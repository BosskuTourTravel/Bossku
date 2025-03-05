<?php
include "../site.php";
include "../db=connection.php";
session_start();
// bentuk array
$data = $_POST['data'];
$tgl = date("Y-m-d");
$berhasil = 0;
$gagal = 0;
$update = 0;
foreach ($data['day'] as $value) {

    if($value['bf'] != "" or $value['ln'] != "" or $value['dn'] != ""){

        $query = "SELECT * FROM  LTVS_add_meal where tour_id='".$data['id']."' && day='".$value['hari']."'";
        $rs = mysqli_query($con, $query);
        $row = mysqli_fetch_array($rs);
        if($row['id'] ==""){
            $sql = "INSERT INTO LTVS_add_meal VALUES ('','$tgl','" . $data['id'] . "','".$value['hari']."','','".$value['bf']."','".$value['ln']."','".$value['dn']."','".$data['staff']."')";
            if (mysqli_query($con, $sql)) {
               $berhasil++;
            } else {
               $gagal++;
            }
        }else{
            $sql2 = "UPDATE LTVS_add_meal SET  bf='".$value['bf']."' , ln='".$value['ln']."', dn='".$value['dn']."' WHERE id=".$row['id'];
            if (mysqli_query($con, $sql2)) {
               $update++;
            } else {
               $gagal++;
            }
        }
    
    }
}
echo "Data Insert : ".$berhasil." , Data Update : ".$update." , Data Gagal : ".$gagal;
$con->close();
