<?php
include "../site.php";
include "../db=connection.php";


$cont = $_POST['city'];
//var_dump($cont);
// $sql = "SELECT * FROM country WHERE continent=".$_POST['continent'];
// $hasil = mysqli_query($con, $sql);
$queryAgent = "SELECT DISTINCT  agent FROM transport where city=".$_POST['city'];
$rsAgent=mysqli_query($con,$queryAgent);

    // while ($row= mysqli_fetch_array($hasil)) {
    //     echo"<option value=".$row['id'].">".$row['name']."</option>";

    while($rowAgent = mysqli_fetch_array($rsAgent)){
        $queryAgent2 = "SELECT * FROM agent where id=".$rowAgent['agent']; 
        $rsAgent2=mysqli_query($con,$queryAgent2);
        $rowAgent2 = mysqli_fetch_array($rsAgent2);
        echo "<option value='".$rowAgent2['id']."'>".$rowAgent2['company']."(".$rowAgent2['name'].")</option>";
    }
//}
?>