<?php
function tambah_hari1($value)
{
    include "../db=connection.php";
    $queryTambah = "SELECT * FROM  LT_add_hari where id='" . $value['id'] . "'";
    $rsTambah = mysqli_query($con, $queryTambah);
    $rowTambah = mysqli_fetch_array($rsTambah);

?>
    <div class="row">
        <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
            <div><u>Hari <?php echo $value['hari'] ?></u></div>
            <div> <?php echo $value['date']  ?></div>
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
            $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && hari='" . $value['hari'] . "' order by urutan ASC";
            $rsTR = mysqli_query($con, $queryTR);
            $detail = "";
            $type = "";
            while ($rowTR = mysqli_fetch_array($rsTR)) {

                if ($rowTR['type'] == '1') {
                    $type = "Flight";

                    $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                    $rsflight = mysqli_query($con, $queryflight);
                    $rowflight = mysqli_fetch_array($rsflight);
                    $detail = $rowflight['maskapai']." ".$rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";

                    // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                    // $rsflight = mysqli_query($con, $queryflight);
                    // $row_flight = mysqli_fetch_array($rsflight);
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

                    $detail = $row_train['nama'];
                    $adt = $row_train['adt'];
                    $chd = $row_train['chd'];
                    $inf = $row_train['inf'];
                } else {
                }

            ?>
                <div style="font-weight: bold; font-size: 12px;">
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
                $queryTmp2 = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah['copy_id'] . "' && hari='" . $rowTambah['hari'] . "' order by urutan ASC";
                $rsTmp2 = mysqli_query($con, $queryTmp2);
                // var_dump($queryTmp2);
                while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                    $query_tempat22 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
                    $rs_tempat22 = mysqli_query($con, $query_tempat22);
                    $row_tempat22 = mysqli_fetch_array($rs_tempat22);

                    $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $rowTambah['id'] . "' && hari='" . $value['x'] . "' && urutan='" . $rowTmp2['urutan'] . "'";
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
                                <b><?php echo "Exclude Optional / Tidak Termasuk Entrance Fee " . $row_tempat22['tempat2'] ?></b><?php echo $row_tempat22['keterangan'] ?>
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
<?php
}
function tambah_hari2($value)
{
    include "../db=connection.php";
    $queryTambah2 = "SELECT * FROM  LT_add_hari where id='" . $value['id'] . "'";
    $rsTambah2 = mysqli_query($con, $queryTambah2);
    $rowTambah2 = mysqli_fetch_array($rsTambah2);
?>
    <div class="row">
        <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
            <div><u>Hari <?php echo $value['hari'] ?></u></div>
            <div> <?php echo $value['date']  ?></div>
        </div>
        <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
            <div style="font-size: 14pt;"><u><b><?php echo $rowTambah2['rute'] ?></b></u>
                <?php
                $queryMealH = "SELECT * FROM  LTHR_add_meal where tour_id='" . $rowTambah2['id'] . "' && hari='" . $rowTambah2['hari'] . "'";
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
            $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && hari='" . $value['hari'] . "' order by urutan ASC";
            $rsTR = mysqli_query($con, $queryTR);
            $detail = "";
            $type = "";
            while ($rowTR = mysqli_fetch_array($rsTR)) {

                if ($rowTR['type'] == '1') {
                    $type = "Flight";

                    $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                    $rsflight = mysqli_query($con, $queryflight);
                    $rowflight = mysqli_fetch_array($rsflight);
                    $detail = $rowflight['maskapai']." ".$rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";

                    // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                    // $rsflight = mysqli_query($con, $queryflight);
                    // $row_flight = mysqli_fetch_array($rsflight);
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

                    $detail = $row_train['nama'] ;
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
                $queryTmp2 = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah2['copy_id'] . "' && hari='" . $rowTambah2['hari'] . "' order by urutan ASC";
                $rsTmp2 = mysqli_query($con, $queryTmp2);
                while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                    $query_tempat22 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
                    $rs_tempat22 = mysqli_query($con, $query_tempat22);
                    $row_tempat22 = mysqli_fetch_array($rs_tempat22);

                    $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $rowTambah2['id'] . "' && hari='" . $value['x'] . "' && urutan='" . $rowTmp2['urutan'] . "'";
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
                                <b><?php echo "Exclude Optional / Tidak Termasuk Entrance Fee " . $row_tempat22['tempat2'] ?></b><?php echo $row_tempat22['keterangan'] ?>
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
    <?php


}
function transport($value)
{
    include "../db=connection.php";

    $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && hari='" . $value['hari'] . "' order by urutan ASC";
    $rsTR = mysqli_query($con, $queryTR);
    $detail = "";
    $type = "";
    while ($rowTR = mysqli_fetch_array($rsTR)) {

        if ($rowTR['type'] == '1') {
            $type = "Flight";
            $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
            $rsflight = mysqli_query($con, $queryflight);
            $rowflight = mysqli_fetch_array($rsflight);
            $detail = $rowflight['maskapai']." ".$rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";

            // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
            // $rsflight = mysqli_query($con, $queryflight);
            // $rowflight = mysqli_fetch_array($rsflight);
            // $detail = $rowflight['tgl'] . " " . $rowflight['maskapai'] . " " . $rowflight['dept'] . "-" . $rowflight['arr'] . " " . $rowflight['take'] . "-" . $rowflight['landing'];
        } else if ($rowTR['type'] == '2') {
            $type = "Ferry";
            $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
            $rs_ferry = mysqli_query($con, $query_ferry);
            $row_ferry = mysqli_fetch_array($rs_ferry);
            $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
            // $adt = $row_ferry['adult'];
            // $chd = $row_ferry['child'];
            // $inf = $row_ferry['infant'];
        } else if ($rowTR['type'] == '4') {
            $type = "Train";
            $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR['transport'];
            $rs_train = mysqli_query($con, $query_train);
            $row_train = mysqli_fetch_array($rs_train);

            $detail = $row_train['nama'] ;
            // $adt = $row_train['adt'];
            // $chd = $row_train['chd'];
            // $inf = $row_train['inf'];
        } else {
        }

    ?>
        <div style="font-weight: bold; font-size: 12px;">
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
}

function hotel($value)
{
    include "../db=connection.php";

    $queryHotel = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id='" . $value['master'] . "' && hari='" . $value['x'] . "'";
    $rsHotel = mysqli_query($con, $queryHotel);

    while ($rowHotel = mysqli_fetch_array($rsHotel)) {
        // if ($rowHotel['hotel'] == "1") {
        $queryPHotel = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && hari='" . $value['x'] . "'";
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

function tmp($value)
{
    include "../db=connection.php";
    ?>
    <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
        <?php
        $query_rt_custom = "SELECT * FROM LT_Custom_Rute where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && type='1'";
        $rs_rt_custom = mysqli_query($con, $query_rt_custom);
        $row_rt_custom = mysqli_fetch_array($rs_rt_custom);

        if ($value['c'] == '1') {
            if ($row_rt_custom['id'] != "") {

                if ($row_rt_custom['tmp1'] != "") {
                    $query_tempat_custom = "SELECT tempat2,keterangan FROM List_tempat where id=" . $row_rt_custom['tmp1'];
                    $rs_tempat_custom = mysqli_query($con, $query_tempat_custom);
                    $row_tempat_custom = mysqli_fetch_array($rs_tempat_custom);
        ?>
                    <div style="padding-left: 20px;">
                        <b><?php echo $row_tempat_custom['tempat2'] . " " ?></b><?php echo $row_tempat_custom['keterangan'] ?>
                    </div>
                <?php

                }
                if ($row_rt_custom['tmp2'] != "") {
                    $query_tempat_custom2 = "SELECT tempat2,keterangan FROM List_tempat where id=" . $row_rt_custom['tmp2'];
                    $rs_tempat_custom2 = mysqli_query($con, $query_tempat_custom2);
                    $row_tempat_custom2 = mysqli_fetch_array($rs_tempat_custom2);
                ?>
                    <div style="padding-left: 20px;">
                        <b><?php echo $row_tempat_custom2['tempat2'] . " " ?></b><?php echo $row_tempat_custom2['keterangan'] ?>
                    </div>
                <?php
                }
            }
        }

        $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $value['master'] . "' && hari='" . $value['x'] . "' order by urutan ASC";
        $rsTmp = mysqli_query($con, $queryTmp);
        while ($rowTmp = mysqli_fetch_array($rsTmp)) {
            $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
            $rs_tempat2 = mysqli_query($con, $query_tempat2);
            $row_tempat2 = mysqli_fetch_array($rs_tempat2);

            $query_ops = "SELECT * FROM LT_add_ops where master_id='" . $value['master'] . "' && hari='" . $value['x'] . "' && urutan='" . $rowTmp['urutan'] . "'";
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
                        <b><?php echo "Exclude Optional / Tidak Termasuk Entrance Fee " . $row_tempat2['tempat2'] ?></b><?php echo $row_tempat2['keterangan'] ?>
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
        if ($value['c'] == $json_day) {

            if ($row_rt_custom2['id'] != "") {
                if ($row_rt_custom2['tmp1'] != "") {
                    $query_tempat_customb = "SELECT tempat2,keterangan FROM List_tempat where id=" . $row_rt_custom2['tmp1'];
                    $rs_tempat_customb = mysqli_query($con, $query_tempat_customb);
                    $row_tempat_customb = mysqli_fetch_array($rs_tempat_customb);
                ?>
                    <div style="padding-left: 20px;">
                        <b><?php echo $row_tempat_customb['tempat2'] . " " ?></b><?php echo $row_tempat_customb['keterangan'] ?>
                    </div>
                <?php

                }
                if ($row_rt_custom2['tmp2'] != "") {
                    $query_tempat_customb2 = "SELECT tempat2,keterangan FROM List_tempat where id=" . $row_rt_custom2['tmp2'];
                    $rs_tempat_customb2 = mysqli_query($con, $query_tempat_customb2);
                    $row_tempat_customb2 = mysqli_fetch_array($rs_tempat_customb2);
                ?>
                    <div style="padding-left: 20px;">
                        <b><?php echo $row_tempat_customb2['tempat2'] . " " ?></b><?php echo $row_tempat_customb2['keterangan'] ?>
                    </div>
        <?php
                }
            }
        }
        ?>


    </div>
<?php
}
function list_tempat($value)
{
    include "../db=connection.php";
    $queryRute = "SELECT * FROM  LT_add_rute where id='" . $value['rute'] . "'";
    $rsRute = mysqli_query($con, $queryRute);
    $rowRute = mysqli_fetch_array($rsRute);

?>
    <div class="row">
        <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
            <div><u>Hari <?php echo $value['hari'] ?></u></div>
            <div><?php echo $value['date'] ?></div>
        </div>
        <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
            <?php
            $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $value['master'] . "' && hari='" . $value['x'] . "'";
            $rsMeal = mysqli_query($con, $queryMeal);
            $rowMeal = mysqli_fetch_array($rsMeal);
            // var_dump($queryMeal);
            $meal = "";
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
                $meal = "(" . $b . $l . $d . ")";
            }
            if ($c == '1') {
                $query_rt_custom = "SELECT * FROM LT_Custom_Rute where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && type='1'";
                $rs_rt_custom = mysqli_query($con, $query_rt_custom);
                $row_rt_custom = mysqli_fetch_array($rs_rt_custom);
                if ($row_rt_custom['id'] != "") {
            ?>
                    <div style="font-size: 14pt;"><u><b><?php echo  $row_rt_custom['rute'] ?></b></u><?php echo $meal ?></div>
                <?php
                } else {
                ?>
                    <div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u><?php echo $meal ?></div>
                <?php
                }
            } else if ($c == $json_day) {
                $query_rt_custom2 = "SELECT * FROM LT_Custom_Rute where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && type='2'";
                $rs_rt_custom2 = mysqli_query($con, $query_rt_custom2);
                $row_rt_custom2 = mysqli_fetch_array($rs_rt_custom2);
                if ($row_rt_custom2['id'] != "") {
                ?>
                    <div style="font-size: 14pt;"><u><b><?php echo  $row_rt_custom2['rute'] ?></b></u><?php echo $meal ?></div>
                <?php
                } else {
                ?>
                    <div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u><?php echo $meal ?></div>
                <?php
                }
            } else {
                ?>
                <div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u><?php echo $meal ?></div>
            <?php
            }
            $data_print = array(
                "id" => $value['id'],
                "hari" => $value['hari'],
                "date" => $value['date'],
                "copy" => $value['copy'],
                "master" => $value['master'],
                "x" => $value['x'],
                "c" => $value['c'],
                "rute" => $value['rute']
            );
            transport($data_print);
            tmp($data_print);
            hotel($data_print);
            ?>
        </div>
    </div>
<?php
}
