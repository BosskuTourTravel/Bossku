<?php
include "../db=connection.php";
$id = $_POST['id']; 
$nominal= $_POST['nominal'];
$sql = "UPDATE LT_profit_range SET  nominal='".$nominal."'  where  id=".$id;
if (mysqli_query($con, $sql)) {
     echo "berhasil";
} else {
     echo "gagal";
}
$con->close();