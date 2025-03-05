<?php
include "../site.php";
include "../db=connection.php";

$sql = "UPDATE LAN_Hotel_List SET hari='".$_POST['hari']."', urutan='".$_POST['urutan']."' WHERE id=".$_POST['id'];
if (mysqli_query($con, $sql)) {
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();
?>