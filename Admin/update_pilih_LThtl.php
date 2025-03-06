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
		$query_master = "SELECT * FROM LT_select_PilihHTL  where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' &&  hari='" . $rowHTL['hari'] . "'";
		$rs_master = mysqli_query($con, $query_master);
		$row_master = mysqli_fetch_array($rs_master);
		if ($row_master['hotel_id'] == "") {
			$sql = "INSERT INTO LT_select_PilihHTL VALUES ('','$date','$master_id','$copy_id','$sel_htl','" . $rowHTL['hari'] . "','" . $data[$x] . "','$status')";
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
		} else {
			$sql = "UPDATE LT_select_PilihHTL SET hotel_id='" . $sel_htl . "' , no_htl='" . $data[$x] . "' WHERE master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && hari='" . $rowHTL['hari'] . "'";
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
		}

		$x++;
	}

} else {
	$count = count($_POST['hotel_name']);
	$queryHTL = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id=" . $master_id;
	$rsHTL = mysqli_query($con, $queryHTL);
	$h = 1;
	$x = 0;
	$berhasil = 0;
	$gagal = 0;
	while ($rowHTL = mysqli_fetch_array($rsHTL)) {
		$hotel_name = $_POST['hotel_name'][$x];
		$hotel_twin = $_POST['hotel_twin'][$x];
		$hotel_triple = $_POST['hotel_triple'][$x];
		$hotel_family = $_POST['hotel_family'][$x];

		$query_master = "SELECT * FROM LT_select_PilihHTLNC  where master_id='" . $master_id . "' &&  hari='" . $rowHTL['hari'] . "'";
		$rs_master = mysqli_query($con, $query_master);
		$row_master = mysqli_fetch_array($rs_master);
		if ($row_master['hotel_name'] == "") {
			$sql2 = "INSERT INTO LT_select_PilihHTLNC VALUES ('','$date','$master_id','','$hotel_name','" . $rowHTL['hari'] . "','$hotel_twin','$hotel_triple','$hotel_family','$status')";
			if (mysqli_query($con, $sql2)) {
				$berhasil++;
			} else {
				$gagal++;
			}
		} else {
			$sql = "UPDATE LT_select_PilihHTLNC SET hotel_name='" . $hotel_name . "' , hotel_twin='" . $hotel_twin . "' , hotel_triple='" . $hotel_triple . "', hotel_family='" . $hotel_family . "' WHERE  master_id='" . $master_id . "'  && hari='" . $rowHTL['hari'] . "'";
			// var_dump($sql);
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
		}
		$h++;
		$x++;
	}

}
$con->close();
echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
