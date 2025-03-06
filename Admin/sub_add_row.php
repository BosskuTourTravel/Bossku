<?php
include "../db=connection.php";
$day = $_POST['day'];
$loop = $_POST['loop'];
for ($xt = 1; $xt <= $loop; $xt++) {
?>
    <div class="row">
        <div class="col-md-3">
            <label style="font-size: 11px;">Transport Type <?php echo $day ?> : <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>pilih_trans<?php echo $xt ?>" id="<?php echo $day ?>pilih_trans<?php echo $xt ?>" onchange="pilihan_trans(<?php echo $day ?>,<?php echo $xt ?>)">
                <option value="0">Transport Type</option>
                <option value="1">Flight</option>
                <option value="2">Ferry</option>
                <option value="3">Land</option>
                <option value="4">Train</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>fl_rutex<?php echo $xt ?>" id="<?php echo $day ?>fl_rutex<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Flight Type : <?php echo $day ?>: <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>fl_rute<?php echo $xt ?>" id="<?php echo $day ?>fl_rute<?php echo $xt ?>" onchange="fungsi_fl(<?php echo  $day ?>,<?php echo $xt ?>)">
                <option selected>Pilih</option>
                <option value="ONE WAY">ONE WAY</option>
                <option value="RETURN">RETURN</option>
                <option value="MULTI">MULTI</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transf<?php echo $xt ?>" id="<?php echo $day ?>pil_transf<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Flight Rute: <?php echo $day ?> : <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>flight<?php echo $xt ?>" id="<?php echo $day ?>flight<?php echo $xt ?>" onchange="fungsi_fval(<?php echo  $day ?>,<?php echo $xt ?>)">
                <option value="">Rute Name</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_fval<?php echo $xt ?>" id="<?php echo $day ?>pil_fval<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Flight : <?php echo $day ?> : <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>flight_val<?php echo $xt ?>" id="<?php echo $day ?>flight_val<?php echo $xt ?>" onchange="fungsi_faci(<?php echo  $day ?>,<?php echo $xt ?>)">
                <option value="">Flight Name</option>
            </select>
        </div>

        <div class="col-md-3" name="<?php echo $day ?>pil_fer_type<?php echo $xt ?>" id="<?php echo $day ?>pil_fer_type<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Ferry Type : <?php echo $day ?>: <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>fer_type<?php echo $xt ?>" id="<?php echo $day ?>fer_type<?php echo $xt ?>" onchange="ferry_type(<?php echo  $day ?>,<?php echo $xt ?>)">
                <option selected>Pilih</option>
                <option value="ONE WAY">ONE WAY</option>
                <option value="ROUND TRIP">ROUND TRIP</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_fer_rute<?php echo $xt ?>" id="<?php echo $day ?>pil_fer_rute<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Ferry Rute: <?php echo $day ?> : <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>ferry_rute<?php echo $xt ?>" id="<?php echo $day ?>ferry_rute<?php echo $xt ?>" onchange="ferry_rute(<?php echo  $day ?>,<?php echo $xt ?>)">
                <option value="">Rute Name</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_fer_name<?php echo $xt ?>" id="<?php echo $day ?>pil_fer_name<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Ferry : <?php echo $day ?> : <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>ferry_name<?php echo $xt ?>" id="<?php echo $day ?>ferry_name<?php echo $xt ?>" onchange="ferry_value(<?php echo  $day ?>,<?php echo $xt ?>)">
                <option value="">Ferry Name</option>
            </select>
        </div>
        <!-- land form -->
        <div class="col-md-3" name="<?php echo $day ?>pil_transl<?php echo $xt ?>" id="<?php echo $day ?>pil_transl<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Land day : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" list="<?php echo $day ?>transport_list<?php echo $xt ?>" name="<?php echo $day ?>transport<?php echo $xt ?>" id="<?php echo $day ?>transport<?php echo $xt ?>">
            <datalist id="<?php echo $day ?>transport_list<?php echo $xt ?>">
                <?php
                $query_tr = "SELECT * FROM Transport_new Order by id ASC";
                $rs_tr = mysqli_query($con, $query_tr);
                while ($row_tr = mysqli_fetch_array($rs_tr)) {
                ?>
                    <option data-customvalue="<?php echo $row_tr['id'] ?>" value="<?php echo $row_tr['city'] . " " . $row_tr['periode'] . " " . $row_tr['trans_type'] ?>"></option>
                <?php
                }
                ?>
            </datalist>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>rt<?php echo $xt ?>" id="<?php echo $day ?>rt<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Rent Type : <?php echo $day ?>: <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>rtv<?php echo $xt ?>" id="<?php echo $day ?>rtv<?php echo $xt ?>" onchange="get_price2(<?php echo $day ?>,<?php echo $xt ?>)">
                <option value="">Pilih Rent Type</option>
                <option value="ow">One Way Transfer</option>
                <option value="tw">Two Way Transfer</option>
                <option value="hd1">Half Day Transfer 1</option>
                <option value="hd2">Half day Transfer 2</option>
                <option value="fd1">Full Day 1</option>
                <option value="fd2">Full Day 2</option>
                <option value="kaisoda">Kaisoda</option>
                <option value="luarkota">Luar Kota</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pt_price<?php echo $xt ?>" id="<?php echo $day ?>pt_price<?php echo $xt ?>">
            <label style="font-size: 11px;">Price Land : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>price_LN<?php echo $xt ?>" id="<?php echo $day ?>price_LN<?php echo $xt ?>">
        </div>

        <!-- train form -->
        <div class="col-md-3" name="<?php echo $day ?>pil_transtnm<?php echo $xt ?>" id="<?php echo $day ?>pil_transtnm<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Train Name : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>trainnm<?php echo $xt ?>" id="<?php echo $day ?>trainnm<?php echo $xt ?>" onclick="">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transt<?php echo $xt ?>" id="<?php echo $day ?>pil_transt<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Train Adult : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>train_adt<?php echo $xt ?>" id="<?php echo $day ?>train_adt<?php echo $xt ?>" onclick="">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transt_chd<?php echo $xt ?>" id="<?php echo $day ?>pil_transt_chd<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Train child : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>train_chd<?php echo $xt ?>" id="<?php echo $day ?>train_chd<?php echo $xt ?>" onclick="">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transt_inf<?php echo $xt ?>" id="<?php echo $day ?>pil_transt_inf<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Train infant : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>train_inf<?php echo $xt ?>" id="<?php echo $day ?>train_inf<?php echo $xt ?>" onclick="">
        </div>



       <!-- global form -->
        <div class="col-md-3" name="<?php echo $day ?>adult1<?php echo $xt ?>" id="<?php echo $day ?>adult1<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Adult : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>adult<?php echo $xt ?>" id="<?php echo $day ?>adult<?php echo $xt ?>" disabled placeholder="0" onchange="total_adt(<?php echo $day ?>,<?php echo $xt ?>)">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>child1<?php echo $xt ?>" id="<?php echo $day ?>child1<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Child : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>child<?php echo $xt ?>" id="<?php echo $day ?>child<?php echo $xt ?>" disabled placeholder="0">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>infant1<?php echo $xt ?>" id="<?php echo $day ?>infant1<?php echo $xt ?>" style="display: none;">
            <label style="font-size: 11px;">Infant : <?php echo $day ?>: <?php echo $xt ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>infant<?php echo $xt ?>" id="<?php echo $day ?>infant<?php echo $xt ?>" disabled placeholder="0">
        </div>
    </div>
<?php } ?>
<script>
    function pilihan_trans(x, y) {

        var a = document.getElementById(x + "pilih_trans" + y).options[document.getElementById(x + "pilih_trans" + y).selectedIndex].value;
        if (a == 1) {
            document.getElementById(x + 'pil_transf' + y).style.display = 'block';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'block';
            document.getElementById(x + 'pil_fval' + y).style.display = 'block';
            document.getElementById(x + 'pil_fer_type' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_rute' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_name' + y).style.display = 'none';
            document.getElementById(x + 'pil_transl' + y).style.display = 'none';
            document.getElementById(x + 'rt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt_chd' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt_inf' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'none';

            document.getElementById(x + 'adult1' + y).style.display = 'block';
            document.getElementById(x + 'child1' + y).style.display = 'block';
            document.getElementById(x + 'infant1' + y).style.display = 'block';
        } else if (a == 2) {
            document.getElementById(x + 'pil_transf' + y).style.display = 'none';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'none';
            document.getElementById(x + 'pil_fval' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_type' + y).style.display = 'block';
            document.getElementById(x + 'pil_fer_rute' + y).style.display = 'block';
            document.getElementById(x + 'pil_fer_name' + y).style.display = 'block';
            document.getElementById(x + 'pil_transl' + y).style.display = 'none';
            document.getElementById(x + 'rt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt_chd' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt_inf' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'none';

            document.getElementById(x + 'adult1' + y).style.display = 'block';
            document.getElementById(x + 'child1' + y).style.display = 'block';
            document.getElementById(x + 'infant1' + y).style.display = 'block';
        } else if (a == 3) {
            document.getElementById(x + 'pil_transf' + y).style.display = 'none';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'none';
            document.getElementById(x + 'pil_fval' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_type' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_rute' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_name' + y).style.display = 'none';
            document.getElementById(x + 'pil_transl' + y).style.display = 'block';
            document.getElementById(x + 'rt' + y).style.display = 'block';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt_chd' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt_inf' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'block';

            document.getElementById(x + 'adult1' + y).style.display = 'none';
            document.getElementById(x + 'child1' + y).style.display = 'none';
            document.getElementById(x + 'infant1' + y).style.display = 'none';
        } else {
            document.getElementById(x + 'pil_transf' + y).style.display = 'none';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'none';
            document.getElementById(x + 'pil_fval' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_type' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_rute' + y).style.display = 'none';
            document.getElementById(x + 'pil_fer_name' + y).style.display = 'none';
            document.getElementById(x + 'pil_transl' + y).style.display = 'none';
            document.getElementById(x + 'rt' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'none';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'block';
            document.getElementById(x + 'pil_transt' + y).style.display = 'block';
            document.getElementById(x + 'pil_transt_chd' + y).style.display = 'block';
            document.getElementById(x + 'pil_transt_inf' + y).style.display = 'block';

            document.getElementById(x + 'adult1' + y).style.display = 'none';
            document.getElementById(x + 'child1' + y).style.display = 'none';
            document.getElementById(x + 'infant1' + y).style.display = 'none';
        }

    }
</script>
<script>
    function fungsi_fl(x, y) {
        // alert("on");
        //// guide fee
        var type = document.getElementById(x + "fl_rute" + y).options[document.getElementById(x + "fl_rute" + y).selectedIndex].value;
        alert(type);
        $.post('get_transport_list.php', {
            'brand': type
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'flight' + y).append('<option value=' + counter.rute+ '>' + counter.rute + '</option>');
                }
            } else {
                $("#" + x + "flight" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }

    function fungsi_fval(x, y) {
        alert("on");
        //// guide fee
        var type = document.getElementById(x + "fl_rute" + y).options[document.getElementById(x + "fl_rute" + y).selectedIndex].value;
        var rute = document.getElementById(x + "flight" + y).options[document.getElementById(x + "flight" + y).selectedIndex].value;
        // alert(rute);
        $.post('get_flight_val.php', {
            'brand': rute,
            'type' : type
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'flight_val' + y).append('<option value=' + counter.id + '>' + counter.inter + ' ' + counter.maskapai + ' ' + counter.dept + '-' + counter.arr + ' ' + counter.take + ':' + counter.landing + '</option>');
                }
            } else {
                $("#" + x + "flight_val" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }
    function ferry_type(x,y){
        var type = document.getElementById(x + "fer_type" + y).options[document.getElementById(x + "fer_type" + y).selectedIndex].value;
        // alert(type);
        $.post('get_ferry_rute.php', {
            'brand': type
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'ferry_rute' + y).append('<option value=' + counter.nama+ '>' + counter.nama + '</option>');
                }
            } else {
                $("#" + x + "ferry_rute" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }

    function ferry_rute(x,y){
        var type = document.getElementById(x + "fer_type" + y).options[document.getElementById(x + "fer_type" + y).selectedIndex].value;
        var rute = document.getElementById(x + "ferry_rute" + y).options[document.getElementById(x + "ferry_rute" + y).selectedIndex].value;
        $.post('get_ferry_rute2.php', {
            'type': type,
            'rute' : rute
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'ferry_name' + y).append('<option value=' + counter.id+ '>' + counter.ferry_name + ' '+counter.ferry_class+' '+counter.jam_dept+' '+counter.jam_arr + '</option>');
                }
            } else {
                $("#" + x + "ferry_name" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }
    function ferry_value(x,y){
        var ferry = document.getElementById(x + "ferry_name" + y).options[document.getElementById(x + "ferry_name" + y).selectedIndex].value;
        $.post('get_ferry_aci.php', {
            'brand': ferry
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $("#" + x + "adult" + y).val(counter.adult);
                    $("#" + x + "child" + y).val(counter.child);
                    $("#" + x + "infant" + y).val(counter.infant);
                }
            }
        });
    }


    function fungsi_faci(x, y) {
        // alert("on");
        //// guide fee
        var flight = document.getElementById(x + "flight_val" + y).options[document.getElementById(x + "flight_val" + y).selectedIndex].value;
        // alert(rute);
        $.post('get_flight_aci.php', {
            'brand': flight
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $("#" + x + "adult" + y).val(counter.adt);
                    $("#" + x + "child" + y).val(counter.chd);
                    $("#" + x + "infant" + y).val(counter.inf);
                }
            }
        });
    }
</script>