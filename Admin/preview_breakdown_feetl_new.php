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
include "fungsi_feetl.php";
include "fungsi_gethotel_price.php";

$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$data_hotel = array(
    "copy_id" => $row_data['id'],
    "master_id" => $row_data['master_id'],
);

$show_hp = get_hotel_price($data_hotel);
$result_hp = json_decode($show_hp, true);
$hotel_id =  $result_hp['id_hotel'];

$query_itin = "SELECT pax FROM  LT_itinnew where id=" . $hotel_id;
$rs_itin = mysqli_query($con, $query_itin);
$row_itin = mysqli_fetch_assoc($rs_itin);


$data_feetl = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_data['id'],
    "grub_id" => $_GET['grub_id'],
    "hotel_id" =>  $hotel_id
);

// var_dump($data_feetl);

$show_feetl = feeTL($data_feetl);
$result_tps = json_decode($show_feetl, true);

$data_tl = array(
    "master_id" => $row_data['master_id'],
    "copy_id" => $row_data['id'],
    "check_id" => '27'
);

$show_tl = get_total($data_tl);
$result_tl = json_decode($show_tl, true);


// var_dump($query_gf );
////// cost tl ///////////////////////////////////////////////////
$gt_cost_tl = 0;
foreach ($result_tps['break_cost_tl'] as $val_cost_tl) {
    if ($val_cost_tl['id'] == '1') {
        $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'] + $val_cost_tl['meal'] + $val_cost_tl['tax'];
    } else if ($val_cost_tl['id'] == '2') {
        $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
    } else if ($val_cost_tl['id'] == '3') {
        $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
    } else if ($val_cost_tl['id'] == '4') {
        $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
    } else if ($val_cost_tl['id'] == '5') {
        $gt_cost_tl = $gt_cost_tl + $val_cost_tl['value'];
    } else {
    }
}

////////////// fee tl cover ////////////////////////////////////
$gt_ft_cover = 0;
$detail_ft_cover = "";
foreach ($result_tps['feetl_cover'] as $val_ft_cover) {
    $gt_ft_cover = $gt_ft_cover + $val_ft_cover['value'];
    $detail_ft_cover .= " + ".$val_ft_cover['value'];
}

///////// cost tl cover //////////////////////////////////

$detail_cover = "";
foreach ($result_tps['costtl_cover'] as $val_ct_cover) {
    $gt_ct_cover = $val_ct_cover['value'];
}

///////////////// tips tl ////////////////////////
$gt_tips_tl = 0;
$detail_tl = "";
if ($result_tl['adt'] != 0) {
    $gt_tips_tl = $gt_tips_tl + $result_tl['adt'];
    $detail_tl = $result_tl['detail'];
}

?>

<body>
    <div class="container" style="max-width: 2300px;">
        <div style="border: 2px solid black; padding: 20px;">
            <div class="header">
                <div class="gmb">
                    <img src="dist/img/kop_bar2.png" alt="header" style="height: 150px; width: 990px;">
                </div>
            </div>
        </div>
        <div style="padding: 5px 15px;">
            <div class="row">
                <div class="col-md-12">
                    <div style="font-size: 24px; font-weight: bold; text-align: center;">
                        <?php echo $row_data['judul'] ?>
                    </div>
                    <div style="font-size: 20px;  text-align: center;">
                        <?php echo $row_data['landtour'] ?>
                    </div>

                </div>
            </div>
        </div>
        <div style="padding: 5px 20px; font-size: 12px;">
            <div>
                <table class="table table-sm table-bordered">
                    <thead style="background-color: salmon;">
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Calculation</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $gt_fee_tl = 0;
                        foreach ($result_tps['breakdown'] as $val_br) {
                            if ($val_br['id'] == '1') {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                        ?>
                                <tr>
                                    <td>TL FEE PER DAY</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".") . " * " . $val_br['hari'] ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                </tr>
                            <?php
                            } else if ($val_br['id'] == "2") {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                            ?>
                                <tr>
                                    <td>TL MEAL</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".") . " * 3 * " . $val_br['hari'] ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                </tr>
                            <?php
                            } else if ($val_br['id'] == '3') {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                            ?>
                                <tr>
                                    <td>TL VOUCHER TLPN</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".") . " * 1" ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                </tr>
                            <?php
                            } else if ($val_br['id'] == '4') {
                                $gt_fee_tl = $gt_fee_tl + $val_br['value'];
                            ?>
                                <tr>
                                    <td>TL SFEE / DAY</td>
                                    <td><?php echo number_format($val_br['current'], 0, ",", ".") . " * " . $val_br['hari'] ?></td>
                                    <td><?php echo number_format($val_br['value'], 0, ",", ".") ?></td>
                                </tr>
                        <?php
                            }
                        }
                       
                        $total= $gt_fee_tl + $gt_ft_cover + $gt_tips_tl;
                        ?>
                        <tr>
                            <td>FEE TL COVERY</td>
                            <td><?php echo $detail_ft_cover ?></td>
                            <td><?php echo number_format($gt_ft_cover, 0, ",", ".") ?></td>
                        </tr>
                        <tr>
                            <td>Tips TL</td>
                            <td><?php echo $detail_tl  ?></td>
                            <td><?php echo number_format($gt_tips_tl, 0, ",", ".") ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th><?php echo number_format($total, 0, ",", ".") ?></th>
                        </tr>
                    </tfoot>
                </table>
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
    document.title = kode + "-" + judul + "-Breakdown-Feetl";
    window.print();
</script>

</html>