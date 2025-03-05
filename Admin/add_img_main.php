<?php
include "../db=connection.php";

$query_cek = "SELECT * FROM  selected_img_main where tour_id =" . $_POST['id'];
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
if ($row_cek['id'] == "") {
    $sql = "INSERT INTO selected_img_main VALUES ('','" . $_POST['id'] . "','" . $_POST['img1'] . "','" . $_POST['img2'] . "','" . $_POST['img3'] . "','" . $_POST['img4'] . "')";
    if (mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
    }
} else {
    $sql2 = "UPDATE selected_img_main SET img1='" . $_POST['img1'] . "',img2='" . $_POST['img2'] . "',img3='" . $_POST['img3'] . "',img4='" . $_POST['img4'] . "' WHERE tour_id='" . $_POST['id'] . "'";
    if (mysqli_query($con, $sql2)) {
        echo "success edited";
    } else {
        echo "Error: " . $sql2 . "" . mysqli_error($con);
    }
}
