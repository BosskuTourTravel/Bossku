<?php
include "../db=connection.php";
session_start();

$sql = "INSERT INTO YT_Landtour VALUES ('',".$_POST['id'].",'" . $_POST['link'] . "','" . $_SESSION['staff_id'] . "')";
if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();
