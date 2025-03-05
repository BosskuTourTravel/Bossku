<?php
function get_profit_flight($data)
{
    include "db=connection.php";

    $adt = $data['adt'];
    $chd = $data['chd'];
    $inf = $data['inf'];
    // set profit flight
    $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $adt . "' && price2 >='" . $adt . "'";
    $rs_profit = mysqli_query($con, $sql_profit);
    $row_profit = mysqli_fetch_array($rs_profit);

    $pr = 0;
    if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
    } else {
        $pr = 5;
    }
    $adm = $adt * ($row_profit['adm_mkp'] / 100);
    $mar = $adt * ($row_profit['marketing'] / 100);
    $agn = $adt * ($row_profit['sub_agent'] / 100);
    $ste = $row_profit['staff_eks'];
    $nom = $row_profit['nominal'];
    $lain2 = $adm + $mar + $agn + $ste + $nom;

    $adt_price = intval($adt) * ($pr / 100);
    $chd_price = intval($adt) * ($pr / 100);
    $inf_price = intval($adt) * ($pr / 100);

    $adt = $adt  +  $adt_price + $nom;
    $chd = $chd + $chd_price + $nom;
    $inf = $inf +  $inf_price + $nom;

    return json_encode(array("adt" => $adt, "chd" =>  $chd, "inf" =>  $inf, "sgl" => $adt, "detail" => ""), true);
}
