<?php
include "../db=connection.php";


if ($_POST['id'] !="") {
      $query_data = "SELECT * FROM LTSUB_itin WHERE id=" . $_POST['id'];
      $rs_data = mysqli_query($con, $query_data);
      $row_data = mysqli_fetch_array($rs_data);
      // var_dump($row_data['landtour']);

      $in = "";
      $out = "";
      if ($row_data['landtour'] != "") {
            $query_itin = "SELECT city_in, city_out FROM LT_itinnew where kode ='" . $row_data['landtour'] . "' order by id ASC limit 1";
            $rs_itin = mysqli_query($con, $query_itin);
            $row_itin = mysqli_fetch_array($rs_itin);

            $in = $row_itin['city_in'];
            $out = $row_itin['city_out'];
            // var_dump($query_itin);
      }

      $json_day = $row_data['hari'];
      // var_dump($in." && ".$out);

?>

      <div class="container" style="padding: 20px;">
            <div class="card">
                  <div class="card-header" style="background-color: green; color: white;">
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="pilihan" id="pilihan0" value="0" checked>
                              <label class="form-check-label" for="pilihan0">FLIGHT</label>
                        </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="pilihan" id="pilihan1" value="1">
                              <label class="form-check-label" for="pilihan1">FERRY</label>
                        </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="pilihan" id="pilihan2" value="2">
                              <label class="form-check-label" for="pilihan2">TRAIN</label>
                        </div>
                        <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="pilihan" id="pilihan3" value="3">
                              <label class="form-check-label" for="pilihan3">LAND TRANS</label>
                        </div>
                  </div>

                  <div class="card-body">
                        <div class="flight" id="flight">
                              <form>
                                    <div class="row">
                                          <div class="col-md-6">
                                                <div style="padding-right: 5px;"> <button type="button" onclick="fungsi_reset(<?php echo $_POST['id'] ?>,<?php echo $row_data['master_id'] ?>)" class="btn btn-danger btn-sm">Reset Flight</button></div>
                                          </div>
                                          <div class="col-md-6" style="text-align: right;">
                                                <div style="padding-right: 5px;"> <button type="button" onclick="LT_itinerary(22,<?php echo $_POST['id'] ?>,<?php echo $row_data['master_id'] ?>)" class="btn btn-primary btn-sm">Add Groub</button></div>

                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                      <label>Grub Flight</label>
                                                      <select class="form-control form-control-sm" id="grub" name="grub" onchange="show_form(this.value,<?php echo $_POST['id'] ?>,<?php echo $row_data['master_id'] ?>)">
                                                            <option value="">Pilih Grub Flight</option>
                                                            <?php
                                                            $query_grub = "SELECT * FROM LTP_grub_flight where city_in='" . $in . "' && city_out='" . $out . "' order by id ASC";
                                                            $rs_grub = mysqli_query($con, $query_grub);
                                                            // var_dump($query_grub);
                                                            while ($row_grub = mysqli_fetch_array($rs_grub)) {
                                                            ?><option value="<?php echo $row_grub['id'] ?>"><?php echo $row_grub['grub_name'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                      </select>
                                                </div>
                                          </div>
                                    </div>

                                    <div id="form_row"></div>
                              </form>
                        </div>
                        <div class="ferry" id="ferry" style="display: none;">
                              <form>
                                    <div class="row">
                                          <div class="col-md-4">
                                                <select class="form-control form-control-sm" name="item_fer" id="item_fer" onchange="fungsi_item_fer()">
                                                      <option selected value="">Pilih Jumlah Item</option>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                      <option value="4">4</option>
                                                      <option value="5">5</option>
                                                      <option value="6">6</option>
                                                      <option value="7">7</option>
                                                </select>
                                          </div>
                                          <div class="col-md-4">
                                                <input type="date" name='tgl_fr' id='tgl_vr'>
                                          </div>
                                    </div>
                                    <?php $f = 1; ?>
                                    <div id="dynamic_ferry" style="padding-top: 10px;">

                                    </div>
                                    <div class="meal-button-add" id="meal-button-add">
                                          <input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_data['id'] ?>">
                                          <input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_data['master_id'] ?>">
                                          <input type="hidden" id="jml_fer" name="jml_fer" value="<?php echo  $f ?>">
                                          <button type="button" class="btn btn-warning" onclick="fungsi_add_ferry()">ADD</button>
                                    </div>
                              </form>
                        </div>
                        <!-- meal package -->
                        <div class="train" id="train" style="display: none;">
                              <form>
                                    <div class="row">
                                          <div class="col-md-4">
                                                <select class="form-control form-control-sm" name="item_tra" id="item_tra" onchange="fungsi_item_tra()">
                                                      <option selected value="">Pilih Jumlah Item</option>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                      <option value="4">4</option>
                                                      <option value="5">5</option>
                                                      <option value="6">6</option>
                                                      <option value="7">7</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div id="dynamic_train" style="padding-top: 10px;">
                                    </div>
                                    <div class="meal-button-add" id="meal-button-add">
                                          <input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_data['id'] ?>">
                                          <input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_data['master_id'] ?>">
                                          <button type="button" class="btn btn-warning" onclick="add_train()">ADD</button>
                                    </div>
                              </form>
                        </div>
                        <div class="land" id="land" style="display: none;">
                              <from>

                              </from>
                        </div>
                        <!-- <div class="tl-fee" id="tl-fee" style="display: none;">tl hhsuhdsud</div> -->

                  </div>
            </div>
            <div style="padding-top: 10px;"></div>
            <div class="card">
                  <div class="card-header" style="background-color: green; color: white; font-weight: bold; text-align: center;">PREVIEW ITINERARY</div>
                  <div class="card-body">
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
                                                                  // var_dump($queryMealH);
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
                                                                  ?>
                                                            </div>
                                                            <?php
                                                            $queryTR = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $loop . "' order by urutan ASC";
                                                            $rsTR = mysqli_query($con, $queryTR);
                                                            //  var_dump($queryTR);
                                                            // var_dump("pppppppppp");

                                                            // $rowTR = mysqli_fetch_array($rsTR);
                                                            $detail = "";
                                                            $type = "";
                                                            while ($rowTR = mysqli_fetch_array($rsTR)) {

                                                                  if ($rowTR['type'] == '1') {
                                                                        $type = "Flight";

                                                                        $query_detail_th = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                                                        $rs_detail_th = mysqli_query($con, $query_detail_th);
                                                                        $row_detail_th = mysqli_fetch_array($rs_detail_th);

                                                                        $detail = $row_detail_th['dept'] . " - " . $row_detail_th['arr'] . " (" . $row_detail_th['take'] . " - " . $row_detail_th['landing'] . ")";
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
                                                                  $queryTmp2 = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah['copy_id'] . "' && hari='" . $rowTambah['hari'] . "'";
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
                                                // var_dump($queryTR);
                                                $detail = "";
                                                $type = "";
                                                while ($rowTR = mysqli_fetch_array($rsTR)) {

                                                      // perbaikan

                                                      if ($rowTR['type'] == '1') {
                                                            $type = "Flight";
                                                            // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $rowTR['transport'];
                                                            // $rsflight = mysqli_query($con, $queryflight);
                                                            // $rowflight = mysqli_fetch_array($rsflight);

                                                            $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                                            $rs_detail = mysqli_query($con, $query_detail);
                                                            $row_detail = mysqli_fetch_array($rs_detail);

                                                            $detail = $row_detail['dept'] . " - " . $row_detail['arr'] . " (" . $row_detail['take'] . " - " . $row_detail['landing'] . ")";
                                                            // var_dump($queryflight);
                                                            // $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . "-" . $rowflight['arr'] . " " . $rowflight['tgl'] . " " . $rowflight['take'] . "-" . $rowflight['landing'];
                                                            //$detail = $rowflight['tgl'] . " " . $rowflight['maskapai'] . " " . $rowflight['dept'] . "-" . $rowflight['arr'] . " " . $rowflight['take'] . "-" . $rowflight['landing'];
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
                                                      // $rowHotel = mysqli_fetch_array($rsHotel);
                                                      while ($rowHotel = mysqli_fetch_array($rsHotel)) {
                                                            // if ($rowHotel['hotel'] == "1") {
                                                            $queryPHotel = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' && hari='" . $rowHotel['hari'] . "'";
                                                            $rsPHotel = mysqli_query($con, $queryPHotel);
                                                            $rowPHotel = mysqli_fetch_array($rsPHotel);

                                                            $queryMaster = "SELECT * FROM  LT_itinnew WHERE id=" . $rowPHotel['hotel_id'];
                                                            $rsMaster = mysqli_query($con, $queryMaster);
                                                            $rowMaster = mysqli_fetch_array($rsMaster);

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

                                                                  $query_detail_th2 = "SELECT * FROM  LTP_route_detail where id='" . $rowTR['transport'] . "'";
                                                                  $rs_detail_th2 = mysqli_query($con, $query_detail_th2);
                                                                  $row_detail_th2 = mysqli_fetch_array($rs_detail_th2);

                                                                  $detail_th2 = $row_detail_th2['dept'] . " - " . $row_detail_th2['arr'] . " (" . $row_detail_th2['take'] . " - " . $row_detail_th['landing'] . ")";
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
                                                            $queryTmp_last = "SELECT * FROM  LTHR_add_listTmp where tour_id='" . $rowTambah2['copy_id'] . "' && hari='" . $rowTambah2['hari'] . "'";
                                                            $rsTmp_last = mysqli_query($con, $queryTmp_last);
                                                            while ($rowTmp_last = mysqli_fetch_array($rsTmp_last)) {
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
                  </div>
            </div>
      </div>

      <script>
            $(document).ready(function() {
                  $('.form-check-input').click(function() {
                        var target = $(this).val();
                        // alert(target);
                        if (target == 0) {
                              $('.flight').show();
                              $('.ferry').hide();
                              $('.train').hide();
                              $('.land').hide();
                              // $('.tl-fee').hide();

                        } else if (target == 1) {
                              $('.flight').hide();
                              $('.ferry').show();
                              $('.train').hide();
                              $('.land').hide();
                              // $('.tl-fee').hide();
                        } else if (target == 2) {
                              $('.flight').hide();
                              $('.ferry').hide();
                              $('.train').show();
                              $('.land').hide();
                              // $('.tl-fee').hide();
                        } else if (target == 3) {
                              $('.flight').hide();
                              $('.ferry').hide();
                              $('.train').hide();
                              $('.land').show();
                              // $('.tl-fee').hide();
                        } else {

                        }
                  });

            });
      </script>
      <script>
            function fungsi_reset(x, y) {
                  var txt;
                  var r = confirm("Are you sure to delete?");
                  if (r == true) {
                        $.ajax({
                              url: "LT_delete_transport_all.php",
                              method: "POST",
                              asynch: false,
                              data: {
                                    id: x,
                              },
                              success: function(data) {
                                    if (data == "success") {
                                          LT_itinerary(33, x, y);
                                    } else {
                                          alert("Fail to Delete");
                                    }
                              }
                        });
                  }
            }

            function show_form(x, y, z) {
                  alert("on");
                  $.ajax({
                        url: "print_show_fl_print.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              x: x,
                              y: y,
                              z: z
                        },
                        success: function(data) {
                              $('#form_row').html(data);
                        }
                  });
            }
      </script>
      <script>
            function fungsi_item() {
                  var item = document.getElementById("item").options[document.getElementById("item").selectedIndex].value;
                  var code = $("input[name=kode_id]").val();
                  $.ajax({
                        url: "LT_addflight_field.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              loop: item,
                              code: code
                        },
                        success: function(data) {
                              $('#dynamic_field').html(data);
                        }
                  })

            }

            function fungsi_item_fer() {
                  var item = document.getElementById("item_fer").options[document.getElementById("item_fer").selectedIndex].value;
                  $.ajax({
                        url: "LT_addferry_field.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              loop: item,
                        },
                        success: function(data) {
                              $('#dynamic_ferry').html(data);
                        }
                  })

            }

            function fungsi_item_tra() {
                  var item = document.getElementById("item_tra").options[document.getElementById("item_tra").selectedIndex].value;
                  // alert(item);
                  $.ajax({
                        url: "LT_addtrain_field.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              loop: item,
                        },
                        success: function(data) {
                              $('#dynamic_train').html(data);
                        }
                  })

            }


            function ferry_type(x) {
                  var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
                  $("#fer_rute" + x).empty();
                  $.post('get_ferry_rute.php', {
                        'brand': type
                  }, function(data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData != '') {
                              $('#fer_rute' + x).append('<option value="">Pilih Rute</option>');
                              for (var i = 0; i < jsonData.length; i++) {
                                    var counter = jsonData[i];
                                    $('#fer_rute' + x).append('<option value=' + counter.nama + '>' + counter.nama + '</option>');
                              }
                        } else {
                              $("#fer_rute" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
                        }
                  });
            }

            function ferry_rute(x) {
                  var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
                  var rute = document.getElementById("fer_rute" + x).options[document.getElementById("fer_rute" + x).selectedIndex].value;
                  $("#fer_name" + x).empty();
                  $.post('get_ferry_rute2.php', {
                        'type': type,
                        'rute': rute
                  }, function(data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData != '') {
                              $('#fer_name' + x).append('<option value="">Pilih Detail</option>');
                              for (var i = 0; i < jsonData.length; i++) {
                                    var counter = jsonData[i];
                                    $('#fer_name' + x).append('<option value=' + counter.id + '>' + counter.ferry_name + ' ' + counter.ferry_class + ' ' + counter.jam_dept + ' ' + counter.jam_arr + '</option>');
                              }
                        } else {
                              $("#fer_name" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
                        }
                  });
            }
      </script>

      <script>
           
            function fungsi_add_ferry() {

                  var jml = document.getElementById("item_fer").options[document.getElementById("item_fer").selectedIndex].value;
                  var copy_id = $("input[name=copy_id]").val();
                  var master_id = $("input[name=master_id]").val();
                  var date_fr = $("input[name=tgl_fr]").val();
                  let formData = new FormData();
                  for (let i = 1; i <= jml; i++) {
                        var hari = $("input[name=fer_hari" + i + "]").val();
                        var urutan = $("input[name=fer_urutan" + i + "]").val();
                        var f_type = document.getElementById("fer_type" + i).options[document.getElementById("fer_type" + i).selectedIndex].value;
                        var f_rute = document.getElementById("fer_rute" + i).options[document.getElementById("fer_rute" + i).selectedIndex].value;
                        var f_name = document.getElementById("fer_name" + i).options[document.getElementById("fer_name" + i).selectedIndex].value;

                        if ((hari == "") || (urutan == "") || (f_type == "") || (f_rute == "") || (f_name == "")) {
                              alert("Silakan isi semua form fields");
                              return false;
                        }


                        formData.append('hari[]', hari);
                        formData.append('urutan[]', urutan);
                        formData.append('f_type[]', f_type);
                        formData.append('f_rute[]', f_rute);
                        formData.append('f_name[]', f_name);
                  }
                  // alert("gagal");
                  formData.append('id', '2');
                  formData.append('jml', jml);
                  formData.append('copy_id', copy_id);
                  formData.append('master_id', master_id);
                  formData.append('date_fr', date_fr);
                  $.ajax({
                        type: 'POST',
                        url: "insert_add_LTtransport.php",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(msg) {
                              alert(msg);
                              // LT_itinerary(4, copy_id, 0);
                              LT_itinerary(25, copy_id, 0);
                        },
                        error: function() {
                              alert("Data Gagal Diupload");
                        }
                  });
            }

            function add_train() {
                  var jml = document.getElementById("item_tra").options[document.getElementById("item_tra").selectedIndex].value;
                  var copy_id = $("input[name=copy_id]").val();
                  var master_id = $("input[name=master_id]").val();
                  let formData = new FormData();
                  for (let i = 1; i <= jml; i++) {
                        var t_tgl = $("input[name=t_tgl" + i + "]").val();
                        var hari = $("input[name=t_hari" + i + "]").val();
                        var urutan = $("input[name=t_urutan" + i + "]").val();
                        var t_name = $("input[name=t_name" + i + "]").val();
                        var t_adult = $("input[name=t_adt" + i + "]").val();
                        var t_child = $("input[name=t_chd" + i + "]").val();
                        var t_infant = $("input[name=t_inf" + i + "]").val();

                        formData.append('t_name[]', t_name);
                        formData.append('t_tgl[]', t_tgl);
                        formData.append('hari[]', hari);
                        formData.append('urutan[]', urutan);
                        formData.append('t_adult[]', t_adult);
                        formData.append('t_child[]', t_child);
                        formData.append('t_infant[]', t_infant);

                  }
                  formData.append('id', '4');
                  formData.append('jml', jml);
                  formData.append('copy_id', copy_id);
                  formData.append('master_id', master_id);
                  $.ajax({
                        type: 'POST',
                        url: "insert_add_LTtransport.php",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(msg) {
                              alert(msg);
                              // LT_itinerary(4, copy_id, 0);
                              LT_itinerary(25, copy_id, 0);
                        },
                        error: function() {
                              alert("Data Gagal Diupload");
                        }
                  });
            }
      </script>
<?php
}
