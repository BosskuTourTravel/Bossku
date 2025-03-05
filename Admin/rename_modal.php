<?php
include "../site.php";
include "../db=connection.php";

if ($_POST['id'] != "") {
	$query_grub2 = "SELECT * FROM LTP_grub_flight where id=".$_POST['id'];
	$rs_grub2 = mysqli_query($con, $query_grub2);
	$row_grub2 = mysqli_fetch_array($rs_grub2);
?>
	<form>
		<div class="form-group">
			<label for="">Name Group</label>
			<input type="text" class="form-control form-control-sm" id="grub_rename" name="grub_rename" value="<?php echo $row_grub2['grub_name'] ?>">
		</div>
		<input type="hidden" id="id" name="id" value="<?php echo $row_grub2['id'] ?>">
	</form>
<?php
}

?>