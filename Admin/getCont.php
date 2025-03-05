<?php
include "../site.php";
include "../db=connection.php";


$cont = $_POST['continent'];
//var_dump($cont);
$sql = "SELECT * FROM country WHERE continent=".$_POST['continent'];
$hasil = mysqli_query($con, $sql);
    while ($row= mysqli_fetch_array($hasil)) {
        echo"<option value=".$row['id'].">".$row['name']."</option>";

}
?>