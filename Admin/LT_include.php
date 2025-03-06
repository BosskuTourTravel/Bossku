<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";

?>
<div class="content-wrapper">
  <form action="">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="font-weight:bold;">Include Itinerary</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append" style="text-align: right;">
                  <!-- <button type="submit" onclick="reloadLandtour(3,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button> -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <div style="padding:20px;">
              <div class="container">
                <div style="padding-top: 5px; padding-bottom: 5px;"></div>
                <div style="border: 2px solid black; padding: 10px;">
                  <div style="text-align: center; font-weight: bold;">INCLUDE </div>
                  <div class="row">
                    <?php
                    $query_include = "SELECT * FROM checkbox_include ORDER BY id ASC";
                    $rs_include = mysqli_query($con, $query_include);
                    $n = 1;
                    while ($row_include = mysqli_fetch_array($rs_include)) {
                    ?>
                      <div class="col-md-4">
                        <input type="checkbox" id="check_<?php echo $row_include['id'] ?>" name="check_<?php echo $row_include['id'] ?>" value="<?php echo $row_include['id'] ?>">
                        <label style="font-size: 8px;"><?php echo $row_include['nama'] ?></label>
                      </div>
                    <?php
                      $n++;
                    }
                    ?>
                  </div>
                  <input class="form-control form-control-sm" type="hidden" name="total_chck" id="total_chck" value="<?php echo $n ?>">
                  <div><button type="button" class="btn btn-primary btn-sm" onclick="check_include(<?php echo $n ?>,<?php echo $_POST['id'] ?>)">Select</button></div>
                </div>
                <div style="padding-top: 5px; padding-bottom: 5px;"></div>
                <div style="border: 2px solid black; padding: 10px;">
                  <div style="text-align: center; font-weight: bold;">EXCLUDE </div>
                  <div class="row">
                    <?php
                    $query_include = "SELECT * FROM checkbox_include ORDER BY id ASC";
                    $rs_include = mysqli_query($con, $query_include);
                    $nx = 1;
                    while ($row_include = mysqli_fetch_array($rs_include)) {
                    ?>
                      <div class="col-md-4">
                        <input type="checkbox" id="checkex_<?php echo $row_include['id'] ?>" name="checkex_<?php echo $row_include['id'] ?>" value="<?php echo $row_include['id'] ?>">
                        <label style="font-size: 8px;"><?php echo $row_include['nama'] ?></label>
                      </div>
                    <?php
                      $nx++;
                    }
                    ?>
                  </div>
                  <input class="form-control form-control-sm" type="hidden" name="total_chck" id="total_chck" value="<?php echo $nx ?>">
                  <div><button type="button" class="btn btn-primary btn-sm" onclick="check_exclude(<?php echo $nx ?>,<?php echo $_POST['id'] ?>)">Select</button></div>
                </div>
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
      success:function(response){
       alert("ok");
        },
    });
    Reloaditin(5, 0, 0);
  }

</script>

<!-- /.row -->