<?php
include "db=connection.php";
include "slug.php";
// include "Admin/Api_LT_total.php";
function get_kurs_manual2($d)
{
    include "db=connection.php";
    $kurs = $d['kurs'];
    $nominal = $d['nominal'];
    $query = "SELECT * FROM  kurs_bca_field where nama = '" . $kurs . "' order by id ASC ";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    if ($row['id'] == "") {
        return json_encode(array("status" => "data Kurs tidak Tersedia", "data" => '0'), true);
    } else {
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "data" => $nominal), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                $price = $nominal * $row['jual'];
                return json_encode(array("status" => $result_data['status'], "data" => $price), true);
            }
        }
    }
}
function get_pembulatan2($x)
{
    $totalharga = ceil($x);
    if (substr($totalharga, -5) == 0) {
        $total_harga = round($totalharga, -5);
    } else if (substr($totalharga, -5) <= 50000) {
        $total_harga = round($totalharga, -5) + 50000;
    } else {
        $total_harga = round($totalharga, -5);
    }
    return json_encode(array("status" => 1, "value" => $total_harga), true);
}


if ($_POST['cari'] !== "") {
?>
    <div class="row" style="text-align: center; padding: 10px;">
        <?php
        $query_cat = "SELECT * FROM LT_add_Category where category='" . $_POST['cari'] . "' order by id ASC";
        $rs_cat = mysqli_query($con, $query_cat);
        while ($row_cat = mysqli_fetch_array($rs_cat)) {
            $query2 = "SELECT * FROM  LT_itinerary2 where id='" . $row_cat['tour_id'] . "'";
            $rs2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_array($rs2);

            $query_bn2 = "SELECT * FROM LT_itinnew where kode='" . $row2['landtour'] . "' && agent_twn !='0' order by agent_twn ASC LIMIT 1";
            $rs_bn2 = mysqli_query($con, $query_bn2);
            $row_bn2 = mysqli_fetch_array($rs_bn2);

            $data_twn = array(
                "kurs" => $row_bn2['kurs'],
                "nominal" => $row_bn2['agent_twn'],
            );
            $show_kurs_twn = get_kurs_manual2($data_twn);
            $rs_kurs_twn = json_decode($show_kurs_twn, true);
        
            // var_dump($data_twn);
            //  var_dump($rs_kurs_twn);
        
            $agent_twn = $rs_kurs_twn['data'];

            if ($row_bn2['agent_twn'] != "") {
                $sql_profit2 = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
                $rs_profit2 = mysqli_query($con, $sql_profit2);
                $row_profit2 = mysqli_fetch_array($rs_profit2);

                $pr2 = 0;
                if ($row_profit2['id'] != "") {
                    $pr2 = $row_profit2['profit'];
                } else {
                    $pr2 = 5;
                }
                $ste2 = $row_profit2['staff_eks'];
                $nom2 = $row_profit2['nominal'];
                $atwn2 =  ($agent_twn * $pr2 / 100) + $agent_twn + $nom2;
                $twn_sp2 = get_pembulatan2($atwn2);
                $twn_rp2 = json_decode($twn_sp2, true);
                $coret2 = $twn_rp2['value'] + 500000;
        ?>
                 <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                    <a href="<?php  echo $domain_web ?>detail-landtour.php?id=<?php echo $row_bn2['id'] ?>&master=<?php echo $row2['id'] ?>" class="front-text" style="text-decoration: none; color:black">
                        <div class="thumbnail">
                            <img src="<?php  echo $domain_web ?>Admin/images/<?php echo $row2['gambar1'] ?>" class="img-fluid img-thumbnail2">
                            <?php
                            if ($row_bn2['statuss'] == 'E') {
                            ?>
                                <div class="top-left" style="color: red;">
                                    EXPIRED
                                </div>
                            <?php
                            }
                            ?>
                            <div class="card-body-tour">
                                <div class="judul"><?php echo $row2['judul'] ?></div>
                                <div style="color: gray; font-size: 8pt;"><?php echo $row_bn2['kota'] ?></div>
                                <div style="color: gray; font-size: 8pt;">
                                    <?php echo $row2['landtour'] ?> - <?php echo  $row_bn2['expired'] ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="color: gray; font-size: 8pt;">
                                            <?php echo $pax_val2 . " Pax" ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="text-decoration: line-through; font-size: 9pt; color: darkmagenta; text-align: right;"> <?php echo "IDR " . number_format($coret2, 0, ",", ".") ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3" style="color: darkgreen;">
                                        <i class="fa fa-building"></i>
                                        <i class="fa fa-bus"></i>
                                        <i class="fa fa-coffee"></i>
                                        <div style="color: gray; font-size: 6pt;">SIC Everyday</div>
                                    </div>
                                    <div class="col-9">
                                        <div class="card-body-price">
                                            <div style="color: darkgreen;"><?php echo "IDR " . number_format($twn_rp2['value'], 0, ",", ".") ?></div>
                                            <div style="color: gray; font-size: 6pt;">
                                                Guarantee Departure (Start From 2pax) klik for price
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        }
        ?>
    </div>
<?php
}
?>