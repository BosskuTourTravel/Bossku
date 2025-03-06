<?php
include "../site.php";
include "../db=connection.php";

$data=$_POST['data'];
$datacode = json_decode($data, true);
$val_data = json_encode($data['exclude']);
// $include = json_decode($data['include'], true);

  $sql = "INSERT INTO Prev_Exclude_LT VALUES ('','".$val_data."','".$data['id']."')";
  	if (mysqli_query($con, $sql)) {
 	echo "success";
	} else {
  		echo "Error: " . $sql . "" . mysqli_error($con);
 		header("location:https://www.2canholiday.com/Admin/#");
	}
 	$con->close();
?>
