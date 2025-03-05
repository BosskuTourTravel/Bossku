<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$query_dp = "SELECT * FROM DP_ptsub2 id=".$id;
$rs_dp = mysqli_query($con, $query_dp);
$value = mysqli_fetch_array($rs_dp);

$query_sub = "SELECT landtour FROM  LTSUB_itin where  id =" . $value['copy_id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$sql = "DELETE FROM DP_ptsub2 WHERE id=".$id;
if ($con->query($sql) === TRUE) {
    $sql_2 = "DELETE FROM DP_add_transport where dp_id=".$id;
    $sql_3 = "DELETE FROM DP_add_transport where dp_id=".$id;
    if ($row_sub['landtour'] != "undefined") {
        $sql_4 = "DELETE FROM DP_select_PilihHTL where dp_id=".$id;
    }else{
        $sql_4 = "DELETE FROM DP_select_PilihHTLNC where dp_id=".$id;
    }
    echo "success";
} else {
    echo "error";
}
$con->close();

?>