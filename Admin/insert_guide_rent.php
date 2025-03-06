<?php
include "../db=connection.php";
$date = date('Y-m-d');
$sql = "INSERT INTO LT_add_guide_price VALUES ('','".$_POST['tourid']."','".$_POST['id']."','".$_POST['hari']."','".$_POST['sel']."','".$_POST['fee']."','".$_POST['sfee']."','".$_POST['bf']."','".$_POST['ln']."','".$_POST['dn']."','".$_POST['vt']."','".$date."','')";
if (mysqli_query($con, $sql)) {
    echo "Berhasil";
} else {
    echo "Gagal";
}
