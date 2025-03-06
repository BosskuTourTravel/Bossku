<html>

<head>
    <title>Priview Itinerary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<?php

include "../site.php";
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";;

$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);


$query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_inc = mysqli_query($con, $query_inc);
$row_inc = mysqli_fetch_array($rs_inc);
$query_include = explode(",", $row_inc['chck']);





$query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_adm = mysqli_query($con, $query_adm);
$row_adm = mysqli_fetch_array($rs_adm);
$include = explode(",", $row_cek['include']);
$exclude = explode(",", $row_cek['exclude']);

$query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $_GET['grub_id'] . "'";
$rs_grub = mysqli_query($con, $query_grub);
$row_grub = mysqli_fetch_array($rs_grub);

$query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $_GET['grub_id'] . "' order by id ASC";
$rs_gf = mysqli_query($con, $query_gf);
$rs_gf_price = mysqli_query($con, $query_gf);
// var_dump($query_gf );

?>

<body>
    <div class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header">
                <div class="gmb">
                    <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: 990px;">
                </div>
            </div>
        </div>
        <div style="padding: 5px 15px">
            <div class="row">
                <div class="col-md-12">
                    <div style="font-size: 24px; font-weight: bold; text-align: center;">
                        <?php echo $row_data['judul'] ?>
                    </div>
                    <div style="font-size: 20px;  text-align: center;">
                        <?php echo $row_data['landtour'] ?>
                    </div>

                </div>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Include</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sale Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $grandtotal = 0;
                    $hotel_id = 0;

                    foreach ($query_include as $check) {
                        $query_chck = "SELECT * FROM  checkbox_include2 where id=" . $check;
                        $rs_chck = mysqli_query($con, $query_chck);
                        $row_chck = mysqli_fetch_array($rs_chck);

                        if ($check == '1') {
                            // get value price flight
                            $adt = 0;
                            $chd = 0;
                            $inf = 0;
                            while ($row_price = mysqli_fetch_array($rs_gf_price)) {
                                $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_price['flight_id'] . "'";
                                $rs_detail2 = mysqli_query($con, $query_detail2);
                                $row_detail2 = mysqli_fetch_array($rs_detail2);


                                $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_price['route_id'] . "'";
                                $rs_rt = mysqli_query($con, $query_rt);
                                $row_rt = mysqli_fetch_array($rs_rt);

                                if ($row_gf['status'] == '1') {
                                    if ($x_gf == '1') {
                                        $adt_rt = $row_rt['adt'];
                                        $chd_rt = $row_rt['chd'];
                                        $inf_rt = $row_rt['inf'];
                                    } else {
                                        $adt_rt = 0;
                                        $chd_rt = 0;
                                        $inf_rt = 0;
                                    }
                                } else {
                                    $adt_rt = $row_detail2['adt'];
                                    $chd_rt = $row_detail2['chd'];
                                    $inf_rt = $row_detail2['inf'];
                                }
                                // var_dump($adt_rt);
                                $adt = $adt + $adt_rt;
                                $chd = $chd + $chd_rt;
                                $inf = $inf + $inf_rt;
                            }
                            $adt = $adt + $row_grub['adt'];
                            $chd = $chd + $row_grub['chd'];
                            $inf = $inf + $row_grub['inf'];
                            // var_dump($query_detail2);
                            $arr_profit = array(
                                "adt" => $adt,
                                "chd" => $chd,
                                "inf" => $inf
                            );
                            // var_dump($arr_profit);
                            $show_tps = get_profit_flight($arr_profit);
                            $result_tps = json_decode($show_tps, true);
                            $grandtotal = $grandtotal + $result_tps['adt'];

                            ///////////////////////////////////////
                        } else if ($check == '15') {
                            $data_hotel = array(
                                "copy_id" => $row_data['id'],
                                "master_id" => $row_data['master_id'],
                            );

                            $show_hp = get_hotel_price($data_hotel);
                            $result_hp = json_decode($show_hp, true);
                            $hotel_id =  $result_hp['id_hotel'];
                            $grandtotal = $grandtotal + $result_hp['twn'];
                        } else if ($check == '17') {
                            $show_tps = get_adm_price($include);
                            $result_tps = json_decode($show_tps, true);
                            $grandtotal = $grandtotal + $result_tps['adt'];
                        } else if ($check == '32') {
                            $data_feetl = array(
                                "master_id" => $row_data['master_id'],
                                "copy_id" => $row_data['id'],
                                "grub_id" => $row_grub['id'],
                                "hotel_id" =>  $hotel_id
                            );

                            //  var_dump($data_feetl);

                            $show_feetl = feeTL($data_feetl);
                            $result_tps = json_decode($show_feetl, true);
                            $fee_tl = 0;
                            if ($_POST['tl_pax'] != "") {
                                $fee_tl = $result_tps['custom'] / $_POST['tl_pax'];
                            } else {
                                $fee_tl = $result_tps['adt'];
                            }

                            $grandtotal = $grandtotal + $fee_tl;
                        } else {
                            $data_tps = array(
                                "master_id" => $row_data['master_id'],
                                "copy_id" => $row_data['id'],
                                "check_id" => $check
                            );

                            $show_tps = get_total($data_tps);
                            $result_tps = json_decode($show_tps, true);
                            $grandtotal = $grandtotal + $result_tps['adt'];
                        }
                    ?>
                        <tr>
                            <th><?php echo $no ?></th>
                            <td><?php echo $row_chck['nama'] ?></td>
                            <td>
                                <?php
                                if ($check == '15') {
                                    echo number_format($result_hp['twn'], 0, ",", ".");
                                } else if ($check == '32') {
                                    echo number_format($fee_tl, 0, ",", ".");
                                } else {
                                    echo number_format($result_tps['adt'], 0, ",", ".");
                                }

                                ?></td>
                            <td></td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                    <tr>
                        <th></th>
                        <td>Biaya Tambahan (Lain-lain)</td>
                        <td><?php echo number_format($_POST['ltwn'], 0, ",", ".") ?></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <?php
                    $grandtotal = $grandtotal + $_POST['ltwn'];
                    $grand_adt = get_pembulatan($grandtotal);
                    $grand_adt_val = json_decode($grand_adt, true);
                    ?>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Total Price</th>
                        <th scope="col"><?php echo number_format($grandtotal, 0, ",", ".") ?></th>
                        <th style="color: green;"><?php echo number_format($grand_adt_val['value'], 0, ",", ".") ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>
<script>
    var kode = "<?php
                $judul = "NO_CODE";
                if ($row_data['landtour'] != "undefined") {
                    $judul = $row_data['landtour'];
                }
                echo $judul;
                ?>";
    var judul = "<?php echo $row_data['judul'] ?>";
    document.title = kode + "-" + judul + "-Breakdown-Pricelist";
    window.print();
</script>

</html>