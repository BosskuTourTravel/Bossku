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
include "Api_LT_total_baru.php";

$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_GET['sub'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query_master = "SELECT hotel_id FROM LT_select_PilihHTL  where master_id ='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "' limit 1";
$rs_master = mysqli_query($con, $query_master);
$row_master = mysqli_fetch_array($rs_master);

$query_itin = "SELECT * FROM LT_itinnew WHERE id='" .  $row_master['hotel_id'] . "'";
$rs_itin = mysqli_query($con, $query_itin);
$row_itin = mysqli_fetch_array($rs_itin);

$pax_u = "";
$pax_b = "";
if ($row_itin['pax_u'] != 0) {
    $pax_u = "-" . $row_itin['pax_u'];
}
if ($row_itin['pax_b'] != 0) {
    $pax_b = "+" . $row_itin['pax_b'];
}
$pax_h = $row_itin['pax'] . $pax_u . $pax_b;
// var_dump($query_data);

?>

<body>
    <?php
    if ($_GET['id'] == '32') {
        $data_tps = array(
            "master_id" => $row_data['master_id'],
            "copy_id" => $row_data['id'],
            "check_id" => $_GET['id'],
            "flight" => $_POST['tl_fl'],
            "date" => $_POST['tl_date'],
            "tl_pax" => $_POST['tl_pax']
        );

        $show_tps = get_total($data_tps);
        $result_tps = json_decode($show_tps, true);
    ?>
        <div class="container" style="max-width: 2300px;">
            <div style="border: 2px solid black; padding: 20px; text-align: center;">
                <div class="header">
                    <div class="gmb">
                        <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: 1010px;">
                    </div>
                </div>
            </div>
            <div style="padding: 5px 20px; font-size: 32px; font-weight: bold; text-align: center;">
                INVOICE LANDTOUR
            </div>
            <div style="padding: 20px;">
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <div class="col-3" style="font-weight: bold;">
                                <div>Paket Tour</div>
                                <div>Tgl Keberangkatan</div>
                                <div>Pax</div>
                                <div>Jumlah Hari </div>
                            </div>
                            <div class="col-8">
                                <div>: <?php echo $row_data['judul'] ?></div>
                                <div>: <?php echo $_POST['tl_date'] ?> </div>
                                <div>: <?php echo $pax_h ?></div>
                                <div>: <?php echo $row_data['hari'] ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <div style="padding: 20px;">BERIKUT KAMI RINCIKAN DETAIL PEMBAYARAN FEE TL :</div>
            <div style="padding: 10px 40px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Grand Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="5" style="text-align: center;">FEE TL</th>
                        </tr>
                        <?php
                        $gt_fee_tl = 0;
                        foreach ($result_tps['breakdown'] as $val_br) {

                            if ($val_br['id'] == '1') {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                        ?>
                                <tr>
                                    <td>Fee TL / Day</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".") ?></td>
                                    <td><?php echo $val_br['hari'] ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php

                            } else if ($val_br['id'] == '2') {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                                $p_tl_meal = $val_br['current'] * 3;
                            ?>
                                <tr>
                                    <td>TL Meal</td>
                                    <td><?php echo number_format($p_tl_meal, 0, ",", ".") ?></td>
                                    <td><?php echo $val_br['hari'] ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php

                            } else if ($val_br['id'] == "3") {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                            ?>
                                <tr>
                                    <td>TL Voucher Tlpn</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".") ?></td>
                                    <td><?php echo "1" ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            } else if ($val_br['id'] == "4") {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                            ?>
                                <tr>
                                    <td>TL Surcharge Fee / Day</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".")  ?></td>
                                    <td><?php echo $val_br['hari'] ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($gt_fee_tl, 0, ",", ".") ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="5" style="text-align: center;">Cost TL</th>
                        </tr>
                        <?php
                        $gt_cost_tl = 0;
                        foreach ($result_tps['break_cost_tl'] as $val_cost_tl) {
                            if ($val_cost_tl['id'] == '1') {
                                $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'] + $val_cost_tl['meal'] + $val_cost_tl['tax'];
                        ?>
                                <tr>
                                    <td>Tiket Pesawat</td>
                                    <td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Flight Meal</td>
                                    <td><?php echo number_format($val_cost_tl['meal'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['meal'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Flight Tax</td>
                                    <td><?php echo number_format($val_cost_tl['tax'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['tax'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php

                            } else if ($val_cost_tl['id'] == '2') {
                                $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
                            ?>
                                <tr>
                                    <td>Landtour</td>
                                    <td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            } else if ($val_cost_tl['id'] == '3') {
                                $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
                            ?>
                                <tr>
                                    <td>Landtour Single Sub</td>
                                    <td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            } else if ($val_cost_tl['id'] == '4') {
                                $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
                            ?>
                                <tr>
                                    <td>Tiket Kereta</td>
                                    <td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            } else if ($val_cost_tl['id'] == '5') {
                                $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
                            ?>
                                <tr>
                                    <td>Tiket Ferry</td>
                                    <td><?php echo number_format($val_cost_tl['current'], 0, ",", ".") ?></td>
                                    <td>1</td>
                                    <td><?php echo number_format($val_cost_tl['value'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($gt_cost_tl, 0, ",", ".") ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="5" style="text-align: center;">Fee TL Covery</th>
                        </tr>
                        <?php
                        $gt_ft_cover = 0;
                        foreach ($result_tps['feetl_cover'] as $val_ft_cover) {
                            $gt_ft_cover = $gt_ft_cover + $val_ft_cover['value'];
                        ?>
                            <tr>
                                <td>TL Meal</td>
                                <td><?php echo $val_ft_cover['detail'] ?></td>
                                <td>-1</td>
                                <td><?php echo number_format($val_ft_cover['value'], 0, ",", ".") ?></td>
                                <td><?php echo number_format($gt_ft_cover, 0, ",", ".") ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <th colspan="5" style="text-align: center;">Cost TL Covery</th>
                        </tr>
                        <?php
                        $gt_ct_cover = 0;
                        foreach ($result_tps['costtl_cover'] as $val_ct_cover) {
                            $gt_ct_cover = $val_ct_cover['value'];
                        ?>
                            <tr>
                                <td>Landtour</td>
                                <td><?php echo  number_format($val_ct_cover['current'], 0, ",", ".") ?></td>
                                <td><?php echo  $val_ct_cover['pax_cover'] ?></td>
                                <td><?php echo number_format($val_ct_cover['value'], 0, ",", ".") ?></td>
                                <td><?php echo number_format($gt_ct_cover, 0, ",", ".") ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $grand = 0;
                        foreach ($result_tps['grand'] as $val_grand) {
                            $grand = $val_grand['value'];
                        ?>
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo number_format($val_grand['current'], 0, ",", ".") ?></td>
                            <th><?php echo " / " . $val_grand['pax'] ?></th>
                            </tr>
                            <tr>
                                <th colspan="5">Total Pembayaran Fee TL / Pax</th>
                                <th><?php echo "IDR ". number_format($val_grand['value'], 0, ",", ".") ?></th>
                            </tr>
                        <?php
                        }
                        ?>

                    </tfoot>
                </table>
            </div>
            <div style="padding: 40px 5px;"></div>
            <div style="padding: 5px 20px; font-weight: bold; text-align: center;">REKENING PERFORMA TOUR AND TRAVEL</div>
            <div style="padding: 5px 20px;">
                <div style="font-weight: bold;">SURABAYA</div>
                <div class="row">
                    <div class="col-3">
                        <div>NAME OF BANK : BCA (IDR)</div>
                        <div>ACC NO : 3845317555</div>
                        <div>A/N : PERFORMA TOUR &TRAVEL</div>
                    </div>
                    <div class="col-3">
                        <div>NAME OF BANK : OCBC(SGD)</div>
                        <div>ACC NO : 687139980001</div>
                        <div>A/N : SHERLIANA</div>
                    </div>
                    <div class="col-3">
                        <div>NAME OF BANK : BCA(USD)</div>
                        <div>ACC NO : 0612705079</div>
                        <div>A/N : PERFORMA TOUR &TRAVEL</div>
                    </div>
                    <div class="col-3">
                        <div>NAME OF BANK : BANK OFCHINA (CNY)</div>
                        <div>ACC NO : 100000900499627</div>
                        <div>A/N : SHERLIANA</div>
                    </div>
                </div>
                <div style="font-weight: bold; padding-top: 5px;">BATAM</div>
                <div class="row">
                    <div class="col-3">
                        <div>NAME OF BANK : BCA (IDR)</div>
                        <div>ACC NO : 8210317555</div>
                        <div>A/N : PERFORMA TOUR &TRAVEL</div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</body>
<script>
    var nama = "<?php echo $row_data['judul'] . " (" . $row_data['landtour'] . ")" ?>";
    document.title = nama;
    window.print();
</script>

</html>