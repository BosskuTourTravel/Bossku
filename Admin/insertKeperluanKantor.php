<?php
include "../site.php";
include "../db=connection.php";
session_start();

$tdate = $_POST['tdate'];
$description = $_POST['description'];
$price = $_POST['price'];
$date = date("Y-m-d");


$sql = "INSERT INTO pengeluaran_kantor VALUES ('','".$tdate."','".$description."',".$price.",0,".$_SESSION['staff_id'].",'".$date."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>