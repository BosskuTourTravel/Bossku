<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query_staff = "SELECT * FROM  login_staff where id=" .$_SESSION['staff_id'];
$rs_staff = mysqli_query($con, $query_staff);
$row_staff = mysqli_fetch_array($rs_staff);
?>
<div class="content-wrapper">
  <form action="">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="font-weight:bold;">Landtour Flight</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append" style="text-align: right;">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <div style="padding:20px;">
              <div class="container">
                <!-- content -->
                <?php
                $query = "SELECT * FROM  Prev_makeLT where id=" . $_POST['id'];
                $rs = mysqli_query($con, $query);
                $row = mysqli_fetch_array($rs);
                $val_data = json_decode($row['data'], true);
                // var_dump($query);
                ?>
                <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
                  <?php echo $row['nama'] ?>
                </div>
                <div class="content">
                  <?php
                  $json_day = $val_data['day'];
                  $h = 1;
                  foreach ($json_day as $loop_day) {
                  ?>
                    <div class="row">
                      <div class="col-md-12">
                        Day <?php echo $h ?> : <u><b><?php echo $loop_day['rute'] ?></b></u>
                      </div>
                    </div>
                    <input class="form-control form-control-sm" type="text" name="staff" id="staff" value="<?php echo $row_staff['cabang'] ?>" hidden>
                    <?php
                    $query_addflight = "SELECT * FROM LT_add_flight  where  tour_id='".$_POST['id']."' && ket=".$row_staff['cabang'];
                    $rs_addflight = mysqli_query($con, $query_addflight);

                    while ($row_addflight = mysqli_fetch_array($rs_addflight)) {
                      $value_add = json_decode($row_addflight['value'], TRUE);
                      foreach ($value_add as $loop_add) {
                        if ($loop_add['hari'] == $h && $loop_add['jml_transport'] != "") {

                          foreach ($loop_add['sel_trans'] as $sel_tr) {
                            if ($sel_tr['transport_type'] == "flight") {
                              $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                              $rs_flight2 = mysqli_query($con, $query_flight2);
                              $row_flight2 = mysqli_fetch_array($rs_flight2);
                              $detail2 = $row_flight2['maskapai'] . " " . $row_flight2['dept'] . "-" . $row_flight2['arr'] . " " . $row_flight2['tgl'] . " " . $row_flight2['take'] . "-" . $row_flight2['landing'];
                    ?>
                              <div style="font-weight: bold;">
                                <i class="fa fa-plane" style="padding-right: 10px;"></i><?php echo  $sel_tr['transport_type'] . " : " . $detail2 ?>
                              </div>
                            <?php

                            } else if ($sel_tr['transport_type'] == "ferry") {
                              $query_ferry = "SELECT * FROM ferry_LT  where id=" . $sel_tr['transport_name'];
                              $rs_ferry = mysqli_query($con, $query_ferry);
                              $row_ferry = mysqli_fetch_array($rs_ferry);
                              $detail2 = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
                            ?>
                              <div style="font-weight: bold;">
                                <i class="fa fa-ship" style="padding-right: 10px;"></i><?php echo  $sel_tr['transport_type'] . " : " . $detail2 ?>
                              </div>
                            <?php
                            } else if ($sel_tr['transport_type'] == "train") {
                              $detail2 = $sel_tr['transport_name'];
                            ?>
                              <div style="font-weight: bold;">
                                <i class="fa fa-ship" style="padding-right: 10px;"></i><?php echo  $sel_tr['transport_type'] . " : " . $detail2 ?>
                              </div>
                        <?php
                            } else {
                            }
                            // var_dump($loop_add['hari']);
                          }
                        }
                      }
                    }


                    foreach ($loop_day['sel_trans'] as $val_pilihan) {
                      if ($val_pilihan['type'] == '1') {

                        ?>
                        <i class="fa fa-plane" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                      <?php
                      } else {
                        $query_tmp = "SELECT * FROM  List_tempat where id='" . $val_pilihan['tujuan'] . "'";
                        $rs_tmp = mysqli_query($con, $query_tmp);
                        $row_tmp = mysqli_fetch_array($rs_tmp);
                      ?>
                        <div class="list-tempat" style="padding-left: 50px;">
                          <b><?php echo $row_tmp['tempat'] . " " ?></b><?php echo $row_tmp['keterangan'] ?>
                        </div>

                      <?php
                      }
                      ?>

                    <?php
                    }
                    ?>
                    <div class="sub-content" style="padding-bottom: 10px;">
                      <div class="add-transport" style="padding-left: 50px; padding-bottom: 20px; padding-top: 10px;">
                        <div class="row">
                          <div class="col-md-2">
                            <select class="form-control form-control-sm" name="<?php echo $h ?>sel_trans" id="<?php echo $h ?>sel_trans" onchange="get_trans(<?php echo $h ?>)">
                              <option value="" selected>JMLH TRANS</option>
                              <?php
                              for ($i = 1; $i <= 10; $i++) {
                              ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                          <!-- <div class="col-md-3">
                            <button type="button" class="btn btn-primary btn-sm add_form_field">Add More</button>
                          </div> -->
                        </div>
                        <div class="<?php echo $h ?>str" name="<?php echo $h ?>str" id="<?php echo $h ?>str" style="padding-top: 5px; padding-bottom: 5px;"></div>
                      </div>
                    </div>
                  <?php
                    $h++;
                  }
                  ?>

                </div>
                <input type="hidden" id="to_day" name="to_day" value="<?php echo $val_data['jml_day'] ?>">
                <input type="hidden" id="to_id" name="to_id" value="<?php echo $_POST['id'] ?>">
                <button type="button" class="btn btn-primary btn-sm" onclick="update_fl()">Submit</button>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
  </form>
</div>
<script>
  function get_trans(x) {
    var a = document.getElementById(x + "sel_trans").options[document.getElementById(x + "sel_trans").selectedIndex].value;
    var day = x;
    $.ajax({
      url: "sub_add_row.php",
      method: "POST",
      asynch: false,
      data: {
        loop: a,
        day: day
      },
      success: function(data) {
        $('#' + x + 'str').html(data);
      }
    });
  }
</script>
<script>
  function check_include(x, y) {
    // alert(y);
    var data = {};
    var arr_chck = [];
    for (var i = 1; i <= x; i++) {
      if ($('#check_' + i).is(":checked")) {
        var value = $("#check_" + i).val();
        arr_chck.push(value);
      }
    }
    console.log(arr_chck);
    data['id'] = y;
    data['include'] = arr_chck;
    $.ajax({
      type: "POST",
      url: "insert_LT_include.php",
      data: {
        data: data
      },
      dataType: "JSON",
      success: function(response) {
        if (response == "success") {
          alert(response);
          // LT_include(0, 0, 0);
        } else {
          alert(response);
        }
      },
    });
    Reloaditin(5, 0, 0);
  }

  function check_exclude(x, y) {
    // alert(y);
    var data = {};
    var arr_chck = [];
    for (var i = 1; i <= x; i++) {
      if ($('#checkex_' + i).is(":checked")) {
        var value = $("#checkex_" + i).val();
        arr_chck.push(value);
      }
    }
    console.log(arr_chck);
    data['id'] = y;
    data['exclude'] = arr_chck;
    $.ajax({
      type: "POST",
      url: "insert_LT_exclude.php",
      data: {
        data: data
      },
      dataType: "JSON",
      success: function(response) {
        alert("ok");
      },
    });
    Reloaditin(5, 0, 0);
  }
</script>
<script>
  function update_fl() {
    // alert("on");
    var data = {};
    var id = $("input[name=to_id]").val();
    var day = $("input[name=to_day]").val();
    var staff = $("input[name=staff]").val();
    alert(staff);
    var loop_day = parseInt(day);
    var array_day = [];
    for (var i = 1; i <= loop_day; i++) {
      day = {};
      day['hari'] = i;
      day['jml_transport'] = document.getElementById(i + "sel_trans").options[document.getElementById(i + "sel_trans").selectedIndex].value;
      var loop_trans = document.getElementById(i + "sel_trans").options[document.getElementById(i + "sel_trans").selectedIndex].value;
      var array_sel_trans = [];
      for (let xt = 1; xt <= loop_trans; xt++) {
        sel_trans = {};
        var trans_type = document.getElementById(i + "pilih_trans" + xt).options[document.getElementById(i + "pilih_trans" + xt).selectedIndex].value;
        if (trans_type == 1) {
          // alert("on sel tr");
          sel_trans['transport_type'] = "flight";
          sel_trans['transport_name'] = $('#' + i + 'flight_val' + xt).val();
          sel_trans['adult'] = $("#" + i + "adult" + xt).val();
          sel_trans['child'] = $("#" + i + "child" + xt).val();
          sel_trans['infant'] = $("#" + i + "infant" + xt).val();
        }
        if (trans_type == 2) {
          sel_trans['transport_type'] = "ferry";
          sel_trans['transport_name'] = $('#' + i + 'ferry_name' + xt).val();
          sel_trans['adult'] = $("#" + i + "adult" + xt).val();
          sel_trans['child'] = $("#" + i + "child" + xt).val();
          sel_trans['infant'] = $("#" + i + "infant" + xt).val();
        }
        if (trans_type == 4) {
          sel_trans['transport_type'] = "train";
          sel_trans['transport_name'] = $('#' + i + 'trainnm' + xt).val();
          sel_trans['adult'] = $("#" + i + "train_adt" + xt).val();
          sel_trans['child'] = $("#" + i + "train_chd" + xt).val();
          sel_trans['infant'] = $("#" + i + "train_inf" + xt).val();
        }
        array_sel_trans.push(sel_trans);
      }
      day['sel_trans'] = array_sel_trans;
      array_day.push(day);
    }
    data['id'] = id;
    data['day'] = array_day;
    data['staff'] = staff;
    console.log(data['day']);
    $.ajax({
      type: "POST",
      url: "update_flight.php",
      data: {
        data: data
      },
      dataType: "JSON",
      success: function(response) {
        if (response == "success") {
          alert(response);
          // Reloaditin(1, 0, 0);
        } else {
          alert(response);
        }
      },
    });
    Reloaditin(5, 0, 0);
  }
</script>

<!-- /.row -->