<?php 
include "../db=connection.php";
session_start();
$date = date('Y-m-d');

$sql = "INSERT INTO Hotel_Package VALUES ('','$date','" . $_POST['nama'] . "','" . $_POST['id'] . "','".$_SESSION['staff_id']."')";
if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();
?>