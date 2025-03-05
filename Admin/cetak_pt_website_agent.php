<html>

<head>
    <title>Priview Itinerary</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php

include "../db=connection.php";
include "api_cetak_rute.php";
include "Api_LT_total_baru.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";
include "fungsi_forLT.php";

$query_data = "SELECT paket_tour_online.*,LTSUB_itin.landtour,LTSUB_itin.master_id,LTSUB_itin.hari,LTSUB_itin.judul FROM paket_tour_online LEFT JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id where paket_tour_online.id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
// var_dump($query_data);

// $query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $row_data['master_id'] . "'";
// $rs_cek = mysqli_query($con, $query_cek);
// $row_cek = mysqli_fetch_array($rs_cek);

$query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_adm = mysqli_query($con, $query_adm);
$row_adm = mysqli_fetch_array($rs_adm);
$include = [];
$exclude = [];
if (isset($row_adm['id'])) {
    $include = explode(",", $row_adm['include']);
    $exclude = explode(",", $row_adm['exclude']);
}


$query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $row_data['grub_id'] . "' && LTP_insert_sfee.id='" . $row_data['sfee_id'] . "'";
$rs_grub = mysqli_query($con, $query_grub);
$row_grub = mysqli_fetch_array($rs_grub);
// var_dump($query_grub);
$start_date = '';
if (!isset($row_data['tgl_ber'])) {
    $start_date = $row_grub['date_set'];
} else {
    $start_date = $row_data['tgl_ber'];
}

/// get nama maskapai
$query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_data['grub_id'] . "' order by id ASC";
$rs_gf = mysqli_query($con, $query_gf);
$rs_gf_price = mysqli_query($con, $query_gf);
$row_gf = mysqli_fetch_array($rs_gf);;
$px = 0;
$code_fl = [];
while ($row_gf = mysqli_fetch_array($rs_gf)) {
    $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
    $rs_detail = mysqli_query($con, $query_detail);
    $row_detail = mysqli_fetch_array($rs_detail);
    // $flight_name = $row_detail['maskapai'] . " / " . $row_detail['dept'] . " - " . $row_detail['arr'] . " / " . $row_detail['take'] . " - " . $row_detail['landing'];
    // echo "<li>" . $flight_name . "</li>";
    // var_dump($row_detail['maskapai']);

    if ($px == '0') {
        $arr_fl = explode(" ", $row_detail['maskapai']);
        array_push($code_fl, $arr_fl[0]);

        $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $code_fl[0] . "'";
        $rsflight_logo = mysqli_query($con, $queryflight_logo);
        $rowflight_logo = mysqli_fetch_array($rsflight_logo);
    }
    $px++;
}
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
if (isset($row_grub['adt'])) {
    $adt = $adt + $row_grub['adt'];
}
if (isset($row_grub['chd'])) {
    $chd = $chd + $row_grub['chd'];
}
if (isset($row_grub['inf'])) {
    $inf = $inf + $row_grub['inf'];
}



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

$queryPHotelx = "SELECT hotel_id FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['tour_id'] . "' order by id ASC limit 1";
$rsPHotelx = mysqli_query($con, $queryPHotelx);
$rowPHotelx = mysqli_fetch_array($rsPHotelx);


$data_hotel = array(
    "hotel_id" => $row_data['hotel_id'],
    "pax" => $row_data['pax_tour'],
);

$show_hp = get_hotel_one($data_hotel);
$result_hp = json_decode($show_hp, true);
//  var_dump($result_hp); 


///////////// fee tl //////////////////////////////
// $data_feetl = array(
//     "master_id" => $row_data['master_id'],
//     "copy_id" => $row_data['id'],
//     "grub_id" => $row_grub['id'],
//     "hotel_id" =>  $result_hp['id_hotel']
// );
// // var_dump($data_feetl);

// $show_feetl = feeTL($data_feetl);
// $result_feetl = json_decode($show_feetl, true);

if ($row_data['tl_fee'] != 0) {
    $data_feetl = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $row_data['tour_id'],
        "grub_id" => $row_data['grub_id'],
        "hotel_id" =>  $result_hp['id_hotel'],
        "tl_fee" => $row_data['tl_fee'],
        "tl_meal" => $row_data['tl_meal'],
        "tl_tlpn" => $row_data['tl_tlpn'],
        "tl_sfee" => $row_data['tl_sfee'],
    );

    $show_feetl = feeTL_custom($data_feetl);
    $result_feetl  = json_decode($show_feetl, true);
} else {
    $data_feetl = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $row_data['tour_id'],
        "grub_id" => $row_data['grub_id'],
        "hotel_id" =>  $result_hp['id_hotel']
    );
    // var_dump("on");

    // var_dump($data_feetl);


    $show_feetl = feeTL($data_feetl);
    $result_feetl  = json_decode($show_feetl, true);
}

////////////////////////////////////


$gt_chck_adt = 0;
$gt_chck_chd = 0;
$gt_chck_inf = 0;
$gt_chck_sgl = 0;
$val_check = [0];
$fee_on = 0;

//// get value grandtotal tanpa tiket pesawat 
$query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_inc = mysqli_query($con, $query_inc);
$row_inc = mysqli_fetch_array($rs_inc);

if (isset($row_inc['id'])) {
    $query_include = explode(",", $row_inc['chck']);
    // var_dump($query_include);

    foreach ($query_include as $check) {
        if ($check != '1' && $check != '15' && $check != '17' && $check != '32' && $check != '55') {
            $data_tps = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $row_data['tour_id'],
                "grub_id" => $row_data['grub_id'],
                "check_id" => $check
            );
            // var_dump($data_tps);

            $show_tps = get_total($data_tps);
            if ($show_tps) {
                $result_tps = json_decode($show_tps, true);
                $harga_adt =  isset($result_tps['adt']) ? intval($result_tps['adt']) : 0;
                $harga_chd = isset($result_tps['chd']) ? intval($result_tps['chd']) : 0;
                $harga_inf = isset($result_tps['inf']) ? intval($result_tps['inf']) : 0;
                $harga_sgl = isset($result_tps['sgl']) ? intval($result_tps['sgl']) : 0;
    
                $gt_chck_adt = $gt_chck_adt + $harga_adt;
                $gt_chck_chd = $gt_chck_chd + $harga_chd;
                $gt_chck_inf = $gt_chck_inf + $harga_inf;
                $gt_chck_sgl = $gt_chck_sgl + $harga_sgl;
            }

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
                    $query_tmp = "SELECT id,tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp . "'";
                    $rs_tmp = mysqli_query($con, $query_tmp);
                    $row_tmp = mysqli_fetch_array($rs_tmp);

                    if (isset($row_tmp['id'])) {
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
                        if ($row_tmp['infant'] != 0) {
                            $datareq_inf = array(
                                "kurs" =>  $row_tmp['kurs'],
                                "nominal" => $row_tmp['infant'],
                            );
                            $inf_kurs = get_kurs($datareq_inf);
                            $rs_inf_kurs = json_decode($inf_kurs, true);
                            $inf_tmp = $inf_tmp +  $rs_inf_kurs['data'];
                        }
                    }

                    $tmp_name = isset($row_tmp['tempat']) ? $row_tmp['tempat'] : '';

                    array_push($arr_tmp, array("nama" =>  $tmp_name, "price" => $adt_tmp));
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
                    $query_tmp2 = "SELECT id,tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp2 . "'";
                    $rs_tmp2 = mysqli_query($con, $query_tmp2);
                    $row_tmp2 = mysqli_fetch_array($rs_tmp2);

                    if (isset($row_tmp2['id'])) {
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
                                "kurs" =>  $row_tmp2['kurs'],
                                "nominal" => $row_tmp2['chd'],
                            );
                            $chd_kurs = get_kurs($datareq_chd);
                            $rs_chd_kurs = json_decode($chd_kurs, true);
                            $chd_tmpex = $chd_tmpex +  $rs_chd_kurs['data'];
                        }
                        if ($row_tmp2['infant'] != 0) {
                            $datareq_inf = array(
                                "kurs" =>  $row_tmp2['kurs'],
                                "nominal" => $row_tmp2['infant'],
                            );
                            $inf_kurs = get_kurs($datareq_inf);
                            $rs_inf_kurs = json_decode($inf_kurs, true);
                            $inf_tmpex = $inf_tmpex +  $rs_inf_kurs['data'];
                        }
                    }
                    $tmp_name2 = isset($row_tmp2['tempat']) ? $row_tmp2['tempat'] : '';

                    array_push($arr_tmpex, array("nama" => $tmp_name2, "price" => $adt_tmpex));
                }
            }
            // var_dump("adm : ".$adt_tmp);
            // var_dump($check. " : " . $adt_tmp . " </br>");
        } else if ($check == '32') {
            $fee_on = 1;
        } else if ($check == '55') {
            $data_tps = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $row_data['tour_id'],
                "grub_id" => $row_data['grub_id'],
                "sfee_id" => $row_data['sfee_id']
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
}



// var_dump($gt_chck_sgl);
$fee_tl = 0;
if ($fee_on == '1') {
    if ($row_data['pax'] != 0) {
        $fee_tl = intval($result_feetl['custom']) / intval($row_data['tl_pax']);
    } else {
        $fee_tl = intval($result_feetl['adt']);
      
    }
}

// var_dump($result_profit['adt']);
$total_manual_adt =  intval($result_profit['adt']) + intval($result_hp['twn']) + $fee_tl + $gt_chck_adt + intval($row_data['ltwn']);
$total_manual_chd =  intval($result_profit['chd']) + intval($result_hp['cnb']) + $fee_tl + $gt_chck_chd + intval($row_data['ltwn']);
$total_manual_inf =  intval($result_profit['inf']) + intval($result_hp['inf']) + $fee_tl + $gt_chck_inf + intval($row_data['ltwn']);
$total_manual_sgl =  intval($result_profit['adt']) + intval($result_hp['sgl']) + $fee_tl + $gt_chck_sgl + intval($row_data['ltwn']);

// echo $result_profit['adt'] . " - " . $result_hp['twn'] . " - " . $fee_tl . " - " . $gt_chck_adt . " - " . $row_data['ltwn'];


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
    "copy_id" => $row_data['tour_id'],
    "check_id" => '8'
);
$show_visa = get_total($data_visa);
$result_visa = json_decode($show_visa, true);
foreach ($result_visa['detail'] as $detail) {
    $detail_visa .= " " . $detail;
}

$data_porter = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_data['tour_id'],
    "check_id" => '37'
);

$show_porter = get_total($data_porter);
$result_porter = json_decode($show_porter, true);
if ($result_porter['adt'] != 0) {
    $porter_price = "Rp." . number_format($result_porter['adt'], 0, ",", ".");
}


$data_tl = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_data['tour_id'],
    "check_id" => '27'
);

$show_tl = get_total($data_tl);
$result_tl = json_decode($show_tl, true);
if ($result_tl['adt'] != 0) {
    $tl_price = "Rp." . number_format($result_tl['adt'], 0, ",", ".");
}


$data_guide = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_data['tour_id'],
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
                    "copy_id" => $row_data['tour_id'],
                    "check_id" => $row_ex['id']
                );
                $show_price = get_total($data_price);
                if (!empty($show_price)) {
                    $result_price = json_decode($show_price, true);
                    // var_dump($result_price);
                    if (empty($result_price)) {
                        array_push($arr_in, $row_ex['id']);
                    } else {
                        $cek_yellow = array_search($row_ex['id'], $yellow_check);
                        if ($cek_yellow != "") {
                            array_push($arr_in, $row_ex['id']);
                        }
                    }
                }
            } else {
                array_push($arr_in, $row_ex['id']);
            }
        }
    }
}

/////////////////////


$queryTmp_set = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['master_id'] . "'";
$rsTmp_set = mysqli_query($con, $queryTmp_set);

$arr_hl = [];
while ($row_tmp_set = mysqli_fetch_array($rsTmp_set)) {

    $query_ops_set = "SELECT * FROM LT_add_ops where master_id='" .  $row_data['master_id'] . "' && hari='" . $row_tmp_set['hari'] . "' && urutan='" . $row_tmp_set['urutan'] . "'";
    $rs_ops_set = mysqli_query($con, $query_ops_set);
    $row_ops_set = mysqli_fetch_array($rs_ops_set);
    if (isset($row_ops_set['id'])) {
        if ($row_ops_set['highlight'] == '1') {
            $query_tempat_hl = "SELECT * FROM List_tempat where id=" . $row_tmp_set['tempat'];
            $rs_tempat_hl = mysqli_query($con, $query_tempat_hl);
            $row_tempat_hl = mysqli_fetch_array($rs_tempat_hl);
            array_push($arr_hl, $row_tempat_hl['tempat']);
        }
    }
    // var_dump($query_ops_set);


}

$query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $row_data['grub_id'] . "'";
$rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
$row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);

// var_dump($query_cek_addhari);
$json_day = $row_data['hari'] + $row_cek_addhari['plus_hari'];
?>

<body>
    <div id="content" class="container" style="max-width: 2300px;">
        <div style="padding: 20px;">
            <div class="row">
                <?php
                $link2 = "https://drive.google.com/file/d/1ZX73bzx42Ox7qNldS6kY_z6XogQmBesH/view?usp=sharing";
                $headers2 = explode('/', $link2);
                $thumbnail = $headers2[5];
                $thumbnail_gmb1 = $headers2[5];
                $thumbnail_gmb2 = $headers2[5];
                $thumbnail_gmb3 = $headers2[5];
                $thumbnail_gmb4 = $headers2[5];
                $id_val1 = "";
                $val1 = "";
                $id_val2 = "";
                $val2 = "";
                $id_val3 = "";
                $val3 = "";
                $id_val4 = "";
                $val4 = "";

                $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $row_data['master_id'] . "' order by id DESC limit 1";
                $rs_main = mysqli_query($con, $query_main);
                $row_main = mysqli_fetch_array($rs_main);
                // var_dump($query_main);
                // while ($row_main = mysqli_fetch_array($rs_main)) {
                if (isset($row_main['img1'])) {
                    $query_sel_main1 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img1'] . "'";
                    $rs_sel_main1 = mysqli_query($con, $query_sel_main1);
                    $row_sel_main1 = mysqli_fetch_array($rs_sel_main1);
                    $s1 = $row_sel_main1['tmp_type'];

                    // var_dump($query_sel_main1);

                    $link_gmb1 = $row_sel_main1[$s1];
                    $headers_gmb1 = explode('/', $link_gmb1);
                    $thumbnail_gmb1 = $headers_gmb1[5];
                    $val1 = $row_sel_main1['tempat'];
                    $id_val1 = $row_sel_main1['id'];
                }
                if (isset($row_main['img2'])) {
                    $query_sel_main2 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img2'] . "'";
                    $rs_sel_main2 = mysqli_query($con, $query_sel_main2);
                    $row_sel_main2 = mysqli_fetch_array($rs_sel_main2);
                    $s2 = $row_sel_main2['tmp_type'];

                    $link_gmb2 = $row_sel_main2[$s2];
                    $headers_gmb2 = explode('/', $link_gmb2);
                    $thumbnail_gmb2 = $headers_gmb2[5];
                    $val2 = $row_sel_main2['tempat'];
                    $id_val2 = $row_sel_main2['id'];
                }
                if (isset($row_main['img3'])) {
                    $query_sel_main3 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img3'] . "'";
                    $rs_sel_main3 = mysqli_query($con, $query_sel_main3);
                    $row_sel_main3 = mysqli_fetch_array($rs_sel_main3);
                    $s3 = $row_sel_main3['tmp_type'];

                    $link_gmb3 = $row_sel_main3[$s3];
                    $headers_gmb3 = explode('/', $link_gmb3);
                    $thumbnail_gmb3 = $headers_gmb3[5];
                    $val3 = $row_sel_main3['tempat'];
                    $id_val3 = $row_sel_main3['id'];
                }
                if (isset($row_main['img4'])) {
                    $query_sel_main4 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img4'] . "'";
                    $rs_sel_main4 = mysqli_query($con, $query_sel_main4);
                    $row_sel_main4 = mysqli_fetch_array($rs_sel_main4);
                    $s4 = $row_sel_main4['tmp_type'];

                    $link_gmb4 = $row_sel_main4[$s4];
                    $headers_gmb4 = explode('/', $link_gmb4);
                    $thumbnail_gmb4 = $headers_gmb4[5];
                    $val4 = $row_sel_main4['tempat'];
                    $id_val4 = $row_sel_main4['id'];
                }
                ?>
                <div class="col">

                    <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb1 ?>" width="100%" height="100%" style="max-height: 160px;">

                </div>
                <div class="col">

                    <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb2 ?>" width="100%" height="100%" style="max-height: 160px;">

                </div>
                <div class="col">

                    <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb3 ?>" width="100%" height="100%" style="max-height: 160px;">

                </div>
                <div class="col">

                    <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb4 ?>" width="100%" height="100%" style="max-height: 160px;">

                </div>
                <?php
                // var_dump($val1." + ".$val2." + ".$val3." + ".$val4);
                // }
                ?>
            </div>
        </div>
        <div style="text-align: center; font-family: sans-serif; padding: 30px 10px; font-weight: bold;">
            <H1 style="text-transform: uppercase;">
                <?php
                $query_judul = "SELECT * FROM LT_change_judul WHERE copy_id='" . $row_data['tour_id'] . "' && grub_id='" . $row_data['grub_id'] . "'";
                $rs_judul = mysqli_query($con, $query_judul);
                $row_judul = mysqli_fetch_array($rs_judul);

                if (!isset($row_judul['id'])) {
                    echo $row_data['judul'];
                } else {
                    echo $row_judul['nama'];
                }

                ?>
            </H1>
        </div>
        <div class="hg" style="font-style: oblique;">
            <div class="container">
                <b>HIGHLIGHT :</b>
                <p>
                    <?php
                    $hl_i = 0;
                    $hl_d = "";
                    foreach ($arr_hl as $value_hl) {
                        $hl_i++;
                        $hl_d .= $value_hl . ",";
                    }
                    echo $hl_d;
                    ?>
                </p>
            </div>
        </div>
        <?php
        $x = 1;
        $arr_hl = [];
        $date_plus = 0;
        $cek_hari = 1;
        for ($c = 1; $c <= $json_day; $c++) {
            $date = date('Y-m-d', strtotime("+ " . $date_plus . " day", strtotime($start_date)));

            $query_cek_hari = "SELECT  id ,hari FROM  LT_AH_Main where copy_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $row_data['grub_id'] . "' && hari='$c'";
            $rs_cek_hari = mysqli_query($con, $query_cek_hari);
            $row_cek_hari = mysqli_fetch_array($rs_cek_hari);

            if (isset($row_cek_hari['id'])) {
                $data_print = array(
                    "copy" => $row_data['tour_id'],
                    "master" => $row_data['master_id'],
                    "sfee_id" => $row_data['sfee_id'],
                    "grub_id" => $row_data['grub_id'],
                    "c" => $c,
                    "date" => $date,
                    "cek_hari" => $row_cek_hari['hari'],
                    "json_day" => $json_day,
                );
                add_rute_AH($data_print);
            } else {
                $data_print = array(
                    "copy" => $row_data['tour_id'],
                    "master" => $row_data['master_id'],
                    "sfee_id" => $row_data['sfee_id'],
                    "grub_id" => $row_data['grub_id'],
                    "c" => $c,
                    "date" => $date,
                    "cek_hari" => $cek_hari,
                    "json_day" => $json_day,
                );
                // var_dump($data_print);
                add_rute_AH($data_print);

                $cek_hari++;
            }
            $date_plus++;
        }
        ?>
        <div style="padding: 5px 20px; font-size: 12pt;">
            <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $row_lt['kota'] ?></div>
            <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $row_lt['kode']; ?></div>
            <div>
                <table class="table table-bordered table-sm" style="border-color: black;">
                    <thead>
                        <tr>
                            <th>Flight Name</th>
                            <th>Depature Date</th>
                            <th>Pax</th>
                            <th>Twin</th>
                            <th>Single</th>
                            <th>CNB</th>
                            <th>Infant</th>
                            <th>Booking Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($row_data['pax'] != 0) {
                        ?>
                            <td style="min-width: 200px;"><?php echo  $rowflight_logo['nama'] ?></td>
                            <td><?php echo $start_date ?></td>
                            <td><?php echo  $row_data['pax'] ?> </td>
                            <td><?php echo "Rp." . number_format($row_data['twn'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($row_data['sgl'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($row_data['cnb'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($row_data['inf'], 0, ",", ".") ?></td>
                            <td></td>
                        <?php
                        } else if ($row_data['ltwn'] != 0) {
                        ?>
                            <td style="min-width: 200px;"><?php echo  $rowflight_logo['nama'] ?></td>
                            <td><?php echo $start_date ?></td>
                            <td>
                                <?php
                                if ($row_data['pax'] != 0) {
                                    echo $row_data['pax'];
                                } else {
                                    echo $row_data['pax_tour'];
                                }
                                ?>
                            </td>
                            <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                            <td></td>
                        <?php
                        } else {
                        ?>
                            <td style="min-width: 200px;"><?php echo  $rowflight_logo['nama'] ?></td>
                            <td><?php echo $start_date ?></td>
                            <td>
                                <?php
                                if ($row_data['pax'] != 0) {
                                    echo $row_data['pax'];
                                } else {
                                    echo $row_data['pax_tour'];
                                }
                                ?>
                            </td>
                            <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                            <td></td>
                        <?php
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Hotel Name </td>
                            <td colspan="7"> <?php
                                                // var_dump($result_hp['hotel']);
                                                foreach ($result_hp['hotel'] as $val_hotel) {
                                                    if (isset($val_hotel)) {
                                                        echo " // " . $val_hotel;
                                                    }
                                                } ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-6">
                    <div>
                        <?php
                        $query2 = "SELECT * FROM LT_add_transport_baru where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['tour_id'] . "' && grub_id='" . $row_data['grub_id'] . "' && sfee_id='" . $row_data['sfee_id'] . "' order by hari ASC, urutan ASC";
                        $rs2 = mysqli_query($con, $query2);
                        $row2 = mysqli_fetch_array($rs2);
                        if (isset($row2['id'])) {
                        ?>
                            <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                                <thead>
                                    <tr>
                                        <th scope="col">Transport</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM  LT_add_transport_baru where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['tour_id'] . "' && grub_id='" . $row_data['grub_id'] . "' && sfee_id='" . $row_data['sfee_id'] . "' order by hari ASC, urutan ASC";
                                    $rs = mysqli_query($con, $query);
                                    $code_fl = [];
                                    while ($row = mysqli_fetch_array($rs)) {
                                        $fl_logo = "";
                                        if ($row['type'] == '1') {
                                            $type = "Flight";

                                            $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $row['transport'] . "'";
                                            $rsflight = mysqli_query($con, $queryflight);
                                            $rowflight = mysqli_fetch_array($rsflight);
                                            $arr_fl = explode(" ", $rowflight['maskapai']);
                                            array_push($code_fl, $arr_fl[0]);

                                            $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") " . $rowflight['rute'];
                                        } else if ($row['type'] == '2') {
                                            $type = "Ferry";
                                            $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row['transport'];
                                            $rs_ferry = mysqli_query($con, $query_ferry);
                                            $row_ferry = mysqli_fetch_array($rs_ferry);
                                            $detail = $type . " : " . $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ") " . $row_ferry['type'];
                                        } else if ($row['type'] == '4') {
                                            $type = "Train";
                                            $query_train = "SELECT * FROM train_LTnew where id=" . $row['transport'];
                                            $rs_train = mysqli_query($con, $query_train);
                                            $row_train = mysqli_fetch_array($rs_train);

                                            $detail = $row_train['nama'];
                                            $adt = $row_train['adt'];
                                            $chd = $row_train['chd'];
                                            $inf = $row_train['inf'];
                                        } else {
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $detail ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        $val_arr = array_unique($code_fl);
                        foreach ($val_arr as $code) {
                            $queryflight_logo = "SELECT * FROM LT_flight_logo WHERE kode='" . $code . "'";
                            $rsflight_logo = mysqli_query($con, $queryflight_logo);
                            $rowflight_logo = mysqli_fetch_array($rsflight_logo);
                            $fl_logo = $rowflight_logo['gambar'];
                        ?>
                            <div class="col-3">
                                <img src="https://www.2canholiday.com/Admin/plane_logo/<?php echo $fl_logo ?>" width="100%" height="60px" />
                            </div>

                        <?php
                        }
                        ?>
                    </div>

                </div>
                <div class="col-6">
                </div>
            </div>
        </div>

        <!-- include & exclude -->
        <div style="padding-top: 20px;"></div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TERMASUK : </u></div>
                    <div>
                        <ul>
                            <?php

                            foreach ($arr_in as $val_auto) {
                                $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto'";
                                $rs_p = mysqli_query($con, $query_p);
                                $row_p = mysqli_fetch_array($rs_p);
                                if ($row_p['id'] == '8') {
                                    echo "<li>" . $row_p['nama'] . " " . $detail_visa . "</li>";
                                } else if ($row_p['id'] == '26') {
                                    echo "<li>" . $row_p['nama'] . " " . $guide_price . "</li>";
                                } else if ($row_p['id'] == '27') {
                                    echo "<li>" . $row_p['nama'] . " " . $tl_price . "</li>";
                                } else if ($row_p['id'] == '37') {
                                    echo "<li>" . $row_p['nama'] . " " . $porter_price . "</li>";
                                } else {
                                    echo "<li>" . $row_p['nama'] . "</li>";
                                }
                            }
                            if (is_array($arr_tmp)) {
                                foreach ($arr_tmp as $val_arr_tmp) {
                                    echo "<li>" . $val_arr_tmp['nama'] . "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>

                </div>
                <div class="col-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TIDAK TERMASUK : </u></div>
                    <div>
                        <?php

                        ?>
                        <ul>
                            <?php
                            foreach ($arr_ex as $val_auto) {
                                $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto'";
                                $rs_p = mysqli_query($con, $query_p);
                                $row_p = mysqli_fetch_array($rs_p);
                                if ($row_p['id'] == '8') {
                                    if ($result_visa['adt'] == '0') {
                                        echo "<li>" . $row_p['nama'] . " " . $detail_visa . " | TBA" . "</li>";
                                    } else {
                                        echo "<li>" . $row_p['nama'] . " " . $detail_visa . " | Rp." . number_format($result_visa['adt'], 0, ",", ".") . "</li>";
                                    }
                                } else if ($row_p['id'] == '26') {
                                    echo "<li>" . $row_p['nama'] . " " . $guide_price . "</li>";
                                } else if ($row_p['id'] == '27') {
                                    echo "<li>" . $row_p['nama'] . " " . $tl_price . "</li>";
                                } else if ($row_p['id'] == '37') {
                                    echo "<li>" . $row_p['nama'] . " " . $porter_price . "</li>";
                                } else {
                                    echo "<li>" . $row_p['nama'] . "</li>";
                                }
                            }
                            if (is_array($arr_tmpex)) {
                                foreach ($arr_tmpex as $val_arr_tmpex) {
                                    echo "<li>" . $val_arr_tmpex['nama'] . " : Rp." . number_format($val_arr_tmpex['price']) . "</li>";
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col">
                    <?php
                    $query_note = "SELECT * FROM  tour_node where copy_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "'";
                    $rs_note = mysqli_query($con, $query_note);
                    $row_note = mysqli_fetch_array($rs_note);
                    // var_dump($query_note);
                    if ($row_note['note'] != "") {
                    ?>
                        <div style="font-size: 12pt;">
                            <u><b>NOTE :</b></u>
                        </div>
                        <div>
                            <?php echo $row_note['note'] ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- <div class="col">
                    <div style="font-size: 12pt;">
                        <u><b>HIGHLIGHT :</b></u>
                    </div>
                    <div>
                        <?php
                        $hl_i = 0;
                        $hl_d = "";
                        foreach ($arr_hl as $value_hl) {
                            $hl_i++;
                            $hl_d .= $value_hl . ",";
                        }
                        echo $hl_d;
                        ?>
                    </div>
                </div> -->
            </div>
        </div>

        <div style="padding: 5px 20px; font-size: 12px;">
            <div style="font-size: 12pt;">
                <u><b>DEPOSIT, PEMBAYARAN & PEMBATALAN :</b></u>
            </div>
            <div>
                <div>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour . No Refund/pengembalian jika ada pembatalan dari peserta</div>
                <div>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour</div>
                <div>Kami tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya</div>
                <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
                <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
                <div>Kami berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Kami sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
            </div>
        </div>
    </div>
    <script>
        var kode = "<?php
                    $judul = "NO_CODE";
                    if ($row_data['landtour'] != "undefined") {
                        $judul = $row_data['landtour'];
                    }
                    echo $judul;
                    ?>";
        var judul = "<?php echo $row_data['judul'] ?>";
        document.title = kode + "-" + judul;
        window.print();
    </script>
</body>

</html>