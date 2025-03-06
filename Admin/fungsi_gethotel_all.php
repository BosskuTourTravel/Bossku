<?php
function get_hotel_price($data)
{
    include "../db=connection.php";

    $querySH_cek = "SELECT * FROM  LT_select_PilihHTL WHERE copy_id='" .  $data['copy_id'] . "' && master_id='" . $data['master_id'] . "' order by hari ASC";
    $rsSH_cek = mysqli_query($con, $querySH_cek);
    $arr_hotel = [];
    $ih = 1;
    $id_hotel = '';
    while ($rowSH_cek = mysqli_fetch_array($rsSH_cek)) {
        if ($ih == 1) {
            $id_hotel =  $rowSH_cek['hotel_id'];
        }

        $query_cek_hotel = "SELECT * FROM LT_itinnew WHERE id=" . $rowSH_cek['hotel_id'];
        $rs_cek_hotel = mysqli_query($con, $query_cek_hotel);
        $row_cek_hotel = mysqli_fetch_array($rs_cek_hotel);

        $i = $rowSH_cek['no_htl'];
        $val = "Hari " . $rowSH_cek['hari'] . " : " . $row_cek_hotel['hotel' . $i];
        array_push($arr_hotel, $val);
        $ih++;
    }

    $query_itin = "SELECT * FROM  LT_itinnew where id=" . $id_hotel;
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_assoc($rs_itin);

    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);
    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }
    $nom = $row_profit['nominal'];

    $atwn =  ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'] + $nom;
    $asgl =  ($row_itin['agent_sgl'] * $pr / 100) + $row_itin['agent_sgl'] + $nom;
    $acnb =  ($row_itin['agent_cnb'] * $pr / 100) + $row_itin['agent_cnb'] + $nom;
    $asglsub =  ($row_itin['agent_sglsub'] * $pr / 100) + $row_itin['agent_sglsub'];
    $ainfant =  ($row_itin['agent_infant'] * $pr / 100) + $row_itin['agent_infant'] + $nom;

    $pax_u = "";
    $pax_b = "";
    if ($row_cek_hotel['pax_u'] != 0) {
        $pax_u = "-" . $row_cek_hotel['pax_u'];
    }
    if ($row_cek_hotel['pax_b'] != 0) {
        $pax_b = "+" . $row_cek_hotel['pax_b'];
    }
    $pxx = $row_cek_hotel['pax'] . $pax_u . $pax_b . " pax";

    return json_encode(array("pax" => $pxx, "twn" => $atwn, "cnb" => $acnb, "inf" => $ainfant, "id_hotel" => $id_hotel, "hotel" =>  $arr_hotel), true);
}

