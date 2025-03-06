<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$hari = $row_data['hari'];
if ($row_data['landtour'] == "undefined") {
    $ket_hotel = "Berdasarkan Hotel Name TBA";
} else {
    $ket_hotel = "Berdasarkan Pilihan Itinerary";
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">KODE : <?php echo $row_data['landtour'] ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(23,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(32,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card text-left" style="padding: 20px;">
                        <div class="list-tempat" id="list-tempat">
                            <form>
                                <?php
                                $statusTmp = 0;
                                for ($x = 1; $x <= $hari; $x++) {
                                    $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='$x'";
                                    $rsTmp = mysqli_query($con, $queryTmp);
                                    $rowTmp = mysqli_fetch_array($rsTmp);

                                    if ($rowTmp['id'] != "") {
                                        $statusTmp = 1;
                                    }
                                ?>
                                    <div style="border: 2px solid; border-color:darkgreen; padding: 10px; margin-bottom: 5px;">
                                        <div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
                                        <div id="<?php echo $x ?>dynamic_field">
                                            <?php
                                            if ($rowTmp['id'] != "") {
                                                $queryTmp2 = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='$x' order by urutan ASC";
                                                $rsTmp2 = mysqli_query($con, $queryTmp2);
                                                $y = 1;
                                                while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                                                    $i = $rowTmp2['urutan'];
                                                    $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
                                                    $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                                    $row_tempat2 = mysqli_fetch_array($rs_tempat2);
                                                    // var_dump($row_tempat2['negara']);
                                            ?>
                                                    <div id="<?php echo $x ?>row<?php echo $i ?>">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <label style="font-size: 11px">List Tempat </label>
                                                                    <input class="form-control form-control-sm" list="<?php echo $x ?>tmp_list" name="<?php echo $x ?>tmp[]" id="<?php echo $x ?>tmp[]" value="<?php echo $row_tempat2['negara'] . " " . $row_tempat2['city'] . " " . $row_tempat2['tempat'] ?>">
                                                                    <datalist id="<?php echo $x ?>tmp_list">

                                                                        <?php
                                                                        $query_tempat = "SELECT * FROM List_tempat Order by id ASC";
                                                                        $rs_tempat = mysqli_query($con, $query_tempat);
                                                                        while ($row_tempat = mysqli_fetch_array($rs_tempat)) {
                                                                        ?>
                                                                            <option data-customvalue="<?php echo $row_tempat['id'] ?>" value="<?php echo $row_tempat['negara'] . " " . $row_tempat['city'] . " " . $row_tempat['tempat'] ?>"></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-1">
																<input class="form-check-input" type="radio" name="opt" id="popt" value="0" checked>
																<label class="form-check-label" for="pilihan0">Optional</label>
															</div> -->
                                                            <?php
                                                            if ($y == 1) {
                                                            ?>
                                                                <div class="col-md-2">
                                                                    <div class="form-group" style="padding-top: 25px;">
                                                                        <button type="button" name="<?php echo $x ?>add" id="<?php echo $x ?>add" class="btn btn-primary btn-sm" onclick="add_row(<?php echo $x ?>)">Add More</button>
                                                                    </div>
                                                                </div>
                                                            <?php

                                                            } else {
                                                            ?>
                                                                <div class="col-md-2">
                                                                    <div class="form-group" style="padding-top: 25px">
                                                                        <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn-sm btn_remove" onclick="remove(<?php echo $x ?>,<?php echo $i ?>)"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                    $y++;
                                                }
                                            } else {
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label style="font-size: 11px;">List Tempat </label>
                                                            <input class="form-control form-control-sm" list="<?php echo $x ?>tmp_list" name="<?php echo $x ?>tmp[]" id="<?php echo $x ?>tmp" placeholder="Masukkan Nama Tempat">
                                                            <datalist id="<?php echo $x ?>tmp_list">
                                                                <?php
                                                                $query_tempat = "SELECT * FROM List_tempat Order by id ASC";
                                                                $rs_tempat = mysqli_query($con, $query_tempat);
                                                                while ($row_tempat = mysqli_fetch_array($rs_tempat)) {
                                                                ?>
                                                                    <option data-customvalue="<?php echo $row_tempat['id'] ?>" value="<?php echo $row_tempat['negara'] . " " . $row_tempat['city'] . " " . $row_tempat['tempat'] ?>"></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group" style="padding-top: 25px;">
                                                            <button type="button" name="<?php echo $x ?>add" id="<?php echo $x ?>add" class="btn btn-primary btn-sm" onclick="add_row(<?php echo $x ?>)">Add More</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
                                <?php
                                if ($statusTmp == '1') {
                                ?>
                                    <div class="tmp-button-update" id="tmp-button-update">
                                        <button type="button" class="btn btn-success" id='but_upload4' onclick="fungsi_update_tmp(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="tmp-button-add" id="tmp-button-add">
                                        <button type="button" class="btn btn-warning" id='but_upload3' onclick="fungsi_add_tmp(<?php echo $row_data['id'] ?>)">ADD</button>
                                    </div>
                                    <div class="tmp-button-update" id="tmp-button-update" style="display: none;">
                                        <button type="button" class="btn btn-success" id='but_upload4' onclick="fungsi_update_tmp(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                }
                                ?>
                            </form>
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
            placement: 'top',
            trigger: "hover"
        });
    });
</script>
<script>
	var i = 1;

	function add_row(x) {
		i++;
		$.ajax({
			url: "LT_tempat_field.php",
			method: "POST",
			asynch: false,
			data: {
				x: x,
				i: i
			},
			success: function(data) {
				$('#' + x + 'dynamic_field').append(data);
			}
		});

	}

	function remove(x, y) {
		var button_id = y;
		$('#' + x + 'row' + button_id).remove();
	}
</script>
<script>
    function fungsi_add_tmp(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            var values = $("input[name='" + i + "tmp[]']").map(function() {
                return $('#' + i + 'tmp_list [value="' + $(this).val() + '"]').data('customvalue');
            }).get();
            // alert(values);
            formData.append("list_tmp[]", values);
        }

        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "insert_add_LTtmp.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.tmp-button-update').show();
                $('.tmp-button-add').hide();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function fungsi_update_tmp(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            var values = $("input[name='" + i + "tmp[]']").map(function() {
                return $('#' + i + 'tmp_list [value="' + $(this).val() + '"]').data('customvalue');
            }).get();
            // alert(values);
            formData.append("list_tmp[]", values);
        }

        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "update_add_LTtmp.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.tmp-button-update').show();
                // $('.list-button-add').hide();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
</script>