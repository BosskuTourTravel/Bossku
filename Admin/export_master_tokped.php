<?php
include "../site.php";
include "../db=connection.php";
// session_start();
$date = date("Y-m-d h:i:sa");

$query = "SELECT * FROM LT_itinerary2 order by id ASC";
$rs = mysqli_query($con, $query);

// var_dump($query);
$columnHeader = '';
$columnHeader = "No"."\t"."Nama Produk" . "\t" . "Deskripsi" . "\t" . "Minimum Pemesanan" . "\t" . "NO Etalase" . "\t" . "Waktu Proses" . "\t" . "Kondisi" . "\t" . "Foto P1" . "\t" . "Fota P2" . "\t" . "Foto P3" . "\t" . "Foto P4" . "\t" . "Foto P5" . "\t" . "Vidio P1" . "\t" . "Vidio P2" . "\t" . "Vidio P3" . "\t" . "SKU Produk" . "\t" . "Status" . "\t" . "Stok" . "\t" . "Harga" . "\t"."Kurir"."\t" . "Asuransi" . "\t" . "Opsi 1" . "\t" . "Opsi 2" . "\t" . "Opsi 3" . "\t"."Berat"."\t" . "Gambar Opsi";
$setData = '';

$val_arr = [];
while ($row = mysqli_fetch_array($rs)) {
  $list_tmp = "";
  for ($i = 1; $i <= $row['hari']; $i++) {

    $query_rute = "SELECT * FROM LT_add_rute where tour_id='" . $row['id'] . "' && hari='" . $i . "'";
    $rs_rute = mysqli_query($con, $query_rute);
    $row_rute = mysqli_fetch_array($rs_rute);
    $list_tmp .= "<div style='font-size: 14px; font-weight: bold; padding-top:10px;'>Day " . $i . " - " . $row_rute['nama'] . "</div>";

    $queryTmp = "SELECT tempat FROM  LT_add_listTmp where tour_id='" . $row['id'] . "' && hari='" . $i . "' order by urutan ASC";
    $rsTmp = mysqli_query($con, $queryTmp);
    while ($rowTmp = mysqli_fetch_array($rsTmp)) {

      $query_tempat = "SELECT tempat2 FROM List_tempat where id=" . $rowTmp['tempat'];
      $rs_tempat = mysqli_query($con, $query_tempat);
      $row_tempat = mysqli_fetch_array($rs_tempat);
      if ($row_tempat['tempat2'] != "") {
        $list_tmp .= "<div style='padding-left: 10px'>";
        $list_tmp .= $row_tempat['tempat2'];
        $list_tmp .= "</div>";
      }
    }
  }
  $list_tmp .= "</br><b>INCLUDE</b>";
  $list_tmp .= "<ul><li>Acara Tour & Transportasi Sesuai Jadwal Berdasarkan Gabungan Tour</li> <li>Hotel</li><li>Meal Sesuai Jadwal</li><li>Tour Admission</li><li>Driver merangkap Guide Atau</li><li>Jasa Pendampingan Guide</li><li>Tour Leader Berbahasa Indonesia</li><li>Souvenir cantik</li></ul>";

  if ($row['landtour'] != "undefined") {
    $array = [];
    $query_lt = "SELECT * FROM LT_itinnew where kode='" . $row['landtour'] . "' order by no_urut ASC limit 1";
    $rs_lt = mysqli_query($con, $query_lt);
    $row_lt = mysqli_fetch_array($rs_lt);

    $query_lt2 = "SELECT * FROM LT_itinnew where kode='" . $row['landtour'] . "' order by no_urut ASC";
    $rs_lt2 = mysqli_query($con, $query_lt2);
    $varian = [];
    while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {

      $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_lt2['agent_twn'] . "' && price2 >='" . $row_lt2['agent_twn'] . "'";
      $rs_profit = mysqli_query($con, $sql_profit);
      $row_profit = mysqli_fetch_array($rs_profit);
      $nom = $row_profit['nominal'];

      $pr = 0;
      if ($row_profit['id'] != "") {
        $pr = $row_profit['profit'];
      } else {
        $pr = 5;
      }
      $ste = $row_profit['staff_eks'];
      $nom = $row_profit['nominal'];
      $market = $row_lt2['agent_twn'] * $row_profit['adm_mkp'] / 100;
      // $lain2 = $dm + $mar + $agn_s + $ste + $nom;

      $atwn =  ($row_lt2['agent_twn'] * $pr / 100) + $row_lt2['agent_twn'] + $nom + $market + $ste;
      $totalharga = ceil($atwn);
      if (substr($totalharga, -5) == 0) {
          $total_harga = round($totalharga, -5);
      } else if (substr($totalharga, -5) <= 50000) {
          $total_harga = round($totalharga, -5) + 50000;
      } else {
          $total_harga = round($totalharga, -5);
      }


      $pax_u = "";
      $pax_b = "";
      if ($row_lt2['pax_u'] != 0) {
        $pax_u = "-" . $row_lt2['pax_u'];
      }
      if ($row_lt2['pax_b'] != 0) {
        $pax_b = "+" . $row_lt2['pax_b'];
      }
      $pax = $row_lt2['pax'] . $pax_u." pax";
      $sku = $row_lt2['kode'] . "-" . $row_lt2['agent'] . $row_lt2['no_urut'];
     
      $paket = $row_lt2['pax'] ." pax";
      $arr_var = array(
        "paket" => $row_lt2['no_urut'],
        "Pax" => $pax,
        "sku" => $sku,
        "status" => "Aktif",
        "stok" => "100",
        "harga" => $total_harga,
        "kurir" =>"50",
        "asuransi" => "Ya",
        "op1" => $paket,
        "op2" => $pax,
        "op3" => "",
        "berat" => "100"
      );
      array_push($varian, $arr_var);
    }

    $array = array(
      "nama_produk" =>  $row['judul'],
      "deskripsi" => $list_tmp,
      "min_pesan" => 1,
      "no_etalase" => 34655567,
      "waktu_proses" => 7,
      "kondisi" => "Baru",
      "gambar_1" => "",
      "gambar_2" => "",
      "gambar_3" => "",
      "gambar_4" => "",
      "gambar_5" => "",
      "vid_1" => "",
      "vid_2" => "",
      "vid_3" => "",
      "varian" => $varian,
    );

    array_push($val_arr, $array);
  }
}

$keys = array_column($val_arr, 'negara');
array_multisort($keys, SORT_ASC, $val_arr);


$no = 1;
foreach ($val_arr as $value) {
  // var_dump($value['varian']);
  $xv = 1;
  foreach ($value['varian'] as $var) {
    // var_dump($value['varian']);
    if ($xv == 1) {
      $valuex = $no ."\t".$value['nama_produk'] . " \t" . $value['deskripsi'] . " \t" . $value['min_pesan'] . " \t" . $value['no_etalase'] . " \t" . $value['waktu_proses'] . " \t" . $value['kondisi'] . " \t" . $value['gambar_1'] . " \t" . $value['gambar_2'] . " \t" . $value['gambar_3'] . "\t" . $value['gambar_4'] . "\t" . $value['gambar_5'] . " \t" . $value['vid_1'] . "\t" . $value['vid_2'] . " \t" . $value['vid_3'] . " \t" . $var['sku'] . "\t" . $var['status'] . "\t" . $var['stok'] . "\t" . $var['harga'] . "\t" .$var['kurir'] . " \t" . $var['asuransi'] . " \t" . $var['op1'] . " \t" . $var['op2'] . " \t" . $var['op3'] . " \t" . $var['berat'] . " \t";
      $setData .= trim($valuex) . "\n";
    } else {
      $valuex = $no ."\t"." " . " \t" . " " . " \t" . " " . " \t" . " " . " \t" . " " . " \t" . " " . " \t" . " " . " \t" ." " . " \t" . " " . "\t" . " " . "\t" . " " . " \t" . " " . "\t" . " " . " \t" . " " . " \t" . $var['sku'] . "\t" . $var['status'] . "\t" . $var['stok'] . "\t" . $var['harga'] ."\t" .$var['kurir']. "\t"  . $var['asuransi'] . " \t" . $var['op1'] . " \t" . $var['op2'] . " \t" . $var['op3'] . " \t" . $var['berat'] . " \t";
      $setData .= trim($valuex) . "\n";
     
    }
    $xv++;
  }
  // $valuex = $value['nama_produk'] . " \t" . $value['deskripsi'] . " \t" . $value['min_pesan'] . " \t" . $value['no_etalase'] . " \t" . $value['waktu_proses'] . " \t" . $value['kondisi'] . " \t" . $value['gambar_1'] . " \t" . $value['gambar_2'] . " \t" . $value['gambar_3'] . "\t" . $value['gambar_4'] . "\t" . $value['gambar_5'] . " \t" . $value['vid_1'] . "\t" . $value['vid_2'] . " \t" . $value['vid_3'] . " \t" . $value['sku'] . "\t" . $value['status'] . "\t" . $value['stok'] . "\t" . $value['harga'] . "\t" . $value['kurir'] . "\t" . $value['asuransi'] . " \t" . " " . " \t" . " " . " \t" . " " . " \t" . " " . " \t";
  // $setData .= trim($valuex) . "\n";
   $no++;
}




header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Master-" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
