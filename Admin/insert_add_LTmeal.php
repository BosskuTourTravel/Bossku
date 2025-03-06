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
	$h = 1;
	for ($i = 0; $i < $hari; $i++) {
		$bf = "";
		$ln = "";
		$dn = "";
		if ($_POST['bf'][$i] != "undefined") {
			$bf = $_POST['bf'][$i];
		}
		if ($_POST['ln'][$i] != "undefined") {
			$ln = $_POST['ln'][$i];
		}
		if ($_POST['dn'][$i] != "undefined") {
			$dn = $_POST['dn'][$i];
		}


		$sql = "INSERT INTO LT_add_meal VALUES ('','$date','$tour_id','$h','$bf','$ln','$dn','$status')";
		// var_dump($sql);
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
