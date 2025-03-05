<?php
include "../db=connection.php";

$tour_id = $_POST['id'];
$grub_id = $_POST['grub_id'];
$sfee_id = $_POST['sfee_id'];
$pax = $_POST['pax'];
$twn = $_POST['twn'];
$sgl = $_POST['sgl'];
$cnb = $_POST['cnb'];
$inf = $_POST['inf'];
$ltwn = $_POST['ltwn'];
$tl_pax = $_POST['tl_pax'];
$tl_fee = $_POST['tl_fee'];
$tl_meal = $_POST['tl_meal'];
$tl_tlpn = $_POST['tl_tlpn'];
$tl_sfee = $_POST['tl_sfee'];
$tgl_ber = $_POST['tgl_ber'];
$promo = $_POST['promo'];
$start = $_POST['start'];
$agent = $_POST['agent'];
$gt = $_POST['gt'];
$negara = $_POST['negara'];
$pax_tour = $_POST['pax_tour'];
$hotel_id = $_POST['hotel_id'];

$sql = "INSERT INTO paket_tour_online VALUES ('','".$tour_id."','".$grub_id."','" . $sfee_id. "','".$hotel_id."','" . $pax . "','" . $twn . "','".$sgl."','".$cnb."','".$inf."','".$ltwn."','".$tl_pax."','".$tl_fee."','".$tl_meal."','".$tl_tlpn."','".$tl_sfee."','".$tgl_ber."','".$promo."','".$start."','".$agent."','".$pax_tour."','".$negara."','".$gt."','')";
if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();
