<?php
include "../db=connection.php";
$tgl = date("Y-m-d");
if ($_POST['master'] != "") {
     $sql = "INSERT INTO LTHR_add_hotel VALUES ('','".$_POST['master']."','".$_POST['copy']."','".$_POST['hari']."','".$_POST['hotel_id']."','".$_POST['rate']."','".$tgl."','')";
     if (mysqli_query($con, $sql)) {
          echo "Berhasil";
     } else {
          echo "gagal";
     }
}
