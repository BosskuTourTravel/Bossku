<?php
include "../db=connection.php";
$date = date("Y-m-d");
$grub = $_POST['grub'];
if ($_POST['id'] != "") {

    $sql = "INSERT INTO LTP_grub_flight VALUES ('','$date','" . $_POST['city_in'] . "','" . $_POST['city_out'] . "','','$status')";
    if (mysqli_query($con, $sql)) {
        echo "Success";
    } else {
        echo "failed";
    }
}
