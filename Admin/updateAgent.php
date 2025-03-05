<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
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


$sql = "UPDATE agent SET name='".$name."', email='".$email."', home_phone='".$homephone."', home_fax='".$homefax."', car_phone='".$carphone."', home_webpage='".$homewebpage."', street='".$street."', city='".$city."', zipcode='".$zipcode."', state='".$state."', country='".$country."', tour_country='".$tourcountry."', website='".$website."', phone='".$phone."', fax='".$fax."', pager='".$pager."', company='".$company."', job_title='".$jobtitle."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
    header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();






?>