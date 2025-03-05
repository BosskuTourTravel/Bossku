<?php
include "../site.php";
include "../db=connection.php";
session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$day = $_POST['day'];
$desc = $_POST['desc'];
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");

$b = $_POST['b'];
$l = $_POST['l'];
$d = $_POST['d'];

//////////////////////////////////////////////
$timedate = date("Y-m-d H:i:s");
$date = date('Y/m/d');
//*** edit neno */
$staff =$_SESSION['staff_id'];
$job = '28';
$keterangan = "input Lantour";
$jumlah = '1';
$queryjob = "SELECT * FROM jenisgaji WHERE id = ".$job;
$rsj=mysqli_query($con,$queryjob);
$rowj = mysqli_fetch_array($rsj);
$harga = $rowj['harga'];
$total=$jumlah * $harga;
$query_tour= "SELECT * FROM tour_package where id=".$id;
$rs_tour=mysqli_query($con,$query_tour);
$row_tour = mysqli_fetch_array($rs_tour);
$name_tour=$row_tour['tour_name'];
///////////////////////////////////////

// $ct1 = $_POST['ct1'];
// $ct2 = $_POST['ct2'];
// $ct3 = $_POST['ct3'];
// $ct4 = $_POST['ct4'];
// $ct5 = $_POST['ct5'];
// $ct6 = $_POST['ct6'];
$itinerary_category_arrival = $_POST['itinerary_category_arrival'];
$itinerary_category_departure = $_POST['itinerary_category_departure'];

$desc = str_replace("'", "", $desc);

if (isset ($_FILES["fileToUpload"]["name"])){
    $target_dir = "../assets/i/tour_package/itinerary/";
    $target_dir2 = "assets/i/tour_package/itinerary/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 30000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO itinerary VALUES ('','".$date."','".$name."','".$day."','".$desc."',".$b.",".$l.",".$d.",".$itinerary_category_arrival.",".$itinerary_category_departure.",".$id.",'".$target_file2."')";
        if (mysqli_query($con, $sql)) {
            echo "success";
            ////////////////////////////////////////////////
                $com2="1";
                $queryct= "SELECT * FROM com_landtour WHERE tour_id=".$id;
                $rsct=mysqli_query($con,$queryct);
                $rowct = mysqli_fetch_array($rsct);
                $id_landtour=$rowct['tour_id'];
                if($id==$id_landtour){
                    $sqlx = "UPDATE com_landtour SET com2='".$com2."' WHERE tour_id=".$id;
                    
                }else{
                    $sqlx = "INSERT INTO com_landtour VALUES ('','".$id."','','".$com2."','')";
                }
                mysqli_query($con, $sqlx);
                $queryx= "SELECT * FROM com_landtour where tour_id=".$id;
                $rsx=mysqli_query($con,$queryx);
                $rowx = mysqli_fetch_array($rsx);
                if($rowx['com1']=="1" && $rowx['com2']=="1" && $rowx['com3']=="1")
                {
                    $querytj= "SELECT * FROM total_job where img=".$id;
                    $rstj=mysqli_query($con,$querytj);
                    $rowtj = mysqli_fetch_array($rstj);
                    $img=$rowtj['img'];
                    if($id==$img){
                        "sallary sudah masuk";
                    }else{
                    $sqljob = "INSERT INTO total_job VALUES ('','".$timedate."','".$staff."','".$job."','".$name_tour."','".$id."','".$jumlah."','".$total."')";
                    mysqli_query($con, $sqljob);
                    }
                }else{ "gagal1";}
            //////////////////////////////////////////////
            
        } else {
            echo "Error: " . $sql . "" . mysqli_error($con);
            header("location:https://www.2canholiday.com/Admin/#");
        }
        $con->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
        header("location:https://www.2canholiday.com/Admin/#");
    }
}

}else{
    echo "Image Harus Diisi!";
}



?>