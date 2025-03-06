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

	foreach ($date_set as $val) {
		// var_dump($val);

		$query_sfee = "SELECT id FROM LTP_insert_sfee where date_set ='" . $val . "' && id_grub='".$id_grub ."'";
		$rs_sfee = mysqli_query($con, $query_sfee);
		$row_sfee = mysqli_fetch_array($rs_sfee);

		if ($row_sfee['id'] == "") {
			$sql = "INSERT INTO LTP_insert_sfee VALUES ('','" . $date . "','" . $val . "','" . $id_grub . "','" . $adt . "','" . $chd . "','" . $inf . "','$status')";
			if (mysqli_query($con, $sql)) {
				$berhasil++;
			} else {
				$gagal++;
			}
		} else {
			$sql2 = "UPDATE LTP_insert_sfee SET adt='" . $adt . "', chd='" . $chd . "', inf='" . $inf . "',date_set='".$val."' where  id=" . $row_sfee['id'];
			if (mysqli_query($con, $sql2)) {
				$uberhasil++;
			} else {
				$ugagal++;
			}
		}
	}
	echo "Berhasil : " . $berhasil . ", Gagal : " . $gagal . " "."Update Berhasil : " . $uberhasil . ", Update Gagal : " . $ugagal;
} else {
	// $sql2 = "UPDATE LTP_insert_sfee SET adt='" . $adt . "', chd='" . $chd . "', inf='" . $inf . "',date_set='".$date_set."' where  id_grub=" . $id_grub;
	// if (mysqli_query($con, $sql2)) {
	// 	echo "Update Berhasil";
	// } else {
	// 	echo "Update Gagal";
	// }
}
$con->close();
