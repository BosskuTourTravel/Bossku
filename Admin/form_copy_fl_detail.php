<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
$data =  explode(",", $_POST['id']);

$data_awal = strval($_POST['id']);

?>
<input type="hidden" name="data" id="data" value="<?php echo $_POST['id'] ?>">
<div class="content-wrapper" style="width: 160%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM COPY FLIGHT</div>
					<div class="card-tools">

						<button type="button" onclick=" LT_Package(15,0,0);" class="btn btn-warning  btn-sm"><i class="fa fa-arrow-left"></i></button>
						<button type="button" onclick="LT_Package(19,'<?php echo $_POST['id'] ?>', 0);" class="btn btn-primary  btn-sm"><i class="fa fa-sync"></i></button>
					</div>
				</div>
				<div class="card-body">
					<?php
					// var_dump($_POST['id']);
					foreach ($data as $val) {
						$query_detail_header = "SELECT * FROM  LTP_route_detail where id_grub='" . $val . "' order by id ASC limit 1";
						$rs_detail_header = mysqli_query($con, $query_detail_header);
						$row_detail_header = mysqli_fetch_array($rs_detail_header);
						// var_dump($query_detail_header);

						$query_route = "SELECT * FROM LTP_add_route where id=" . $row_detail_header['route_id'];
						$rs_route = mysqli_query($con, $query_route);
						$row_route = mysqli_fetch_array($rs_route);

						$query_flight_logo2 = "SELECT * FROM  LT_flight_logo where kode='" .  $row_route['maskapai'] . "'";
						$rs_flight_logo2 = mysqli_query($con, $query_flight_logo2);
						$row_flight_logo2 = mysqli_fetch_array($rs_flight_logo2);

						$query_type = "SELECT nama FROM LTP_type_flight where id=" . $row_detail_header['type'];
						$rs_type = mysqli_query($con, $query_type);
						$row_type = mysqli_fetch_array($rs_type);

					?>
						<div class="card">
							<div class="card-header" style="padding: 10px;">
								<div class="row">
									<div class="col-md-10">
										<?php echo "<b>" . $row_type['nama'] . " / " . $row_flight_logo2['nama'] . " / " . $row_route['city_in'] . " - " . $row_route['city_out'] . " / " . $row_detail_header['musim'] . " / " . $row_detail_header['rute'] . "</b>"; ?>
									</div>
									<div class="col-md-2" style="text-align: right;">
										<button type="button" onclick="del(<?php echo $val ?>)" class="btn btn-danger  btn-sm"><i class="fa fa-trash"></i></button>
									</div>
								</div>
							</div>
							<div class="card-body" style="padding: 10px;">
								<?php
								$query_detail = "SELECT * FROM  LTP_route_detail where id_grub=" . $val;
								$rs_detail = mysqli_query($con, $query_detail);
								$i = 1;
								while ($row_detail = mysqli_fetch_array($rs_detail)) {
								?>
									<div class="form-row" style="padding-top: 5px;">
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Flight Code</label>";
											} ?>
											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>maskapai<?php echo $i ?>" name="<?php echo $val ?>maskapai<?php echo $i ?>" value="<?php echo $row_detail['maskapai'] ?>">
										</div>
										<div class="col" style="max-width: 120px;">
											<?php if ($i == '1') {
												echo "<label>Depature</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>dept<?php echo $i ?>" name="<?php echo $val ?>dept<?php echo $i ?>" value="<?php echo $row_detail['dept'] ?>">
										</div>
										<div class="col" style="max-width: 120px;">
											<?php if ($i == '1') {
												echo "<label>Arrival</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>arr<?php echo $i ?>" name="<?php echo $val ?>arr<?php echo $i ?>" value="<?php echo $row_detail['arr'] ?>">
										</div>
										<div class="col" style="max-width: 120px;">
											<?php if ($i == '1') {
												echo "<label>Etd</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>etd<?php echo $i ?>" name="<?php echo $val ?>etd<?php echo $i ?>" value="<?php echo $row_detail['take'] ?>">
										</div>
										<div class="col" style="max-width: 120px;">
											<?php if ($i == '1') {
												echo "<label>Eta</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>eta<?php echo $i ?>" name="<?php echo $val ?>eta<?php echo $i ?>" value=" <?php echo $row_detail['landing'] ?>">
										</div>
										<div class="col" style="max-width: 120px;" hidden="hidden">
											<?php if ($i == '1') {
												echo "<label>Transit</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>transit<?php echo $i ?>" name="<?php echo $val ?>transit<?php echo $i ?>" value="<?php echo $row_detail['transit'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Tgl</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>tgl<?php echo $i ?>" name="<?php echo $val ?>tgl<?php echo $i ?>" value="<?php echo $row_detail['tgl'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Adt</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>adt<?php echo $i ?>" name="<?php echo $val ?>adt<?php echo $i ?>" value="<?php echo $row_detail['adt'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Chd</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>chd<?php echo $i ?>" name="<?php echo $val ?>chd<?php echo $i ?>" value="<?php echo $row_detail['chd'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Inf</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>inf<?php echo $i ?>" name="<?php echo $val ?>inf<?php echo $i ?>" value="<?php echo $row_detail['inf'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Bf</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>bf<?php echo $i ?>" name="<?php echo $val ?>bf<?php echo $i ?>" value="<?php echo $row_detail['bf'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Ln</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>ln<?php echo $i ?>" name="<?php echo $val ?>ln<?php echo $i ?>" value="<?php echo $row_detail['ln'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Dn</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>dn<?php echo $i ?>" name="<?php echo $val ?>dn<?php echo $i ?>" value="<?php echo $row_detail['dn'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Bagasi(kg)</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>bagasi<?php echo $i ?>" name="<?php echo $val ?>bagasi<?php echo $i ?>" value="<?php echo $row_detail['bagasi'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Bagasi Price</label>";
											} ?>

											<input type="text" class="form-control form-control-sm" id="bagasi_price<?php echo $i ?>" name="bagasi_price<?php echo $i ?>" value="<?php echo $row_detail['bagasi_price'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>SEAT</label>";
											} ?>
											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>seat<?php echo $i ?>" name="<?php echo $val ?>seat<?php echo $i ?>" value="<?php echo $row_detail['seat_price'] ?>">
										</div>
										<div class="col" style="max-width: 190px;">
											<?php if ($i == '1') {
												echo "<label>Tax</label>";
											} ?>
											<input type="text" class="form-control form-control-sm" id="<?php echo $val ?>tax<?php echo $i ?>" name="<?php echo $val ?>tax<?php echo $i ?>" value="<?php echo $row_detail['tax'] ?>">
										</div>
									</div>
								<?php
									$i++;
								}
								?>
								<input type="hidden" id="<?php echo $val ?>loop" name="<?php echo $val ?>loop" value="<?php echo $i ?>">
							</div>
						</div>
					<?php
					} ?>

				</div>
				<div class="card-footer">
					<button type="button" class="btn btn-success btn-sm" onclick="fungsi_insert()">INSERT AS NEW DATA</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		function del(x) {
			var txt;
			var r = confirm("Are you sure to delete?");
			if (r == true) {
				var data = $("input[name=data]").val();
				var arr_data = data.split(",");
				var newArray = arr_data.filter((value) => value != x);
				var val = newArray.toString();
				LT_Package(19, val, 0);
				console.log(newArray);
				// alert(arr_data);

			}
		}

		function fungsi_insert() {
			let formData = new FormData();
			var data = $("input[name=data]").val();
			var array = data.split(",");
			for (let i = 0; i < array.length; i++) {
				var x = array[i];
				var loop = $("input[name=" + x + "loop]").val();
				formData.append(x+'loop', loop);
				
				for (y = 1; y < loop; y++) {
					var maskapai = $("input[name=" + x + "maskapai" + y + "]").val();
					var dept = $("input[name=" + x + "dept" + y + "]").val();
					var arr = $("input[name=" + x + "arr" + y + "]").val();
					var etd = $("input[name=" + x + "etd" + y + "]").val();
					var eta = $("input[name=" + x + "eta" + y + "]").val();
					var transit = $("input[name=" + x + "transit" + y + "]").val();
					var tgl = $("input[name=" + x + "tgl" + y + "]").val();
					var adt = $("input[name=" + x + "adt" + y + "]").val();
					var chd = $("input[name=" + x + "chd" + y + "]").val();
					var inf = $("input[name=" + x + "inf" + y + "]").val();
					var bf = $("input[name=" + x + "bf" + y + "]").val();
					var ln = $("input[name=" + x + "ln" + y + "]").val();
					var dn = $("input[name=" + x + "dn" + y + "]").val();
					var bagasi = $("input[name=" + x + "bagasi" + y + "]").val();
					var bagasi_price = $("input[name=" + x + "bagasi_price" + y + "]").val();
					var seat = $("input[name=" + x + "seat" + y + "]").val();
					var tax = $("input[name=" + x + "tax" + y + "]").val();

					formData.append(x+'maskapai'+y, maskapai);
					formData.append(x+'dept'+y, dept);
					formData.append(x+'arr'+y, arr);
					formData.append(x+'etd'+y, etd);
					formData.append(x+'eta'+y, eta);
					formData.append(x+'transit'+y, transit);
					formData.append(x+'tgl'+y, tgl);
					formData.append(x+'adt'+y, adt);
					formData.append(x+'chd'+y, chd);
					formData.append(x+'inf'+y, inf);
					formData.append(x+'bf'+y, bf);
					formData.append(x+'ln'+y, ln);
					formData.append(x+'dn'+y, dn);
					formData.append(x+'bagasi'+y, bagasi);
					formData.append(x+'bagasi_price'+y, bagasi_price);
					formData.append(x+'seat'+y, seat);
					formData.append(x+'tax'+y, tax);

				}

			}

			formData.append('grub_id', data);
			$.ajax({
				type: 'POST',
				url: "insert_copy_fl.php",
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
	</script>