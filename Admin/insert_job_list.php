<?php
include "../db=connection.php";
$data = explode(",", $_POST['lt_id']);
$staff = $_POST['staff_id'];
$tgl = date("Y-m-d");
$berhasil = 0;
$gagal = 0;
foreach ($data as $val) {
    $sql = "INSERT INTO LT_job_list VALUES ('','" . $tgl . "','" . $staff . "','" . $val . "','0')";
    if (mysqli_query($con, $sql)) {
        $berhasil++;
    } else {
       $gagal++;
    }
}
echo "berhasil : ".$berhasil." Gagal: ".$gagal;