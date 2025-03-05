<?php

function get_rate($v)
{
    include "../db=connection.php";
    // konversi kurs
    $low = array(
        "kurs" =>  $v['kurs'],
        "nominal" => $v['price'],
    );

    $show_kurs_low = get_kurs($low);
    $rs_kurs_low = json_decode($show_kurs_low, true);

    $adt = $rs_kurs_low['data'];

    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $adt . "' && price2 >='" . $adt. "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);

    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }

    $adt_price = intval($adt) * ($pr / 100);
    $adt = $adt  +  $adt_price ;
    return json_encode(array("status" => "ok", "price" => $adt), true);
}


function get_kurs($d)
{
    include "../db=connection.php";
    $kurs = $d['kurs'];
    $nominal = $d['nominal'];
    $query = "SELECT * FROM  kurs_bca_field where nama = '" . $kurs . "' order by id ASC ";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    if (!isset($row['id'])) {
        return json_encode(array("status" => "data Kurs tidak Tersedia", "data" => '0'), true);
    } else {
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "data" => $nominal), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                $price = $nominal * $row['jual'];
                return json_encode(array("status" => "berhasil", "data" => $price), true);
            }
        }
    }
}

