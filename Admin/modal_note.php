<?php
include "../site.php";
include "../db=connection.php";
if ($_POST['id'] != "") {
	$query_note = "SELECT note FROM  LT_itinerary2 where id='" . $_POST['id'] . "'";
	$rs_note = mysqli_query($con, $query_note);
	$row_note = mysqli_fetch_array($rs_note);
?>
	<div class="form-group">
		<label>Note</label>
		<textarea id="note" name="note"><?php echo $row_note['note'] ?></textarea>
	</div>
	<input type="hidden" id="id" name="id" value="<?php echo  $_POST['id'] ?>">
<?php
}
?>
<script>
	$(document).ready(function() {
		$('#note').summernote();
	});
</script>