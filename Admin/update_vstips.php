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

    if($value['tl'] != "" or $value['gui'] != "" or $value['dr'] != "" or $value['por'] != "" or $value['ass'] != "" or $value['res'] != ""){

        $query = "SELECT * FROM  LTVS_add_tips where tour_id='".$data['id']."' && day='".$value['hari']."'";
        $rs = mysqli_query($con, $query);
        $row = mysqli_fetch_array($rs);
        if($row['id'] ==""){
            $sql = "INSERT INTO LTVS_add_tips VALUES ('','$tgl','" . $data['id'] . "','".$value['hari']."','".$value['negara']."','".$value['kurs']."','".$value['tl']."','".$value['gui']."','".$value['ass']."','".$value['dr']."','".$value['por']."','".$value['res']."','".$data['staff']."')";
            if (mysqli_query($con, $sql)) {
               $berhasil++;
            } else {
               $gagal++;
            }
        }else{
            $sql2 = "UPDATE LTVS_add_tips SET negara='".$value['negara']."', kurs='".$value['kurs']."' , tl='".$value['tl']."',gui='".$value['gui']."',dr='".$value['dr']."',por='".$value['por']."',ass='".$value['ass']."',res='".$value['res']."', WHERE id=".$row['id'];
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
