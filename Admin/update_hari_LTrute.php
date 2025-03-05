<?php
include "../site.php";
include "../db=connection.php";
session_start();


$date = date("Y-m-d");
$hari = $_POST['hari'];
$copy_id = $_POST['copy_id'];
$master_id = $_POST['copy_id'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];

$sql = "UPDATE LT_add_hari SET rute='" . $rute . "' WHERE id='" . $tour_id . "' && master_id='$master_id' && copy_id='$copy_id'";
if (mysqli_query($con, $sql)) {
	echo "success";
} else {
	echo "gagal";
}
$con->close();
