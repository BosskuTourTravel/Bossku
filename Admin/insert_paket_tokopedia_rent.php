
<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
session_start();
// $id = "835-953-19";
$id = $_POST['paket'];
$mp_id = $_POST['id'];
if ($id != "") {
    $date = date("Y-m-d");
    $staff =  $_SESSION['staff_id'];

    $query_u = "SELECT * FROM Upload_tokopedia_rent where trans_id='" . $id . "' && mp_id='".$mp_id."'";
    $rs_u = mysqli_query($con, $query_u);
    $row_u = mysqli_fetch_array($rs_u);

    $berhasil = 0;
    $gagal = 0;

    if ($row_u['id'] == "") {

        $query_trans = "SELECT * FROM Transport_new where id='" . $id . "'";
        $rs_trans = mysqli_query($con, $query_trans);
        $row_trans = mysqli_fetch_array($rs_trans);

        $judul = $row_trans['trans_type'] . " (" . $row_trans['seat'] . " Seat) " . $row_trans['company'] . " " . $row_trans['periode'] . " IN " . $row_trans['city'] . " " .$row_trans['country'];

        $detail = "Harga untuk Mobil,Driver,BBM, Toll, Parkir";
        $agn_code = str_pad($row_trans['agent'], 4, '0', STR_PAD_LEFT);
        $code = str_pad($row_trans['id'], 5, '0', STR_PAD_LEFT);
        $img = $row_trans['img'];

        if ($row_trans['oneway'] != '0') {
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['oneway'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];
            $sku = "RTOW-".$agn_code.$code;

            $sql_oneway = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','One Way')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_oneway)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['twoway'] != '0') {
            $sku = "RTTW-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['twoway'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_twoway = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Two Way')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_twoway)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['hd1'] != '0') {
            $sku = "RTHD1-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['hd1'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_hd1 = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Half Day 1')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_hd1)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['hd2'] != '0') {
            $sku = "RTHD2-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['hd2'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_hd2 = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Half Day 2')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_hd2)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['fd1'] != '0') {
            $sku = "RTFD1-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['fd1'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_fd1 = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Full Day 1')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_fd1)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['fd2'] != '0') {
            $sku = "RTFD2-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['fd2'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_fd2 = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Full Day 2')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_fd2)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['kaisoda'] != '0') {
            $sku = "RTK-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['kaisoda'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_kaisoda = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Kaisoda')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_kaisoda)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        if ($row_trans['luarkota'] != '0') {
            $sku = "RTLK-".$agn_code.$code;
            $datareq = array(
                "kurs" =>  $row_trans['kurs'],
                "nominal" =>$row_trans['luarkota'],
            );
            $show_kurs = get_kurs($datareq);
            $result_show_kurs = json_decode($show_kurs, true);
            $harga = $result_show_kurs['data'];

            $sql_lk = "INSERT INTO Upload_tokopedia_rent VALUES ('','" . $mp_id . "','" . $row_trans['agent'] . "','" . $row_trans['id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Luar Kota')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_lk)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
        echo "Berhasil : " . $berhasil;
    } else {
        echo "data sudah tersedia dalam package ini !";
    }
} else {
    echo "data ID tidak tersedia";
}
?>