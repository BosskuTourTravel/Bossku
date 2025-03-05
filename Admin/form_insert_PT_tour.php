<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";


$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
$rs_LTNx = mysqli_query($con, $query_LTNx);

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$hari = $row_data['hari'];
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12' >
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM INSERT PT DRIVE
				</div>
			</div>
			<div class="container" style="padding: 20px;">
				<div class="card">
					<div class="card-header">
						<div class="card-body">
							<div>
								<form mehtod="post" id="import_drive">
									<label>File input PT Drive</label>
									<div class="form-group">
										<input type="file" name="excel_drive" id="excel_drive">
									</div>
								</form>
								<div id="result_drive" style="padding-bottom: 20px;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#excel_drive').change(function() {
				$('#import_drive').submit();
			});
			$('#import_drive').on('submit', function(event) {
				event.preventDefault();
				$.ajax({
					url: "upload_PT_drive.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						$('#result_drive').html(data);
						$('#excel_drive').val('');
					}
				});
			});
		});
	</script>