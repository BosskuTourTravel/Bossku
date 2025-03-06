<?php
include "../site.php";
include "../db=connection.php";
$date = date("Y-m-d H:i:s");
$id = $_POST['id'];
$staff = $_POST['staff'];
$keterangan = $_POST['keterangan'];
$nominal = $_POST['nominal'];



$sql = "INSERT INTO tunjangan VALUES ('','".$date."','".$staff."','".$keterangan."','".$nominal."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>