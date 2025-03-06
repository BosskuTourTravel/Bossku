<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$sql = "DELETE FROM `imigration` WHERE id = ".$id;

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
    echo $sql;
}

$con->close();


?>