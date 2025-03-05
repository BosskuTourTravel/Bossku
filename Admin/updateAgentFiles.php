<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['tid'];
$agent = $_POST['agent'];

$country = $_POST['country'];
$city = $_POST['city'];
$city_count = $_POST['city_count'];

if($_POST['code']==1){
    $img = $_POST['img'];
    $target_dir = "dist/landtour/";
    $target_dir2 = "dist/landtour/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);
    $date = date("Y-m-d");
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

            $sql = "UPDATE agent_files SET agent=".$agent.", location='".$target_file."',country='".$country."', city='".$city."',city_count='".$city_count."', updateDate='".$date."' WHERE id=".$id;
            if (mysqli_query($con, $sql)) {
                unlink($img);
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
else{
    $img = $_POST['img'];
    $sql = "UPDATE agent_files SET agent=".$agent.",country='".$country."', city='".$city."',city_count='".$city_count."', location='".$img."' WHERE id=".$id;
    if (mysqli_query($con, $sql)) {
        echo "success";

    } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
        header("location:https://www.2canholiday.com/Admin/#");
    }
    $con->close();
}





?>