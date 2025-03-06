<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";


$query_visa = "SELECT * FROM  Visa2 Order by id ASC";
$rs_visa = mysqli_query($con, $query_visa);
var_dump($query_visa);
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM ADD VISA
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
					</div>

					<div class="card-body">
						<div class="list-tempat" id="list-tempat">
							<form>
								<div class="form-group">
									<label style="font-size: 11px;">Visa </label>
									<input class="form-control form-control-sm" list="visa_list" name="LT_visa" id="LT_visa" placeholder="Visa Name" onchange="">
									<datalist id="visa_list">
										<?php

										while ($row_visa = mysqli_fetch_array($rs_visa)) {
											
										?>
											<option data-customvalue="<?php echo $row_visa['id'] ?>" value="<?php echo $row_visa['visa'] . " " . $row_visa['jenis'] . " " . $row_visa['tipe'] . " ".$row_visa['durasi'] ." (".$row_visa['kota']." - ".$row_visa['kota_embessy'].")"?>"></option>
										<?php
										}
										?>
									</datalist>
								</div>

								<button type="button" class="btn btn-primary" id='but_upload' onclick="insert_visa(<?php echo $_POST['id'] ?>)">ADD</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function insert_visa(x) {
		var val = $("#LT_visa").val();
		var visa = $('#visa_list [value="' + val + '"]').data('customvalue');
		// alert(val);
		$.ajax({
			type: "POST",
			url: "insert_add_visa.php",
			data: {
				id: visa,
				ket:val,
				tour:x
			},
			success: function(data) {
				Reloaditin(5, 0, 0);
			}
		});
		// LT_itinerary(0, 0, 0);
	}
</script>
