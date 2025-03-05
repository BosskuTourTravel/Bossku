<?php
include "../db=connection.php";
if ($_POST['status'] != "") {
    $sql2 = "UPDATE Upload_Drive2 SET status='" . $_POST['status'] . "'  WHERE id=" . $_POST['id'];
    // var_dump($sql2);
    if (mysqli_query($con, $sql2)) {
        echo "success";
    } else {
        echo "failed";
    }
}
