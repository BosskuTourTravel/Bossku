<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$harga = $_POST['harga'];
$remark = $_POST['remark'];


$sql = "UPDATE transport SET harga='".$harga."', remark='".$remark."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}


$con->close();



?>