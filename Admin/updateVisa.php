<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$day = $_POST['day'];
$price = $_POST['price'];
$country = $_POST['country'];
$continent = $_POST['continent'];
$type = $_POST['type'];
$embassy = $_POST['embassy'];


$sql = "UPDATE visa SET country = ".$country.",continent = '".$continent."', type='".$type."',day=".$day.",price=".$price.",embassy=".$embassy." WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>