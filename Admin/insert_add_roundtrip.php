<?php
include "../site.php";
include "../db=connection.php";
$tipe = $_POST['tipe'];
$id = $_POST['id'];
$adt = $_POST['adt'];
$chd = $_POST['chd'];
$inf = $_POST['inf'];

$query = "SELECT * FROM  LTP_add_route where id=".$id;
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);


$tgl = date("Y-m-d");

if ($tipe == '0') {
	$sql = "INSERT INTO LT_add_roundtrip VALUES ('','" . $tgl . "','" . $id . "','" . $adt . "','" . $chd . "','" . $inf . "','','".$row['city_in']."','".$row['city_out']."','".$row['maskapai']."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
} else {
	$sql2 = "UPDATE LT_add_roundtrip SET adt='" . $adt . "', chd='" . $chd. "' , inf='" . $inf . "' WHERE route_id=" .$id;
	if (mysqli_query($con, $sql2)) {
		echo "success";
	} else {
		echo "Error Update : " . $sql2 . "" . mysqli_error($con2);
	}
}
$con->close();
