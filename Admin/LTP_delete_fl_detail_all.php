<?php
include "../site.php";
include "../db=connection.php";

// $id = $_POST['id'];
$data =  explode(",", $_POST['id']);
$berhasil = 0;
$gagal = 0;
foreach ($data as $id) {
    $sql = "DELETE FROM LTP_route_detail WHERE id_grub=" . $id;
    if ($con->query($sql) === TRUE) {
        $berhasil++;
    } else {
       $gagal++;
    }
}
$con->close();
echo "success";
