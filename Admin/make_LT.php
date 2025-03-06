<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query2 = "SELECT * FROM rute_itin Order by id ASC";
$rs2 = mysqli_query($con, $query2);
// var_dump($query2);

$query_tr = "SELECT * FROM transport Order by id ASC";
$rs_tr = mysqli_query($con, $query_tr);

$bf2 = 'BREAKFAST';
$ln2 = 'LUNCH';
$dn2 = 'DINNER';

$query_meal2 = "SELECT * FROM Guest_meal where bld='" . $bf2 . "' Order by negara ASC";
$rs_meal2 = mysqli_query($con, $query_meal2);

$query_ln2 = "SELECT * FROM Guest_meal where bld='" . $ln2 . "' Order by negara ASC";
$rs_ln2 = mysqli_query($con, $query_ln2);

$query_dn2 = "SELECT * FROM Guest_meal where bld='" . $dn2 . "' Order by negara ASC";
$rs_dn2 = mysqli_query($con, $query_dn2);

// var_dump($query_vt);



$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
$rs_LTNx = mysqli_query($con, $query_LTNx);
?>
<div class="content-wrapper">
    <form action="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight:bold;">Itenerary</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append" style="text-align: right;">
                                    <button type="submit" onclick="reloadLandtour(3,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <div style="padding:20px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="header">
                                            <div class="card">

                                                <div class="card-header">
                                                    Input Image
                                                </div>
                                                <div class="card-body">
                                                    <div style="padding: 10px;">
                                                        <input type="file" id="files" name="files[]" onchange="preview_image();" accept="image/*" multiple />
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <div id="image_preview"></div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label style="font-size: 11px;">JUDUL TOUR </label>
                                                                <input class="form-control form-control-sm" type="text" name="j_tour" id="j_tour" placeholder="Judul TOUR">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input class="form-control form-control-sm" type="text" name="staff" id="staff" value="<?php echo $_SESSION['staff_id'] ?>" hidden>
                                                    <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <label style="font-size: 11px;">Landtour Name</label>
                                                            <input class="form-control form-control-sm" type="text" list="LTN_list" name="LT_name" id="LT_name" placeholder="Landtour Name">
                                                            <datalist id="LTN_list">
                                                                <?php

                                                                while ($row_ltn = mysqli_fetch_array($rs_LTN)) {
                                                                ?>
                                                                    <option data-customvalue="<?php echo $row_ltn['id'] ?>" value="<?php echo $row_ltn['judul'] ?>"></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label style="font-size: 12px;">Landtour Name</label>
                                                            <input class="form-control form-control-sm" list="ltn_list" name="LT_name" id="LT_name" placeholder="Landtour Name" onchange="fungsi_ltpax()">
                                                            <datalist id="ltn_list">
                                                                <?php

                                                                while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
                                                                    $kode = $row_ltn['kode'];
                                                                ?>
                                                                    <option data-customvalue="<?php echo $kode ?>" value="<?php echo $row_ltn['kode']." - ". $row_ltn['judul'] ?>"></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                        <!-- <div class="col-md-3">
                                                            <label style="font-size: 11px;">Jumlah Pax</label>
                                                            <select class="form-control form-control-sm" nama="sel_pax" id="sel_pax" onchange="fungsi_lthotel()">
                                                                <option value="">Pilih Pax</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label style="font-size: 11px;">Pilih Hotel</label>
                                                            <select class="form-control form-control-sm" nama="sel_htl" id="sel_htl">
                                                                <option value="">Pilih Hotel</option>
                                                            </select>
                                                        </div> -->
                                                    </div>
                                                    <div style="padding-top: 5px; padding-bottom: 5px;">
                                                        <div class="col-md-2">
                                                            <label style="font-size: 11px;">Pilih Jumlah Hari</label>
                                                            <select class="form-control form-control-sm" name="sel_day" id="sel_day" onchange="get_sub()">
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
                                                    <div class="sub" name="sub" id="sub" style="padding-top: 5px; padding-bottom: 5px;">
                                                        <div style="border: 2px solid black; padding: 10px;">
                                                            <div style="text-align: center; font-weight: bold;">Day 1</div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label style="font-size: 11px;">Rute</label>
                                                                    <input class="form-control form-control-sm" list="rute_list" name="rute" id="rute">
                                                                    <datalist id="rute_list">
                                                                        <?php
                                                                        while ($row2 = mysqli_fetch_array($rs2)) {
                                                                        ?>
                                                                            <option data-customvalue="<?php echo $row2['id'] ?>" value="<?php echo $row2['judul'] ?>"></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Jml Transport & Tempat Wisata</label>
                                                                    <select class="form-control form-control-sm" name="sel_trans" id="sel_trans" onchange="get_trans()">
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
                                                            <div class="str" name="str" id="str" style="padding-top: 5px; padding-bottom: 5px;">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label style="font-size: 11px;">Transport & Tempat 1</label>
                                                                        <select class="form-control form-control-sm" name="pilih" id="pilih" onchange="pilihan()">
                                                                            <option value="0">Select Type</option>
                                                                            <option value="1">Transport</option>
                                                                            <option value="2">Tempat</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="pil" name="pil" id="pil"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="str2" name="str2" id="str2" style="padding-top: 5px; padding-bottom: 5px;"></div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <input type="checkbox" id="cek_bf" name="cek_bf" checked>
                                                                    <label style="font-size: 11px;">Guest Breakfast</label>
                                                                    <input class="form-control form-control-sm" list="bf_list" name="bf" id="bf">
                                                                    <datalist id="bf_list">
                                                                        <?php
                                                                        while ($row_meal2 = mysqli_fetch_array($rs_meal2)) {
                                                                        ?>
                                                                            <option data-customvalue="<?php echo $row_meal2['id'] ?>" value="<?php echo $row_meal2['negara'] . " " . $row_meal2['bld'] . " : Rp. " . number_format($row_meal2['harga_idr']) ?>"></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="checkbox" id="cek_ln" name="cek_ln" checked>
                                                                    <label style="font-size: 11px;">Guest Lunch</label>
                                                                    <input class="form-control form-control-sm" list="ln_list" name="lunch" id="lunch">
                                                                    <datalist id="ln_list">
                                                                        <?php
                                                                        while ($row_ln2 = mysqli_fetch_array($rs_ln2)) {
                                                                        ?>
                                                                            <option data-customvalue="<?php echo $row_ln2['id'] ?>" value="<?php echo $row_ln2['negara'] . " " . $row_ln2['bld'] . " : Rp. " . number_format($row_ln2['harga_idr']) ?>"></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="checkbox" id="cek_dn" name="cek_dn" checked>
                                                                    <label style="font-size: 11px;">Guest Dinner</label>
                                                                    <input class="form-control form-control-sm" list="dn_list" name="dinner" id="dinner">
                                                                    <datalist id="dn_list">
                                                                        <?php
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
                                                                    <input class="form-control form-control-sm" type="text" name="guest_hotel" id="guest_hotel" placeholder="Hotel">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guest Twin</label>
                                                                    <input class="form-control form-control-sm" type="text" name="hotel_twin" id="hotel_twin" placeholder="0" onchange="TL_htl()">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guest Triple</label>
                                                                    <input class="form-control form-control-sm" type="text" name="hotel_single" id="hotel_single" placeholder="0">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guest Family</label>
                                                                    <input class="form-control form-control-sm" type="text" name="hotel_family" id="hotel_family" placeholder="0">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">TL Fee</label>
                                                                    <!-- <input class="form-control form-control-sm" type="text" name="tl_fee" id="tl_fee" placeholder="0"> -->
                                                                    <input class="form-control form-control-sm" type="text" list="tlfee_list" name="tl_fee" id="tl_fee" placeholder="0">
                                                                    <datalist id="tlfee_list">
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
                                                                    <input class="form-control form-control-sm" type="text" list="tlsfee_list" name="tl_sfee" id="tl_sfee" placeholder="0">
                                                                    <datalist id="tlsfee_list">
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
                                                                    <input class="form-control form-control-sm" type="text" list="tlv_list" name="tl_v" id="tl_v" placeholder="0">
                                                                    <datalist id="tlv_list">
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
                                                                    <input class="form-control form-control-sm" type="text" list="tlm_list" name="tl_m" id="tl_m" placeholder="0">
                                                                    <datalist id="tlm_list">
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
                                                                    <input class="form-control form-control-sm" type="text" name="tl_h" id="tl_h" disabled placeholder="0">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">TL Transport</label>
                                                                    <input class="form-control form-control-sm" type="text" name="tl_t" id="tl_t" disabled placeholder="0">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="row">
                                                                <div class="col-md-6">
                                                                    <label style="font-size: 11px;">Include</label>
                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="ctiket" name="ctiket" checked>
                                                                                <label style="font-size: 11px;">TIKET PESAWAT PP</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="chotel" name="chotel" checked>
                                                                                <label style="font-size: 11px;">HOTEL SESUAI ITINERARY</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="ctour" name="ctour" checked>
                                                                                <label style="font-size: 11px;">TOUR , MEAL & TRANSPORT SESUAI PROGRAM</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="cguide" name="cguide" checked>
                                                                                <label style="font-size: 11px;">TOUR GUIDE BERBAHASA INDONESIA</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="csovenir" name="csovenir" checked>
                                                                                <label style="font-size: 11px;">SOUVENIR CANTIK PERFORMA TOUR & TRAVEL</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="font-size: 11px;">Exclude</label>
                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="ctips" name="ctips" checked>
                                                                                <label style="font-size: 11px;">TIPS GUIDE & DRIVER</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="ctl" name="ctl" checked>
                                                                                <label style="font-size: 11px;">TIPS TOUR LEADER</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="casuransi" name="casuransi" checked>
                                                                                <label style="font-size: 11px;">ASURANSI,PORTER & BIAYA PRIBADI SELAMA PERJALANAN</label>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <input type="checkbox" id="cbagasi" name="cbagasi" checked>
                                                                                <label style="font-size: 11px;">BAGASI PESAWAT</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <!-- ////// batas ////// -->
                                                            <!-- <div style="padding-top: 10px;">
                                                                <label for="">LandTour</label>
                                                            </div> -->



                                                        </div>
                                                    </div>
                                                    <div class="sub2" name="sub2" id="sub2" style="padding-top: 5px; padding-bottom: 5px;"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <button type="button" class="btn btn-primary" onclick="insert_itin()">Submit</button>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
    </form>
</div>
<!-- /.row -->

</div>
<script>
    function preview_image() {
        var total_file = document.getElementById("files").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#image_preview')
                .append('<div class="col-md-3"')
                .append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' style='width:150px; hight:150px; padding=10px'>")
                .append('</div>');
        }
    }
</script>
<script>
    $("input").on("change", function() {

        // alert(day);
        var ret = parseInt($("#adult").val() || '0') + parseInt($("#child").val() || '0') + parseInt($("#infant").val() || '0');
        var lain = parseInt($("#tb_peserta").val() || '0') + parseInt($("#tour_leader").val() || '0') + parseInt($("#guide").val() || '0') + parseInt($("#driver").val() || '0') + parseInt($("#pendeta").val() || '0');
        // var gb = $("#bf").val();
        var gb = $('#bf').val();
        var gl = $("#lunch").val();
        var gd = $("#dinner").val();

        var h_gb = $('#bf_list [value="' + gb + '"]').data('customvalue');
        var h_gl = $('#ln_list [value="' + gl + '"]').data('customvalue');
        var h_gd = $('#dn_list [value="' + gd + '"]').data('customvalue');
        var bld = '';

        // alert(h_gb);

        var all = ret + lain;
        $("#total_pax").val(ret);
        $("#total_all").val(all);
        //// total bld ////////////////////////////


        /////////////// end total bld ///////////////

    })

    function TL_htl() {
        var hotel = $('#hotel_twin').val();
        $("#tl_h").val(hotel);

    }

    // $('#files').change(function() {
    //     var totalfiles = document.getElementById('files').files.length;
    //     for (var index = 0; index < totalfiles; index++) {
    //         form_data.append("files[]", document.getElementById('files').files[index]);
    //         $('#preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
    //     }

    // });

    // function fungsi_hotel() {
    //     var lt = $('#LT_name').val();
    //     $.post('get_lthotel.php', {
    //         'brand': lt
    //     }, function(data) {
    //         var jsonData = JSON.parse(data);
    //         if (jsonData != '') {
    //             for (var i = 0; i < jsonData.length; i++) {
    //                 var counter = jsonData[i];
    //                 $('#LT_hotel').append('<option value=' + counter.id + '>' + counter.hotel + '</option>');
    //             }
    //         } else {
    //             $("#LT_hotel").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
    //         }

    //         // $("#g_dinner").val(obj_dn.harga);
    //     });

    // }


    function fungsi_ltpax() {
        var gb = $("#LT_name").val();
        var h_gb = $('#ltn_list [value="' + gb + '"]').data('customvalue');
        // alert(h_gb);
        $.post('get_select_ltpax.php', {
            'brand': h_gb
        }, function(data) {
            var jsonData = JSON.parse(data);
            // console.log(jsonData);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#sel_pax').append('<option value=' + counter.pax + '>' + counter.pax + '</option>');
                }
            } else {
                $("#sel_pax").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
            }
        });
    }

    function fungsi_lthotel() {
        var gb = $("#LT_name").val();
        var h_gb = $('#ltn_list [value="' + gb + '"]').data('customvalue');
        var pax = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
        alert(h_gb);
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


    function price_HLT() {
        var lth = $('#LT_hotel').val();
        $.post('get_price_LTHl.php', {
            'brand': lth
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $("#LTH_twn").val(counter.twn);
                    $("#LTH_cnb").val(counter.cnb);
                    $("#LTH_sgl").val(counter.sgl);

                    var tot = $("#adult").val() * $("#LTH_twn").val();
                    var tot2 = $("#child").val() * $("#LTH_cnb").val();
                    var total = tot + tot2;
                    alert(tot);

                    $("#total_tl").val(total);

                }
            } else {
                $("#LTH_twn").val('0');
                $("#LTH_cnb").val('0');
                $("#LTH_sgl").val('0');

            }

            // $("#g_dinner").val(obj_dn.harga);
        });

    }
</script>
<script>
    function get_sub() {
        var a = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        $.ajax({
            url: "LT_multiday.php",
            method: "POST",
            asynch: false,
            data: {
                sub: a,
            },
            success: function(data) {
                $('#sub2').html(data);
                document.getElementById('sub').style.display = 'none';
                document.getElementById('sub2').style.display = 'block';
            }
        });
        // }

    }

    function pilihan() {
        var a = document.getElementById("pilih").options[document.getElementById("pilih").selectedIndex].value;
        // alert(a);
        var x = 1;
        var y = 1;
        // alert(x);
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
                $('#pil').html(data);
            }
        });
        // }

    }

    function get_tujuan() {
        var a = document.getElementById("sel_tujuan").options[document.getElementById("sel_tujuan").selectedIndex].value;
        $.ajax({
            url: "sub_tujuan.php",
            method: "POST",
            asynch: false,
            data: {
                tujuan: a,
            },
            success: function(data) {
                $('#st2').html(data);
                document.getElementById('st').style.display = 'none';
                document.getElementById('st2').style.display = 'block';
            }
        });
    }

    function get_trans() {
        var a = document.getElementById("sel_trans").options[document.getElementById("sel_trans").selectedIndex].value;
        // alert(a);
        var day = 1;
        $.ajax({
            url: "LT_subtrans.php",
            method: "POST",
            asynch: false,
            data: {
                trans: a,
                day: day
            },
            success: function(data) {
                $('#str2').html(data);
                document.getElementById('str').style.display = 'none';
                document.getElementById('str2').style.display = 'block';
            }
        });
    }

    // function total_LT() {
    //     alert("bisa dong");
    // }


    function insert_itinxx() {
        alert("itin xxx");
        var fileSelect = document.getElementById('files');
        var files = fileSelect.files;
        var total_file = document.getElementById("files").files.length;

        var data = {};
        var arr_gmb = [];
        // console.log(fileSelect);
        for (var i = 0; i < total_file; i++) {
            gmb = {};
            gmb['filename'] = files[i].name;
            gmb['filesize'] = files[i].size;
            gmb['filetype'] = files[i].type;
            // gmb['obj'] = files[i];
            arr_gmb.push(gmb);


            let formData = new FormData();
            formData.append('fileupload', files[i]);
            $.ajax({
                type: 'POST',
                url: "upload_img.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });


        }
        console.log(arr_gmb);
        data['gambar'] = arr_gmb;
        $.ajax({
            type: "POST",
            url: "Insert_itenerary.php",
            data: {
                data: data
            },
            dataType: "JSON",
            success: function(msg) {
                alert(msg);
                Reloaditin(1, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

        // let formData = new FormData();
        // formData.append('fileupload', files);
        // $.ajax({
        //     type: 'POST',
        //     url: "upload.php",
        //     data: formData,
        //     cache: false,
        //     processData: false,
        //     contentType: false,
        //     success: function (msg) {
        //         alert(msg);
        //         document.getElementById("form-data").reset();
        //     },
        //     error: function () {
        //         alert("Data Gagal Diupload");
        //     }
        // });


    }

    function include_itin() {

    }


    function insert_itin() {
        // alert("on");
        var fileSelect = document.getElementById('files');
        var files = fileSelect.files;
        var total_file = document.getElementById("files").files.length;
        var arr_gmb = [];
        // console.log(fileSelect);
        for (var i = 0; i < total_file; i++) {
            gmb = {};
            gmb['filename'] = files[i].name;
            gmb['filesize'] = files[i].size;
            gmb['filetype'] = files[i].type;
            arr_gmb.push(gmb);

            let formData = new FormData();
            formData.append('fileupload', files[i]);
            $.ajax({
                type: 'POST',
                url: "upload_img.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
        // var arr_inc = [];
        // var arr_exc = [];

        // for (var i = 1; i <= n; i++) {
        // if ($('#check_' + i).is(":checked")) {
        //     arr_inc.push( $("#check_" + i).val());
        // }else{
        //     arr_exc.push( $("#check_" + i).val());
        // }
        // }

        var datalist = [];
        var data = {};
        data['gambar'] = arr_gmb;
        data['judul'] = $("input[name=j_tour]").val();
        data['jml_day'] = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var gb = $("#LT_name").val();
        data['landtour_name'] = $('#ltn_list [value="' + gb + '"]').data('customvalue');
        // data['staff'] = $("input[name=staff]").val();
        // data['inc'] = arr_inc;
        // data['exc'] = arr_exc;
        var loop_day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        //// tour perday 
        var array_day = [];
        if (loop_day == 1) {
            day = {};
            var d = 1;
            var dl = 1;
            day['rute'] = $("input[name=rute]").val();
            day['jml_transport'] = document.getElementById("sel_trans").options[document.getElementById("sel_trans").selectedIndex].value;
            var loop_trans = document.getElementById("sel_trans").options[document.getElementById("sel_trans").selectedIndex].value;
            var array_sel_trans = [];
            if (loop_trans == 1) {
                /// pilihan trans 1 hari /////
                sel_trans = {};
                var pilih = document.getElementById(d + "pilih").options[document.getElementById(d + "pilih").selectedIndex].value;
                sel_trans['type'] = document.getElementById(d + "pilih").options[document.getElementById(d + "pilih").selectedIndex].value;
                //// admision /////
                if (pilih == 2) {
                    var val_tujuan = $('#tujuan').val();
                    // sel_trans['tujuan'] = $("input[name=" + d + "tujuan" + dl + "]").val();
                    sel_trans['tujuan'] = $('#' + d + 'tujuan_list' + dl + ' [value="' + val_tujuan + '"]').data('customvalue');
                    sel_trans['price'] = $("input[name=" + d + "price_adm" + dl + "]").val();
                }
                /////// transport //////
                else {
                    var trans_type = document.getElementById(d + "pilih_trans" + dl).options[document.getElementById(d + "pilih_trans" + dl).selectedIndex].value;
                    //// flight //////
                    if (trans_type == 1) {
                        sel_trans['transport_type'] = "flight";
                        sel_trans['transport_name'] = $('#' + d + 'flight' + dl).val();
                        sel_trans['adult'] = $("#" + d + "adult" + dl).val();
                        sel_trans['child'] = $("#" + d + "child" + dl).val();
                        sel_trans['infant'] = $("#" + d + "infant" + dl).val();
                    }
                    ///// ferryy /////////
                    else if (trans_type == 2) {
                        sel_trans['transport_type'] = "ferry";
                        sel_trans['transport_name'] = $("#" + d + "ferrynm" + dl).val();
                        sel_trans['adult'] = $("#" + d + "adult" + dl).val();
                        sel_trans['child'] = $("#" + d + "child" + dl).val();
                        sel_trans['infant'] = $("#" + d + "infant" + dl).val();

                    }
                    /////// land ////////
                    else if (trans_type == 3) {
                        sel_trans['transport_type'] = "land";
                        var land = $('#' + d + 'transport' + dl).val();
                        sel_trans['transport_name'] = $('#' + d + 'transport_list' + dl + ' [value="' + land + '"]').data('customvalue');
                        sel_trans['rent_type'] = document.getElementById(d + "rtv" + dl).value;
                        sel_trans['price'] = $('#' + d + 'price_LN' + dl).val();
                    }
                    ////// train //////
                    else {
                        sel_trans['transport_type'] = "train";
                        sel_trans['transport_name'] = $("#" + d + "trainnm" + dl).val();
                        sel_trans['adult'] = $("#" + d + "adult" + dl).val();
                        sel_trans['child'] = $("#" + d + "child" + dl).val();
                        sel_trans['infant'] = $("#" + d + "infant" + dl).val();
                    }

                }
                array_sel_trans.push(sel_trans);
            } else {
                /// pilihan trans banyak hari /////
                for (let xt = 1; xt <= loop_trans; xt++) {
                    sel_trans = {};
                    var pilih = document.getElementById(d + "pilih" + xt).options[document.getElementById(d + "pilih" + xt).selectedIndex].value;
                    sel_trans['type'] = document.getElementById(d + "pilih" + xt).options[document.getElementById(d + "pilih" + xt).selectedIndex].value;
                    //// admision /////
                    if (pilih == 2) {
                        var val_tujuan = $('#' + d + 'tujuan' + xt).val();
                        sel_trans['tujuan'] = $('#' + d + 'tujuan_list' + xt + ' [value="' + val_tujuan + '"]').data('customvalue');
                        // sel_trans['tujuan'] = $("input[name=" + d + "tujuan" + xt + "]").val();
                        sel_trans['price'] = $("input[name=" + d + "price_adm" + xt + "]").val();
                    }
                    /////// transport //////
                    else {
                        var trans_type = document.getElementById(d + "pilih_trans" + xt).options[document.getElementById(d + "pilih_trans" + xt).selectedIndex].value;
                        //// flight //////
                        if (trans_type == 1) {
                            sel_trans['transport_type'] = "flight";
                            sel_trans['transport_name'] = $('#' + d + 'flight' + xt).val();
                            sel_trans['adult'] = $("#" + d + "adult" + xt).val();
                            sel_trans['child'] = $("#" + d + "child" + xt).val();
                            sel_trans['infant'] = $("#" + d + "infant" + xt).val();
                        }
                        ///// ferryy /////////
                        else if (trans_type == 2) {
                            sel_trans['transport_type'] = "ferry";
                            sel_trans['transport_name'] = $("#" + d + "ferrynm" + xt).val();
                            sel_trans['adult'] = $("#" + d + "adult" + xt).val();
                            sel_trans['child'] = $("#" + d + "child" + xt).val();
                            sel_trans['infant'] = $("#" + d + "infant" + xt).val();

                        }
                        /////// land ////////
                        else if (trans_type == 3) {
                            sel_trans['transport_type'] = "land";
                            var land = $('#' + d + 'transport' + xt).val();
                            sel_trans['transport_name'] = $('#' + d + 'transport_list' + xt + ' [value="' + land + '"]').data('customvalue');
                            sel_trans['rent_type'] = document.getElementById(d + "rtv" + xt).value;
                            sel_trans['price'] = $('#' + d + 'price_LN' + xt).val();
                        }
                        ////// train //////
                        else {
                            sel_trans['transport_type'] = "train";
                            sel_trans['transport_name'] = $("#" + d + "trainnm" + xt).val();
                            sel_trans['adult'] = $("#" + d + "adult" + xt).val();
                            sel_trans['child'] = $("#" + d + "child" + xt).val();
                            sel_trans['infant'] = $("#" + d + "infant" + xt).val();
                        }

                    }
                    array_sel_trans.push(sel_trans);
                }
            }
            day['sel_trans'] = array_sel_trans;
            ///// end trans ///////
            var gb = $("input[name=bf]").val();;
            var gl = $("input[name=lunch]").val();
            var gd = $("input[name=dinner]").val();
            day['guest_breakfast'] = $('#bf_list [value="' + gb + '"]').data('customvalue');
            day['guest_lunch'] = $('#ln_list [value="' + gl + '"]').data('customvalue');
            day['guest_dinner'] = $('#dn_list [value="' + gd + '"]').data('customvalue');
            day['guest_hotel_name'] = $("input[name=guest_hotel]").val();
            day['gst_hotel_twin'] = $("input[name=hotel_twin]").val();
            day['gst_hotel_triple'] = $("input[name=hotel_single]").val();
            day['gst_hotel_family'] = $("input[name=hotel_family]").val();
            day['landtour_hotel'] = $("#LT_hotel").val();
            day['lt_hotel_twin'] = $("#LTH_twn").val();
            day['lt_hotel_cnb'] = $("#LTH_cnb").val();
            day['lt_hotel_infant'] = $("#LTH_infant").val();
            day['lt_hotel_single'] = $("#LTH_sgl").val();

            var fee = $("#tl_fee").val();
            var sfee = $("#tl_sfee").val();
            var vt = $("#tl_v").val();
            var meal = $("#tl_m").val();

            day['tl_fee'] = $('#tlfee_list [value="' + fee + '"]').data('customvalue');
            day['tl_sfee'] = $('#tlsfee_list [value="' + sfee + '"]').data('customvalue');
            day['tl_vt'] = $('#tlv_list [value="' + vt + '"]').data('customvalue');
            day['tl_meal'] = $('#tlm_list [value="' + meal + '"]').data('customvalue');
            day['tl_hotel'] = $("#tl_h").val();
            day['tl_transport'] = $("#tl_t").val();

            array_day.push(day);

        } else {
            for (let i = 1; i <= loop_day; i++) {
                day = {};
                day['rute'] = $("input[name=rute" + i + "]").val();
                day['jml_transport'] = document.getElementById(i + "sel_trans").options[document.getElementById(i + "sel_trans").selectedIndex].value;
                var loop_trans = document.getElementById(i + "sel_trans").options[document.getElementById(i + "sel_trans").selectedIndex].value;
                var array_sel_trans = [];
                var dl = 1;
                if (loop_trans == 1) {
                    /// pilihan trans 1 hari /////
                    sel_trans = {};
                    var pilih = document.getElementById(i + "pilih").options[document.getElementById(i + "pilih").selectedIndex].value;
                    sel_trans['type'] = document.getElementById(i + "pilih").options[document.getElementById(i + "pilih").selectedIndex].value;
                    //// admision /////
                    if (pilih == 2) {
                        // sel_trans['tujuan'] = $("input[name=" + i + "tujuan" + dl + "]").val();

                        var val_tujuan = $('#' + i + 'tujuan' + dl).val();
                        sel_trans['tujuan'] = $('#' + i + 'tujuan_list' + dl + ' [value="' + val_tujuan + '"]').data('customvalue');
                        sel_trans['price'] = $("input[name=" + i + "price_adm" + dl + "]").val();
                    }
                    /////// transport //////
                    else {
                        var trans_type = document.getElementById(i + "pilih_trans" + dl).options[document.getElementById(i + "pilih_trans" + dl).selectedIndex].value;
                        //// flight //////
                        if (trans_type == 1) {
                            sel_trans['transport_type'] = "flight";
                            sel_trans['transport_name'] = $('#' + i + 'flight' + dl).val();
                            sel_trans['adult'] = $("#" + i + "adult" + dl).val();
                            sel_trans['child'] = $("#" + i + "child" + dl).val();
                            sel_trans['infant'] = $("#" + i + "infant" + dl).val();
                        }
                        ///// ferryy /////////
                        else if (trans_type == 2) {
                            sel_trans['transport_type'] = "ferry";
                            sel_trans['transport_name'] = $("#" + i + "ferrynm" + dl).val();
                            sel_trans['adult'] = $("#" + i + "adult" + dl).val();
                            sel_trans['child'] = $("#" + i + "child" + dl).val();
                            sel_trans['infant'] = $("#" + i + "infant" + dl).val();

                        }
                        /////// land ////////
                        else if (trans_type == 3) {
                            sel_trans['transport_type'] = "land";
                            var land = $('#' + d + 'transport' + dl).val();
                            sel_trans['transport_name'] = $('#' + d + 'transport_list' + dl + ' [value="' + land + '"]').data('customvalue');
                            sel_trans['rent_type'] = document.getElementById(d + "rtv" + dl).value;
                            sel_trans['price'] = $('#' + i + 'price_LN' + dl).val();
                        }
                        ////// train //////
                        else {
                            sel_trans['transport_type'] = "train";
                            sel_trans['transport_name'] = $("#" + i + "trainnm" + dl).val();
                            sel_trans['adult'] = $("#" + i + "adult" + dl).val();
                            sel_trans['child'] = $("#" + i + "child" + dl).val();
                            sel_trans['infant'] = $("#" + i + "infant" + dl).val();
                        }

                    }
                    array_sel_trans.push(sel_trans);
                } else {
                    /// pilihan trans banyak hari /////
                    for (let xt = 1; xt <= loop_trans; xt++) {
                        sel_trans = {};
                        var pilih = document.getElementById(i + "pilih" + xt).options[document.getElementById(i + "pilih" + xt).selectedIndex].value;
                        sel_trans['type'] = document.getElementById(i + "pilih" + xt).options[document.getElementById(i + "pilih" + xt).selectedIndex].value;
                        //// admision /////
                        if (pilih == 2) {
                            var val_tujuan = $('#' + i + 'tujuan' + xt).val();
                            sel_trans['tujuan'] = $('#' + i + 'tujuan_list' + xt + ' [value="' + val_tujuan + '"]').data('customvalue');
                            // sel_trans['tujuan'] = $("input[name=" + d + "tujuan" + xt + "]").val();
                            sel_trans['price'] = $("input[name=" + i + "price_adm" + xt + "]").val();
                        }
                        /////// transport //////
                        else {
                            var trans_type = document.getElementById(i + "pilih_trans" + xt).options[document.getElementById(i + "pilih_trans" + xt).selectedIndex].value;
                            //// flight //////
                            if (trans_type == 1) {
                                sel_trans['transport_type'] = "flight";
                                sel_trans['transport_name'] = $('#' + i + 'flight' + xt).val();
                                sel_trans['adult'] = $("#" + i + "adult" + xt).val();
                                sel_trans['child'] = $("#" + i + "child" + xt).val();
                                sel_trans['infant'] = $("#" + i + "infant" + xt).val();
                            }
                            ///// ferryy /////////
                            else if (trans_type == 2) {
                                sel_trans['transport_type'] = "ferry";
                                sel_trans['transport_name'] = $("#" + i + "ferrynm" + xt).val();
                                sel_trans['adult'] = $("#" + i + "adult" + xt).val();
                                sel_trans['child'] = $("#" + i + "child" + xt).val();
                                sel_trans['infant'] = $("#" + i + "infant" + xt).val();
                            }
                            /////// land ////////
                            else if (trans_type == 3) {
                                sel_trans['transport_type'] = "land";
                                var land = $('#' + i + 'transport' + xt).val();
                                sel_trans['transport_name'] = $('#' + i + 'transport_list' + xt + ' [value="' + land + '"]').data('customvalue');
                                sel_trans['rent_type'] = document.getElementById(i + "rtv" + xt).value;
                                sel_trans['price'] = $('#' + i + 'price_LN' + xt).val();
                            }
                            ////// train //////
                            else {
                                sel_trans['transport_type'] = "train";
                                sel_trans['transport_name'] = $("#" + i + "trainnm" + xt).val();
                                sel_trans['adult'] = $("#" + i + "adult" + xt).val();
                                sel_trans['child'] = $("#" + i + "child" + xt).val();
                                sel_trans['infant'] = $("#" + i + "infant" + xt).val();
                            }

                        }
                        array_sel_trans.push(sel_trans);
                    }
                }
                ////
                day['sel_trans'] = array_sel_trans;
                ///// end trans ///////
                var gb = $("input[name="+i+"bf]").val();
                var gl = $("input[name="+i+"lunch]").val();
                var gd = $("input[name="+i+"dinner]").val();
                day['guest_breakfast'] = $('#'+i+'bf_list [value="' + gb + '"]').data('customvalue');
                day['guest_lunch'] = $('#'+i+'ln_list [value="' + gl + '"]').data('customvalue');
                day['guest_dinner'] = $('#'+i+'dn_list [value="' + gd + '"]').data('customvalue');

                day['guest_hotel_name'] = $("input[name=" + i + "guest_hotel]").val();
                day['gst_hotel_twin'] = $("input[name=" + i + "hotel_twin]").val();
                day['gst_hotel_triple'] = $("input[name=" + i + "hotel_single]").val();
                day['gst_hotel_family'] = $("input[name=" + i + "hotel_family]").val();

                var fee = $("#" + i + "tl_fee").val();
                var sfee = $("#" + i + "tl_sfee").val();
                var vt = $("#" + i + "tl_v").val();
                var meal = $("#" + i + "tl_m").val();

                day['tl_fee'] = $('#' + i + 'tlfee_list [value="' + fee + '"]').data('customvalue');
                day['tl_sfee'] = $('#' + i + 'tlsfee_list [value="' + sfee + '"]').data('customvalue');
                day['tl_vt'] = $('#' + i + 'tlv_list [value="' + vt + '"]').data('customvalue');
                day['tl_meal'] = $('#' + i + 'tlm_list [value="' + meal + '"]').data('customvalue');
                day['tl_hotel'] = $("#" + i + "tl_h").val();
                day['tl_transport'] = $("#" + i + "tl_t").val();


                // if (ctiket.checked) {day['ctiket'] = '1'; } else {day['ctiket'] = '0';}
                // if (chotel.checked) {day['ctiket'] = '1'; } else {day['ctiket'] = '0';}
                // if (ctour.checked) {day['ctiket'] = '1'; } else {day['ctiket'] = '0';}
                // if (cguide.checked) {day['ctiket'] = '1'; } else {day['ctiket'] = '0';}
                // if (csovenir.checked) {day['ctiket'] = '1'; } else {day['ctiket'] = '0';}

                array_day.push(day);
                // end push day
            }

        }
        data['day'] = array_day;
        $.ajax({
            type: "POST",
            url: "Insert_makeLT.php",
            data: {
                data: data
            },
            dataType: "JSON",
            success: function(response) {
                if (response == "success") {
                    alert(response);
                    Reloaditin(1, 0, 0);
                } else {
                    alert(response);
                }
            },
        });
        Reloaditin(5, 0, 0);
    }
</script>