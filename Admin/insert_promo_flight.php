<?php
include "../db=connection.php";
session_start();

$sql = "INSERT INTO promo_flight VALUES ('','" . $_POST['nama'] . "','" . $_POST['tgl'] . "','".$_POST['ket']."','" . $_SESSION['staff_id'] . "')";

if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error: " . $sql ;
}
$con->close();
