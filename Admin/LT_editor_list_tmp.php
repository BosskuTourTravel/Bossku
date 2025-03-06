<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$json_day = $row_data['hari'];

?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class="card-header">
					<h3 class="card-title" style="font-weight:bold;">SETTING LIST TEMPAT</h3>
					<div class="card-tools">
						<div class="input-group input-group-sm" style="width: 150px;">
							<div class="input-group-append" style="text-align: right;">
								<a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
								<a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(23,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
								<a class="btn btn-info btn-sm tip" title="Add Rute" onclick="LT_itinerary(31,<?php echo $_POST['id'] ?>,0)"><i class="fas fa-route"></i></a>
								<a class="btn btn-success btn-sm tip" title="Add List Tempat" onclick="LT_itinerary(32,<?php echo $_POST['id'] ?>,0)"><i class="fas fa-mountain"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container" style="padding: 20px;">
				<div class="card">
					<div class="card-header">
						<div style="text-align: center; font-size: 20px; font-weight: bold;"> <?php echo $row_data['judul'] ?></div>
					</div>
					<div class="card-body">
						<?php
						$x = 1;
						for ($c = 1; $c <= $json_day; $c++) {
							$queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_data['id'] . "' && hari='$x'";
							$rsRute = mysqli_query($con, $queryRute);
							$rowRute = mysqli_fetch_array($rsRute);
						?>
							<div class="card">
								<div class="card-header" style="background-color: darkslategray; color: white;">
									<div class="row">
										<div class="col-md-6" style="text-align: left;">
											<button type="button" class="btn btn-success btn-sm" onclick="up_hari(<?php echo $row_data['id'] ?>,<?php echo $x ?>)"><i class="fa fa-arrow-up"></i></button>
											<button type="button" class="btn btn-success btn-sm" onclick="down_hari(<?php echo $row_data['id'] ?>,<?php echo $x ?>)"><i class="fa fa-arrow-down"></i></button>
										</div>
										<div class="col-md-6" style="text-align: left; font-weight: bold; font-size: 16px;">
											<?php echo "DAY " . $x; ?>
										</div>
										<!-- <div class="col-md-4" style="text-align: right;">
											<button type="button" class="btn btn-success btn-sm tip" title="Add Rute"><i class="fas fa-route"></i></button>
											<button type="button" class="btn btn-success btn-sm tip" title="Add List Tempat"><i class="fas fa-mountain"></i></button>
										</div> -->
									</div>

								</div>
								<div class="card-body">
									<div class="rute" style="font-weight: bold;">
										<div class="row">
											<div class="col-md-9"><?php echo $rowRute['nama'] ?></div>
											<div class="col-md-3">
												<?php
												$queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row_data['id'] . "' && hari='$x'";
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
										</div>
									</div>
									<div class="tempat" style="padding: 20px 10px;">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">Tempat</th>
													<th scope="col" style="max-width: 100px;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['id'] . "' && hari='$x' order by urutan ASC";
												$rsTmp = mysqli_query($con, $queryTmp);
												while ($rowTmp = mysqli_fetch_array($rsTmp)) {
													$query_tempat = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
													$rs_tempat = mysqli_query($con, $query_tempat);
													$row_tempat = mysqli_fetch_array($rs_tempat);

													$query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $row_data['id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp['urutan'] . "'";
													$rs_ops = mysqli_query($con, $query_ops);
													$row_ops = mysqli_fetch_array($rs_ops);

												?>
													<tr>
														<th><?php echo $row_tempat['tempat'] ?></th>
														<td>
															<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
															<button type="button" class="btn btn-primary btn-sm" onclick="up_tmp(<?php echo $rowTmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $rowTmp['urutan'] ?>)"><i class="fa fa-arrow-up"></i></button>
															<button type="button" class="btn btn-primary btn-sm" onclick="down_tmp(<?php echo $rowTmp['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $rowTmp['urutan'] ?>)"><i class="fa fa-arrow-down"></i></button>
															<button type="button" class="btn btn-danger btn-sm" onclick="del_tmp(<?php echo $rowTmp['id'] ?>,<?php echo $_POST['id'] ?>)"><i class="fa fa-trash"></i></button>
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
							$x++;
						}
						?>
						<input type="hidden" name="max_val" id="max_val" value="<?php echo $x ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".tip").tooltip({
			placement: 'top'
		});
	});
</script>
<script>
	function del_tmp(x, y) {
		var r = confirm("Are you sure to delete this file ?");
		if (r == true) {
			let formData = new FormData();
			formData.append('id', x);
			$.ajax({
				type: 'POST',
				url: "del_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_itinerary(23, y, 0);
				},
				error: function() {
					alert("Data Gagal Hapus");
				}
			});
		}
	}

	function up_tmp(x, y, z) {
		// var r = confirm("Are you sure to up this  ?");
		if (z != 1) {
			let formData = new FormData();
			formData.append('id', x);
			formData.append('pilihan', 1);

			$.ajax({
				type: 'POST',
				url: "up_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_itinerary(23, y, 0);
				},
				error: function() {
					alert("Data Gagal Update");
				}
			});
		} else {
			alert("Urutan pertama tidak dapat di naikkan !");
		}
	}

	function down_tmp(x, y, z) {
		// var r = confirm("Are you sure to up this  ?");
		if (z != '') {
			let formData = new FormData();
			formData.append('id', x);
			formData.append('pilihan', 2);

			$.ajax({
				type: 'POST',
				url: "up_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_itinerary(23, y, 0);
				},
				error: function() {
					alert("Data Gagal Update");
				}
			});
		}
	}

	function up_hari(x, y) {
		if (y != 1) {
			let formData = new FormData();
			formData.append('id', x);
			formData.append('pilihan', 3);
			formData.append('hari', y);

			$.ajax({
				type: 'POST',
				url: "up_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_itinerary(23, x, 0);
				},
				error: function() {
					alert("Data Gagal Update");
				}
			});
		} else {
			alert("Hari pertama tidak dapat di naikkan !");
		}
	}

	function down_hari(x, y) {
		var z = $("input[name=max_val]").val();
		var chck = z - 1;
		if (y != chck) {
			let formData = new FormData();
			formData.append('id', x);
			formData.append('pilihan', 4);
			formData.append('hari', y);

			$.ajax({
				type: 'POST',
				url: "up_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_itinerary(23, x, 0);
				},
				error: function() {
					alert("Data Gagal Update");
				}
			});
		} else {
			alert("Hari terakhir tidak dapat di turunkan!");
		}
	}
</script>