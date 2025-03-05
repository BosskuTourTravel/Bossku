<?php
include "../site.php";
include "../db=connection.php";

$requirements = $_POST['requirements'];
$notes = $_POST['notes'];

$sql = "UPDATE visa_requirements SET description = '".$requirements."'";
$sql2 = "UPDATE visa_notes SET description = '".$notes."'";
if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
    echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

?>