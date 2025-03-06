<?php
include "../db=connection.php";

$id = $_POST['id'];
$sql = "DELETE FROM MP_tokopedia_rent WHERE id=" . $id;
if ($con->query($sql) === TRUE) {
    echo "berhasil ";
} else {
    echo "gagal ";
}
