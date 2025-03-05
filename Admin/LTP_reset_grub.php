<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$sql = "DELETE FROM LTP_grub_flight_value where grub_id=".$id;
if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}
$con->close();
?>