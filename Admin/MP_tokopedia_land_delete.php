<?php
include "../db=connection.php";
$berhasil = 0;
$gagal = 0;
$id = $_POST['id'];

foreach ($id as $val) {
    $sql = "DELETE FROM Upload_tokopedia_land WHERE id=" . $val;
    if ($con->query($sql) === TRUE) {
        $berhasil++;
    } else {
        $gagal++;
    }
}

echo "berhasil " . $berhasil;
