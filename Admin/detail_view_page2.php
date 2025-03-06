<?php
include "../db=connection.php";
$id = $_POST['id'];
$cabang = $_POST['cabang'];
$total = $_POST['total'];
$itin = $_POST['itin'];
$lt_hotel = $_POST['lt_hotel'];
// var_dump($id);
// var_dump("onn");
$query_tour = "SELECT * FROM  Prev_makeLT where id=" . $itin;
$rs_tour = mysqli_query($con, $query_tour);
$row_tour = mysqli_fetch_assoc($rs_tour);
$val_data = json_decode($row_tour['data'], true);
$json_day = $val_data['day'];
$jml_day = $val_data['jml_day'];
// var_dump($json_day);
if ($id == 32) {

    $d = 1;
    $day = [];
    $x = 1;
    $fee   = 0;
    $sfee  = 0;
    $vocer = 0;
    $meal = 0;
    $total_meal = 0;
    $total_meal2 = 0;
    $total_fee = 0;
    $total_sfee = 0;
    $total_plane = 0;
    $total_ferr = 0;
    $total_train = 0;
    $pr_vt = '';
    $arr_meal = [];
    $arr_sfee = [];
    $arr_fee = [];
    $arr_plane = [];
    $arr_fl_tax = [];
    $arr_fl_meal = [];
    $arr_fl_bagasi = [];
    $arr_ferry = [];
    $arr_train = [];


    foreach ($json_day as $loop_day) {
        $query_tl_fee = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_fee'] . "'";
        $rs_tl_fee = mysqli_query($con, $query_tl_fee);
        $row_tl_fee = mysqli_fetch_array($rs_tl_fee);
        if ($row_tl_fee['id'] != "") {
            $total_meal2++;
        }

        $query_meal = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_breakfast'];
        $rs_meal = mysqli_query($con, $query_meal);
        $row_meal = mysqli_fetch_assoc($rs_meal);
        if ($row_meal['id'] != "") {
            $total_meal2++;
        }

        $query_ln = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_lunch'];
        $rs_ln = mysqli_query($con, $query_ln);
        $row_ln = mysqli_fetch_assoc($rs_ln);
        if ($row_ln['id'] != "") {
            $total_meal2++;
        }
        $query_dn = "SELECT * FROM  Guest_meal where id=" . $loop_day['guest_dinner'];
        $rs_dn = mysqli_query($con, $query_dn);
        $row_dn = mysqli_fetch_assoc($rs_dn);

        array_push($arr_fee, $row_tl_fee['price']);
        if ($loop_day['tl_fee'] != null) {
            $total_fee++;
        }
        if ($loop_day['tl_sfee'] != null) {
            $total_sfee++;
        }
        if ($loop_day['tl_meal'] != null) {
            $total_meal++;
        }


        $query_tl_sfee = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_sfee'] . "'";
        $rs_tl_sfee = mysqli_query($con, $query_tl_sfee);
        $row_tl_sfee = mysqli_fetch_array($rs_tl_sfee);

        array_push($arr_sfee, $row_tl_sfee['price']);

        if ($loop_day['tl_vt'] != null) {
            $query_tl_vt = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_vt'] . "'";
            $rs_tl_vt = mysqli_query($con, $query_tl_vt);
            $row_tl_vt = mysqli_fetch_array($rs_tl_vt);
            $pr_vt = $row_tl_vt['harga'];
        }



        $query_tl_meal = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_meal'] . "'";
        $rs_tl_meal = mysqli_query($con, $query_tl_meal);
        $row_tl_meal = mysqli_fetch_array($rs_tl_meal);
        $price_meal = intval($row_tl_meal['price']);

        $tl_fee_price = $row_tl_fee['price'];
        $tl_fee_detail = $row_tl_fee['type'];

        $fee = $fee + intval($row_tl_fee['price']);
        $sfee = $sfee  + intval($row_tl_sfee['price']);
        $meal = $meal + (intval($row_tl_meal['price']) * 3);
        array_push($arr_meal, $row_tl_meal['price']);

        // flight
        $query_plane = "SELECT * FROM LT_add_flight where tour_id='".$itin."' && ket=".$cabang;
        $rs_plane = mysqli_query($con, $query_plane);
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            $value_add = json_decode($row_plane['value'], TRUE);
            foreach ($value_add as $loop_add) {
                if ($loop_add['hari'] == $x && $loop_add['jml_transport'] != "") {

                    foreach ($loop_add['sel_trans'] as $sel_tr) {
                        if ($sel_tr['transport_type'] == "flight") {
                            $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $sel_tr['transport_name'];
                            $rs_flight2 = mysqli_query($con, $query_flight2);
                            $row_flight2 = mysqli_fetch_array($rs_flight2);
                            // var_dump($query_flight2);
                            $adt = $adt + intval($row_flight2['adt']);
                            $chd = $chd + intval($row_flight2['chd']);
                            $inf = $inf + intval($row_flight2['inf']);
                            $meal_fl = intval($row_flight2['bf']) + intval($row_flight2['ln']) + intval($row_flight2['dn']);

                            array_push($arr_plane, intval($row_flight2['adt']));
                            array_push($arr_fl_tax, intval($row_flight2['tax']));
                            array_push($arr_fl_meal, intval($meal_fl));
                            array_push($arr_fl_bagasi, intval($row_flight2['bagasi_price']));
                            $total_plane++;
                        } else if ($sel_tr['transport_type'] == "ferry") {
                            $query_ferry = "SELECT * FROM ferry_LT  where id=" . $sel_tr['transport_name'];
                            $rs_ferry = mysqli_query($con, $query_ferry);
                            $row_ferry = mysqli_fetch_array($rs_ferry);
                            array_push($arr_ferry, intval($row_ferry['adult']));
                            $total_ferr++;
                        } else if ($sel_tr['transport_type'] == "train") {
                            array_push($arr_train, intval($sel_tr['adult']));
                            $total_train++;
                        } else {
                        }
                    }
                }
            }
        }

        $d++;
        $x++;
    }
    // visa
    $query_visa = "SELECT * FROM  LT_add_visa where tour_id='" . $itin . "' order by tgl ASC";
    $rs_visa = mysqli_query($con, $query_visa);
    $row_visa = mysqli_fetch_array($rs_visa);
    $visa_price = $row_visa['price'];
    $visa_ket = $row_visa['ket'];

    // lt 
    $query = "SELECT * FROM  LT_itinnew where id=" . $lt_hotel;
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($rs);
    $lt_price = intval($row['agent_twn']);
    $lt_price_sub = intval($row['agent_sglsub']);
    $lt_code = $row['kode'];
    $pax = intval($row['pax']) + intval($row['pax_b']);
    $pax_u = "";
    $pax_b = "";
    $pax_covery = -1 * intval($row['pax_b']);
    if ($row['pax_u'] != 0) {
        $pax_u = "-" . $row['pax_u'];
    }
    if ($row['pax_b'] != 0) {
        $pax_b = "+" . $row['pax_b'];
    }
    $detail_pax =  $row['pax'] . $pax_u . $pax_b;


    $tr = 0;
    $plane = intval($adt);
    $fee_tl = intval($fee) + intval($sfee) + intval($meal);
    $cost_tl = $plane + $lt_price + $tr;
    $fee_tl_covery = intval($meal);
    $cost_tl_covery = intval($row['twn']);

    $total_fee_tl = $fee_tl - $fee_tl_covery;
    $total_cost_tl = $cost_tl - $cost_tl_covery;

    $fe_d_cost_tl = $total_fee_tl + $total_cost_tl;
    $fe_d_cost_tl_pax = $fe_d_cost_tl / $pax;

    // echo json_encode(array("detail" => "", "price" => $fe_d_cost_tl_pax));
    // var_dump("+++++++" . $total_meal);

?>
    <div>FEE TL</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">NAMA</th>
                <th scope="col">JML</th>
                <th scope="col">DETAIL</th>
                <th scope="col">PRICE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2101</td>
                <td>FEE PERDAY</td>
                <td><?php echo $total_fee ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_fee as $val_fee) {
                        echo $val_fee . " + ";
                    }
                    ?>
                </td>
                <td><?php echo $fee ?></td>
            </tr>
            <tr>
                <td>2103</td>
                <td>MEAL</td>
                <td><?php echo $total_meal * 3; ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_meal as $val_meal) {
                        echo $val_meal . " + ";
                    }
                    ?>
                </td>
                <td><?php echo $v_meal = $price_meal * ($total_meal * 3); ?></td>
            </tr>
            <tr>
                <td>2104</td>
                <td>VOCER TLPN</td>
                <td>
                    <?php if ($pr_vt != null) {
                        echo 1;
                    } else {
                        echo 0;
                    } ?>
                </td>
                <td><?php echo  $pr_vt ?></td>
                <td><?php echo  $pr_vt ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>S FEE PERDAY</td>
                <td><?php echo $total_sfee ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_sfee as $val_sfee) {
                        echo $val_sfee . " + ";
                    }
                    ?>
                </td>
                <td><?php echo $sfee ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td>
                </td>
                <td><?php echo $vfee_tl = $sfee + $pr_vt + $meal + $fee; ?></td>
            </tr>
        </tbody>
    </table></br>
    <div>COST TL</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">NAMA</th>
                <th scope="col">JML</th>
                <th scope="col">DETAIL</th>
                <th scope="col">PRICE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2101</td>
                <td>FLIGHT</td>
                <td><?php echo $total_plane ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_plane as $val_plane) {
                        echo $val_plane . " + ";
                    }
                    ?>
                </td>
                <td><?php echo array_sum($arr_plane) ?></td>
            </tr>
            <tr>
                <td>2103</td>
                <td>FLIGHT TAX</td>
                <td><?php echo $total_plane ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_fl_tax as $val_tax) {
                        echo $val_tax . " + ";
                    }
                    ?>
                </td>
                <td><?php echo array_sum($arr_fl_tax) ?></td>
            </tr>
            <tr>
                <td>2104</td>
                <td>FLIGHT MEAL</td>
                <td>
                    <?php echo $total_plane ?>
                </td>
                <td>
                    <?php
                    foreach ($arr_fl_meal as $val_fl_meal) {
                        echo $val_fl_meal . " + ";
                    }
                    ?>
                </td>
                <td><?php echo array_sum($arr_fl_meal) ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>FLIGHT BAGGAGE</td>
                <td><?php echo $total_plane ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_fl_bagasi as $val_fl_bagasi) {
                        echo $val_fl_bagasi . " + ";
                    }
                    ?>
                </td>
                <td><?php echo array_sum($arr_fl_bagasi) ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>LANDTOUR</td>
                <td><?php echo $detail_pax ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    echo  $lt_code;
                    ?>
                </td>
                <td><?php echo $lt_price ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>TRAIN</td>
                <td><?php echo $total_train ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_train as $val_train) {
                        echo $val_train . " + ";
                    }
                    ?>
                </td>
                <td><?php echo array_sum($arr_train) ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>FERRY</td>
                <td><?php echo $total_ferr ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_ferry as $val_ferry) {
                        echo $val_ferry . " + ";
                    }
                    ?>
                </td>
                <td><?php echo array_sum($arr_ferry) ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>VISA</td>
                <td></td>
                <td style="font-size: 8pt;">
                    <?php echo $visa_ket;
                    ?>
                </td>
                <td><?php echo $visa_price ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td>
                </td>
                <td><?php echo $vcost_tl = array_sum($arr_plane) + $lt_price + array_sum($arr_ferry) + array_sum($arr_train) + $visa_price; ?></td>
            </tr>
        </tbody>
    </table></br>
    <div>FEE TL COVERY</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">NAMA</th>
                <th scope="col">JML</th>
                <th scope="col">DETAIL</th>
                <th scope="col">PRICE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2103</td>
                <td>MEAL</td>
                <td><?php

                    echo  $total_meal2 * -1;
                    ?></td>
                <td style="font-size: 8pt;">

                </td>
                <td><?php
                    $meal_cover = ($total_meal2 * $price_meal) * -1;
                    echo $meal_cover; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td>
                </td>
                <td><?php echo $meal_cover; ?></td>
            </tr>
        </tbody>
    </table></br>
    <div>COST TL COVERY</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">NAMA</th>
                <th scope="col">JML</th>
                <th scope="col">DETAIL</th>
                <th scope="col">PRICE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2101</td>
                <td>FLIGHT</td>
                <td><?php echo $total_plane ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_plane as $val_plane) {
                        echo $val_plane . " + ";
                    }
                    ?>
                </td>
                <td><?php
                    $plane_cover =  array_sum($arr_plane) * 0;
                    echo $plane_cover ?></td>
            </tr>
            <tr>
                <td>2103</td>
                <td>FLIGHT TAX</td>
                <td><?php echo $total_plane ?></td>
                <td style="font-size: 8pt;">
                </td>
                <td></td>
            </tr>
            <tr>
                <td>2104</td>
                <td>FLIGHT MEAL</td>
                <td><?php echo $total_plane ?></td>
                <td><?php echo  $pr_vt ?></td>
                <td><?php echo  $pr_vt ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>FLIGHT BAGGAGE</td>
                <td></td>
                <td style="font-size: 8pt;">

                </td>
                <td></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>LANDTOUR</td>
                <td><?php echo $detail_pax ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    echo  $lt_code;
                    ?>
                </td>
                <td><?php
                    $lt_cover = $pax_covery * $lt_price;
                    echo $lt_cover ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>LANDTOUR SGL SUB</td>
                <td><?php echo $detail_pax ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    echo  $lt_code;
                    ?>
                </td>
                <td><?php
                    $lt_cover_sub = $pax_covery * $lt_price_sub;
                    echo $lt_cover_sub ?></td>
            </tr>
            <tr>
                <td>2105</td>
                <td>TRAIN</td>
                <td><?php echo $total_train ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_train as $val_train) {
                        echo $val_train . " + ";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $train_cover =  array_sum($arr_train) * 0;
                    echo $train_cover ?>
                </td>
            </tr>
            <tr>
                <td>2105</td>
                <td>FERRY</td>
                <td><?php echo $total_ferr ?></td>
                <td style="font-size: 8pt;">
                    <?php
                    foreach ($arr_ferry as $val_ferry) {
                        echo $val_ferry . " + ";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $ferry_cover =  array_sum($arr_ferry) * 0;
                    echo $ferry_cover ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td>
                </td>
                <td><?php echo $vcost_cov = $plane_cover + $lt_cover + $lt_cover_sub + $ferry_cover + $train_cover; ?></td>
            </tr>
        </tbody>
    </table></br>
    <?php
    $total_final_f = $vfee_tl + $meal_cover;
    $total_final_c = $vcost_tl + $vcost_cov;
    ?>
    <div>Fee TL: <?php echo number_format($total_final_f, 0, ",", "."); ?></div>
    <div>Cost TL: <?php echo number_format($total_final_c, 0, ",", "."); ?></div>
    <div>Total Fee & Cost TL: <?php echo  number_format($total_final_f + $total_final_c, 0, ",", "."); ?></div>
    <div>Total/ Pax: <?php echo number_format(($total_final_f + $total_final_c) / intval($row['pax']), 0, ",", ".") ?></div>
<?php
} else {
    echo "data empty";
}
