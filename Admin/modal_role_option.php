<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM login_staff where id=".$_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

$query_lvl2 = "SELECT * FROM level where id=".$row['type'];
$rs_lvl2 = mysqli_query($con, $query_lvl2);
$row_lvl2 = mysqli_fetch_array($rs_lvl2)

?>
<div>
	<div style="text-align: center;"><?php echo $row['name'] ?></div>
	<div class="form-group">
		<label>Pilih Role Type</label>
		<select class="form-control form-control-sm" id="item" name="item">
		<option value="<?php echo $row_lvl2['id'] ?>" selected><?php echo $row_lvl2['level'] ?></option>
			<?php
			$query_lvl = "SELECT * FROM level order by id ASC ";
			$rs_lvl = mysqli_query($con, $query_lvl);
			while ($row_lvl = mysqli_fetch_array($rs_lvl)) {
			?>
				<option value="<?php echo $row_lvl['id'] ?>"><?php echo $row_lvl['level'] ?></option>
			<?php
			}
			?>
		</select>
	</div>
	<input type="hidden" id="id" name="id" value="<?php echo $_POST['id'] ?>">
</div>