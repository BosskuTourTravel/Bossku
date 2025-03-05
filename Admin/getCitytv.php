<?php
include "../site.php";
include "../db=connection.php";


$cit = $_POST['city'];
//var_dump($cont);
// $sql = "SELECT * FROM country WHERE continent=".$_POST['continent'];
// $hasil = mysqli_query($con, $sql);
$queryper = "SELECT DISTINCT  periode FROM transport where city=".$_POST['city'];
$rsper=mysqli_query($con,$queryper);

    // while ($row= mysqli_fetch_array($hasil)) {
    //     echo"<option value=".$row['id'].">".$row['name']."</option>";

    while($rowper= mysqli_fetch_array($rsper)){
        $queryper2 = "SELECT * FROM periode where id=".$rowper['periode']; 
        $rsper2=mysqli_query($con,$queryper2);
        $rowper2 = mysqli_fetch_array($rsper2);
    echo "<option value='".$rowper2['id']."'>".$rowper2['nama']."</option>";
    }
//}
?>