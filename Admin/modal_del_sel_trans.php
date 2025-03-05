<?php
include "../site.php";
include "../db=connection.php";
// var_dump($_POST['change']);
?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">DAY - <?php echo $_POST['id'] ?></li>
	</ol>
</nav>
<table class="table table-striped table-sm" style="font-size: 12px;">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">City</th>
			<th scope="col">Agent</th>
			<th scope="col">Transport Type</th>
			<th scope="col">Rent Type</th>
			<th scope="col">Season</th>
			<th scope="col">Capacity</th>
			<th scope="col">Price</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$query_val = "SELECT * FROM  LT_selected_trans where day ='" . $_POST['id'] . "' && tour_id='" . $_POST['tour_id'] . "'";
		var_dump($query_val);
		$rs_val = mysqli_query($con, $query_val);
		$no = 1;
		$gt = 0;
		while ($row_val = mysqli_fetch_array($rs_val)) {

			$query_trans2 = "SELECT * FROM Transport_new where id=" . $row_val['trans_type'];
			$rs_trans2 = mysqli_query($con, $query_trans2);
			$row_trans2 = mysqli_fetch_array($rs_trans2);

			$query_agents = "SELECT * FROM agent where id='" . $row_trans2['agent'] . "'";
			$rs_agents = mysqli_query($con, $query_agents);
			$row_agents = mysqli_fetch_array($rs_agents);
			$p = $row_val['rent_type'];
			if ($pp <= $row_trans2['seat']) {
				$pp = $row_trans2['seat'];
			}
		?>
			<tr style="text-align: left;">
				<td><?php echo $no ?></td>
				<td><?php echo $row_trans2['city'] ?></td>
				<td><?php echo $row_agents['company'] ?></td>
				<td><?php echo $row_trans2['trans_type'] ?></td>
				<td><?php echo $row_val['rent_type'] ?></td>
				<td><?php echo $row_trans2['periode'] ?></td>
				<td><?php echo $row_trans2['seat'] ?></td>
				<td><?php echo "IDR " . number_format($row_trans2[$p], 0, ",", ".")  ?></td>
				<td>
					<div class="form-check">
						<input class="form-check-input position-static" type="checkbox" id="val_id<?php echo $_POST['tour_id']?>" value="<?php echo $row_val['id'] ?>" >
					</div>
				</td>
			</tr>
		<?php
			$gt = $gt + $row_trans2[$p];
			$no++;
		}
		?>

	</tbody>
</table>