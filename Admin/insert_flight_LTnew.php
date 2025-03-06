<?php
include "../db=connection.php";
$type = explode(",",$_POST['tipe']); 
$tc = explode(",",$_POST['tour']);

$rute = explode(",",$_POST['rute']);
$int = explode(",",$_POST['int']);
$maskapai = explode(",",$_POST['maskapai']);
$dept = explode(",",$_POST['dept']);
$arr = explode(",",$_POST['arr']);
$tgl = explode(",",$_POST['tgl']);
$take = explode(",",$_POST['take']);
$landing = explode(",",$_POST['landing']);
$adt = explode(",",$_POST['adt']);
$chd = explode(",",$_POST['chd']);
$inf = explode(",",$_POST['inf']);
$bagasi= explode(",",$_POST['bagasi']);
$bagasi_price = explode(",",$_POST['bg_price']);
$seat_price = explode(",",$_POST['st_price']);
$fl_b = explode(",",$_POST['bf']);
$fl_l = explode(",",$_POST['ln']);
$fl_d = explode(",",$_POST['dn']);
$tax = explode(",",$_POST['tax']);
$x = 0;
// foreach($tc as $val_tc){
//      echo $val_tc." - ";
// }
$berhasil =0;
$gagal = 0;
foreach($type as $val_type){

     $query_lt = "SELECT * FROM LT_itinnew where kode  LIKE '" . $tc[$x]. "'";
     $rs_lt = mysqli_query($con, $query_lt);
     $row_lt = mysqli_fetch_array($rs_lt);
     $tn = $row_lt['judul'];

     $sql = "INSERT INTO flight_LTnew VALUES ('','$val_type','".$tc[$x]."','".$tn."','".$rute[$x]."','".$int[$x]."','".$maskapai[$x]."','".$dept[$x]."','".$arr[$x]."','".$tgl[$x]."','".$take[$x]."','".$landing[$x]."','".$adt[$x]."','".$chd[$x]."','".$inf[$x]."','".$bagasi[$x]."','".$bagasi_price[$x]."','".$seat_price[$x]."','".$fl_b[$x]."','".$fl_l[$x]."','".$fl_d[$x]."','".$tax[$x]."','0')";
     //  var_dump($sql);
     if (mysqli_query($con, $sql)) {
          $berhasil++;
     } else {
          $gagal++;
     }

//     echo $val_type."-";
$x++;
}
echo "data berhasil : ".$berhasil;
echo ", data gagal : ".$gagal;
