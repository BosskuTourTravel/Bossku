<?php
include "../site.php";
include "../db=connection.php";
session_start();


$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];
$sfee_id = $_POST['sfee_id'];
$grub_id = $_POST['grub_id'];

if (!empty($hari)) {
	$bf = $_POST['bf'];
	$ln = $_POST['ln'];
	$dn = $_POST['dn'];
	// if ($bf = "" or $ln = "" or $dn = "") {
		$sql = "UPDATE LT_AH_ListMeal SET bf='" . $bf . "', ln='" . $ln . "', dn='" . $dn . "' WHERE tour_id='" . $tour_id . "' && grub_id='".$grub_id."' && hari='" . $hari . "'";
		if (mysqli_query($con, $sql)) {
			echo "seccess";
		} else {
			echo "gagal";
		}
	// }

	$con->close();
}
