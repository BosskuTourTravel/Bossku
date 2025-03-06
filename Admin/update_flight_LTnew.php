<?php
include "../db=connection.php";
$type = explode(",",$_POST['tipe']); 
$tc = explode(",",$_POST['tour']);
$id = explode(",",$_POST['id']);
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
$berhasil = 0;
$gagal = 0;
foreach($id as $val_id){

     $query_lt = "SELECT * FROM LT_itinnew where kode  LIKE '" . $tc[$x]. "'";
     $rs_lt = mysqli_query($con, $query_lt);
     $row_lt = mysqli_fetch_array($rs_lt);
     $tn = $row_lt['judul'];

     $sql = "UPDATE  flight_LTnew SET type='".$type[$x]."', tour_code='".$tc[$x]."',tour_name='".$tn."',rute='".$rute[$x]."',inter='".$int[$x]."',maskapai='".$maskapai[$x]."',dept='".$dept[$x]."',arr='".$arr[$x]."',tgl='".$tgl[$x]."',take='".$take[$x]."',landing='".$landing[$x]."', adt='".$adt[$x]."',chd='".$chd[$x]."',inf='".$inf[$x]."',bagasi='".$bagasi[$x]."',bagasi_price='".$bagasi_price[$x]."',seat_price='".$seat_price[$x]."',bf='".$fl_b[$x]."',ln='".$fl_l[$x]."',dn='".$fl_d[$x]."',tax='".$tax[$x]."' where  id=".$val_id;
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
