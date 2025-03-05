<?php
include "../site.php";
include "../db=connection.php";
session_start();

$querymaster = "SELECT * FROM  LTSUB_itin WHERE id=" . $_POST['id'];
$rsmaster = mysqli_query($con, $querymaster);
$rowmaster = mysqli_fetch_array($rsmaster);

$copy_id = $_POST['id'];
$hari = $_POST['hari'];
$rute = $_POST['rute'];
$date = date("Y-m-d");
$staff = $_SESSION['staff_id'];

if ($hari != "" && $rute != "") {
	$sql = "INSERT INTO LT_Rute VALUES ('','".$rowmaster['master_id']."','".$_POST['id']."','".$_POST['grub_id']."','$hari','$rute','$staff')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}

	$con->close();
}
