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
	$h = 1;

	$query_ops = "SELECT * FROM LT_add_ops where master_id='" . $tour_id . "' order by hari ASC, urutan ASC";
	$rs_ops = mysqli_query($con, $query_ops);
	$row_ops = mysqli_fetch_array($rs_ops);
	if ($row_ops['id'] == "") {
		for ($i = 0; $i < $hari; $i++) {
			$data = $_POST['optional'][$i];
			$data_hl = $_POST['highlight'][$i];
			if ($data != "") {
				$data_list = explode(",", $data);
				$data_hl_list = explode(",", $data_hl);
				$urutan = 1;
				$index = 0;
				foreach ($data_list as $value_list) {
					$sql = "INSERT INTO LT_add_ops VALUES ('','$date','$tour_id','$h','$urutan','$value_list','".$data_hl_list[$index]."','$status')";
					if (mysqli_query($con, $sql)) {
						$berhasil++;
					} else {
						$gagal++;
					}
					$urutan++;
					$index++;
				}
				$h++;
			}
			// var_dump($data);
		}
	} else {
		for ($i = 0; $i < $hari; $i++) {
			$data = $_POST['optional'][$i];
			$data_hl = $_POST['highlight'][$i];
			// data opsional tidak kosong
			if ($data != "") {
				$data_list = explode(",", $data);
				$data_hl_list = explode(",", $data_hl);
				// var_dump($data_hl);
				$urutan = 1;
				$index = 0;
				foreach ($data_list as $value_list) {
					$cek = "SELECT * FROM LT_add_ops where master_id='" . $tour_id . "' && hari='$h' && urutan='" . $urutan . "'";
					$rs_cek = mysqli_query($con, $cek);
					$row_cek = mysqli_fetch_array($rs_cek);

					if ($row_cek['urutan'] == "") {
						$sql = "INSERT INTO LT_add_ops VALUES ('','$date','$tour_id','$h','$urutan','$value_list','".$data_hl_list[$index]."','$status')";
						if (mysqli_query($con, $sql)) {
							$berhasil++;
						} else {
							$gagal++;
						}
						// var_dump($sql);

					} else {
						$sql = "UPDATE LT_add_ops SET optional='" . $value_list . "', highlight='" . $data_hl_list[$index] . "' WHERE master_id='" . $tour_id . "' && hari='" . $h . "' && urutan='" . $urutan . "'";
						// var_dump($sql);
						if (mysqli_query($con, $sql)) {
							$berhasil++;
						} else {
							$gagal++;
						}
					}
					$urutan++;
					$index++;
				}
				$h++;
			}
		}
	}

	$con->close();
	echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
}
