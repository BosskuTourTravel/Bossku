<?php
include "../db=connection.php";
session_start();
$staff = $_POST['staff_id'];
$tgl = date("Y-m-d");

$query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='".$_POST['id']."'";
$rs_cek = mysqli_query($con,$query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
if($row_cek['id'] !=""){

    $sql2 = "UPDATE LT_insert_from_list_tmp SET img1='".$_POST['img1']."',img2='".$_POST['img2']."',img3='".$_POST['img3']."',img4='".$_POST['img4']."',tp1='".$_POST['tp1']."',tp2='".$_POST['tp2']."',tp3='".$_POST['tp3']."',tp4='".$_POST['tp4']."' WHERE id=".$id;
    if (mysqli_query($con, $sql2)) {
        echo "success";
    } else {
        echo "Error: " . $sql2 . "" . mysqli_error($con);
    }

}else{
    $sql = "INSERT INTO LT_insert_from_list_tmp VALUES ('','" . $tgl . "','" . $staff . "','" . $_POST['id'] . "','" . $_POST['img1'] . "','" . $_POST['img2'] . "','" . $_POST['img3'] . "','" . $_POST['img4'] . "','" . $_POST['tp1'] . "','" . $_POST['tp2'] . "','" . $_POST['tp3'] . "','" . $_POST['tp4'] . "')";
    if (mysqli_query($con, $sql)) {
        echo "Success";
    } else {
        echo "Failed";
    }
}
$con->close();