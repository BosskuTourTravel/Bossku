<?php
include "../site.php";
include "../db=connection.php";
if ($_POST['cek'] == '1') {
?>
	<div class="form-group">
		<label for="exampleFormControlSelect1">Category LandTour</label>
		<select class="form-control form-control-sm" id="staff">
			<?php
			$query_ct3 = "SELECT * FROM LT_add_Category where tour_id='" . $_POST['id'] . "'";
			$rs_ct3 = mysqli_query($con, $query_ct3);
			$row_ct3 = mysqli_fetch_array($rs_ct3);

			$query_ct_val = "SELECT * FROM  LT_Category where id=".$row_ct3['category'];
			$rs_ct_val = mysqli_query($con, $query_ct_val);
			$row_ct_val = mysqli_fetch_array($rs_ct_val);
			if($row_ct_val['id'] !=""){
				?>
				<option value="<?php echo $row_ct_val['id'] ?>" selected><?php echo $row_ct_val['nama'] ?></option>
				<?php
			}
			$query_staff = "SELECT * FROM  LT_Category order by id ASC";
			$rs_staff = mysqli_query($con, $query_staff);
			while ($row_staff = mysqli_fetch_array($rs_staff)) {
			?>
				<option value="<?php echo $row_staff['id'] ?>"><?php echo $row_staff['nama'] ?></option>
			<?php
			}
			?>
		</select>
	</div>
<?php
} else {
?>
	<div class="form-group">
		<label for="exampleFormControlSelect1">Category LandTour</label>
		<select class="form-control form-control-sm" id="staff">
			<?php
			$query_staff = "SELECT * FROM  LT_Category order by id ASC";
			$rs_staff = mysqli_query($con, $query_staff);
			while ($row_staff = mysqli_fetch_array($rs_staff)) {
			?>
				<option value="<?php echo $row_staff['id'] ?>"><?php echo $row_staff['nama'] ?></option>
			<?php
			}
			?>
		</select>
	</div>
<?php
}
?>

<input type="hidden" name="id" id="id" value="<?php echo $_POST['id'] ?>">
<input type="hidden" name="cek" id="cek" value="<?php echo $_POST['cek'] ?>">