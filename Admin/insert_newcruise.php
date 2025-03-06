<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
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
								<!-- <label for="exampleFormControlFile1">Masukkan File Excel</label>
								<input type="file" class="form-control-file" id="exampleFormControlFile1"> -->
								<div class="form-group">
									<label>NAMA KAPAL</label>
									<select class="form-control" name="ship" id="ship">
										<?php
										while($row_ship = mysqli_fetch_array($rs_ship)){
											?>
										<option value="<?php echo $row_ship['id'] ?>"><?php echo $row_ship['name'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">JUDUL ITINERARY</label>
									<input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul">
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">SUB JUDUL</label>
									<input type="text" class="form-control" id="sub" name="sub" placeholder="Masukkan Sub Judul">
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">NOTES</label>
									<textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" id='but_upload'>CREATE</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#but_upload").click(function() {
		var a = $("input[name=judul]").val();
		var b = $("textarea[name=notes]").val();
		var c = $("input[name=sub]").val();
		var d = document.getElementById("ship").options[document.getElementById("ship").selectedIndex].value;
		$.ajax({
			url: "insertdata_cruisenew.php",
			method: "POST",
			asynch: false,
			data: {
				judul: a,
				notes: b,
				sub: c,
				ship:d
			},
			success: function(data) {
				if (data == 'success') {
					alert(data);
					reloadManual(10, 0, 0);
				}
			}
		});
	});
</script>