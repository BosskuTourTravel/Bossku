<div id='loadingmsg' style='display: none;'>
    <div class="spinner-grow text-primary" role="status">>
    </div>
    <div class="spinner-grow text-primary" role="status">
    </div>
    <div class="spinner-grow text-primary" role="status">
    </div>
</div>
<div id='loadingover' style='display: none;'></div>
<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total.php";

$id = $_POST['id'];
$query_data = "SELECT * FROM  DP_ptsub2 where ket='" . $_POST['cb'] . "' && id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query_sub = "SELECT landtour,judul FROM  LTSUB_itin where  id =" . $row_data['copy_id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);
$code = "";
$continent = "";
$country = "";
$city = "";
$pax = "";
$twn = 0;
$sgl = 0;
$cnb = 0;
$inf = 0;
$exp = "";
$judul = $row_data['judul'];

$arr = [];
$arr_chck = json_decode($row_data['chck_id'], true);
foreach ($arr_chck as $check) {
    if ($check != '15') {
        $data_tps = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['copy_id'],
            "check_id" => $check,
        );

        $show_tps = get_total($data_tps);
        $result_tps = json_decode($show_tps, true);

        $twn = $twn + $result_tps['adt'];
        $sgl = $sgl + $result_tps['sgl'];
        $cnb = $cnb + $result_tps['chd'];
        $inf = $inf + $result_tps['inf'];
    }
}

if ($row_sub['landtour'] != "undefined") {
    // get id lt_itinnew
    $query_hotel = "SELECT hotel_id FROM LT_select_PilihHTL WHERE master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['copy_id'] . "' order by id ASC limit 1";
    $rs_hotel = mysqli_query($con, $query_hotel);
    $row_hotel = mysqli_fetch_array($rs_hotel);
    if ($row_hotel['hotel_id'] != "") {

        $query_itin = "SELECT * FROM LT_itinnew WHERE id=" . $row_hotel['hotel_id'];
        $rs_itin = mysqli_query($con, $query_itin);
        $row_itin = mysqli_fetch_array($rs_itin);
        $code = $row_itin['kode'];
        $continent = $row_itin['benua'];
        $country = $row_itin['negara'];
        $city = $row_itin['kota'];
        $pax = "(" . $row_itin['pax'] . " - " . $row_itin['pax_u'] . " [" . $row_itin['pax_b'] . "])";
        $exp = $row_itin['expired'];

        if ($row_itin['id'] != "") {
            $sql_profit = "SELECT id,profit FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
            $rs_profit = mysqli_query($con, $sql_profit);
            $row_profit = mysqli_fetch_array($rs_profit);

            $pr = 0;
            if ($row_profit['id'] != "") {
                $pr = $row_profit['profit'];
            } else {
                $pr = 5;
            }
            $p_twin = ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'];
            $p_chd = ($row_itin['agent_cnb'] * $pr / 100) + $row_itin['agent_cnb'];
            $p_inf = ($row_itin['agent_inf'] * $pr / 100) + $row_itin['agent_inf'];
            $p_sgl = ($row_itin['agent_sgl'] * $pr / 100) + $row_itin['agent_sgl'];

            $twn = $twn +  $p_twin + $row_data['l_twn'];
            $sgl = $sgl +  $p_sgl + $row_data['l_sgl'];
            $cnb = $chd +  $p_chd + $row_data['l_cnb'];
            $inf = $inf +  $p_inf + $row_data['l_inf'];
        }
    }
} else {
}
$twn_sp = get_pembulatan($twn);
$twn_rp = json_decode($twn_sp, true);

$sgl_sp = get_pembulatan($sgl);
$sgl_rp = json_decode($sgl_sp, true);

$cnb_sp = get_pembulatan($cnb);
$cnb_rp = json_decode($cnb_sp, true);

$inf_sp = get_pembulatan($inf);
$inf_rp = json_decode($inf_sp, true);
?>
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    PAKET TOUR: <?php echo $judul ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">CODE</div>
                        <div class="col-md-9">: <?php echo $code ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">CONTINENT</div>
                        <div class="col-md-9">: <?php echo $continent ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">COUNTRY</div>
                        <div class="col-md-9">: <?php echo $country ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">CITY</div>
                        <div class="col-md-9">: <?php echo $city ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">PAX</div>
                        <div class="col-md-9">: <?php echo $pax ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">TWIN</div>
                        <div class="col-md-9">: <?php echo number_format($twn_rp['value'], 0, ",", ".") ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">SGL</div>
                        <div class="col-md-9">: <?php echo number_format($sgl_rp['value'], 0, ",", ".") ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">CNB</div>
                        <div class="col-md-9">: <?php echo number_format($cnb_rp['value'], 0, ",", ".") ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">INF</div>
                        <div class="col-md-9">: <?php echo number_format($inf_rp['value'], 0, ",", ".") ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">EXPIRED</div>
                        <div class="col-md-9">: <?php echo $exp ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    TRANSPORT PT
                </div>
                <div class="card-body">
                    <?php
                    $query2 = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['copy_id'] . "' order by hari ASC, urutan ASC";
                    $rs2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_array($rs2);
                   
                    if ($row2['id'] != "") {
                        $query_tr = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['copy_id'] . "' order by hari ASC, urutan ASC";
                        $rs_tr = mysqli_query($con, $query_tr);
                        
                        while ($row_tr = mysqli_fetch_array($rs_tr)) {
                            if ($row_tr['type'] == '1') {
                                $type = "Flight";

                                $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $row_tr['transport'];
                                $rsflight = mysqli_query($con, $queryflight);
                                $rowflight = mysqli_fetch_array($rsflight);
                                $detail = $type . " : " . $rowflight['maskapai'] . " | " . $rowflight['tgl'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ")";
                                ?>
                                <div class="row">
                                    <div class="col-md-12"><?php echo $detail ?></div>
                                </div>
                        <?php
                            } else if ($row['type'] == '2') {
                                $type = "Ferry";
                                $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row['transport'];
                                $rs_ferry = mysqli_query($con, $query_ferry);
                                $row_ferry = mysqli_fetch_array($rs_ferry);
                                $detail = $type . " : " . $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ") " . $row_ferry['type'];
                                ?>
                                <div class="row">
                                    <div class="col-md-12"><?php echo $detail ?></div>
                                </div>
                        <?php
                            } else if ($row['type'] == '4') {
                                $type = "Train";
                                $query_train = "SELECT * FROM train_LTnew where id=" . $row['transport'];
                                $rs_train = mysqli_query($con, $query_train);
                                $row_train = mysqli_fetch_array($rs_train);

                                $detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
                                ?>
                                <div class="row">
                                    <div class="col-md-12"><?php echo $detail ?></div>
                                </div>
                        <?php
                            } else {
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>