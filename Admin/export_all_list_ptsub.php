
<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total.php";
session_start();
$date = date("Y-m-d h:i:sa");

$query = "SELECT * FROM  checkbox_include2 order by id ASC";
$rs = mysqli_query($con, $query);
$id_chck = 1;
// setting header
$columnHeader = '';
$columnHeader .= "No" . "\t" . "Id" . "\t" . "ITINERARY CODE" . "\t" . "COUNTRY" . "\t" . "SUBJECT" . "\t" . "START PAX" . "\t" . "UNTIL PAX" . "\t" . "BONUS PAX";
while ($row = mysqli_fetch_array($rs)) {
  $columnHeader .= "\t" . $row['nama'];
  $id_chck++;
}
// end setting header

$query_sub = "SELECT * FROM LTSUB_itin where cabang='2' order by id ASC";
$rs_sub  = mysqli_query($con, $query_sub);

$val_ltsub = [];
while ($row_sub = mysqli_fetch_array($rs_sub)) {
  $id = $row_sub['id'];
  $judul = $row_sub['judul'];
  if ($row_sub['landtour'] != "undefined") {
    $array = [];
    $code = $row_sub['code'];
    $query_hotel = "SELECT * FROM LT_select_PilihHTL WHERE master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' order by id ASC limit 1";
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

      $array['id'] = $id;
      $array['code'] = $code;
      $array['negara'] = $negara;
      $array['judul'] = $judul;
      $array['start_pax'] = $start_pax;
      $array['until_pax'] = $until_pax;
      $array['bonus_pax'] = $bonus_pax;

      $hasil_chck = [];
      for ($i = 1; $i <= $id_chck; $i++) {
        $datareq = array(
          "master_id" => $row_sub['master_id'],
          "copy_id" => $row_sub['id'],
          "check_id" => $i
        );
        $show_total = get_total($datareq);
        $result_show_total = json_decode($show_total, true);
        $array['chck' . $i] = $result_show_total['adt'];
      }
    } else {
    }
  }
  array_push($val_ltsub, $array);
}
$keys = array_column($val_ltsub, 'negara');
array_multisort($keys, SORT_ASC, $val_ltsub);

$no = 0;
foreach ($val_arr as $value) {
  $valuex = "";
  $valuex .= $no . " \t" . $value['id'] . " \t" . $value['code'] . " \t" . $value['negara'] . " \t" . $value['judul'] . " \t" . $value['start_pax'] . " \t" . $value['until_pax'] . " \t" . $value['bonus_pax'] . " \t";
 
  for ($i = 1; $i <= $id_chck; $i++) {
    $valuex .= $value['chck'.$i]." \t";
  }
  $setData .= trim($valuex) . "\n";
  $no++;
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master-all-" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
