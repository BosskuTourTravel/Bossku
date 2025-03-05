<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$sql = "DELETE FROM LT_add_transport WHERE id=".$id;
if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}
$con->close();

?>