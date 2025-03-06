<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$date = date("Y-m-d");

$sql = "UPDATE login_staff SET status=0 , stampofdelete='".$date."' WHERE id=".$id;

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$con->close();


?>