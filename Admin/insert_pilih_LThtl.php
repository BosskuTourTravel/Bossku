<?php
include "../site.php";
include "../db=connection.php";
session_start();

$date = date("Y-m-d");
$status = $_SESSION['staff_id'];
$master_id = $_POST['master_id'];
$copy_id = $_POST['copy_id'];

if ($_POST['code'] == "yes") {

	$count = count($_POST['hotel_name']);
	$queryHTL = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id=" . $master_id;
	$rsHTL = mysqli_query($con, $queryHTL);

	$sel_htl = $_POST['sel_htl'];
	$data = $_POST['htl_day'];
	$count =  count($_POST['htl_day']);
	$berhasil = 0;
	$gagal = 0;
	$x = 0;
	while ($rowHTL = mysqli_fetch_array($rsHTL)) {

		$sql = "INSERT INTO LT_select_PilihHTL VALUES ('','$date','$master_id','$copy_id','$sel_htl','" . $rowHTL['hari'] . "','" . $data[$x] . "','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
		// }

		$x++;
	}
} else {

	$queryHTL = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id=" . $master_id;
	$rsHTL = mysqli_query($con, $queryHTL);
	$berhasil = 0;
	$gagal = 0;
	$x = 0;
	while ($rowHTL = mysqli_fetch_array($rsHTL)) {
		$hotel_name = $_POST['hotel_name'][$x];
		$hotel_twin = $_POST['hotel_twin'][$x];
		$hotel_triple = $_POST['hotel_triple'][$x];
		$hotel_family = $_POST['hotel_family'][$x];
		$sql = "INSERT INTO LT_select_PilihHTLNC VALUES ('','$date','$master_id','','$hotel_name','" . $rowHTL['hari'] . "','$hotel_twin','$hotel_triple','$hotel_family','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
	}

	// $count = count($_POST['hotel_name']);
	// $berhasil = 0;
	// $gagal = 0;
	// for ($x = 0; $x < $count; $x++) {
	// 	$hotel_name =$_POST['hotel_name'][$x];
	// 	$hotel_twin = $_POST['hotel_twin'][$x];
	// 	$hotel_triple = $_POST['hotel_triple'][$x];
	// 	$hotel_family = $_POST['hotel_family'][$x];

	// 	$queryHTL = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id=" . $master_id;
	// 	$rsHTL = mysqli_query($con, $queryHTL);
	// 	$rowHTL = mysqli_fetch_array($rsHTL);

	// 	$sql = "INSERT INTO LT_select_PilihHTLNC VALUES ('','$date','$master_id','','$hotel_name','" . $rowHTL['hari'][$x] . "','$hotel_twin','$hotel_triple','$hotel_family','$status')";
	// 	// var_dump($sql);
	// 	if (mysqli_query($con, $sql)) {
	// 		$berhasil++;
	// 	} else {
	// 		$gagal++;
	// 	}
	// }
}
$con->close();
echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
