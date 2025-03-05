<?php
include "../site.php";
include "../db=connection.php";
session_start();

$date = date("Y-m-d");
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];
$tour_id = $_POST['id'];


if (!empty($hari)) {
	$berhasil = 0;
	$gagal = 0;
	$h = 1;
	for ($i = 0; $i < $hari; $i++) {

		$data = $_POST['list_tmp'][$i];
		var_dump($data);
		$data_list = explode(",", $data);
		$urutan = 1;
		foreach ($data_list as $value_list) {
			if ($value_list != "") {
				$query_master = "SELECT * FROM LT_add_listTmp  where tour_id='" . $tour_id . "' && hari='$h' && urutan ='$urutan'";
				$rs_master = mysqli_query($con, $query_master);
				$row_master = mysqli_fetch_array($rs_master);
				// if($h=="4"){
				// 	var_dump($query_master);
				// }

				if ($row_master['id'] == "") {

					$sql2 = "INSERT INTO LT_add_listTmp VALUES ('','$date','$tour_id','$h','$urutan','$value_list','$status')";
					if (mysqli_query($con, $sql2)) {
						$berhasil++;
					} else {
						$gagal++;
					}
				} else {
					// var_dump($data);
					$sql = "UPDATE LT_add_listTmp SET tempat='" . $value_list . "' WHERE tour_id='" . $tour_id . "' && hari='" . $h . "' && urutan='" . $urutan . "'";
					// var_dump($sql);
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
	}
	$con->close();
	echo "success" . " , Update berhasil : " . $berhasil . " , Update Gagal : " . $gagal;
}
