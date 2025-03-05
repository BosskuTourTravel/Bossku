<?php
//export.php  
include "../db=connection.php";
if ($_POST['trans_type'] != "") {
     $sql = "INSERT INTO LT_selected_trans VALUES ('','".$_POST['tour_id']."','".$_POST['guide']."','" . $_POST['durasi'] . "','" . $_POST['trans_type'] . "','".$_POST['day']."','')";
     // var_dump($sql);
     if (mysqli_query($con, $sql)) {
         echo "berhasil";
     } else {
         echo "gagal";
     }
}
$con->close();