<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$type = $_POST['type'];


$sql = "INSERT INTO transport_type VALUES ('','".$name."','".$type."','')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>