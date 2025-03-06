<?php 
include "../db=connection.php";
include "Api_paket_tour.php";
session_start();

$query2 = "SELECT MP_tokopedia.id,MP_tokopedia.tgl,MP_tokopedia.nama,login_staff.name as staff FROM MP_tokopedia LEFT JOIN login_staff ON MP_tokopedia.staff=login_staff.id where MP_tokopedia.id='".$_GET['id']."'";
$rs2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($rs2);

$columnHeader = '';
$columnHeader = "no" . "\t" . "Nama Produk" . "\t" . "Deskripsi" . "\t" . "Min Pesan" . "\t" . "Etalase" . "\t" . "Pre Order" . "\t" . "Kondisi" . "\t" . "img 1" . "\t" . "img 2" . "\t" . "img 3" . "\t" . "img 4" . "\t" . "img 5" . "\t". "Spek". "\t"."SKU". "\t"."Status". "\t"."Stok". "\t"."Harga". "\t"."Kurir". "\t"."Asuransi". "\t"."Kemasan 1"."\t"."Kemasan 2"."\t"."Warna"."\t"."Berat"."\t"."Gambar";
$setData = '';
$err = "";

$query = "SELECT * FROM Upload_tokopedia where mp_id='" . $_GET['id'] . "' ORDER BY id ASC limit 300";
$rs = mysqli_query($con, $query);
$no = 1;
$sfee_id = 0;
while ($row = mysqli_fetch_array($rs)) {
    if($sfee_id ==  $row['sfee_id']){
        $valuex = $no. "\t" . $row['produk_name'] . "\t" . $err . "\t" .  $err . "\t" .  $err . "\t" .  $err . "\t" . $err . "\t" . $row['img1'] . "\t" . $row['img2'] . "\t" . $row['img3'] . "\t" . $row['img4'] . "\t" . $row['img5']. "\t". $err . "\t" . $row['sku']. "\t".$row['status'] . "\t".$row['stok']."\t".$row['Harga']."\t".$row['kurir']."\t".$row['asuransi']."\t".$err."\t".$err."\t".$row['varian']."\t".$row['berat'];
        $setData .= trim($valuex) . "\n";
    }else{
        $valuex = $no. "\t" . $row['produk_name'] . "\t" . $row['deskripsi'] . "\t" . $row['min_pembelian'] . "\t" . $row['etalase'] . " \t" . $row['preorder'] . "\t" . $row['kondisi'] . "\t" . $row['img1'] . "\t" . $row['img2'] . "\t" . $row['img3'] . "\t" . $row['img4'] . "\t" . $row['img5']. "\t".$err. "\t" . $row['sku']. "\t".$row['status'] . "\t".$row['stok']."\t".$row['Harga']."\t".$row['kurir']."\t".$row['asuransi']."\t".$err."\t".$err."\t".$row['varian']."\t".$row['berat'];
        $setData .= trim($valuex) . "\n";
        $sfee_id = $row['sfee_id'];
    }
    $no++;
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PT-" . $row2['nama'] . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?>