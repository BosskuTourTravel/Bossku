<?php
include "../db=connection.php";
$grub = $_POST['grub'];
if ($_POST['id'] != "") {

    $sql = "UPDATE LTP_grub_flight SET grub_name='" . $_POST['name'] . "' where id=" . $_POST['id'];
    // var_dump($sql);
    if (mysqli_query($con, $sql)) {
        echo "Berhasil Update Data, Reload page";
    } else {
        echo "Gagal Update Data";
    }
    $con->close();
}
