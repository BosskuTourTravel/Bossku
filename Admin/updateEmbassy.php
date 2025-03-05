<?php
include "../site.php";
include "../db=connection.php";

$country = $_POST['country'];
$city = $_POST['city'];
$address = $_POST['address'];
$hour = $_POST['hour'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$web = $_POST['web'];
$email = $_POST['email'];


$sql = "UPDATE embassy SET country = ".$country.", city= ".$city.", address = '".	$address."', office_hours='".$hour."', phone='".$phone."', fax='".$fax."', web = '".$web."', email = '".$email."' WHERE id = ".$_POST['id'];
	if (mysqli_query($con, $sql)) {
		echo "success	";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>