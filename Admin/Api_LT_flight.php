<?php
/// live :  https://sg-api.globaltix.com/api
/// dummy : https://uat-api.globaltix.com/api

function get_fl_total($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $check_id = $datareq['check_id'];

    if ($check_id == '1') {
        // $query_plane = "SELECT * FROM LT_add_transport where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' order by hari ASC,urutan ASC";
        // $rs_plane = mysqli_query($con, $query_plane);
        $adt = 0;
        $chd = 0;
        $inf = 0;
        $data = [];
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            if ($row_plane['type'] == '1') {
                $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $row_plane['transport'];
                $rs_flight2 = mysqli_query($con, $query_flight2);
                $row_flight2 = mysqli_fetch_array($rs_flight2);


                // set profit flight
                $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $row_flight2['adt'] . "' && price2 >='" . $row_flight2['adt'] . "'";
                $rs_profit = mysqli_query($con, $sql_profit);
                $row_profit = mysqli_fetch_array($rs_profit);

                $pr = 0;
                if ($row_profit['id'] != "") {
                    $pr = $row_profit['profit'];
                } else {
                    $pr = 5;
                }
                $dm = $row_flight2['adt'] * ($row_profit['adm_mkp'] / 100);
                $mar = $row_flight2['adt'] * ($row_profit['marketing'] / 100);
                $agn = $row_flight2['adt'] * ($row_profit['sub_agent'] / 100);
                $ste = $row_profit['staff_eks'];
                $nom = $row_profit['nominal'];
                $lain2 = $adm + $mar + $agn + $ste + $nom;

                $adt_price = intval($row_flight2['adt']) * ($pr / 100);
                $chd_price = intval($row_flight2['chd']) * ($pr / 100);
                $inf_price = intval($row_flight2['inf']) * ($pr / 100);

                $adt = $adt + intval($row_flight2['adt']) +  $adt_price + $nom;
                $chd = $chd + intval($row_flight2['chd']) + $chd_price + $nom;
                $inf = $inf + intval($row_flight2['inf']) + $inf_price + $nom;

                $detail = $row_flight2['tgl'] . " | " . $row_flight2['maskapai'] . " (" . $row_flight2['dept'] . "-" . $row_flight2['arr'] . ") | " . $row_flight2['take'] . "-" . $row_flight2['landing'];
                array_push($data, $detail);
            }
        }
        return json_encode(array("adt" => $adt, "chd" => $chd, "inf" => $inf, "sgl" => $adt, "detail" => $data), true);
    }
}
