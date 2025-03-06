<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$sql = "DELETE FROM Prev_makeLT WHERE id=".$id;

if ($con->query($sql) === TRUE) {
    $sql2 = "DELETE FROM Prev_Include_LT WHERE id_LT=".$id;
    $sql3 = "DELETE FROM Prev_Exclude_LT WHERE id_LT=".$id;
    echo "success";
} else {
    echo "error";
}

$con->close();


?>