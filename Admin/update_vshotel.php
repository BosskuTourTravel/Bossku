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

    if($value['hotel_name'] != "" or $value['hotel_twin'] != "" or $value['hotel_triple'] != "" or $value['hotel_family'] != ""){

        $query = "SELECT * FROM  LTVS_add_hotel where tour_id='".$data['id']."' && day='".$value['hari']."'";
        $rs = mysqli_query($con, $query);
        $row = mysqli_fetch_array($rs);
        if($row['id'] ==""){
            $sql = "INSERT INTO LTVS_add_hotel VALUES ('','$tgl','" . $data['id'] . "','".$value['hari']."','".$value['hotel_name']."','".$value['hotel_twin']."','".$value['hotel_triple']."','".$value['hotel_family']."','".$data['staff']."')";
            if (mysqli_query($con, $sql)) {
               $berhasil++;
            } else {
               $gagal++;
            }
        }else{
            $sql2 = "UPDATE LTVS_add_hotel SET hotel_name='".$value['hotel_name']."', hotel_twin='".$value['hotel_twin']."' , hotel_triple='".$value['hotel_triple']."',hotel_family='".$value['hotel_family']."' WHERE id=".$row['id'];
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
