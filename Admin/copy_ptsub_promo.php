<?php
include "../site.php";
include "../db=connection.php";
session_start();


$date = date("Y-m-d");
$status = $_SESSION['staff_id'];

$query = "SELECT * FROM  LTSUB_itin where id =".$_POST['sub_id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);


	$sql = "INSERT INTO DP_ptsub VALUES ('','".$date."','".$row['master_id']."','".$row['id']."','".$_POST['chck']."','".$_POST['pax']."','".$_POST['twn']."','".$_POST['sgl']."','".$_POST['cnb']."','".$_POST['inf']."','".$_POST['ltwn']."','".$_POST['lsgl']."','".$_POST['lcnb']."','".$_POST['linf']."','".$row['cabang']."','".$status."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}

$con->close();