<?php
include "../db=connection.php";
$id = $_POST['id'];
$tour = $_POST['tour'];
$total = $_POST['total'];
$itin = $_POST['itin'];

// var_dump("onn");
$query_tour = "SELECT * FROM  Prev_makeLT where id=" . $itin;
$rs_tour = mysqli_query($con, $query_tour);
$row_tour = mysqli_fetch_assoc($rs_tour);
$val_data = json_decode($row_tour['data'], true);
$json_day = $val_data['day'];
$jml_day = $val_data['jml_day'];

//  var_dump($json_day);
$query = "SELECT * FROM  LT_itinnew where id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($rs);
$lt_price = intval($row['twn']);
$pax = intval($row['pax']) + intval($row['pax_b']);
?>
</br>
<div>
    Total Pax : <?php echo $row['pax'] ?> + <?php echo $row['pax_b'] ?>
</div>
<div>
    jumlah Hari : <?php echo $jml_day ?>
</div>
</br>
<div>Meal</div>
<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">keterangan</th>
                <th scope="col">price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $d = 1;
            foreach ($json_day as $loop_day) {
            ?>
                <tr>
                    <th scope="row">day <?php echo $d ?></th>
                    <td>
                        <?php
                        $query_tl_meal = "SELECT * FROM  TL_itin where id='" . $loop_day['tl_meal'] . "'";
                        $rs_tl_meal = mysqli_query($con, $query_tl_meal);
                        $row_tl_meal = mysqli_fetch_array($rs_tl_meal);

                        echo "b : ".$loop_day['guest_breakfast']."</br>";
                        echo "l : ".$loop_day['guest_lunch']."</br>";
                        echo "d : ".$loop_day['guest_dinner']."</br>";
                        ?>
                    </td>
                    <td>yy</td>
                </tr>
            <?php
                $d++;
            }
            ?>


        </tbody>
    </table>
</div>




<?php
// // var_dump($json_day);
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
    $arr_fl_meal =[];
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
        $query_plane = "SELECT * FROM LT_add_flight where tour_id=" . $itin;
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
                            $meal_fl = intval($row_flight2['bf'])+intval($row_flight2['ln'])+intval($row_flight2['dn']);

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
                        }else if($sel_tr['transport_type'] == "train"){
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

    // lt 
    $query = "SELECT * FROM  LT_itinnew where id=" . $tour;
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
    // $plane = intval($adt);
    // $fee_tl = intval($fee) + intval($sfee) + intval($meal);
    // $cost_tl = $plane + $lt_price + $tr;
    // $fee_tl_covery = intval($meal);
    // $cost_tl_covery = intval($row['twn']);

    // $total_fee_tl = $fee_tl - $fee_tl_covery;
    // $total_cost_tl = $cost_tl - $cost_tl_covery;

    // $fe_d_cost_tl = $total_fee_tl + $total_cost_tl;
    // $fe_d_cost_tl_pax = $fe_d_cost_tl / $pax;

    // echo json_encode(array("detail" => "", "price" => $fe_d_cost_tl_pax));
    // var_dump("+++++++" . $total_meal);


    $v_meal = $price_meal * ($total_meal * 3);
    $vfee_tl = $sfee + $pr_vt + $meal + $fee;
    $vcost_tl = array_sum($arr_plane) + $lt_price + array_sum($arr_ferry) + array_sum($arr_train);
    $meal_cover = ($total_meal2 * $price_meal) * -1;



    $lt_cover_sub = $pax_covery * $lt_price_sub;
    $plane_cover =  array_sum($arr_plane) * 0;
    $ferry_cover =  array_sum($arr_ferry) * 0;
    $train_cover =  array_sum($arr_train) * 0;
    $vcost_cov = $plane_cover + $lt_cover + $lt_cover_sub +$ferry_cover+$train_cover;

    $total_final_f = $vfee_tl + $meal_cover;
    $total_final_c = $vcost_tl + $vcost_cov;
    $fedancost = $total_final_f + $total_final_c;
    $ttpax = ($total_final_f + $total_final_c) / intval($row['pax']);
   
} else {
    echo "data empty";
}
?>
<!-- <div>
    page on nihh
</div> -->