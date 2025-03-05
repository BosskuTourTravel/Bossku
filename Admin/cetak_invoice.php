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
?>
<?php
$query_data = "SELECT * FROM  LT_order_list where id=" . $_GET['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$pax = $row_data['adt']+$row_data['chd'];

$limited =  date('d-m-Y',strtotime('+2 day',strtotime($row_data['tgl'])));
$query_itin = "SELECT * FROM  LT_itinerary2 where id=" . $row_data['master_id'];
$rs_itin = mysqli_query($con, $query_itin);
$row_itin = mysqli_fetch_array($rs_itin);

$book = date('dmy', strtotime($row_data['tgl'])).$row_data['id'];

?>

<body>
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
                            <div>No Invoice</div>
                            <div>Customer Name</div>
                            <div>No Telpon</div>
                            <div>Email</div>
                        </div>
                        <div class="col-8">
                            <div>: <?php echo $book?></div>
                            <div>: <?php echo $row_data['nama'] ?></div>
                            <div>: <?php echo $row_data['tlpn'] ?></div>
                            <div>: <?php echo $row_data['email'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
        <div style="padding: 20px;">BERIKUT KAMI RINCIKAN DETAIL PEMBAYARAN LANDTOUR :</div>
        <div style="padding: 10px 40px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Landtour Name</th>
                        <th>keberangkatan</th>
                        <th>Pax</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row_data['nama_paket'] ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row_data['tgl_berangkat'])) ?></td>
                        <td><?php echo $pax ?></td>
                        <td><?php echo "IDR ". number_format($row_data['price_web'], 0, ",", ".") ?></td>
                    </tr>
                </tbody>
                <tfoot style="color: darkred;">
                    <tr>
                        <td colspan="2">Time Limited</td>
                        <td colspan="2"><?php echo $limited ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
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
</body>
<script>
    var kode = "<?php
                $judul = "NO_CODE";
                if ($row_itin['landtour'] != "undefined") {
                    $judul = $row_itin['landtour'];
                }
                echo $judul;
                ?>";
    var judul = "<?php echo $row_itin['judul'] ?>";
    var nama = "<?php echo $book ?>"
    document.title = nama+"-"+kode + "-" + judul;
    window.print();
</script>

</html>