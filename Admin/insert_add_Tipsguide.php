<?php
include "../site.php";
include "../db=connection.php";
$tour_id = $_POST['tour'];
$data = $_POST['data'];
$tgl = date("Y-m-d");

$x = 1;
$b = 0;
$g = 0;
foreach ($data as $value) {

	$tl = $value['tl'];
	$guide = $value['guide'];
	$assistant = $value['ass'];
	$driver = $value['driver'];
	$porter = $value['porter'];
	$restaurant = $value['res'];
	$hari = $value['hari'];

	$sql = "INSERT INTO LT_add_Tips VALUES ('','" . $tgl . "','" . $tour_id . "','" . $hari . "','" . $tl . "','" . $guide . "','" . $assistant . "','" . $driver . "','" . $porter . "','" . $restaurant . "','0')";
	var_dump($sql);
	if (mysqli_query($con, $sql)) {
		$b++;
	} else {
		$g++;
	}

	// echo $x;
	$x++;
}
$con->close();
echo "success";
// $query_visa = "SELECT * FROM  Visa2 where id=".$id;
// $rs_visa = mysqli_query($con, $query_visa);
// $row_visa = mysqli_fetch_array($rs_visa);
