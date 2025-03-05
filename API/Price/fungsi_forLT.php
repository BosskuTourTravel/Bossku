<?php
function get_hotel_forLT($datareq)
{
    include "db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $sfee_id = $datareq['sfee_id'];

    $query_hotel_data = "SELECT * FROM LT_AH_ListHotel WHERE copy_id='" . $copy_id . "' && master_id='" . $master_id . "' && sfee_id='".$sfee_id."'";
    $rs_hotel_data = mysqli_query($con, $query_hotel_data);
    $gt = 0;
    while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
        $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
        $rs_hlt = mysqli_query($con, $query_hlt);
        $row_hlt = mysqli_fetch_array($rs_hlt);
        if ($row_hotel_data['rate'] == '1') {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "price" => $row_hlt['rate_low'],
            );
            $show_rate2 = get_rate_forLT($data);
            $result_rate2 = json_decode($show_rate2, true);

            $gt = $gt + $result_rate2['price'];
            // echo number_format($result_rate2['price'], 0, ",", ".");
        } else {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "price" => $row_hlt['rate_high'],
            );
            $show_rate2 = get_rate_forLT($data);
            $result_rate2 = json_decode($show_rate2, true);
          

            $gt = $gt + $result_rate2['price'];
            // echo number_format($result_rate2['price'], 0, ",", ".");
        }
    }
    return json_encode(array("adt" => $gt, "chd" => $gt, "inf" => $gt, "sgl" => $gt, "detail" =>$query_hlt), true);
}

function get_rate_forLT($v)
{
    include "db=connection.php";
    // konversi kurs
    $low = array(
        "kurs" =>  $v['kurs'],
        "nominal" => $v['price'],
    );

    $show_kurs_low = get_kurs_forLT($low);
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


function get_kurs_forLT($d)
{
    include "db=connection.php";
    $kurs = $d['kurs'];
    $nominal = $d['nominal'];
    $query = "SELECT * FROM  kurs_bca_field where nama = '" . $kurs . "' order by id ASC ";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    if ($row['id'] == "") {
        return json_encode(array("status" => "data Kurs tidak Tersedia", "data" => '0'), true);
    } else {
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "data" => $nominal), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                $price = $nominal * $row['jual'];
                return json_encode(array("status" => $result_data['status'], "data" => $price), true);
            }
        }
    }
}

?>