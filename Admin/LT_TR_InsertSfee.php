<?php
include "../site.php";
include "../db=connection.php";
session_start();

$status = $_SESSION['staff_id'];
$date = date("Y-m-d");
$adt = $_POST['adt'];
$chd = $_POST['chd'];
$inf = $_POST['inf'];
$date_set = explode(",", $_POST['tgl']);
$id_grub = $_POST['id'];
$berhasil = 0;
$gagal = 0;
$uberhasil = 0;
$ugagal = 0;
if ($_POST['z'] == '0') {

	$query_sfee = "SELECT * FROM LTP_insert_sfee where id_grub='".$id_grub ."' && adt='" . $adt . "' && chd='" . $chd . "' && inf='" . $inf . "'";
	$rs_sfee = mysqli_query($con, $query_sfee);
	$row_sfee = mysqli_fetch_array($rs_sfee);
	if ($row_sfee['id'] == "") {

		$sql = "INSERT INTO LTP_insert_sfee VALUES ('','" . $date . "','','" . $id_grub . "','" . $adt . "','" . $chd . "','" . $inf . "','$status')";
		if (mysqli_query($con, $sql)) {

			$query_sfee_tgl = "SELECT id FROM LTP_insert_sfee order by id DESC limit 1";
			$rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
			$row_sfee_tgl = mysqli_fetch_array($rs_sfee_tgl);

			foreach ($date_set as $val) {
				$sql2 = "INSERT INTO LTP_tgl_sfee VALUES ('','" . $row_sfee_tgl['id'] . "','" . $val . "','$status')";
				if (mysqli_query($con, $sql2)) {
					$berhasil++;
				}
				
			}
		} else {
			$gagal++;
		}

	}else{
		foreach ($date_set as $val) {
			$sql3 = "INSERT INTO LTP_tgl_sfee VALUES ('','" . $row_sfee['id'] . "','" . $val . "','$status')";
			if (mysqli_query($con, $sql3)) {
				$berhasil++;
			}
		}
	}
}
echo "Berhasil : " . $berhasil . ", Gagal : " . $gagal;
$con->close();
