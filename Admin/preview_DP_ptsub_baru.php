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
include "Api_LT_total_baru.php";
?>
<?php

$query_dp = "SELECT * FROM  DP_ptsub2 where id=" . $_GET['id'];
$rs_dp = mysqli_query($con, $query_dp);
$row_dp = mysqli_fetch_array($rs_dp);
$data = $row_dp['copy_id'];
// $val_data = json_decode($row_data['data'], true);

// var_dump($val_data['day']);
$query_data = "SELECT * FROM  LTSUB_itin where id=" . $row_dp['copy_id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);


$queryTmp_set = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['master_id'] . "'";
$rsTmp_set = mysqli_query($con, $queryTmp_set);
$arr_hl = [];
while ($row_tmp_set = mysqli_fetch_array($rsTmp_set)) {
    $query_ops_set = "SELECT * FROM LT_add_ops where master_id='" .  $row_data['id'] . "' && hari='" . $row_tmp_set['hari'] . "' && urutan='" . $row_tmp_set['urutan'] . "'";
    $rs_ops_set = mysqli_query($con, $query_ops_set);
    $row_ops_set = mysqli_fetch_array($rs_ops_set);

    if ($row_ops_set['highlight'] == '1') {
        $query_tempat_hl = "SELECT * FROM List_tempat where id=" . $row_tmp_set['tempat'];
        $rs_tempat_hl = mysqli_query($con, $query_tempat_hl);
        $row_tempat_hl = mysqli_fetch_array($rs_tempat_hl);
        array_push($arr_hl, $row_tempat_hl['tempat']);
    }
}

$query_date = "SELECT * FROM  LT_Date_list where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && ket='1'";
$rs_date = mysqli_query($con, $query_date);
$row_date = mysqli_fetch_array($rs_date);
$start_date = $row_date['tgl'];

$json_day = $row_data['hari'];
$view_guide = 0;

$arr_chck =  explode(',',$row_dp['chck_id']);
// var_dump($arr_chck);
$total_twn = 0;
$total_sgl = 0;
$total_inf = 0;
$total_chd  = 0;

$guide_price = '';
$tl_price = '';
$porter_price = '';
$detail_visa = "";
$data_visa = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_dp['copy_id'],
    "check_id" => '8'
);
$show_visa = get_total($data_visa);
$result_visa = json_decode($show_visa, true);
foreach ($result_visa['detail'] as $detail) {
    $detail_visa .= " " . $detail;
}

$data_porter = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_dp['copy_id'],
    "check_id" => '37'
);

$show_porter = get_total($data_porter);
$result_porter = json_decode($show_porter, true);
if ($result_porter['adt'] != 0) {
    $porter_price = "Rp." . number_format($result_porter['adt'], 0, ",", ".");
}


$data_tl = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_dp['copy_id'],
    "check_id" => '27'
);

$show_tl = get_total($data_tl);
$result_tl = json_decode($show_tl, true);
if ($result_tl['adt'] != 0) {
    $tl_price = "Rp." . number_format($result_tl['adt'], 0, ",", ".");
}


$data_guide = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_dp['copy_id'],
    "check_id" => '26'
);

$show_guide = get_total($data_guide);
$result_guide = json_decode($show_guide, true);
if ($result_guide['adt'] != 0) {
    $guide_price = "Rp." . number_format($result_guide['adt'], 0, ",", ".");
}


// include exclude

$val_check = [0];
foreach ($arr_chck as $val) {
    array_push($val_check, $val);
}
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
                    "copy_id" => $row_dp['copy_id'],
                    "check_id" => $row_ex['id']
                );
                $show_price = get_total($data_price);
                $result_price = json_decode($show_price, true);


                // var_dump($result_price['adt']);
                if ($result_price['adt'] != "" or $result_price['adt'] != '0' or $result_price['adt'] != null) {
                    array_push($arr_in, $row_ex['id']);
                    // var_dump($row_ex['id']);
                } else {
                    $cek_yellow = array_search($row_ex['id'], $yellow_check);
                    if ($cek_yellow != "") {
                        array_push($arr_in, $row_ex['id']);
                    }
                }
            } else {
                array_push($arr_in, $row_ex['id']);
            }
        }
    }
}
// var_dump($arr_in);
// var_dump("=====");
// var_dump($arr_ex);
?>

<body>
    <div id="content" class="container" style="max-width: 2300px;">
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
                if ($row_data['gambar1'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar1'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
                <?php
                if ($row_data['gambar2'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php

                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar2'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
                <?php
                if ($row_data['gambar3'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar3'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
                <?php
                if ($row_data['gambar4'] == "") {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                } else {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar4'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div style="padding: 5px 15px">
            <div class="row">
                <div class="col-3" style="font-size: 14px;">
                    <?php
                    $tb = "";
                    $query_date_set = "SELECT * FROM  LT_Date_list where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "'";
                    $rs_date_set = mysqli_query($con, $query_date_set);
                    $xb = 0;
                    while ($row_date_set = mysqli_fetch_array($rs_date_set)) {
                        $xb++;
                        // $tgl_set = explode("-",$row_date_set['tgl']);
                        if ($xb == '1') {
                            $tb .= "<b>TGL KEBERANGKATAN : </b></br>";
                        }
                        $tb .= date("d M ", strtotime($row_date_set['tgl'])) . ",";
                    }
                    echo $tb;
                    ?>

                </div>
                <div class="col-6">
                    <div style="font-size: 24px; font-weight: bold; text-align: center;">
                        <?php echo $row_data['judul'] ?>
                    </div>
                </div>
                <div class="col-3">
                </div>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <!-- loop day disini -->
            <?php
            $x = 1;
            $loop = 1;
            $date_plus = 0;
            for ($c = 1; $c <= $json_day; $c++) {
                $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_data['master_id'] . "' && hari='$x'";
                $rsRute = mysqli_query($con, $queryRute);
                $rowRute = mysqli_fetch_array($rsRute);

                $queryTambah = "SELECT * FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$loop'";
                $rsTambah = mysqli_query($con, $queryTambah);
                // var_dump($queryTambah);
                while ($rowTambah = mysqli_fetch_array($rsTambah)) {
                    if ($rowTambah['hari'] == $loop) {
            ?>
                        <div class="row">
                            <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
                                <div><u>Hari <?php echo $loop ?></u></div>
                                <div> <?php if ($row_date['id'] != "") {
                                            echo date('Y-m-d', strtotime("+ " . $date_plus . " day", strtotime($start_date)));
                                        } ?></div>
                            </div>
                            <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                                <div style="font-size: 14pt;"><u><b><?php echo $rowTambah['rute'] ?></b></u>
                                    <?php
                                    $queryMealH = "SELECT * FROM  LTHR_add_meal where tour_id='" . $rowTambah['id'] . "' && hari='" . $rowTambah['hari'] . "'";
                                    $rsMealH = mysqli_query($con, $queryMealH);
                                    $rowMealH = mysqli_fetch_array($rsMealH);
                                    if ($rowMealH['id'] != "") {
                                        if ($rowMealH['bf'] != '0' or $rowMealH['ln'] != '0' or $rowMealH['dn'] != '0') {
                                            $b = "";
                                            $l = "";
                                            $d = "";
                                            if ($rowMealH['bf'] != '0') {
                                                $b = "B";
                                            }
                                            if ($rowMealH['ln'] != '0') {
                                                $l = "L";
                                            }
                                            if ($rowMealH['dn'] != '0') {
                                                $d = "D";
                                            }
                                            echo "(" . $b . $l . $d . ")";
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                $queryTR = "SELECT * FROM  DP_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' && dp_id='" . $row_dp['id'] . "' order by urutan ASC";
                                $rsTR = mysqli_query($con, $queryTR);
                                // var_dump($queryTR);

                                // $rowTR = mysqli_fetch_array($rsTR);
                                $detail = "";
                                $type = "";
                                while ($rowTR = mysqli_fetch_array($rsTR)) {

                                    if ($rowTR['type'] == '1') {
                                        $type = "Flight";
                                        // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                                        // $rsflight = mysqli_query($con, $queryflight);
                                        // $row_flight = mysqli_fetch_array($rsflight);

                                        $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                        $rs_detail2 = mysqli_query($con, $query_detail2);
                                        $row_detail2 = mysqli_fetch_array($rs_detail2);
                                        var_dump($query_detail2);
                                        $detail = $row_detail2['maskapai'] . " : " . $row_detail2['dept'] . "-" . $row_detail2['arr'] . " (" . $row_detail2['take'] . "-" . $row_detail2['landing'] . ")";

                                        // var_dump($queryflight);
                                        // $detail = $row_flight['tgl'] . " " . $row_flight['maskapai'] . " " . $row_flight['dept'] . "-" . $row_flight['arr'] . " " . $row_flight['take'] . "-" . $row_flight['landing'];
                                    } else if ($rowTR['type'] == '2') {
                                        $type = "Ferry";
                                        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                                        $rs_ferry = mysqli_query($con, $query_ferry);
                                        $row_ferry = mysqli_fetch_array($rs_ferry);
                                        $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                        $adt = $row_ferry['adult'];
                                        $chd = $row_ferry['child'];
                                        $inf = $row_ferry['infant'];
                                    } else if ($rowTR['type'] == '4') {
                                        $type = "Train";
                                        $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR['transport'];
                                        $rs_train = mysqli_query($con, $query_train);
                                        $row_train = mysqli_fetch_array($rs_train);

                                        $detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
                                        $adt = $row_train['adt'];
                                        $chd = $row_train['chd'];
                                        $inf = $row_train['inf'];
                                    } else {
                                    }

                                ?>
                                    <div style="font-weight: bold;">
                                        <?php
                                        if ($rowTR['type'] == '1') {
                                        ?>
                                            <i class="fa fa-plane" style="padding-right: 10px;"></i>
                                        <?php
                                        } else if ($rowTR['type'] == '2') {
                                        ?>
                                            <i class="fa fa-ship" style="padding-right: 10px;"></i>
                                        <?php
                                        } else if ($rowTR['type'] == '4') {
                                        ?>
                                            <i class="fa fa-train" style="padding-right: 10px;"></i>
                                        <?php
                                        }
                                        ?>
                                        <?php echo  $type . " : " . $detail ?>
                                    </div>
                                <?php

                                }
                                ?>
                                <!-- class tempat -->
                                <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
                                    <?php
                                    $queryTmp2 = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah['id'] . "' && hari='" . $rowTambah['hari'] . "'";
                                    $rsTmp2 = mysqli_query($con, $queryTmp2);
                                    while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                                        $query_tempat22 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
                                        $rs_tempat22 = mysqli_query($con, $query_tempat22);
                                        $row_tempat22 = mysqli_fetch_array($rs_tempat22);

                                        $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $rowTambah['id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp2['urutan'] . "'";
                                        $rs_ops = mysqli_query($con, $query_ops);
                                        $row_ops = mysqli_fetch_array($rs_ops);
                                        // var_dump( $query_ops);
                                        if ($row_ops['id'] == "") {
                                    ?>
                                            <div style="padding-left: 20px;">
                                                <b><?php echo $row_tempat22['tempat2'] . " " ?></b><?php echo $row_tempat22['keterangan'] ?>
                                            </div>
                                            <?php
                                        } else {
                                            if ($row_ops['optional'] == '1') {
                                            ?>
                                                <div style="padding-left: 20px;">
                                                    <b><?php echo $row_tempat22['tempat2'] . " (Optional) " ?></b><?php echo $row_tempat22['keterangan'] ?>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div style="padding-left: 20px;">
                                                    <b><?php echo $row_tempat22['tempat2'] . " " ?></b><?php echo $row_tempat22['keterangan'] ?>
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div style="padding:2px"></div>
                <?php
                        $loop++;
                        $date_plus++;
                    }
                }

                // end tambah day
                ?>
                <div class="row">
                    <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
                        <div><u>Hari <?php echo $loop ?></u></div>
                        <div> <?php if ($row_date['id'] != "") {
                                    echo date('Y-m-d', strtotime("+ " . $date_plus . " day", strtotime($start_date)));
                                } ?></div>
                    </div>
                    <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                        <div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u>
                            <?php
                            $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row_data['master_id'] . "' && hari='$x'";
                            $rsMeal = mysqli_query($con, $queryMeal);
                            $rowMeal = mysqli_fetch_array($rsMeal);
                            // var_dump($queryMeal);
                            if ($rowMeal['bf'] != '0' or $rowMeal['ln'] != '0' or $rowMeal['dn'] != '0') {
                                $b = "";
                                $l = "";
                                $d = "";
                                if ($rowMeal['bf'] != '0') {
                                    $b = "B";
                                }
                                if ($rowMeal['ln'] != '0') {
                                    $l = "L";
                                }
                                if ($rowMeal['dn'] != '0') {
                                    $d = "D";
                                }
                                echo "(" . $b . $l . $d . ")";
                            }
                            ?>
                        </div>
                        <?php
                        $queryTR = "SELECT * FROM  DP_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' && dp_id='" . $row_dp['id'] . "' order by urutan ASC";
                        $rsTR = mysqli_query($con, $queryTR);
                        // var_dump($queryTR);
                        // $rowTR = mysqli_fetch_array($rsTR);
                        $detail = "";
                        $type = "";
                        while ($rowTR = mysqli_fetch_array($rsTR)) {

                            if ($rowTR['type'] == '1') {
                                $type = "Flight";

                                $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                $rs_detail= mysqli_query($con, $query_detail);
                                $row_detail = mysqli_fetch_array($rs_detail);
                                $detail = $row_detail['maskapai'] . " : " . $row_detail['dept'] . "-" . $row_detail['arr'] . " (" . $row_detail['take'] . "-" . $row_detail['landing'] . ")";

                            } else if ($rowTR['type'] == '2') {
                                $type = "Ferry";
                                $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                                $rs_ferry = mysqli_query($con, $query_ferry);
                                $row_ferry = mysqli_fetch_array($rs_ferry);
                                $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                $adt = $row_ferry['adult'];
                                $chd = $row_ferry['child'];
                                $inf = $row_ferry['infant'];
                            } else if ($rowTR['type'] == '4') {
                                $type = "Train";
                                $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR['transport'];
                                $rs_train = mysqli_query($con, $query_train);
                                $row_train = mysqli_fetch_array($rs_train);

                                $detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
                                $adt = $row_train['adt'];
                                $chd = $row_train['chd'];
                                $inf = $row_train['inf'];
                            } else {
                            }

                        ?>
                            <div style="font-weight: bold;">
                                <?php
                                if ($rowTR['type'] == '1') {
                                ?>
                                    <i class="fa fa-plane" style="padding-right: 10px;"></i>
                                <?php
                                } else if ($rowTR['type'] == '2') {
                                ?>
                                    <i class="fa fa-ship" style="padding-right: 10px;"></i>
                                <?php
                                } else if ($rowTR['type'] == '4') {
                                ?>
                                    <i class="fa fa-train" style="padding-right: 10px;"></i>
                                <?php
                                }
                                ?>
                                <?php echo  $type . " : " . $detail ?>
                            </div>
                        <?php

                        }
                        ?>
                        <!-- class tempat -->
                        <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
                            <?php
                            $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['master_id'] . "' && hari='$x'";
                            $rsTmp = mysqli_query($con, $queryTmp);
                            while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
                                $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                $row_tempat2 = mysqli_fetch_array($rs_tempat2);

                                $query_ops = "SELECT * FROM LT_add_ops where master_id='" . $row_data['master_id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp['urutan'] . "'";
                                $rs_ops = mysqli_query($con, $query_ops);
                                $row_ops = mysqli_fetch_array($rs_ops);
                                //  var_dump( $query_ops);
                                if ($row_ops['id'] == "") {
                            ?>
                                    <div style="padding-left: 20px;">
                                        <b><?php echo $row_tempat2['tempat2'] . " " ?></b><?php echo $row_tempat2['keterangan'] ?>
                                    </div>
                                    <?php
                                } else {
                                    if ($row_ops['optional'] == '1') {
                                    ?>
                                        <div style="padding-left: 20px;">
                                            <b><?php echo $row_tempat2['tempat2'] . " (Optional) " ?></b><?php echo $row_tempat2['keterangan'] ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div style="padding-left: 20px;">
                                            <b><?php echo $row_tempat2['tempat2'] . " " ?></b><?php echo $row_tempat2['keterangan'] ?>
                                        </div>
                            <?php
                                    }
                                }
                            }

                            ?>


                        </div>
                        <?php
                        if ($row_data['landtour'] == "undefined") {
                            $queryHotel = "SELECT * FROM  DP_select_PilihHTLNC where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$x' && dp_id='" . $row_dp['id'] . "'";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            while ($rowHotel = mysqli_fetch_array($rsHotel)) {
                        ?>
                                <div style="font-weight: bold; font-size: 12pt;">
                                    <div class="row">
                                        <div class="col-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                        <div class="col-9">: <?php echo $rowHotel['hotel_name'] ?></div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                        } else {
                            $queryHotel = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id='" . $row_data['master_id'] . "' && hari='$x' ";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            // var_dump($queryHotel);
                            // $rowHotel = mysqli_fetch_array($rsHotel);
                            while ($rowHotel = mysqli_fetch_array($rsHotel)) {
                                // if ($rowHotel['hotel'] == "1") {
                                $queryPHotel = "SELECT * FROM  DP_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $x . "' && dp_id='" . $row_dp['id'] . "'";
                                $rsPHotel = mysqli_query($con, $queryPHotel);
                                $rowPHotel = mysqli_fetch_array($rsPHotel);
                                // var_dump($queryPHotel);

                                $queryMaster = "SELECT * FROM  LT_itinnew WHERE id=" . $rowPHotel['hotel_id'];
                                $rsMaster = mysqli_query($con, $queryMaster);
                                $rowMaster = mysqli_fetch_array($rsMaster);
                                // var_dump($queryMaster);

                            ?>
                                <div style="font-weight: bold; font-size: 12pt;">
                                    <div class="row">
                                        <div class="col-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                        <?php
                                        if ($rowPHotel['no_htl'] == '1') {
                                        ?>
                                            <div class="col-9">: <?php echo $rowMaster['hotel1'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '2') {
                                        ?>
                                            <div class="col-9">: <?php echo $rowMaster['hotel2'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '3') {
                                        ?>
                                            <div class="col-9">: <?php echo $rowMaster['hotel3'] ?></div>
                                        <?php
                                        } else if ($rowPHotel['no_htl'] == '4') {
                                        ?>
                                            <div class="col-9">: <?php echo $rowMaster['hotel4'] ?></div>
                                        <?php
                                        } else if ($rowPHotel['no_htl'] == '5') {
                                        ?>
                                            <div class="col-9">:<?php echo $rowMaster['hotel5'] ?></div>
                                        <?php
                                        } else if ($rowPHotel['no_htl'] == '6') {
                                        ?>
                                            <div class="col-9">:<?php echo $rowMaster['hotel6'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '7') {
                                        ?>
                                            <div class="col-9">:<?php echo $rowMaster['hotel7'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '8') {
                                        ?>
                                            <div class="col-9">:<?php echo $rowMaster['hotel8'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '9') {
                                        ?>
                                            <div class="col-9">:<?php echo $rowMaster['hotel9'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '10') {
                                        ?>
                                            <div class="col-9">:<?php echo $rowMaster['hotel10'] ?></div>
                                        <?php

                                        } else {
                                        }
                                        ?>

                                    </div>
                                </div>
                        <?php
                            }
                        }

                        ?>
                    </div>
                </div>
                <div style="padding:2px"></div>
            <?php
                $x++;
                $loop++;
                $date_plus++;
            }
            ?>

            <?php
            $queryTambah2 = "SELECT * FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$loop'";
            $rsTambah2 = mysqli_query($con, $queryTambah2);
            while ($rowTambah2 = mysqli_fetch_array($rsTambah2)) {

                if ($rowTambah2['hari'] == $loop) {
            ?>
                    <div class="row">
                        <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
                            <div><u>Hari <?php echo $loop ?></u></div>
                            <div> <?php if ($row_date['id'] != "") {
                                        echo date('Y-m-d', strtotime("+ " . $date_plus . " day", strtotime($start_date)));
                                    } ?></div>
                        </div>
                        <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                            <div style="font-size: 14pt;"><u><b><?php echo $rowTambah2['rute'] ?></b></u>
                                <?php
                                $queryMealH2 = "SELECT * FROM  LTHR_add_meal where tour_id='" . $rowTambah2['id'] . "' && hari='" . $rowTambah2['hari'] . "'";
                                $rsMealH2 = mysqli_query($con, $queryMealH2);
                                $rowMealH2 = mysqli_fetch_array($rsMealH2);
                                if ($rowMealH2 != "") {
                                    if ($rowMealH2['bf'] != '0' or $rowMealH2['ln'] != '0' or $rowMealH2['dn'] != '0') {
                                        $b = "";
                                        $l = "";
                                        $d = "";
                                        if ($rowMealH2['bf'] != '0') {
                                            $b = "B";
                                        }
                                        if ($rowMealH2['ln'] != '0') {
                                            $l = "L";
                                        }
                                        if ($rowMealH2['dn'] != '0') {
                                            $d = "D";
                                        }
                                        echo "(" . $b . $l . $d . ")";
                                    }
                                };

                                ?>
                            </div>
                            <?php
                            $queryTR = "SELECT * FROM  DP_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' && dp_id='" . $row_dp['id'] . "' order by urutan ASC";
                            $rsTR = mysqli_query($con, $queryTR);

                            // $rowTR = mysqli_fetch_array($rsTR);
                            $detail = "";
                            $type = "";
                            while ($rowTR = mysqli_fetch_array($rsTR)) {

                                if ($rowTR['type'] == '1') {
                                    $type = "Flight";
                                    $query_detail3 = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                    $rs_detail3 = mysqli_query($con, $query_detail3);
                                    $row_detail3 = mysqli_fetch_array($rs_detail3);
                                    $detail = $row_detail3['maskapai'] . " : " . $row_detail3['dept'] . "-" . $row_detail3['arr'] . " (" . $row_detail3['take'] . "-" . $row_detail3['landing'] . ")";

                                } else if ($rowTR['type'] == '2') {
                                    $type = "Ferry";
                                    $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                                    $rs_ferry = mysqli_query($con, $query_ferry);
                                    $row_ferry = mysqli_fetch_array($rs_ferry);
                                    $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                    $adt = $row_ferry['adult'];
                                    $chd = $row_ferry['child'];
                                    $inf = $row_ferry['infant'];
                                } else if ($rowTR['type'] == '4') {
                                    $type = "Train";
                                    $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR['transport'];
                                    $rs_train = mysqli_query($con, $query_train);
                                    $row_train = mysqli_fetch_array($rs_train);

                                    $detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
                                    $adt = $row_train['adt'];
                                    $chd = $row_train['chd'];
                                    $inf = $row_train['inf'];
                                } else {
                                }

                            ?>
                                <div style="font-weight: bold;">
                                    <?php
                                    if ($rowTR['type'] == '1') {
                                    ?>
                                        <i class="fa fa-plane" style="padding-right: 10px;"></i>
                                    <?php
                                    } else if ($rowTR['type'] == '2') {
                                    ?>
                                        <i class="fa fa-ship" style="padding-right: 10px;"></i>
                                    <?php
                                    } else if ($rowTR['type'] == '4') {
                                    ?>
                                        <i class="fa fa-train" style="padding-right: 10px;"></i>
                                    <?php
                                    }
                                    ?>
                                    <?php echo  $type . " : " . $detail ?>
                                </div>
                            <?php

                            }
                            ?>
                            <!-- class tempat -->
                            <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
                                <?php
                                $queryTmp_last = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah2['id'] . "' && hari='" . $rowTambah2['hari'] . "'";
                                $rsTmp_last = mysqli_query($con, $queryTmp_last);
                                // var_dump( $queryTmp_last);
                                while ($rowTmp_last = mysqli_fetch_array($rsTmp_last)) {
                                    $query_tempat_last = "SELECT * FROM List_tempat where id=" . $rowTmp_last['tempat'];
                                    $rs_tempat_last = mysqli_query($con, $query_tempat_last);
                                    $row_tempat_last = mysqli_fetch_array($rs_tempat_last);

                                    $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $rowTambah2['id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp2['urutan'] . "'";
                                    $rs_ops = mysqli_query($con, $query_ops);
                                    $row_ops = mysqli_fetch_array($rs_ops);
                                    // var_dump( $query_ops);
                                    if ($row_ops['id'] == "") {
                                ?>
                                        <div style="padding-left: 20px;">
                                            <b><?php echo $row_tempat_last['tempat2'] . " " ?></b><?php echo $row_tempat_last['keterangan'] ?>
                                        </div>
                                        <?php
                                    } else {
                                        if ($row_ops['optional'] == '1') {
                                        ?>
                                            <div style="padding-left: 20px;">
                                                <b><?php echo $row_tempat_last['tempat2'] . " (Optional) " ?></b><?php echo $row_tempat_last['keterangan'] ?>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div style="padding-left: 20px;">
                                                <b><?php echo $row_tempat_last['tempat2'] . " " ?></b><?php echo $row_tempat_last['keterangan'] ?>
                                            </div>
                                <?php
                                        }
                                    }
                                }

                                ?>


                            </div>
                        </div>
                    </div>
                    <div style="padding:2px"></div>
            <?php
                    $loop++;
                    $date_plus++;
                }
            }

            ?>
        </div>
        <div style="padding-top: 20px;"></div>
        <div style="padding-top: 20px;"></div>
        <?php
        $query_lt = "SELECT * FROM LT_itinnew where kode='" . $row_data['landtour'] . "'";
        $rs_lt = mysqli_query($con, $query_lt);
        $row_lt = mysqli_fetch_array($rs_lt);
        // var_dump($_POST['twn']);
        // custom price
        if ($row_dp['c_twn'] != 0) {
        ?>
            <div style="padding: 5px 20px; font-size: 12pt;">
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
                        <tr>
                            <td>
                                <?php
                                if ($row_data['landtour'] != "undefined") {
                                    $query_lt2 = "SELECT * FROM  LT_itinnew where id = '" . $rowPHotel['hotel_id'] . "'";
                                    $rs_lt2 = mysqli_query($con, $query_lt2);
                                    while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
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
                                        echo  $row_lt2['hotel1'] . $tanda2 . $row_lt2['hotel2'] . $tanda3 . $row_lt2['hotel3'] . $tanda4 . $row_lt2['hotel4'] . $tanda5 . $row_lt2['hotel5'];
                                    }
                                } else {
                                    $query_nc_hotel = "SELECT * FROM  LT_select_PilihHTLNC  where copy_id = '" . $row_dp['copy_id'] . "' && master_id='" . $row_data['master_id'] . "' && dp_id='" . $row_dp['id'] . "' order by hari ASC";
                                    $rs_nc_hotel = mysqli_query($con, $query_nc_hotel);
                                    $detail_hotel = "";
                                    $x = 1;
                                    $ht_twin = 0;
                                    while ($row_nc_hotel = mysqli_fetch_array($rs_nc_hotel)) {
                                        $ht_twin = $ht_twin + $row_nc_hote['hotel_twin'];

                                        if ($x == 1) {
                                            $detail_hotel = $row_nc_hotel['hotel_name'];
                                        } else {
                                            $detail_hotel = $detail_hotel . " <i class='fa fa-circle' style='font-size:6pt'; text_align:center;></i> " . $row_nc_hotel['hotel_name'];
                                        }
                                        $x++;
                                    }
                                    echo $detail_hotel;
                                }
                                ?>
                            </td>
                            <td><?php echo $row_dp['c_pax'] ?></td>
                            <td><?php echo "Rp." . number_format($row_dp['c_twn'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($row_dp['c_sgl'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($row_dp['c_cnb'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($row_dp['c_sgl'], 0, ",", ".") ?></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <?php
        } else {
            // var_dump($query_lt);
            $tambahan = 0;
            if ($row_data['landtour'] != "undefined") {
            ?>
                <div style="padding: 5px 20px; font-size: 12pt;">
                    <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $row_lt['kota'] ?></div>
                    <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $row_data['judul']; ?></div>
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
                                // $query_call_hotel = "SELECT *  FROM "
                                $query_lt2 = "SELECT * FROM  LT_itinnew where id = '" . $rowPHotel['hotel_id'] . "'";
                                $rs_lt2 = mysqli_query($con, $query_lt2);
                                // var_dump($query_lt2);
                                while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
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

                                        // $data_hotel = array(
                                        //     "master_id" => $row_data['master_id'],
                                        //     "copy_id" => $row_dp['copy_id'],
                                        //     "check_id" => '15'
                                        // );

                                        // $show_hotel = get_total($data_hotel);
                                        // $result_hotel = json_decode($show_hotel, true);
                                        // var_dump($_POST['ltwn']);

                                        $grand_twn = $row_dp['twn'];
                                        $grand_sgl = $row_dp['sgl'];
                                        $grand_cnb = $row_dp['cnb'];
                                        $grand_inf = $row_dp['inf'];

                                ?>
                                        <tr>
                                            <td><?php
                                                echo  $row_lt2['hotel1'] . $tanda2 . $row_lt2['hotel2'] . $tanda3 . $row_lt2['hotel3'] . $tanda4 . $row_lt2['hotel4'] . $tanda5 . $row_lt2['hotel5'];
                                                ?></td>
                                            <td><?php
                                                $pax_u = "";
                                                $pax_b = "";
                                                if ($row_dp['pax_u'] != 0) {
                                                    $pax_u = "-" . $row_dp['pax_u'];
                                                }
                                                if ($row_dp['pax_b'] != 0) {
                                                    $pax_b = "+" . $row_dp['pax_b'];
                                                }
                                                echo $row_dp['pax'] . $pax_u . $pax_b; ?></td>
                                            <td><?php echo "Rp." . number_format($grand_twn, 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($grand_sgl, 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($grand_cnb, 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($grand_inf, 0, ",", ".") ?></td>
                                            <td><?php echo $row_dp['exp'] ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div style="padding: 5px 20px; font-size: 12pt;">
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
                            $query_nc_hotel = "SELECT * FROM  LT_select_PilihHTLNC  where copy_id = '" . $row_dp['copy_id'] . "' && master_id='" . $row_data['master_id'] . "' && dp_id='" . $row_dp['dp_id'] . "' order by hari ASC";
                            $rs_nc_hotel = mysqli_query($con, $query_nc_hotel);
                            $detail_hotel = "";
                            // var_dump($query_nc_hotel);
                            $x = 1;
                            $ht_twin = 0;
                            while ($row_nc_hotel = mysqli_fetch_array($rs_nc_hotel)) {
                                $ht_twin = $ht_twin + $row_nc_hote['hotel_twin'];

                                if ($x == 1) {
                                    $detail_hotel = $row_nc_hotel['hotel_name'];
                                } else {
                                    $detail_hotel = $detail_hotel . " <i class='fa fa-circle' style='font-size:6pt'; text_align:center;></i> " . $row_nc_hotel['hotel_name'];
                                }
                                $x++;
                            }

                            $grand_twn = $row_dp['twn'];
                            $grand_sgl = $row_dp['sgl'];
                            $grand_cnb = $row_dp['cnb'];
                            $grand_inf = $row_dp['inf'];

                            ?>
                            <tr>
                                <td><?php echo $detail_hotel ?></td>
                                <td></td>
                                <td><?php echo "Rp." . number_format($grand_twn, 0, ",", ".") ?></td>
                                <td><?php echo "Rp." . number_format($grand_sgl, 0, ",", ".") ?></td>
                                <td><?php echo "Rp." . number_format($grand_cnb, 0, ",", ".") ?></td>
                                <td><?php echo "Rp." . number_format($grand_inf, 0, ",", ".") ?></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
        <?php
            }
        }

        ?>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-6">
                    <div>
                        <?php
                        $query2 = "SELECT * FROM  DP_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_dp['copy_id'] . "' && dp_id='" . $row_dp['id'] . "' order by hari ASC, urutan ASC";
                        $rs2 = mysqli_query($con, $query2);
                        $row2 = mysqli_fetch_array($rs2);
                        if ($row2['id'] != "") {
                        ?>
                            <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                                <thead>
                                    <tr>
                                        <th scope="col">Transport</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM  DP_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_dp['copy_id'] . "' && dp_id='" . $row_dp['id'] . "' order by hari ASC, urutan ASC";
                                    $rs = mysqli_query($con, $query);
                                    $code_fl = [];
                                    while ($row = mysqli_fetch_array($rs)) {
                                        $fl_logo = "";
                                        if ($row['type'] == '1') {
                                            $type = "Flight";

                                            // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $row['transport'];
                                            // $rsflight = mysqli_query($con, $queryflight);
                                            // $rowflight = mysqli_fetch_array($rsflight);

                                            $query_detail4 = "SELECT * FROM  LTP_route_detail where id='" . $row['transport'] . "'";
                                            $rs_detail4 = mysqli_query($con, $query_detail4);
                                            $row_detail4 = mysqli_fetch_array($rs_detail4);

                                            $detail = $row_detail4['maskapai'] . " : " . $row_detail4['dept'] . "-" . $row_detail4['arr'] . " (" . $row_detail4['take'] . "-" . $row_detail4['landing'] . ")";
                                            // var_dump($detail );
                                            $arr_fl = explode(" ", $row_detail4['maskapai']);
                                            array_push($code_fl, $arr_fl[0]);

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

                                            $detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
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
                            ?>

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
                <div>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya untuk berangkat da</div>
                <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
                <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
                <div>Performa Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
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