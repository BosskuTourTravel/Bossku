<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$continent = $_POST['continent'];

$cekName = strtolower($name);

$query_country = "SELECT COUNT(*) as total FROM country WHERE LOWER(name) LIKE '".$cekName."'";
$rs_country=mysqli_query($con,$query_country);
$row_country = mysqli_fetch_assoc($rs_country);


if($row_country['total']<=0){

    if($_POST['code']==0){
        $sql = "INSERT INTO country VALUES ('','".$name."',".$continent.",'','')";
        if (mysqli_query($con, $sql)) {
            echo "success";
            
        } else {
            echo "Error: " . $sql . "" . mysqli_error($con);
            header("location:https://www.2canholiday.com/Admin/#");
        }
        $con->close();
    }else{
        $target_dir = "../assets/i/country/";
        $target_dir2 = "assets/i/country/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);

        $target_filex = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
        $target_filex2 = $target_dir2 . basename($_FILES["fileToUpload2"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $imageFileTypex = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $checkx = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false and $checkx !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

// Check if file already exists
        if (file_exists($target_file) or file_exists($target_filex)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000 or $_FILES["fileToUpload2"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileTypex != "jpg" && $imageFileTypex != "png" && $imageFileTypex != "jpeg"
            && $imageFileTypex != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_filex)) {

            $sql = "INSERT INTO country VALUES ('','".$name."','".$target_file2."','".$target_filex2."')";
            if (mysqli_query($con, $sql)) {
                echo "success";

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
}

}


?>