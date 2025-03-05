<?php
include "../site.php";
include "../db=connection.php";
include "../Activity/Api/Api_request.php";
session_start();
$date = date("Y-m-d H:i:s");
$id = $_POST['id'];

// var_dump($cart_tiket);
$datareq = array(
    "type" => $_SESSION['type'],
    "token" => $_SESSION['token'],
    "data" => $id
);
// var_dump($datareq);
$tiket = get_etiket($datareq);
$result_tiket = json_decode($tiket, true);

echo $result_tiket['data']['data']['ticketUrl'];
// var_dump($result_tiket);
// var_dump($result_checkout['data']);

?>