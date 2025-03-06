<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query_staff = "SELECT * FROM  login_staff where id=" . $_SESSION['staff_id'];
$rs_staff = mysqli_query($con, $query_staff);
$row_staff = mysqli_fetch_array($rs_staff);



?>
<div class="content-wrapper">
  <form action="">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="font-weight:bold;">Landtour VS Overland Tips</h3>
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
                        <?php
                        $query_vmeal = "SELECT * FROM  LTVS_add_meal  where tour_id=" . $_POST['id'];
                        $rs_vmeal = mysqli_query($con, $query_vmeal);
                        $row_vmeal = mysqli_fetch_array($rs_vmeal);
                        if ($row_vmeal['bf'] != "" or $row_vmeal['ln'] != "" or $row_vmeal['dn'] != "") {
                          $b = "";
                          $l = "";
                          $d = "";
                          if ($row_vmeal['bf']  != "") {
                            $b = "B";
                          }
                          if ($row_vmeal['ln']  != "") {
                            $l = "L";
                          }
                          if ($row_vmeal['dn']  != "") {
                            $d = "D";
                          }
                          echo "(" . $b . $l . $d . ")";
                        }
                        ?>
                      </div>
                    </div>
                    <input class="form-control form-control-sm" type="text" name="staff" id="staff" value="<?php echo $row_staff['cabang'] ?>" hidden>
                    <?php
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
                    <div style="padding-left: 50px; padding-bottom: 5px;">
                      <div class="row">
                        <div class="col-md-4">
                          <label>NEGARA</label>
                          <input class="form-control form-control-sm" list="negara_list<?php echo $h ?>" name="negara<?php echo $h ?>" id="negara<?php echo $h ?>">
                          <datalist id="negara_list<?php echo $h ?>">
                            <?php
                            $query_meal2 = "SELECT DISTINCT negara FROM Tips_Landtour Order by negara ASC";
                            $rs_meal2 = mysqli_query($con, $query_meal2);
                            while ($row_meal2 = mysqli_fetch_array($rs_meal2)) {
                            ?>
                              <option data-customvalue="<?php echo $row_meal2['negara'] ?>" value="<?php echo $row_meal2['negara'] ?>"></option>
                            <?php
                            }
                            ?>
                          </datalist>
                        </div>
                        <div class="col-md-4">
                          <label>Kurs</label>
                          <input class="form-control form-control-sm" list="kurs_list<?php echo $h ?>" name="kurs<?php echo $h ?>" id="kurs<?php echo $h ?>">
                          <datalist id="kurs_list<?php echo $h ?>">
                            <?php
                            $query_kurs = "SELECT * FROM kurs_bank Order by name ASC";
                            $rs_kurs = mysqli_query($con, $query_kurs);
                            while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
                            ?>
                              <option data-customvalue="<?php echo $row_kurs['name'] ?>" value="<?php echo $row_kurs['name'] ?>"></option>
                            <?php
                            }
                            ?>
                          </datalist>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="padding-left: 50px; padding-bottom: 10px;">
                      <div class="col-md-2">
                        <input type="checkbox" id="cek_tl<?php echo $h ?>" name="cek_tl<?php echo $h ?>">
                        <label style="font-size: 11px;">Tour Leader</label>
                      </div>
                      <div class="col-md-2">
                        <input type="checkbox" id="cek_gui<?php echo $h ?>" name="cek_gui<?php echo $h ?>">
                        <label style="font-size: 11px;">Guide</label>
                      </div>
                      <div class="col-md-2">
                        <input type="checkbox" id="cek_as<?php echo $h ?>" name="cek_as<?php echo $h ?>">
                        <label style="font-size: 11px;">Assistant</label>
                      </div>
                      <div class="col-md-2">
                        <input type="checkbox" id="cek_dr<?php echo $h ?>" name="cek_dr<?php echo $h ?>">
                        <label style="font-size: 11px;">Driver</label>
                      </div>
                      <div class="col-md-2">
                        <input type="checkbox" id="cek_por<?php echo $h ?>" name="cek_por<?php echo $h ?>">
                        <label style="font-size: 11px;">Porter</label>
                      </div>
                      <div class="col-md-2">
                        <input type="checkbox" id="cek_res<?php echo $h ?>" name="cek_res<?php echo $h ?>">
                        <label style="font-size: 11px;">Restaurant</label>
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
  function update_fl() {

    // alert("on");
    var data = {};
    var id = $("input[name=to_id]").val();
    var day = $("input[name=to_day]").val();
    var staff = $("input[name=staff]").val();
    // alert(staff);
    var loop_day = parseInt(day);
    var array_day = [];
    for (var i = 1; i <= loop_day; i++) {
      var tl = "";
      var gui = "";
      var dr = "";
      var por = "";
      var ass = "";
      var res ="";

      if ($('#cek_tl' + i).is(":checked")) {
        tl =  "1";
      }
      if ($('#cek_gui' + i).is(":checked")) {
        gui = "1";
      }
      if ($('#cek_as' + i).is(":checked")) {
        ass = "1";
      }
      if ($('#cek_dr' + i).is(":checked")) {
        dr = "1";
      }
      if ($('#cek_por' + i).is(":checked")) {
        por = "1";
      }
      if ($('#cek_res' + i).is(":checked")) {
        res ="1";
      }
      day = {};
      day['hari'] = i;
      day['negara'] = $("input[name=negara" + i + "]").val();
      day['kurs'] = $("input[name=negara" + i + "]").val();
      day['tl'] = tl;
      day['gui'] = gui;
      day['ass'] = ass;
      day['dr'] = dr;
      day['por'] = por;
      day['res'] = res;

      array_day.push(day);
    }
    data['id'] = id;
    data['day'] = array_day;
    data['staff'] = staff;
    console.log(data['day']);
    $.ajax({
      type: "POST",
      url: "update_vstips.php",
      data: {
        data: data
      },
      success: function(data) {
        alert(data);
        Reloaditin(9, 0, 0);
      }
    });
  }
</script>