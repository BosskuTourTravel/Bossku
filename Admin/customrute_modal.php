<?php
include "../site.php";
include "../db=connection.php";

$arr_tmp = [];
$query_tempat = "SELECT id,negara,city,tempat FROM List_tempat where negara='INDONESIA' OR negara='SINGAPORE' Order by id ASC";
$rs_tempat = mysqli_query($con, $query_tempat);
while ($row_tempat = mysqli_fetch_array($rs_tempat)) {
	array_push($arr_tmp, array(
		"id" => $row_tempat['id'],
		"detail" => $row_tempat['negara'] . " " . $row_tempat['city'] . " " . $row_tempat['tempat'],
	));
}
?>
<div class="row">
	<div class="col-md-6">
		<label for="hari">Rute Day Pertama</label>
		<input type="text" class="form-control" id="rute1" name="rute1" placeholder="">
	</div>
	<div class="col-md-6">
		<label for="hari">List Tempat 1</label>
		<input class="form-control form-control-sm" list="tmp_list11" name="tmp11" id="tmp11">
		<datalist id="tmp_list11">
			<?php
			foreach ($arr_tmp as $val_tmp) {
			?>
				<option value="<?php echo $val_tmp['id'] ?>" label="<?php echo $val_tmp['detail'] ?>"></option>
			<?php
			}
			?>
		</datalist>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
	</div>
	<div class="col-md-6">
		<label for="hari">List Tempat 2</label>
		<input class="form-control form-control-sm" list="tmp_list12" name="tmp12" id="tmp12">
		<datalist id="tmp_list12">
			<?php
			foreach ($arr_tmp as $val_tmp) {
			?>
				<option value="<?php echo $val_tmp['id'] ?>" label="<?php echo $val_tmp['detail'] ?>"></option>
			<?php
			}
			?>
		</datalist>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="hari">Rute Day Terakhir </label>
		<input type="text" class="form-control" id="rute2" name="rute2">
	</div>
	<div class="col-md-6">
		<label for="hari">List Tempat 1</label>
		<input class="form-control form-control-sm" list="tmp_list21" name="tmp21" id="tmp21">
		<datalist id="tmp_list21">
			<?php
			foreach ($arr_tmp as $val_tmp) {
			?>
				<option value="<?php echo $val_tmp['id'] ?>" label="<?php echo $val_tmp['detail'] ?>"></option>
			<?php
			}
			?>
		</datalist>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
	</div>
	<div class="col-md-6">
		<label for="hari">List Tempat 2</label>
		<input class="form-control form-control-sm" list="tmp_list22" name="tmp22" id="tmp22">
		<datalist id="tmp_list22">
			<?php
			foreach ($arr_tmp as $val_tmp) {
			?>
				<option value="<?php echo $val_tmp['id'] ?>" label="<?php echo $val_tmp['detail'] ?>"></option>
			<?php
			}
			?>
		</datalist>
	</div>
</div>
<input type="hidden" name="master" id="master" value="<?php echo $_POST['master'] ?>">
<input type="hidden" name="copy_id" id="copy_id" value="<?php echo $_POST['id'] ?>">