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

include "../site.php";
include "../db=connection.php";
?>
<?php
$data = $_GET['id'];
$query_data = "SELECT * FROM  Prev_itin where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$val_data = json_decode($row_data['data'], true);

// var_dump($val_data['day']);
$json_day = $val_data['day'];

?>

<body>
    <div class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header">
                <div class="gmb">
                    <img src="dist/img/header_performa.png" alt="header">
                </div>
            </div>
        </div>
        <div style="padding: 20px;">
            <div class="row">
                <?php
                foreach ($val_data['gambar'] as $gmb) {
                ?>
                    <div class="col">
                        <img src="https://www.2canholiday.com/Admin/images/<?php echo $gmb['filename'] ?>" width="100%" height="100%" />
                    </div>
                <?php
                }
                ?>
                <!-- <div class="col">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                </div>
                <div class="col">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                </div>
                <div class="col">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                </div>
                <div class="col">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                </div> -->
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 12pt;">
            <div class="row">
                <div class="col-md-3">TOTAL PESERTA :</div>
                <div class="col-md-3"><?php echo $val_data['total_pax'] ?></div>
                <div class="col-md-3">TOUR LEADER :</div>
                <div class="col-md-3"><?php echo $val_data['tl'] ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">TOTAL BONUS PESERTA :</div>
                <div class="col-md-3"><?php echo $val_data['total_bonus_peserta'] ?></div>
                <div class="col-md-3">GUIDE</div>
                <div class="col-md-3"><?php echo $val_data['guide'] ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">TOTAL PESERTA TERMASUK BNS,TL , GUIDE ,DRIVER & PDT </div>
                <div class="col-md-3"><?php echo $val_data['total_all'] ?></div>
                <div class="col-md-3">DRIVER</div>
                <div class="col-md-3"><?php echo $val_data['driver'] ?></div>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
            <?php echo $val_data['nama'] ?>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <!-- loop day disini -->
            <?php
            $x = 1;
            foreach ($json_day as $loop_day) {
            ?>
                <div class="row">
                    <div class="col-md-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $x ?></u></div>
                    <div class="col-md-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                        <div style="font-size: 14pt;"><u><b><?php echo $loop_day['rute'] ?></b></u>
                            <?php
                            if ($loop_day['guest_breakfast'] != "" or $loop_day['guest_breakfast'] != "" or $loop_day['guest_breakfast'] != "") {
                                $b = "";
                                $l = "";
                                $d = "";
                                if ($loop_day['guest_breakfast'] != "") {
                                    $b = "B";
                                }
                                if ($loop_day['guest_lunch'] != "") {
                                    $l = "L";
                                }
                                if ($loop_day['guest_dinner'] != "") {
                                    $d = "D";
                                }
                                echo "(" . $b . $l . $d . ")";
                            }
                            ?>
                        </div>
                        <!-- class tempat -->
                        <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
                            <?php
                            foreach ($loop_day['sel_trans'] as $val_pilihan) {
                                if ($val_pilihan['type'] == '1') {
                                    if ($val_pilihan['transport_type'] == "flight") {
                            ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-plane" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                                        </div>
                                    <?php
                                    } else if ($val_pilihan['transport_type'] == "ferry") {
                                    ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-ship" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                                        </div>
                                    <?php
                                    } else if ($val_pilihan['transport_type'] == "land") {
                                    ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-bus" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div style="font-weight: bold;">
                                            <i class="fa fa-train" style="padding-right: 10px;"></i><?php echo $val_pilihan['transport_type'] . " : " . $val_pilihan['transport_name'] ?>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                <?php
                                } else {
                                    // var_dump($val_pilihan['tujuan']);
                                    $query_tmp = "SELECT * FROM  List_tempat where id='" . $val_pilihan['tujuan'] . "'";
                                    $rs_tmp = mysqli_query($con, $query_tmp);
                                    $row_tmp = mysqli_fetch_array($rs_tmp);
                                ?>
                                    <div style="padding-left: 20px;">
                                        <b><?php echo $row_tmp['tempat'] . " " ?></b><?php echo $row_tmp['keterangan'] ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- end tempat -->
                        <!-- <div style="font-size: 12pt;">
                            <div class="row">
                                <div class="col-md-3">BREAKFAST</div>
                                <div class="col-md-9">: <?php echo $loop_day['guest_breakfast'] ?></div>
                            </div>
                        </div>
                        <div style="font-size: 12pt;">
                            <div class="row">
                                <div class="col-md-3">LUNCH</div>
                                <div class="col-md-9">: <?php echo $loop_day['guest_lunch'] ?></div>
                            </div>
                        </div>
                        <div style="font-size: 12pt;">
                            <div class="row">
                                <div class="col-md-3">Dinner</div>
                                <div class="col-md-9">: <?php echo $loop_day['guest_dinner'] ?></div>
                            </div>
                        </div> -->
                        <div style="font-weight: bold; font-size: 12pt;">
                            <div class="row">
                                <div class="col-md-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                <div class="col-md-9">: <?php echo $loop_day['guest_hotel_name'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding:2px"></div>
            <?php
                $x++;
            }
            ?>
        </div>
        <div style="padding-top: 20px;"></div>
        <!-- <div style="padding: 5px 20px; font-size: 12px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">TB</th>
                        <th scope="col">BP</th>
                        <th scope="col">TL</th>
                        <th scope="col">GUI</th>
                        <th scope="col">DRI</th>
                        <th scope="col">TP</th>
                        <th scope="col">ADT</th>
                        <th scope="col">CHD</th>
                        <th scope="col">INF</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>LAND TOUR</td>
                        <td>20</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>26</td>
                        <td>2150000</td>
                        <td>1900000</td>
                        <td>2650000</td>
                    </tr>
                    <tr>
                        <td>TRANSPORT WHOLE TRIP PER PAX</td>
                        <td>20</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>26</td>
                        <td>2150000</td>
                        <td>1900000</td>
                        <td>2650000</td>
                    </tr>
                    <tr>
                        <td>ADM TICKET & HOTEL PER PAX</td>
                        <td>20</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>26</td>
                        <td>2150000</td>
                        <td>1900000</td>
                        <td>2650000</td>
                    </tr>
                    <tr>
                        <td>TOUR LEADER, PDT, & BONUS PESERTA</td>
                        <td>20</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>26</td>
                        <td>2150000</td>
                        <td>1900000</td>
                        <td>2650000</td>
                    </tr>

                </tbody>
            </table>

        </div> -->
        <div style="padding-top: 20px;"></div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Airline</th>
                                <th scope="col" colspan="6" style="text-align: center;">HARGA PAKET TOUR </th>
                            </tr>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">ADULT </th>
                                <th scope="col">CLD/TWN</th>
                                <th scope="col">CWB</th>
                                <th scope="col">CNB</th>
                                <th scope="col">INFANT</th>
                                <th scope="col">SINGLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Singapore Airlines</td>
                                <td>20</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>Garuda Indonesia</td>
                                <td>20</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>Citilink</td>
                                <td>20</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>Sriwijaya Air</td>
                                <td>20</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>26</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table class="table table-bordered table-sm" style="font-size: 11pt; text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">Biaya Tambahan</th>
                                <th scope="col" style="text-align: center;">TOTAL BIAYA/ORG DEWASA (1 kmr berdua)</th>
                            </tr>
                            <tr>
                                <th scope="col">TIPS GUIDE</th>
                                <th scope="col">Visa</th>
                                <th scope="col">TAX </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rp.<?php echo number_format($val_data['tcf_guide'], 0, ".", ".") ?></td>
                                <td></td>
                                <td></td>
                                <td>Rp.<?php echo  number_format($val_data['th_twin'], 0, ".", ".") ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div style="padding-top: 20px;"></div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div class="row">
                <div class="col-md-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TERMASUK : </u></div>
                    <div>
                        <?php
                        foreach ($val_data['include'] as $include) {
                            $query_include = "SELECT * FROM checkbox_include where id=" . $include;
                            $rs_include = mysqli_query($con, $query_include);
                            $row_include = mysqli_fetch_array($rs_include);
                        ?>
                            <li><?php echo $row_include['nama'] ?></li>
                        <?php
                        }

                        ?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TIDAK TERMASUK : </u></div>
                    <div>
                        <ul>
                            <?php
                            foreach ($val_data['exclude'] as $include) {
                                $query_include = "SELECT * FROM checkbox_include where id=" . $include;
                                $rs_include = mysqli_query($con, $query_include);
                                $row_include = mysqli_fetch_array($rs_include);
                            ?>
                                <li><?php echo $row_include['nama'] ?></li>
                            <?php
                            }

                            ?>
                        </ul>
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
                <div>Penggantian nama peserta 3 minggu sebelum keberangkatan dikenai charge SGD 150.</div>
                <div>PERFORMA tidak bertanggung jawab atas kecelakaan, kehilangan, pencurian / kerusakan barang bawaan masing - masing peserta, force majeur, dan bencana alam lainya, delay dari pesawat udara / kereta / alat - alat transportasi lainnya untuk berangkat da</div>
                <div>Jika hotel - hotel yang telah ditetapkan dalam acara tour ternyata penuh, tour operator berhak mengganti dengan hotel lain yang setaraf sesuai dengan pertimbangan dan konfirmasinya.</div>
                <div>TIDAK ADA pengembalian biaya tour / tiket yang tidak terpakai karena diluar kemampuan kami, sehingga batal (termasuk visa yang ditolak atau ditolak masuk oleh pihak imigrasi negara yang dituju, dll).</div>
                <div>Performa Tour & Travel berhak membatalkan keberangkatan seandainya peserta tidak mencapai jumlah minimum peserta / menunda jadwal keberangkatan. Segala langkah dan keputusan yang diambil atau diputuskan oleh Performa Tour & Travel sbg penyelenggara tour adalah keputusan mutlak dan tidak dapat diganggu gugat.</div>
            </div>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>