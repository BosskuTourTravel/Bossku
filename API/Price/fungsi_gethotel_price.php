<?php
function get_hotel_price($data)
{
    include "db=connection.php";

    $querySH_cek = "SELECT * FROM  LT_select_PilihHTL WHERE copy_id='" .  $data['copy_id'] . "' && master_id='" . $data['master_id'] . "' order by hari ASC";
    $rsSH_cek = mysqli_query($con, $querySH_cek);
    $arr_hotel = [];
    $ih = 1;
    $id_hotel = '';
    // var_dump()
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

    $data_twn = array(
        "kurs" => $row_itin['kurs'],
        "nominal" => $row_itin['agent_twn'],
    );
    $data_sgl = array(
        "kurs" => $row_itin['kurs'],
        "nominal" => $row_itin['agent_sgl'],
    );
    $data_cnb = array(
        "kurs" => $row_itin['kurs'],
        "nominal" => $row_itin['agent_cnb'],
    );
    $data_inf = array(
        "kurs" => $row_itin['kurs'],
        "nominal" => $row_itin['agent_infant'],
    );
    $show_kurs_twn = get_kurs($data_twn);
    $rs_kurs_twn = json_decode($show_kurs_twn, true);

    $show_kurs_sgl = get_kurs($data_sgl);
    $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

    $show_kurs_cnb = get_kurs($data_cnb);
    $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

    $show_kurs_inf = get_kurs($data_inf);
    $rs_kurs_inf = json_decode($show_kurs_inf, true);

    $agent_twn = $rs_kurs_twn['data'];
    $agent_sgl = $rs_kurs_sgl['data'];
    $agent_cnb = $rs_kurs_cnb['data'];
    $agent_inf = $rs_kurs_inf['data'];

    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);
    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }
    $nom = $row_profit['nominal'];
    $adm_twn = $agent_twn * $row_profit['adm_mkp'] / 100;
    $adm_sgl = $agent_sgl * $row_profit['adm_mkp'] / 100;
    $adm_cnb = $agent_cnb * $row_profit['adm_mkp'] / 100;
    $adm_inf =  $agent_inf * $row_profit['adm_mkp'] / 100;

    $adm_tokped_twn = $agent_twn * $row_profit['adm_tokped'] / 100;
    $adm_tokped_sgl = $agent_sgl * $row_profit['adm_tokped'] / 100;
    $adm_tokped_cnb = $agent_cnb * $row_profit['adm_tokped'] / 100;
    $adm_tokped_inf =  $agent_inf * $row_profit['adm_tokped'] / 100;

    $adm_shopee_twn = $agent_twn * $row_profit['adm_shopee'] / 100;
    $adm_shopee_sgl = $agent_sgl * $row_profit['adm_shopee'] / 100;
    $adm_shopee_cnb = $agent_cnb * $row_profit['adm_shopee'] / 100;
    $adm_shopee_inf =  $agent_inf * $row_profit['adm_shopee'] / 100;

    $adm_blibli_twn = $agent_twn * $row_profit['adm_blibli'] / 100;
    $adm_blibli_sgl =$agent_sgl * $row_profit['adm_blibli'] / 100;
    $adm_blibli_cnb = $agent_cnb * $row_profit['adm_blibli'] / 100;
    $adm_blibli_inf =  $agent_inf * $row_profit['adm_blibli'] / 100;

    $atwn =  ($agent_twn * $pr / 100) + $agent_twn + $nom;
    $asgl =  ($agent_sgl * $pr / 100) + $agent_sgl + $nom;
    $acnb =  ($agent_cnb * $pr / 100) + $agent_cnb + $nom;
    // $asglsub =  ($row_itin['agent_sglsub'] * $pr / 100) + $row_itin['agent_sglsub'];
    $ainfant =  ( $agent_inf * $pr / 100) +  $agent_inf + $nom;

    $pax_u = "";
    $pax_b = "";
    if ($row_cek_hotel['pax_u'] != 0) {
        $pax_u = "-" . $row_cek_hotel['pax_u'];
    }
    if ($row_cek_hotel['pax_b'] != 0) {
        $pax_b = "+" . $row_cek_hotel['pax_b'];
    }
    $pxx = $row_cek_hotel['pax'] . $pax_u . $pax_b . " pax";

    return json_encode(array(
        "pax" => $pxx, 
        "twn" => $atwn, 
        "cnb" => $acnb, 
        "inf" => $ainfant, 
        "sgl" =>$asgl, 
        "id_hotel" => $id_hotel, 
        "hotel" =>  $arr_hotel,
        "adm_twn" => $adm_twn,
        "adm_sgl" => $adm_sgl,
        "adm_cnb" => $adm_cnb,
        "adm_inf" => $adm_inf,
        "adm_tokped_twn" => $adm_tokped_twn,
        "adm_tokped_sgl" => $adm_tokped_sgl,
        "adm_tokped_cnb" => $adm_tokped_cnb,
        "adm_tokped_inf" => $adm_tokped_inf,
        "adm_shopee_twn" => $adm_shopee_twn,
        "adm_shopee_sgl" => $adm_shopee_sgl,
        "adm_shopee_cnb" => $adm_shopee_cnb,
        "adm_shopee_inf" => $adm_shopee_inf,
        "adm_blibli_twn" => $adm_blibli_twn,
        "adm_blibli_sgl" => $adm_blibli_sgl,
        "adm_blibli_cnb" => $adm_blibli_cnb,
        "adm_blibli_inf" => $adm_blibli_inf,
    ), true);
}


function get_hotel_all($data)
{
    include "db=connection.php";

    $id_hotel = $data['id'];
    $query_itin2 = "SELECT * FROM  LT_itinnew where id=" . $id_hotel;
    $rs_itin2 = mysqli_query($con, $query_itin2);
    $row_itin2 = mysqli_fetch_assoc($rs_itin2);
    $arr_hotel = [];
    for($i=0; $i < 10 ;$i++){
        if($row_itin2['hotel' . $i] != ""){
            $val = $row_itin2['hotel' . $i];
            array_push($arr_hotel,$val);
        }

    }

    
    $data_twn = array(
        "kurs" => $row_itin2['kurs'],
        "nominal" => $row_itin2['agent_twn'],
    );
    $data_sgl = array(
        "kurs" => $row_itin2['kurs'],
        "nominal" => $row_itin2['agent_sgl'],
    );
    $data_cnb = array(
        "kurs" => $row_itin2['kurs'],
        "nominal" => $row_itin2['agent_cnb'],
    );
    $data_inf = array(
        "kurs" => $row_itin2['kurs'],
        "nominal" => $row_itin2['agent_infant'],
    );
    $show_kurs_twn = get_kurs($data_twn);
    $rs_kurs_twn = json_decode($show_kurs_twn, true);

    $show_kurs_sgl = get_kurs($data_sgl);
    $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

    $show_kurs_cnb = get_kurs($data_cnb);
    $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

    $show_kurs_inf = get_kurs($data_inf);
    $rs_kurs_inf = json_decode($show_kurs_inf, true);

    $agent_twn = $rs_kurs_twn['data'];
    $agent_sgl = $rs_kurs_sgl['data'];
    $agent_cnb = $rs_kurs_cnb['data'];
    $agent_inf = $rs_kurs_inf['data'];


    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);
    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }
    $nom = $row_profit['nominal'];

    $atwn =  ($agent_twn * $pr / 100) +$agent_twn + $nom;
    $asgl =  ($agent_sgl * $pr / 100) + $agent_sgl + $nom;
    $acnb =  ($agent_cnb * $pr / 100) + $agent_cnb + $nom;
    // $asglsub =  ($row_itin2['agent_sglsub'] * $pr / 100) + $row_itin2['agent_sglsub'];
    $ainfant =  ($agent_inf * $pr / 100) + $agent_inf + $nom;

    $pax_u = "";
    $pax_b = "";
    if ($row_itin2['pax_u'] != 0) {
        $pax_u = "-" . $row_itin2['pax_u'];
    }
    if ($row_itin2['pax_b'] != 0) {
        $pax_b = "+" . $row_itin2['pax_b'];
    }
    $pxx = $row_itin2['pax'] . $pax_u . $pax_b . " pax";
    return json_encode(array("pax" => $pxx, "twn" => $atwn, "cnb" => $acnb, "inf" => $ainfant, "sgl" =>$asgl, "id_hotel" => $id_hotel, "hotel" =>  $arr_hotel), true);

}