<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$sql = "DELETE FROM LAN_Hotel_List WHERE id=" . $id;
if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}
$con->close();
