<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$files = $_POST['files'];

$sql = "UPDATE agent_files set deletedStatus=1 WHERE id=".$id;

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$con->close();


?>