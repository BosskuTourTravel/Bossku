<?php
include "../site.php";
include "../db=connection.php";
$tour_id = $_POST['tour'];
$id = $_POST['id'];
$ket = $_POST['ket'];
$tgl = date("Y-m-d");

$query_visa = "SELECT * FROM  Visa2 where id=".$id;
$rs_visa = mysqli_query($con, $query_visa);
$row_visa = mysqli_fetch_array($rs_visa);




$sql = "INSERT INTO LT_add_visa VALUES ('','".$tgl."','".$tour_id."','".$id."','".$ket."','".$row_visa['sell_price']."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>