<?php
include "../site.php";
include "../db=connection.php";

$zone = $_POST['zone'];
$day = $_POST['day'];
$price = $_POST['price'];
$day2 = $_POST['day2'];
$price2 = $_POST['price2'];


$sql = "INSERT INTO passport VALUES ('','".$zone."',".$day.",".$price.",".$day2.",".$price2.",'0')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>