<?php
include "../db=connection.php";
session_start();
$query_role = "SELECT * FROM Staff_role where staff_id='" . $_SESSION['staff_id'] . "'";
$rs_role = mysqli_query($con, $query_role);
$row_role = mysqli_fetch_array($rs_role);
$role_check = explode(",", $row_role['menu_sub']);
function hide_sub_menu($x, $y)
{
    $sub_menu = 0;
    $key_sub_menu = array_search($x, $y);
    if ($key_sub_menu !== false) {
        $sub_menu = 1;
    }
    return $sub_menu;

    // return json_encode(array("sub_menu" => $sub_menu), true);
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Upload Tokopedia Landtour Package</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#new_package">New Package</i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="MP_Package(6,0,0)" title="Reload"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query = "SELECT MP_tokopedia_land.id,MP_tokopedia_land.tgl,MP_tokopedia_land.nama,login_staff.name as staff FROM MP_tokopedia_land LEFT JOIN login_staff ON MP_tokopedia_land.staff=login_staff.id order by id ASC";
                    $rs = mysqli_query($con, $query);
                    // var_dump($query);

                    $no = 1;
                    ?>
                    <div style="padding: 20px;">
                        <table id="tb-pt-sub" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>TGL </th>
                                    <th>Nama Package</th>
                                    <th>Staff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = mysqli_fetch_array($rs)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['tgl'] ?></td>
                                        <td><?php echo $row['nama'] ?></td>
                                        <td><?php echo $row['staff'] ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm tip" onclick="MP_Package(7,<?php echo $row['id'] ?>,0)" title="Input Product"><i class="fas fa-sign-in-alt"></i></a>
                                            <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#edit_package" data-id="<?php echo $row['id'] ?>" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm tip" onclick="del_all(<?php echo $row['id']  ?>)" title="Delete Data"><i class="fas fa-trash"></i></a>
                                            <a class="btn btn-success btn-sm tip" href="export_tokopedia_land_list.php?id=<?php echo $row['id'] ?>" target="_BLANK" title="Export to Excel"><i class="fa fa-file-excel"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="new_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Package Name</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Enter Package Name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_package()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">EDIT Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="edit_package()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tb-pt-sub').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
        $('#edit_package').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_edit_tokped_package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
    });


    function add_package() {
        var nama = document.getElementById("nama").value;
        // alert(nama);
        $.ajax({
            url: "insert_package_tokopedia_land.php",
            method: "POST",
            asynch: false,
            data: {
                nama: nama,
            },
            success: function(data) {
                alert(data);
            }
        });
    }

    function edit_package() {
        var nama = document.getElementById("edit").value;
        var id = document.getElementById("mp_id").value;
        // alert(nama);
        $.ajax({
            url: "edit_package_tokopedia_land.php",
            method: "POST",
            asynch: false,
            data: {
                nama: nama,
                id: id
            },
            success: function(data) {
                alert(data);
            }
        });
    }

    function del_all(x) {
        var txt;
        var r = confirm("Apakah Kamu yakin menghapus Semua data ?");
        if (r == true) {
            $.ajax({
                url: "MP_tokopedia_land_delete_all.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    // alert(data);
                    // MP_Package(2, x, 0);
                    del_package(x);
                }
            });
        }

    }

    function del_package(x) {
        $.ajax({
            url: "tokopedia_land_list_delete.php",
            method: "POST",
            asynch: false,
            data: {
                id: x
            },
            success: function(data) {
                alert(data);
                MP_Package(6,0,0);
            }
        });
    }
</script>