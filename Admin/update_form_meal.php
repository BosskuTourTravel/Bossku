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
$ket = $_POST['ket'];

///// bf
$sql_bf = "UPDATE Guest_meal2 SET kurs='$kurs',price='$bf' where ket LIKE '%$ket%' && meal_type='BREAKFAST'";
// var_dump($sql);
if (mysqli_query($con, $sql_bf)) {
    $berhasil++;
} else {
    $gagal++;
}
/// lunch
$sql_ln = "UPDATE Guest_meal2 SET kurs='$kurs',price='$ln' where ket LIKE '%$ket%' && meal_type='LUNCH'";
// var_dump($sql);
if (mysqli_query($con, $sql_ln)) {
    $berhasil++;
} else {
    $gagal++;
}

////// dn
$sql_dn = "UPDATE Guest_meal2 SET kurs='$kurs',price='$dn' where ket LIKE '%$ket%' && meal_type='DINNER'";
// var_dump($sql);
if (mysqli_query($con, $sql_dn)) {
    $berhasil++;
} else {
    $gagal++;
}
echo "data berhasil Update: ".$berhasil.", Gagal : ".$gagal;
