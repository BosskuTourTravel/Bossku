<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$sql = "DELETE FROM LTP_insert_sfee WHERE id=" . $id;
if ($con->query($sql) === TRUE) {

    $sql2 = "DELETE FROM LTP_tgl_sfee  WHERE sfee_id=" . $id;
    if ($con->query($sql2) === TRUE) {
        echo "success";
    }
} else {
    echo "error";
}
$con->close();
