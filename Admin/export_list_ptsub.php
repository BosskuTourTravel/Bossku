
<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total.php";
session_start();
$date = date("Y-m-d h:i:sa");

$query = "SELECT * FROM LTSUB_itin where cabang ='2' order by id ASC";
$rs = mysqli_query($con, $query);

// var_dump($query);
$columnHeader = '';
$columnHeader = "No" . "\t" . "Id" . "\t" . "ITINERARY CODE" . "\t" . "COUNTRY" . "\t" . "SUBJECT" . "\t" . "START PAX" . "\t" . "UNTIL PAX" . "\t" . "BONUS PAX" . "\t" . "LT PRICE" . "\t" . "HOTEL" . "\t" . "FLIGHT" . "\t" . "FERRY" . "\t" . "TRAIN" . "\t" . "VISA" . "\t" . "ITIN MAKER" . "\t" . "DATE OF MAKE ITIN" . "\t" . "EXPIRED PERIOD";
$setData = '';

$val_arr = [];
while ($row = mysqli_fetch_array($rs)) {
  if ($row['landtour'] != "undefined") {

    $query_plane = "SELECT * FROM LT_add_transport where master_id='" . $row['master_id'] . "' && copy_id='" . $row['id'] . "'  order by hari ASC,urutan ASC";
    $rs_plane = mysqli_query($con, $query_plane);
    $plane = "";
    $ferry = "";
    $train = "";

    // transport
    while ($row_plane = mysqli_fetch_array($rs_plane)) {
      if ($row_plane['type'] == '1') {
        $query_flight2 = "SELECT * FROM flight_LTnew  where id=" . $row_plane['transport'];
        $rs_flight2 = mysqli_query($con, $query_flight2);
        $row_flight2 = mysqli_fetch_array($rs_flight2);
        $detail = $row_flight2['tgl'] . " | " . $row_flight2['maskapai'] . " (" . $row_flight2['dept'] . "-" . $row_flight2['arr'] . ")";
        $plane .= $detail . " / ";
      } else if ($row_plane['type'] == '2') {
        $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row_plane['transport'];
        $rs_ferry = mysqli_query($con, $query_ferry);
        $row_ferry = mysqli_fetch_array($rs_ferry);
        $ket = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
        $ferry .= $ket . " / ";
      } else if ($row_plane == '4') {
        $query_tr = "SELECT * FROM train_LTnew  where id=" . $row_plane['transport'];
        $rs_tr = mysqli_query($con, $query_tr);
        $row_tr = mysqli_fetch_array($rs_tr);
        $ket = $row_tr['nama'];
        $train .= $ket . " / ";
      } else {
      }
    }
    // end transport
    // hotel  
    $query_hotel2 = "SELECT * FROM LT_select_PilihHTL WHERE master_id='" . $row['master_id'] . "' && copy_id='" . $row['id'] . "' order by id ASC";
    $rs_hotel2 = mysqli_query($con, $query_hotel2);
    $hotel = "";

    while ($row_hotel2 = mysqli_fetch_array($rs_hotel2)) {

      $query_lt2 = "SELECT * FROM LT_itinnew where id='" . $row_hotel2['hotel_id'] . "'";
      $rs_lt2 = mysqli_query($con, $query_lt2);
      $row_lt2 = mysqli_fetch_array($rs_lt2);
      $index = "hotel" . $row_hotel2['no_htl'];

      $val_hotel = $row_lt2[$index];
      $hotel .= $val_hotel . "/";
    }
    // end of hotel

    // pilih lt
    $negara = "";
    $start_pax = "";
    $until_pax = "";
    $bonus_pax = "";
    $price = "";
    $expired = "";
    $visa = "";
    $query_hotel = "SELECT * FROM LT_select_PilihHTL WHERE master_id='" . $row['master_id'] . "' && copy_id='" . $row['id'] . "' order by id ASC limit 1";
    $rs_hotel = mysqli_query($con, $query_hotel);
    $row_hotel = mysqli_fetch_array($rs_hotel);
    if ($row_hotel['id'] != "") {
      $query_lt = "SELECT * FROM LT_itinnew where id='" . $row_hotel['hotel_id'] . "'";
      $rs_lt = mysqli_query($con, $query_lt);
      $row_lt = mysqli_fetch_array($rs_lt);

      $negara = $row_lt['negara'];
      $start_pax = $row_lt['pax'];
      $until_pax = $row_lt['pax_u'];
      $bonus_pax = $row_lt['pax_b'];
      $price = $row_lt['agent_twn'];
      $expired = $row_lt['expired'];

      $data_visa = array(
        "master_id" => $row['master_id'],
        "copy_id" => $row['id'],
        "check_id" => '8'
      );
      $show_visa = get_total($data_visa);
      $result_visa = json_decode($show_visa, true);
      foreach ($result_visa['detail'] as $detail) {
        $visa .= " " . $detail;
      }
    }
    // end visa
    $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['status'];
    $rsStaff = mysqli_query($con, $queryStaff);
    $rowStaff = mysqli_fetch_array($rsStaff);

    $staff = $rowStaff['name'];
    $link = "";
    $judul = $row['judul'];
    $id = $row['id'];
    $tgl = $row['tgl'];
    $code = $row['landtour'];



    $arr = array(
      "id" => $id,
      "code" => $code,
      "negara" => $negara,
      "judul" => $judul,
      "start_pax" => $start_pax,
      "until_pax" => $until_pax,
      "bonus_pax" => $bonus_pax,
      "price" => $price,
      "hotel" => $hotel,
      "plane" => $plane,
      "ferry" => $ferry,
      "train" => $train,
      "visa" => $visa,
      "staff" => $staff,
      "tgl" => $tgl,
      "exp" => $expired
    );
    array_push($val_arr, $arr);
  }
}
$no = 1;
$keys = array_column($val_arr, 'negara');
array_multisort($keys, SORT_ASC, $val_arr);
foreach ($val_arr as $value) {
  $valuex = $no . " \t" . $value['id'] . " \t" . $value['code'] . " \t" . $value['negara'] . " \t" . $value['judul'] . " \t" . $value['start_pax'] . " \t" . $value['until_pax'] . " \t" . $value['bonus_pax'] . " \t" . $value['price'] . " \t" . $value['hotel'] . "\t" . $value['plane'] . " \t" . $value['ferry']. " \t" . $value['train'] . " \t" . $value['visa'] . " \t" . $value['staff'] . "\t" . $value['tgl'] . " \t" . $value['exp']. " \t";
  $setData .= trim($valuex) . "\n";
  $no++;
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PT-SUB-" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
