<?php
include "../site.php";
include "../db=connection.php";
$id = $_POST['id'];
$staff = $_POST['staff'];

$sql = "UPDATE LT_order_list SET handle='".$staff."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();
?>