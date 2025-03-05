<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];

if (!empty($hari)) {

	$bf = "";
	$ln = "";
	$dn = "";
	if ($_POST['bf'] != "undefined") {
		$bf = $_POST['bf'];
	}
	if ($_POST['ln'] != "undefined") {
		$ln = $_POST['ln'];
	}
	if ($_POST['dn'] != "undefined") {
		$dn = $_POST['dn'];
	}

	$sql = "INSERT INTO LTHR_add_meal VALUES ('','$date','$tour_id','$hari','$bf','$ln','$dn','$status')";
	// var_dump($sql);
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Gagal";
	}
	$con->close();
}
