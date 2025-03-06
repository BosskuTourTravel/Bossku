<?php
include "../site.php";
include "../db=connection.php";
$id = $_POST['id'];
$promo = $_POST['promo'];

$sql2 = "UPDATE paket_tour_online SET promo='" . $promo . "' WHERE id='" . $id . "'";
if (mysqli_query($con, $sql2)) {
    echo "Berhasil Update ";
} else {
    echo "Gagal Update";
}


$con->close();
