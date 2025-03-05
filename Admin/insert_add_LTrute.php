<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];

if (!empty($hari)) {

	$berhasil = 0;
	$gagal = 0;
	$h=1;
	for ($i = 0; $i < $hari; $i++) {

		$rute = $_POST['rute'][$i];

		$sql = "INSERT INTO LT_add_rute VALUES ('','$date','$tour_id','$h','$rute','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
		$h++;
	}

	$con->close();
	echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
}
