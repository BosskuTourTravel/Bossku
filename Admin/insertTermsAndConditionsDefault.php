<?php
include "../site.php";
include "../db=connection.php";


$country = $_POST['country'];
$term = $_POST['terms'];

$sql = "INSERT INTO termsandconditions_default VALUES ('',".$country.",'".$term."')";

if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();



?>