<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$querydata = "SELECT * FROM Itinerary_Cuise WHERE id=".$_POST['id'];
$rsdata = mysqli_query($con,$querydata);
$rowdata = mysqli_fetch_array($rsdata);
// echo $querydata;
$querytourtype = "SELECT * FROM agent";
$rstourtype = mysqli_query($con, $querytourtype);

$querycountry = "SELECT * FROM country";
$rscountry = mysqli_query($con, $querycountry);

$query_continent = "SELECT * FROM continent";
$rs_continent = mysqli_query($con, $query_continent);

$query_kurs = "SELECT * FROM kurs_bank";
$rs_kurs = mysqli_query($con, $query_kurs);
// $link = 'https://drive.google.com/file/d/15RIt-3SHpQkDQUIiH3Af_dadYoIPBPNw/view?usp=sharing';
//  $headers = explode('/', $link);
//  echo $headers[5];
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM EDIT CRUISE DRIVE
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
                                <input type='text' name='tid' id='tid' value='<?php echo $_POST['id'] ?>' hidden>
								<div class="form-group">
									<label for="exampleFormControlInput1">JUDUL ITINERARY</label>
									<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $rowdata['judul'] ?>" placeholder="Masukkan Judul">
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">SUB JUDUL</label>
									<input type="text" class="form-control" id="sub" name="sub" value="<?php echo $rowdata['sub'] ?>" placeholder="Masukkan Sub Judul">
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">NOTES</label>
									<textarea class="form-control" id="notes" name="notes" value="<?php echo $rowdata['notes'] ?>"  rows="3"  placeholder="<?php echo $rowdata['notes'] ?>" ></textarea>
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
        var d = $("input[name=tid]").val();
		$.ajax({
			url: "update_newcruise.php",
			method: "POST",
			asynch: false,
			data: {
				judul: a,
				notes: b,
				sub:c,
                id:d,
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