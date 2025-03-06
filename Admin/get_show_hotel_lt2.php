<?php
include "../site.php";
include "../db=connection.php";
include "Api_get_hotel_lt_range.php";
//export.php  
if (isset($_POST['negara'])) {
      $query_hotel_detail = "SELECT * FROM hotel_lt where name='" . $_POST['negara'] . "' Order by id ASC limit 1";
      $rs_hotel_detail = mysqli_query($con, $query_hotel_detail);
      $row_hotel_detail = mysqli_fetch_array($rs_hotel_detail);

      // var_dump($query_hotel_detail_opsi);

      $datareq_d = array(
            "kurs" =>  $row_hotel_detail['kurs'],
            "price" => $row_hotel_detail['rate_low'],
      );
      $datareq_dhigh = array(
            "kurs" =>  $row_hotel_detail['kurs'],
            "price" => $row_hotel_detail['rate_high'],
      );

      $show_rate_d = get_rate($datareq_d);
      $result_rate_d = json_decode($show_rate_d, true);

      $show_rate_dh = get_rate($datareq_dhigh);
      $result_rate_dh = json_decode($show_rate_dh, true);


      // var_dump($query_hotel_detail);
?>
      <div class="card">
            <div class="card-header" style="background-color: darkmagenta; color: white;">
                  <div>
                        <?php echo $row_hotel_detail['name'] ?>
                  </div>
            </div>
            <div class="card-body">
                  <div class="tempat" style="padding: 5px 5px;">
                        <div class="row">
                              <div class="col-md-3">
                                    <div class="card" style="width: 50%;">
                                          <img class="card-img-top" src="https://www.2canholiday.com/Admin/images/performalogo.png" alt="Card image cap">
                                    </div>
                              </div>
                              <div class="col-md-6">
                                    <div><?php for ($i = 0; $i < $row_hotel_detail['class']; $i++) {
                                          ?>
                                                <span class='fa fa-star checked' style="color: goldenrod;"></span>
                                          <?php
                                          } ?>
                                    </div>
                                    <div class="alamat">
                                          <?php echo $row_hotel_detail['addres'] ?>
                                    </div>
                                    <div class="inclusive" style="padding-top: 10px;">
                                          <b>Inclusive : </b><?php echo $row_hotel_detail['inclusive'] ?>
                                    </div>
                                    <div class="quota"><b>Quote: </b><?php echo $row_hotel_detail['quote'] ?></div>
                              </div>
                              <div class="col-md-3" style="text-align: center;">
                                    <div><span class="badge badge-warning">Low Rate :Rp.<?php echo number_format($result_rate_d['price'], 0, ",", ".")  ?></span></div>
                                    <div><span class="badge badge-danger">High Rate :Rp.<?php echo number_format($result_rate_dh['price'], 0, ",", ".")  ?></span></div>
                                    <input type="hidden" name="hi<?php echo $row_hotel_detail['id'] ?>" id="hi<?php echo $row_hotel_detail['id'] ?>" value="0">
                                    <div class="align-text-bottom" style="padding-top: 20px;"><button type="button" class="btn btn-primary btn-sm" onclick="show_hotel_detail(<?php echo $row_hotel_detail['id'] ?>)">Type Hotel</button></div>
                              </div>
                        </div>
                        <div id="card_hotel_detail<?php echo $row_hotel_detail['id'] ?>"></div>
                  </div>
            </div>
      </div>
      <div class="card" style="text-align: center; padding: 20px; background-color: darkcyan; font-size: 24px; font-weight: bold; color: whitesmoke;">
            <?php
            echo "Hotel Lainnya di " . $row_hotel_detail['city'] . " , " . $row_hotel_detail['country']
            ?>
      </div>

      <?php

      $query_hotel = "SELECT DISTINCT name  FROM hotel_lt where name !='".$row_hotel_detail['name']."' && country='" .  $row_hotel_detail['country'] . "' && city='" .  $row_hotel_detail['city'] . "'  Order by rate_low  ASC";
      $rs_hotel = mysqli_query($con, $query_hotel);
      while ($row_hotel =  mysqli_fetch_assoc($rs_hotel)) {

            $query_hotel_detail_opsi = "SELECT * FROM hotel_lt where country='" .$row_hotel_detail['country'] . "' && city='" . $row_hotel_detail['city'] . "' && name='" . $row_hotel['name'] . "' Order by id ASC limit 1";
            $rs_hotel_detail_opsi = mysqli_query($con, $query_hotel_detail_opsi);
            $row_hotel_detail_opsi = mysqli_fetch_array($rs_hotel_detail_opsi);
            // var_dump($query_hotel_detail_opsi);

            if ($row_hotel['name'] != "") {
                  $datareq_d = array(
                        "kurs" =>  $row_hotel_detail_opsi['kurs'],
                        "price" => $row_hotel_detail_opsi['rate_low'],
                  );
                  $datareq_dhigh = array(
                        "kurs" =>  $row_hotel_detail_opsi['kurs'],
                        "price" => $row_hotel_detail_opsi['rate_high'],
                  );

                  $show_rate_d = get_rate($datareq_d);
                  $result_rate_d = json_decode($show_rate_d, true);

                  $show_rate_dh = get_rate($datareq_dhigh);
                  $result_rate_dh = json_decode($show_rate_dh, true);
      ?>
                  <div class="card">
                        <div class="card-header" style="background-color: darkcyan; color: white;">
                              <div>
                                    <?php echo $row_hotel['name'] ?>
                              </div>
                        </div>
                        <div class="card-body">
                              <div class="tempat" style="padding: 5px 5px;">
                                    <div class="row">
                                          <div class="col-md-3">
                                                <div class="card" style="width: 50%;">
                                                      <img class="card-img-top" src="https://www.2canholiday.com/Admin/images/performalogo.png" alt="Card image cap">
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <div><?php for ($i = 0; $i < $row_hotel_detail_opsi['class']; $i++) {
                                                      ?>
                                                            <span class='fa fa-star checked' style="color: goldenrod;"></span>
                                                      <?php
                                                      } ?>
                                                </div>
                                                <div class="alamat">
                                                      <?php echo $row_hotel_detail_opsi['addres'] ?>
                                                </div>
                                                <div class="inclusive" style="padding-top: 10px;">
                                                      <b>Inclusive : </b><?php echo $row_hotel_detail_opsi['inclusive'] ?>
                                                </div>
                                                <div class="quota"><b>Quote: </b><?php echo $row_hotel_detail_opsi['quote'] ?></div>
                                          </div>
                                          <div class="col-md-3" style="text-align: center;">
                                                <div><span class="badge badge-warning">Low Rate :Rp.<?php echo number_format($result_rate_d['price'], 0, ",", ".")  ?></span></div>
                                                <div><span class="badge badge-danger">High Rate :Rp.<?php echo number_format($result_rate_dh['price'], 0, ",", ".")  ?></span></div>
                                                <input type="hidden" name="hi<?php echo $row_hotel_detail_opsi['id'] ?>" id="hi<?php echo $row_hotel_detail_opsi['id'] ?>" value="0">
                                                <div class="align-text-bottom" style="padding-top: 20px;"><button type="button" class="btn btn-primary btn-sm" onclick="show_hotel_detail(<?php echo $row_hotel_detail_opsi['id'] ?>)">Type Hotel</button></div>
                                          </div>
                                    </div>
                                    <div id="card_hotel_detail<?php echo $row_hotel_detail_opsi['id'] ?>"></div>
                              </div>
                        </div>
                  </div>
<?php

            }
      }
      // }
}
?>