<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
$query = "SELECT * FROM  LTP_add_route where id =" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

$query_rr = "SELECT * FROM  LT_add_roundtrip where route_id =" . $_POST['id'];
$rs_rr = mysqli_query($con, $query_rr);
$row_rr = mysqli_fetch_array($rs_rr);

?>
<div class="content-wrapper">
	<div class='row' style="padding: 20px;">
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM RETURN FLIGHT <?php echo $row['city_in'] . " - " . $row['city_out'] . " " . $row['maskapai']; ?></div>
					<div class="card-tools"></div>
				</div>
				<div class="card-body">
					<div class="row">
						<?php
						if ($row_rr['id'] == "") {
						?>
							<div class="col-md-4">
								<div class="form-group">
									<label>Adult</label>
									<input type="text" class="form-control form-control-sm" id="adt" name="adt">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Chd</label>
									<input type="text" class="form-control form-control-sm" id="chd" name="chd">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Inf</label>
									<input type="text" class="form-control form-control-sm" id="inf" name="inf">
								</div>
							</div>
						<?php
						} else {
						?>
							<div class="col-md-4">
								<div class="form-group">
									<label>Adult</label>
									<input type="text" class="form-control form-control-sm" id="adt" name="adt" value="<?php echo $row_rr['adt'] ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Chd</label>
									<input type="text" class="form-control form-control-sm" id="chd" name="chd" value="<?php echo $row_rr['chd'] ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Inf</label>
									<input type="text" class="form-control form-control-sm" id="inf" name="inf" value="<?php echo $row_rr['inf'] ?>">
								</div>
							</div>
						<?php
						}
						?>

					</div>
				</div>
				<div class="card-footer">
					<?php
					if ($row_rr['id'] == "") {
					?>
						<button type="button" class="btn btn-warning btn-sm" onclick="add_flight(<?php echo $_POST['id'] ?>,0)">ADD PRICE</button>
					<?php
					} else {
					?>
						<button type="button" class="btn btn-success btn-sm" onclick="add_flight(<?php echo $_POST['id'] ?>,<?php echo $row_rr['id'] ?>)">UPDATE PRICE</button>
					<?php
					}
					?>
					<button type="button" class="btn btn-danger btn-sm" onclick="LT_Package(9, 0, 0)">BACK</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		function add_flight(x, y) {
			let formData = new FormData();
			var adt = document.getElementById('adt').value;
			var chd = document.getElementById('chd').value;
			var inf = document.getElementById('inf').value;
			formData.append("id", x);
			formData.append("tipe", y);
			formData.append("adt", adt);
			formData.append("chd", chd);
			formData.append("inf", inf);

			$.ajax({
				type: 'POST',
				url: "insert_add_roundtrip.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_Package(9, 0, 0);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});


		}
	</script>