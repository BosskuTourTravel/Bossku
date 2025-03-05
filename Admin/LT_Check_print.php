<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
include "Api_LT_total.php";

$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$querySH = "SELECT * FROM  LT_select_PilihHTL WHERE copy_id='" . $_POST['id'] . "' && master_id=" . $row_sub['master_id'];
$rsSH = mysqli_query($con, $querySH);
$rowSH = mysqli_fetch_array($rsSH);

$queryH_id = "SELECT * FROM LT_itinnew WHERE id=" . $rowSH['hotel_id'];
$rsH_id = mysqli_query($con, $queryH_id);
$rowH_id = mysqli_fetch_array($rsH_id);

$show_button = 0;
if ($row_sub['landtour'] != "undefined") {
    $query_itin = "SELECT city_in, city_out FROM LT_itinnew where kode ='" . $row_sub['landtour'] . "' order by id ASC limit 1";
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_array($rs_itin);
    $in = $row_itin['city_in'];
    $out = $row_itin['city_out'];

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
                    <h3 class="card-title" style="font-weight:bold;">COSTUM PRINT BARU</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="LT_itinerary(33,<?php echo $_POST['id'] ?>,<?php echo $_POST['master'] ?>)"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="container" style="max-width:95%; padding: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <div style="text-align: center;">PRICE ITIN PREVIEW</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="include">
                                            <form action="preview_custom_baru.php?id=<?php echo $_POST['id'] ?>" method="post" target="_blank">
                                                <div id="accordion5">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">Hotel</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne5" class="collapse" aria-labelledby="headingOne" data-parent="#accordion4">
                                                            <div class="card-body">
                                                                <?php
                                                                if ($row_sub['landtour'] != "undefined") {
                                                                ?>
                                                                    <div style="text-align: center; padding-bottom: 10px;"><?php echo $row_sub['landtour'] ?></div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label style="font-size: 11px;">Jumlah Pax</label>
                                                                                <!-- <select class="form-control form-control-sm" nama="sel_pax" id="sel_pax" onchange="fungsi_lthotel()"> -->
                                                                                <select class="form-control form-control-sm" nama="sel_pax" id="sel_pax" onchange="fungsi_hotel_day()">
                                                                                    <option value="">Pilih Pax / reset</option>
                                                                                    <?php
                                                                                    $query_LTNx = "SELECT* FROM LT_itinnew where kode='" . $row_sub['landtour'] . "'";
                                                                                    $rs_LTNx = mysqli_query($con, $query_LTNx);
                                                                                    while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
                                                                                        $ket = "";
                                                                                        if ($row_ltn['ket'] != "") {
                                                                                            $ket = " || " . $row_ltn['ket'];
                                                                                        }
                                                                                        $hotel = $row_ltn['hotel1'] . $ket;
                                                                                        if ($rowH_id['id'] != $row_ltn['id']) {
                                                                                    ?>
                                                                                            <option value="<?php echo $row_ltn['id'] ?>">
                                                                                                <?php
                                                                                                $pax_u = "";
                                                                                                $pax_b = "";
                                                                                                if ($row_ltn['pax_u'] != 0) {
                                                                                                    $pax_u = "-" . $row_ltn['pax_u'];
                                                                                                }
                                                                                                if ($row_ltn['pax_b'] != 0) {
                                                                                                    $pax_b = "+" . $row_ltn['pax_b'];
                                                                                                }
                                                                                                $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_ltn['agent_twn'] . "' && price2 >='" . $row_ltn['agent_twn'] . "'";
                                                                                                $rs_profit = mysqli_query($con, $sql_profit);
                                                                                                $row_profit = mysqli_fetch_array($rs_profit);
                                                                                                // var_dump($sql_profit);

                                                                                                $pr = 0;
                                                                                                if ($row_profit['id'] != "") {
                                                                                                    $pr = $row_profit['profit'];
                                                                                                } else {
                                                                                                    $pr = 5;
                                                                                                }

                                                                                                $nom = $row_profit['nominal'];

                                                                                                $atwn =  ($row_ltn['agent_twn'] * $pr / 100) + $row_ltn['agent_twn'] + $nom;

                                                                                                echo $row_ltn['pax'] . $pax_u . $pax_b . " pax (" . number_format($atwn, 0, ",", ".") . ") || " . $hotel;
                                                                                                ?>
                                                                                            </option>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <option value="<?php echo $row_ltn['id'] ?>" selected>
                                                                                                <?php
                                                                                                $pax_u = "";
                                                                                                $pax_b = "";
                                                                                                if ($row_ltn['pax_u'] != 0) {
                                                                                                    $pax_u = "-" . $row_ltn['pax_u'];
                                                                                                }
                                                                                                if ($row_ltn['pax_b'] != 0) {
                                                                                                    $pax_b = "+" . $row_ltn['pax_b'];
                                                                                                }
                                                                                                $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_ltn['agent_twn'] . "' && price2 >='" . $row_ltn['agent_twn'] . "'";
                                                                                                $rs_profit = mysqli_query($con, $sql_profit);
                                                                                                $row_profit = mysqli_fetch_array($rs_profit);
                                                                                                // var_dump($sql_profit);

                                                                                                $pr = 0;
                                                                                                if ($row_profit['id'] != "") {
                                                                                                    $pr = $row_profit['profit'];
                                                                                                } else {
                                                                                                    $pr = 5;
                                                                                                }

                                                                                                $nom = $row_profit['nominal'];

                                                                                                $atwn =  ($row_ltn['agent_twn'] * $pr / 100) + $row_ltn['agent_twn'] + $nom;

                                                                                                echo $row_ltn['pax'] . $pax_u . $pax_b . " pax (" . number_format($atwn, 0, ",", ".") . ") || " . $hotel;
                                                                                                ?>
                                                                                            </option>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $queryLTH = "SELECT * FROM  LT_add_pilihHotel WHERE hotel='1' && tour_id=" . $row_sub['master_id'];
                                                                    $rsLTH = mysqli_query($con, $queryLTH);
                                                                    $z = 1;
                                                                    $ip = 0;
                                                                    while ($rowLTH = mysqli_fetch_array($rsLTH)) {
                                                                        $query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $row_sub['master_id'] . "' && hari='" . $rowLTH['hari'] . "'";
                                                                        $rs_rute = mysqli_query($con, $query_rute);
                                                                        $row_rute = mysqli_fetch_array($rs_rute);
                                                                    ?>
                                                                        <div style="font-weight: bold; padding-top: 10px;">Hari Ke <?php echo $rowLTH['hari'] ?> : <?php echo $row_rute['nama'] ?></div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label style="font-size: 11px;">Pilih Hotel</label>
                                                                                <select class="form-control form-control-sm loop" nama="htl_day<?php echo $z ?>" id="htl_day<?php echo $z ?>">
                                                                                    <?php

                                                                                    if ($rowSH['id'] != "") {

                                                                                        $querySH2 = "SELECT * FROM  LT_select_PilihHTL WHERE copy_id='" . $row_sub['id'] . "' && master_id='" . $row_sub['master_id'] . "' && hari= '" . $rowLTH['hari'] . "'";
                                                                                        $rsSH2 = mysqli_query($con, $querySH2);
                                                                                        $rowSH2 = mysqli_fetch_array($rsSH2);
                                                                                        if ($rowSH2['id'] != "") {

                                                                                            $hotel = "";
                                                                                            if ($rowSH2['no_htl'] == 1) {
                                                                                                $hotel = $rowH_id['hotel1'];
                                                                                            } else if ($rowSH2['no_htl'] == 2) {
                                                                                                $hotel = $rowH_id['hotel2'];
                                                                                            } else if ($rowSH2['no_htl'] == 3) {
                                                                                                $hotel = $rowH_id['hotel3'];
                                                                                            } else if ($rowSH2['no_htl'] == 4) {
                                                                                                $hotel = $rowH_id['hotel4'];
                                                                                            } else if ($rowSH2['no_htl'] == 5) {
                                                                                                $hotel = $rowH_id['hotel5'];
                                                                                            } else if ($rowSH2['no_htl'] == 6) {
                                                                                                $hotel = $rowH_id['hotel6'];
                                                                                            } else if ($rowSH2['no_htl'] == 7) {
                                                                                                $hotel = $rowH_id['hotel7'];
                                                                                            } else if ($rowSH2['no_htl'] == 8) {
                                                                                                $hotel = $rowH_id['hotel8'];
                                                                                            } else if ($rowSH2['no_htl'] == 9) {
                                                                                                $hotel = $rowH_id['hotel9'];
                                                                                            } else if ($rowSH2['no_htl'] == 10) {
                                                                                                $hotel = $rowH_id['hotel10'];
                                                                                            }
                                                                                        }

                                                                                    ?>
                                                                                        <option value="<?php echo  $rowSH['no_htl'] ?>" selected><?php echo $hotel ?></option>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                        <option value="">Pilih Hotel</option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                        $z++;
                                                                        $ip++;
                                                                    }
                                                                    ?>
                                                                    <div style="padding-top: 15px;"></div>
                                                                    <input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_sub['id'] ?>">
                                                                    <input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_sub['master_id'] ?>">
                                                                    <input type="hidden" id="lt_name" name="lt_name" value="<?php echo  $row_sub['landtour'] ?>">
                                                                    <?php
                                                                    if ($rowSH['id'] == "") {
                                                                    ?>
                                                                        <button type="button" class="btn btn-warning btn-sm" onclick="insert_htl(<?php echo $z ?>)">Submit</button>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <button type="button" class="btn btn-success btn-sm" onclick="update_htl(<?php echo $z ?>)">Update</button>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="accordion6">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">SET FLIGHT DETAIL</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne" onclick="get_input_flight(<?php echo $row_sub['id'] ?>)">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne" data-parent="#accordion6">
                                                            <div class="card-body">
                                                                <?php
                                                                $query_atr = "SELECT * FROM  LT_add_transport where master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' order by hari ASC, urutan ASC";
                                                                $rs_atr = mysqli_query($con, $query_atr);
                                                                $no = 1
                                                                ?>
                                                                <div class="data-input-flight"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="accordion">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">Include & Exclude</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <?php
                                                                    $no = 1;
                                                                    while ($row = mysqli_fetch_array($rs)) {
                                                                        if ($row['id'] == '9' or $row['id'] == '10' or $row['id'] == '11' or $row['id'] == '12') {
                                                                    ?>
                                                                            <div class="col-md-6">
                                                                                <div class="input-group input-group-sm mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <div class="input-group-text">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?>" onclick="add_chck(<?php echo $row['id'] ?>)">
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $no . ") " . $row['nama'] ?>" disabled style="background-color: greenyellow;">
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <div class="col-md-6">
                                                                                <div class="input-group input-group-sm mb-3">
                                                                                    <div class="input-group-prepend">
                                                                                        <div class="input-group-text">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $no . ") " . $row['nama'] ?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                    <?php
                                                                        }
                                                                        $no++;
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="accordion2">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">Flight</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <?php
                                                                        $query_date = "SELECT * FROM  LT_add_transport where master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' order by hari ASC, urutan ASC limit 1";
                                                                        $rs_date = mysqli_query($con, $query_date);
                                                                        $row_date = mysqli_fetch_array($rs_date);
                                                                        $start_date = $row_date['tgl_sfee'];
                                                                        // var_dump($query_date);
                                                                        ?>
                                                                        <input type="hidden" name="strt_date" id="strt_date" value="<?php echo $start_date ?>">
                                                                        <div class="form-group">
                                                                            <select class="form-control form-control-sm" id="grub_i" name="grub_i" onchange="fungsi_fl_date()">
                                                                                <option value="">Pilih Grub Flight</option>
                                                                                <?php
                                                                                $query_grub = "SELECT * FROM LTP_grub_flight where city_in='" . $in . "' && city_out='" . $out . "' order by id ASC";
                                                                                $rs_grub = mysqli_query($con, $query_grub);
                                                                                // var_dump($query_grub);
                                                                                while ($row_grub = mysqli_fetch_array($rs_grub)) {
                                                                                ?><option value="<?php echo $row_grub['id'] ?>"><?php echo $row_grub['grub_name'] ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <select class="form-control form-control-sm gflight" id="grub_date" name="grub_date">
                                                                                <option value="">Pilih tgl Berangkat</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div style="padding-left: 10px;"><button type="button" class="btn btn-primary btn-sm" onclick="show_fl(<?php echo $_POST['id'] ?>,<?php echo $row_sub['master_id'] ?>);">Set Flight</button></div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="input-group input-group-sm mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">
                                                                                    <input type="checkbox" id="rdio" name="rdio" value="1">
                                                                                </div>
                                                                            </div>
                                                                            <input type="text" class="form-control" name="val_rdio" id="val_rdio" value="Option B (Compare Flight)" disabled>
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
                                                                <div id="show_fl"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="accordion3">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">Custom Price & Other</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion3">
                                                            <div class="card-body">
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
                                                                <div style="padding-bottom: 10px;">
                                                                    <label for="">COST TL (Pax)</label>
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <input class="form-control form-control-sm" type="number" name="tl_pax" id="tl_pax">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="accordion5">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">Tour Admission</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collaps5" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                            <!-- <i class="fa fa-chevron-down"></i>
                                                                                <i class="fa fa-chevron-up"></i> -->
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                            </h5>
                                                        </div>

                                                        <div id="collaps5" class="collapse" aria-labelledby="headingOne" data-parent="#accordion5">
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
                                                                                        <?php if ($row_tempat['price'] != 0 or $row_tempat['price'] == "") {
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
                                                <div id="accordion4">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-6">Note</div>
                                                                    <div class="col-md-6" style="text-align: right;">
                                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordion4">
                                                            <div class="card-body">
                                                                <div class="form-group">

                                                                    <label>Note</label>
                                                                    <!-- <textarea class="form-control" id="note" name="note" rows="3"></textarea> -->
                                                                    <textarea id="note" name="note"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div> <button type="submit" class="btn btn-success btn-sm">Print Itinerary</button></div>
                                                    <?php
                                                    if ($show_button == '1') {
                                                    ?>
                                                        <div style="padding-left: 10px;"><button type="button" class="btn btn-primary btn-sm" onclick="check_price(<?php echo $_POST['id'] ?>)">Breakdown Price</button></div>
                                                        <div style="padding-left: 10px;"> <button type="button" class="btn btn-danger btn-sm" onclick="add_promo2(<?php echo $_POST['id'] ?>)">Copy to Data Promo</button></div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div id="show_pricelist"></div>
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
    $(document).ready(function() {
        $('#note').summernote();
    });
</script>
<script>
    function get_input_flight(x) {
        $.ajax({
            url: "get_input_flight.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
            },
            success: function(data) {
                $('.data-input-flight').html(data);
            }
        });
    }
</script>
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

    function show_fl(y, z) {
        // alert("on")
        // document.getElementById("rdio").checked = false;
        var date = document.getElementById("grub_date").options[document.getElementById("grub_date").selectedIndex].value;
        var x = document.getElementById("grub_i").options[document.getElementById("grub_i").selectedIndex].value;
        // alert(x);
        $.ajax({
            url: "print_show_printview.php",
            method: "POST",
            asynch: false,
            data: {
                x: x,
                y: y,
                z: z,
                date: date
            },
            success: function(data) {
                $('#show_fl').html(data);
            }
        });
    }

    function fungsi_fl_date() {
        var h_gb = document.getElementById("grub_i").options[document.getElementById("grub_i").selectedIndex].value;
        // alert(h_gb);
        $('.gflight').empty();
        $.post('LT_get_flight_date.php', {
            'brand': h_gb,
        }, function(data) {
            var jsonData = JSON.parse(data);
            // console.log(jsonData);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter.date_set != "") {
                        $('.gflight').append('<option value=' + counter.date_set + '>' + counter.date_set + '</option>');
                    }
                }
            } else {
                $(".gflight").empty().append('<option selected="selected" value="">Date Not Found</option>');
            }
        });
    }


    function updateInput(ish) {
        document.getElementById("lsgl").value = ish;
        document.getElementById("lcnb").value = ish;
        document.getElementById("linf").value = ish;
    }

    function add_promo2(x) {
        var r = confirm("Are you sure to copy this file to Data Promo ?");
        if (r == true) {
            let formData = new FormData();
            var array = [];
            // var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
            var date = document.getElementById("grub_date").value;
            var flight = document.getElementById("grub_i").value;

            $("[name='include[]']:checked").each(function() {
                $val = $(this).val();
                array.push($val);
            });
            // console.log(array);

            // var jsondata = JSON.stringify(array);
            formData.append('flight', flight);
            formData.append('date', date);
            formData.append('chck', array);
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
                url: "copy_ptsub_promo_new.php",
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

        // console.log(array);
    }

    function check_price(x) {
        let formData = new FormData();
        var array = [];
        var arr_adm_inc = [];
        var arr_adm_ex = [];

        // var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
        var hotel = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
        var flight = document.getElementById("grub_i").value;
        var date = document.getElementById("grub_date").value;
        var tl_pax = document.getElementById("tl_pax").value;
        var ltwn = document.getElementById("ltwn").value;

        $("[name='include[]']:checked").each(function() {
            $val = $(this).val();
            array.push($val);
        });
        $("[name='tmp[]']:checked").each(function() {
            $val = $(this).val();
            arr_adm_inc.push($val);
        });
        $("[name='tmp_ex[]']:checked").each(function() {
            $val = $(this).val();
            arr_adm_ex.push($val);
        });

        formData.append('chck', array);
        formData.append('adm_inc', arr_adm_inc);
        formData.append('adm_ex', arr_adm_ex);
        formData.append('id', x);
        formData.append('flight', flight);
        formData.append('date', date);
        formData.append('hotel', hotel);
        formData.append('ltwn', ltwn);
        formData.append('tl_pax', tl_pax);
        $.ajax({
            type: 'POST',
            url: "view_price_list.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#show_pricelist').html(data);
            }
        });

    }


    function fungsi_hotel_day() {
        var txt;
        var r = confirm("Are you sure to Replace?");
        if (r == true) {
            var h_gb = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
            $('.loop').empty();
            $.post('LT_get_select_lt.php', {
                'brand': h_gb,
            }, function(data) {
                var jsonData = JSON.parse(data);
                // console.log(jsonData);
                if (jsonData != '') {
                    for (var i = 0; i < jsonData.length; i++) {
                        var counter = jsonData[i];
                        if (counter.hotel1 != "") {
                            $('.loop').append('<option value=' + 1 + '>' + counter.hotel1 + '</option>');
                        }
                        if (counter.hotel2 != "") {
                            $('.loop').append('<option value=' + 2 + '>' + counter.hotel2 + '</option>');
                        }
                        if (counter.hotel3 != "") {
                            $('.loop').append('<option value=' + 3 + '>' + counter.hotel3 + '</option>');
                        }
                        if (counter.hotel4 != "") {
                            $('.loop').append('<option value=' + 4 + '>' + counter.hotel4 + '</option>');
                        }
                        if (counter.hotel5 != "") {
                            $('.loop').append('<option value=' + 5 + '>' + counter.hotel5 + '</option>');
                        }
                        if (counter.hotel6 != "") {
                            $('.loop').append('<option value=' + 6 + '>' + counter.hotel6 + '</option>');
                        }
                        if (counter.hotel7 != "") {
                            $('.loop').append('<option value=' + 7 + '>' + counter.hotel7 + '</option>');
                        }
                        if (counter.hotel8 != "") {
                            $('.loop').append('<option value=' + 8 + '>' + counter.hotel8 + '</option>');
                        }
                        if (counter.hotel9 != "") {
                            $('.loop').append('<option value=' + 9 + '>' + counter.hotel9 + '</option>');
                        }
                        if (counter.hotel10 != "") {
                            $('.loop').append('<option value=' + 10 + '>' + counter.hotel10 + '</option>');
                        }

                    }
                } else {
                    $(".loop").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
                }
            });
        }
    }

    function insert_htl(x) {
        var h_gb = $("input[name=lt_name]").val();
        var pax = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
        var master_id = $("input[name=master_id]").val();
        var copy_id = $("input[name=copy_id]").val();
        let formData = new FormData();
        for (var i = 1; i < x; i++) {
            var htl_day = document.getElementById("htl_day" + i).options[document.getElementById("htl_day" + i).selectedIndex].value;
            formData.append("htl_day[]", htl_day);
        }
        formData.append("lt_name", h_gb);
        formData.append("sel_htl", pax);
        formData.append("master_id", master_id);
        formData.append("copy_id", copy_id);
        formData.append("code", "yes");
        $.ajax({
            type: 'POST',
            url: "insert_pilih_LThtl.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(3, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }

    function update_htl(x) {
        var h_gb = $("input[name=lt_name]").val();
        var pax = document.getElementById("sel_pax").options[document.getElementById("sel_pax").selectedIndex].value;
        var master_id = $("input[name=master_id]").val();
        var copy_id = $("input[name=copy_id]").val();
        let formData = new FormData();
        for (var i = 1; i < x; i++) {
            var htl_day = document.getElementById("htl_day" + i).options[document.getElementById("htl_day" + i).selectedIndex].value;
            formData.append("htl_day[]", htl_day);
        }
        formData.append("lt_name", h_gb);
        formData.append("sel_htl", pax);
        formData.append("master_id", master_id);
        formData.append("copy_id", copy_id);
        formData.append("code", "yes");
        $.ajax({
            type: 'POST',
            url: "update_pilih_LThtl.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(3, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }
</script>