<?php
include "../site.php";
include "../db=connection.php";
session_start();

$validity=$_POST['validity'];
$name=$_POST['name'];
$country=$_POST['country'];
$opening_hours=$_POST['opening_hours'];
$opening_hours2 = str_replace("'", "", $opening_hours);
$remarks=$_POST['remarks'];
$remarks2 = str_replace("'", "", $remarks);

$category=$_POST['category'];
$category_desc=$_POST['category_desc'];
$physic=$_POST['physic'];
$etix=$_POST['etix'];
$redeem=$_POST['redeem'];
$kurs_price=$_POST['kurs_price'];

$adt_price=$_POST['adt_price'];
$senior_price=$_POST['senior_price'];
$junior_price=$_POST['junior_price'];
$chd_price=$_POST['chd_price'];
$inf_price=$_POST['inf_price'];

$sell_adt_price=$_POST['sell_adt_price'];
$sell_senior_price=$_POST['sell_senior_price'];
$sell_junior_price=$_POST['sell_junior_price'];
$sell_chd_price=$_POST['sell_chd_price'];
$sell_inf_price=$_POST['sell_inf_price'];

$adt_desc=$_POST['adt_desc'];
$senior_desc=$_POST['senior_desc'];
$junior_desc=$_POST['junior_desc'];
$chd_desc=$_POST['chd_desc'];
$inf_desc=$_POST['inf_desc'];

$date = date("Y-m-d");

$sql = "INSERT INTO admission VALUES ('','".$name."','".$category."','".$category_desc."',".$physic.",".$etix.",".$redeem.",'".$validity."',".$kurs_price.",".$adt_price.",".$senior_price.",".$junior_price.",".$chd_price.",".$inf_price.",".$sell_adt_price.",".$sell_senior_price.",".$sell_junior_price.",".$sell_chd_price.",".$sell_inf_price.",'".$adt_desc."','".$senior_desc."','".$junior_desc."','".$chd_desc."','".$inf_desc."','".$opening_hours2."','".$remarks2."',".$country.",".$_SESSION['staff_id'].",'0000-00-00','".$date."')";
  //echo $sql."</br>";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>