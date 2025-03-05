<?php
include "../db=connection.php";
session_start();

if ($_POST['id'] != "") {
    $query = "SELECT * FROM login_staff where id='".$_POST['id']."'";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);

    $_SESSION['staff'] = $row['name'];
    $_SESSION['staff_id'] = $row['id'];
    // $_SESSION['type'] = $row['type'];
    $_SESSION['destroy'] = 0;
    // header("Location: https://www.2canholiday.com/Admin"); 
}
