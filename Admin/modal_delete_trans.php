<?php
include "../site.php";
include "../db=connection.php";

if ($_POST['change'] == '0') {
    $sql = "DELETE FROM LT_add_selected_trans WHERE tour_id='".$_POST['tour_id']."' && transport_type='".$_POST['trans']."' && hari='".$_POST['id']."'";
    if ($con->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Gagal";
    }
} else {
    $sql2 = "DELETE FROM LT_add_change_trans WHERE tour_id='".$_POST['tour_id']."' && transport_type='".$_POST['trans']."' && hari='".$_POST['id']."'";
    if ($con->query($sql2) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Gagal";
    }
}
$con->close();
