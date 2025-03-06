<?php
include "../site.php";
include "../db=connection.php";
$query = "SELECT * FROM  paket_tour_online where id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
?>
<div class="form-group">
	<label for="exampleFormControlSelect1">Category Paket Tour</label>
	<select class="form-control form-control-sm" id="promo">
		<?php
		if ($row['promo'] != "") {

			if ($row['promo'] == "p_ls") {
				$detail = "Low Seasons";
			} else if ($row['promo'] == "p_ny") {
				$detail = "New Years";
			} else if ($row['promo'] == "p_lebaran") {
				$detail = "Lebaran";
			} else if ($row['promo'] == "p_sh") {
				$detail = "School Holiday";
			} else {
				$detail = "Undefined";
			}
		?>
			<option value="<?php echo $row['promo'] ?>"><?php echo $detail ?></option>
		<?php
		}
		?>
		<option value="p_ls">Low Seasons</option>
		<option value="p_ny">New Years</option>
		<option value="p_lebaran">Lebaran</option>
		<option value="p_sh">School Holiday</option>
	</select>
</div>
<input type="hidden" name="id" id="id" value="<?php echo $_POST['id'] ?>">