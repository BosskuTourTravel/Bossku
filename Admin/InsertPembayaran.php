<?php
include "../site.php";
include "../db=connection.php";

$staff = $_POST['staff'];
$bln = $_POST['bln'];
$thn = $_POST['thn'];
$jp = $_POST['jp'];
$bayar = $_POST['bayar'];
$date= date('Y-m-d');
$querylp = "SELECT * FROM lemburPrice WHERE nama=".$_POST['staff'];
$rslp=mysqli_query($con,$querylp);
$rowlp=mysqli_fetch_array($rslp);
$hours=$rowlp['nominal'];
$th=$bayar / $hours;
var_dump($th);



$sql = "INSERT INTO pembayaran VALUES ('','".$date."','".$staff."','".$bln."','".$thn."','".$jp."','".$th."','".$bayar."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} 
	$con->close();


?>