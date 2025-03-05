<?php
    include "../db=connection.php";
    include "fungsi_profit_flight.php";
    include "Api_LT_total_baru.php";
    include "fungsi_gethotel_price.php";
    include "fungsi_feetl.php";
    include "fungsi_forLT.php";

    $x='7';

    $query_paket = "SELECT * FROM paket_tour_online where id=" . $x;
    $rs_paket = mysqli_query($con, $query_paket);
    $row_paket = mysqli_fetch_array($rs_paket);


    $query_data = "SELECT * FROM  LTSUB_itin where id=" . $row_paket['tour_id'];
    $rs_data = mysqli_query($con, $query_data);
    $row_data = mysqli_fetch_array($rs_data);

    $query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $row_data['master_id'] . "'";
    $rs_cek = mysqli_query($con, $query_cek);
    $row_cek = mysqli_fetch_array($rs_cek);

    $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" .$row_paket['tour_id']. "' && master_id='" . $row_data['master_id'] . "'";
    $rs_adm = mysqli_query($con, $query_adm);
    $row_adm = mysqli_fetch_array($rs_adm);
    $include = explode(",", $row_adm['include']);
    $exclude = explode(",", $row_adm['exclude']);

    $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $row_paket['grub_id'] . "' && LTP_insert_sfee.id='" . $row_paket['sfee_id'] . "'";
    $rs_grub = mysqli_query($con, $query_grub);
    $row_grub = mysqli_fetch_array($rs_grub);
    // var_dump($query_grub);

    if ($row_paket['tgl_ber'] == "0000-00-00") {
        $start_date = $row_grub['date_set'];
    } else {
        $start_date = $row_paket['tgl_ber'];
    }

    /// get nama maskapai
    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
    $rs_gf_price = mysqli_query($con, $query_gf);
    // var_dump($query_gf);


    $adt = 0;
    $chd = 0;
    $inf = 0;
    $x_gf = 1;
    while ($row_price = mysqli_fetch_array($rs_gf_price)) {
        $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_price['flight_id'] . "'";
        $rs_detail2 = mysqli_query($con, $query_detail2);
        $row_detail2 = mysqli_fetch_array($rs_detail2);


        $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail2['route_id'] . "'";
        $rs_rt = mysqli_query($con, $query_rt);
        $row_rt = mysqli_fetch_array($rs_rt);

        if ($row_price['status'] == '1') {
            if ($x_gf == '1') {
                $adt_rt = $row_rt['adt'];
                $chd_rt = $row_rt['chd'];
                $inf_rt = $row_rt['inf'];
            } else {
                $adt_rt = 0;
                $chd_rt = 0;
                $inf_rt = 0;
            }
        } else {
            $adt_rt = $row_detail2['adt'];
            $chd_rt = $row_detail2['chd'];
            $inf_rt = $row_detail2['inf'];
        }
        // var_dump($adt_rt);
        $adt = $adt + $adt_rt;
        $chd = $chd + $chd_rt;
        $inf = $inf + $inf_rt;
        $x_gf++;
    }
    $adt = $adt + $row_grub['adt'];
    $chd = $chd + $row_grub['chd'];
    $inf = $inf + $row_grub['inf'];
    // var_dump($query_detail2);
    $arr_profit = array(
        "adt" => $adt,
        "chd" => $chd,
        "inf" => $inf
    );
    //   var_dump($arr_profit);
    $show_profit = get_profit_flight($arr_profit);
    $result_profit = json_decode($show_profit, true);
    // var_dump($result_profit);

    //////////////////////////////////////////////////

    // get hotel price ///////////////////////////////////////////
    $data_lt = $row_data['landtour'];
    $query_lt = "SELECT * FROM LT_itinnew where kode='" . $data_lt . "' && city_in !='' && city_out !='' order by id ASC ";
    $rs_lt = mysqli_query($con, $query_lt);
    $row_lt = mysqli_fetch_array($rs_lt);
    $in = $row_lt['city_in'];
    $out = $row_lt['city_out'];

    $queryPHotelx = "SELECT hotel_id FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' order by id ASC limit 1";
    $rsPHotelx = mysqli_query($con, $queryPHotelx);
    $rowPHotelx = mysqli_fetch_array($rsPHotelx);


    $data_hotel = array(
        "copy_id" => $row_data['id'],
        "master_id" => $row_data['master_id'],
    );

    $show_hp = get_hotel_price($data_hotel);
    $result_hp = json_decode($show_hp, true);
    var_dump($result_hp); 

    if ($row_paket['tl_fee'] != '0') {
        $data_feetl = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['id'],
            "grub_id" => $row_grub['id'],
            "hotel_id" =>  $result_hp['id_hotel'],
            "tl_fee" => $row_paket['tl_fee'],
            "tl_meal" => $row_paket['tl_meal'],
            "tl_tlpn" => $row_paket['tl_tlpn'],
            "tl_sfee" => $row_paket['tl_sfee'],
        );

        $show_feetl = feeTL_custom($data_feetl);
        $result_feetl  = json_decode($show_feetl, true);
    } else {
        $data_feetl = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['id'],
            "grub_id" => $row_grub['id'],
            "hotel_id" =>  $result_hp['id_hotel']
        );
        var_dump($data_feetl);

        $show_feetl = feeTL($data_feetl);
        $result_feetl  = json_decode($show_feetl, true);
        var_dump($result_feetl);
    }

    // ////////////////////////////////////



    // //// get value grandtotal tanpa tiket pesawat 
    // $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
    // $rs_inc = mysqli_query($con, $query_inc);
    // $row_inc = mysqli_fetch_array($rs_inc);

    // $query_include = explode(",", $row_inc['chck']);
    // // var_dump($query_include);
    // $gt_chck_adt = 0;
    // $gt_chck_chd = 0;
    // $gt_chck_inf = 0;
    // $gt_chck_sgl = 0;
    // $val_check = [0];
    // $fee_on = 0;
    // foreach ($query_include as $check) {
    //     if ($check != '1' && $check != '15' && $check != '17' && $check != '32' && $check != '55') {
    //         $data_tps = array(
    //             "master_id" => $row_data['master_id'],
    //             "copy_id" => $row_data['id'],
    //             "grub_id" => $row_grub['id'],
    //             "check_id" => $check
    //         );
    //         // var_dump($data_tps);

    //         $show_tps = get_total($data_tps);
    //         $result_tps = json_decode($show_tps, true);
    //         $gt_chck_adt = $gt_chck_adt + $result_tps['adt'];
    //         $gt_chck_chd = $gt_chck_chd + $result_tps['chd'];
    //         $gt_chck_inf = $gt_chck_inf + $result_tps['inf'];
    //         $gt_chck_sgl = $gt_chck_sgl + $result_tps['sgl'];
    //         // var_dump($result_tps['adt']);
    //     } else if ($check == '17') {

    //         $arr_tmp = [];

    //         $arr_tmpex = [];
    //         if (isset($include)) {
    //             foreach ($include as $val_tmp) {
    //                 $adt_tmp = 0;
    //                 $chd_tmp = 0;
    //                 $inf_tmp = 0;
    //                 $query_tmp = "SELECT tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp . "'";
    //                 $rs_tmp = mysqli_query($con, $query_tmp);
    //                 $row_tmp = mysqli_fetch_array($rs_tmp);

    //                 if ($row_tmp['price'] != 0) {
    //                     $datareq = array(
    //                         "kurs" =>  $row_tmp['kurs'],
    //                         "nominal" => $row_tmp['price'],
    //                     );
    //                     $adt_kurs = get_kurs($datareq);
    //                     $rs_adt_kurs = json_decode($adt_kurs, true);
    //                     $adt_tmp = $adt_tmp + $rs_adt_kurs['data'];
    //                 }
    //                 if ($row_tmp['chd'] != 0) {
    //                     $datareq_chd = array(
    //                         "kurs" =>  $row_tmp['kurs'],
    //                         "nominal" => $row_tmp['chd'],
    //                     );
    //                     $chd_kurs = get_kurs($datareq_chd);
    //                     $rs_chd_kurs = json_decode($chd_kurs, true);
    //                     $chd_tmp = $chd_tmp +  $rs_chd_kurs['data'];
    //                 }
    //                 if ($row_tmp['inf'] != 0) {
    //                     $datareq_inf = array(
    //                         "kurs" =>  $row_tmp['kurs'],
    //                         "nominal" => $row_tmp['inf'],
    //                     );
    //                     $inf_kurs = get_kurs($datareq_inf);
    //                     $rs_inf_kurs = json_decode($inf_kurs, true);
    //                     $inf_tmp = $inf_tmp +  $rs_inf_kurs['data'];
    //                 }
    //                 array_push($arr_tmp, array("nama" => $row_tmp['tempat'], "price" => $adt_tmp));
    //                 $gt_chck_adt = $gt_chck_adt + $adt_tmp;
    //                 $gt_chck_chd = $gt_chck_chd + $chd_tmp;
    //                 $gt_chck_inf = $gt_chck_inf + $inf_tmp;
    //                 $gt_chck_sgl = $gt_chck_sgl +  $adt_tmp;
    //             }
    //             // var_dump("admiss: ".$adt_tmp);

    //         }
    //         if (isset($exclude)) {
    //             foreach ($exclude as $val_tmp2) {
    //                 $adt_tmpex = 0;
    //                 $chd_tmpex = 0;
    //                 $inf_tmpex = 0;
    //                 $query_tmp2 = "SELECT tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp2 . "'";
    //                 $rs_tmp2 = mysqli_query($con, $query_tmp2);
    //                 $row_tmp2 = mysqli_fetch_array($rs_tmp2);

    //                 if ($row_tmp2['price'] != 0) {
    //                     $datareq = array(
    //                         "kurs" =>  $row_tmp2['kurs'],
    //                         "nominal" => $row_tmp2['price'],
    //                     );
    //                     $adt_kurs = get_kurs($datareq);
    //                     $rs_adt_kurs = json_decode($adt_kurs, true);
    //                     $adt_tmpex = $adt_tmpex + $rs_adt_kurs['data'];
    //                 }
    //                 if ($row_tmp2['chd'] != 0) {
    //                     $datareq_chd = array(
    //                         "kurs" =>  $row_tmp['kurs'],
    //                         "nominal" => $row_tmp['chd'],
    //                     );
    //                     $chd_kurs = get_kurs($datareq_chd);
    //                     $rs_chd_kurs = json_decode($chd_kurs, true);
    //                     $chd_tmpex = $chd_tmpex +  $rs_chd_kurs['data'];
    //                 }
    //                 if ($row_tmp2['inf'] != 0) {
    //                     $datareq_inf = array(
    //                         "kurs" =>  $row_tmp['kurs'],
    //                         "nominal" => $row_tmp['inf'],
    //                     );
    //                     $inf_kurs = get_kurs($datareq_inf);
    //                     $rs_inf_kurs = json_decode($inf_kurs, true);
    //                     $inf_tmpex = $inf_tmpex +  $rs_inf_kurs['data'];
    //                 }

    //                 array_push($arr_tmpex, array("nama" => $row_tmp2['tempat'], "price" => $adt_tmpex));
    //             }
    //         }
    //         // var_dump("adm : ".$adt_tmp);
    //         // var_dump($check. " : " . $adt_tmp . " </br>");
    //     } else if ($check == '32') {
    //         $fee_on = 1;
    //     } else if ($check == '55') {
    //         $data_tps = array(
    //             "master_id" => $row_data['master_id'],
    //             "copy_id" => $row_data['id'],
    //             "sfee_id" => $row_grub['sfee_id']
    //         );
    //         // var_dump($data_tps);

    //         $show_tps = get_hotel_forLT($data_tps);
    //         $result_tps = json_decode($show_tps, true);
    //         $ph = $result_tps['adt'] / 2;
    //         $gt_chck_adt = $gt_chck_adt + $ph;
    //     } else {
    //     }
    //     array_push($val_check, $check);
    // }

    // // var_dump($gt_chck_sgl);
    // $fee_tl = 0;
    // if ($fee_on == '1') {
    //     if ($row_paket['tl_pax'] != "") {
    //         $fee_tl = $result_feetl['custom'] / $row_paket['tl_pax'];
    //     } else {
    //         $fee_tl = $result_feetl['adt'];
    //     }
    // }

    // // var_dump($result_profit['adt']);
    // $total_manual_adt =  $result_profit['adt'] + $result_hp['twn'] + $fee_tl + $gt_chck_adt + $row_paket['ltwn'];
    // $total_manual_chd =  $result_profit['chd'] + $result_hp['cnb'] + $fee_tl + $gt_chck_chd + $row_paket['ltwn'];
    // $total_manual_inf =  $result_profit['inf'] + $result_hp['inf'] + $fee_tl + $gt_chck_inf + $row_paket['ltwn'];
    // $total_manual_sgl =  $result_profit['adt'] + $result_hp['sgl'] + $fee_tl + $gt_chck_sgl + $row_paket['ltwn'];

    // // echo $result_profit['adt'] . " - " . $result_hp['twn'] . " - " . $fee_tl . " - " . $gt_chck_adt . " - " . $row_paket['ltwn'];


    // $twn_sp = get_pembulatan($total_manual_adt);
    // $twn_rp = json_decode($twn_sp, true);

    // $sgl_sp = get_pembulatan($total_manual_sgl);
    // $sgl_rp = json_decode($sgl_sp, true);

    // $cnb_sp = get_pembulatan($total_manual_chd);
    // $cnb_rp = json_decode($cnb_sp, true);

    // $inf_sp = get_pembulatan($total_manual_inf);
    // $inf_rp = json_decode($inf_sp, true);

    // ////////////////////////////////////////////////////////////////
    // ///////////////// lain - lain ///////////////



