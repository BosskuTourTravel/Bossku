<?php
include "Api_Kurs_online.php";
include "../site.php";
include "../db=connection.php";
session_start();
$tgl = date("Y-m-d");
$status = $_SESSION['staff_id'];
$query = "SELECT * FROM  kurs_bca_field where nama != 'IDR' order by id ASC ";
$rs = mysqli_query($con, $query);
$berhasil = 0;
$gagal = 0;
while ($row = mysqli_fetch_array($rs)) {
	$data = array(
		"nominal" => 1,
		"code" => $row['nama'],
	);
	$show_kurs = get_kurs_bca($data);
	$result_kurs = json_decode($show_kurs, true);
	$sql = "UPDATE  kurs_bca_field SET beli='" . $result_kurs['status']['kurs']['beli'] . "', jual='" . $result_kurs['status']['kurs']['jual'] . "', tgl='" . $tgl . "' where  id=" . $row['id'];
	if (mysqli_query($con, $sql)) {
		$berhasil++;
	} else {
		$gagal++;
	}
}
if ($berhasil == 0) {
	echo "Update Failed";
} else {
	echo "Update Success";
}

$con->close();
