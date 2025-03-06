<?php

	// include kurs.php
	// require("Api_Kurs_online.php");
	// $data = array(
    //     "nominal" => 0,
    //     "code" => "USD",
    // );
    // $show_visa = get_kurs_bca($data);
    // $result_visa = json_decode($show_visa, true);
    // var_dump($result_visa);
    for($x = 1; $x <= 2; $x++){
        $datareq = array(
            "kurs" => "USD",
            "nominal" => 1,
        );
        $show_kurs = get_kurs($datareq);
        $result_show_kurs = json_decode($show_kurs, true);
        var_dump($result_show_kurs['data']);
    //     echo $x;
    }


    function get_kurs($datareq)
    {
        require("Api_Kurs_online.php");
        $kurs = $datareq['kurs'];
        $nominal = $datareq['nominal'];
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "data" => $nominal), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                $data = array(
                    "nominal" => $nominal,
                    "code" => $kurs,
                );
                $show_data = get_kurs_bca($data);
                $result_data = json_decode($show_data, true);
                return json_encode(array("status" => $result_data['status'], "data" => $result_data['price']), true);
            }
        }
    }

    

?>