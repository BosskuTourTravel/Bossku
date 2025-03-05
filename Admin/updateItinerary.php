<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$day = $_POST['day'];
$desc = $_POST['desc'];
$img = $_POST['img'];
$b = $_POST['b'];
$l = $_POST['l'];
$d = $_POST['d'];

// $ct1 = $_POST['ct1'];
// $ct2 = $_POST['ct2'];
// $ct3 = $_POST['ct3'];
// $ct4 = $_POST['ct4'];
// $ct5 = $_POST['ct5'];
// $ct6 = $_POST['ct6'];

$itinerary_category_arrival = $_POST['itinerary_category_arrival'];
$itinerary_category_departure = $_POST['itinerary_category_departure'];

if($_POST['code']==0){
	$sql = "UPDATE itinerary SET name='".$name."', day=".$day.", description='".$desc."', breakfast=".$b.", lunch=".$l.", dinner=".$d.", img='".$img."', itinerary_category_arrival=".$itinerary_category_arrival.", itinerary_category_departure=".$itinerary_category_departure." WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";

	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
}else{
	$target_dir = "../assets/i/tour_package/itinerary/";
	$target_dir2 = "assets/i/tour_package/itinerary/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
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

		$sql = "UPDATE itinerary SET name='".$name."', day=".$day.", description='".$desc."', breakfast=".$b.", lunch=".$l.", dinner=".$d.",img='".$target_file2."', category=".$category.", itinerary_category_arrival=".$itinerary_category_arrival.", itinerary_category_departure=".$itinerary_category_departure." WHERE id=".$id;
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
}
    



?>