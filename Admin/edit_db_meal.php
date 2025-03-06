<?php
include "../db=connection.php";

$query = "SELECT * FROM Guest_meal2 order by id ASC";
$rs = mysqli_query($con, $query);
$berhasil = 0;
$gagal = 0;
while ($row = mysqli_fetch_array($rs)) {
    
    if($row['ket'] !=""){
        $slug = $row['negara']."-".$row['ket'];
    }else{
        $slug = $row['negara'];
    }
    $sql = "UPDATE  Guest_meal2 SET ket='" . $slug . "'  where  id=" . $row['id'];
    if (mysqli_query($con, $sql)) {
        $berhasil++;
    } else {
        $gagal++;
    }
}
echo "berhasil : ".$berhasil."</br>";
echo "gagal : ".$gagal;