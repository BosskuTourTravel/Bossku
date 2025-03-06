<?php
include "../site.php";
include "../db=connection.php";
$company = $_POST['company'];
$name = $_POST['name'];
$email = $_POST['email'];
$city = $_POST['city'];
$zipcode = $_POST['zipcode'];
$state = $_POST['state'];
$country = $_POST['country'];
$tourcountry = $_POST['tourcountry'];
$website = $_POST['website'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$jobtitle = $_POST['jobtitle'];
$homephone = $_POST['homephone'];
$homefax = $_POST['homefax'];
$carphone = $_POST['carphone'];
$homewebpage = $_POST['homewebpage'];
$street = $_POST['street'];
$pager = $_POST['pager'];
$notes = $_POST['notes'];


$sql = "INSERT INTO agent VALUES('','".$name."','".$email."','".$homephone."','".$homefax."','".$carphone."','".$homewebpage."','".$street."','".$city."','".$zipcode."','".$state."','".$country."','".$tourcountry."','".$website."','".$phone."','".$fax."','".$pager."', '".$company."','".$jobtitle."','',0)";
//echo $sql."</br>";
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();






?>