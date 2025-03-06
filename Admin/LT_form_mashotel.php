<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";




$querySHNO = "SELECT * FROM  LT_select_PilihHTLNC WHERE master_id=" . $_POST['id'];
$rsSHNO = mysqli_query($con, $querySHNO);
$rowSHNO = mysqli_fetch_array($rsSHNO);
// var_dump($rowSH[0]['hari']);
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM TAMBAH HOTEL MASTER LANDTOUR
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
						<a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
					</div>

					<div class="card-body">
						<form>
							<?php
								$queryLTH = "SELECT * FROM  LT_add_pilihHotel WHERE hotel='1' && tour_id='" . $_POST['id'] . "' order by hari ASC";
								$rsLTH = mysqli_query($con, $queryLTH);
								// var_dump($queryLTH);
								$xy = 1;
								while ($rowLTH = mysqli_fetch_array($rsLTH)) {
									$querySHNO2 = "SELECT * FROM  LT_select_PilihHTLNC WHERE master_id='" . $_POST['id'] . "'  && hari='" . $rowLTH['hari'] . "' order by hari ASC";
									$rsSHNO2 = mysqli_query($con, $querySHNO2);
									$rowSHNO2 = mysqli_fetch_array($rsSHNO2);
									// var_dump($querySHNO2);
									if ($rowSHNO['id'] != "") {
										if ($rowSHNO2['hari'] != "") {
											$val_hotel_name = $rowSHNO2['hotel_name'];
											$val_hotel_twin = $rowSHNO2['hotel_twin'];
											$val_hotel_triple = $rowSHNO2['hotel_triple'];
											$val_hotel_family = $rowSHNO2['hotel_family'];
										}
										$query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $_POST['id'] . "' && hari='".$rowLTH['hari']."'";
										$rs_rute = mysqli_query($con, $query_rute);
										$row_rute = mysqli_fetch_array($rs_rute);
							?>
										<div style="font-weight: bold; padding-top: 10px;">Hari Ke <?php echo $rowLTH['hari'] ?> :  <?php echo $row_rute['nama']?></div>
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
										$query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $_POST['id'] . "' && hari='".$rowLTH['hari']."'";
										$rs_rute = mysqli_query($con, $query_rute);
										$row_rute = mysqli_fetch_array($rs_rute);
									?>
										<div style="font-weight: bold; padding-top: 10px;">Hari Ke <?php echo $rowLTH['hari'] ?>:  <?php echo $row_rute['nama']?></div>
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
									$xy++;
								}
								?>
								<div style="padding-top: 15px;"></div>
								<input type="hidden" id="master_id" name="master_id" value="<?php echo  $_POST['id'] ?>">
								<?php
								if ($rowSHNO['id'] == "") {
								?>
									<button type="button" class="btn btn-warning btn-sm" onclick="insert_htl_no(<?php echo $xy ?>)">Submit</button>
								<?php
								} else {
								?>
									<button type="button" class="btn btn-success btn-sm" onclick="update_htl_no(<?php echo $xy ?>)">Update</button>
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
				LT_itinerary(3, 0, 0);
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
				LT_itinerary(3, 0, 0);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		})
	}

	function insert_htl_no(x) {
		var master_id = $("input[name=master_id]").val();
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
				LT_itinerary(3, 0, 0);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		})
	}

	function update_htl_no(x) {
		var master_id = $("input[name=master_id]").val();
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
				LT_itinerary(3, 0, 0);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		})
	}
</script>