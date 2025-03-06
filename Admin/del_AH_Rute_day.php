<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$query_main = "SELECT * FROM LT_AH_Main where id=" . $id;
$rs_main = mysqli_query($con, $query_main);
$row_main = mysqli_fetch_array($rs_main);

$sql = "DELETE FROM LT_AH_Main WHERE id=".$id;

if ($con->query($sql) === TRUE) {
    echo "success";
    $sql2 = "DELETE FROM LT_AH_ListTempat WHERE tour_id='".$row_main['copy_id']."' && sfee_id='".$row_main['sfee_id']."' && hari='".$row_main['hari']."'";
} else {
    echo "error";
}

$con->close();
?>