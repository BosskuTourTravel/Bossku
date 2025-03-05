<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";


$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
$rs_LTNx = mysqli_query($con, $query_LTNx);

$query_data = "SELECT * FROM LT_add_hari WHERE id=" . $_POST['row'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$hari = $row_data['hari'];
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM TAMBAH HARI COMPONENT LANDTOUR
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
						<div class="input-group-append" style="text-align: right;">
							<a class="btn btn-warning btn-sm" onclick="LT_itinerary(8,<?php echo  $_POST['id'] ?>,0)"><i class="fa fa-chevron-circle-left"></i></a>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan0" value="0" checked>
							<label class="form-check-label" for="pilihan0">Rute</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan1" value="1">
							<label class="form-check-label" for="pilihan1">List Tempat</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan2" value="2">
							<label class="form-check-label" for="pilihan2">Guest Meal</label>
						</div>
						<!-- <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan4" value="4">
							<label class="form-check-label" for="pilihan4">TL Fee</label>
						</div> -->
					</div>

					<div class="card-body">
						<div class="rute" id="rute">
							<from>
								<div class="form-group">
									<label for="exampleInputEmail1">Rute - Day <?php echo $hari ?></label>
									<input type="text" class="form-control form-control-sm" id="rute" name="rute" value="<?php echo $row_data['rute'] ?>">
								</div>
								<input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
								<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_data['copy_id'] ?>">
								<input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_data['master_id'] ?>">
								<div class="list-button-update" id="list-button-update">
									<button type="button" class="btn btn-success" id='but_upload2' onclick="fungsi_update_rute(<?php echo $row_data['id'] ?>)">UPDATE</button>
								</div>
							</from>
						</div>
						<div class="list-tempat" id="list-tempat" style="display: none;">
							<?php
							$statusTmp = 0;
							$queryTmp = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='$hari'";
							$rsTmp = mysqli_query($con, $queryTmp);
							$rowTmp = mysqli_fetch_array($rsTmp);

							if ($rowTmp['id'] != "") {
								$statusTmp = 1;
							}

							?>
							<form>
								<div style="border: 2px solid; border-color:darkgreen; padding: 10px; margin-bottom: 5px;">
									<div style="text-align: center; font-weight: bold;">Day <?php echo $hari ?></div>
									<div id="dynamic_field">
										<?php
										if ($rowTmp['id'] != "") {
											$queryTmp2 = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='$hari'";
											$rsTmp2 = mysqli_query($con, $queryTmp2);
											$y = 1;
											while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
												$i = $rowTmp2['urutan'];
												$query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
												$rs_tempat2 = mysqli_query($con, $query_tempat2);
												$row_tempat2 = mysqli_fetch_array($rs_tempat2);
										?>
												<div id="row<?php echo $i ?>">
													<div class="row">
														<div class="col-md-10">
															<div class="form-group">
																<label style="font-size: 11px">List Tempat </label>
																<input class="form-control form-control-sm" list="tmp_list" name="tmp[]" id="tmp[]" value="<?php echo $row_tempat2['negara'] . " " . $row_tempat2['city'] . " " . $row_tempat2['tempat'] ?>">
																<datalist id="tmp_list">
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
														<?php
														if ($y == 1) {
														?>
															<div class="col-md-2">
																<div class="form-group" style="padding-top: 25px;">
																	<button type="button" name="add" id="add" class="btn btn-primary btn-sm" onclick="add_row()">Add More</button>
																</div>
															</div>
														<?php

														} else {
														?>
															<div class="col-md-2">
																<div class="form-group" style="padding-top: 25px">
																	<button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn-sm btn_remove" onclick="remove(<?php echo $i ?>)"><i class="fa fa-trash"></i></button>
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
														<input class="form-control form-control-sm" list="tmp_list" name="tmp[]" id="tmp" placeholder="Masukkan Nama Tempat">
														<datalist id="tmp_list">
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
														<button type="button" name="add" id="add" class="btn btn-primary btn-sm" onclick="add_row()">Add More</button>
													</div>
												</div>
											</div>
										<?php
										}
										?>

									</div>
								</div>
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
						<!-- meal package -->
						<div class="meal" id="meal" style="display: none;">
							<form>
								<?php
								$statusMeal = 0;

								$queryMeal = "SELECT * FROM  LTHR_add_meal where tour_id='" . $_POST['id'] . "' && hari='$hari'";
								$rsMeal = mysqli_query($con, $queryMeal);
								$rowMeal = mysqli_fetch_array($rsMeal);
								// var_dump($queryMeal);

								$query_up = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['bf'];
								$rs_up = mysqli_query($con, $query_up);
								$row_up = mysqli_fetch_array($rs_up);
								// var_dump($query_up);

								$query_upln = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['ln'];
								$rs_upln = mysqli_query($con, $query_upln);
								$row_upln = mysqli_fetch_array($rs_upln);

								$query_updn = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['dn'];
								$rs_updn = mysqli_query($con, $query_updn);
								$row_updn = mysqli_fetch_array($rs_updn);

								if ($rowMeal['id'] != "") {
									$statusMeal = 1;
								}
								?>
								<div style="border: 2px solid; border-color:darkorange; padding: 10px; margin-bottom: 5px;">
									<div style="text-align: center; font-weight: bold;">Day </div>
									<div style="padding-left: 50px; padding-bottom: 5px;">
										<div class="row">
											<div class="col-md-4">
												<label style="font-size: 11px;">BREAKFAST</label>
												<input class="form-control form-control-sm" list="bf_list" name="bf" id="bf" value="<?php echo $row_up['negara'] ?>" autocomplete="off">
												<datalist id="bf_list">
													<?php
													$query_mealb = "SELECT * FROM Guest_meal2 WHERE meal_type='BREAKFAST' Order by negara ASC";
													$rs_mealb = mysqli_query($con, $query_mealb);

													while ($row_mealb = mysqli_fetch_array($rs_mealb)) {
													?>
														<option data-customvalue="<?php echo $row_mealb['id'] ?>" value="<?php echo $row_mealb['negara'] ?>"></option>
													<?php
													}
													?>
												</datalist>
											</div>
											<div class="col-md-4">
												<label style="font-size: 11px;">LUNCH</label>
												<input class="form-control form-control-sm" list="ln_list" name="ln" id="ln" value="<?php echo $row_upln['negara'] ?>" autocomplete="off">
												<datalist id="ln_list">
													<?php
													$query_meall = "SELECT * FROM Guest_meal2  WHERE meal_type='LUNCH' Order by negara ASC";
													$rs_meall = mysqli_query($con, $query_meall);
													while ($row_meall = mysqli_fetch_array($rs_meall)) {
													?>
														<option data-customvalue="<?php echo $row_meall['id'] ?>" value="<?php echo $row_meall['negara'] ?>"></option>
													<?php
													}
													?>
												</datalist>
											</div>
											<div class="col-md-4">
												<label style="font-size: 11px;">DINNER</label>
												<input class="form-control form-control-sm" list="dn_list" name="dn" id="dn" value="<?php echo $row_updn['negara'] ?>" autocomplete="off">
												<datalist id="dn_list">
													<?php
													$query_meal2 = "SELECT * FROM Guest_meal2  WHERE meal_type='DINNER' Order by negara ASC";
													$rs_meald = mysqli_query($con, $query_meal2);
													while ($row_meald = mysqli_fetch_array($rs_meald)) {
													?>
														<option data-customvalue="<?php echo $row_meald['id'] ?>" value="<?php echo $row_meald['negara'] ?>"></option>
													<?php
													}
													?>
												</datalist>
											</div>
										</div>
									</div>
								</div>
								<?php

								?>
								<input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
								<?php
								if ($statusMeal == '1') {
								?>
									<div class="tmp-button-update" id="tmp-button-update">
										<button type="button" class="btn btn-success" onclick="fungsi_update_meal(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								} else {
								?>
									<div class="meal-button-add" id="meal-button-add">
										<button type="button" class="btn btn-warning" onclick="fungsi_add_meal(<?php echo $row_data['id'] ?>)">ADD</button>
									</div>
									<div class="meal-button-update" id="meal-button-update" style="display: none;">
										<button type="button" class="btn btn-success" onclick="fungsi_update_meal(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								}
								?>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	function fungsi_tmpt() {
		var x = document.getElementById("list-tempat");

		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>
<script>
	$(document).ready(function() {
		$('.form-check-input').click(function() {

			var target = $(this).val();
			if (target == 0) {
				$('.rute').show();
				$('.list-tempat').hide();
				$('.meal').hide();
				// $('.tl-fee').hide();

			} else if (target == 1) {
				$('.rute').hide();
				$('.list-tempat').show();
				$('.meal').hide();
				// $('.tl-fee').hide();
			} else if (target == 2) {
				$('.rute').hide();
				$('.list-tempat').hide();
				$('.meal').show();
				// $('.tl-fee').hide();
			} else {

			}
		});

	});
</script>
<script>
	var i = 1;

	function add_row() {
		i++;
		$.ajax({
			url: "LT_tempat_sgl.php",
			method: "POST",
			asynch: false,
			data: {
				i: i
			},
			success: function(data) {
				$('#dynamic_field').append(data);
			}
		});

	}

	function remove(y) {
		var button_id = y;
		$('#row' + button_id + '').remove();
	}
</script>
<script>
	function fungsi_update_rute(x) {
		var hari = $("input[name=hari]").val();
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();
		var rute = $("input[name=rute]").val();
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
				$('.list-button-update').show();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function fungsi_add_tmp(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();
		var values = $("input[name='tmp[]']").map(function() {
			return $('#tmp_list [value="' + $(this).val() + '"]').data('customvalue');
		}).get();
		formData.append("list_tmp[]", values);
		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "insertHR_add_LTtmp.php",
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
		var values = $("input[name='tmp[]']").map(function() {
			return $('#tmp_list [value="' + $(this).val() + '"]').data('customvalue');
		}).get();
		formData.append("list_tmp[]", values);
		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "updateHR_add_LTtmp.php",
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

	function fungsi_add_meal(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();

		var bf = $('#bf').val();
		var v_bf = $('#bf_list [value="' + bf + '"]').data('customvalue');
		var ln = $('#ln').val();
		var v_ln = $('#ln_list [value="' + ln + '"]').data('customvalue');
		var dn = $('#dn').val();
		var v_dn = $('#dn_list [value="' + dn + '"]').data('customvalue');

		formData.append("bf", v_bf);
		formData.append("ln", v_ln);
		formData.append("dn", v_dn);
		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "insertHR_add_LTmeal.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.meal-button-update').show();
				$('.meal-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});

	}

	function fungsi_update_meal(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();

		var bf = $('#bf').val();
		var v_bf = $('#bf_list [value="' + bf + '"]').data('customvalue');
		var ln = $('#ln').val();
		var v_ln = $('#ln_list [value="' + ln + '"]').data('customvalue');
		var dn = $('#dn').val();
		var v_dn = $('#dn_list [value="' + dn + '"]').data('customvalue');

		formData.append("bf", v_bf);
		formData.append("ln", v_ln);
		formData.append("dn", v_dn);


		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "updateHR_add_LTmeal.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.meal-button-update').show();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>