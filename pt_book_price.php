<?php
if (isset($_POST['room'])) {
    include "db=connection.php";
    include "API/fungsi_gethotel_front_price.php";
    include "API/Price/Api_LT_total_baru.php";
    include "API/fungsi_get_front_profit_flight_price.php";
    include "API/fungsi_front_feetl.php";
    $judul = "";
    // $deptDate =
    $query_data = "SELECT paket_tour_online.*, LTSUB_itin.judul,LTSUB_itin.landtour,LTSUB_itin.master_id,LTSUB_itin.hari,LT_change_judul.nama as change_judul,LTP_insert_sfee.ket as staff_id,login_staff.name as staff_name,login_staff.phone FROM paket_tour_online INNER JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id lEFT JOIN LT_change_judul ON paket_tour_online.tour_id=LT_change_judul.copy_id && paket_tour_online.grub_id=LT_change_judul.grub_id INNER JOIN LTP_insert_sfee ON paket_tour_online.sfee_id=LTP_insert_sfee.id INNER JOIN login_staff ON LTP_insert_sfee.ket=login_staff.id where paket_tour_online.id='" . $_POST['id'] . "'";
    $rs_data = mysqli_query($con, $query_data);
    while ($row_data = mysqli_fetch_array($rs_data)) {

        $query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $row_data['grub_id'] . "'";
        $rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
        $row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);

        // var_dump($query_cek_addhari);
        $json_day = $row_data['hari'] + $row_cek_addhari['plus_hari'];

        // $deptDate = $row_data['tgl_ber'];
        $returnDate = date('D, d M Y', strtotime('+' . $json_day . 'day', strtotime($row_data['tgl_ber'])));
        $deptDate = date('D, d M Y', strtotime($row_data['tgl_ber']));

        if (isset($row_data['change_judul'])) {
            $judul = $row_data['change_judul'];
        } else {
            $judul = $row_data['judul'];
        }

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

        $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_data['grub_id'] . "' order by id ASC";
        $rs_gf_price = mysqli_query($con, $query_gf);

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


        $arr_profit = array(
            "adt" => $adt,
            "chd" => $chd,
            "inf" => $inf
        );
        //  var_dump($arr_profit);
        $show_profit = get_profit_flight($arr_profit);
        $result_profit = json_decode($show_profit, true);


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


        ///////////// fee tl //////////////////////////////

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



        ////// batas /////////
    }
}
?>
<div class="card mt-4">
    <div class="card-header" style="text-align: center; font-weight: bold;">
        BOOKING SUMMARY
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div><?php echo $judul ?></div>
            <div style="padding-top: 20px;">
                <div class="row">
                    <div class="col-md-6">Checkin</div>
                    <div class="col-md-6">: <?php echo $deptDate ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Checkout</div>
                    <div class="col-md-6">: <?php echo $returnDate ?></div>
                </div>
                <?php
                $grandtotal = 0;
                for ($i = 1; $i <= $_POST['room']; $i++) {
                    $val_dewasa = $_POST['adt' . $i];
                    $val_anak =  $_POST['chd' . $i];

                    $adt_price = intval($val_dewasa) * $twn_rp['value'];
                    $sgl_price = intval($val_dewasa) * $sgl_rp['value'];
                    $cnb_price = intval($val_anak) * $cnb_rp['value'];

                    if ($val_dewasa % 2 == 0) {
                        $grandtotal = $grandtotal + $adt_price;
                    } else {
                        $grandtotal = $grandtotal + $sgl_price;
                    }



                ?>
                    <div class="room" style="border-bottom: gray solid 1px;">
                        <div class="room-title" style="font-weight: bold;">ROOM <?php echo $i ?></div>
                        <div class="room-content">
                            <?php
                            if ($val_dewasa % 2 == 0) {
                            ?>
                                <div class="row">
                                    <div class="col-md-6"><?php echo $val_dewasa . " adt x " . number_format($twn_rp['value'], 0, ",", ".") ?></div>
                                    <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($adt_price, 0, ",", ".") ?></div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="row">
                                    <div class="col-md-6"><?php echo $val_dewasa . " adt x " . number_format($sgl_rp['value'], 0, ",", ".") ?></div>
                                    <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($sgl_price, 0, ",", ".") ?></div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($val_anak != 0) {
                                $grandtotal = $grandtotal + $cnb_price;
                            ?>
                                <div class="row">
                                    <div class="col-md-6"><?php echo $val_anak . " chd x " . number_format($cnb_rp['value'], 0, ",", ".") ?></div>
                                    <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($cnb_price, 0, ",", ".") ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                    // if ($sisa > 0) {
                    //     $sisa--;
                    // }
                    // if ($sisa_anak > 0) {
                    //     $sisa_anak = $sisa_anak - 1;
                    // }
                }
                ?>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-6" style="font-weight: bold;">TOTAL</div>
                <div class="col-md-6" style="font-weight: bold;">IDR <?php echo number_format($grandtotal, 0, ",", ".") ?></div>
            </div>
        </li>
    </ul>
    <div class="card-footer" style="text-align: center;">
        <form action="booking-pt.php?id=<?php echo $_POST['id'] ?>" method="post">
            <input type="hidden" id="judul" name="judul" value="<?php echo $judul ?>">
            <input type="hidden" id="tgl" name="tgl" value="<?php echo  $start_date ?>">
            <input type="hidden" id="room" name="room" value="<?php echo  $_POST['room'] ?>">
            <?php
            for ($x = 1; $x <= $_POST['room']; $x++) {
            ?>
                <input type="hidden" id="adt_<?php echo $x  ?>" name="adt_<?php echo $x  ?>" value="<?php echo  $_POST['adt' . $x] ?>">
                <input type="hidden" id="chd_<?php echo $x  ?>" name="chd_<?php echo $x  ?>" value="<?php echo $_POST['chd' . $x] ?>">
            <?php
            }
            ?>
            <input type="hidden" id="adt_price" name="adt_price" value="<?php echo  $twn_rp['value'] ?>">
            <input type="hidden" id="cnb_price" name="cnb_price" value="<?php echo  $cnb_rp['value'] ?>">
            <input type="hidden" id="sgl_price" name="sgl_price" value="<?php echo  $sgl_price ?>">
            <input type="hidden" id="price" name="price" value="<?php echo  $grandtotal ?>">
            <button type="submit" class="btn btn-warning">BOOK NOW</button>
        </form>

    </div>
</div>