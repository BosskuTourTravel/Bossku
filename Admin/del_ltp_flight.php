<?php
include "../site.php";
include "../db=connection.php";
$berhasil = 0;
$gagal = 0 ;

foreach($_POST['id'] as $id){

$sql = "DELETE FROM flight_LTnew WHERE id=".$id;

if ($con->query($sql) === TRUE) {
    $berhasil++;
} else {
    $gagal++;
}

}
$con->close();
echo "data Berhasil : ".$berhasil." , data gagal : ".$gagal;
?>