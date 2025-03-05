<html>

<head>
    <title>Priview Itinerary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php

include "../site.php";
include "../db=connection.php";
include "Api_LT_total.php";
?>
<?php
$data = $_GET['id'];
$query_data = "SELECT * FROM  LT_itinerary2 where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$json_day = $row_data['hari'];

$arr_all_fl = [];
$arr_all_fery = [];

$query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $_GET['id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
?>

<body>
    <div class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header">
                <div class="gmb">
                    <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: 1010px;">
                </div>
            </div>
        </div>
        
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

                $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $_GET['id'] . "' order by id DESC limit 1";
                $rs_main = mysqli_query($con, $query_main);
                $row_main = mysqli_fetch_array($rs_main);
                // var_dump($query_main);
                // while ($row_main = mysqli_fetch_array($rs_main)) {
                if ($row_main['img1'] != "") {
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
                if ($row_main['img2'] != "") {
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
                if ($row_main['img3'] != "") {
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
                if ($row_main['img4'] != "") {
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
        <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
            <?php echo $row_data['judul'] ?>
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
        // $arr_hl = [];
        for ($c = 1; $c <= $json_day; $c++) {
            $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_data['id'] . "' && hari='$x'";
            $rsRute = mysqli_query($con, $queryRute);
            $rowRute = mysqli_fetch_array($rsRute);
            $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row_data['id'] . "' && hari='$x'";
            $rsMeal = mysqli_query($con, $queryMeal);
            $rowMeal = mysqli_fetch_array($rsMeal);
            $b = "";
            $l = "";
            $d = "";
            if ($rowMeal['bf'] != '0') {
                $b = "Breakfast";
            }
            if ($rowMeal['ln'] != '0') {
                $l = "Lunch";
            }
            if ($rowMeal['dn'] != '0') {
                $d = "Dinner";
            }

        ?>
            <div class="content-itin" style="padding-bottom: 15px;">
                <div class="container">
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-9" style="font-weight: bold;">
                            <div>
                                <h5 style="margin: 0px; text-transform: uppercase;"><?php echo "DAY " . $x . " " . $rowRute['nama'] ?></h5>
                            </div>
                            <div style="font-weight: 9pt; color: gray; font-style: italic;"><?php echo $b . " " . $l . " " . $d ?></div>

                        </div>
                        <div class="col-3" style="text-align: right; font-weight: bold;">
                            <!-- <h3>04 JUN 2024</h3> -->
                        </div>
                    </div>
                    <!-- <div class="row" style="font-size: 9pt;">
                        <div class="col-6">
                            <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                            <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <div style="font-weight: bold; color: grey;">FERRY : BTC - HBF 19:00</div>
                            <div style="font-weight: bold; color: grey;">TRAIN : SHINKANSEN 300P 07:00</div>
                        </div>
                    </div> -->
                    <div class="tempat" style="font-size: 12pt;">
                        <div>
                            <p style="margin: 0px; text-align: justify;">
                                <?php
                                $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['id'] . "' && hari='$x' order by urutan ASC";
                                $rsTmp = mysqli_query($con, $queryTmp);
                                while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                    $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
                                    $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                    $row_tempat2 = mysqli_fetch_array($rs_tempat2);

                                    $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $row_data['id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp['urutan'] . "'";
                                    $rs_ops = mysqli_query($con, $query_ops);
                                    $row_ops = mysqli_fetch_array($rs_ops);
                                    if ($row_ops['id'] == "") {
                                        echo "<b>" . $row_tempat2['tempat2'] . "</b> " . $row_tempat2['keterangan'] . ", ";
                                    } else {
                                        // if ($row_ops['highlight'] == '1') {
                                        //     array_push($arr_hl,  $row_tempat2['tempat']);
                                        // }
                                        if ($row_ops['optional'] == '1') {
                                            echo "<b> [ Optional ] " . $row_tempat2['tempat2'] . "</b> " . $row_tempat2['keterangan'] . ", ";
                                        } else {
                                            echo "<b>" . $row_tempat2['tempat2'] . "</b> " . $row_tempat2['keterangan'] . ", ";
                                        }
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="hotel">
                        <?php
                        $queryHotel = "SELECT * FROM  LT_add_pilihHotel where tour_id='" . $row_data['id'] . "' && hari='$x'";
                        $rsHotel = mysqli_query($con, $queryHotel);
                        $rowHotel = mysqli_fetch_array($rsHotel);
                        if ($rowHotel['hotel'] == "1") {
                            echo "<b>HOTEL : Hotel Name TBA </b>";
                        }
                        ?>
                    </div>
                    <div class="gambar" style="padding: 10px;">
                        <div class="row">
                            <?php
                            $query_sel = "SELECT * FROM  selected_img_tmp where tour_id ='" . $row_data['id'] . "' && hari='" . $x . "' limit 3";
                            $rs_sel = mysqli_query($con, $query_sel);
                            // var_dump($query_sel);
                            while ($row_sel = mysqli_fetch_array($rs_sel)) {
                                $query_stmp = "SELECT List_tempat_img.id ,List_tempat_img.link,List_tempat_img.summer_img,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM List_tempat_img LEFT JOIN List_tempat ON List_tempat_img.tmp_id=List_tempat.id where List_tempat_img.tmp_id='" . $row_sel['tmp'] . "'";
                                $rs_stmp = mysqli_query($con, $query_stmp);
                                $row_stmp = mysqli_fetch_array($rs_stmp);

                                $p = $row_sel['tmp_type'];
                                $link = $row_stmp[$p];
                                $headers = explode('/', $link);
                                $thumbnail = $headers[5];
                                if ($link != "") {
                            ?>
                                    <div class="col-4" style="text-align: center;">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="300px" height="200px">
                                        <div style="font-style: italic; text-align: center; font-size: 9pt;"><?php echo $row_stmp['tempat'] ?></div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <!-- <div class="col-4">
                                <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                                <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                            </div>
                            <div class="col-4">
                                <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                                <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        <?php

            $x++;
        }
        ?>
        <div style="padding-top: 20px;"></div>
        <div style="padding-top: 20px;"></div>
        <?php
        $query_lt = "SELECT * FROM LT_itinnew where kode='" . $row_data['landtour'] . "'";
        $rs_lt = mysqli_query($con, $query_lt);
        $row_lt = mysqli_fetch_array($rs_lt);
        // var_dump($query_lt);
        if ($row_data['landtour'] != "undefined") {
        ?>
            <div style="padding: 5px 20px; font-size: 12pt;">
                <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $row_lt['kota'] ?></div>
                <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $row_lt['judul']; ?></div>
                <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $row_lt['kode']; ?></div>
                <div>
                    <table class="table table-bordered table-sm" style="border-color: black;">
                        <thead>
                            <tr>
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
                            $query_lt2 = "SELECT * FROM  LT_itinnew where kode = '" . $row_lt['kode'] . "'";
                            $rs_lt2 = mysqli_query($con, $query_lt2);
                            // var_dump($query_lt2);
                            while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
                                $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_lt2['agent_twn'] . "' && price2 >='" . $row_lt2['agent_twn'] . "'";
                                $rs_profit = mysqli_query($con, $sql_profit);
                                $row_profit = mysqli_fetch_array($rs_profit);
                                $tambahan = $row_lt2['agent_twn'] * $row_profit['adm_mkp']  / 100;

                                $pr = 0;
                                if ($row_profit['id'] != "") {
                                    $pr = $row_profit['profit'];
                                } else {
                                    $pr = 5;
                                }
                                $twin = ($row_lt2['agent_twn'] * $pr / 100) + $row_lt2['agent_twn'] + $tambahan;
                                $chd = ($row_lt2['agent_cnb'] * $pr / 100) + $row_lt2['agent_cnb'] + $tambahan;
                                $inf = ($row_lt2['agent_inf'] * $pr / 100) + $row_lt2['agent_inf'] + $tambahan;
                                $sgl = ($row_lt2['agent_sgl'] * $pr / 100) + $row_lt2['agent_sgl'] + $tambahan;

                                $twn_sp = get_pembulatan($twin);
                                $twn_rp = json_decode($twn_sp, true);

                                $sgl_sp = get_pembulatan($sgl);
                                $sgl_rp = json_decode($sgl_sp, true);

                                $cnb_sp = get_pembulatan($chd);
                                $cnb_rp = json_decode($cnb_sp, true);

                                $inf_sp = get_pembulatan($inf);
                                $inf_rp = json_decode($inf_sp, true);

                                if ($row_lt2['twn'] != "") {
                                    $tanda2 = "";
                                    $tanda3 = "";
                                    $tanda4 = "";
                                    $tanda5 = "";
                                    if ($row_lt2['hotel2'] != "") {
                                        $tanda2 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                    }
                                    if ($row_lt2['hotel3'] != "") {
                                        $tanda3 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                    }
                                    if ($row_lt2['hotel4'] != "") {
                                        $tanda4 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                    }
                                    if ($row_lt2['hotel5'] != "") {
                                        $tanda5 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
                                    }
                            ?>
                                    <tr>
                                        <td><?php
                                            echo  $row_lt2['hotel1'] . $tanda2 . $row_lt2['hotel2'] . $tanda3 . $row_lt2['hotel3'] . $tanda4 . $row_lt2['hotel4'] . $tanda5 . $row_lt2['hotel5'];

                                            ?></td>
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
                                        <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                        <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                                        <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                                        <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                                        <td><?php echo $row_lt2['expired'] ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        }
        ?>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-6">
                    <?php
                    if ($arr_all_fl != null) {
                    ?>
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
                <div class="col-4">
                    <!-- <?php
                            if ($arr_all_fery != null) {
                            ?>
                        <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                            <thead>
                                <tr>
                                    <th scope="col">Transport</th>
                                    <th scope="col">Adult</th>
                                    <th scope="col">Child</th>
                                    <th scope="col">Infant</th>
                                    <th scope="col">Senior</th>
                                </tr>
                                <?php
                                $t_a = 0;
                                $t_c = 0;
                                $t_i = 0;
                                foreach ($arr_all_fery as $val_fery) {
                                    $t_a = $t_a + intval($val_fery['adt']);
                                    $t_c = $t_c + intval($val_fery['chd']);
                                    $t_i = $t_i + intval($val_fery['inf']);
                                    $t_s = $t_s + intval($val_fery['snr']);
                                    // var_dump($val_fl);
                                ?>
                                    <tr>
                                        <td scope="col"><?php echo "<b>Ferry :</b>" . $val_fery['detail'] ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['adt'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['chd'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['inf'], 0, ",", ".") ?></td>
                                        <td scope="col"><?php echo  number_format($val_fery['snr'], 0, ",", ".") ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Total /Pax</th>
                                    <th><?php echo number_format($t_a, 0, ",", ".") ?></th>
                                    <th><?php echo number_format($t_c, 0, ",", ".") ?></th>
                                    <th><?php echo number_format($t_i, 0, ",", ".") ?></th>
                                    <th><?php echo number_format($t_s, 0, ",", ".") ?></th>

                                </tr>
                            </tbody>
                        </table>
                    <?php
                            }
                    ?> -->

                </div>
            </div>
        </div>
        <div style="padding-top: 20px;"></div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-6">
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
                            <li>Hotel</li>
                            <li>Meal Sesuai Jadwal</li>
                            <li>Tour Admission</li>
                            <li>Driver merangkap Guide Atau</li>
                            <li>Jasa Pendampingan Guide</li>
                            <li>Tour Leader Berbahasa Indonesia</li>
                            <li>Souvenir cantik</li>
                        </ul>
                    </div>

                </div>
                <div class="col-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TIDAK TERMASUK : </u></div>
                    <div>
                        <?php
                        $query_incx = "SELECT * FROM  Prev_Exclude_LT where id_LT=" . $_GET['id'];
                        $rs_incx = mysqli_query($con, $query_incx);
                        $row_incx = mysqli_fetch_array($rs_incx);
                        $datax = json_decode($row_incx['exclude'], true);

                        ?>
                        <ul>
                            <li>Tiket Pesawat International , Tax & Fuel Surcharge</li>
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
                <u><b>HIGHLIGHT :</b></u>
            </div>
            <div>
                <?php
                $hl_i = 0;
                $hl_d = "";
                foreach ($arr_hl as $value_hl) {
                    $hl_i++;
                    $hl_d .= $value_hl . ", ";
                }
                echo $hl_d;
                ?>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div style="font-size: 12pt;">
                <u><b>DEPOSIT, PEMBAYARAN & PEMBATALAN :</b></u>
            </div>
            <div>
                <div>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour . No Refund/pengembalian jika ada pembatalan dari peserta</div>
                <div>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour</div>
                <div>Travel Agent tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya untuk berangkat da</div>
                <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
                <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
                <div>Travel Agent berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Travel Agent sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
            </div>
        </div>

    </div>

</body>
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

</html>