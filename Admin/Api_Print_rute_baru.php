<?php
function add_rute_AH($value)
{
    include "../db=connection.php";
    $queryTambah = "SELECT * FROM  LT_AH_Main where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && grub_id='".$value['grub_id']."' && hari='" . $value['c'] . "'";
    $rsTambah = mysqli_query($con, $queryTambah);
    $rowTambah = mysqli_fetch_array($rsTambah);
    // var_dump($queryTambah);

    if ($rowTambah['id'] != "") {
        $hari = $value['cek_hari'];
?>
        <div class="row" style="padding-top: 10px;">
            <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
                <div><u>Hari <?php echo $hari ?></u></div>
                <div> <?php echo $value['date']  ?></div>
            </div>
            <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                <div style="font-size: 14pt;"><u><b><?php echo $rowTambah['rute'] ?></b></u>
                    <?php
                    $queryMealH = "SELECT * FROM LT_AH_ListMeal where tour_id='" . $value['copy'] . "' && grub_id='".$value['grub_id']."' && hari='" . $rowTambah['hari'] . "'";
                    $rsMealH = mysqli_query($con, $queryMealH);
                    $rowMealH = mysqli_fetch_array($rsMealH);
                    // var_dump($queryMealH);
                    if ($rowMealH['id'] != "") {
                        if ($rowMealH['bf'] != '0' or $rowMealH['ln'] != '0' or $rowMealH['dn'] != '0') {
                            $b = "";
                            $l = "";
                            $d = "";
                            if ($rowMealH['bf'] != '0') {
                                $b = "Breakfast";
                            }
                            if ($rowMealH['ln'] != '0') {
                                $l = " // Lunch ";
                            }
                            if ($rowMealH['dn'] != '0') {
                                $d = " // Dinner";
                            }
                            echo "(" . $b . $l . $d . ")";
                        }
                    }
                    ?>
                </div>
                <?php
                $queryTR = "SELECT * FROM  LT_add_transport_baru where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && grub_id='" . $value['grub_id'] . "' &&  hari='" .  $value['c'] . "' order by urutan ASC";
                $rsTR = mysqli_query($con, $queryTR);
                $detail = "";
                $type = "";
                // var_dump($queryTR);
                while ($rowTR = mysqli_fetch_array($rsTR)) {

                    if ($rowTR['type'] == '1') {
                        $type = "Flight";

                        $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                        $rsflight = mysqli_query($con, $queryflight);
                        $rowflight = mysqli_fetch_array($rsflight);
                        $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";
                    } else if ($rowTR['type'] == '2') {
                        $type = "Ferry";
                        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
                        $rs_ferry = mysqli_query($con, $query_ferry);
                        $row_ferry = mysqli_fetch_array($rs_ferry);
                        $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                    } else if ($rowTR['type'] == '4') {
                        $type = "Train";
                        $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR['transport'];
                        $rs_train = mysqli_query($con, $query_train);
                        $row_train = mysqli_fetch_array($rs_train);
                        $detail = $row_train['nama'];
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
                    $queryTmp2 = "SELECT * FROM LT_AH_ListTempat where tour_id='" . $value['copy'] . "' && grub_id='".$value['grub_id']."' && hari='" . $value['c'] . "' order by urutan ASC";
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
                <?php
                $data_h = array(
                    "copy" => $value['copy'],
                    "master" => $value['master'],
                    "grub_id" => $value['grub_id'],
                    "sfee_id" => $value['sfee_id'],
                    "hari" => $value['c']
                );
                hotel_for_lt_AH($data_h);
                ?>

            </div>
        </div>
    <?php

    } else {
        // var_dump("on");
        // $hari = $value['c'] - 1;
        $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $value['master'] . "' && hari='" . $value['cek_hari'] . "'";
        $rsRute = mysqli_query($con, $queryRute);
        $rowRute = mysqli_fetch_array($rsRute);
        // var_dump($queryRute);

        $query_rute_hide = "SELECT * FROM LT_Rute where copy_id='" . $value['copy'] . "' && master_id='" . $value['master'] . "' && grub_id='".$value['grub_id']."' && hari='" . $value['cek_hari'] . "'";
        $rs_rute_hide = mysqli_query($con, $query_rute_hide);
        $row_rute_hide = mysqli_fetch_array($rs_rute_hide);
        // var_dump($query_rute_hide);


        // var_dump($queryRute);
    ?>
        <div class="row" style="padding-top: 10px;">
            <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;">
                <div><u>Hari <?php echo $value['c'] ?></u></div>
                <div><?php echo $value['date'] ?></div>
            </div>
            <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                <?php
                $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $value['master'] . "' && hari='" . $value['cek_hari'] . "'";
                $rsMeal = mysqli_query($con, $queryMeal);
                $rowMeal = mysqli_fetch_array($rsMeal);
                //  var_dump($queryMeal);
                $meal = "";
                if ($rowMeal['bf'] != '0' or $rowMeal['ln'] != '0' or $rowMeal['dn'] != '0') {
                    $b = "";
                    $l = "";
                    $d = "";
                    if ($rowMeal['bf'] != '0') {
                        $b = "Breakfast";
                    }
                    if ($rowMeal['ln'] != '0') {
                        $l = "// Lunch";
                    }
                    if ($rowMeal['dn'] != '0') {
                        $d = "// Dinner";
                    }
                    $meal = "(" . $b . $l . $d . ")";
                }

                if ($row_rute_hide['id'] == "") {
                ?>
                    <div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u><?php echo $meal ?></div>
                <?php
                } else {
                ?>
                    <div style="font-size: 14pt;"><u><b><?php echo $row_rute_hide['nama'] ?></b></u><?php echo $meal ?></div>
                <?php
                }
                ?>

                <?php
                $data_print = array(
                    "hari" => $value['cek_hari'],
                    "hari_asli" => $value['c'],
                    "date" => $value['date'],
                    "copy" => $value['copy'],
                    "master" => $value['master'],
                    "sfee_id" => $value['sfee_id'],
                    "grub_id" => $value['grub_id'],
                    "lte_rute" => $row_rute_hide['id']
                );
                // var_dump($data_print);
                transport_AH($data_print);
                tmp_AH($data_print);
                hotel_AH($data_print);
                ?>
            </div>
        </div>
    <?php

    }
}

function transport_AH($value)
{
    include "../db=connection.php";
    $queryTR = "SELECT * FROM  LT_add_transport_baru where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && grub_id='".$value['grub_id']."'  && hari='" . $value['hari_asli'] . "' order by urutan ASC";
    $rsTR = mysqli_query($con, $queryTR);
    // var_dump($queryTR);
    $detail = "";
    $type = "";
    while ($rowTR = mysqli_fetch_array($rsTR)) {

        if ($rowTR['type'] == '1') {
            $type = "Flight";
            $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
            $rsflight = mysqli_query($con, $queryflight);
            $rowflight = mysqli_fetch_array($rsflight);
            $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";
        } else if ($rowTR['type'] == '2') {
            $type = "Ferry";
            $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR['transport'];
            $rs_ferry = mysqli_query($con, $query_ferry);
            $row_ferry = mysqli_fetch_array($rs_ferry);
            $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
        } else if ($rowTR['type'] == '4') {
            $type = "Train";
            $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR['transport'];
            $rs_train = mysqli_query($con, $query_train);
            $row_train = mysqli_fetch_array($rs_train);

            $detail = $row_train['nama'];
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
            <?php echo   $type . " : " . $detail ?>
        </div>
    <?php
    }
}

function tmp_AH($value)
{
    include "../db=connection.php";


    ?>
    <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
        <?php
        if ($value['lte_rute'] != "") {
            $query_lte_tmp = "SELECT * FROM LT_RT_list_tmp where rute_id='" . $value['lte_rute'] . "' order by urutan ASC";
            //var_dump($query_lte_tmp);
            $rs_lte_tmp = mysqli_query($con, $query_lte_tmp);
            while ($row_lte_tmp = mysqli_fetch_array($rs_lte_tmp)) {
                $query_tempat_lte = "SELECT * FROM List_tempat where id=" . $row_lte_tmp['tmp'];
                $rs_tempat_lte = mysqli_query($con, $query_tempat_lte);
                $row_tempat_lte = mysqli_fetch_array($rs_tempat_lte);
        ?>
                <div style="padding-left: 20px;">
                    <b><?php echo $row_tempat_lte['tempat2'] . " " ?></b><?php echo $row_tempat_lte['keterangan'] ?>
                </div>
            <?php

            }
        }

        $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $value['master'] . "' && hari='" . $value['hari'] . "' order by urutan ASC";
        $rsTmp = mysqli_query($con, $queryTmp);
        // var_dump($queryTmp);
        while ($rowTmp = mysqli_fetch_array($rsTmp)) {
            $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
            $rs_tempat2 = mysqli_query($con, $query_tempat2);
            $row_tempat2 = mysqli_fetch_array($rs_tempat2);

            $query_ops = "SELECT * FROM LT_add_ops where master_id='" . $value['master'] . "' && hari='" . $value['hari'] . "' && urutan='" . $rowTmp['urutan'] . "'";
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
        ?>
    </div>
    <?php
}
function hotel_AH($value)
{
    include "../db=connection.php";

    $queryHotel = "SELECT * FROM  LT_add_pilihHotel where hotel='1' && tour_id='" . $value['master'] . "' && hari='" . $value['hari'] . "'";
    $rsHotel = mysqli_query($con, $queryHotel);
    // var_dump($queryHotel );

    while ($rowHotel = mysqli_fetch_array($rsHotel)) {
        // if ($rowHotel['hotel'] == "1") {
        $queryPHotel = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && hari='" . $value['hari'] . "'";
        $rsPHotel = mysqli_query($con, $queryPHotel);
        $rowPHotel = mysqli_fetch_array($rsPHotel);
        //  var_dump($queryPHotel);

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

function hotel_for_lt_AH($value)
{
    include "../db=connection.php";

    $query_hotel_data = "SELECT * FROM LT_AH_ListHotel WHERE copy_id='" . $value['copy'] . "' and master_id='" . $value['master'] . "' && grub_id='".$value['grub_id']."' && hari='" . $value['hari'] . "'";
    $rs_hotel_data = mysqli_query($con, $query_hotel_data);
    while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
        $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
        $rs_hlt = mysqli_query($con, $query_hlt);
        $row_hlt = mysqli_fetch_array($rs_hlt);
    ?>
        <div style="font-weight: bold; font-size: 12pt;">
            <div class="row">
                <div class="col-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                <div class="col-9">: <?php echo "*" . $row_hlt['class'] . " (" . $row_hlt['name'] . " - " . $row_hlt['type'] . ", " . $row_hlt['city'] . ")" ?></div>
            </div>
        </div>
<?php
    }
}
?>