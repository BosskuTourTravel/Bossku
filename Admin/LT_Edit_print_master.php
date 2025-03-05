<?php
include "../db=connection.php";
$query = "SELECT * FROM  checkbox_include2 order by id ASC ";
$rs = mysqli_query($con, $query);

$query_cek2 = "SELECT * FROM LT_include_master where  master_id='" . $_POST['id'] . "'";
$rs_cek2 = mysqli_query($con, $query_cek2);
$row_cek2 = mysqli_fetch_array($rs_cek2);
$in_chck = [];
if (isset($row_cek2['id'])) {
    $in_chck = explode(",", $row_cek2['chck']);
}


?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card" style="padding: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Print Custom Landtour</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px; text-align: right;">
                            <div class="input-group-append">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(43,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="card my-2">
                        <div class="card-header">
                            PAKET TERMASUK / TIDAK TERMASUK
                        </div>
                        <div class="card-body justify-content-center">
                            <div class="row">
                                <?php
                                $no = 1;
                                $hide = array(1, 3, 8, 9, 10, 11, 12, 13, 18, 19);
                                while ($row = mysqli_fetch_array($rs)) {
                                    if (!in_array($row['id'], $hide)) {
                                ?>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <?php
                                                        if (in_array($row['id'], $in_chck)) {
                                                        ?>
                                                            <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include" value="<?php echo $row['id'] ?>" checked>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include" value="<?php echo $row['id'] ?>">
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $row['id'] . ") " . $row['nama'] ?>" disabled>
                                            </div>
                                        </div>
                                <?php

                                        $no++;
                                    }
                                }
                                ?>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="add_chck_val(<?php echo $_POST['id'] ?>)">ADD PAKET TERMASUK</button>
                        </div>
                    </div>

                    <form class="p-2" action="cetak_tambahan_LT.php?id=<?php echo $_POST['id'] ?>" method="post" target="_blank">
                        <div class="form-group">
                            <label>Tambahan Lain-lain</label>
                            <input type="number" class="form-control" id="lain" name="lain">
                        </div>
                        <!-- <div style="padding-bottom: 10px;">
                            <label for="">COST TL (Pax)</label>
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-control form-control-sm" type="number" name="tl_pax" id="tl_pax">
                                </div>
                            </div>
                        </div> -->
                        <div style="padding-bottom: 10px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>TL FEE PER DAY</label>
                                    <input class="form-control form-control-sm" type="number" name="tl_fee" id="tl_fee">
                                </div>
                                <div class="col-md-3">
                                    <label>TL MEAL PER DAY</label>
                                    <input class="form-control form-control-sm" type="number" name="tl_meal" id="tl_meal">
                                </div>
                                <div class="col-md-3">
                                    <label>TL VOUCHER TLPN</label>
                                    <input class="form-control form-control-sm" type="number" name="tl_tlpn" id="tl_tlpn">
                                </div>
                                <div class="col-md-3">
                                    <label>TL SFEE PER DAY</label>
                                    <input class="form-control form-control-sm" type="number" name="tl_sfee" id="tl_sfee">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-footer mt-2">

                </div>
            </div>
        </div>
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
            }

        }

        function add_chck_val(y) {
            var arr_chck = [];
            $('input[name="include"]:checked').each(function() {
                // console.log(this.value);
                arr_chck.push(this.value);
            });
            var value = arr_chck.toString();
            $.ajax({
                url: "insert_chck_val_master.php",
                method: "POST",
                asynch: false,
                data: {
                    master_id: y,
                    chck: value
                },
                success: function(data) {
                    alert(data);
                }
            });
        }
    </script>