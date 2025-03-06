<?php
include "../db=connection.php";

$id = $_POST['id'];
$sql = "DELETE FROM Upload_tokopedia_rent WHERE mp_id=" . $id;
if ($con->query($sql) === TRUE) {
    echo "berhasil ";
} else {
    echo "gagal ";
}
