<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$year = $_POST['year'];
$rating = $_POST['rating'];
$pricepackage = $_POST['pricepackage'];


$sql = "UPDATE tour_price_package SET name='".$name."'	, price_package=".$pricepackage.", year='".$year."', rating=".$rating." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>