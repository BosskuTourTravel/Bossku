
<?php
include "../db=connection.php";
session_start();
if ($_POST['nama'] != "") {
    $date = date("Y-m-d");
    $staff =  $_SESSION['staff_id'];
    $sql2 = "INSERT INTO MP_tokopedia_rent VALUES ('','".$date."','".$_POST['nama']."','".$staff."')";
    if (mysqli_query($con, $sql2)) {
        echo "Success";
    } else {
        echo "Failed Input";
    }
} else {
    echo "data ID tidak tersedia";
}
?>