<?php
include "../site.php";
include "../db=connection.php";
$query2 = "SELECT * FROM  LT_order_list where id='" . $_POST['id'] . "'";
$rs2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($rs2);

?>
<div class="form-group">
	<label for="exampleFormControlSelect1">Staff Handle</label>
	<select class="form-control form-control-sm" id="staff">
		<?php 
		$query_staff = "SELECT * FROM  login_staff order by id ASC";
		$rs_staff = mysqli_query($con, $query_staff);
		while($row_staff = mysqli_fetch_array($rs_staff)){
			?>
			<option value="<?php echo $row_staff['id'] ?>"><?php echo $row_staff['name'] ?></option>
			<?php
		}
		?>
	</select>
</div>
<input type="hidden" name="id" id="id" value="<?php echo $_POST['id'] ?>">