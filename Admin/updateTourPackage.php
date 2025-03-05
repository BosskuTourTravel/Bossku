<?php
include "../site.php";
include "../db=connection.php";
session_start();
$id = $_POST['id'];
$name = $_POST['name'];
$category = $_POST['category'];
$desc = $_POST['desc'];
$type = $_POST['type'];
$duration = $_POST['duration'];
$departure = $_POST['departure'];
$minperson = $_POST['minperson'];
$country = $_POST['country'];
$city = $_POST['city'];
$city_count = $_POST['city_count'];
$agent  = $_POST['agent'];

// $date2 = date('Y-m-d');
// $to = $_POST['to'];
// $out = $_POST['out'];
// $destination_to = $_POST['destination_to'];
// $destination_out = $_POST['destination_out'];
// $query_flight_city = "SELECT COUNT(*) as total FROM tour_package_flight_city WHERE tour_package=".$id;
// $rs_flight_city=mysqli_query($con,$query_flight_city);
// $row_flight_city = mysqli_fetch_assoc($rs_flight_city);
// if($row_flight_city['total']>0){
//   $sql_flight = "UPDATE tour_package_flight_city SET tos='".$to."', outs='".$out."', destination_to='".$destination_to."', destination_out='".$destination_out."', stamp_update='".$date2."' WHERE tour_package=".$id;
//   if (mysqli_query($con, $sql_flight)) {

//   } else {
//     echo "Error: " . $sql_flight . "" . mysqli_error($con);
//   }
// }else{
//     $sql_flight = "INSERT INTO tour_package_flight_city values('',".$id.",'".$to."','".$out."','".$destination_to."','".$destination_out."',".$_SESSION['staff_id'].",'0000-00-00','".$date2."')";
//     if (mysqli_query($con, $sql_flight)) {

//     } else {
//         echo "Error: " . $sql_flight . "" . mysqli_error($con);
//     }
// }

if($_POST['code']==0){
  if($city=='' or $country==''){
    $img = $_POST['img'];
    $img_head = $_POST['img_head'];
    $sql = "UPDATE tour_package SET tour_name='".$name."', agent='".$agent."', category='".$category."', description='".$desc."', tour_type='".$type."', duration_tour=".$duration.", departure='".$departure."', country='".$country."', city='".$city."',city_count='".$city_count."', minperson=".$minperson.",img='".$img."', img_head='".$img_head."' WHERE id=".$id;
    if (mysqli_query($con, $sql)) {
      echo "success";

    } else {
      echo "Error: " . $sql . "" . mysqli_error($con);
    }
    $con->close();
  }else{

    $citycount = $_POST['citycount'];
    $img = $_POST['img'];
    $img_head = $_POST['img_head'];
    $sql = "UPDATE tour_package SET tour_name='".$name."', agent='".$agent."', category='".$category."', description='".$desc."', tour_type='".$type."', duration_tour=".$duration.", departure='".$departure."', country='".$country."', city='".$city."',city_count='".$city_count."', minperson=".$minperson.",img='".$img."', img_head='".$img_head."' WHERE id=".$id;
    if (mysqli_query($con, $sql)) {
      echo "success";

    } else {
      echo "Error: " . $sql . "" . mysqli_error($con);
    }
    $con->close();
  }
}else if($_POST['code']==2){
  $img = $_POST['img'];
  $img_head = $_POST['img_head'];
  $target_dir = "../assets/i/tour_package/";
  $target_dir2 = "assets/i/tour_package/";
  $target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
  $target_file2 = $target_dir2 . basename($_FILES["fileToUpload2"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
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


  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {

      $sql = "UPDATE tour_package SET tour_name='".$name."', agent='".$agent."', category='".$category."', description='".$desc."', tour_type='".$type."', duration_tour=".$duration.", departure='".$departure."', country='".$country."', city='".$city."',city_count='".$city_count."', minperson=".$minperson.", img='".$target_file2."', img_head='".$img_head."' WHERE id=".$id;
      if (mysqli_query($con, $sql)) {
        unlink("../".$img);
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

}else if($_POST['code']==3){
  $img = $_POST['img'];
  $img_head = $_POST['img_head'];
  $target_dir = "../assets/i/tour_package/";
  $target_dir2 = "assets/i/tour_package/";
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

      $sql = "UPDATE tour_package SET tour_name='".$name."', aagent='".$agent."', category='".$category."', description='".$desc."', tour_type='".$type."', duration_tour=".$duration.", departure='".$departure."', country='".$country."', city='".$city."',city_count='".$city_count."', minperson=".$minperson.", img='".$img."', img_head='".$target_file2."' WHERE id=".$id;
      if (mysqli_query($con, $sql)) {
        unlink("../".$img_head);
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

}else{
  $img = $_POST['img'];
  $img_head = $_POST['img_head'];
  $target_dir = "../assets/i/tour_package/";
  $target_dir2 = "assets/i/tour_package/";
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

    $sql = "UPDATE tour_package SET tour_name='".$name."', agent='".$agent."', category='".$category."', description='".$desc."', tour_type='".$type."', duration_tour=".$duration.", departure='".$departure."', country='".$country."', city='".$city."',city_count='".$city_count."', minperson=".$minperson.", img='".$target_filex2."', img_head='".$target_file2."' WHERE id=".$id;
    if (mysqli_query($con, $sql)) {
      unlink("../".$img);
      unlink("../".$img_head);
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
    



?>