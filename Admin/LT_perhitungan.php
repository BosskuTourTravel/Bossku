<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query_staff = "SELECT * FROM  login_staff where id=" . $_SESSION['staff_id'];
$rs_staff = mysqli_query($con, $query_staff);
$row_staff = mysqli_fetch_array($rs_staff);

$query_count = "SELECT COUNT(*) as jumlah FROM checkbox_include2";
$rs_count = mysqli_query($con, $query_count);
$row_count = mysqli_fetch_array($rs_count);
$jml = $row_count['jumlah'];

?>
<div class="content-wrapper">
  <form action="">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="font-weight:bold;">Landtour Preview Perhitungan</h3>
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
                // var_dump($val_data);
                $query_LTNx = "SELECT* FROM LT_itinnew where kode='" . $val_data['landtour_name'] . "'";
                $rs_LTNx = mysqli_query($con, $query_LTNx);
                // var_dump($query_LTNx);
                ?>
                <input type="hidden" id="lt_name" name="lt_name" value="<?php echo  $val_data['landtour_name'] ?>">
                <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
                  <?php echo $row['nama'] ?>
                </div>
                <div class="row" style="padding-bottom: 10px;">

                  <div class="col-md-3">
                    <label style="font-size: 11px;">Jumlah Pax</label>
                    <select class="form-control form-control-sm" nama="sel_pax" id="sel_pax" onchange="fungsi_lthotel(<?php echo $jml ?>)">
                      <option value="" selected>Pilih Pax</option>
                      <?php
                      while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
                      ?>
                        <option value="<?php echo $row_ltn['pax'] ?>">
                          <?php
                          $pax_u = "";
                          $pax_b = "";
                          if ($row_ltn['pax_u'] != 0) {
                            $pax_u = "-" . $row_ltn['pax_u'];
                          }
                          if ($row_ltn['pax_b'] != 0) {
                            $pax_b = "+" . $row_ltn['pax_b'];
                          }
                          echo $row_ltn['pax'] . $pax_u . $pax_b;
                          ?>
                        </option>
                      <?php
                      }
                      ?>

                    </select>
                  </div>
                  <div class="col-md-3">
                    <label style="font-size: 11px;">Pilih Hotel</label>
                    <select class="form-control form-control-sm" nama="sel_htl" id="sel_htl" onchange="fungsi_reset(<?php echo $jml ?>)">
                      <option value="">Pilih Hotel</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    JUMLAH PAX : <?php
                                  $query_lt = "SELECT * FROM  LT_itinnew where id=" . $val_data['landtour_name'];
                                  $rs_lt = mysqli_query($con, $query_lt);
                                  $row_lt = mysqli_fetch_array($rs_lt);
                                  $pax_u = "";
                                  $pax_b = "";
                                  if ($row_lt['pax_u'] != 0) {
                                    $pax_u = "-" . $row_lt['pax_u'];
                                  }
                                  if ($row_lt['pax_b'] != 0) {
                                    $pax_b = "+" . $row_lt['pax_b'];
                                  }
                                  echo $row_lt['pax'] . $pax_u . $pax_b;
                                  ?>
                  </div>
                  <input type="hidden" id="staff" name="staff" value="<?php echo $row_staff['cabang'] ?>">
                  <div class="col-md-3">
                    <div class="form-check">
                      <input class="form-check-input position-static" type="checkbox" id="gt" name="gt" value="gt" onclick="fungsi_gt()" checked>
                      <label class="form-check-label" for="gt">Groub Tour</label>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-check">
                      <input class="form-check-input position-static" type="checkbox" id="pt" name="pt" value="pt" onclick="fungsi_pt()">
                      <label class="form-check-label" for="pt">Private Tour</label>
                    </div>
                  </div>
                </div>
                <div class="content">

                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 70px;">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Detail</th>
                        <th scope="col">TWIN/CWB</th>
                        <th scope="col">CNB</th>
                        <th scope="col">INF</th>
                        <th scope="col">SGL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total_inc = "SELECT COUNT(id) AS ttl FROM checkbox_include2";
                      $rs_inc = mysqli_query($con, $total_inc);
                      $row_inc = mysqli_fetch_array($rs_inc);
                      // var_dump($row_inc['ttl']);
                      $tt = 1;
                      $query_include = "SELECT * FROM checkbox_include2 ORDER BY id ASC";
                      $rs_include = mysqli_query($con, $query_include);
                      while ($row_include = mysqli_fetch_array($rs_include)) {


                      ?>
                        <tr>
                          <td>
                            <div class="form-check">
                              <?php
                              if ($row_include['id'] == 41 or $row_include['id'] == 42 or $row_include['id'] == 43) {
                              ?>
                                <input class="form-check-input position-static" type="checkbox" id="check_<?php echo $row_include['id'] ?>" name="check_<?php echo $row_include['id'] ?>" value="<?php echo $row_include['id'] ?>" disabled>
                                <?php
                              } else {
                                $arr_auto = [1, 2, 3, 4, 7, 8, 15, 16, 18, 19, 20, 21, 22, 23, 24, 26, 27, 28, 30, 32, 34, 35, 36, 37, 38, 39, 40];
                                $cocok = array_search($row_include['id'], $arr_auto);
                                if ($cocok == "") {
                                ?>
                                  <input class="form-check-input position-static" type="checkbox" id="check_<?php echo $row_include['id'] ?>" name="check_<?php echo $row_include['id'] ?>" value="<?php echo $row_include['id'] ?>" onclick="fungsi_detail(<?php echo $row_include['id'] ?>,<?php echo $row_inc['ttl'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['cabang'] ?>)">
                                <?php
                                } else {
                                ?>
                                  <input class="form-check-input position-static" type="checkbox" id="check_<?php echo $row_include['id'] ?>" name="check_<?php echo $row_include['id'] ?>" value="<?php echo $row_include['id'] ?>" onclick="fungsi_detail(<?php echo $row_include['id'] ?>,<?php echo $row_inc['ttl'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['cabang'] ?>)" checked>
                                <?php
                                }
                                ?>

                                <!-- <input class="form-check-input position-static" type="checkbox" id="check_<?php echo $row_include['id'] ?>" name="check_<?php echo $row_include['id'] ?>" value="<?php echo $row_include['id'] ?>" onclick="fungsi_detail(<?php echo $row_include['id'] ?>,<?php echo $row_inc['ttl'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['cabang'] ?>)"> -->
                              <?php
                              }
                              ?>

                            </div>
                          </td>
                          <td><?php
                              if ($row_include['id'] == '32') {
                                echo $row_include['nama'];
                              ?>
                              <div class="myDIV" name="myDIV" id="myDIV" style="display: none;">
                              </div>
                            <?php
                              } else {
                                echo $row_include['nama'];
                              }
                            ?>
                          </td>
                          <!-- detail -->
                          <td>
                            <div class="detail_page<?php echo  $row_include['id'] ?>" id="detail_page<?php echo  $row_include['id'] ?>" style="font-size: 10pt;">
                            </div>
                          </td>
                          <!-- twin -->
                          <td>
                            <div class="twin_page<?php echo  $row_include['id'] ?>" id="twin_page<?php echo  $row_include['id'] ?>">

                            </div>
                          </td>
                          <!-- cnb -->
                          <td>
                            <div class="cnb_page<?php echo  $row_include['id'] ?>" id="cnb_page<?php echo  $row_include['id'] ?>">

                            </div>
                          </td>
                          <!-- inf -->
                          <td>
                            <div class="inf_page<?php echo  $row_include['id'] ?>" id="inf_page<?php echo  $row_include['id'] ?>">

                            </div>
                          </td>
                          <!-- sgl -->
                          <td>
                            <div class="sgl_page<?php echo  $row_include['id'] ?>" id="sgl_page<?php echo  $row_include['id'] ?>">

                            </div>
                          </td>
                        </tr>
                      <?php
                        $tt++;
                      }
                      ?>
                      <tr>
                        <td colspan="2">TOTAL</td>
                        <td></td>
                        <td>
                          <div class="total_page" id="total_page">
                            <input type="hidden" id="total_form" name="total_form">
                        </td>
                        <td>
                          <div class="total_cnb_page" id="total_cnb_page">
                            <input type="hidden" id="total_cnb_form" name="total_cnb_form">
                        </td>
                        <td>
                          <div class="total_inf_page" id="total_inf_page">
                            <input type="hidden" id="total_inf_form" name="total_inf_form">
                        </td>
                        <td>
                          <div class="total_sgl_page" id="total_sgl_page">
                            <input type="hidden" id="total_sgl_form" name="total_sgl_form">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="5">
                          <button type="button" class="btn btn-primary btn-sm" onclick="fungsi_total(<?php echo $tt ?>)">Submit</button>

                        </td>
                        <td colspan="2">
                          <button type="button" class="btn btn-danger btn-sm" onclick="check_include(<?php echo $tt ?>,<?php echo $_POST['id'] ?>)">ADD TO ITIN</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
          <!-- modal -->

          <div class="modal hide" id="addBookDialog">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">x</button>
              <h3>Modal header</h3>
            </div>
            <div class="modal-body">
              <p>some content</p>
              <input type="text" name="bookId" id="bookId" value="" />
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
  </form>
</div>
<script>
  // function fungsi_ltpax() {
  //   var gb = $("#LT_name").val();
  //   var h_gb = $('#ltn_list [value="' + gb + '"]').data('customvalue');
  //   // alert(h_gb);
  //   $.post('get_select_ltpax.php', {
  //     'brand': h_gb
  //   }, function(data) {
  //     var jsonData = JSON.parse(data);
  //     // console.log(jsonData);
  //     if (jsonData != '') {
  //       for (var i = 0; i < jsonData.length; i++) {
  //         var counter = jsonData[i];
  //         $('#sel_pax').append('<option value=' + counter.pax + '>' + counter.pax + '</option>');
  //       }
  //     } else {
  //       $("#sel_pax").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
  //     }
  //   });
  // }

  function fungsi_lthotel(x) {
    var h_gb = $("input[name=lt_name]").val();
    var pax = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
    // alert(x);
    for (var i = 1; i <= x; i++) {
      $("#check_" + i).prop("checked", false);
      $('#detail_page' + i).empty();
      $('#twin_page' + i).empty();
      $('#cnb_page' + i).empty();
      $('#inf_page' + i).empty();
      $('#sgl_page' + i).empty();
    }
    $("#sel_htl").empty();
    $.post('get_select_lt.php', {
      'brand': h_gb,
      'pax': pax,
    }, function(data) {
      var jsonData = JSON.parse(data);
      // console.log(jsonData);
      if (jsonData != '') {
        for (var i = 0; i < jsonData.length; i++) {
          var counter = jsonData[i];
          $('#sel_htl').append('<option value=' + counter.id + '>' + counter.hotel1 + '</option>');
        }
      } else {
        $("#sel_htl").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
      }
    });
  }

  function fungsi_reset(x) {
    for (var i = 1; i <= x; i++) {
      $("#check_" + i).prop("checked", false);
      $('#detail_page' + i).empty();
      $('#twin_page' + i).empty();
      $('#cnb_page' + i).empty();
      $('#inf_page' + i).empty();
      $('#sgl_page' + i).empty();
    }
  }
</script>
<script>
  function fungsi_gt() {
    document.getElementById("check_44").disabled = false;
    document.getElementById("check_45").disabled = false;
    document.getElementById("check_46").disabled = false;
    document.getElementById("check_41").disabled = true;
    document.getElementById("check_42").disabled = true;
    document.getElementById("check_43").disabled = true;
    $("#pt").prop("checked", false);


  }

  function fungsi_pt() {

    document.getElementById("check_44").disabled = true;
    document.getElementById("check_45").disabled = true;
    document.getElementById("check_46").disabled = true;
    document.getElementById("check_41").disabled = false;
    document.getElementById("check_42").disabled = false;
    document.getElementById("check_43").disabled = false;
    $("#gt").prop("checked", false);
  }


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
    var lt_hotel = document.getElementById("sel_htl").options[document.getElementById("sel_htl").selectedIndex].value;
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
    data['cabang'] = $("input[name=staff]").val();
    data['lt_hotel'] = lt_hotel;
    $.ajax({
      type: "POST",
      url: "insert_LT_total.php",
      data: {
        data: data
      },
      success: function(data) {
        Reloaditin(5, 0, 0);
      }
    });
    // Reloaditin(5, 0, 0);
  }

  // function check_exclude(x, y) {
  //   // alert(y);
  //   var data = {};
  //   var arr_chck = [];
  //   for (var i = 1; i <= x; i++) {
  //     if ($('#checkex_' + i).is(":checked")) {
  //       var value = $("#checkex_" + i).val();
  //       arr_chck.push(value);
  //     }
  //   }
  //   console.log(arr_chck);
  //   data['id'] = y;
  //   data['exclude'] = arr_chck;
  //   $.ajax({
  //     type: "POST",
  //     url: "insert_LT_exclude.php",
  //     data: {
  //       data: data
  //     },
  //     dataType: "JSON",
  //     success: function(response) {
  //       alert("ok");
  //     },
  //   });
  //   Reloaditin(5, 0, 0);
  // }
</script>
<script>
  function update_fl() {
    // alert("on");
    var data = {};
    var id = $("input[name=to_id]").val();
    var day = $("input[name=to_day]").val();
    // alert(day);
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
        array_sel_trans.push(sel_trans);
      }
      day['sel_trans'] = array_sel_trans;
      array_day.push(day);
    }
    data['id'] = id;
    data['day'] = array_day;
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


<script>
  function fungsi_detail(x, z, v, w) {
    // x = id
    // z = id tour
    var y = $("input[name=lt_name]").val();
    var lt_hotel = document.getElementById("sel_htl").options[document.getElementById("sel_htl").selectedIndex].value;
    if (x == 1) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var detailv = counter.detail;
          var val_de = "";
          var no = 1
          for (let i = 0; i < detailv.length; ++i) {
            val_de += no + ") " + detailv[i] + "<br>";
            no++;
          }
          var form_twin = "<div><label>" + counter.adt.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter.adt + "'></div>";
          var form_cnb = "<div><label>" + counter.chd.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter.chd + "'></div>";
          var form_inf = "<div><label>" + counter.inf.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter.inf + "'></div>";
          var form_sgl = "<div><label>" + counter.adt.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter.adt + "'></div>";

          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 5) {
      // alert("on  05");
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var harga = 0;
          var val_de = "";
          for (let i = 0; i < counter.length; ++i) {
            harga = harga + counter[i].price;
            if (counter[i].nama != "") {
              val_de += counter[i].nama + "</br>";
            }

          }


          var form_twin = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + harga + "'></div>";
          var form_cnb = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + harga + "'></div>";
          var form_inf = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + harga + "'></div>";
          var form_sgl = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + harga + "'></div>";

          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });

      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 6) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var val_de = "";
          var no = 1
          var bf = 0;
          var ln = 0;
          var dn = 0;
          var d_bf = "";
          var d_ln = "";
          var d_dn = "";
          console.log(counter);

          for (let i = 0; i < counter.length; ++i) {
            bf = bf + parseInt(counter[i].bf);
            ln = ln + parseInt(counter[i].ln);
            dn = dn + parseInt(counter[i].dn);
            if (counter[i].detail_bf != null) {
              d_bf = counter[i].detail_bf;
            }
            if (counter[i].detail_ln != null) {
              d_ln = counter[i].detail_ln;
            }
            if (counter[i].detail_dn != null) {
              d_dn = counter[i].detail_dn;
            }
            // console.log(bf);
            val_de += d_bf + "," + d_ln + "," + d_dn + "</br>";
          }
          var total = parseInt(bf) + parseInt(ln) + parseInt(dn);
          var form_twin = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + total + "'></div>";
          var form_cnb = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + total + "'></div>";
          var form_inf = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + total + "'></div>";
          var form_sgl = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + total + "'></div>";

          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 8) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter.price + "'></div>";
          var form_cnb = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter.price + "'></div>";
          var form_inf = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter.price + "'></div>";
          var form_sgl = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter.price + "'></div>";

          $('#detail_page' + x).html(counter.ket);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 14) {
      if ($('#check_' + x).is(":checked")) {

      }
    } else if (x == 15) {
      if ($('#check_' + x).is(":checked")) {

        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter.twn.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter.twn + "'></div>";
          var form_cnb = "<div><label>" + counter.cnb.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter.cnb + "'></div>";
          var form_inf = "<div><label>" + counter.infant.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter.infant + "'></div>";
          var form_sgl = "<div><label>" + counter.sgl.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter.sgl + "'></div>";
          $('#detail_page' + x).html(counter.kode);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 17) {
      if ($('#check_' + x).is(":checked")) {
        // alert("on cccc");
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          // console.log(counter);
          val_tempat = "";
          price = 0;
          chd = 0;
          inf = 0;
          kurs = "";

          for (var a = 0; a < counter.length; a++) {
            nop = 1;
            //console.log(counter[a]['trans_sel']);
            sel_tr = counter[a]['trans_sel'];
            for (var b = 0; b < sel_tr.length; b++) {
              // sel_tr['tempat']
              // console.log(sel_tr[b]['adult']);
              val_tempat += nop + ") " + sel_tr[b]['tempat'] + "</br>";
              if (sel_tr[b]['adult'] == null) {
                value = 0;
                value_chd = 0;
                value_inf = 0;
              } else {
                value = parseInt(sel_tr[b]['adult']);
                value_chd = parseInt(sel_tr[b]['child']);
                value_inf = parseInt(sel_tr[b]['infant']);
              }
              price = price + value;
              chd = chd + value_chd;
              inf = inf + value_inf;
              nop++;
            }
            val_tempat += "</br>";
          }
          var form_twin = "<div><label>" + price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + price + "'></div>";
          var form_cnb = "<div><label>" + price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + price + "'></div>";
          var form_inf = "<div><label>" + price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + price + "'></div>";
          var form_sgl = "<div><label>" + price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + price + "'></div>";

          $('#detail_page' + x).html(val_tempat);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 18) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          console.log(counter);
          var harga = 0;
          var chd = 0;
          var inf = 0;
          var snr = 0;
          var val_de = "";
          for (let i = 0; i < counter.length; ++i) {
            if (counter[i].adult != "") {
              harga = harga + parseInt(counter[i].adult);
              snr = snr + parseInt(counter[i].snr);
              chd = chd + parseInt(counter[i].chd);
              inf = inf + parseInt(counter[i].inf);
            }
            if (counter[i].nama != "") {
              val_de += counter[i].nama + "</br>";
            }
          }
          var form_twin = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + harga + "'></div>";
          var form_cnb = "<div><label>" + chd.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + chd + "'></div>";
          var form_inf = "<div><label>" + inf.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + inf + "'></div>";
          var form_sgl = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + harga + "'></div>";

          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }

    } else if (x == 19) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          console.log(counter);
          var harga = 0;
          var chd = 0;
          var inf = 0;
          var snr = 0;
          var val_de = "";
          for (let i = 0; i < counter.length; ++i) {
            if (counter[i].adult != "") {
              harga = harga + parseInt(counter[i].adult);
              snr = snr + parseInt(counter[i].snr);
              chd = chd + parseInt(counter[i].chd);
              inf = inf + parseInt(counter[i].inf);
            }
            if (counter[i].nama != "") {
              val_de += counter[i].nama + "</br>";
            }
          }
          var form_twin = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + harga + "'></div>";
          var form_cnb = "<div><label>" + chd.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + chd + "'></div>";
          var form_inf = "<div><label>" + inf.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + inf + "'></div>";
          var form_sgl = "<div><label>" + harga.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + harga + "'></div>";

          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }

    } else if (x == 23) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var detailv = counter.detail;
          var val_de = "";
          var no = 1
          for (let i = 0; i < detailv.length; ++i) {
            val_de += no + ") " + detailv[i] + "<br>";
            no++;
          }
          var form_twin = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter.price + "'></div>";
          var form_cnb = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter.price + "'></div>";
          var form_inf = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter.price + "'></div>";
          var form_sgl = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter.price + "'></div>";

          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 24) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var detailv = counter.detail;
          var total = parseInt(counter.bf) + parseInt(counter.ln) + parseInt(counter.dn);
          var val_de = "";
          var no = 1
          for (let i = 0; i < detailv.length; ++i) {
            val_de += no + ") " + detailv[i] + "<br>";
            no++;
          }
          var form_twin = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + total + "'></div>";
          var form_cnb = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + total + "'></div>";
          var form_inf = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + total + "'></div>";
          var form_sgl = "<div><label>" + total.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + total + "'></div>";
          $('#detail_page' + x).html(val_de);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 26) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_cnb = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_inf = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_sgl = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter[0].price + "'></div>";
          $('#detail_page' + x).html(counter[0].kurs);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 27) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_cnb = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_inf = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_sgl = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter[0].price + "'></div>";
          $('#detail_page' + x).html(counter[0].kurs);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 32) {
      if ($('#check_' + x).is(":checked")) {
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          console.log(counter);
          var form_twin = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter.price + "'></div>";
          var form_cnb = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter.price + "'></div>";
          var form_inf = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter.price + "'></div>";
          var form_sgl = "<div><label>" + counter.price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter.price + "'></div>";
          var link_page = "<div><button type='button' class='btn btn-outline-success btn-sm' onclick='fungsi_view(" + x + "," + w + "," + z + "," + v + "," + lt_hotel + ")'>View Detail</button></div>";
          $('#detail_page' + x).html(link_page);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);
        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 36) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_cnb = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_inf = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_sgl = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter[0].price + "'></div>";
          $('#detail_page' + x).html(counter[0].kurs);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 37) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_cnb = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_inf = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_sgl = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter[0].price + "'></div>";
          $('#detail_page' + x).html(counter[0].kurs);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 38) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_cnb = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_inf = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_sgl = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter[0].price + "'></div>";
          $('#detail_page' + x).html(counter[0].kurs);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else if (x == 39) {
      if ($('#check_' + x).is(":checked")) {
        // alert(i);
        // alert("onn page" + x);
        $.post('sub_twin_page.php', {
          'id': x,
          'tour': y,
          'total': z,
          'itin': v,
          'lt_hotel': lt_hotel,
          'cabang': w
        }, function(data) {
          var counter = JSON.parse(data);
          var form_twin = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='twin_form" + x + "' name='twin_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_cnb = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='cnb_form" + x + "' name='cnb_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_inf = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='inf_form" + x + "' name='inf_form" + x + "' value='" + counter[0].price + "'></div>";
          var form_sgl = "<div><label>" + counter[0].price.toLocaleString('en-US') + "</label><input type='hidden' id='sgl_form" + x + "' name='sgl_form" + x + "' value='" + counter[0].price + "'></div>";
          $('#detail_page' + x).html(counter[0].kurs);
          $('#twin_page' + x).html(form_twin);
          $('#cnb_page' + x).html(form_cnb);
          $('#inf_page' + x).html(form_inf);
          $('#sgl_page' + x).html(form_sgl);

        });
      } else {
        $('#detail_page' + x).empty();
        $('#twin_page' + x).empty();
        $('#cnb_page' + x).empty();
        $('#inf_page' + x).empty();
        $('#sgl_page' + x).empty();
      }
    } else {

    }
  }
</script>
<script>
  function fungsi_total(x) {
    // alert(x);
    // alert(xl);
    total_adt = 0;
    total_cnb = 0;
    total_inf = 0;
    total_sgl = 0;

    for (var a = 1; a <= x; a++) {
      var has = $("input[name=twin_form" + a + "]").val();
      var cnb = $("input[name=cnb_form" + a + "]").val();
      var inf = $("input[name=inf_form" + a + "]").val();
      var sgl = $("input[name=sgl_form" + a + "]").val();
      // console.log(has);
      if (has != null) {
        total_adt = total_adt + parseInt(has);
      }
      if (cnb != null) {
        total_cnb = total_cnb + parseInt(cnb);
      }
      if (inf != null) {
        total_inf = total_inf + parseInt(inf);
      }
      if (sgl != null) {
        total_sgl = total_sgl + parseInt(sgl);
      }
    }
    console.log(total_cnb);
    $('#total_page').html(total_adt.toLocaleString('en-US'));
    $('#total_cnb_page').html(total_cnb.toLocaleString('en-US'));
    $('#total_inf_page').html(total_inf.toLocaleString('en-US'));
    $('#total_sgl_page').html(total_sgl.toLocaleString('en-US'));

    $('#total_form').val(total_adt);
    $('#total_cnb_form').val(total_cnb);
    $('#total_inf_form').val(total_inf);
    $('#total_sgl_form').val(total_sgl);
  }

  function fungsi_view(x, y, z, v, w) {
    // alert(w);
    var u = document.getElementById('myDIV');
    if (u.style.display === "none") {
      $.ajax({
        url: "detail_view_page2.php",
        method: "POST",
        asynch: false,
        data: {
          id: x,
          cabang: y,
          total: z,
          itin: v,
          lt_hotel: w
        },
        success: function(data) {
          $('#myDIV').html(data);
          document.getElementById('myDIV').style.display = 'block';
        }
      });
    } else {
      u.style.display = "none";
    }


  }
</script>
<script>
  function fungsi_itin(x) {
    var data = [];
    alert(x);
    for (var i = 1; i <= x; i++) {
      if ($('#checkex_' + i).is(":checked")) {
        var value = $("#checkex_" + i).val();
        arr_chck.push(value);
      }
    }
  }
</script>
<!-- /.row -->