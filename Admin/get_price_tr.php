<?php
include "../site.php";
include "../db=connection.php";
//export.php  
// var_dump($_POST['data']);
if ($_POST['data'] != "") {
      $data = json_decode($_POST['data'], true);
      var_dump($data);


?>
      <div style="border: 2px solid; border-color:darkblue; padding: 10px; margin-bottom: 5px; background-color: darkblue;">
            <div style="text-align: center; font-weight: bold; color: white;">TRANSPORT PRICE</div>
      </div>
      <div style="border: 2px solid; border-color:darkblue; padding: 10px; margin-bottom: 5px;">
            <div class="row">
                  <?php
                  $query_trans = "SELECT * FROM  transport_type order by id ASC";
                  $rs_trans = mysqli_query($con, $query_trans);
                  while ($row_trans = mysqli_fetch_array($rs_trans)) {
                        $true = 0;
                        $seat = 0;
                        $price = 0;
                        foreach ($data as $value) {


                              $query_LTR = "SELECT * FROM Transport_new where id='" . $value['trans_id'] . "'";
                              $rs_LTR = mysqli_query($con, $query_LTR);
                              $rowLTR = mysqli_fetch_array($rs_LTR);

                              $query_LTR2 = "SELECT * FROM Transport_new where trans_type like'" . $row_trans['name'] . "' && city='" . $rowLTR['city'] . "' order by oneway ASC limit 1";
                              $rs_LTR2 = mysqli_query($con, $query_LTR2);
                              $rowLTR2 = mysqli_fetch_array($rs_LTR2);
                              // var_dump($value['rent_type']);
                              if ($rowLTR2 != "") {
                                    $seat =  $rowLTR2['seat'];
                                    if ($value['rent_type'] == "oneway") {
                                          $price = $price + $rowLTR2['oneway'];
                                    } else if ($value['rent_type'] == "twoway") {
                                          $price = $price + $rowLTR2['twoway'];
                                    } else if ($value['rent_type'] == "hd1") {
                                          $price = $price + $rowLTR2['hd1'];
                                    } else if ($value['rent_type'] == "hd2") {
                                          $price = $price + $rowLTR2['hd2'];
                                    } else if ($value['rent_type'] == "fd1") {
                                          $price = $price + $rowLTR2['fd1'];
                                    } else if ($value['rent_type'] == "fd2") {
                                          $price = $price + $rowLTR2['fd2'];
                                    } else if ($value['rent_type'] == "kaisoda") {
                                          $price = $price + $rowLTR2['kaisoda'];
                                    } else if ($value['rent_type'] == "luarkota") {
                                          $price = $price + $rowLTR2['luarkota'];
                                    } else {
                                    }
                                    $true++;
                              }
                              // var_dump($query_LTR2);
                        }
                        //     var_dump($price);

                        if (count($data) == $true) {
                  ?>
                              <div class="col-md-6">
                                    <div style="text-align: left; font-weight: bold;">
                                          <div class="row">
                                                <div class="col-md-8">
                                                      <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="chck" name="chck" value="<?php echo $row_trans['id'] ?>">
                                                            <label class="form-check-label" for="exampleCheck1"><?php echo $row_trans['name']  ?></label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3"><a onclick=""><i class="fa fa-exclamation-circle"></i></a></div>
                                          </div>
                                    </div>
                                    <div>
                                          <table class="table table-bordered table-sm">
                                                <thead>
                                                      <tr>
                                                            <th scope="col">PAX</th>
                                                            <th scope="col">PRICE</th>
                                                            <th scope="col">PRICE + GUIDE</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php
                                                      $g = 1;
                                                      for ($i = 1; $i <= $seat; $i++) {
                                                            $harga = $price / $i;
                                                      ?>
                                                            <tr>
                                                                  <th scope="row"><?php echo $i ?></th>
                                                                  <td><?php echo number_format(ceil($harga), 0, ",", "."); ?></td>
                                                                  <?php
                                                                  if ($i == $seat) {
                                                                  ?>
                                                                        <td></td>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <td><?php echo number_format(ceil($harga), 0, ",", "."); ?></td>
                                                                  <?php
                                                                  }
                                                                  ?>

                                                            </tr>
                                                      <?php
                                                      } ?>
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                  <?php
                        }
                  }
                  ?>
                  <!-- <div class="col-md-6">
                        <div style="text-align: left; font-weight: bold;">CUSTOM RENT</div>
                        <div>
                              <table class="table table-bordered table-sm">
                                    <thead>
                                          <tr>
                                                <th scope="col">PAX</th>
                                                <th scope="col">PRICE</th>
                                                <th scope="col">PRICE + GUIDE</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                          </tr>
                                          <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                          </tr>
                                    </tbody>
                              </table>
                        </div>
                  </div> -->
            </div>
      </div>

<?php
} else {
?>
      <div>Mohon Input Form Terlebih Dahulu !!!</div>
<?php
}
?>