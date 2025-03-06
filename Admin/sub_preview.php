<?php
include "../db=connection.php";
$data = $_POST['data'];
//var_dump($data['checkbox']);
// var_dump("onnn");
?>
<div style="border: 2px solid black; padding: 10px;">
    <div style="text-align: center; font-weight: bold;">HASIL PREVIEW</div>
    <input type="hidden" id="chck_v" name="chck_v" value="<?php echo $data['checkbox'] ?>">
    <div>
        <table class="table table-bordered table-sm" style="font-size: 8px;">
            <thead>
                <tr>
                    <th scope="col">KOMPOSISI</th>
                    <th scope="col">DETAIL</th>
                    <th scope="col">PRICE TRANS</th>
                    <th scope="col">TL</th>
                    <th scope="col">GUIDE</th>
                    <th scope="col">DRIVER</th>
                    <th scope="col">LANDTOUR</th>
                    <th scope="col">ADULT</th>
                    <th scope="col">CHILD</th>
                    <th scope="col">INF</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['checkbox'] as $value) {
                    $query = "SELECT * FROM checkbox_include where id=" . $value['nama'];
                    $rs = mysqli_query($con, $query);
                    $row = mysqli_fetch_array($rs);
                    $tran_price = 0;
                    $adult = 0;
                    $child = 0;
                    $infant = 0;
                    // var_dump($value);
                ?>
                    <tr>
                        <!-- komposisi -->
                        <td><?php echo $row['nama'] ?></td>
                        <!-- detail -->
                        <td>
                            <?php
                            if ($value['nama'] == '1' or $value['nama'] == '2') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "land") {
                                                echo $o . ") " . $trans_value['transport_name'];
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '19') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "ferry") {
                                                echo $o . ") " . $trans_value['transport_name'];
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '9') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {
                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);
                                                $hasil = $row_fl['inter'] . " " . $row_fl['maskapai'] . " " . $row_fl['dept'] . "-" . $row_fl['arr'] . " " . $row_fl['take'] . ":" . $row_fl['landing'];

                                                if ($row_fl['inter'] == "INT") {
                                                    echo $o . ") " . $hasil;
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '11') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {
                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);
                                                $hasil = $row_fl['inter'] . " " . $row_fl['maskapai'] . " " . $row_fl['dept'] . "-" . $row_fl['arr'] . " " . $row_fl['take'] . ":" . $row_fl['landing'];

                                                if ($row_fl['inter'] == "DOM") {
                                                    echo $o . ") " . $hasil;
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '14') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] == '2') {
                                            $query_tempat = "SELECT * FROM List_tempat where id=" . $trans_value['tujuan'];
                                            $rs_tempat = mysqli_query($con, $query_tempat);
                                            $row_tempat = mysqli_fetch_array($rs_tempat);

                                            echo $o . ") " . $row_tempat['city'] . " " . $row_tempat['tempat'];
                                            echo "</br>";
                                            $o++;
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '16') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tg = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_guide'];
                                    $rs_tg = mysqli_query($con, $query_tg);
                                    $row_tg = mysqli_fetch_array($rs_tg);

                                    echo $o . ") " . $row_tg['negara'];
                                }
                            } else if ($value['nama'] == '17') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tl = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_tl'];
                                    $rs_tl = mysqli_query($con, $query_tl);
                                    $row_tl = mysqli_fetch_array($rs_tl);

                                    echo $o . ") " . $row_tl['negara'];
                                }
                            } else if ($value['nama'] == '34') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_ass = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_ass'];
                                    $rs_ass = mysqli_query($con, $query_ass);
                                    $row_ass = mysqli_fetch_array($rs_ass);

                                    echo $o . ") " . $row_ass['negara'];
                                }
                            } else if ($value['nama'] == '35') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tpo = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_porter'];
                                    $rs_tpo = mysqli_query($con, $query_tpo);
                                    $row_tpo = mysqli_fetch_array($rs_tpo);

                                    echo $o . ") " . $row_tpo['negara'];
                                }
                            } else if ($value['nama'] == '36') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tre = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_res'];
                                    $rs_tre = mysqli_query($con, $query_tre);
                                    $row_tre = mysqli_fetch_array($rs_tre);

                                    echo $o . ") " . $row_tre['negara'];
                                }
                            } else if ($value['nama'] == '37') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tdr = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_driver'];
                                    $rs_tdr = mysqli_query($con, $query_tdr);
                                    $row_tdr = mysqli_fetch_array($rs_tdr);

                                    echo $o . ") " . $row_tdr['negara'];
                                }
                            } else if ($value['nama'] == '3') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_meal = "SELECT * FROM Guest_meal where id=" . $day_value['guest_breakfast'];
                                    $rs_meal = mysqli_query($con, $query_meal);
                                    $row_meal = mysqli_fetch_array($rs_meal);

                                    $query_ln = "SELECT * FROM Guest_meal where id=" . $day_value['guest_lunch'];
                                    $rs_ln = mysqli_query($con, $query_ln);
                                    $row_ln = mysqli_fetch_array($rs_ln);

                                    $query_dn = "SELECT * FROM Guest_meal where id=" . $day_value['guest_dinner'];
                                    $rs_dn = mysqli_query($con, $query_dn);
                                    $row_dn = mysqli_fetch_array($rs_dn);

                                    // if($row_meal['bld'] !='' and $row_ln['bld'] !='' and $row_dn['bld'] !='')

                                    echo $o . ") " . $row_meal['bld'] . " " . $row_ln['bld'] . " " . $row_dn['bld'];
                                    echo "</br>";
                                    $o++;
                                }
                            } else if ($value['nama'] == '13') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    echo $o . ") " . $day_value['guest_hotel_name'];
                                    echo "</br>";
                                }
                            } else {
                                $query_c = "SELECT * FROM Guest_meal where id=" . $value['nama'];
                                $rs_c = mysqli_query($con, $query_c);
                                $row_c = mysqli_fetch_array($rs_c);
                                echo $row_c['nama'];
                            }
                            ?>
                        </td>
                        <!--price  transport -->
                        <td>
                            <?php
                            if ($value['nama'] == '1' or $value['nama'] == '2') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "land") {
                                                echo $o . ") " . $trans_value['price'];
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '13') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    echo $o . ")" . "</br>";
                                    echo "Twin : " . number_format($day_value['gst_hotel_twin'], 0, ",", ".");
                                    echo "</br>";
                                    echo "Triple : " . number_format($day_value['gst_hotel_triple'], 0, ",", ".");
                                    echo "</br>";
                                    echo "Family : " . number_format($day_value['gst_hotel_family'], 0, ",", ".");
                                    echo "</br>";
                                }
                            } else if ($value['nama'] == '30') {
                                $o = 1;
                                echo $data['tcf_tl'];
                                echo "</br>";
                            } else if ($value['nama'] == '31') {
                                $o = 1;
                                echo $data['tcf_guide'];
                                echo "</br>";
                            } else if ($value['nama'] == '32') {
                                $o = 1;
                                echo  $data['tcf_pendeta'];
                                echo "</br>";
                            } else if ($value['nama'] == '33') {
                                $o = 1;
                                echo $data['tcf_bonus'];
                                echo "</br>";
                            }
                            ?>
                        </td>
                        <td><?php
                            if ($value['nama'] == '13') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    echo $o . ")";
                                    echo "Twin : " . number_format($day_value['gst_hotel_twin'], 0, ",", ".");
                                    echo "</br>";
                                }
                            }
                            ?></td>
                        <!-- guide -->
                        <td><?php
                            if ($value['nama'] == '3') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    // var_dump($day_value['gui_breakfast']);
                                    $query_meal = "SELECT * FROM Guide_Meal where id=" . $day_value['gui_breakfast'];
                                    $rs_meal = mysqli_query($con, $query_meal);
                                    $row_meal = mysqli_fetch_array($rs_meal);

                                    $query_ln = "SELECT * FROM Guide_Meal where id=" . $day_value['gui_lunch'];
                                    $rs_ln = mysqli_query($con, $query_ln);
                                    $row_ln = mysqli_fetch_array($rs_ln);

                                    $query_dn = "SELECT * FROM Guide_Meal where id=" . $day_value['gui_dinner'];
                                    $rs_dn = mysqli_query($con, $query_dn);
                                    $row_dn = mysqli_fetch_array($rs_dn);

                                    $total = $row_meal['harga'] + $row_ln['harga'] + $row_dn['harga'];

                                    echo $o . ") " . number_format($total, 0, ",", ".");
                                    echo "</br>";
                                    $o++;
                                }
                            } else if ($value['nama'] == '13') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    echo $o . ")";
                                    echo "Twin : " . number_format($day_value['gui_hotel'], 0, ",", ".");
                                    echo "</br>";
                                }
                            } else if ($value['nama'] == '16') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tg = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_guide'];
                                    $rs_tg = mysqli_query($con, $query_tg);
                                    $row_tg = mysqli_fetch_array($rs_tg);

                                    echo $o . ") " . $row_tg['guide'];
                                }
                            } else if ($value['nama'] == '17') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tl = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_tl'];
                                    $rs_tl = mysqli_query($con, $query_tl);
                                    $row_tl = mysqli_fetch_array($rs_tl);

                                    echo $o . ") " . $row_tl['tl'];
                                }
                            } else if ($value['nama'] == '34') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_ass = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_ass'];
                                    $rs_ass = mysqli_query($con, $query_ass);
                                    $row_ass = mysqli_fetch_array($rs_ass);

                                    echo $o . ") " . $row_ass['assistant'];
                                }
                            } else if ($value['nama'] == '35') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tpo = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_porter'];
                                    $rs_tpo = mysqli_query($con, $query_tpo);
                                    $row_tpo = mysqli_fetch_array($rs_tpo);

                                    echo $o . ") " . $row_tpo['porter'];
                                }
                            } else if ($value['nama'] == '36') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tre = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_res'];
                                    $rs_tre = mysqli_query($con, $query_tre);
                                    $row_tre = mysqli_fetch_array($rs_tre);

                                    echo $o . ") " . $row_tre['restaurant'];
                                }
                            } else if ($value['nama'] == '37') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_tdr = "SELECT * FROM Tips_Landtour where id=" . $day_value['tips_driver'];
                                    $rs_tdr = mysqli_query($con, $query_tdr);
                                    $row_tdr = mysqli_fetch_array($rs_tdr);

                                    echo $o . ") " . $row_tdr['driver'];
                                }
                            } else {
                            }
                            ?></td>

                        <td><?php echo $value['driver'] ?></td>
                        <!-- landtour value -->
                        <td><?php
                         if ($value['nama'] == '8') {
                            $query_ltv = "SELECT * FROM LT_itinnew where id=" . $value['landtour'];
                            $rs_ltv = mysqli_query($con, $query_ltv);
                            $row_ltv = mysqli_fetch_array($rs_ltv);
                            // var_dump($query_ltv);
                            echo "Twin : ".number_format($row_ltv['twn'], 0, ",", ".")."</br>";
                            echo "sgl : ".number_format($row_ltv['sgl'], 0, ",", ".")."</br>";
                            echo "cnb : ".number_format($row_ltv['cnb'], 0, ",", ".")."</br>";
                            echo "sgl_sub: ".number_format($row_ltv['sgl_sub'], 0, ",", ".")."</br>";
                            echo "infant : ".number_format($row_ltv['infant'], 0, ",", ".")."</br>";
                         }
                            ?>
                        </td>
                        <!-- adc -->
                        <td>
                            <?php
                            if ($value['nama'] == '1' or $value['nama'] == '2') {
                                $tpax = $data['total_all'];
                                $ta = $data['adult'];
                                $tc = $data['child'];
                                $ti = $data['infant'];
                                $plus = $ta + $tc;
                                // var_dump($plus);
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "land") {
                                                $hasil = $trans_value['price'] / $plus;
                                                echo $o . ") " . $hasil;
                                                echo "</br>";
                                            }
                                        }
                                        $o++;
                                    }
                                }
                            } else if ($value['nama'] == '19') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "ferry") {
                                                echo $o . ") " . $trans_value['adult'];
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '9') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {
                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);

                                                if ($row_fl['inter'] == "INT") {
                                                    echo $o . ") " . $trans_value['adult'];
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '11') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {
                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);

                                                if ($row_fl['inter'] == "DOM") {
                                                    echo $o . ") " . $trans_value['adult'];
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '14') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] == '2') {
                                            $query_tempat = "SELECT * FROM List_tempat where id=" . $trans_value['tujuan'];
                                            $rs_tempat = mysqli_query($con, $query_tempat);
                                            $row_tempat = mysqli_fetch_array($rs_tempat);

                                            echo $o . ") " . $row_tempat['price'];
                                            echo "</br>";
                                            $o++;
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '3') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_meal = "SELECT * FROM Guest_meal where id=" . $day_value['guest_breakfast'];
                                    $rs_meal = mysqli_query($con, $query_meal);
                                    $row_meal = mysqli_fetch_array($rs_meal);

                                    $query_ln = "SELECT * FROM Guest_meal where id=" . $day_value['guest_lunch'];
                                    $rs_ln = mysqli_query($con, $query_ln);
                                    $row_ln = mysqli_fetch_array($rs_ln);

                                    $query_dn = "SELECT * FROM Guest_meal where id=" . $day_value['guest_dinner'];
                                    $rs_dn = mysqli_query($con, $query_dn);
                                    $row_dn = mysqli_fetch_array($rs_dn);

                                    $total = $row_meal['harga_idr'] + $row_ln['harga_idr'] + $row_dn['harga_idr'];

                                    // if($row_meal['bld'] !='' and $row_ln['bld'] !='' and $row_dn['bld'] !='')

                                    echo $o . ") " . number_format($total, 0, ",", ".");
                                    echo "</br>";
                                    $o++;
                                }
                            }
                            ?>
                        </td>
                        <!-- chd -->
                        <td>
                            <?php
                            if ($value['nama'] == '1' or $value['nama'] == '2') {
                                $tpax = $data['total_all'];
                                $ta = $data['adult'];
                                $tc = $data['child'];
                                $ti = $data['infant'];
                                $plus = $ta + $tc;
                                // var_dump($plus);
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "land") {
                                                $hasil = $trans_value['price'] / $plus;
                                                echo $o . ") " . $hasil;
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '19') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "ferry") {
                                                echo $o . ") " . $trans_value['child'];
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '9') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {
                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);

                                                if ($row_fl['inter'] == "INT") {
                                                    echo $o . ") " . $trans_value['child'];;
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '11') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {
                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);

                                                if ($row_fl['inter'] == "DOM") {
                                                    echo $o . ") " . $trans_value['child'];;
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '14') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] == '2') {
                                            $query_tempat = "SELECT * FROM List_tempat where id=" . $trans_value['tujuan'];
                                            $rs_tempat = mysqli_query($con, $query_tempat);
                                            $row_tempat = mysqli_fetch_array($rs_tempat);

                                            echo $o . ") " . $row_tempat['price'];
                                            echo "</br>";
                                            $o++;
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '3') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    $query_meal = "SELECT * FROM Guest_meal where id=" . $day_value['guest_breakfast'];
                                    $rs_meal = mysqli_query($con, $query_meal);
                                    $row_meal = mysqli_fetch_array($rs_meal);

                                    $query_ln = "SELECT * FROM Guest_meal where id=" . $day_value['guest_lunch'];
                                    $rs_ln = mysqli_query($con, $query_ln);
                                    $row_ln = mysqli_fetch_array($rs_ln);

                                    $query_dn = "SELECT * FROM Guest_meal where id=" . $day_value['guest_dinner'];
                                    $rs_dn = mysqli_query($con, $query_dn);
                                    $row_dn = mysqli_fetch_array($rs_dn);

                                    $total = $row_meal['harga_idr'] + $row_ln['harga_idr'] + $row_dn['harga_idr'];

                                    // if($row_meal['bld'] !='' and $row_ln['bld'] !='' and $row_dn['bld'] !='')

                                    echo $o . ") " . number_format($total, 0, ",", ".");
                                    echo "</br>";
                                    $o++;
                                }
                            }
                            ?>
                        </td>
                        <!-- infant -->
                        <td>
                            <?php
                            if ($value['nama'] == '1' or $value['nama'] == '2') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "land") {
                                                echo $o . ") " . '0';
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '19') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "ferry") {
                                                echo $o . ") " . $trans_value['infant'];
                                                echo "</br>";
                                                $o++;
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '9') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {

                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);

                                                if ($row_fl['inter'] == "INT") {
                                                    echo $o . ") " . $trans_value['infant'];
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '11') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] != '2') {
                                            if ($trans_value['transport_type'] == "flight") {

                                                $query_fl = "SELECT * FROM flight_LTnew where id=" . $trans_value['transport_name'];
                                                $rs_fl = mysqli_query($con, $query_fl);
                                                $row_fl = mysqli_fetch_array($rs_fl);

                                                if ($row_fl['inter'] == "DOM") {
                                                    echo $o . ") " . $trans_value['infant'];
                                                    echo "</br>";
                                                    $o++;
                                                }
                                            }
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '14') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    foreach ($day_value['sel_trans'] as $trans_value) {
                                        if ($trans_value['type'] == '2') {
                                            echo $o . ") " . '0';
                                            echo "</br>";
                                            $o++;
                                        }
                                    }
                                }
                            } else if ($value['nama'] == '3') {
                                $o = 1;
                                foreach ($value['day'] as $day_value) {
                                    echo $o . ") " . '0';
                                    echo "</br>";
                                    $o++;
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>