<?php
include "../site.php";
include "../db=connection.php";

?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">DAY - <?php echo $_POST['id'] ?></li>
		<li class="breadcrumb-item" aria-current="page"><?php echo $_POST['trans'] ?></li>
	</ol>
</nav>
<?php
$query_sel_modal = "SELECT * FROM  LT_selected_trans where day ='" . $_POST['id'] . "' && tour_id='" . $_POST['tour_id'] . "'";
$rs_sel_modal = mysqli_query($con, $query_sel_modal);
$x = 1;
while ($row_sel_modal =  mysqli_fetch_array($rs_sel_modal)) {
?>
	<div class="form-trans">
		<div class="row" style="padding-bottom: 5px;">
			<div class="col">
				<?php if ($x == '1') {
					echo "<label>City</label>";
				} ?>
				<input class="form-control form-control-sm" list="city_list<?php echo $x ?>" name="city<?php echo $x ?>" id="city<?php echo $x ?>" autocomplete="off">
				<datalist id="city_list<?php echo $x ?>">
					<?php
					$query_city = "SELECT name FROM city Order by name ASC";
					$rs_city = mysqli_query($con, $query_city);
					while ($row_city = mysqli_fetch_array($rs_city)) {
					?>
						<option value="<?php echo $row_city['name'] ?>"></option>
					<?php
					}
					?>
				</datalist>
			</div>
			<div class="col">
				<?php if ($x == '1') {
					echo "<label>Agent Name</label>";
				} ?>
				<input class="form-control form-control-sm" type="text" name="agent<?php echo $x ?>" id="agent<?php echo $x ?>">
			</div>
			<div class="col">
				<?php if ($x == '1') {
					echo "<label>Season</label>";
				} ?>

				<input class="form-control form-control-sm" type="text" name="season<?php echo $x ?>" id="season<?php echo $x ?>">
			</div>
			<div class="col">
				<?php if ($x == '1') {
					echo "<label>Rent Type</label>";
				} ?>
				<select class="form-control form-control-sm" id="rent<?php echo $x ?>" name="rent<?php echo $x ?>">
					<option value="oneway" selected>One Way</option>
					<option value="twoway">Two Way </option>
					<option value="hd1">Half Day 1</option>
					<option value="hd2">Half Day 2</option>
					<option value="fd1">Full Day 1</option>
					<option value="fd2">Full Day 2</option>
					<option value="kaisoda">Kaisoda</option>
					<option value="luarkota">Luar Kota</option>
				</select>
			</div>
			<div class="col">
				<?php if ($x == '1') {
					echo "<label>Capacity</label>";
				} ?>

				<input class="form-control form-control-sm" type="text" name="capacity<?php echo $x ?>" id="capacity<?php echo $x ?>">
			</div>
			<div class="col">
				<?php if ($x == '1') {
					echo "<label>Price</label>";
				} ?>

				<input class="form-control form-control-sm" type="text" name="price<?php echo $x ?>" id="price<?php echo $x ?>">
			</div>
		</div>
	</div>
<?php
	$x++;
}
?>
<input type="hidden" id="loop_trans" name="loop_trans" value="<?php echo $x ?>">
<input type="hidden" id="hari_trans" name="hari_trans" value="<?php echo $_POST['id'] ?>">
<input type="hidden" id="trans_type" name="trans_type" value="<?php echo $_POST['trans'] ?>">