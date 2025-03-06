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
include "Api_LT_total_baru.php";

$arr_num = explode(",", $_POST['num_pax']);

$data = $_GET['tour_id'];
$query_data = "SELECT * FROM  LT_itinerary2 where id=" . $_GET['tour_id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$queryTmp_set = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['id'] . "'";
$rsTmp_set = mysqli_query($con, $queryTmp_set);

$arr_hl = [];
while ($row_tmp_set = mysqli_fetch_array($rsTmp_set)) {

    $query_ops_set = "SELECT * FROM LT_add_ops where master_id='" .  $row_data['id'] . "' && hari='" . $row_tmp_set['hari'] . "' && urutan='" . $row_tmp_set['urutan'] . "'";
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

$query_lt = "SELECT * FROM LT_itinnew where kode='" . $row_data['landtour'] . "'";
$rs_lt = mysqli_query($con, $query_lt);
$row_lt = mysqli_fetch_array($rs_lt);

$data_guide = array(
    "master_id" => $row_data['id'],
    "copy_id" => $_GET['tour_id'],
    "check_id" => '26'
);

$show_guide = get_total($data_guide);
$result_guide = json_decode($show_guide, true);
$guide_price = "";
if ($result_guide['adt'] != 0) {
    $guide_price = "Rp." . number_format($result_guide['adt'], 0, ",", ".");
}

$json_day = $row_data['hari'];



$query_guide2 = "SELECT * FROM  LT_add_guide_price  where tour_id='" . $_GET['tour_id'] . "' && package_id='" . $_GET['id'] . "'";
$rs_guide2 = mysqli_query($con, $query_guide2);
// var_dump($query_guide2);
$n = 1;
$grand_guide2 = 0;
$grand_foc = 0;
while ($row_guide2 = mysqli_fetch_array($rs_guide2)) {
    $fee_price2 = 0;
    $sfee_price2 = 0;
    $bf_price2 = 0;
    $ln_price2 = 0;
    $dn_price2 = 0;
    $vt_price2 = 0;

    $query_fee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['fee'] . "'";
    $rs_fee2 = mysqli_query($con, $query_fee2);
    $row_fee2 = mysqli_fetch_array($rs_fee2);
    if (isset($row_fee2['id'])) {
        $data_fee2 = array(
            "kurs" =>  $row_fee2['kurs'],
            "price" => $row_fee2['harga'],
        );
        $show_fee2 = get_rate($data_fee2);
        $result_fee2 = json_decode($show_fee2, true);

        $fee_price2 = $result_fee2['price'];
    }

    $query_sfee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['sfee'] . "'";
    $rs_sfee2 = mysqli_query($con, $query_sfee2);
    $row_sfee2 = mysqli_fetch_array($rs_sfee2);
    if (isset($row_sfee2['id'])) {
        $data_sfee2 = array(
            "kurs" =>  $row_sfee2['kurs'],
            "price" => $row_sfee2['harga'],
        );
        $show_sfee2 = get_rate($data_sfee2);
        $result_sfee2 = json_decode($show_sfee2, true);
        $sfee_price2 = $result_sfee2['price'];
    }

    $query_bf2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['bf'] . "'";
    $rs_bf2 = mysqli_query($con, $query_bf2);
    $row_bf2 = mysqli_fetch_array($rs_bf2);
    if (isset($row_bf2['id'])) {
        $data_bf2 = array(
            "kurs" =>  $row_bf2['kurs'],
            "price" => $row_bf2['harga'],
        );
        $show_bf2 = get_rate($data_bf2);
        $result_bf2 = json_decode($show_bf2, true);

        $bf_price2 = $result_bf2['price'];
    }

    $query_ln2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['ln'] . "'";
    $rs_ln2 = mysqli_query($con, $query_ln2);
    $row_ln2 = mysqli_fetch_array($rs_ln2);
    if (isset($row_ln2['id'])) {
        $data_ln2 = array(
            "kurs" =>  $row_ln2['kurs'],
            "price" => $row_ln2['harga'],
        );
        $show_ln2 = get_rate($data_ln2);
        $result_ln2 = json_decode($show_ln2, true);
        $ln_price2 = $result_ln2['price'];
    }

    $query_dn2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['dn'] . "'";
    $rs_dn2 = mysqli_query($con, $query_dn2);
    $row_dn2 = mysqli_fetch_array($rs_dn2);
    if (isset($row_dn2['id'])) {
        $data_dn2 = array(
            "kurs" =>  $row_dn2['kurs'],
            "price" => $row_dn2['harga'],
        );
        $show_dn2 = get_rate($data_dn2);
        $result_dn2 = json_decode($show_dn2, true);
        $dn_price2 = $result_dn2['price'];
    }

    $query_vt2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['vt'] . "'";
    $rs_vt2 = mysqli_query($con, $query_vt2);
    $row_vt2 = mysqli_fetch_array($rs_vt2);
    if (isset($row_vt2['id'])) {
        $data_vt2 = array(
            "kurs" =>  $row_vt2['kurs'],
            "price" => $row_vt2['harga'],
        );
        $show_vt2 = get_rate($data_vt2);
        $result_vt2 = json_decode($show_vt2, true);

        $vt_price2 = $result_vt2['price'];
    }

    $guide_total2 = $fee_price2 + $sfee_price2 + $bf_price2 + $ln_price2 + $dn_price2 + $vt_price2;
    $grand_guide2 = $grand_guide2 + $guide_total2;
    $grand_foc = $grand_foc + $bf_price2 + $ln_price2 + $dn_price2;
    // var_dump($fee_price2 ."+". $sfee_price2 ."+". $bf_price2 ."+". $ln_price2 ."+". $dn_price2 ."+". $vt_price2."</br>");
    // var_dump($grand_guide2."</br>");
}

//  var_dump($arr_hotel);

$query_rent2 = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package=" . $_GET['id'] . "  order by Rent_selected.id ASC";
$rs_rent2 = mysqli_query($con, $query_rent2);
$gt_rent = 0;
while ($row_rent2 = mysqli_fetch_array($rs_rent2)) {
    $datareq = array(
        "kurs" =>  $row_rent2['kurs'],
        "nominal" => $row_rent2['price'],
    );
    $adt_kurs = get_kurs($datareq);
    $rs_adt_kurs = json_decode($adt_kurs, true);
    // $gt_rent = $gt_rent + $rs_adt_kurs['data'];
       // profit rent
       if (isset($rs_adt_kurs['data'])) {

        $idr = $rs_adt_kurs['data'];
        $sql_profit = "SELECT * FROM LTR_profit_range where price1 <='" . $idr . "' && price2 >='" . $idr . "'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);
        if (isset($row_profit['id'])) {
            $pr = $row_profit['profit'];
        }
        $persen = intval($pr) / 100;
        $p_oneway = intval($idr) + (intval($idr) * $persen);
        $gt_rent = $gt_rent + $p_oneway;
        //  var_dump(intval($idr) ." + ". "(".intval($idr) ." * ". $persen.")");
    }
}


$arr_all_fl = [];
$arr_all_fery = [];
// $guest_meal = $_POST['val_guest_meal_price'];
// $adm_price = $_POST['val_adm_price'];

// var_dump("bagi = ".$bagi ." ".$val_guide_custom ." + ". $val_hotel_twn ." + ". $val_rent);
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

                $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $_GET['tour_id'] . "' order by id DESC limit 1";
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
            <H1 style="text-transform: uppercase;"><?php echo $row_data['judul'] ?></H1>
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

            $query_rent = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package='" . $_GET['id'] . "' && Rent_selected.status='" . $c . "'  order by Rent_selected.id ASC";
            $rs_rent = mysqli_query($con, $query_rent);
            $row_rent = mysqli_fetch_array($rs_rent);

            $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_data['id'] . "' && hari='$x'";
            $rsRute = mysqli_query($con, $queryRute);
            $rowRute = mysqli_fetch_array($rsRute);

            $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row_data['id'] . "' && hari='$x'";
            $rsMeal = mysqli_query($con, $queryMeal);
            $rowMeal = mysqli_fetch_array($rsMeal);
            $b = "";
            $l = "";
            $d = "";
            if (isset($rowMeal['id'])) {
                if ($rowMeal['bf'] != '0') {
                    $b = "Breakfast";
                }
                if ($rowMeal['ln'] != '0') {
                    $l = "Lunch";
                }
                if ($rowMeal['dn'] != '0') {
                    $d = "Dinner";
                }
            }

        ?>
            <div class="content-itin" style="padding-bottom: 15px;">
                <div class="container">
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-9" style="font-weight: bold;">
                            <div>
                                <h5 style="margin: 0px; text-transform: uppercase;"><?php echo "DAY " . $x . " " . $rowRute['nama'] ?></h5>
                            </div>
                            <!-- <div style="font-weight: 9pt; color: gray; font-style: italic;"><?php echo $b . " " . $l . " " . $d ?></div> -->

                        </div>
                        <div class="col-3" style="text-align: right; font-weight: bold;">
                            <!-- <h3>04 JUN 2024</h3> -->
                        </div>
                    </div>
                    <div class="row" style="font-size: 9pt;">
                        <div class="col-6">
                            <!-- <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                            <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div> -->
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <?php
                            if (isset($row_rent['id'])) {
                                $tipe = "";
                                if ($row_rent['tipe'] == "oneway") {
                                    $tipe = "One Way";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Two Way";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Half Day 1";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Half Day 2";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Full Day 1";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Full Day 2";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Kaisoda";
                                } else if ($row_rent['tipe']) {
                                    $tipe = "Luar Kota";
                                } else {
                                    $tipe = "";
                                }
                            ?>
                                <div style="font-weight: bold; color: grey;"><?php echo $row_rent['trans_type'] . " : " . $row_rent['seat'] . " Seat" . " / " . $tipe ?> </div>
                            <?php
                            }
                            ?>

                            <!-- <div style="font-weight: bold; color: grey;">TRAIN : SHINKANSEN 300P 07:00</div> -->
                        </div>
                    </div>
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
                                    if (!isset($row_ops['id'])) {
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
                        $query_hotel_data = "SELECT LAN_Hotel_List.*,hotel_lt.name,hotel_lt.city FROM LAN_Hotel_List INNER JOIN hotel_lt ON LAN_Hotel_List.hotel_id=hotel_lt.id  WHERE LAN_Hotel_List.master_id='" . $row_data['id'] . "' && LAN_Hotel_List.status='" . $_POST['guest_hotel'] . "' && hari='" . $c . "' order by LAN_Hotel_List.urutan ASC";
                        $rs_hotel_data = mysqli_query($con, $query_hotel_data);
                        while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
                            if (isset($row_hotel_data['id'])) {
                                echo "<b>HOTEL : " . $row_hotel_data['name'] . " , " . $row_hotel_data['city'] . "</b>";
                            } else {
                                $queryHotel = "SELECT * FROM  LT_add_pilihHotel where tour_id='" . $row_data['id'] . "' && hari='$x'";
                                $rsHotel = mysqli_query($con, $queryHotel);
                                $rowHotel = mysqli_fetch_array($rsHotel);
                                if (isset($rowHotel['id'])) {
                                    if ($rowHotel['hotel'] == "1") {
                                        echo "<b>HOTEL : Hotel Name TBA </b>";
                                    }
                                }
                            }
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
                        </div>
                    </div>

                </div>
            </div>
        <?php

            $x++;
        }
        ?>
        <div class="harga" style="padding: 10px 20px;">
            <div style="text-align: center; padding: 10px; font-weight: bold;">
                <h3>HARGA PAKET TOUR</h3>
            </div>
            <!-- <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $row_lt['kota'] ?></div>
            <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $row_lt['kode']; ?></div> -->
            <table class="table table-bordered table-sm" style="border-color: black;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hotel Name</th>
                        <th>Pax</th>
                        <th>Twin</th>
                        <th>Single</th>
                        <th>CNB</th>
                        <th>Infant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $batas = $_POST['num_pax'] - $_POST['guide'] - $_POST['foc'];
                    $no = 1;
                    for ($i = 1; $i <= $batas; $i++) {
                        $val_pax = "";
                        $pax_tour = $i;
                        $bagi = intval($i);
                        $val_pax .= $pax_tour . " Pax";
                        $val_guide = $grand_guide2 / $bagi;
                        $val_foc = $_POST['foc'] * ($grand_foc / $bagi);
                        $val_rent =  $gt_rent / $bagi;



                        if ($_POST['guide'] != '0') {
                            $val_pax .= " + " . $_POST['guide'] . " Guide";
                        }
                        if ($_POST['foc'] != '0') {
                            $val_pax .= " + " . $_POST['foc'] . " FOC";
                        }

                        $guest_meal = $_POST['val_guest_meal_price'];
                        $adm_price = $_POST['val_adm_price'];

                        $guide_adm = $_POST['guide'] * ($adm_price / $bagi);
                        $foc_adm = $_POST['foc'] * ($adm_price / $bagi);



                        // loop hotel disini /////////////
                        $query_pkg = "SELECT Hotel_Package.*,LAN_Hotel_List.hotel_id,LAN_Hotel_List.rate FROM Hotel_Package LEFT JOIN LAN_Hotel_List ON Hotel_Package.id=LAN_Hotel_List.status GROUP BY Hotel_Package.id order by Hotel_Package.nama ASC";
                        $rs_pkg = mysqli_query($con, $query_pkg);
                        while ($row_pkg = mysqli_fetch_array($rs_pkg)) {

                            if ($row_pkg['hotel_id'] != '') {

                                $arr_hotel = [];
                                $query_hotel_data2 = "SELECT LAN_Hotel_List.*,hotel_lt.name,hotel_lt.city FROM LAN_Hotel_List INNER JOIN hotel_lt ON LAN_Hotel_List.hotel_id=hotel_lt.id WHERE LAN_Hotel_List.master_id='" . $_GET['tour_id'] . "' && LAN_Hotel_List.status='" . $row_pkg['id'] . "'";
                                $rs_hotel_data2 = mysqli_query($con, $query_hotel_data2);
                                while ($row_hotel_data2 = mysqli_fetch_array($rs_hotel_data2)) {
                                    $key = array_search($row_hotel_data2['name'], $arr_hotel);
                                    if ($key == false) {
                                        array_push($arr_hotel, $row_hotel_data2['name']);
                                    }
                                }


                                /////// price //////////////////////
                                $val_guest_hotel = $row_pkg['id'];
                                $show_guest_hotel = get_hotel_lt_price($val_guest_hotel);
                                $result_guest_hotel = json_decode($show_guest_hotel, true);

                                $gprice = $result_guest_hotel['price'];
                                $val_hotel = $result_guest_hotel['price'] / 2;

                                if ($_POST['guide_hotel'] == 0) {
                                    $val_hotel_guide = $result_guest_hotel['price'];
                                    $gprice_guide = $result_guest_hotel['price'];
                                } else {
                                    $val_guide_hotel = $_POST['guide_hotel'];
                                    $show_guide_hotel = get_hotel_lt_price($val_guide_hotel);
                                    $result_guide_hotel = json_decode($show_guide_hotel, true);
                                    $val_hotel_guide = $result_guide_hotel['price'];
                                    $gprice_guide = $result_guide_hotel['price'];
                                }
                                if ($_POST['foc_hotel'] == 0) {
                                    $val_hotel_foc = $val_hotel;
                                    $gprice_foc = $result_guest_hotel['price'];
                                } else {
                                    $val_foc_hotel = $_POST['foc_hotel'];
                                    $show_foc_hotel = get_hotel_lt_price($val_foc_hotel);
                                    $result_foc_hotel = json_decode($show_foc_hotel, true);

                                    $val_hotel_foc = $result_foc_hotel['price'] / 2;
                                    $gprice_foc = $result_foc_hotel['price'];
                                }


                                $val_hotel_twn = $gprice / 2;
                                $val_hotel_sgl = $gprice;
                                $val_hotel_chd = 0;
                                $val_hotel_inf = 0;


                                $guide_hotel = $_POST['guide'] * ($val_hotel_guide / $bagi);
                                $foc_hotel = $_POST['foc'] * ($val_hotel_foc / $bagi);


                                $val_guide_custom = $_POST['guide'] * ($grand_guide2 / $bagi);
                                $val_foc_custom = $_POST['foc'] * ($grand_foc / $pax_tour);
                                $gt_twn_custom = $val_rent + $val_hotel_twn + $val_guide_custom + $val_foc_custom + $guest_meal + $adm_price + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;
                                $gt_sgl_custom = $val_rent + $gprice + $val_guide_custom + $val_foc_custom +  $guest_meal + $adm_price + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;
                                $gt_cnb_custom = $val_rent + $val_guide_custom + $val_foc_custom +  $guest_meal + $adm_price + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;
                                $gt_inf_custom =  $val_guide_custom + $val_foc_custom + $guest_meal + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;



                                $twn_sp = get_pembulatan($gt_twn_custom);
                                $twn_rp = json_decode($twn_sp, true);

                                $sgl_sp = get_pembulatan($gt_sgl_custom);
                                $sgl_rp = json_decode($sgl_sp, true);

                                $cnb_sp = get_pembulatan($gt_cnb_custom);
                                $cnb_rp = json_decode($cnb_sp, true);

                                $inf_sp = get_pembulatan($gt_inf_custom);
                                $inf_rp = json_decode($inf_sp, true);

                    ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <?php
                                        foreach ($arr_hotel as $hotel) {
                                            echo "<div> * " . $hotel . "</div>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $val_pax; ?></td>
                                    <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                                    <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                                </tr>
                    <?php
                                $no++;
                            }
                        }
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="include" style="padding: 10px 40px;">
            <div class="row">
                <div class="col-6">
                    <div style="text-align: left; font-weight: bold; text-decoration: underline;">INCLUDE</div>
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
                <div class="col-6">
                    <div style="text-align: left; font-weight: bold; text-decoration: underline;">EXCLUDE</div>
                    <ul>
                        <li>Tiket Pesawat International , Tax & Fuel Surcharge</li>
                        <li>Tips Guide <?php echo $guide_price ?></li>
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
        <div class="remarks" style="padding: 20px;">
            <?php
            if ($row_data['note'] != "") {
            ?>
                <div>REMARKS : </div>
                <p><?php echo $row_data['note'] ?></p>
            <?php
            }
            ?>
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
        var kode = "<?php
                    $judul = "LT_Custom";
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