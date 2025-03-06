<?php
include "../site.php";
include "../db=connection.php";
session_start();



$copy_id = $_POST['copy_id'];
$master_id = $_POST['master_id'];

$date = date("Y-m-d");
$staff = $_SESSION['staff_id'];
$fee = $_POST['tl_fee'];
$sfee = $_POST['tl_sfee'];
$tl_v = $_POST['tl_v'];
$tl_m = $_POST['tl_m'];

if ($copy_id != "" && $master_id != "") {
	$sql = "INSERT INTO LT_add_TL VALUES ('','$date','$master_id','".$copy_id."','$fee','$sfee','$tl_v','$tl_m','$staff')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
	$con->close();
}
