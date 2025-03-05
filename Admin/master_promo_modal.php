<?php
include "../site.php";
include "../db=connection.php";
$query = "SELECT * FROM  LT_itinerary2 where id =".$_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
?>
<div class="form-group">
	<label for="exampleFormControlSelect1">Pilih Pax</label>
	<select class="form-control" id="pax" name="pax">
		<option value="">Pilih Detail Pax</option>
		<?php
		$query_itin = "SELECT id,agent_twn,pax,pax_u,pax_b FROM LT_itinnew WHERE kode='" . $row['landtour'] . "' order by pax ASC";
		$rs_itin = mysqli_query($con, $query_itin);
		while ($row_itin = mysqli_fetch_array($rs_itin)) {

			$sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
			$rs_profit = mysqli_query($con, $sql_profit);
			$row_profit = mysqli_fetch_array($rs_profit);

			$pr = 0;
			$dp = "";
			if ($row_profit['id'] != "") {
				$pr = $row_profit['profit'];
			} else {
				$pr = 5;
			}
			$atwn =  ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'];

			$pax = $row_itin['pax'];
			$detailj = "Pax : " . $pax . " - " . $row_itin['pax_u'] . " [" . $row_itin['pax_b'] . "] | Twin : Rp" . number_format($atwn, 0, ",", ".");
		?>
			<option value="<?php echo $row_itin['id'] ?>"><?php echo $detailj ?></option>
		<?php
		}
		?>

	</select>
	<input type="hidden" name="id" id="id" value="<?php echo $_POST['id'] ?>">
</div>