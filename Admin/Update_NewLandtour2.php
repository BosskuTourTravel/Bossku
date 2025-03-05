<?php
include "../site.php";
include "../db=connection.php";

$documents = $_POST['LinkDocs'];
$thumnail = $_POST['Thumbnail'];
$gambar = $_POST['LinkGambar'];
$country = $_POST['country'];
$continent = $_POST['continent'];
$city = $_POST['city'];
$youtube = $_POST['youtube'];
$ig = $_POST['ig'];
$tt = $_POST['tt'];
$judul = $_POST['judul'];
$price =$_POST['price'];
$kurs =$_POST['kurs'];



// $sql = "UPDATE jenisgaji SET nama_job='".$nama_job."', harga='".$harga."' WHERE id=".$id;
// if (mysqli_query($con, $sql)) {
//     echo "success";

// } else {
//     echo "Error: " . $sql . "" . mysqli_error($con);
// }


$con->close();



?>