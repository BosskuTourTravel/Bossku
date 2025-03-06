<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM Prev_makeLT order by id ASC";
$rs = mysqli_query($con, $query);

$date = date("Y-m-d");
$status = '14';
$berhasil = [];
$gagal = [];
while ($row = mysqli_fetch_array($rs)) {
    $val_data = json_decode($row['data'], true);
    $json_day = $val_data['day'];

    $g1 = $val_data['gambar'][0]['filename'];
    $g2 = $val_data['gambar'][1]['filename'];
    $g3 = $val_data['gambar'][2]['filename'];
    $g4 = $val_data['gambar'][3]['filename'];
    $judul =  $val_data['judul'];
    $hari = count($json_day);
    $landtour = $val_data['landtour_name'];
    // var_dump($query);



    $sql = "INSERT INTO LT_itinerary2 VALUES ('','$judul','$landtour','$hari','$g1','$g2','$g3','$g4','$date','$status')";
    if (mysqli_query($con, $sql)) {
        array_push($berhasil, $row['id']);

        $sql_cek = "SELECT * FROM LT_itinerary2 order by id DESC LIMIT 1";
        $rs_cek = mysqli_query($con, $sql_cek);
        $row_cek = mysqli_fetch_array($rs_cek);
        $h = 1;

        $rute_berhasil = 0;
        $rute_gagal = 0;
        $meal_berhasil = 0 ;
        $meal_gagal= 0 ;
        foreach ($json_day as $loop_day) {

            // add rute
            $rute = $loop_day['rute'];
            $sql_rute = "INSERT INTO LT_add_rute VALUES ('','$date','" . $row_cek['id'] . "','$h','$rute','$status')";
            if (mysqli_query($con, $sql_rute)) {
                $rute_berhasil++;
            } else {
                $rute_gagal++;
            }
            // add list tempat
            $urutan = 1;
            $tmp_berhasil = 0;
            $tmp_gagal = 0;
            foreach ($loop_day['sel_trans'] as $val_pilihan) {
                if ($val_pilihan['type'] == '2') {
                    $tempat = $val_pilihan['tujuan'];
                    $sql_tmp = "INSERT INTO LT_add_listTmp VALUES ('','$date','".$row_cek['id']."','$h','$urutan','$tempat','$status')";
                    if (mysqli_query($con, $sql_tmp)) {
                        $tmp_berhasil++;
                    } else {
                        $tmp_gagal++;
                    }
                }
                $urutan++;
            }

            // add meal
            $bf = $loop_day['guest_breakfast'];
            $ln = $loop_day['guest_lunch'];
            $dn = $loop_day['guest_dinner'];

            $sql_meal = "INSERT INTO LT_add_meal VALUES ('','$date','".$row_cek['id']."','$h','$bf','$ln','$dn','$status')";
            if (mysqli_query($con, $sql_meal)) {
                $meal_berhasil++;
            } else {
                $meal_gagal++;
            }
            $hotel = 0;
            if($h < $hari){
                $hotel =1;
            }
            // add Hotel
            $sql_hotel = "INSERT INTO LT_add_pilihHotel VALUES ('','$date','".$row_cek['id']."','$h','$hotel','$status')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_hotel)) {
                $hotel_berhasil++;
            } else {
                $hotel_gagal++;
            }

            $h++;
        }
    } else {
        array_push($gagal, $row['id']);
    }
}
$con->close();
?>
<div> berhasil : </div>
<div><?php var_dump($berhasil); ?></div>
<div> gagal : </div>
<div> <?php var_dump($gagal); ?></div>

