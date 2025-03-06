<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";


$query = "SELECT * FROM  Prev_makeLT where id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
$val_data = json_decode($row['data'], true);
$json_day = $val_data['day'];

// var_dump($query_visa);
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM ADD TIPS GUIDE
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
						<?php echo $row['nama'] ?>
					</div>

					<div class="card-body">
						<div class="list-tempat" id="list-tempat">
							<form>
								<?php
								$h = 1;
								$n = 1;
								foreach ($json_day as $loop_day) {
								?>
									<div class="row">
										<div class="col-md-12">
											Day <?php echo $h ?> : <u><b><?php echo $loop_day['rute'] ?></b></u>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<label style="font-size: 11px;">Tips TL</label>
											<select class="form-control form-control-sm" name="tips_tl<?php echo $n ?>" id="tips_tl<?php echo $n ?>">
												<option value="">Tidak ada</option>
												<?php
												$query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
												$rs_tips = mysqli_query($con, $query_tips);
												while ($row_tips = mysqli_fetch_array($rs_tips)) {
												?>
													<option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
												<?php
												}
												?>

											</select>
										</div>
										<div class="col-md-2">
											<label style="font-size: 11px;">Tips Guide</label>
											<select class="form-control form-control-sm" name="tips_guide<?php echo $n ?>" id="tips_guide<?php echo $n ?>">
												<option value="">Tidak ada</option>
												<?php
												$query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
												$rs_tips = mysqli_query($con, $query_tips);
												while ($row_tips = mysqli_fetch_array($rs_tips)) {
												?>
													<option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label style="font-size: 11px;">Tips Assistant</label>
											<select class="form-control form-control-sm" name="tips_ass<?php echo $n ?>" id="tips_ass<?php echo $n ?>">
												<option value="">Tidak ada</option>
												<?php
												$query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
												$rs_tips = mysqli_query($con, $query_tips);
												while ($row_tips = mysqli_fetch_array($rs_tips)) {
												?>
													<option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label style="font-size: 11px;">Tips Driver</label>
											<select class="form-control form-control-sm" name="tips_driver<?php echo $n ?>" id="tips_driver<?php echo $n ?>">
												<option value="">Tidak ada</option>
												<?php
												$query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
												$rs_tips = mysqli_query($con, $query_tips);
												while ($row_tips = mysqli_fetch_array($rs_tips)) {
												?>
													<option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label style="font-size: 11px;">Tips Porter</label>
											<select class="form-control form-control-sm" name="tips_porter<?php echo $n ?>" id="tips_porter<?php echo $n ?>">
												<option value="">Tidak ada</option>
												<?php
												$query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
												$rs_tips = mysqli_query($con, $query_tips);
												while ($row_tips = mysqli_fetch_array($rs_tips)) {
												?>
													<option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="col-md-2">
											<label style="font-size: 11px;">Tips Restaurant</label>
											<select class="form-control form-control-sm" name="tips_res<?php echo $n ?>" id="tips_res<?php echo $n ?>">
												<option value="">Tidak ada</option>
												<?php
												$query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
												$rs_tips = mysqli_query($con, $query_tips);
												while ($row_tips = mysqli_fetch_array($rs_tips)) {
												?>
													<option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
												<?php
												}
												?>
											</select>
										</div>

									</div>
									<div style="padding-top: 20px;"></div>
								<?php
									$h++;
									$n++;
								}
								?>
								<button type="button" class="btn btn-primary" id='but_upload' onclick="insert_tips(<?php echo $_POST['id'] ?>,<?php echo $n ?>)">ADD</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function insert_tips(x, y) {
		// alert(y);
		var arr_tl = [];
		for (var i = 1; i < y; i++) {
			var tl = document.getElementById("tips_tl" + i).options[document.getElementById("tips_tl" + i).selectedIndex].value;
			var guide = document.getElementById("tips_guide" + i).options[document.getElementById("tips_guide" + i).selectedIndex].value;
			var ass = document.getElementById("tips_ass" + i).options[document.getElementById("tips_ass" + i).selectedIndex].value;
			var driver = document.getElementById("tips_driver" + i).options[document.getElementById("tips_driver" + i).selectedIndex].value;
			var porter = document.getElementById("tips_porter" + i).options[document.getElementById("tips_porter" + i).selectedIndex].value;
			var res = document.getElementById("tips_res" + i).options[document.getElementById("tips_res" + i).selectedIndex].value;
				// alert("on");
				arr_tl.push({hari:i,tl:tl,guide:guide,ass:ass,driver:driver,porter:porter,res:res});
		}
		console.log(arr_tl);
		$.ajax({
			type: "POST",
			url: "insert_add_Tipsguide.php",
			data: {
				data: arr_tl,
				tour: x
			},

			success: function(data) {
				Reloaditin(5, 0, 0);
			}
		});

	}
</script>