<?php
include "../db=connection.php";
$query = "SELECT * FROM Rent_selected where id_package='" . $_POST['id'] . "'";
$rs = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($rs)) {
}
?>
