<?php
include "../site.php";
include "../db=connection.php";
$col = $_POST['col'];
$date = date("Y-m-d");
$status = $_SESSION['staff_id'];
$berhasil = 0;
$gagal = 0;
if ($_POST['hari'] != "") {
for($i=1; $i<=$_POST['item'];$i++){
    $sql = "INSERT INTO LT_add_guide_new VALUES ('','".$_POST['tour_id']."','".$_POST['hari']."','".$_POST['negara'.$i]."','".$_POST['fee'.$i]."','".$_POST['sfee'.$i]."','".$_POST['bf'.$i]."','".$_POST['ln'.$i]."','".$_POST['dn'.$i]."','".$_POST['vt'.$i]."','".$date."','$status')";
    // var_dump($sql);
    if (mysqli_query($con, $sql)) {
        $berhasil++;
    } else {
        $gagal++;
    }
}
echo "berhasil : ".$berhasil." , Gagal : ".$gagal;
} else {
    echo "Data Gagal Insert !!";
}

$con->close();
