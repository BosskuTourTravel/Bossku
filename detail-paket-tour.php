<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php";
include "API/Price/Api_LT_total_baru.php";
include "api_cetak_rute_detail.php";

$base = $_SERVER['REQUEST_URI'];

// var_dump($base);
$query_data = "SELECT paket_tour_online.*,LTSUB_itin.landtour,LTSUB_itin.master_id,LTSUB_itin.hari,LTSUB_itin.judul FROM paket_tour_online LEFT JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id where paket_tour_online.id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

// var_dump($query_data);





?>
<style>
    .ui-highlight .ui-state-default {
        background: palevioletred !important;
        border-color: palevioletred !important;
        color: white !important;
    }

    .ui-highlight .ui-state-active {
        background: darkblue !important;
        border-color: darkblue !important;
        color: white !important;
    }
</style>

<script src="./js/script.js"></script>

<body>
    <?php
    if (isset($row_data['id'])) {
        $tmb = 0;
        $start_date = '';
        $arr_in = [];
        $arr_ex = [];
        $val_check = [0];

        if (isset($row_data['tgl_ber'])) {
            $start_date = $row_data['tgl_ber'];
        }

        $query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $row_data['grub_id'] . "'";
        $rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
        $row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);
        if (isset($row_cek_addhari['plus_hari'])); {
            $tmb = $row_cek_addhari['plus_hari'];
        }
        // var_dump($query_cek_addhari);
        $json_day = $row_data['hari'] + $tmb;

        ///////////////// lain - lain ///////////////


        $guide_price = '';
        $tl_price = '';
        $porter_price = '';
        $detail_visa = "";
        $data_visa = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['tour_id'],
            "check_id" => '8'
        );
        $show_visa = get_total($data_visa);
        $result_visa = json_decode($show_visa, true);
        foreach ($result_visa['detail'] as $detail) {
            $detail_visa .= " " . $detail;
        }

        $data_porter = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['tour_id'],
            "check_id" => '37'
        );

        $show_porter = get_total($data_porter);
        $result_porter = json_decode($show_porter, true);
        if ($result_porter['adt'] != 0) {
            $porter_price = "Rp." . number_format($result_porter['adt'], 0, ",", ".");
        }


        $data_tl = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['tour_id'],
            "check_id" => '27'
        );

        $show_tl = get_total($data_tl);
        $result_tl = json_decode($show_tl, true);
        if ($result_tl['adt'] != 0) {
            $tl_price = "Rp." . number_format($result_tl['adt'], 0, ",", ".");
        }


        $data_guide = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['tour_id'],
            "check_id" => '26'
        );

        $show_guide = get_total($data_guide);
        $result_guide = json_decode($show_guide, true);
        if ($result_guide['adt'] != 0) {
            $guide_price = "Rp." . number_format($result_guide['adt'], 0, ",", ".");
        }

        $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "'";
        $rs_adm = mysqli_query($con, $query_adm);
        $row_adm = mysqli_fetch_array($rs_adm);
        $include = [];
        $exclude = [];
        if (isset($row_adm['id'])) {
            $include = explode(",", $row_adm['include']);
            $exclude = explode(",", $row_adm['exclude']);
        }


        // $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "'";
        // $rs_adm = mysqli_query($con, $query_adm);
        // $row_adm = mysqli_fetch_array($rs_adm);
        // // var_dump($query_adm);
        // $include = [];
        // $exclude = [];
        // if (isset($row_adm['id'])) {
        //     $data_adm_inc = explode(",", $row_adm['include']);
        //     $data_adm_exc = explode(",", $row_adm['exclude']);

        //     foreach ($data_adm_inc as $val_tmp) {

        //         $query_tmp = "SELECT id,tempat FROM  List_tempat where id='" . $val_tmp . "'";
        //         $rs_tmp = mysqli_query($con, $query_tmp);
        //         $row_tmp = mysqli_fetch_array($rs_tmp);

        //         $tmp_name = isset($row_tmp['tempat']) ? $row_tmp['tempat'] : '';
        //         array_push($include, $tmp_name);
        //     }
        //     foreach ($data_adm_exc as $val_tmp2) {

        //         $query_tmp3 = "SELECT id,tempat FROM  List_tempat where id='" . $val_tmp2 . "'";
        //         $rs_tmp3 = mysqli_query($con, $query_tmp3);
        //         $row_tmp3 = mysqli_fetch_array($rs_tmp3);

        //         $tmp_name3 = isset($row_tmp3['tempat']) ? $row_tmp3['tempat'] : '';
        //         array_push($exclude, $tmp_name3);
        //     }
        // }


        ////////////// include
        $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['tour_id'] . "' && master_id='" . $row_data['master_id'] . "'";
        $rs_inc = mysqli_query($con, $query_inc);
        $row_inc = mysqli_fetch_array($rs_inc);
        if (isset($row_inc['id'])) {
            $query_include = explode(",", $row_inc['chck']);
            foreach ($query_include as $check) {
                array_push($val_check, $check);
            }
        }


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
                            "copy_id" => $row_data['tour_id'],
                            "check_id" => $row_ex['id']
                        );
                        $show_price = get_total($data_price);
                        if (!empty($show_price)) {
                            $result_price = json_decode($show_price, true);
                            // var_dump($result_price);
                            if (empty($result_price)) {
                                array_push($arr_in, $row_ex['id']);
                            } else {
                                $cek_yellow = array_search($row_ex['id'], $yellow_check);
                                if ($cek_yellow != "") {
                                    array_push($arr_in, $row_ex['id']);
                                }
                            }
                        }
                    } else {
                        array_push($arr_in, $row_ex['id']);
                    }
                }
            }
        }

        /////// exclude ///////////////////////////////////////////////

        $arr_tmp = [];
        $arr_tmpex = [];
        if (isset($include)) {
            foreach ($include as $val_tmp) {
                $adt_tmp = 0;
                $chd_tmp = 0;
                $inf_tmp = 0;
                $query_tmp = "SELECT id,tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp . "'";
                $rs_tmp = mysqli_query($con, $query_tmp);
                $row_tmp = mysqli_fetch_array($rs_tmp);

                if (isset($row_tmp['id'])) {
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
                    if ($row_tmp['infant'] != 0) {
                        $datareq_inf = array(
                            "kurs" =>  $row_tmp['kurs'],
                            "nominal" => $row_tmp['infant'],
                        );
                        $inf_kurs = get_kurs($datareq_inf);
                        $rs_inf_kurs = json_decode($inf_kurs, true);
                        $inf_tmp = $inf_tmp +  $rs_inf_kurs['data'];
                    }
                }

                $tmp_name = isset($row_tmp['tempat']) ? $row_tmp['tempat'] : '';

                array_push($arr_tmp, array("nama" =>  $tmp_name, "price" => $adt_tmp));
                // $gt_chck_adt = $gt_chck_adt + $adt_tmp;
                // $gt_chck_chd = $gt_chck_chd + $chd_tmp;
                // $gt_chck_inf = $gt_chck_inf + $inf_tmp;
                // $gt_chck_sgl = $gt_chck_sgl +  $adt_tmp;
            }
            // var_dump("admiss: ".$adt_tmp);

        }
        if (isset($exclude)) {
            foreach ($exclude as $val_tmp2) {
                $adt_tmpex = 0;
                $chd_tmpex = 0;
                $inf_tmpex = 0;
                $query_tmp2 = "SELECT id,tempat,tempat2,kurs,price,chd,infant FROM  List_tempat where id='" . $val_tmp2 . "'";
                $rs_tmp2 = mysqli_query($con, $query_tmp2);
                $row_tmp2 = mysqli_fetch_array($rs_tmp2);
                // var_dump($query_tmp2);

                if (isset($row_tmp2['id'])) {
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
                            "kurs" =>  $row_tmp2['kurs'],
                            "nominal" => $row_tmp2['chd'],
                        );
                        $chd_kurs = get_kurs($datareq_chd);
                        $rs_chd_kurs = json_decode($chd_kurs, true);
                        $chd_tmpex = $chd_tmpex +  $rs_chd_kurs['data'];
                    }
                    if ($row_tmp2['infant'] != 0) {
                        $datareq_inf = array(
                            "kurs" =>  $row_tmp2['kurs'],
                            "nominal" => $row_tmp2['infant'],
                        );
                        $inf_kurs = get_kurs($datareq_inf);
                        $rs_inf_kurs = json_decode($inf_kurs, true);
                        $inf_tmpex = $inf_tmpex +  $rs_inf_kurs['data'];
                    }
                }
                $tmp_name2 = isset($row_tmp2['tempat']) ? $row_tmp2['tempat'] : '';

                array_push($arr_tmpex, array("nama" => $tmp_name2, "price" => $adt_tmpex));
            }
        }

        /////////////////////
    ?>
        <div class="container mx-auto px-4 py-16 mt-10">
            <!-- Title -->
            <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb">Paket Land Tour</h1>
            <h1 class="text-3xl font-bold text-gray-800 text-center"><?php echo $row_data['judul'] ?></h1>

            <div class="text-center">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-5">
                    <?php
                    $link2 = "https://drive.google.com/file/d/1ZX73bzx42Ox7qNldS6kY_z6XogQmBesH/view?usp=sharing";
                    $headers2 = explode('/', $link2);
                    $thumbnail = $headers2[5];
                    $thumbnail_gmb1 = $headers2[5];
                    $thumbnail_gmb2 = $headers2[5];
                    $thumbnail_gmb3 = $headers2[5];
                    $thumbnail_gmb4 = $headers2[5];

                    $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $row_data['master_id'] . "' order by id DESC limit 1";
                    $rs_main = mysqli_query($con, $query_main);
                    $row_main = mysqli_fetch_array($rs_main);
                    if (isset($row_main['id'])) {
                        if (isset($row_main['img1'])) {
                            $query_sel_main1 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img1'] . "'";
                            $rs_sel_main1 = mysqli_query($con, $query_sel_main1);
                            $row_sel_main1 = mysqli_fetch_array($rs_sel_main1);
                            $s1 = $row_sel_main1['tmp_type'];

                            $link_gmb1 = $row_sel_main1[$s1];
                            $headers_gmb1 = explode('/', $link_gmb1);
                            $thumbnail_gmb1 = $headers_gmb1[5];
                    ?>
                            <figure class="relative">
                                <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb1 ?>" alt="Gallery image 1" class="w-full h-auto rounded-lg shadow-md">
                            </figure>
                        <?php
                        }
                        if (isset($row_main['img2'])) {
                            $query_sel_main2 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img2'] . "'";
                            $rs_sel_main2 = mysqli_query($con, $query_sel_main2);
                            $row_sel_main2 = mysqli_fetch_array($rs_sel_main2);
                            $s2 = $row_sel_main2['tmp_type'];

                            $link_gmb2 = $row_sel_main2[$s2];
                            $headers_gmb2 = explode('/', $link_gmb2);
                            $thumbnail_gmb2 = $headers_gmb2[5];
                        ?>
                            <figure class="relative">
                                <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb2 ?>" alt="Gallery image 2" class="w-full h-auto rounded-lg shadow-md">
                            </figure>
                        <?php
                        }
                        if (isset($row_main['img3'])) {
                            $query_sel_main3 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img3'] . "'";
                            $rs_sel_main3 = mysqli_query($con, $query_sel_main3);
                            $row_sel_main3 = mysqli_fetch_array($rs_sel_main3);
                            $s3 = $row_sel_main3['tmp_type'];

                            $link_gmb3 = $row_sel_main3[$s3];
                            $headers_gmb3 = explode('/', $link_gmb3);
                            $thumbnail_gmb3 = $headers_gmb3[5];
                        ?>
                            <figure class="relative">
                                <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb3 ?>" alt="Gallery image 3" class="w-full h-auto rounded-lg shadow-md">
                            </figure>
                        <?php
                        }
                        if (isset($row_main['img4'])) {
                            $query_sel_main4 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img4'] . "'";
                            $rs_sel_main4 = mysqli_query($con, $query_sel_main4);
                            $row_sel_main4 = mysqli_fetch_array($rs_sel_main4);
                            $s4 = $row_sel_main4['tmp_type'];

                            $link_gmb4 = $row_sel_main4[$s4];
                            $headers_gmb4 = explode('/', $link_gmb4);
                            $thumbnail_gmb4 = $headers_gmb4[5];
                        ?>
                            <figure class="relative">
                                <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb4 ?>" alt="Gallery image 4" class="w-full h-auto rounded-lg shadow-md">
                            </figure>
                        <?php
                        }
                    } else {
                        $query_sel_img = "SELECT * FROM  selected_img_tmp where tour_id ='" . $row_data['master_id'] . "' limit 4";
                        $rs_sel_img = mysqli_query($con, $query_sel_img);
                        $x = 1;
                        while ($row_sel_img = mysqli_fetch_array($rs_sel_img)) {
                            $query_stmp = "SELECT List_tempat_img.id ,List_tempat_img.link,List_tempat_img.summer_img,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM List_tempat_img LEFT JOIN List_tempat ON List_tempat_img.tmp_id=List_tempat.id where List_tempat_img.tmp_id='" . $row_sel_img['tmp'] . "'";
                            $rs_stmp = mysqli_query($con, $query_stmp);
                            $row_stmp = mysqli_fetch_array($rs_stmp);

                            $p = $row_sel_img['tmp_type'];
                            $link = $row_stmp[$p];
                            $headers = explode('/', $link);
                            $thumbnail = $headers[5];
                        ?>
                            <figure class="relative">
                                <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Gallery image <?php echo $x ?>" class="w-full h-auto rounded-lg shadow-md">
                            </figure>
                    <?php
                            $x++;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="content-more text-left p-5">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse border border-gray-300 text-left text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Departure Date</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Paket</th>
                                <th class="border border-gray-300 px-4 py-2">Pax</th>
                                <th class="border border-gray-300 px-4 py-2">Category</th>
                                <th class="border border-gray-300 px-4 py-2">Start From</th>
                                <th class="border border-gray-300 px-4 py-2">Price</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT paket_tour_online.*, LTSUB_itin.judul,LTSUB_itin.landtour,LT_change_judul.nama as change_judul,LTP_insert_sfee.ket as staff_id,login_staff.name as staff_name,login_staff.phone FROM paket_tour_online INNER JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id LEFT JOIN LT_change_judul ON paket_tour_online.tour_id=LT_change_judul.copy_id && paket_tour_online.grub_id=LT_change_judul.grub_id LEFT JOIN LTP_insert_sfee ON paket_tour_online.sfee_id=LTP_insert_sfee.id LEFT JOIN login_staff ON LTP_insert_sfee.ket=login_staff.id where LTSUB_itin.landtour='" . $row_data['landtour'] . "' order by paket_tour_online.tgl_ber, paket_tour_online.gt ASC";
                            $rs = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($rs)) {
                                $judul = "";
                                $url_encode = urldecode("Haii " . $row['staff_name'] . ", Saya ingin Memesan Paket Tour : https://www.holidaymyboss.com/Admin/cetak_pt_website.php?id=" . $row['id']);

                                if (isset($row['change_judul'])) {
                                    $judul = $row['change_judul'];
                                } else {
                                    $judul = $row['judul'];
                                }

                                if ($row['promo'] == "p_ls") {
                                    $detail = "Low Seasons";
                                } else if ($row['promo'] == "p_ny") {
                                    $detail = "New Years";
                                } else if ($row['promo'] == "p_lebaran") {
                                    $detail = "Lebaran";
                                } else if ($row['promo'] == "p_sh") {
                                    $detail = "School Holiday";
                                } else {
                                    $detail = "Undefined";
                                }

                                $start = "";

                                if ($row['start'] == "SUB") {
                                    $start = "SURABAYA";
                                } else if ($row['start'] == "BTH") {
                                    $start = "BATAM";
                                } else if ($row['start'] == "CGK") {
                                    $start = "JAKARTA";
                                } else if ($row['start'] == "DPS") {
                                    $start = "DENPASAR";
                                } else {
                                    $start = "";
                                }
                            ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2"><?php echo  $row['tgl_ber'] ?></td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <div><b><a href="#EXE_DIV1" class="text-blue-600 hover:underline" onclick="load_content(<?php echo $row['id'] ?>);open_book(<?php echo $row['id'] ?>)"><?php echo $judul ?></a></b></div>
                                        <div><?php echo $row['negara'] ?></div>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2"><?php echo $row['pax_tour'] ?></td>
                                    <td class="border border-gray-300 px-4 py-2"><?php echo $detail ?></td>
                                    <td class="border border-gray-300 px-4 py-2"><?php echo $start ?></td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <div><?php echo "IDR " . number_format($row['gt'], 0, ".", ".") ?></div>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600" href="Admin/cetak_pt_website.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                                        <a class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600" href="Admin/cetak_pt_website_agent.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print Agent</a>
                                        <a class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600" href="https://wa.me/<?php echo $row['phone'] . '?text=' . $url_encode ?>" target="_BLANK"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <section id="EXE_MAIN" class="py-8">
                <div class="content-itin-detail text-justofy" id="EXE_DIV1">
                    <?php
                    $x = 1;
                    for ($c = 1; $c <= $json_day; $c++) {
                        $queryRute = "SELECT * FROM LT_add_rute WHERE tour_id='" . $row_data['tour_id'] . "' AND hari='$x'";
                        $rsRute = mysqli_query($con, $queryRute);
                        $rowRute = mysqli_fetch_array($rsRute);

                        $queryMeal = "SELECT * FROM LT_add_meal WHERE tour_id='" . $row_data['tour_id'] . "' AND hari='$x'";
                        $rsMeal = mysqli_query($con, $queryMeal);
                        $rowMeal = mysqli_fetch_array($rsMeal);

                        $set_meal = "";
                        if (!empty($rowMeal) && ($rowMeal['bf'] != '0' || $rowMeal['ln'] != '0' || $rowMeal['dn'] != '0')) {
                            $b = $rowMeal['bf'] != '0' ? "B" : "";
                            $l = $rowMeal['ln'] != '0' ? "L" : "";
                            $d = $rowMeal['dn'] != '0' ? "D" : "";
                            $set_meal = "($b $l $d)";
                        }
                    ?>
                        <div class="border-b pb-4 mb-4">
                            <h3 class="font-bold text-xl mb-3 text-gray-800">
                                <?php echo "Day $x: " . htmlspecialchars($rowRute['nama'] ?? '') . " " . htmlspecialchars($set_meal); ?>
                            </h3>
                            <ul class="list-disc pl-6 text-gray-700">
                                <?php
                                $queryTmp = "SELECT * FROM LT_add_listTmp WHERE tour_id='" . $row_data['tour_id'] . "' AND hari='$x' ORDER BY urutan ASC";
                                $rsTmp = mysqli_query($con, $queryTmp);
                                while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                    $query_tempat2 = "SELECT * FROM List_tempat WHERE id=" . intval($rowTmp['tempat']);
                                    $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                    $row_tempat2 = mysqli_fetch_array($rs_tempat2);

                                    $query_ops = "SELECT * FROM LT_add_ops WHERE master_id='" . $row_data['master_id'] . "' AND hari='$x' AND urutan='" . $rowTmp['urutan'] . "'";
                                    $rs_ops = mysqli_query($con, $query_ops);
                                    $row_ops = mysqli_fetch_array($rs_ops);

                                    $optional = isset($row_ops['optional']) && $row_ops['optional'] == '1' ? " (Optional)" : "";
                                ?>
                                    <li>
                                        <strong><?php echo htmlspecialchars($row_tempat2['tempat2'] ?? '') . $optional; ?></strong>
                                        <p class="font-normal text-sm tracking-wide text-justify"> <?php echo strip_tags($row_tempat2['keterangan'] ?? ''); ?></p>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <?php
                            $queryHotel = "SELECT * FROM LT_add_pilihHotel WHERE tour_id='" . $row_data['tour_id'] . "' AND hari='$x'";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            $rowHotel = mysqli_fetch_array($rsHotel);

                            if (!empty($rowHotel) && isset($rowHotel['hotel']) && $rowHotel['hotel'] == "1") {
                            ?>
                                <p class="font-bold mt-3 text-gray-800">Menginap di Hotel Sesuai Pilihan Itinerary</p>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                        $x++;
                    }
                    ?>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md mt-6">
                    <h2 class="text-lg font-bold mb-4">Include</h2>
                    <ul class="list-disc pl-5 text-gray-700">
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
                                echo "<li>" . $val_arr_tmp['nama'] . "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md mt-6">
                    <h2 class="text-lg font-bold mb-4">Exclude</h2>
                    <ul class="list-disc pl-5 text-gray-700">
                        <?php
                        foreach ($arr_ex as $val_auto2) {
                            $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto2'";
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
                <div class="bg-gray-100 p-6 rounded-lg shadow-md mt-6">
                    <h2 class="text-lg font-bold mb-4">Syarat & Ketentuan</h2>
                    <ul class="list-disc pl-5 text-gray-700">
                        <li>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour. No Refund/pengembalian jika ada pembatalan dari peserta.</li>
                        <li>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour.</li>
                        <li>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian/kerusakan barang bawaan masing-masing peserta, force majeur, dan bencana alam lainnya, delay dari pesawat udara/kereta/alat-alat transportasi lainnya.</li>
                        <li>Jika hotel-hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</li>
                        <li>TIDAK ADA pengembalian biaya tour/tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</li>
                        <li>Performa Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta/menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sebagai penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</li>
                    </ul>
                </div>
            </section>
        </div>
    <?php
    }
    ?>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                multidate: true,
                minDate: 'today',
                dateFormat: "yy-mm-dd",
                beforeShowDay: function(date) {
                    var xx = document.getElementById("tgl_fl").value;
                    var fl = xx.split("-");
                    var day = String(date.getDay());
                    if (fl.includes(day)) {
                        return [true, "ui-highlight"];
                    } else {
                        return [false];
                    }
                },
                onSelect: function(date, datepicker) {
                    if (date != "") {
                        document.getElementById("tgl").value = date;
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#hotelModal').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.ajax({
                    url: "modal_form_hotel.php",
                    method: "POST",
                    asynch: false,
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('.modal-data-hotel').html(data);
                    }
                });
            });
        });
    </script>
    <script>
        function load_content(x) {
            $.ajax({
                url: "content-detail-rute.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    $('.content-itin-detail').html(data);
                    open_book(x);
                }
            });
        }

        function open_book(x) {
            $.ajax({
                url: "pt_book_summary.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    // load_content(x);
                    $('.room-book').html(data);
                }
            });
        }

        function chck_price(x) {
            let formData = new FormData();
            var room = document.getElementById("room").value;
            for (i = 1; i <= room; i++) {

                var adt = document.getElementById('adt_room_' + i).value;
                var chd = document.getElementById('chd_room_' + i).value;

                formData.append('adt' + i, adt);
                formData.append('chd' + i, chd);
            }
            formData.append('id', x);
            formData.append('room', room);
            $.ajax({
                type: 'POST',
                url: "pt_book_price.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    $('.book-price').html(msg);
                }
            });
        }

        function fungsi_more() {
            var li = document.getElementById('val_li').value;
            // alert(li);
            $.ajax({
                url: "more-landtour.php",
                method: "POST",
                asynch: false,
                data: {
                    id: li,
                },
                success: function(data) {
                    var more = parseInt(li) + 6;
                    document.getElementById("val_li").value = more;
                    $('.more-landtour').html(data);
                }
            });
        }

        function fungsi_cari() {
            var cari = document.getElementById('cari').value;
            $.ajax({
                url: "search-landtour.php",
                method: "POST",
                asynch: false,
                data: {
                    cari: cari,
                },
                success: function(data) {
                    $('.search').html(data);
                    $('.more-landtour').html('');
                }
            });
        }

        function get_hotel(x, y) {
            var adt = document.getElementById("adt").value;
            var inf = document.getElementById("inf").value;
            $.ajax({
                url: "hotel-content.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    master: y,
                    adt: adt,
                    inf: inf

                },
                success: function(data) {
                    $('.content-opsi').html(data);
                }
            });
        }

        function tambah_adt_room(x) {

            // var total_adt = document.getElementById("total_adt").value;
            // var total_adt_int = parseInt(total_adt);
            // const total = cek_total_adt();
            // if (total_adt_int > total) {
            var adt_room = document.getElementById("adt_room_" + x).value;
            var cek = parseInt(adt_room);
            var tambah = cek + 1;
            if (tambah >= 3) {
                alert("Maksimal Orang Dewasa dalam kamar, 2 orang !");
            } else {
                document.getElementById("adt_room_" + x).value = tambah;
            }
            // } else {
            //     alert("Total Peserta Tidak Sesuai !");
            // }
        }

        function kurang_adt_room(x) {
            var adt_room = document.getElementById("adt_room_" + x).value;
            var cek = parseInt(adt_room);
            var kurang = cek - 1;
            if (cek <= 1) {
                alert("Minimal Orang Dewasa dalam kamar, 1 orang !");
            } else {
                document.getElementById("adt_room_" + x).value = kurang;
            }
        }

        function tambah_chd_room(x) {

            // var total_chd = document.getElementById("total_chd").value;
            // var total_chd_int = parseInt(total_chd);
            // const total = cek_total_chd();
            // if (total_chd_int > total) {
            var chd_room = document.getElementById("chd_room_" + x).value;
            var cek = parseInt(chd_room);
            var tambah = cek + 1;
            if (tambah >= 3) {
                alert("Maksimal Anak-anak dalam kamar, 2 orang !");
            } else {
                document.getElementById("chd_room_" + x).value = tambah;
            }
            // } else {
            //     alert("Total Peserta Tidak Sesuai !");
            // }
        }

        function kurang_chd_room(x) {
            var chd_room = document.getElementById("chd_room_" + x).value;
            var cek = parseInt(chd_room);
            var kurang = cek - 1;
            document.getElementById("chd_room_" + x).value = kurang;
            if (cek <= 0) {
                alert("Minimal, 1 orang !");
            } else {
                document.getElementById("chd_room_" + x).value = kurang;
            }
        }

        function tambah_room() {
            var room = document.getElementById('room').value;
            var tambah = parseInt(room) + 1;
            document.getElementById("room").value = tambah;
            $('#room-list').html('');
            room_list();
        }

        function kurang_room() {
            var room = document.getElementById('room').value;

            var kurang = parseInt(room) - 1;
            // if (kurang > 0) {
            document.getElementById("room").value = kurang;
            $('#room-list').html('');
            room_list();
        }

        function room_list() {
            var room = document.getElementById("room").value;
            $.ajax({
                url: "roomlist-content.php",
                method: "POST",
                asynch: false,
                data: {
                    room: room,
                },
                success: function(data) {
                    $('#room-list').html(data);
                }
            });
        }
    </script>
</body>
<?php
include "footer.php";
?>

</html>