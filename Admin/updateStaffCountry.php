<?php
include "../site.php";
include "../db=connection.php";

$staff = $_POST['staff'];
$tour_country = $_POST['country'];
$id = $_POST['id'];


$sql = "UPDATE staff_country SET staff=".$staff.", country='".$tour_country."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}


$con->close();




?>