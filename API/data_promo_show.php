<?php 
include "get_api_datapromo.php";

$show_promo = get_datapromo();
$result_promo = json_decode($show_promo, true);

// contoh menampilkan hanya judul LT itinerary
foreach ($result_promo as $value){
echo "Judul : ".$value['judul']."</br>";
}
?>