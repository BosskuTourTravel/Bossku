<?php
include "../site.php";
include "../db=connection.php";
$id = $_POST['id'];
$staff = $_POST['staff'];
$nominal = $_POST['nominal'];



$sql = "UPDATE lemburPrice SET nama='".$staff."', nominal='".$nominal."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();
?>