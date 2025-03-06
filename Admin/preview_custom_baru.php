<html>

<head>
    <title>Priview Itinerary</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php
///note
// twn op itu harga tanpa  tl
// 1 tanpa tl

include "../site.php";
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "Api_Print_rute.php";
include "Api_get_date.php";


$data = $_GET['id'];
$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);




$query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $_GET['id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);

$queryTmp_set = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_data['master_id'] . "'";
$rsTmp_set = mysqli_query($con, $queryTmp_set);

$arr_hl = [];
while ($row_tmp_set = mysqli_fetch_array($rsTmp_set)) {

    $query_ops_set = "SELECT * FROM LT_add_ops where master_id='" .  $row_data['master_id'] . "' && hari='" . $row_tmp_set['hari'] . "' && urutan='" . $row_tmp_set['urutan'] . "'";
    $rs_ops_set = mysqli_query($con, $query_ops_set);
    $row_ops_set = mysqli_fetch_array($rs_ops_set);
    // var_dump($query_ops_set);

    if ($row_ops_set['highlight'] == '1') {
        $query_tempat_hl = "SELECT * FROM List_tempat where id=" . $row_tmp_set['tempat'];
        $rs_tempat_hl = mysqli_query($con, $query_tempat_hl);
        $row_tempat_hl = mysqli_fetch_array($rs_tempat_hl);
        array_push($arr_hl, $row_tempat_hl['tempat']);
    }
}

$query_date = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' order by hari ASC, urutan ASC limit 1";
$rs_date = mysqli_query($con, $query_date);
$row_date = mysqli_fetch_array($rs_date);
$start_date = $row_date['tgl_sfee'];

$query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
$row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);

$json_day = $row_data['hari'] + $row_cek_addhari['plus_hari'];
$view_guide = 0;
// foreach($_POST['include'] as $inc){
//     echo $inc.",";
// }
$check_flight = 0;
$check_costtl = 0;
if (!empty($_POST['include'])) {
    $total_twn = 0;
    $total_sgl = 0;
    $total_inf = 0;
    $total_chd  = 0;
    $twn_op = 0;
    $sgl_op = 0;
    $chd_op = 0;
    $inf_op = 0;
    $chck_fetl = 0;
    foreach ($_POST['include'] as $check) {

        // $query_tps = "SELECT * FROM  checkbox_include2 where id=" . $check;
        // $rs_tps = mysqli_query($con, $query_tps);
        // $row_tps = mysqli_fetch_array($rs_tps);

        if ($check != '15' && $check != '1' && $check != '17' && $check != '32') {
            $data_tps = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $_GET['id'],
                "check_id" => $check
            );

            $show_tps = get_total($data_tps);
            $result_tps = json_decode($show_tps, true);

            $total_twn = $total_twn + $result_tps['adt'];
            $total_sgl = $total_sgl + $result_tps['sgl'];
            $total_chd = $total_chd + $result_tps['chd'];
            $total_inf = $total_inf + $result_tps['inf'];
            // var_dump($check . " : " . $result_tps['adt']." =>".$total_twn. " </br>");
        } else if ($check == '17') {


            // $adt_tmp = 0;
            // $chd_tmp = 0;
            // $inf_tmp = 0;
            $arr_tmp = [];
            // $adt_tmpex = 0;
            // $chd_tmpex = 0;
            // $inf_tmpex = 0;
            $arr_tmpex = [];
            if (isset($_POST['tmp'])) {
                foreach ($_POST['tmp'] as $val_tmp) {
                    $adt_tmp = 0;
                    $chd_tmp = 0;
                    $inf_tmp = 0;
                    $query_tmp = "SELECT tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp . "'";
                    $rs_tmp = mysqli_query($con, $query_tmp);
                    $row_tmp = mysqli_fetch_array($rs_tmp);

                    if ($row_tmp['price'] != 0) {
                        $datareq = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['price'],
                        );
                        $adt_kurs = get_kurs($datareq);
                        $rs_adt_kurs = json_decode($adt_kurs, true);
                        $adt_tmp = $adt_tmp + $rs_adt_kurs['data'];
                    }
                    if ($row_tmp['chd'] != 0) {
                        $datareq_chd = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['chd'],
                        );
                        $chd_kurs = get_kurs($datareq_chd);
                        $rs_chd_kurs = json_decode($chd_kurs, true);
                        $chd_tmp = $chd_tmp +  $rs_chd_kurs['data'];
                    }
                    if ($row_tmp['inf'] != 0) {
                        $datareq_inf = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['inf'],
                        );
                        $inf_kurs = get_kurs($datareq_inf);
                        $rs_inf_kurs = json_decode($inf_kurs, true);
                        $inf_tmp = $inf_tmp +  $rs_inf_kurs['data'];
                    }
                    array_push($arr_tmp, array("nama" => $row_tmp['tempat'], "price" => $adt_tmp));
                    $total_twn = $total_twn + $adt_tmp;
                    $total_sgl = $total_sgl + $chd_tmp;
                    $total_chd = $total_chd + $chd_tmp;
                    $total_inf = $total_inf + $inf_tmp;
                }
                // var_dump("admiss: ".$adt_tmp);

            }
            if (isset($_POST['tmp_ex'])) {
                foreach ($_POST['tmp_ex'] as $val_tmp2) {
                    $adt_tmpex = 0;
                    $chd_tmpex = 0;
                    $inf_tmpex = 0;
                    $query_tmp2 = "SELECT tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp2 . "'";
                    $rs_tmp2 = mysqli_query($con, $query_tmp2);
                    $row_tmp2 = mysqli_fetch_array($rs_tmp2);

                    if ($row_tmp2['price'] != 0) {
                        $datareq = array(
                            "kurs" =>  $row_tmp2['kurs'],
                            "nominal" => $row_tmp2['price'],
                        );
                        $adt_kurs = get_kurs($datareq);
                        $rs_adt_kurs = json_decode($adt_kurs, true);
                        $adt_tmpex = $adt_tmpex + $rs_adt_kurs['data'];
                    }
                    if ($row_tmp2['chd'] != 0) {
                        $datareq_chd = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['chd'],
                        );
                        $chd_kurs = get_kurs($datareq_chd);
                        $rs_chd_kurs = json_decode($chd_kurs, true);
                        $chd_tmpex = $chd_tmpex +  $rs_chd_kurs['data'];
                    }
                    if ($row_tmp2['inf'] != 0) {
                        $datareq_inf = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['inf'],
                        );
                        $inf_kurs = get_kurs($datareq_inf);
                        $rs_inf_kurs = json_decode($inf_kurs, true);
                        $inf_tmpex = $inf_tmpex +  $rs_inf_kurs['data'];
                    }

                    array_push($arr_tmpex, array("nama" => $row_tmp2['tempat'], "price" => $adt_tmpex));
                }
            }
            // var_dump("adm : ".$adt_tmp);
            // var_dump($check. " : " . $adt_tmp . " </br>");
        } else if ($check == '1') {
            $check_flight = 1;
        } else if ($check == '32') {
            $check_costtl = 1;
        } else {
        }
        if ($check == '26') {
            $view_guide = 1;
        }
    }
    // var_dump($total_twn);
}
$guide_price = '';
$tl_price = '';
$porter_price = '';
$detail_visa = "";
$data_visa = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $_GET['id'],
    "check_id" => '8'
);
$show_visa = get_total($data_visa);
$result_visa = json_decode($show_visa, true);
foreach ($result_visa['detail'] as $detail) {
    $detail_visa .= " " . $detail;
}

$data_porter = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $_GET['id'],
    "check_id" => '37'
);

$show_porter = get_total($data_porter);
$result_porter = json_decode($show_porter, true);
if ($result_porter['adt'] != 0) {
    $porter_price = "Rp." . number_format($result_porter['adt'], 0, ",", ".");
}


$data_tl = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $_GET['id'],
    "check_id" => '27'
);

$show_tl = get_total($data_tl);
$result_tl = json_decode($show_tl, true);
if ($result_tl['adt'] != 0) {
    $tl_price = "Rp." . number_format($result_tl['adt'], 0, ",", ".");
}


$data_guide = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $_GET['id'],
    "check_id" => '26'
);

$show_guide = get_total($data_guide);
$result_guide = json_decode($show_guide, true);
if ($result_guide['adt'] != 0) {
    $guide_price = "Rp." . number_format($result_guide['adt'], 0, ",", ".");
}


// include exclude

$val_check = [0];
foreach ($_POST['include'] as $val) {
    array_push($val_check, $val);
}
$arr_in = [];
$arr_ex = [];
$query_ex = "SELECT * FROM  checkbox_include2 order by id ASC";
$rs_ex = mysqli_query($con, $query_ex);
$blue_check = [0, 3, 4, 5, 6, 7, 17, 18, 19, 22, 23, 24, 36, 37, 38, 39, 41, 44, 47, 48, 49, 52, 53, 54];
$red_check = [0, 9, 10, 11, 12, 13, 14, 15, 16, 25, 32, 33, 34, 35, 40, 42, 43, 45, 46, 55, 56, 57, 58];
$yellow_check = [0, 5, 5, 17, 41, 44, 52, 53, 54];
while ($row_ex = mysqli_fetch_array($rs_ex)) {
    $cek_val  = array_search($row_ex['id'], $val_check);
    if ($cek_val == "") {
        // masuk exclude
        $cek_red = array_search($row_ex['id'], $red_check);
        if ($cek_red == "") {
            $cek_blue = array_search($row_ex['id'], $blue_check);
            if ($cek_blue == "") {
                array_push($arr_ex, $row_ex['id']);
            }
        }
    } else {
        // masuk include
        $cek_red = array_search($row_ex['id'], $red_check);
        if ($cek_red == "") {
            // var_dump($row_ex['id']);
            $cek_blue = array_search($row_ex['id'], $blue_check);
            if ($cek_blue != "") {
                $data_price = array(
                    "master_id" => $row_data['master_id'],
                    "copy_id" => $_GET['id'],
                    "check_id" => $row_ex['id']
                );
                $show_price = get_total($data_price);
                $result_price = json_decode($show_price, true);


                // var_dump($result_price['adt']);
                if ($result_price['adt'] != "" or $result_price['adt'] != '0' or $result_price['adt'] != null) {
                    array_push($arr_in, $row_ex['id']);
                    // var_dump($row_ex['id']);
                } else {
                    $cek_yellow = array_search($row_ex['id'], $yellow_check);
                    if ($cek_yellow != "") {
                        array_push($arr_in, $row_ex['id']);
                    }
                }
            } else {
                array_push($arr_in, $row_ex['id']);
            }
        }
    }
}

?>

<body>
    <div id="content" class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header" style="text-align: center;">
                <div class="gmb">
                    <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: 990px;">
                </div>
            </div>
        </div>
        <div style="padding: 20px;">
            <div class="row">
                <?php
                if ($row_cek['img1'] != "") {
                    $link = $row_cek['img1'];
                    $headers = explode('/', $link);
                    $thumbnail = $headers[5];
                ?>
                    <div class="col">
                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                    <?php
                } else {
                    if ($row_data['gambar1'] == "") {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar1'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                if ($row_cek['img2'] != "") {
                    $link = $row_cek['img2'];
                    $headers = explode('/', $link);
                    $thumbnail = $headers[5];
                ?>
                    <div class="col">
                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                    <?php
                } else {
                    if ($row_data['gambar2'] == "") {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                    <?php

                    } else {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar2'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                if ($row_cek['img3'] != "") {
                    $link = $row_cek['img3'];
                    $headers = explode('/', $link);
                    $thumbnail = $headers[5];
                ?>
                    <div class="col">
                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                    <?php
                } else {
                    if ($row_data['gambar3'] == "") {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar3'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                if ($row_cek['img4'] != "") {
                    $link = $row_cek['img4'];
                    $headers = explode('/', $link);
                    $thumbnail = $headers[5];
                ?>
                    <div class="col">
                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="100%" height="100%" style="max-height: 160px;" />
                    </div>
                    <?php
                } else {
                    if ($row_data['gambar4'] == "") {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col">
                            <img src="https://www.2canholiday.com/Admin/images/<?php echo $row_data['gambar4'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div style="padding: 5px 15px">
            <div class="row">
                <div class="col-md-12">
                    <div style="font-size: 24px; font-weight: bold; text-align: center;">
                        <?php echo $row_data['judul'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <?php
            $x = 1;
            $loop = 1;
            $date_plus = 0;
            $cek_hari = 1;
            for ($c = 1; $c <= $json_day; $c++) {
                $date = date('Y-m-d', strtotime("+ " . $date_plus . " day", strtotime($start_date)));

                $query_cek_hari = "SELECT  id ,hari FROM  LT_add_hari where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && hari='$c'";
                $rs_cek_hari = mysqli_query($con, $query_cek_hari);
                $row_cek_hari = mysqli_fetch_array($rs_cek_hari);
                // var_dump($query_cek_hari);
                if ($row_cek_hari['id'] != "") {

                    $data_print = array(
                        "id" => $rowTambah['id'],
                        "copy" => $row_data['id'],
                        "master" => $row_data['master_id'],
                        "c" => $c,
                        "date" => $date,
                        "cek_hari" => $row_cek_hari['hari'],
                        "json_day" => $json_day,
                    );
                    add_rute($data_print);
                } else {
                    $data_print = array(
                        "id" => $rowTambah['id'],
                        "copy" => $row_data['id'],
                        "master" => $row_data['master_id'],
                        "c" => $c,
                        "date" => $date,
                        "cek_hari" => $cek_hari,
                        "json_day" => $json_day,
                    );
                    // var_dump($data_print);
                    add_rute($data_print);

                    $cek_hari++;
                }

                $date_plus++;
            }
            ?>
        </div>
    </div>
    <?php
    $data_lt = $row_data['landtour'];
    $query_lt = "SELECT * FROM LT_itinnew where kode='" . $data_lt . "' && city_in !='' && city_out !='' order by id ASC ";
    $rs_lt = mysqli_query($con, $query_lt);
    $row_lt = mysqli_fetch_array($rs_lt);
    $in = $row_lt['city_in'];
    $out = $row_lt['city_out'];
    // var_dump($query_lt);


    $queryPHotelx = "SELECT hotel_id FROM  LT_select_PilihHTL where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' order by id ASC limit 1";
    $rsPHotelx = mysqli_query($con, $queryPHotelx);
    $rowPHotelx = mysqli_fetch_array($rsPHotelx);

    $query_lt2 = "SELECT * FROM  LT_itinnew where id = '" . $rowPHotelx['hotel_id'] . "'";
    $rs_lt2 = mysqli_query($con, $query_lt2);
    while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
        $pax_u = "";
        $pax_b = "";
        if ($row_lt2['pax_u'] != 0) {
            $pax_u = "-" . $row_lt2['pax_u'];
        }
        if ($row_lt2['pax_b'] != 0) {
            $pax_b = "+" . $row_lt2['pax_b'];
        }
        $pax_h = $row_lt2['pax'] . $pax_u . $pax_b;
        if ($row_lt2['twn'] != "") {
            $tanda2 = "";
            $tanda3 = "";
            $tanda4 = "";
            $tanda5 = "";
            $tanda6 = "";
            $tanda7 = "";
            $tanda8 = "";
            $tanda9 = "";
            $tanda10 = "";
            if ($row_lt2['hotel2'] != "") {
                $tanda2 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel3'] != "") {
                $tanda3 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel4'] != "") {
                $tanda4 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel5'] != "") {
                $tanda5 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel6'] != "") {
                $tanda6 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel7'] != "") {
                $tanda7 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel8'] != "") {
                $tanda8 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel9'] != "") {
                $tanda9 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            if ($row_lt2['hotel10'] != "") {
                $tanda10 = " <i class='fa fa-circle' style='font-size:6px'; text_align:center;></i> ";
            }
            $d_hotel = $row_lt2['hotel1'] . $tanda2 . $row_lt2['hotel2'] . $tanda3 . $row_lt2['hotel3'] . $tanda4 . $row_lt2['hotel4'] . $tanda5 . $row_lt2['hotel5'] . $tanda6 . $row_lt2['hotel6'] . $tanda7 . $row_lt2['hotel7'] . $tanda8 . $row_lt2['hotel8'] . $tanda9 . $row_lt2['hotel9'] . $tanda10 . $row_lt2['hotel10'];
            // get value hotel price
            $data_hotel = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $_GET['id'],
                "check_id" => '15'
            );

            $show_hotel = get_total($data_hotel);
            $result_hotel = json_decode($show_hotel, true);

            $total_twn = $total_twn + $result_hotel['adt'] + $_POST['ltwn'];
            $total_sgl = $total_sgl + $result_hotel['sgl'] + $_POST['ltwn'];
            $total_chd = $total_chd + $result_hotel['chd'] + $_POST['ltwn'];
            $total_inf = $total_inf + $result_hotel['inf'] + $_POST['ltwn'];
        }
    }

    if ($_POST['rdio'] == "") {
        if ($_POST['twn'] != "") {
            //////////////////////////////////////////////// custom price //////////////////////////////////////////////////////////
            // var_dump("yyyyy");
            $data_date = array(
                "in" => $in,
                "out" => $out,
                "kota" => $row_lt['kota'],
                "judul" => $row_data['judul'],
                "kode" => $row_lt['kode'],
                "d_hotel" => $d_hotel,
                "grub_id" => $_POST['grub_i'],
                "pax" => $_POST['pax'],
                "total_twn" => $_POST['twn'],
                "total_sgl" =>  $_POST['sgl'],
                "total_chd" =>  $_POST['cnb'],
                "total_inf" =>  $_POST['inf'],
            );
            custom_price($data_date);
            //////////////////////////////////////////////// custom price //////////////////////////////////////////////////////////
        } else {
            if ($_POST['rdio_pax'] == '1') {
                //////////////////////////////////////////////// pilih grub  no TL //////////////////////////////////////////////////////////
                // var_dump("cccc");
                $data_date = array(
                    "in" => $in,
                    "out" => $out,
                    "kota" => $row_lt['kota'],
                    "judul" => $row_data['judul'],
                    "kode" => $row_lt['kode'],
                    "d_hotel" => $d_hotel,
                    "grub_id" => $_POST['grub_i'],
                    "pax" => $pax_h,
                    "total_twn" => $total_twn,
                    "total_sgl" => $total_sgl,
                    "total_chd" => $total_chd,
                    "total_inf" => $total_inf,
                    "copy" => $row_data['id'],
                    "master" => $row_data['master_id'],
                    "chck_flight" => $check_flight,
                    "chck_costtl" => $check_costtl,
                    "tl_pax" => $_POST['tl_pax']
                );

                get_date_pilih($data_date);
            } else {
                //////////////////////////////////////////////// pilih grub with TL //////////////////////////////////////////////////////////
                // var_dump("sssss");
                $data_date = array(
                    "in" => $in,
                    "out" => $out,
                    "kota" => $row_lt['kota'],
                    "judul" => $row_data['judul'],
                    "kode" => $row_lt['kode'],
                    "d_hotel" => $d_hotel,
                    "grub_id" => $_POST['grub_i'],
                    "pax" => $pax_h,
                    "total_twn" => $total_twn,
                    "total_sgl" => $total_sgl,
                    "total_chd" => $total_chd,
                    "total_inf" => $total_inf,
                    "copy" => $row_data['id'],
                    "master" => $row_data['master_id'],
                    "chck_flight" => $check_flight,
                    "chck_costtl" => $check_costtl,
                    "tl_pax" => $_POST['tl_pax']
                );
                // var_dump( $data_date);
                get_date_pilih($data_date);
                //////////////////////////////////////////////// pilih grub with TL //////////////////////////////////////////////////////////

            }
        }
    } else {

        if ($_POST['rdio_pax'] == '1') {
            ///////////////////////// compare  no TL //////////////////////////////////////////////////////////
            $data_date = array(
                "in" => $in,
                "out" => $out,
                "kota" => $row_lt['kota'],
                "judul" => $row_data['judul'],
                "kode" => $row_lt['kode'],
                "d_hotel" => $d_hotel,
                "pax" => $pax_h,
                "total_twn" => $total_twn,
                "total_sgl" => $total_sgl,
                "total_chd" => $total_chd,
                "total_inf" => $total_inf,
                "copy" => $row_data['id'],
                "master" => $row_data['master_id'],
                "chck_flight" => $check_flight,
                "chck_costtl" => $check_costtl,
                "tl_pax" => $_POST['tl_pax']
            );
            // var_dump("ppp");
            get_date($data_date);
            //////////////////////////////////////////////// compare no TL //////////////////////////////////////////////////////////
        } else {
            // var_dump("oonn");
            //////////////////////////////////////////////// compare  with TL //////////////////////////////////////////////////////////
            $data_date = array(
                "in" => $in,
                "out" => $out,
                "kota" => $row_lt['kota'],
                "judul" => $row_data['judul'],
                "kode" => $row_lt['kode'],
                "d_hotel" => $d_hotel,
                "pax" => $pax_h,
                "total_twn" => $total_twn,
                "total_sgl" => $total_sgl,
                "total_chd" => $total_chd,
                "total_inf" => $total_inf,
                "copy" => $row_data['id'],
                "master" => $row_data['master_id'],
                "chck_flight" => $check_flight,
                "chck_costtl" => $check_costtl,
                "tl_pax" => $_POST['tl_pax']
            );

            get_date($data_date);

            //////////////////////////////////////////////// compare with TL //////////////////////////////////////////////////////////
        }
    }

    ?>
    <div style="padding: 5px 20px; font-size: 12px;">
        <div class="row">
            <div class="col-6">
                <div>
                    <?php
                    $query2 = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $_GET['id'] . "' order by hari ASC, urutan ASC";
                    $rs2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_array($rs2);
                    if ($row2['id'] != "") {
                    ?>
                        <table class="table table-bordered table-sm" style="border-color: black; font-weight: normal; font-size: 10pt;">
                            <thead>
                                <tr>
                                    <th scope="col">Transport</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM  LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $_GET['id'] . "' order by hari ASC, urutan ASC";
                                $rs = mysqli_query($con, $query);
                                $code_fl = [];
                                while ($row = mysqli_fetch_array($rs)) {
                                    $fl_logo = "";
                                    if ($row['type'] == '1') {
                                        $type = "Flight";

                                        $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $row['transport'] . "'";
                                        $rsflight = mysqli_query($con, $queryflight);
                                        $rowflight = mysqli_fetch_array($rsflight);
                                        $arr_fl = explode(" ", $rowflight['maskapai']);
                                        array_push($code_fl, $arr_fl[0]);

                                        $detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") " . $rowflight['rute'];
                                    } else if ($row['type'] == '2') {
                                        $type = "Ferry";
                                        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row['transport'];
                                        $rs_ferry = mysqli_query($con, $query_ferry);
                                        $row_ferry = mysqli_fetch_array($rs_ferry);
                                        $detail = $type . " : " . $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ") " . $row_ferry['type'];
                                    } else if ($row['type'] == '4') {
                                        $type = "Train";
                                        $query_train = "SELECT * FROM train_LTnew where id=" . $row['transport'];
                                        $rs_train = mysqli_query($con, $query_train);
                                        $row_train = mysqli_fetch_array($rs_train);

                                        $detail = $row_train['nama'];
                                        $adt = $row_train['adt'];
                                        $chd = $row_train['chd'];
                                        $inf = $row_train['inf'];
                                    } else {
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $detail ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <?php
                    $val_arr = array_unique($code_fl);
                    foreach ($val_arr as $code) {
                        $queryflight_logo = "SELECT * FROM LT_flight_logo WHERE kode='" . $code . "'";
                        $rsflight_logo = mysqli_query($con, $queryflight_logo);
                        $rowflight_logo = mysqli_fetch_array($rsflight_logo);
                        $fl_logo = $rowflight_logo['gambar'];
                    ?>
                        <div class="col-3">
                            <img src="https://www.2canholiday.com/Admin/plane_logo/<?php echo $fl_logo ?>" width="100%" height="60px" />
                        </div>

                    <?php
                    }
                    ?>
                </div>

            </div>
            <div class="col-6">
            </div>
        </div>
    </div>
    <div style="padding-top: 20px;"></div>
    <div style="padding: 5px 20px; font-size: 12px;">
        <div class="row">
            <div class="col-6">
                <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TERMASUK : </u></div>
                <div>
                    <ul>
                        <?php

                        foreach ($arr_in as $val_auto) {
                            $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto'";
                            $rs_p = mysqli_query($con, $query_p);
                            $row_p = mysqli_fetch_array($rs_p);
                            if ($row_p['id'] == '8') {
                                echo "<li>" . $row_p['nama'] . " " . $detail_visa . "</li>";
                            } else if ($row_p['id'] == '26') {
                                echo "<li>" . $row_p['nama'] . " " . $guide_price . "</li>";
                            } else if ($row_p['id'] == '27') {
                                echo "<li>" . $row_p['nama'] . " " . $tl_price . "</li>";
                            } else if ($row_p['id'] == '37') {
                                echo "<li>" . $row_p['nama'] . " " . $porter_price . "</li>";
                            } else {
                                echo "<li>" . $row_p['nama'] . "</li>";
                            }
                        }
                        if (is_array($arr_tmp)) {
                            foreach ($arr_tmp as $val_arr_tmp) {
                                echo "<li>" . $val_arr_tmp['nama'] . " : Rp." . $val_arr_tmp['price'] . "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
            <div class="col-6">
                <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TIDAK TERMASUK : </u></div>
                <div>
                    <?php

                    ?>
                    <ul>
                        <?php
                        foreach ($arr_ex as $val_auto) {
                            $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto'";
                            $rs_p = mysqli_query($con, $query_p);
                            $row_p = mysqli_fetch_array($rs_p);
                            if ($row_p['id'] == '8') {
                                if ($result_visa['adt'] == '0') {
                                    echo "<li>" . $row_p['nama'] . " " . $detail_visa . " | TBA" . "</li>";
                                } else {
                                    echo "<li>" . $row_p['nama'] . " " . $detail_visa . " | Rp." . number_format($result_visa['adt'], 0, ",", ".") . "</li>";
                                }
                            } else if ($row_p['id'] == '26') {
                                echo "<li>" . $row_p['nama'] . " " . $guide_price . "</li>";
                            } else if ($row_p['id'] == '27') {
                                echo "<li>" . $row_p['nama'] . " " . $tl_price . "</li>";
                            } else if ($row_p['id'] == '37') {
                                echo "<li>" . $row_p['nama'] . " " . $porter_price . "</li>";
                            } else {
                                echo "<li>" . $row_p['nama'] . "</li>";
                            }
                        }
                        if (is_array($arr_tmpex)) {
                            foreach ($arr_tmpex as $val_arr_tmpex) {
                                echo "<li>" . $val_arr_tmpex['nama'] . " : Rp." . $val_arr_tmpex['price'] . "</li>";
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 5px 20px; font-size: 12px;">
        <div class="row">
            <div class="col">
                <?php
                if (isset($_POST['note'])) {
                ?>
                    <div style="font-size: 12pt;">
                        <u><b>NOTE :</b></u>
                    </div>
                    <div>
                        <?php echo $_POST['note'] ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col">
                <div style="font-size: 12pt;">
                    <u><b>HIGHLIGHT :</b></u>
                </div>
                <div>
                    <?php
                    $hl_i = 0;
                    $hl_d = "";
                    foreach ($arr_hl as $value_hl) {
                        $hl_i++;
                        $hl_d .= $value_hl . ",";
                    }
                    echo $hl_d;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 5px 20px; font-size: 12px;">
        <div style="font-size: 12pt;">
            <u><b>DEPOSIT, PEMBAYARAN & PEMBATALAN :</b></u>
        </div>
        <div>
            <div>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour . No Refund/pengembalian jika ada pembatalan dari peserta</div>
            <div>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour</div>
            <div>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya</div>
            <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
            <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
            <div>Performa Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
        </div>
    </div>
    <script>
        var kode = "<?php
                    $judul = "NO_CODE";
                    if ($row_data['landtour'] != "undefined") {
                        $judul = $row_data['landtour'];
                    }
                    echo $judul;
                    ?>";
        var judul = "<?php echo $row_data['judul'] ?>";
        document.title = kode + "-" + judul;
        window.print();
    </script>
</body>

</html>