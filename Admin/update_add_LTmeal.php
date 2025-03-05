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
	
			$bf = $_POST['bf'][$i];
			$ln = $_POST['ln'][$i];
			$dn = $_POST['dn'][$i];


		if ($bf != "" or $ln != "" or $dn != "") {
			$sql = "UPDATE LT_add_meal SET bf='" . $bf . "', ln='" . $ln . "', dn='" . $dn . "' WHERE tour_id='" . $tour_id . "' && hari='" . $h . "'";
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$h++;
		}
	}

	$con->close();
	echo "success" . " , Update berhasil : " . $berhasil . " , Update Gagal : " . $gagal;
}
