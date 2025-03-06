<?php
include "../site.php";
include "../db=connection.php";
//export.php  
?>
<div class="accordion" id="transport">
      <?php
      // var_dump($_POST['loop']);
      $sql_tr = "SELECT DISTINCT trans_type FROM Transport_new Order by trans_type ASC";
      $rs_tr = mysqli_query($con, $sql_tr);
      $tr = 1;
      while ($row_tr = mysqli_fetch_array($rs_tr)) {
            if ($row_tr['trans_type'] != "") {
      ?>
                  <div class="card">
                        <div class="card-header" id="transport_head<?php echo $tr ?>" style="background-color: darkgoldenrod; color: white;" data-toggle="collapse" data-target="#transport<?php echo $tr ?>" aria-expanded="true" aria-controls="transport<?php echo $tr ?>">
                              <div><?php echo $row_tr['trans_type'] ?></div>
                        </div>
                        <div class="card-body" style="padding: 5px;">
                              <div id="transport<?php echo $tr ?>" class="collapse" aria-labelledby="transport_head<?php echo $tr ?>" data-parent="#transport">
                                    <div class="row">
                                          <div class="col-md-8" style="padding: 10px;">
                                                <div style="font-weight: bold; text-align: center;">Detail Price</div>
                                                <?php
                                                $i = 0;
                                                $grand_val = 0;
                                                $grand_val_guide = 0;
                                                $lt = 0;
                                                for ($i = 1; $i < $_POST['loop']; $i++) {
                                                      $query_rent = "SELECT * FROM  LT_selected_trans where day ='" . $i . "' && tour_id='" . $_POST['tour_id'] . "'";
                                                      $rs_rent = mysqli_query($con, $query_rent);
                                                      $row_rent = mysqli_fetch_array($rs_rent);

                                                      // echo $i;
                                                      // var_dump($query_rent);
                                                ?>
                                                      <div class="card">
                                                            <div class="card-body" style="padding: 10px;">
                                                                  <div class="tittle">
                                                                        <div class="row">
                                                                              <div class="col-md-6"> <b><?php echo "DAY " . $i ?></b></div>
                                                                              <div class="col-md-6" style="text-align: right;">
                                                                                    <?php
                                                                                    if ($row_rent['id'] != "") {
                                                                                    ?>
                                                                                          <span class="badge bg-success" style="padding: 5px;" data-toggle="modal" data-target="#modal_trans" data-id="<?php echo $i ?>" data-trans="<?php echo $row_tr['trans_type'] ?>" data-tour_id="<?php echo $_POST['tour_id']  ?>"><i class="fa fa-plus"></i></span>
                                                                                          <span class="badge bg-warning" style="padding: 5px;" data-toggle="modal" data-target="#modal_change_trans" data-id="<?php echo $i ?>" data-trans="<?php echo $row_tr['trans_type'] ?>" data-tour_id="<?php echo $_POST['tour_id']  ?>"><i class="fa fa-share"></i></span>
                                                                                          <span class="badge bg-primary" style="padding: 5px;" data-toggle="modal" data-target="#modal_replace_trans" data-id="<?php echo $i ?>" data-trans="<?php echo $row_tr['trans_type'] ?>" data-tour_id="<?php echo $_POST['tour_id'] ?>" data-rent="<?php echo $row_rent['rent_type'] ?>"><i class="fa fa-edit"></i></span>
                                                                                          <span class="badge bg-danger" style="padding: 5px;" onclick="delete_trans(<?php echo $i ?>,'<?php echo $row_tr['trans_type'] ?>',<?php echo $_POST['tour_id'] ?>)"><i class="fa fa-trash"></i></span>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  <div class="table-sel" style="padding-top: 10px;">
                                                                        <table class="table table-striped table-sm" style="font-size: 12px;">
                                                                              <thead>
                                                                                    <tr>
                                                                                          <th scope="col">No</th>
                                                                                          <th scope="col">City</th>
                                                                                          <th scope="col">Agent</th>
                                                                                          <th scope="col">Transport Type</th>
                                                                                          <th scope="col">Rent Type</th>
                                                                                          <th scope="col">Season</th>
                                                                                          <th scope="col">Capacity</th>
                                                                                          <th scope="col">Price</th>
                                                                                    </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                    <?php
                                                                                    $query_val = "SELECT * FROM  LT_selected_trans where day ='" . $i . "' && tour_id='" . $_POST['tour_id'] . "'";
                                                                                    $rs_val = mysqli_query($con, $query_val);
                                                                                    $no = 1;
                                                                                    $gt = 0;

                                                                                    while ($row_val = mysqli_fetch_array($rs_val)) {

                                                                                          if ($row_val['trans_type'] != "") {
                                                                                                // var_dump($i);

                                                                                                $query_trans2 = "SELECT * FROM Transport_new where id=" . $row_val['trans_type'];
                                                                                                $rs_trans2 = mysqli_query($con, $query_trans2);
                                                                                                $row_trans2 = mysqli_fetch_array($rs_trans2);

                                                                                                $query_trans_val = "SELECT * FROM Transport_new where country='" . $row_trans2['country'] . "' && city='" . $row_trans2['city'] . "' && trans_type='" . $row_tr['trans_type'] . "' && " . $row_val['rent_type'] . "!='0' order by " . $row_val['rent_type'] . " ASC";
                                                                                                $rs_trans_val = mysqli_query($con, $query_trans_val);
                                                                                                $row_trans_val = mysqli_fetch_array($rs_trans_val);
                                                                                                // 
                                                                                                if ($row_trans_val['id'] != null) {
                                                                                                      // jika type transport tersedia


                                                                                                      // LT_add_change_trans
                                                                                                      $query_change_trans = "SELECT * FROM LT_add_change_trans where tour_id='" . $_POST['tour_id'] . "' && hari='" . $i . "' && urutan='$no'";
                                                                                                      $rs_change_trans = mysqli_query($con, $query_change_trans);
                                                                                                      $row_change_trans = mysqli_fetch_array($rs_change_trans);

                                                                                                      if ($row_change_trans['id'] == "") {
                                                                                                            $query_agents = "SELECT * FROM agent where id='" . $row_trans_val['agent'] . "'";
                                                                                                            $rs_agents = mysqli_query($con, $query_agents);
                                                                                                            $row_agents = mysqli_fetch_array($rs_agents);
                                                                                                            $p = $row_val['rent_type'];
                                                                                                            if ($lt <= $row_trans_val['seat']) {
                                                                                                                  $lt = $row_trans_val['seat'];
                                                                                                            }
                                                                                    ?>
                                                                                                            <tr style="text-align: left;">
                                                                                                                  <td><?php echo $no ?></td>
                                                                                                                  <td><?php echo $row_trans_val['city'] ?></td>
                                                                                                                  <td><?php echo $row_agents['company'] ?></td>
                                                                                                                  <td><?php echo $row_trans_val['trans_type'] ?></td>
                                                                                                                  <td><?php echo $row_val['rent_type'] ?></td>
                                                                                                                  <td><?php echo $row_trans_val['periode'] ?></td>
                                                                                                                  <td><?php echo $row_trans_val['seat'] ?></td>
                                                                                                                  <td><?php echo "IDR " . number_format($row_trans_val[$p], 0, ",", ".")  ?></td>
                                                                                                            </tr>
                                                                                                      <?php
                                                                                                            $gt = $gt + $row_trans_val[$p];
                                                                                                      } else {
                                                                                                      ?>
                                                                                                            <tr style="text-align: left; color:darkorange">
                                                                                                                  <td><?php echo $no ?></td>
                                                                                                                  <td><?php echo  $row_change_trans['city'] ?></td>
                                                                                                                  <td><?php echo  $row_change_trans['agent'] ?></td>
                                                                                                                  <td><?php echo  $row_change_trans['transport_type'] ?></td>
                                                                                                                  <td><?php echo $row_change_trans['rent_type'] ?></td>
                                                                                                                  <td><?php echo  $row_change_trans['season'] ?></td>
                                                                                                                  <td><?php echo  $row_change_trans['capacity'] ?></td>
                                                                                                                  <td><?php echo "IDR " . number_format($row_change_trans['price'], 0, ",", ".")  ?></td>
                                                                                                            </tr>
                                                                                                      <?php
                                                                                                            $gt = $gt + $row_change_trans['price'];
                                                                                                      }

                                                                                                      ?>
                                                                                                      <!-- adaaaa transport -->
                                                                                                <?php
                                                                                                } else {
                                                                                                      // transport tidak tersedia
                                                                                                ?>
                                                                                                      <input type="hidden" name="idx<?php echo $i ?>" id="idx<?php echo $i ?>" value="<?php echo "0" ?>">
                                                                                                      <?php
                                                                                                      // query cek tambahan manual
                                                                                                      $query_ast = "SELECT * FROM  LT_add_selected_trans where tour_id='" . $_POST['tour_id'] . "' && hari='" . $i . "' && urutan='$no'";
                                                                                                      $rs_ast = mysqli_query($con, $query_ast);
                                                                                                      $row_ast = mysqli_fetch_array($rs_ast);
                                                                                                      // var_dump($query_ast);
                                                                                                      if ($row_ast['id'] != "") {

                                                                                                            $query_trans_ast = "SELECT * FROM Transport_new where city='".$row_ast['city']."' && trans_type ='".$row_tr['trans_type']."'";
                                                                                                            $rs_trans_ast= mysqli_query($con, $query_trans_ast);
                                                                                                            $row_trans_ast = mysqli_fetch_array($rs_trans_ast);
                                                                                                            // var_dump($query_trans_ast);
                                                                                                      ?>
                                                                                                            <tr style="text-align: left; color:darkgreen">
                                                                                                                  <td><?php echo $no ?></td>
                                                                                                                  <td><?php echo  $row_ast['city'] ?></td>
                                                                                                                  <td><?php echo  $row_ast['agent'] ?></td>
                                                                                                                  <td><?php echo  $row_ast['transport_type'] ?></td>
                                                                                                                  <td><?php echo $row_ast['rent_type'] ?></td>
                                                                                                                  <td><?php echo  $row_ast['season'] ?></td>
                                                                                                                  <td><?php echo  $row_ast['capacity'] ?></td>
                                                                                                                  <td><?php echo "IDR " . number_format($row_ast['price'], 0, ",", ".")  ?></td>
                                                                                                            </tr>

                                                                                                      <?php
                                                                                                            $gt = $gt + $row_ast['price'];
                                                                                                      } else {
                                                                                                      ?>
                                                                                                            <tr>
                                                                                                                  <td colspan="8"><b>Transport tidak Tersedia</b></td>
                                                                                                            </tr>
                                                                                    <?php
                                                                                                      }
                                                                                                }
                                                                                          }
                                                                                          $no++;
                                                                                    }
                                                                                    ?>

                                                                              </tbody>
                                                                              <tfoot>
                                                                                    <tr>
                                                                                          <th colspan="7"></th>
                                                                                          <th><?php echo "IDR " . number_format($gt, 0, ",", ".") ?></th>
                                                                                    </tr>
                                                                              </tfoot>
                                                                        </table>
                                                                  </div>
                                                                  <div class="table_guide">
                                                                        <div>Guide</div>
                                                                        <table class="table table-striped table-sm" style="font-size: 12px;">
                                                                              <thead>
                                                                                    <tr>
                                                                                          <th scope="col">NO</th>
                                                                                          <th scope="col">Country</th>
                                                                                          <th scope="col">FEE</th>
                                                                                          <th scope="col">SFEE</th>
                                                                                          <th scope="col">BREAKFAST</th>
                                                                                          <th scope="col">LUNCH</th>
                                                                                          <th scope="col">DINNER</th>
                                                                                          <th scope="col">VOUCHER TLPN</th>
                                                                                          <th scope="col">Total</th>
                                                                                    </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                    <?php
                                                                                    $query_guide = "SELECT * FROM  LT_add_guide_new  where hari='$i' && tour_id='" . $_POST['tour_id'] . "'";
                                                                                    $rs_guide = mysqli_query($con, $query_guide);
                                                                                    $n = 1;
                                                                                    $grand_guide = 0;
                                                                                    while ($row_guide = mysqli_fetch_array($rs_guide)) {
                                                                                          $query_fee = "SELECT * FROM Guide_Meal where id='" . $row_guide['fee'] . "'";
                                                                                          $rs_fee = mysqli_query($con, $query_fee);
                                                                                          $row_fee = mysqli_fetch_array($rs_fee);

                                                                                          $query_sfee = "SELECT * FROM Guide_Meal where id='" . $row_guide['sfee'] . "'";
                                                                                          $rs_sfee = mysqli_query($con, $query_sfee);
                                                                                          $row_sfee = mysqli_fetch_array($rs_sfee);

                                                                                          $query_bf = "SELECT * FROM Guide_Meal where id='" . $row_guide['bf'] . "'";
                                                                                          $rs_bf = mysqli_query($con, $query_bf);
                                                                                          $row_bf = mysqli_fetch_array($rs_bf);

                                                                                          $query_ln = "SELECT * FROM Guide_Meal where id='" . $row_guide['ln'] . "'";
                                                                                          $rs_ln = mysqli_query($con, $query_ln);
                                                                                          $row_ln = mysqli_fetch_array($rs_ln);

                                                                                          $query_dn = "SELECT * FROM Guide_Meal where id='" . $row_guide['dn'] . "'";
                                                                                          $rs_dn = mysqli_query($con, $query_dn);
                                                                                          $row_dn = mysqli_fetch_array($rs_dn);

                                                                                          $query_vt = "SELECT * FROM Guide_Meal where id='" . $row_guide['vt'] . "'";
                                                                                          $rs_vt = mysqli_query($con, $query_vt);
                                                                                          $row_vt = mysqli_fetch_array($rs_vt);

                                                                                          $guide_total = $row_fee['harga'] + $row_sfee['harga'] + $row_bf['harga'] + $row_ln['harga'] + $row_dn['harga'] + $row_vt['harga'];


                                                                                    ?>
                                                                                          <tr>
                                                                                                <td><?php echo $n ?></td>
                                                                                                <td><?php echo $row_guide['negara'] ?></td>
                                                                                                <td><?php echo number_format($row_fee['harga'], 0, ",", ".") ?></td>
                                                                                                <td><?php echo number_format($row_sfee['harga'], 0, ",", ".") ?></td>
                                                                                                <td><?php echo number_format($row_bf['harga'], 0, ",", ".") ?></td>
                                                                                                <td><?php echo number_format($row_ln['harga'], 0, ",", ".") ?></td>
                                                                                                <td><?php echo number_format($row_dn['harga'], 0, ",", ".") ?></td>
                                                                                                <td><?php echo  number_format($row_vt['harga'], 0, ",", ".") ?></td>
                                                                                                <td><?php echo "IDR " . number_format($guide_total, 0, ",", ".") ?></td>
                                                                                          </tr>
                                                                                    <?php
                                                                                          $n++;
                                                                                          $grand_guide = $grand_guide + $guide_total;
                                                                                    }
                                                                                    ?>

                                                                              </tbody>
                                                                              <tfoot>
                                                                                    <tr>
                                                                                          <th colspan="8"></th>
                                                                                          <th><?php echo "IDR " . number_format($grand_guide, 0, ",", ".") ?></th>
                                                                                    </tr>
                                                                              </tfoot>
                                                                        </table>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                <?php
                                                      $grand_val = $grand_val + $gt;
                                                      $grand_val_guide = $grand_val_guide + $gt + $grand_guide;
                                                      // var_dump($i);
                                                }
                                                ?>
                                          </div>
                                          <div class="col-md-4">
                                                <div style="font-weight: bold; text-align: center;">Price List / Pax</div>
                                                <div class="card">
                                                      <div class="card-body" style="padding: 10px;">

                                                            <div class="table-pax" style="padding-top: 10px;">
                                                                  <table class="table table-striped table-sm" style="font-size: 12px;">
                                                                        <thead>
                                                                              <tr>
                                                                                    <th scope="col">Pax</th>
                                                                                    <th scope="col">Price</th>
                                                                                    <th scope="col">Price + Guide</th>
                                                                              </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                              <?php

                                                                              for ($a = 1; $a <= $lt; $a++) {
                                                                                    $val = $grand_val / $a;
                                                                                    $val_guide = $grand_val_guide / $a;
                                                                              ?>
                                                                                    <tr>
                                                                                          <td><?php echo $a ?></td>

                                                                                          <td><?php echo "IDR " . number_format($val, 0, ",", ".") ?></td>
                                                                                          <td><?php echo "IDR " . number_format($val_guide, 0, ",", ".") ?></td>
                                                                                    </tr>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </tbody>
                                                                  </table>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>

                              </div>
                        </div>
                        <div class="card-footer" style="padding: 5px;">
                              <div style="text-align: right; font-weight: bold;"><?php echo "IDR " . number_format($grand_val, 0, ",", ".") ?></div>
                        </div>
                  </div>
      <?php
                  $tr++;
            }
      }
      ?>


      <!-- card trans -->
      <div class="modal fade" id="modal_trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                        <div class="modal-header" style="background-color: darkgreen; color: white;">
                              <h5 class="modal-title" id="exampleModalLabel">Modal ADD Transport (Tambah Transport Manual)</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: white;">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
                              <div class="modal-data-add"></div>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-success btn-sm" onclick="fungsi_add_trans(<?php echo $_POST['tour_id'] ?>)">Submit</button>
                        </div>
                  </div>
            </div>
      </div>
      <!-- card trans -->
      <div class="modal fade" id="modal_change_trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                        <div class="modal-header" style="background-color: darkgoldenrod; color: white;">
                              <h5 class="modal-title" id="exampleModalLabel">Modal Change Transport (Ganti Transport yg sudah ada dengan Manual)</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: white;">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
                              <div class="modal-data-change"></div>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-warning btn-sm" onclick="fungsi_change_trans(<?php echo $_POST['tour_id'] ?>)">Submit</button>
                        </div>
                  </div>
            </div>
      </div>
      <div class="modal fade" id="modal_replace_trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                        <div class="modal-header" style="background-color: darkblue; color: white;">
                              <h5 class="modal-title" id="exampleModalLabel">Modal Replace Transport (Ganti Transport yg sudah ada dari database)</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: white;">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
                              <div class="modal-data-replace"></div>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-primary btn-sm" onclick="fungsi_replace_trans(<?php echo $_POST['tour_id'] ?>)">Submit</button>
                        </div>
                  </div>
            </div>
      </div>
</div>
<script>
      $(document).ready(function() {
            $('#modal_trans').on('show.bs.modal', function(e) {
                  var id = $(e.relatedTarget).data('id');
                  var trans = $(e.relatedTarget).data('trans');
                  var tour_id = $(e.relatedTarget).data('tour_id');
                  $.ajax({
                        url: "modal_add_trans.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              id: id,
                              trans: trans,
                              tour_id: tour_id
                        },
                        success: function(data) {
                              $('.modal-data-add').html(data);
                        }
                  });
            });
            $('#modal_change_trans').on('show.bs.modal', function(e) {
                  var id = $(e.relatedTarget).data('id');
                  var trans = $(e.relatedTarget).data('trans');
                  var tour_id = $(e.relatedTarget).data('tour_id');
                  var change = $("input[name=cek_change" + id + "]").val();
                  $.ajax({
                        url: "modal_change_trans.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              id: id,
                              trans: trans,
                              tour_id: tour_id,
                              change: change
                        },
                        success: function(data) {
                              $('.modal-data-change').html(data);
                        }
                  });
            });
            $('#modal_replace_trans').on('show.bs.modal', function(e) {
                  var id = $(e.relatedTarget).data('id');
                  var trans = $(e.relatedTarget).data('trans');
                  var tour_id = $(e.relatedTarget).data('tour_id');
                  var rent = $(e.relatedTarget).data('rent');
                  var change = $("input[name=cek_replace" + id + "]").val();
                  if (change !== undefined) {
                        $.ajax({
                              url: "modal_replace_trans.php",
                              method: "POST",
                              asynch: false,
                              data: {
                                    id: id,
                                    trans: trans,
                                    tour_id: tour_id,
                                    change: change,
                                    rent: rent
                              },
                              success: function(data) {
                                    $('.modal-data-replace').html(data);
                              }
                        });
                  }

            });
      });
</script>
<script>
      function fungsi_add_trans(x) {
            let formData = new FormData();
            var loop = $("input[name=loop_trans]").val();
            var hari = $("input[name=hari_trans]").val();
            var trans = $("input[name=trans_type]").val();
            for (let i = 1; i < loop; i++) {
                  var city = document.getElementById('city' + i).value;
                  var agent = $("input[name=agent" + i + "]").val();
                  var season = $("input[name=season" + i + "]").val();
                  var rent = document.getElementById('rent' + i).value;
                  var capacity = $("input[name=capacity" + i + "]").val();
                  var price = $("input[name=price" + i + "]").val();

                  formData.append('city' + i, city);
                  formData.append('agent' + i, agent);
                  formData.append('season' + i, season);
                  formData.append('rent' + i, rent);
                  formData.append('capacity' + i, capacity);
                  formData.append('price' + i, price);

            }
            formData.append('loop', loop);
            formData.append('tour_id', x);
            formData.append('hari', hari);
            formData.append('trans', trans);
            // alert(hari);
            $.ajax({
                  type: 'POST',
                  url: "insert_add_trans_val.php",
                  data: formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                  success: function(msg) {
                        alert(msg);
                        // LT_Package(15, 0, 0);
                  },
                  error: function() {
                        alert("Data Gagal Diupload");
                  }
            });
      }

      function fungsi_change_trans(x) {
            let formData = new FormData();
            var loop = $("input[name=loop_trans]").val();
            var hari = $("input[name=hari_trans]").val();
            var trans = $("input[name=trans_type]").val();
            for (let i = 1; i < loop; i++) {
                  var city = document.getElementById('city' + i).value;
                  var agent = $("input[name=agent" + i + "]").val();
                  var season = $("input[name=season" + i + "]").val();
                  var rent = document.getElementById('rent' + i).value;
                  var capacity = $("input[name=capacity" + i + "]").val();
                  var price = $("input[name=price" + i + "]").val();

                  formData.append('city' + i, city);
                  formData.append('agent' + i, agent);
                  formData.append('season' + i, season);
                  formData.append('rent' + i, rent);
                  formData.append('capacity' + i, capacity);
                  formData.append('price' + i, price);
            }
            formData.append('loop', loop);
            formData.append('tour_id', x);
            formData.append('hari', hari);
            formData.append('trans', trans);
            $.ajax({
                  type: 'POST',
                  url: "insert_change_trans_val.php",
                  data: formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                  success: function(msg) {
                        alert(msg);
                  },
                  error: function() {
                        alert("Data Gagal Diupload");
                  }
            });
      }


      function fungsi_replace_trans(x) {
            let formData = new FormData();
            var loop = $("input[name=loop_trans]").val();
            var hari = $("input[name=hari_trans]").val();
            var trans = $("input[name=trans_type]").val();
            var rent = $("input[name=rent]").val();
            for (let i = 1; i < loop; i++) {
                  var city = document.getElementById('city' + i).value;
                  var agent = $("input[name=agent" + i + "]").val();
                  var season = $("input[name=season" + i + "]").val();
                  var rent = document.getElementById('rent' + i).value;
                  var capacity = $("input[name=capacity" + i + "]").val();
                  var price = $("input[name=price" + i + "]").val();

                  formData.append('city' + i, city);
                  formData.append('agent' + i, agent);
                  formData.append('season' + i, season);
                  formData.append('rent' + i, rent);
                  formData.append('capacity' + i, capacity);
                  formData.append('price' + i, price);
            }
            formData.append('loop', loop);
            formData.append('tour_id', x);
            formData.append('hari', hari);
            formData.append('trans', trans);
            $.ajax({
                  type: 'POST',
                  url: "insert_change_trans_val.php",
                  data: formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                  success: function(msg) {
                        alert(msg);
                  },
                  error: function() {
                        alert("Data Gagal Diupload");
                  }
            });
      }

      function delete_trans(x, y, z) {
            var txt;
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                  var id = x;
                  var trans = y;
                  var tour_id = z;
                  var change = $("input[name=cek_change" + id + "]").val();
                  $.ajax({
                        url: "modal_delete_trans.php",
                        method: "POST",
                        asynch: false,
                        data: {
                              id: id,
                              trans: trans,
                              tour_id: tour_id,
                              change: change
                        },
                        success: function(data) {
                              alert(data);
                              LT_itinerary(37, tour_id, 0);
                        }
                  });
            }

      }
</script>