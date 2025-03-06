<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$status = $_SESSION['staff_id'];
$mulai = explode(",", $_POST['mulai']);
$until = explode(",", $_POST['until']);
$profit = explode(",", $_POST['profit']);
$admin = explode(",", $_POST['admin']);
$admin_tokped = explode(",", $_POST['admin_tokped']);
$admin_shopee = explode(",", $_POST['admin_shopee']);
$admin_blibli = explode(",", $_POST['admin_blibli']);
$marketing = explode(",", $_POST['marketing']);
$sub_agent = explode(",", $_POST['sub_agent']);
$staff = explode(",", $_POST['staff']);
$nominal = explode(",",$_POST['nominal']);

$berhasil = 0;
$gagal = 0;

if (!empty($_POST['mulai'])) {
	$i = 0;
	foreach ($mulai as $value) {
		$sql = "INSERT INTO LTR_profit_range VALUES ('','$date','" . $value . "','" . $until[$i] . "','" . $profit[$i] . "','" . $admin[$i] . "','" . $admin_tokped[$i] . "','" . $admin_shopee[$i] . "','" . $admin_blibli[$i] . "','" . $marketing[$i] . "','" . $sub_agent[$i] . "','" . $staff[$i] . "','".$nominal[$i]."','$status')";
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
		$i++;
	}
	$con->close();
	echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
}
