<?php
include "db=connection.php";
include "API/Api_PaketTour_Price.php";

$query_paket = "SELECT * FROM paket_tour_online where id=" . $_POST['id'];
$rs_paket = mysqli_query($con, $query_paket);
$row_paket = mysqli_fetch_array($rs_paket);
$data_price = $row_paket['id'];

$query_data = "SELECT * FROM  LTSUB_itin where id=" . $row_paket['tour_id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

// var_dump($data_price);

$show_price = get_price_paket($data_price);
$result_price = json_decode($show_price, true);
// var_dump($result_price);

//////////////////////////////////////////////////////////////////////////

$query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "' && grub_id='" . $row_paket['grub_id'] . "'";
$rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
$row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);

// var_dump($query_cek_addhari);
$json_day = $row_data['hari'] + $row_cek_addhari['plus_hari'];
// var_dump($json_day);

$returnDate = date('D, d M Y', strtotime('+' . $json_day . 'day', strtotime($row_paket['tgl_ber'])));
$deptDate = date('D, d M Y', strtotime($row_paket['tgl_ber']));

// $pax = $_POST['adt'] + $_POST['chd'];



// var_dump($returnDate);

?>
<div class="card" style="width: 18rem;">
    <div class="card-header" style="text-align: center; font-weight: bold;">
        BOOKING SUMMARY
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div><?php echo $_POST['judul'] ?></div>
            <div style="padding-top: 20px;">
                <div class="row">
                    <div class="col-md-6">Checkin</div>
                    <div class="col-md-6">: <?php echo $deptDate ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Checkout</div>
                    <div class="col-md-6">: <?php echo $returnDate ?></div>
                </div>
                <?php
                if ($_POST['adt'] != "") {
                    $val = $_POST['adt'] * $result_price['twn'];
                ?>
                    <div class="room" style="border-bottom: gray solid 1px;">
                        <div class="room-title" style="font-weight: bold;">ADULT</div>
                        <div class="room-content">
                            <div class="row">
                                <div class="col-md-6"><?php echo $_POST['adt'] . " x " . number_format($result_price['twn'], 0, ",", ".") ?></div>
                                <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($val, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if($_POST['sgl'] !=""){
                    $val_sgl = $_POST['sgl'] * $result_price['sgl'];
                    ?>
                    <div class="room" style="border-bottom: gray solid 1px;">
                        <div class="room-title" style="font-weight: bold;">SINGLE</div>
                        <div class="room-content">
                            <div class="row">
                                <div class="col-md-6"><?php echo $_POST['sgl'] . " x " . number_format($result_price['sgl'], 0, ",", ".") ?></div>
                                <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($val_sgl, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                <?php
                    
                }
                if($_POST['cwb'] !=""){
                    $val_cwb = $_POST['cwb'] * $result_price['twn'];
                    ?>
                    <div class="room" style="border-bottom: gray solid 1px;">
                        <div class="room-title" style="font-weight: bold;">CHILD WITH BED</div>
                        <div class="room-content">
                            <div class="row">
                                <div class="col-md-6"><?php echo $_POST['cwb'] . " x " . number_format($result_price['twn'], 0, ",", ".") ?></div>
                                <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($val_cwb, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                <?php

                }
                if ($_POST['cnb'] != "") {
                    $val_cnb = $_POST['cnb'] * $result_price['cnb'];
                    ?>
                        <div class="room" style="border-bottom: gray solid 1px;">
                            <div class="room-title" style="font-weight: bold;">CHILD NO BED</div>
                            <div class="room-content">
                                <div class="row">
                                    <div class="col-md-6"><?php echo $_POST['cnb'] . " x " . number_format($result_price['cnb'], 0, ",", ".") ?></div>
                                    <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($val_cnb, 0, ",", ".") ?></div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                if($_POST['inf'] !=""){
                    $val_inf = $_POST['inf'] * $result_price['inf'];
                    ?>
                    <div class="room" style="border-bottom: gray solid 1px;">
                        <div class="room-title" style="font-weight: bold;">INFANT</div>
                        <div class="room-content">
                            <div class="row">
                                <div class="col-md-6"><?php echo $_POST['inf'] . " x " . number_format($result_price['inf'], 0, ",", ".") ?></div>
                                <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($val_inf, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                $gt = $val + $val_cnb +$val_cwb +$val_sgl + $val_inf;
                ?>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-6" style="font-weight: bold;">TOTAL</div>
                <div class="col-md-6" style="font-weight: bold;">IDR <?php echo number_format($gt, 0, ",", ".") ?></div>
            </div>
        </li>
    </ul>
    <div class="card-footer" style="text-align: center;">
        <form action="booking-paket.php?id=<?php echo $_POST['id'] ?>" method="post">
            <input type="hidden" id="judul" name="judul" value="<?php echo  $_POST['judul'] ?>">
            <input type="hidden" id="tgl" name="tgl" value="<?php echo  $row_paket['tgl_ber'] ?>">
            <input type="hidden" id="adt" name="adt" value="<?php echo  $_POST['adt'] ?>">
            <input type="hidden" id="cnb" name="cnb" value="<?php echo $_POST['cnb'] ?>">
            <input type="hidden" id="cwb" name="cwb" value="<?php echo $_POST['cwb'] ?>">
            <input type="hidden" id="sgl" name="sgl" value="<?php echo $_POST['sgl'] ?>">
            <input type="hidden" id="inf" name="inf" value="<?php echo $_POST['inf'] ?>">
            <input type="hidden" id="price" name="price" value="<?php echo  $gt ?>">
            <button type="submit" class="btn btn-warning">BOOK NOW</button>
        </form>

    </div>
</div>