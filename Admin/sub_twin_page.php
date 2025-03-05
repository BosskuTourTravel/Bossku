<?php
include "../db=connection.php";
include "Api_total.php";
$id = $_POST['id'];
$tour = $_POST['tour'];
$total = $_POST['total'];
$itin = $_POST['itin'];
$lt_hotel = $_POST['lt_hotel'];
$cabang = $_POST['cabang'];
// var_dump("onn");
$query_tour = "SELECT * FROM  Prev_makeLT where id=" . $itin;
$rs_tour = mysqli_query($con, $query_tour);
$row_tour = mysqli_fetch_assoc($rs_tour);
$val_data = json_decode($row_tour['data'], true);
$json_day = $val_data['day'];
$jml_day = $val_data['jml_day'];
// var_dump($json_day);
if ($id == '1') {
    // var_dump("onn 1");
    $data = [];
    $x = 1;
    $adt = 0;
    $chd = 0;
    $inf = 0;
    foreach ($json_day as $loop_day) {
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
        $rs_plane = mysqli_query($con, $query_plane);
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            $value_add = json_decode($row_plane['value'], TRUE);
            // var_dump($value_add);
            foreach ($value_add as $loop_add) {
                if ($loop_add['hari'] == $x && $loop_add['jml_transport'] != "") {
                    // var_dump($loop_add['hari']."==".$x);

                    foreach ($loop_add['sel_trans'] as $sel_tr) {
                        if ($sel_tr['transport_type'] == "flight") {
                            $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                            $rs_flight2 = mysqli_query($con, $query_flight2);
                            $row_flight2 = mysqli_fetch_array($rs_flight2);
                            // var_dump($query_flight2);
                            $adt = $adt + intval($row_flight2['adt']);
                            $chd = $chd + intval($row_flight2['chd']);
                            $inf = $inf + intval($row_flight2['inf']);
                            $detail = $row_flight2['maskapai'] . " " . $row_flight2['dept'] . "-" . $row_flight2['arr'] . " " . $row_flight2['tgl'] . " " . $row_flight2['take'] . "-" . $row_flight2['landing'];
                            array_push($data, $detail);
                        }
                    }
                }
            }
        }
        $x++;
    }

    echo json_encode(array("adt" => $adt, "chd" => $chd, "inf" => $inf, "detail" => $data));
} else if ($id == '5') {
    // hotel
    $data = [];

    foreach ($json_day as $loop_day) {
        $hotel_name = $loop_day['guest_hotel_name'];
        $hotel_twin = $loop_day['gst_hotel_twin'];
        array_push($data, array("nama" => $hotel_name, "price" => $hotel_twin));
    }
    echo json_encode($data);
} else if ($id == '8') {
    // visa
    $query_visa = "SELECT * FROM  LT_add_visa where tour_id='" . $itin . "' order by tgl ASC";
    $rs_visa = mysqli_query($con, $query_visa);
    $row_visa = mysqli_fetch_array($rs_visa);
    echo json_encode($row_visa);
} else if ($id == '6') {
    $data = [];

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
        array_push($data, array("bf" => $bf, "ln" => $ln, "dn" => $dn, "detail_bf" => $row_meal['bld'], "detail_ln" => $row_ln['bld'], "detail_dn" => $row_dn['bld']));
    }
    echo json_encode($data);
} else if ($id == '15') {
    // var_dump($_POST['id']);
    $query = "SELECT * FROM  LT_itinnew where id=" . $lt_hotel;
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($rs);
    echo json_encode($row);
} else if ($id == 17) {
    $d = 1;
    $day = [];
    foreach ($json_day as $loop_day) {
        $trans = [];
        foreach ($loop_day['sel_trans'] as $val_pilihan) {
            $query_tmp = "SELECT * FROM  List_tempat where id='" . $val_pilihan['tujuan'] . "'";
            $rs_tmp = mysqli_query($con, $query_tmp);
            $row_tmp = mysqli_fetch_array($rs_tmp);
            array_push($trans, array("tempat" => $row_tmp['tempat'], "kurs" => $row_tmp['kurs'], "adult" => $row_tmp['price'], "child" => $row_tmp['chd'], "infant" => $row_tmp['infant']));
        }
        array_push($day, array("hari" => $d, "trans_sel" => $trans));
        $d++;
    }
    echo json_encode($day);
} else if ($id == 18) {
    $arr_ferry = [];
    $x = 1;
    foreach ($json_day as $loop_day) {
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
        $rs_plane = mysqli_query($con, $query_plane);
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            $value_add = json_decode($row_plane['value'], TRUE);
            // var_dump($value_add);
            foreach ($value_add as $loop_add) {
                if ($loop_add['hari'] == $x && $loop_add['jml_transport'] != "") {
                    foreach ($loop_add['sel_trans'] as $sel_tr) {
                        if ($sel_tr['transport_type'] == "ferry") {
                            $query_ferry = "SELECT * FROM ferry_LT  where id=" . $sel_tr['transport_name'];
                            $rs_ferry = mysqli_query($con, $query_ferry);
                            $row_ferry = mysqli_fetch_array($rs_ferry);
                            // var_dump($query_ferry);
                            array_push($arr_ferry, array("nama" => $row_ferry['ferry_name'], "adult" => $row_ferry['adult'], "chd" => $row_ferry['child'], "inf" => $row_ferry['infant'], "snr" => $row_ferry['senior']));
                        }
                    }
                }
            }
        }
        $x++;
    }
    echo json_encode($arr_ferry);
} else if ($id == 19) {
    $arr_train = [];
    $x = 1;
    foreach ($json_day as $loop_day) {
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
        $rs_plane = mysqli_query($con, $query_plane);
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            $value_add = json_decode($row_plane['value'], TRUE);
            // var_dump($value_add);
            foreach ($value_add as $loop_add) {
                if ($loop_add['hari'] == $x && $loop_add['jml_transport'] != "") {
                    foreach ($loop_add['sel_trans'] as $sel_tr) {
                        if ($sel_tr['transport_type'] == "train") {
                            // var_dump($query_ferry);
                            array_push($arr_train, array("nama" => $sel_tr['transport_name'], "adult" => $sel_tr['adult'], "chd" => $sel_tr['child'], "inf" => $sel_tr['infant']));
                        }
                    }
                }
            }
        }
        $x++;
    }
    echo json_encode($arr_train);
} else if ($id == 23) {
    /// bagasi
    $price = 0;
    $data = [];
    foreach ($json_day as $loop_day) {
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
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
                            $price = $price + intval($row_flight2['bagasi_price']);

                            $detail = $row_flight2['maskapai'] . " " . $row_flight2['dept'] . "-" . $row_flight2['arr'] . " " . $row_flight2['tgl'] . " " . $row_flight2['take'] . "-" . $row_flight2['landing'] . " (" . $row_flight2['bagasi'] . ")";
                            array_push($data, $detail);
                        }
                    }
                }
            }
        }
        $x++;
    }
    echo json_encode(array("price" => $price, "detail" => $data));
} else if ($id == 24) {
    /// bagasi
    $bf = 0;
    $ln = 0;
    $dn = 0;

    $data = [];
    foreach ($json_day as $loop_day) {
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
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
                            $bf = $bf + intval($row_flight2['bf']);
                            $ln = $ln + intval($row_flight2['ln']);
                            $dn = $dn + intval($row_flight2['dn']);
                            $total = intval($row_flight2['bf']) + intval($row_flight2['ln']) + intval($row_flight2['dn']);

                            $detail = $row_flight2['maskapai'] . " " . $row_flight2['dept'] . "-" . $row_flight2['arr'] . " " . $row_flight2['tgl'] . " " . $row_flight2['take'] . "-" . $row_flight2['landing'] . " (" .  $total . ")";
                            array_push($data, $detail);
                        }
                    }
                }
            }
        }
        $x++;
    }
    echo json_encode(array("bf" => $bf, "ln" => $ln, "dn" => $dn, "detail" => $data));
} else if ($id == 26) {
    /// tips guide
    $arr_guide = [];
    $query_guide = "SELECT * FROM  LT_add_Tips where tour_id='" . $itin . "' order by hari ASC";
    $rs_guide = mysqli_query($con, $query_guide);
    $price = 0;
    while ($row_guide = mysqli_fetch_array($rs_guide)) {
        $query_guide2 = "SELECT * FROM  Tips_Landtour where id=" . $row_guide['guide'];
        $rs_guide2 = mysqli_query($con, $query_guide2);
        $row_guide2 = mysqli_fetch_array($rs_guide2);
        $price = $price + intval($row_guide2['guide']);
    }
       
    $datareq = array(
        "kurs" => $row_guide2['kurs'],
        "nominal" => $price,
    );
    $show_total = get_kurs($datareq);
    $result_show_total = json_decode($show_total, true);
    array_push($arr_guide,array("kurs" => "IDR", "price" => $result_show_total['data']));
    echo json_encode($arr_guide);
} else if ($id == 27) {
    /// tips guide
    $arr_tl = [];
    $query_tl = "SELECT * FROM  LT_add_Tips where tour_id='" . $itin . "' order by hari ASC";
    $rs_tl = mysqli_query($con, $query_tl);
    $price = 0;
    while ($row_tl = mysqli_fetch_array($rs_tl)) {
        $query_tl2 = "SELECT * FROM  Tips_Landtour where id=" . $row_tl['tl'];
        $rs_tl2 = mysqli_query($con, $query_tl2);
        $row_tl2 = mysqli_fetch_array($rs_tl2);
        $price = $price + intval($row_tl2['tl']);
    }
   
    $datareq = array(
        "kurs" => $row_tl2['kurs'],
        "nominal" => $price,
    );
    $show_total = get_kurs($datareq);
    $result_show_total = json_decode($show_total, true);
    array_push($arr_tl, array("kurs" => "IDR", "price" => $result_show_total['data']));
    echo json_encode($arr_tl);
} else if ($id == 36) {
    /// tips guide
    $arr_ass = [];
    $query_ass = "SELECT * FROM  LT_add_Tips where tour_id='" . $itin . "' order by hari ASC";
    $rs_ass = mysqli_query($con, $query_ass);
    $price = 0;
    while ($row_ass = mysqli_fetch_array($rs_ass)) {
        $query_ass2 = "SELECT * FROM  Tips_Landtour where id=" . $row_ass['assistant'];
        $rs_ass2 = mysqli_query($con, $query_ass2);
        $row_ass2 = mysqli_fetch_array($rs_ass2);
        $price = $price + intval($row_ass2['assistant']);
    }
    $datareq = array(
        "kurs" => $row_ass2['kurs'],
        "nominal" => $price,
    );
    $show_total = get_kurs($datareq);
    $result_show_total = json_decode($show_total, true);
    array_push($arr_ass, array("kurs" => "IDR", "price" => $result_show_total['data']));
    echo json_encode($arr_ass);
} else if ($id == 39) {
    /// tips guide
    $arr_driver = [];
    $query_driver = "SELECT * FROM  LT_add_Tips where tour_id='" . $itin . "' order by hari ASC";
    $rs_driver = mysqli_query($con, $query_driver);
    $price = 0;
    while ($row_driver = mysqli_fetch_array($rs_driver)) {
        $query_driver2 = "SELECT * FROM  Tips_Landtour where id=" . $row_driver['driver'];
        $rs_driver2 = mysqli_query($con, $query_driver2);
        $row_driver2 = mysqli_fetch_array($rs_driver2);
        $price = $price + intval($row_driver2['driver']);
    }
    
    $datareq = array(
        "kurs" => $row_driver2['kurs'],
        "nominal" => $price,
    );
    $show_total = get_kurs($datareq);
    $result_show_total = json_decode($show_total, true);
    array_push($arr_driver, array("kurs" => "IDR", "price" => $result_show_total['data']));
    echo json_encode($arr_driver);
} else if ($id == 37) {
    /// tips guide
    $arr_porter = [];
    $query_porter = "SELECT * FROM  LT_add_Tips where tour_id='" . $itin . "' order by hari ASC";
    $rs_porter = mysqli_query($con, $query_porter);
    $price = 0;
    while ($row_porter = mysqli_fetch_array($rs_porter)) {
        $query_porter2 = "SELECT * FROM  Tips_Landtour where id=" . $row_porter['porter'];
        $rs_porter2 = mysqli_query($con, $query_porter2);
        $row_porter2 = mysqli_fetch_array($rs_porter2);
        $price = $price + intval($row_porter2['porter']);
    }
    $datareq = array(
        "kurs" => $row_porter2['kurs'],
        "nominal" => $price,
    );
    $show_total = get_kurs($datareq);
    $result_show_total = json_decode($show_total, true);
    array_push($arr_porter, array("kurs" => "IDR", "price" => $result_show_total['data']));
    echo json_encode($arr_porter);
} else if ($id == 38) {
    /// tips guide
    $arr_res = [];
    $query_res = "SELECT * FROM  LT_add_Tips where tour_id='" . $itin . "' order by hari ASC";
    $rs_res = mysqli_query($con, $query_res);
    $price = 0;
    while ($row_res = mysqli_fetch_array($rs_res)) {
        $query_res2 = "SELECT * FROM  Tips_Landtour where id=" . $row_res['restaurant'];
        $rs_res2 = mysqli_query($con, $query_res2);
        $row_res2 = mysqli_fetch_array($rs_res2);

        $price = $price + intval($row_res2['restaurant']);
    }
    $datareq = array(
        "kurs" => $row_res2['kurs'],
        "nominal" => $price,
    );
    // var_dump($val_pilihan);
    $show_total = get_kurs($datareq);
    $result_show_total = json_decode($show_total, true);

    array_push($arr_res, array("kurs" => "IDR", "price" =>$result_show_total['data']));
    echo json_encode($arr_res);
} else if ($id == 32) {
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
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
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
    $query_visa = "SELECT * FROM  LT_add_visa where tour_id='" . $itin . "' order by tgl ASC";
    $rs_visa = mysqli_query($con, $query_visa);
    $row_visa = mysqli_fetch_array($rs_visa);
    $visa_price = $row_visa['price'];
    $visa_ket = $row_visa['ket'];
    // lt 
    $query = "SELECT * FROM  LT_itinnew where id=" . $lt_hotel;
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($rs);
    $lt_price = intval($row['agent_twn']);
    $lt_price_sub = intval($row['agent_sglsub']);
    $lt_code = $row['kode'];
    $pax = intval($row['pax']) + intval($row['pax_b']);
    $pax_u = "";
    $pax_b = "";
    $pax_covery = -1 * intval($row['pax_b']);
    if ($row['pax_u'] != 0) {
        $pax_u = "-" . $row['pax_u'];
    }
    if ($row['pax_b'] != 0) {
        $pax_b = "+" . $row['pax_b'];
    }
    $detail_pax =  $row['pax'] . $pax_u . $pax_b;

    $v_meal = $price_meal * ($total_meal * 3);
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
    $fedancost = $total_final_f + $total_final_c;
    $ttpax = ($total_final_f + $total_final_c) / intval($row['pax']);

    echo json_encode(array("detail" => "", "price" => ceil($ttpax)));
} else {
    echo "data empty";
}
