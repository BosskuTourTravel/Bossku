<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
session_start();

$mp_id =  $_POST['id'];
// $mp_id = '1';

$berhasil = 0;
$gagal = 0;
$query = "SELECT * FROM Upload_tokopedia_rent where mp_id='" . $mp_id . "' ORDER BY id ASC limit 300";
$rs = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($rs)) {
    $query_trans = "SELECT * FROM Transport_new where id='" . $row['trans_id'] . "'";
    $rs_trans = mysqli_query($con, $query_trans);
    $row_trans = mysqli_fetch_array($rs_trans);


    if ($row['varian'] == "One Way") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['oneway'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];


        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Two Way") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['twoway'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];

        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Half Day 1") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['hd1'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];


        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Half Day 2") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['hd2'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];

        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Full Day 1") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['fd1'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];

        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Full Day 2") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['fd2'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];

        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Kaisoda") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['kaisoda'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];

        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else if ($row['varian'] == "Luar Kota") {
        $datareq = array(
            "kurs" =>  $row_trans['kurs'],
            "nominal" => $row_trans['luarkota'],
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        $harga = $result_show_kurs['data'];

        $sql = "UPDATE Upload_tokopedia_rent SET Harga='" . $harga . "' WHERE id='" . $row['id'] . "'";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    } else {
    }
}
echo "Update Berhasil :" . $berhasil . " Gagal :" . $gagal;
