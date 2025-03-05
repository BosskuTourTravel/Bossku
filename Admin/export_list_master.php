
<?php
include "../site.php";
include "../db=connection.php";
// session_start();
$date = date("Y-m-d h:i:sa");

$query = "SELECT * FROM LT_itinerary2 order by id ASC";
$rs = mysqli_query($con, $query);

// var_dump($query);
$columnHeader = '';
$columnHeader = "No"."\t"."Id" . "\t" . "ITINERARY CODE" . "\t" . "COUNTRY" . "\t" . "SUBJECT" . "\t" . "START PAX" . "\t" . "UNTIL PAX" . "\t" . "BONUS PAX" . "\t" . "PRICE" ."\t"."LINK FLYER MASTER ITINERARY". "\t" . "LINK ITIN MASTER ITINERARY" . "\t" ."FLYER MAKER"."\t"."ITIN MAKER" . "\t" . "DATE OF MAKE ITIN" . "\t"."EXPIRED PERIOD";
$setData = '';

$val_arr = [];
while ($row = mysqli_fetch_array($rs)) {

  if ($row['landtour'] != "undefined") {
    $array = [];
    $query_lt = "SELECT * FROM LT_itinnew where kode='" . $row['landtour'] . "' order by twn ASC limit 1";
    $rs_lt = mysqli_query($con, $query_lt);
    $row_lt = mysqli_fetch_array($rs_lt);
    $staff = $rowStaff['name'];
    $staff = $rowStaff['name'];
    $link = "https://www.2canholiday.com/Admin/preview_all_LTnew.php?id=" . $row['id'];
    $judul = $row['judul'];
    $id = $row['id'];
    $tgl = $row['tgl'];

    $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['status'];
    $rsStaff = mysqli_query($con, $queryStaff);
    $rowStaff = mysqli_fetch_array($rsStaff);
    $code = $row_lt['kode'];
    $negara = $row_lt['negara'];
    $start_pax = $row_lt['pax'];
    $until_pax = $row_lt['pax_u'];
    $bonus_pax = $row_lt['pax_b'];
    $price = $row_lt['agent_twn'];
    $expired = $row_lt['expired'];

    $array['id'] = $id ;
    $array['code'] = $code;
    $array['negara'] = $negara;
    $array['judul'] = $judul ;
    $array['start_pax'] = $start_pax ;
    $array['until_pax'] = $until_pax ;
    $array['bonus_pax'] = $bonus_pax ; 
    $array['price'] = $price ;
    $array['link'] = '';
    $array['link_itin'] = $link;
    $array['flayer_maker'] = $staff;
    $array['tgl'] = $tgl;
    $array['exp'] = $expired;
    array_push($val_arr, $array);
  }
}

$keys = array_column($val_arr, 'negara');
array_multisort($keys, SORT_ASC, $val_arr);

$no = 1;
foreach($val_arr as $value){
$valuex = $no . " \t".$value['id'] . " \t" . $value['code'] . " \t" . $value['negara'] . " \t" . $value['judul'] . " \t" . $value['start_pax'] . " \t" . $value['until_pax'] . " \t" . $value['bonus_pax'] . " \t" . $value['price'] . " \t" . " " ."\t".$value['link_itin']."\t" . " "." \t" .$value['flayer_maker']."\t" . $value['tgl'] . " \t" . $value['exp'] . " \t";
$setData .= trim($valuex) . "\n";
$no++;
}




header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master-" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
