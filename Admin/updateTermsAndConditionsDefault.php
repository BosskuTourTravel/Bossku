<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$country = $_POST['country'];
$term = $_POST['terms'];

$sql = "UPDATE termsandconditions_default SET country=".$country.", name='".$term."' WHERE id=".$id;

if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();



?>