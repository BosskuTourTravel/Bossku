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
include "Api_LT_total.php";
?>
<?php
$data = $_GET['id'];

// $val_data = json_decode($row_data['data'], true);

// var_dump($val_data['day']);
$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$json_day = $row_data['hari'];
$query_total = "SELECT * FROM  checkbox_include2 order by id ASC";
$rs_total = mysqli_query($con, $query_total);
$total_twn = 0;
$total_chd = 0;
$total_inf = 0;
$tips_guide = 0;
$total_sgl = 0;
while ($row_total = mysqli_fetch_array($rs_total)) {
    $datareq = array(
        "master_id" => $row_data['master_id'],
        "copy_id" => $_GET['id'],
        "check_id" => $row_total['id']
    );
    $show_total = get_total($datareq);
    $result_show_total = json_decode($show_total, true);

    if ($row_total['id'] == '26' or $row_total['id'] == '27' or $row_total['id'] == '36' or $row_total['id'] == '37' or $row_total['id'] == '39' or $row_total['id'] == '51') {
    } else {
        $total_twn = $total_twn + $result_show_total['adt'];
        $total_chd = $total_chd + $result_show_total['chd'];
        $total_inf = $total_inf + $result_show_total['inf'];
        $total_sgl = $total_sgl + $result_show_total['sgl'];
    }
    if ($row_total['id'] == '26') {
        $tips_guide = $result_show_total['adt'];
    }
    // echo "id :" . $row_total['id']." - ". $result_show_total['adt'];
    // echo "</br>";
}
$datareq2 = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $_GET['id'],
);
$data_guide = get_guide($datareq2);
$result_guide = json_decode($data_guide, true);

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
        <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
            <?php echo $row_data['judul'] ?>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <!-- loop day disini -->
            <?php
            $x = 1;
            $loop = 1;
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
                            <div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $loop ?></u></div>
                            <div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
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
                                $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' order by urutan ASC";
                                $rsTR = mysqli_query($con, $queryTR);

                                // $rowTR = mysqli_fetch_array($rsTR);
                                $detail = "";
                                $type = "";
                                while ($rowTR = mysqli_fetch_array($rsTR)) {

                                    if ($rowTR['type'] == '1') {
                                        $type = "Flight";
                                        $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                                        $rsflight = mysqli_query($con, $queryflight);
                                        $row_flight = mysqli_fetch_array($rsflight);
                                        // var_dump($queryflight);
                                        $detail = $row_flight['maskapai'] . " " . $row_flight['dept'] . "-" . $row_flight['arr'] . " " . $row_flight['tgl'] . " " . $row_flight['take'] . "-" . $row_flight['landing'];
                                    } else if ($rowTR['type'] == '2') {
                                        $type = "Ferry";
                                        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                                        $rs_ferry = mysqli_query($con, $query_ferry);
                                        $row_ferry = mysqli_fetch_array($rs_ferry);
                                        $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                        $adt = $row_ferry['adult'];
                                        $chd = $row_ferry['child'];
                                        $inf = $row_ferry['infant'];
                                    }else if ($rowTR['type'] =='4'){
                                        $type = "Train";
                                        $query_train = "SELECT * FROM train_LTnew where id=".$rowTR['transport'];
                                        $rs_train = mysqli_query($con,$query_train);
                                        $row_train = mysqli_fetch_array($rs_train);
    
                                        $detail = $row_train['nama']." (".$row_train['tgl'].")";
                                        $adt = $row_train['adt'];
                                        $chd = $row_train['chd'];
                                        $inf = $row_train['inf'];
                                    }else{
    
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
                                        }else if ($rowTR['type'] == '4') {
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
                                    ?>
                                        <div style="padding-left: 20px;">
                                            <b><?php echo $row_tempat22['tempat2'] . " " ?></b><?php echo $row_tempat22['keterangan'] ?>
                                        </div>
                                    <?php
                                    }

                                    ?>


                                </div>
                            </div>
                        </div>
                        <div style="padding:2px"></div>
                <?php
                        $loop++;
                    }
                }

                // end tambah day
                ?>
                <div class="row">
                    <div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $loop ?></u></div>
                    <div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
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
                        $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' order by urutan ASC";
                        $rsTR = mysqli_query($con, $queryTR);
                        // $rowTR = mysqli_fetch_array($rsTR);
                        $detail = "";
                        $type = "";
                        while ($rowTR = mysqli_fetch_array($rsTR)) {

                            if ($rowTR['type'] == '1') {
                                $type = "Flight";
                                $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                                $rsflight = mysqli_query($con, $queryflight);
                                $rowflight = mysqli_fetch_array($rsflight);
                                $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . "-" . $rowflight['arr'] . " " . $rowflight['tgl'] . " " . $rowflight['take'] . "-" . $rowflight['landing'];
                            } else if ($rowTR['type'] == '2') {
                                $type = "Ferry";
                                $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                                $rs_ferry = mysqli_query($con, $query_ferry);
                                $row_ferry = mysqli_fetch_array($rs_ferry);
                                $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                $adt = $row_ferry['adult'];
                                $chd = $row_ferry['child'];
                                $inf = $row_ferry['infant'];
                            }else if ($rowTR['type'] =='4'){
                                $type = "Train";
                                $query_train = "SELECT * FROM train_LTnew where id=".$rowTR['transport'];
                                $rs_train = mysqli_query($con,$query_train);
                                $row_train = mysqli_fetch_array($rs_train);

                                $detail = $row_train['nama']." (".$row_train['tgl'].")";
                                $adt = $row_train['adt'];
                                $chd = $row_train['chd'];
                                $inf = $row_train['inf'];
                            }else{

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
                                }else if ($rowTR['type'] == '4') {
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
                            ?>
                                <div style="padding-left: 20px;">
                                    <b><?php echo $row_tempat2['tempat2'] . " " ?></b><?php echo $row_tempat2['keterangan'] ?>
                                </div>
                            <?php
                            }

                            ?>


                        </div>
                        <?php
                        if ($row_data['landtour'] == "undefined") {
                            $queryHotel = "SELECT * FROM  LT_select_PilihHTLNC where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$x'";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            while ($rowHotel = mysqli_fetch_array($rsHotel)) {
                        ?>
                                <div style="font-weight: bold; font-size: 12pt;">
                                    <div class="row">
                                        <div class="col-md-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                        <div class="col-md-9">: <?php echo $rowHotel['hotel_name'] ?></div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                        } else {
                            $queryHotel = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id='" . $row_data['master_id'] . "' && hari='$x'";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            // var_dump($queryHotel);
                            // $rowHotel = mysqli_fetch_array($rsHotel);
                            while ($rowHotel = mysqli_fetch_array($rsHotel)) {
                                // if ($rowHotel['hotel'] == "1") {
                                $queryPHotel = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $x . "'";
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
                                        <div class="col-md-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                        <?php
                                        if ($rowPHotel['no_htl'] == '1') {
                                        ?>
                                            <div class="col-md-9">: <?php echo $rowMaster['hotel1'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '2') {
                                        ?>
                                            <div class="col-md-9">: <?php echo $rowMaster['hotel2'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '3') {
                                        ?>
                                            <div class="col-md-9">: <?php echo $rowMaster['hotel3'] ?></div>
                                        <?php
                                        } else if ($rowPHotel['no_htl'] == '4') {
                                        ?>
                                            <div class="col-md-9">: <?php echo $rowMaster['hotel4'] ?></div>
                                        <?php
                                        } else if ($rowPHotel['no_htl'] == '5') {
                                        ?>
                                            <div class="col-md-9">:<?php echo $rowMaster['hotel5'] ?></div>
                                        <?php
                                        } else if ($rowPHotel['no_htl'] == '6') {
                                        ?>
                                            <div class="col-md-9">:<?php echo $rowMaster['hotel6'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '7') {
                                        ?>
                                            <div class="col-md-9">:<?php echo $rowMaster['hotel7'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '8') {
                                        ?>
                                            <div class="col-md-9">:<?php echo $rowMaster['hotel8'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '9') {
                                        ?>
                                            <div class="col-md-9">:<?php echo $rowMaster['hotel9'] ?></div>
                                        <?php

                                        } else if ($rowPHotel['no_htl'] == '10') {
                                        ?>
                                            <div class="col-md-9">:<?php echo $rowMaster['hotel10'] ?></div>
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
            }
            ?>

            <?php
            $queryTambah2 = "SELECT * FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$loop'";
            $rsTambah2 = mysqli_query($con, $queryTambah2);
            while ($rowTambah2 = mysqli_fetch_array($rsTambah2)) {

                if ($rowTambah2['hari'] == $loop) {
            ?>
                    <div class="row">
                        <div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $loop ?></u></div>
                        <div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
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
                            $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' order by urutan ASC";
                            $rsTR = mysqli_query($con, $queryTR);

                            // $rowTR = mysqli_fetch_array($rsTR);
                            $detail = "";
                            $type = "";
                            while ($rowTR = mysqli_fetch_array($rsTR)) {

                                if ($rowTR['type'] == '1') {
                                    $type = "Flight";
                                    $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                                    $rsflight = mysqli_query($con, $queryflight);
                                    $row_flight = mysqli_fetch_array($rsflight);
                                    // var_dump($queryflight);
                                    $detail = $row_flight['maskapai'] . " " . $row_flight['dept'] . "-" . $row_flight['arr'] . " " . $row_flight['tgl'] . " " . $row_flight['take'] . "-" . $row_flight['landing'];
                                } else if ($rowTR['type'] == '2') {
                                    $type = "Ferry";
                                    $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                                    $rs_ferry = mysqli_query($con, $query_ferry);
                                    $row_ferry = mysqli_fetch_array($rs_ferry);
                                    $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                                    $adt = $row_ferry['adult'];
                                    $chd = $row_ferry['child'];
                                    $inf = $row_ferry['infant'];
                                }else if ($rowTR['type'] =='4'){
                                    $type = "Train";
                                    $query_train = "SELECT * FROM train_LTnew where id=".$rowTR['transport'];
                                    $rs_train = mysqli_query($con,$query_train);
                                    $row_train = mysqli_fetch_array($rs_train);

                                    $detail = $row_train['nama']." (".$row_train['tgl'].")";
                                    $adt = $row_train['adt'];
                                    $chd = $row_train['chd'];
                                    $inf = $row_train['inf'];
                                }else{

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
                                    }else if ($rowTR['type'] == '4') {
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
                                while ($rowTmp_last = mysqli_fetch_array($rsTmp2)) {
                                    $query_tempat_last = "SELECT * FROM List_tempat where id=" . $rowTmp_last['tempat'];
                                    $rs_tempat_last = mysqli_query($con, $query_tempat_last);
                                    $row_tempat_last = mysqli_fetch_array($rs_tempat_last);
                                ?>
                                    <div style="padding-left: 20px;">
                                        <b><?php echo $row_tempat_last['tempat2'] . " " ?></b><?php echo $row_tempat_last['keterangan'] ?>
                                    </div>
                                <?php
                                }

                                ?>


                            </div>
                        </div>
                    </div>
                    <div style="padding:2px"></div>
            <?php
                    $loop++;
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
                                        <td><?php echo "Rp." . number_format($total_twn, 0, ",", ".") ?></td>
                                        <td><?php echo "Rp." . number_format($total_sgl, 0, ",", ".") ?></td>
                                        <td><?php echo "Rp." . number_format($total_chd, 0, ",", ".") ?></td>
                                        <td><?php echo "Rp." . number_format($total_inf, 0, ",", ".") ?></td>
                                        <td><?php echo $row_lt2['expired'] ?></td>
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
                        $query_nc_hotel = "SELECT * FROM  LT_select_PilihHTLNC  where copy_id = '" . $_GET['id'] . "' && master_id='" . $row_data['master_id'] . "' order by hari ASC";
                        $rs_nc_hotel = mysqli_query($con, $query_nc_hotel);
                        // var_dump($query_nc_hotel);
                        $detail_hotel = "";
                        $x = 1;
                        // $total_twin = 0;
                        while ($row_nc_hotel = mysqli_fetch_array($rs_nc_hotel)) {
                            if ($x == 1) {
                                $detail_hotel = $row_nc_hotel['hotel_name'];
                            } else {
                                $detail_hotel = $detail_hotel . " <i class='fa fa-circle' style='font-size:6pt'; text_align:center;></i> " . $row_nc_hotel['hotel_name'];
                            }
                            // $total_twin = $total_twin + $row_nc_hotel['hotel_twin'];
                            $x++;
                        }
                        ?>
                        <tr>
                            <td><?php echo $detail_hotel ?></td>
                            <td></td>
                            <td><?php echo "Rp." . number_format($total_twn, 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($total_sgl, 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($total_chd, 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($total_inf, 0, ",", ".") ?></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $query2 = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $_GET['id'] . "' order by urutan ASC";
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
                                $query = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $_GET['id'] . "' order by hari ASC";
                                $rs = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_array($rs)) {
                                    if ($row['type'] == '1') {
                                        $type = "Flight";
                                        $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $row['transport'];
                                        $rsflight = mysqli_query($con, $queryflight);
                                        $rowflight = mysqli_fetch_array($rsflight);

                                        $detail = $type . " : " . $rowflight['maskapai'] . " | " . $rowflight['tgl'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ")" . " " . $rowflight['type'];
                                    } else if ($row['type'] == '2') {
                                        $type = "Ferry";
                                        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row['transport'];
                                        $rs_ferry = mysqli_query($con, $query_ferry);
                                        $row_ferry = mysqli_fetch_array($rs_ferry);
                                        $detail = $type . " : " . $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ") " . $row_ferry['type'];
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
                <div class="col-md-6">
                    <?php
                    $query_tpsv = "SELECT * FROM  checkbox_include2 order by id ASC";
                    $rs_tpsv = mysqli_query($con, $query_tpsv);
                    // var_dump($query_tps);
                    $view = 0;
                    while ($row_tpsv = mysqli_fetch_array($rs_tpsv)) {
                        if ($row_tpsv['id'] == '26' or $row_tpsv['id'] == '27' or $row_tpsv['id'] == '36' or $row_tpsv['id'] == '37' or $row_tpsv['id'] == '39' or $row_tpsv['id'] == '51') {
                            $data_tpsv = array(
                                "master_id" => $row_data['master_id'],
                                "copy_id" => $_GET['id'],
                                "check_id" => $row_tpsv['id']
                            );

                            $show_tpsv = get_total($data_tpsv);
                            $result_tpsv = json_decode($show_tpsv, true);


                            if ($result_tpsv['adt'] != "") {
                                $view = 1;
                            }
                        }
                    }
                    if ($view = 1) {
                    ?>
                        <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                            <thead>
                                <tr>
                                    <th scope="col">Biaya Tambahan</th>
                                    <th scope="col">Detail Price</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $query_tps = "SELECT * FROM  checkbox_include2 order by id ASC";
                                $rs_tps = mysqli_query($con, $query_tps);
                                // var_dump($query_tps);
                                $total = 0;
                                while ($row_tps = mysqli_fetch_array($rs_tps)) {
                                    if ($row_tps['id'] == '26' or $row_tps['id'] == '27' or $row_tps['id'] == '36' or $row_tps['id'] == '37' or $row_tps['id'] == '39' or $row_tps['id'] == '51') {
                                        $data_tps = array(
                                            "master_id" => $row_data['master_id'],
                                            "copy_id" => $_GET['id'],
                                            "check_id" => $row_tps['id']
                                        );

                                        $show_tps = get_total($data_tps);
                                        $result_tps = json_decode($show_tps, true);
                                        // var_dump($result_tps['adt']);
                                        if ($result_tps['adt'] != "") {
                                            $total = $total + $result_tps['adt'];
                                ?>
                                            <tr>
                                                <td><?php echo $row_tps['nama'] ?></td>
                                                <td><?php echo number_format($result_tps['adt'], 0, ",", ".") ?></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th><?php echo number_format($total, 0, ",", ".") ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php
                    }
                    ?>

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