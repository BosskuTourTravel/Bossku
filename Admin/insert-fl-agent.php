
<?php
include "../db=connection.php";
session_start();
// cek route
$test = 0;
$invalid = 0;
$berhasil = 0;
$gagal = 0;
for ($i = 1; $i <= $_POST['loop']; $i++) {
    $fl = $_POST['fl' . $i];
    $city_in = $_POST['city_in' . $i];
    $city_out = $_POST['city_out' . $i];
    $adt = $_POST['adt' . $i];
    $chd = $_POST['chd' . $i];
    $inf = $_POST['inf' . $i];
    $musim = $_POST['musim' . $i];
    //// maaf nama kebalik ehehehe
    $tipe = $_POST['trip' . $i];
    $rute = $_POST['tipe' . $i];
    $bagasi = $_POST['bagasi' . $i];
    $bf = $_POST['bf' . $i];
    $ln = $_POST['ln' . $i];
    $dn = $_POST['dn' . $i];
    $id = $_POST['id'];
    if ($adt != "") {
        $sql = "INSERT INTO promo_flight_detail VALUES ('','" . $id. "','" . $fl . "','" . $city_in. "','" . $city_out . "','".$musim."','".$rute."','".$tipe."','".$adt."','".$chd."','".$inf."','".$bagasi."','".$bf."','".$ln."','".$dn."','offline','".$_SESSION['staff_id']."')";
        if (mysqli_query($con, $sql)) {
            $berhasil++;
        } else {
            $gagal++;
        }
    }
}
// echo "test : ".$test;
echo "Data berhasil Upload : " . $berhasil . "</br>";
echo "Data gagal Upload : " . $gagal . "</br>";
?>
