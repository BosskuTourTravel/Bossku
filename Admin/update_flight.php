<?php
include "../site.php";
include "../db=connection.php";
session_start();
// bentuk array
$data = $_POST['data'];
// bentuk string
// $val_data = json_encode($data);
// var_dump($data['day']);
$val_data = json_encode($data['day']);
// var_dump($data['staff']);

$sql = "INSERT INTO LT_add_flight VALUES ('','".$data['id']."','".$val_data."','".$data['staff']."')";
if (mysqli_query($con, $sql)) {
echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

