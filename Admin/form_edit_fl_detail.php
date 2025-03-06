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
<?php echo $_POST['id'] ?>
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM EDIT FLIGHT</div>
					<div class="card-tools">
						<button type="button" onclick=" LT_Package(15,0,0);" class="btn btn-warning  btn-sm"><i class="fa fa-arrow-left"></i></button>
						<button type="button" onclick="LT_Package(17,<?php echo $_POST['id'] ?>, 0);" class="btn btn-primary  btn-sm"><i class="fa fa-sync"></i></button>
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
											<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_update" data-id="<?php echo $row_detail['id']  ?>"><i class="fa fa-edit"></i></a>
										</td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
					<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">FORM UPDATE FLIGHT</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="modal-data"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-success btn-sm" onclick="update_fl(<?php echo $_POST['id'] ?>)" data-dismiss="modal">Update</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#modal_update').on('show.bs.modal', function(e) {
				var id = $(e.relatedTarget).data('id');
				$.ajax({
					url: "get_modal_update_fl_detail.php",
					method: "POST",
					asynch: false,
					data: {
						id: id,
					},
					success: function(data) {
						$('.modal-data').html(data);
					}
				});
			});
		});

		function update_fl(x) {

			var id = $("input[name=detail_id]").val();
			var musim = $("input[name=musim]").val();
			var trip = document.getElementById("trip").value;
			var rute = document.getElementById("rute").value;
			var tgl = $("input[name=tgl]").val();
			var kode = $("input[name=kode]").val();
			var dept = $("input[name=dept]").val();
			var arr = $("input[name=arr]").val();
			var etd = $("input[name=etd]").val();
			var eta = $("input[name=eta]").val();
			var transit = $("input[name=transit]").val();
			var adt = $("input[name=adt]").val();
			var chd = $("input[name=chd]").val();
			var inf = $("input[name=inf]").val();
			var bf = $("input[name=bf]").val();
			var ln = $("input[name=ln]").val();
			var dn = $("input[name=dn]").val();
			var bagasi = $("input[name=bagasi]").val();
			var bagasi_price = $("input[name=bagasi_price]").val();
			var seat = $("input[name=seat]").val();
			var tax = $("input[name=tax]").val();

			// alert(x);

			$.ajax({
				url: "update_fl_detail.php",
				method: "POST",
				asynch: false,
				data: {
					id: id,
					musim: musim,
					trip: trip,
					rute: rute,
					tgl: tgl,
					kode: kode,
					dept: dept,
					arr: arr,
					etd: etd,
					eta: eta,
					transit: transit,
					adt: adt,
					chd: chd,
					inf: inf,
					bf: bf,
					ln: ln,
					dn: dn,
					bagasi: bagasi,
					bagasi_price: bagasi_price,
					seat: seat,
					tax: tax
				},
				success: function(data) {
					if (data == "success") {
						// $('#modal_update').modal('hide');
						alert(data);
						// LT_Package(17, x, 0);
					} else {
						alert(data);
					}

				}
			});
		}
	</script>