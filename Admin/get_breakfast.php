<?php
include "../site.php";
include "../db=connection.php";
//export.php  
// $bf ='';
// $ln = '';
// $dn = '';
// $data =[];
$datax = [];
$data = json_decode($_POST['data'], true);
$day = $_POST['day'];
$peserta = $_POST['total'];
$val_total  = 0;
for ($i = 0; $i < $day; $i++) {
      if ($data['breakfast'][$i] != null) {
            if($data['breakfast'][$i] !='0'){
                  $sql_bf = "SELECT * FROM Guest_meal WHERE id= '" . $data['breakfast'][$i] . "'";
                  $result_bf = mysqli_query($con, $sql_bf);
                  $row_bf = mysqli_fetch_assoc($result_bf);
                  $bf = $row_bf['harga_idr'];
                  $val_total = $val_total + $bf;
            }else{
                  $val_total = $val_total + 0;
            }

      }
      if ($data['lunch'][$i] != null) {
            if($data['lunch'][$i] !='0'){
                  $sql_ln = "SELECT * FROM Guest_meal WHERE id= '" . $data['lunch'][$i] . "'";
                  $result_ln = mysqli_query($con, $sql_ln);
                  $row_ln = mysqli_fetch_assoc($result_ln);
                  $ln = $row_ln['harga_idr'];
                  $val_total = $val_total + $ln;
            }else{
                  $val_total = $val_total + 0;
            }

      }
      if ($data['dinner'][$i] != null) {
            if($data['dinner'][$i] !='0'){
                  $sql_dn = "SELECT * FROM Guest_meal WHERE id= '" . $data['dinner'][$i] . "'";
                  $result_dn = mysqli_query($con, $sql_dn);
                  $row_dn = mysqli_fetch_assoc($result_dn);
                  $dn = $row_dn['harga_idr'];
                  $val_total = $val_total + $dn;
            }else{
                  $val_total = $val_total + 0;
            }

      }
}
array_push($datax, $val_total);
echo json_encode($datax);
