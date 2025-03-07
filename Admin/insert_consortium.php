<?php
include "../db=connection.php";
session_start();
// cek route
$test = 0;
$invalid = 0;
$berhasil = 0;
$gagal = 0;
$loop = $_POST['loop'];
$tgl = date("Y-m-d");
for ($i = 1; $i <= $loop; $i++) {
    $continent = $_POST['con' . $i];
    $region = $_POST['region' . $i];
    $country = $_POST['coun' . $i];
    $city = $_POST['city' . $i];
    $adt = $_POST['adt' . $i];
    $chd = $_POST['chd' . $i];
    $inf = $_POST['inf' . $i];
    $nama = $_POST['nama' . $i];
    $kurs = $_POST['kurs' . $i];
    $pdf = $_POST['pdf' . $i];
    $img = $_POST['img' . $i];
    if ($adt != "" && $city !="" && $continent !="" && $country !="") {
        $sql = "INSERT INTO consortium_list VALUES ('','" . $continent . "','" . $region . "','" . $country . "','" . $city . "','" . $nama . "','" . $kurs . "','" . $adt . "','" . $chd . "','" . $inf . "','" . $pdf . "','" . $img . "','" . $tgl . "','" . $_SESSION['staff_id'] . "')";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    }
}
echo "Data berhasil Upload : " . $berhasil . ", ";
echo "Data gagal Upload : " . $gagal . " ";