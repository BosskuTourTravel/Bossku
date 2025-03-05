<?php
include "../site.php";
include "../db=connection.php";

$date = date("Y-m-d H:i:s");
$day = $_POST['day'];
$poc = $_POST['poc'];
$arrival = $_POST['arrival'];
$depature = $_POST['depature'];
$activity = $_POST['activity'];
$id = $_POST['id'];



// $sql = "INSERT INTO Itinerary_Cuise VALUES ('','".$date."','".$judul."','".$sub."','".$notes."')";
$sql = "UPDATE cruise_activity SET day='".$day."', poc='".$poc."', arrival='".$arrival."', depature='".$depature."', activity='".$activity."'  WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";
		echo $sql;
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		// header("location:https://www.2canholiday.com/Admin/#");
	}

	$con->close();

?>