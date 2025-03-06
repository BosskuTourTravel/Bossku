<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['desc'];
$country = $_POST['country'];
$city = $_POST['city'];
$continent = $_POST['continent'];

$sql = "UPDATE continent_explore SET continent=".$continent.",title='".$title."',description='".$description."',country='".$country."',city='".$city."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

?>