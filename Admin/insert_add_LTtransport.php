<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$jml = $_POST['jml'];
$status = $_SESSION['staff_id'];
$master_id = $_POST['master_id'];
$copy_id = $_POST['copy_id'];

// $count = count($_FILES['fileToUpload']['name']);

$berhasil = 0;
$gagal = 0;
$h = 1;
if ($_POST['id'] == '1') {
	for ($i = 0; $i < $jml; $i++) {
		// echo $i;
		$hari = $_POST['hari'][$i];
		$urutan = $_POST['urutan'][$i];
		// $f_type = $_POST['f_type'][$i];
		// $f_rute = $_POST['f_rute'][$i];
		$f_name = $_POST['f_name'][$i];

		$sql = "INSERT INTO LT_add_transport VALUES ('','$date','','$master_id','$copy_id','','" . $_POST['id'] . "','$hari','$urutan','$f_name','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
	}
	// echo $jml;
} else if ($_POST['id'] == '2') {
	$originalDate = $_POST['date_fr'];
	$newDate = date("Y-m-d", strtotime($originalDate));
	for ($i = 0; $i < $jml; $i++) {
		$hari = $_POST['hari'][$i];
		$urutan = $_POST['urutan'][$i];
		// $f_type = $_POST['f_type'][$i];
		// $f_rute = $_POST['f_rute'][$i];
		$f_name = $_POST['f_name'][$i];

		$sql = "INSERT INTO LT_add_transport VALUES ('','$date','$newDate','$master_id','$copy_id','','" . $_POST['id'] . "','$hari','$urutan','$f_name','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
	}
} else if ($_POST['id'] == '3') {

	$sql2 = "UPDATE  LT_add_transport SET hari='" . $_POST['hari'] . "' , urutan='" . $_POST['urutan'] . "' WHERE id=" . $_POST['flight_id'];
	if (mysqli_query($con, $sql2)) {
		$berhasil++;
	} else {
		$gagal++;
	}
} else if ($_POST['id'] == '4') {
	for ($i = 0; $i < $jml; $i++) {
		$nama = $_POST['t_name'][$i];
		$t_tgl = $_POST['t_tgl'][$i];
		$adt = $_POST['t_adult'][$i];
		$chd = $_POST['t_child'][$i];
		$inf = $_POST['t_infant'][$i];
		$hari = $_POST['hari'][$i];
		$urutan = $_POST['urutan'][$i];

		$sql3 = "INSERT INTO train_LTnew VALUE ('','" . $t_tgl . "','" . $nama . "','" . $adt . "','" . $chd . "','" . $inf . "','$status')";
		if (mysqli_query($con, $sql3)) {
			$sql_get = "SELECT * FROM train_LTnew ORDER BY id DESC limit 1";
			$rs_get = mysqli_query($con, $sql_get);
			$row_get = mysqli_fetch_array($rs_get);

			if ($row_get['id'] != "") {
				$sql = "INSERT INTO LT_add_transport VALUES ('','$date','','$master_id','$copy_id','','" . $_POST['id'] . "','$hari','$urutan','" . $row_get['id'] . "','$status')";
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			}
		} else {
			$gagal++;
		}
	}
} else if ($_POST['id'] == '5') {
	$val_id = explode(",", $_POST['kode']);
	$grub_id = $_POST['grub_id'];
	// var_dump($val_id);
	$i = 0;
	$berhasil = 0;
	$gagal = 0;
	foreach ($val_id as $id) {
		$hari = $_POST['hari'][$i];
		$urutan = $_POST['urutan'][$i];
		$sql = "INSERT INTO LT_add_transport VALUES ('','$date','','$master_id','$copy_id','$grub_id','1','$hari','$urutan','$id','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
		$i++;
	}
} else if ($_POST['id'] == '6') {
	// var_dump($_POST['detail']);
	$val_id = $_POST['detail'];
	$grub_id = $_POST['grub_id'];
	$tgl = $_POST['tgl'];
	$i = 0;
	$berhasil = 0;
	$gagal = 0;

	$query_cek = "SELECT * FROM LT_add_transport where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "' && tgl_sfee='" . $tgl . "'";
	$rs_cek = mysqli_query($con, $query_cek);
	$row_cek = mysqli_fetch_array($rs_cek);
	if ($row_cek['id'] == "") {
		foreach ($val_id as $id) {
			$hari = $_POST['hari'][$i];
			$urutan = $_POST['urutan'][$i];
			$sql = "INSERT INTO LT_add_transport VALUES ('','$date','$tgl','$master_id','$copy_id','$grub_id','1','$hari','$urutan','$id','$status')";
			// var_dump($sql);
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$i++;
		}
	} else {
		$i = 0;
		foreach ($val_id as $id) {
			$hari = $_POST['hari'][$i];
			$urutan = $_POST['urutan'][$i];
			$sql2 = "UPDATE LT_add_transport SET hari='" . $hari . "', urutan='" . $urutan . "'  where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "' && tgl_sfee='" . $tgl . "' && transport='" . $id . "'";
			if (mysqli_query($con, $sql2)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$i++;
		}
	}
} else if ($_POST['id'] == '7') {
	$val_id = $_POST['detail'];
	$grub_id = $_POST['grub_id'];
	$sfee_id = $_POST['sfee_id'];
	$tgl = $_POST['tgl'];
	$i = 0;
	$berhasil = 0;
	$gagal = 0;

	$query_cek = "SELECT * FROM LT_add_transport_baru where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "' && type='1'";
	$rs_cek = mysqli_query($con, $query_cek);
	$row_cek = mysqli_fetch_array($rs_cek);
	if ($row_cek['id'] == "") {
		foreach ($val_id as $id) {
			$hari = $_POST['hari'][$i];
			$urutan = $_POST['urutan'][$i];
			$sql = "INSERT INTO LT_add_transport_baru VALUES ('','$date','$tgl','$master_id','$copy_id','$grub_id','$sfee_id','1','$hari','$urutan','$id','$status')";
			// var_dump($sql);
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$i++;
		}
	} else {
		$i = 0;
		foreach ($val_id as $id) {
			$hari = $_POST['hari'][$i];
			$urutan = $_POST['urutan'][$i];
			$sql2 = "UPDATE LT_add_transport_baru SET hari='" . $hari . "', urutan='" . $urutan . "'  where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "' && sfee_id='" . $sfee_id . "' && transport='" . $id . "'";
			if (mysqli_query($con, $sql2)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$i++;
		}
	}
} else if ($_POST['id'] == '8') {
	$grub_id = $_POST['grub_id'];
	$sfee_id = $_POST['sfee_id'];
	$tgl = $_POST['tgl'];
	$berhasil = 0;
	$gagal = 0;

	// $query_cek = "SELECT * FROM LT_add_transport_baru where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "' && type='2'";
	// $rs_cek = mysqli_query($con, $query_cek);
	// $row_cek = mysqli_fetch_array($rs_cek);
	// if ($row_cek['id'] == "") {
		$i=0;
		foreach ($_POST['hari'] as $val) {
			$hari = $val;
			$urutan = $_POST['urutan'][$i];
			$f_name = $_POST['f_name'][$i];
			$sql = "INSERT INTO LT_add_transport_baru VALUES ('','$date','$tgl','$master_id','$copy_id','$grub_id','$sfee_id','2','$hari','$urutan','$f_name','$status')";
			// var_dump($sql);
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
			$i++;
		}
	// } else {
		// $i=0;
		// foreach ($_POST['hari'] as $val) {
		// 	$hari = $val;
		// 	$urutan = $_POST['urutan'][$i];
		// 	$f_name = $_POST['f_name'][$i];
		// 	$sql2 = "UPDATE LT_add_transport_baru SET hari='" . $hari . "', urutan='" . $urutan . "'  where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "' && transport='" . $f_name . "'";
		// 	if (mysqli_query($con, $sql2)) {
		// 		$berhasil++;
		// 	} else {
		// 		$gagal++;
		// 	}
		// 	$i++;

		// }

	// }
}else if($_POST['id'] == '9'){
	$grub_id = $_POST['grub_id'];
	$sfee_id = $_POST['sfee_id'];
	$tgl = $_POST['tgl'];
	$berhasil = 0;
	$gagal = 0;
	$i=0;
	foreach ($_POST['hari'] as $val) {
		$nama = $_POST['t_name'][$i];
		$t_tgl = $_POST['t_tgl'][$i];
		$adt = $_POST['t_adult'][$i];
		$chd = $_POST['t_child'][$i];
		$inf = $_POST['t_infant'][$i];
		$hari = $val;
		$urutan = $_POST['urutan'][$i];
		
		$sql3 = "INSERT INTO train_LTnew VALUE ('','" . $t_tgl . "','" . $nama . "','" . $adt . "','" . $chd . "','" . $inf . "','$status')";
		if (mysqli_query($con, $sql3)) {
			$sql_get = "SELECT * FROM train_LTnew ORDER BY id DESC limit 1";
			$rs_get = mysqli_query($con, $sql_get);
			$row_get = mysqli_fetch_array($rs_get);
			if ($row_get['id'] != "") {

				$sql = "INSERT INTO LT_add_transport_baru VALUES ('','$date','$tgl','$master_id','$copy_id','$grub_id','$sfee_id','4','$hari','$urutan','".$row_get['id']."','$status')";
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			}


		}
		$i++;
	}
} else {

}

$con->close();
echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
