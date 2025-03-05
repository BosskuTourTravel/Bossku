<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$harga = $_POST['harga'];



$sql = "INSERT INTO jenisgaji VALUES ('','".$name."','".$harga."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>