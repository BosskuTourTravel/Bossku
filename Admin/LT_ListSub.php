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
                    <h3 class="card-title" style="font-weight:bold;">Landtour SUB List</h3>
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
                    $query = "SELECT * FROM  LTSUB_itin where cabang='2' order by id ASC";
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
                                    <th>Exclude</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($rs)) {

                                    $queryStaff = "SELECT id,name FROM  login_staff WHERE id=" . $row['status'];
                                    $rsStaff = mysqli_query($con, $queryStaff);
                                    $rowStaff = mysqli_fetch_array($rsStaff);

                                    $queryStaff2 = "SELECT cabang FROM  login_staff WHERE id=" . $_SESSION['staff_id'];
                                    $rsStaff2 = mysqli_query($con, $queryStaff2);
                                    $rowStaff2 = mysqli_fetch_array($rsStaff2);

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
                                                        echo "Duplicated by " . $rowStaff['name'] . " on " . $row['tgl'];
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </td>
                                        <td><?php echo $row['master_id'] ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                            if ($row['landtour'] == "undefined") {
                                                $querySH = "SELECT id FROM LT_select_PilihHTLNC where master_id='" . $row['master_id'] . "'";
                                                $rsSH = mysqli_query($con, $querySH);
                                                $rowSH = mysqli_fetch_array($rsSH);
                                            } else {
                                                $querySH = "SELECT id FROM LT_select_PilihHTL where master_id='" . $row['master_id'] . "' && copy_id='" . $row['id'] . "'";
                                                $rsSH = mysqli_query($con, $querySH);
                                                $rowSH = mysqli_fetch_array($rsSH);
                                            }
                                            $get_sub_menu = hide_sub_menu(20, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <a class="btn btn-info btn-sm tip" onclick="LT_itinerary(33,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Print Custom"><i class="fa fa-print"></i></a>
                                                <!-- <a class="btn btn-info btn-sm tip" onclick="LT_itinerary(34,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="maintenance"><i class="fa fa-bomb"></i></a> -->
                                                 <a class="btn btn-info btn-sm tip" onclick="MN_Package(0,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="maintenance"><i class="fa fa-bomb"></i></a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($rowStaff2['cabang'] == '2') {
                                                $get_sub_menu = hide_sub_menu(21, $role_check);
                                                if ($get_sub_menu != 0) {
                                            ?>
                                                    <a class="btn btn-danger btn-sm tip" onclick="LT_itinerary(81,<?php echo $row['id'] ?>,0)" title="Tambah Hari"><i class="far fa-calendar-plus"></i></a>
                                                <?php
                                                }
                                                $get_sub_menu = hide_sub_menu(22, $role_check);
                                                if ($get_sub_menu != 0) {
                                                ?>
                                                    <a class="btn btn-danger btn-sm tip" onclick="LT_itinerary(25,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Add Flight"><i class="fa fa-plane"></i></a>
                                                    <?php
                                                }
                                                if ($rowSH['id'] == "") {
                                                    $get_sub_menu = hide_sub_menu(23, $role_check);
                                                    if ($get_sub_menu != 0) {
                                                    ?>
                                                        <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(11,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Add Hotel"><i class="fas fa-hotel"></i></a>
                                                    <?php
                                                    }
                                                } else {
                                                    $get_sub_menu = hide_sub_menu(23, $role_check);
                                                    if ($get_sub_menu != 0) {
                                                    ?>
                                                        <a class="btn btn-success btn-sm tip" onclick="LT_itinerary(11,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Edit Hotel"><i class="fas fa-hotel"></i></a>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if ($row['landtour'] == "undefined") {
                                                ?>
                                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#tips_nc" data-id="<?php echo $row['id']  ?>" data-master="<?php echo $row['master_id'] ?>"><i class="fas fa-donate"></i></a>
                                                <?php
                                                }
                                                $get_sub_menu = hide_sub_menu(25, $role_check);
                                                if ($get_sub_menu != 0) {
                                                ?>
                                                    <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(18,<?php echo $row['id'] ?>,0)" title="Edit Judul"><i class="fa fa-edit"></i></a>
                                                <?php
                                                }
                                                $get_sub_menu = hide_sub_menu(26, $role_check);
                                                if ($get_sub_menu != 0) {
                                                ?>
                                                    <a class="btn btn-warning btn-sm tip" title="Edit Rute" onclick="LT_itinerary(35,<?php echo $row['id'] ?>,0)"><i class="fa fa-tools"></i></a>
                                                <?php
                                                }
                                                $get_sub_menu = hide_sub_menu(27, $role_check);
                                                if ($get_sub_menu != 0) {
                                                ?>
                                                    <a class="btn btn-danger btn-sm tip" onclick="delete_itin(<?php echo $row['id'] ?>)" title="Delete Itin PT"><i class="fa fa-trash"></i></a>
                                                <?php
                                                }
                                            }
                                            ?>
                                            <a class="btn btn-success btn-sm tip" onclick="FL_Package(0,<?php echo $row['id'] ?>,<?php echo $row['master_id'] ?>)" title="Add Flight"><i class="fa fa-plane"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="tips_nc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">TIPS WITHOUT CODE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_tips_nc()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal fade" id="visa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">VISA </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-visa"></div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_visa()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="modal fade" id="linkCustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    function add_tips_nc() {
        let formData = new FormData();
        var negara = document.getElementById('negara').value;
        var master = document.getElementById('master').value;
        var id = document.getElementById('copy_id').value;
        // work with the values here:
        formData.append('copy_id', id);
        formData.append('master_id', master);
        formData.append('negara', negara);
        $.ajax({
            type: 'POST',
            url: "add_LT_Tips.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                $('#tips_nc').modal('hide');
                LT_itinerary(3, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }

    function add_visa() {
        let formData = new FormData();
        var visa = $("input[name=visa]").val();
        var masterId = document.getElementById('master').value;
        var id = document.getElementById('copy_id').value;
        // work with the values here:
        formData.append('copy_id', id);
        formData.append('master_id', masterId);
        formData.append('visa', visa);
        $.ajax({
            type: 'POST',
            url: "add_LT_Visa.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                $('#visa').modal('hide');
                LT_itinerary(3, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }

    function add_custom() {
        let formData = new FormData();

        const id = document.getElementById('copy_id').value;
        const masterId = document.getElementById('master').value;
        const tmp11 = document.getElementById('tmp11').value;
        const tmp12 = document.getElementById('tmp12').value;
        const tmp21 = document.getElementById('tmp21').value;
        const tmp22 = document.getElementById('tmp22').value;
        const rute1 = document.getElementById('rute1').value;
        const rute2 = document.getElementById('rute2').value;

        // work with the values here:
        formData.append('copy_id', id);
        formData.append('master_id', masterId);
        formData.append('tmp11', tmp11);
        formData.append('tmp12', tmp12);
        formData.append('tmp21', tmp21);
        formData.append('tmp22', tmp22);
        formData.append('rute1', rute1);
        formData.append('rute2', rute2);
        $.ajax({
            type: 'POST',
            url: "add_LT_custom_rute.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                $('#linkCustom').modal('hide');
                LT_itinerary(3, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tips_nc').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "tips_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master: master
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
        $('#visa').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "visa_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master: master
                },
                success: function(data) {
                    $('.modal-data-visa').html(data);
                }
            });
        });
        $('#linkCustom').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "customrute_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master: master
                },
                success: function(data) {
                    $('.modal-data-custom').html(data);
                }
            });
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
                        LT_itinerary(3, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>