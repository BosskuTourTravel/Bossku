<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM city WHERE country = ".$_POST['id'];
$result = mysqli_query($con,$query);
$return_arr = array();
while($row = mysqli_fetch_array($result)){
	$id = $row['id'];
    $name = $row['name'];
    $country = $row['country'];
    $img = $row['img'];

    $return_arr[] = array("id" => $id,
                    "name" => $name,
                    "country" => $country,
                    "img" => $img);
}

echo json_encode($return_arr);
?>