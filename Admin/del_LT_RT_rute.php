<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$sql = "DELETE FROM  LT_Rute WHERE id=" . $id;

if ($con->query($sql) === TRUE) {

    $sql2 = "DELETE FROM  LT_RT_list_tmp  WHERE rute_id=" . $id;
    if ($con->query($sql2) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}

$con->close();
