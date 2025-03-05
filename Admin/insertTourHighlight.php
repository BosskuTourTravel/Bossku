<?php
include "../site.php";
include "../db=connection.php";

$title = $_POST['title'];
$tourpackage = $_POST['tourpackage'];
$country = $_POST['country'];

$sql = "INSERT INTO tour_highlight VALUES ('',".$country.",'".$title."','".$tourpackage."','','','')";
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

?>