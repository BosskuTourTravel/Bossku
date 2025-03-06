<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];

// $count = count($_FILES['fileToUpload']['name']);
if (!empty($hari)) {

	$berhasil = 0;
	$gagal = 0;
	$h=1;
	for ($i = 0; $i < $hari; $i++) {
		$data = $_POST['list_tmp'][$i];
		$data_list = explode(",",$data);
		$urutan = 1;
		foreach($data_list as $value_list){
			$sql = "INSERT INTO LT_add_listTmp VALUES ('','$date','$tour_id','$h','$urutan','$value_list','$status')";
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$urutan++;
		}
		$h++;
	}
	$con->close();
	echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
}
