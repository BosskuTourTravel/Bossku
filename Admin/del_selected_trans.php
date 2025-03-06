<?php
include "../db=connection.php";

// // echo $row_list['tour_id']."</br>";
$sql = "DELETE FROM LT_selected_trans WHERE id=" . $_POST['id'];
if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Gagal";
}


$con->close();
