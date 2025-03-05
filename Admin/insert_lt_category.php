<?php
include "../site.php";
include "../db=connection.php";
$id = $_POST['id'];
$staff = $_POST['staff'];

if ($_POST['cek'] == '0') {

    // var_dump($id." - ".$staff);
    $sql = "INSERT INTO LT_add_Category VALUES ('','$id','$staff','')";
    if (mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "Error ";
    }
} else {
    $sql2 = "UPDATE LT_add_Category SET category='" . $staff . "' WHERE tour_id='" . $id . "'";
    if (mysqli_query($con, $sql2)) {
        echo "Berhasil Update ";
    } else {
        echo "Gagal Update";
    }
    // var_dump("Update ".$id." - ".$staff);
}


$con->close();
