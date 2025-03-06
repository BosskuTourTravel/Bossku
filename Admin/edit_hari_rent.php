<?php
include "../db=connection.php";
$sql = "UPDATE  Rent_selected SET status='" . $_POST['hari'] . "' WHERE id='" . $_POST['id'] . "' && id_package='" . $_POST['package'] . "'";
// var_dump($sql);
if (mysqli_query($con, $sql)) {
    echo "berhasil";
} else {
    echo "gagal";
}
