<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/midtrans/Midtrans.php';
Config::$serverKey = 'SB-Mid-server-NAv2rsJEX9aTl9Fewbw3Ltsx';
Config::$clientKey = 'SB-Mid-client-0fUQA7oGBujmTtGE';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $_POST['price'], // no decimal allowed for creditcard
);

// Optional
$item1_details = array(
    'id' => 'a1',
    'price' => $_POST['adt_price'],
    'quantity' => $_POST['adt'],
    'name' => "Adt"
);
$item2_details = [];
if ($_POST['chd'] > 0) {
    $item2_details = array(
        'id' => 'a2',
        'price' => $_POST['cnb_price'],
        'quantity' => $_POST['chd'],
        'name' => "Chd"
    );
    $item_details = array($item1_details, $item2_details);
}else{
    $item_details = array($item1_details);
}
// Optional


// Optional


// Optional
// $billing_address = array(
//     'first_name'    => "Andri",
//     'last_name'     => "Litani",
//     'address'       => "Mangga 20",
//     'city'          => "Jakarta",
//     'postal_code'   => "16602",
//     'phone'         => "081122334455",
//     'country_code'  => 'IDN'
// );

// // Optional
// $shipping_address = array(
//     'first_name'    => "Obet",
//     'last_name'     => "Supriadi",
//     'address'       => "Manggis 90",
//     'city'          => "Jakarta",
//     'postal_code'   => "16601",
//     'phone'         => "08113366345",
//     'country_code'  => 'IDN'
// );

// Optional
$customer_details = array(
    'first_name'    => $_POST['nama'],
    'last_name'     => "",
    'email'         => $_POST['email'],
    'phone'         => $_POST['tlpn'],
);

// Optional, remove this to display all available payment methods
$enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel');

// Fill transaction details
$transaction = array(
    'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}

// echo "snapToken = " . $snap_token;

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-NAv2rsJEX9aTl9Fewbw3Ltsx\';');
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php

include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php";
?>
<style>
    .ui-highlight .ui-state-default {
        background: palevioletred !important;
        border-color: palevioletred !important;
        color: white !important;
    }

    .ui-highlight .ui-state-active {
        background: darkblue !important;
        border-color: darkblue !important;
        color: white !important;
    }
</style>
<script src="./js/script.js"></script>
<?php
$sub_adt = intval($_POST['adt']) * intval($_POST['adt_price']);
$sub_chd = intval($_POST['chd']) * intval($_POST['cnb_price']);
$gt = $sub_adt + $sub_chd;
?>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center p-5 gap-2">
        <div class="card w-full w-75">
            <div class="card-header d-flex justify-content-center">
                <div><b><?php echo $_POST['judul'] ?></b></div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row justify-content-start">
                    <div class="w-25"><b>Nama Pemesan </b></div>
                    <div>: <?php echo $_POST['nama'] ?></div>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <div class="w-25"><b>Email </b></div>
                    <div>: <?php echo $_POST['email'] ?></div>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <div class="w-25"><b>No Tlpn </b></div>
                    <div>: <?php echo $_POST['tlpn'] ?> </div>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <div class="w-25"><b>Tgl Berangkat </b></div>
                    <div>: <?php echo $_POST['tgl'] ?> </div>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <div class="w-25"><b>Total Kamar </b></div>
                    <div>: <?php echo $_POST['room'] ?> Rooms </div>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <div class="w-25"><b>Noted </b></div>
                    <div>: <?php echo $_POST['ket'] ?> </div>
                </div>
            </div>
        </div>
        <div class="card w-full w-75">
            <div class="card-body">
                <table class="table table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Produk di Pesan</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Sub Total Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <div><?php echo $_POST['judul'] ?></div>
                                <div class="text-secondary">Adult</div>
                            </th>
                            <td><?php echo number_format($_POST['adt_price']) ?></td>
                            <td><?php echo $_POST['adt'] ?></td>
                            <td><?php echo number_format($sub_adt) ?></td>
                        </tr>
                        <?php
                        if ($_POST['chd'] > 0) {
                        ?>
                            <tr>
                                <th>
                                    <div><?php echo $_POST['judul'] ?></div>
                                    <div class="text-secondary">Child</div>
                                </th>
                                <td><?php echo number_format($_POST['cnb_price']) ?></td>
                                <td><?php echo $_POST['chd'] ?></td>
                                <td><?php echo number_format($sub_chd) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <th colspan="3">Grand Total</th>
                            <th><?php echo number_format($gt) ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <button type="button" class="btn btn-success btn-sm" id="pay-button">Pembayaran</button>
            </div>
        </div>
    </div>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snap_token ?>', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
</body>
<?php
include "footer.php";
?>

</html>