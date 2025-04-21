<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php"; // Perbaikan dari "db=connection.php"
include "Admin/Api_LT_total.php";

$query_itin = "SELECT * FROM LT_itinnew WHERE id=" . intval($_GET['id']);
$rs_itin = mysqli_query($con, $query_itin);
$row_itin = mysqli_fetch_array($rs_itin);

$query_lt = "SELECT * FROM LT_itinerary2 WHERE id='" . intval($_GET['master']) . "'";
$rs_lt = mysqli_query($con, $query_lt);
$row_lt = mysqli_fetch_array($rs_lt);
$json_day = $row_lt['hari'];

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

<body>
    <div class="container mx-auto px-4 py-16 mt-10">
        <!-- Title -->
        <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb-2">Paket Land Tour</h1>
        <nav aria-label="breadcrumb">
            <div class="text-3xl font-bold tracking-wide text-center">
                <?php echo htmlspecialchars($row_lt['judul']); ?>
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

                            $query_main = "SELECT * FROM selected_img_main WHERE tour_id ='" . intval($_GET['master']) . "' ORDER BY id DESC LIMIT 1";
                            $rs_main = mysqli_query($con, $query_main);
                            $row_main = mysqli_fetch_array($rs_main);
                            if (isset($row_main['id'])) {
                                if (isset($row_main['img1'])) {
                                    $query_sel_main1 = "SELECT selected_img_tmp.*, List_tempat_img.link, List_tempat_img.winter_img, List_tempat_img.autumn_img, List_tempat.tempat 
                                                        FROM selected_img_tmp 
                                                        LEFT JOIN List_tempat_img ON selected_img_tmp.tmp = List_tempat_img.tmp_id 
                                                        LEFT JOIN List_tempat ON selected_img_tmp.tmp = List_tempat.id 
                                                        WHERE selected_img_tmp.id ='" . intval($row_main['img1']) . "'";
                                    $rs_sel_main1 = mysqli_query($con, $query_sel_main1);
                                    $row_sel_main1 = mysqli_fetch_array($rs_sel_main1);
                                    $s1 = $row_sel_main1['tmp_type'];

                                    $link_gmb1 = $row_sel_main1[$s1];
                                    $headers_gmb1 = explode('/', $link_gmb1);
                                    $thumbnail_gmb1 = $headers_gmb1[5];
                            ?>
                                    <figure class="gallery__item gallery__item--1">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . htmlspecialchars($thumbnail_gmb1); ?>" alt="Gallery image 1" class="gallery__img">
                                    </figure>
                                <?php
                                }
                                if (isset($row_main['img2'])) {
                                    $query_sel_main2 = "SELECT selected_img_tmp.*, List_tempat_img.link, List_tempat_img.winter_img, List_tempat_img.autumn_img, List_tempat.tempat 
                                                        FROM selected_img_tmp 
                                                        LEFT JOIN List_tempat_img ON selected_img_tmp.tmp = List_tempat_img.tmp_id 
                                                        LEFT JOIN List_tempat ON selected_img_tmp.tmp = List_tempat.id 
                                                        WHERE selected_img_tmp.id ='" . intval($row_main['img2']) . "'";
                                    $rs_sel_main2 = mysqli_query($con, $query_sel_main2);
                                    $row_sel_main2 = mysqli_fetch_array($rs_sel_main2);
                                    $s2 = $row_sel_main2['tmp_type'];

                                    $link_gmb2 = $row_sel_main2[$s2];
                                    $headers_gmb2 = explode('/', $link_gmb2);
                                    $thumbnail_gmb2 = $headers_gmb2[5];
                                ?>
                                    <figure class="gallery__item gallery__item--2">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . htmlspecialchars($thumbnail_gmb2); ?>" alt="Gallery image 2" class="gallery__img">
                                    </figure>
                                <?php
                                }
                                if (isset($row_main['img3'])) {
                                    $query_sel_main3 = "SELECT selected_img_tmp.*, List_tempat_img.link, List_tempat_img.winter_img, List_tempat_img.autumn_img, List_tempat.tempat 
                                                        FROM selected_img_tmp 
                                                        LEFT JOIN List_tempat_img ON selected_img_tmp.tmp = List_tempat_img.tmp_id 
                                                        LEFT JOIN List_tempat ON selected_img_tmp.tmp = List_tempat.id 
                                                        WHERE selected_img_tmp.id ='" . intval($row_main['img3']) . "'";
                                    $rs_sel_main3 = mysqli_query($con, $query_sel_main3);
                                    $row_sel_main3 = mysqli_fetch_array($rs_sel_main3);
                                    $s3 = $row_sel_main3['tmp_type'];

                                    $link_gmb3 = $row_sel_main3[$s3];
                                    $headers_gmb3 = explode('/', $link_gmb3);
                                    $thumbnail_gmb3 = $headers_gmb3[5];
                                ?>
                                    <figure class="gallery__item gallery__item--3">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . htmlspecialchars($thumbnail_gmb3); ?>" alt="Gallery image 3" class="gallery__img">
                                    </figure>
                                <?php
                                }
                                if (isset($row_main['img4'])) {
                                    $query_sel_main4 = "SELECT selected_img_tmp.*, List_tempat_img.link, List_tempat_img.winter_img, List_tempat_img.autumn_img, List_tempat.tempat 
                                                        FROM selected_img_tmp 
                                                        LEFT JOIN List_tempat_img ON selected_img_tmp.tmp = List_tempat_img.tmp_id 
                                                        LEFT JOIN List_tempat ON selected_img_tmp.tmp = List_tempat.id 
                                                        WHERE selected_img_tmp.id ='" . intval($row_main['img4']) . "'";
                                    $rs_sel_main4 = mysqli_query($con, $query_sel_main4);
                                    $row_sel_main4 = mysqli_fetch_array($rs_sel_main4);
                                    $s4 = $row_sel_main4['tmp_type'];

                                    $link_gmb4 = $row_sel_main4[$s4];
                                    $headers_gmb4 = explode('/', $link_gmb4);
                                    $thumbnail_gmb4 = $headers_gmb4[5];
                                ?>
                                    <figure class="gallery__item gallery__item--4">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . htmlspecialchars($thumbnail_gmb4); ?>" alt="Gallery image 4" class="gallery__img">
                                    </figure>
                                <?php
                                }
                            } else {
                                $query_sel_img = "SELECT * FROM selected_img_tmp WHERE tour_id ='" . intval($_GET['master']) . "' LIMIT 4";
                                $rs_sel_img = mysqli_query($con, $query_sel_img);
                                $x = 1;
                                while ($row_sel_img = mysqli_fetch_array($rs_sel_img)) {
                                    $query_stmp = "SELECT List_tempat_img.id, List_tempat_img.link, List_tempat_img.summer_img, List_tempat_img.winter_img, List_tempat_img.autumn_img, List_tempat.tempat 
                                                    FROM List_tempat_img 
                                                    LEFT JOIN List_tempat ON List_tempat_img.tmp_id = List_tempat.id 
                                                    WHERE List_tempat_img.tmp_id ='" . intval($row_sel_img['tmp']) . "'";
                                    $rs_stmp = mysqli_query($con, $query_stmp);
                                    $row_stmp = mysqli_fetch_array($rs_stmp);

                                    $p = $row_sel_img['tmp_type'];
                                    $link = $row_stmp[$p];
                                    $headers = explode('/', $link);
                                    $thumbnail = $headers[5];
                                ?>
                                    <figure class="gallery__item gallery__item--<?php echo $x; ?>">
                                        <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . htmlspecialchars($thumbnail); ?>" alt="Gallery image <?php echo $x; ?>" class="gallery__img">
                                    </figure>
                            <?php
                                    $x++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="bg-gray-100 shadow-md rounded-lg p-6">
                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-2">Tanggal Keberangkatan</label>
                                    <div id="datepicker" class="border border-gray-300 rounded-md p-2 bg-white cursor-pointer overflow-hidden w-full"></div>
                                </div>
                                <div class="mt-6">
                                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                        <a class="bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-yellow-600 text-center font-semibold transition duration-300 ease-in-out transform hover:scale-105"
                                            href="Data_promo/landtour_master_agent.php?id=<?php echo $_GET['master'] ?>"
                                            target="_BLANK"
                                            title="Cetak Flayer">
                                            Print Flayer
                                        </a>
                                        <a class="bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-yellow-600 text-center font-semibold transition duration-300 ease-in-out transform hover:scale-105"
                                            href="Admin/cetak_all_LTnew.php?id=<?php echo $_GET['master'] ?>"
                                            target="_BLANK">
                                            <i class="fa fa-print mr-2"></i> Print Itinerary
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="tgl">
                            <input type="hidden" name="tgl_fl" id="tgl_fl" value="<?php echo $data_val ?>">
                        </form>
                    </div>
                </div>
                <div class="content-itin-detail text-left p-5 mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <?php
                            $x = 1;
                            for ($c = 1; $c <= $json_day; $c++) {
                                $queryRute = "SELECT * FROM LT_add_rute WHERE tour_id='" . $row_lt['id'] . "' AND hari='$x'";
                                $rsRute = mysqli_query($con, $queryRute);
                                $rowRute = mysqli_fetch_array($rsRute);

                                $queryMeal = "SELECT * FROM LT_add_meal WHERE tour_id='" . $row_lt['id'] . "' AND hari='$x'";
                                $rsMeal = mysqli_query($con, $queryMeal);
                                $rowMeal = mysqli_fetch_array($rsMeal);

                                $set_meal = "";
                                if ($rowMeal['bf'] != '0' || $rowMeal['ln'] != '0' || $rowMeal['dn'] != '0') {
                                    $b = $rowMeal['bf'] != '0' ? "B" : "";
                                    $l = $rowMeal['ln'] != '0' ? "L" : "";
                                    $d = $rowMeal['dn'] != '0' ? "D" : "";
                                    $set_meal = "($b $l $d)";
                                }
                            ?>
                                <div class="border-b pb-4 mb-4">
                                    <h3 class="font-bold text-xl mb-3 text-gray-800">
                                        <?php echo "Day $x: " . htmlspecialchars($rowRute['nama']) . " " . htmlspecialchars($set_meal); ?>
                                    </h3>
                                    <ul class="list-disc pl-6 text-gray-700">
                                        <?php
                                        $queryTmp = "SELECT * FROM LT_add_listTmp WHERE tour_id='" . $row_lt['id'] . "' AND hari='$x' ORDER BY urutan ASC";
                                        $rsTmp = mysqli_query($con, $queryTmp);
                                        while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                            $query_tempat2 = "SELECT * FROM List_tempat WHERE id=" . intval($rowTmp['tempat']);
                                            $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                            $row_tempat2 = mysqli_fetch_array($rs_tempat2);

                                            $query_ops = "SELECT * FROM LT_add_ops WHERE master_id='" . $row_lt['id'] . "' AND hari='$x' AND urutan='" . $rowTmp['urutan'] . "'";
                                            $rs_ops = mysqli_query($con, $query_ops);
                                            $row_ops = mysqli_fetch_array($rs_ops);

                                            $optional = isset($row_ops['optional']) && $row_ops['optional'] == '1' ? " (Optional)" : "";
                                        ?>
                                            <li>
                                                <strong><?php echo htmlspecialchars($row_tempat2['tempat2']) . $optional; ?></strong>
                                                <p class="font-normal text-sm tracking-wide text-justify"><?php echo htmlspecialchars($row_tempat2['keterangan']); ?></p>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                    $queryHotel = "SELECT * FROM LT_add_pilihHotel WHERE tour_id='" . $row_lt['id'] . "' AND hari='$x'";
                                    $rsHotel = mysqli_query($con, $queryHotel);
                                    $rowHotel = mysqli_fetch_array($rsHotel);

                                    if (isset($rowHotel['hotel']) && $rowHotel['hotel'] == "1") {
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
                        <div class="font-normal text-sm tracking-wide text-justify">
                            <div class="mb-8">
                                <h3 class="font-bold text-xl mb-3 text-gray-800">Include</h3>
                                <ul class="list-disc pl-6 text-gray-700">
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
                            <div class="mb-8">
                                <h3 class="font-bold text-xl mb-3 text-gray-800">Exclude</h3>
                                <ul class="list-disc pl-6 text-gray-700">
                                    <li>Tiket Pesawat International, Tax & Fuel Surcharge</li>
                                    <li>Tips Guide</li>
                                    <li>Tips Tour Leader</li>
                                    <li>Porter dan Biaya Pribadi</li>
                                    <li>Visa</li>
                                    <li>Asuransi Pariwisata</li>
                                    <li>Modem Wifi</li>
                                    <li>Dokumen: Passport</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl mb-3 text-gray-800">Syarat & Ketentuan</h3>
                                <ul class="list-disc pl-6 text-gray-700">
                                    <li>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour. No Refund/pengembalian jika ada pembatalan dari peserta.</li>
                                    <li>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour.</li>
                                    <li>Bossku tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing-masing peserta, force majeur, dan bencana alam lainnya, delay dari pesawat udara / kereta / alat transportasi lainnya.</li>
                                    <li>Jika hotel-hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</li>
                                    <li>Tidak ada pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</li>
                                    <li>Bossku Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sebagai penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </nav>
    </div>
    <script>
        $(function() {
            function adjustDatepicker() {
            if ($(window).width() < 768) {
                $("#datepicker").datepicker("option", "numberOfMonths", 1);
            } else {
                $("#datepicker").datepicker("option", "numberOfMonths", 2);
            }
            }

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

            adjustDatepicker();
            $(window).on("resize", adjustDatepicker);
        });

        function tambah_room() {
            var room = document.getElementById('room').value;
            var tambah = parseInt(room) + 1;
            document.getElementById("room").value = tambah;
        }

        function kurang_room() {
            var room = document.getElementById('room').value;
            var kurang = parseInt(room) - 1;
            if (kurang > 0) {
                document.getElementById("room").value = kurang;
            }
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