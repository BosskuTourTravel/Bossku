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
include "Api_LT_total.php";

$data = $_GET['id'];

?>

<body>
    <div class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header">
                <div class="gmb">
                    <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: 1010px;">
                </div>
            </div>
        </div>
        <div style="text-align: center; font-family: sans-serif; padding: 30px 10px; font-weight: bold;">
            <H1>8D7N AMAZING JAPAN TOKYO - OSAKA - KYOTO</H1>
        </div>
        <div class="hg" style="font-style: oblique;">
            <div class="container">
                <b>HIGHLIGHT :</b>
                <p> Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample,Kyoto Tample</p>
            </div>
        </div>
        <div class="content-itin" style="padding-bottom: 15px;">
            <div class="container">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-9" style="font-weight: bold;">
                        <div>
                            <h3 style="margin: 0px;">DAY 1 NARITA - TOKYO -OSAKA</h3>
                        </div>
                        <div style="font-weight: 9pt; color: gray; font-style: italic;">Breakfast - Lunch - Dinner</div>

                    </div>
                    <div class="col-3" style="text-align: right; font-weight: bold;">
                        <h3>04 JUN 2024</h3>
                    </div>
                </div>
                <div class="row" style="font-size: 9pt;">
                    <div class="col-6">
                        <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                        <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <div style="font-weight: bold; color: grey;">FERRY : BTC - HBF 19:00</div>
                        <div style="font-weight: bold; color: grey;">TRAIN : SHINKANSEN 300P 07:00</div>
                    </div>
                </div>
                <div class="tempat" style="font-size: 12pt;">
                    <div>
                        <p style="margin: 0px; text-align: justify;"><b>Mengunjungi Bandara International Narita </b> lalu dijemput dengan menggunakan Private Bus menuju hotel untuk menitipkan Koper. Kemudian kita akan mengunjungi Shibuya Crossing, Setelah itu kita juga akan melihat patung Hachiko yang adalah patung anjing Jepang setia. Selanjutnya kita berkunjung ke Harajuku ,
                            <b>Mengunjungi Bandara International Narita </b> lalu dijemput dengan menggunakan Private Bus menuju hotel untuk menitipkan Koper. Kemudian kita akan mengunjungi Shibuya Crossing, Setelah itu kita juga akan melihat patung Hachiko yang adalah patung anjing Jepang setia. Selanjutnya kita berkunjung ke Harajuku
                        </p>
                    </div>
                </div>
                <div class="hotel">
                    <b>HOTEL : *4(Q-Box Sanjiagang Hotel, Shanghai) </b>
                </div>
                <div class="gambar" style="padding: 10px;">
                    <div class="row">
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-itin" style="padding-bottom: 15px;">
            <div class="container">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-9" style="font-weight: bold;">
                        <div>
                            <h3 style="margin: 0px;">DAY 2 NARITA - TOKYO -OSAKA</h3>
                        </div>
                        <div style="font-weight: 9pt; color: gray; font-style: italic;">Breakfast - Lunch - Dinner</div>

                    </div>
                    <div class="col-3" style="text-align: right; font-weight: bold;">
                        <h3>05 JUN 2024</h3>
                    </div>
                </div>
                <div class="row" style="font-size: 9pt;">
                    <div class="col-6">
                        <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                        <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <div style="font-weight: bold; color: grey;">FERRY : BTC - HBF 19:00</div>
                        <div style="font-weight: bold; color: grey;">TRAIN : SHINKANSEN 300P 07:00</div>
                    </div>
                </div>
                <div class="tempat" style="font-size: 12pt;">
                    <div>
                        <p style="margin: 0px; text-align: justify;"><b>Mengunjungi Bandara International Narita </b> lalu dijemput dengan menggunakan Private Bus menuju hotel untuk menitipkan Koper. Kemudian kita akan mengunjungi Shibuya Crossing, Setelah itu kita juga akan melihat patung Hachiko yang adalah patung anjing Jepang setia. Selanjutnya kita berkunjung ke Harajuku ,
                            <b>Mengunjungi Bandara International Narita </b> lalu dijemput dengan menggunakan Private Bus menuju hotel untuk menitipkan Koper. Kemudian kita akan mengunjungi Shibuya Crossing, Setelah itu kita juga akan melihat patung Hachiko yang adalah patung anjing Jepang setia. Selanjutnya kita berkunjung ke Harajuku
                        </p>
                    </div>
                </div>
                <div class="hotel">
                    <b>HOTEL : *4(Q-Box Sanjiagang Hotel, Shanghai) </b>
                </div>
                <div class="gambar" style="padding: 10px;">
                    <div class="row">
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-itin" style="padding-bottom: 15px;">
            <div class="container">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-9" style="font-weight: bold;">
                        <div>
                            <h3 style="margin: 0px;">DAY 3 NARITA - TOKYO -OSAKA</h3>
                        </div>
                        <div style="font-weight: 9pt; color: gray; font-style: italic;">Breakfast - Lunch - Dinner</div>

                    </div>
                    <div class="col-3" style="text-align: right; font-weight: bold;">
                        <h3>06 JUN 2024</h3>
                    </div>
                </div>
                <div class="row" style="font-size: 9pt;">
                    <div class="col-6">
                        <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                        <div style="font-weight: bold; color: grey;">SQ 120 SUB-SIN 19:00-23:00</div>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <div style="font-weight: bold; color: grey;">FERRY : BTC - HBF 19:00</div>
                        <div style="font-weight: bold; color: grey;">TRAIN : SHINKANSEN 300P 07:00</div>
                    </div>
                </div>
                <div class="tempat" style="font-size: 12pt;">
                    <div>
                        <p style="margin: 0px; text-align: justify;"><b>Mengunjungi Bandara International Narita </b> lalu dijemput dengan menggunakan Private Bus menuju hotel untuk menitipkan Koper. Kemudian kita akan mengunjungi Shibuya Crossing, Setelah itu kita juga akan melihat patung Hachiko yang adalah patung anjing Jepang setia. Selanjutnya kita berkunjung ke Harajuku ,
                            <b>Mengunjungi Bandara International Narita </b> lalu dijemput dengan menggunakan Private Bus menuju hotel untuk menitipkan Koper. Kemudian kita akan mengunjungi Shibuya Crossing, Setelah itu kita juga akan melihat patung Hachiko yang adalah patung anjing Jepang setia. Selanjutnya kita berkunjung ke Harajuku
                        </p>
                    </div>
                </div>
                <div class="hotel">
                    <b>HOTEL : *4(Q-Box Sanjiagang Hotel, Shanghai) </b>
                </div>
                <div class="gambar" style="padding: 10px;">
                    <div class="row">
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                        <div class="col-4">
                            <img src="https://plus.unsplash.com/premium_photo-1682091715689-b6ab529fd9a3?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" height="200px" title="Spring">
                            <div style="font-style: italic; text-align: center; font-size: 9pt;">judul gambar 1</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="harga" style="padding: 10px 20px;">
            <div style="text-align: center; padding: 10px; font-weight: bold;">
                <h3>HARGA PAKET TOUR</h3>
            </div>
            <table class="table table-bordered table-sm" style="border-color: black;">
                <thead>
                    <tr>
                        <th>Flight Name</th>
                        <th>Depature Date</th>
                        <th>Pax</th>
                        <th>Twin</th>
                        <th>Single</th>
                        <th>CNB</th>
                        <th>Infant</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="min-width: 200px;">Singapore Airlines</td>
                        <td>2024 Jun : 03 ,07 ,10 ,14</td>
                        <td>10+1.0 pax</td>
                        <td>Rp.11.050.000</td>
                        <td>Rp.11.050.000</td>
                        <td>Rp.11.050.000</td>
                        <td>Rp.11.050.000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Hotel</td>
                        <td colspan="7">// Hari 1 : *4 (Dieshang Orchid Hotel, Huangshan) // Hari 2 : *4 (Dieshang Orchid Hotel, Huangshan) // Hari 3 : *4 (Suyuan Hotel, Suzhou) // Hari 4 : *4 (Q-Box Sanjiagang Hotel, Shanghai)
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="include" style="padding: 10px 40px;">
            <div class="row">
                <div class="col-6">
                    <div style="text-align: left; font-weight: bold; text-decoration: underline;">INCLUDE</div>
                    <ul>
                        <li>Tiket Pesawat International</li>
                        <li>Tax & Fuel Surcharge</li>
                        <li>Hotel</li>
                        <li>Visa CHINA SINGLE BIASA 5 DAYS From : SURABAYA</li>
                        <li>Tour Admission</li>
                        <li>Souvenir cantik</li>
                    </ul>
                </div>
                <div class="col-6">
                    <div style="text-align: left; font-weight: bold; text-decoration: underline;">EXCLUDE</div>
                    <ul>
                        <li>Asuransi Pariwisata</li>
                        <li>Modem</li>
                        <li>Tips Guide Rp.407.250</li>
                        <li>Tips Tour Leader</li>
                        <li>High dan Peak Season Surcharge (Mohon Hubungi kami)</li>
                        <li>Documen : Passport</li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="remarks" style="padding: 20px;">
            <div>REMARKS : </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas tempore consectetur, placeat reiciendis modi consequatur temporibus rerum recusandae laudantium distinctio, nemo maxime quis cum, vitae molestias vel explicabo alias aut?</p>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div style="font-size: 12pt;">
                <u><b>DEPOSIT, PEMBAYARAN & PEMBATALAN :</b></u>
            </div>
            <div>
                <div>Pendaftaran Uang Muka / Down Payment sebesar 50% dari Total Tour . No Refund/pengembalian jika ada pembatalan dari peserta</div>
                <div>Pembatalan 2 minggu sebelum keberangkatan dikenakan 75% dari biaya tour</div>
                <div>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya untuk berangkat da</div>
                <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
                <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
                <div>Performa Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
            </div>
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
    document.title = kode + "-" + judul;
    window.print();
</script>

</html>