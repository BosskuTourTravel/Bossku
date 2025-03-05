<?php
include "../db=connection.php";

if ($_POST['menu'] != "" && $_POST['tipe'] != "") {
    $tgl = date("Y-m-d");

    $query_update = "SELECT * FROM Staff_role where staff_id='" . $_POST['staff'] . "'";
    $rs_update = mysqli_query($con, $query_update);
    $row_update = mysqli_fetch_array($rs_update);


    if ($row_update['id'] == "") {
        $sql = "INSERT INTO Staff_role VALUES ('','" . $tgl . "','" . $_POST['staff'] . "','" . $_POST['tipe'] . "','".$_POST['menu']."','" . $_POST['role'] . "')";
        if (mysqli_query($con, $sql)) {

            $sql3 = "UPDATE login_staff SET type='" . $_POST['tipe'] . "'  where id =" . $_POST['staff'];
            if (mysqli_query($con, $sql3)) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "failed";
        }
    } else {
        $sql2 = "UPDATE Staff_role SET role='" . $_POST['tipe'] . "' ,menu='".$_POST['menu']."', menu_sub='" . $_POST['role'] . "' where id =" . $row_update['id'];
        if (mysqli_query($con, $sql2)) {

            $sql4 = "UPDATE login_staff SET type='" . $_POST['tipe'] . "'  where id =" . $_POST['staff'];
            if (mysqli_query($con, $sql4)) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "failed";
        }
    }
}else{
    echo "Role : ".$_POST['role']." - Tipe : ".$_POST['tipe'];
}
