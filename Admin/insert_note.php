<?php
include "../site.php";
include "../db=connection.php";
if ($_POST['id'] != "") {
	$sql = "UPDATE LT_itinerary2 SET note='".$_POST['note']."' WHERE id=" . $_POST['id'];
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
	$con->close();
}
