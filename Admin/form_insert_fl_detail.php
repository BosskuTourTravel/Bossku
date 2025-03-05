<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
$data =  explode(",", $_POST['id']);
// var_dump($_POST['id']);
$data_awal = strval($_POST['id']);
?>
<div class="content-wrapper" style="width: 150%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM INSERT FLIGHT</div>
					<div class="card-tools">
						<button type="button" onclick=" LT_Package(15,0,0);" class="btn btn-warning  btn-sm"><i class="fa fa-arrow-left"></i></button>
						<button type="button" onclick=" LT_Package(18,0,0);" class="btn btn-primary  btn-sm"><i class="fa fa-sync"></i></button>
					</div>
				</div>
				<div class="card-body">
					<form action="">
						<div class="form-row">
							<div class="col" style="max-width: 190px;">
								<label>City In</label>
								<input type="text" class="form-control form-control-sm" list="city_in_list" id="city_in" name="city_in" placeholder="City In">
								<datalist id="city_in_list">
									<?php
									$query_city = "SELECT name FROM city Order by name ASC";
									$rs_city = mysqli_query($con, $query_city);
									while ($row_city = mysqli_fetch_array($rs_city)) {
									?>
										<option value="<?php echo $row_city['name'] ?>"></option>
									<?php
									}
									?>
								</datalist>
							</div>
							<div class="col" style="max-width: 190px;">
								<label>City Out</label>
								<input type="text" class="form-control form-control-sm" list="city_out_list" id="city_out" name="city_out" placeholder="City Out">
								<datalist id="city_out_list">
									<?php
									$query_city2 = "SELECT name FROM city Order by name ASC";
									$rs_city2 = mysqli_query($con, $query_city2);
									while ($row_city2 = mysqli_fetch_array($rs_city2)) {
									?>
										<option value="<?php echo $row_city2['name'] ?>"></option>
									<?php
									}
									?>
								</datalist>
							</div>
							<div class="col" style="max-width: 190px;">
								<label>Flight</label>
								<select class="form-control form-control-sm" name="fl" id="fl">
									<option selected>Choose...</option>
									<?php
									$query_flight_logo = "SELECT * FROM  LT_flight_logo order by nama ASC";
									$rs_flight_logo = mysqli_query($con, $query_flight_logo);
									while ($row_flight_logo = mysqli_fetch_array($rs_flight_logo)) {
									?>
										<option value="<?php echo $row_flight_logo['id']  ?>"><?php echo $row_flight_logo['nama'] . " (" . $row_flight_logo['kode'] . ") "  ?></option>
									<?php
									}
									?>

								</select>
							</div>
							<div class="col" style="max-width: 190px;">
								<label>Musim</label>
								<select id="musim" name="musim" class="form-control form-control-sm">
									<option selected>Choose...</option>
									<option value="all">All</option>
									<option value="winter">Winter</option>
									<option value="summer">Summer</option>
								</select>
							</div>
							<div class="col" style="max-width: 90px;">
								<label>Type</label>
								<select id="rute" name="rute" class="form-control form-control-sm">
									<option selected>Choose...</option>
									<option value="FIT">FIT</option>
									<option value="FIG">FIG</option>
								</select>
							</div>
							<div class="col" style="max-width: 190px;">
								<label>Trip</label>
								<select id="trip" name="trip" class="form-control form-control-sm" onchange="fungsi_trip(this.value)">
									<option value="" selected>Choose...</option>
									<?php
									$query_type = "SELECT * FROM LTP_type_flight order by id ASC ";
									$rs_type = mysqli_query($con, $query_type);
									while ($row_type = mysqli_fetch_array($rs_type)) {
									?>
										<option value="<?php echo $row_type['id'] ?>"><?php echo $row_type['nama'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div id="modal_trip" style="padding-top: 20px;">
						</div>
					</form>
				</div>
				<div class="card-footer">
					<button type="button" class="btn btn-danger btn-sm" onclick="fungsi_insert()">INSERT</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		function fungsi_trip(x) {
			$.ajax({
				url: "get_data_insert_flight.php",
				method: "POST",
				asynch: false,
				data: {
					id: x,
				},
				success: function(data) {
					$('#modal_trip').html(data);
				}
			});
		}

		function fungsi_insert() {
			let formData = new FormData();
			var city_in = $("input[name=city_in]").val();
			var city_out = $("input[name=city_out]").val();
			var fl = document.getElementById("fl").value;
			var rute = document.getElementById("rute").value;
			var musim = document.getElementById("musim").value;
			var trip = document.getElementById("trip").value;
			var col = $("input[name=kolom]").val();
			if (city_in == "") {
				alert("Field City In tidak boleh kosong !!!");
			} else if (city_out == "") {
				alert("FieldCity Out tidak boleh kosong !!!");
			} else if (fl == "") {
				alert("Field Flight tidak boleh kosong !!!");
			} else if (rute == "") {
				alert("Field Type tidak boleh kosong !!!");
			} else if (musim == "") {
				alert("Field Musim tidak boleh kosong !!!");
			} else if (trip == "") {
				alert("Field Trip tidak boleh kosong !!!");
			} else {
				for (i = 1; i <= col; i++) {
					var maskapai = $("input[name=maskapai" + i + "]").val();
					var dept = $("input[name=dept" + i + "]").val();
					var arr = $("input[name=arr" + i + "]").val();
					var etd = $("input[name=etd" + i + "]").val();
					var eta = $("input[name=eta" + i + "]").val();
					var transit = $("input[name=transit" + i + "]").val();
					var tgl = $("input[name=tgl" + i + "]").val();
					var adt = $("input[name=adt" + i + "]").val();
					var chd = $("input[name=chd" + i + "]").val();
					var inf = $("input[name=inf" + i + "]").val();
					var bf = $("input[name=bf" + i + "]").val();
					var ln = $("input[name=ln" + i + "]").val();
					var dn = $("input[name=dn" + i + "]").val();
					var bagasi = $("input[name=bagasi" + i + "]").val();
					var bagasi_price = $("input[name=bagasi_price" + i + "]").val();
					var seat = $("input[name=seat" + i + "]").val();
					var tax = $("input[name=tax" + i + "]").val();

					formData.append('maskapai[]', maskapai);
					formData.append('dept[]', dept);
					formData.append('arr[]', arr);
					formData.append('eta[]', eta);
					formData.append('etd[]', etd);
					formData.append('transit[]', transit);
					formData.append('tgl[]', tgl);
					formData.append('adt[]', adt);
					formData.append('chd[]', chd);
					formData.append('inf[]', inf);
					formData.append('bf[]', bf);
					formData.append('ln[]', ln);
					formData.append('dn[]', dn);
					formData.append('bagasi[]', bagasi);
					formData.append('bagasi_price[]', bagasi_price);
					formData.append('seat[]', seat);
					formData.append('tax[]', tax);
				}
				formData.append('city_in', city_in);
				formData.append('city_out', city_out);
				formData.append('fl', fl);
				formData.append('rute', rute);
				formData.append('musim', musim);
				formData.append('trip', trip);
				formData.append('col', col);

				$.ajax({
					type: 'POST',
					url: "insert_form_fl.php",
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function(msg) {
						alert(msg);
						LT_Package(15, 0, 0);
					},
					error: function() {
						alert("Data Gagal Diupload");
					}
				});
			}

		}
	</script>