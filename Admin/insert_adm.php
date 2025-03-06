<?php
include "../db=connection.php";

$tour_id = $_POST['tour_id'];
$master_id = $_POST['master_id'];
$inc = $_POST['adm_inc'];
$exc = $_POST['adm_ex'];

$query_cek = "SELECT * FROM tour_adm_chck where tour_id='" . $_POST['tour_id'] . "' && master_id='" . $_POST['master_id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
// var_dump($query_cek);


if ($row_cek['id'] == "") {
	$sql = "INSERT INTO tour_adm_chck VALUES ('','" . $tour_id . "','" . $master_id . "','" . $inc . "','" . $exc . "')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
} else {
	$sql2 = "UPDATE tour_adm_chck SET include='" . $inc . "', exclude='".$exc."' WHERE id='" .$row_cek['id'] . "'";
	if (mysqli_query($con, $sql2)) {
		echo "success";
	} else {
		echo "gagal";
	}
}

$con->close();
