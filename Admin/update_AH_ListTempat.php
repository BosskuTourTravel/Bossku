<?php
include "../site.php";
include "../db=connection.php";
session_start();


$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];
$sfee_id = $_POST['id'];

if (!empty($hari)) {
	$berhasil = 0;
	$gagal = 0;
	$h = 1;
	$data = $_POST['list_tmp'][0];
	// var_dump($data);
	$data_list = explode(",", $data);
	$urutan = 1;
	foreach ($data_list as $value_list) {
		if ($value_list != "") {
			$query_cek = "SELECT * FROM LT_AH_ListTempat where tour_id='" . $tour_id . "' && sfee_id='" . $sfee_id . "' &&  hari='" . $hari . "' && urutan='" . $urutan . "'";
			$rs_cek = mysqli_query($con, $query_cek);
			$row_cek = mysqli_fetch_array($rs_cek);
			if ($row_cek['id'] == "") {
				$sql = "INSERT INTO LT_AH_ListTempat VALUES ('','$date','$tour_id','$sfee_id','$hari','$urutan','$value_list','$status')";
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			} else {
				$sql = "UPDATE LT_AH_ListTempat SET tempat='" . $value_list . "' WHERE tour_id='" . $tour_id . "' && sfee_id='" . $sfee_id . "'  && hari='" . $hari . "' && urutan='" . $urutan . "'";
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			}
		}
		$urutan++;
	}
	$h++;
	$con->close();
	echo "success" . " , Update berhasil : " . $berhasil . " , Update Gagal : " . $gagal;
}
