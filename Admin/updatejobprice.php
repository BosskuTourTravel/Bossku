<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$nama_job = $_POST['nama_job'];
$harga = $_POST['harga'];


$sql = "UPDATE jenisgaji SET nama_job='".$nama_job."', harga='".$harga."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}


$con->close();



?>