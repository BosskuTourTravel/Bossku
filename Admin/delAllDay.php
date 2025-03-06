<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$sql = "DELETE FROM date_package WHERE tourpackage=".$id;

//echo $sql;
if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$con->close();


?>