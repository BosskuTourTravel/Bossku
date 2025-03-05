<?php
include "../site.php";
include "../db=connection.php";
session_start();

$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$destination = $_POST['destination'];
$pax = $_POST['pax'];
$month = $_POST['month'];
$email = $_POST['email'];
$from = $_POST['from'];
$city = $_POST['city'];
$address = $_POST['address'];
$customer_category = $_POST['customer_category'];
$departure = $_POST['departure'];
$dateNow = date("Y-m-d H:i:s");
$staff= $_SESSION['staff_id'];
$job ='29';
$jumlah='1';
$queryjob = "SELECT * FROM jenisgaji WHERE id = ".$job;
$rsj=mysqli_query($con,$queryjob);
$rowj = mysqli_fetch_array($rsj);
$harga = $rowj['harga'];
$total=$jumlah * $harga;

$sql = "INSERT INTO customer_list VALUES ('','".$name."','".$phone."','".$address."','".$type."','".$destination."','".$pax."','".$month."','".$email."',0,'".$from."','".$city."','".$dateNow."','".$departure."','".$customer_category."',0,0,0,'-1','".$_SESSION['staff_id']."')";
$sqljob = "INSERT INTO total_job VALUES ('','".$dateNow."','".$staff."','".$job."','".$name."','','".$jumlah."','".$total."')";	
if (mysqli_query($con, $sql) && mysqli_query($con, $sqljob)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>