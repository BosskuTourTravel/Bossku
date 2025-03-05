<?php
include "../site.php";
include "../db=connection.php";
session_start();
$tgl = date("Y-m-d");
$master_id = $_POST['master_id'];
$copy_id = $_POST['copy_id'];
$status = $_SESSION['staff_id'];
$tmp11 = $_POST['tmp11'];
$tmp12 = $_POST['tmp12'];
$tmp21 = $_POST['tmp21'];
$tmp22 = $_POST['tmp22'];
$rute1 = $_POST['rute1'];
$rute2 = $_POST['rute2'];


$arr = [];
if ($rute1 != "") {
    $data = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "type" => "1",
        "rute" => $rute1,
        "tmp1" => $tmp11,
        "tmp2" => $tmp12
    );
    array_push($arr, $data);
}
if ($rute2 != "") {
    $data = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "type" => "2",
        "rute" => $rute2,
        "tmp1" => $tmp21,
        "tmp2" => $tmp22
    );
    array_push($arr, $data);
}
$berhasil = 0;
$gagal = 0 ;
foreach ($arr as $val) {
    $query = "INSERT INTO LT_Custom_Rute VALUES ('','$tgl','".$val['master_id']."','".$val['copy_id']."','".$val['type']."','".$val['rute']."','".$val['tmp1']."','".$val['tmp2']."','$status')";
    if (mysqli_query($con, $query)) {
        $berhasil++;
    } else {
       $gagal++;
    }
}
echo "Berhasil : ".$berhasil." , Gagal : ".$gagal;
$con->close();

