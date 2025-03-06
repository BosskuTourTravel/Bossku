
<?php
include "../db=connection.php";
session_start();
if ($_POST['nama'] != "") {

    $sql = "UPDATE  MP_tokopedia_land SET nama='" . $_POST['nama'] . "' WHERE id='" . $_POST['id'] . "'";
    if (mysqli_query($con, $sql)) {
       echo "Berhasil";
    } else {
        echo "Gagal";
    }
} else {
    echo "data ID tidak tersedia";
}
?>