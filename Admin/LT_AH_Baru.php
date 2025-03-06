<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$query = "SELECT * FROM  LT_AH_Main WHERE copy_id='" . $_POST['id'] . "' && grub_id='".$_POST['grub_id']."' order by hari ASC";
$rs = mysqli_query($con, $query);
// var_dump($query);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour ADD Hari List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_sub['master_id'] ?>)"><i class="fa fa-chevron-circle-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="AH_Package(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>,0)"><i class="fas fa-sync-alt"></i></a>
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
                                            <?php echo "DAY " . $row['hari'] . " - " . $row['rute']; ?>
                                        </div>
                                        <div class="col-md-4" style="text-align: right;">
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_rute" data-id="<?php echo $row['id']  ?>" data-copy="<?php echo  $_POST['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-success btn-sm" onclick="AH_Package(1,<?php echo $row['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-mountain"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="AH_Package(2,<?php echo $row['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-hard-hat"></i></button>
                                            <button type="button" class="btn btn-info btn-sm" onclick="AH_Package(3,<?php echo $row['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-hotel"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="del_AH(<?php echo $row['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="tempat" style="padding: 20px 10px;">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tempat</th>
                                                    <th scope="col">Meal</th>
                                                    <th scope="col" style="max-width: 100px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $queryTmp = "SELECT * FROM  LT_AH_ListTempat where tour_id='" . $row['copy_id'] . "' && grub_id='".$_POST['grub_id']."' && hari='" . $row['hari'] . "' order by urutan ASC";
                                                $rsTmp = mysqli_query($con, $queryTmp);
                                                // var_dump($queryTmp);
                                                while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                                    $query_tempat = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
                                                    $rs_tempat = mysqli_query($con, $query_tempat);
                                                    $row_tempat = mysqli_fetch_array($rs_tempat);

                                                    $queryMeal = "SELECT * FROM  LT_AH_ListMeal where tour_id='" . $row['copy_id'] . "' && grub_id='".$_POST['grub_id']."' && hari='" . $row['hari'] . "'";
                                                    $rsMeal = mysqli_query($con, $queryMeal);
                                                    $rowMeal = mysqli_fetch_array($rsMeal);
                                                    $meal = "";
                                                    if ($rowMeal['id'] != "") {
                                                        if ($rowMeal['bf'] != '0' or $rowMeal['ln'] != '0' or $rowMeal['dn'] != '0') {
                                                            $b = "";
                                                            $l = "";
                                                            $d = "";
                                                            if ($rowMeal['bf'] != '0') {
                                                                $b = "B";
                                                            }
                                                            if ($rowMeal['ln'] != '0') {
                                                                $l = "L";
                                                            }
                                                            if ($rowMeal['dn'] != '0') {
                                                                $d = "D";
                                                            }
                                                            $meal = "(" . $b . $l . $d . ")";
                                                        }
                                                    }

                                                ?>
                                                    <tr>
                                                        <td><?php echo $row_tempat['tempat'] ?></td>
                                                        <td><?php echo $meal ?></td>
                                                        <td style="max-width: 150px;">
                                                            <button type="button" class="btn btn-primary btn-sm" onclick="up_tmp(<?php echo $rowTmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $rowTmp['urutan'] ?>)"><i class="fa fa-arrow-up"></i></button>
                                                            <button type="button" class="btn btn-primary btn-sm" onclick="down_tmp(<?php echo $rowTmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $rowTmp['urutan'] ?>)"><i class="fa fa-arrow-down"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="del_tmp(<?php echo $rowTmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    <tr>
                                                    <?php

                                                }
                                                    ?>

                                            </tbody>
                                        </table>

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
                url: "del_AH_Rute_day.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        // LT_itinerary(81, y, 0);
                        AH_Package(0,y,z,u);
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
                url: "del_AH_list_tmp2.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        // LT_itinerary(81, y, 0);
                        AH_Package(0,y,z,u);
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
            const sfee_id = $button.data('sfee');
            const grub_id = $button.data('grub');
            const hari = $modalBody.find($("input[name=hari]")).val();
            const rute = $modalBody.find($("input[name=rute]")).val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('sfee_id', sfee_id);
            formData.append('hari', hari);
            formData.append('rute', rute);
            formData.append('grub_id', grub_id);
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "add_AH.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    AH_Package(0, id, grub_id,sfee_id);
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
                url: "modal_update_rute.php",
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
                // LT_itinerary(3, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }

    function fungsi_update_rute() {
		var hari = document.getElementById('hari_rute').value;
		var copy_id =  document.getElementById('copy_id').value;
		var master_id =  document.getElementById('master_id').value;
		var rute =  $("input[name=rute_name]").val();
        var x = document.getElementById('id_rute').value;
		let formData = new FormData();
		formData.append("rute", rute);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		formData.append('hari', hari);
		formData.append("id", x);
		$.ajax({
			type: 'POST',
			url: "updateHR_add_LTrute.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
                LT_itinerary(81,copy_id,0);
			},
			error: function() {
				alert("Data Gagal Update");
			}
		});
	}
</script>