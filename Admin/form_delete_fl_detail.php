<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
$data =  explode(",", $_POST['id']);
// var_dump($_POST['id']);
$data_awal = strval($_POST['id']);
?>
<div class="content-wrapper" style="width: 120%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM DELETE FLIGHT</div>
					<div class="card-tools">

						<button type="button" onclick=" LT_Package(15,0,0);" class="btn btn-warning  btn-sm"><i class="fa fa-arrow-left"></i></button>
						<button type="button" onclick=" LT_Package(16,'<?php echo $_POST['id'] ?>', 0);" class="btn btn-primary  btn-sm"><i class="fa fa-sync"></i></button>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-striped table-sm" style="font-size: 12px;">
						<thead>
							<tr>
								<th>ID GROUP</th>
								<th>MUSIM</th>
								<th>MASKAPAI</th>
								<th>IN / OUT</th>
								<th>TRIP</th>
								<th>TYPE</th>
								<th>TGL</th>
								<th>CODE</th>
								<th>DEPT ARR</th>
								<th>ETD ETA</th>
								<th>TRANSIT</th>
								<th>ADT</th>
								<th>CHD</th>
								<th>INF</th>
								<th>BAGASI</th>
								<th>BF</th>
								<th>LN</th>
								<th>DN</th>
								<th>SEAT PRICE</th>
								<th>TAX</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// var_dump($data_awal);
							foreach ($data as $val) {
								$query_detail = "SELECT * FROM  LTP_route_detail where id_grub=" . $val;
								$rs_detail = mysqli_query($con, $query_detail);
								while ($row_detail = mysqli_fetch_array($rs_detail)) {

									$query_route = "SELECT * FROM LTP_add_route where id=" . $row_detail['route_id'];
									$rs_route = mysqli_query($con, $query_route);
									$row_route = mysqli_fetch_array($rs_route);

									$query_type = "SELECT nama FROM LTP_type_flight where id=" . $row_detail['type'];
									$rs_type = mysqli_query($con, $query_type);
									$row_type = mysqli_fetch_array($rs_type);

									$query_flight_logo2 = "SELECT * FROM  LT_flight_logo where kode='" .  $row_route['maskapai'] . "'";
									$rs_flight_logo2 = mysqli_query($con, $query_flight_logo2);
									$row_flight_logo2 = mysqli_fetch_array($rs_flight_logo2);
							?>
									<tr>
										<th><?php echo $row_detail['id_grub'] ?></th>
										<td><?php echo $row_detail['musim'] ?></td>
										<td><?php echo  $row_flight_logo2['nama'] ?></td>
										<td style="color: darkgreen;"><?php echo $row_route['city_in'] . " - " . $row_route['city_out'] ?></td>
										<td><?php echo $row_type['nama'] ?></td>
										<td><?php echo $row_detail['rute'] ?></td>
										<td><?php echo $row_detail['tgl'] ?></td>
										<td><?php echo $row_detail['maskapai'] ?></td>
										<td><?php echo $row_detail['dept'] . "-" . $row_detail['arr'] ?></td>
										<td style="max-width: 90px;"><?php echo $row_detail['take'] . "-" . $row_detail['landing'] ?></td>
										<td><?php echo $row_detail['transit'] ?></td>
										<td><?php echo $row_detail['adt'] ?></td>
										<td><?php echo $row_detail['chd'] ?></td>
										<td><?php echo $row_detail['inf'] ?></td>
										<td><?php echo $row_detail['bagasi'] . " kg : IDR " . $row_detail['bagasi_price'] ?></td>
										<td><?php echo $row_detail['bf'] ?></td>
										<td><?php echo $row_detail['ln'] ?></td>
										<td><?php echo $row_detail['dn'] ?></td>
										<td><?php echo $row_detail['seat_price'] ?></td>
										<td><?php echo $row_detail['tax'] ?></td>
										<td>
											<a class="btn btn-danger btn-sm" onclick="fungsi_hapus(<?php echo $row_detail['id']  ?>,<?php echo $_POST['id'] ?>)"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
					<div id="modal_update" style="padding-top: 20px;"></div>
				</div>
				<div class="card-footer">
					<button type="button" class="btn btn-danger btn-sm" onclick="fungsi_hapus_all(<?php echo $_POST['id'] ?>)">DELETE ALL</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		function fungsi_hapus(x, y) {
			var txt;
			var r = confirm("Are you sure to delete?");
			if (r == true) {
				$.ajax({
					url: "LTP_delete_fl_detail.php",
					method: "POST",
					asynch: false,
					data: {
						id: x
					},
					success: function(data) {
						if (data == "success") {
							LT_Package(16, y, 0);
						} else {
							alert("Fail to Delete");
						}
					}
				});
			}
		}

		function fungsi_hapus_all(x) {
			var txt;
			var r = confirm("Are you sure to delete All data Flight?");
			if (r == true) {
				$.ajax({
					url: "LTP_delete_fl_detail_all.php",
					method: "POST",
					asynch: false,
					data: {
						id: x
					},
					success: function(data) {
						if (data == "success") {
							LT_Package(15, 0, 0);
						} else {
							alert("Fail to Delete");
						}
					}
				});
			}
		}
	</script>