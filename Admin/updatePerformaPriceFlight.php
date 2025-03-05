<?php
include "../site.php";
include "../db=connection.php";


$id = $_POST['id'];
$txtpersentase = "persentase";
$txtnominal = "nominal";
$txtflag = "flag";

$persentase = $_POST[$txtpersentase];
$nominal = $_POST[$txtnominal];
$flag = $_POST[$txtflag];
$flight_type = $_POST['flight_type'];

if($_POST['code']==2){
	$sql = "UPDATE performa_price_standart_flight SET persentase =".$persentase.",nominal = ".$nominal.",option_price=".$flag." WHERE flight_type LIKE '".$flight_type."'";
}else{
	$sql = "UPDATE performa_price_standart_flight SET persentase =".$persentase.",nominal = ".$nominal.",option_price=".$flag." WHERE id=".$id;
}


if (mysqli_query($con, $sql)) {
	$temp = 0;
} else {
	$temp = 1;
	echo "Error: " . $sql . "" . mysqli_error($con);
	header("location:https://www.2canholiday.com/Admin/#");
}

if($temp==0){
	echo "success";
}

$con->close();


?>