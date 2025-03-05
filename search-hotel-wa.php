<?php 
function get_country($datareq)
{
    $type = $datareq['type'];
    $token = $datareq['token'];
    $aut = $type . " " . $token;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://project-partner-api-test.up.railway.app/location/search?query=',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "Accept-Version: 1.0",
            "Authorization: $aut"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return json_encode(array("status" => 0, "message" => "failed request token"));
    } else {
        $data = json_decode($response, true);
        return json_encode(array("status" => 1, "success" => $data['success'], "data" => $data['data']), true);
    }
}
?>