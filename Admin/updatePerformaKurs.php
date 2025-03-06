<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$price = $_POST['price'];
$country = $_POST['country'];
$kurs = $_POST['kurs'];


$sql = "UPDATE performa_kurs_standart SET country=".$country.", kurs=".$kurs.", price=".$price." WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
	$con->close();


?>