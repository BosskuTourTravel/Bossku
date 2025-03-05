<?php
include "../site.php";
include "../db=connection.php";
session_start();

$data=$_POST['data'];
$datacode = json_decode($data, true);
$val_data = json_encode($data);

  $sql = "INSERT INTO Prev_makeLT VALUES ('','".$data['judul']."','".$val_data."','')";
  	if (mysqli_query($con, $sql)) {
 	echo "success";
	} else {
  		echo "Error: " . $sql . "" . mysqli_error($con);
 		header("location:https://www.2canholiday.com/Admin/#");
	}
 	$con->close();
?>