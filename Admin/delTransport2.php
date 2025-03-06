<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$city = $_POST['city'];
$periode = $_POST['periode'];
$kurs = $_POST['kurs'];
var_dump($agent);
var_dump($continent);
var_dump($country);
var_dump($city);
var_dump($periode);
var_dump($kurs);

$sql = "DELETE FROM transport WHERE agent=".$agent." AND continent=".$continent." AND contry=".$country." AND city=".$city." AND periode=".$periode." AND kurs=".$kurs;

if ($con->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$con->close();


?>