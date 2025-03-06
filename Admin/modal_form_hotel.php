<?php
include "../site.php";
include "../db=connection.php";

$querySH = "SELECT * FROM  LT_select_PilihHTL WHERE copy_id='" . $_POST['id'] . "' && master_id=" . $_POST['master_id'];
$rsSH = mysqli_query($con, $querySH);
$rowSH = mysqli_fetch_array($rsSH);


$querySHNO = "SELECT * FROM  LT_select_PilihHTLNC WHERE  master_id=" . $_POST['master_id'];
$rsSHNO = mysqli_query($con, $querySHNO);
$rowSHNO = mysqli_fetch_array($rsSHNO);

$queryH_id = "SELECT * FROM LT_itinnew WHERE id=" . $rowSH['hotel_id'];
$rsH_id = mysqli_query($con, $queryH_id);
$rowH_id = mysqli_fetch_array($rsH_id);
// var_dump($queryH_id);


$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
$rs_LTNx = mysqli_query($con, $query_LTNx);

?>
<form>
	<?php
	$queryMaster = "SELECT * FROM  LT_itinerary2 WHERE id=" . $_POST['master_id'];
	$rsMaster = mysqli_query($con, $queryMaster);
	$rowMaster = mysqli_fetch_array($rsMaster);
	if ($rowMaster['landtour'] == "undefined") {


		$queryLTH = "SELECT * FROM  LT_add_pilihHotel WHERE hotel='1' && tour_id='" . $_POST['master_id'] . "'";
		$rsLTH = mysqli_query($con, $queryLTH);
	
		$xy = 1;
		while ($rowLTH = mysqli_fetch_array($rsLTH)) {
			$querySHNO2 = "SELECT * FROM  LT_select_PilihHTLNC WHERE  master_id='" . $_POST['master_id'] . "' && hari='" . $rowLTH['hari'] . "' order by hari ASC";
			$rsSHNO2 = mysqli_query($con, $querySHNO2);
			$rowSHNO2 = mysqli_fetch_array($rsSHNO2);
			if ($rowSHNO['id'] != "") {
				if ($rowSHNO2['hari'] != "") {
					$val_hotel_name = $rowSHNO2['hotel_name'];
					$val_hotel_twin = $rowSHNO2['hotel_twin'];
					$val_hotel_triple = $rowSHNO2['hotel_triple'];
					$val_hotel_family = $rowSHNO2['hotel_family'];
				}
				$query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $_POST['master_id'] . "' && hari='" . $rowLTH['hari'] . "'";
				$rs_rute = mysqli_query($con, $query_rute);
				$row_rute = mysqli_fetch_array($rs_rute);
	?>
				<div style="font-weight: bold; padding-top: 10px;">Hari Ke <?php echo $rowLTH['hari'] ?> : <?php echo $row_rute['nama'] ?></div>
				<div class="row">
					<div class="col">
						<label for="hari">Hotel Name</label>
						<input type="text" class="form-control form-control-sm" id="hotel_name<?php echo $xy ?>" name="hotel_name<?php echo $xy ?>" value="<?php echo $val_hotel_name ?>">
					</div>
					<div class="col">
						<label for="hari">Twin Price</label>
						<input type="text" class="form-control form-control-sm" id="hotel_twin<?php echo $xy ?>" name="hotel_twin<?php echo $xy ?>" value="<?php echo $val_hotel_twin ?>">
					</div>
					<div class="col">
						<label for="hari">Triple Price</label>
						<input type="text" class="form-control form-control-sm" id="hotel_triple<?php echo $xy ?>" name="hotel_triple<?php echo $xy ?>" value="<?php echo $val_hotel_triple ?>">
					</div>
					<div class="col">
						<label for="hari">Family Price</label>
						<input type="text" class="form-control form-control-sm" id="hotel_family" name="hotel_family" value="<?php echo $val_hotel_family ?>">
					</div>
				</div>
			<?php
			} else {
				$query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $_POST['master_id'] . "' && hari='" . $rowLTH['hari'] . "'";
				$rs_rute = mysqli_query($con, $query_rute);
				$row_rute = mysqli_fetch_array($rs_rute);
			?>
				<div style="font-weight: bold; padding-top: 10px;">Hari Ke <?php echo $rowLTH['hari'] ?>: <?php echo $row_rute['nama'] ?></div>
				<div class="row">
					<div class="col">
						<label for="hari">Hotel Name</label>
						<input type="text" class="form-control form-control-sm" id="hotel_name<?php echo $xy ?>" name="hotel_name<?php echo $xy ?>" value="" placeholder="Input Hotel Name">
					</div>
					<div class="col">
						<label for="hari">Twin Price</label>
						<input type="text" class="form-control form-control-sm" id="hotel_twin<?php echo $xy ?>" name="hotel_twin<?php echo $xy ?>" placeholder="Input Hotel Twin Price">
					</div>
					<div class="col">
						<label for="hari">Triple Price</label>
						<input type="text" class="form-control form-control-sm" id="hotel_triple<?php echo $xy ?>" name="hotel_triple<?php echo $xy ?>" placeholder="Input Hotel Triple Price">
					</div>
					<div class="col">
						<label for="hari">Family Price</label>
						<input type="text" class="form-control form-control-sm" id="hotel_family" name="hotel_family" placeholder="nput Hotel Family Price">
					</div>
				</div>
			<?php

			}
			?>

		<?php
			$xy++;
		}
		?>
		<div style="padding-top: 15px;"></div>
		<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $_POST['id'] ?>">
		<input type="hidden" id="master_id" name="master_id" value="<?php echo  $_POST['master_id'] ?>">
		<?php
		if ($rowSHNO['id'] == "") {
		?>
			<button type="button" class="btn btn-warning btn-sm" onclick="insert_htl_no(<?php echo $xy ?>)" data-dismiss="modal">Submit</button>
		<?php
		} else {
		?>
			<button type="button" class="btn btn-success btn-sm" onclick="update_htl_no(<?php echo $xy ?>)" data-dismiss="modal">Update</button>
		<?php
		}
		?>
	<?php
	} else {
	?>
		<div style="text-align: center; padding-bottom: 10px;"><?php echo $rowMaster['landtour'] ?></div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label style="font-size: 11px;">Jumlah Pax</label>
					<!-- <select class="form-control form-control-sm" nama="sel_pax" id="sel_pax" onchange="fungsi_lthotel()"> -->
					<select class="form-control form-control-sm" nama="sel_pax" id="sel_pax" onchange="fungsi_hotel_day()">
						<option value="">Pilih Pax</option>
						<?php
						$query_LTNx = "SELECT* FROM LT_itinnew where kode='" . $rowMaster['landtour'] . "'";
						$rs_LTNx = mysqli_query($con, $query_LTNx);
						
						while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
							$ket = "";
							if ($row_ltn['ket'] != "") {
								$ket = " || " . $row_ltn['ket'];
							}
							$hotel = $row_ltn['hotel1'] . $ket;
							if ($rowH_id['id'] != $row_ltn['id']) {
						?>
								<option value="<?php echo $row_ltn['id'] ?>">
									<?php
									$pax_u = "";
									$pax_b = "";
									if ($row_ltn['pax_u'] != 0) {
										$pax_u = "-" . $row_ltn['pax_u'];
									}
									if ($row_ltn['pax_b'] != 0) {
										$pax_b = "+" . $row_ltn['pax_b'];
									}
									echo "NO : ".$row_ltn['no_urut']." || ".$row_ltn['pax'] . $pax_u . $pax_b . " pax (" . number_format($row_ltn['twn'], 0, ",", ".") . ") || " . $hotel." || exp : ".$row_ltn['expired'];
									?>
								</option>
							<?php
							} else {
							?>
								<option value="<?php echo $row_ltn['id'] ?>" selected>
									<?php
									$pax_u = "";
									$pax_b = "";
									if ($row_ltn['pax_u'] != 0) {
										$pax_u = "-" . $row_ltn['pax_u'];
									}
									if ($row_ltn['pax_b'] != 0) {
										$pax_b = "+" . $row_ltn['pax_b'];
									}
									echo "NO : ".$row_ltn['no_urut']." || ". $row_ltn['pax'] . $pax_u . $pax_b . " pax (" . number_format($row_ltn['twn'], 0, ",", ".") . ") || " . $hotel." || exp : ".$row_ltn['expired'];
									?>
								</option>
						<?php
							}

							// }
						}
						?>

					</select>
				</div>
			</div>
		</div>

		<?php
		$queryLTH = "SELECT * FROM  LT_add_pilihHotel WHERE hotel='1' && tour_id=" . $_POST['master_id'];
		$rsLTH = mysqli_query($con, $queryLTH);
		// var_dump($queryLTH);
		$z = 1;
		$ip = 0;
		while ($rowLTH = mysqli_fetch_array($rsLTH)) {
			$query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $_POST['master_id'] . "' && hari='" . $rowLTH['hari'] . "'";
			$rs_rute = mysqli_query($con, $query_rute);
			$row_rute = mysqli_fetch_array($rs_rute);
		?>
			<div style="font-weight: bold; padding-top: 10px;">Hari Ke <?php echo $rowLTH['hari'] ?> : <?php echo $row_rute['nama'] ?></div>
			<div class="row">
				<div class="col-md-12">
					<label style="font-size: 11px;">Pilih Hotel</label>
					<select class="form-control form-control-sm loop" nama="htl_day<?php echo $z ?>" id="htl_day<?php echo $z ?>">
						<?php
						if ($rowSH['id'] != "") {

							$querySH2 = "SELECT * FROM  LT_select_PilihHTL WHERE copy_id='" . $_POST['id'] . "' && master_id='" . $_POST['master_id'] . "' && hari= '" . $rowLTH['hari'] . "'";
							$rsSH2 = mysqli_query($con, $querySH2);
							$rowSH2 = mysqli_fetch_array($rsSH2);
							// var_dump($rowSH2['id']);
							if ($rowSH2['id'] != "") {

								$hotel = "";
								if ($rowSH2['no_htl'] == 1) {
									$hotel = $rowH_id['hotel1'];
								} else if ($rowSH2['no_htl'] == 2) {
									$hotel = $rowH_id['hotel2'];
								} else if ($rowSH2['no_htl'] == 3) {
									$hotel = $rowH_id['hotel3'];
								} else if ($rowSH2['no_htl'] == 4) {
									$hotel = $rowH_id['hotel4'];
								} else if ($rowSH2['no_htl'] == 5) {
									$hotel = $rowH_id['hotel5'];
								} else if ($rowSH2['no_htl'] == 6) {
									$hotel = $rowH_id['hotel6'];
								} else if ($rowSH2['no_htl'] == 7) {
									$hotel = $rowH_id['hotel7'];
								} else if ($rowSH2['no_htl'] == 8) {
									$hotel = $rowH_id['hotel8'];
								} else if ($rowSH2['no_htl'] == 9) {
									$hotel = $rowH_id['hotel9'];
								} else if ($rowSH2['no_htl'] == 10) {
									$hotel = $rowH_id['hotel10'];
								}
							}

						?>
							<option value="<?php echo  $rowSH['no_htl'] ?>" selected><?php echo $hotel ?></option>
						<?php
						} else {
						?>
							<option value="">Pilih Hotel</option>
						<?php
						}
						?>

					</select>
				</div>
			</div>
		<?php
			$z++;
			$ip++;
		}
		?>
		<div style="padding-top: 15px;"></div>
		<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $_POST['id'] ?>">
		<input type="hidden" id="master_id" name="master_id" value="<?php echo  $_POST['master_id'] ?>">
		<input type="hidden" id="lt_name" name="lt_name" value="<?php echo  $rowMaster['landtour'] ?>">
		<?php
		if ($rowSH['id'] == "") {
		?>
			<button type="button" class="btn btn-warning btn-sm" onclick="insert_htl(<?php echo $z ?>)" data-dismiss="modal">Submit</button>
		<?php
		} else {
		?>
			<button type="button" class="btn btn-success btn-sm" onclick="update_htl(<?php echo $z ?>)" data-dismiss="modal">Update</button>
		<?php
		}
		?>

	<?php
	}
	?>

</form>
<script>
	function fungsi_hotel_day() {
		var txt;
		var r = confirm("Are you sure to Replace?");
		if (r == true) {
			var h_gb = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
			$('.loop').empty();
			$.post('LT_get_select_lt.php', {
				'brand': h_gb,
			}, function(data) {
				var jsonData = JSON.parse(data);
				// console.log(jsonData);
				if (jsonData != '') {
					for (var i = 0; i < jsonData.length; i++) {
						var counter = jsonData[i];
						if (counter.hotel1 != "") {
							$('.loop').append('<option value=' + 1 + '>' + counter.hotel1 + '</option>');
						}
						if (counter.hotel2 != "") {
							$('.loop').append('<option value=' + 2 + '>' + counter.hotel2 + '</option>');
						}
						if (counter.hotel3 != "") {
							$('.loop').append('<option value=' + 3 + '>' + counter.hotel3 + '</option>');
						}
						if (counter.hotel4 != "") {
							$('.loop').append('<option value=' + 4 + '>' + counter.hotel4 + '</option>');
						}
						if (counter.hotel5 != "") {
							$('.loop').append('<option value=' + 5 + '>' + counter.hotel5 + '</option>');
						}
						if (counter.hotel6 != "") {
							$('.loop').append('<option value=' + 6 + '>' + counter.hotel6 + '</option>');
						}
						if (counter.hotel7 != "") {
							$('.loop').append('<option value=' + 7 + '>' + counter.hotel7 + '</option>');
						}
						if (counter.hotel8 != "") {
							$('.loop').append('<option value=' + 8 + '>' + counter.hotel8 + '</option>');
						}
						if (counter.hotel9 != "") {
							$('.loop').append('<option value=' + 9 + '>' + counter.hotel9 + '</option>');
						}
						if (counter.hotel10 != "") {
							$('.loop').append('<option value=' + 10 + '>' + counter.hotel10 + '</option>');
						}

					}
				} else {
					$(".loop").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
				}
			});
		}
	}

	function insert_htl(x) {
		var h_gb = $("input[name=lt_name]").val();
		var pax = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
		// var sel_htl = document.getElementById("sel_htl").options[document.getElementById("sel_htl").selectedIndex].value;
		var master_id = $("input[name=master_id]").val();
		var copy_id = $("input[name=copy_id]").val();
		let formData = new FormData();
		for (var i = 1; i < x; i++) {
			var htl_day = document.getElementById("htl_day" + i).options[document.getElementById("htl_day" + i).selectedIndex].value;
			formData.append("htl_day[]", htl_day);
		}
		formData.append("lt_name", h_gb);
		// formData.append("pax", pax);
		formData.append("sel_htl", pax);
		formData.append("master_id", master_id);
		formData.append("copy_id", copy_id);
		formData.append("code", "yes");
		$.ajax({
			type: 'POST',
			url: "insert_pilih_LThtl.php",
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
		})
	}

	function update_htl(x) {
		var h_gb = $("input[name=lt_name]").val();
		var pax = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
		// var sel_htl = document.getElementById("sel_htl").options[document.getElementById("sel_htl").selectedIndex].value;
		var master_id = $("input[name=master_id]").val();
		var copy_id = $("input[name=copy_id]").val();
		let formData = new FormData();
		for (var i = 1; i < x; i++) {
			var htl_day = document.getElementById("htl_day" + i).options[document.getElementById("htl_day" + i).selectedIndex].value;
			formData.append("htl_day[]", htl_day);
		}
		formData.append("lt_name", h_gb);
		// formData.append("pax", pax);
		formData.append("sel_htl", pax);
		formData.append("master_id", master_id);
		formData.append("copy_id", copy_id);
		formData.append("code", "yes");
		$.ajax({
			type: 'POST',
			url: "update_pilih_LThtl.php",
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
		})
	}

	function insert_htl_no(x) {
		var master_id = $("input[name=master_id]").val();
		var copy_id = $("input[name=copy_id]").val();
		let formData = new FormData();
		for (var i = 1; i < x; i++) {
			var hotel_name = $("input[name=hotel_name" + i + "]").val();
			var hotel_twin = $("input[name=hotel_twin" + i + "]").val();
			var hotel_triple = $("input[name=hotel_triple" + i + "]").val();
			var hotel_family = $("input[name=hotel_family" + i + "]").val();
			formData.append("hotel_name[]", hotel_name);
			formData.append("hotel_twin[]", hotel_twin);
			formData.append("hotel_triple[]", hotel_triple);
			formData.append("hotel_family[]", hotel_family);
		}

		formData.append("master_id", master_id);
		formData.append("copy_id", copy_id);
		formData.append("code", "no");

		$.ajax({
			type: 'POST',
			url: "insert_pilih_LThtl.php",
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
		})
	}

	function update_htl_no(x) {
		var master_id = $("input[name=master_id]").val();
		var copy_id = $("input[name=copy_id]").val();
		let formData = new FormData();
		for (var i = 1; i < x; i++) {
			var hotel_name = $("input[name=hotel_name" + i + "]").val();
			var hotel_twin = $("input[name=hotel_twin" + i + "]").val();
			var hotel_triple = $("input[name=hotel_triple" + i + "]").val();
			var hotel_family = $("input[name=hotel_family" + i + "]").val();
			formData.append("hotel_name[]", hotel_name);
			formData.append("hotel_twin[]", hotel_twin);
			formData.append("hotel_triple[]", hotel_triple);
			formData.append("hotel_family[]", hotel_family);
		}

		formData.append("master_id", master_id);
		formData.append("copy_id", copy_id);
		formData.append("code", "no");

		$.ajax({
			type: 'POST',
			url: "update_pilih_LThtl.php",
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
		})
	}
</script>