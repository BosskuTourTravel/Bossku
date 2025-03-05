<?php
/// live :  https://sg-api.globaltix.com/api
/// dummy : https://uat-api.globaltix.com/api

function get_total($datareq)
{
    include "../db=connection.php";

    $tour_id = $datareq['tour_id'];
    $lt_id = $datareq['lt_id'];
    $cabang = $datareq['cabang'];

    $query_data = "SELECT * FROM  Prev_makeLT where id=" . $tour_id;
    $rs_data = mysqli_query($con, $query_data);
    $row_data = mysqli_fetch_array($rs_data);

    $query_tt = "SELECT * FROM  LT_Perhitungan where id=" . $lt_id;
    $rs_tt = mysqli_query($con, $query_tt);
    $row_tt = mysqli_fetch_array($rs_tt);

    $val_data = json_decode($row_data['data'], true);
    $json_day = $val_data['day'];
    $pz = 0;
    $grand_total_twn = 0;
    $grand_total_cnb = 0;
    $grand_total_inf = 0;
    $grand_total_sgl = 0;
    $pil = json_decode($row_tt['pilihan'], true);

    foreach ($pil as $value) {
        if ($value == 1) {
            $query_plane = "SELECT * FROM LT_add_flight where tour_id='" . $tour_id . "' && ket=" . $cabang;
            $rs_plane = mysqli_query($con, $query_plane);
            $adt = 0;
            $chd = 0;
            $inf = 0;
            while ($row_plane = mysqli_fetch_array($rs_plane)) {
                $value_add = json_decode($row_plane['value'], TRUE);
                foreach ($value_add as $loop_add) {
                    if ($loop_add['jml_transport'] != "") {
                        foreach ($loop_add['sel_trans'] as $sel_tr) {
                            if ($sel_tr['transport_type'] == "flight") {
                                $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                                $rs_flight2 = mysqli_query($con, $query_flight2);
                                $row_flight2 = mysqli_fetch_array($rs_flight2);

                                $sql_profit = "SELECT * FROM PR_flight where flight_id ='" . $row_flight2['id'] . "'";
                                $rs_profit = mysqli_query($con, $sql_profit);
                                $row_profit = mysqli_fetch_array($rs_profit);
                                $pr = 0;
                                if ($row_profit['id'] != "") {
                                    $pr = $row_profit['profit'];
                                   
                                }
                                $adt_price = intval($row_flight2['adt']) *($pr/100);
                                $chd_price = intval($row_flight2['chd']) *($pr/100);
                                $inf_price = intval($row_flight2['inf']) *($pr/100);

                                
                                $adt = $adt + intval($row_flight2['adt']) + $adt_price;
                                $chd = $chd + intval($row_flight2['chd']) + $chd_price;
                                $inf = $inf + intval($row_flight2['inf']) + $inf_price;
                            }
                        }
                    }
                }
            }
            $grand_total_twn = $grand_total_twn + $adt;
            $grand_total_cnb = $grand_total_cnb + $chd;
            $grand_total_inf = $grand_total_inf + $inf;
            $grand_total_sgl = $grand_total_sgl + $adt;
        } else if ($value == 5) {
            $data = [];
            $th = 0;
            foreach ($json_day as $loop_day) {
                $hotel_twin = $loop_day['gst_hotel_twin'];
                $th = $th + intval($hotel_twin);
            }
            $grand_total_twn = $grand_total_twn + $th;
            $grand_total_cnb = $grand_total_cnb + $th;
            $grand_total_inf = $grand_total_inf + $th;
            $grand_total_sgl = $grand_total_sgl + $th;
        } else if ($value == 6) {
            $data = [];
            $meal = 0;
            foreach ($json_day as $loop_day) {
                $query_meal = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_breakfast'];
                $rs_meal = mysqli_query($con, $query_meal);
                $row_meal = mysqli_fetch_assoc($rs_meal);

                $query_ln = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_lunch'];
                $rs_ln = mysqli_query($con, $query_ln);
                $row_ln = mysqli_fetch_assoc($rs_ln);

                $query_dn = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_dinner'];
                $rs_dn = mysqli_query($con, $query_dn);
                $row_dn = mysqli_fetch_assoc($rs_dn);


                $bf = intval($row_meal['harga_idr']);
                $ln = intval($row_ln['harga_idr']);
                $dn = intval($row_dn['harga_idr']);
                $meal = $meal + $bf + $ln +$dn ;
            }
            $grand_total_twn = $grand_total_twn + $meal;
            $grand_total_cnb = $grand_total_cnb + $meal;
            $grand_total_inf = $grand_total_inf + $meal;
            $grand_total_sgl = $grand_total_sgl + $meal;

        } else if ($value == 8) {
            $query_visa = "SELECT * FROM  LT_add_visa where tour_id='" . $tour_id . "' order by tgl ASC";
            $rs_visa = mysqli_query($con, $query_visa);
            $row_visa = mysqli_fetch_array($rs_visa);
            $grand_total_twn = $grand_total_twn + intval($row_visa['price']);
            $grand_total_cnb = $grand_total_cnb + intval($row_visa['price']);
            $grand_total_inf = $grand_total_inf + intval($row_visa['price']);
            $grand_total_sgl = $grand_total_sgl + intval($row_visa['price']);
        } else if ($value == 15) {
            $query = "SELECT * FROM  LT_itinnew where id=" . $row_tt['lt_id'];
            $rs = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($rs);
            $grand_total_twn = $grand_total_twn + intval($row['twn']);
            $grand_total_cnb = $grand_total_cnb + intval($row['cnb']);
            $grand_total_inf = $grand_total_inf + intval($row['inf']);
            $grand_total_sgl = $grand_total_sgl + intval($row['sgl']);

        } else if ($value == 17) {
            foreach ($json_day as $loop_day) {
                foreach ($loop_day['sel_trans'] as $val_pilihan) {
                    $query_tmp = "SELECT * FROM  List_tempat where id='" . $val_pilihan['tujuan'] . "'";
                    $rs_tmp = mysqli_query($con, $query_tmp);
                    $row_tmp = mysqli_fetch_array($rs_tmp);
                    $kurs =  $row_tmp['kurs'];

                    $grand_total_twn = $grand_total_twn + intval($row_tmp['price']);
                    $grand_total_cnb = $grand_total_cnb + intval($row_tmp['chd']);
                    $grand_total_inf = $grand_total_inf + intval($row_tmp['infant']);
                    $grand_total_sgl = $grand_total_sgl + intval($row_tmp['price']);

                }
            }

        } else if ($value == 18) {
            $query_plane = "SELECT * FROM LT_add_flight where tour_id='" . $tour_id . "' && ket=" . $cabang;
            $rs_plane = mysqli_query($con, $query_plane);
            $adt = 0;
            $chd = 0;
            $inf = 0;
            while ($row_plane = mysqli_fetch_array($rs_plane)) {
                $value_add = json_decode($row_plane['value'], TRUE);
                foreach ($value_add as $loop_add) {
                    if ($loop_add['jml_transport'] != "") {
                        foreach ($loop_add['sel_trans'] as $sel_tr) {
                            if ($sel_tr['transport_type'] == "ferry") {
                                $query_ferry = "SELECT * FROM ferry_LT  where id=" . $sel_tr['transport_name'];
                                $rs_ferry = mysqli_query($con, $query_ferry);
                                $row_ferry = mysqli_fetch_array($rs_ferry);

                                $adt = $adt + intval($row_ferry['adult']);
                                $chd = $chd + intval($row_ferry['child']);
                                $inf = $inf + intval($row_ferry['infant']);
                            }
                        }
                    }
                }
            }
            $grand_total_twn = $grand_total_twn + $adt;
            $grand_total_cnb = $grand_total_cnb + $chd;
            $grand_total_inf = $grand_total_inf + $inf;
            $grand_total_sgl = $grand_total_sgl + $adt;
        } else if ($value == 19) {
            $query_plane = "SELECT * FROM LT_add_flight where tour_id='" . $tour_id . "' && ket=" . $cabang;
            $rs_plane = mysqli_query($con, $query_plane);
            $adt = 0;
            $chd = 0;
            $inf = 0;
            while ($row_plane = mysqli_fetch_array($rs_plane)) {
                $value_add = json_decode($row_plane['value'], TRUE);
                foreach ($value_add as $loop_add) {
                    if ($loop_add['jml_transport'] != "") {
                        foreach ($loop_add['sel_trans'] as $sel_tr) {
                            if ($sel_tr['transport_type'] == "train") {
                                // var_dump($query_ferry);
                                array_push($arr_train, array("nama" => $sel_tr['transport_name'], "adult" => $sel_tr['adult'], "chd" => $sel_tr['child'], "inf" => $sel_tr['infant']));
                                $adt = $adt + intval($sel_tr['adult']);
                                $chd = $chd + intval($sel_tr['child']);
                                $inf = $inf + intval($sel_tr['infant']);
                            }
                        }
                    }
                }
            }
            $grand_total_twn = $grand_total_twn + $adt;
            $grand_total_cnb = $grand_total_cnb + $chd;
            $grand_total_inf = $grand_total_inf + $inf;
            $grand_total_sgl = $grand_total_sgl + $adt;
        } else if ($value == 23) {
            $query_plane = "SELECT * FROM LT_add_flight where tour_id='" . $tour_id . "' && ket=" . $cabang;
            $rs_plane = mysqli_query($con, $query_plane);
            $adt = 0;
            $chd = 0;
            $inf = 0;
            while ($row_plane = mysqli_fetch_array($rs_plane)) {
                $value_add = json_decode($row_plane['value'], TRUE);
                foreach ($value_add as $loop_add) {
                    if ($loop_add['jml_transport'] != "") {
                        foreach ($loop_add['sel_trans'] as $sel_tr) {
                            if ($sel_tr['transport_type'] == "flight") {
                                $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                                $rs_flight2 = mysqli_query($con, $query_flight2);
                                $row_flight2 = mysqli_fetch_array($rs_flight2);
                                $price = $price + intval($row_flight2['bagasi_price']);

                                $adt = $adt + intval($price);
                                $chd = $chd + intval($price);
                                $inf = $inf + intval($price);
                            }
                        }
                    }
                }
            }
            $grand_total_twn = $grand_total_twn + $adt;
            $grand_total_cnb = $grand_total_cnb + $chd;
            $grand_total_inf = $grand_total_inf + $inf;
            $grand_total_sgl = $grand_total_sgl + $adt;
        } else if ($value == 24) {
            $query_plane = "SELECT * FROM LT_add_flight where tour_id='" . $tour_id . "' && ket=" . $cabang;
            $rs_plane = mysqli_query($con, $query_plane);
            $bf = 0;
            $ln = 0;
            $dn = 0;
            while ($row_plane = mysqli_fetch_array($rs_plane)) {
                $value_add = json_decode($row_plane['value'], TRUE);
                foreach ($value_add as $loop_add) {
                    if ($loop_add['jml_transport'] != "") {
                        foreach ($loop_add['sel_trans'] as $sel_tr) {
                            if ($sel_tr['transport_type'] == "flight") {
                                $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                                $rs_flight2 = mysqli_query($con, $query_flight2);
                                $row_flight2 = mysqli_fetch_array($rs_flight2);

                                $bf = $bf + intval($row_flight2['bf']);
                                $ln = $ln + intval($row_flight2['ln']);
                                $dn = $dn + intval($row_flight2['dn']);
                            }
                        }
                    }
                }
            }
            $grand_total_twn = $grand_total_twn + $bf + $ln + $dn;
            $grand_total_cnb = $grand_total_cnb + $bf + $ln + $dn;
            $grand_total_inf = $grand_total_inf + $bf + $ln + $dn;
            $grand_total_sgl = $grand_total_sgl + $bf + $ln + $dn;
        } else if ($value == 26) {
            $query_guide = "SELECT * FROM  LT_add_Tips where tour_id='" . $tour_id . "' order by hari ASC";
            $rs_guide = mysqli_query($con, $query_guide);
            $price = 0;
            while ($row_guide = mysqli_fetch_array($rs_guide)) {
                $query_guide2 = "SELECT * FROM  Tips_Landtour where id=" . $row_guide['guide'];
                $rs_guide2 = mysqli_query($con, $query_guide2);
                $row_guide2 = mysqli_fetch_array($rs_guide2);
                $price = $price + intval($row_guide2['guide']);
            }

            $grand_total_twn = $grand_total_twn + $price;
            $grand_total_cnb = $grand_total_cnb + $price;
            $grand_total_inf = $grand_total_inf + $price;
            $grand_total_sgl = $grand_total_sgl + $price;
        } else if ($value == 27) {
            $query_tl = "SELECT * FROM  LT_add_Tips where tour_id='" . $tour_id . "' order by hari ASC";
            $rs_tl = mysqli_query($con, $query_tl);
            $price = 0;
            while ($row_tl = mysqli_fetch_array($rs_tl)) {
                $query_tl2 = "SELECT * FROM  Tips_Landtour where id=" . $row_tl['tl'];
                $rs_tl2 = mysqli_query($con, $query_tl2);
                $row_tl2 = mysqli_fetch_array($rs_tl2);
                $price = $price + intval($row_tl2['tl']);
            }
            $grand_total_twn = $grand_total_twn + $price;
            $grand_total_cnb = $grand_total_cnb + $price;
            $grand_total_inf = $grand_total_inf + $price;
            $grand_total_sgl = $grand_total_sgl + $price;
        } else if ($value == 32) {
            $d = 1;
            $day = [];
            $x = 1;
            $fee   = 0;
            $sfee  = 0;
            $vocer = 0;
            $meal = 0;
            $total_meal = 0;
            $total_meal2 = 0;
            $total_fee = 0;
            $total_sfee = 0;
            $total_plane = 0;
            $total_ferr = 0;
            $total_train = 0;
            $pr_vt = '';
            $arr_meal = [];
            $arr_sfee = [];
            $arr_fee = [];
            $arr_plane = [];
            $arr_fl_tax = [];
            $arr_fl_meal = [];
            $arr_fl_bagasi = [];
            $arr_ferry = [];
            $arr_train = [];


            foreach ($json_day as $loop_day) {
                $query_tl_fee = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_fee'] . "'";
                $rs_tl_fee = mysqli_query($con, $query_tl_fee);
                $row_tl_fee = mysqli_fetch_array($rs_tl_fee);
                if ($row_tl_fee['id'] != "") {
                    $total_meal2++;
                }

                $query_meal = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_breakfast'];
                $rs_meal = mysqli_query($con, $query_meal);
                $row_meal = mysqli_fetch_assoc($rs_meal);
                if ($row_meal['id'] != "") {
                    $total_meal2++;
                }

                $query_ln = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_lunch'];
                $rs_ln = mysqli_query($con, $query_ln);
                $row_ln = mysqli_fetch_assoc($rs_ln);
                if ($row_ln['id'] != "") {
                    $total_meal2++;
                }
                $query_dn = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_dinner'];
                $rs_dn = mysqli_query($con, $query_dn);
                $row_dn = mysqli_fetch_assoc($rs_dn);

                array_push($arr_fee, $row_tl_fee['price']);
                if ($loop_day['tl_fee'] != null) {
                    $total_fee++;
                }
                if ($loop_day['tl_sfee'] != null) {
                    $total_sfee++;
                }
                if ($loop_day['tl_meal'] != null) {
                    $total_meal++;
                }


                $query_tl_sfee = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_sfee'] . "'";
                $rs_tl_sfee = mysqli_query($con, $query_tl_sfee);
                $row_tl_sfee = mysqli_fetch_array($rs_tl_sfee);

                array_push($arr_sfee, $row_tl_sfee['price']);

                if ($loop_day['tl_vt'] != null) {
                    $query_tl_vt = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_vt'] . "'";
                    $rs_tl_vt = mysqli_query($con, $query_tl_vt);
                    $row_tl_vt = mysqli_fetch_array($rs_tl_vt);
                    $pr_vt = $row_tl_vt['harga'];
                }



                $query_tl_meal = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_meal'] . "'";
                $rs_tl_meal = mysqli_query($con, $query_tl_meal);
                $row_tl_meal = mysqli_fetch_array($rs_tl_meal);
                $price_meal = intval($row_tl_meal['price']);

                $tl_fee_price = $row_tl_fee['price'];
                $tl_fee_detail = $row_tl_fee['type'];

                $fee = $fee + intval($row_tl_fee['price']);
                $sfee = $sfee  + intval($row_tl_sfee['price']);
                $meal = $meal + (intval($row_tl_meal['price']) * 3);
                array_push($arr_meal, $row_tl_meal['price']);

                // flight
                $query_plane = "SELECT * FROM LT_add_flight where tour_id='" . $tour_id . "' && ket=" . $cabang;
                $rs_plane = mysqli_query($con, $query_plane);
                while ($row_plane = mysqli_fetch_array($rs_plane)) {
                    $value_add = json_decode($row_plane['value'], TRUE);
                    foreach ($value_add as $loop_add) {
                        if ($loop_add['hari'] == $x && $loop_add['jml_transport'] != "") {

                            foreach ($loop_add['sel_trans'] as $sel_tr) {
                                if ($sel_tr['transport_type'] == "flight") {
                                    $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                                    $rs_flight2 = mysqli_query($con, $query_flight2);
                                    $row_flight2 = mysqli_fetch_array($rs_flight2);
                                    // var_dump($query_flight2);
                                    $adt = $adt + intval($row_flight2['adt']);
                                    $chd = $chd + intval($row_flight2['chd']);
                                    $inf = $inf + intval($row_flight2['inf']);
                                    $meal_fl = intval($row_flight2['bf']) + intval($row_flight2['ln']) + intval($row_flight2['dn']);

                                    array_push($arr_plane, intval($row_flight2['adt']));
                                    array_push($arr_fl_tax, intval($row_flight2['tax']));
                                    array_push($arr_fl_meal, intval($meal_fl));
                                    array_push($arr_fl_bagasi, intval($row_flight2['bagasi_price']));
                                    $total_plane++;
                                } else if ($sel_tr['transport_type'] == "ferry") {
                                    $query_ferry = "SELECT * FROM ferry_LT  where id=" . $sel_tr['transport_name'];
                                    $rs_ferry = mysqli_query($con, $query_ferry);
                                    $row_ferry = mysqli_fetch_array($rs_ferry);
                                    array_push($arr_ferry, intval($row_ferry['adult']));
                                    $total_ferr++;
                                } else if ($sel_tr['transport_type'] == "train") {
                                    array_push($arr_train, intval($sel_tr['adult']));
                                    $total_train++;
                                } else {
                                }
                            }
                        }
                    }
                }

                $d++;
                $x++;
            }
            $query_visa = "SELECT * FROM  LT_add_visa where tour_id='" . $tour_id . "' order by tgl ASC";
            $rs_visa = mysqli_query($con, $query_visa);
            $row_visa = mysqli_fetch_array($rs_visa);
            $visa_price = $row_visa['price'];
            $visa_ket = $row_visa['ket'];
            // lt 
            $query = "SELECT * FROM  LT_itinnew where id=" .$row_tt['lt_id'];
            $rs = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($rs);
            $lt_price = intval($row['agent_twn']);
            $lt_price_sub = intval($row['agent_sglsub']);
            $pax_covery = -1 * intval($row['pax_b']);

            $vfee_tl = $sfee + $pr_vt + $meal + $fee;
            $vcost_tl = array_sum($arr_plane) + $lt_price + array_sum($arr_ferry) + array_sum($arr_train) + intval($visa_price);
            $meal_cover = ($total_meal2 * $price_meal) * -1;
            $plane_cover =  array_sum($arr_plane) * 0;
            $lt_cover = $pax_covery * $lt_price;
            $lt_cover_sub = $pax_covery * $lt_price_sub;
            $train_cover =  array_sum($arr_train) * 0;
            $ferry_cover =  array_sum($arr_ferry) * 0;
            $vcost_cov = $plane_cover + $lt_cover + $lt_cover_sub + $ferry_cover + $train_cover;

            $total_final_f = $vfee_tl + $meal_cover;
            $total_final_c = $vcost_tl + $vcost_cov;

            $ttpax = ($total_final_f + $total_final_c) / intval($row['pax']);

            $grand_total_twn = $grand_total_twn + ceil($ttpax);
            $grand_total_cnb = $grand_total_cnb + ceil($ttpax);
            $grand_total_inf = $grand_total_inf + ceil($ttpax);
            $grand_total_sgl = $grand_total_sgl + ceil($ttpax);

        } else if ($value == 36) {
            $query_ass = "SELECT * FROM  LT_add_Tips where tour_id='" . $tour_id . "' order by hari ASC";
            $rs_ass = mysqli_query($con, $query_ass);
            $price = 0;
            while ($row_ass = mysqli_fetch_array($rs_ass)) {
                $query_ass2 = "SELECT * FROM  Tips_Landtour where id=" . $row_ass['assistant'];
                $rs_ass2 = mysqli_query($con, $query_ass2);
                $row_ass2 = mysqli_fetch_array($rs_ass2);
                $price = $price + intval($row_ass2['assistant']);
            }
            $grand_total_twn = $grand_total_twn + $price;
            $grand_total_cnb = $grand_total_cnb + $price;
            $grand_total_inf = $grand_total_inf + $price;
            $grand_total_sgl = $grand_total_sgl + $price;
        } else if ($value == 37) {
            $query_driver = "SELECT * FROM  LT_add_Tips where tour_id='" . $tour_id . "' order by hari ASC";
            $rs_driver = mysqli_query($con, $query_driver);
            $price = 0;
            while ($row_driver = mysqli_fetch_array($rs_driver)) {
                $query_driver2 = "SELECT * FROM  Tips_Landtour where id=" . $row_driver['driver'];
                $rs_driver2 = mysqli_query($con, $query_driver2);
                $row_driver2 = mysqli_fetch_array($rs_driver2);
                $price = $price + intval($row_driver2['driver']);
            }
            $grand_total_twn = $grand_total_twn + $price;
            $grand_total_cnb = $grand_total_cnb + $price;
            $grand_total_inf = $grand_total_inf + $price;
            $grand_total_sgl = $grand_total_sgl + $price;
        } else if ($value == 38) {
            $query_porter = "SELECT * FROM  LT_add_Tips where tour_id='" . $tour_id . "' order by hari ASC";
            $rs_porter = mysqli_query($con, $query_porter);
            $price = 0;
            while ($row_porter = mysqli_fetch_array($rs_porter)) {
                $query_porter2 = "SELECT * FROM  Tips_Landtour where id=" . $row_porter['porter'];
                $rs_porter2 = mysqli_query($con, $query_porter2);
                $row_porter2 = mysqli_fetch_array($rs_porter2);
                $price = $price + intval($row_porter2['porter']);
            }
            $grand_total_twn = $grand_total_twn + $price;
            $grand_total_cnb = $grand_total_cnb + $price;
            $grand_total_inf = $grand_total_inf + $price;
            $grand_total_sgl = $grand_total_sgl + $price;
        } elseif ($value == 39) {
            $query_res = "SELECT * FROM  LT_add_Tips where tour_id='" . $tour_id . "' order by hari ASC";
            $rs_res = mysqli_query($con, $query_res);
            $price = 0;
            while ($row_res = mysqli_fetch_array($rs_res)) {
                $query_res2 = "SELECT * FROM  Tips_Landtour where id=" . $row_res['restaurant'];
                $rs_res2 = mysqli_query($con, $query_res2);
                $row_res2 = mysqli_fetch_array($rs_res2);
                $price = $price + intval($row_res2['restaurant']);
            }
            $grand_total_twn = $grand_total_twn + $price;
            $grand_total_cnb = $grand_total_cnb + $price;
            $grand_total_inf = $grand_total_inf + $price;
            $grand_total_sgl = $grand_total_sgl + $price;
        } else {
        }
        // batas
    }

    return json_encode(array("status" => 1, "success" => $total_train, "twn" => $grand_total_twn, "cnb" =>$grand_total_cnb,"inf"=>$grand_total_inf,"sgl"=>$grand_total_sgl), true);
}


function get_kurs($datareq)
{
    $kurs = $datareq['kurs'];
    $nominal = $datareq['nominal'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://v6.exchangerate-api.com/v6/00e06c2f96ff9de56caf5760/latest/" . $kurs);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    if (false !== $output) {
        try {
            $response_curl = json_decode($output);
            $curl_base_price = $nominal;
            // dalam IDR
            $data = round(($curl_base_price * $response_curl->conversion_rates->IDR), 2);
            return json_encode(array("status" => 1, "data" => $data), true);
        } catch (Exception $e) {
            return json_encode(array("status" => 0, "data" => "failed request kurs"));
        }
    }
}
