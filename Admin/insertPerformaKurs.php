<?php
include "../site.php";
include "../db=connection.php";

$price = $_POST['price'];
$country = $_POST['country'];
$kurs = $_POST['kurs'];


$sql = "INSERT INTO performa_kurs_standart VALUES ('',".$country.",".$kurs.",".$price.")";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
	$con->close();


?>