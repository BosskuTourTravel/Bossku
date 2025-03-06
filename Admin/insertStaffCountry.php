<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$country = $_POST['country'];

$sql = "INSERT INTO staff_country VALUES ('',".$agent.",'".$country."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
	$con->close();


?>