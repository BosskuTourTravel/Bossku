<?php
include "db=connection.php";

function get_kurs($d)
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
                return json_encode(array("status" => "success", "data" => $price), true);
            }
        }
    }
}

function get_pembulatan($x)
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

if (isset($_POST['room'])) {

    // $sisa = intval($_POST['adt']) - intval($_POST['room']);
    // $sisa_anak = intval($_POST['chd']);
    $query_book = "SELECT * FROM LT_itinnew where id=" . $_POST['id'];
    $rs_book = mysqli_query($con, $query_book);
    $row_book = mysqli_fetch_array($rs_book);

    $data_twn = array(
        "kurs" => $row_book['kurs'],
        "nominal" => $row_book['agent_twn'],
    );
    $data_sgl = array(
        "kurs" => $row_book['kurs'],
        "nominal" => $row_book['agent_sgl'],
    );
    $data_cnb = array(
        "kurs" => $row_book['kurs'],
        "nominal" => $row_book['agent_cnb'],
    );

    $show_kurs_twn = get_kurs($data_twn);
    $rs_kurs_twn = json_decode($show_kurs_twn, true);

    $show_kurs_sgl = get_kurs($data_sgl);
    $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

    $show_kurs_cnb = get_kurs($data_cnb);
    $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

    $agent_twn = $rs_kurs_twn['data'];
    $agent_sgl = $rs_kurs_sgl['data'];
    $agent_cnb = $rs_kurs_cnb['data'];

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
    $asgl =  ($agent_sgl * $pr / 100) + $agent_sgl;
    $acnb =  ($agent_cnb * $pr / 100) + $agent_cnb;
    ///pembulatan
    $twn_sp = get_pembulatan($twin);
    $twn_rp = json_decode($twn_sp, true);

    $sgl_sp = get_pembulatan($asgl);
    $sgl_rp = json_decode($sgl_sp, true);

    $cnb_sp = get_pembulatan($acnb);
    $cnb_rp = json_decode($cnb_sp, true);



    $query_master_book = "SELECT * FROM  LT_itinerary2 where id=" . $_POST['master'];
    $rs_master_book = mysqli_query($con, $query_master_book);
    $row_master_book = mysqli_fetch_array($rs_master_book);
    $returnDate = date('D, d M Y', strtotime('+' . $row_master_book['hari'] . 'day', strtotime($_POST['tgl'])));
    $deptDate = date('D, d M Y', strtotime($_POST['tgl']));

    // $pax = $_POST['adt'] + $_POST['chd'];

?>

    <div class="card mt-4">
        <div class="card-header" style="text-align: center; font-weight: bold;">
            BOOKING SUMMARY
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div><?php echo $row_master_book['judul'] ?></div>
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
                    $grandtotal = 0;
                    for ($i = 1; $i <= $_POST['room']; $i++) {
                        $val_dewasa = $_POST['adt' . $i];
                        $val_anak =  $_POST['chd' . $i];

                        $adt_price = intval($val_dewasa) * $twn_rp['value'];
                        $sgl_price = intval($val_dewasa) * $sgl_rp['value'];
                        $cnb_price = intval($val_anak) * $cnb_rp['value'];

                        $grandtotal = $grandtotal + $adt_price;

                    ?>
                        <div class="room" style="border-bottom: gray solid 1px;">
                            <div class="room-title" style="font-weight: bold;">ROOM <?php echo $i ?></div>
                            <div class="room-content">
                                <div class="row">
                                    <div class="col-md-6"><?php echo $val_dewasa . " adt x " . number_format($twn_rp['value'], 0, ",", ".") ?></div>
                                    <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($adt_price, 0, ",", ".") ?></div>
                                </div>
                                <?php
                                if ($val_anak != 0) {
                                    $grandtotal = $grandtotal + $cnb_price;
                                ?>
                                    <div class="row">
                                        <div class="col-md-6"><?php echo $val_anak . " chd x " . number_format($cnb_rp['value'], 0, ",", ".") ?></div>
                                        <div class="col-md-6" style="font-weight: bold;"><?php echo "IDR " . number_format($cnb_price, 0, ",", ".") ?></div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                        // if ($sisa > 0) {
                        //     $sisa--;
                        // }
                        // if ($sisa_anak > 0) {
                        //     $sisa_anak = $sisa_anak - 1;
                        // }
                    }
                    ?>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6" style="font-weight: bold;">TOTAL</div>
                    <div class="col-md-6" style="font-weight: bold;">IDR <?php echo number_format($grandtotal, 0, ",", ".") ?></div>
                </div>
            </li>
        </ul>
        <div class="card-footer" style="text-align: center;">
            <form action="booking-1.php?id=<?php echo $_POST['id'] ?>&master=<?php echo $_POST['master'] ?>" method="post">
                <input type="hidden" id="judul" name="judul" value="<?php echo  $row_master_book['judul'] ?>">
                <input type="hidden" id="tgl" name="tgl" value="<?php echo  $_POST['tgl'] ?>">
                <input type="hidden" id="room" name="room" value="<?php echo  $_POST['room'] ?>">
                <?php
                for ($x = 1; $x <= $_POST['room']; $x++) {
                ?>
                    <input type="hidden" id="adt_<?php echo $x  ?>" name="adt_<?php echo $x  ?>" value="<?php echo  $_POST['adt'.$x] ?>">
                    <input type="hidden" id="chd_<?php echo $x  ?>" name="chd_<?php echo $x  ?>" value="<?php echo $_POST['chd'.$x] ?>">
                <?php
                }
                ?>
                <input type="hidden" id="adt_price" name="adt_price" value="<?php echo  $twn_rp['value'] ?>">
                <input type="hidden" id="cnb_price" name="cnb_price" value="<?php echo  $cnb_rp['value'] ?>">
                <input type="hidden" id="sgl_price" name="sgl_price" value="<?php echo  $sgl_price ?>">
                <input type="hidden" id="price" name="price" value="<?php echo  $grandtotal ?>">
                <button type="submit" class="btn btn-warning">BOOK NOW</button>
                <!-- <a class="btn btn-success" href="preview_itin_web.php?id=<?php echo $_POST['master'] ?>&c_id=<?php echo $_POST['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a> -->
            </form>

        </div>
    </div>
<?php
}

?>