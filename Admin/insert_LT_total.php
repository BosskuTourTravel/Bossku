<?php
include "../site.php";
include "../db=connection.php";

$data=$_POST['data'];
$datacode = json_decode($data, true);
$val_data = json_encode($data['include']);
$date =  date("Y-m-d");
// $include = json_decode($data['include'], true);

  $sql = "INSERT INTO LT_Perhitungan VALUES ('','".$date."','".$data['id']."','".$data['lt_hotel']."','$val_data','".$data['cabang']."')";
  	if (mysqli_query($con, $sql)) {
 	echo "success";
	} else {
  		echo "Error: " . $sql . "" . mysqli_error($con);
 		header("location:https://www.2canholiday.com/Admin/#");
	}
 	$con->close();
?>
