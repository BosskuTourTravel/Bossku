<?php
include "../site.php";
include "../db=connection.php";
session_start();

$agent = $_POST['agent'];
$country = $_POST['country'];
$city = $_POST['city'];
$continent = $_POST['continent'];
$season = $_POST['season'];
$kurs = $_POST['kurs'];
$totalren = $_POST['totalren'.$x];
$totaltrans = $_POST['totaltrans'.$x];

for ($x = 0; $x < $totaltrans; $x++){
    $txttp = "tp".$x;
    $txtseat = "seat".$x;
    for ($y = 0; $y < $totalren; $y++) {
        $txtren = "ren".$x.$y;
        $txtdurasi = "durasi".$x.$y;
        $txtharga = "harga".$x.$y;
        $txtremarks = "remarks".$x.$y;


$cekifnull = 0;

$tp = $_POST[$txttp];
$seat = $_POST[$txtseat];
$ren = $_POST[$txtren];
$durasi = $_POST[$txtdurasi];
$harga= $_POST[$txtharga];
$remarks = $_POST[$txtremarks];

if($tp==''){
    $cekifnull = $cekifnull + 1;
}
if($seat==''){
    $cekifnull = $cekifnull + 1;
}
if($ren==''){
    $cekifnull = $cekifnull + 1;
}
if($durasi==''){
    $cekifnull = $cekifnull + 1;
}
if($harga==''){
    $cekifnull = $cekifnull + 1;
}
if($remarks==''){
    $cekifnull = $cekifnull + 1;
}


if($cekifnull!=6){
    if ($harga != 0){
$sql = "INSERT INTO transport VALUES ('',".$agent.",'".$continent."','".$country."','".$city."','".$season."','".$kurs."','".$tp."','".$seat."','".$ren."','".$durasi."','".$harga."','".$remarks."')";

    if (mysqli_query($con, $sql)) {
        echo "success   ";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
    }

    }else{ echo"gagal";}
}
}
 }

    $con->close();


?>
    