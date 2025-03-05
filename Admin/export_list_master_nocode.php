
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
$no = 1;
while ($row = mysqli_fetch_array($rs)) {
  $query_lt = "SELECT * FROM LT_itinnew where kode='" . $row['landtour'] . "' order by twn ASC limit 1";
  $rs_lt = mysqli_query($con, $query_lt);
  $row_lt = mysqli_fetch_array($rs_lt);
  $staff = $rowStaff['name'];
  $staff = $rowStaff['name'];
  $link = "https://www.2canholiday.com/Admin/preview_all_LTnew.php?id=" . $row['id'];
  $judul = $row['judul'];
  $id = $row['id'];
  $tgl = $row['tgl'];

  if ($row['landtour'] == "undefined") {
    $code = "No Code";
    $negara = "";
    $start_pax = "1";
    $until_pax = "0";
    $bonus_pax = "0";
    $price = "0";
    $value = $no . " \t".$id . " \t" . $code . " \t" . $negara . " \t" . $judul . " \t" . $start_pax . " \t" . $until_pax . " \t" . $bonus_pax . " \t" . $price . " \t" . " " ."\t" .$link." \t" . " "." \t" .$staff."\t" . $tgl . " \t" . $expired . " \t";
    $setData .= trim($value) . "\n";
    $no++;
  }

  // $value = $row['id']."\t".$row['continent']."\t".$row['negara']."\t".$row['city']."\t".$row['tempat']."\t".$row['keterangan']."\t".$row['kurs']."\t".$row['price']."\t".$row['chd']."\t".$row['infant']."\t";

}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master-nocode-" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
