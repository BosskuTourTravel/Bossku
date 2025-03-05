<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$staff = $_POST['staff'];
$date = date("Y-m-d");


$sql = "INSERT INTO login_staff VALUES ('','".$name."','".$email."','".$password."',".$phone.",'".$staff."','".$date."',1,'0000-00-00')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>