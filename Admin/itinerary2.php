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
/// guide fee
$query_guide_f = "SELECT * FROM Guide_Meal where type='FEE' Order by id ASC";
$rs_guide_f = mysqli_query($con, $query_guide_f);

$query_guide_bf = "SELECT * FROM Guide_Meal where type='MEAL' && kode='E' Order by id ASC";
$rs_guide_bf = mysqli_query($con, $query_guide_bf);

$query_guide_ln = "SELECT * FROM Guide_Meal where type='MEAL' && kode='F' Order by id ASC";
$rs_guide_ln = mysqli_query($con, $query_guide_ln);

$query_guide_dn = "SELECT * FROM Guide_Meal where type='MEAL' && kode='G' Order by id ASC";
$rs_guide_dn = mysqli_query($con, $query_guide_dn);

$query_sfee = "SELECT * FROM Guide_Meal where type='S FEE' && kode='D' Order by id ASC";
$rs_guide_sfee = mysqli_query($con, $query_sfee);

$query_vt = "SELECT * FROM Guide_Meal where type='VT' && kode='H' Order by id ASC";
$rs_vt = mysqli_query($con, $query_vt);
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
                                                    <!-- <div class="container" style="text-align: right;"> -->
                                                    <div class="row" style="align-items: flex-end;">
                                                        <div class="col-md-2">
                                                            <input type="checkbox" id="gt" name="gt" value="gt" onclick="fungsi_gt()" checked>
                                                            <label>Group</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox" id="pt" name="pt" value="pt" onclick="fungsi_pt()">
                                                            <label>Private</label>
                                                        </div>
                                                    </div>
                                                    <!-- </div> -->
                                                    <div style="padding: 10px;">
                                                        <input type="file" id="files" name="files[]" onchange="preview_image();" multiple />
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <div id="image_preview"></div>
                                                        </div>
                                                    </div>
                                                    <div style="padding-top: 5px; padding-bottom: 5px;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label style="font-size: 11px;">ADULT</label>
                                                                            <input class="form-control form-control-sm" type="number" min="0" name="adult" id="adult" placeholder="0">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label style="font-size: 11px;">CHILD </label>
                                                                            <input class="form-control form-control-sm" type="number" min="0" name="child" id="child" placeholder="0">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label style="font-size: 11px;">INFANT </label>
                                                                            <input class="form-control form-control-sm" type="number" min="0" name="infant" id="infant" placeholder="0">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <label style="font-size: 11px;">TOTAL PESERTA </label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="total_pax" id="total_pax" disabled placeholder="0">
                                                                </div>
                                                                <div>
                                                                    <label style="font-size: 11px;">TOTAL BONUS PESERTA </label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="tb_peserta" id="tb_peserta" placeholder="0">
                                                                </div>
                                                                <div>
                                                                    <label style="font-size: 11px;">TOTAL PESERTA TERMASUK BNS,TL , GUIDE ,DRIVER & PDT</label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="total_all" id="total_all" value='2' disabled placeholder="2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <label style="font-size: 11px;">TOUR LEADER</label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="tour_leader" id="tour_leader" placeholder="0">
                                                                </div>
                                                                <div>
                                                                    <label style="font-size: 11px;">GUIDE </label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="guide" id="guide" value='1' placeholder="1">
                                                                </div>
                                                                <div>
                                                                    <label style="font-size: 11px;">DRIVER </label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="driver" id="driver" value='1' placeholder="1">
                                                                </div>
                                                                <div>
                                                                    <label style="font-size: 11px;">PENDETA </label>
                                                                    <input class="form-control form-control-sm" type="number" min="0" name="pendeta" id="pendeta" placeholder="0">
                                                                </div>
                                                            </div>
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
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label style="font-size: 12px;">Landtour Name</label>
                                                                <input class="form-control form-control-sm" list="ltn_list" name="LT_name" id="LT_name" placeholder="Landtour Name" onchange="fungsi_ltpax()">
                                                                <datalist id="ltn_list">
                                                                    <?php

                                                                    while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
                                                                        $kode = $row_ltn['kode'];
                                                                    ?>
                                                                        <option data-customvalue="<?php echo $kode ?>" value="<?php echo $row_ltn['judul'] ?>"></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                            </div>
                                                            <div class="col-md-3">
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
                                                            </div>
                                                        </div>
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
                                                                    <input class="form-control form-control-sm" list="bf_list" name="bf" id="bf" onchange="fguide_fee(); guide_breakfast();">
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
                                                                    <input class="form-control form-control-sm" list="ln_list" name="lunch" id="lunch" onchange="guide_lunch();">
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
                                                                    <input class="form-control form-control-sm" list="dn_list" name="dinner" id="dinner" onchange="guide_dinner();">
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
                                                                <div class="col-md-2" style="padding-top: 10px;">
                                                                    <div id="box_bf" name="box_bf"></div>
                                                                </div>
                                                                <div class="col-md-2" style="padding-top: 10px;">
                                                                    <div id="box_lunch" name="box_lunch"></div>
                                                                </div>
                                                                <div class="col-md-2" style="padding-top: 10px;">
                                                                    <div id="box_dinner" name="box_dinner"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guide Hotel</label>
                                                                    <input class="form-control form-control-sm" type="text" name="g_hotel" id="g_hotel" placeholder="Hotel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guide Fee</label>
                                                                    <select class="form-control form-control-sm" name="guide_fee" id="guide_fee">
                                                                        <option value="">Guide Fee</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guide Surcharge Fee</label>
                                                                    <select class="form-control form-control-sm" nama="gsfee" id="gsfee">
                                                                        <option value="">Guide S Fee</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Voucher Telephone</label>
                                                                    <select class="form-control form-control-sm" nama="vt" id="vt">
                                                                        <option value="">Guide Voucher</option>
                                                                    </select>
                                                                </div>
                                                                <!-- <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Guide Transport</label>
                                                                    <input class="form-control form-control-sm" type="text" name="transport" id="transport" placeholder="Guide Transport">
                                                                </div> -->
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Price Guide Transport</label>
                                                                    <input class="form-control form-control-sm" type="text" name="g_transport" id="g_transport" placeholder="Price Guide Transport">
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
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Tips TL</label>
                                                                    <select class="form-control form-control-sm" name="tips_tl" id="tips_tl">
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
                                                                    <select class="form-control form-control-sm" name="tips_guide" id="tips_guide">
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
                                                                    <select class="form-control form-control-sm" name="tips_ass" id="tips_ass">
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
                                                                    <select class="form-control form-control-sm" name="tips_driver" id="tips_driver">
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
                                                                    <select class="form-control form-control-sm" name="tips_porter" id="tips_porter">
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
                                                                    <select class="form-control form-control-sm" name="tips_res" id="tips_res">
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
                                                                    <input class="form-control form-control-sm" type="text" list="LTN_list" name="LT_name" id="LT_name" onchange="fungsi_hotel()" placeholder="Landtour Name">
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
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">Landtour Hotel</label>
                                                                    <select class="form-control form-control-sm" name="LT_hotel" id="LT_hotel" placeholder="Landtour Hotel" onchange="price_HLT()">
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">LT Adult Twin Price</label>
                                                                    <input class="form-control form-control-sm" type="text" name="LTH_twn" id="LTH_twn" placeholder="Landtour Adult" disabled>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">LT CNB Price</label>
                                                                    <input class="form-control form-control-sm" type="text" name="LTH_cnb" id="LTH_cnb" placeholder="Landtour CNB" disabled>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">LT INFANT Price</label>
                                                                    <input class="form-control form-control-sm" type="text" name="LT_infant" id="LT_infant" placeholder="Landtour Infant">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label style="font-size: 11px;">LT Single Price</label>
                                                                    <input class="form-control form-control-sm" type="text" name="LTH_sgl" id="LTH_sgl" placeholder="Landtour Single" disabled>
                                                                </div>
                                                            </div> -->


                                                        </div>
                                                    </div>
                                                    <div class="sub2" name="sub2" id="sub2" style="padding-top: 5px; padding-bottom: 5px;"></div>
                                                    <div style="border: 2px solid black; padding: 10px;">
                                                        <div style="text-align: center; font-weight: bold;">Package Tour Price</div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label style="font-size: 14px;">Total Transport</label>
                                                                <!-- <input class="form-control form-control-sm" type="text" name="t_transport" id="t_transport" placeholder="Total Transport"> -->
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Adult</label>
                                                                <input class="form-control form-control-sm" type="text" name="TT_adult" id="TT_adult" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Child</label>
                                                                <input class="form-control form-control-sm" type="text" name="TT_child" id="TT_child" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Infant</label>
                                                                <input class="form-control form-control-sm" type="text" name="TT_infant" id="TT_infant" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2" style="padding-top: 30px;"></div>
                                                            <div class="col-md-2" style="padding-top: 30px;">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="total_TR()" style="margin-top: auto;">Total Transport</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label style="font-size: 14px;">Total Admission Ticket</label>
                                                                <!-- <input class="form-control form-control-sm" type="text" name="t_transport" id="t_transport" placeholder="Total Transport"> -->
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Adult</label>
                                                                <input class="form-control form-control-sm" type="text" name="a_admison" id="a_admison" disabled placeholder="Ticket Adult Price">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Child</label>
                                                                <input class="form-control form-control-sm" type="text" name="a_child" id="a_child" disabled placeholder="Ticket Child Price">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Infant</label>
                                                                <input class="form-control form-control-sm" type="text" name="a_infant" id="a_infant" disabled placeholder="Ticket Infant Price">
                                                            </div>
                                                            <div class="col-md-2" style="padding-top: 30px;"></div>
                                                            <div class="col-md-2" style="padding-top: 30px;">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="total_ADM()" style="margin-top: auto;">Total Admission </button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label style="font-size: 14px;">Total Hotel</label>
                                                                <!-- <input class="form-control form-control-sm" type="text" name="t_transport" id="t_transport" placeholder="Total Transport"> -->
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Adult/Twin</label>
                                                                <input class="form-control form-control-sm" type="text" name="th_twin" id="th_twin" disabled placeholder="Hrg/Org(Twin)">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Adult/Triple</label>
                                                                <input class="form-control form-control-sm" type="text" name="th_triple" id="th_triple" disabled placeholder="Hrg/Org(Tripple)">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Child/Twin</label>
                                                                <input class="form-control form-control-sm" type="text" name="th_ctwin" id="th_ctwin" disabled placeholder="Hrg/Org(Twin)">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Single</label>
                                                                <input class="form-control form-control-sm" type="text" name="th_single" id="th_single" disabled placeholder="Hrg/Org(Single)">
                                                            </div>
                                                            <div class="col-md-2" style="padding-top: 30px;">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="total_HTL()" style="margin-top: auto;">Total Hotel Price</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label style="font-size: 14px;">Total Meal</label>
                                                                <!-- <input class="form-control form-control-sm" type="text" name="t_transport" id="t_transport" placeholder="Total Transport"> -->
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Adult</label>
                                                                <input class="form-control form-control-sm" type="text" name="t_bf" id="t_bf" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Child</label>
                                                                <input class="form-control form-control-sm" type="text" name="t_ln" id="t_ln" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Infant</label>
                                                                <input class="form-control form-control-sm" type="text" name="t_dn" id="t_dn" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2" style="padding-top: 30px;"></div>
                                                            <div class="col-md-2" style="padding-top: 30px;">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="total_Meal()" style="margin-top: auto;">Total Meal Price</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label style="font-size: 14px;">Total Cost & Fee</label>
                                                                <!-- <input class="form-control form-control-sm" type="text" name="t_transport" id="t_transport" placeholder="Total Transport"> -->
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">TL</label>
                                                                <input class="form-control form-control-sm" type="text" name="total_tl" id="total_tl" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Guide</label>
                                                                <input class="form-control form-control-sm" type="text" name="total_guide" id="total_guide" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Pendeta</label>
                                                                <input class="form-control form-control-sm" type="text" name="tl_hotel" id="tl_hotel" placeholder="0">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label style="font-size: 11px;">Bonus Peserta</label>
                                                                <input class="form-control form-control-sm" type="text" name="total_bp" id="total_bp" disabled placeholder="0">
                                                            </div>
                                                            <div class="col-md-2" style="padding-top: 30px;">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="Total_TL()" style="margin-top: auto;">Total Cost Price</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="padding-top: 5px; padding-bottom: 5px;"></div>
                                                    <div style="border: 2px solid black; padding: 10px;">
                                                        <div style="text-align: center; font-weight: bold;">INCLUDE & EXCLUDE</div>
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
                                                        <div><button type="button" class="btn btn-primary btn-sm" onclick="check_include(<?php echo $n ?>)">Select</button></div>
                                                    </div>
                                                    <div style="padding-top: 5px; padding-bottom: 5px;"></div>
                                                    <div class="prev" id="prev" name="prev"></div>

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
<!-- upload gambar -->
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
<!-- perhitungan total -->
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

    function fungsi_gt() {
        document.getElementById("check_2").disabled = false;
        document.getElementById("check_1").disabled = true;
        document.getElementById("check_4").disabled = true;
        document.getElementById("check_5").disabled = true;
        document.getElementById("check_6").disabled = false;
        document.getElementById("check_7").disabled = false
        $("#pt").prop("checked", false);


    }

    function fungsi_pt() {
        document.getElementById("check_2").disabled = true;
        document.getElementById("check_1").disabled = false;
        document.getElementById("check_4").disabled = false;
        document.getElementById("check_5").disabled = false;
        document.getElementById("check_6").disabled = true;
        document.getElementById("check_7").disabled = true;
        $("#gt").prop("checked", false);
    }

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

    function fguide_fee() {
        // alert("on");
        // var day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var gb = $('#bf').val();
        var h_gb = $('#bf_list [value="' + gb + '"]').data('customvalue');

        //// guide fee
        $.post('get_fee_guide.php', {
            'brand': h_gb
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#guide_fee').append('<option value=' + counter.harga + '>' + counter.deskripsi + ' :Rp.' + counter.harga + '</option>');
                }
            } else {
                $("#guide_fee").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
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
                    $('#gsfee').append('<option value=' + counter.harga + '>' + counter.deskripsi + ' :Rp.' + counter.harga + '</option>');
                }
            } else {
                $("#gsfee").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
            // $("#g_dinner").val(obj_dn.harga);
        });
        ///////// vocer guide ///////
        $.post('get_vocer.php', {
            'brand': h_gb
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    $('#vt').append('<option value=' + counter.harga + '>' + counter.deskripsi + ' :Rp.' + counter.harga + '</option>');
                }
            } else {
                $("#vt").empty().append('<option selected="selected" value="">Tidak ada Data</option>');
            }
        });
    }

    function guide_breakfast() {
        alert("on");
        var gb = $('#bf').val();
        var h_gb = $('#bf_list [value="' + gb + '"]').data('customvalue');

        var element = document.getElementById("box_bf");
        var child = document.getElementById("guide_bf");
        var label = document.getElementById("bf_label");
        if (child != null && label != null) {
            element.removeChild(child);
            element.removeChild(label);
        }
        alert(h_gb);
        //// guide breakfast
        $.post('bf_breakfast.php', {
            'brand': h_gb,
        }, function(data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData[0].nama);
            if (jsonData[0].nama != null) {
                $('#box_bf')
                    .append('<input type="checkbox" id="guide_bf" name="guide_bf" value="' + jsonData[0].harga + '" checked>')
                    .append('<label  for="guide_bf" id="bf_label" style="font-size: 11px;">' + jsonData[0].nama + '</label></div>');
            } else {
                var element = document.getElementById("box_bf");
                var child = document.getElementById("guide_bf");
                var label = document.getElementById("bf_label");
                if (child != null && label != null) {
                    element.removeChild(child);
                    element.removeChild(label);
                }
            }
        });
    }


    function guide_lunch() {
        var gl = $('#lunch').val();
        var h_gl = $('#ln_list [value="' + gl + '"]').data('customvalue');

        var element2 = document.getElementById("box_lunch");
        var child2 = document.getElementById("guide_lunch");
        var label2 = document.getElementById("ln_label");
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
                $('#box_lunch')
                    .append('<input type="checkbox" id="guide_lunch" name="guide_lunch" value="' + jsonData[0].harga + '" checked>')
                    .append('<label  for="guide_lunch" id="ln_label" style="font-size: 11px;">' + jsonData[0].nama + '</label></div>');
            } else {
                alert('kosong');
                var element2 = document.getElementById("box_lunch");
                var child2 = document.getElementById("guide_lunch");
                var label2 = document.getElementById("ln_label");
                if (child2 != null && label2 != null) {
                    element.removeChild(child2);
                    element.removeChild(label2);
                }
            }
        });
    }

    function guide_dinner() {
        var gd = $('#dinner').val();
        var h_gd = $('#dn_list [value="' + gd + '"]').data('customvalue');

        var element3 = document.getElementById("box_dinner");
        var child3 = document.getElementById("guide_dinner");
        var label3 = document.getElementById("dn_label");
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
                $('#box_dinner')
                    .append('<input type="checkbox" id="guide_dinner" name="guide_dinner" value="' + jsonData[0].harga + '" checked>')
                    .append('<label  for="guide_dinner" id="dn_label" style="font-size: 11px;">' + jsonData[0].nama + '</label></div>');
            } else {
                var element3 = document.getElementById("box_bf");
                var child3 = document.getElementById("guide_dinner");
                var label3 = document.getElementById("dn_label");
                if (child3 != null && label3 != null) {
                    element.removeChild(child3);
                    element.removeChild(label3);
                }
            }
        });
    }
</script>
<script>
    function get_sub() {
        var a = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        $.ajax({
            url: "sub_day.php",
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
            url: "sub_trans.php",
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


    function total_Meal() {
        // alert("oooooo");
        var day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var tbf = 0;
        var tl = 0;
        var td = 0;
        var cs = 0;
        var a_gb = [];
        var a_gl = [];
        var a_gd = [];

        if (day == 1) {
            var gb = $('#bf').val();
            var gl = $("#lunch").val();
            var gd = $("#dinner").val();

            // var h_gb = $('#bf_list [value="' + gb + '"]').data('customvalue');
            // var h_gl = $('#ln_list [value="' + gl + '"]').data('customvalue');
            // var h_gd = $('#dn_list [value="' + gd + '"]').data('customvalue');

            if (cek_bf.checked) {
                var h_gb = $('#bf_list [value="' + gb + '"]').data('customvalue');
            } else {
                var h_gb = 0;
            }
            if (cek_ln.checked) {
                var h_gl = $('#ln_list [value="' + gl + '"]').data('customvalue');
            } else {
                var h_gl = 0;
            }
            if (cek_dn.checked) {
                var h_gd = $('#dn_list [value="' + gd + '"]').data('customvalue');

            } else {
                var h_gd = 0;
            }

            a_gb.push(h_gb);
            a_gl.push(h_gl);
            a_gd.push(h_gd);
        } else {
            for (let i = 1; i <= day; i++) {
                var gb = $('#' + i + 'bf').val();
                var gl = $("#" + i + "lunch").val();
                var gd = $("#" + i + "dinner").val();

                if ($('#' + i + 'cek_bf').is(":checked")) {
                    var h_gb = $('#' + i + 'bf_list [value="' + gb + '"]').data('customvalue');
                } else {
                    var h_gb = 0;
                }
                if ($('#' + i + 'cek_ln').is(":checked")) {
                    var h_gl = $('#' + i + 'ln_list [value="' + gl + '"]').data('customvalue');
                } else {
                    var h_gl = 0;
                }
                if ($('#' + i + 'cek_dn').is(":checked")) {
                    var h_gd = $('#' + i + 'dn_list [value="' + gd + '"]').data('customvalue');
                } else {
                    var h_gd = 0;
                }
                a_gb.push(h_gb);
                a_gl.push(h_gl);
                a_gd.push(h_gd);
            }
        }
        // var  plus = 0;

        const data = {
            breakfast: a_gb,
            lunch: a_gl,
            dinner: a_gd,
        }
        const mydata = JSON.stringify(data);

        //// total bld ////////////////////////////
        $.post('get_breakfast.php', {
            'data': mydata,
            'day': day,
            'total': parseInt($("#total_all").val())
        }, function(data) {
            var total = JSON.parse(data);
            $("#t_bf").val(total[0]);
            $("#t_ln").val(total[0]);
            $("#t_dn").val('0');
        });

    }

    function total_TR() {
        var day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var adult = $("#adult").val() || 0;
        var child = $("#child").val() || 0;
        var infant = $("#infant").val() || 0;
        var ferry = 0;
        var train = 0;
        var flight = 0;

        var total_trs = 0;

        var total_adt = 0;
        var total_chd = 0;
        var total_inf = 0;
        // alert(ferry);

        if (day == 1) {
            var f_adt = 0;
            var f_chd = 0;
            var f_inf = 0;

            var fl_adt = 0;
            var fl_chd = 0;
            var fl_inf = 0;

            var l_adt = 0;
            var l_chd = 0;
            var l_inf = 0;

            var t_adt = 0;
            var t_chd = 0;
            var t_inf = 0;

            var tr = document.getElementById("sel_trans").options[document.getElementById("sel_trans").selectedIndex].value;
            var i = 1;
            for (let x = 1; x <= tr; x++) {
                var pf = parseInt($('#ferry' + x).val() || 0);
                var pt = parseInt($('#train' + x).val() || 0);
                // alert(pt);
                var pilihan = $('#' + i + 'pilih_trans' + x).val();
                var i = 1;
                if (pilihan == "1") {
                    //// flight
                    fl_adt = fl_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                    fl_chd = fl_chd + parseInt($('#' + i + 'child' + x).val() || 0);
                    fl_inf = fl_inf + parseInt($('#' + i + 'infant' + x).val() || 0);

                } else if (pilihan == "2") {
                    /// ferry
                    var f_adt = f_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                    var f_chd = f_chd + parseInt($('#' + i + 'child' + x).val() || 0);
                    var f_inf = f_inf + parseInt($('#' + i + 'infant' + x).val() || 0);
                    // alert(f_adt);

                } else if (pilihan == "3") {
                    //// land
                    ac = parseInt(adult) + parseInt(child);
                    l_adt = l_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                    prc_adt = parseInt($("#" + i + "price_LN" + x).val() || 0) / ac;
                    l_adt = l_adt + prc_adt;
                    l_chd = l_chd + prc_adt
                    l_inf = l_inf + 0;

                } else if (pilihan == "4") {
                    //// train
                    var t_adt = t_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                    var t_chd = t_chd + parseInt($('#' + i + 'child' + x).val() || 0);
                    var t_inf = t_inf + parseInt($('#' + i + 'infant' + x).val() || 0);
                    // alert(t_adt);
                } else {
                    console.log('kosong');
                }

            }
            total_adt = total_adt + f_adt + t_adt + fl_adt + l_adt;
            total_chd = total_chd + f_chd + t_chd + fl_chd + l_chd;
            total_inf = total_inf + f_inf + t_inf + fl_inf + l_inf;
        } else {
            for (let i = 1; i <= day; i++) {
                var f_adt = 0;
                var f_chd = 0;
                var f_inf = 0;

                var fl_adt = 0;
                var fl_chd = 0;
                var fl_inf = 0;

                var l_adt = 0;
                var l_chd = 0;
                var l_inf = 0;

                var t_adt = 0;
                var t_chd = 0;
                var t_inf = 0;

                var tr = document.getElementById(i + "sel_trans").options[document.getElementById(i + "sel_trans").selectedIndex].value;
                for (let x = 1; x <= tr; x++) {
                    var pf = parseInt($('#' + i + 'ferry' + x).val() || 0);
                    var pt = parseInt($('#' + i + 'train' + x).val() || 0);
                    // alert(pf);
                    // alert(pt);
                    var pilihan = $('#' + i + 'pilih_trans' + x).val();
                    if (pilihan == "1") {
                        //// flight
                        fl_adt = fl_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                        fl_chd = fl_chd + parseInt($('#' + i + 'child' + x).val() || 0);
                        fl_inf = fl_inf + parseInt($('#' + i + 'infant' + x).val() || 0);

                    } else if (pilihan == "2") {
                        /// ferry
                        var f_adt = f_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                        var f_chd = f_chd + parseInt($('#' + i + 'child' + x).val() || 0);
                        var f_inf = f_inf + parseInt($('#' + i + 'infant' + x).val() || 0);
                        // alert(f_adt);

                    } else if (pilihan == "3") {
                        //// land
                        ac = parseInt(adult) + parseInt(child);
                        l_adt = l_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                        prc_adt = parseInt($("#" + i + "price_LN" + x).val() || 0) / ac;
                        l_adt = l_adt + prc_adt;
                        l_chd = l_chd + prc_adt
                        l_inf = l_inf + 0;

                    } else if (pilihan == "4") {
                        //// train
                        var t_adt = t_adt + parseInt($('#' + i + 'adult' + x).val() || 0);
                        var t_chd = t_chd + parseInt($('#' + i + 'child' + x).val() || 0);
                        var t_inf = t_inf + parseInt($('#' + i + 'infant' + x).val() || 0);
                        // alert(t_adt);
                    } else {
                        console.log('kosong');
                    }

                }
                total_adt = total_adt + f_adt + t_adt + fl_adt + l_adt;
                total_chd = total_chd + f_chd + t_chd + fl_chd + l_chd;
                total_inf = total_inf + f_inf + t_inf + fl_inf + l_inf;
                // alert(f_adt);

            }
        }

        // alert(ferry);
        // alert(train);

        // total_trs = ferry + train;
        // alert(total_trs);
        $("#TT_adult").val(Math.ceil(total_adt));
        $("#TT_child").val(Math.ceil(total_chd));
        $("#TT_infant").val(Math.ceil(total_inf));
        // alert(a);
        // alert(b);
    }

    function total_ADM() {
        // alert("adm bisa dong");
        var day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var adult = $("#adult").val();
        var child = $("#child").val();
        var infant = $("#infant").val();
        var adm_tt = 0;
        if (day == 1) {
            var i = 1;
            var tr = document.getElementById("sel_trans").options[document.getElementById("sel_trans").selectedIndex].value;
            if (tr == '1') {
                var pilihan2 = document.getElementById(i + "pilih").options[document.getElementById(i + "pilih").selectedIndex].value;
                var ui = 1;
                if (pilihan2 == '2') {
                    //  alert("okhee");
                    adm_tt = adm_tt + parseInt($("#" + i + "price_adm" + ui).val() || 0);
                    // alert(adm_tt);
                } else {
                    console.log('kosong');
                }
            } else {
                for (let x = 1; x <= tr; x++) {
                    var pilihan2 = document.getElementById(i + "pilih" + x).options[document.getElementById(i + "pilih" + x).selectedIndex].value;
                    //alert("ada");
                    if (pilihan2 == '2') {
                        //  alert("okhee");
                        adm_tt = adm_tt + parseInt($("#" + i + "price_adm" + x).val() || 0);
                        // alert(adm_tt);
                    } else {
                        console.log('kosong');
                    }
                }
            }
        } else {
            for (let i = 1; i <= day; i++) {
                var tr = document.getElementById(i + "sel_trans").options[document.getElementById(i + "sel_trans").selectedIndex].value;
                if (tr == '1') {
                    var pilihan2 = document.getElementById(i + "pilih").options[document.getElementById(i + "pilih").selectedIndex].value;
                    var ui = 1;
                    //alert("ada");
                    if (pilihan2 == '2') {
                        //  alert("okhee");
                        adm_tt = adm_tt + parseInt($("#" + i + "price_adm" + ui).val() || 0);
                        // alert(adm_tt);
                    } else {
                        console.log('kosong');
                    }
                } else {
                    // alert(tr);
                    for (let x = 1; x <= tr; x++) {
                        var pilihan2 = document.getElementById(i + "pilih" + x).options[document.getElementById(i + "pilih" + x).selectedIndex].value;
                        //alert("ada");
                        if (pilihan2 == '2') {
                            //  alert("okhee");
                            adm_tt = adm_tt + parseInt($("#" + i + "price_adm" + x).val() || 0);
                            // alert(adm_tt);
                        } else {
                            console.log('kosong');
                        }
                    }
                }
            }
        }

        $("#a_admison").val(adm_tt);
        $("#a_child").val(adm_tt);
        $("#a_infant").val(0);

    }


    function Total_TL() {


        // alert("TL bisa dong");
        ////// tl ////////////////
        var day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var adult = $("#adult").val();
        var child = $("#child").val();
        var infant = $("#infant").val();
        var peserta = parseInt($("#adult").val() || 0) + parseInt($("#child").val() || 0);

        var val_fee = 0;
        var val_sfee = 0;
        var val_vocer = 0;
        var val_meal = 0;

        var a_fee = [];
        var a_sfee = [];
        var a_vocer = [];
        var a_meal = [];
        var a_h = [];
        var a_t = [];
        var val_guide = 0;
        if (day == 1) {
            var tl_fee = $('#tl_fee').val();
            var h_fee = $('#tlfee_list' + ' [value="' + tl_fee + '"]').data('customvalue');
            // alert(h_fee);
            var tl_sfee = $('#tl_sfee').val();
            var h_sfee = $('#tlsfee_list' + ' [value="' + tl_sfee + '"]').data('customvalue');

            var tl_v = $('#tl_v').val();
            var h_v = $('#tlv_list' + ' [value="' + tl_v + '"]').data('customvalue');

            var tl_m = $('#tl_m').val();
            var h_m = $('#tlm_list' + ' [value="' + tl_m + '"]').data('customvalue');

            var tl_m = $('#tl_m').val();
            var h_m = $('#tlm_list' + ' [value="' + tl_m + '"]').data('customvalue');

            var h_h = parseInt($('#' + i + 'tl_h').val() || 0);
            var h_t = parseInt($('#' + i + 'tl_t').val() || 0);

            a_fee.push(h_fee);
            a_sfee.push(h_sfee);
            a_vocer.push(h_v);
            a_meal.push(h_m);
            a_h.push(h_h);
            a_t.push(h_t);
            /// gantii
            // var g_bf = parseInt($("#" + i + "g_bf").val() || 0);
            // var g_lnc = parseInt($("#" + i + "g_lunch").val() || 0);
            // var g_dnnr = parseInt($("#" + i + "g_dinner").val() || 0);
            if (guide_bf.checked) {
                var g_bf = parseInt($("#guide_bf:checked").val());
            } else {
                var g_bf = 0;
            }
            if (guide_lunch.checked) {
                var g_lnc = parseInt($("#guide_lunch:checked").val());
            } else {
                var g_lnc = 0;
            }
            if (guide_dinner.checked) {
                var g_dnnr = parseInt($("#guide_dinner:checked").val());
            } else {
                var g_dnnr = 0;
            }


            // if ($('#' + i + 'guide_bf').is(":checked")) {
            //     var g_bf = parseInt($("#guide_bf:checked").val());
            // } else {
            //     var g_bf = 0;
            // }
            // if ($('#' + i + 'guide_lunch').is(":checked")) {
            //     var g_lnc = parseInt($("#guide_lunch:checked").val());
            // } else {
            //     var g_lnc  = 0;
            // }
            // if ($('#' + i + 'guide_dinner').is(":checked")) {
            //     var g_dnnr = parseInt($("#guide_dinner:checked").val());
            // } else {
            //     var g_dnnr = 0;
            // }


            /// ganti
            var meal = g_bf + g_lnc + g_dnnr;
            //  alert(meal);
            var vocer = parseInt($("#vt").val() || 0);
            var g_fee = parseInt($("#guide_fee").val() || 0);
            var gs_fee = parseInt($("#gsfee").val() || 0);
            var g_transport = parseInt($("#g_transport").val() || 0);
            var g_hotel = parseInt($("#g_hotel").val() || 0);


            var total_gui = (meal + vocer + g_fee + gs_fee + g_transport + g_hotel) / peserta;
            val_guide = val_guide + total_gui;
        } else {
            for (let i = 1; i <= day; i++) {
                var tl_fee = $('#' + i + 'tl_fee').val();
                var h_fee = $('#' + i + 'tlfee_list' + ' [value="' + tl_fee + '"]').data('customvalue');
                // alert(h_fee);
                var tl_sfee = $('#' + i + 'tl_sfee').val();
                var h_sfee = $('#' + i + 'tlsfee_list' + ' [value="' + tl_sfee + '"]').data('customvalue');

                var tl_v = $('#' + i + 'tl_v').val();
                var h_v = $('#' + i + 'tlv_list' + ' [value="' + tl_v + '"]').data('customvalue');

                var tl_m = $('#' + i + 'tl_m').val();
                var h_m = $('#' + i + 'tlm_list' + ' [value="' + tl_m + '"]').data('customvalue');

                var tl_m = $('#' + i + 'tl_m').val();
                var h_m = $('#' + i + 'tlm_list' + ' [value="' + tl_m + '"]').data('customvalue');

                var h_h = parseInt($('#' + i + 'tl_h').val() || 0);
                var h_t = parseInt($('#' + i + 'tl_t').val() || 0);

                a_fee.push(h_fee);
                a_sfee.push(h_sfee);
                a_vocer.push(h_v);
                a_meal.push(h_m);
                a_h.push(h_h);
                a_t.push(h_t);
                /// gantii
                // var g_bf = parseInt($("#" + i + "g_bf").val() || 0);
                // var g_lnc = parseInt($("#" + i + "g_lunch").val() || 0);
                // var g_dnnr = parseInt($("#" + i + "g_dinner").val() || 0);
                // if (guide_bf.checked) {
                //     var g_bf = parseInt($("#guide_bf:checked").val());
                // } else {
                //     var g_bf = 0;
                // }
                // if (guide_lunch.checked) {
                //     var g_lnc = parseInt($("#guide_lunch:checked").val());
                // } else {
                //     var g_lnc = 0;
                // }
                // if (guide_dinner.checked) {
                //     var g_dnnr = parseInt($("#guide_dinner:checked").val());
                // } else {
                //     var g_dnnr = 0;
                // }

                if ($('#' + i + 'guide_bf').is(":checked")) {
                    var g_bf = parseInt($("#" + i + "guide_bf:checked").val());
                } else {
                    var g_bf = 0;
                }
                if ($('#' + i + 'guide_lunch').is(":checked")) {
                    var g_lnc = parseInt($("#" + i + "guide_lunch:checked").val());
                } else {
                    var g_lnc = 0;
                }
                if ($('#' + i + 'guide_dinner').is(":checked")) {
                    var g_dnnr = parseInt($("#" + i + "guide_dinner:checked").val());
                } else {
                    var g_dnnr = 0;
                }



                /// ganti
                var meal = g_bf + g_lnc + g_dnnr;
                // alert(meal);
                // alert("asasasa");
                var vocer = parseInt($("#" + i + "vt").val() || 0);
                var g_fee = parseInt($("#" + i + "guide_fee").val() || 0);
                var gs_fee = parseInt($("#" + i + "gsfee").val() || 0);
                var g_transport = parseInt($("#" + i + "g_transport").val() || 0);
                var g_hotel = parseInt($("#" + i + "g_hotel").val() || 0);
                // alert(meal);
                // alert(vocer);
                // alert(g_fee);
                // alert(gs_fee);
                // alert(g_transport);
                // alert(g_hotel);
                // alert(peserta);

                var total_gui = (meal + vocer + g_fee + gs_fee + g_transport + g_hotel) / peserta;
                val_guide = val_guide + total_gui;
            }
        }
        const data = {
            fee: a_fee,
            sfee: a_sfee,
            meal: a_meal,
            vocer: a_vocer,
            hotel: a_h,
            transport: a_t
        }
        const mydata = JSON.stringify(data);
        // alert(mydata);
        $.post('get_tlfee.php', {
            'data': mydata,
            'day': day,
            'peserta': peserta
        }, function(data) {
            var hasil = JSON.parse(data);
            console.log(hasil[0]);

            $("#total_tl").val(Math.ceil(hasil[0].tl));
            $("#total_bp").val(Math.ceil(hasil[0].bp));
        });

        $("#total_guide").val(Math.ceil(val_guide));

    }

    function total_HTL() {
        // alert("hotel on");
        var adult = $("#adult").val();
        var child = $("#child").val();
        var day = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        var h_twin = 0;
        var h_triple = 0;
        var h_family = 0;
        var h_single = 0;

        if (day == 1) {
            h_twin = h_twin + (parseInt($("#hotel_twin").val() || 0) / 2);
            h_triple = h_triple + (parseInt($("#hotel_single").val() || 0) / 3);
            h_family = h_family + (parseInt($("#hotel_family").val() || 0) / 3);
            h_single = h_single + parseInt($("#hotel_twin").val() || 0);
        } else {
            for (let i = 1; i <= day; i++) {
                h_twin = h_twin + (parseInt($("#" + i + "hotel_twin").val() || 0) / 2);
                h_triple = h_triple + (parseInt($("#" + i + "hotel_single").val() || 0) / 3);
                h_family = h_family + (parseInt($("#" + i + "hotel_family").val() || 0) / 3);
                h_single = h_single + parseInt($("#" + i + "hotel_twin").val() || 0);

            }
        }



        $("#th_twin").val(h_twin);
        $("#th_triple").val(h_triple);
        $("#th_ctwin").val(h_twin);
        $("#th_single").val(h_single);
    }

    // function insert_itinxx() {
    //     alert("itin xxx");
    //     var fileSelect = document.getElementById('files');
    //     var files = fileSelect.files;
    //     var total_file = document.getElementById("files").files.length;

    //     var data = {};
    //     var arr_gmb = [];
    //     // console.log(fileSelect);
    //     for (var i = 0; i < total_file; i++) {
    //         gmb = {};
    //         gmb['filename'] = files[i].name;
    //         gmb['filesize'] = files[i].size;
    //         gmb['filetype'] = files[i].type;
    //         // gmb['obj'] = files[i];
    //         arr_gmb.push(gmb);


    //         let formData = new FormData();
    //         formData.append('fileupload', files[i]);
    //         $.ajax({
    //             type: 'POST',
    //             url: "upload_img.php",
    //             data: formData,
    //             cache: false,
    //             processData: false,
    //             contentType: false,
    //             success: function(msg) {
    //                 alert(msg);
    //             },
    //             error: function() {
    //                 alert("Data Gagal Diupload");
    //             }
    //         });


    //     }
    //     console.log(arr_gmb);
    //     data['gambar'] = arr_gmb;
    //     $.ajax({
    //         type: "POST",
    //         url: "Insert_itenerary.php",
    //         data: {
    //             data: data
    //         },
    //         dataType: "JSON",
    //         success: function(msg) {
    //             alert(msg);
    //             Reloaditin(1, 0, 0);
    //         },
    //         error: function() {
    //             alert("Data Gagal Diupload");
    //         }
    //     });

    // }

    function check_include(x) {
        var data = {};
        var a = [];
        for (var i = 1; i <= x; i++) {
            var chck = {};
            if ($('#check_' + i).is(":checked")) {

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
                            sel_trans['tujuan'] = $("input[name=" + d + "tujuan" + dl + "]").val();
                            sel_trans['price'] = $("input[name=" + d + "price_adm" + dl + "]").val();
                        }
                        /////// transport //////
                        else {
                            var trans_type = document.getElementById(d + "pilih_trans" + dl).options[document.getElementById(d + "pilih_trans" + dl).selectedIndex].value;
                            //// flight //////
                            if (trans_type == 1) {
                                sel_trans['transport_type'] = "flight";
                                sel_trans['transport_name'] = $('#' + d + 'flight_val' + dl).val();
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
                                sel_trans['transport_name'] = $('#' + d + 'transport' + dl).val();
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
                                    sel_trans['transport_name'] = $('#' + d + 'flight_val' + xt).val();
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
                                    sel_trans['transport_name'] = $('#' + d + 'transport' + xt).val();
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
                    var bf = $('#bf').val();
                    var ln = $('#lunch').val();
                    var dn = $('#dinner').val();
                    // sel_trans['tujuan'] = $('#bf_list [value="' + bf + '"]').data('customvalue');

                    day['guest_breakfast'] = $('#bf_list [value="' + bf + '"]').data('customvalue');
                    day['guest_lunch'] = $('#ln_list [value="' + ln + '"]').data('customvalue');
                    day['guest_dinner'] = $('#dn_list [value="' + dn + '"]').data('customvalue');

                    day['guest_hotel_name'] = $("input[name=guest_hotel]").val();
                    day['gst_hotel_twin'] = $("input[name=hotel_twin]").val();
                    day['gst_hotel_triple'] = $("input[name=hotel_single]").val();
                    day['gst_hotel_family'] = $("input[name=hotel_family]").val();
                    day['gui_breakfast'] = $("#guide_bf").val();
                    day['gui_lunch'] = $("#guide_lunch").val();
                    day['gui_dinner'] = $("#guide_dinner").val();
                    day['gui_hotel'] = $("#g_hotel").val();
                    day['gui_fee'] = $("#guide_fee").val();
                    day['gui_sfee'] = $("#gsfee").val();
                    day['gui_vt'] = $("#vt").val();
                    day['gui_transport'] = $("#g_transport").val();
                    day['tl_fee'] = $("#tl_fee").val();
                    day['tl_sfee'] = $("#tl_sfee").val();
                    day['tl_vt'] = $("#tl_v").val();
                    day['tl_meal'] = $("#tl_m").val();
                    day['tl_hotel'] = $("#tl_h").val();
                    day['tl_transport'] = $("#tl_t").val();

                    day['tips_tl'] = $("#tips_tl").val();
                    day['tips_guide'] = $("#tips_guide").val();
                    day['tips_ass'] = $("#tips_ass").val();
                    day['tips_driver'] = $("#tips_driver").val();
                    day['tips_porter'] = $("#tips_porter").val();
                    day['tips_res'] = $("#tips_res").val();

                    // day['landtour_name'] = $("#LT_name").val();
                    // day['landtour_hotel'] = $("#LT_hotel").val();
                    // day['lt_hotel_twin'] = $("#LTH_twn").val();
                    // day['lt_hotel_cnb'] = $("#LTH_cnb").val();
                    // day['lt_hotel_infant'] = $("#LTH_infant").val();
                    // day['lt_hotel_single'] = $("#LTH_sgl").val();

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
                                sel_trans['tujuan'] = $("input[name=" + i + "tujuan" + dl + "]").val();
                                sel_trans['price'] = $("input[name=" + i + "price_adm" + dl + "]").val();
                            }
                            /////// transport //////
                            else {
                                var trans_type = document.getElementById(i + "pilih_trans" + dl).options[document.getElementById(i + "pilih_trans" + dl).selectedIndex].value;
                                //// flight //////
                                if (trans_type == 1) {
                                    sel_trans['transport_type'] = "flight";
                                    sel_trans['transport_name'] = $('#' + i + 'flight_val' + dl).val();
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
                                    sel_trans['transport_name'] = $('#' + i + 'transport' + dl).val();
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
                                        sel_trans['transport_name'] = $('#' + i + 'flight_val' + xt).val();
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
                                        sel_trans['transport_name'] = $('#' + i + 'transport' + xt).val();
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
                        day['guest_breakfast'] = $("input[name=" + i + "bf]").val();
                        day['guest_lunch'] = $("input[name=" + i + "lunch]").val();
                        day['guest_dinner'] = $("input[name=" + i + "dinner]").val();
                        day['guest_hotel_name'] = $("input[name=" + i + "guest_hotel]").val();
                        day['gst_hotel_twin'] = $("input[name=" + i + "hotel_twin]").val();
                        day['gst_hotel_triple'] = $("input[name=" + i + "hotel_single]").val();
                        day['gst_hotel_family'] = $("input[name=" + i + "hotel_family]").val();
                        day['gui_breakfast'] = $("#" + i + "guide_bf").val();
                        day['gui_lunch'] = $("#" + i + "guide_lunch").val();
                        day['gui_dinner'] = $("#" + i + "guide_dinner").val();
                        day['gui_hotel'] = $("#" + i + "g_hotel").val();
                        day['gui_fee'] = $("#" + i + "guide_fee").val();
                        day['gui_sfee'] = $("#" + i + "gsfee").val();
                        day['gui_vt'] = $("#" + i + "vt").val();
                        day['gui_transport'] = $("#" + i + "g_transport").val();
                        day['tl_fee'] = $("#" + i + "tl_fee").val();
                        day['tl_sfee'] = $("#" + i + "tl_sfee").val();
                        day['tl_vt'] = $("#" + i + "tl_v").val();
                        day['tl_meal'] = $("#" + i + "tl_m").val();
                        day['tl_hotel'] = $("#" + i + "tl_h").val();
                        day['tl_transport'] = $("#" + i + "tl_t").val();

                        day['tips_tl'] = $("#" + i + "tips_tl").val();
                        day['tips_guide'] = $("#" + i + "tips_guide").val();
                        day['tips_ass'] = $("#" + i + "tips_ass").val();
                        day['tips_driver'] = $("#" + i + "tips_driver").val();
                        day['tips_porter'] = $("#" + i + "tips_porter").val();
                        day['tips_res'] = $("#" + i + "tips_res").val();
                        // day['landtour_name'] = $("#" + i + "LT_name").val();
                        // day['landtour_hotel'] = $("#" + i + "LT_hotel").val();
                        // day['lt_hotel_twin'] = $("#" + i + "LTH_twn").val();
                        // day['lt_hotel_cnb'] = $("#" + i + "LTH_cnb").val();
                        // day['lt_hotel_infant'] = $("#" + i + "LTH_infant").val();
                        // day['lt_hotel_single'] = $("#" + i + "LTH_sgl").val();
                        array_day.push(day);

                        // end push day
                    }

                }
                chck['day'] = array_day;
                chck['nama'] = $("#check_" + i).val();
                chck['transport'] = "";
                chck['price_tr'] = "";
                chck['tl'] = "";
                chck['guide'] = "";
                chck['driver'] = "";
                chck['landtour'] = document.getElementById("sel_htl").options[document.getElementById("sel_htl").selectedIndex].value;
                chck['adt'] = "";
                chck['chd'] = "";
                chck['inf'] = "";

                // var ck = $("#check_" + i).val();
                a.push(chck);
            }
            data['checkbox'] = a;
            data['total_pax'] = $("input[name=total_pax]").val();
            data['total_bonus_peserta'] = $("input[name=tb_peserta]").val();
            data['total_all'] = $("input[name=total_all]").val();
            data['adult'] = $("input[name=adult]").val();
            data['child'] = $("input[name=child]").val();
            data['infant'] = $("input[name=infant]").val();
            data['landtour'] = $("#LT_name").val();

            data['tcf_tl'] = $("#total_tl").val();
            data['tcf_guide'] = $("#total_guide").val();
            data['tcf_pendeta'] = $("#tl_hotel").val();
            data['tcf_bonus'] = $("#total_bp").val();

        }
        // console.log(data['landtour']);
        console.log(data);
        $.ajax({
            url: "sub_preview.php",
            method: "POST",
            asynch: false,
            data: {
                data: data,
            },
            success: function(data) {
                $('#prev').html(data);
                document.getElementById('prev').style.display = 'block';
            }
        });

    }


    function insert_itin() {

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
        var datalist = [];
        var data = {};
        data['gambar'] = arr_gmb;
        data['nama'] = $("input[name=j_tour]").val();
        data['adult'] = $("input[name=adult]").val();
        data['child'] = $("input[name=child]").val();
        data['infant'] = $("input[name=infant]").val();
        data['total_pax'] = $("input[name=total_pax]").val();
        data['total_bonus_peserta'] = $("input[name=tb_peserta]").val();
        data['total_all'] = $("input[name=total_all]").val();
        data['tl'] = $("input[name=tour_leader]").val();
        data['guide'] = $("input[name=guide]").val();
        data['driver'] = $("input[name=driver]").val();
        data['pendeta'] = $("input[name=pendeta]").val();
        data['judul'] = $("input[name=j_tour]").val();
        data['landtour'] = document.getElementById("sel_htl").options[document.getElementById("sel_htl").selectedIndex].value;
        data['jml_day'] = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        data['chck_v'] = $("input[chck_v]").val();
        if ($('#gt').is(":checked")) {
           data['tipe'] = "groub";
        } else {
            data['tipe'] = "private";
        }
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
                    sel_trans['tujuan'] = $("input[name=" + d + "tujuan" + dl + "]").val();
                    sel_trans['price'] = $("input[name=" + d + "price_adm" + dl + "]").val();
                }
                /////// transport //////
                else {
                    var trans_type = document.getElementById(d + "pilih_trans" + dl).options[document.getElementById(d + "pilih_trans" + dl).selectedIndex].value;
                    //// flight //////
                    if (trans_type == 1) {
                        sel_trans['transport_type'] = "flight";
                        sel_trans['transport_name'] = $('#' + d + 'flight_val' + dl).val();
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
                        sel_trans['transport_name'] = $('#' + d + 'transport' + dl).val();
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
                            sel_trans['transport_name'] = $('#' + d + 'flight_val' + xt).val();
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
                            sel_trans['transport_name'] = $('#' + d + 'transport' + xt).val();
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
            day['guest_breakfast'] = $("input[name=bf]").val();
            day['guest_lunch'] = $("input[name=lunch]").val();
            day['guest_dinner'] = $("input[name=dinner]").val();
            day['guest_hotel_name'] = $("input[name=guest_hotel]").val();
            day['gst_hotel_twin'] = $("input[name=hotel_twin]").val();
            day['gst_hotel_triple'] = $("input[name=hotel_single]").val();
            day['gst_hotel_family'] = $("input[name=hotel_family]").val();
            day['gui_breakfast'] = $("#guide_bf").val();
            day['gui_lunch'] = $("#guide_lunch").val();
            day['gui_dinner'] = $("#guide_dinner").val();
            day['gui_hotel'] = $("#g_hotel").val();
            day['gui_fee'] = $("#guide_fee").val();
            day['gui_sfee'] = $("#gsfee").val();
            day['gui_vt'] = $("#vt").val();
            day['gui_transport'] = $("#g_transport").val();
            day['tl_fee'] = $("#tl_fee").val();
            day['tl_sfee'] = $("#tl_sfee").val();
            day['tl_vt'] = $("#tl_v").val();
            day['tl_meal'] = $("#tl_m").val();
            day['tl_hotel'] = $("#tl_h").val();
            day['tl_transport'] = $("#tl_t").val();

            day['tips_tl'] = $("#tips_tl").val();
            day['tips_guide'] = $("#tips_guide").val();
            day['tips_ass'] = $("#tips_ass").val();
            day['tips_driver'] = $("#tips_driver").val();
            day['tips_porter'] = $("#tips_porter").val();
            day['tips_res'] = $("#tips_res").val();
            // day['landtour_name'] = $("#LT_name").val();
            // day['landtour_hotel'] = $("#LT_hotel").val();
            // day['lt_hotel_twin'] = $("#LTH_twn").val();
            // day['lt_hotel_cnb'] = $("#LTH_cnb").val();
            // day['lt_hotel_infant'] = $("#LTH_infant").val();
            // day['lt_hotel_single'] = $("#LTH_sgl").val();

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
                        sel_trans['tujuan'] = $("input[name=" + i + "tujuan" + dl + "]").val();
                        sel_trans['price'] = $("input[name=" + i + "price_adm" + dl + "]").val();
                    }
                    /////// transport //////
                    else {
                        var trans_type = document.getElementById(i + "pilih_trans" + dl).options[document.getElementById(i + "pilih_trans" + dl).selectedIndex].value;
                        //// flight //////
                        if (trans_type == 1) {
                            sel_trans['transport_type'] = "flight";
                            sel_trans['transport_name'] = $('#' + i + 'flight_val' + dl).val();
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
                            sel_trans['transport_name'] = $('#' + i + 'transport' + dl).val();
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
                                sel_trans['transport_name'] = $('#' + i + 'flight_val' + xt).val();
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
                                sel_trans['transport_name'] = $('#' + i + 'transport' + xt).val();
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
                day['guest_breakfast'] = $("input[name=" + i + "bf]").val();
                day['guest_lunch'] = $("input[name=" + i + "lunch]").val();
                day['guest_dinner'] = $("input[name=" + i + "dinner]").val();
                day['guest_hotel_name'] = $("input[name=" + i + "guest_hotel]").val();
                day['gst_hotel_twin'] = $("input[name=" + i + "hotel_twin]").val();
                day['gst_hotel_triple'] = $("input[name=" + i + "hotel_single]").val();
                day['gst_hotel_family'] = $("input[name=" + i + "hotel_family]").val();
                day['gui_breakfast'] = $("#" + i + "guide_bf").val();
                day['gui_lunch'] = $("#" + i + "guide_lunch").val();
                day['gui_dinner'] = $("#" + i + "guide_dinner").val();
                day['gui_hotel'] = $("#" + i + "g_hotel").val();
                day['gui_fee'] = $("#" + i + "guide_fee").val();
                day['gui_sfee'] = $("#" + i + "gsfee").val();
                day['gui_vt'] = $("#" + i + "vt").val();
                day['gui_transport'] = $("#" + i + "g_transport").val();
                day['tl_fee'] = $("#" + i + "tl_fee").val();
                day['tl_sfee'] = $("#" + i + "tl_sfee").val();
                day['tl_vt'] = $("#" + i + "tl_v").val();
                day['tl_meal'] = $("#" + i + "tl_m").val();
                day['tl_hotel'] = $("#" + i + "tl_h").val();
                day['tl_transport'] = $("#" + i + "tl_t").val();

                day['tips_tl'] = $("#" + i + "tips_tl").val();
                day['tips_guide'] = $("#" + i + "tips_guide").val();
                day['tips_ass'] = $("#" + i + "tips_ass").val();
                day['tips_driver'] = $("#" + i + "tips_driver").val();
                day['tips_porter'] = $("#" + i + "tips_porter").val();
                day['tips_res'] = $("#" + i + "tips_res").val();
                // day['landtour_name'] = $("#" + i + "LT_name").val();
                // day['landtour_hotel'] = $("#" + i + "LT_hotel").val();
                // day['lt_hotel_twin'] = $("#" + i + "LTH_twn").val();
                // day['lt_hotel_cnb'] = $("#" + i + "LTH_cnb").val();
                // day['lt_hotel_infant'] = $("#" + i + "LTH_infant").val();
                // day['lt_hotel_single'] = $("#" + i + "LTH_sgl").val();
                array_day.push(day);

                // end push day
            }

        }
        data['day'] = array_day;
        data['tt_adult'] = $("#TT_adult").val();
        data['tt_child'] = $("#TT_adult").val();
        data['tt_infant'] = $("#TT_adult").val();

        data['ta_adult'] = $("#a_admison").val();
        data['ta_child'] = $("#a_child").val();
        data['ta_infant'] = $("#a_infant").val();

        data['th_twin'] = $("#th_twin").val();
        data['th_triple'] = $("#th_triple").val();
        data['th_twin_child'] = $("#th_ctwin").val();
        data['th_single'] = $("th_single").val();

        data['tm_adult'] = $("#t_bf").val();
        data['tm_child'] = $("#t_ln").val();
        data['tm_infant'] = $("#t_dn").val();

        data['tcf_tl'] = $("#total_tl").val();
        data['tcf_guide'] = $("#total_guide").val();
        data['tcf_pendeta'] = $("#tl_hotel").val();
        data['tcf_bonus'] = $("#total_bp").val();

        var arr_in = [];
        var arr_ex = [];
        var total_chck = $("#total_chck").val();
        for (i = 1; i <= total_chck; i++) {
            var value = $("#check_" + i).val();
            if ($('#check_' + i).is(":checked")) {
                arr_in.push(value);
            } else {
                arr_ex.push(value);
            }
        }

        data['include'] = arr_in;
        data['exclude'] = arr_ex;


        $.ajax({
            type: "POST",
            url: "Insert_itenerary.php",
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

    }
</script>