
<?php
include "../site.php";
include "../db=connection.php";
// session_start();
$date = date("Y-m-d");

$query = "SELECT * FROM List_tempat order by id ASC";
$rs = mysqli_query($con, $query);

// var_dump($query);
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "Continent" . "\t" . "Country" . "\t". "City" . "\t". "Place Name" . "\t". "Place Name2" . "\t"."Description" . "\t". "Kurs" . "\t". "Adult" . "\t". "Child" . "\t". "Infant" . "\t";  
$setData = '';  
while ($row = mysqli_fetch_array($rs)) {
    $id = $row['id'];
    $continent = $row['continent'];
    $negara = $row['negara'];
    $city = $row['city'];
    $tempat = $row['tempat'];
    $tempat2 = $row['tempat2'];
    $keterangan = $row['keterangan'];
    $kurs = $row['kurs'];
    $adult = $row['price'];
    $chd = $row['chd'];
    $inf = $row['infant'];
    // $value = $row['id']."\t".$row['continent']."\t".$row['negara']."\t".$row['city']."\t".$row['tempat']."\t".$row['keterangan']."\t".$row['kurs']."\t".$row['price']."\t".$row['chd']."\t".$row['infant']."\t";
    $value = $id." \t".$continent." \t".$negara." \t".$city." \t".$tempat." \t".$tempat2." \t".$keterangan." \t".$kurs." \t".$adult." \t".$chd." \t".$inf." \t";
    $setData .= trim($value) . "\n";  
}
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=List_Tmpt_".$date.".xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?> 
