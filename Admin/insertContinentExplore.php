<?php
include "../site.php";
include "../db=connection.php";

$title = $_POST['title'];
$description = $_POST['desc'];
$country = $_POST['country'];
$city = $_POST['city'];
$continent = $_POST['continent'];

$sql = "INSERT INTO continent_explore VALUES ('',".$continent.",'".$title."','".$description."','".$country."','".$city."')";
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

?>