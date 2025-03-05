<?php
include "../site.php";
include "../db=connection.php";


$cont2 = $_POST['agent'];
$cont = $_POST['city'];
//var_dump($cont);
// $sql = "SELECT * FROM country WHERE continent=".$_POST['continent'];
// $hasil = mysqli_query($con, $sql);
$query_ac = "SELECT DISTINCT  periode FROM transport where agent=".$_POST['agent'].", city=".$_POST['city'];
$rs_ac=mysqli_query($con,$query_ac);

    // while ($row= mysqli_fetch_array($hasil)) {
    //     echo"<option value=".$row['id'].">".$row['name']."</option>";

    while($row_ac = mysqli_fetch_array($rs_ac)){
        $query_per= "SELECT * FROM periode where id=".$row_ac['periode']; 
        $rs_per=mysqli_query($con,$query_per);
        $row_per = mysqli_fetch_array($rs_per);
        echo "<option value='".$row_per['id']."'>".$row_per['nama']."</option>";
    }
//}
?>