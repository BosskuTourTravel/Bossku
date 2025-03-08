<?php
include "../db=connection.php";
session_start();
// cek route
$tgl = date("Y-m-d");
$continent = $_POST['con'];
$region = $_POST['region'];
$country = $_POST['coun'];
$city = $_POST['city'];
$adt = $_POST['adt'];
$chd = $_POST['chd'];
$inf = $_POST['inf'];
$nama = $_POST['nama'];
$kurs = $_POST['kurs'];
$pdf = $_POST['pdf'];
$img = $_POST['img'];
if ($adt != "" && $city != "" && $continent != "" && $country != "") {

    $sql = "UPDATE consortium_list SET continent='" . $continent . "',detail='".$region."',country='".$country."',city='".$city."',nama='".$nama."',adt='".$adt."',chd='".$chd."',inf='".$inf."',kurs='".$kurs."',link_gambar='".$img."',link_pdf='".$pdf."' WHERE id='" . $_POST['id'] . "'";
    if (mysqli_query($con, $sql)) {
       echo "Berhasil";
    } else {
       echo "gagal";
    }

}
