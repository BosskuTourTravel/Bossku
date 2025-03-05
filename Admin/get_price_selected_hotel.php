<?php

function get_price_selected_hotel($x)
{
    include "../db=connection.php";

    $query_hh = "SELECT * FROM LAN_Hotel_List where status='" . $x . "' order by hari ,urutan ASC";
    $rs_hh = mysqli_query($con, $query_hh);
    $gt = 0;

    while ($row_hh = mysqli_fetch_array($rs_hh)) {
        $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hh['hotel_id'] . "'";
        $rs_hlt = mysqli_query($con, $query_hlt);
        $row_hlt = mysqli_fetch_array($rs_hlt);

        if ($row_hh['rate'] == '1') {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "price" => $row_hlt['rate_low'],
            );
            $show_rate2 = get_rate($data);
            $result_rate2 = json_decode($show_rate2, true);

            $gt = $gt + $result_rate2['price'];

        } else {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "price" => $row_hlt['rate_high'],
            );
            $show_rate2 = get_rate($data);
            $result_rate2 = json_decode($show_rate2, true);


            $gt = $gt + $result_rate2['price'];

        }
    }



    return json_encode(array("status" => "ok", "price" => $gt), true);
}
