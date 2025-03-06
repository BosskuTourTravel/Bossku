<?php
include "../db=connection.php";
$agent = intval($_POST['agent']);
$berhasil = 0;
$gagal = 0;
for ($i = 1; $i <= $_POST['item']; $i++) {
    $cont = $_POST['con' . $i];
    $cou = $_POST['cou' . $i];
    $cit = $_POST['cit' . $i];
    $periode = $_POST['periode' . $i];
    $trns_type = $_POST['trans_type' . $i];
    $seat =  intval($_POST['seat' . $i]);
    $kurs = $_POST['kurs' . $i];
    $oneway = intval($_POST['oneway' . $i]);
    $twoway = intval($_POST['twoway' . $i]);
    $hd1 = intval($_POST['hd1' . $i]);
    $hd2 = intval($_POST['hd2' . $i]);
    $fd1 = intval($_POST['fd1' . $i]);
    $fd2 = intval($_POST['fd2' . $i]);
    $kaisoda = intval($_POST['kaisoda' . $i]);
    $luarkota = intval($_POST['luarkota' . $i]);
    $remarks = $_POST['ket' . $i];

    $sql2 = "INSERT INTO Transport_new VALUES ('','" . $agent . "','" . $cont . "','" . $cou . "','" . $cit . "','" . $periode . "','" . $kurs . "','" . $trns_type . "','" . $seat . "','','" . $oneway . "','".$twoway."','" . $hd1 . "','" . $hd2 . "','" . $fd1 . "','" . $fd2 . "','" . $kaisoda . "','" . $luarkota . "','" . $remarks . "','')";
    if (mysqli_query($con, $sql2)) {
        $berhasil++;
    } else {
        $gagal++;
    }

}
echo "Berhasil : ".$berhasil." , Gagal : ".$gagal;