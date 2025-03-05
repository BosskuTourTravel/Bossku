<?php
function get_date($data)
{
    include "../db=connection.php";
    // include "Api_LT_total_baru.php";
    $query_grub = "SELECT * FROM LTP_grub_flight where city_in='" . $data['in'] . "' && city_out='" . $data['out'] . "' order by id ASC";
    $rs_grub = mysqli_query($con, $query_grub);
    // var_dump($query_grub);

    $v_total_twn = $data['total_twn'];
    $v_total_sgl = $data['total_sgl'];
    $v_total_chd = $data['total_chd'];
    $v_total_inf = $data['total_inf'];

    // var_dump("harga lt :".$v_total_twn."</br>");
?>
    <div style="padding: 5px 20px; font-size: 12pt;">
        <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $data['kota'] ?></div>
        <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $data['judul']; ?></div>
        <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $data['kode']; ?></div>
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
                    $code_fl = [];
                    $xx = 1;
                    while ($row_grub = mysqli_fetch_array($rs_grub)) {
                        // var_dump($xx . "</br>");
                        $query_sfee = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $row_grub['id'] . "' order by date_set ASC";
                        $rs_sfee = mysqli_query($con, $query_sfee);

                        $xpp = 0;
                        $price_set = 0;
                        $tgl_sementara = "";
                        $arr_tgl = [];
                        $sfee_tgl = [];
                        while ($row_sfee = mysqli_fetch_array($rs_sfee)) {
                            $date_sekarang = date("Y-m-d");
                            if ($row_sfee['date_set'] > $date_sekarang) {

                                $search = $row_sfee['adt'];
                                $found = array_filter($arr_tgl, function ($v, $k) use ($search) {
                                    return $v['adt'] == $search;
                                }, ARRAY_FILTER_USE_BOTH);
                                if (count(array_values($found)) === 0) {
                                    $tgl_sementara = date("d M ", strtotime($row_sfee['date_set']));
                                    $val = array(
                                        "tgl" => $tgl_sementara,
                                        "adt" => $row_sfee['adt'],
                                        "chd" => $row_sfee['chd'],
                                        "inf" => $row_sfee['inf'],
                                        "tgl_ct" => $row_sfee['date_set'],
                                    );
                                    array_push($arr_tgl, $val);
                                } else {

                                    foreach ($arr_tgl as $k => $v) {
                                        if ($v['adt'] == $row_sfee['adt']) {
                                            $tgl_sementara = $v['tgl'];
                                            $tgl_sementara .= ", " . date("d M ", strtotime($row_sfee['date_set']));
                                            $arr_tgl[$k]['tgl'] =  $tgl_sementara;
                                        }
                                    }
                                }
                            }
                            $xpp++;
                        }
                        // var_dump($arr_tgl['tgl'] . "</br>");
                        $no_gf = 1;
                        $query_grub_value = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
                        $rs_grub_value = mysqli_query($con, $query_grub_value);
                        // var_dump($query_grub_value);

                        $fl_name = "";
                        $fl_kode = "";
                        $price_detail_twn = 0;
                        $price_detail_sgl = 0;
                        $price_detail_chd = 0;
                        $price_detail_inf = 0;
                        while ($row_grub_value = mysqli_fetch_array($rs_grub_value)) {


                            $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_grub_value['flight_id'] . "'";
                            $rs_detail2 = mysqli_query($con, $query_detail2);
                            $row_detail2 = mysqli_fetch_array($rs_detail2);
                            // var_dump($row_detail2['maskapai']);

                            $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail2['route_id'] . "'";
                            $rs_rt = mysqli_query($con, $query_rt);
                            $row_rt = mysqli_fetch_array($rs_rt);
                            // var_dump($query_rt);

                            if ($row_grub_value['status'] == '1') {
                                if ($no_gf == '1') {
                                    $price_detail_twn = $price_detail_twn + $row_rt['adt'];
                                    $price_detail_sgl = $price_detail_sgl + $row_rt['adt'];
                                    $price_detail_chd = $price_detail_chd + $row_rt['chd'];
                                    $price_detail_inf = $price_detail_inf + $row_rt['inf'];
                                }
                            } else {

                                $price_detail_twn = $price_detail_twn + $row_detail2['adt'];
                                $price_detail_sgl = $price_detail_sgl + $row_detail2['adt'];
                                $price_detail_chd = $price_detail_chd + $row_detail2['chd'];
                                $price_detail_inf = $price_detail_inf + $row_detail2['inf'];
                            }

                            //  var_dump($queryflight_logo."</br>");
                            if ($no_gf == 1) {
                                // var_dump($row_detail2['maskapai']);
                                $fl_kode = $row_detail2['maskapai'];
                            }

                            $no_gf++;
                        }

                        // var_dump("ccc".$price_detail_twn);

                        $arr_fl = explode(" ", $fl_kode);
                        // array_push($code_fl, $arr_fl[0]);

                        $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" .  $arr_fl[0] . "'";
                        $rsflight_logo = mysqli_query($con, $queryflight_logo);
                        $rowflight_logo = mysqli_fetch_array($rsflight_logo);
                        $fl_name = $rowflight_logo['nama'];
                        // var_dump($arr_tgl);

                        foreach ($arr_tgl as $val_tgl) {

                            if ($val_tgl != null) {
                                $data_tps = array(
                                    "master_id" => $data['master'],
                                    "copy_id" => $data['copy'],
                                    "check_id" => '32',
                                    "flight" => $row_grub['id'],
                                    "date" => $val_tgl['tgl_ct']
                                );
                                // var_dump($data_tps);

                                $show_tps = get_total($data_tps);
                                $result_tps = json_decode($show_tps, true);

                                $price_flight_adt = $val_tgl['adt'] + $price_detail_twn ;
                                $price_flight_sgl = $val_tgl['adt'] + $price_detail_sgl ;
                                $price_flight_inf = $val_tgl['chd'] + $price_detail_chd ;
                                $price_flight_chd = $val_tgl['inf'] + $price_detail_inf ;

                                // set profit flight
                                $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $price_flight_adt . "' && price2 >='" .$price_flight_adt . "'";
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

                                $adt_price = intval($price_flight_adt) * ($pr / 100);
                                $chd_price = intval($price_flight_adt) * ($pr / 100);
                                $inf_price = intval($price_flight_adt) * ($pr / 100);

                                $plus_adt = $adt_price + $nom;
                                $plus_chd = $chd_price + $nom;
                                $plus_inf = $inf_price + $nom;

                                $v_twn = 0;
                                $v_sgl = 0;
                                $v_chd = 0;
                                $v_inf = 0;
                                // var_dump( $v_twn);
                                


                                if ($data['chck_flight'] == '1') {
                                    // var_dump("---".$v_twn);

                                    $v_twn =   $price_flight_adt + $plus_adt;
                                    $v_sgl = $price_flight_adt + $plus_adt;
                                    $v_chd =  $price_flight_adt + $plus_chd;
                                    $v_inf = $price_flight_adt + $plus_inf;
                                }
                                // echo $val_tgl['tgl']."</br>";
                                if ($data['chck_costtl'] == '1') {
                                    $v_twn =  $v_twn + $result_tps['adt'];
                                    $v_sgl =  $v_sgl + $result_tps['adt'];
                                    $v_chd =  $v_chd + $result_tps['adt'];
                                    $v_inf =  $v_inf + $result_tps['adt'];
                                }

                                $v_twn = $v_twn + $v_total_twn;
                                $v_sgl = $v_sgl + $v_total_sgl;
                                $v_chd = $v_chd + $v_total_chd;
                                $v_inf = $v_inf + $v_total_inf;



                                $twn_sp = get_pembulatan($v_twn);
                                $twn_rp = json_decode($twn_sp, true);

                                $sgl_sp = get_pembulatan($v_sgl);
                                $sgl_rp = json_decode($sgl_sp, true);

                                $cnb_sp = get_pembulatan($v_chd);
                                $cnb_rp = json_decode($cnb_sp, true);

                                $inf_sp = get_pembulatan($v_inf);
                                $inf_rp = json_decode($inf_sp, true);

                    ?>
                                <tr>
                                    <td style="min-width: 200px;"><?php echo  $fl_name ?></td>
                                    <td><?php echo  $val_tgl['tgl'] ?></td>
                                    <td><?php echo  $data['pax'] ?> </td>
                                    <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                    <?php

                            }
                        }
                        $xx++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Hotel Name </td>
                        <td colspan="7"><?php echo $data['d_hotel'] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php
}
function get_date_pilih($data)
{
    include "../db=connection.php";
    $query_grub = "SELECT * FROM LTP_grub_flight where id='" . $data['grub_id'] . "' order by id ASC";
    $rs_grub = mysqli_query($con, $query_grub);

    $v_total_twn = $data['total_twn'];
    $v_total_sgl = $data['total_sgl'];
    $v_total_chd = $data['total_chd'];
    $v_total_inf = $data['total_inf'];
    // var_dump($data['total_twn']);
?>
    <div style="padding: 5px 20px; font-size: 12pt;">
        <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $data['kota'] ?></div>
        <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $data['judul']; ?></div>
        <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $data['kode']; ?></div>
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
                    $code_fl = [];
                    $xx = 1;
                    while ($row_grub = mysqli_fetch_array($rs_grub)) {

                        $query_sfee = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $row_grub['id'] . "' order by adt ASC, date_set ASC";
                        $rs_sfee = mysqli_query($con, $query_sfee);
                        // var_dump($query_sfee);
                        $x = 0;
                        $price_set = 0;
                        $tgl_sementara = "";
                        $arr_tgl = [];
                        $index = 0;
                        while ($row_sfee = mysqli_fetch_array($rs_sfee)) {
                            $date_sekarang = date("Y-m-d");

                            if ($row_sfee['date_set'] > $date_sekarang) {
                                // var_dump($row_sfee['date_set']);
                                $search = $row_sfee['adt'];
                                $found = array_filter($arr_tgl, function ($v, $k) use ($search) {
                                    return $v['adt'] == $search;
                                }, ARRAY_FILTER_USE_BOTH);
                                if (count(array_values($found)) === 0) {
                                    $tgl_sementara = date("d M ", strtotime($row_sfee['date_set']));
                                    $val = array(
                                        "tgl" => $tgl_sementara,
                                        "adt" => $row_sfee['adt'],
                                        "chd" => $row_sfee['chd'],
                                        "inf" => $row_sfee['inf'],
                                        "tgl_ct" => $row_sfee['date_set']

                                    );
                                    array_push($arr_tgl, $val);
                                } else {

                                    foreach ($arr_tgl as $k => $v) {
                                        if ($v['adt'] == $row_sfee['adt']) {
                                            $tgl_sementara = $v['tgl'];
                                            $tgl_sementara .= ", " . date("d M ", strtotime($row_sfee['date_set']));
                                            $arr_tgl[$k]['tgl'] =  $tgl_sementara;
                                        }
                                    }
                                }
                            }

                            $x++;
                        }

                        $query_grub_value = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
                        $rs_grub_value = mysqli_query($con, $query_grub_value);
                        // var_dump($query_grub_value);
                        $x_gf = 1;
                        /// get value flight detail
                        $fl_detail_adt = 0;
                        $fl_detail_chd = 0;
                        $fl_detail_inf = 0;
                        while ($row_grub_value = mysqli_fetch_array($rs_grub_value)) {

                            $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_grub_value['flight_id'] . "'";
                            $rs_detail2 = mysqli_query($con, $query_detail2);
                            $row_detail2 = mysqli_fetch_array($rs_detail2);
                            // var_dump($query_detail2);

                            $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .   $row_detail2['route_id'] . "'";
                            $rs_rt = mysqli_query($con, $query_rt);
                            $row_rt = mysqli_fetch_array($rs_rt);
                            // var_dump($query_rt);


                            if ($row_grub_value['status'] == '1') {
                                if ($x_gf == '1') {
                                    // echo $v_total_twn." + ".$row_rt['adt']."</br>";

                                    $fl_detail_adt = $fl_detail_adt + $row_rt['adt'];
                                    $fl_detail_chd = $fl_detail_adt + $row_rt['chd'];
                                    $fl_detail_inf = $fl_detail_adt + $row_rt['inf'];
                                    $x_gf++;
                                }
                            } else {
                                $fl_detail_adt = $fl_detail_adt + $row_detail2['adt'];
                                $fl_detail_chd = $fl_detail_chd + $row_detail2['chd'];
                                $fl_detail_inf = $fl_detail_inf + $row_detail2['inf'];
                            }

                            $arr_fl = explode(" ", $row_detail2['maskapai']);
                            array_push($code_fl, $arr_fl[0]);

                            $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $code_fl[0] . "'";
                            $rsflight_logo = mysqli_query($con, $queryflight_logo);
                            $rowflight_logo = mysqli_fetch_array($rsflight_logo);
                            // var_dump($queryflight_logo);
                        }
                        // var_dump($arr_tgl);

                        foreach ($arr_tgl as $val_tgl) {
                            if ($val_tgl != null) {
                                $data_tps = array(
                                    "master_id" => $data['master'],
                                    "copy_id" => $data['copy'],
                                    "check_id" => '32',
                                    "flight" => $data['grub_id'],
                                    "date" => $val_tgl['tgl_ct'],
                                    "tl_pax" => $data['tl_pax'],
                                    "tl_pax" => $data['tl_pax']
                                );
                                // var_dump($data_tps);

                                $show_tps = get_total($data_tps);
                                $result_tps = json_decode($show_tps, true);
                                // var_dump( "cost tl :" .$result_tps['adt']);

                                $adt_dt_sfee = $val_tgl['adt'] + $fl_detail_adt;
                                $chd_dt_sfee = $val_tgl['chd'] + $fl_detail_chd;
                                $inf_dt_sfee = $val_tgl['inf'] + $fl_detail_inf;

                                // set profit flight
                                $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $adt_dt_sfee . "' && price2 >='" . $adt_dt_sfee . "'";
                                $rs_profit = mysqli_query($con, $sql_profit);
                                $row_profit = mysqli_fetch_array($rs_profit);
                                // var_dump($sql_profit);

                                $pr = 0;
                                if ($row_profit['id'] != "") {
                                    $pr = $row_profit['profit'];
                                } else {
                                    $pr = 5;
                                }
                                $dm = $adt_dt_sfee * ($row_profit['adm_mkp'] / 100);
                                $mar = $adt_dt_sfee * ($row_profit['marketing'] / 100);
                                $agn = $adt_dt_sfee * ($row_profit['sub_agent'] / 100);
                                $ste = $row_profit['staff_eks'];
                                $nom = $row_profit['nominal'];
                                $lain2 = $adm + $mar + $agn + $ste + $nom;

                                $adt_price = intval($adt_dt_sfee) * ($pr / 100);
                                $chd_price = intval($adt_dt_sfee) * ($pr / 100);
                                $inf_price = intval($adt_dt_sfee) * ($pr / 100);

                                $plus_adt = $adt_dt_sfee +  $adt_price + $nom;
                                $plus_chd = $chd_dt_sfee + $chd_price + $nom;
                                $plus_inf = $inf_dt_sfee +  $inf_price + $nom;

                                $v_twn = $v_total_twn;
                                $v_sgl = $v_total_sgl;
                                $v_chd = $v_total_chd;
                                $v_inf = $v_total_inf;



                                if ($data['chck_flight'] == '1') {

                                    $v_twn = $v_twn + $plus_adt;
                                    $v_sgl = $v_sgl + $plus_adt;
                                    $v_chd = $v_chd + $plus_chd;
                                    $v_inf = $v_inf + $plus_inf;
                                }
                                // echo $val_tgl['tgl']."</br>";
                                if ($data['chck_costtl'] == '1') {
                                    $v_twn = $v_twn + $result_tps['adt'];
                                    $v_sgl = $v_sgl + $result_tps['adt'];
                                    $v_chd = $v_chd + $result_tps['adt'];
                                    $v_inf = $v_inf + $result_tps['adt'];
                                }


                                // var_dump($plus_adt);
                                // var_dump($v_total_twn);


                                $twn_sp = get_pembulatan($v_twn);
                                $twn_rp = json_decode($twn_sp, true);

                                $sgl_sp = get_pembulatan($v_sgl);
                                $sgl_rp = json_decode($sgl_sp, true);

                                $cnb_sp = get_pembulatan($v_chd);
                                $cnb_rp = json_decode($cnb_sp, true);

                                $inf_sp = get_pembulatan($v_inf);
                                $inf_rp = json_decode($inf_sp, true);

                    ?>
                                <tr>
                                    <td style="min-width: 200px;"><?php echo  $rowflight_logo['nama'] ?></td>
                                    <td><?php echo  $val_tgl['tgl'] ?></td>
                                    <td><?php echo  $data['pax'] ?> </td>
                                    <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                    <?php

                            }
                        }
                        $xx++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Hotel Name </td>
                        <td colspan="7"><?php echo $data['d_hotel'] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php
}

function custom_price($data)
{
    include "../db=connection.php";
    $query_grub = "SELECT * FROM LTP_grub_flight where id='" . $data['grub_id'] . "' order by id ASC";
    $rs_grub = mysqli_query($con, $query_grub);

    $v_total_twn = $data['total_twn'];
    $v_total_sgl = $data['total_sgl'];
    $v_total_chd = $data['total_chd'];
    $v_total_inf = $data['total_inf'];
?>
    <div style="padding: 5px 20px; font-size: 12pt;">
        <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $data['kota'] ?></div>
        <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $data['judul']; ?></div>
        <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $data['kode']; ?></div>
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
                    $code_fl = [];
                    $xx = 1;
                    while ($row_grub = mysqli_fetch_array($rs_grub)) {
                        // var_dump($xx);
                        // $jml = "SELECT COUNT(*) as val FROM LTP_insert_sfee where id_grub=" . $row_grub['id'];
                        // $rs_jml = mysqli_query($con, $jml);
                        // $row_jml = mysqli_fetch_array($rs_jml);

                        $query_sfee = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $row_grub['id'] . "' order by adt ASC, date_set ASC";
                        $rs_sfee = mysqli_query($con, $query_sfee);
                        // var_dump($query_sfee);
                        $x = 0;
                        $price_set = 0;
                        $tgl_sementara = "";
                        $arr_tgl = [];
                        while ($row_sfee = mysqli_fetch_array($rs_sfee)) {
                            $date_sekarang = date("Y-m-d");

                            if ($row_sfee['date_set'] > $date_sekarang) {
                                // var_dump($row_sfee['date_set']);
                                $search = $row_sfee['adt'];
                                $found = array_filter($arr_tgl, function ($v, $k) use ($search) {
                                    return $v['adt'] == $search;
                                }, ARRAY_FILTER_USE_BOTH);
                                if (count(array_values($found)) === 0) {
                                    $tgl_sementara = date("d M ", strtotime($row_sfee['date_set']));
                                    $val = array(
                                        "tgl" => $tgl_sementara,
                                        "adt" => $row_sfee['adt'],
                                        "chd" => $row_sfee['chd'],
                                        "inf" => $row_sfee['inf'],
                                        "tgl_ct" => $row_sfee['date_set']

                                    );
                                    array_push($arr_tgl, $val);
                                } else {

                                    foreach ($arr_tgl as $k => $v) {
                                        if ($v['adt'] == $row_sfee['adt']) {
                                            $tgl_sementara = $v['tgl'];
                                            $tgl_sementara .= ", " . date("d M ", strtotime($row_sfee['date_set']));
                                            $arr_tgl[$k]['tgl'] =  $tgl_sementara;
                                        }
                                    }
                                }
                            }

                            $x++;
                        }

                        $x_gf = 1;
                        $query_grub_value = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
                        $rs_grub_value = mysqli_query($con, $query_grub_value);
                        // var_dump($query_grub_value);
                        while ($row_grub_value = mysqli_fetch_array($rs_grub_value)) {

                            $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_grub_value['flight_id'] . "'";
                            $rs_detail2 = mysqli_query($con, $query_detail2);
                            $row_detail2 = mysqli_fetch_array($rs_detail2);


                            $arr_fl = explode(" ", $row_detail2['maskapai']);
                            array_push($code_fl, $arr_fl[0]);

                            $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $code_fl[0] . "'";
                            $rsflight_logo = mysqli_query($con, $queryflight_logo);
                            $rowflight_logo = mysqli_fetch_array($rsflight_logo);
                            // var_dump($queryflight_logo);
                        }
                        // var_dump($arr_tgl);

                        foreach ($arr_tgl as $val_tgl) {
                            if ($val_tgl != null) {
                    ?>
                                <tr>
                                    <td style="min-width: 200px;"><?php echo  $rowflight_logo['nama'] ?></td>
                                    <td><?php echo  $val_tgl['tgl'] ?></td>
                                    <td><?php echo  $data['pax'] ?> </td>
                                    <td><?php echo "Rp." . number_format($v_total_twn, 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($v_total_sgl, 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($v_total_chd, 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($v_total_inf, 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                    <?php

                            }
                        }
                        $xx++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Hotel Name </td>
                        <td colspan="7"><?php echo $data['d_hotel'] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php
}
