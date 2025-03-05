<?php
include "../site.php";
include "../db=connection.php";
// var_dump($_POST['change']);
if ($_POST['change'] == '1') {
	// var_dump("pppp ".$_POST['rent']);
?>
	<div style="text-align: center; font-weight: bold;">Transport tidak Tersedia!!!</div>
<?php
} else {
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
	$row_sel_modal =  mysqli_fetch_array($rs_sel_modal);

	$query_trans2 = "SELECT * FROM Transport_new where id=" . $row_sel_modal['trans_type'];
	$rs_trans2 = mysqli_query($con, $query_trans2);
	$row_trans2 = mysqli_fetch_array($rs_trans2);
	
	$query_trans3 = "SELECT * FROM Transport_new where continent='" . $row_trans2['continent'] . "' && country='" . $row_trans2['country'] . "' && city='" . $row_trans2['city'] . "' && trans_type='" . $_POST['trans'] . "'";
	$rs_trans3 = mysqli_query($con, $query_trans3);
	?>
	<div class="form-group">
		<select class="form-control form-control-sm" id="sel_lt" name="sel_lt">
		<option value="" selected>Pilih Land Transport</option>
			<?php 
				while ($row_trans3 = mysqli_fetch_array($rs_trans3)) {
		
					$query_agent = "SELECT * FROM agent where id='" . $row_trans3['agent'] . "'";
					$rs_agent = mysqli_query($con, $query_agent);
					$row_agent = mysqli_fetch_array($rs_agent);
					$p = $_POST['rent'];
					?>
					<option value="<?php echo $row_trans3['id'] ?>"><?php echo $row_agent['company']." | ".$row_trans3['periode']." | ".$_POST['rent']." | Rp. ".number_format($row_trans3[$p], 0, ",", ".") ?></option>
					<?php							
				}
			?>
		</select>
	</div>
	<input type="hidden" id="loop_trans" name="loop_trans" value="<?php echo $x ?>">
	<input type="hidden" id="rent" name="rent" value="<?php echo $p ?>">
	<input type="hidden" id="hari_trans" name="hari_trans" value="<?php echo $_POST['id'] ?>">
	<input type="hidden" id="trans_type" name="trans_type" value="<?php echo $_POST['trans'] ?>">
<?php
}
?>