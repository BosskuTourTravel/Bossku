<?php
include "../db=connection.php";
$i = $_POST['id'];

$cont = $_POST['con' . $i];
$cou = $_POST['cou' . $i];
$cit = $_POST['cit' . $i];
$periode = $_POST['periode' . $i];
$trns_type = $_POST['trans_type' . $i];
$seat =  intval($_POST['seat' . $i]);
$kurs = $_POST['kurs' . $i];
$oneway = intval($_POST['oneway' . $i]);
$twoway = intval($_POST['twoway' . $i]);
$hd1 = intval($_POST['hd1' . $i]);
$hd2 = intval($_POST['hd2' . $i]);
$fd1 = intval($_POST['fd1' . $i]);
$fd2 = intval($_POST['fd2' . $i]);
$kaisoda = intval($_POST['kaisoda' . $i]);
$luarkota = intval($_POST['luarkota' . $i]);
$remarks = $_POST['ket' . $i];

$update = 0;
$gagal = 0;

$sql2 = "UPDATE  Transport_new SET continent='" . $cont . "',country='" . $cou . "',city='" . $cit . "',periode='" . $periode . "',kurs='" . $kurs . "',trans_type='" . $trns_type . "',seat='" . $seat . "',oneway='" . $oneway . "',twoway='" . $twoway . "',hd1='" . $hd1 . "',hd2='" . $hd2 . "',fd1='" . $fd1 . "',fd2='" . $fd2 . "',kaisoda='" . $kaisoda . "',luarkota='" . $luarkota . "',remarks='" . $remarks . "' WHERE id=" . $i;
if (mysqli_query($con, $sql2)) {
    // echo "Berhasil";
    $query_cek = "SELECT Rent_selected.id,Rent_selected.kurs, t_oneway.price as oneway,t_twoway.price as twoway, t_fd1.price as fd1,t_fd2.price as fd2,t_hd1.price as hd1, t_hd2.price as hd2,t_kaisoda.price AS kaisoda,t_luarkota.price as luarkota  FROM Rent_selected LEFT JOIN Rent_selected as t_oneway ON (t_oneway.tipe = 'oneway' && t_oneway.id_trans='" . $_POST['id'] . "') LEFT JOIN Rent_selected as t_twoway ON (t_twoway.tipe = 'twoway' && t_twoway.id_trans='" . $_POST['id'] . "') LEFT JOIN Rent_selected as t_fd1 ON (t_fd1.tipe='fd1' && t_fd1.id_trans='" . $_POST['id'] . "') LEFT JOIN Rent_selected as t_fd2 ON (t_fd2.tipe='fd2' && t_fd2.id_trans='" . $_POST['id'] . "') LEFT JOIN Rent_selected as t_hd1 ON (t_hd1.tipe='hd1' && t_hd1.id_trans='" . $_POST['id'] . "') LEFT JOIN Rent_selected as t_hd2 ON (t_hd2.tipe='hd2' && t_hd2.id_trans='" . $_POST['id'] . "') LEFT JOIN Rent_selected as t_kaisoda ON (t_kaisoda.tipe='kaisoda' && t_kaisoda.id_trans='" . $_POST['id'] . "')LEFT JOIN Rent_selected as t_luarkota ON (t_luarkota.tipe='luarkota' && t_luarkota.id_trans='" . $_POST['id'] . "') WHERE Rent_selected.id_trans='" . $_POST['id'] . "' order by Rent_selected.id ASC";
    $rs_cek = mysqli_query($con, $query_cek);
    $row_cek = mysqli_fetch_array($rs_cek);

    if (isset($row_cek['oneway'])) {
        $sql_up1 = "UPDATE Rent_selected SET price ='" . $oneway . "', kurs='" . $kurs . "' WHERE tipe='oneway' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up1)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['twoway'])) {
        $sql_up2 = "UPDATE Rent_selected SET price ='" . $twoway . "', kurs='" . $kurs . "' WHERE tipe='twoway' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up2)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['fd1'])) {
        $sql_up3 = "UPDATE Rent_selected SET price ='" . $fd1 . "', kurs='" . $kurs . "' WHERE tipe='fd1' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up3)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['fd2'])) {
        $sql_up4 = "UPDATE Rent_selected SET price ='" . $fd2 . "', kurs='" . $kurs . "' WHERE tipe='fd2' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up4)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['hd1'])) {
        $sql_up5 = "UPDATE Rent_selected SET price ='" . $hd1 . "', kurs='" . $kurs . "' WHERE tipe='hd1' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up5)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['hd2'])) {
        $sql_up6 = "UPDATE Rent_selected SET price ='" . $hd2 . "', kurs='" . $kurs . "' WHERE tipe='hd2' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up6)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['kaisoda'])) {
        $sql_up7 = "UPDATE Rent_selected SET price ='" . $kaisoda . "', kurs='" . $kurs . "' WHERE tipe='kaisoda' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up7)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    if (isset($row_cek['luarkota'])) {
        $sql_up8 = "UPDATE Rent_selected SET price ='" . $luarkota . "', kurs='" . $kurs . "' WHERE tipe='luarkota' && id_trans=" . $i;
        if (mysqli_query($con, $sql_up8)) {
            $update++;
        } else {
            $gagal++;
        }
    }
    echo "Berhasil : ".$update.", Gagal".$gagal;
} else {
    echo "Gagal";
}
