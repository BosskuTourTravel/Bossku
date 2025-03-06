<?php
include "../site.php";
include "../db=connection.php";
session_start();

$master_id = $_POST['id'];
$lt_id = $_POST['pax'];
$date = date("Y-m-d");
$status = $_SESSION['staff_id'];


	$sql = "INSERT INTO DP_master VALUES ('','".$date."','".$master_id."','".$lt_id."','".$status."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}

$con->close();