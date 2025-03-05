<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$tour_country = $_POST['country'];
  
$sql2 = "UPDATE agent SET tour_country='".$tour_country."' WHERE id=".$agent;
if ( mysqli_query($con, $sql2)) {
    echo "success";

} else {
    echo "Error: " . $sql2 . "" . mysqli_error($con);
    header("location:https://www.2canholiday.com/Admin/#");
}

$con->close();





?>