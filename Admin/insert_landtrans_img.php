<?php
include "../db=connection.php";
if ($_POST['id'] != "") {
    $sql2 = "UPDATE  Transport_new SET img='" . $_POST['img'] . "' where  id='" . $_POST['id'] . "'";
    if (mysqli_query($con, $sql2)) {
        echo "berhasil";
    } else {
        echo "gagal";
    }
} else {
    echo "data ID tidak tersedia";
}
