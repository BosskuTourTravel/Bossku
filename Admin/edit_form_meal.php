<?php
include "../db=connection.php";

$date = date('Y-m-d');
$bf = $_POST['bf'];
$ln = $_POST['ln'];
$dn = $_POST['dn'];
$negara = $_POST['negara'];
$kurs = $_POST['kurs'];

$sql = "UPDATE Guest_meal2 SET negara='$negara',meal_type='$bld',ket='" . $ket . "',kurs='$kurs',price='$harga_idr' where id='" . $row_update['id'] . "'";
if (mysqli_query($con, $sql)) {
    echo "berhasil Update ";
} else {
    echo "Gagal Update ";
}
