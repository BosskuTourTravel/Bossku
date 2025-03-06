<?php
include "../db=connection.php";

// // echo $row_list['tour_id']."</br>";
$sql = "DELETE FROM LT_add_listTmp WHERE id=".$_POST['id'];
if ($con->query($sql) === TRUE) {
  echo "Berhasil" ;
} else {
   echo "Gagal";
}


$con->close();
