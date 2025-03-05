<?php
include "../db=connection.php";
// $berhasil = 0;
// $gagal = 0;
// $query_list = "SELECT * FROM LT_add_listTmp order by tour_id ASC";
// $rs_list = mysqli_query($con,$query_list);
// while($row_list = mysqli_fetch_array($rs_list)){

// $query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $row_list['tour_id'];
// $rs_data = mysqli_query($con, $query_data);
// $row_data = mysqli_fetch_array($rs_data);
// if($row_data['id'] ==""){
// // echo $row_list['tour_id']."</br>";
// $sql = "DELETE FROM LT_add_listTmp WHERE tour_id=".$row_list['tour_id'];
// if ($con->query($sql) === TRUE) {
//    $berhasil++;
// } else {
//    $gagal++;
// }
// }

// }
// echo $berhasil." / ".$gagal;
$query_list = "SELECT DISTINCT tour_id FROM LT_add_listTmp  where hari = '1'  order by tour_id ASC , urutan ASC";
$rs_list = mysqli_query($con, $query_list);

$ur = 0;
$tour = 0;
$hr = 0;
$x = 0;
$data = [];
$berhasil = 0;
$gagal= 0 ;
while ($row_list = mysqli_fetch_array($rs_list)) {
    $val_hari = $row_list['hari'];


    $query_list2 = "SELECT COUNT(*) as total FROM LT_add_listTmp  where tour_id ='" . $row_list['tour_id'] . "' && hari ='1' && urutan='1'";
    $rs_list2 = mysqli_query($con, $query_list2);
    $row_list2 = mysqli_fetch_array($rs_list2);
    // var_dump($query_list2);
    if ($row_list2['total'] == '2') {

        $query_list3 = "SELECT * FROM LT_add_listTmp  where tour_id ='" . $row_list['tour_id'] . "' && hari ='1'";
        $rs_list3 = mysqli_query($con, $query_list3);

        $tourx = 0;
        $hrx = 1;
        while ($row_list3 = mysqli_fetch_array($rs_list3)) {
            if ($row_list3['tour_id'] == $tourx) {
                if ($row_list3['urutan'] == '1') {
                    $hrx = 2;
                    // echo $row_list3['tour_id'] . " " . $hrx . " " . $row_list3['urutan'] . " " . $row_list3['tempat'] . "</br>";
                    $sql = "UPDATE  LT_add_listTmp SET hari='$hrx' where  id=" .$row_list3['id'];
                    if (mysqli_query($con, $sql)) {
                        $berhasil++;
                    } else {
                        $gagal++;
                    }
                } else {
                    // echo $row_list3['tour_id'] . " " . $hrx . " " . $row_list3['urutan'] . " " . $row_list3['tempat'] . "</br>";
                    $sql2 = "UPDATE  LT_add_listTmp SET hari='$hrx' where  id=" .$row_list3['id'];
                    if (mysqli_query($con, $sql2)) {
                        $berhasil++;
                    } else {
                        $gagal++;
                    }
                }
            } else {
                // echo $row_list3['tour_id'] . " " . $row_list3['hari']. " " . $row_list3['urutan'] . " " . $row_list3['tempat'] . "</br>";
                $tourx = $row_list3['tour_id'];
                $hrx = 1;
            }
        }
    }
}
$con->close();
echo $berhasil." / ".$gagal;
