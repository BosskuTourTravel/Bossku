<!-- <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script> -->
<!-- <link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script> -->
<?php
include "../site.php";
include "../db=connection.php";

$querytourtype = "SELECT * FROM agent";
$rstourtype = mysqli_query($con, $querytourtype);

$querycountry = "SELECT * FROM country";
$rscountry = mysqli_query($con, $querycountry);

$query_continent = "SELECT * FROM continent";
$rs_continent = mysqli_query($con, $query_continent);

$query_kurs = "SELECT * FROM kurs_bank";
$rs_kurs = mysqli_query($con, $query_kurs);

$query_ship = "SELECT * FROM Cruise_ship";
$rs_ship = mysqli_query($con, $query_ship);

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
					</div>
					<div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleFormControlInput1">Nama Tour</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Tour">
							</div>
							<div class="form-group">
								<label for="exampleFormControlInput1">City</label>
								<input type="text" class="form-control" id="city" name="city" placeholder="Masukkan Kota Tour">
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Include</label>
								<textarea id="include" name="include"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Exclude</label>
								<textarea id="exclude" name="exclude"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Privacy & Policy</label>
								<textarea id="policy" name="policy"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Remarks</label>
								<textarea id="remarks" name="remarks"></textarea>
							</div>
							<button type="button" class="btn btn-primary" id='but_upload'>CREATE</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#include').summernote();
		$('#exclude').summernote();
		$('#policy').summernote();
		$('#remarks').summernote();
		$("#but_upload").click(function() {
			var fd = new FormData();
			var include = $("textarea[name=include]").val();
			var exclude = $("textarea[name=exclude]").val();
			var policy = $("textarea[name=policy]").val();
			var remarks = $("textarea[name=remarks]").val();
			var nama = $("input[name=nama]").val();
			var city = $("input[name=nama]").val();

			fd.append('include', include);
			fd.append('exclude', exclude);
			fd.append('policy', policy);
			fd.append('remarks', remarks);
			fd.append('nama', nama);
			fd.append('city', city);
			// alert(include);

			$.ajax({
				url: 'insert_main_tour.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response == "success") {
						//  alert(response);
						 reloadLantour(0, 0, 0);
					} else {
						alert(response);
					}
				},
			});
		});
	});
</script>
