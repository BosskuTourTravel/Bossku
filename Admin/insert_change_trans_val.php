<?php
include "../site.php";
include "../db=connection.php";
$col = $_POST['col'];
$date = date("Y-m-d");
$status = $_SESSION['staff_id'];
$b = 0;
$g = 0;
if ($_POST['loop'] != "") {
    for ($i = 1; $i < $_POST['loop']; $i++) {
        $sql = "INSERT INTO LT_add_change_trans VALUES ('','" . $date . "','" . $_POST['tour_id'] . "','" . $_POST['hari'] . "','$i','" . $_POST['city'.$i] . "','" . $_POST['agent'.$i] . "','" . $_POST['trans'] . "','" . $_POST['rent'.$i] . "','" . $_POST['season'.$i] . "','" . $_POST['capacity'.$i] . "','" . $_POST['price'.$i] . "','$status')";
        if (mysqli_query($con, $sql)) {
            $b++;
        } else {
            $g++;
        }

    }
    echo "Berhasil : ".$b." , Gagal : ".$g;
} else {
    echo "data kosong !!!";
}
$con->close();
