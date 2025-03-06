<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$job = $_POST['job'];



$sql = "INSERT INTO jobdesk VALUES ('','".$nama."','".$job."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>