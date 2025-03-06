<?php
include "../site.php";
include "../db=connection.php";

$staff = $_POST['staff'];
$gaji = $_POST['gaji'];
$bpjs = $_POST['bpjs'];
$gj = $_POST['gj'];
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");



$sql = "INSERT INTO sallary VALUES ('','".$date."','".$staff."','".$gaji."','".$bpjs."','".$gj."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://2canholiday.com/Admin/#");
	}
	$con->close();


?>