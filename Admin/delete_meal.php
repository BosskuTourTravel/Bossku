<?php
include "../db=connection.php";

$slug = $_POST['slug'];

$sql = "DELETE FROM Guest_meal2 WHERE ket LIKE '%$slug%'";

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$con->close();


?>