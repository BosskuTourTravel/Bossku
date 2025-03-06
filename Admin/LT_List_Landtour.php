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
                    <h3 class="card-title" style="font-weight:bold;">Landtour List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <?php
                                $get_sub_menu = hide_sub_menu(17, $role_check);
                                // var_dump( $get_sub_menu);
                                if ($get_sub_menu != 0) {
                                ?>
                                    <div style="padding-right: 5px;"><a class="btn btn-danger btn-sm" href="export_master_tokped.php" target="_BLANK" title="Export Itin to Excel"><i class="fa fa-file-excel"></i></a></div>
                                <?php
                                }
                                $get_sub_menu = hide_sub_menu(18, $role_check);
                                if ($get_sub_menu != 0) {
                                ?>
                                    <div style="padding-right: 5px;"><a class="btn btn-success btn-sm tip" href="export_list_master.php" target="_BLANK" title="Export Itin to Excel"><i class="fa fa-file-excel"></i></a></div>
                                <?php
                                }
                                $get_sub_menu = hide_sub_menu(19, $role_check);
                                if ($get_sub_menu != 0) {
                                ?>
                                    <div style="padding-right: 5px;"><a class="btn btn-warning btn-sm tip" href="export_list_master_nocode.php" target="_BLANK" title="Export Itin to Excel without Code"><i class="fa fa-file-excel"></i></a></div>
                                <?php
                                }
                                $get_sub_menu = hide_sub_menu(12, $role_check);
                                if ($get_sub_menu != 0) {
                                ?>
                                    <div style="padding-right: 5px;"><button type="submit" onclick="LT_itinerary(1,0,0)" class="btn btn-primary  btn-sm tip" title="Add Itin"><i class="fa fa-plus"></i></button></div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query = "SELECT * FROM  LT_itinerary2 order by id ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <div style="padding: 20px;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($rs)) {

                                    $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['status'];
                                    $rsStaff = mysqli_query($con, $queryStaff);
                                    $rowStaff = mysqli_fetch_array($rsStaff);

                                    $query_bn = "SELECT benua ,negara,kota,ket FROM LT_itinnew where kode='" . $row['landtour'] . "' order by id ASC LIMIT 1";
                                    $rs_bn = mysqli_query($con, $query_bn);
                                    $row_bn = mysqli_fetch_array($rs_bn);

                                ?>
                                    <tr>
                                        <td><?php echo  $row['id'] ?></td>
                                        <td>
                                            <div><?php echo $row['judul'] ?></div>
                                            <div><b><?php
                                                    if ($row['landtour'] == "undefined") {
                                                        echo "Without Landtour";
                                                    } else {
                                                        echo $row['landtour'];
                                                    }
                                                    ?></b>
                                            </div>
                                            <?php
                                            if ($row['landtour'] != "undefined") {
                                            ?>
                                                <div>
                                                    <p><?php echo $row_bn['benua'] . "</br>" . $row_bn['negara'] . "</br>" . $row_bn['kota'] ?></p>
                                                </div>
                                                <div>
                                                    <p><?php echo $row_bn['ket'] ?></p>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div>
                                                <p style="color: green;">
                                                    <?php
                                                    if ($rowStaff['id'] != "") {
                                                        echo "Created by " . $rowStaff['name'] . " on " . $row['tgl'];
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            $get_sub_menu = hide_sub_menu(13, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(27,<?php echo $row['id'] ?>,0)" title="Itin Package"><i class="fas fa-sign-in-alt"></i></a>
                                            <?php
                                            }
                                            $get_sub_menu = hide_sub_menu(14, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-primary btn-sm tip" data-toggle="modal" data-target="#copy_itin" data-id="<?php echo $row['id']  ?>" title="Duplicate Itin"><i class="far fa-clone"></i></a>

                                            <?php
                                            }

                                            $get_sub_menu = hide_sub_menu(15, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-success btn-sm tip" data-toggle="modal" data-target="#note_itin" data-id="<?php echo $row['id']  ?>" title="Note Itin"><i class="fa fa-edit"></i></a>
                                            <?php
                                            }
                                            $get_sub_menu = hide_sub_menu(16, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-danger btn-sm" onclick="del_makelt(<?php echo $row['id'] ?>)" title="Delete Itin"><i class="fa fa-trash"></i></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="copy_itin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Custom Rute</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-custom"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_custom()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="note_itin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Note Itinerary</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-note">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_note()">Submit</button>
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
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top'
        });
        $('#note').summernote();
        $('#note_itin').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_note.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data-note').html(data);
                }
            });
        });
    });
</script>
<script>
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_master.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function add_note() {
        let formData = new FormData();
        var id = $("input[name=id]").val();
        var note = document.getElementById("note").value;
        formData.append('id', id);
        formData.append('note', note);
        // alert(note);
        $.ajax({
            type: 'POST',
            url: "insert_note.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }
</script>