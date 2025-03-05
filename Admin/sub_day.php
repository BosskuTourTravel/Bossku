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
                <input class="form-control form-control-sm" list="<?php echo $x ?>bf_list" name="<?php echo $x ?>bf" id="<?php echo $x ?>bf" onchange="fguide_fee2(<?php echo $x ?>); guide_breakfast2(<?php echo $x ?>);">
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
                <input class="form-control form-control-sm" list="<?php echo $x ?>ln_list" name="<?php echo $x ?>lunch" id="<?php echo $x ?>lunch" onchange="guide_lunch2(<?php echo $x ?>);">
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
                <input class="form-control form-control-sm" list="<?php echo $x ?>dn_list" name="<?php echo $x ?>dinner" id="<?php echo $x ?>dinner" onchange="guide_dinner2(<?php echo $x ?>)">
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
            <div class="col-md-2" style="padding-top: 10px;">
                <div id="<?php echo $x ?>box_bf" name="<?php echo $x ?>box_bf"></div>
            </div>
            <div class="col-md-2" style="padding-top: 10px;">
                <div id="<?php echo $x ?>box_lunch" name="<?php echo $x ?>box_lunch"></div>
            </div>
            <div class="col-md-2" style="padding-top: 10px;">
                <div id="<?php echo $x ?>box_dinner" name="<?php echo $x ?>box_dinner"></div>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Guide Hotel</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>g_hotel" id="<?php echo $x ?>g_hotel" placeholder="Hotel">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 11px;">Guide Fee</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>guide_fee" id="<?php echo $x ?>guide_fee">
                    <option value="">Guide Fee</option>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Guide Surcharge Fee</label>
                <select class="form-control form-control-sm" nama="<?php echo $x ?>gsfee" id="<?php echo $x ?>gsfee">
                    <option value="">Guide S Fee</option>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Voucher Telephone</label>
                <select class="form-control form-control-sm" nama="<?php echo $x ?>vt" id="<?php echo $x ?>vt">
                    <option value="">Guide Voucher</option>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Price Guide Transport</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>g_transport" id="<?php echo $x ?>g_transport" placeholder="Price Guide Transport">
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
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 11px;">Tips TL</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>tips_tl" id="<?php echo $x ?>tips_tl">
                    <option value="">Tidak ada</option>
                    <?php
                    $query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
                    $rs_tips = mysqli_query($con, $query_tips);
                    while ($row_tips = mysqli_fetch_array($rs_tips)) {
                    ?>
                        <option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Tips Guide</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>tips_guide" id="<?php echo $x ?>tips_guide">
                    <option>Tidak ada</option>
                    <?php
                    $query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
                    $rs_tips = mysqli_query($con, $query_tips);
                    while ($row_tips = mysqli_fetch_array($rs_tips)) {
                    ?>
                        <option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Tips Assistant</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>tips_ass" id="<?php echo $x ?>tips_ass">
                    <option>Tidak ada</option>
                    <?php
                    $query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
                    $rs_tips = mysqli_query($con, $query_tips);
                    while ($row_tips = mysqli_fetch_array($rs_tips)) {
                    ?>
                        <option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Tips Driver</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>tips_driver" id="<?php echo $x ?>tips_driver">
                    <option>Tidak ada</option>
                    <?php
                    $query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
                    $rs_tips = mysqli_query($con, $query_tips);
                    while ($row_tips = mysqli_fetch_array($rs_tips)) {
                    ?>
                        <option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Tips Porter</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>tips_porter" id="<?php echo $x ?>tips_porter">
                    <option>Tidak ada</option>
                    <?php
                    $query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
                    $rs_tips = mysqli_query($con, $query_tips);
                    while ($row_tips = mysqli_fetch_array($rs_tips)) {
                    ?>
                        <option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Tips Restaurant</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>tips_res" id="<?php echo $x ?>tips_res">
                    <option>Tidak ada</option>
                    <?php
                    $query_tips = "SELECT * FROM Tips_Landtour Order by id ASC";
                    $rs_tips = mysqli_query($con, $query_tips);
                    while ($row_tips = mysqli_fetch_array($rs_tips)) {
                    ?>
                        <option value="<?php echo $row_tips['id'] ?>"><?php echo $row_tips['negara'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- ////// batas ////// -->
        <!-- <div style="padding-top: 10px;">
            <label for="">LandTour</label>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 11px;">Landtour Name</label>
                <input class="form-control form-control-sm" type="text" list="<?php echo $x ?>LTN_list" name="<?php echo $x ?>LT_name" id="<?php echo $x ?>LT_name" onchange="fungsi_hotel2(<?php echo $x ?>)" placeholder="Landtour Name">
                <datalist id="<?php echo $x ?>LTN_list">
                    <?php
                    $query_LTN = "SELECT DISTINCT judul FROM LT_itin  Order by id ASC";
                    $rs_LTN = mysqli_query($con, $query_LTN);
                    while ($row_ltn = mysqli_fetch_array($rs_LTN)) {
                    ?>
                        <option data-customvalue="<?php echo $row_ltn['id'] ?>" value="<?php echo $row_ltn['judul'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">Landtour Hotel</label>
                <select class="form-control form-control-sm" name="<?php echo $x ?>LT_hotel" id="<?php echo $x ?>LT_hotel" placeholder="Landtour Hotel" onchange="price_HLT2(<?php echo $x ?>)">
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">LT Adult Twin Price</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>LTH_twn" id="<?php echo $x ?>LTH_twn" placeholder="Landtour Adult" disabled>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">LT CNB Price</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>LTH_cnb" id="<?php echo $x ?>LTH_cnb" placeholder="Landtour CNB" disabled>
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">LT INFANT Price</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>LT_infant" id="<?php echo $x ?>LT_infant" placeholder="Landtour Infant">
            </div>
            <div class="col-md-2">
                <label style="font-size: 11px;">LT Single Price</label>
                <input class="form-control form-control-sm" type="text" name="<?php echo $x ?>LTH_sgl" id="<?php echo $x ?>LTH_sgl" placeholder="Landtour Single" disabled>
            </div>
        </div> -->
    </div>
    <div style="padding-top: 10px;"></div>

<?php
}
?>
<script>
    // function guide_price(x) {
    //     // alert(x);
    //     var ret = parseInt($("#adult").val() || '0') + parseInt($("#child").val() || '0') + parseInt($("#infant").val() || '0');
    //     var lain = parseInt($("#tb_peserta").val() || '0') + parseInt($("#tour_leader").val() || '0') + parseInt($("#guide").val() || '0') + parseInt($("#driver").val() || '0') + parseInt($("#pendeta").val() || '0');
    //     var all = ret + lain;

    //     var gb = $("#" + x + "bf").val();
    //     var gl = $("#" + x + "lunch").val();
    //     var gd = $("#" + x + "dinner").val();

    //     var h_gb = $('#' + x + 'bf_list [value="' + gb + '"]').data('customvalue');
    //     var h_gl = $('#' + x + 'ln_list [value="' + gl + '"]').data('customvalue');
    //     var h_gd = $('#' + x + 'dn_list [value="' + gd + '"]').data('customvalue');

    //     if (gb != '' && gl != '' && gd != '') {
    //         // alert("onn tel");
    //         $("#" + x + "g_bf").prop("disabled", true);
    //         $("#" + x + "g_lunch").prop("disabled", true);
    //         $("#" + x + "g_dinner").prop("disabled", true);

    //         if (all > 14) {
    //             $("#" + x + "g_bf").val('0');
    //             $("#" + x + "g_lunch").val('0');
    //             $("#" + x + "g_dinner").val('0');
    //         } else {
    //             $.post('get_data.php', {
    //                 'brand': h_gb
    //             }, function(data) {
    //                 var obj = JSON.parse(data);
    //                 $("#" + x + "g_bf").val(obj.harga);
    //                 // alert(x);
    //                 // $('#gbf_list [value="' + val_obj + '"]').data('customvalue');
    //             });

    //             $.post('get_data_lunch.php', {
    //                 'brand': h_gb
    //             }, function(data) {
    //                 // alert(data);
    //                 var obj_lunch = JSON.parse(data);
    //                 $("#" + x + "g_lunch").val(obj_lunch.harga);
    //             });

    //             $.post('get_data_dinner.php', {
    //                 'brand': h_gb
    //             }, function(data) {
    //                 var obj_dn = JSON.parse(data);
    //                 $("#" + x + "g_dinner").val(obj_dn.harga);
    //             });

    //         }
    //     } else {
    //         $("#" + x + "g_bf").prop("disabled", false);
    //         $("#" + x + "g_lunch").prop("disabled", false);
    //         $("#" + x + "g_dinner").prop("disabled", false);
    //     }
    // }

    function get_tq() {
        var a = document.getElementById("sel_tq").options[document.getElementById("sel_tq").selectedIndex].value;
        $.ajax({
            url: "sub_tq.php",
            method: "POST",
            asynch: false,
            data: {
                tq: a,
            },
            success: function(data) {
                $('#tq2').html(data);
                document.getElementById('tq').style.display = 'none';
                document.getElementById('tq2').style.display = 'block';
            }
        });
    }

    function get_trans(x) {
        var a = document.getElementById(x + "sel_trans").options[document.getElementById(x + "sel_trans").selectedIndex].value;
        // alert(a);
        $.ajax({
            url: "sub_trans.php",
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

    function get_tujuan2() {
        var a = document.getElementById("sel_tujuan2").options[document.getElementById("sel_tujuan2").selectedIndex].value;
        alert(a);
        $.ajax({
            url: "sub_tujuan.php",
            method: "POST",
            asynch: false,
            data: {
                tujuan: a,
            },
            success: function(data) {
                $('#st2_a').html(data);
                document.getElementById('st_a').style.display = 'none';
                document.getElementById('st2_a').style.display = 'block';
            }
        });
    }

    function pilihan3(x) {
        var a = document.getElementById(x + "pilih").options[document.getElementById(x + "pilih").selectedIndex].value;
        var y = document.getElementById(x + "sel_trans").options[document.getElementById(x + "sel_trans").selectedIndex].value;
        alert("pilihan tdk ganda");
        $.ajax({
            url: "sub_tempat.php",
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

    function fguide_fee2(x) {
        // alert("on");
        var gb = $('#' + x + 'bf').val();
        var h_gb = $('#' + x + 'bf_list [value="' + gb + '"]').data('customvalue');
        //// guide fee
        $.post('get_fee_guide.php', {
            'brand': h_gb
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'guide_fee').append('<option value=' + counter.id + '>' + counter.deskripsi + ' :Rp.' + counter.harga + '</option>');
                }
            } else {
                $("#" + x + "guide_fee").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });

        //////// sfee guide /////////////////
        $.post('get_sfee_guide.php', {
            'brand': h_gb
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'gsfee').append('<option value=' + counter.id + '>' + counter.deskripsi + ' :Rp.' + counter.harga + '</option>');
                }
            } else {
                $("#" + x + "gsfee").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
        ///////// vocer guide ///////
        $.post('get_vocer.php', {
            'brand': h_gb
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'vt').append('<option value=' + counter.id + '>' + counter.deskripsi + ' :Rp.' + counter.harga + '</option>');
                }
            } else {
                $("#" + x + "vt").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }

    function guide_breakfast2(x) {
        var gb = $('#' + x + 'bf').val();
        var h_gb = $('#' + x + 'bf_list [value="' + gb + '"]').data('customvalue');

        var element = document.getElementById(x + "box_bf");
        var child = document.getElementById(x + "guide_bf");
        var label = document.getElementById(x + "bf_label");
        if (child != null && label != null) {
            element.removeChild(child);
            element.removeChild(label);
        }
        //// guide breakfast
        $.post('bf_breakfast.php', {
            'brand': h_gb,
        }, function(data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData[0].nama);
            if (jsonData[0].nama != null) {
                $('#' + x + 'box_bf')
                    .append('<input type="checkbox" id="' + x + 'guide_bf" name="' + x + 'guide_bf" value="' + jsonData[0].harga + '" checked>')
                    .append('<label  for="' + x + 'guide_bf" id="' + x + 'bf_label" style="font-size: 11px;">' + jsonData[0].nama + '</label></div>');
            } else {
                var element = document.getElementById(x + "box_bf");
                var child = document.getElementById(x + "guide_bf");
                var label = document.getElementById(x + "bf_label");
                if (child != null && label != null) {
                    element.removeChild(child);
                    element.removeChild(label);
                }
            }
        });
    }

    function guide_lunch2(x) {
        var gl = $('#' + x + 'lunch').val();
        var h_gl = $('#' + x + 'ln_list [value="' + gl + '"]').data('customvalue');

        var element2 = document.getElementById(x + "box_lunch");
        var child2 = document.getElementById(x + "guide_lunch");
        var label2 = document.getElementById(x + "ln_label");
        if (child2 != null && label2 != null) {
            element.removeChild(child2);
            element.removeChild(label2);
        }
        //// guide lunch
        $.post('guide_lunch.php', {
            'lunch': h_gl,
        }, function(data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData[0]);
            if (jsonData[0].nama != null) {
                $('#' + x + 'box_lunch')
                    .append('<input type="checkbox" id="' + x + 'guide_lunch" name="' + x + 'guide_lunch" value="' + jsonData[0].harga + '" checked>')
                    .append('<label  for="' + x + 'guide_lunch" id="' + x + 'ln_label" style="font-size: 11px;">' + jsonData[0].nama + '</label></div>');
            } else {
                alert('kosong');
                var element2 = document.getElementById(x + "box_lunch");
                var child2 = document.getElementById(x + "guide_lunch");
                var label2 = document.getElementById(x + "ln_label");
                if (child2 != null && label2 != null) {
                    element.removeChild(child2);
                    element.removeChild(label2);
                }
            }
        });
    }

    function guide_dinner2(x) {
        var gd = $('#' + x + 'dinner').val();
        var h_gd = $('#' + x + 'dn_list [value="' + gd + '"]').data('customvalue');

        var element3 = document.getElementById(x + "box_dinner");
        var child3 = document.getElementById(x + "guide_dinner");
        var label3 = document.getElementById(x + "dn_label");
        if (child3 != null && label3 != null) {
            element.removeChild(child3);
            element.removeChild(label3);
        }
        //// guide lunch
        $.post('guide_dinner.php', {
            'dinner': h_gd,
        }, function(data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData[0].nama);
            if (jsonData[0].nama != null) {
                $('#' + x + 'box_dinner')
                    .append('<input type="checkbox" id="' + x + 'guide_dinner" name="' + x + 'guide_dinner" value="' + jsonData[0].harga + '" checked>')
                    .append('<label  for="' + x + 'guide_dinner" id="' + x + 'dn_label" style="font-size: 11px;">' + jsonData[0].nama + '</label></div>');
            } else {
                var element3 = document.getElementById(x + "box_bf");
                var child3 = document.getElementById(x + "guide_dinner");
                var label3 = document.getElementById(x + "dn_label");
                if (child3 != null && label3 != null) {
                    element.removeChild(child3);
                    element.removeChild(label3);
                }
            }
        });
    }

    function fungsi_hotel2(x) {
        var lt = $('#' + x + 'LT_name').val();
        $.post('get_lthotel.php', {
            'brand': lt
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#' + x + 'LT_hotel').append('<option value=' + counter.id + '>' + counter.hotel + '</option>');
                }
            } else {
                $("#" + x + "LT_hotel").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }

            // $("#g_dinner").val(obj_dn.harga);
        });

    }

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

            // $("#g_dinner").val(obj_dn.harga);
        });

    }

    // function total_adt2(x, y) {
    //     var adt = $('#' + x + 'adult' + y).val();
    //     var total = parseInt(adt) * parseInt($("#adult").val() || '0');
    //     // $("#TT_adult").val(total);
    // }
</script>