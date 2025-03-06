<?php
include "../site.php";
include "../db=connection.php";
session_start();

$query_data = "SELECT * FROM LT_change_judul WHERE copy_id='" . $_POST['copy_id'] . "' && grub_id='" . $_POST['grub_id'] . "'";
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$date = date("Y-m-d");
$judul = $_POST['judul'];
$status = $_SESSION['staff_id'];
if ($row_data['id'] == "") {
	$sql = "INSERT INTO LT_change_judul VALUES ('','" . $judul . "','" . $_POST['copy_id'] . "','" . $_POST['grub_id'] . "','" . $_POST['sfee_id'] . "','" . $status . "')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
} else {
	$sql2 = "UPDATE LT_change_judul SET nama='" . $judul . "' WHERE copy_id='" . $_POST['copy_id'] . "' && grub_id='" . $_POST['grub_id'] . "'";
	if (mysqli_query($con, $sql2)) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
}

$con->close();
