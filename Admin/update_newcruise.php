<?php
include "../site.php";
include "../db=connection.php";

$date = date("Y-m-d H:i:s");
$judul = $_POST['judul'];
$notes = $_POST['notes'];
$sub = $_POST['sub'];
$id = $_POST['id'];



// $sql = "INSERT INTO Itinerary_Cuise VALUES ('','".$date."','".$judul."','".$sub."','".$notes."')";
$sql = "UPDATE Itinerary_Cuise SET judul='".$judul."', sub='".$sub."', notes='".$notes."' WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";
		echo $sql;
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		// header("location:https://www.2canholiday.com/Admin/#");
	}

	$con->close();

?>