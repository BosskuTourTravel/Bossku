<?php
include "../site.php";
include "../db=connection.php";
session_start();

$unique_code=$_POST['uniquecode'];
$hotel_type=$_POST['hotel_type'];
$guest_name=$_POST['guest_name'];
$booking_id=$_POST['booking_id'];
$hotel_name=$_POST['hotel_name'];
$tour_name=$_POST['tour_name'];
$hotel_address=$_POST['hotel_address'];
$city=$_POST['city'];
$country=$_POST['country'];
$total_room=$_POST['total_room'];
$tax=$_POST['tax'];
$total_night=$_POST['total_night'];
$price=$_POST['price'];
$status=$_POST['status'];
$payment_type=$_POST['payment_type'];
$bank=$_POST['bank'];
$size=$_POST['size'];
$type_room=$_POST['type_room'];
$type_bed=$_POST['type_bed'];
$date_checkin=$_POST['date_checkin'];
$date_checkout=$_POST['date_checkout'];
$date_limit_bayar=$_POST['date_limit_bayar'];
$date_limit_pembatalan=$_POST['date_limit_pembatalan'];
$date = date("Y-m-d");

if($unique_code=='0'){
	$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);

	$query_hotel = "SELECT COUNT(*) as total FROM hotel WHERE unique_code LIKE '".$randomNum."'";
	$rs_hotel=mysqli_query($con,$query_hotel);
	$row_hotel = mysqli_fetch_assoc($rs_hotel);

	while($row_hotel['total']>0){
		$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
		$query_hotel = "SELECT COUNT(*) as total FROM hotel WHERE unique_code LIKE '".$randomNum."'";
		$rs_hotel=mysqli_query($con,$query_hotel);
		$row_hotel = mysqli_fetch_assoc($rs_hotel);
	}
}else{
	$randomNum = $unique_code;
}




$sql = "INSERT INTO hotel VALUES ('',".$booking_id.",'".$guest_name."','".$date_checkin."','".$date_checkout."','".$date_limit_bayar."','".$date_limit_pembatalan."','".$city."','".$country."',".$tour_name.",'".$hotel_name."','".$hotel_address."','".$hotel_type."',".$total_room.",'".$type_room."','".$tax."',".$total_night.",'".$price."','".$payment_type."',".$bank.",'".$status."','".$size."','".$type_bed."',".$_SESSION['staff_id'].",'".$date."','0000-00-00','".$randomNum."')";
// echo $unique_code."</br>";
//  echo $sql."</br>";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>