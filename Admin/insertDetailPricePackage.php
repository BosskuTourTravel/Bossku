<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$tourpricepackage = $_POST['tourpricepackage'];
$person = $_POST['person'];
$personplus = $_POST['personplus'];
$personplus2 = $_POST['personplus2'];
$price = $_POST['price'];
$adult = $_POST['adt'];
$cwb = $_POST['cwb'];
$cnb = $_POST['cnb'];
$infant = $_POST['inf'];
$kurs = $_POST['kurs'];
$adult_sub = $_POST['adt_sub'];
$tag = $_POST['tag'];
$tag2 = $_POST['tag2'];
$surcharge = $_POST['surcharge'];

$sql = "INSERT INTO tour_price_detail VALUES ('',".$person.",'-',".$personplus.",'+',".$personplus2.",".$price.",'".$cwb."','".$cnb."','".$infant."','".$adult."',".$adult_sub.",".$kurs.",".$surcharge.",".$tourpricepackage.")";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>