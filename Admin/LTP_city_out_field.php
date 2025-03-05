
<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $query_out = "SELECT city_out FROM LTP_add_route where city_in = '" . $_POST['x'] . "' order by city_out ASC";
    $rs_out = mysqli_query($con, $query_out);
    $data = [];
    while ($row_out = mysqli_fetch_array($rs_out)) {
        array_push($data, $row_out);
    }
    echo json_encode($data);
}
?>