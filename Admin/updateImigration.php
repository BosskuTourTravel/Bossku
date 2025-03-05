<?php
include "../site.php";
include "../db=connection.php";

$zone = $_POST['zone'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$id = $_POST['id'];


$sql = "UPDATE imigration SET zone='".$zone."', address='".$address."', phone='".$phone."' WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>