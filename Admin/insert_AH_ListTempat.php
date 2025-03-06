<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];
$sfee_id = $_POST['sfee_id'];
$grub_id = $_POST['grub_id'];

// $count = count($_FILES['fileToUpload']['name']);
if (!empty($hari)) {
	$berhasil = 0;
	$gagal = 0;
		$data = $_POST['list_tmp'][0];
		// var_dump($data);
		$data_list = explode(",",$data);
		$urutan = 1;
		foreach($data_list as $value_list){
			// var_dump($value_list);
			$sql = "INSERT INTO LT_AH_ListTempat VALUES ('','$date','$tour_id','$grub_id','$sfee_id','$hari','$urutan','$value_list','$status')";
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$urutan++;
		}
	// $con->close();
	echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
}
