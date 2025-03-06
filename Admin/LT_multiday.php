<?php $sub = $_POST['sub'];
include "../db=connection.php";
$query_tr = "SELECT * FROM transport Order by id ASC";
$rs_tr = mysqli_query($con, $query_tr);

$bf2 = 'BREAKFAST';
$ln2 = 'LUNCH';
$dn2 = 'DINNER';

?>
<?php
for ($x = 1; $x <= $sub; $x++) {

?>
    <div style="border: 2px solid black; padding: 10px;">
        <div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
        <div class="row">
            <div class="col-md-6">
                <label style="font-size: 11px;">Rute</label>
                <input class="form-control form-control-sm" list="rute_list<?php echo $x ?>" name="rute<?php echo $x ?>" id="rute<?php echo $x ?>">
                <datalist id="rute_list<?php echo $x ?>">
                    <?php
                    $query_rute = "SELECT * FROM rute_itin Order by id ASC";
                    $rs_rute = mysqli_query($con, $query_rute);
                    while ($row_rute = mysqli_fetch_array($rs_rute)) {
                    ?>
                        <option data-customvalue="<?php echo $row_rute['id'] ?>" value="<?php echo $row_rute['judul'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 11px;">Jml Transport & Tempat Wisata</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>sel_trans" id="<?php echo $x ?>sel_trans" onchange="get_trans(<?php echo $x ?>)">
                    <?php
                    for ($i = 1; $i <= 15; $i++) {
                    ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="<?php echo $x ?>str_a" name="str_a" id="<?php echo $x ?>str_a" style="padding-top: 5px; padding-bottom: 5px;">
            <div class="row">
                <div class="col-md-2">
                    <label style="font-size: 11px;">Transport & Tempat <?php echo $x ?></label>
                    <select class="form-control form-control-sm" name="<?php echo $x ?>pilih" id="<?php echo $x ?>pilih" onchange="pilihan3(<?php echo $x ?>)">
                        <option value="0">Select Type</option>
                        <option value="1">Transport</option>
                        <option value="2">Tempat</option>
                    </select>
                </div>
                <div class="col">
                    <div class="<?php echo $x ?>pil_a" name="<?php echo $x ?>pil_a" id="<?php echo $x ?>pil_a"></div>
                </div>
            </div>
        </div>
        <div class="<?php echo $x ?>str2_a" name="<?php echo $x ?>str2_a" id="<?php echo $x ?>str2_a" style="padding-top: 5px; padding-bottom: 5px;"></div>

        <div class="row">
            <div class="col-md-2">
                <input type="checkbox" id="<?php echo $x ?>cek_bf" name="<?php echo $x ?>cek_bf" checked>
                <label style="font-size: 11px;">Guest Breakfast</label>
                <input class="form-control form-control-sm" list="<?php echo $x ?>bf_list" name="<?php echo $x ?>bf" id="<?php echo $x ?>bf">
                <datalist id="<?php echo $x ?>bf_list">
                    <?php
                    $query_meal2 = "SELECT * FROM Guest_meal where bld='" . $bf2 . "' Order by negara ASC";
                    $rs_meal2 = mysqli_query($con, $query_meal2);
                    while ($row_meal2 = mysqli_fetch_array($rs_meal2)) {
                    ?>
                        <option data-customvalue="<?php echo $row_meal2['id'] ?>" value="<?php echo $row_meal2['negara'] . " " . $row_meal2['bld'] . " : Rp. " . number_format($row_meal2['harga_idr']) ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <input type="checkbox" id="<?php echo $x ?>cek_ln" name="<?php echo $x ?>cek_ln" checked>
                <label style="font-size: 11px;">Guest Lunch</label>
                <input class="form-control form-control-sm" list="<?php echo $x ?>ln_list" name="<?php echo $x ?>lunch" id="<?php echo $x ?>lunch">
                <datalist id="<?php echo $x ?>ln_list">
                    <?php
                    $query_ln2 = "SELECT * FROM Guest_meal where bld='" . $ln2 . "' Order by negara ASC";
                    $rs_ln2 = mysqli_query($con, $query_ln2);
                    while ($row_ln2 = mysqli_fetch_array($rs_ln2)) {
                    ?>
                        <option data-customvalue="<?php echo $row_ln2['id'] ?>" value="<?php echo $row_ln2['negara'] . " " . $row_ln2['bld'] . " : Rp. " . number_format($row_ln2['harga_idr']) ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <input type="checkbox" id="<?php echo $x ?>cek_dn" name="<?php echo $x ?>cek_dn" checked>
                <label style="font-size: 11px;">Guest Dinner</label>
                <input class="form-control form-control-sm" list="<?php echo $x ?>dn_list" name="<?php echo $x ?>dinner" id="<?php echo $x ?>dinner">
                <datalist id="<?php echo $x ?>dn_list">
                    <?php
                    $query_dn2 = "SELECT * FROM Guest_meal where bld='" . $dn2 . "' Order by negara ASC";
                    $rs_dn2 = mysqli_query($con, $query_dn2);
                    while ($row_dn2 = mysqli_fetch_array($rs_dn2)) {
                    ?>
                        <option data-customvalue="<?php echo $row_dn2['id'] ?>" value="<?php echo $row_dn2['negara'] . " " . $row_dn2['bld'] . " : Rp. " . number_format($row_dn2['harga_idr']) ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 11px;">Guest Hotel Name</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>guest_hotel" id="<?php echo $x ?>guest_hotel" placeholder="Hotel">
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Guest Twin</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>hotel_twin" id="<?php echo $x ?>hotel_twin" placeholder="0" onchange="TL_htl2(<?php echo $x ?>)">
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Guest Triple</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>hotel_single" id="<?php echo $x ?>hotel_single" placeholder="0">
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Guest Family </label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>hotel_family" id="<?php echo $x ?>hotel_family" placeholder="0">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 11px;">TL Fee</label>
                <input class="form-control form-control-sm" type="text" list="<?php echo $x ?>tlfee_list" name="<?php echo $x ?>tl_fee" id="<?php echo $x ?>tl_fee" placeholder="0">
                <datalist id="<?php echo $x ?>tlfee_list">
                    <?php
                    $query_tlf = "SELECT * FROM TL_itin where type like'%TL FEE PER DAY%' Order by id ASC";
                    $rs_tlf = mysqli_query($con, $query_tlf);
                    while ($row_tlf = mysqli_fetch_array($rs_tlf)) {
                    ?>
                        <option data-customvalue="<?php echo $row_tlf['id'] ?>" value="<?php echo $row_tlf['ket'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">TL Surcharge Fee</label>
                <!-- <input class="form-control form-control-sm" type="text" name="tl_sfee" id="tl_sfee" placeholder="0"> -->
                <input class="form-control form-control-sm" type="text" list="<?php echo $x ?>tlsfee_list" name="<?php echo $x ?>tl_sfee" id="<?php echo $x ?>tl_sfee" placeholder="0">
                <datalist id="<?php echo $x ?>tlsfee_list">
                    <?php
                    $query_tli = "SELECT * FROM TL_itin where type like'%TL FEE SURCHARGE PER DAY%' Order by id ASC";
                    $rs_tli = mysqli_query($con, $query_tli);
                    while ($row_tlsf = mysqli_fetch_array($rs_tli)) {
                    ?>
                        <option data-customvalue="<?php echo $row_tlsf['id'] ?>" value="<?php echo $row_tlsf['ket'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">TL Voucher</label>
                <!-- <input class="form-control form-control-sm" type="text" name="tl_fee" id="tl_fee" placeholder="0"> -->
                <input class="form-control form-control-sm" type="text" list="<?php echo $x ?>tlv_list" name="<?php echo $x ?>tl_v" id="<?php echo $x ?>tl_v" placeholder="0">
                <datalist id="<?php echo $x ?>tlv_list">
                    <?php
                    $query_tlv = "SELECT * FROM TL_itin where type like'%TL VOUCHER TELEPHONE%' Order by id ASC";
                    $rs_tlv = mysqli_query($con, $query_tlv);
                    while ($row_tlv = mysqli_fetch_array($rs_tlv)) {
                    ?>
                        <option data-customvalue="<?php echo $row_tlv['id'] ?>" value="<?php echo $row_tlv['ket'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">TL Meal</label>
                <!-- <input class="form-control form-control-sm" type="text" name="tl_fee" id="tl_fee" placeholder="0"> -->
                <input class="form-control form-control-sm" type="text" list="<?php echo $x ?>tlm_list" name="<?php echo $x ?>tl_m" id="<?php echo $x ?>tl_m" placeholder="0">
                <datalist id="<?php echo $x ?>tlm_list">
                    <?php
                    $query_tlm = "SELECT * FROM TL_itin where type like'%TL MEAL 1X ABF/LUNCH/DINNER%' Order by id ASC";
                    $rs_tlm = mysqli_query($con, $query_tlm);
                    while ($row_tlm = mysqli_fetch_array($rs_tlm)) {
                    ?>
                        <option data-customvalue="<?php echo $row_tlm['id'] ?>" value="<?php echo $row_tlm['ket'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">TL Hotel</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>tl_h" id="<?php echo $x ?>tl_h" disabled placeholder="0">

            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">TL Transport</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>tl_t" id="<?php echo $x ?>tl_t" disabled placeholder="0">
            </div>
        </div>

    </div>
    <div style="padding-top: 10px;"></div>

<?php
}
?>
<script>
    function get_trans(x) {
        var a = document.getElementById(x + "sel_trans").options[document.getElementById(x + "sel_trans").selectedIndex].value;
        // alert(a);
        $.ajax({
            url: "LT_subtrans.php",
            method: "POST",
            asynch: false,
            data: {
                trans: a,
                day: x
            },
            success: function(data) {
                $('#' + x + 'str2_a').html(data);
                document.getElementById(x + 'str_a').style.display = 'none';
                document.getElementById(x + 'str2_a').style.display = 'block';
            }
        });
    }


    function pilihan3(x) {
        var a = document.getElementById(x + "pilih").options[document.getElementById(x + "pilih").selectedIndex].value;
        var y = document.getElementById(x + "sel_trans").options[document.getElementById(x + "sel_trans").selectedIndex].value;
        alert("pilihan tdk ganda");
        $.ajax({
            url: "LT_subtempat.php",
            method: "POST",
            asynch: false,
            data: {
                sub: a,
                day: x,
                loop: y
            },
            success: function(data) {
                $('#' + x + 'pil_a').html(data);
            }
        });
        // }
    }

    function TL_htl2(x) {
        var hotel = $('#' + x + 'hotel_twin').val();
        $("#" + x + "tl_h").val(hotel);
    }

    // function fungsi_hotel2(x) {
    //     var lt = $('#' + x + 'LT_name').val();
    //     $.post('get_lthotel.php', {
    //         'brand': lt
    //     }, function(data) {
    //         var jsonData = JSON.parse(data);
    //         if (jsonData != '') {
    //             for (var i = 0; i < jsonData.length; i++) {
    //                 var counter = jsonData[i];
    //                 $('#' + x + 'LT_hotel').append('<option value=' + counter.id + '>' + counter.hotel + '</option>');
    //             }
    //         } else {
    //             $("#" + x + "LT_hotel").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
    //         }

    //         // $("#g_dinner").val(obj_dn.harga);
    //     });

    // }

    function price_HLT2(x) {
        var lth = $('#' + x + 'LT_hotel').val();
        // alert(lth);
        $.post('get_price_LTHl.php', {
            'brand': lth
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $("#" + x + "LTH_twn").val(counter.twn);
                    $("#" + x + "LTH_cnb").val(counter.cnb);
                    $("#" + x + "LTH_sgl").val(counter.sgl);

                    var tot = $("#adult").val() * $("#" + x + "LTH_twn").val();
                    var tot2 = $("#child").val() * $("#" + x + "LTH_cnb").val();
                    var total = tot + tot2;
                    // alert(tot);

                    $("#total_tl").val(total);
                }
            } else {
                $("#" + x + "LTH_twn").val(0);
                $("#" + x + "LTH_cnb").val(0);
                $("#" + x + "LTH_sgl").val(0);
            }
        });

    }
</script>