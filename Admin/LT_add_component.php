<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->
<?php
include "../site.php";
include "../db=connection.php";

// $query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
// $rs_LTNx = mysqli_query($con, $query_LTNx);

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
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">FORM INSERT COMPONENT LANDTOUR</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(2,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="container" style="max-width: 80%; padding: 20px;">
				<div class="card">
					<div class="card-header">

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
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan3" value="3">
							<label class="form-check-label" for="pilihan3">Guest Hotel</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan4" value="4">
							<label class="form-check-label" for="pilihan4">Land Transport</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan5" value="5">
							<label class="form-check-label" for="pilihan5">List Tempat Optional</label>
						</div>
					</div>

					<div class="card-body">
						<div class="rute" id="rute">
							<from>
								<?php
								$status = 0;
								for ($x = 1; $x <= $hari; $x++) {
									$query = "SELECT * FROM  LT_add_rute where tour_id='" . $_POST['id'] . "' && hari='$x'";
									$rs = mysqli_query($con, $query);
									$row = mysqli_fetch_array($rs);
									if ($row['id'] != "") {
										$status = 1;
									}
								?>
									<div class="form-group">
										<label for="exampleInputEmail1">Rute - Day <?php echo $x ?></label>
										<input type="text" class="form-control form-control-sm" id="rute<?php echo $x ?>" name="rute<?php echo $x ?>" value="<?php echo $row['nama'] ?>">
									</div>
								<?php
								}
								?>
								<input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
								<?php
								if ($status == '1') {
								?>
									<div class="list-button-update" id="list-button-update">
										<button type="button" class="btn btn-success" id='but_upload2' onclick="fungsi_update_rute(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								} else {
								?>
									<div class="list-button-add" id="list-button-add">
										<button type="button" class="btn btn-warning" id='but_upload' onclick="fungsi_rute(<?php echo $row_data['id'] ?>)">ADD</button>
									</div>
									<div class="list-button-update" id="list-button-update" style="display: none;">
										<button type="button" class="btn btn-success" id='but_upload2' onclick="fungsi_update_rute(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								}
								?>
							</from>
						</div>
						<div class="list-tempat" id="list-tempat" style="display: none;">
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
						<!-- meal package -->
						<div class="meal" id="meal" style="display: none;">
							<form>
								<?php
								$statusMeal = 0;

								for ($x = 1; $x <= $hari; $x++) {
									$queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $_POST['id'] . "' && hari='$x'";
									$rsMeal = mysqli_query($con, $queryMeal);
									$rowMeal = mysqli_fetch_array($rsMeal);
									// var_dump($rowMeal['bf'] . " " . $rowMeal['ln'] . " " . $rowMeal['dn']);

									$query_up = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['bf'];
									$rs_up = mysqli_query($con, $query_up);
									$row_up = mysqli_fetch_array($rs_up);

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
										<div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
										<div style="padding-left: 50px; padding-bottom: 5px;">
											<div class="row">
												<div class="col-md-4">
													<label style="font-size: 11px;">BREAKFAST</label>
													<input class="form-control form-control-sm" list="bf_list<?php echo $x ?>" name="bf<?php echo $x ?>" id="bf<?php echo $x ?>" value="<?php echo $row_up['negara'] ?>" autocomplete="off">
													<datalist id="bf_list<?php echo $x ?>">
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
													<input class="form-control form-control-sm" list="ln_list<?php echo $x ?>" name="ln<?php echo $x ?>" id="ln<?php echo $x ?>" value="<?php echo $row_upln['negara'] ?>" autocomplete="off">
													<datalist id="ln_list<?php echo $x ?>">
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
													<input class="form-control form-control-sm" list="dn_list<?php echo $x ?>" name="dn<?php echo $x ?>" id="dn<?php echo $x ?>" value="<?php echo $row_updn['negara'] ?>" autocomplete="off">
													<datalist id="dn_list<?php echo $x ?>">
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
								}
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
						<div class="hotel" id="hotel" style="display: none;">
							<from>
								<?php
								$statusHotel = 0;


								for ($x = 1; $x <= $hari; $x++) {
									$queryHotel = "SELECT * FROM  LT_add_pilihHotel where tour_id='" . $_POST['id'] . "' && hari='$x'";
									$rsHotel = mysqli_query($con, $queryHotel);
									$rowHotel = mysqli_fetch_array($rsHotel);
									if ($rowHotel['id'] != "") {
										$statusHotel = 1;

										if ($rowHotel['hotel'] == 1) {
								?>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>" checked>
												<label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
											</div>
										<?php

										} else {
										?>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>">
												<label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
											</div>
										<?php
										}
									} else {
										if ($x == $hari) {
										?>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>">
												<label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
											</div>
										<?php
										} else {
										?>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>" checked>
												<label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
											</div>
										<?php
										}
										?>
									<?php
									}
									?>

								<?php
								}
								?>
								<input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
								<?php
								if ($statusHotel == '1') {
								?>
									<div class="hotel-button-update" id="hotel-button-update">
										<button type="button" class="btn btn-success" onclick="fungsi_update_hotel(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								} else {
								?>
									<div class="hotel-button-add" id="hotel-button-add">
										<button type="button" class="btn btn-warning" onclick="fungsi_add_hotel(<?php echo $row_data['id'] ?>)">ADD</button>
									</div>
									<div class="hotel-button-update" id="hotel-button-update" style="display: none;">
										<button type="button" class="btn btn-success" onclick="fungsi_update_hotel(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								}
								?>
							</from>
						</div>
						<div class="landtrans" id="landtrans" style="display: none;">

						</div>
						<div class="list-tmpt-optional" id="list-tmpt-optional" style="display: none;">
							<form action="">
								<?php
								$statusOps = 0;
								$query_ops = "SELECT * FROM LT_add_ops where master_id='" . $_POST['id'] . "' order by hari ASC, urutan ASC";
								$rs_ops = mysqli_query($con, $query_ops);
								$row_ops = mysqli_fetch_array($rs_ops);
								// var_dump($row_ops['id']);
								if ($row_ops['id'] != "") {
									$statusOps = 1;
								}
								for ($x = 1; $x <= $hari; $x++) {
									$queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='$x' order by urutan ASC";
									$rsTmp = mysqli_query($con, $queryTmp);

								?>
									<div style="border: 2px solid; border-color:darkgreen; padding: 10px; margin-bottom: 5px;">
										<div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
										<?php
										$loop = 0;
										while ($rowTmp = mysqli_fetch_array($rsTmp)) {
											$query_ops2 = "SELECT highlight FROM LT_add_ops where master_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "' && urutan='" . $rowTmp['urutan'] . "'";
											$rs_ops2 = mysqli_query($con, $query_ops2);
											$row_ops2 = mysqli_fetch_array($rs_ops2);
										?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<div class="row">
															<div class="col-md-3">
																<label style="font-size: 11px">List Tempat </label>
															</div>
															<div class="col-md-3"></div>
															<div class="col-md-3" style="text-align: right; font-size: 11px">
																<div class="form-check">
																	<?php
																	if ($row_ops['id'] != "") {
																		if ($row_ops2['highlight'] == '0') {
																	?>
																			<input type="checkbox" class="form-check-input2" id="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
																		<?php
																		} else {
																		?>
																			<input type="checkbox" class="form-check-input2" id="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>" checked>
																		<?php
																		}
																	} else {
																		?>
																		<input type="checkbox" class="form-check-input2" id="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
																	<?php
																	}

																	?>
																	<label class="form-check-label"><b>Highlight</b></label>
																</div>
															</div>
															<div class="col-md-3" style="text-align: right; font-size: 11px">
																<div class="form-check">
																	<?php
																	if ($row_ops['id'] != "") {
																		// $query_ops2 = "SELECT * FROM LT_add_ops where master_id='" . $_POST['id'] . "' && hari ='$x' && urutan ='" . $rowTmp['urutan'] . "'";
																		// $rs_ops2 = mysqli_query($con, $query_ops2);
																		// $row_ops2 = mysqli_fetch_array($rs_ops2);
																		if ($row_ops2['optional'] == "1") {
																	?>
																			<input type="checkbox" class="form-check-input2" id="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>" checked>
																		<?php
																		} else {
																		?>
																			<input type="checkbox" class="form-check-input2" id="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
																		<?php
																		}
																	} else {
																		?>
																		<input type="checkbox" class="form-check-input2" id="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
																	<?php
																	}
																	?>
																	<label class="form-check-label"><b>Optional</b></label>
																</div>
															</div>
														</div>
														<?php
														$query_tempat3 = "SELECT * FROM List_tempat where id='" . $rowTmp['tempat'] . "'";
														$rs_tempat3 = mysqli_query($con, $query_tempat3);
														while ($row_tempat3 = mysqli_fetch_array($rs_tempat3)) {
															$detail3 = $row_tempat3['negara'] . " " . $row_tempat3['city'] . " " . $row_tempat3['tempat'];
														}
														?>
														<input class="form-control form-control-sm" value="<?php echo $detail3 ?>" disabled>
													</div>
												</div>
											</div>
										<?php
											$loop++;
										}
										?>
										<input type="hidden" id="<?php echo $x ?>loop" name="<?php echo $x ?>loop" value="<?php echo  $loop ?>">
									</div>
								<?php
								}
								?>
								<input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
								<?php
								if ($statusOps == '1') {
								?>
									<div class="ops-button-update" id="tmp-button-update">
										<button type="button" class="btn btn-success" id='but_optional4' onclick="fungsi_ops(<?php echo $row_data['id'] ?>)">UPDATE</button>
									</div>
								<?php
								} else {
								?>
									<div class="ops-button-add" id="tmp-button-add">
										<button type="button" class="btn btn-warning" id='but_optional3' onclick="fungsi_ops(<?php echo $row_data['id'] ?>)">ADD</button>
									</div>
									<div class="ops-button-update" id="tmp-button-update" style="display: none;">
										<button type="button" class="btn btn-success" id='but_optional4' onclick="fungsi_ops(<?php echo $row_data['id'] ?>)">UPDATE</button>
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
				$('.hotel').hide();
				$('.landtrans').hide();
				$('.list-tmpt-optional').hide();

			} else if (target == 1) {
				$('.rute').hide();
				$('.list-tempat').show();
				$('.meal').hide();
				$('.hotel').hide();
				$('.landtrans').hide();
				$('.list-tmpt-optional').hide();
			} else if (target == 2) {
				$('.rute').hide();
				$('.list-tempat').hide();
				$('.meal').show();
				$('.hotel').hide();
				$('.landtrans').hide();
				$('.list-tmpt-optional').hide();
				// $('.tl-fee').hide();
			} else if (target == 3) {
				$('.rute').hide();
				$('.list-tempat').hide();
				$('.meal').hide();
				$('.hotel').show();
				$('.landtrans').hide();
				$('.list-tmpt-optional').hide();
				// $('.tl-fee').hide();
			} else if (target == 4) {
				$('.rute').hide();
				$('.list-tempat').hide();
				$('.meal').hide();
				$('.hotel').hide();
				$('.landtrans').show();
				$('.list-tmpt-optional').hide();
			} else if (target == 5) {
				$('.rute').hide();
				$('.list-tempat').hide();
				$('.meal').hide();
				$('.hotel').hide();
				$('.landtrans').hide();
				$('.list-tmpt-optional').show();
			} else {

			}
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
	// function fungsi_item(x){
	// 	var item = document.getElementById("item" + x).options[document.getElementById("item" + x).selectedIndex].value;
	// 	$.ajax({
	// 		url: "LT_transport_field.php",
	// 		method: "POST",
	// 		asynch: false,
	// 		data: {
	// 			loop: item,
	// 			x:x
	// 		},
	// 		success: function(data) {
	// 			$('#' + x + 'transport_field').html(data);
	// 		}
	// 	})

	// }
	// function fungsi_negara(x,y) {
	// 	// var item = document.getElementById("item" + x).options[document.getElementById("item" + x).selectedIndex].value;
	// 	$("#"+y+"per_list" + x).empty();
	// 	$('input[name='+y+'per'+x+']').val('');
	// 	var negara = document.getElementById(y+"negara" + x).options[document.getElementById(y+"negara" + x).selectedIndex].value;
	// 	$.post("get_select_tr.php", {
	// 		"negara": negara,
	// 	}, function(data) {
	// 		var jsonData = JSON.parse(data);
	// 		console.log(jsonData);
	// 		if (jsonData != '') {
	// 			// alert("on");
	// 			for (var i = 0; i < jsonData.length; i++) {
	// 				var counter = jsonData[i];
	// 				// var option = '<option value=' + counter.id + '>' + counter.detail  + ' (' + counter.agent + ') ' + '</option>';
	// 				var option = '<option data-customvalue='+counter.id+'>'+counter.detail+' ('+counter.agent+') '+'</option>';
	// 				$("#"+y+"per_list"+x).append(option);
	// 			}
	// 		} else {
	// 			$("#"+y+"per_list" + x).empty();
	// 		}
	// 	});
	// }
</script>
<script>
	function fungsi_rute(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();
		for (let i = 1; i <= hari; i++) {
			var rute = $("input[name=rute" + i + "]").val();
			formData.append("rute[]", rute);
		}

		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTrute.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.list-button-update').show();
				$('.list-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function fungsi_update_rute(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();
		for (let i = 1; i <= hari; i++) {
			var rute = $("input[name=rute" + i + "]").val();
			formData.append("rute[]", rute);
		}


		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "update_add_LTrute.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.list-button-update').show();
				// $('.list-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

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

	function fungsi_add_meal(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();
		for (let i = 1; i <= hari; i++) {
			var bf = $('#bf' + i).val();
			var v_bf = $('#bf_list' + i + ' [value="' + bf + '"]').data('customvalue');
			var ln = $('#ln' + i).val();
			var v_ln = $('#ln_list' + i + ' [value="' + ln + '"]').data('customvalue');
			var dn = $('#dn' + i).val();
			var v_dn = $('#dn_list' + i + ' [value="' + dn + '"]').data('customvalue');

			formData.append("bf[]", v_bf);
			formData.append("ln[]", v_ln);
			formData.append("dn[]", v_dn);
		}

		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTmeal.php",
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
		for (let i = 1; i <= hari; i++) {
			var bf = $('#bf' + i).val();
			var v_bf = $('#bf_list' + i + ' [value="' + bf + '"]').data('customvalue');
			var ln = $('#ln' + i).val();
			var v_ln = $('#ln_list' + i + ' [value="' + ln + '"]').data('customvalue');
			var dn = $('#dn' + i).val();
			var v_dn = $('#dn_list' + i + ' [value="' + dn + '"]').data('customvalue');

			formData.append("bf[]", v_bf);
			formData.append("ln[]", v_ln);
			formData.append("dn[]", v_dn);
		}

		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "update_add_LTmeal.php",
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

	function fungsi_add_hotel(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();
		for (let i = 1; i <= hari; i++) {
			;
			if ($('#hotel' + i).is(":checked")) {
				formData.append("hotel[]", 1);
			} else {
				formData.append("hotel[]", 0);
			}

		}

		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "insert_add_LThotel.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.hotel-button-update').show();
				$('.hotel-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function fungsi_update_hotel(x) {
		var hari = $("input[name=hari]").val();
		let formData = new FormData();
		for (let i = 1; i <= hari; i++) {
			if ($('#hotel' + i).is(":checked")) {
				formData.append("hotel[]", 1);
			} else {
				formData.append("hotel[]", 0);
			}
		}
		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "update_add_LThotel.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.hotel-button-update').show();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function fungsi_ops(x) {

		let formData = new FormData();
		var hari = $("input[name=hari]").val();
		var arr_val = [];
		for (let i = 1; i <= hari; i++) {
			var loop = $("input[name=" + i + "loop]").val();
			arr_loop = [];
			arr_hl = [];
			for (var y = 1; y <= loop; y++) {
				if ($("#" + i + "optional" + y).is(":checked")) {
					arr_loop.push(1);

				} else {
					arr_loop.push(0);

				}
				if ($("#" + i + "highlight" + y).is(":checked")) {
					arr_hl.push(1);
				} else {
					arr_hl.push(0);
				}
			}
			formData.append("optional[]", arr_loop);
			formData.append("highlight[]", arr_hl);
		}
		formData.append('id', x);
		formData.append('hari', hari);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTops.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				$('.ops-button-update').show();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});

	}
</script>