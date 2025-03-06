<?php
include "../site.php";
include "../db=connection.php";

if (isset($_POST['agent'])) {
$cont = $_POST['agent'];
$queryAgent = "SELECT DISTINCT  city FROM transport where agent=".$_POST['agent'];
$rsAgent=mysqli_query($con,$queryAgent);
//echo "<option value=''>Pilih City</option>";
    while($rowAgent = mysqli_fetch_array($rsAgent)){
        $query_city= "SELECT * FROM city where id=".$rowAgent['city']; 
        $rs_city=mysqli_query($con,$query_city);
        $row_city = mysqli_fetch_array($rs_city);
        echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
    }


}

if (isset($_POST['agent2'])) {
    $cont = $_POST['agent2'];
    $queryAgent = "SELECT DISTINCT  city FROM transport where agent=".$_POST['agent2'];
    $rsAgent=mysqli_query($con,$queryAgent);
    //echo "<option value=''>Pilih City</option>";
        while($rowAgent = mysqli_fetch_array($rsAgent)){
            $query_city= "SELECT * FROM city where id=".$rowAgent['city']; 
            $rs_city=mysqli_query($con,$query_city);
            $row_city = mysqli_fetch_array($rs_city);
            echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
        }
    
    
    }
    if (isset($_POST['agent3'])) {
        $cont = $_POST['agent3'];
        $queryAgent = "SELECT DISTINCT  city FROM transport where agent=".$_POST['agent3'];
        $rsAgent=mysqli_query($con,$queryAgent);
        //echo "<option value=''>Pilih City</option>";
            while($rowAgent = mysqli_fetch_array($rsAgent)){
                $query_city= "SELECT * FROM city where id=".$rowAgent['city']; 
                $rs_city=mysqli_query($con,$query_city);
                $row_city = mysqli_fetch_array($rs_city);
                echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
            }
        
        
        }
    if (isset($_POST['agent4'])) {
        $cont = $_POST['agent4'];
        $queryAgent = "SELECT DISTINCT  city FROM transport where agent=".$_POST['agent4'];
        $rsAgent=mysqli_query($con,$queryAgent);
        //echo "<option value=''>Pilih City</option>";
            while($rowAgent = mysqli_fetch_array($rsAgent)){
                $query_city= "SELECT * FROM city where id=".$rowAgent['city']; 
                $rs_city=mysqli_query($con,$query_city);
                $row_city = mysqli_fetch_array($rs_city);
                echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
            }
        
        
        }
    if (isset($_POST['agent5'])) {
        $cont = $_POST['agent5'];
        $queryAgent = "SELECT DISTINCT  city FROM transport where agent=".$_POST['agent5'];
        $rsAgent=mysqli_query($con,$queryAgent);
        //echo "<option value=''>Pilih City</option>";
            while($rowAgent = mysqli_fetch_array($rsAgent)){
                $query_city= "SELECT * FROM city where id=".$rowAgent['city']; 
                $rs_city=mysqli_query($con,$query_city);
                $row_city = mysqli_fetch_array($rs_city);
                echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
            }
        
        
        }
        if (isset($_POST['agent6'])) {
            $cont = $_POST['agent6'];
            $queryAgent = "SELECT DISTINCT  city FROM transport where agent=".$_POST['agent6'];
            $rsAgent=mysqli_query($con,$queryAgent);
            //echo "<option value=''>Pilih City</option>";
                while($rowAgent = mysqli_fetch_array($rsAgent)){
                    $query_city= "SELECT * FROM city where id=".$rowAgent['city']; 
                    $rs_city=mysqli_query($con,$query_city);
                    $row_city = mysqli_fetch_array($rs_city);
                    echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
                }
            
            
            }

// if (isset($_POST['city'])) {
//     $agent = $_POST['agent'];
//     $city = $_POST['city'];
//     $query_ac = "SELECT DISTINCT  periode FROM transport where agent=".$_POST['agent']." AND city=".$_POST['city'];
//     $rs_ac=mysqli_query($con,$query_ac);
// //  var_dump($query_ac);
//         while($row_ac = mysqli_fetch_array($rs_ac)){
//             $query_per= "SELECT * FROM periode where id=".$row_ac['periode']; 
//             $rs_per=mysqli_query($con,$query_per);
//             $row_per = mysqli_fetch_array($rs_per);
//             echo "<option value='".$row_per['id']."'>".$row_per['nama']."</option>";
//         }

// }
?>