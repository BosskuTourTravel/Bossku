<?php 
include "../db=connection.php";
$data = explode(",", $_POST['id']);
$sql = "INSERT INTO selected_img_tmp VALUES ('','" . $_POST['tour_id']. "','".$_POST['hari']."','" . $data[0]. "','" . $data[1] . "')";
if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
?>