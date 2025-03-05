<?php
include "../db=connection.php";
if ($_POST['id'] != "") {
    $query = "SELECT * FROM Upload_tokopedia_rent  where id='" . $_POST['id'] . "'";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);

    echo $row['deskripsi'];
}
?>

