<?php
include "../db=connection.php";
$query_agn = "SELECT * FROM  agent_transport where agent_code='" . $_POST['code'] . "'";
$rs_agn = mysqli_query($con, $query_agn);
$row_agn = mysqli_fetch_array($rs_agn);
if ($row_agn['id'] == "") {

    $sql = "INSERT INTO agent_transport VALUES ('','" .$_POST['agent'] . "','" . $_POST['code'] . "','" . $_POST['email'] . "','" . $_POST['tlpn'] . "','','','','" . $_POST['alamat'] . "','" . $_POST['kota'] . "','','','" . $_POST['negara']. "','" . $_POST['tour_code']. "','" . $_POST['web'] . "','" . $_POST['tlpn'] . "','','','" . $_POST['company'] . "','','" . $_POST['note']. "','')";
    if (mysqli_query($con, $sql)) {
        echo "Berhasil";
    } else {
        echo "Gagal";
    }
}
