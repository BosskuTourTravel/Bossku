<?php
include "../db=connection.php";
$type = $_POST['tipe']; 
$route_id = $_POST['route_id'];
$rute = $_POST['rute'];
// $int = explode(",",$_POST['int']);
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
$transit = 0;
$f_awal = 0;
$berhasil =0;
$gagal = 0;
// $trans_time = 0;
$val_cekid = 0;
$query_cek = "SELECT id_grub FROM LTP_route_detail order by id_grub DESC limit 1";
$rs_cek = mysqli_query($con,$query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
if($row_cek['id_grub'] !=""){
     $val_cekid = $row_cek['id_grub'] +1;
}

foreach($maskapai as $val_mas){
$f_awal = strtotime($take[$x]);
if($x==0){
$transit = 0;
}else{
 $transit = $f_awal - $f_akhir;
}
$jam = floor($transit / 60 );

     $sql = "INSERT INTO LTP_route_detail VALUES ('','".$route_id."','".$type."','".$rute."','".$val_cekid."','".$val_mas."','".$dept[$x]."','".$arr[$x]."','".$tgl[$x]."','".$take[$x]."','".$landing[$x]."','".$jam."','".$adt[$x]."','".$chd[$x]."','".$inf[$x]."','".$bagasi[$x]."','".$bagasi_price[$x]."','".$seat_price[$x]."','".$fl_b[$x]."','".$fl_l[$x]."','".$fl_d[$x]."','".$tax[$x]."','0')";
     //  var_dump($sql);
     if (mysqli_query($con, $sql)) {
          $berhasil++;
     } else {
          $gagal++;
     }
$f_akhir =strtotime($landing[$x]);
$x++;
// echo $val_rute;
}
echo "data berhasil : ".$berhasil;
echo ", data gagal : ".$gagal;
