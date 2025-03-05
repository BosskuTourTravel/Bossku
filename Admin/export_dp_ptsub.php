
<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total.php";
session_start();
$date = date("Y-m-d h:i:sa");
// var_dump($query);
$columnHeader = '';
$columnHeader = "No" . "\t" . "Copy Id"."\t" . "Master Id"  . "\t" . "ITINERARY CODE" . "\t" . "COUNTRY" . "\t" . "SUBJECT" . "\t" . "START PAX" . "\t" . "UNTIL PAX" . "\t" . "BONUS PAX" . "\t" . "LT PRICE" . "\t" . "HOTEL" . "\t" . "FLIGHT" . "\t" . "FERRY" . "\t" . "TRAIN" . "\t" . "VISA" . "\t" . "ITIN MAKER" . "\t" . "DATE OF MAKE ITIN" . "\t" . "EXPIRED PERIOD";
$setData = '';

$query_data = "SELECT * FROM  DP_ptsub where cabang='2' order by id ASC";
$rs_data = mysqli_query($con, $query_data);
$data_arr = [];
while ($row_data = mysqli_fetch_array($rs_data)) {
    $arr = [];
    $arr_chck = json_decode($row_data['chck'], true);

    $total_twn = 0;
    $total_sgl = 0;
    $total_inf = 0;
    $total_chd  = 0;

    foreach ($arr_chck as $check) {

        $query_tps = "SELECT * FROM  checkbox_include2 where id=" . $check;
        $rs_tps = mysqli_query($con, $query_tps);
        $row_tps = mysqli_fetch_array($rs_tps);

        if ($row_tps['id'] != '15') {
            $data_tps = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $row_data['copy_id'],
                "check_id" => $row_tps['id']
            );

            $show_tps = get_total($data_tps);
            $result_tps = json_decode($show_tps, true);

            $total_twn = $total_twn + $result_tps['adt'];
            $total_sgl = $total_sgl + $result_tps['sgl'];
            $total_chd = $total_chd + $result_tps['chd'];
            $total_inf = $total_inf + $result_tps['inf'];
        }
    }




    $query = "SELECT * FROM  LT_itinerary2 where id=" . $row_data['master_id'];
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    $tgl = $row['tgl'];


    $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['status'];
    $rsStaff = mysqli_query($con, $queryStaff);
    $rowStaff = mysqli_fetch_array($rsStaff);
    $staff = $rowStaff['name'];

    $queryStaff2 = "SELECT * FROM  login_staff WHERE id=" . $row_data['status'];
    $rsStaff2 = mysqli_query($con, $queryStaff2);
    $rowStaff2 = mysqli_fetch_array($rsStaff2);
    $staff2 = $rowStaff2['name'];

    $query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $row_data['copy_id'];
    $rs_sub = mysqli_query($con, $query_sub);
    $row_sub = mysqli_fetch_array($rs_sub);

    $query_plane = "SELECT * FROM LT_add_transport where master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['id'] . "'  order by hari ASC,urutan ASC";
    $rs_plane = mysqli_query($con, $query_plane);
    $plane = 0;
    $ferry = 0;
    $train = 0;
    while ($row_plane = mysqli_fetch_array($rs_plane)) {
      if ($row_plane['type'] == '1') {
        $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $row_plane['transport'];
        $rs_flight2 = mysqli_query($con, $query_flight2);
        $row_flight2 = mysqli_fetch_array($rs_flight2);

        $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $row_flight2['adt'] . "' && price2 >='". $row_flight2['adt']."'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);
        // var_dump($sql_profit);

        $pr = 0;
        if ($row_profit['id'] != "") {
            $pr = $row_profit['profit'];
        }else{
            $pr = 5;
        }

        $adt_price = intval($row_flight2['adt']) * ($pr / 100);
        $plane = $plane + intval($row_flight2['adt']) +  $adt_price;

      } else if ($row_plane['type'] == '2') {
        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row_plane['transport'];
        $rs_ferry = mysqli_query($con, $query_ferry);
        $row_ferry = mysqli_fetch_array($rs_ferry);

        $ferry = $ferry + intval($row_ferry['adult']);

      } else if ($row_plane == '4') {
        $query_tr = "SELECT * FROM train_LTnew  where id=" . $row_plane['transport'];
        $rs_tr = mysqli_query($con, $query_tr);
        $row_tr = mysqli_fetch_array($rs_tr);
        $train = $train + intval($row_tr['adt']);
      } else {
      }
    }
    

    if ($row_sub['landtour'] != "undefined") {


        $query_hotel = "SELECT * FROM LT_select_PilihHTL WHERE master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['copy_id'] . "' order by id ASC limit 1";
        $rs_hotel = mysqli_query($con, $query_hotel);
        $row_hotel = mysqli_fetch_array($rs_hotel);

        $query_itin = "SELECT * FROM LT_itinnew WHERE id=" . $row_hotel['hotel_id'];
        $rs_itin = mysqli_query($con, $query_itin);
        $row_itin = mysqli_fetch_array($rs_itin);
        $exp = $row_itin['expired'];

        if ($row_itin['id'] != "") {
            $data_hotel = array(
                "master_id" => $row_data['master_id'],
                "copy_id" => $row_data['copy_id'],
                "check_id" => '15'
            );

            $show_hotel = get_total($data_hotel);
            $result_hotel = json_decode($show_hotel, true);

            $grand_twn = $total_twn +  $result_hotel['adt'] + $row_data['l_twn'];
            $grand_sgl = $total_sgl +  $result_hotel['sgl'] + $row_data['l_sgl'];
            $grand_cnb = $total_chd +  $result_hotel['chd'] + $row_data['l_cnb'];
            $grand_inf = $total_inf +  $result_hotel['inf'] + $row_data['l_inf'];

            $arr['code'] = $row_itin['kode'];
            $arr['negara'] = $row_itin['negara'];
            $arr['judul'] = $row_itin['judul'];
            $arr['start_pax'] = $row_itin['pax'];
            $arr['until_pax'] = $row_itin['pax_u'];
            $arr['bonus_pax'] = $row_itin['pax_b'];
            $arr['price'] = $grand_twn;

        }
    } else {
        $query_nc_hotel = "SELECT * FROM  LT_select_PilihHTLNC  where copy_id = '" . $row_data['copy_id'] . "' && master_id='" . $row_data['master_id'] . "' order by hari ASC";
        $rs_nc_hotel = mysqli_query($con, $query_nc_hotel);
        $ht_twin = 0;
        while ($row_nc_hotel = mysqli_fetch_array($rs_nc_hotel)) {
            $ht_twin = $ht_twin + $row_nc_hote['hotel_twin'];
        }

        $grand_twn = $total_twn + $ht_twin + $row_data['l_twn'];
        $grand_sgl = $total_sgl + $ht_twin + $row_data['l_sgl'];
        $grand_cnb = $total_chd + 0 + $row_data['l_cnb'];
        $grand_inf = $total_inf + 0 + $row_data['l_inf'];

        $arr['code'] = "No Code";
        $arr['negara'] = "";
        $arr['judul'] = $row_sub['judul'];
        $arr['start_pax'] = '';
        $arr['until_pax'] = '';
        $arr['bonus_pax'] ='';
        $arr['price'] = $grand_twn;
    }
    $arr['id'] = $row_data['id'];
    $arr['copy_id'] = $row_data['copy_id'];
    $arr['master_id'] = $row_data['master_id'];
    $arr['link'] = '';
    $arr['link_itin'] = $link;
    $arr['flayer_maker'] = $staff;
    $arr['tgl'] = $tgl;
    $arr['exp'] = $expired;
    $arr['sc'] = $staff2;
    $arr['c_twn'] = $row_data['c_twn'];
    $arr['l_twn'] = $row_data['l_twn'];

    array_push($data_arr, $arr);

}
$keys = array_column($data_arr, 'negara');
array_multisort($keys, SORT_ASC, $data_arr);
foreach ($data_arr as $value) {
  $valuex = $no . " \t" . $value['copy_id']. " \t" . $value['master_id']  ." \t" . $value['code'] . " \t" . $value['negara'] . " \t" . $value['judul'] . " \t" . $value['start_pax'] . " \t" . $value['until_pax'] . " \t" . $value['bonus_pax'] . " \t" . $value['price'] . " \t" . $value['hotel'] . "\t" . $value['plane'] . " \t" . $value['ferry']. " \t" . $value['train'] . " \t" . $value['visa'] . " \t" . $value['staff'] . "\t" . $value['tgl'] . " \t" . $value['exp']. " \t";
  $setData .= trim($valuex) . "\n";
  $no++;
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PT-SUB-PRC-" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
