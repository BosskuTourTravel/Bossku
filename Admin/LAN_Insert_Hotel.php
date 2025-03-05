<?php
include "../db=connection.php";
$tgl = date("Y-m-d");
if ($_POST['master'] != "") {
     $sql = "INSERT INTO LAN_Hotel_List VALUES ('','".$tgl."','".$_POST['master']."','".$_POST['hotel_id']."','".$_POST['rate']."','','','".$_POST['hotel_pkg_id']."')";
     if (mysqli_query($con, $sql)) {
          echo "Berhasil";
     } else {
          echo "gagal";
     }
}
