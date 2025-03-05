<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total_baru.php";

$query_data = "SELECT master_id,id FROM  LTSUB_itin where id=" . $_POST['itin'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);


if ($_POST['id'] == '32') {
	$data_tps = array(
		"master_id" => $row_data['master_id'],
		"copy_id" => $row_data['id'],
		"check_id" => $_POST['id'],
		"flight" => $_POST['flight'],
		"date" => $_POST['date'],
		"tl_pax" => $_POST['tl_pax']
	);

	$show_tps = get_total($data_tps);
	$result_tps = json_decode($show_tps, true);
	// $grandtotal = $grandtotal + $result_tps['adt'];
?>
	<div>
		<table class="table table-sm table-bordered">
			<thead style="background-color: salmon;">
				<tr>
					<th scope="col">FEE TL</th>
					<th scope="col">Calculation</th>
					<th scope="col">Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$gt_fee_tl = 0;
				foreach ($result_tps['breakdown'] as $val_br) {
					if ($val_br['id'] == '1') {
						$gt_fee_tl = $gt_fee_tl + $val_br['value'];
				?>
						<tr>
							<td>TL FEE PER DAY</td>
							<td><?php echo number_format($val_br['current'], 0, ",", ".") . " * " . $val_br['hari'] ?></td>
							<td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
						</tr>
					<?php
					} else if ($val_br['id'] == "2") {
						$gt_fee_tl = $gt_fee_tl + $val_br['value'];
					?>
						<tr>
							<td>TL MEAL</td>
							<td><?php echo number_format($val_br['current'], 0, ",", ".") . " * 3 * " . $val_br['hari'] ?></td>
							<td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
						</tr>
					<?php
					} else if ($val_br['id'] == '3') {
						$gt_fee_tl = $gt_fee_tl + $val_br['value'];
					?>
						<tr>
							<td>TL VOUCHER TLPN</td>
							<td><?php echo number_format($val_br['current'], 0, ",", ".") . " * 1" ?></td>
							<td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
						</tr>
					<?php
					} else if ($val_br['id'] == '4') {
						$gt_fee_tl = $gt_fee_tl + $val_br['value'];
					?>
						<tr>
							<td>TL SFEE / DAY</td>
							<td><?php echo number_format($val_br['current'], 0, ",", ".") . " * " . $val_br['hari'] ?></td>
							<td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
						</tr>
				<?php
					}
				}
				?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="2">Total</th>
					<th><?php echo number_format($gt_fee_tl, 0, ",", ".") ?></th>
				</tr>
			</tfoot>
		</table>
		<div style="padding: 10px;"></div>
		<table class="table table-sm table-bordered">
			<thead style="background-color: salmon;">
				<tr>
					<th scope="col">COST TL</th>
					<th scope="col">Calculation</th>
					<th scope="col">Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$gt_cost_tl = 0;
				foreach ($result_tps['break_cost_tl'] as $val_cost_tl) {
					if ($val_cost_tl['id'] == '1') {
						$gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'] + $val_cost_tl['meal'] + $val_cost_tl['tax'];
				?>
						<tr>
							<td>FLIGHT</td>
							<td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
						</tr>
						<tr>
							<td>FLIGHT MEAL</td>
							<td><?php echo number_format($val_cost_tl['meal'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['meal'], 0, ",", ".") ?></td>
						</tr>
						<tr>
							<td>FLIGHT TAX</td>
							<td><?php echo number_format($val_cost_tl['tax'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['tax'], 0, ",", ".") ?></td>
						</tr>
					<?php
					} else if ($val_cost_tl['id'] == '2') {
						$gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
					?>
						<tr>
							<td>LANDTOUR</td>
							<td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
						</tr>
					<?php

					} else if ($val_cost_tl['id'] == '3') {
						$gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
					?>
						<tr>
							<td>LANDTOUR SINGLE SUP</td>
							<td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
						</tr>
					<?php
					} else if ($val_cost_tl['id'] == '4') {
						$gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
					?>
						<tr>
							<td>TRAIN</td>
							<td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
						</tr>
					<?php

					} else if ($val_cost_tl['id'] == '5') {
						$gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
					?>

						<tr>
							<td>FERRY</td>
							<td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
							<td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
						</tr>
					<?php
					} else {
					}
					?>

				<?php
				}
				?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="2">Total</th>
					<th><?php echo number_format($gt_cost_tl, 0, ",", ".") ?></th>
				</tr>
			</tfoot>
		</table>
		<div style="padding: 10px;"></div>
		<table class="table table-sm table-bordered">
			<thead style="background-color: salmon;">
				<tr>
					<th scope="col">FEE TL COVERY</th>
					<th scope="col">Calculation</th>
					<th scope="col">Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$gt_ft_cover = 0;
				foreach ($result_tps['feetl_cover'] as $val_ft_cover) {
					$gt_ft_cover = $gt_ft_cover + $val_ft_cover['value'];
				?>
					<tr>
						<td>TL MEAL</td>
						<td><?php echo $val_ft_cover['detail'] . "* -1" ?></td>
						<td><?php echo number_format($val_ft_cover['value'], 0, ",", ".") ?></td>
					</tr>
				<?php
				}
				?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="2">Total</th>
					<th><?php echo number_format($gt_ft_cover, 0, ",", ".") ?></th>
				</tr>
			</tfoot>
		</table>
		<div style="padding: 10px;"></div>
		<table class="table table-sm table-bordered">
			<thead style="background-color: salmon;">
				<tr>
					<th scope="col">COST TL COVERY</th>
					<th scope="col">Calculation</th>
					<th scope="col">Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$gt_ct_cover = 0;
				foreach ($result_tps['costtl_cover'] as $val_ct_cover) {
					$gt_ct_cover = $val_ct_cover['value'];
				?>
					<tr>
						<td>LANDTOUR</td>
						<td><?php echo  number_format($val_ct_cover['current'], 0, ",", ".") . " * " . $val_ct_cover['pax_cover'] ?></td>
						<td><?php echo number_format($val_ct_cover['value'], 0, ",", ".") ?></td>
					</tr>
				<?php
				}
				?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="2">Total</th>
					<th><?php echo number_format($gt_ct_cover, 0, ",", ".") ?></th>
				</tr>
			</tfoot>
		</table>
		<div style="padding: 10px;"></div>
		<table class="table table-sm table-bordered">
			<thead style="background-color: salmon;">
				<tr>
					<th scope="col">Grandtotal /pax</th>
					<th scope="col">Calculation</th>
					<th scope="col">Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$grand = 0;
				foreach ($result_tps['grand'] as $val_grand) {
					$grand = $val_grand['value'];
				?>
					<tr>
						<td>GRAND TOTAL</td>
						<td><?php echo number_format($val_grand['current'], 0, ",", ".") . " / " . $val_grand['pax'] ?></td>
						<td><?php echo number_format($val_grand['value'], 0, ",", ".") ?></td>
					</tr>
				<?php
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="2">Total</th>
					<th><?php echo number_format($grand, 0, ",", ".") ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
<?php
}
?>