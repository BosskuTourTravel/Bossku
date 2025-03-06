<?php
include "../site.php";
include "../db=connection.php";
session_start();


$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];
$rute = $_POST['rute'];
if (!empty($hari)) {
	$berhasil = 0;
	$gagal = 0;
	$h = 1;
		
		if ($rute != "") {
			$sql = "UPDATE LT_add_hari SET rute='" . $rute . "', hari='".$hari."' WHERE id='" . $tour_id . "'";
			// var_dump($sql);
			if (mysqli_query($con, $sql)) {
				echo "success";
			} else {
				echo "gagal";
			}
		}

	$con->close();
}else{
	echo "hari kosong ";
}
