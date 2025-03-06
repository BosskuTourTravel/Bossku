<?php
include "../site.php";
include "../db=connection.php";
$query_cek_visa = "SELECT * FROM Visa_add where  master_id='" . $row['master_id'] . "' && copy_id='" . $row['id'] . "'";
$rs_cek_visa = mysqli_query($con, $query_cek_visa);
$row_cek_visa = mysqli_fetch_array($rs_cek_visa);

?>

<form>
	<div class="form-group">
		<label for="hari">Detail Visa</label>
		<input class="form-control form-control-sm" list="visa_list" name="visa" id="visa" value="<?php echo $row_cek_visa['visa_id'] ?>">
		<datalist id="visa_list">
			<?php
			$query_visa = "SELECT * FROM Visa2  order by visa ASC";
			$rs_visa = mysqli_query($con, $query_visa);
			// $row_visa = mysqli_fetch_array($rs_visa);
			while($row_visa = mysqli_fetch_array($rs_visa)) {
				$detail = $row_visa['visa'] . " " . $row_visa['jenis'] . " " . $row_visa['tipe'] . " " . $row_visa['durasi'] . " From : " . $row_visa['kota'];
			?>
				<option value="<?php echo $row_visa['id'] ?>" label="<?php echo $detail ?>"></option>
			<?php
			}
			?>
		</datalist>
	</div>
	<input type="hidden" name="master" id="master" value="<?php echo $_POST['master'] ?>">
	<input type="hidden" name="copy_id" id="copy_id" value="<?php echo $_POST['id'] ?>">
</form>