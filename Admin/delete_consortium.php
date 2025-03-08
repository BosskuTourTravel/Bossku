<?php
include "../db=connection.php";

$sql = "DELETE FROM consortium_list WHERE id='".$_POST['id']."'";

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$con->close();


?>