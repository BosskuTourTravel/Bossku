<?php
include "../site.php";
include "../db=connection.php";
$query_tips = "SELECT negara FROM tips_negara WHERE master_id='" . $_POST['master'] . "' && copy_id='" . $_POST['id'] . "'";
$rs_tips = mysqli_query($con, $query_tips);
$row_tips = mysqli_fetch_array($rs_tips);
?>
<form>
	<div class="form-group">
		<label for="hari">NEGARA</label>
		<input type="text" class="form-control" id="negara" name="negara" placeholder="NEGARA 1 - NEGARA 2 - NEGARA 3" value="<?php echo $row_tips['negara'] ?>" autocomplete="off">
	</div>
	<input type="hidden" name="master" id="master" value="<?php echo $_POST['master'] ?>">
	<input type="hidden" name="copy_id" id="copy_id" value="<?php echo $_POST['id'] ?>">
</form>
