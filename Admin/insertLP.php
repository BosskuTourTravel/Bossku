<?php
include "../site.php";
include "../db=connection.php";
$id = $_POST['id'];
$staff = $_POST['staff'];
$type = $_POST['type'];
$nominal = $_POST['nominal'];
$office = $_POST['office'];
$thn=$_POST['thn'];



$sql = "INSERT INTO lemburPrice VALUES ('','".$staff."','".$nominal."','".$type."','".$office."','".$thn."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>