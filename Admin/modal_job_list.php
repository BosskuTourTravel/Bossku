<?php
include "../site.php";
include "../db=connection.php";

?>
<div class="form-group">
	<label>Pilih Staff</label>
	<select class="form-control form-control-sm" id="item" name="item">
		<?php
		$query = "SELECT * FROM login_staff  order by id ASC";
		$rs = mysqli_query($con, $query);
		while ($row = mysqli_fetch_array($rs)) {
		?>
			<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
		<?php
		}
		?>
	</select>
</div>
<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_job(<?php echo $_POST['id'] ?>)">Add</button>