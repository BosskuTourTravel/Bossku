<?php
function get_data($x)
{
    include "../db=connection.php";
    // include "api_cetak_rute.php";
    include "../Admin/Api_LT_total_baru.php";
    include "../Admin/fungsi_gethotel_price.php";
    include "../Admin/fungsi_profit_flight.php";
    include "../Admin/fungsi_feetl.php";
    include "../Admin/fungsi_forLT.php";

    $query_data = "SELECT * FROM  LTSUB_itin where id=" . $x['id'];
    $rs_data = mysqli_query($con, $query_data);
    $row_data = mysqli_fetch_array($rs_data);
    $g1 = $row_data['gambar1'];
    $g2 = $row_data['gambar2'];
    $g3 = $row_data['gambar3'];
    $g4 = $row_data['gambar4'];


    $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $x['id'] . "' && master_id='" . $row_data['master_id'] . "'";
    $rs_adm = mysqli_query($con, $query_adm);
    $row_adm = mysqli_fetch_array($rs_adm);
    $include = explode(",", $row_adm['include']);
    $exclude = explode(",", $row_adm['exclude']);

    $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $x['grub_id'] . "' && LTP_insert_sfee.id='" . $x['sfee_id'] . "'";
    $rs_grub = mysqli_query($con, $query_grub);
    $row_grub = mysqli_fetch_array($rs_grub);
    // var_dump($query_grub);

    if ($x['tgl_ber'] == "") {
        $start_date = $row_grub['date_set'];
    } else {
        $start_date = $x['tgl_ber'];
    }

    $judul ="";
    $query_judul = "SELECT * FROM LT_change_judul WHERE copy_id='" . $row_data['id'] . "' && grub_id='" . $x['grub_id'] . "'";
    $rs_judul = mysqli_query($con, $query_judul);
    $row_judul = mysqli_fetch_array($rs_judul);
    if ($row_judul['id'] == "") {
        $judul = $row_data['judul'];
    } else {
        $judul = $row_judul['nama'];
    }

    /// get nama maskapai
    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
    $rs_gf_price = mysqli_query($con, $query_gf);

    // var_dump($query_grub);
    // get value price flight
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
    //  var_dump($arr_profit);
    $show_profit = get_profit_flight($arr_profit);
    $result_profit = json_decode($show_profit, true);

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
    //  var_dump($result_hp); 


    ///////////// fee tl //////////////////////////////
    $data_feetl = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $row_data['id'],
        "grub_id" => $row_grub['id'],
        "hotel_id" =>  $result_hp['id_hotel']
    );
    // var_dump($data_feetl);

    $show_feetl = feeTL($data_feetl);
    $result_feetl = json_decode($show_feetl, true);

    ////////////////////////////////////



    //// get value grandtotal tanpa tiket pesawat 
    $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
    $rs_inc = mysqli_query($con, $query_inc);
    $row_inc = mysqli_fetch_array($rs_inc);

    $query_include = explode(",", $row_inc['chck']);
    // var_dump($query_include);
    $gt_chck_adt = 0;
    $gt_chck_chd = 0;
    $gt_chck_inf = 0;
    $gt_chck_sgl = 0;
    $val_check = [0];
    $fee_on = 0;
    foreach ($query_include as $check) {
        if ($check != '1' && $check != '15' && $check != '17' && $check != '32' && $check != '55') {
            $data_tps = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $row_data['id'],
                "grub_id" => $row_grub['id'],
                "check_id" => $check
            );
            // var_dump($data_tps);

            $show_tps = get_total($data_tps);
            $result_tps = json_decode($show_tps, true);
            $gt_chck_adt = $gt_chck_adt + $result_tps['adt'];
            $gt_chck_chd = $gt_chck_chd + $result_tps['chd'];
            $gt_chck_inf = $gt_chck_inf + $result_tps['inf'];
            $gt_chck_sgl = $gt_chck_sgl + $result_tps['sgl'];
            // var_dump($result_tps['adt']);
        } else if ($check == '17') {


            // $adt_tmp = 0;
            // $chd_tmp = 0;
            // $inf_tmp = 0;
            $arr_tmp = [];
            // $adt_tmpex = 0;
            // $chd_tmpex = 0;
            // $inf_tmpex = 0;
            $arr_tmpex = [];
            if (isset($include)) {
                foreach ($include as $val_tmp) {
                    $adt_tmp = 0;
                    $chd_tmp = 0;
                    $inf_tmp = 0;
                    $query_tmp = "SELECT tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp . "'";
                    $rs_tmp = mysqli_query($con, $query_tmp);
                    $row_tmp = mysqli_fetch_array($rs_tmp);

                    if ($row_tmp['price'] != 0) {
                        $datareq = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['price'],
                        );
                        $adt_kurs = get_kurs($datareq);
                        $rs_adt_kurs = json_decode($adt_kurs, true);
                        $adt_tmp = $adt_tmp + $rs_adt_kurs['data'];
                    }
                    if ($row_tmp['chd'] != 0) {
                        $datareq_chd = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['chd'],
                        );
                        $chd_kurs = get_kurs($datareq_chd);
                        $rs_chd_kurs = json_decode($chd_kurs, true);
                        $chd_tmp = $chd_tmp +  $rs_chd_kurs['data'];
                    }
                    if ($row_tmp['inf'] != 0) {
                        $datareq_inf = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['inf'],
                        );
                        $inf_kurs = get_kurs($datareq_inf);
                        $rs_inf_kurs = json_decode($inf_kurs, true);
                        $inf_tmp = $inf_tmp +  $rs_inf_kurs['data'];
                    }
                    array_push($arr_tmp, array("nama" => $row_tmp['tempat'], "price" => $adt_tmp));
                    $gt_chck_adt = $gt_chck_adt + $adt_tmp;
                    $gt_chck_chd = $gt_chck_chd + $chd_tmp;
                    $gt_chck_inf = $gt_chck_inf + $inf_tmp;
                    $gt_chck_sgl = $gt_chck_sgl +  $adt_tmp;
                }
                // var_dump("admiss: ".$adt_tmp);

            }
            if (isset($exclude)) {
                foreach ($exclude as $val_tmp2) {
                    $adt_tmpex = 0;
                    $chd_tmpex = 0;
                    $inf_tmpex = 0;
                    $query_tmp2 = "SELECT tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp2 . "'";
                    $rs_tmp2 = mysqli_query($con, $query_tmp2);
                    $row_tmp2 = mysqli_fetch_array($rs_tmp2);

                    if ($row_tmp2['price'] != 0) {
                        $datareq = array(
                            "kurs" =>  $row_tmp2['kurs'],
                            "nominal" => $row_tmp2['price'],
                        );
                        $adt_kurs = get_kurs($datareq);
                        $rs_adt_kurs = json_decode($adt_kurs, true);
                        $adt_tmpex = $adt_tmpex + $rs_adt_kurs['data'];
                    }
                    if ($row_tmp2['chd'] != 0) {
                        $datareq_chd = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['chd'],
                        );
                        $chd_kurs = get_kurs($datareq_chd);
                        $rs_chd_kurs = json_decode($chd_kurs, true);
                        $chd_tmpex = $chd_tmpex +  $rs_chd_kurs['data'];
                    }
                    if ($row_tmp2['inf'] != 0) {
                        $datareq_inf = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['inf'],
                        );
                        $inf_kurs = get_kurs($datareq_inf);
                        $rs_inf_kurs = json_decode($inf_kurs, true);
                        $inf_tmpex = $inf_tmpex +  $rs_inf_kurs['data'];
                    }

                    array_push($arr_tmpex, array("nama" => $row_tmp2['tempat'], "price" => $adt_tmpex));
                }
            }
            // var_dump("adm : ".$adt_tmp);
            // var_dump($check. " : " . $adt_tmp . " </br>");
        } else if ($check == '32') {
            $fee_on = 1;
        } else if ($check == '55') {
            $data_tps = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $row_data['id'],
                "sfee_id" => $row_grub['sfee_id']
            );
            // var_dump($data_tps);

            $show_tps = get_hotel_forLT($data_tps);
            $result_tps = json_decode($show_tps, true);
            $ph = $result_tps['adt'] / 2;
            $gt_chck_adt = $gt_chck_adt + $ph;
        } else {
        }
        array_push($val_check, $check);
    }

    // var_dump($gt_chck_sgl);
    $fee_tl = 0;
    if ($fee_on == '1') {
        if ($x['tl_pax'] != "") {
            $fee_tl = $result_feetl['custom'] / $x['tl_pax'];
        } else {
            $fee_tl = $result_feetl['adt'];
        }
    }

    // var_dump($result_profit['adt']);
    $total_manual_adt =  $result_profit['adt'] + $result_hp['twn'] + $fee_tl + $gt_chck_adt + $x['ltwn'];
    $total_manual_chd =  $result_profit['chd'] + $result_hp['cnb'] + $fee_tl + $gt_chck_chd + $x['ltwn'];
    $total_manual_inf =  $result_profit['inf'] + $result_hp['inf'] + $fee_tl + $gt_chck_inf + $x['ltwn'];
    $total_manual_sgl =  $result_profit['adt'] + $result_hp['sgl'] + $fee_tl + $gt_chck_sgl + $x['ltwn'];

    // echo $result_profit['adt'] . " - " . $result_hp['twn'] . " - " . $fee_tl . " - " . $gt_chck_adt . " - " . $x['ltwn'];


    $twn_sp = get_pembulatan($total_manual_adt);
    $twn_rp = json_decode($twn_sp, true);

    $sgl_sp = get_pembulatan($total_manual_sgl);
    $sgl_rp = json_decode($sgl_sp, true);

    $cnb_sp = get_pembulatan($total_manual_chd);
    $cnb_rp = json_decode($cnb_sp, true);

    $inf_sp = get_pembulatan($total_manual_inf);
    $inf_rp = json_decode($inf_sp, true);

    ////////////////////////////////////////////////////////////////
    ///////////////// lain - lain ///////////////


    $guide_price = '';
    $tl_price = '';
    $porter_price = '';
    $detail_visa = "";
    $data_visa = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $x['id'],
        "check_id" => '8'
    );
    $show_visa = get_total($data_visa);
    $result_visa = json_decode($show_visa, true);
    foreach ($result_visa['detail'] as $detail) {
        $detail_visa .= " " . $detail;
    }

    $data_porter = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $x['id'],
        "check_id" => '37'
    );

    $show_porter = get_total($data_porter);
    $result_porter = json_decode($show_porter, true);
    if ($result_porter['adt'] != 0) {
        $porter_price = "Rp." . number_format($result_porter['adt'], 0, ",", ".");
    }


    $data_tl = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $x['id'],
        "check_id" => '27'
    );

    $show_tl = get_total($data_tl);
    $result_tl = json_decode($show_tl, true);
    if ($result_tl['adt'] != 0) {
        $tl_price = "Rp." . number_format($result_tl['adt'], 0, ",", ".");
    }


    $data_guide = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $x['id'],
        "check_id" => '26'
    );

    $show_guide = get_total($data_guide);
    $result_guide = json_decode($show_guide, true);
    if ($result_guide['adt'] != 0) {
        $guide_price = "Rp." . number_format($result_guide['adt'], 0, ",", ".");
    }
    ////////////// include

    $arr_in = [];
    $arr_ex = [];
    $query_ex = "SELECT * FROM  checkbox_include2 order by id ASC";
    $rs_ex = mysqli_query($con, $query_ex);
    $blue_check = [0, 3, 4, 5, 6, 7, 17, 18, 19, 22, 23, 24, 36, 37, 38, 39, 41, 44, 47, 48, 49, 52, 53, 54];
    $red_check = [0, 9, 10, 11, 12, 13, 14, 15, 16, 25, 32, 33, 34, 35, 40, 42, 43, 45, 46, 55, 56, 57, 58];
    $yellow_check = [0, 5, 5, 17, 41, 44, 52, 53, 54];
    while ($row_ex = mysqli_fetch_array($rs_ex)) {
        $cek_val  = array_search($row_ex['id'], $val_check);
        if ($cek_val == "") {
            // masuk exclude
            $cek_red = array_search($row_ex['id'], $red_check);
            if ($cek_red == "") {
                $cek_blue = array_search($row_ex['id'], $blue_check);
                if ($cek_blue == "") {
                    array_push($arr_ex, $row_ex['id']);
                }
            }
        } else {
            // masuk include
            $cek_red = array_search($row_ex['id'], $red_check);
            if ($cek_red == "") {
                // var_dump($row_ex['id']);
                $cek_blue = array_search($row_ex['id'], $blue_check);
                if ($cek_blue != "") {
                    $data_price = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $x['id'],
                        "check_id" => $row_ex['id']
                    );
                    $show_price = get_total($data_price);
                    $result_price = json_decode($show_price, true);



                    // var_dump($data_price);
                    if ($result_price['adt'] != "" or $result_price['adt'] != '0' or $result_price['adt'] != null) {
                        array_push($arr_in, $row_ex['id']);
                        // var_dump($row_ex['id']);
                    } else {
                        $cek_yellow = array_search($row_ex['id'], $yellow_check);
                        if ($cek_yellow != "") {
                            array_push($arr_in, $row_ex['id']);
                        }
                    }
                } else {
                    array_push($arr_in, $row_ex['id']);
                }
            }
        }
    }


    $query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && sfee_id='" . $x['sfee_id'] . "'";
    $rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
    $row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);

    // var_dump($query_cek_addhari);
    $json_day = $row_data['hari'] + $row_cek_addhari['plus_hari'];
    $final_price = 0;
    if ($_POST['pax'] != "") {
    } else {
        $final_twn = $twn_rp['value'];
        $final_sgl = $sgl_rp['value'];
        $final_cnb = $cnb_rp['value'];
        $final_inf = $inf_rp['value'];
    }
    $data = [];
    $cek_hari = 1;
    for ($c = 1; $c <= $json_day; $c++) {

        $query_cek_hari = "SELECT  id ,hari,rute FROM  LT_AH_Main where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $_GET['grub_id'] . "' && hari='$c'";
        $rs_cek_hari = mysqli_query($con, $query_cek_hari);
        $row_cek_hari = mysqli_fetch_array($rs_cek_hari);

        if ($row_cek_hari['id'] != "") {
            $rute =  $row_cek_hari['rute'];
            $arr_tmp_list = [];

            $queryTmp2 = "SELECT * FROM LT_AH_ListTempat where tour_id='" . $row_data['id'] . "' && grub_id='" . $_GET['grub_id'] . "' && hari='" . $c . "' order by urutan ASC";
            $rsTmp2 = mysqli_query($con, $queryTmp2);
            while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                $query_tempat22 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
                $rs_tempat22 = mysqli_query($con, $query_tempat22);
                $row_tempat22 = mysqli_fetch_array($rs_tempat22);

                array_push($arr_tmp_list, $row_tempat22['tempat2']);
            }

            $arr_day = array(
                "hari" => $c,
                "rute" => $rute,
                "tempat" => $arr_tmp_list

            );
            array_push($data, $arr_day);
        } else {

            $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_data['master_id'] . "' && hari='" . $cek_hari . "'";
            $rsRute = mysqli_query($con, $queryRute);
            $rowRute = mysqli_fetch_array($rsRute);

            $query_rute_hide = "SELECT * FROM LT_Rute where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $_GET['grub_id'] . "' && hari='" . $cek_hari . "'";
            $rs_rute_hide = mysqli_query($con, $query_rute_hide);
            $row_rute_hide = mysqli_fetch_array($rs_rute_hide);

            if ($row_rute_hide['id'] == "") {
                $rute =  $rowRute['nama'];
            } else {
                $rute = $row_rute_hide['nama'];
            }

            $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['master_id'] . "' && hari='" . $cek_hari . "' order by urutan ASC";
            $rsTmp = mysqli_query($con, $queryTmp);
            // var_dump($queryTmp);
            $arr_tmp_list = [];
            while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
                $rs_tempat2 = mysqli_query($con, $query_tempat2);
                $row_tempat2 = mysqli_fetch_array($rs_tempat2);
                array_push($arr_tmp_list, $row_tempat2['tempat2']);
            }
            $arr_day = array(
                "hari" => $c,
                "rute" => $rute,
                "tempat" => $arr_tmp_list

            );
            array_push($data, $arr_day);

            $cek_hari++;
        }
    }
    $final_pax = "";
    if ($x['tl_pax'] != "") {
        $final_pax =  $x['tl_pax'];
    } else {
        $final_pax =  $result_hp['pax'] ;
    }


    return json_encode(array(
        "status" => "ok",
        "judul" => $judul,
        "pax" => $final_pax,
        "tgl" => $start_date,
        "twn" => $final_twn,
        "sgl" => $final_sgl,
        "cnb" => $final_cnb,
        "inf" => $final_inf,
        "data" => $data,
        "img1" => $g1,
        "img2" => $g2,
        "img3" => $g3,
        "img4" => $g4,
        "query" => $query_sel
    ), true);
}
