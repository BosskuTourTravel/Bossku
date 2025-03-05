<?php
function feeTL($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $hotel_id = $datareq['hotel_id'];
    $grub_id = $datareq['grub_id'];

    $query_m = "SELECT * FROM LT_itinerary2  where id=" . $master_id;
    $rs_m = mysqli_query($con, $query_m);
    $row_m = mysqli_fetch_array($rs_m);

    $query_plus = "SELECT COUNT(*) as jml FROM  LT_AH_Main WHERE copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "'";
    $rs_plus = mysqli_query($con, $query_plus);
    $row_plus = mysqli_fetch_array($rs_plus);

    $fee_hari = $row_m['hari'] + $row_plus['jml'];
    if ($row_m['landtour'] != "undefined") {

        $query_sub = "SELECT * FROM LTSUB_itin where master_id ='" . $master_id . "' && id='" . $copy_id . "'";
        $rs_sub = mysqli_query($con, $query_sub);
        $row_sub = mysqli_fetch_array($rs_sub);

        $query_cbng = "SELECT * FROM cabang where id ='" . $row_sub['cabang'] . "'";
        $rs_cbng = mysqli_query($con, $query_cbng);
        $row_cbng = mysqli_fetch_array($rs_cbng);

        $query_itin = "SELECT * FROM LT_itinnew WHERE id='" .  $hotel_id . "'";
        $rs_itin = mysqli_query($con, $query_itin);
        $row_itin = mysqli_fetch_array($rs_itin);

        if ($row_itin['benua'] == "ASIA") {

            ////////////////////////////////////////// asia
            $val_check = ["THAILAND", "MALAYSIA", "SINGAPORE"];
            $exp_negara = preg_split("( - )", $row_itin['negara']);
            $pilih_negara = "";
            foreach ($exp_negara as $value) {
                $cek  = array_search($value, $val_check);
                if ($cek != "") {
                    $pilih_negara = $value;
                    break;
                }
            }

            if ($pilih_negara != "") {

                $query_tl_fee = "SELECT * FROM  TL_fee where benua='" . $row_itin['benua'] . "' && negara='" . $pilih_negara . "' && mulai='" . $row_cbng['nama'] . "'";
                $rs_tl_fee = mysqli_query($con, $query_tl_fee);
                while ($row_tl_fee = mysqli_fetch_array($rs_tl_fee)) {

                    if ($row_tl_fee['type'] == "TL FEE PER DAY") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $v_fee =  $result_show_kurs['data'] * $fee_hari;
                        $fee_day_current = $result_show_kurs['data'];
                    } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $tl_sfee_harga = $result_show_kurs['data'];
                        $v_sfee =  $result_show_kurs['data'] *  $fee_hari;
                    } else if ($row_tl_fee['type'] == "TL MEAL 1X ABF/LUNCH/DINNER") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);

                        $price_meal = intval($result_show_kurs['data'] * 3);
                        $tl_meal_harga = $result_show_kurs['data'];
                        $v_meal =  $fee_hari * $price_meal;
                    } else if ($row_tl_fee['type'] == "TL VOUCHER TELEPHONE") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);

                        $v_vt = $result_show_kurs['data'];
                        $tl_vocer_harga = $result_show_kurs['data'];
                    } else {
                    }
                }
            } else {
                $query_tl_fee = "SELECT * FROM  TL_fee where benua='" . $row_itin['benua'] . "' && negara != 'SINGAPORE' && negara !='MALAYSIA' && negara !='THAILAND' && mulai='" . $row_cbng['nama'] . "'";
                $rs_tl_fee = mysqli_query($con, $query_tl_fee);
                // array_push($data,$query_tl_fee);

                while ($row_tl_fee = mysqli_fetch_array($rs_tl_fee)) {
                    if ($row_tl_fee['type'] == "TL FEE PER DAY") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $tl_fee_harga =  $result_show_kurs['data'];
                        $v_fee =  $result_show_kurs['data'] * $fee_hari;
                        $fee_day_current = $result_show_kurs['data'];
                    } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $tl_sfee_harga = $result_show_kurs['data'];
                        $v_sfee =  $result_show_kurs['data'] * $fee_hari;
                    } else if ($row_tl_fee['type'] == "TL MEAL 1X ABF/LUNCH/DINNER") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);

                        $price_meal = intval($result_show_kurs['data'] * 3);
                        $tl_meal_harga = $result_show_kurs['data'];
                        $v_meal =  $fee_hari * $price_meal;
                    } else if ($row_tl_fee['type'] == "TL VOUCHER TELEPHONE") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);

                        $v_vt = $result_show_kurs['data'];
                        $tl_vocer_harga = $result_show_kurs['data'];
                    } else {
                    }
                }
            }
        } else {
            ////////////////////////////////////////// bukan asia
            $query_tl_fee = "SELECT * FROM  TL_fee where benua='" . $row_itin['benua'] . "' && mulai='" . $row_cbng['nama'] . "'";
            $rs_tl_fee = mysqli_query($con, $query_tl_fee);

            while ($row_tl_fee = mysqli_fetch_array($rs_tl_fee)) {
                if ($row_tl_fee['type'] == "TL FEE PER DAY") {
                    // konversi kurs
                    $datareq = array(
                        "kurs" =>  $row_tl_fee['kurs'],
                        "nominal" => $row_tl_fee['price'],
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $tl_fee_harga =  $result_show_kurs['data'];
                    $v_fee =  $result_show_kurs['data'] *  $fee_hari;
                    $fee_day_current =  $result_show_kurs['data'];
                } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                    // konversi kurs
                    $datareq = array(
                        "kurs" =>  $row_tl_fee['kurs'],
                        "nominal" => $row_tl_fee['price'],
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $tl_sfee_harga = $result_show_kurs['data'];
                    $v_sfee =  $result_show_kurs['data'] *  $fee_hari;
                } else if ($row_tl_fee['type'] == "TL MEAL 1X ABF/LUNCH/DINNER") {
                    // konversi kurs
                    $datareq = array(
                        "kurs" =>  $row_tl_fee['kurs'],
                        "nominal" => $row_tl_fee['price'],
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);

                    $price_meal = intval($result_show_kurs['data'] * 3);
                    $tl_meal_harga = $result_show_kurs['data'];
                    $v_meal =  $fee_hari * $price_meal;
                } else if ($row_tl_fee['type'] == "TL VOUCHER TELEPHONE") {
                    // konversi kurs
                    $datareq = array(
                        "kurs" =>  $row_tl_fee['kurs'],
                        "nominal" => $row_tl_fee['price'],
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);

                    $v_vt = $result_show_kurs['data'];
                    $tl_vocer_harga = $result_show_kurs['data'];
                } else {
                }
            }
        }
    }
    //// meal customer
    $query_master_meal = "SELECT * FROM LT_add_meal  where tour_id=" . $master_id;
    $rs_master_meal = mysqli_query($con, $query_master_meal);

    $total_mealcus = 0;
    $tmeal_cus = 0;
    $detail_meal = "";
    while ($row_master_meal = mysqli_fetch_array($rs_master_meal)) {
        if ($row_master_meal['bf'] != '0') {
            $hbf = 0;
            $query_bf = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['bf'];
            $rs_bf = mysqli_query($con, $query_bf);
            $row_bf = mysqli_fetch_array($rs_bf);
            ////////////
            $datareq = array(
                "kurs" => $row_bf['kurs'],
                "nominal" => $row_bf['price'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $hbf = $result_show_kurs['data'];
            ///////

            $total_mealcus = $total_mealcus + $hbf;
            $detail_meal .= " + " . $hbf;
            $tmeal_cus++;
            // var_dump( $total_mealcus);
        }
        if ($row_master_meal['ln'] != '0') {
            $hln = 0;
            $query_ln = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['ln'];
            $rs_ln = mysqli_query($con, $query_ln);
            $row_ln = mysqli_fetch_array($rs_ln);

            $datareq = array(
                "kurs" => $row_ln['kurs'],
                "nominal" => $row_ln['price'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $hln = $result_show_kurs['data'];
            $detail_meal .= " + " . $hln;
            $total_mealcus = $total_mealcus + $hln;
            $tmeal_cus++;
        }
        if ($row_master_meal['dn'] != '0') {
            $hdn = 0;
            $query_dn = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['dn'];
            $rs_dn = mysqli_query($con, $query_dn);
            $row_dn = mysqli_fetch_array($rs_dn);

            $datareq = array(
                "kurs" => $row_dn['kurs'],
                "nominal" => $row_dn['price'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);

            $hdn = $result_show_kurs['data'];
            $detail_meal .= " + " . $hdn;
            $total_mealcus = $total_mealcus + $hdn;
            $tmeal_cus++;
        }
        // $total_mealcus = $total_mealcus + $hbf + $hln + $hdn;
    }

    $data_twn = array(
        "kurs" => $row_itin['kurs'],
        "nominal" => $row_itin['agent_twn'],
    );
    $data_sgl_sub = array(
        "kurs" => $row_itin['kurs'],
        "nominal" => $row_itin['agent_sglsub'],
    );

    $show_kurs_twn = get_kurs($data_twn);
    $rs_kurs_twn = json_decode($show_kurs_twn, true);

    $show_kurs_sglsub = get_kurs($data_sgl_sub);
    $rs_kurs_sglsub = json_decode($show_kurs_sglsub, true);

    $lt_price = intval($rs_kurs_twn['data']);
    $lt_price_sub = intval($rs_kurs_sglsub['data']);
    $pax_covery = -1 * intval($row_itin['pax_b']);
    // get price flight
    $show_flight_tl = get_flight_tl($grub_id);
    $result_show_flight_tl = json_decode($show_flight_tl, true);
    /// get price ferry
    $data_fr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "18"
    );
    $show_fr = get_total($data_fr);
    $result_fr = json_decode($show_fr, true);
    /// get price train
    $data_tr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "19"
    );
    $show_tr = get_total($data_tr);
    $result_tr = json_decode($show_tr, true);

    $ferry = $result_fr['adt'];
    $flight =  $result_show_flight_tl['adt'];
    $train = $result_tr['adt'];

    $transport =  $ferry + $flight + $train;
    $feeTL = $v_vt + $v_meal + $v_fee + $v_sfee;
    $lt_cover = $pax_covery * $lt_price;
    $costTL = $lt_price + $lt_price_sub + $transport + $tips_flBagasi + $tips_flMeal + $tips_flTax;
    $val_cost_tl_fl = $flight +  $tips_flBagasi + $tips_flMeal + $tips_flTax;
    $feeTL_cover = $total_mealcus * -1;
    $costTL_cover =  $lt_cover;
    $tlpax = intval($row_itin['pax']);
    $ttpax = $feeTL + $costTL + $feeTL_cover + $costTL_cover;
    $vttpax = $ttpax  / $tlpax;

    ////// breakdown fee tl ///////////////////
    $arr_breakdown = [];
    array_push($arr_breakdown, array(
        "id" => '1',
        "nama" => "TL FEE /DAY",
        "current" => $fee_day_current,
        "hari" => $fee_hari,
        "value" => $v_fee
    ));
    array_push($arr_breakdown, array(
        "id" => '2',
        "nama" => "TL MEAL",
        "current" => $tl_meal_harga,
        "hari" => $fee_hari,
        "value" => $v_meal
    ));
    array_push($arr_breakdown, array(
        "id" => '3',
        "nama" => "TL VOUCHER TLPN",
        "current" => $tl_vocer_harga,
        "hari" => $fee_hari,
        "value" => $v_vt
    ));
    array_push($arr_breakdown, array(
        "id" => '4',
        "nama" => "TL SFEE /DAY",
        "current" => $tl_sfee_harga,
        "hari" => $fee_hari,
        "value" => $v_sfee
    ));
    $arr_break_costtl = [];
    array_push($arr_break_costtl, array(
        "id" => '1',
        "nama" => "FLIGHT",
        "current" => $flight,
        "bagasi" => $tips_flBagasi,
        "meal" => $tips_flMeal,
        "tax" => $tips_flTax,
        "value" => $val_cost_tl_fl
    ));
    array_push($arr_break_costtl, array(
        "id" => '2',
        "nama" => "LANDTOUR",
        "current" => $lt_price,
        "value" => $lt_price
    ));
    array_push($arr_break_costtl, array(
        "id" => '3',
        "nama" => "LANDTOUR SINGLE SUB",
        "current" => $lt_price_sub,
        "value" => $lt_price_sub
    ));
    array_push($arr_break_costtl, array(
        "id" => '4',
        "nama" => "TRAIN",
        "current" =>  $train,
        "value" =>  $train
    ));
    array_push($arr_break_costtl, array(
        "id" => '5',
        "nama" => "FERRY",
        "current" => $ferry,
        "value" => $ferry
    ));
    $arr_feetl_cover = [];
    array_push($arr_feetl_cover, array(
        "id" => '1',
        "nama" => "TL MEAL",
        "detail" => $detail_meal,
        "current" => $feeTL_cover,
        "value" => $feeTL_cover
    ));

    $arr_ct_cover = [];
    array_push($arr_ct_cover, array(
        "id" => '1',
        "nama" => "LANDTOUR",
        "current" => $lt_price,
        "pax_cover" => $pax_covery,
        "value" => $costTL_cover
    ));

    // $grand = [];
    // array_push($grand, array(
    //     "id" => '1',
    //     "nama" => "GRAND TOTAL",
    //     "current" => $ttpax,
    //     "pax" => $tlpax,
    //     "value" => $vttpax
    // ));


    return json_encode(array("adt" => $vttpax, "chd" => $vttpax, "inf" => $vttpax, "sgl" => $vttpax, "detail" => $data, "breakdown" => $arr_breakdown, "break_cost_tl" => $arr_break_costtl, "feetl_cover" => $arr_feetl_cover, "costtl_cover" => $arr_ct_cover, "grand" => $grand, "custom" => $ttpax), true);
}

function get_flight_tl($grub_id)
{
    include "../db=connection.php";

    $query_grub_tl = "SELECT LTP_grub_flight.id,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $grub_id . "'";
    $rs_grub_tl = mysqli_query($con, $query_grub_tl);
    $row_grub_tl = mysqli_fetch_array($rs_grub_tl);

    $query_gfv_tl = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $grub_id . "' order by id ASC";
    $rs_gfv_price_tl = mysqli_query($con, $query_gfv_tl);

    $adt_tl = 0;
    $chd_tl = 0;
    $inf_tl = 0;
    while ($row_gfv_price_tl = mysqli_fetch_array($rs_gfv_price_tl)) {
        $query_rd_tl = "SELECT * FROM  LTP_route_detail where id='" . $row_gfv_price_tl['flight_id'] . "'";
        $rs_rd_tl = mysqli_query($con, $query_rd_tl);
        $row_rd_tl = mysqli_fetch_array($rs_rd_tl);

        $query_ar_tl = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_gfv_price_tl['route_id'] . "'";
        $rs_ar_tl = mysqli_query($con, $query_ar_tl);
        $row_ar_tl = mysqli_fetch_array($rs_ar_tl);

        if ($row_gfv_price_tl['status'] == '1') {
            if ($x_gf == '1') {
                $adt_ar_tl = $row_ar_tl['adt'];
                $chd_ar_tl = $row_ar_tl['chd'];
                $inf_ar_tl = $row_ar_tl['inf'];
            } else {
                $adt_ar_tl = 0;
                $chd_ar_tl = 0;
                $inf_ar_tl = 0;
            }
        } else {
            $adt_ar_tl = $row_rd_tl['adt'];
            $chd_ar_tl = $row_rd_tl['chd'];
            $inf_ar_tl = $row_rd_tl['inf'];
        }
        $adt_tl = $adt_tl + $adt_ar_tl;
        $chd_tl = $chd_tl + $chd_ar_tl;
        $inf_tl = $inf_tl + $inf_ar_tl;
    }
    $adt_tl = $adt_tl + $row_grub_tl['adt'];
    $chd_tl = $chd_tl + $row_grub_tl['chd'];
    $inf_tl = $inf_tl + $row_grub_tl['inf'];
    return json_encode(array("adt" =>   $adt_tl, "chd" =>  $chd_tl, "inf" =>  $inf_tl,), true);
}

function feeTL_custom($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $hotel_id = $datareq['hotel_id'];
    $grub_id = $datareq['grub_id'];
    $tl_fee = $datareq['tl_fee'];
    $tl_meal = $datareq['tl_meal'];
    $tl_tlpn = $datareq['tl_tlpn'];
    $tl_sfee = $datareq['tl_sfee'];

    $query_m = "SELECT * FROM LT_itinerary2  where id=" . $master_id;
    $rs_m = mysqli_query($con, $query_m);
    $row_m = mysqli_fetch_array($rs_m);

    $query_plus = "SELECT COUNT(*) as jml FROM  LT_AH_Main WHERE copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "'";
    $rs_plus = mysqli_query($con, $query_plus);
    $row_plus = mysqli_fetch_array($rs_plus);

    $fee_hari = $row_m['hari'] + $row_plus['jml'];
    if ($row_m['landtour'] != "undefined") {

        $query_sub = "SELECT * FROM LTSUB_itin where master_id ='" . $master_id . "' && id='" . $copy_id . "'";
        $rs_sub = mysqli_query($con, $query_sub);
        $row_sub = mysqli_fetch_array($rs_sub);


        $query_itin = "SELECT * FROM LT_itinnew WHERE id='" .  $hotel_id . "'";
        $rs_itin = mysqli_query($con, $query_itin);
        $row_itin = mysqli_fetch_array($rs_itin);

        if ($tl_fee != 0) {
            $v_fee =  $tl_fee * $fee_hari;
            $fee_day_current =  $tl_fee;
        }
        if ($tl_meal != 0) {

            $price_meal = intval($tl_meal * 3);
            $tl_meal_harga = $tl_meal;
            $v_meal = $fee_hari * $price_meal;
        }
        if ($tl_tlpn != 0) {

            $v_vt = $tl_tlpn;
            $tl_vocer_harga = $tl_tlpn;
        }
        if ($tl_sfee != 0) {
            $tl_sfee_harga = $tl_sfee;
            $v_sfee =  $tl_sfee * $fee_hari;
        }
    }

    //// meal customer
    $query_master_meal = "SELECT * FROM LT_add_meal  where tour_id=" . $master_id;
    $rs_master_meal = mysqli_query($con, $query_master_meal);

    $total_mealcus = 0;
    $tmeal_cus = 0;
    $detail_meal = "";
    while ($row_master_meal = mysqli_fetch_array($rs_master_meal)) {
        if ($row_master_meal['bf'] != '0') {
            $hbf = 0;
            $query_bf = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['bf'];
            $rs_bf = mysqli_query($con, $query_bf);
            $row_bf = mysqli_fetch_array($rs_bf);
            ////////////
            $datareq = array(
                "kurs" => $row_bf['kurs'],
                "nominal" => $row_bf['price'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $hbf = $result_show_kurs['data'];
            ///////

            $total_mealcus = $total_mealcus + $hbf;
            $detail_meal .= " + " . $hbf;
            $tmeal_cus++;
            // var_dump( $total_mealcus);
        }
        if ($row_master_meal['ln'] != '0') {
            $hln = 0;
            $query_ln = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['ln'];
            $rs_ln = mysqli_query($con, $query_ln);
            $row_ln = mysqli_fetch_array($rs_ln);

            $datareq = array(
                "kurs" => $row_ln['kurs'],
                "nominal" => $row_ln['price'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $hln = $result_show_kurs['data'];
            $detail_meal .= " + " . $hln;
            $total_mealcus = $total_mealcus + $hln;
            $tmeal_cus++;
        }
        if ($row_master_meal['dn'] != '0') {
            $hdn = 0;
            $query_dn = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['dn'];
            $rs_dn = mysqli_query($con, $query_dn);
            $row_dn = mysqli_fetch_array($rs_dn);

            $datareq = array(
                "kurs" => $row_dn['kurs'],
                "nominal" => $row_dn['price'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);

            $hdn = $result_show_kurs['data'];
            $detail_meal .= " + " . $hdn;
            $total_mealcus = $total_mealcus + $hdn;
            $tmeal_cus++;
        }
        // $total_mealcus = $total_mealcus + $hbf + $hln + $hdn;
    }


    $lt_price = intval($row_itin['agent_twn']);
    $lt_price_sub = intval($row_itin['agent_sglsub']);
    $pax_covery = -1 * intval($row_itin['pax_b']);
    // get price flight
    $show_flight_tl = get_flight_tl($grub_id);
    $result_show_flight_tl = json_decode($show_flight_tl, true);
    /// get price ferry
    $data_fr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "18"
    );
    $show_fr = get_total($data_fr);
    $result_fr = json_decode($show_fr, true);
    /// get price train
    $data_tr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "19"
    );
    $show_tr = get_total($data_tr);
    $result_tr = json_decode($show_tr, true);

    $ferry = $result_fr['adt'];
    $flight =  $result_show_flight_tl['adt'];
    $train = $result_tr['adt'];

    $transport =  $ferry + $flight + $train;
    $feeTL = $v_vt + $v_meal + $v_fee + $v_sfee;
    $lt_cover = $pax_covery * $lt_price;
    $costTL = $lt_price + $lt_price_sub + $transport + $tips_flBagasi + $tips_flMeal + $tips_flTax;
    $val_cost_tl_fl = $flight +  $tips_flBagasi + $tips_flMeal + $tips_flTax;
    $feeTL_cover = $total_mealcus * -1;
    $costTL_cover =  $lt_cover;
    $tlpax = intval($row_itin['pax']);
    $ttpax = $feeTL + $costTL + $feeTL_cover + $costTL_cover;
    $vttpax = $ttpax  / $tlpax;

    ////// breakdown fee tl ///////////////////
    $arr_breakdown = [];
    array_push($arr_breakdown, array(
        "id" => '1',
        "nama" => "TL FEE /DAY",
        "current" => $fee_day_current,
        "hari" => $fee_hari,
        "value" => $v_fee
    ));
    array_push($arr_breakdown, array(
        "id" => '2',
        "nama" => "TL MEAL",
        "current" => $tl_meal_harga,
        "hari" => $fee_hari,
        "value" => $v_meal
    ));
    array_push($arr_breakdown, array(
        "id" => '3',
        "nama" => "TL VOUCHER TLPN",
        "current" => $tl_vocer_harga,
        "hari" => $fee_hari,
        "value" => $v_vt
    ));
    array_push($arr_breakdown, array(
        "id" => '4',
        "nama" => "TL SFEE /DAY",
        "current" => $tl_sfee_harga,
        "hari" => $fee_hari,
        "value" => $v_sfee
    ));
    $arr_break_costtl = [];
    array_push($arr_break_costtl, array(
        "id" => '1',
        "nama" => "FLIGHT",
        "current" => $flight,
        "bagasi" => $tips_flBagasi,
        "meal" => $tips_flMeal,
        "tax" => $tips_flTax,
        "value" => $val_cost_tl_fl
    ));
    array_push($arr_break_costtl, array(
        "id" => '2',
        "nama" => "LANDTOUR",
        "current" => $lt_price,
        "value" => $lt_price
    ));
    array_push($arr_break_costtl, array(
        "id" => '3',
        "nama" => "LANDTOUR SINGLE SUB",
        "current" => $lt_price_sub,
        "value" => $lt_price_sub
    ));
    array_push($arr_break_costtl, array(
        "id" => '4',
        "nama" => "TRAIN",
        "current" =>  $train,
        "value" =>  $train
    ));
    array_push($arr_break_costtl, array(
        "id" => '5',
        "nama" => "FERRY",
        "current" => $ferry,
        "value" => $ferry
    ));
    $arr_feetl_cover = [];
    array_push($arr_feetl_cover, array(
        "id" => '1',
        "nama" => "TL MEAL",
        "detail" => $detail_meal,
        "current" => $feeTL_cover,
        "value" => $feeTL_cover
    ));

    $arr_ct_cover = [];
    array_push($arr_ct_cover, array(
        "id" => '1',
        "nama" => "LANDTOUR",
        "current" => $lt_price,
        "pax_cover" => $pax_covery,
        "value" => $costTL_cover
    ));
    return json_encode(array("adt" => $vttpax, "chd" => $vttpax, "inf" => $vttpax, "sgl" => $vttpax, "detail" => $data, "breakdown" => $arr_breakdown, "break_cost_tl" => $arr_break_costtl, "feetl_cover" => $arr_feetl_cover, "costtl_cover" => $arr_ct_cover, "grand" => $grand, "custom" => $ttpax), true);
}


function get_total($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $check_id = $datareq['check_id'];
    $flight_post_id = $datareq['flight'];
    $date_post = $datareq['date'];
    if ($check_id == '18') {
        $query_plane = "SELECT * FROM  LT_add_transport_baru where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && type='2' && grub_id='" . $datareq['grub_id'] . "'";
        $rs_plane = mysqli_query($con, $query_plane);

        $adt = 0;
        $chd = 0;
        $inf = 0;
        $data = [];
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row_plane['transport'];
            $rs_ferry = mysqli_query($con, $query_ferry);
            $row_ferry = mysqli_fetch_array($rs_ferry);

            $adt = $adt + intval($row_ferry['adult']);
            $chd = $chd + intval($row_ferry['child']);
            $inf = $inf + intval($row_ferry['infant']);
            $ket = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
            array_push($data, $ket);
        }
        return json_encode(array("adt" => $adt, "chd" => $chd, "inf" => $inf, "sgl" => $adt, "detail" => $data), true);
    } else if ($check_id == '19') {
        $query_train = "SELECT * FROM   LT_add_transport_baru  where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && type='4'";
        $rs_train = mysqli_query($con, $query_train);
        $adt = 0;
        $chd = 0;
        $inf = 0;
        $data = [];

        while ($row_train = mysqli_fetch_array($rs_train)) {
            $query_tr = "SELECT * FROM train_LTnew  where id=" . $row_train['transport'];
            $rs_tr = mysqli_query($con, $query_tr);
            $row_tr = mysqli_fetch_array($rs_tr);

            $adt = $adt + intval($row_tr['adt']);
            $chd = $chd + intval($row_tr['chd']);
            $inf = $inf + intval($row_tr['inf']);
            $ket = $row_tr['nama'];
            array_push($data, $ket);
        }

        return json_encode(array("adt" => $adt, "chd" => $chd, "inf" => $inf, "sgl" => $adt, "detail" => $data), true);
    } else {
    }
}
