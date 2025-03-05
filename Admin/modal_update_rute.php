<?php
include "../site.php";
include "../db=connection.php";

$query_rute = "SELECT * FROM  LT_add_hari WHERE id='" . $_POST['id'] . "'";
$rs_rute = mysqli_query($con, $query_rute);
$row_rute = mysqli_fetch_array($rs_rute);
// var_dump($row_rute['rute']);


?>
<div class="row">
	<div class="col-md-6">
		<label for="hari">day </label>
		<input type="text" class="form-control" id="hari_rute" name="hari_rute" value="<?php echo $row_rute['hari'] ?>">
	</div>
	<div class="col-md-6">
		<label>Rute</label>
		<input type="text" class="form-control" id="rute_name" name="rute_name" value="<?php echo $row_rute['rute'] ?>">
	</div>
</div>
<input type="hidden" name="id_rute" id="id_rute" value="<?php echo $_POST['id'] ?>">
<input type="hidden" name="copy_id" id="copy_id" value="<?php echo $_POST['copy'] ?>">
<input type="hidden" name="master_id" id="master_id" value="<?php echo $row_rute['master_id'] ?>">