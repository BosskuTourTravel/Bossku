<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $sub_id = $_POST['y'];
    $val_in = $_POST['val_in'];
?>
    <div class="input-group input-group-sm">
        <div class="input-group-append" style="text-align: left;">
            <div style="padding-right: 5px;"><button type="button" id="btn_sub" class="btn btn-sm" onclick="add_filter(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,'Surabaya')" style="background-color: green; color: white;">SUB</button></div>
            <div style="padding-right: 5px;"><button type="button" id="btn_sin" class="btn btn-sm" onclick="add_filter(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,'Singapore') " style="background-color: green; color: white;">SIN</button></div>
            <div style="padding-right: 5px;"><button type="button" id="btn_cgk" class="btn btn-sm" onclick="add_filter(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,'Jakarta')" style="background-color: green; color: white;">CGK</button></div>
            <div style="padding-right: 5px;"><button type="button" id="btn_dps" class="btn btn-sm" onclick="add_filter(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,'Denpasar')" style="background-color: green; color: white;">DPS</button></div>
        </div>
    </div>
    <?php

    $query_sfee_tt = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $_POST['x'] . "'";
    $rs_sfee_tt = mysqli_query($con, $query_sfee_tt);
    $row_sfee_tt = mysqli_fetch_array($rs_sfee_tt);
    $adt_sfe = 0;
    $chd_sfe = 0;
    $inf_sfe = 0;
    if ($row_sfee_tt['id'] != "") {
        $adt_sfe = $row_sfee_tt['adt'];
        $chd_sfe = $row_sfee_tt['chd'];
        $inf_sfe = $row_sfee_tt['inf'];
    }

    $query_grub = "SELECT city_in,city_out,grub_name FROM LTP_grub_flight where id='" . $_POST['x'] . "'";
    $rs_grub = mysqli_query($con, $query_grub);
    $row_grub = mysqli_fetch_array($rs_grub);
    if ($row_grub['city_in'] != "") {

        $query_route = "SELECT * FROM LTP_add_route where city_out='" . $row_grub['city_in'] . "' && city_in='" . $val_in . "' order by id ASC";
        $rs_route = mysqli_query($con, $query_route);
        while ($row_route = mysqli_fetch_array($rs_route)) {
            $query_fl2 = "SELECT nama FROM LT_flight_logo where kode='" . $row_route['maskapai'] . "'";
            $rs_fl2 = mysqli_query($con, $query_fl2);
            $row_fl2 = mysqli_fetch_array($rs_fl2);
    ?>
            <div style="text-align: center; font-weight: bold; padding: 10px;"><?php echo $row_fl2['nama'] ?></div>
            <div><b style="color: green;"><?php echo $row_route['city_in'] ?></b> to <b style="color: red;"><?php echo $row_route['city_out'] ?></b></div>
            <table class="table table-bordered table-sm" style="font-size: 12px;">
                <thead>
                    <tr style="text-align: center;">
                        <th style="min-width: 40px;">#</th>
                        <th>Flight</th>
                        <th>Dept</th>
                        <th>Arr</th>
                        <th>ETD</th>
                        <th>ETA</th>
                        <th>Transit</th>
                        <th>Date</th>
                        <th>Adt</th>
                        <th>Chd</th>
                        <th>Inf</th>
                        <th>Bagasi</th>
                        <th>Bagasi Price</th>
                        <th>Group</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $chek_id = 0;
                    $query_rou = "SELECT * FROM  LTP_route_detail where route_id='" . $row_route['id'] . "' order by rute ASC , id ASC";
                    $rs_rou = mysqli_query($con, $query_rou);
                    while ($row_rou = mysqli_fetch_array($rs_rou)) {
                        $query_typ = "SELECT * FROM LTP_type_flight where id='" . $row_rou['type'] . "'";
                        $rs_typ = mysqli_query($con, $query_typ);
                        $row_typ = mysqli_fetch_array($rs_typ);
                    ?>
                        <tr>
                            <td>
                                <div style="text-align: center; margin: auto;">
                                    <?php
                                    if ($chek_id != $row_rou['id_grub']) {
                                        $chek_id = $row_rou['id_grub'];
                                    ?>
                                        <input class="form-check-input" type="checkbox" id="chck" name="chck" value="<?php echo $row_rou['id'] ?>">
                                    <?php
                                    }
                                    ?>

                                </div>
                            </td>
                            <td><?php echo  $row_rou['maskapai'] ?></td>
                            <td><?php echo  $row_rou['dept'] ?></td>
                            <td><?php echo  $row_rou['arr'] ?></td>
                            <td><?php echo  $row_rou['take'] ?></td>
                            <td><?php echo  $row_rou['landing'] ?></td>
                            <td><?php if ($row_rou['transit'] != 0) {
                                    $jam = floor($row_rou['transit'] / 60);
                                    $menit = fmod($row_rou['transit'], 60);
                                    echo $jam . "H " . $menit . "M";
                                }  ?></td>
                            <td><?php echo $row_rou['tgl'] ?></td>
                            <td><?php echo number_format($row_rou['adt'], 0, ",", ".") ?></td>
                            <td><?php echo number_format($row_rou['chd'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['inf'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['bagasi'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['bagasi_price'], 0, ",", ".") ?></td>
                            <td><?php echo  $row_rou['rute'] ?></td>
                            <td><?php echo  $row_typ['nama'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- pulang -->
            <div><b style="color: green;"><?php echo $row_route['city_out'] ?></b> to <b style="color: red;"><?php echo $row_route['city_in'] ?></b></div>
            <table class="table table-bordered table-sm" style="font-size: 12px;">
                <thead>
                    <tr style="text-align: center;">
                        <th style="min-width: 40px;">#</th>
                        <th>Flight</th>
                        <th>Dept</th>
                        <th>Arr</th>
                        <th>ETD</th>
                        <th>ETA</th>
                        <th>Transit</th>
                        <th>Date</th>
                        <th>Adt</th>
                        <th>Chd</th>
                        <th>Inf</th>
                        <th>Bagasi</th>
                        <th>Bagasi Price</th>
                        <th>Group</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $chek_id_pp = 0;
                    $query_route_pp = "SELECT * FROM  LTP_add_route  where id ='" . $row_route['id'] . "'";
                    $rs_route_pp = mysqli_query($con, $query_route_pp);
                    $row_route_pp = mysqli_fetch_array($rs_route_pp);

                    $query_pp = "SELECT id FROM  LTP_add_route  where city_in ='" . $row_route_pp['city_out'] . "' && city_out='" . $row_route_pp['city_in'] . "' && maskapai='" . $row_route_pp['maskapai'] . "'";
                    $rs_pp = mysqli_query($con, $query_pp);
                    $row_pp = mysqli_fetch_array($rs_pp);

                    $query_rou_pp = "SELECT * FROM  LTP_route_detail where route_id='" . $row_pp['id'] . "' order by rute ASC , id ASC";
                    $rs_rou_pp = mysqli_query($con, $query_rou_pp);
                    while ($row_rou_pp = mysqli_fetch_array($rs_rou_pp)) {
                        $query_typ_pp = "SELECT * FROM LTP_type_flight where id='" . $row_rou_pp['type'] . "'";
                        $rs_typ_pp = mysqli_query($con, $query_typ_pp);
                        $row_typ_pp = mysqli_fetch_array($rs_typ_pp);
                    ?>
                        <tr>
                            <td>
                                <div style="text-align: center; margin: auto;">
                                    <?php
                                    if ($chek_id_pp != $row_rou_pp['id_grub']) {
                                        $chek_id_pp = $row_rou_pp['id_grub'];
                                    ?>
                                        <input class="form-check-input" type="checkbox" id="chck" name="chck" value="<?php echo $row_rou_pp['id'] ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>
                            <td><?php echo  $row_rou_pp['maskapai'] ?></td>
                            <td><?php echo  $row_rou_pp['dept'] ?></td>
                            <td><?php echo  $row_rou_pp['arr'] ?></td>
                            <td><?php echo  $row_rou_pp['take'] ?></td>
                            <td><?php echo  $row_rou_pp['landing'] ?></td>
                            <td><?php if ($row_rou_pp['transit'] != 0) {
                                    $jam = floor($row_rou_pp['transit'] / 60);
                                    $menit = fmod($row_rou_pp['transit'], 60);
                                    echo $jam . "H " . $menit . "M";
                                }  ?>
                            </td>
                            <td><?php echo $row_rou_pp['tgl'] ?></td>
                            <td><?php echo number_format($row_rou_pp['adt'], 0, ",", ".") ?></td>
                            <td><?php echo number_format($row_rou_pp['chd'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou_pp['inf'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou_pp['bagasi'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou_pp['bagasi_price'], 0, ",", ".") ?></td>
                            <td><?php echo  $row_rou_pp['rute'] ?></td>
                            <td><?php echo  $row_typ_pp['nama'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
        <div class="roundtrip">
            <div style="text-align: center; font-size: 20px; font-weight: bold; background-color: darkolivegreen; color: white;">ROUND TRIP</div>
            <?php
            $query_rr = "SELECT * FROM  LT_add_roundtrip where city_out='" . $row_grub['city_in'] . "' && city_in='" . $val_in . "' order by id ASC";
            $rs_rr = mysqli_query($con, $query_rr);

            ?>
            <div><b style="color: green;"><?php echo $val_in ?></b> to <b style="color: red;"><?php echo $row_grub['city_in'] ?></b></div>
            <table class="table table-bordered table-sm" style="font-size: 12px;">
                <thead>
                    <tr style="text-align: center;">
                        <th style="min-width: 40px;">#</th>
                        <th>Flight</th>
                        <th>Dept</th>
                        <th>Arr</th>
                        <th>ETD</th>
                        <th>ETA</th>
                        <th>Transit</th>
                        <th>Date</th>
                        <th>Adt</th>
                        <th>Chd</th>
                        <th>Inf</th>
                        <th>Bagasi</th>
                        <th>Bagasi Price</th>
                        <th>Group</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_rr = mysqli_fetch_array($rs_rr)) {
                        $query_frr = "SELECT nama FROM LT_flight_logo where kode='" . $row_rr['flight'] . "'";
                        $rs_frr = mysqli_query($con, $query_frr);
                        $row_frr = mysqli_fetch_array($rs_frr);

                        $adt_rr = 0;
                        $chd_rr = 0;
                        $inf_rr = 0;
                        // var_dump($query_frr);
                    ?>
                        <tr>
                            <th colspan="15" style="text-align: center;"><?php echo  $row_frr['nama'] ?></th>
                        </tr>
                        <?php
                        $chek_id_rr = 0;
                        $query_detail_rr = "SELECT * FROM  LTP_route_detail where route_id='" . $row_rr['route_id'] . "' order by rute ASC , id ASC";
                        $rs_detail_rr = mysqli_query($con, $query_detail_rr);
                        $x_rr = 1;
                        while ($row_detail_rr = mysqli_fetch_array($rs_detail_rr)) {
                            $query_typ_rr = "SELECT * FROM LTP_type_flight where id='" . $row_detail_rr['type'] . "'";
                            $rs_typ_rr = mysqli_query($con, $query_typ_rr);
                            $row_typ_rr = mysqli_fetch_array($rs_typ_rr);
                            if ($x_rr == '1') {
                                $adt_rr = $row_rr['adt'];
                                $chd_rr = $row_rr['chd'];
                                $inf_rr = $row_rr['inf'];
                            } else {
                                $adt_rr = 0;
                                $chd_rr = 0;
                                $inf_rr = 0;
                            }
                        ?>
                            <tr>
                                <td>
                                    <div style="text-align: center; margin: auto;">
                                        <input class="form-check-input" type="checkbox" id="chck_rr" name="chck_rr" value="<?php echo $row_detail_rr['id'] ?>">
                                    </div>
                                </td>
                                <td><?php echo  $row_detail_rr['maskapai'] ?></td>
                                <td><?php echo  $row_detail_rr['dept'] ?></td>
                                <td><?php echo  $row_detail_rr['arr'] ?></td>
                                <td><?php echo  $row_detail_rr['take'] ?></td>
                                <td><?php echo  $row_detail_rr['landing'] ?></td>
                                <td><?php if ($row_detail_rr['transit'] != 0) {
                                        $jam = floor($row_detail_rr['transit'] / 60);
                                        $menit = fmod($row_detail_rr['transit'], 60);
                                        echo $jam . "H " . $menit . "M";
                                    } ?></td>
                                <td><?php echo $row_detail_rr['tgl'] ?></td>
                                <td><?php echo number_format($adt_rr, 0, ",", ".") ?></td>
                                <td><?php echo number_format($chd_rr, 0, ",", ".") ?></td>
                                <td><?php echo number_format($inf_rr, 0, ",", ".") ?></td>
                                <td><?php echo number_format($row_detail_rr['bagasi'], 0, ",", ".") ?></td>
                                <td><?php echo number_format($row_detail_rr['bagasi_price'], 0, ",", ".") ?></td>
                                <td><?php echo $row_detail_rr['rute'] ?></td>
                                <td><?php echo $row_typ_rr['nama'] ?></td>
                            </tr>

                        <?php
                            $x_rr++;
                        }
                        ?>
                        <tr>
                            <td colspan="15" style="background-color: darkolivegreen;"></td>
                        </tr>
                        <?php
                        $query_pp_rr = "SELECT id FROM  LTP_add_route  where city_in ='" . $row_rr['city_out'] . "' && city_out='" . $row_rr['city_in'] . "' && maskapai='" . $row_rr['flight'] . "'";
                        $rs_pp_rr = mysqli_query($con, $query_pp_rr);
                        $row_pp_rr = mysqli_fetch_array($rs_pp_rr);

                        // var_dump($query_pp_rr);

                        $query_rou_pp_rr = "SELECT * FROM  LTP_route_detail where route_id='" . $row_pp_rr['id'] . "' order by rute ASC , id ASC";
                        $rs_rou_pp_rr = mysqli_query($con, $query_rou_pp_rr);
                        while ($row_rou_pp_rr = mysqli_fetch_array($rs_rou_pp_rr)) {
                            $query_typ_pp_rr = "SELECT * FROM LTP_type_flight where id='" . $row_rou_pp_rr['type'] . "'";
                            $rs_typ_pp_rr = mysqli_query($con, $query_typ_pp_rr);
                            $row_typ_pp_rr = mysqli_fetch_array($rs_typ_pp_rr);
                        ?>
                            <tr>
                                <td>
                                <div style="text-align: center; margin: auto;">
                                        <input class="form-check-input" type="checkbox" id="chck_rr" name="chck_rr" value="<?php echo $row_rou_pp_rr['id'] ?>">
                                    </div>
                                </td>
                                <td><?php echo  $row_rou_pp_rr['maskapai'] ?></td>
                                <td><?php echo  $row_rou_pp_rr['dept'] ?></td>
                                <td><?php echo  $row_rou_pp_rr['arr'] ?></td>
                                <td><?php echo  $row_rou_pp_rr['take'] ?></td>
                                <td><?php echo  $row_rou_pp_rr['landing'] ?></td>
                                <td><?php if ($row_rou_pp_rr['transit'] != 0) {
                                        $jam = floor($row_rou_pp_rr['transit'] / 60);
                                        $menit = fmod($row_rou_pp_rr['transit'], 60);
                                        echo $jam . "H " . $menit . "M";
                                    }  ?></td>
                                <td><?php echo $row_rou_pp_rr['tgl'] ?></td>
                                <td><?php echo number_format($adt_rr, 0, ",", ".") ?></td>
                                <td><?php echo number_format($chd_rr, 0, ",", ".") ?></td>
                                <td><?php echo  number_format($inf_rr, 0, ",", ".") ?></td>
                                <td><?php echo  number_format($row_rou_pp_rr['bagasi'], 0, ",", ".") ?></td>
                                <td><?php echo  number_format($row_rou_pp_rr['bagasi_price'], 0, ",", ".") ?></td>
                                <td><?php echo  $row_rou_pp_rr['rute'] ?></td>
                                <td><?php echo  $row_typ_pp_rr['nama'] ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div style="text-align: center; font-size: 20px; font-weight: bold; background-color: darkolivegreen; color: white; padding-top: 30px;"></div>
        </div>
        <div id="more" style="padding: 10px 0px;">

        </div>
        <div style="padding: 10px;">
            <input type="hidden" id="cek" value="0">
            <button type="button" class="btn btn-success btn-sm" onclick="add_togrub(<?php echo $_POST['x'] ?>,<?php echo $sub_id ?>);add_form_edit(<?php echo $_POST['x'] ?>,<?php echo $sub_id?>)">Add Flight To Group</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="add_more(<?php echo $_POST['x'] ?>,<?php echo $sub_id ?>)">More Flight</button>
            <button type="button" class="btn btn-warning btn-sm" onclick="reset_grub(<?php echo $_POST['x'] ?>,<?php echo $sub_id ?>); add_form_edit(<?php echo $_POST['x'] ?>,<?php echo $sub_id?>)">Reset Group</button>
        </div>
        <div style="padding: 10px; text-align: center;"><b>LIST <?php echo $row_grub['grub_name'] ?></b></div>
        <table class="table table-bordered table-sm" style="font-size: 12px;">
            <thead>
                <tr style="text-align: center;">
                    <th style="min-width: 40px;">No</th>
                    <th>Flight</th>
                    <th>Dept</th>
                    <th>Arr</th>
                    <th>ETD</th>
                    <th>ETA</th>
                    <th>Transit</th>
                    <th>Date</th>
                    <th>Adt</th>
                    <th>Chd</th>
                    <th>Inf</th>
                    <th>Bagasi</th>
                    <th>Bagasi Price</th>
                    <th>Type 1</th>
                    <th>Type 2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $_POST['x'] . "' order by id ASC";
                $rs_gf = mysqli_query($con, $query_gf);
                $no = 1;
                $adt = 0;
                $chd = 0;
                $inf = 0;
                $bg = 0;
                $x_gf = 1;
                while ($row_gf = mysqli_fetch_array($rs_gf)) {

                    $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
                    $rs_detail = mysqli_query($con, $query_detail);
                    $row_detail = mysqli_fetch_array($rs_detail);

                    $query_typ2 = "SELECT * FROM LTP_type_flight where id='" . $row_detail['type'] . "'";
                    $rs_typ2 = mysqli_query($con, $query_typ2);
                    $row_typ2 = mysqli_fetch_array($rs_typ2);

                    $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail['route_id'] . "'";
                    $rs_rt = mysqli_query($con, $query_rt);
                    $row_rt = mysqli_fetch_array($rs_rt);

                    if ($row_gf['status'] == '1') {
                        if($x_gf =='1'){
                            $type = "Roundtrip Auto";
                            $adt_rt = $row_rt['adt'];
                            $chd_rt = $row_rt['chd'];
                            $inf_rt = $row_rt['inf'];
                        }else{
                            $type = "Roundtrip Auto";
                            $adt_rt = 0;
                            $chd_rt = 0;
                            $inf_rt =0;
                        }

                    } else {
                        $type = $row_typ2['nama'];
                        $adt_rt = $row_detail['adt'];
                        $chd_rt = $row_detail['chd'];
                        $inf_rt = $row_detail['inf'];
                    }


                ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo  $row_detail['maskapai'] ?></td>
                        <td><?php echo  $row_detail['dept'] ?></td>
                        <td><?php echo  $row_detail['arr'] ?></td>
                        <td><?php echo  $row_detail['take'] ?></td>
                        <td><?php echo  $row_detail['landing'] ?></td>
                        <td><?php if ($row_detail['transit'] != 0) {
                                $jam = floor($row_detail['transit'] / 60);
                                $menit = fmod($row_detail['transit'], 60);
                                echo $jam . "H " . $menit . "M";
                            }  ?></td>
                        <td><?php echo $row_detail['tgl'] ?></td>
                        <td><?php echo number_format($adt_rt, 0, ",", ".") ?></td>
                        <td><?php echo number_format($chd_rt, 0, ",", ".") ?></td>
                        <td><?php echo  number_format($inf_rt, 0, ",", ".") ?></td>
                        <td><?php echo  number_format($row_detail['bagasi'], 0, ",", ".") ?></td>
                        <td><?php echo  number_format($row_detail['bagasi_price'], 0, ",", ".") ?></td>
                        <td><?php echo  $row_detail['rute'] ?></td>
                        <td><?php echo  $type ?></td>
                        <td><a class="badge badge-danger" onclick="del_fg(<?php echo $row_gf['id'] ?>); add_form_edit(<?php echo $_POST['x'] ?>,<?php echo $sub_id?>)"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php
                    $no++;
                    $adt = $adt + $adt_rt;
                    $chd = $chd + $chd_rt;
                    $inf = $inf + $inf_rt;
                    $bg = $bg + $row_detail['bagasi_price'];
                    $x_gf ++;
                }
                $adt = $adt + $adt_sfe;
                $chd = $chd + $chd_sfe;
                $inf = $inf + $inf_sfe;
                ?>
                <tr>
                    <th colspan="8">Surcharge Fee</th>
                    <td><?php echo  number_format($adt_sfe, 0, ",", ".") ?></td>
                    <td><?php echo  number_format($chd_sfe, 0, ",", ".") ?></td>
                    <td><?php echo  number_format($inf_sfe, 0, ",", ".") ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8">Total Price Flight</th>
                    <th><?php echo  number_format($adt, 0, ",", ".") ?></th>
                    <th><?php echo  number_format($chd, 0, ",", ".") ?></th>
                    <th><?php echo  number_format($inf, 0, ",", ".") ?></th>
                    <th></th>
                    <th><?php echo  number_format($bg, 0, ",", ".") ?></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
<?php
    }
}
?>
<script>
    function add_more(x, y) {
        var cek = document.getElementById('cek').value;
        if (cek === '0') {
            $.ajax({
                url: "LTP_more_field.php",
                method: "POST",
                asynch: false,
                data: {
                    x: x,
                    y: y
                },
                success: function(data) {
                    $('#more').html(data);
                    document.getElementById('cek').value = '1';
                }
            });
        } else {
            $('#more').html('');
            document.getElementById('cek').value = '0';
        }

    }

    function add_togrub(x, y) {
        let formData = new FormData();
        $('input[name="chck"]:checked').each(function() {
            // console.log(this.value);
            formData.append("chck[]", this.value);
        });
        $('input[name="chck_rr"]:checked').each(function() {
            // console.log(this.value);
            formData.append("chck_rr[]", this.value);
        });

        formData.append("grub_fl", x);
        // alert(y);
        $.ajax({
            type: 'POST',
            url: "LTP_insert_grub_flight.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(22, y, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function reset_grub(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LTP_reset_grub.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        alert("Reset Success");
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>
<script>
    function add_filter(x, y, z) {
        $.ajax({
            url: "LTP_formedit_field.php",
            method: "POST",
            asynch: false,
            data: {
                x: x,
                y: y,
                val_in: z
            },
            success: function(data) {
                $('#form-edit').html(data);
            }
        });
    }

    function del_fg(x){
        var txt;
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                $.ajax({
                    url: "LTP_delete_fg.php",
                    method: "POST",
                    asynch: false,
                    data: {
                        id: x,
                    },
                    success: function(data) {
                        if (data == "success") {
                           
                            alert("Deleted Success")
                        } else {
                            alert("Fail to Delete");
                        }
                    }
                });
            }
    }
</script>