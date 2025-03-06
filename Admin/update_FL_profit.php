<?php
include "../db=connection.php";
$id = explode(",",$_POST['id']); 
$start= explode(",",$_POST['start']);
$until = explode(",",$_POST['until']);
$profit = explode(",",$_POST['profit']);
$admin = explode(",",$_POST['admin']);
$marketing = explode(",",$_POST['marketing']);
$sub_agent = explode(",",$_POST['sub_agent']);
$staff = explode(",",$_POST['staff']);
$nominal = explode(",",$_POST['nominal']);

$x = 0;
$berhasil = 0;
$gagal = 0;
foreach($id as $val_id){

     $sql = "UPDATE  LT_profit_range SET price1='".$start[$x]."', price2='".$until[$x]."', profit='".$profit[$x]."', adm_mkp='".$admin[$x]."',marketing='".$marketing[$x]."', sub_agent='".$sub_agent[$x]."',staff_eks='".$staff[$x]."', nominal='".$nominal[$x]."'  where  id=".$val_id;
     if (mysqli_query($con, $sql)) {
          $berhasil++;
     } else {
          $gagal++;
     }
$x++;
}
$con->close();
echo "data berhasil : ".$berhasil;
echo ", data gagal : ".$gagal;
