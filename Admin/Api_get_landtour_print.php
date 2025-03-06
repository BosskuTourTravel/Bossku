<?php
function data_print($x)
{
    include "../db=connection.php";
    include "Api_LT_total.php";
    include "../slug.php";

    $query2 = "SELECT * FROM  LT_itinerary2 where id =" . $x;
    $rs2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_array($rs2);
    $json_day = $row2['hari'];

    $arr_all_fl = [];
    $arr_all_fery = [];

    $query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $x . "'";
    $rs_cek = mysqli_query($con, $query_cek);
    $row_cek = mysqli_fetch_array($rs_cek);

?>
    <div>
        <div>
            <div class="header" style="text-align: center; border: 2px solid black; padding: 5px;">
                <div class="gmb">
                    <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: auto;">
                </div>
            </div>
            <div style="padding: 20px;">
                <div class="row">
                    <?php
                    if ($row_cek['img1'] != "") {
                        $link = $row_cek['img1'];
                        $headers = explode('/', $link);
                        $thumbnail = $headers[5];
                        // var_dump($thumbnail);
                    ?>
                        <div class="col">
                            <img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="100%" height="100%" style="max-height: 160px;" />
                        </div>
                        <?php
                    } else {
                        if ($row2['gambar1'] == "") {
                            // var_dump($domain_web);
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                            </div>
                        <?php
                        } else {
                            // var_dump($row2['gambar1']);
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/<?php echo $row2['gambar1'] ?>" width="100%" height="100%" style="max-height: 160px;" />
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
                        if ($row2['gambar2'] == "") {
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                            </div>
                        <?php

                        } else {
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/<?php echo $row2['gambar2'] ?>" width="100%" height="100%" style="max-height: 160px;" />
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
                        if ($row2['gambar3'] == "") {
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/<?php echo $row2['gambar3'] ?>" width="100%" height="100%" style="max-height: 160px;" />
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
                        if ($row2['gambar4'] == "") {
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/performalogo.png" width="100%" height="100%" style="max-height: 160px;" />
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col">
                                <img src="<?php echo $domain_web ?>Admin/images/<?php echo $row2['gambar4'] ?>" width="100%" height="100%" style="max-height: 160px;" />
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div style="padding: 5px 20px; font-size: 24px; font-weight: bold; text-align: center;">
                <?php echo $row2['judul'] ?>
            </div>
            <div style="padding: 5px 20px; font-size: 12px;">
                <!-- loop day disini -->
                <?php
                $x = 1;
                $arr_hl = [];
                for ($c = 1; $c <= $json_day; $c++) {

                    $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row2['id'] . "' && hari='$x'";
                    $rsRute = mysqli_query($con, $queryRute);
                    $rowRute = mysqli_fetch_array($rsRute);
                ?>
                    <div class="row">
                        <div class="col-2" style="border: 2px solid black; padding: 10px; font-size: 14pt;"><u>Hari <?php echo $x ?></u></div>
                        <div class="col-10" style="border: 2px solid black;  padding: 10px; border-left: 0px;">
                            <div style="font-size: 14pt;"><u><b><?php echo $rowRute['nama'] ?></b></u>
                                <?php
                                $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $row2['id'] . "' && hari='$x'";
                                $rsMeal = mysqli_query($con, $queryMeal);
                                $rowMeal = mysqli_fetch_array($rsMeal);
                                // var_dump($queryMeal);
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
                                    echo "(" . $b . $l . $d . ")";
                                }
                                ?>
                            </div>
                            <!-- class tempat -->
                            <div class="tempat" style="padding-left: 20px; font-size: 12pt;">
                                <?php
                                $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $row2['id'] . "' && hari='$x' order by urutan ASC";
                                $rsTmp = mysqli_query($con, $queryTmp);
                                while ($rowTmp = mysqli_fetch_array($rsTmp)) {

                                    $query_tempat2 = "SELECT * FROM List_tempat where id=" . $rowTmp['tempat'];
                                    $rs_tempat2 = mysqli_query($con, $query_tempat2);
                                    $row_tempat2 = mysqli_fetch_array($rs_tempat2);

                                    $query_ops = "SELECT * FROM LT_add_ops where master_id='" .  $row2['id'] . "' && hari='" . $x . "' && urutan='" . $rowTmp['urutan'] . "'";
                                    $rs_ops = mysqli_query($con, $query_ops);
                                    $row_ops = mysqli_fetch_array($rs_ops);

                                    // var_dump($query_ops);
                                    if ($row_ops['id'] == "") {
                                ?>
                                        <div style="padding-left: 20px;">
                                            <b><?php echo $row_tempat2['tempat2'] . " " ?></b><?php echo $row_tempat2['keterangan'] ?>
                                        </div>
                                        <?php
                                    } else {
                                        // var_dump($row_ops['highlight']);
                                        if ($row_ops['highlight'] == '1') {
                                            array_push($arr_hl,  $row_tempat2['tempat']);
                                        }
                                        if ($row_ops['optional'] == '1') {
                                        ?>
                                            <div style="padding-left: 20px;">
                                                <b><?php echo " [ Optional ] " . $row_tempat2['tempat2']  ?></b><?php echo $row_tempat2['keterangan'] ?>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div style="padding-left: 20px;">
                                                <b><?php echo $row_tempat2['tempat2'] . " " ?></b><?php echo $row_tempat2['keterangan'] ?>
                                            </div>
                                <?php
                                        }
                                    }
                                }

                                ?>

                            </div>
                            <?php
                            $queryHotel = "SELECT * FROM LAN_Hotel_List where master_id='" . $row2['id'] . "' && hari='$x'";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            // var_dump($queryHotel);
                            while ($rowHotel = mysqli_fetch_array($rsHotel)) {
                                if ($rowHotel['id'] != "") {
                                    $query_hotel_detail = "SELECT * FROM hotel_lt where id='" . $rowHotel['hotel_id'] . "'";
                                    $rs_hotel_detail = mysqli_query($con, $query_hotel_detail);
                                    $row_hotel_detail = mysqli_fetch_array($rs_hotel_detail);
                            ?>
                                    <div style="font-weight: bold; font-size: 12pt;">
                                        <div class="row">
                                            <div class="col-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                            <div class="col-9">: <?php echo  $row_hotel_detail['name']." , ". $row_hotel_detail['city'] ?></div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }

                            ?>
                        </div>
                    </div>
                    <div style="padding:2px"></div>
                <?php
                    $x++;
                }
                ?>
            </div>
            <div style="padding-top: 20px;"></div>
            <div style="padding-top: 20px;"></div>
            <?php
            $query_lt = "SELECT * FROM LT_itinnew where kode='" . $row2['landtour'] . "'";
            $rs_lt = mysqli_query($con, $query_lt);
            $row_lt = mysqli_fetch_array($rs_lt);
            // var_dump($query_lt);
            if ($row2['landtour'] != "undefined") {
            ?>
                <div style="padding: 5px 20px; font-size: 12pt;">
                    <div style="padding-bottom: 5px; font-weight: bold;">KOTA : <?php echo $row_lt['kota'] ?></div>
                    <div style="padding-bottom: 10px; font-weight: bold;">JUDUL : <?php echo $row_lt['judul']; ?></div>
                    <div style="padding-bottom: 10px; font-weight: bold;">KODE : <?php echo $row_lt['kode']; ?></div>
                    <div>
                        <table class="table table-bordered table-sm" style="border-color: black;">
                            <thead>
                                <tr>
                                    <th scope="col">Hotel Name</th>
                                    <th scope="col">Total Pax</th>
                                    <th scope="col">Twin</th>
                                    <th scope="col">Single</th>
                                    <th scope="col">CNB</th>
                                    <th scope="col">Infant</th>
                                    <th scope="col">Expired</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_lt2 = "SELECT * FROM  LT_itinnew where kode = '" . $row_lt['kode'] . "'";
                                $rs_lt2 = mysqli_query($con, $query_lt2);
                                // var_dump($query_lt2);
                                while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
                                    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_lt2['agent_twn'] . "' && price2 >='" . $row_lt2['agent_twn'] . "'";
                                    $rs_profit = mysqli_query($con, $sql_profit);
                                    $row_profit = mysqli_fetch_array($rs_profit);

                                    $pr = 0;
                                    if ($row_profit['id'] != "") {
                                        $pr = $row_profit['profit'];
                                    } else {
                                        $pr = 5;
                                    }
                                    $twin = ($row_lt2['agent_twn'] * $pr / 100) + $row_lt2['agent_twn'];
                                    $chd = ($row_lt2['agent_cnb'] * $pr / 100) + $row_lt2['agent_cnb'];
                                    $inf = ($row_lt2['agent_inf'] * $pr / 100) + $row_lt2['agent_inf'];
                                    $sgl = ($row_lt2['agent_sgl'] * $pr / 100) + $row_lt2['agent_sgl'];

                                    $twn_sp = get_pembulatan($twin);
                                    $twn_rp = json_decode($twn_sp, true);

                                    $sgl_sp = get_pembulatan($sgl);
                                    $sgl_rp = json_decode($sgl_sp, true);

                                    $cnb_sp = get_pembulatan($chd);
                                    $cnb_rp = json_decode($cnb_sp, true);

                                    $inf_sp = get_pembulatan($inf);
                                    $inf_rp = json_decode($inf_sp, true);

                                    if ($row_lt2['twn'] != "") {
                                        $tanda2 = "";
                                        $tanda3 = "";
                                        $tanda4 = "";
                                        $tanda5 = "";
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
                                ?>
                                        <tr>
                                            <td><?php
                                                echo  $row_lt2['hotel1'] . $tanda2 . $row_lt2['hotel2'] . $tanda3 . $row_lt2['hotel3'] . $tanda4 . $row_lt2['hotel4'] . $tanda5 . $row_lt2['hotel5'];

                                                ?></td>
                                            <td><?php
                                                $pax_u = "";
                                                $pax_b = "";
                                                if ($row_lt2['pax_u'] != 0) {
                                                    $pax_u = "-" . $row_lt2['pax_u'];
                                                }
                                                if ($row_lt2['pax_b'] != 0) {
                                                    $pax_b = "+" . $row_lt2['pax_b'];
                                                }
                                                echo $row_lt2['pax'] . $pax_u . $pax_b ?></td>
                                            <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo $row_lt2['expired'] ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            }
            ?>
            <div style="padding-top: 20px;"></div>
            <div style="padding: 5px 20px; font-size: 12px;">
                <div class="row">
                    <div class="col-6">
                        <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TERMASUK : </u></div>
                        <div>
                            <?php
                            $query_inc = "SELECT * FROM  Prev_Include_LT where id_LT=" . $_GET['id'];
                            $rs_inc = mysqli_query($con, $query_inc);
                            $row_inc = mysqli_fetch_array($rs_inc);
                            $data = json_decode($row_inc['include'], true);

                            ?>

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
                    <div class="col-6">
                        <div style="font-size: 12pt; font-weight: bold;"><u>PAKET TIDAK TERMASUK : </u></div>
                        <div>
                            <?php
                            $query_incx = "SELECT * FROM  Prev_Exclude_LT where id_LT=" . $_GET['id'];
                            $rs_incx = mysqli_query($con, $query_incx);
                            $row_incx = mysqli_fetch_array($rs_incx);
                            $datax = json_decode($row_incx['exclude'], true);

                            ?>
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
            </div>
            <div style="padding: 5px 20px; font-size: 12px;">
                <div style="font-size: 12pt;">
                    <u><b>HIGHLIGHT :</b></u>
                </div>
                <div>
                    <?php
                    $hl_i = 0;
                    $hl_d = "";
                    foreach ($arr_hl as $value_hl) {
                        $hl_i++;
                        $hl_d .= $value_hl . ", ";
                    }
                    echo $hl_d;
                    ?>
                </div>
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


            <!-- end content -->
        </div>
    </div>
<?php
}
?>