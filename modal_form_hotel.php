<?php
include "db=connection.php";
include "API/fungsi_gethotel_front_price.php";
include "API/Price/Api_LT_total_baru.php";
include "API/fungsi_get_front_profit_flight_price.php";
include "API/fungsi_front_feetl.php";
// var_dump($_POST['id']);
if (isset($_POST['id'])) {
    $query_cek = "SELECT paket_tour_online.*,LTSUB_itin.landtour,LTSUB_itin.master_id,LTSUB_itin.hari,LTSUB_itin.judul FROM paket_tour_online LEFT JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id where paket_tour_online.id=" . $_POST['id'];
    $rs_cek = mysqli_query($con, $query_cek);
    $row_cek = mysqli_fetch_array($rs_cek);
    // var_dump($query_cek);
    if (isset($row_cek['id'])) {
        $gt_chck_adt = 0;
        $gt_chck_chd = 0;
        $gt_chck_inf = 0;
        $gt_chck_sgl = 0;
        $val_check = [0];
        $fee_on = 0;
        $adt = 0;
        $chd = 0;
        $inf = 0;
        $x_gf = 1;
        $flight_price = 0;

        /// get nama maskapai
        $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_cek['grub_id'] . "' order by id ASC";
        $rs_gf_price = mysqli_query($con, $query_gf);
        // var_dump($query_gf);
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

        $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $row_cek['grub_id'] . "' && LTP_insert_sfee.id='" . $row_cek['sfee_id'] . "'";
        $rs_grub = mysqli_query($con, $query_grub);
        $row_grub = mysqli_fetch_array($rs_grub);
        if (isset($row_grub['id'])) {
            $adt = $adt + $row_grub['adt'];
            $chd = $chd + $row_grub['chd'];
            $inf = $inf + $row_grub['inf'];
        }

        $arr_profit = array(
            "adt" => $adt,
            "chd" => $chd,
            "inf" => $inf
        );
        // var_dump($arr_profit);
        $show_profit = get_profit_flight($arr_profit);
        if ($show_profit) {
            $result_profit = json_decode($show_profit, true);
            $flight_price = $flight_price + intval($result_profit['adt']);
        }



        //// get value grandtotal tanpa tiket pesawat 
        $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_cek['tour_id'] . "' && master_id='" . $row_cek['master_id'] . "'";
        $rs_inc = mysqli_query($con, $query_inc);
        $row_inc = mysqli_fetch_array($rs_inc);
        $po = 0;
        if (isset($row_inc['id'])) {
            $query_include = explode(",", $row_inc['chck']);
            $ces = "";
            foreach ($query_include as $check) {
                if ($check != '1' && $check != '15' && $check != '17' && $check != '32') {
                    $data_tps = array(
                        "master_id" => $row_cek['master_id'],
                        "copy_id" => $row_cek['tour_id'],
                        "grub_id" => $row_cek['grub_id'],
                        "check_id" => $check
                    );
                    // var_dump($data_tps);
                    $show_tps = get_total($data_tps);
                    if ($show_tps) {
                        $result_tps = json_decode($show_tps, true);
                        $gt_chck_adt = $gt_chck_adt + $result_tps['adt'];
                        $gt_chck_chd = $gt_chck_chd + $result_tps['chd'];
                        $gt_chck_inf = $gt_chck_inf + $result_tps['inf'];
                        $gt_chck_sgl = $gt_chck_sgl + $result_tps['sgl'];
                    }
                    $po = $po + $result_tps['adt'];
                    $ces .= " + " . $check . " " . $gt_chck_adt;
                } else {
                    if ($check == '17') {
                        $include = [];
                        $adt_tmp = 0;
                        $chd_tmp = 0;
                        $inf_tmp = 0;

                        $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_cek['tour_id'] . "' && master_id='" . $row_cek['master_id'] . "'";
                        $rs_adm = mysqli_query($con, $query_adm);
                        $row_adm = mysqli_fetch_array($rs_adm);
                        if (isset($row_adm['id'])) {
                            $include = explode(",", $row_adm['include']);
                        }
                        $show_tps = get_adm_price($include);
                        if ($show_tps) {
                            $result_tps = json_decode($show_tps, true);
                            // $grandtotal = $grandtotal + $result_tps['adt'];
                            $gt_chck_adt = $gt_chck_adt + $result_tps['adt'];
                            $gt_chck_chd = $gt_chck_chd + $result_tps['adt'];
                            $gt_chck_inf = $gt_chck_inf + $result_tps['adt'];
                            $gt_chck_sgl = $gt_chck_sgl + $result_tps['adt'];
                        }
                    }
                    if ($check == '32') {
                        $fee_on = 1;
                    }
                }
            }
        }
        // echo " </br>" . $gt_chck_adt . "</br>";
        // echo " </br>" . $po . "</br>";
        // echo " </br>" . $ces . "</br>";


?>
        <div class="p-2">
            <div class="p-2 bd-highlight">
                <a class="btn btn-danger btn-sm tip my-1" href="Admin/cetak_pt_website_all_hotel.php?id=<?php echo $_POST['id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print All Hotel</a>
            </div>
            <table class="table table-striped table-sm text-sm text-start align-items-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pax</th>
                        <th scope="col">Hotel Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_master = "SELECT * FROM  LT_itinnew where kode='" . $row_cek['landtour'] . "' order by pax ASC";
                    $rs_master = mysqli_query($con, $query_master);
                    $no = 1;
                    while ($row_master = mysqli_fetch_array($rs_master)) {
                        $fee_tl = 0;

                        $data_hotel = array(
                            "id" => $row_master['id']
                        );

                        $show_hp = get_hotel_all($data_hotel);
                        $result_hp = json_decode($show_hp, true);

                        ///////////// fee tl //////////////////////////////
                        // $data_feetl = array(
                        //     "master_id" => $row_cek['master_id'],
                        //     "copy_id" => $row_cek['tour_id'],
                        //     "grub_id" => $row_cek['grub_id'],
                        //     "hotel_id" =>  $row_master['id']
                        // );
                        // var_dump($data_feetl);
                        // $show_feetl = feeTL($data_feetl);

                        if ($row_cek['tl_fee'] != '0') {
                            $data_feetl = array(
                                "master_id" => $row_cek['master_id'],
                                "copy_id" => $row_cek['tour_id'],
                                "grub_id" => $row_cek['grub_id'],
                                "hotel_id" =>  $row_master['id'],
                                "tl_fee" => $row_cek['tl_fee'],
                                "tl_meal" => $row_cek['tl_meal'],
                                "tl_tlpn" => $row_cek['tl_tlpn'],
                                "tl_sfee" => $row_cek['tl_sfee'],
                            );



                            $show_feetl = feeTL_custom($data_feetl);
                            // $result_feetl  = json_decode($show_feetl, true);
                        } else {
                            $data_feetl = array(
                                "master_id" => $row_cek['master_id'],
                                "copy_id" => $row_cek['tour_id'],
                                "grub_id" => $row_cek['grub_id'],
                                "hotel_id" =>  $row_master['id']
                            );
                            // var_dump($data_feetl);
                            $show_feetl = feeTL($data_feetl);
                        }


                        if ($show_feetl) {
                            $result_feetl = json_decode($show_feetl, true);
                            if ($fee_on == '1') {
                                if (isset($_POST['tl_pax'])) {
                                    $fee_tl = $result_feetl['custom'] / $row_cek['tl_pax'];
                                } else {
                                    $fee_tl = $result_feetl['adt'];
                                }
                            }
                        }

                        $total_manual_adt =  intval($flight_price) + intval($result_hp['twn']) + intval($fee_tl) + intval($gt_chck_adt) + intval($row_cek['ltwn']);

                        // echo "flight : " . $flight_price . " + hotel : " . $result_hp['twn'] . " + include : " . $gt_chck_adt . " + lain2 : " . $row_cek['ltwn'] . " + Feetl : " . $fee_tl . "</br>";

                        $twn_sp = get_pembulatan($total_manual_adt);
                        $twn_rp = json_decode($twn_sp, true);



                        $bonus = number_format($row_master['pax_b']);
                        $pax = "";
                        $pax .= $row_master['pax'];
                        if ($row_master['pax_u'] != '0') {
                            $pax = " - " . $row_master['pax_u'];
                        }
                        if ($bonus != 0) {
                            $pax .= " + " . $bonus;
                        }
                    ?>
                        <tr>
                            <th scope="row"><?php echo $no ?></th>
                            <td><?php echo $pax ?></td>
                            <td class="fs-6 text-start">
                                <?php
                                foreach ($result_hp['hotel'] as $htl) {
                                    echo "<div style='font-size:12px'>" . $htl . "</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo "IDR " . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm tip my-1" href="Admin/cetak_pt_website_hotel_one.php?id=<?php echo $_POST['id'] ?>&hotel=<?php echo  $row_master['id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                                <a class="btn btn-info btn-sm tip my-1" href="Admin/cetak_pt_website_hotel_one_agent.php?id=<?php echo $_POST['id'] ?>&hotel=<?php echo  $row_master['id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print Agent</a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}

?>