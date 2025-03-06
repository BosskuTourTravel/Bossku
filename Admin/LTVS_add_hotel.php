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
            <h3 class="card-title" style="font-weight:bold;">Landtour VS Overland Hotel</h3>
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
                        <div class="col-md-3">
                          <label>Guest Hotel Name</label>
                          <input class="form-control form-control-sm" type="text" name="guest_hotel<?php echo $h ?>" id="guest_hotel<?php echo $h ?>" >
                        </div>
                        <div class="col-md-3">
                          <label>Guest Hotel Twin</label>
                          <input class="form-control form-control-sm" type="text" name="guest_twin<?php echo $h ?>" id="guest_twin<?php echo $h ?>" >
                        </div>
                        <div class="col-md-3">
                          <label>Guest Hotel Triple</label>
                          <input class="form-control form-control-sm" type="text" name="guest_triple<?php echo $h ?>" id="guest_triple<?php echo $h ?>" >
                        </div>
                        <div class="col-md-3">
                          <label>Guest Hotel Family</label>
                          <input class="form-control form-control-sm" type="text" name="guest_family<?php echo $h ?>" id="guest_family<?php echo $h ?>" >
                        </div>
                        <!-- <div class="col-md-4">
                          <label>Guest Hotel Bed</label>
                          <select class="form-control  form-control-sm" name="hotel_bed<?php echo $h ?>" id="hotel_bed<?php echo $h ?>">
                            <option>Twin</option>
                            <option>Triple</option>
                            <option>Single</option>
                          </select>
                        </div> -->
                        <!-- <div class="col-md-4">
                          <label>Guest Hotel Price</label>
                          <input class="form-control form-control-sm" type="text" name="hotel_price<?php echo $h ?>" id="hotel_price<?php echo $h ?>">
                        </div> -->

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

      day = {};
      day['hari'] = i;
      day['hotel_name'] = $("input[name=guest_hotel" + i + "]").val();
      day['hotel_twin'] = $("input[name=guest_twin" + i + "]").val();
      day['hotel_triple'] = $("input[name=guest_triple" + i + "]").val();
      day['hotel_family'] = $("input[name=guest_family" + i + "]").val();
      // day['hotel_bed'] = document.getElementById("hotel_bed"+i).options[document.getElementById("hotel_bed"+i).selectedIndex].value;
      // day['hotel_price'] = $("input[name=hotel_price" + i + "]").val();
      array_day.push(day);
    }
    data['id'] = id;
    data['day'] = array_day;
    data['staff'] = staff;
    console.log(data['day']);
    $.ajax({
      type: "POST",
      url: "update_vshotel.php",
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