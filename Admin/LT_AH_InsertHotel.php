<?php
include "../db=connection.php";
$tgl = date("Y-m-d");
if ($_POST['master'] != "") {
     $sql = "INSERT INTO LT_AH_ListHotel VALUES ('','".$_POST['master']."','".$_POST['copy']."','".$_POST['grub_id']."','".$_POST['sfee_id']."','".$_POST['hari']."','".$_POST['hotel_id']."','".$_POST['rate']."','".$tgl."','')";
     if (mysqli_query($con, $sql)) {
          echo "Berhasil";
     } else {
          echo "gagal";
     }
}
