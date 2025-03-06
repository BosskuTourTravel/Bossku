<?php
include "db=connection.php";
include "API/Price/Api_LT_total_baru.php";
include "api_cetak_rute_detail.php";


$query_cek = "SELECT paket_tour_online.*, LTSUB_itin.judul,LTSUB_itin.landtour,LTSUB_itin.master_id,LTSUB_itin.hari,LT_change_judul.nama as change_judul,LTP_insert_sfee.ket as staff_id,login_staff.name as staff_name,login_staff.phone FROM paket_tour_online INNER JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id lEFT JOIN LT_change_judul ON paket_tour_online.tour_id=LT_change_judul.copy_id && paket_tour_online.grub_id=LT_change_judul.grub_id INNER JOIN LTP_insert_sfee ON paket_tour_online.sfee_id=LTP_insert_sfee.id INNER JOIN login_staff ON LTP_insert_sfee.ket=login_staff.id where paket_tour_online.id='".$_POST['id']."'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
if (isset($row_cek['id'])) {
    $tmb = 0;
    $start_date = '';
    $arr_in = [];
    $arr_ex = [];
    $val_check = [0];
    $judul = "";

    if (isset($row_cek['change_judul'])) {
        $judul = $row_cek['change_judul'];
    } else {
        $judul = $row_cek['judul'];
    }


    $query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_cek['tour_id'] . "' && master_id='" . $row_cek['master_id'] . "' && grub_id='" . $row_cek['grub_id'] . "'";
    $rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
    $row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);
    if (isset($row_cek_addhari['plus_hari'])); {
        $tmb = $row_cek_addhari['plus_hari'];
    }
    if (isset($row_cek['tgl_ber'])) {
        $start_date = $row_cek['tgl_ber'];
    }
    // var_dump($query_cek_addhari);
    $json_day = $row_cek['hari'] + $tmb;

    ///////////////// lain - lain ///////////////


    $guide_price = '';
    $tl_price = '';
    $porter_price = '';
    $detail_visa = "";
    $data_visa = array(
        "master_id" => $row_cek['master_id'],
        "copy_id" => $row_cek['tour_id'],
        "check_id" => '8'
    );
    $show_visa = get_total($data_visa);
    $result_visa = json_decode($show_visa, true);
    foreach ($result_visa['detail'] as $detail) {
        $detail_visa .= " " . $detail;
    }

    $data_porter = array(
        "master_id" => $row_cek['master_id'],
        "copy_id" => $row_cek['tour_id'],
        "check_id" => '37'
    );

    $show_porter = get_total($data_porter);
    $result_porter = json_decode($show_porter, true);
    if ($result_porter['adt'] != 0) {
        $porter_price = "Rp." . number_format($result_porter['adt'], 0, ",", ".");
    }


    $data_tl = array(
        "master_id" => $row_cek['master_id'],
        "copy_id" => $row_cek['tour_id'],
        "check_id" => '27'
    );

    $show_tl = get_total($data_tl);
    $result_tl = json_decode($show_tl, true);
    if ($result_tl['adt'] != 0) {
        $tl_price = "Rp." . number_format($result_tl['adt'], 0, ",", ".");
    }


    $data_guide = array(
        "master_id" => $row_cek['master_id'],
        "copy_id" => $row_cek['tour_id'],
        "check_id" => '26'
    );

    $show_guide = get_total($data_guide);
    $result_guide = json_decode($show_guide, true);
    if ($result_guide['adt'] != 0) {
        $guide_price = "Rp." . number_format($result_guide['adt'], 0, ",", ".");
    }

    $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_cek['tour_id'] . "' && master_id='" . $row_cek['master_id'] . "'";
    $rs_adm = mysqli_query($con, $query_adm);
    $row_adm = mysqli_fetch_array($rs_adm);
    // var_dump($query_adm);
    $include = [];
    $exclude = [];
    if (isset($row_adm['id'])) {
        $data_adm_inc = explode(",", $row_adm['include']);
        $data_adm_exc = explode(",", $row_adm['exclude']);

        foreach ($data_adm_inc as $val_tmp) {

            $query_tmp = "SELECT id,tempat FROM  List_tempat where id='" . $val_tmp . "'";
            $rs_tmp = mysqli_query($con, $query_tmp);
            $row_tmp = mysqli_fetch_array($rs_tmp);

            $tmp_name = isset($row_tmp['tempat']) ? $row_tmp['tempat'] : '';
            array_push($include, $tmp_name);
        }
        foreach ($data_adm_exc as $val_tmp2) {

            $query_tmp3 = "SELECT id,tempat FROM  List_tempat where id='" . $val_tmp2 . "'";
            $rs_tmp3 = mysqli_query($con, $query_tmp3);
            $row_tmp3 = mysqli_fetch_array($rs_tmp3);

            $tmp_name3 = isset($row_tmp3['tempat']) ? $row_tmp3['tempat'] : '';
            array_push($exclude, $tmp_name3);
        }
    }


    ////////////// include
    $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_cek['tour_id'] . "' && master_id='" . $row_cek['master_id'] . "'";
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
                        "master_id" => $row_cek['master_id'],
                        "copy_id" => $row_cek['tour_id'],
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

    /////////////////////

?>
<div class="justify-content-center align-items-center h4 text-center p-2"><?php echo $judul ?></div>
    <div class="row">
        <div class="col-md-8">
            <div class="accordion accordion-flush" id="accordion-tmp">
                <?php
                $x = 1;
                $arr_hl = [];
                $date_plus = 0;
                $cek_hari = 1;
                for ($c = 1; $c <= $json_day; $c++) {
                    $date = date('Y-m-d', strtotime("+ " . $date_plus . " day", strtotime($start_date)));
                    $query_cek_hari = "SELECT  id ,hari FROM  LT_AH_Main where copy_id='" . $row_cek['tour_id'] . "' && master_id='" . $row_cek['master_id'] . "' && grub_id='" . $row_cek['grub_id'] . "' && hari='$c'";
                    $rs_cek_hari = mysqli_query($con, $query_cek_hari);
                    $row_cek_hari = mysqli_fetch_array($rs_cek_hari);

                    if (isset($row_cek_hari['id'])) {
                        $data_print = array(
                            "copy" => $row_cek['tour_id'],
                            "master" => $row_cek['master_id'],
                            "sfee_id" => $row_cek['sfee_id'],
                            "grub_id" => $row_cek['grub_id'],
                            "c" => $c,
                            "date" => $date,
                            "cek_hari" => $row_cek_hari['hari'],
                            "json_day" => $json_day,
                        );
                        add_rute_AH($data_print);
                    } else {
                        $data_print = array(
                            "copy" => $row_cek['tour_id'],
                            "master" => $row_cek['master_id'],
                            "sfee_id" => $row_cek['sfee_id'],
                            "grub_id" => $row_cek['grub_id'],
                            "c" => $c,
                            "date" => $date,
                            "cek_hari" => $cek_hari,
                            "json_day" => $json_day,
                        );
                        // var_dump($data_print);
                        add_rute_AH($data_print);
                        $cek_hari++;
                    }
                    $date_plus++;
                    $x++;
                }
                ?>
            </div>
            <div style="padding: 20px;"></div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Include
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
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
                                if (is_array($include)) {
                                    foreach ($include as $val_arr_tmp) {
                                        echo "<li>" . $val_arr_tmp . "</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Exclude
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <?php
                                foreach ($arr_ex as $val_auto2) {
                                    $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto2'";
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
                                if (is_array($exclude)) {
                                    foreach ($exclude as $val_arr_tmp2) {
                                        echo "<li>" . $val_arr_tmp2 . "</li>";
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Syarat & Ketentuan
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour . No
                                    Refund/pengembalian jika ada pembatalan dari peserta</li>
                                <li>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour
                                </li>
                                <li>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian
                                    / kerusakan barang bawaan masing - masing peserta, force majeur, dan
                                    bencana alam lainya, delay dari pesawat udara / kereta / alat - alat
                                    transportasi lainnya</li>
                                <li>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata
                                    penuh, tour operator berhak mengganti dengan hotel lain yang setaraf
                                    sesuai dengan pertimbangan dan konfirmasinya.</li>
                                <li>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena
                                    diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau
                                    ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</li>
                                <li>Performa Tour & Travel berhak membatalkan keberangkatan seandainya
                                    peserta tidak mencapai jumlah minimum peserta / menunda jadwal
                                    keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan
                                    oleh Performa Tour & Travel sbg penyelenggara tour adalah keputusan
                                    mutlak dan tidak dapat diganggu gugat.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="room-book"></div>
            <div class="book-price"></div>
        </div>
    </div>
<?php
}

?>