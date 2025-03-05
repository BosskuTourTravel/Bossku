<?php
include "../site.php";
include "../db=connection.php";
session_start();

$nama=$_POST['nama'];
$city=$_POST['city'];
$include=$_POST['include'];
$exclude=$_POST['exclude'];
$policy=$_POST['policy'];
$remarks=$_POST['remarks'];

 $sql = "INSERT INTO Landtour VALUES ('','".$nama."','".$city."','','','".$include."','".$exclude."','".$policy."','".$remarks."','')";
//   //echo $sql."</br>";
 	if (mysqli_query($con, $sql)) {
	echo "success";
 	} else {
 		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
?>