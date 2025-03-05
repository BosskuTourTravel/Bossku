<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$staff = $_POST['staff'];
$date = date("Y-m-d");
$cabang =  $_POST['cabang'];


$sql = "INSERT INTO login_staff VALUES ('','".$name."','".$email."','".$password."','".$phone."','".$staff."','".$date."',1,'0000-00-00','".$_POST['cabang']."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
	$con->close();


?>