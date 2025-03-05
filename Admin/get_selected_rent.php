<?php
include "../db=connection.php";

if ($_POST['id'] != "") {

    $id = $_POST['id'];
    $tipe = $_POST['tipe'];
    $pack = $_POST['pack_id'];
    $query_trans = "SELECT Transport_new.id, Transport_new.country,Transport_new.city, Transport_new.agent,Transport_new.trans_type, Transport_new.periode,Transport_new.seat,agent_transport.company,Transport_new.oneway,Transport_new.twoway,Transport_new.hd1,Transport_new.hd2,Transport_new.fd1,Transport_new.fd2,Transport_new.kaisoda,Transport_new.luarkota,Transport_new.kurs FROM Transport_new LEFT JOIN agent_transport ON agent_transport.id=Transport_new.agent where Transport_new.id='" . $id . "'";
    $rs_trans = mysqli_query($con, $query_trans);
    //  var_dump("Pack ".$pack);
    while ($row_trans = mysqli_fetch_array($rs_trans)) {

        if ($tipe == "oneway") {
            $sql_oneway = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['oneway'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_oneway)) {
                echo "Berhasil";
            } else {
               echo "gagal";
            }
        } else if ($tipe == "twoway") {
            $sql_twoway = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['twoway'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_twoway)) {
                echo "Berhasil";
            } else {
                $gagal++;
            }
        } else if ($tipe == "hd1") {
            $sql_hd1 = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['hd1'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_hd1)) {
                echo "Berhasil";
            } else {
                echo "gagal";
            }
        } else if ($tipe == "hd2") {
            $sql_hd2 = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['hd2'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_hd2)) {
                echo "Berhasil";
            } else {
                echo "gagal";
            }
        } else if ($tipe == "fd1") {
            $sql_fd1 = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['fd1'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_fd1)) {
                echo "Berhasil";
            } else {
                echo "gagal";
            }
        } else if ($tipe == "fd2") {
            $sql_fd2 = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['fd2'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_fd2)) {
                echo "Berhasil";
            } else {
                echo "gagal";
            }
        } else if ($tipe == "kaisoda") {
            $sql_kaisoda = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['kaisoda'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_kaisoda)) {
                echo "Berhasil";
            } else {
                echo "gagal";
            }
        } else if ($tipe == "luarkota") {
            $sql_luarkota = "INSERT INTO Rent_selected VALUES ('','" . $pack . "','" . $id . "','" . $row_trans['agent'] . "','" . $row_trans['trans_type'] . "','" . $row_trans['seat'] . "','" . $row_trans['country'] . "','" . $row_trans['city'] . "','" . $row_trans['periode'] . "','" . $tipe . "','" . $row_trans['kurs'] . "','" . $row_trans['luarkota'] . "','')";
            // var_dump($sql);
            if (mysqli_query($con, $sql_luarkota)) {
                echo "Berhasil";
            } else {
                echo "gagal";
            }
        } else {
            echo "tipe kosong";
        }
    }
} else {
    echo "nodata";
}
