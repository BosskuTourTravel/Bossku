<?php
include "db=connection.php";
if ($_POST['id'] != "") {


    $date = date("Y-m-d");
    $deptDate = date('Y-m-d', strtotime($_POST['tgl']));
    // $book = date('dmy', strtotime($row_data['tgl'])) . $row_data['id'];

    $sql = "INSERT INTO LT_order_list VALUES ('','" . $date . "','" . $_POST['email'] . "','" . $_POST['nama'] . "','" . $_POST['tlpn'] . "','" . $_POST['master'] . "','" . $_POST['id'] . "','" . $_POST['judul'] . "','" . $deptDate . "','" . $_POST['adt'] . "','" . $_POST['chd'] . "','" . $_POST['price'] . "','" . $_POST['ket'] . "','','')";
    if (mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "gagal";
    }
}
?>