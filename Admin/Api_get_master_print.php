<?php
function data_print($xy)
{
    include "../db=connection.php";
    include "Api_LT_total_baru.php";

    $query2 = "SELECT * FROM  LT_itinerary2 where id =" . $xy;
    $rs2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_array($rs2);
    $json_day = $row2['hari'];

    $arr_all_fl = [];
    $arr_all_fery = [];

    $query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $xy . "'";
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
                    $link2 = "https://drive.google.com/file/d/1ZX73bzx42Ox7qNldS6kY_z6XogQmBesH/view?usp=sharing";
                    $headers2 = explode('/', $link2);
                    $thumbnail = $headers2[5];
                    $thumbnail_gmb1 = $headers2[5];
                    $thumbnail_gmb2 = $headers2[5];
                    $thumbnail_gmb3 = $headers2[5];
                    $thumbnail_gmb4 = $headers2[5];
                    $id_val1 = "";
                    $val1 = "";
                    $id_val2 = "";
                    $val2 = "";
                    $id_val3 = "";
                    $val3 = "";
                    $id_val4 = "";
                    $val4 = "";

                    $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $xy . "' order by id DESC limit 1";
                    $rs_main = mysqli_query($con, $query_main);
                    $row_main = mysqli_fetch_array($rs_main);
                    // var_dump($query_main);
                    // while ($row_main = mysqli_fetch_array($rs_main)) {
                    if ($row_main['img1'] != "") {
                        $query_sel_main1 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img1'] . "'";
                        $rs_sel_main1 = mysqli_query($con, $query_sel_main1);
                        $row_sel_main1 = mysqli_fetch_array($rs_sel_main1);
                        $s1 = $row_sel_main1['tmp_type'];

                        // var_dump($query_sel_main1);

                        $link_gmb1 = $row_sel_main1[$s1];
                        $headers_gmb1 = explode('/', $link_gmb1);
                        $thumbnail_gmb1 = $headers_gmb1[5];
                        $val1 = $row_sel_main1['tempat'];
                        $id_val1 = $row_sel_main1['id'];
                    }
                    if ($row_main['img2'] != "") {
                        $query_sel_main2 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img2'] . "'";
                        $rs_sel_main2 = mysqli_query($con, $query_sel_main2);
                        $row_sel_main2 = mysqli_fetch_array($rs_sel_main2);
                        $s2 = $row_sel_main2['tmp_type'];

                        $link_gmb2 = $row_sel_main2[$s2];
                        $headers_gmb2 = explode('/', $link_gmb2);
                        $thumbnail_gmb2 = $headers_gmb2[5];
                        $val2 = $row_sel_main2['tempat'];
                        $id_val2 = $row_sel_main2['id'];
                    }
                    if ($row_main['img3'] != "") {
                        $query_sel_main3 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img3'] . "'";
                        $rs_sel_main3 = mysqli_query($con, $query_sel_main3);
                        $row_sel_main3 = mysqli_fetch_array($rs_sel_main3);
                        $s3 = $row_sel_main3['tmp_type'];

                        $link_gmb3 = $row_sel_main3[$s3];
                        $headers_gmb3 = explode('/', $link_gmb3);
                        $thumbnail_gmb3 = $headers_gmb3[5];
                        $val3 = $row_sel_main3['tempat'];
                        $id_val3 = $row_sel_main3['id'];
                    }
                    if ($row_main['img4'] != "") {
                        $query_sel_main4 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img4'] . "'";
                        $rs_sel_main4 = mysqli_query($con, $query_sel_main4);
                        $row_sel_main4 = mysqli_fetch_array($rs_sel_main4);
                        $s4 = $row_sel_main4['tmp_type'];

                        $link_gmb4 = $row_sel_main4[$s4];
                        $headers_gmb4 = explode('/', $link_gmb4);
                        $thumbnail_gmb4 = $headers_gmb4[5];
                        $val4 = $row_sel_main4['tempat'];
                        $id_val4 = $row_sel_main4['id'];
                    }
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb1 ?>" height="160" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb2 ?>" height="160" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb3 ?>" height="160" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb4 ?>" height="160" alt="Card image cap">
                        </div>
                    </div>
                    <?php
                    // var_dump($val1." + ".$val2." + ".$val3." + ".$val4);
                    // }
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
                            $queryHotel = "SELECT * FROM  LT_add_pilihHotel where tour_id='" . $row2['id'] . "' && hari='$x'";
                            $rsHotel = mysqli_query($con, $queryHotel);
                            $rowHotel = mysqli_fetch_array($rsHotel);
                            if ($rowHotel['hotel'] == "1") {
                            ?>
                                <div style="font-weight: bold; font-size: 12pt;">
                                    <div class="row">
                                        <div class="col-3"><i class="fa fa-hotel" style="padding-right: 10px;"></i> Hotel</div>
                                        <div class="col-9">: <?php
                                                                if ($row2['landtour'] == "undefined") {
                                                                    $querySHNO = "SELECT * FROM  LT_select_PilihHTLNC WHERE master_id='" . $row2['id'] . "' && hari='" .  $c . "'";
                                                                    $rsSHNO = mysqli_query($con, $querySHNO);
                                                                    $rowSHNO = mysqli_fetch_array($rsSHNO);
                                                                    // var_dump($querySHNO);
                                                                    if ($rowSHNO['id'] == "") {
                                                                        $ket_hotel = "Hotel Name TBA";
                                                                    } else {
                                                                        $ket_hotel =  $rowSHNO['hotel_name'];
                                                                    }
                                                                } else {
                                                                    $ket_hotel = "Pilih Hotel yang tertera di Itinerary";
                                                                }
                                                                echo $ket_hotel;
                                                                ?></div>
                                    </div>
                                </div>
                            <?php
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
                                    <th scope="col">No</th>
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
                                $no = 1;
                                while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
                                    $data_twn = array(
                                        "kurs" => $row_lt2['kurs'],
                                        "nominal" => $row_lt2['agent_twn'],
                                    );
                                    $data_sgl = array(
                                        "kurs" => $row_lt2['kurs'],
                                        "nominal" => $row_lt2['agent_sgl'],
                                    );
                                    $data_cnb = array(
                                        "kurs" => $row_lt2['kurs'],
                                        "nominal" => $row_lt2['agent_cnb'],
                                    );
                                    $data_inf = array(
                                        "kurs" => $row_lt2['kurs'],
                                        "nominal" => $row_lt2['agent_infant'],
                                    );


                                    $show_kurs_twn = get_kurs($data_twn);
                                    $rs_kurs_twn = json_decode($show_kurs_twn, true);

                                    $show_kurs_sgl = get_kurs($data_sgl);
                                    $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

                                    $show_kurs_cnb = get_kurs($data_cnb);
                                    $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

                                    $show_kurs_inf = get_kurs($data_inf);
                                    $rs_kurs_inf = json_decode($show_kurs_inf, true);


                                    $agent_twn = $rs_kurs_twn['data'];
                                    $agent_sgl = $rs_kurs_sgl['data'];
                                    $agent_cnb = $rs_kurs_cnb['data'];
                                    $agent_inf = $rs_kurs_inf['data'];

                                    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
                                    $rs_profit = mysqli_query($con, $sql_profit);
                                    $row_profit = mysqli_fetch_array($rs_profit);

                                    $pr = 0;
                                    if ($row_profit['id'] != "") {
                                        $pr = $row_profit['profit'];
                                    } else {
                                        $pr = 5;
                                    }
                                    $twin = ($agent_twn * $pr / 100) + $agent_twn;
                                    $chd = ($agent_cnb * $pr / 100) + $agent_cnb;
                                    $inf = ($agent_inf * $pr / 100) + $agent_inf;
                                    $sgl = ($agent_sgl * $pr / 100) + $agent_sgl;

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
                                            <td><?php echo $no ?></td>
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
                                                echo $row_lt2['pax'] . $pax_u . $pax_b ?>
                                            </td>
                                            <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                                            <td><?php echo $row_lt2['expired'] ?></td>
                                        </tr>
                                <?php
                                    }
                                    $no++;
                                }
                                ?>
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
                            $query_inc = "SELECT * FROM  Prev_Include_LT where id_LT=" . $xy;
                            $rs_inc = mysqli_query($con, $query_inc);
                            $row_inc = mysqli_fetch_array($rs_inc);
                            // var_dump($query_inc);
                            // $data = json_decode($row_inc['include'], true);

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
                            $query_incx = "SELECT * FROM  Prev_Exclude_LT where id_LT=" . $xy;
                            $rs_incx = mysqli_query($con, $query_incx);
                            $row_incx = mysqli_fetch_array($rs_incx);
                            // $datax = json_decode($row_incx['exclude'], true);

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