<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];

$img = $_POST['img'];
$target_dir = "../assets/i/invoice/";
$target_dir2 = "assets/i/invoice/";
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

if ($_FILES["fileToUpload"]["size"] > 500000) {
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

		$sql = "UPDATE invoice SET img='".$target_file2."' WHERE id=".$id;
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




?>