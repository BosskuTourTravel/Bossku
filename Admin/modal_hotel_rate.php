<?php
include "../site.php";
include "../db=connection.php";
include "Api_get_hotel_lt_range.php";


$query_dh = "SELECT * FROM hotel_lt where id='" . $_POST['id'] . "'";
$rs_dh = mysqli_query($con, $query_dh);
$row_dh = mysqli_fetch_array($rs_dh);

$datareq = array(
	"kurs" =>  $row_dh['kurs'],
	"price" => $row_dh['rate_low'],
);
$datareq_high = array(
	"kurs" =>  $row_dh['kurs'],
	"price" => $row_dh['rate_high'],
);

$show_rate = get_rate($datareq);
$result_rate = json_decode($show_rate, true);

$show_rate_h = get_rate($datareq_high);
$result_rate_h = json_decode($show_rate_h, true);

?>
<div class="row">
	<div class="col-md-6">
		<div style="font-weight: bold;"><?php echo $row_dh['name']  ?></div>
	</div>
	<div class="col-md-6" style="text-align: right;">
		<?php for ($i = 0; $i < $row_dh['class']; $i++) {
		?>
			<span class='fa fa-star checked' style="color: goldenrod;"></span>
		<?php
		} ?>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col"><b><?php echo $row_dh['type'] . " (" . $row_dh['occ'] . ")"  ?></b></div>
					<div class="col" style="text-align: center;">
						<div><b>Quote</b></div>
						<div><?php echo $row_dh['quote']  ?></div>
					</div>
					<div class="col" style="text-align: center;">
						<div><b>Inclusive</b></div>
						<div><?php echo $row_dh['inclusive']  ?></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row" style="text-align: center;">
					<div class="col">
						<div style="font-weight: bold;">Low Rate</div>
						<div><span class="badge badge-warning"><?php echo number_format($result_rate['price'], 0, ",", ".")  ?></span></div>
					</div>
					<div class="col">
						<div style="font-weight: bold;">High Rate</div>
						<div><span class="badge badge-danger"><?php echo number_format($result_rate_h['price'], 0, ",", ".")   ?></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>