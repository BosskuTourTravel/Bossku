<?php
include "../site.php";
include "../db=connection.php";


$city = $_POST['country'];
$sql = "SELECT * FROM city WHERE country=".$_POST['country'];
$hasil = mysqli_query($con, $sql);
    while ($row= mysqli_fetch_array($hasil)) {
        echo"<option value=".$row['id'].">".$row['name']."</option>";

}
?>