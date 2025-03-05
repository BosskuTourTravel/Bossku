<?php
include "../db=connection.php";
$date = date('Y-m-d');
$bf = $_POST['bf'];
$ln = $_POST['ln'];
$dn = $_POST['dn'];
$negara = $_POST['negara'];
$kurs = $_POST['kurs'];
if(isset($_POST['ket'])){
    $ket = $negara."-".$_POST['ket'];
}else{
    $ket = $negara;
}

$query = "SELECT * FROM Guest_meal2 where negara LIKE '%$negara%' && ket LIKE '%$ket%'";
$rs = mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);
if(isset($row['id'])){
    echo "sama";
}else{
    echo "beda";
}
