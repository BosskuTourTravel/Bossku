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

include "../site.php";
include "../db=connection.php";
include "Api_total.php";
?>
<?php
$data = $_GET['id'];
$query_data = "SELECT * FROM  Prev_makeLT where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query_tt = "SELECT * FROM  LT_Perhitungan where id=" . $_GET['tt'];
$rs_tt = mysqli_query($con, $query_tt);
$row_tt = mysqli_fetch_array($rs_tt);
// var_dump($row_tt);
$val_pilihan = json_decode($row_tt['pilihan']);



$datareq = array(
    "tour_id" => $_GET['id'],
    "lt_id" => $_GET['tt'],
    "cabang" => $_GET['cabang']
);
// var_dump($val_pilihan);
$show_total = get_total($datareq);
$result_show_total = json_decode($show_total, true);
// var_dump($result_show_total);

$val_data = json_decode($row_data['data'], true);

// var_dump($val_data['day']);
$json_day = $val_data['day'];
$arr_all_fl = [];
$arr_all_fery = [];

?>

<body>
    <div class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header">
                <div class="gmb">
                    <img src="dist/img/header_performa.png" alt="header">
                </div>
            </div>
        </div>
        <div style="padding: 20px;">
            <div class="row">
                <?php
                if ($val_data['gambar'][0]['filename'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $val_data['gambar'][0]['filename'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
                <?php
                if ($val_data['gambar'][1]['filename'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php

                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $val_data['gambar'][1]['filename'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
                <?php
                if ($val_data['gambar'][2]['filename'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $val_data['gambar'][2]['filename'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
                <?php
                if ($val_data['gambar'][3]['filename'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $val_data['gambar'][3]['filename'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
            <?php echo $val_data['judul'] ?>
            <?php echo  $result_show_total['data'] ?>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <!-- loop day disini -->
            <?php
            $x = 1;
            $tt = 0;
            foreach ($json_day as $loop_day) {
            ?>
                <div class="row">
                    <div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $x ?></u></div>
                    <div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                        <div style="font-size: 14pt;"><u><b><?php echo $loop_day['rute'] ?></b></u>
                            <?php
                            if ($loop_day['guest_breakfast'] != "" or $loop_day['guest_lunch'] != "" or $loop_day['guest_dinner'] != "") {
                                $b = "";
                                $l = "";
                                $d = "";
                                if ($loop_day['guest_breakfast'] != "") {
                                    $b = "B";
                                }
                                if ($loop_day['guest_lunch'] != "") {
                                    $l = "L";
                                }
                                if ($loop_day['guest_dinner'] != "") {
                                    $d = "D";
                                }
                                echo "(" . $b . $l . $d . ")";
                            }
                            ?>
                        </div>
                        <!-- class tempat -->
                        <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
                            <?php
                            $query_addflight = "SELECT * FROM LT_add_flight  where tour_id='" . $_GET['id'] . "' && ket=" . $_GET['cabang'];
                            // var_dump($query_addflight);
                            $rs_addflight = mysqli_query($con, $query_addflight);
                            while ($row_addflight = mysqli_fetch_array($rs_addflight)) {
                                $value_add = json_decode($row_addflight['value'], TRUE);

                                foreach ($value_add as $loop_add) {
                                    if ($loop_add['hari'] == $x && $loop_add['jml_transport'] != "") {

                                        foreach ($loop_add['sel_trans'] as $sel_tr) {
                                            if ($sel_tr['transport_type'] == "flight") {
                                                $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                                                $rs_flight2 = mysqli_query($con, $query_flight2);
                                                $row_flight2 = mysqli_fetch_array($rs_flight2);
                                                $detail2 = $row_flight2['maskapai'] . " " . $row_flight2['dept'] . "-" . $row_flight2['arr'] . " " . $row_flight2['tgl'] . " " . $row_flight2['take'] . "-" . $row_flight2['landing'];
                                                array_push($arr_all_fl, array("detail" => $detail2, "adt" => $row_flight2['adt'], "chd" => $row_flight2['chd'], "inf" => $row_flight2['inf']));
                            ?>
                                                <div style="font-weight: bold;">
                                                    <i class="fa fa-plane" style="padding-right: 10px;"></i><?php echo  $sel_tr['transport_type'] . " : " . $detail2 ?>
                                                </div>
                                            <?php
                                            } else if ($sel_tr['transport_type'] == "ferry") {
                                                $query_ferry = "SELECT * FROM ferry_LT  where id=" . $sel_tr['transport_name'];
                                                $rs_ferry = mysqli_query($con, $query_ferry);
                                                $row_ferry = mysqli_fetch_array($rs_ferry);
                                                $detail2 = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                                array_push($arr_all_fery, array("detail" => $detail2, "adt" => $row_ferry['adult'], "chd" => $row_ferry['child'], "inf" => $row_ferry['infant'], "snr" => $row_ferry['senior']));
                                            ?>
                                                <div style="font-weight: bold;">
                                                    <i class="fa fa-ship" style="padding-right: 10px;"></i><?php echo  $sel_tr['transport_type'] . " : " . $detail2 ?>
                                                </div>
                                            <?php
                                            } else {
                                            }
                                            ?>

                                        <?php
                                            // var_dump($loop_add['hari']);
                                        }
                                    }
                                }
                            }


                            foreach ($loop_day['sel_trans'] as $val_pilihan) {
                                if ($val_pilihan['type'] == '1') {

                                    if ($val_pilihan['transport_type'] == "flight") {

                                        $query_flight = "SELECT * FROM flight_LTnew  where id=" . $val_pilihan['transport_name'];
                                        $rs_flight = mysqli_query($con, $query_flight);
                                        $row_flight = mysqli_fetch_array($rs_flight);
                                        // var_dump($rs_flight['id']);
                                        if ($row_flight['id'] == null) {
                                            $detail = "";
                                        } else {

                                            $detail = $row_flight['maskapai'] . " " . $row_flight['dept'] . "-" . $row_flight['arr'] . " " . $row_flight['tgl'] . " " . $row_flight['take'] . "-" . $row_flight['landing'];
                                        ?>
                                            <div style="font-weight: bold;">
                                                <i class="fa fa-plane" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $detail ?>
                                            </div>
                                        <?php
                                            array_push($arr_all_fl, array("detail" => $detail, "adt" => $row_flight['adt'], "chd" => $row_flight['adt'], "inf" => $row_flight['chd'], "inf" => $row_flight['inf']));
                                        }
                                        ?>

                                    <?php
                                    } else if ($val_pilihan['transport_type'] == "ferry") {
                                    ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-ship" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                                        </div>
                                    <?php
                                    } else if ($val_pilihan['transport_type'] == "land") {
                                        $query_land = "SELECT * FROM Transport_new  where id=" . $val_pilihan['transport_name'];
                                        $rs_land = mysqli_query($con, $query_land);
                                        $row_land = mysqli_fetch_array($rs_land);
                                        $land_detail = "";
                                        if ($val_pilihan['rent_type'] == "ow") {
                                            $land_detail = "One Way";
                                        } else if ($val_pilihan['rent_type'] == "tw") {
                                            $land_detail = "Two Way";
                                        } else if ($val_pilihan['rent_type'] == "hd1") {
                                            $land_detail = "Half Day 1";
                                        } else if ($val_pilihan['rent_type'] == "hd2") {
                                            $land_detail = "half Day 2";
                                        } else if ($val_pilihan['rent_type'] == "fd1") {
                                            $land_detail = "Full Day 1";
                                        } else if ($val_pilihan['rent_type'] == "fd2") {
                                            $land_detail = "Full Day 2";
                                        } else if ($val_pilihan['rent_type'] == "kaisoda") {
                                            $land_detail = "Kaisoda";
                                        } else if ($val_pilihan['rent_type'] == "luarkota") {
                                            $land_detail = "Luar Kota";
                                        }


                                    ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-bus" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $row_land['city'] . " " . $row_land['trans_type'] . " " . $land_detail . "(" . $row_land['seat'] . ")" ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-train" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                <?php
                                } else {
                                    //  var_dump($val_pilihan['tujuan']);
                                    $query_tmp = "SELECT * FROM  List_tempat where id='" . $val_pilihan['tujuan'] . "'";
                                    $rs_tmp = mysqli_query($con, $query_tmp);
                                    $row_tmp = mysqli_fetch_array($rs_tmp);
                                ?>
                                    <div style="padding-left: 20px;">
                                        <b><?php echo strtoupper($row_tmp['tempat']) . " " ?></b><?php echo $row_tmp['keterangan'] ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                        if ($loop_day['guest_hotel_name'] != "") {
                        ?>
                            <div style="font-weight: bold; font-size: 12pt;">
                                <div class="row">
                                    <div class="col-md-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                    <div class="col-md-9">: <?php echo $loop_day['guest_hotel_name'] ?></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div style="padding:2px"></div>
            <?php
                $x++;
                $tt++;
            }
            ?>
        </div>
        <div style="padding-top: 20px;"></div>
        <div style="padding-top: 20px;"></div>
        <?php
        $query_lt = "SELECT * FROM LT_itinnew where id=" . $row_tt['lt_id'];
        $rs_lt = mysqli_query($con, $query_lt);
        $row_lt = mysqli_fetch_array($rs_lt);
        if ($val_data['landtour_name'] != "") {
        ?>
            <div style="padding: 5px 20px; font-size: 12pt;">
                <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $row_lt['kota']; ?></div>
                <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $row_lt['judul']; ?></div>
                <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $row_lt['kode']; ?></div>
                <div style="font-weight: bold;">Biaya Tour Dalam Rupiah (IDR)</div>
                <div>
                    <table class="table table-bordered table-sm" style="border-color: black;">
                        <thead>
                            <tr>
                                <th scope="col">Keberangkatan</th>
                                <th scope="col">Hotel Name</th>
                                <th scope="col">Total Pax</th>
                                <th scope="col">Twin</th>
                                <th scope="col">Single</th>
                                <th scope="col">CNB</th>
                                <th scope="col">Infant</th>
                                <th scope="col">Expired</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_lt2 = "SELECT * FROM  LT_itinnew where id =" . $row_lt['id'];
                            $rs_lt2 = mysqli_query($con, $query_lt2);
                            while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
                                $tanda2 = "";
                                $tanda3 = "";
                                $tanda4 = "";
                                $tanda5 = "";
                                if ($row_lt['hotel2'] != "") {
                                    $tanda2 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                }
                                if ($row_lt['hotel3'] != "") {
                                    $tanda3 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                }
                                if ($row_lt['hotel4'] != "") {
                                    $tanda4 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                }
                                if ($row_lt['hotel5'] != "") {
                                    $tanda5 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                }
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo  $row_lt['hotel1'] . $tanda2 . $row_lt['hotel2'] . $tanda3 . $row_lt['hotel3'] . $tanda4 . $row_lt['hotel4'] . $tanda5 . $row_lt['hotel5']; ?></td>
                                    <td><?php
                                        $pax_u = "";
                                        $pax_b = "";
                                        if ($row_lt2['pax_u'] != 0) {
                                            $pax_u = "-" . $row_lt2['pax_u'];
                                        }
                                        if ($row_lt2['pax_b'] != 0) {
                                            $pax_b = "+" . $row_lt2['pax_b'];
                                        }
                                        echo $row_lt2['pax'] . $pax_u . $pax_b ?></td>
                                    <td><?php echo "Rp." . number_format($result_show_total['twn'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($result_show_total['sgl'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($result_show_total['cnb'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($result_show_total['cnb'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="text-align: center; font-weight: bold; font-size: 14pt;">HARGA TERMASUK TAX & FUEL SURCHARGE</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php
        }
        ?>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $query_tps = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "'";
                    $rs_tps = mysqli_query($con, $query_tps);
                    $row_tps = mysqli_fetch_array($rs_tps);
                    // var_dump($query_tps);

                    if ($row_tps['id'] != "") {
                        $total = 0;
                        if ($row_tps['until_pax'] == '0') {
                            if ($row_lt['pax'] >= $row_tps['tt_pax']) {
                    ?>
                                <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tips Guide</th>
                                            <th scope="col">Tips Assistant Guide</th>
                                            <th scope="col">Tips Driver</th>
                                            <th scope="col">Tips Porter</th>
                                            <th scope="col">Tips Restaurant</th>
                                        </tr>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <?php
                                                if ($row_tps['guide'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $guide = $row_tps['guide'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $guide,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' &&  tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $guide = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['guide'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $guide = $guide + $vg;
                                                            }
                                                            $total = $total + $guide;
                                                            echo  number_format(ceil($guide), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['ass'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $ass = $row_tps['ass'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $ass,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $ass = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['ass'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $ass = $ass + $vg;
                                                            }
                                                            $total = $total + $ass;
                                                            echo  number_format(ceil($ass), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['driver'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $driver = $row_tps['driver'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $driver,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $guide = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['guide'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $guide = $guide + $vg;
                                                            }
                                                            $total = $total + $guide;
                                                            echo  number_format(ceil($guide), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['porter'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $porter = $row_tps['porter'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $porter,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $porter = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['porter'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $porter = $porter + $vg;
                                                            }
                                                            $total = $total + $porter;
                                                            echo  number_format(ceil($porter), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['restaurant'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $restaurant = $row_tps['restaurant'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $restaurant,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $restaurant = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['restaurant'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $restaurant = $restaurant + $vg;
                                                            }
                                                            $total = $total + $restaurant;
                                                            echo  number_format(ceil($restaurant), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" style="text-align: center;">TOTAL TIPS IDR : <?php echo number_format(ceil($total), 0, ",", ".") ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php

                            } else {
                            }
                        } else {
                            if ($row_lt['pax'] >= $row_tps['tt_pax'] && $row_lt['pax'] <= $row_tps['until_pax']) {
                            ?>
                                <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tips Guide</th>
                                            <th scope="col">Tips Assistant Guide</th>
                                            <th scope="col">Tips Driver</th>
                                            <th scope="col">Tips Porter</th>
                                            <th scope="col">Tips Restaurant</th>
                                        </tr>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <?php
                                                if ($row_tps['guide'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $guide = $row_tps['guide'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $guide,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' &&  tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $guide = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['guide'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $guide = $guide + $vg;
                                                            }
                                                            $total = $total + $guide;
                                                            echo  number_format(ceil($guide), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['ass'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $ass = $row_tps['ass'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $ass,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $ass = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['ass'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $ass = $ass + $vg;
                                                            }
                                                            $total = $total + $ass;
                                                            echo  number_format(ceil($ass), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['driver'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $driver = $row_tps['driver'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $driver,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $guide = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['guide'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $guide = $guide + $vg;
                                                            }
                                                            $total = $total + $guide;
                                                            echo  number_format(ceil($guide), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['porter'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $porter = $row_tps['porter'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $porter,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $porter = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['porter'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $porter = $porter + $vg;
                                                            }
                                                            $total = $total + $porter;
                                                            echo  number_format(ceil($porter), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($row_tps['restaurant'] != '0') {
                                                    if ($row_tps['type'] == 'A') {
                                                        $restaurant = $row_tps['restaurant'] * $tt;
                                                        $datareq = array(
                                                            "kurs" => $row_tps['kurs'],
                                                            "nominal" => $restaurant,
                                                        );
                                                        $show_total = get_kurs($datareq);
                                                        $result_show_total = json_decode($show_total, true);
                                                        $total = $total + $result_show_total['data'];
                                                        echo  number_format(ceil($result_show_total['data']), 0, ",", ".");
                                                    } else {
                                                        if ($row_tps['tour_code'] != "") {
                                                            $query_tps2 = "SELECT * FROM tips_LT where agent='" . $row_lt['agent'] . "' && negara='" . $row_lt['negara'] . "' && tour_code='" . $row_tps['tour_code'] . "'";
                                                            $rs_tps2 = mysqli_query($con, $query_tps2);
                                                            $restaurant = 0;
                                                            while ($row_tps2 = mysqli_fetch_array($rs_tps2)) {
                                                                $vg = $row_tps2['restaurant'] * $row_tp2['tt_hari'];
                                                                $datareq = array(
                                                                    "kurs" => $row_tps2['kurs'],
                                                                    "nominal" => $vg,
                                                                );
                                                                $show_total = get_kurs($datareq);
                                                                $result_show_total = json_decode($show_total, true);
                                                                $restaurant = $restaurant + $vg;
                                                            }
                                                            $total = $total + $restaurant;
                                                            echo  number_format(ceil($restaurant), 0, ",", ".");
                                                        }
                                                    }
                                                }
                                                ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" style="text-align: center;">TOTAL TIPS IDR : <?php echo number_format(ceil($total), 0, ",", ".") ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                    <?php
                            } else {
                            }
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if ($arr_all_fl != null) {

                    ?>
                        <div><b>FLIGHT DETAILS DAPAT BERUBAH SEWAKTU-WAKTU</b></div>
                        <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                            <thead>
                                <tr>
                                    <th scope="col">Transport</th>
                                    <!-- <th scope="col">Adult</th>
                                    <th scope="col">Child</th>
                                    <th scope="col">Infant</th>
                                    <th scope="col">Senior</th> -->
                                </tr>
                                <?php
                                $t_a = 0;
                                $t_c = 0;
                                $t_i = 0;
                                $t_s = 0;
                                foreach ($arr_all_fl as $val_fl) {
                                    $t_a = $t_a + intval($val_fl['adt']);
                                    $t_c = $t_c + intval($val_fl['chd']);
                                    $t_i = $t_i + intval($val_fl['inf']);
                                    $t_s = $t_s + intval($val_fl['adt']);
                                    // var_dump($val_fl);
                                ?>
                                    <tr>
                                        <td scope="col"><?php echo "<b>Flight : </b>" . $val_fl['detail'] ?></td>
                                        <!-- <td scope="col"><?php echo  number_format($val_fl['adt'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fl['chd'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fl['inf'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fl['adt'], 0, ",", ".") ?></td> -->
                                    </tr>
                                <?php
                                }
                                foreach ($arr_all_fery as $val_fery) {
                                    $t_a = $t_a + intval($val_fery['adt']);
                                    $t_c = $t_c + intval($val_fery['chd']);
                                    $t_i = $t_i + intval($val_fery['inf']);
                                    $t_s = $t_s + intval($val_fery['snr']);
                                    // var_dump($val_fl);
                                ?>
                                    <tr>
                                        <td scope="col"><?php echo "<b>Ferry : </b>" . $val_fery['detail'] ?></td>
                                        <!-- <td scope="col"><?php echo  number_format($val_fery['adt'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['chd'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['inf'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['snr'], 0, ",", ".") ?></td> -->
                                    </tr>
                                <?php
                                }
                                ?>
                            </thead>
                            <!-- <tbody>
                                <tr>
                                    <th>Total /Pax</th>
                                    <th><?php echo number_format($t_a, 0, ",", ".") ?></th>
                                    <th><?php echo number_format($t_c, 0, ",", ".") ?></th>
                                    <th><?php echo number_format($t_i, 0, ",", ".") ?></th>
                                    <th><?php echo number_format($t_s, 0, ",", ".") ?></th>

                                </tr>
                            </tbody> -->
                        </table>
                    <?php
                    }
                    ?>

                </div>
                <div class="col-md-6">
                    <div><B>NOTE :</B></div>
                    <div style="border: 2px solid #6c757d; height: 90%; width:90%;">

                    </div>
                </div>
            </div>
        </div>
        <div style="padding-top: 20px;"></div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-md-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TERMASUK : </u></div>
                    <div>
                        <?php
                        $query_inc = "SELECT * FROM  Prev_Include_LT where id_LT=" . $_GET['id'];
                        $rs_inc = mysqli_query($con, $query_inc);
                        $row_inc = mysqli_fetch_array($rs_inc);
                        $data = json_decode($row_inc['include'], true);


                        ?>
                        <ul>
                            <li>Acara Tour & Transportasi Sesuai Jadwal Berdasarkan Gabungan Tour</li>
                            <li>Tiket Pesawat International , Tax & Fuel Surcharge</li>
                            <li>Hotel sesuai atau setaraf dengan yang tertera di Itinerary</li>
                            <li>Meal Sesuai Jadwal</li>
                            <li>Tour Admission</li>
                            <li>Driver merangkap Guide Atau</li>
                            <li>Jasa Pendampingan Guide</li>
                            <li>Tour Leader Berbahasa Indonesia</li>
                            <li>Souvenir cantik</li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TIDAK TERMASUK : </u></div>
                    <div>
                        <?php
                        $query_incx = "SELECT * FROM  Prev_Exclude_LT where id_LT=" . $_GET['id'];
                        $rs_incx = mysqli_query($con, $query_incx);
                        $row_incx = mysqli_fetch_array($rs_incx);
                        $datax = json_decode($row_incx['exclude'], true);

                        ?>
                        <ul>
                            <li>Tips Guide</li>
                            <li>Tips Tour Leader</li>
                            <li>Porter dan Biaya Pribadi</li>
                            <li>Visa</li>
                            <li>Asuransi Pariwisata</li>
                            <li>Modem Wifi</li>
                            <li>Documen : Passport</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div style="font-size: 12pt;">
                <u><b>DEPOSIT, PEMBAYARAN & PEMBATALAN :</b></u>
            </div>
            <div>
                <div>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour . No Refund/pengembalian jika ada pembatalan dari peserta</div>
                <div>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour</div>
                <div>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya untuk berangkat da</div>
                <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
                <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
                <div>Performa Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
            </div>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>