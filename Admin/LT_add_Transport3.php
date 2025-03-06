<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";



$query_data = "SELECT * FROM LTSUB_itin WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$json_day = $row_data['hari'];
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM INSERT COMPONENT LANDTOUR
				</div>
			</div>
			<div class="container" style="max-width: 90%; padding: 20px;">
				<div class="card">
					<div class="card-header">
						<a href="format_transport.php" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print"></i> </a>
						<a class="btn btn-warning btn-sm">UPLOAD</i> </a>
					</div>
					<div class="card-body">	

					</div>
				</div>
				<div style="padding-top: 10px;"></div>
				<div class="card">
					<div class="card-header">PREVIEW ITINERARY</div>
					<div class="card-body">
						<div style="padding: 5px 20px; font-size: 12px;">
							<!-- loop day disini -->
							<?php
							$x = 1;
							$loop = 1;
							for ($c = 1; $c <= $json_day; $c++) {
								$queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_data['master_id'] . "' && hari='$x'";
								$rsRute = mysqli_query($con, $queryRute);
								$rowRute = mysqli_fetch_array($rsRute);

								$queryTambah = "SELECT * FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$loop'";
								$rsTambah = mysqli_query($con, $queryTambah);
								// var_dump($queryTambah);
								while ($rowTambah = mysqli_fetch_array($rsTambah)) {
									if ($rowTambah['hari'] == $loop) {
							?>
										<div class="row">
											<div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $loop ?></u></div>
											<div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
												<div style="font-size: 14pt;"><u><b><?php echo $rowTambah['rute'] ?></b></u>
													<?php
													$queryMealH = "SELECT * FROM  LTHR_add_meal where tour_id='" . $rowTambah['id'] . "' && hari='" . $rowTambah['hari'] . "'";
													$rsMealH = mysqli_query($con, $queryMealH);
													$rowMealH = mysqli_fetch_array($rsMealH);
													// var_dump($queryMealH);
													if ($rowMealH['bf'] != '0' or $rowMealH['ln'] != '0' or $rowMealH['dn'] != '0') {
														$b = "";
														$l = "";
														$d = "";
														if ($rowMealH['bf'] != '0') {
															$b = "B";
														}
														if ($rowMealH['ln'] != '0') {
															$l = "L";
														}
														if ($rowMealH['dn'] != '0') {
															$d = "D";
														}
														echo "(" . $b . $l . $d . ")";
													}
													?>
												</div>
												<?php
												$queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' order by urutan ASC";
												$rsTR = mysqli_query($con, $queryTR);

												// $rowTR = mysqli_fetch_array($rsTR);
												$detail = "";
												$type = "";
												while ($rowTR = mysqli_fetch_array($rsTR)) {

													if ($rowTR['type'] == '1') {
														$type = "Flight";
														$queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
														$rsflight = mysqli_query($con, $queryflight);
														$row_flight = mysqli_fetch_array($rsflight);
														
														$detail = $row_flight['maskapai'] . " " . $row_flight['dept'] . "-" . $row_flight['arr'] . " " . $row_flight['tgl'] . " " . $row_flight['take'] . "-" . $row_flight['landing'];
													} else if ($rowTR['type'] == '2') {
														$type = "Ferry";
														$query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
														$rs_ferry = mysqli_query($con, $query_ferry);
														$row_ferry = mysqli_fetch_array($rs_ferry);
														$detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
														$adt = $row_ferry['adult'];
														$chd = $row_ferry['child'];
														$inf = $row_ferry['infant'];
													}

												?>
													<div style="font-weight: bold;">
														<?php
														if ($rowTR['type'] == '1') {
														?>
															<i class="fa fa-plane" style="padding-right: 10px;"></i>
														<?php
														} else if ($rowTR['type'] == '2') {
														?>
															<i class="fa fa-ship" style="padding-right: 10px;"></i>
														<?php
														}
														?>
														<?php echo  $type . " : " . $detail ?>
													</div>
												<?php

												}
												?>
												<!-- class tempat -->
												<div class="tempat" style="padding-left: 20px; font-size: 12pt;">
													<?php
													$queryTmp2 = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah['id'] . "' && hari='" . $rowTambah['hari'] . "'";
													$rsTmp2 = mysqli_query($con, $queryTmp2);
													while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
														$query_tempat22 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
														$rs_tempat22 = mysqli_query($con, $query_tempat22);
														$row_tempat22 = mysqli_fetch_array($rs_tempat22);
													?>
														<div style="padding-left: 20px;">
															<b><?php echo $row_tempat22['tempat2'] . " " ?></b><?php echo $row_tempat22['keterangan'] ?>
														</div>
													<?php
													}

													?>


												</div>
											</div>
										</div>
										<div style="padding:2px"></div>
								<?php
										$loop++;
									}
								}
								?>
								<div class="row">
									<div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $loop ?></u></div>
									<div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
										<div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u>
											<?php
											$queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row_data['master_id'] . "' && hari='$x'";
											$rsMeal = mysqli_query($con, $queryMeal);
											$rowMeal = mysqli_fetch_array($rsMeal);
											// var_dump($queryMeal);
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
												echo "(" . $b . $l . $d . ")";
											}
											?>
										</div>
										<?php
										$queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' order by urutan ASC";
										$rsTR = mysqli_query($con, $queryTR);
										// $rowTR = mysqli_fetch_array($rsTR);
										$detail = "";
										$type = "";
										while ($rowTR = mysqli_fetch_array($rsTR)) {

											if ($rowTR['type'] == '1') {
												$type = "Flight";
												$queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
												$rsflight = mysqli_query($con, $queryflight);
												$rowflight = mysqli_fetch_array($rsflight);
												// var_dump($queryflight);
												$detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . "-" . $rowflight['arr'] . " " . $rowflight['tgl'] . " " . $rowflight['take'] . "-" . $rowflight['landing'];
											} else if ($rowTR['type'] == '2') {
												$type = "Ferry";
												$query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
												$rs_ferry = mysqli_query($con, $query_ferry);
												$row_ferry = mysqli_fetch_array($rs_ferry);
												$detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
												$adt = $row_ferry['adult'];
												$chd = $row_ferry['child'];
												$inf = $row_ferry['infant'];
											}

										?>
											<div style="font-weight: bold;">
												<?php
												if ($rowTR['type'] == '1') {
												?>
													<i class="fa fa-plane" style="padding-right: 10px;"></i>
												<?php
												} else if ($rowTR['type'] == '2') {
												?>
													<i class="fa fa-ship" style="padding-right: 10px;"></i>
												<?php
												}
												?>
												<?php echo  $type . " : " . $detail ?>
											</div>
										<?php

										}
										?>
										<!-- class tempat -->
										<div class="tempat" style="padding-left: 20px; font-size: 12pt;">
											<?php
											$queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['master_id'] . "' && hari='$x'";
											$rsTmp = mysqli_query($con, $queryTmp);
											while ($rowTmp = mysqli_fetch_array($rsTmp)) {
												$query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
												$rs_tempat2 = mysqli_query($con, $query_tempat2);
												$row_tempat2 = mysqli_fetch_array($rs_tempat2);
											?>
												<div style="padding-left: 20px;">
													<b><?php echo $row_tempat2['tempat2'] . " " ?></b><?php echo $row_tempat2['keterangan'] ?>
												</div>
											<?php
											}

											?>


										</div>
										<?php
										if ($row_data['landtour'] == "undefined") {
											$queryHotel = "SELECT * FROM  LT_select_PilihHTLNC where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$x'";
											$rsHotel = mysqli_query($con, $queryHotel);
											while ($rowHotel = mysqli_fetch_array($rsHotel)) {
										?>
												<div style="font-weight: bold; font-size: 12pt;">
													<div class="row">
														<div class="col-md-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
														<div class="col-md-9">: <?php echo $rowHotel['hotel_name'] ?></div>
													</div>
												</div>
											<?php
											}
											?>

											<?php
										} else {
											$queryHotel = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id='" . $row_data['master_id'] . "' && hari='$x'";
											$rsHotel = mysqli_query($con, $queryHotel);
											// $rowHotel = mysqli_fetch_array($rsHotel);
											while ($rowHotel = mysqli_fetch_array($rsHotel)) {
												// if ($rowHotel['hotel'] == "1") {
												$queryPHotel = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $rowHotel['hari'] . "'";
												$rsPHotel = mysqli_query($con, $queryPHotel);
												$rowPHotel = mysqli_fetch_array($rsPHotel);

												$queryMaster = "SELECT * FROM  LT_itinnew WHERE id=" . $rowPHotel['hotel_id'];
												$rsMaster = mysqli_query($con, $queryMaster);
												$rowMaster = mysqli_fetch_array($rsMaster);

											?>
												<div style="font-weight: bold; font-size: 12pt;">
													<div class="row">
														<div class="col-md-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
														<?php
														if ($rowPHotel['no_htl'] == '1') {
														?>
															<div class="col-md-9">: <?php echo $rowMaster['hotel1'] ?></div>
														<?php

														} else if ($rowPHotel['no_htl'] == '2') {
														?>
															<div class="col-md-9">: <?php echo $rowMaster['hotel2'] ?></div>
														<?php

														} else if ($rowPHotel['no_htl'] == '3') {
														?>
															<div class="col-md-9">: <?php echo $rowMaster['hotel3'] ?></div>
														<?php
														} else if ($rowPHotel['no_htl'] == '4') {
														?>
															<div class="col-md-9">: <?php echo $rowMaster['hotel4'] ?></div>
														<?php
														} else if ($rowPHotel['no_htl'] == '5') {
														?>
															<div class="col-md-9">:<?php echo $rowMaster['hotel5'] ?></div>
														<?php
														} else {
														}
														?>

													</div>
												</div>
										<?php
											}
										}

										?>
									</div>
								</div>
								<div style="padding:2px"></div>
							<?php
								$x++;
								$loop++;
							}
							?>

							<?php
							$queryTambah2 = "SELECT * FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$loop'";
							$rsTambah2 = mysqli_query($con, $queryTambah2);
							while ($rowTambah2 = mysqli_fetch_array($rsTambah2)) {

								if ($rowTambah2['hari'] == $loop) {
							?>
									<div class="row">
										<div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $loop ?></u></div>
										<div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
											<div style="font-size: 14pt;"><u><b><?php echo $rowTambah2['rute'] ?></b></u>
												<?php
												$queryMealH2 = "SELECT * FROM  LTHR_add_meal where tour_id='" . $rowTambah2['id'] . "' && hari='" . $rowTambah2['hari'] . "'";
												$rsMealH2 = mysqli_query($con, $queryMealH2);
												$rowMealH2 = mysqli_fetch_array($rsMealH2);
												if ($rowMealH2 != "") {
													if ($rowMealH2['bf'] != '0' or $rowMealH2['ln'] != '0' or $rowMealH2['dn'] != '0') {
														$b = "";
														$l = "";
														$d = "";
														if ($rowMealH2['bf'] != '0') {
															$b = "B";
														}
														if ($rowMealH2['ln'] != '0') {
															$l = "L";
														}
														if ($rowMealH2['dn'] != '0') {
															$d = "D";
														}
														echo "(" . $b . $l . $d . ")";
													}
												};

												?>
											</div>
											<!-- class tempat -->
											<div class="tempat" style="padding-left: 20px; font-size: 12pt;">
												<?php
												$queryTmp_last = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah2['id'] . "' && hari='" . $rowTambah2['hari'] . "'";
												$rsTmp_last = mysqli_query($con, $queryTmp_last);
												while ($rowTmp_last = mysqli_fetch_array($rsTmp2)) {
													$query_tempat_last = "SELECT * FROM List_tempat where id=" . $rowTmp_last['tempat'];
													$rs_tempat_last = mysqli_query($con, $query_tempat_last);
													$row_tempat_last = mysqli_fetch_array($rs_tempat_last);
												?>
													<div style="padding-left: 20px;">
														<b><?php echo $row_tempat_last['tempat2'] . " " ?></b><?php echo $row_tempat_last['keterangan'] ?>
													</div>
												<?php
												}

												?>


											</div>
										</div>
									</div>
									<div style="padding:2px"></div>
							<?php
									$loop++;
								}
							}

							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('.form-check-input').click(function() {

			var target = $(this).val();
			if (target == 0) {
				$('.flight').show();
				$('.ferry').hide();
				$('.train').hide();
				$('.land').hide();
				// $('.tl-fee').hide();

			} else if (target == 1) {
				$('.flight').hide();
				$('.ferry').show();
				$('.train').hide();
				$('.land').hide();
				// $('.tl-fee').hide();
			} else if (target == 2) {
				$('.rute').hide();
				$('.ferry').hide();
				$('.train').show();
				$('.land').hide();
				// $('.tl-fee').hide();
			} else if (target == 3) {
				$('.rute').hide();
				$('.ferry').hide();
				$('.train').hide();
				$('.land').show();
				// $('.tl-fee').hide();
			} else {

			}
		});

	});
</script>
<script>
	function fungsi_fl(x) {
		//// guide fee
		var type = document.getElementById("f_type" + x).options[document.getElementById("f_type" + x).selectedIndex].value;
		// alert(type);
		$.post('get_transport_list.php', {
			'brand': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#f_rute' + x).append('<option value=' + counter.rute + '>' + counter.rute + '</option>');
				}
			} else {
				$("#f_rute" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function fungsi_fval(x) {
		//// guide fee
		var type = document.getElementById("f_type" + x).options[document.getElementById("f_type" + x).selectedIndex].value;
		var rute = document.getElementById("f_rute" + x).options[document.getElementById("f_rute" + x).selectedIndex].value;
		// alert(rute);
		$.post('get_flight_val.php', {
			'brand': rute,
			'type': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#f_name' + x).append('<option value=' + counter.id + '>' + counter.inter + ' ' + counter.maskapai + ' ' + counter.dept + '-' + counter.arr + ' ' + counter.take + ':' + counter.landing + '</option>');
				}
			} else {
				$("#f_name" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function ferry_type(x) {
		var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
		$.post('get_ferry_rute.php', {
			'brand': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#fer_rute' + x).append('<option value=' + counter.nama + '>' + counter.nama + '</option>');
				}
			} else {
				$("#fer_rute" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function ferry_rute(x) {
		var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
		var rute = document.getElementById("fer_rute" + x).options[document.getElementById("fer_rute" + x).selectedIndex].value;
		$.post('get_ferry_rute2.php', {
			'type': type,
			'rute': rute
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#fer_name' + x).append('<option value=' + counter.id + '>' + counter.ferry_name + ' ' + counter.ferry_class + ' ' + counter.jam_dept + ' ' + counter.jam_arr + '</option>');
				}
			} else {
				$("#fer_name" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}
</script>
<script>
	$(document).ready(function() {
		var i = 1;
		$('#add').click(function() {
			var jml = $("input[name=jml]").val();
			var val_jml = parseInt(jml) + 1;
			var type = "flight";
			i++;
			$.ajax({
				url: "LT_transport_field.php",
				method: "POST",
				asynch: false,
				data: {
					i: i,
					type: type
				},
				success: function(data) {
					$('#dynamic_field').append(data);
					$('#jml').val(val_jml);
				}
			});
		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			var jml = $("input[name=jml]").val();
			var val_jml = parseInt(jml) - 1;
			$('#row' + button_id + '').remove();
			$('#jml').val(val_jml);

		});

		$('#add_fer').click(function() {
			var jml = $("input[name=jml_fer]").val();
			var val_jml = parseInt(jml) + 1;
			var type = "ferry";
			i++;
			$.ajax({
				url: "LT_transport_field.php",
				method: "POST",
				asynch: false,
				data: {
					i: i,
					type: type
				},
				success: function(data) {
					$('#dynamic_ferry').append(data);
					$('#jml_fer').val(val_jml);
				}
			});
		});

		$(document).on('click', '.btn_remove_ferry', function() {
			var button_id = $(this).attr("id");
			var jml = $("input[name=jml_fer]").val();
			var val_jml = parseInt(jml) - 1;
			$('#row_ferry' + button_id + '').remove();
			$('#jml_fer').val(val_jml);

		});

	});
</script>
<script>
	function fungsi_add_flight() {
		var jml = $("input[name=jml]").val();
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();

		let formData = new FormData();
		for (let i = 1; i <= jml; i++) {

			var hari = $("input[name=hari" + i + "]").val();
			var urutan = $("input[name=urutan" + i + "]").val();
			var f_type = document.getElementById("f_type" + i).options[document.getElementById("f_type" + i).selectedIndex].value;
			var f_rute = document.getElementById("f_rute" + i).options[document.getElementById("f_rute" + i).selectedIndex].value;
			var f_name = document.getElementById("f_name" + i).options[document.getElementById("f_name" + i).selectedIndex].value;

			if ((hari == "") || (urutan == "") || (f_type == "") || (f_rute == "") || (f_name == "")) {
				alert("Silakan isi semua form fields");
				return false;
			}
			formData.append('hari[]', hari);
			formData.append('urutan[]', urutan);
			formData.append('f_type[]', f_type);
			formData.append('f_rute[]', f_rute);
			formData.append('f_name[]', f_name);
		}
		formData.append('id', '1');
		formData.append('jml', jml);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTtransport.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				LT_itinerary(4,copy_id,0);
				$('.list-button-update').show();
				$('.list-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function fungsi_add_ferry() {

		var jml = $("input[name=jml_fer]").val();
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();
		let formData = new FormData();
		for (let i = 1; i <= jml; i++) {
			var hari = $("input[name=fer_hari" + i + "]").val();
			var urutan = $("input[name=fer_urutan" + i + "]").val();
			var f_type = document.getElementById("fer_type" + i).options[document.getElementById("fer_type" + i).selectedIndex].value;
			var f_rute = document.getElementById("fer_rute" + i).options[document.getElementById("fer_rute" + i).selectedIndex].value;
			var f_name = document.getElementById("fer_name" + i).options[document.getElementById("fer_name" + i).selectedIndex].value;

			if ((hari == "") || (urutan == "") || (f_type == "") || (f_rute == "") || (f_name == "")) {
				alert("Silakan isi semua form fields");
				return false;
			}

			formData.append('hari[]', hari);
			formData.append('urutan[]', urutan);
			formData.append('f_type[]', f_type);
			formData.append('f_rute[]', f_rute);
			formData.append('f_name[]', f_name);
		}
		// alert("gagal");
		formData.append('id', '2');
		formData.append('jml', jml);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTtransport.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				LT_itinerary(4,copy_id,0);
				$('.list-button-update').show();
				$('.list-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>