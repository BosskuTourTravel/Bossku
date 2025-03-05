<?php
session_start();
include "../db=connection.php";
include "Api_LT_total.php";

$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);
$show_button = 0;
if ($row_sub['landtour'] != "undefined") {
    $query_hotel = "SELECT * FROM LT_select_PilihHTL WHERE master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' order by id ASC limit 1";
    $rs_hotel = mysqli_query($con, $query_hotel);
    $row_hotel = mysqli_fetch_array($rs_hotel);
    if ($row_hotel['id'] != "") {
        $show_button = 1;
    }
} else {
    $show_button = 1;
}

$query = "SELECT * FROM  checkbox_include2 order by id ASC ";
$rs = mysqli_query($con, $query);
$no = 1;
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">COSTUM PRINT</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <div class="container" style="max-width:85%; padding: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <div style="text-align: center;">INCLUDE EXCLUDE</div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="include">
                                            <form action="preview_custom.php?id=<?php echo $_POST['id'] ?>" method="post" target="_blank">

                                                <?php
                                                // $auto = array(0,6,18,19,26,27,36,37,38,39,1);
                                                while ($row = mysqli_fetch_array($rs)) {
                                                    // var_dump($row['id']);
                                                    // $cocok = array_search($row['id'], $auto);
                                                    // if ($cocok != "") {
                                                    // if($row['id'] =='15'){

                                                    // }
                                                    if ($row['id'] == '9' or $row['id'] == '10' or $row['id'] == '11' or $row['id'] == '12') {
                                                ?>
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?>" onclick="add_chck(<?php echo $row['id'] ?>)">
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $row['nama'] ?>" disabled style="background-color: greenyellow;">
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?>">
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $row['nama'] ?>" disabled>
                                                        </div>
                                                <?php
                                                    }
                                                    // }
                                                }
                                                ?>
                                                <div style="padding-bottom: 10px;">
                                                    <div id="accordion">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="mb-0">
                                                                    <div class="row">
                                                                        <div class="col-md-6">Tour Admission</div>
                                                                        <div class="col-md-6" style="text-align: right;">
                                                                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                                <!-- <i class="fa fa-chevron-down"></i>
                                                                                <i class="fa fa-chevron-up"></i> -->
                                                                            </a>
                                                                        </div>
                                                                    </div>

                                                                </h5>
                                                            </div>

                                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div><b>INCLUDE</b></div>
                                                                            <div>
                                                                                <?php
                                                                                $query_master = "SELECT tempat from LT_add_listTmp where tour_id ='" . $row_sub['master_id'] . "' order by hari ASC,urutan ASC";
                                                                                $rs_master = mysqli_query($con, $query_master);
                                                                                while ($row_master = mysqli_fetch_array($rs_master)) {
                                                                                    $query_tempat = "SELECT id,tempat,price,keterangan FROM List_tempat where id=" . $row_master['tempat'];
                                                                                    $rs_tempat = mysqli_query($con, $query_tempat);
                                                                                    $row_tempat = mysqli_fetch_array($rs_tempat);
                                                                                ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-check">
                                                                                            <input type="checkbox" class="form-check-input" id="tmp" name="tmp[]" value="<?php echo $row_tempat['id'] ?>">
                                                                                            <?php if ($row_tempat['price'] != 0 or $row_tempat['price'] == "" ) {
                                                                                            ?>
                                                                                                <label style="color: green;" class="form-check-label" for="exampleCheck1"><?php echo $row_tempat['tempat'] ?></label>
                                                                                            <?php

                                                                                            } else {
                                                                                            ?>
                                                                                                <label class="form-check-label" for="exampleCheck1"><?php echo $row_tempat['tempat'] ?></label>
                                                                                            <?php
                                                                                            } ?>
                                                                                            <!-- <label class="form-check-label" for="exampleCheck1"><?php echo $row_tempat['tempat'] ?></label> -->
                                                                                        </div>
                                                                                    </div>
                                                                                <?php
                                                                                }

                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div><b>EXCLUDE</b></div>
                                                                            <div>
                                                                                <?php
                                                                                $query_master2 = "SELECT tempat from LT_add_listTmp where tour_id ='" . $row_sub['master_id'] . "' order by hari ASC,urutan ASC";
                                                                                $rs_master2 = mysqli_query($con, $query_master2);
                                                                                while ($row_master2 = mysqli_fetch_array($rs_master2)) {
                                                                                    $query_tempat2 = "SELECT id,tempat,price,keterangan FROM List_tempat where id=" . $row_master2['tempat'];
                                                                                    $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                                                                    $row_tempat2 = mysqli_fetch_array($rs_tempat2);
                                                                                ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-check">
                                                                                            <input type="checkbox" class="form-check-input" id="tmp_ex" name="tmp_ex[]" value="<?php echo $row_tempat2['id'] ?>">
                                                                                            <?php if ($row_tempat2['price'] != 0 or $row_tempat2['price'] == "") {
                                                                                            ?>
                                                                                                <label style="color: green;" class="form-check-label" for="exampleCheck1"><?php echo $row_tempat2['tempat'] ?></label>
                                                                                            <?php

                                                                                            } else {
                                                                                            ?>
                                                                                                <label class="form-check-label" for="exampleCheck1"><?php echo $row_tempat2['tempat'] ?></label>
                                                                                            <?php
                                                                                            } ?>

                                                                                        </div>
                                                                                    </div>
                                                                                <?php
                                                                                }

                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="padding-bottom: 10px;">
                                                    <label for="">Print Preview Attribute</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <input type="radio" id="rdio" name="rdio" value="0" checked>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control" name="val_rdio" value="Option A (One Flight)" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <input type="radio" id="rdio" name="rdio" value="1">
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control" name="val_rdio" value="Option B (Compare Flight)" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <input type="radio" id="rdio_pax" name="rdio_pax" value="0" checked>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control" name="val_rdio_pax" value="Total Pax + TL" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <input type="radio" id="rdio_pax" name="rdio_pax" value="1">
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control" name="val_rdio_pax" value="Total Pax" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="padding-bottom: 10px;">
                                                    <label for="">Custom Price</label>
                                                    <div class="row">
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="pax" id="pax" placeholder="Pax"></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="twn" id="twn" placeholder="Twn"></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="sgl" id="sgl" placeholder="Single"></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="cnb" id="cnb" placeholder="CNB"></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="inf" id="inf" placeholder="Infant"></div>
                                                    </div>
                                                </div>
                                                <div style="padding-bottom: 10px;">
                                                    <label for="">Lain-lain</label>
                                                    <div class="row">
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="ltwn" id="ltwn" placeholder="Twn" onchange="updateInput(this.value)"></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="lsgl" id="lsgl" placeholder="Sgl" disabled></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="lcnb" id="lcnb" placeholder="Cnb" disabled></div>
                                                        <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="linf" id="linf" placeholder="Inf" disabled></div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div> <button type="submit" class="btn btn-success btn-sm">Print</button></div>
                                                    <?php
                                                    if ($show_button == '1') {
                                                    ?>
                                                        <div style="padding-left: 10px;"> <button type="button" class="btn btn-danger btn-sm" onclick="add_promo2(<?php echo $_POST['id'] ?>)">Data Promo</button></div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- <div style="padding-left: 10px;"> <button type="button" class="btn btn-danger btn-sm" onclick="add_promo2(<?php echo $_POST['id'] ?>)">Test Promo</button></div> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.row -->
</div>
<script>
    function add_chck(x) {
        if ($('#chck' + x).is(':checked')) {
            if (x == '9') {
                document.getElementById("chck10").checked = false;
                document.getElementById("chck11").checked = false;
                document.getElementById("chck12").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }

                const unchck = [41, 42, 43];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            } else if (x == '10') {
                document.getElementById("chck9").checked = false;
                document.getElementById("chck11").checked = false;
                document.getElementById("chck12").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }

                const unchck = [41, 42, 43];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            } else if (x == '11') {
                document.getElementById("chck10").checked = false;
                document.getElementById("chck9").checked = false;
                document.getElementById("chck12").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }
                const unchck = [44, 45, 46];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            } else {
                document.getElementById("chck10").checked = false;
                document.getElementById("chck11").checked = false;
                document.getElementById("chck9").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }
                const unchck = [44, 45, 46];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            }



        } else {
            if (x == '9') {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            } else if (x == '10') {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            } else if (x == '11') {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            } else {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            }
            // const auto_arr = [1, 2, 5, 6, 15, 17, 19, 33, 39, 44];
            // for (var i = 0; i < auto_arr.length; i++) {
            //     document.getElementById("chck" + auto_arr[i]).checked = false;
            // }

        }

    }

    function updateInput(ish) {
        document.getElementById("lsgl").value = ish;
        document.getElementById("lcnb").value = ish;
        document.getElementById("linf").value = ish;
    }

    function add_promo(x) {
        var r = confirm("Are you sure to copy this file to Data Promo ?");
        if (r == true) {
            let formData = new FormData();
            var array = [];
            var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

            for (var i = 0; i < checkboxes.length; i++) {
                array.push(checkboxes[i].value);
            }

            var jsondata = JSON.stringify(array);
            formData.append('chck', jsondata);
            formData.append('sub_id', x);
            formData.append('pax', $("#pax").val());
            formData.append('twn', $("#twn").val());
            formData.append('sgl', $("#sgl").val());
            formData.append('cnb', $("#cnb").val());
            formData.append('inf', $("#inf").val());
            formData.append('ltwn', $("#ltwn").val());
            formData.append('lsgl', $("#lsgl").val());
            formData.append('lcnb', $("#lcnb").val());
            formData.append('linf', $("#linf").val());
            $.ajax({
                type: 'POST',
                url: "copy_ptsub_promo.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    // LT_itinerary(4, copy_id, 0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });

        }
        // alert("on");

        console.log(array);
    }

    function add_promo2(x) {
        var r = confirm("Are you sure to copy this file to Data Promo ?");
        if (r == true) {
            let formData = new FormData();
            var array = [];
            var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

            for (var i = 0; i < checkboxes.length; i++) {
                array.push(checkboxes[i].value);
            }

            var jsondata = JSON.stringify(array);
            formData.append('chck', jsondata);
            formData.append('sub_id', x);
            formData.append('pax', $("#pax").val());
            formData.append('twn', $("#twn").val());
            formData.append('sgl', $("#sgl").val());
            formData.append('cnb', $("#cnb").val());
            formData.append('inf', $("#inf").val());
            formData.append('ltwn', $("#ltwn").val());
            formData.append('lsgl', $("#lsgl").val());
            formData.append('lcnb', $("#lcnb").val());
            formData.append('linf', $("#linf").val());
            $.ajax({
                type: 'POST',
                url: "copy_ptsub_promo2.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    // LT_itinerary(4, copy_id, 0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });

        }
        // alert("on");

        console.log(array);
    }
</script>