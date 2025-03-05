<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$note = $_POST['note'];
$date = date("Y-m-d");
// $kosong="assets/i/food_package/food/none.png";
// echo"hampirrr";

if (isset ($_FILES["fileToUpload"]["name"]) && isset($_FILES["header"]["name"])){
    $target_dir = "../assets/i/Cruise/content/";
    $target_dir_b = "assets/i/Cruise/content/";
    $target_dir2 = "../assets/i/Cruise/header/";
    $target_dir2_b = "assets/i/Cruise/header/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file_b = $target_dir_b . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["header"]["name"]);
    $target_file2_b = $target_dir2_b . basename($_FILES["header"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $check2 = getimagesize($_FILES["header"]["tmp_name"]);
    if($check !== false && $check2 !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file) && file_exists($target_file2)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 30000000 && $_FILES["header"]["size"] > 30000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
&& $imageFileType2 != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["header"]["tmp_name"],$target_file2)) {
		$sql = "INSERT INTO Cruise_ship VALUES ('','".$date."','".$name."','".$note."','".$target_file_b."','".$target_file2_b."')";
        if (mysqli_query($con, $sql) ) {
            echo "success";
        } else {
            echo "Error: " . $sql . "" . mysqli_error($con);
            // header("location:https://www.thekingdom-mart.com/Admin/#");
        }
        $con->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
        // header("location:https://www.2canholiday.com/Admin/#");
    }
}

}else{
    echo "Image Harus Diisi!";
}
