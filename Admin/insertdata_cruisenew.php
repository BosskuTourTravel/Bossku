<?php
include "../site.php";
include "../db=connection.php";
$date = date("Y-m-d H:i:s");
$judul = $_POST['judul'];
$notes = $_POST['notes'];
$sub = $_POST['sub'];
$ship = $_POST['ship'];



$sql = "INSERT INTO Itinerary_Cuise VALUES ('','".$ship."','".$date."','".$judul."','".$sub."','".$notes."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
		echo $sql;
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		// header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();

?>