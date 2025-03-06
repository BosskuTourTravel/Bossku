<?php
session_start();
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "../slug.php";
// include "Api_get_hotel_lt_range.php";

$query_rent2 = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package=" . $_POST['id'] . "  order by Rent_selected.id ASC";
$rs_rent2 = mysqli_query($con, $query_rent2);
$gt_rent = 0;
// var_dump($query_rent2);
while ($row_rent2 = mysqli_fetch_array($rs_rent2)) {
    $datareq = array(
        "kurs" =>  $row_rent2['kurs'],
        "nominal" => $row_rent2['price'],
    );
    $adt_kurs = get_kurs($datareq);
    $rs_adt_kurs = json_decode($adt_kurs, true);

    if (isset($rs_adt_kurs['data'])) {

        $idr = $rs_adt_kurs['data'];
        $sql_profit = "SELECT * FROM LTR_profit_range where price1 <='" . $idr . "' && price2 >='" . $idr . "'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);
        if (isset($row_profit['id'])) {
            $pr = $row_profit['profit'];
        }
        $persen = intval($pr) / 100;
        $p_oneway = intval($idr) + (intval($idr) * $persen);
        $gt_rent = $gt_rent + $p_oneway;
        //  var_dump(intval($idr) ." + ". "(".intval($idr) ." * ". $persen.")");
    }

}
$bagi = $_POST['pax'] - $_POST['pilihan'] - $_POST['foc'];
$total =  $gt_rent / $bagi;
// var_dump("rent++++".$gt_rent ."/".$bagi."</br>");

$query_guide = "SELECT * FROM  LT_add_guide_price  where tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'";
$rs_guide = mysqli_query($con, $query_guide);
$grand_guide = 0;
// var_dump($query_guide);
while ($row_guide = mysqli_fetch_array($rs_guide)) {
    $fee_price = 0;
    $sfee_price = 0;
    $bf_price = 0;
    $ln_price = 0;
    $dn_price = 0;
    $vt_price = 0;

    $query_fee = "SELECT * FROM Guide_Meal where id='" . $row_guide['fee'] . "'";
    $rs_fee = mysqli_query($con, $query_fee);
    $row_fee = mysqli_fetch_array($rs_fee);
    if (isset($row_fee['id'])) {
        $fee_price = $row_fee['harga'];
    }

    $query_sfee = "SELECT * FROM Guide_Meal where id='" . $row_guide['sfee'] . "'";
    $rs_sfee = mysqli_query($con, $query_sfee);
    $row_sfee = mysqli_fetch_array($rs_sfee);
    if (isset($row_sfee['id'])) {
        $sfee_price = $row_sfee['harga'];
    }

    $query_bf = "SELECT * FROM Guide_Meal where id='" . $row_guide['bf'] . "'";
    $rs_bf = mysqli_query($con, $query_bf);
    $row_bf = mysqli_fetch_array($rs_bf);
    if (isset($row_bf['id'])) {
        $bf_price = $row_bf['harga'];
    }

    $query_ln = "SELECT * FROM Guide_Meal where id='" . $row_guide['ln'] . "'";
    $rs_ln = mysqli_query($con, $query_ln);
    $row_ln = mysqli_fetch_array($rs_ln);
    if (isset($row_ln['id'])) {
        $ln_price = $row_ln['harga'];
    }

    $query_dn = "SELECT * FROM Guide_Meal where id='" . $row_guide['dn'] . "'";
    $rs_dn = mysqli_query($con, $query_dn);
    $row_dn = mysqli_fetch_array($rs_dn);
    if (isset($row_dn['id'])) {
        $dn_price = $row_dn['harga'];
    }

    $query_vt = "SELECT * FROM Guide_Meal where id='" . $row_guide['vt'] . "'";
    $rs_vt = mysqli_query($con, $query_vt);
    $row_vt = mysqli_fetch_array($rs_vt);
    if (isset($row_vt['id'])) {
        $vt_price = $row_vt['harga'];
    }

    $guide_total = $fee_price + $sfee_price + $bf_price + $ln_price + $dn_price + $vt_price;
}

/////// hotel //////////////////////////////////////////////////////////////////////////////////
$val_guest_hotel = $_POST['guest_hotel'];
$show_guest_hotel = get_hotel_lt_price($val_guest_hotel);
$result_guest_hotel = json_decode($show_guest_hotel, true);

$gprice = $result_guest_hotel['price'];
$val_hotel = $result_guest_hotel['price'] / 2;

if ($_POST['guide_hotel'] == 0) {
    $val_hotel_guide = $result_guest_hotel['price'];
    $gprice_guide = $result_guest_hotel['price'];
} else {
    $val_guide_hotel = $_POST['guide_hotel'];
    $show_guide_hotel = get_hotel_lt_price($val_guide_hotel);
    $result_guide_hotel = json_decode($show_guide_hotel, true);
    $val_hotel_guide = $result_guide_hotel['price'];
    $gprice_guide = $result_guide_hotel['price'];
}
if ($_POST['foc_hotel'] == 0) {
    $val_hotel_foc = $val_hotel;
    $gprice_foc = $result_guest_hotel['price'];
    // echo "ffsfs :".$gprice_foc;
} else {
    $val_foc_hotel = $_POST['foc_hotel'];
    $show_foc_hotel = get_hotel_lt_price($val_foc_hotel);
    $result_foc_hotel = json_decode($show_foc_hotel, true);

    $val_hotel_foc = $result_foc_hotel['price'] / 2;
    $gprice_foc = $result_foc_hotel['price'];
}




///////////////////////////////////////////////////////////////////////////////////
$query_guide2 = "SELECT * FROM  LT_add_guide_price  where tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'";
$rs_guide2 = mysqli_query($con, $query_guide2);
// var_dump($query_guide2);
$n = 1;
$grand_guide2 = 0;
$grand_foc = 0;

while ($row_guide2 = mysqli_fetch_array($rs_guide2)) {
    $fee_price2 = 0;
    $sfee_price2 = 0;
    $bf_price2 = 0;
    $ln_price2 = 0;
    $dn_price2 = 0;
    $vt_price2 = 0;
    $query_fee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['fee'] . "'";
    $rs_fee2 = mysqli_query($con, $query_fee2);
    $row_fee2 = mysqli_fetch_array($rs_fee2);
    if (isset($row_fee2['id'])) {
        $data_fee2 = array(
            "kurs" =>  $row_fee2['kurs'],
            "price" => $row_fee2['harga'],
        );
        $show_fee2 = get_rate($data_fee2);
        $result_fee2 = json_decode($show_fee2, true);

        $fee_price2 = $result_fee2['price'];
    }

    $query_sfee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['sfee'] . "'";
    $rs_sfee2 = mysqli_query($con, $query_sfee2);
    $row_sfee2 = mysqli_fetch_array($rs_sfee2);
    if (isset($row_sfee2['id'])) {
        $data_sfee2 = array(
            "kurs" =>  $row_sfee2['kurs'],
            "price" => $row_sfee2['harga'],
        );
        $show_sfee2 = get_rate($data_sfee2);
        $result_sfee2 = json_decode($show_sfee2, true);
        $sfee_price2 = $result_sfee2['price'];
    }

    $query_bf2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['bf'] . "'";
    $rs_bf2 = mysqli_query($con, $query_bf2);
    $row_bf2 = mysqli_fetch_array($rs_bf2);
    if (isset($row_bf2['id'])) {
        $data_bf2 = array(
            "kurs" =>  $row_bf2['kurs'],
            "price" => $row_bf2['harga'],
        );
        $show_bf2 = get_rate($data_bf2);
        $result_bf2 = json_decode($show_bf2, true);

        $bf_price2 = $result_bf2['price'];
    }

    $query_ln2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['ln'] . "'";
    $rs_ln2 = mysqli_query($con, $query_ln2);
    $row_ln2 = mysqli_fetch_array($rs_ln2);
    if (isset($row_ln2['id'])) {
        $data_ln2 = array(
            "kurs" =>  $row_ln2['kurs'],
            "price" => $row_ln2['harga'],
        );
        $show_ln2 = get_rate($data_ln2);
        $result_ln2 = json_decode($show_ln2, true);
        $ln_price2 = $result_ln2['price'];
    }

    $query_dn2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['dn'] . "'";
    $rs_dn2 = mysqli_query($con, $query_dn2);
    $row_dn2 = mysqli_fetch_array($rs_dn2);
    if (isset($row_dn2['id'])) {
        $data_dn2 = array(
            "kurs" =>  $row_dn2['kurs'],
            "price" => $row_dn2['harga'],
        );
        $show_dn2 = get_rate($data_dn2);
        $result_dn2 = json_decode($show_dn2, true);
        $dn_price2 = $result_dn2['price'];
    }

    $query_vt2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['vt'] . "'";
    $rs_vt2 = mysqli_query($con, $query_vt2);
    $row_vt2 = mysqli_fetch_array($rs_vt2);
    if (isset($row_vt2['id'])) {
        $data_vt2 = array(
            "kurs" =>  $row_vt2['kurs'],
            "price" => $row_vt2['harga'],
        );
        $show_vt2 = get_rate($data_vt2);
        $result_vt2 = json_decode($show_vt2, true);

        $vt_price2 = $result_vt2['price'];
    }

    $guide_total2 = $fee_price2 + $sfee_price2 + $bf_price2 + $ln_price2 + $dn_price2 + $vt_price2;
    $grand_guide2 = $grand_guide2 + $guide_total2;
    $grand_foc = $grand_foc + $bf_price2 + $ln_price2 + $dn_price2;
    // var_dump($fee_price2 ."+". $sfee_price2 ."+". $bf_price2 ."+". $ln_price2 ."+". $dn_price2 ."+". $vt_price2."</br>");
    // var_dump($grand_guide2."</br>");
}

if ($_POST['val_meal'] == 1) {
    $guest_meal = $_POST['guest_meal_price'];
} else {
    $guest_meal = 0;
}
if ($_POST['val_adm'] == 1) {
    $adm_price = $_POST['adm_price'];
} else {
    $adm_price = 0;
}



$val_guide = $_POST['pilihan'] * ($grand_guide2 / $bagi);
$val_foc = $_POST['foc'] * ($grand_foc / $bagi);
$guide_adm = $_POST['pilihan'] * ($adm_price / $bagi);
$foc_adm = $_POST['foc'] * ($adm_price / $bagi);
$guide_hotel = $_POST['pilihan'] * ($val_hotel_guide / $bagi);
$foc_hotel = $_POST['foc'] * ($val_hotel_foc / $bagi);



// $t = $gt + $grand_guide;
// var_dump($query_rent2);


?>
<table class="table table-striped table-sm" style="font-size: 12px;">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Detail</th>
            <th scope="col">PRICE (TWN)</th>
            <th scope="col">SGL</th>
            <th scope="col">CNB</th>
            <th scope="col">INF</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Guest Meal</td>
            <td><?php echo number_format($guest_meal) ?></td>
            <td><?php echo "IDR " . number_format($guest_meal) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Guest Admission</td>
            <td><?php echo number_format($adm_price) ?></td>
            <td><?php echo "IDR " . number_format($adm_price) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Guide Admission</td>
            <td><?php echo $_POST['pilihan'] . " * (" . number_format($adm_price) . " / " . $bagi . " PAX )"; ?></td>
            <td><?php echo "IDR " . number_format($guide_adm) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Foc Admission</td>
            <td><?php echo $_POST['foc'] . " * (" . number_format($adm_price) . " / " . $bagi . " PAX )"; ?></td>
            <td><?php echo "IDR " . number_format($foc_adm) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Hotel</td>
            <td><?php echo number_format($gprice) . " / 2" ?></td>
            <td><?php echo "IDR " . number_format($val_hotel) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Hotel Guide</td>
            <td><?php echo  $_POST['pilihan'] . " * (" . number_format($gprice_guide) . " / " . $bagi . ")" ?></td>
            <td><?php echo "IDR " . number_format($guide_hotel) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Hotel FOC</td>
            <td><?php echo  $_POST['foc'] . " * (" . number_format($gprice_foc) . " / 2 ) / " . $bagi ?></td>
            <td><?php echo "IDR " . number_format($foc_hotel) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>8</td>
            <td>Guide</td>
            <td><?php echo $_POST['pilihan'] . " * (" . number_format($grand_guide2) . " / " . $bagi . " PAX )"; ?></td>
            <td><?php echo "IDR " . number_format($val_guide) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>9</td>
            <td>FOC </td>
            <td><?php echo $_POST['foc'] . " * (" . number_format($grand_foc) . " / " . $bagi . " PAX )"; ?></td>
            <td><?php echo "IDR " . number_format($val_foc) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Rent Transport</td>
            <td><?php echo number_format($gt_rent) . " / " . $bagi . " PAX" ?></td>
            <td><?php echo "IDR " . number_format($total) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
    <?php
    $gt = $total + $val_hotel + $val_guide + $val_foc + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal + $adm_price;
    $gt_sgl = $total + $gprice + $val_guide + $val_foc + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal + $adm_price;
    $gt_cnb = $total + $val_guide + $val_foc + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal + $adm_price;
    $gt_inf = $val_guide + $val_foc + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal;
    ?>
    <tfoot>
        <tr>
            <td></td>
            <th>TOTAL</th>
            <td></td>
            <th><?php echo "IDR " . number_format($gt) ?></th>
            <th><?php echo "IDR " . number_format($gt_sgl) ?></th>
            <th><?php echo "IDR " . number_format($gt_cnb) ?></th>
            <th><?php echo "IDR " . number_format($gt_inf) ?></th>
        </tr>
    </tfoot>

</table>
<div class="row">
    <div class="col-md-6">
        <form class="form-inline" action="cetak_LT_custom_all.php?id=<?php echo $_POST['id'] ?>&tour_id=<?php echo $_POST['tourid'] ?>" target="_blank" method="POST">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" id="num_pax" name="num_pax" placeholder="1,2,3,6,7,9">
            </div>

            <input type="hidden" name="guest_meal" id="guest_meal" value="<?php echo $_POST['guest_meal_price'] ?>">
            <input type="hidden" name="adm_price" id="adm_price" value="<?php echo $_POST['adm_price'] ?>">
            <input type="hidden" name="guest_hotel" id="guest_hotel" value="<?php echo $_POST['guest_hotel'] ?>">
            <input type="hidden" name="guide_hotel" id="guide_hotel" value="<?php echo $_POST['guide_hotel'] ?>">
            <input type="hidden" name="foc_hotel" id="foc_hotel" value="<?php echo $_POST['foc_hotel'] ?>">
            <input type="hidden" name="val_meal" id="val_meal" value="<?php echo $_POST['val_meal'] ?>">
            <input type="hidden" name="val_adm" id="val_adm" value="<?php echo $_POST['val_adm'] ?>">

            <input type="hidden" name="guide" id="guide" value="<?php echo  $_POST['pilihan'] ?>">
            <input type="hidden" name="foc" id="foc" value="<?php echo $_POST['foc'] ?>">
            <input type="hidden" name="val_adm_price" id="val_adm_price" value="<?php echo $adm_price ?>">
            <input type="hidden" name="val_guest_meal_price" id="val_guest_meal_price" value="<?php echo $guest_meal ?>">
            <button type="submit" class="btn btn-danger mb-2"><i class="fa fa-print"> Print</i></button>
        </form>
    </div>
    <div class="col-md-3">
        <form class="form-inline" action="cetak_LT_custom_all2.php?id=<?php echo $_POST['id'] ?>&tour_id=<?php echo $_POST['tourid'] ?>" target="_blank" method="POST">
            <input type="hidden" id="num_pax" name="num_pax" value="<?php echo $_POST['seat'] ?>">
            <input type="hidden" name="guest_meal" id="guest_meal" value="<?php echo $_POST['guest_meal_price'] ?>">
            <input type="hidden" name="adm_price" id="adm_price" value="<?php echo $_POST['adm_price'] ?>">
            <input type="hidden" name="guest_hotel" id="guest_hotel" value="<?php echo $_POST['guest_hotel'] ?>">
            <input type="hidden" name="guide_hotel" id="guide_hotel" value="<?php echo $_POST['guide_hotel'] ?>">
            <input type="hidden" name="foc_hotel" id="foc_hotel" value="<?php echo $_POST['foc_hotel'] ?>">
            <input type="hidden" name="val_meal" id="val_meal" value="<?php echo $_POST['val_meal'] ?>">
            <input type="hidden" name="val_adm" id="val_adm" value="<?php echo $_POST['val_adm'] ?>">

            <input type="hidden" name="guide" id="guide" value="<?php echo  $_POST['pilihan'] ?>">
            <input type="hidden" name="foc" id="foc" value="<?php echo $_POST['foc'] ?>">
            <input type="hidden" name="val_adm_price" id="val_adm_price" value="<?php echo $adm_price ?>">
            <input type="hidden" name="val_guest_meal_price" id="val_guest_meal_price" value="<?php echo $guest_meal ?>">
            <button type="submit" class="btn btn-warning mb-2"><i class="fa fa-print"> Print All</i></button>
        </form>
    </div>
    <div class="col-md-3">
        <form class="form-inline" action="cetak_LT_custom_all_hotel.php?id=<?php echo $_POST['id'] ?>&tour_id=<?php echo $_POST['tourid'] ?>" target="_blank" method="POST">
            <input type="hidden" id="num_pax" name="num_pax" value="<?php echo $_POST['seat'] ?>">
            <input type="hidden" name="guest_meal" id="guest_meal" value="<?php echo $_POST['guest_meal_price'] ?>">
            <input type="hidden" name="adm_price" id="adm_price" value="<?php echo $_POST['adm_price'] ?>">
            <input type="hidden" name="guest_hotel" id="guest_hotel" value="<?php echo $_POST['guest_hotel'] ?>">
            <input type="hidden" name="guide_hotel" id="guide_hotel" value="<?php echo $_POST['guide_hotel'] ?>">
            <input type="hidden" name="foc_hotel" id="foc_hotel" value="<?php echo $_POST['foc_hotel'] ?>">
            <input type="hidden" name="val_meal" id="val_meal" value="<?php echo $_POST['val_meal'] ?>">
            <input type="hidden" name="val_adm" id="val_adm" value="<?php echo $_POST['val_adm'] ?>">

            <input type="hidden" name="guide" id="guide" value="<?php echo  $_POST['pilihan'] ?>">
            <input type="hidden" name="foc" id="foc" value="<?php echo $_POST['foc'] ?>">
            <input type="hidden" name="val_adm_price" id="val_adm_price" value="<?php echo $adm_price ?>">
            <input type="hidden" name="val_guest_meal_price" id="val_guest_meal_price" value="<?php echo $guest_meal ?>">
            <button type="submit" class="btn btn-warning mb-2"><i class="fa fa-print"> Print All Hotel</i></button>
        </form>
    </div>

</div>
<div class="pt-2">
    <table id="tb-all-price" class="table table-striped table-bordered table-sm" style="width:100% ;font-size: 10pt;">
        <thead style="background-color: darkblue; color: white;">
            <tr>
                <th>No</th>
                <th>Pax</th>
                <th>TWN</th>
                <th>SGL</th>
                <th>CNB</th>
                <th>INF</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $batas = $_POST['seat'] - $_POST['pilihan'] - $_POST['foc'];
            $hide =  $_POST['pilihan'] + $_POST['foc'];
            for ($i = 1; $i <= $batas; $i++) {
                if ($i > $hide) {
                    $val_guide_custom = $_POST['pilihan'] * ($grand_guide2 / $i);
                    $val_foc_custom = $_POST['foc'] * ($grand_foc / $i);
                    $gt_twn_custom = $total + $val_hotel + $val_guide_custom + $val_foc_custom + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal;

                    $gt_sgl_custom = $total + $gprice + $val_guide_custom + $val_foc_custom + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal;

                    $gt_cnb_custom = $total + $val_guide_custom + $val_foc_custom + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal;

                    $gt_inf_custom = $val_guide + $val_foc + $guide_adm + $guide_hotel + $foc_hotel + $guest_meal;;
                    // $alamat_domain =  $domain_web . "cetak_LT_custom.php?id=" . $_POST['id'] . "&tour_id=" . $_POST['tourid'] . "&pax=" . $i . "&pilihan=" . $_POST['pilihan'];
            ?>
                    <tr>
                        <th><?php echo $no ?></th>
                        <td><?php echo $i . " + " . $_POST['pilihan'] . " Guide + " . $_POST['foc'] . " FOC" ?></td>
                        <td><?php echo "IDR " . number_format($gt_twn_custom) ?></td>
                        <td><?php echo "IDR " . number_format($gt_sgl_custom) ?></td>
                        <td><?php echo "IDR " . number_format($gt_cnb_custom) ?></td>
                        <td><?php echo "IDR " . number_format($gt_inf_custom) ?></td>
                        <td>
                            <form action="cetak_LT_custom.php?id=<?php echo $_POST['id'] ?>&tour_id=<?php echo $_POST['tourid'] ?>&pax=<?php echo $i  ?>" target="_blank" method="POST">
                                <input type="hidden" name="guest_meal" id="guest_meal" value="<?php echo $_POST['guest_meal_price'] ?>">
                                <input type="hidden" name="adm_price" id="adm_price" value="<?php echo $_POST['adm_price'] ?>">
                                <input type="hidden" name="guest_hotel" id="guest_hotel" value="<?php echo $_POST['guest_hotel'] ?>">
                                <input type="hidden" name="guide_hotel" id="guide_hotel" value="<?php echo $_POST['guide_hotel'] ?>">
                                <input type="hidden" name="foc_hotel" id="foc_hotel" value="<?php echo $_POST['foc_hotel'] ?>">
                                <input type="hidden" name="val_meal" id="val_meal" value="<?php echo $_POST['val_meal'] ?>">
                                <input type="hidden" name="val_adm" id="val_adm" value="<?php echo $_POST['val_adm'] ?>">

                                <input type="hidden" name="guide" id="guide" value="<?php echo  $_POST['pilihan'] ?>">
                                <input type="hidden" name="foc" id="foc" value="<?php echo $_POST['foc'] ?>">
                                <input type="hidden" name="val_adm_price" id="val_adm_price" value="<?php echo $adm_price ?>">
                                <input type="hidden" name="val_guest_meal_price" id="val_guest_meal_price" value="<?php echo $guest_meal ?>">
                                <button type="submit" class="btn btn-warning btn-sm" onclick=""><i class="fa fa-print"></i> Print</button>
                            </form>
                        </td>
                    </tr>
            <?php
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tb-all-price').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5,
            "bDestroy": true
        });
    });
</script>