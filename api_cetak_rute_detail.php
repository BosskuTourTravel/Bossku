<?php
function add_rute_AH($value)
{
    include "db=connection.php";
    $queryTambah = "SELECT * FROM  LT_AH_Main where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && grub_id='" . $value['grub_id'] . "' && hari='" . $value['c'] . "'";
    $rsTambah = mysqli_query($con, $queryTambah);
    $rowTambah = mysqli_fetch_array($rsTambah);
    // var_dump($queryTambah);

    if (isset($rowTambah['id'])) {
        $hari = $value['cek_hari'];
        $b = "";
        $l = "";
        $d = "";
        $queryMealH = "SELECT * FROM LT_AH_ListMeal where tour_id='" . $value['copy'] . "' && grub_id='" . $value['grub_id'] . "' && hari='" . $rowTambah['hari'] . "'";
        $rsMealH = mysqli_query($con, $queryMealH);
        $rowMealH = mysqli_fetch_array($rsMealH);
        if(isset($rowMealH)){
            if ($rowMealH['bf'] != '0') {
                $b = "Breakfast";
            }
            if ($rowMealH['ln'] != '0') {
                $l = "Lunch";
            }
            if ($rowMealH['dn'] != '0') {
                $d = "Dinner";
            }
        }
        $set_meal = "(" . $b . " " . $l . " " . $d . ")";
        // transport
        $queryTR = "SELECT * FROM  LT_add_transport_baru where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && grub_id='" . $value['grub_id'] . "' &&  hari='" .  $value['c'] . "' order by urutan ASC";
        $rsTR1 = mysqli_query($con, $queryTR);
        $rsTR2 = mysqli_query($con, $queryTR);
        // var_dump($queryTR);
        $detail = "";
        $type = "";
?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $value['c'] ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $value['c'] ?>">
                    <div style="font-weight: bold;">
                        <?php echo "Day " . $hari . " : " . $rowTambah['rute'] . " " . $set_meal ?>
                    </div>
            </h2>
            <div id="flush-collapse<?php echo $value['c'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordion-tmp">
                <div class="accordion-body">
                    <div class="col-12" style="color: grey; text-align: end; font-weight: bold;">
                        <?php
                        if ($value['date'] != "") {
                            echo date("j F  Y", strtotime($value['date']));
                        }
                        //  echo $value['date'] 
                        ?>
                    </div>
                    <div class="row" style="font-size: 9pt;">
                        <div class="col-6">
                            <?php
                            while ($rowTR = mysqli_fetch_array($rsTR1)) {
                                if ($rowTR['type'] == '1') {
                                    $type = "Flight";
                                    $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                    $rsflight = mysqli_query($con, $queryflight);
                                    $rowflight = mysqli_fetch_array($rsflight);
                                    $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";
                            ?>
                                    <div style="font-weight: bold; color: grey;"><?php echo $detail ?></div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <?php
                            while ($rowTR2 = mysqli_fetch_array($rsTR2)) {
                                // var_dump($rowTR2['type'] );
                                if ($rowTR2['type'] == '2') {
                                    $type = "Ferry";
                                    $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR2['transport'];
                                    $rs_ferry = mysqli_query($con, $query_ferry);
                                    $row_ferry = mysqli_fetch_array($rs_ferry);
                                    $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                            ?>
                                    <div style="font-weight: bold; color: grey;">FERRY : <?php echo $detail ?></div>
                                <?php
                                } else if ($rowTR2['type'] == '4') {
                                    $type = "Train";
                                    $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR2['transport'];
                                    $rs_train = mysqli_query($con, $query_train);
                                    $row_train = mysqli_fetch_array($rs_train);
                                    $detail = $row_train['nama'];

                                ?>
                                    <div style="font-weight: bold; color: grey;">TRAIN : <?php echo $detail ?></div>
                            <?php
                                } else {
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <ul>
                    <?php
                        $queryTmp2 = "SELECT * FROM LT_AH_ListTempat where tour_id='" . $value['copy'] . "' && grub_id='" . $value['grub_id'] . "' && hari='" . $value['c'] . "' order by urutan ASC";
                        $rsTmp2 = mysqli_query($con, $queryTmp2);
                        while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                            $query_tempat22 = "SELECT * FROM List_tempat where id=" . $rowTmp2['tempat'];
                            $rs_tempat22 = mysqli_query($con, $query_tempat22);
                            $row_tempat22 = mysqli_fetch_array($rs_tempat22);

                            $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $rowTambah['id'] . "' && hari='" . $value['cek_hari'] . "' && urutan='" . $rowTmp2['urutan'] . "'";
                            $rs_ops = mysqli_query($con, $query_ops);
                            $row_ops = mysqli_fetch_array($rs_ops);

                            if (!isset($row_ops['id'])) {
                                echo "<li><b>" . $row_tempat22['tempat2'] . "</b> " . $row_tempat22['keterangan'] . "</li>";
                            } else {
                                if ($row_ops['highlight'] == '1') {
                                    array_push($arr_hl,  $row_tempat22['tempat']);
                                }
                                if ($row_ops['optional'] == '1') {
                                    echo "<li><b> [ Optional ] " . $row_tempat22['tempat2'] . "</b> " . $row_tempat22['keterangan'] . "</li>";
                                } else {
                                    echo "<li><b>" . $row_tempat22['tempat2'] . "</b> " . $row_tempat22['keterangan'] . "</li>";
                                }
                            }
                        }
                        ?>
                    </ul>
                    <div class="hotel">
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
            </div>
        </div>
    <?php
    } else {
        $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $value['master'] . "' && hari='" . $value['cek_hari'] . "'";
        $rsRute = mysqli_query($con, $queryRute);
        $rowRute = mysqli_fetch_array($rsRute);

        $query_rute_hide = "SELECT * FROM LT_Rute where copy_id='" . $value['copy'] . "' && master_id='" . $value['master'] . "' && grub_id='" . $value['grub_id'] . "' && hari='" . $value['cek_hari'] . "'";
        $rs_rute_hide = mysqli_query($con, $query_rute_hide);
        $row_rute_hide = mysqli_fetch_array($rs_rute_hide);
        $nama_rute = "";
        if (!isset($row_rute_hide['id'])) {
            $nama_rute = $rowRute['nama'];
        } else {
            $nama_rute = $row_rute_hide['nama'];
        }

        $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $value['master'] . "' && hari='" . $value['cek_hari'] . "'";
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
        $set_meal = "(" . $b . " " . $l . " " . $d . ")";

    ?>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $value['c'] ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $value['c'] ?>">
                    <div style="font-weight: bold;">
                        <?php echo "Day " . $value['c'] . " : " . $nama_rute . " " . $set_meal ?>
                    </div>
            </h2>
            <div id="flush-collapse<?php echo $value['c'] ?>" class="accordion-collapse collapse show" data-bs-parent="#accordion-tmp">
                <div class="accordion-body">
                    <div class="col-12" style="color: grey; text-align: end; font-weight: bold;">
                        <?php
                        if ($value['date'] != "") {
                            echo date("j F  Y", strtotime($value['date']));
                        }
                        //  echo $value['date'] 
                        ?>
                    </div>
                    <?php
                    $data_print = array(
                        "hari" => $value['cek_hari'],
                        "hari_asli" => $value['c'],
                        "date" => $value['date'],
                        "copy" => $value['copy'],
                        "master" => $value['master'],
                        "sfee_id" => $value['sfee_id'],
                        "grub_id" => $value['grub_id'],
                        "lte_rute" => isset($row_rute_hide['id']) ? $row_rute_hide['id'] : '',
                    );
                    // var_dump($data_print);
                    transport_AH($data_print);
                    tmp_AH($data_print);
                    ?>
                    <div style="color: gray; font-weight: bold;">
                        <?php
                        hotel_for_lt($data_print);
                        hotel_for_lt_AH($data_print);
                        ?>
                    </div>

                </div>
            </div>
        </div>









    <?php

    }
}

function transport_AH($value)
{
    include "db=connection.php";
    $queryTR = "SELECT * FROM  LT_add_transport_baru where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && grub_id='" . $value['grub_id'] . "'  && hari='" . $value['hari_asli'] . "' order by urutan ASC";
    $rsTR = mysqli_query($con, $queryTR);
    $rsTR2 = mysqli_query($con, $queryTR);
    // var_dump($queryTR);
    $detail = "";
    $type = "";
    ?>
    <div class="row" style="font-size: 9pt;">
        <div class="col-6">
            <?php
            while ($rowTR = mysqli_fetch_array($rsTR)) {
                if ($rowTR['type'] == '1') {
                    $type = "Flight";
                    $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                    $rsflight = mysqli_query($con, $queryflight);
                    $rowflight = mysqli_fetch_array($rsflight);
                    $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ";
            ?>
                    <div style="font-weight: bold; color: grey;"><?php echo $detail ?></div>
            <?php
                }
            }
            ?>
        </div>
        <div class="col-6" style="text-align: right;">
            <?php
            while ($rowTR2 = mysqli_fetch_array($rsTR2)) {
                if ($rowTR2['type'] == '2') {
                    $type = "Ferry";
                    $query_ferry = "SELECT * FROM ferry_LT  where id=" . $rowTR2['transport'];
                    $rs_ferry = mysqli_query($con, $query_ferry);
                    $row_ferry = mysqli_fetch_array($rs_ferry);
                    $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
            ?>
                    <div style="font-weight: bold; color: grey;">FERRY : <?php echo $detail ?></div>
                <?php
                } else if ($rowTR2['type'] == '4') {
                    $type = "Train";
                    $query_train = "SELECT * FROM train_LTnew where id=" . $rowTR2['transport'];
                    $rs_train = mysqli_query($con, $query_train);
                    $row_train = mysqli_fetch_array($rs_train);
                    $detail = $row_train['nama'];
                ?>
                    <div style="font-weight: bold; color: grey;">TRAIN : <?php echo $detail ?></div>
            <?php
                } else {
                }
            }
            ?>


        </div>
    </div>
<?php
}

function tmp_AH($value)
{
    include "db=connection.php";


?>
    <ul>
        <?php
        if (isset($value['lte_rute'])) {
            $query_lte_tmp = "SELECT * FROM LT_RT_list_tmp where rute_id='" . $value['lte_rute'] . "' order by urutan ASC";
            $rs_lte_tmp = mysqli_query($con, $query_lte_tmp);
            while ($row_lte_tmp = mysqli_fetch_array($rs_lte_tmp)) {
                $query_tempat_lte = "SELECT * FROM List_tempat where id=" . $row_lte_tmp['tmp'];
                $rs_tempat_lte = mysqli_query($con, $query_tempat_lte);
                $row_tempat_lte = mysqli_fetch_array($rs_tempat_lte);
                echo "<li><b>" . $row_tempat_lte['tempat2'] . "</b> " . $row_tempat_lte['keterangan'] . "</li>";
            }
        }
        $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $value['master'] . "' && hari='" . $value['hari'] . "' order by urutan ASC";
        $rsTmp = mysqli_query($con, $queryTmp);
        while ($rowTmp = mysqli_fetch_array($rsTmp)) {
            $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
            $rs_tempat2 = mysqli_query($con, $query_tempat2);
            $row_tempat2 = mysqli_fetch_array($rs_tempat2);

            $query_ops = "SELECT * FROM LT_add_ops where master_id='" . $value['master'] . "' && hari='" . $value['hari'] . "' && urutan='" . $rowTmp['urutan'] . "'";
            $rs_ops = mysqli_query($con, $query_ops);
            $row_ops = mysqli_fetch_array($rs_ops);
            //  var_dump( $query_ops);
            if (!isset($row_ops['id'])) {
                echo "<li><b>" . $row_tempat2['tempat2'] . "</b> " . $row_tempat2['keterangan'] . "</li>";
            } else {
                if ($row_ops['optional'] == '1') {
                    echo "<li><b> [ Optional ] " . $row_tempat2['tempat2'] . "</b> " . $row_tempat2['keterangan'] . "</li>";
                } else {
                    echo "<li><b>" . $row_tempat2['tempat2'] . "</b> " . $row_tempat2['keterangan'] . "</li>";
                }
            }
        }
        ?>
    </ul>
    <?php
}
function hotel_AH($value)
{
    include "db=connection.php";
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
        $nama_hotel = "";
        if ($rowPHotel['no_htl'] == '1') {
            $nama_hotel = $rowMaster['hotel1'];
        } else if ($rowPHotel['no_htl'] == '2') {
            $nama_hotel = $rowMaster['hotel2'];
        } else if ($rowPHotel['no_htl'] == '3') {
            $nama_hotel = $rowMaster['hotel3'];
        } else if ($rowPHotel['no_htl'] == '4') {
            $nama_hotel = $rowMaster['hotel4'];
        } else if ($rowPHotel['no_htl'] == '5') {
            $nama_hotel = $rowMaster['hotel5'];
        } else if ($rowPHotel['no_htl'] == '6') {
            $nama_hotel = $rowMaster['hotel6'];
        } else if ($rowPHotel['no_htl'] == '7') {
            $nama_hotel = $rowMaster['hotel7'];
        } else if ($rowPHotel['no_htl'] == '8') {
            $nama_hotel = $rowMaster['hotel8'];
        } else if ($rowPHotel['no_htl'] == '9') {
            $nama_hotel = $rowMaster['hotel9'];
        } else if ($rowPHotel['no_htl'] == '10') {
            $nama_hotel = $rowMaster['hotel10'];
        } else {
        }


        // var_dump($queryMaster);
        echo "<b>HOTEL : " . $nama_hotel . " </b></br>";
    ?>
<?php
    }
}

function hotel_for_lt($value)
{
    include "db=connection.php";

    $queryPHotel = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $value['master'] . "' && copy_id='" . $value['copy'] . "' && hari='" . $value['hari'] . "'";
    $rsPHotel = mysqli_query($con, $queryPHotel);
    while ($rowPHotel = mysqli_fetch_array($rsPHotel)) {
        $queryMaster = "SELECT * FROM  LT_itinnew WHERE id=" . $rowPHotel['hotel_id'];
        $rsMaster = mysqli_query($con, $queryMaster);
        $rowMaster = mysqli_fetch_array($rsMaster);

        if ($rowPHotel['no_htl'] == '1') {
            echo "<b>HOTEL : " . $rowMaster['hotel1'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '2') {
            echo "<b>HOTEL : " . $rowMaster['hotel2'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '3') {
            echo "<b>HOTEL : " . $rowMaster['hotel3'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '4') {
            echo "<b>HOTEL : " . $rowMaster['hotel4'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '5') {
            echo "<b>HOTEL : " . $rowMaster['hotel5'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '6') {
            echo "<b>HOTEL : " . $rowMaster['hotel6'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '7') {
            echo "<b>HOTEL : " . $rowMaster['hotel7'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '8') {
            echo "<b>HOTEL : " . $rowMaster['hotel8'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '9') {
            echo "<b>HOTEL : " . $rowMaster['hotel9'] . " </b></br>";
        } else if ($rowPHotel['no_htl'] == '10') {
            echo "<b>HOTEL : " . $rowMaster['hotel10'] . " </b></br>";
        } else {
        }
    }
}


function hotel_for_lt_AH($value)
{
    include "db=connection.php";

    $query_hotel_data = "SELECT * FROM LT_AH_ListHotel WHERE copy_id='" . $value['copy'] . "' and master_id='" . $value['master'] . "' && grub_id='" . $value['grub_id'] . "' && hari='" . $value['hari'] . "'";
    $rs_hotel_data = mysqli_query($con, $query_hotel_data);
    // var_dump($query_hotel_data);
    while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
        $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
        $rs_hlt = mysqli_query($con, $query_hlt);
        $row_hlt = mysqli_fetch_array($rs_hlt);

        echo "<b>HOTEL : *" . $row_hlt['class'] . " " . $row_hlt['name'] . " </b></br>";
    }
}
?>