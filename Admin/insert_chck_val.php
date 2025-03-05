<?php
include "../db=connection.php";

$query_cek = "SELECT * FROM LT_include_checkbox where tour_id='" . $_POST['tour_id'] . "' && master_id='" . $_POST['master_id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
if ($row_cek['id'] == "") {
    $sql = "INSERT INTO LT_include_checkbox VALUES ('','" . $_POST['tour_id'] . "','" . $_POST['master_id'] . "','" . $_POST['chck'] . "')";
    if (mysqli_query($con, $sql)) {
        echo "Success";
    } else {
        echo "Gagal";
    }
} else {
    $sql2 = "UPDATE LT_include_checkbox SET chck='" . $_POST['chck'] . "' WHERE id=" . $row_cek['id'];
    if (mysqli_query($con, $sql2)) {
        echo "success Update";
    } else {
        echo "Error Update";
    }
}
$con->close();