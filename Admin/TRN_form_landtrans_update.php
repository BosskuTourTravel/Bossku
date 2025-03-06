<?php
include "../db=connection.php";
$i = $_POST['id'];
$query_tp = "SELECT * FROM  Transport_new where id='" . $i . "'";
$rs_tp = mysqli_query($con, $query_tp);
$row_tp = mysqli_fetch_array($rs_tp);

?>
<div class="content-wrapper" style="padding: 20px; width: auto">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtransport Update List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <button type="button" onclick="TRN_Package(0,0,0)" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                                <a class="btn btn-success btn-sm tip" title="Edit transport" onclick="TRN_Package(5,<?php echo  $_POST['id'] ?>,0)"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div style="padding: 20px;">
                        <div style="border:solid 1px; padding: 10px; margin: 5px;">
                            <div class="row">
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Continent</label>
                                    <input type="text" class="form-control form-control-sm" id="con<?php echo $i ?>" name="con<?php echo $i ?>" value="<?php echo $row_tp['continent'] ?>" disabled>
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Country</label>
                                    <input type="text" class="form-control form-control-sm" id="cou<?php echo $i ?>" name="cou<?php echo $i ?>" value="<?php echo $row_tp['country'] ?>" disabled>
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">City</label>
                                    <input type="text" class="form-control form-control-sm" list="cit_list<?php echo $i ?>" id="cit<?php echo $i ?>" name="cit<?php echo $i ?>" autocomplete="off" value="<?php echo $row_tp['city'] ?>" onchange="set_val(this.value,<?php echo $i ?>)">
                                    <datalist id="cit_list<?php echo $i ?>">
                                        <?php
                                        $query_cit = "SELECT name FROM city Order by name ASC";
                                        $rs_cit = mysqli_query($con, $query_cit);
                                        while ($row_cit = mysqli_fetch_array($rs_cit)) {
                                        ?>
                                            <option value="<?php echo $row_cit['name'] ?>"></option>
                                        <?php
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Periode</label>
                                    <select class="form-control form-control-sm" id="periode<?php echo $i ?>" name="periode<?php echo $i ?>">
                                        <option value="<?php echo $row_tp['periode'] ?>" selected><?php echo $row_tp['periode'] ?></option>
                                        <option>HIGH & LOW SEASON</option>
                                        <option>HIGH SEASON</option>
                                        <option>LOW SEASON</option>
                                    </select>
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Trans Type</label>
                                    <select class="form-control form-control-sm" id="trans<?php echo $i ?>" name="trans<?php echo $i ?>">
                                        <option value="<?php echo $row_tp['trans_type'] ?>" selected><?php echo $row_tp['trans_type'] ?></option>
                                        <?php
                                        $query_tr = "SELECT * FROM transport_type Order by id ASC";
                                        $rs_tr = mysqli_query($con, $query_tr);
                                        while ($row_tr = mysqli_fetch_array($rs_tr)) {
                                        ?>
                                            <option value="<?php echo $row_tr['name'] ?>"><?php echo $row_tr['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Seat</label>
                                    <input type="text" class="form-control form-control-sm" id="seat<?php echo $i ?>" name="seat<?php echo $i ?>" value="<?php echo $row_tp['seat'] ?>">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Kurs</label>
                                    <select class="form-control form-control-sm" id="kurs<?php echo $i ?>" name="kurs<?php echo $i ?>">
                                        <option value="<?php echo $row_tp['kurs'] ?>" selected><?php echo $row_tp['kurs'] ?></option>
                                        <?php

                                        $query_kurs = "SELECT * FROM kurs_bca_field Order by id ASC";
                                        $rs_kurs = mysqli_query($con, $query_kurs);
                                        while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
                                        ?>
                                            <option value="<?php echo $row_kurs['nama'] ?>"><?php echo $row_kurs['nama'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">One Way</label>
                                    <input type="text" class="form-control form-control-sm" id="oneway<?php echo $i ?>" name="oneway<?php echo $i ?>" value="<?php echo $row_tp['oneway'] ?>">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Two Way</label>
                                    <input type="text" class="form-control form-control-sm" id="twoway<?php echo $i ?>" name="twoway<?php echo $i ?>" value="<?php echo $row_tp['twoway'] ?>">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Half Day 1</label>
                                    <input type="text" class="form-control form-control-sm" id="hd1<?php echo $i ?>" name="hd1<?php echo $i ?>" value="<?php echo $row_tp['hd1'] ?>">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Half Day 2</label>
                                    <input type="text" class="form-control form-control-sm" id="hd2<?php echo $i ?>" name="hd2<?php echo $i ?>" value="<?php echo $row_tp['hd2'] ?>">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Full Day 1</label>
                                    <input type="text" class="form-control form-control-sm" id="fd1<?php echo $i ?>" name="fd1<?php echo $i ?>" value="<?php echo $row_tp['fd1'] ?>">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt; color:red; font-weight: bold;">Full Day 2</label>
                                    <input type="text" class="form-control form-control-sm" id="fd2<?php echo $i ?>" name="fd2<?php echo $i ?>" value="<?php echo $row_tp['fd2'] ?>" onchange="add_auto(<?php echo $i ?>)">
                                </div>
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Kaisoda</label>
                                    <input type="text" class="form-control form-control-sm" id="kaisoda<?php echo $i ?>" name="kaisoda<?php echo $i ?>" value="<?php echo $row_tp['kaisoda'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="max-width: 170px;">
                                    <label style="font-size: 9pt;">Luar Kota</label>
                                    <input type="text" class="form-control form-control-sm" id="luarkota<?php echo $i ?>" name="luarkota<?php echo $i ?>" value="<?php echo $row_tp['luarkota'] ?>">
                                </div>
                                <div class="col">
                                    <label style="font-size: 9pt;">Remarks</label>
                                    <input type="text" class="form-control form-control-sm" id="remarks<?php echo $i ?>" name="remarks<?php echo $i ?>" value="<?php echo $row_tp['remarks'] ?>">
                                </div>
                            </div>
                            <div style="text-align: left; padding: 10px;">
                                <button type="button" class="btn btn-success" onclick="update_trans(<?php echo $i ?>)">Update Landtrans</button>
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
    function set_val(x, y) {
        $.post('get-con-city.php', {
            'key': x,
        }, function(data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
            if (jsonData != '') {
                var counter = jsonData;
                document.getElementById("con" + y).value = counter.con;
                document.getElementById("cou" + y).value = counter.cou;
            } else {

            }
        });
    }

    function update_trans(i) {
        let formData = new FormData();
        var con = document.getElementById("con" + i).value;
        var cou = document.getElementById("cou" + i).value;
        var cit = document.getElementById("cit" + i).value;
        var periode = document.getElementById("periode" + i).value;
        var trns_type = document.getElementById("trans" + i).value;
        var seat = document.getElementById("seat" + i).value;
        var kurs = document.getElementById("kurs" + i).value;
        var oneway = document.getElementById("oneway" + i).value;
        var twoway = document.getElementById("twoway" + i).value;
        var hd1 = document.getElementById("hd1" + i).value;
        var hd2 = document.getElementById("hd2" + i).value;
        var fd1 = document.getElementById("fd1" + i).value;
        var fd2 = document.getElementById("fd2" + i).value;
        var kaisoda = document.getElementById("kaisoda" + i).value;
        var luarkota = document.getElementById("luarkota" + i).value;
        var remarks = document.getElementById("remarks" + i).value;

        formData.append('con' + i, con);
        formData.append('cou' + i, cou);
        formData.append('cit' + i, cit);
        formData.append('periode' + i, periode);
        formData.append('trans_type' + i, trns_type);
        formData.append('seat' + i, seat);
        formData.append('kurs' + i, kurs);
        formData.append('oneway' + i, oneway);
        formData.append('twoway' + i, twoway);
        formData.append('hd1' + i, hd1);
        formData.append('hd2' + i, hd2);
        formData.append('fd1' + i, fd1);
        formData.append('fd2' + i, fd2);
        formData.append('kaisoda' + i, kaisoda);
        formData.append('luarkota' + i, luarkota);
        formData.append('ket' + i, remarks);
        formData.append('id', i);

        $.ajax({
            type: 'POST',
            url: "update_landtrans.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                TRN_Package(4, agent, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
</script>