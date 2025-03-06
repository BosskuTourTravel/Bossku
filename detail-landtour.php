<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php";
include "Admin/Api_LT_total.php";

$query_itin = "SELECT * FROM LT_itinnew where id=" . $_GET['id'];
$rs_itin = mysqli_query($con, $query_itin);
$row_itin = mysqli_fetch_array($rs_itin);

$query_lt = "SELECT * FROM  LT_itinerary2 where id='" . $_GET['master'] . "'";
$rs_lt = mysqli_query($con, $query_lt);
$row_lt = mysqli_fetch_array($rs_lt);
$json_day = $row_lt['hari'];
// var_dump($query_lt);

$val_tgl = [];
$arr_tgl = explode("-", $row_itin['tgl_brkt']);
foreach ($arr_tgl as $val) {
    if ($val == '7') {
        array_push($val_tgl, '0');
    } else {
        array_push($val_tgl, $val);
    }
}
$data_val = implode('-', $val_tgl);
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

    <div>
        <nav aria-label="breadcrumb" style="padding: 10px; background-color: whitesmoke; margin: auto;">
            <div style="text-align: center; padding: 15px; font-weight: bold; font-size: 16pt;">
                <?php echo $row_lt['judul'] ?>
            </div>
            <div class="content-landtour" style="text-align: center;">
                <div class="row" style="padding: 20px;">
                    <div class="col-md">
                        <div class="gallery">
                            <?php
                            $link2 = "https://drive.google.com/file/d/1ZX73bzx42Ox7qNldS6kY_z6XogQmBesH/view?usp=sharing";
                            $headers2 = explode('/', $link2);
                            $thumbnail = $headers2[5];
                            $thumbnail_gmb1 = $headers2[5];
                            $thumbnail_gmb2 = $headers2[5];
                            $thumbnail_gmb3 = $headers2[5];
                            $thumbnail_gmb4 = $headers2[5];
                            // var_dump($thumbnail_gmb1);

                            $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $_GET['master'] . "' order by id DESC limit 1";
                            $rs_main = mysqli_query($con, $query_main);
                            $row_main = mysqli_fetch_array($rs_main);
                            if (isset($row_main['id'])) {
                                if (isset($row_main['img1'])) {
                                    $query_sel_main1 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img1'] . "'";
                                    $rs_sel_main1 = mysqli_query($con, $query_sel_main1);
                                    $row_sel_main1 = mysqli_fetch_array($rs_sel_main1);
                                    $s1 = $row_sel_main1['tmp_type'];

                                    // var_dump($query_sel_main1);

                                    $link_gmb1 = $row_sel_main1[$s1];
                                    $headers_gmb1 = explode('/', $link_gmb1);
                                    $thumbnail_gmb1 = $headers_gmb1[5];
                            ?>
                                    <figure class="gallery__item gallery__item--1">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb1 ?>" alt="Gallery image 1" class="gallery__img">
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
                                    $val2 = $row_sel_main2['tempat'];
                                    $id_val2 = $row_sel_main2['id'];
                                ?>
                                    <figure class="gallery__item gallery__item--2">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb2 ?>" alt="Gallery image 2" class="gallery__img">
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
                                    $val3 = $row_sel_main3['tempat'];
                                    $id_val3 = $row_sel_main3['id'];
                                ?>
                                    <figure class="gallery__item gallery__item--3">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb3 ?>" alt="Gallery image 3" class="gallery__img">
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
                                    $val4 = $row_sel_main4['tempat'];
                                    $id_val4 = $row_sel_main4['id'];
                                ?>
                                    <figure class="gallery__item gallery__item--4">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb4 ?>" alt="Gallery image 4" class="gallery__img">
                                    </figure>
                                <?php
                                }
                            } else {
                                $query_sel_img = "SELECT * FROM  selected_img_tmp where tour_id ='" . $_GET['master'] . "' limit 4";
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
                                    <figure class="gallery__item gallery__item--<?php echo $x ?>">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Gallery image 1" class="gallery__img">
                                    </figure>
                                <?php
                                    $x++;

                                    $p = $x;
                                }
                                // echo $x;
                                for ($i = 5; $i < $x; $i++) {
                                ?>
                                    <figure class="gallery__item gallery__item--<?php echo $p ?>">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Gallery image 1" class="gallery__img">
                                    </figure>
                            <?php
                                    $p++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card" style="width: auto; height: 96%; background-color: #EEEDEB;">
                            <div class="card-body" style="text-align: left;">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: center;">
                                            <label>Tanggal Keberangkatan</label>
                                            <div id="datepicker" onclick="add_pr()"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <div class="form-group" style="padding: 5px;">
                                                <label>Dewasa</label>
                                                <div class="d-flex flex-row justify-content-between gap-1">
                                                    <button type="button" class="btn btn-warning" onclick="kurang_adt()"><i class="fa fa-minus"></i></button>
                                                    <input type="text" class="form-control" id="adt" disabled value="1">
                                                    <button type="button" class="btn btn-warning" onclick="tambah_adt()"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="form-group" style="padding: 5px;">
                                                <label>Anak-anak</label>
                                                <div class="d-flex flex-row justify-content-between gap-1">
                                                    <button type="button" class="btn btn-warning" onclick="kurang_inf()"><i class="fa fa-minus"></i></button>
                                                    <input type="text" class="form-control" id="inf" disabled value="0">
                                                    <button type="button" class="btn btn-warning" onclick="tambah_inf()"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div> -->
                                            <div class="form-group" style="padding: 5px;">
                                                <label>Room</label>
                                                <div class="d-flex flex-row justify-content-between gap-1">
                                                    <button type="button" class="btn btn-warning" onclick="kurang_room()"><i class="fa fa-minus"></i></button>
                                                    <input type="text" class="form-control" id="room" disabled value="1">
                                                    <button type="button" class="btn btn-warning" onclick="tambah_room()"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div style="padding: 10px 20px;"></div>
                                            <div style="text-align: right;">
                                                <!-- <a class="btn btn-warning tip" href="Data_promo/landtour_master_agent.php?id=<?php echo $_GET['master'] ?>" target="_BLANK" title="Cetak Flayer">Print Flayer</a> -->
                                                <button type="button" class="btn btn-success" onclick="get_hotel(<?php echo $_GET['id'] ?>,<?php echo $_GET['master'] ?>)">Check
                                                    Landtour
                                                </button>
                                                <a class="btn btn-warning btn-sm tip my-1" href="Admin/cetak_all_LTnew.php?id=<?php echo $_GET['master'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print Itinerary</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="tgl">
                                    <input type="hidden" name="tgl_fl" id="tgl_fl" value="<?php echo $data_val ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-opsi" style="padding: 20px; text-align: left;">
                </div>
                <div class="content-itin-detail" style="text-align: left; padding: 20px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="accordion accordion-flush" id="accordion-tmp">
                                <?php
                                $x = 1;
                                for ($c = 1; $c <= $json_day; $c++) {
                                    $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_lt['id'] . "' && hari='$x'";
                                    $rsRute = mysqli_query($con, $queryRute);
                                    $rowRute = mysqli_fetch_array($rsRute);

                                    $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row_lt['id'] . "' && hari='$x'";
                                    $rsMeal = mysqli_query($con, $queryMeal);
                                    $rowMeal = mysqli_fetch_array($rsMeal);
                                    $set_meal = "";
                                    if (isset($rowMeal['id'])) {
                                        if ($rowMeal['bf'] != '0' or $rowMeal['ln'] != '0' or $rowMeal['dn'] != '0') {
                                            $b = "";
                                            $l = "";
                                            $d = "";
                                            if ($rowMeal['bf'] != '0') {
                                                $b = "B";
                                            }
                                            if ($rowMeal['ln'] != '0') {
                                                $l = "L";
                                            }
                                            if ($rowMeal['dn'] != '0') {
                                                $d = "D";
                                            }
                                            $set_meal = "(" . $b . " " . $l . " " . $d . ")";
                                        }
                                    }
                                    // var_dump($queryMeal);


                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $c ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $c ?>">
                                                <div style="font-weight: bold;">
                                                    <?php echo "Day " . $x . " : " . $rowRute['nama'] . " " . $set_meal ?>
                                                </div>
                                        </h2>
                                        <div id="flush-collapse<?php echo $c ?>" class="accordion-collapse collapse show" data-bs-parent="#accordion-tmp">
                                            <div class="accordion-body">
                                                <ul>
                                                    <?php
                                                    $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row_lt['id'] . "' && hari='$x' order by urutan ASC";
                                                    $rsTmp = mysqli_query($con, $queryTmp);
                                                    while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                                        $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
                                                        $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                                        $row_tempat2 = mysqli_fetch_array($rs_tempat2);

                                                        $query_ops = "SELECT * FROM LT_add_ops where master_id='" . $row_lt['id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp['urutan'] . "'";
                                                        $rs_ops = mysqli_query($con, $query_ops);
                                                        $row_ops = mysqli_fetch_array($rs_ops);

                                                        $queryHotel = "SELECT * FROM  LT_add_pilihHotel where tour_id='" . $row_lt['id'] . "' && hari='$x'";
                                                        $rsHotel = mysqli_query($con, $queryHotel);
                                                        $rowHotel = mysqli_fetch_array($rsHotel);

                                                        if (!isset($row_ops['id'])) {
                                                    ?>
                                                            <li><b>
                                                                    <?php echo $row_tempat2['tempat2'] . " " ?>
                                                                </b>
                                                                <?php echo $row_tempat2['keterangan'] ?>
                                                            </li>
                                                            <?php
                                                        } else {
                                                            if ($row_ops['optional'] == '1') {
                                                            ?>
                                                                <li><b>
                                                                        <?php echo $row_tempat2['tempat2'] . " (Optional) " ?>
                                                                    </b>
                                                                    <?php echo $row_tempat2['keterangan'] ?>
                                                                </li>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li><b>
                                                                        <?php echo $row_tempat2['tempat2'] . " " ?>
                                                                    </b>
                                                                    <?php echo $row_tempat2['keterangan'] ?>
                                                                </li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                                if (isset($rowHotel['hotel'])) {
                                                    if ($rowHotel['hotel'] == "1") {
                                                ?>
                                                        <div style="font-weight: bold;">
                                                            Menginap di Hotel Sesuai Pilihan Itinerary
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
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
                                                <li>Acara Tour & Transportasi Sesuai Jadwal Berdasarkan Gabungan Tour</li>
                                                <li>Hotel</li>
                                                <li>Meal Sesuai Jadwal</li>
                                                <li>Tour Admission</li>
                                                <li>Driver merangkap Guide Atau</li>
                                                <li>Jasa Pendampingan Guide</li>
                                                <li>Tour Leader Berbahasa Indonesia</li>
                                                <li>Souvenir cantik</li>
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
                                                <li>Tiket Pesawat International , Tax & Fuel Surcharge</li>
                                                <li>Tips Guide</li>
                                                <li>Tips Tour Leader</li>
                                                <li>Porter dan Biaya Pribadi</li>
                                                <li>Visa</li>
                                                <li>Asuransi Pariwisata</li>
                                                <li>Modem Wifi</li>
                                                <li>Documen : Passport</li>

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
                            <div class="room-set"></div>
                            <div class="content-booking"></div>
                            <div class="justify-content-center">
                                <?php
                                $query_video = "SELECT * FROM YT_Landtour where tour_id='" . $_GET['master'] . "'";
                                $rs_video = mysqli_query($con, $query_video);
                                $row_video = mysqli_fetch_array($rs_video);
                                if (isset($row_video['id'])) {
                                ?>
                                    <iframe width="210" height="372" src="https://www.youtube.com/embed/<?php echo $row_video['link'] ?>">
                                    </iframe>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
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

        // function tambah_inf() {
        //     var inf = document.getElementById('inf').value;
        //     var tambah = parseInt(inf) + 1;
        //     document.getElementById("inf").value = tambah;
        // }

        // function kurang_inf() {
        //     var inf = document.getElementById('inf').value;
        //     var kurang = parseInt(inf) - 1;
        //     if (kurang >= 0) {
        //         document.getElementById("inf").value = kurang;
        //     }
        // }

        // function tambah_adt() {
        //     var adt = document.getElementById('adt').value;
        //     var tambah = parseInt(adt) + 1;
        //     document.getElementById("adt").value = tambah;
        // }

        // function kurang_adt() {
        //     var adt = document.getElementById('adt').value;
        //     var kurang = parseInt(adt) - 1;
        //     if (kurang > 0) {
        //         document.getElementById("adt").value = kurang;
        //     }
        // }

        function tambah_room() {
            var room = document.getElementById('room').value;
            // var adt = document.getElementById('adt').value;
            var tambah = parseInt(room) + 1;
            // var cek_adt = parseInt(adt);
            // if (cek_adt >= tambah) {
            document.getElementById("room").value = tambah;
            // } else {
            //     alert("Jumlah Kamar tidak boleh lebih banyak dari Jumlah orang Dewasa");
            // }

        }

        function kurang_room() {
            var room = document.getElementById('room').value;

            var kurang = parseInt(room) - 1;
            // if (kurang > 0) {
            document.getElementById("room").value = kurang;
            // }
        }
    </script>
    <script>
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
            // var adt = document.getElementById("adt").value;
            // var inf = document.getElementById("inf").value;
            $.ajax({
                url: "hotel-content.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    master: y,
                    // adt: adt,
                    // inf: inf

                },
                success: function(data) {
                    $('.content-opsi').html(data);
                }
            });
        }
    </script>
</body>
<?php
include "footer.php";
?>

</html>