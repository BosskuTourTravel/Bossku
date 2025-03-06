<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$destination = $_POST['destination'];
$pax = $_POST['pax'];
$month = $_POST['month'];
$email = $_POST['email'];
$from = $_POST['from'];
$city = $_POST['city'];
$address = $_POST['address'];
$customer_category = $_POST['customer_category'];
$id = $_POST['id'];
$departure = $_POST['departure'];
$dateNow = date("Y-m-d H:i:s");

$sql = "UPDATE customer_list SET customer_name='".$name."',address='".$address."', phone_number='".$phone."', tour_type='".$type."', destination='".$destination."', departure_date='".$departure."',total_pax='".$pax."', month_planning='".$month."', email='".$email."', customer_from='".$from."', city='".$city."',category='".$customer_category."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();


?>