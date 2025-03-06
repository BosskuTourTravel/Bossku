<?php
function get_total_modal($datareq)
{
    include "../db=connection.php";
    $id = $datareq['copy_id'];
    $sfee_id = $datareq['sfee_id'];
    $grub_id = $datareq['grub_id'];
    $check_id = $datareq['check_id'];
    $query_data = "SELECT * FROM  LTSUB_itin where id=" . $id;
    $rs_data = mysqli_query($con, $query_data);
    $row_data = mysqli_fetch_array($rs_data);
    $master_id = $row_data['master_id'];
    $copy_id = $row_data['id'];

    $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
    $rs_adm = mysqli_query($con, $query_adm);
    $row_adm = mysqli_fetch_array($rs_adm);
    $include = explode(",", $row_adm['include']);
    $exclude = explode(",", $row_adm['exclude']);

    $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $grub_id . "'  && LTP_insert_sfee.id='" . $sfee_id . "'";
    $rs_grub = mysqli_query($con, $query_grub);
    $row_grub = mysqli_fetch_array($rs_grub);
    // var_dump($query_grub);


    if ($check_id == '1') {

        $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $grub_id . "' order by id ASC";
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
            // var_dump($query_detail2);


            $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail2['route_id'] . "'";
            $rs_rt = mysqli_query($con, $query_rt);
            $row_rt = mysqli_fetch_array($rs_rt);
            // var_dump($query_rt);

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
        return json_encode(array("adt" => $adt, "chd" => $chd, "inf" => $inf, "sgl" => $adt, "detail" => ""), true);
    } else if ($check_id == '8') {
        if ($row_data['landtour'] != "undefined") {
            $query = "SELECT hotel_id FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "'";
            $rs = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($rs);
            if ($row['hotel_id'] != "") {
                $query_itin = "SELECT * FROM  LT_itinnew where id=" . $row['hotel_id'];
                $rs_itin = mysqli_query($con, $query_itin);
                $row_itin = mysqli_fetch_assoc($rs_itin);
                $exp_negara = preg_split("( - )", $row_itin['negara']);
                $exp_vp = preg_split("( - )", $row_itin['vp']);
                $vp = $row_itin['vp'];

                $query_visa_add = "SELECT visa_id FROM Visa_add where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "'";
                $rs_visa_add = mysqli_query($con, $query_visa_add);
                $isi = 0;
                $adt = 0;
                $data = [];
                // array_push($data, $query_visa_add);

                while ($row_visa_add = mysqli_fetch_array($rs_visa_add)) {

                    $query_visa = "SELECT * FROM Visa2 where id=" . $row_visa_add['id'];
                    $rs_visa = mysqli_query($con, $query_visa);
                    $row_visa = mysqli_fetch_array($rs_visa);

                    if ($row_visa['id'] != "") {
                        if ($row_visa['kurs'] != 'IDR') {
                            if ($row_visa['sell_price'] != '0') {
                                $datareq = array(
                                    "kurs" =>  $row_visa['kurs'],
                                    "nominal" => $row_visa['sell_price'],
                                );
                                $adt_kurs = get_kurs($datareq);
                                $rs_adt_kurs = json_decode($adt_kurs, true);
                                $adt = $adt +  $rs_adt_kurs['data'];
                            } else {
                                $adt = $adt + $row_visa['sell_price'];
                            }
                        } else {
                            $adt = $adt + $row_visa['sell_price'];
                        }
                        $detail = $row_visa['visa'] . " " . $row_visa['jenis'] . " " . $row_visa['tipe'] . " " . $row_visa['durasi'] . " From : " . $row_visa['kota'];
                        array_push($data, $detail);
                        $isi++;
                    }
                }
                if ($isi == '0') {
                    $query_cabang = "SELECT nama FROM cabang where id=" . $row_data['cabang'];
                    $rs_cabang = mysqli_query($con, $query_cabang);
                    $row_cabang = mysqli_fetch_array($rs_cabang);

                    foreach ($exp_negara as $negara) {
                        $cek_val = '1';
                        foreach ($exp_vp as $val_vp) {
                            if ($val_vp == $negara) {
                                $cek_val = '2';
                                break;
                            }
                        }
                        // $cek_val  = array_search($negara, $exp_vp);
                        if ($cek_val == '1') {
                            $query_visa2 = "SELECT * FROM Visa2 where kota='" . $row_cabang['nama'] . "' && visa='" . $negara . "' && jenis='SINGLE' limit 1";
                            $rs_visa2 = mysqli_query($con, $query_visa2);
                            $row_visa2 = mysqli_fetch_array($rs_visa2);
                            // array_push($data, $query_visa2);
                            if ($row_visa2['id'] == "") {
                                $detail = $negara . " Harga TBA ";
                            } else {
                                if ($row_visa2['kurs'] != 'IDR') {
                                    if ($row_visa2['sell_price'] != '0') {
                                        $datareq2 = array(
                                            "kurs" =>  $row_visa2['kurs'],
                                            "nominal" => $row_visa2['sell_price'],
                                        );
                                        $adt_kurs2 = get_kurs($datareq2);
                                        $rs_adt_kurs2 = json_decode($adt_kurs2, true);
                                        $adt = $adt +  $rs_adt_kurs2['data'];
                                    } else {
                                        $adt = $adt + $row_visa2['sell_price'];
                                    }
                                } else {
                                    $adt = $adt + $row_visa2['sell_price'];
                                }
                                $detail = $row_visa2['visa'] . " " . $row_visa2['jenis'] . " " . $row_visa2['tipe'] . " " . $row_visa2['durasi'] . " From : " . $row_visa2['kota'];
                                array_push($data, $detail);
                            }
                        } else {
                            $detail = $negara . " Free ";
                            array_push($data, $detail);
                        }
                    }
                }
                return json_encode(array("adt" => $adt, "chd" => $adt, "inf" => $adt, "sgl" => $adt, "detail" => $data), true);
            } else {
                $data = ['Belum Pilih Hotel id'];
                return json_encode(array("adt" => 0, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => $data), true);
            }
        } else {
            $data = ['No Code'];
            return json_encode(array("adt" => 0, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => $data), true);
        }
    } else if ($check_id == '15') {
        $data_hotel = array(
            "copy_id" => $row_data['id'],
            "master_id" => $row_data['master_id'],
        );

        $show_hp = get_hotel_modal($data_hotel);
        $result_hp = json_decode($show_hp, true);
        // var_dump($result_hp);id_hotel
        return json_encode(array("adt" => $result_hp['twn'], "chd" => $result_hp['cnb'], "inf" =>  $result_hp['inf'], "sgl" =>  $result_hp['sgl'], "detail" => $result_hp['id_hotel']), true);
        // echo $result_hp['twn'];
    } else if ($check_id == '17') {
        $show_tps = get_adm_modal($include);
        $result_tps = json_decode($show_tps, true);
        return json_encode(array("adt" => $result_tps['adt'], "chd" => $result_tps['cnb'], "inf" =>  $result_tps['inf'], "sgl" =>  $result_tps['sgl'], "detail" => ""), true);
    } else if ($check_id == '18') {
        $query_plane = "SELECT * FROM  LT_add_transport_baru where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && type='2' && grub_id='" . $grub_id . "'";
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
        $query_train = "SELECT * FROM  LT_add_transport_baru where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && type='4'";
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
    } else if ($check_id == '23') {
        $query_plane = "SELECT * FROM LT_add_transport_baru where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
        $rs_plane = mysqli_query($con, $query_plane);
        $price = 0;
        $data = [];
        $bagasi_price = 0;
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            if ($row_plane['type'] == '1') {

                $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                $rsflight = mysqli_query($con, $queryflight);
                $rowflight = mysqli_fetch_array($rsflight);
                $bagasi_price = $bagasi_price + $rowflight['bagasi_price'];
                $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'];
                array_push($data, $detail);
            }
        }
        // return json_encode(array("adt" => $price, "chd" => $price, "inf" => $price, "sgl" => $price, "detail" => $data), true);
        return json_encode(array("adt" => $bagasi_price, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => $data), true);
    } else if ($check_id == '24') {
        $query_plane = "SELECT * FROM LT_add_transport_baru where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
        $rs_plane = mysqli_query($con, $query_plane);
        $adt = 0;
        $chd = 0;
        $inf = 0;
        $data = [];
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            if ($row_plane['type'] == '1') {
                $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $row_plane['transport'];
                $rs_flight2 = mysqli_query($con, $query_flight2);
                $row_flight2 = mysqli_fetch_array($rs_flight2);
                $adt = $adt + $row_flight2['bf'] + $row_flight2['ln'] + $row_flight2['dn'];
            }
        }
        return json_encode(array("adt" => $adt, "chd" => $adt, "inf" => '0', "sgl" => $adt, "detail" => $data), true);
    } else if ($check_id == '26') {
        $query_master = "SELECT * FROM LT_itinerary2 WHERE id='" . $master_id . "'";
        $rs_master = mysqli_query($con, $query_master);
        $row_master = mysqli_fetch_array($rs_master);


        ///// select code
        if ($row_master['landtour'] != "undefined") {
            $query_itin = "SELECT * FROM LT_itinnew WHERE kode='" . $row_master['landtour'] . "' limit 1";
            $rs_itin = mysqli_query($con, $query_itin);
            $row_itin = mysqli_fetch_array($rs_itin);


            if ($row_itin['agent'] == "") {
                $agent = "PTT";
            } else {
                $agent =  $row_itin['agent'];
            }
            $exp_negara = preg_split("( - )", $row_itin['negara']);
            if (count($exp_negara) > 1) {
                $data = [];
                $guide = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && tour_code='" . $row_master['landtour'] . "' && negara = '" . $value . "' && type='B' ";
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
                    //  array_push($data,$datareq);
                }
                return json_encode(array("adt" => $guide, "chd" => $guide, "inf" => $guide, "sgl" => $guide, "detail" => $exp_negara), true);
            } else {
                $data = [];
                $guide = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara ='" . $row_itin['negara'] . "' && type='A' &&  '" . $row_itin['pax'] . "' <= until_pax && '" . $row_itin['pax'] . "' >= tt_pax ";
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

                // array_push($data, $value_guide);
                $guide = $guide + $value_guide;
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
    } else if ($check_id == '55') {
        $data_tps = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['id'],
            "sfee_id" => $row_grub['sfee_id']
        );
        // var_dump($data_tps);

        $show_tps = get_hotel_forLT_modal($data_tps);
        $result_tps = json_decode($show_tps, true);
        $ph = $result_tps['adt'] / 2;
        return json_encode(array("adt" => $ph, "chd" => $ph, "inf" =>  $ph, "sgl" =>  $result_tps['adt'], "detail" => ""), true);
        // echo $ph;
    }
}


function get_hotel_forLT_modal($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $sfee_id = $datareq['sfee_id'];

    $query_hotel_data = "SELECT * FROM LT_AH_ListHotel WHERE copy_id='" . $copy_id . "' && master_id='" . $master_id . "' && sfee_id='" . $sfee_id . "'";
    $rs_hotel_data = mysqli_query($con, $query_hotel_data);
    $gt = 0;
    while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
        $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
        $rs_hlt = mysqli_query($con, $query_hlt);
        $row_hlt = mysqli_fetch_array($rs_hlt);
        if ($row_hotel_data['rate'] == '1') {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "nominal" => $row_hlt['rate_low'],
            );

            $adt_kurs = get_kurs($data);
            $rs_adt_kurs = json_decode($adt_kurs, true);

            $gt = $gt + $rs_adt_kurs['data'];
            // echo number_format($result_rate2['price'], 0, ",", ".");
        } else {
            $data = array(
                "kurs" =>  $row_hlt['kurs'],
                "nominal" => $row_hlt['rate_high'],
            );
            $adt_kurs = get_kurs($data);
            $rs_adt_kurs = json_decode($adt_kurs, true);


            $gt = $gt + $rs_adt_kurs['data'];
            // echo number_format($result_rate2['price'], 0, ",", ".");
        }
    }
    return json_encode(array("adt" => $gt, "chd" => $gt, "inf" => $gt, "sgl" => $gt, "detail" => $query_hlt), true);
}


function get_hotel_modal($data)
{
    include "../db=connection.php";

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



    $atwn =  $agent_twn;
    $asgl =  $agent_sgl;
    $acnb =  $agent_cnb;
    $asglsub =  $row_itin['agent_sglsub'];
    $ainfant =  $agent_inf;

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
        "sgl" => $asgl,
        "id_hotel" => $id_hotel,
        "hotel" =>  $arr_hotel,
    ), true);
}

function get_adm_modal($adm_inc)
{
    include "../db=connection.php";
    $adt_tmp = 0;
    foreach ($adm_inc as $val_tmp) {
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
    }
    return json_encode(array("adt" => $adt_tmp, "chd" =>  $adt_tmp, "inf" => $adt_tmp, "sgl" => $adt_tmp, "detail" => ""), true);
}


function get_kurs($d)
{
    include "../db=connection.php";
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
    $show_fr = get_total_modal($data_fr);
    $result_fr = json_decode($show_fr, true);
    /// get price train
    $data_tr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "19"
    );
    $show_tr = get_total_modal($data_tr);
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

    return json_encode(array("adt" => $vttpax, "chd" => $vttpax, "inf" => $vttpax, "sgl" => $vttpax, "detail" => $data, "breakdown" => $arr_breakdown, "break_cost_tl" => $arr_break_costtl, "feetl_cover" => $arr_feetl_cover, "costtl_cover" => $arr_ct_cover, "grand" => $grand, "custom"=> $ttpax), true);
}

function get_flight_tl($grub_id){
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
        $query_rd_tl = "SELECT * FROM  LTP_route_detail where id='" .$row_gfv_price_tl['flight_id'] . "'";
        $rs_rd_tl= mysqli_query($con, $query_rd_tl);
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
