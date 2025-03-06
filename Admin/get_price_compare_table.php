<?php
function get_price_compare($x, $y)
{
    $x = 1;
    $gt_rent = get_price($x);
}

function get_price_hotel_com() {}

function get_price_guide($x, $y)
{
    // $x = 1;
    // $y = 28;

    include "../db=connection.php";
    $query_guide2 = "SELECT * FROM  LT_add_guide_price  where tour_id='" . $y . "' && package_id='" . $x . "'";
    $rs_guide2 = mysqli_query($con, $query_guide2);
    // var_dump($query_guide2);
    $n = 1;
    $grand_guide2 = 0;
    $grand_foc = 0;

    while ($row_guide2 = mysqli_fetch_array($rs_guide2)) {
        $fee_price2 = 0;
        $sfee_price2 = 0;
        $bf_price2 = 0;
        $ln_price2 = 0;
        $dn_price2 = 0;
        $vt_price2 = 0;

        $query_fee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['fee'] . "'";
        $rs_fee2 = mysqli_query($con, $query_fee2);
        $row_fee2 = mysqli_fetch_array($rs_fee2);
        if (isset($row_fee2['id'])) {
            $data_fee2 = array(
                "kurs" =>  $row_fee2['kurs'],
                "price" => $row_fee2['harga'],
            );
            $show_fee2 = get_rate($data_fee2);
            $result_fee2 = json_decode($show_fee2, true);

            $fee_price2 = $result_fee2['price'];
        }

        $query_sfee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['sfee'] . "'";
        $rs_sfee2 = mysqli_query($con, $query_sfee2);
        $row_sfee2 = mysqli_fetch_array($rs_sfee2);
        if (isset($row_sfee2['id'])) {
            $data_sfee2 = array(
                "kurs" =>  $row_sfee2['kurs'],
                "price" => $row_sfee2['harga'],
            );
            $show_sfee2 = get_rate($data_sfee2);
            $result_sfee2 = json_decode($show_sfee2, true);
            $sfee_price2 = $result_sfee2['price'];
        }

        $query_bf2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['bf'] . "'";
        $rs_bf2 = mysqli_query($con, $query_bf2);
        $row_bf2 = mysqli_fetch_array($rs_bf2);
        if (isset($row_bf2['id'])) {
            $data_bf2 = array(
                "kurs" =>  $row_bf2['kurs'],
                "price" => $row_bf2['harga'],
            );
            $show_bf2 = get_rate($data_bf2);
            $result_bf2 = json_decode($show_bf2, true);

            $bf_price2 = $result_bf2['price'];
        }

        $query_ln2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['ln'] . "'";
        $rs_ln2 = mysqli_query($con, $query_ln2);
        $row_ln2 = mysqli_fetch_array($rs_ln2);
        if (isset($row_ln2['id'])) {
            $data_ln2 = array(
                "kurs" =>  $row_ln2['kurs'],
                "price" => $row_ln2['harga'],
            );
            $show_ln2 = get_rate($data_ln2);
            $result_ln2 = json_decode($show_ln2, true);
            $ln_price2 = $result_ln2['price'];
        }

        $query_dn2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['dn'] . "'";
        $rs_dn2 = mysqli_query($con, $query_dn2);
        $row_dn2 = mysqli_fetch_array($rs_dn2);
        if (isset($row_dn2['id'])) {
            $data_dn2 = array(
                "kurs" =>  $row_dn2['kurs'],
                "price" => $row_dn2['harga'],
            );
            $show_dn2 = get_rate($data_dn2);
            $result_dn2 = json_decode($show_dn2, true);
            $dn_price2 = $result_dn2['price'];
        }

        $query_vt2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['vt'] . "'";
        $rs_vt2 = mysqli_query($con, $query_vt2);
        $row_vt2 = mysqli_fetch_array($rs_vt2);
        if (isset($row_vt2['id'])) {
            $data_vt2 = array(
                "kurs" =>  $row_vt2['kurs'],
                "price" => $row_vt2['harga'],
            );
            $show_vt2 = get_rate($data_vt2);
            $result_vt2 = json_decode($show_vt2, true);

            $vt_price2 = $result_vt2['price'];
        }

        $guide_total2 = $fee_price2 + $sfee_price2 + $bf_price2 + $ln_price2 + $dn_price2 + $vt_price2;
        $grand_guide2 = $grand_guide2 + $guide_total2;
        $grand_foc = $grand_foc + $bf_price2 + $ln_price2 + $dn_price2;
    }

    return json_encode(array("status" => "OK", "guide" => $grand_guide2, "foc" => $grand_foc), true);
}

function get_adm_price($x)
{
    include "../db=connection.php";
    $query_inc = "SELECT LT_add_listTmp.id,LT_add_listTmp.tour_id,LT_add_listTmp.hari,LT_add_listTmp.urutan,List_tempat.tempat,List_tempat.kurs,List_tempat.price as adt,List_tempat.chd as cnb,List_tempat.infant as inf,LT_add_ops.optional FROM LT_add_listTmp LEFT JOIN List_tempat ON List_tempat.id=LT_add_listTmp.tempat LEFT JOIN LT_add_ops ON (LT_add_ops.master_id=LT_add_listTmp.tour_id && LT_add_ops.hari=LT_add_listTmp.hari && LT_add_ops.urutan=LT_add_listTmp.urutan) WHERE tour_id = '" . $x . "' && LT_add_ops.optional='0' order by LT_add_listTmp.hari,LT_add_listTmp.urutan ASC";
    $rs_inc = mysqli_query($con, $query_inc);

    $total_inc = 0;
    while ($row_inc = mysqli_fetch_array($rs_inc)) {
        $inc_price = 0;
        if (isset($row_inc['kurs']) && $row_inc['adt'] != '0') {
            $data_inc = array(
                "kurs" =>  $row_inc['kurs'],
                "price" => $row_inc['adt'],
            );
            $show_inc = get_rate($data_inc);
            $result_rate_inc = json_decode($show_inc, true);
            $inc_price = $result_rate_inc['price'];
        }
        $total_inc += $inc_price;
    }

    return json_encode(array("status" => "ok", "price" => $total_inc), true);
}

function get_meal_price($x)
{
    include "../db=connection.php";

    $queryMeal = "SELECT LT_add_meal.*, CASE WHEN bf_meal.negara IS NOT NULL THEN bf_meal.negara WHEN ln_meal.negara IS NOT NULL THEN ln_meal.negara ELSE dn_meal.negara END as negara,CASE WHEN bf_meal.kurs IS NOT NULL THEN bf_meal.kurs WHEN ln_meal.kurs IS NOT NULL THEN ln_meal.kurs ELSE dn_meal.kurs END as kurs, bf_meal.price as breakfast , ln_meal.price as lunch, dn_meal.price as dinner FROM `LT_add_meal` LEFT JOIN Guest_meal2 as bf_meal ON (bf_meal.id=LT_add_meal.bf) LEFT JOIN Guest_meal2 as ln_meal ON (ln_meal.id=LT_add_meal.ln) LEFT JOIN Guest_meal2 as dn_meal ON (dn_meal.id=LT_add_meal.dn) WHERE tour_id='" . $x . "' order by LT_add_meal.hari ASC";
    $rsMeal = mysqli_query($con, $queryMeal);
    $gt_meal = 0;
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

    return json_encode(array("status" => "ok", "price" => $gt_meal), true);
}
function get_price_hotel($x)
{
    include "../db=connection.php";
    $query_hotel_data = "SELECT * FROM LAN_Hotel_List WHERE status='" . $x . "'";
    $rs_hotel_data = mysqli_query($con, $query_hotel_data);
    $gprice = 0;
    // var_dump($query_hotel_data);
    $hotel = "";
    while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
        $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
        $rs_hlt = mysqli_query($con, $query_hlt);
        $row_hlt = mysqli_fetch_array($rs_hlt);

        if (isset($row_hlt['id'])) {
            $hotel .= $row_hlt['name'] . " || ";
        }


        if ($row_hotel_data['rate'] == '1') {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "price" => $row_hlt['rate_low'],
            );
            $show_rate2 = get_rate($data);
            $result_rate2 = json_decode($show_rate2, true);

            // $gt = $gt + $result_rate2['price'];
            $price = $result_rate2['price'];
            // $gprice = $gprice + ($price /2);
        } else {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "price" => $row_hlt['rate_high'],
            );
            $show_rate2 = get_rate($data);
            $result_rate2 = json_decode($show_rate2, true);


            // $gt = $gt + $result_rate2['price'];
            $price = $result_rate2['price'];
        }
        $gprice = $gprice + $price;
    }
    return json_encode(array("status" =>  "ok", "price" => $gprice, "hotel" => $hotel), true);
}
function get_price_rent($x)
{

    $x = 1;

    include "../db=connection.php";

    $query_rent = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package=" . $x . "  order by Rent_selected.id ASC";
    $rs_rent = mysqli_query($con, $query_rent);
    $gt = 0;
    while ($row_rent = mysqli_fetch_array($rs_rent)) {

        $pr = 5;
        $idr = 0;
        $datareq = array(
            "kurs" =>  $row_rent['kurs'],
            "nominal" => $row_rent['price'],
        );
        $adt_kurs = get_kurs($datareq);
        if ($adt_kurs) {
            $rs_adt_kurs = json_decode($adt_kurs, true);
            if (isset($rs_adt_kurs['data'])) {

                $idr = $rs_adt_kurs['data'];
                $sql_profit = "SELECT * FROM LTR_profit_range where price1 <='" . $idr . "' && price2 >='" . $idr . "'";
                $rs_profit = mysqli_query($con, $sql_profit);
                $row_profit = mysqli_fetch_array($rs_profit);
                if (isset($row_profit['id'])) {
                    $pr = $row_profit['profit'];
                }
                $persen = intval($pr) / 100;
                $p_oneway = intval($idr) + (intval($idr) * $persen);
                $gt = $gt + $p_oneway;
            }
        }
    }

    return json_encode(array("status" => "ok", "price" => $gt), true);
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
function get_pembulatan($x)
{
    $totalharga = ceil($x);
    if (substr($totalharga, -5) == 0) {
        $total_harga = round($totalharga, -5);
    } else if (substr($totalharga, -5) <= 50000) {
        $total_harga = round($totalharga, -5) + 50000;
    } else {
        $total_harga = round($totalharga, -5);
    }
    return json_encode(array("status" => 1, "value" => $total_harga), true);
}
