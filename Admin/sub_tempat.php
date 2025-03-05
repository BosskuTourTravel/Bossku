<?php
include "../db=connection.php";
$sub = $_POST['sub'];
$day = $_POST['day'];
$loop = $_POST['loop'];
// var_dump($sub);
$query_t = "SELECT * FROM transport_type Order by id ASC";
$rs_t = mysqli_query($con, $query_t);


$query_tempat = "SELECT * FROM List_tempat Order by id ASC";
$rs_tempat = mysqli_query($con, $query_tempat);

$query_flt = "SELECT * FROM flight_LT Order by id ASC";
$rs_flt = mysqli_query($con, $query_flt);
// var_dump( $query_flt);

if ($sub == "2") {
?>
    <div class="row">
        <div class="col-md-6">
            <label style="font-size: 11px;">Tujuan day : <?php echo $day ?> : <?php echo $loop ?> </label>
            <input class="form-control form-control-sm" list="<?php echo $day ?>tujuan_list<?php echo $loop ?>" name="<?php echo $day ?>tujuan<?php echo $loop ?>" id="<?php echo $day ?>tujuan<?php echo $loop ?>" onchange="show_price(<?php echo $day ?>,<?php echo $loop ?>)">
            <datalist id="<?php echo $day ?>tujuan_list<?php echo $loop ?>">
                <?php
                while ($row_tempat = mysqli_fetch_array($rs_tempat)) {
                ?>
                    <option data-customvalue="<?php echo $row_tempat['id'] ?>" value="<?php echo $row_tempat['negara'] . " " . $row_tempat['city'] . " " . $row_tempat['tempat'] ?>"></option>
                <?php
                }
                ?>
            </datalist>
        </div>
        <div class="col-md-3">
            <label style="font-size: 11px;">Price : <?php echo $day ?> : <?php echo $loop ?> </label>
            <input type="text" class="form-control form-control-sm" name="<?php echo $day ?>price_adm<?php echo $loop ?>" id="<?php echo $day ?>price_adm<?php echo $loop ?>" placeholder="0" disabled>
        </div>
    </div>
<?php
} else {
?>
    <div class="row">
        <div class="col-md-3">
            <label style="font-size: 11px;">Transport Type <?php echo $day ?> : <?php echo $loop ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>pilih_trans<?php echo $loop ?>" id="<?php echo $day ?>pilih_trans<?php echo $loop ?>" onchange="pilihan_trans(<?php echo $day ?>,<?php echo $loop ?>)">
                <option value="0">Transport Type</option>
                <option value="1">Flight</option>
                <option value="2">Ferry</option>
                <option value="3">Land</option>
                <option value="4">Train</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>fl_rutex<?php echo $loop ?>" id="<?php echo $day ?>fl_rutex<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Flight Type : <?php echo $day ?>: <?php echo $loop ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>fl_rute<?php echo $loop ?>" id="<?php echo $day ?>fl_rute<?php echo $loop ?>" onchange="fungsi_fl(<?php echo  $day ?>,<?php echo $loop ?>)">
                <option selected>Pilih</option>
                <option value="ONE WAY">ONE WAY</option>
                <option value="RETURN">RETURN</option>
                <option value="MULTI">GABUNGAN</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transf<?php echo $loop ?>" id="<?php echo $day ?>pil_transf<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Flight Rute: <?php echo $day ?> : <?php echo $loop ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>flight<?php echo $loop ?>" id="<?php echo $day ?>flight<?php echo $loop ?>" onchange="fungsi_fval(<?php echo  $day ?>,<?php echo $loop ?>)">
                <option value="">Rute Name</option>
            </select>
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_fval<?php echo $loop ?>" id="<?php echo $day ?>pil_fval<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Flight : <?php echo $day ?> : <?php echo $loop ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>flight_val<?php echo $loop ?>" id="<?php echo $day ?>flight_val<?php echo $loop ?>" onchange="fungsi_faci(<?php echo  $day ?>,<?php echo $loop ?>)">
                <option value="">Flight Name</option>
            </select>
        </div>

        <div class="col-md-3" name="<?php echo $day ?>pil_transnm<?php echo $loop ?>" id="<?php echo $day ?>pil_transnm<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Ferry Name : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>ferrynm<?php echo $loop ?>" id="<?php echo $day ?>ferrynm<?php echo $loop ?>" onchange="">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transfr<?php echo $loop ?>" id="<?php echo $day ?>pil_transfr<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Ferry Price : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>ferry<?php echo $loop ?>" id="<?php echo $day ?>ferry<?php echo $loop ?>" onchange="ferry_price(<?php echo $day ?>,<?php echo $loop ?>); get_tlp(<?php echo $day ?>,<?php echo $loop ?>)">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transl<?php echo $loop ?>" id="<?php echo $day ?>pil_transl<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Land day : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" list="<?php echo $day ?>transport_list<?php echo $loop ?>" name="<?php echo $day ?>transport<?php echo $loop ?>" id="<?php echo $day ?>transport<?php echo $loop ?>">
            <datalist id="<?php echo $day ?>transport_list<?php echo $loop ?>">
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
        <div class="col-md-3" name="<?php echo $day ?>rt<?php echo $loop ?>" id="<?php echo $day ?>rt<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Rent Type : <?php echo $day ?>: <?php echo $loop ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>rtv<?php echo $loop ?>" id="<?php echo $day ?>rtv<?php echo $loop ?>" onchange="get_price2(<?php echo $day?>,<?php echo $loop ?>)">
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
        <div class="col-md-3" name="<?php echo $day ?>pt_price<?php echo $loop ?>" id="<?php echo $day ?>pt_price<?php echo $loop ?>">
            <label style="font-size: 11px;">Price Land : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>price_LN<?php echo $loop ?>" id="<?php echo $day ?>price_LN<?php echo $loop ?>">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transtnm<?php echo $loop ?>" id="<?php echo $day ?>pil_transtnm<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Train Name : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>trainnm<?php echo $loop ?>" id="<?php echo $day ?>trainnm<?php echo $loop ?>" onclick="">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>pil_transt<?php echo $loop ?>" id="<?php echo $day ?>pil_transt<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Train Price : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>train<?php echo $loop ?>" id="<?php echo $day ?>train<?php echo $loop ?>" onclick="train_price(<?php echo $day ?>,<?php echo $loop ?>); get_tlp(<?php echo $day ?>,<?php echo $loop ?>);">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>adult1<?php echo $loop ?>" id="<?php echo $day ?>adult1<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Adult : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>adult<?php echo $loop ?>" id="<?php echo $day ?>adult<?php echo $loop ?>" disabled placeholder="0" onchange="total_adt(<?php echo $day ?>,<?php echo $loop ?>)">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>child1<?php echo $loop ?>" id="<?php echo $day ?>child1<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Child : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>child<?php echo $loop ?>" id="<?php echo $day ?>child<?php echo $loop ?>" disabled placeholder="0">
        </div>
        <div class="col-md-3" name="<?php echo $day ?>infant1<?php echo $loop ?>" id="<?php echo $day ?>infant1<?php echo $loop ?>" style="display: none;">
            <label style="font-size: 11px;">Infant : <?php echo $day ?>: <?php echo $loop ?></label>
            <input class="form-control form-control-sm" name="<?php echo $day ?>infant<?php echo $loop ?>" id="<?php echo $day ?>infant<?php echo $loop ?>" disabled placeholder="0">
        </div>
    </div>
<?php
}
?>
<script>
    function fungsi_fl(x, y) {
        alert("on");
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
                    $('#' + x + 'flight' + y).append('<option value=' + counter.id + '>' + counter.rute + '</option>');
                }
            } else {
                $("#" + x + "flight" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }

    function fungsi_fval(x, y) {
        alert("on");
        //// guide fee
        var rute = document.getElementById(x + "flight" + y).options[document.getElementById(x + "flight" + y).selectedIndex].value;
        alert(rute);
        $.post('get_flight_val.php', {
            'brand': rute
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
<script>
    // function get_tlp(x, y) {
    //     // alert("tlp on");
    //     for (let i = 1; i <= x; i++) {
    //         var tl_tr = 0;
    //         for (let u = 1; u <= y; u++) {
    //             var adult = parseInt($("#" + i + "adult" + u).val() || 0);
    //             tl_tr = tl_tr + adult;
    //         }
    //         $("#" + i + "tl_t").val(tl_tr);
    //     }
    // }


    function show_price(x, y) {
        // alert(x);
        // alert(y);
        // alert('on');
        var tmp = $('#' + x + 'tujuan' + y).val();
        var h_tmp = $('#' + x + 'tujuan_list' + y + ' [value="' + tmp + '"]').data('customvalue');
        // alert(tmp);
        $.post('get_price_adm.php', {
            'tmp': h_tmp,
        }, function(data) {
            //// 0 = breakfast
            //// 1 = lunch
            //// 2 = dinner
            var hasil = JSON.parse(data);
            console.log(hasil[0].price);
            $("#" + x + "price_adm" + y).val(hasil[0].price);

        });
    }



    function total_adt(x, y) {
        var adt = $('#' + x + 'adult' + y).val();
        var total = parseInt(adt) * parseInt($("#adult").val() || '0');
        // $("#TT_adult").val(total);
    }

    function aci(x, y) {
        // alert('on');
        var flight = $('#' + x + 'flight' + y).val();
        var h_flight = $('#' + x + 'flight_list' + y + ' [value="' + flight + '"]').data('customvalue');

        $.post('get_flight.php', {
            'flight': h_flight,
        }, function(data) {
            //// 0 = breakfast
            //// 1 = lunch
            //// 2 = dinner
            var hasil = JSON.parse(data);
            console.log(hasil.adult);
            $("#" + x + "adult" + y).val(hasil.adult);
            $("#" + x + "child" + y).val(hasil.child);
            $("#" + x + "infant" + y).val(hasil.infant);
        });

    }
    function get_price2(x,y){
        var land = $('#' + x + 'transport' + y).val();
        var h_land = $('#' + x + 'transport_list' + y + ' [value="' + land + '"]').data('customvalue');
        var rt = document.getElementById(x+"rtv"+y).value;

        $.post('get_rentype.php', {
            'brand': h_land,
            'rt':rt
        }, function(data) {
            var hasil = JSON.parse(data);
            if (hasil != '') {
                for (var i = 0; i < hasil.length; i++) {
                    var counter = hasil[i];
                    $("#"+x+"price_LN"+y).val(counter.harga);
                }
            } else {
                $("#"+x+"price_LN"+y).val(0);
            }
        });

    }

    // function price_LNx(x, y) {
    //     var land = $('#' + x + 'transport' + y).val();
    //     var h_land = $('#' + x + 'transport_list' + y + ' [value="' + land + '"]').data('customvalue');

    //     $.post('get_land.php', {
    //         'land': h_land,
    //     }, function(data) {
    //         var hasil = JSON.parse(data);
    //         console.log(hasil.harga);
    //         $("#" + x + "price_LN" + y).val(hasil.harga);

    //         total = 0;
    //         for (let i = 1; i <= y; i++) {
    //             var xx = parseInt($("#" + x + "price_LN" + i).val());
    //             var type = $("#" + x + "pilih" + i).val();
    //             if (type == 1) {
    //                 total = total + xx;
    //             } else {
    //                 total = total + 0;
    //             }

    //         }

    //         var total_plus = parseInt($("#adult").val() || 0) + parseInt($("#child").val() || 0);
    //         var harga_plus = parseInt(total) / total_plus;

    //         var adt = parseInt($("#adult").val() || 0);
    //         var chd = parseInt($("#child").val() || 0);

    //         var total_tr = parseInt(harga_plus);
    //         var total_chd = parseInt(harga_plus);

    //         if (chd == 0) {
    //             $("#TT_child").val(0);
    //         } else {
    //             $("#TT_child").val(total_chd);
    //         }
    //         if (adt == 0) {
    //             $("#TT_adult").val(0);
    //         } else {
    //             $("#TT_adult").val(total_tr);
    //         }
    //         $("#TT_infant").val(0);

    //     });

    // }

    function ferry_price(x, y) {
        var pf = $('#' + x + 'ferry' + y).val();
        var inf = pf * 0.25;
        $('#' + x + 'adult' + y).val(pf);
        $('#' + x + 'child' + y).val(pf);
        $('#' + x + 'infant' + y).val(inf);


    }

    function train_price(x, y) {
        var pt = $('#' + x + 'train' + y).val();
        var inft = pt * 0.25;
        $('#' + x + 'adult' + y).val(pt);
        $('#' + x + 'child' + y).val(pt);
        $('#' + x + 'infant' + y).val(inft);
    }



    function pilihan_trans(x, y) {

        var a = document.getElementById(x + "pilih_trans" + y).options[document.getElementById(x + "pilih_trans" + y).selectedIndex].value;
        if (a == 1) {
            document.getElementById(x + 'pil_transf' + y).style.display = 'block';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'block';
            document.getElementById(x + 'pil_fval' + y).style.display = 'block';
            document.getElementById(x + 'pil_transfr' + y).style.display = 'none';
            document.getElementById(x + 'pil_transnm' + y).style.display = 'none';
            document.getElementById(x + 'pil_transl' + y).style.display = 'none';
            document.getElementById(x + 'rt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'none';

            document.getElementById(x + 'adult1' + y).style.display = 'block';
            document.getElementById(x + 'child1' + y).style.display = 'block';
            document.getElementById(x + 'infant1' + y).style.display = 'block';
        } else if (a == 2) {
            document.getElementById(x + 'pil_transf' + y).style.display = 'none';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'none';
            document.getElementById(x + 'pil_fval' + y).style.display = 'none';
            document.getElementById(x + 'pil_transfr' + y).style.display = 'block';
            document.getElementById(x + 'pil_transnm' + y).style.display = 'block';
            document.getElementById(x + 'pil_transl' + y).style.display = 'none';
            document.getElementById(x + 'rt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'none';

            document.getElementById(x + 'adult1' + y).style.display = 'block';
            document.getElementById(x + 'child1' + y).style.display = 'block';
            document.getElementById(x + 'infant1' + y).style.display = 'block';
        } else if (a == 3) {
            document.getElementById(x + 'pil_transf' + y).style.display = 'none';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'none';
            document.getElementById(x + 'pil_fval' + y).style.display = 'none';
            document.getElementById(x + 'pil_transfr' + y).style.display = 'none';
            document.getElementById(x + 'pil_transnm' + y).style.display = 'none';
            document.getElementById(x + 'pil_transl' + y).style.display = 'block';
            document.getElementById(x + 'rt' + y).style.display = 'block';
            document.getElementById(x + 'pil_transt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'none';
            document.getElementById(x + 'pt_price' + y).style.display = 'block';

            document.getElementById(x + 'adult1' + y).style.display = 'none';
            document.getElementById(x + 'child1' + y).style.display = 'none';
            document.getElementById(x + 'infant1' + y).style.display = 'none';
        } else {
            document.getElementById(x + 'pil_transf' + y).style.display = 'none';
            document.getElementById(x + 'fl_rutex' + y).style.display = 'none';
            document.getElementById(x + 'pil_fval' + y).style.display = 'none';
            document.getElementById(x + 'pil_transfr' + y).style.display = 'none';
            document.getElementById(x + 'pil_transnm' + y).style.display = 'none';
            document.getElementById(x + 'pil_transl' + y).style.display = 'none';
            document.getElementById(x + 'rt' + y).style.display = 'none';
            document.getElementById(x + 'pil_transt' + y).style.display = 'block';
            document.getElementById(x + 'pil_transtnm' + y).style.display = 'block';
            document.getElementById(x + 'pt_price' + y).style.display = 'none';

            document.getElementById(x + 'adult1' + y).style.display = 'block';
            document.getElementById(x + 'child1' + y).style.display = 'block';
            document.getElementById(x + 'infant1' + y).style.display = 'block';
        }

    }
</script>