<?php
include "../db=connection.php";
$date = date('Y-m-d');
$berhasil = 0;
$gagal = 0;
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

///// bf
$sql_bf = "INSERT INTO Guest_meal2 VALUES ('','$date','$negara','BREAKFAST','".$ket."','$kurs','$bf','')";
// var_dump($sql);
if (mysqli_query($con, $sql_bf)) {
    $berhasil++;
} else {
    $gagal++;
}
/// lunch
$sql_ln = "INSERT INTO Guest_meal2 VALUES ('','$date','$negara','LUNCH','".$ket."','$kurs','$ln','')";
// var_dump($sql);
if (mysqli_query($con, $sql_ln)) {
    $berhasil++;
} else {
    $gagal++;
}

////// dn
$sql_dn = "INSERT INTO Guest_meal2 VALUES ('','$date','$negara','DINNER','".$ket."','$kurs','$dn','')";
// var_dump($sql);
if (mysqli_query($con, $sql_dn)) {
    $berhasil++;
} else {
    $gagal++;
}
echo "data berhasil : ".$berhasil.", Gagal : ".$gagal;
