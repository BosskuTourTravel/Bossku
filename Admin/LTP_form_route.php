<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total.php";

$query_data = "SELECT city_in,city_out FROM  LTP_add_route where id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$arr_type = [];
$query_type = "SELECT * FROM LT_Flight_Tag order by id ASC";
$rs_type = mysqli_query($con, $query_type);
while ($row_type = mysqli_fetch_array($rs_type)) {
	array_push($arr_type, array("tag" => $row_type['tag'], "ket" => $row_type['ket']));
}

?>
<div class="content-wrapper" style="width: 200%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div style="text-align: center;">
						<h3 class="card-title" style="font-weight:bold;"><?php echo $row_data['city_in'] . " - " . $row_data['city_out'] ?></h3>
					</div>
					<div>
						<div class="input-group input-group-sm">
							<div class="input-group-append" style="text-align: left;">

							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<!-- <div class="container" style="padding: 10px; margin: 5px;"> -->
					<form>
						<div class="row">
							<div class="col-md-3" style="max-width: 300px;">
								<div class="form-group">
									<label for="tipe">Type</label>
									<select class="form-control form-control-sm" id="tipe" name="tipe" onchange="add_page(<?php echo $_POST['id'] ?>)">
										<option value="">Pilih tipe</option>
										<?php

										$query = "SELECT * FROM LTP_type_flight order by id ASC";
										$rs = mysqli_query($con, $query);
										while ($row = mysqli_fetch_array($rs)) {
										?>
											<option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3" style="max-width: 150px;">
								<div class="form-group">
									<label>Type</label>
									<select class="form-control form-control-sm" id="rute" name="rute">
										<option value="">Pilih tipe</option>
										<option value="FIT">FIT</option>
										<option value="FIG">FIG</option>
									</select>
								</div>
							</div>

						</div>
						<div id="dynamic_field"></div>
					</form>
					<div style="padding-top: 20px;">
						<button type="button" class="btn btn-success btn-sm" onclick="add_flight(<?php echo $_POST['id'] ?>)">SUBMIT</button>
					</div>
					<div style="padding-top: 30px;" id="card_field">
						<div class="card">
							<div class="card-body">
								<table class="table table-bordered table-sm">
									<thead style="background-color: mediumseagreen;">
										<tr style="text-align: center;">
											<th>Flight</th>
											<th>Dept</th>
											<th>Arr</th>
											<th>ETD</th>
											<th>ETA</th>
											<th>Transit</th>
											<th>Adt</th>
											<th>Chd</th>
											<th>Inf</th>
											<th>Bagasi</th>
											<th>Bagasi Price</th>
											<th>Seat Price</th>
											<th>Breakfast</th>
											<th>Lunch</th>
											<th>Dinner</th>
											<th>Tax</th>
											<th>Groub</th>
											<th>Type</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$grub = "";
										$query_rou = "SELECT * FROM  LTP_route_detail where route_id='" . $_POST['id'] . "'  order by rute ASC , id ASC";
										$rs_rou = mysqli_query($con, $query_rou);
										while ($row_rou = mysqli_fetch_array($rs_rou)) {
											$query_typ = "SELECT * FROM LTP_type_flight where id='" . $row_rou['type'] . "'";
											$rs_typ = mysqli_query($con, $query_typ);
											$row_typ = mysqli_fetch_array($rs_typ);
										?>
											<tr>
												<td><?php echo  $row_rou['maskapai'] ?></td>
												<td><?php echo  $row_rou['dept'] ?></td>
												<td><?php echo  $row_rou['arr'] ?></td>
												<td><?php echo  $row_rou['take'] ?></td>
												<td><?php echo  $row_rou['landing'] ?></td>
												<td><?php if ($row_rou['transit'] != 0) {
														echo number_format($row_rou['transit'], 0, ",", ".") . " Menit";
													}  ?></td>
												<td><?php echo number_format($row_rou['adt'], 0, ",", ".") ?></td>
												<td><?php echo number_format($row_rou['chd'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['inf'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['bagasi'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['bagasi_price'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['seat_price'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['bf'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['ln'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['dn'], 0, ",", ".") ?></td>
												<td><?php echo  number_format($row_rou['tax'], 0, ",", ".") ?></td>
												<td><?php echo  $row_rou['rute'] ?></td>
												<td><?php echo $row_typ['nama'] ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- </div> -->
				</div>
				<div class="card-footer">
					<div style="padding-right: 5px;"> <button type="button" class="btn btn-warning btn-sm" onclick="LT_Package(9,0,0)"><i class="fa fa-arrow-left"></i></button></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		function add_page(x) {
			var tipe = document.getElementById("tipe").options[document.getElementById("tipe").selectedIndex].value;
			$.ajax({
				url: "LTP_route_field.php",
				method: "POST",
				asynch: false,
				data: {
					x: x,
					tipe: tipe,
				},
				success: function(data) {
					$('#dynamic_field').html(data);
				}
			});

		}

		// function add_card(x) {
		// 	var tipe = document.getElementById("tipe").options[document.getElementById("tipe").selectedIndex].value;
		// 	var rute = document.getElementById("rute").options[document.getElementById("rute").selectedIndex].value;
		// 	$.ajax({
		// 		url: "LTP_card_field.php",
		// 		method: "POST",
		// 		asynch: false,
		// 		data: {
		// 			x: x,
		// 			tipe: tipe,
		// 			rute: rute
		// 		},
		// 		success: function(data) {
		// 			$('#card_field').html(data);
		// 		}
		// 	});
		// }
	</script>
	<script>
		function getFromX(x, y) {
			$("#dept_list" + y).empty();
			$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/' + x + '?isDestination=true&enable_general_search_v2=true', function(data) {
				var i = 0;
				for (i = 0; i < data.length; i++) {
					if (data[i].PlaceId !== "undefined") {
						var detail = data[i].PlaceName + " ( " + data[i].CountryName + " ) ";
						var id = data[i].PlaceId;
						var option = "<option value='" + id + "'>" + detail + "</option>";
						$("#dept_list" + y).append(option);
					}

				}

			});
		}

		function getArr(x, y) {
			$("#arr_list" + y).empty();
			$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/' + x + '?isDestination=true&enable_general_search_v2=true', function(data) {
				var i = 0;
				for (i = 0; i < data.length; i++) {
					if (data[i].PlaceId !== "undefined") {
						var detail = data[i].PlaceName + " ( " + data[i].CountryName + " ) ";
						var id = data[i].PlaceId;
						var option = "<option value='" + id + "'>" + detail + "</option>";
						$("#arr_list" + y).append(option);
					}

				}

			});
		}
	</script>
	<script>
		function add_flight(x) {
			let formData = new FormData();
			var tipe = document.getElementById("tipe").options[document.getElementById("tipe").selectedIndex].value;
			var route_id = x;
			var rute = document.getElementById("rute").options[document.getElementById("rute").selectedIndex].value;

			// var int = $('select[name="int[]"] option:selected').map(function() {
			// 	return this.value; // $(this).val()
			// }).get();
			var maskapai = $('input[name="maskapai[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var dept = $('input[name="dept[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var arr = $('input[name="arr[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var tgl = $('input[name="tgl[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var take = $('input[name="take[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var landing = $('input[name="landing[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var adt = $('input[name="adt[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var chd = $('input[name="chd[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var inf = $('input[name="inf[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var bagasi = $('input[name="bagasi[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var bg_price = $('input[name="bg_price[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var st_price = $('input[name="st_price[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var bf = $('input[name="bf[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var ln = $('input[name="ln[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var dn = $('input[name="dn[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var tax = $('input[name="tax[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			formData.append("route_id", route_id);
			formData.append("rute", rute);
			formData.append("tipe", tipe);
			formData.append("maskapai", maskapai);
			formData.append("dept", dept);
			formData.append("arr", arr);
			formData.append("tgl", tgl);
			formData.append("take", take);
			formData.append("landing", landing);
			formData.append("adt", adt);
			formData.append("chd", chd);
			formData.append("inf", inf);
			formData.append("bagasi", bagasi);
			formData.append("bg_price", bg_price);
			formData.append("st_price", st_price);
			formData.append("bf", bf);
			formData.append("ln", ln);
			formData.append("dn", dn);
			formData.append("tax", tax);
			// alert(rute);
			if (rute === ''){
				alert("Silikan Pilih Type dahulu !!")
			}else{
				$.ajax({
				type: 'POST',
				url: "LTP_insert_route.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_Package(10,route_id,0);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});
			}

		}
	</script>