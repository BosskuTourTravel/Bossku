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
                    <h3 class="card-title" style="font-weight:bold;">Paket Tour List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <div style="padding-right: 5px;"><a class="btn btn-warning btn-sm tip" href="export_list_ptsub.php" target="_BLANK" title="Export to Excel"><i class="fa fa-file-excel"></i></a></div>
                                <div style="padding-right: 5px;"><a class="btn btn-success btn-sm tip" href="export_listprice_ptsub.php" target="_BLANK" title="Export to Excel without Code"><i class="fa fa-file-excel"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query = "SELECT LTSUB_itin.* ,login_staff.name ,LT_itinnew.benua ,LT_itinnew.negara,LT_itinnew.kota,LT_itinnew.ket FROM LTSUB_itin INNER JOIN login_staff ON LTSUB_itin.status=login_staff.id INNER JOIN LT_itinnew ON LTSUB_itin.landtour=LT_itinnew.kode GROUP BY LT_itinnew.kode ORDER by LTSUB_itin.id ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1;
                    ?>
                    <div style="padding: 20px;">
                        <table id="tb-pt-sub" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Master ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($rs)) {

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
                                                    <p><?php echo $row['benua'] . "</br>" . $row['negara'] . "</br>" . $row['kota'] ?></p>
                                                </div>
                                                <div>
                                                    <p><?php echo $row['ket'] ?></p>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div>
                                                <p style="color: green;">
                                                    <?php
                                                    if (isset($row['status'])) {
                                                        echo "Duplicated by " . $row['name'] . " on " . $row['tgl'];
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                        <td><?php echo $row['master_id'] ?></td>
                                        <td>
                                        <a class="btn btn-info btn-sm tip" onclick="MN_Package(0,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="print"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-success btn-sm tip" onclick="FL_Package(0,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Add Flight"><i class="fa fa-plane"></i></a>
                                        <a class="btn btn-danger btn-sm tip" onclick="delete_itin(<?php echo $row['id'] ?>)" title="Delete Itin PT"><i class="fa fa-trash"></i></a>
                                            <!-- <?php
                                            $get_sub_menu = hide_sub_menu(20, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-info btn-sm tip" onclick="MN_Package(0,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="maintenance"><i class="fa fa-print"></i></a>
                                            <?php
                                            }
                                            $get_sub_menu = hide_sub_menu(22, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-success btn-sm tip" onclick="FL_Package(0,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Add Flight"><i class="fa fa-plane"></i></a>
                                            <?php
                                            }
                                            $get_sub_menu = hide_sub_menu(27, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-danger btn-sm tip" onclick="delete_itin(<?php echo $row['id'] ?>)" title="Delete Itin PT"><i class="fa fa-trash"></i></a>
                                            <?php
                                            }
                                            ?> -->
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
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
    });
</script>
<script>
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>
<script>
    function delete_itin(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_copy.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(40, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>