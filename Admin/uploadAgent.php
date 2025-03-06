<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$tour_country = $_POST['countryA'];
$date = date("Y-m-d h:i:sa");

$country = $_POST['country'];
$city = $_POST['city'];
$city_count = $_POST['city_count'];
//*** edit neno */
$staff = '3';
date_default_timezone_set('Asia/Jakarta');
$date2 = date("Y-m-d H:i:s");
$job = '1';
$queryc = "SELECT * FROM country WHERE id =".$country;
$rsc=mysqli_query($con,$queryc);
$rowc = mysqli_fetch_array($rsc);
$tc = $rowc['name'];

$jumlah = '1';

$queryjob = "SELECT * FROM jenisgaji WHERE id =".$job;
$rsjob=mysqli_query($con,$queryjob);
$row = mysqli_fetch_array($rsjob);

$harga = $row['harga'];
$total=$jumlah * $harga;
//*************/

if($_POST['code']==1){
    $target_dir = "dist/landtour/";
    $target_dir2 = "dist/landtour/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);
    $filename=basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileTypex = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $sql = "INSERT INTO agent_files VALUES ('','".$agent."','".$target_file."',0,0,'".$country."','".$city."','".$city_count."','0000-00-00','".$date."',0)";
            if($tour_country==''){
                if (mysqli_query($con, $sql)) {
                    $sql3 = "INSERT INTO total_job VALUES ('','".$date2."','".$staff."','".$job."','".$filename."','','".$jumlah."','".$total."')";
                    mysqli_query($con, $sql3);
                echo "success";
                    
                } else {
                    echo "Error: " . $sql . "" . mysqli_error($con);
                    header("location:https://www.2canholiday.com/Admin/#");
                }
            }else{
                $sql2 = "UPDATE agent SET tour_country='".$tour_country."' WHERE id=".$agent;
                if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
                    $sql3 = "INSERT INTO total_job VALUES ('','".$date2."','".$staff."','".$job."','".$tc."','','".$jumlah."','".$total."')";
                    mysqli_query($con, $sql3);
                    echo "success" ;
                    
                } 
                            ///******neno edit ****
            // $sql3 = "INSERT INTO total_job VALUES ('','".$date2."','".$staff."','".$job."','".$tour_country."','','".$jumlah."','".$total."')";
            // if (mysqli_query($con, $sql) && mysqli_query($con, $sql3)) {
            //     echo "success";
                
            // } 
          
            ///****** end neno edit ****
                else {
                    echo "Error: " . $sql . "" . mysqli_error($con);
                    header("location:https://www.2canholiday.com/Admin/#");
                }

            }
           
            $con->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
            header("location:https://www.2canholiday.com/Admin/#");
        }
    }
}else{
    echo "Silahkan Masukkan File Yang Di Upload Terlebih Dahulu";
}





?>