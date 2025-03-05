<?php
include "../db=connection.php";
$sql = "UPDATE YT_Landtour SET link='" . $_POST['link'] . "' WHERE tour_id='" . $_POST['id'] . "'";
if (mysqli_query($con, $sql)) {
    echo "berhasil";
} else {
   echo "gagal";
}
