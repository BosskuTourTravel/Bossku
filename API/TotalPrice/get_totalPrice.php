<?php
/// live :  https://sg-api.globaltix.com/api
/// dummy : https://uat-api.globaltix.com/api
// $datareq = array(
//     "master_id" => '951',
//     "copy_id" => '885',
//     "check_id" => '39'
// );
// // var_dump($datareq);
// $show_p =  get_total($datareq);
// $rs_p = json_decode($show_p, true);
// var_dump($rs_p);

function get_total($datareq)
{
    // include ".../../db=connection.php";
    include "../../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $check_id = $datareq['check_id'];
    $flight_post_id = $datareq['flight'];
    $date_post = $datareq['date'];
    // var_dump($datareq['date']);
   

    if ($check_id == '5') {
         
        $query_master = "SELECT * FROM LT_itinerary2  where id=" . $master_id;
        $rs_master = mysqli_query($con, $query_master);
        $row_master = mysqli_fetch_array($rs_master);
        // return json_encode(array("adt" => 0, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => $query_master), true);
        if ($row_master['landtour'] == "undefined") {
            $data = [];
            // $query_hotel = "SELECT * FROM  LT_select_PilihHTLNC where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
            $query_hotel = "SELECT * FROM  LT_select_PilihHTLNC where master_id='" . $master_id . "'";
            $rs_hotel = mysqli_query($con, $query_hotel);
            $twin = 0;
            $triple = 0;
            $family = 0;
            while ($row_hotel = mysqli_fetch_array($rs_hotel)) {
                $twin = $twin + $row_hotel['hotel_twin'];
                $triple = $triple + $row_hotel['hotel_triple'];
                $family = $family + $row_hotel['hotel_family'];
                array_push($data, $row_hotel['hotel_name']);
            }
            return json_encode(array("adt" => $twin, "chd" => $twin, "inf" => $twin, "sgl" => $twin, "detail" => $data), true);
        }else{
            return json_encode(array("adt" => 0, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => $data), true);
        }
    } else if ($check_id == '8') {
        $query_sub = "SELECT * FROM LTSUB_itin where  id='" . $copy_id . "'";
        $rs_sub = mysqli_query($con, $query_sub);
        $row_sub = mysqli_fetch_array($rs_sub);
        if ($row_sub['landtour'] != "undefined") {
            $query = "SELECT hotel_id FROM  LT_select_PilihHTL where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
            $rs = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($rs);
            if ($row['hotel_id'] != "") {
                $query_itin = "SELECT * FROM  LT_itinnew where id=" . $row['hotel_id'];
                $rs_itin = mysqli_query($con, $query_itin);
                $row_itin = mysqli_fetch_assoc($rs_itin);
                $exp_negara = preg_split("( - )", $row_itin['negara']);
                $exp_vp = preg_split("( - )", $row_itin['vp']);
                $vp = $row_itin['vp'];

                $query_visa_add = "SELECT visa_id FROM Visa_add where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
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
                    $query_cabang = "SELECT nama FROM cabang where id=" . $row_sub['cabang'];
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
    } else if ($check_id == '56') {
        $query_master_meal = "SELECT * FROM LT_add_meal  where tour_id=" . $master_id;
        $rs_master_meal = mysqli_query($con, $query_master_meal);
        $total = 0;
        $data = [];
        while ($row_master_meal = mysqli_fetch_array($rs_master_meal)) {


            if ($row_master_meal['bf'] != '0') {
                $hbf = 0;
                $query_bf = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['bf'];
                $rs_bf = mysqli_query($con, $query_bf);
                $row_bf = mysqli_fetch_array($rs_bf);

                $datareq = array(
                    "kurs" =>  $row_bf['kurs'],
                    "nominal" => $row_bf['price'],
                );
                $bf_pem = get_kurs($datareq);
                $rs_bf_pem = json_decode($bf_pem, true);
                $hbf =  $rs_bf_pem['data'];
            }
            if ($row_master_meal['ln'] != '0') {
                $hln = 0;
                $query_ln = "SELECT * FROM Guest_meal2  where id=" . $row_master_meal['ln'];
                $rs_ln = mysqli_query($con, $query_ln);
                $row_ln = mysqli_fetch_array($rs_ln);

                $datareq = array(
                    "kurs" =>  $row_ln['kurs'],
                    "nominal" => $row_ln['price'],
                );
                $ln_pem = get_kurs($datareq);
                $rs_ln_pem = json_decode($ln_pem, true);
                $hln =  $rs_ln_pem['data'];
            }
            if ($row_master_meal['dn'] != '0') {
                $hdn = 0;
                $query_dn = "SELECT * FROM Guest_meal2 where id=" . $row_master_meal['dn'];
                $rs_dn = mysqli_query($con, $query_dn);
                $row_dn = mysqli_fetch_array($rs_dn);



                $datareq = array(
                    "kurs" =>  $row_dn['kurs'],
                    "nominal" => $row_dn['price'],
                );
                $dn_pem = get_kurs($datareq);
                $rs_dn_pem = json_decode($dn_pem, true);
                $hdn =  $rs_dn_pem['data'];
            }
            $total = $total + $hbf + $hln + $hdn;

            // array_push($data,$query_master_meal);
        }
        return json_encode(array("adt" => $total, "chd" => $total, "inf" => $total, "sgl" => $total, "detail" => $data), true);
    } else if ($check_id == '18') {
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
    } else if ($check_id == 19) {
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
    } else if ($check_id == 23) {
        $query_plane = "SELECT * FROM LT_add_transport where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
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
                array_push($data,$detail);
            }
        }
        // return json_encode(array("adt" => $price, "chd" => $price, "inf" => $price, "sgl" => $price, "detail" => $data), true);
        return json_encode(array("adt" => $bagasi_price, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => $data), true);
    } else if ($check_id == '24') {

        $query_plane = "SELECT * FROM LT_add_transport where master_id='" . $master_id . "' && copy_id='" . $copy_id . "'";
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
    } else if ($check_id == '27') {
        // tnpa kode blom di tentukan
        $query_tl = "SELECT * FROM  LT_add_Tips where tour_id='" . $master_id . "' order by hari ASC";
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
    } else if ($check_id == '36') {

        $query_master = "SELECT * FROM LT_itinerary2 WHERE id='" . $master_id . "'";
        $rs_master = mysqli_query($con, $query_master);
        $row_master = mysqli_fetch_array($rs_master);


        ///// select code
        if ($row_master['landtour'] != "undefined") {
            $query_itin = "SELECT * FROM LT_itinnew WHERE kode='" . $row_master['landtour'] . "'";
            $rs_itin = mysqli_query($con, $query_itin);
            $row_itin = mysqli_fetch_array($rs_itin);

            if ($row_itin['agent'] == "") {
                $agent = "PTT";
            } else {
                $agent =  $row_itin['agent'];
            }
            $exp_negara = preg_split("( - )", $row_itin['negara']);
            if (count($exp_negara) > 1) {
                $ass = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara = '" . $value . "' && type='B' ";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);
                    if ($row_tips['id'] != "") {
                        $value = $row_tips['ass'] * $row_tips['tt_hari'];
                        $datareq = array(
                            "kurs" => $row_tips['kurs'],
                            "nominal" => $value,
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $value_ass = $result_show_kurs['data'];
                        $ass = $ass + $value_ass;
                    }
                }

                return json_encode(array("adt" => $ass, "chd" => $ass, "inf" => $ass, "sgl" => $ass, "detail" => $exp_negara), true);
            } else {
                $ass = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara = '" . $row_itin['negara'] . "' && type='A' &&  tt_pax < '" . $row_itin['pax'] . "' && until_pax > '" . $row_itin['pax'] . "'";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);

                $value = $row_tips['ass'] * $row_master['hari'];
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_ass = $result_show_kurs['data'];

                $ass = $ass + $value_ass;
                return json_encode(array("adt" => $ass, "chd" => $ass, "inf" => $ass, "sgl" => $ass, "detail" => $exp_negara), true);
            }
        } else {
            $query_negara = "SELECT * FROM tips_negara WHERE master_id='" . $master_id . "' && copy_id='$copy_id'";
            $rs_negara = mysqli_query($con, $query_negara);
            $row_negara = mysqli_fetch_array($rs_negara);
            if ($row_negara['id'] != "") {
                $exp_negara = preg_split("( - )", $row_negara['negara']);
                if (count($exp_negara) > 1) {
                    $ass = 0;
                    foreach ($exp_negara as $value) {
                        $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $value . "' && type='B' ";
                        $rs_tips = mysqli_query($con, $query_tips);
                        $row_tips = mysqli_fetch_array($rs_tips);
                        if ($row_tips['id'] != "") {
                            $value = $row_tips['ass'] * $row_tips['tt_hari'];
                            $datareq = array(
                                "kurs" => $row_tips['kurs'],
                                "nominal" => $value,
                            );
                            $show_kurs = get_kurs($datareq);
                            $result_show_kurs = json_decode($show_kurs, true);
                            $value_ass = $result_show_kurs['data'];
                            $ass = $ass + $value_ass;
                        }
                    }

                    return json_encode(array("adt" => $ass, "chd" => $ass, "inf" => $ass, "sgl" => $ass, "detail" => $exp_negara), true);
                } else {
                    $ass = 0;
                    $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $row_negara['negara'] . "' && type='A'";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);

                    $value = $row_tips['ass'] * $row_master['hari'];
                    $datareq = array(
                        "kurs" => $row_tips['kurs'],
                        "nominal" => $value,
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $value_ass = $result_show_kurs['data'];

                    $ass = $ass + $value_ass;
                    return json_encode(array("adt" => $ass, "chd" => $ass, "inf" => $ass, "sgl" => $ass, "detail" => $exp_negara), true);
                }
            }
        }
    } else if ($check_id == '37') {
        $query_master = "SELECT * FROM LT_itinerary2 WHERE id='" . $master_id . "'";
        $rs_master = mysqli_query($con, $query_master);
        $row_master = mysqli_fetch_array($rs_master);


        ///// select code
        if ($row_master['landtour'] != "undefined") {
            $query_itin = "SELECT * FROM LT_itinnew WHERE kode='" . $row_master['landtour'] . "'";
            $rs_itin = mysqli_query($con, $query_itin);
            $row_itin = mysqli_fetch_array($rs_itin);

            if ($row_itin['agent'] == "") {
                $agent = "PTT";
            } else {
                $agent =  $row_itin['agent'];
            }
            $exp_negara = preg_split("( - )", $row_itin['negara']);
            if (count($exp_negara) > 1) {
                $porter = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara = '" . $value . "' && type='B' ";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);
                    if ($row_tips['id'] != "") {
                        $value = $row_tips['porter'] * $row_tips['tt_hari'];
                        $datareq = array(
                            "kurs" => $row_tips['kurs'],
                            "nominal" => $value,
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $value_porter = $result_show_kurs['data'];
                        $porter = $porter + $value_porter;
                    }
                }

                return json_encode(array("adt" => $porter, "chd" => $porter, "inf" => $porter, "sgl" => $porter, "detail" => $exp_negara), true);
            } else {
                $porter = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara ='" . $row_itin['negara'] . "' && type='A' &&  tt_pax < '" . $row_itin['pax'] . "' && until_pax > '" . $row_itin['pax'] . "'";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);

                $value = $row_tips['porter'] * $row_master['hari'];
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_porter = $result_show_kurs['data'];

                $porter = $porter + $value_porter;
                return json_encode(array("adt" => $porter, "chd" => $porter, "inf" => $porter, "sgl" => $porter, "detail" => $exp_negara), true);
            }
        } else {
            $query_negara = "SELECT * FROM tips_negara WHERE master_id='" . $master_id . "' && copy_id='$copy_id'";
            $rs_negara = mysqli_query($con, $query_negara);
            $row_negara = mysqli_fetch_array($rs_negara);
            if ($row_negara['id'] != "") {
                $exp_negara = preg_split("( - )", $row_negara['negara']);
                if (count($exp_negara) > 1) {
                    $porter = 0;
                    foreach ($exp_negara as $value) {
                        $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $value . "' && type='B' ";
                        $rs_tips = mysqli_query($con, $query_tips);
                        $row_tips = mysqli_fetch_array($rs_tips);
                        if ($row_tips['id'] != "") {
                            $value = $row_tips['porter'] * $row_tips['tt_hari'];
                            $datareq = array(
                                "kurs" => $row_tips['kurs'],
                                "nominal" => $value,
                            );
                            $show_kurs = get_kurs($datareq);
                            $result_show_kurs = json_decode($show_kurs, true);
                            $value_porter = $result_show_kurs['data'];
                            $porter = $porter + $value_porter;
                        }
                    }

                    return json_encode(array("adt" => $porter, "chd" => $porter, "inf" => $porter, "sgl" => $porter, "detail" => $exp_negara), true);
                } else {
                    $porter = 0;
                    $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara = '" . $row_negara['negara'] . "' && type='A'";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);

                    $value = $row_tips['porter'] * $row_master['hari'];
                    $datareq = array(
                        "kurs" => $row_tips['kurs'],
                        "nominal" => $value,
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $value_porter = $result_show_kurs['data'];

                    $porter = $porter + $value_porter;
                    return json_encode(array("adt" => $porter, "chd" => $porter, "inf" => $porter, "sgl" => $porter, "detail" => $exp_negara), true);
                }
            }
        }
    } else if ($check_id == '38') {
        $query_master = "SELECT * FROM LT_itinerary2 WHERE id='" . $master_id . "'";
        $rs_master = mysqli_query($con, $query_master);
        $row_master = mysqli_fetch_array($rs_master);


        ///// select code
        if ($row_master['landtour'] != "undefined") {
            $query_itin = "SELECT * FROM LT_itinnew WHERE kode='" . $row_master['landtour'] . "'";
            $rs_itin = mysqli_query($con, $query_itin);
            $row_itin = mysqli_fetch_array($rs_itin);

            if ($row_itin['agent'] == "") {
                $agent = "PTT";
            } else {
                $agent =  $row_itin['agent'];
            }
            $exp_negara = preg_split("( - )", $row_itin['negara']);
            if (count($exp_negara) > 1) {
                $restaurant = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara = '" . $value . "' && type='B' ";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);
                    if ($row_tips['id'] != "") {
                        $value = $row_tips['restaurant'] * $row_tips['tt_hari'];
                        $datareq = array(
                            "kurs" => $row_tips['kurs'],
                            "nominal" => $value,
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $value_restaurant = $result_show_kurs['data'];
                        $restaurant = $restaurant + $value_restaurant;
                    }
                }

                return json_encode(array("adt" => $restaurant, "chd" => $restaurant, "inf" => $restaurant, "sgl" => $restaurant, "detail" => $exp_negara), true);
            } else {
                $restaurant = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara ='" . $row_itin['negara'] . "' && type='A' &&  tt_pax < '" . $row_itin['pax'] . "' && until_pax > '" . $row_itin['pax'] . "'";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);

                $value = $row_tips['restaurant'] * $row_master['hari'];
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_restaurant = $result_show_kurs['data'];

                $restaurant = $restaurant + $value_restaurant;
                return json_encode(array("adt" => $restaurant, "chd" => $restaurant, "inf" => $restaurant, "sgl" => $restaurant, "detail" => $exp_negara), true);
            }
        } else {
            $query_negara = "SELECT * FROM tips_negara WHERE master_id='" . $master_id . "' && copy_id='$copy_id'";
            $rs_negara = mysqli_query($con, $query_negara);
            $row_negara = mysqli_fetch_array($rs_negara);
            if ($row_negara['id'] != "") {
                $exp_negara = preg_split("( - )", $row_negara['negara']);
                if (count($exp_negara) > 1) {
                    $restaurant = 0;
                    foreach ($exp_negara as $value) {
                        $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $value . "' && type='B' ";
                        $rs_tips = mysqli_query($con, $query_tips);
                        $row_tips = mysqli_fetch_array($rs_tips);
                        if ($row_tips['id'] != "") {
                            $value = $row_tips['restaurant'] * $row_tips['tt_hari'];
                            $datareq = array(
                                "kurs" => $row_tips['kurs'],
                                "nominal" => $value,
                            );
                            $show_kurs = get_kurs($datareq);
                            $result_show_kurs = json_decode($show_kurs, true);
                            $value_restaurant = $result_show_kurs['data'];
                            $restaurant = $restaurant + $value_restaurant;
                        }
                    }

                    return json_encode(array("adt" => $restaurant, "chd" => $restaurant, "inf" => $restaurant, "sgl" => $restaurant, "detail" => $exp_negara), true);
                } else {
                    $restaurant = 0;
                    $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $row_negara['negara'] . "' && type='A'";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);

                    $value = $row_tips['restaurant'] * $row_master['hari'];
                    $datareq = array(
                        "kurs" => $row_tips['kurs'],
                        "nominal" => $value,
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $value_restaurant = $result_show_kurs['data'];

                    $restaurant = $restaurant + $value_restaurant;
                    return json_encode(array("adt" => $restaurant, "chd" => $restaurant, "inf" => $restaurant, "sgl" => $restaurant, "detail" => $exp_negara), true);
                }
            }
        }
    } else if ($check_id == '39') {
        $query_master = "SELECT * FROM LT_itinerary2 WHERE id='" . $master_id . "'";
        $rs_master = mysqli_query($con, $query_master);
        $row_master = mysqli_fetch_array($rs_master);


        ///// select code
        if ($row_master['landtour'] != "undefined") {
            $query_itin = "SELECT * FROM LT_itinnew WHERE kode='" . $row_master['landtour'] . "'";
            $rs_itin = mysqli_query($con, $query_itin);
            $row_itin = mysqli_fetch_array($rs_itin);

            if ($row_itin['agent'] == "") {
                $agent = "PTT";
            } else {
                $agent =  $row_itin['agent'];
            }
            $exp_negara = preg_split("( - )", $row_itin['negara']);
            if (count($exp_negara) > 1) {
                $driver = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara ='" . $value . "' && type='B' ";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);
                    if ($row_tips['id'] != "") {
                        $value = $row_tips['driver'] * $row_tips['tt_hari'];
                        $datareq = array(
                            "kurs" => $row_tips['kurs'],
                            "nominal" => $value,
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $value_driver = $result_show_kurs['data'];
                        $driver = $driver + $value_driver;
                    }
                }

                return json_encode(array("adt" => $driver, "chd" => $driver, "inf" => $driver, "sgl" => $driver, "detail" => $exp_negara), true);
            } else {
                $driver = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara ='" . $row_itin['negara'] . "' && type='A' &&  tt_pax < '" . $row_itin['pax'] . "' && until_pax > '" . $row_itin['pax'] . "'";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);

                $value = $row_tips['driver'] * $row_master['hari'];
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_driver = $result_show_kurs['data'];

                $driver = $driver + $value_driver;
                return json_encode(array("adt" => $driver, "chd" => $driver, "inf" => $driver, "sgl" => $driver, "detail" => $exp_negara), true);
            }
        } else {
            $query_negara = "SELECT * FROM tips_negara WHERE master_id='" . $master_id . "' && copy_id='$copy_id'";
            $rs_negara = mysqli_query($con, $query_negara);
            $row_negara = mysqli_fetch_array($rs_negara);
            if ($row_negara['id'] != "") {
                $exp_negara = preg_split("( - )", $row_negara['negara']);
                if (count($exp_negara) > 1) {
                    $driver = 0;
                    foreach ($exp_negara as $value) {
                        $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $value . "' && type='B' ";
                        $rs_tips = mysqli_query($con, $query_tips);
                        $row_tips = mysqli_fetch_array($rs_tips);
                        if ($row_tips['id'] != "") {
                            $value = $row_tips['driver'] * $row_tips['tt_hari'];
                            $datareq = array(
                                "kurs" => $row_tips['kurs'],
                                "nominal" => $value,
                            );
                            $show_kurs = get_kurs($datareq);
                            $result_show_kurs = json_decode($show_kurs, true);
                            $value_driver = $result_show_kurs['data'];
                            $driver = $driver + $value_driver;
                        }
                    }

                    return json_encode(array("adt" => $driver, "chd" => $driver, "inf" => $driver, "sgl" => $driver, "detail" => $exp_negara), true);
                } else {
                    $driver = 0;
                    $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara ='" . $row_negara['negara'] . "' && type='A'";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);

                    $value = $row_tips['driver'] * $row_master['hari'];
                    $datareq = array(
                        "kurs" => $row_tips['kurs'],
                        "nominal" => $value,
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $value_driver = $result_show_kurs['data'];

                    $driver = $driver + $value_driver;
                    return json_encode(array("adt" => $driver, "chd" => $driver, "inf" => $driver, "detail" => $exp_negara), true);
                }
            }
        }
    }else {
        return json_encode(array("adt" => 0, "chd" => 0, "inf" => 0, "sgl" => 0, "detail" => ""), true);
    }
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


function get_guide($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];

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
            $guide = 0;
            $p = 1;
            $total_usd = 0;
            foreach ($exp_negara as $value) {
                $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara like '" . $value . "' && type='B' ";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);
                if ($row_tips['id'] != "") {
                    $value = $row_tips['guide'] * $row_tips['tt_hari'];
                    $total_usd = $total_usd + $value;
                    $datareq = array(
                        "kurs" => $row_tips['kurs'],
                        "nominal" => $value,
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $value_guide = $result_show_kurs['data'];
                    $guide = $guide + $value_guide;
                }
                $p++;
            }
            $detail = " ( " . $row_tips['guide'] . " * " . $row_tips['tt_hari'] . " ) " . " * " . $p;

            return json_encode(array("adt" => $guide, "kurs" => $row_tips['kurs'], "total" => $total_usd, "detail" => $detail), true);
        } else {
            $guide = 0;
            $query_tips = "SELECT * FROM tips_LT  where agent='" . $agent . "' && negara like '" . $row_itin['negara'] . "' && type='A' &&  '" . $row_itin['pax'] . "' <= until_pax && '" . $row_itin['pax'] . "' >= tt_pax ";
            $rs_tips = mysqli_query($con, $query_tips);
            $row_tips = mysqli_fetch_array($rs_tips);
            $total_usd = 0;
            $value = $row_tips['guide'] * $row_master['hari'];
            $total_usd = $total_usd + $value;
            $datareq = array(
                "kurs" => $row_tips['kurs'],
                "nominal" => $value,
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $value_guide = $result_show_kurs['data'];

            $guide = $guide + $value_guide;
            $detail = $row_tips['guide'] . " * " . $row_master['hari'];
            return json_encode(array("adt" => $guide, "kurs" => $row_tips['kurs'], "total" => $total_usd, "detail" => $detail), true);
        }
    } else {
        $query_negara = "SELECT * FROM tips_negara WHERE master_id='" . $master_id . "' && copy_id='$copy_id'";
        $rs_negara = mysqli_query($con, $query_negara);
        $row_negara = mysqli_fetch_array($rs_negara);
        if ($row_negara['id'] != "") {
            $exp_negara = preg_split("( - )", $row_negara['negara']);
            if (count($exp_negara) > 1) {
                $guide = 0;
                $total_usd = 0;
                foreach ($exp_negara as $value) {
                    $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara like '" . $value . "' && type='B' ";
                    $rs_tips = mysqli_query($con, $query_tips);
                    $row_tips = mysqli_fetch_array($rs_tips);
                    if ($row_tips['id'] != "") {
                        $value = $row_tips['guide'] * $row_tips['tt_hari'];
                        $total_usd = $total_usd + $value;
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
                $detail = " ( " . $row_tips['guide'] . " * " . $row_tips['tt_hari'] . " ) " . " * " . $p;
                return json_encode(array("adt" => $guide, "kurs" => $row_tips['kurs'], "total" => $total_usd, "detail" => $detail), true);
            } else {
                $guide = 0;
                $query_tips = "SELECT * FROM tips_LT  where agent='PTT' && negara like '" . $row_negara['negara'] . "' && type='A'";
                $rs_tips = mysqli_query($con, $query_tips);
                $row_tips = mysqli_fetch_array($rs_tips);
                $total_usd = 0;
                $value = $row_tips['guide'] * $row_master['hari'];
                $total_usd = $total_usd + $value;
                $datareq = array(
                    "kurs" => $row_tips['kurs'],
                    "nominal" => $value,
                );
                $show_kurs = get_kurs($datareq);
                $result_show_kurs = json_decode($show_kurs, true);
                $value_guide = $result_show_kurs['data'];

                $guide = $guide + $value_guide;
                $detail = $row_tips['guide'] . " * " . $row_master['hari'];
                return json_encode(array("adt" => $guide, "kurs" => $row_tips['kurs'], "total" => $total_usd, "detail" => $detail), true);
            }
        }
    }
}

// function get_kurs($datareq)
// {
//     $kurs = $datareq['kurs'];
//     $nominal = $datareq['nominal'];

//     $ch = curl_init();
//     // curl_setopt($ch, CURLOPT_URL, "https://v6.exchangerate-api.com/v6/00e06c2f96ff9de56caf5760/latest/" . $kurs);
//     curl_setopt($ch, CURLOPT_URL, "https://api.exchangerate.host/latest?symbols=".$kurs."&base=IDR");

//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     $output = curl_exec($ch);
//     curl_close($ch);
//     if (false !== $output) {
//         try {
//             $response_curl = json_decode($output);
//             $curl_base_price = $nominal;
//             // dalam IDR
//             $data = round(($curl_base_price * $response_curl->rates->IDR), 2);
//             return json_encode(array("status" => 1, "data" => $data), true);
//         } catch (Exception $e) {
//             return json_encode(array("status" => 0, "data" => "failed request kurs"));
//         }
//     }
// }
function get_fee_tl($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $hotel_id = $datareq['hotel_id'];
    $flight_price = $datareq['flight_price'];
    $data = [];

    $query_m = "SELECT * FROM LT_itinerary2  where id=" . $master_id;
    $rs_m = mysqli_query($con, $query_m);
    $row_m = mysqli_fetch_array($rs_m);


    $query_sub = "SELECT * FROM LTSUB_itin where master_id ='" . $master_id . "' && id='" . $copy_id . "'";
    $rs_sub = mysqli_query($con, $query_sub);
    $row_sub = mysqli_fetch_array($rs_sub);

    $query_cbng = "SELECT * FROM cabang where id ='" . $row_sub['cabang'] . "'";
    $rs_cbng = mysqli_query($con, $query_cbng);
    $row_cbng = mysqli_fetch_array($rs_cbng);

    $query_master = "SELECT * FROM LT_select_PilihHTL  where master_id ='$master_id' && copy_id='$copy_id' limit 1";
    $rs_master = mysqli_query($con, $query_master);
    $row_master = mysqli_fetch_array($rs_master);



    $query_itin = "SELECT * FROM LT_itinnew WHERE id='" .  $hotel_id . "'";
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_array($rs_itin);

    if ($row_itin['id'] != "") {
        $v_fee = 0;
        $v_sfee = 0;
        $v_vt = 0;
        $v_meal = 0;
        // array_push($data,  $datareq['master_id']);

        if ($row_itin['benua'] == "ASIA") {
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
                        $tl_fee_harga =  $result_show_kurs['data'];
                        $v_fee =  $result_show_kurs['data'] * $row_m['hari'];
                    } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $tl_sfee_harga = $result_show_kurs['data'];
                        $v_sfee =  $result_show_kurs['data'] * $row_m['hari'];
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
                        $v_meal = $row_m['hari'] * $price_meal;
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
                        $v_fee =  $result_show_kurs['data'] * $row_m['hari'];
                    } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                        // konversi kurs
                        $datareq = array(
                            "kurs" =>  $row_tl_fee['kurs'],
                            "nominal" => $row_tl_fee['price'],
                        );
                        $show_kurs = get_kurs($datareq);
                        $result_show_kurs = json_decode($show_kurs, true);
                        $tl_sfee_harga = $result_show_kurs['data'];
                        $v_sfee =  $result_show_kurs['data'] * $row_m['hari'];
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
                        $v_meal = $row_m['hari'] * $price_meal;
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
                    $v_fee =  $result_show_kurs['data'] * $row_m['hari'];
                } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                    // konversi kurs
                    $datareq = array(
                        "kurs" =>  $row_tl_fee['kurs'],
                        "nominal" => $row_tl_fee['price'],
                    );
                    $show_kurs = get_kurs($datareq);
                    $result_show_kurs = json_decode($show_kurs, true);
                    $tl_sfee_harga = $result_show_kurs['data'];
                    $v_sfee =  $result_show_kurs['data'] * $row_m['hari'];
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
                    $v_meal = $row_m['hari'] * $price_meal;
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
    // end feetl
    $query_master_meal = "SELECT * FROM LT_add_meal  where tour_id=" . $master_id;
    $rs_master_meal = mysqli_query($con, $query_master_meal);
    $total_mealcus = 0;
    $tmeal_cus = 0;
    while ($row_master_meal = mysqli_fetch_array($rs_master_meal)) {
        if ($row_master_meal['bf'] != '0') {
            $hbf = 0;
            $query_bf = "SELECT * FROM Guest_meal  where id=" . $row_master_meal['bf'];
            $rs_bf = mysqli_query($con, $query_bf);
            $row_bf = mysqli_fetch_array($rs_bf);
            $hbf =  $row_bf['harga_idr'];
            $total_mealcus = $total_mealcus + $hbf;
            $detail_meal .= " + " . $row_bf['harga_idr'];
            $tmeal_cus++;
            // var_dump( $total_mealcus);
        }
        if ($row_master_meal['ln'] != '0') {
            $hln = 0;
            $query_ln = "SELECT * FROM Guest_meal  where id=" . $row_master_meal['ln'];
            $rs_ln = mysqli_query($con, $query_ln);
            $row_ln = mysqli_fetch_array($rs_ln);
            $hln = $row_ln['harga_idr'];
            $detail_meal .= " + " . $row_ln['harga_idr'];
            $total_mealcus = $total_mealcus + $hln;
            $tmeal_cus++;
        }
        if ($row_master_meal['dn'] != '0') {
            $hdn = 0;
            $query_dn = "SELECT * FROM Guest_meal  where id=" . $row_master_meal['dn'];
            $rs_dn = mysqli_query($con, $query_dn);
            $row_dn = mysqli_fetch_array($rs_dn);
            $hdn = $row_dn['harga_idr'];
            $detail_meal .= " + " . $row_dn['harga_idr'];
            $total_mealcus = $total_mealcus + $hdn;
            $tmeal_cus++;
        }
        // $total_mealcus = $total_mealcus + $hbf + $hln + $hdn;
    }
    // end meal

    $feeTL = $v_vt + $v_meal + $v_fee + $v_sfee;


    $query = "SELECT * FROM  LT_itinnew where id='" . $row_master['hotel_id'] . "'";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($rs);

    // flight
    $query_pre = "SELECT * FROM flight_optional where id='" . $flight_price . "'";
    $rs_pre = mysqli_query($con, $query_pre);
    $row_pre = mysqli_fetch_array($rs_pre);

    $query_fl = "SELECT maskapai,adt,chd,inf FROM  flight_LTnew where tour_code='" . $row_pre['tour_code'] . "' && rute='" . $row_pre['rute'] . "'";
    $rs_fl = mysqli_query($con, $query_fl);
    $adt_fl = 0;
    while ($row_fl = mysqli_fetch_array($rs_fl)) {
        $adt_fl = $adt_fl + $row_fl['adt'];
    }
    array_push($data, $query_pre);

    $data_fr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "18"
    );
    $show_fr = get_total($data_fr);
    $result_fr = json_decode($show_fr, true);


    $data_tr = array(
        "master_id" => $master_id,
        "copy_id" => $copy_id,
        "check_id" => "19"
    );
    $show_tr = get_total($data_tr);
    $result_tr = json_decode($show_tr, true);

    $ferry = $result_fr['adt'];
    $flight = $adt_fl;
    $train = $result_tr['adt'];

    // // ($total_meal2 * $price_meal) * -1;

    $lt_price = intval($row['agent_twn']);
    $lt_price_sub = intval($row['agent_sglsub']);
    $pax_covery = -1 * intval($row['pax_b']);

    $lt_cover = $pax_covery * $lt_price;
    $transport =  $ferry + $flight + $train;
    $costTL = $lt_price + $lt_price_sub + $transport + $tips_flBagasi + $tips_flMeal + $tips_flTax;

    $feeTL_cover = $total_mealcus * -1;
    $costTL_cover =  $lt_cover;

    // $total_final_f = $feeTL + $feeTL_cover;
    // $total_final_c = $costTL + $costTL_cover;
    // array_push($data,$lt_cover,$lt_cover_sub);
    array_push($data, "Fee TL : " . number_format($feeTL, 0, ",", "."));
    array_push($data, "Cost TL : " . number_format($costTL, 0, ",", "."));
    array_push($data, "Fee TL Cover : " . number_format($feeTL_cover, 0, ",", "."));
    array_push($data, "Cost TL Cover : " . number_format($costTL_cover, 0, ",", "."));

    $ttpax = $feeTL + $costTL + $feeTL_cover + $costTL_cover;
    $vttpax = $ttpax  / intval($row['pax']);

    return json_encode(array("adt" => $vttpax, "chd" => $vttpax, "inf" => $vttpax, "sgl" => $vttpax, "detail" => $data), true);
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

function get_kurs_landtrans($d)
{
    include "../db=connection.php";
    $kurs = $d['kurs'];
    $oneway = $d['oneway'];
    $twoway = $d['twoway'];
    $hd1 = $d['hd1'];
    $hd2 = $d['hd2'];
    $fd1 = $d['fd1'];
    $fd2 = $d['fd2'];
    $kaisoda = $d['kaisoda'];
    $luarkota = $d['luarkota'];


    $query = "SELECT * FROM  kurs_bca_field where nama = '" . $kurs . "' order by id ASC ";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    if ($row['id'] == "") {
        return json_encode(array("status" => "data Kurs tidak Tersedia", "data" => '0'), true);
    } else {
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "oneway" => $oneway,"twoway" => $twoway,"hd1" => $hd1,"hd2" => $hd2,"fd1" => $fd1,"fd2" => $fd2,"kaisoda" => $kaisoda,"luarkota" => $luarkota), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                // $price = $nominal * $row['jual'];
                $oneway_idr = $d['oneway'] * $row['jual'];
                $twoway_idr = $d['twoway'] * $row['jual'];
                $hd1_idr = $d['hd1'] * $row['jual'];
                $hd2_idr = $d['hd2'] * $row['jual'];
                $fd1_idr = $d['fd1'] * $row['jual'];
                $fd2_idr = $d['fd2'] * $row['jual'];
                $kaisoda_idr = $d['kaisoda'] * $row['jual'];
                $luarkota_idr = $d['luarkota'] * $row['jual'];
                return json_encode(array("status" => $result_data['status'],"oneway" => $oneway_idr,"twoway" => $twoway_idr,"hd1" => $hd1_idr,"hd2" => $hd2_idr,"fd1" => $fd1_idr,"fd2" => $fd2_idr,"kaisoda" => $kaisoda_idr,"luarkota" => $luarkota_idr), true);
            }
        }
    }
}

function flight_tl($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];

    $x = $datareq['flight'];
    $date = $datareq['date'];
    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $x . "' order by id ASC";
    $rs_gf = mysqli_query($con, $query_gf);

    $query_sfee_tt = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $x . "' && date_set='" . $date . "'";
    $rs_sfee_tt = mysqli_query($con, $query_sfee_tt);
    $row_sfee_tt = mysqli_fetch_array($rs_sfee_tt);
    $adt_sfe = 0;
    $chd_sfe = 0;
    $inf_sfe = 0;
    if ($row_sfee_tt['id'] != "") {
        $adt_sfe = $row_sfee_tt['adt'];
        $chd_sfe = $row_sfee_tt['chd'];
        $inf_sfe = $row_sfee_tt['inf'];
    }

    $no = 1;
    $adt = 0;
    $chd = 0;
    $inf = 0;
    $bg = 0;
    $x_gf = 1;

    while ($row_gf = mysqli_fetch_array($rs_gf)) {
        $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
        $rs_detail = mysqli_query($con, $query_detail);
        $row_detail = mysqli_fetch_array($rs_detail);

        $query_typ2 = "SELECT * FROM LTP_type_flight where id='" . $row_detail['type'] . "'";
        $rs_typ2 = mysqli_query($con, $query_typ2);
        $row_typ2 = mysqli_fetch_array($rs_typ2);

        $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail['route_id'] . "'";
        $rs_rt = mysqli_query($con, $query_rt);
        $row_rt = mysqli_fetch_array($rs_rt);

        if ($row_gf['status'] == '1') {
            if ($x_gf == '1') {
                // $type = "Roundtrip Auto";
                $adt_rt = $row_rt['adt'];
                $chd_rt = $row_rt['chd'];
                $inf_rt = $row_rt['inf'];
            } else {
                // $type = "Roundtrip Auto";
                $adt_rt = 0;
                $chd_rt = 0;
                $inf_rt = 0;
            }
        } else {
            // $type = $row_typ2['nama'];
            $adt_rt = $row_detail['adt'];
            $chd_rt = $row_detail['chd'];
            $inf_rt = $row_detail['inf'];
        }
        $adt = $adt + $adt_rt;
        $chd = $chd + $chd_rt;
        $inf = $inf + $inf_rt;
        $bg = $bg + $row_detail['bg'];
        $x_gf++;
    }
    $adt = $adt + $adt_sfe;
    $chd = $chd + $chd_sfe;
    $inf = $inf + $inf_sfe;

    return json_encode(array("adt" => $adt, "chd" =>  $chd, "inf" =>  $inf, "sgl" => $adt, "detail" => ""), true);
}



function get_optional_fl($datareq)
{
    include "../db=connection.php";

    $tour_code = $datareq['tour_code'];
    $rute = $datareq['rute'];


    $fl_date = "";
    $query_fl_berangkat2 = "SELECT * FROM flight_keberangkatan where kode='" . $tour_code . "' && rute='" . $rute . "' order by rute ASC, flight_date ASC";
    $rs_fl_berangkat2 = mysqli_query($con, $query_fl_berangkat2);
    while ($row_flb2 = mysqli_fetch_array($rs_fl_berangkat2)) {
        $fl_date .= date("d M ", strtotime($row_flb2['flight_date'])) . ",";
    }

    $adt = 0;
    $chd = 0;
    $inf = 0;
    $query_fl = "SELECT maskapai,adt,chd,inf FROM  flight_LTnew where tour_code='" .  $tour_code . "' && rute='" . $rute . "'";
    $rs_fl = mysqli_query($con, $query_fl);
    $io = 0;
    while ($row_fl = mysqli_fetch_array($rs_fl)) {
        $adt = $adt + $row_fl['adt'];
        if ($io == 0) {
            $arr_fl = explode(" ", $row_fl['maskapai']);
            $code =  $arr_fl[0];
        }
        $io++;
    }
    $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $code . "'";
    $rsflight_logo = mysqli_query($con, $queryflight_logo);
    $rowflight_logo = mysqli_fetch_array($rsflight_logo);

    return json_encode(array("status" => 1, "nama" =>  $rowflight_logo['nama'], 'tgl' => $fl_date, 'price' => $adt, 'chd' => $chd, 'inf' => $inf), true);
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

function get_flight_price($data)
{
    $x = $data['flight'];
    $date = $data['date'];
    include "../db=connection.php";
    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $x . "' order by id ASC";
    $rs_gf = mysqli_query($con, $query_gf);
    // var_dump( $query_gf);

    $query_sfee_tt = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $x . "' && date_set='" . $date . "'";
    $rs_sfee_tt = mysqli_query($con, $query_sfee_tt);
    $row_sfee_tt = mysqli_fetch_array($rs_sfee_tt);
    $adt_sfe = 0;
    $chd_sfe = 0;
    $inf_sfe = 0;
    if ($row_sfee_tt['id'] != "") {
        $adt_sfe = $row_sfee_tt['adt'];
        $chd_sfe = $row_sfee_tt['chd'];
        $inf_sfe = $row_sfee_tt['inf'];
    }
// var_dump($adt_sfe);
    $no = 1;
    $adt = 0;
    $chd = 0;
    $inf = 0;
    $bg = 0;
    $x_gf = 1;

    while ($row_gf = mysqli_fetch_array($rs_gf)) {
        $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
        $rs_detail = mysqli_query($con, $query_detail);
        $row_detail = mysqli_fetch_array($rs_detail);

        $query_typ2 = "SELECT * FROM LTP_type_flight where id='" . $row_detail['type'] . "'";
        $rs_typ2 = mysqli_query($con, $query_typ2);
        $row_typ2 = mysqli_fetch_array($rs_typ2);

        $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail['route_id'] . "'";
        $rs_rt = mysqli_query($con, $query_rt);
        $row_rt = mysqli_fetch_array($rs_rt);
        // var_dump($query_rt);

        if ($row_gf['status'] == '1') {
            if ($x_gf == '1') {
                // $type = "Roundtrip Auto";
                $adt_rt = $row_rt['adt'];
                $chd_rt = $row_rt['chd'];
                $inf_rt = $row_rt['inf'];
            } else {
                // $type = "Roundtrip Auto";
                $adt_rt = 0;
                $chd_rt = 0;
                $inf_rt = 0;
            }
        } else {
            // $type = $row_typ2['nama'];
            $adt_rt = $row_detail['adt'];
            $chd_rt = $row_detail['chd'];
            $inf_rt = $row_detail['inf'];
        }
        $adt = $adt + $adt_rt;
        $chd = $chd + $chd_rt;
        $inf = $inf + $inf_rt;
        $bg = $bg + $row_detail['bg'];
        $x_gf++;
    }
    // var_dump($adt);
    $adt = $adt + $adt_sfe;
    $chd = $chd + $chd_sfe;
    $inf = $inf + $inf_sfe;
    // var_dump($adt);

    // set profit flight
    $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $adt . "' && price2 >='" . $adt . "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);

    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }
    $dm = $adt * ($row_profit['adm_mkp'] / 100);
    $mar = $adt * ($row_profit['marketing'] / 100);
    $agn = $adt * ($row_profit['sub_agent'] / 100);
    $ste = $row_profit['staff_eks'];
    $nom = $row_profit['nominal'];
    $lain2 = $adm + $mar + $agn + $ste + $nom;

    $adt_price = intval($adt) * ($pr / 100);
    $chd_price = intval($adt) * ($pr / 100);
    $inf_price = intval($adt) * ($pr / 100);

    $adt = $adt  +  $adt_price + $nom;
    $chd = $chd + $chd_price + $nom;
    $inf = $inf +  $inf_price + $nom;

    return json_encode(array("adt" => $adt, "chd" =>  $chd, "inf" =>  $inf, "sgl" => $adt, "detail" => ""), true);
}

function get_adm_price($adm_inc)
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

function get_chck_hotel($adm)
{
    include "../db=connection.php";
    $query_itin = "SELECT * FROM  LT_itinnew where id=" . $adm['hotel'];
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_assoc($rs_itin);
    array_push($data, $row_itin['judul']);

    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
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

    $atwn =  ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'] + $nom;
    $asgl =  ($row_itin['agent_sgl'] * $pr / 100) + $row_itin['agent_sgl'] + $nom;
    $acnb =  ($row_itin['agent_cnb'] * $pr / 100) + $row_itin['agent_cnb'] + $nom;
    $ainfant =  ($row_itin['agent_infant'] * $pr / 100) + $row_itin['agent_infant'] + $nom;

    return json_encode(array("adt" =>  $atwn, "chd" =>  $acnb, "inf" => $ainfant, "sgl" => $asgl, "detail" => $data), true);
}

function get_bandara($x)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/" . $x . "?isDestination=true&enable_general_search_v2=true");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    if (false !== $output) {
        // $response_curl = json_decode($output);
        // $loop = count($response_curl);
        // $arr = [];
        // for($i=0;$i  < $loop; $i++){

        //   }
        return $output;
    }
}
