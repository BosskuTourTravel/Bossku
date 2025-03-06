<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Perhitungan List </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    include "Api_LT_total.php";
                    $query = "SELECT * FROM  checkbox_include2 order by id ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1;

                    $query_master = "SELECT * FROM LT_itinerary2  where id=" . $_POST['master_id'];
                    $rs_master = mysqli_query($con, $query_master);
                    $row_master = mysqli_fetch_array($rs_master);
                    $bonus = "";
                    if ($row_master['landtour'] == "undefined") {
                        $lt_judul = "Without Landtour";
                    } else {
                        $lt_judul = $row_master['landtour'];
                        $query_ss = "SELECT * FROM  LT_select_PilihHTL where master_id='" . $_POST['master_id'] . "' && copy_id='" . $_POST['id'] . "'";
                        $rs_ss = mysqli_query($con, $query_ss);
                        $row_ss = mysqli_fetch_assoc($rs_ss);
                        $hotel_id = $row_ss['hotel_id'];

                        
                        $query_p = "SELECT * FROM  LT_itinnew where id=" . $hotel_id;
                        $rs_p = mysqli_query($con, $query_p);
                        $row_p = mysqli_fetch_assoc($rs_p);
                        $pax = $row_p['pax'];
                        $detailj = "(".$pax." - ". $row_p['pax_u']." [".$row_p['pax_b']."])";

                    }
                    ?>
                    <div style="text-align: center; padding: 10px;"><b><?php echo $lt_judul." ".$detailj ?></b></div>
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Detail</th>
                                <th>Twin/CWB</th>
                                <th>CNB</th>
                                <th>INF</th>
                                <th>SGL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_twn = 0;
                            $total_chd = 0;
                            $total_inf = 0;
                            $total_sgl = 0;

                            $tips_meal = 0;
                            $tips_flight = 0;
                            $tips_train = 0;
                            $tips_ferry = 0;
                            $tips_flTax = 0;
                            $tips_flMeal = 0;
                            $tips_flBagasi = 0;
                            $tips_LT = 0;
                            $landtour = 0;
                            $single_sub = 0;
                            $ltc = 0;
                            $grand = 0;
                            $grandtotal = 0;
                            $flight = 0;
                            while ($row = mysqli_fetch_array($rs)) {


                                $datareq = array(
                                    "master_id" => $_POST['master_id'],
                                    "copy_id" => $_POST['id'],
                                    "check_id" => $row['id']
                                );
                                $show_total = get_total($datareq);
                                $result_show_total = json_decode($show_total, true);
                                $total_twn = $total_twn + $result_show_total['adt'];
                                $total_chd = $total_chd + $result_show_total['chd'];
                                $total_inf = $total_inf + $result_show_total['inf'];
                                $total_sgl = $total_sgl + $result_show_total['sgl'];




                            ?>
                                <tr>
                                    <td><?php echo  $row['id'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php
                                        foreach ($result_show_total['detail'] as $detail) {
                                            echo "<div>" . $detail . "</div>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo number_format($result_show_total['adt'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($result_show_total['chd'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($result_show_total['inf'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($result_show_total['sgl'], 0, ",", ".") ?></td>
                                    <td>
                                        <?php
                                        if ($row['id'] == '1') {
                                            $tips_flight = $tips_flight + $result_show_total['adt'];
                                        }
                                        if ($row['id'] == '18') {
                                            $tips_ferry = $tips_ferry + $result_show_total['adt'];
                                        }
                                        if ($row['id'] == '19') {
                                            $tips_train = $tips_train + $result_show_total['adt'];
                                        }
                                        if ($row['id'] == '24') {
                                            $tips_flMeal = $tips_flMeal + $result_show_total['adt'];
                                        }
                                        if ($row['id'] == '32') {

                                            // $pax = 1;

                                            $v_fee = 0;
                                            $v_sfee = 0;
                                            $v_vt = 0;
                                            $v_meal = 0;
                                            $tl_fee_harga = 0;
                                            $tl_sfee_harga = 0;
                                            $tl_vocer_harga = 0;
                                            $tl_meal_harga = 0;


                                            if ($row_master['landtour'] == "undefined") {
                                                $single_sub = 0;
                                            } else {
                                                $lt_price = intval($row_p['agent_twn']);
                                                $lt_price_sub = intval($row_p['agent_sglsub']);
                                                $pax_covery = 0;
                                                if($row_p['pax_b'] >= '0'){
                                                    $pax_covery = $row_p['pax_b'] * -1;
                                                }
                                                // var_dump($lt_price);
                                                $landtour = $landtour + $lt_price;
                                                $single_sub = $single_sub + $lt_price_sub;
                                                $lt_c = $lt_c + ($landtour * $pax_covery);


                                                $query_sub = "SELECT * FROM LTSUB_itin where master_id ='" .  $_POST['master_id'] . "' && id='" . $_POST['id'] . "'";
                                                $rs_sub = mysqli_query($con, $query_sub);
                                                $row_sub = mysqli_fetch_array($rs_sub);

                                                $query_cbng = "SELECT * FROM cabang where id ='" . $row_sub['cabang'] . "'";
                                                $rs_cbng = mysqli_query($con, $query_cbng);
                                                $row_cbng = mysqli_fetch_array($rs_cbng);



                                                if ($row_p['benua'] == "ASIA") {
                                                    $val_check = ["THAILAND", "MALAYSIA", "SINGAPORE"];
                                                    $exp_negara = preg_split("( - )", $row_p['negara']);
                                                    $pilih_negara = "";
                                                    foreach ($exp_negara as $value) {
                                                        $cek  = array_search($value, $val_check);
                                                        if ($cek != "") {
                                                            $pilih_negara = $value;
                                                            break;
                                                        }
                                                    }

                                                    if ($pilih_negara != "") {
                                                        $query_tl_fee = "SELECT * FROM  TL_fee where benua='" . $row_p['benua'] . "' && negara='" . $pilih_negara . "' && mulai='" . $row_cbng['nama'] . "'";
                                                        $rs_tl_fee = mysqli_query($con, $query_tl_fee);

                                                        while ($row_tl_fee = mysqli_fetch_array($rs_tl_fee)) {
                                                            if ($row_tl_fee['type'] == "TL FEE PER DAY") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);
                                                                $tl_fee_harga =  $result_show_kurs['data'];
                                                                $v_fee =  $result_show_kurs['data'] * $row_master['hari'];
                                                            } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);
                                                                $tl_sfee_harga = $result_show_kurs['data'];
                                                                $v_sfee =  $result_show_kurs['data'] * $row_master['hari'];
                                                            } else if ($row_tl_fee['type'] == "TL MEAL 1X ABF/LUNCH/DINNER") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);

                                                                $price_meal = intval($result_show_kurs['data'] * 3);
                                                                $tl_meal_harga = $result_show_kurs['data'];
                                                                $v_meal = $row_master['hari'] * $price_meal;
                                                            } else if ($row_tl_fee['type'] == "TL VOUCHER TELEPHONE") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);

                                                                $v_vt = $result_show_kurs['data'];
                                                                $tl_vocer_harga = $result_show_kurs['data'];
                                                            } else {
                                                            }
                                                        }
                                                    } else {

                                                        $query_tl_fee = "SELECT * FROM  TL_fee where benua='" . $row_p['benua'] . "' && negara != 'SINGAPORE' && negara !='MALAYSIA' && negara !='THAILAND' && mulai='" . $row_cbng['nama'] . "'";
                                                        $rs_tl_fee = mysqli_query($con, $query_tl_fee);
                                                        // array_push($data,$query_tl_fee);

                                                        while ($row_tl_fee = mysqli_fetch_array($rs_tl_fee)) {
                                                            if ($row_tl_fee['type'] == "TL FEE PER DAY") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);
                                                                $tl_fee_harga =  $result_show_kurs['data'];
                                                                $v_fee =  $result_show_kurs['data'] * $row_master['hari'];
                                                            } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);
                                                                $tl_sfee_harga = $result_show_kurs['data'];
                                                                $v_sfee =  $result_show_kurs['data'] * $row_master['hari'];
                                                            } else if ($row_tl_fee['type'] == "TL MEAL 1X ABF/LUNCH/DINNER") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);

                                                                $price_meal = intval($result_show_kurs['data'] * 3);
                                                                $tl_meal_harga = $result_show_kurs['data'];
                                                                $v_meal = $row_master['hari'] * $price_meal;
                                                            } else if ($row_tl_fee['type'] == "TL VOUCHER TELEPHONE") {
                                                                // konversi kurs
                                                                $datareq = array(
                                                                    "kurs" =>  $row_tl_fee['kurs'],
                                                                    "nominal" => $row_tl_fee['price'],
                                                                );
                                                                $show_kurs = get_kurs($datareq);
                                                                $result_show_kurs = json_decode($show_kurs, true);

                                                                $v_vt = $result_show_kurs['data'];
                                                                $tl_vocer_harga = $result_show_kurs['data'];
                                                            } else {
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $query_tl_fee = "SELECT * FROM  TL_fee where benua='" . $row_p['benua'] . "' && mulai='" . $row_cbng['nama'] . "'";
                                                    $rs_tl_fee = mysqli_query($con, $query_tl_fee);

                                                    while ($row_tl_fee = mysqli_fetch_array($rs_tl_fee)) {
                                                        if ($row_tl_fee['type'] == "TL FEE PER DAY") {
                                                            // konversi kurs
                                                            $datareq = array(
                                                                "kurs" =>  $row_tl_fee['kurs'],
                                                                "nominal" => $row_tl_fee['price'],
                                                            );
                                                            $show_kurs = get_kurs($datareq);
                                                            $result_show_kurs = json_decode($show_kurs, true);
                                                            $tl_fee_harga =  $result_show_kurs['data'];
                                                            $v_fee =  $result_show_kurs['data'] * $row_master['hari'];
                                                        } else if ($row_tl_fee['type'] == "TL FEE SURCHARGE PER DAY") {
                                                            // konversi kurs
                                                            $datareq = array(
                                                                "kurs" =>  $row_tl_fee['kurs'],
                                                                "nominal" => $row_tl_fee['price'],
                                                            );
                                                            $show_kurs = get_kurs($datareq);
                                                            $result_show_kurs = json_decode($show_kurs, true);
                                                            $tl_sfee_harga = $result_show_kurs['data'];
                                                            $v_sfee =  $result_show_kurs['data'] * $row_master['hari'];
                                                        } else if ($row_tl_fee['type'] == "TL MEAL 1X ABF/LUNCH/DINNER") {
                                                            // konversi kurs
                                                            $datareq = array(
                                                                "kurs" =>  $row_tl_fee['kurs'],
                                                                "nominal" => $row_tl_fee['price'],
                                                            );
                                                            $show_kurs = get_kurs($datareq);
                                                            $result_show_kurs = json_decode($show_kurs, true);

                                                            $price_meal = intval($result_show_kurs['data'] * 3);
                                                            $tl_meal_harga = $result_show_kurs['data'];
                                                            $v_meal = $row_master['hari'] * $price_meal;
                                                        } else if ($row_tl_fee['type'] == "TL VOUCHER TELEPHONE") {
                                                            // konversi kurs
                                                            $datareq = array(
                                                                "kurs" =>  $row_tl_fee['kurs'],
                                                                "nominal" => $row_tl_fee['price'],
                                                            );
                                                            $show_kurs = get_kurs($datareq);
                                                            $result_show_kurs = json_decode($show_kurs, true);

                                                            $v_vt = $result_show_kurs['data'];
                                                            $tl_vocer_harga = $result_show_kurs['data'];
                                                        } else {
                                                        }
                                                    }
                                                }
                                            }
                                            $query_master_meal = "SELECT * FROM LT_add_meal  where tour_id=" . $_POST['master_id'];
                                            $rs_master_meal = mysqli_query($con, $query_master_meal);
                                            // var_dump($query_master_meal);
                                            $total_mealcus = 0;
                                            $tmeal_cus = 0;
                                            $detail_meal = "";
                                            while ($row_master_meal = mysqli_fetch_array($rs_master_meal)) {
                                                if ($row_master_meal['bf'] != '0') {
                                                    $hbf = 0;
                                                    $query_bf = "SELECT * FROM Guest_meal  where id=" . $row_master_meal['bf'];
                                                    $rs_bf = mysqli_query($con, $query_bf);
                                                    $row_bf = mysqli_fetch_array($rs_bf);
                                                    $hbf =  $row_bf['harga_idr'];
                                                    $total_mealcus = $total_mealcus + $hbf;
                                                    $detail_meal .= " + " . $row_bf['harga_idr'];
                                                    $tmeal_cus++;
                                                    // var_dump( $total_mealcus);
                                                }
                                                if ($row_master_meal['ln'] != '0') {
                                                    $hln = 0;
                                                    $query_ln = "SELECT * FROM Guest_meal  where id=" . $row_master_meal['ln'];
                                                    $rs_ln = mysqli_query($con, $query_ln);
                                                    $row_ln = mysqli_fetch_array($rs_ln);
                                                    $hln = $row_ln['harga_idr'];
                                                    $detail_meal .= " + " . $row_ln['harga_idr'];
                                                    $total_mealcus = $total_mealcus + $hln;
                                                    $tmeal_cus++;
                                                }
                                                if ($row_master_meal['dn'] != '0') {
                                                    $hdn = 0;
                                                    $query_dn = "SELECT * FROM Guest_meal  where id=" . $row_master_meal['dn'];
                                                    $rs_dn = mysqli_query($con, $query_dn);
                                                    $row_dn = mysqli_fetch_array($rs_dn);
                                                    $hdn = $row_dn['harga_idr'];
                                                    $detail_meal .= " + " . $row_dn['harga_idr'];
                                                    $total_mealcus = $total_mealcus + $hdn;
                                                    $tmeal_cus++;
                                                }
                                                // $total_mealcus = $total_mealcus + $hbf + $hln + $hdn;
                                            }

                                            $data_fl = array(
                                                "master_id" => $_POST['master_id'],
                                                "copy_id" => $_POST['id'],
                                            );
                                            $show_fl = flight_tl($data_fl);
                                            $result_fl = json_decode($show_fl, true);
                                            $flight = $flight + $result_fl['adt'];
                                            // var_dump($result_fl['detail']);

                                            $v_meal_cover = $total_mealcus * -1;


                                            $v_meal_hari_cover = $tmeal_cus * -1;

                                            $total = $v_fee + $v_meal + $v_sfee + $v_vt;

                                            $total_cost_tl = $flight + $tips_flMeal + $landtour + $single_sub + $tips_train + $tips_ferry;
                                            $grand = $grand + $total + $total_cost_tl + $v_meal_cover + $lt_c;
                                            $grandtotal = $grandtotal + ($grand / $pax);
                                        ?>
                                            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#tipsModal<?php echo $row['id']  ?>"><i class="fa fa-eye"></i></i></a>
                                            <div class="modal fade bd-example-modal-lg" id="tipsModal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo  $row['nama'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="fee-tl" style="padding-bottom: 10px;">
                                                                <div><b>FEE TL</b></div>
                                                                <div class="container" style="border: solid 1px; padding: 3px; font-size: 9pt;">
                                                                    <div class="row" style="padding-top: 5px;">
                                                                        <div class="col-md-5">TL FEE PER DAY</div>
                                                                        <div class="col-md-3"><?php echo number_format($tl_fee_harga, 0, ",", ".") . " * " . $row_master['hari'] ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($v_fee, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">TL MEAL</div>
                                                                        <div class="col-md-3"><?php echo number_format($tl_meal_harga, 0, ",", ".") . "* 3 * " . $row_master['hari'] ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($v_meal, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">TL VOCER TLPN</div>
                                                                        <div class="col-md-3"><?php echo number_format($tl_vocer_harga, 0, ",", ".") . " * " . '1' ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($v_vt, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">TL FEE SURCHARGE PER DAY</div>
                                                                        <div class="col-md-3"><?php echo number_format($tl_sfee_harga, 0, ",", ".") . " * " . $row_master['hari'] ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($v_sfee, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5"></div>
                                                                        <div class="col-md-3"></div>
                                                                        <div class="col-md-2"></div>
                                                                        <div class="col-md-2"><b><?php echo number_format($total, 0, ",", ".") ?></b></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cost-tl" style="padding-bottom: 10px;">
                                                                <div><b>COST TL</b></div>
                                                                <div class="container" style="border: solid 1px; padding: 3px; font-size: 9pt;">
                                                                    <div class="row" style="padding-top: 5px;">
                                                                        <div class="col-md-5">FLIGHT</div>
                                                                        <div class="col-md-3"><?php echo number_format($flight, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($flight, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">FLIGHT MEAL</div>
                                                                        <div class="col-md-3"><?php echo number_format($tips_flMeal, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($tips_flMeal, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">FLIGHT TAX</div>
                                                                        <div class="col-md-3">0</div>
                                                                        <div class="col-md-2">0</div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">LANDTOUR</div>
                                                                        <div class="col-md-3"><?php echo number_format($landtour, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($landtour, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">LANDTOUR SINGLE SUP</div>
                                                                        <div class="col-md-3"><?php echo number_format($single_sub, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($single_sub, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">TRAIN</div>
                                                                        <div class="col-md-3"><?php echo number_format($tips_train, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($tips_train, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5">FERRY</div>
                                                                        <div class="col-md-3"><?php echo number_format($tips_ferry, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($tips_ferry, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5"></div>
                                                                        <div class="col-md-3"></div>
                                                                        <div class="col-md-2"></div>
                                                                        <div class="col-md-2"><b><?php echo number_format($total_cost_tl, 0, ",", ".") ?></b></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="fee-tl-covery" style="padding-bottom: 10px;">
                                                                <div><b>FEE TL COVERY</b></div>
                                                                <div class="container" style="border: solid 1px; padding: 3px; font-size: 9pt;">
                                                                    <div class="row" style="padding-top: 5px;">
                                                                        <div class="col-md-5">TL MEAL</div>
                                                                        <div class="col-md-3"><?php echo  $detail_meal . " * -1 " ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($v_meal_cover, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5"></div>
                                                                        <div class="col-md-3"></div>
                                                                        <div class="col-md-2"></div>
                                                                        <div class="col-md-2"><b><?php echo number_format($v_meal_cover, 0, ",", ".") ?></b></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="fee-tl-covery" style="padding-bottom: 10px;">
                                                                <div><b>COST TL COVERY</b></div>
                                                                <div class="container" style="border: solid 1px; padding: 3px; font-size: 9pt;">
                                                                    <div class="row" style="padding-top: 5px;">
                                                                        <div class="col-md-5">LANDTOUR</div>
                                                                        <div class="col-md-3"><?php echo number_format($landtour, 0, ",", ".") . " * " . $pax_covery ?></div>
                                                                        <div class="col-md-2"><?php echo number_format($lt_c, 0, ",", ".") ?></div>
                                                                        <div class="col-md-2"></div>
                                                                    </div>
                                                                    <div class="row" style="padding-top: 3px;">
                                                                        <div class="col-md-5"></div>
                                                                        <div class="col-md-3"></div>
                                                                        <div class="col-md-2"></div>
                                                                        <div class="col-md-2"><b><?php echo number_format($lt_c, 0, ",", ".") ?></b></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="grand" style="padding-bottom: 10px;">
                                                                <div class="container" style=" padding: 3px;">
                                                                    <div class="row" style="padding-top: 5px;">
                                                                        <div class="col-md-5"></div>
                                                                        <div class="col-md-3"><?php echo number_format($grand, 0, ",", ".") . " : " . $pax  ?></div>
                                                                        <div class="col-md-2"></div>
                                                                        <div class="col-md-2"><b><?php echo number_format($grandtotal, 0, ",", ".") ?></b></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>TOTAL</th>
                                <th></th>
                                <th><?php echo number_format($total_twn, 0, ",", ".") ?></th>
                                <th><?php echo number_format($total_chd, 0, ",", ".") ?></th>
                                <th><?php echo number_format($total_inf, 0, ",", ".") ?></th>
                                <th><?php echo number_format($total_sgl, 0, ",", ".") ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 10,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.form-check-input').click(function() {

            var target = $(this).val();
            if (target == 0) {
                $('.flight').show();
                $('.ferry').hide();
                $('.train').hide();
                $('.land').hide();
                // $('.tl-fee').hide();

            } else if (target == 1) {
                $('.flight').hide();
                $('.ferry').show();
                $('.train').hide();
                $('.land').hide();
                // $('.tl-fee').hide();
            } else if (target == 2) {
                $('.rute').hide();
                $('.ferry').hide();
                $('.train').show();
                $('.land').hide();
                // $('.tl-fee').hide();
            } else if (target == 3) {
                $('.rute').hide();
                $('.ferry').hide();
                $('.train').hide();
                $('.land').show();
                // $('.tl-fee').hide();
            } else {

            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $.ajax({
                url: "LT_transport_field.php",
                method: "POST",
                asynch: false,
                data: {
                    i: i
                },
                success: function(data) {
                    $('#dynamic_field').append(data);
                }
            });
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            // const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            // const id = $button.data('id');
            // const hari = $modalBody.find($("input[name=hari]")).val();
            // const rute = $modalBody.find($("input[name=rute]")).val();

            // let formData = new FormData();
            // formData.append('id', id);
            // formData.append('hari', hari);
            // formData.append('rute', rute);
            // // work with the values here:
            // $.ajax({
            //     type: 'POST',
            //     url: "add_LT_hari.php",
            //     data: formData,
            //     cache: false,
            //     processData: false,
            //     contentType: false,
            //     success: function(msg) {
            //         alert(msg);
            //         LT_itinerary(8,id,0);
            //     },
            //     error: function() {
            //         alert("Data Gagal Diupload");
            //     }
            // });
            //  console.log(id, hari, rute);

        });
    });
</script>