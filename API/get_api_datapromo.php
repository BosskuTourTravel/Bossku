<?php 
function get_datapromo()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.2canholiday.com/API/Data_promo.php");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    if (false !== $output) {
        return $output;
    }
}
?>