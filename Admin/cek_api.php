
<?php 
echo "cchuchchuhcuhc";
$show_kurs = exchangeRate();
$result_show_kurs = json_decode($show_kurs, true);
var_dump($result_show_kurs);
function exchangeRate()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.exchangerate.host/convert?from=USD&to=IDR&amount=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {

        return json_encode(array("status" => 0, "message" => "failed request token"));
    } else {
        $data = json_decode($response, true);
        return json_encode(array($data['result']), true);
    }
}
?>

