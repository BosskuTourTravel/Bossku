<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
// var_dump($_POST['id']);
// $link = 'https://drive.google.com/file/d/15RIt-3SHpQkDQUIiH3Af_dadYoIPBPNw/view?usp=sharing';
//  $headers = explode('/', $link);
//  echo $headers[5];
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM INSERT CRUISE DRIVE
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
						<button type="button" class="btn btn-primary" onclick="window.location.href='master_excel.xls';">
							Download Template Excel
						</button>
						<div class='card-tools'>
								<div class='input-group-append'>
									<button type='submit' onclick="reloadcruise(0,<?php echo $_POST['id'] ?>,0)" class='btn btn-primary'><i class='fa fa-arrow-left'></i></button>
								</div>
						</div>
					</div>

					<div class="card-body">
						<!-- <form role="form" method="post" action="" name="form" id="form" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputFile">File input</label>
								<div class="input-group">
									<div class="custom-file">
										<input name="fileToUpload" id="fileToUpload" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
									</div>
								</div>
								<button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
							</div>
						</form> -->
						<form mehtod="post" id="export_excel">
							<input type="file" name="excel_file" id="excel_file" />
							<input name='id' id='id' value="<?php echo $_POST['id'] ?>" type='hidden'>
						</form>
						<br />
						<br />
						<div id="result">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <script>
	$(document).ready(function() {
		$("#but_upload").click(function() {
			var fd = new FormData();
			var files = $('#fileToUpload')[0].files[0];
			fd.append('fileToUpload', files);
			if ($('#fileToUpload')[0].files.length < 1) {
				fd.append('code', 0);
			} else {
				fd.append('code', 1);
			}
			$.ajax({
				url: 'upload_Activitycruise.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response == "success") {
						alert(response);
						reloadcruise(0, 0, 0)
					}

				},
			});
		});
	});
</script> -->
<script>
	$(document).ready(function() {
		$('#excel_file').change(function() {
			$('#export_excel').submit();
		});
		$('#export_excel').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: "export.php",
				method: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function(data) {
					$('#result').html(data);
					$('#excel_file').val('');
				}
			});
		});
	});
</script>