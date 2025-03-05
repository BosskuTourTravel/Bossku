<?php
include "../site.php";
include "../db=connection.php";

$day = $_POST['day'];
$price = $_POST['price'];
$country = $_POST['country'];
$continent = $_POST['continent'];
$type = $_POST['type'];
$embassy = $_POST['embassy'];


$sql = "INSERT INTO visa VALUES ('',".$country.",'".$continent."','".$type."',".$day.",".$price.",".$embassy.")";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>