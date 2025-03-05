<?php

function get_tips_guide($x)
{

    include "../db=connection.php";
    $query_master = "SELECT LT_itinerary2.id as tour_id,LT_itinerary2.landtour,LT_itinnew.* FROM LT_itinerary2  INNER JOIN LT_itinnew ON LT_itinerary2.landtour=LT_itinnew.kode where  LT_itinerary2.id='" . $x . "' order by LT_itinnew.id ASC limit 1";
    $rs_master = mysqli_query($con, $query_master);
    $row_master = mysqli_fetch_array($rs_master);
    if ($row_master['landtour'] != "undefined") {
        if (isset($row_master['landtour'])) {
            $agent =  $row_master['agent'];
        } else {
            $agent = "PTT";
        }
        $exp_negara = preg_split("( - )", $row_master['negara']);
        if (count($exp_negara) > 1) {
            $data = [];
            $guide = 0;
            foreach ($exp_negara as $value) {
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && tour_code='" . $row_master['landtour'] . "' && negara = '" . $value . "' && type='B' ";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);
                if (isset($row_tips['kurs'])) {
                    $value = $row_tips['guide'] * $row_tips['tt_hari'];
                    $datareq = array(
                        "kurs" => $row_tips['kurs'],
                        "nominal" => $value,
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $value_guide = $result_show_kurs['data'];
                    $guide = $guide + $value_guide;
                }
                //  array_push($data,$datareq);
            }
            return json_encode(array("adt" => $guide, "chd" => $guide, "inf" => $guide, "sgl" => $guide, "detail" => $exp_negara), true);
        } else {
            $data = [];
            $guide = 0;
            $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara ='" . $row_master['negara'] . "' && type='A' &&  '" . $row_master['pax'] . "' <= until_pax && '" . $row_master['pax'] . "' >= tt_pax ";
            $rs_tips = mysqli_query($con, $query_tips);
            $row_tips = mysqli_fetch_array($rs_tips);
            if (isset($row_tips['id'])) {
                array_push($data, $query_tips);

                $value = intval($row_tips['guide']) * intval($row_master['hari']);
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_guide = $result_show_kurs['data'];

                // array_push($data, $value_guide);
                $guide = $guide + $value_guide;
            }

            // array_push($data, $query_tips);
            return json_encode(array("adt" => $guide, "chd" => $guide, "inf" => $guide, "sgl" => $guide, "detail" => $query_tips), true);
        }
    } else {
        $query_negara = "SELECT * FROM tips_negara WHERE master_id='" . $master_id . "' && copy_id='$copy_id'";
        $rs_negara = mysqli_query($con, $query_negara);
        $row_negara = mysqli_fetch_array($rs_negara);
        if ($row_negara['id'] != "") {
            $exp_negara = preg_split("( - )", $row_negara['negara']);
            if (count($exp_negara) > 1) {
                $guide = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara = '" . $value . "' && type='B' ";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);
                    if ($row_tips['id'] != "") {
                        $value = $row_tips['guide'] * $row_tips['tt_hari'];
                        $datareq = array(
                            "kurs" => $row_tips['kurs'],
                            "nominal" => $value,
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $value_guide = $result_show_kurs['data'];
                        $guide = $guide + $value_guide;
                    }
                }

                return json_encode(array("adt" => $guide, "chd" => $guide, "inf" => $guide, "sgl" => $guide, "detail" => $exp_negara), true);
            } else {
                $data = [];
                $guide = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $row_negara['negara'] . "' && type='A'";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);
                array_push($data, $query_tips);

                $value = $row_tips['guide'] * $row_master['hari'];
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_guide = $result_show_kurs['data'];

                $guide = $guide + $value_guide;
                return json_encode(array("adt" => $guide, "chd" => $guide, "inf" => $guide, "sgl" => $guide, "detail" => $exp_negara), true);
            }
        }
    }
}
function get_tips_tl($x)
{

    include "../db=connection.php";
    // tnpa kode blom di tentukan
    $query_tl = "SELECT * FROM  LT_add_Tips where tour_id='" . $x . "' order by hari ASC";
    $rs_tl = mysqli_query($con, $query_tl);
    $price = 0;
    $data = [];
    while ($row_tl = mysqli_fetch_array($rs_tl)) {
        $query_tl2 = "SELECT * FROM  Tips_Landtour where id=" . $row_tl['tl'];
        $rs_tl2 = mysqli_query($con, $query_tl2);
        $row_tl2 = mysqli_fetch_array($rs_tl2);
        $price = $price + intval($row_tl2['tl']);
    }
    return json_encode(array("adt" => $price, "chd" => $price, "inf" => $price, "sgl" => $price, "detail" => $data), true);
}
function get_lt_meal($x)
{
    include "../db=connection.php";
    $queryMeal = "SELECT LT_add_meal.*, CASE WHEN bf_meal.negara IS NOT NULL THEN bf_meal.negara WHEN ln_meal.negara IS NOT NULL THEN ln_meal.negara ELSE dn_meal.negara END as negara,CASE WHEN bf_meal.kurs IS NOT NULL THEN bf_meal.kurs WHEN ln_meal.kurs IS NOT NULL THEN ln_meal.kurs ELSE dn_meal.kurs END as kurs, bf_meal.price as breakfast , ln_meal.price as lunch, dn_meal.price as dinner FROM `LT_add_meal` LEFT JOIN Guest_meal2 as bf_meal ON (bf_meal.id=LT_add_meal.bf) LEFT JOIN Guest_meal2 as ln_meal ON (ln_meal.id=LT_add_meal.ln) LEFT JOIN Guest_meal2 as dn_meal ON (dn_meal.id=LT_add_meal.dn) WHERE tour_id='" . $x . "' order by LT_add_meal.hari ASC";
    $rsMeal = mysqli_query($con, $queryMeal);
    $gt_meal = 0;
    // var_dump($queryMeal);
    while ($rowMeal = mysqli_fetch_array($rsMeal)) {
        $data_bf = array(
            "kurs" =>  $rowMeal['kurs'],
            "price" => $rowMeal['breakfast'],
        );
        $show_rate_bf = get_rate($data_bf);
        $result_rate_bf = json_decode($show_rate_bf, true);
        ///////////////////////
        $data_ln = array(
            "kurs" =>  $rowMeal['kurs'],
            "price" => $rowMeal['lunch'],
        );
        $show_rate_ln = get_rate($data_ln);
        $result_rate_ln = json_decode($show_rate_ln, true);
        ///////////////////////////
        $data_dn = array(
            "kurs" =>  $rowMeal['kurs'],
            "price" => $rowMeal['dinner'],
        );
        $show_rate_dn = get_rate($data_dn);
        $result_rate_dn = json_decode($show_rate_dn, true);

        $total = $result_rate_bf['price'] + $result_rate_ln['price'] + $result_rate_dn['price'];
        $gt_meal += $total;
    }
    return $gt_meal;
}

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

    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $adt . "' && price2 >='" . $adt . "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);

    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }

    $adt_price = intval($adt) * ($pr / 100);
    $adt = $adt  +  $adt_price;
    return json_encode(array("status" => "ok", "price" => $adt), true);
}

function get_landtour($x)
{
    include "../db=connection.php";
    $query_itin = "SELECT * FROM  LT_itinnew where id=" . $x;
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_assoc($rs_itin);
    array_push($data, $row_itin['judul']);
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
    // var_dump($sql_profit);

    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }

    $nom = $row_profit['nominal'];

    $atwn =  ($agent_twn * $pr / 100) + $agent_twn + $nom;
    $asgl =  ($agent_sgl * $pr / 100) + $agent_sgl + $nom;
    $acnb =  ($agent_cnb * $pr / 100) + $agent_cnb + $nom;
    // $asglsub =  ($row_itin['agent_sglsub'] * $pr / 100) + $row_itin['agent_sglsub'];
    $ainfant =  ($agent_inf * $pr / 100) + $agent_inf + $nom;

    return json_encode(array("adt" =>  $atwn, "chd" =>  $acnb, "inf" => $ainfant, "sgl" => $asgl, "detail" => $data), true);
}


function get_include($val,$id)
{
    include "../db=connection.php";

    $query_cek2 = "SELECT * FROM LT_include_master where  master_id='" . $val . "'";
    $rs_cek2 = mysqli_query($con, $query_cek2);
    $row_cek2 = mysqli_fetch_array($rs_cek2);

    $in_chck = [];
    if (isset($row_cek2['id'])) {
        $in_chck = explode(",", $row_cek2['chck']);
    }
    $twn = 0;
    $sgl = 0;
    $inf = 0;
    $cnb = 0;
    foreach ($in_chck as $check) {
        if ($check == '15') {
            /// landtour
        } else if ($check == '22') {
            // rent trans
        } else if ($check == '26') {
        } else if ($check == '27') {

           $data_tips_tl = get_tips_tl($val);
           $rs_tips_tl = json_decode($data_tips_tl,true);
           $twn += $rs_tips_tl['adt'];
           $sgl += $rs_tips_tl['sgl'];  
           $cnb += $rs_tips_tl['cnb']; 
           $inf += $rs_tips_tl['inf'];

        } else if ($check == '56') {
            $meal = get_lt_meal($val);
            $twn += $meal;
            $sgl += $meal;  
            $cnb += $meal; 
            $inf += $meal;
        } else if ($check == '32') {
        } else if ($check == '33') {
        } else {
        }
    }
    if (empty($in_chck)) {
        echo json_encode(array("status" => '0', "data" => "data kosong"), true);
    } else {
        echo json_encode(array("status" => '1', "data" => $in_chck,"twn"=>$twn,"cnb"=>$cnb,"inf"=>$inf), true);
    }
    // return $in_chck;
}

function get_itin($id)
{
    include "../db=connection.php";
    $query_data = "SELECT LT_itinnew.*,LT_itinerary2.id as master_id FROM LT_itinnew INNER JOIN LT_itinerary2 ON LT_itinnew.kode=LT_itinerary2.landtour where LT_itinerary2.id='" . $id . "' order by LT_itinnew.pax ASC";
    $rs_data = mysqli_query($con, $query_data);
    $row_data = mysqli_fetch_array($rs_data);
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

function get_price_lain($val)
{

    // dammy
    $master_id = '28';
    $tl_pax  = '10';
    $tl_fee = '10000';
    $tl_meal = '11000';
    $tl_tlpn = '12000';
    $tl_sfee = '13000';
    $lain = '14000';
    $id = '3308';

    get_include($master_id,$id);


}

//// cek value disini ////////////
// get_price_lain(21);
// $data = get_price_lain(28);
// $rs_data = json_decode($data,true);
// var_dump($rs_data);
get_include('28','3308');