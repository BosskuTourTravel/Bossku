<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM  checkbox_include2 order by id ASC ";
$rs = mysqli_query($con, $query);

$query_cek2 = "SELECT * FROM LT_include_checkbox where tour_id='" . $_POST['id'] . "' && master_id='" . $_POST['master'] . "'";
$rs_cek2 = mysqli_query($con, $query_cek2);
$row_cek2 = mysqli_fetch_array($rs_cek2);
$in_chck = explode(",", $row_cek2['chck']);

?>
<div class="row">
	<?php
	$no = 1;
	while ($row = mysqli_fetch_array($rs)) {
		if ($row['id'] == '9' or $row['id'] == '10' or $row['id'] == '11' or $row['id'] == '12') {
	?>
			<div class="col-md-6">
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<?php
							if (in_array($row['id'], $in_chck)) {
							?>
								<input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?>" onclick="add_chck(<?php echo $row['id'] ?>)" checked>
							<?php
							} else {
							?>
								<input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?>" onclick="add_chck(<?php echo $row['id'] ?>)">
							<?php
							}
							?>
						</div>
					</div>
					<input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $no . ") " . $row['nama'] ?>" disabled style="background-color: greenyellow;">
				</div>
			</div>
		<?php
		} else {
		?>
			<div class="col-md-6">
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<?php
							if (in_array($row['id'], $in_chck)) {
							?>
								<input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include" value="<?php echo $row['id'] ?>" checked>
							<?php
							} else {
							?>
								<input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include" value="<?php echo $row['id'] ?>">
							<?php
							}
							?>

						</div>
					</div>
					<input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $no . ") " . $row['nama'] ?>" disabled>
				</div>
			</div>
	<?php
		}
		$no++;
	}
	?>
	<div style="padding: 20px;"><a class="btn btn-success" onclick="add_chck_val(<?php echo $_POST['id'] ?>,<?php echo $_POST['master'] ?>)" data-dismiss="modal">Submit</a></div>
</div>
<script>
	function add_chck_val(x, y) {
		var arr_chck = [];
		$('input[name="include"]:checked').each(function() {
			// console.log(this.value);
			arr_chck.push(this.value);
		});
		var value = arr_chck.toString();
		$.ajax({
			url: "insert_chck_val.php",
			method: "POST",
			asynch: false,
			data: {
				tour_id: x,
				master_id: y,
				chck: value
			},
			success: function(data) {
				alert(data);
			}
		});
	}
</script>