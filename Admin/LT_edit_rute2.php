<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query_data = "SELECT * FROM  LTSUB_itin where id='" . $_POST['id'] . "'";
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query = "SELECT * FROM LT_Rute where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='".$_POST['grub_id']."'";
$rs = mysqli_query($con, $query);
// var_dump($query);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Edit Rute</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_data['master_id'] ?>)"><i class="fa fa-chevron-circle-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="RT_Package(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-sync-alt"></i></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="far fa-calendar-plus"></i></a>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ADD DAY </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="hari">day </label>
                                                        <input type="text" class="form-control" id="hari" name="hari" placeholder="Select Day">
                                                    </div>
                                                    <div class="col">
                                                        <label for="rutet">Rute</label>
                                                        <input type="text" class="form-control" id="rute" name="rute" placeholder="rute">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-success btn-sm submit" data-id="<?php echo $_POST['id'] ?>" data-grub="<?php echo $_POST['grub_id'] ?>" data-sfee="<?php echo $_POST['sfee_id'] ?>" data-dismiss="modal">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="container" style="padding: 20px;">

                        <?php
                        while ($row = mysqli_fetch_array($rs)) {
                        ?>
                            <div class="card">
                                <div class="card-header" style="background-color: darkslategray; color: white;">
                                    <div class="row">
                                        <div class="col-md-8" style="text-align: left; font-weight: bold; font-size: 16px;">
                                            <?php echo "DAY " . $row['hari'] . " - " . $row['nama']; ?>
                                        </div>
                                        <div class="col-md-4" style="text-align: right;">
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_rute" data-id="<?php echo $row['id']  ?>" data-copy="<?php echo  $_POST['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-success btn-sm" onclick="RT_Package(1,<?php echo $_POST['id'] ?>,<?php echo $row['id'] ?>,0)"><i class="fas fa-mountain"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="del_AH(<?php echo $row['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="tempat" style="padding: 20px 10px;">
                                        <?php
                                        $query_lte_tmp_cek = "SELECT * FROM LT_RT_list_tmp where rute_id='" . $row['id'] . "'";
                                        $rs_lte_tmp_cek = mysqli_query($con, $query_lte_tmp_cek);
                                        $row_lte_tmp_cek = mysqli_fetch_array($rs_lte_tmp_cek);
                                        if ($row_lte_tmp_cek['id'] == "") {
                                        } else {
                                        ?>
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tempat</th>
                                                        <th scope="col" style="max-width: 100px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query_lte_tmp = "SELECT * FROM LT_RT_list_tmp where rute_id='" . $row['id'] . "' order by hari ASC, urutan ASC";
                                                    $rs_lte_tmp = mysqli_query($con, $query_lte_tmp);
                                                    while ($row_lte_tmp = mysqli_fetch_array($rs_lte_tmp)) {
                                                        $query_tempat = "SELECT * FROM List_tempat where id=" . $row_lte_tmp['tmp'];
                                                        $rs_tempat = mysqli_query($con, $query_tempat);
                                                        $row_tempat = mysqli_fetch_array($rs_tempat);
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row_tempat['tempat'] ?></td>
                                                            <td style="max-width: 150px;">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="up_tmp(<?php echo $row_lte_tmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $row_lte_tmp['urutan'] ?>)"><i class="fa fa-arrow-up"></i></button>
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="down_tmp(<?php echo $row_lte_tmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $row_lte_tmp['urutan'] ?>)"><i class="fa fa-arrow-down"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="del_tmp(<?php echo $row_lte_tmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        <tr>
                                                        <?php
                                                    }

                                                        ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                    </div>
                    <div class="modal fade" id="edit_rute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">UPDATE RUTE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="fungsi_update_rute()" data-dismiss="modal">Submit</button>
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
    function del_AH(x, y,z,u) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_LT_RT_rute.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        alert(data);
                        RT_Package(0,y,z,u);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function del_tmp(x, y,z,u) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_LT_RT_tmp.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        // LT_itinerary(35, y, 0);
                        RT_Package(0,y,z,u);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            const id = $button.data('id');
            const grub = $button.data('grub');
            const sfee = $button.data('sfee');
            const hari = $modalBody.find($("input[name=hari]")).val();
            const rute = $modalBody.find($("input[name=rute]")).val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('hari', hari);
            formData.append('rute', rute);
            formData.append('grub_id',grub);
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "add_LT_Rute.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    RT_Package(0,id,grub,sfee)
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
            //  console.log(id, hari, rute);

        });

        $('#edit_rute').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var copy = $(e.relatedTarget).data('copy');
            $.ajax({
                url: "modal_lte_update_rute.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    copy: copy
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
    });
</script>
<script>

    function fungsi_update_rute() {
        var hari = document.getElementById('hari_rute').value;
        var copy_id = document.getElementById('copy_id').value;
        var master_id = document.getElementById('master_id').value;
        var rute = $("input[name=rute_name]").val();
        var x = document.getElementById('id_rute').value;
        let formData = new FormData();
        formData.append("rute", rute);
        formData.append('copy_id', copy_id);
        formData.append('master_id', master_id);
        formData.append('hari', hari);
        formData.append("id", x);
        $.ajax({
            type: 'POST',
            url: "update_lte_rute.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                LT_itinerary(35, copy_id, 0);
            },
            error: function() {
                alert("Data Gagal Update");
            }
        });
    }
</script>