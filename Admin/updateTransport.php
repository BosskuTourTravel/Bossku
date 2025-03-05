<?php
include "../site.php";
include "../db=connection.php";
session_start();

$id = $_POST['id'];
$agent = $_POST['agent'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$city = $_POST['city'];
$transport = $_POST['transport'];
$seat = $_POST['seat'];
$rent = $_POST['rent'];
$duration = $_POST['duration'];
$kurs = $_POST['kurs'];
$price = $_POST['price'];
$tipping = $_POST['tipping'];
$charge = $_POST['charge'];
$tglpergi = $_POST['tglpergi'];
$tglpulang = $_POST['tglpulang'];


$sql = "UPDATE transport_pric SET agent='".$agent."', continent='".$continent."', country='".$country."', city='".$city."', transport= '".$transport."', seat='".$seat."', rent='".$rent."', duration='".$duration."', kurs='".$kurs."', price='".$price."', tipping='".$tipping."', charge='".$charge."', tglpergi='".$tglpergi."', tglpulang='".$tglpulang."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
	echo "success";

} else {
	echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();
	



?>