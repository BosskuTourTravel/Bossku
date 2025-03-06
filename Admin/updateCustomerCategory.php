<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$category = $_POST['category'];


$sql = "UPDATE customer_list SET category='".$category."' WHERE id=".$id;
// echo $sql."</br>";
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>