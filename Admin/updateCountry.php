<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$continent = $_POST['continent'];

if($_POST['code']==0){
	$img = $_POST['img'];
	$img_head = $_POST['img_head'];
	$sql = "UPDATE country SET name='".$name."', continent=".$continent.", img='".$img."', img_head='".$img_head."' WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";

	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
}else if($_POST['code']==2){
	$img = $_POST['img'];
	$img_head = $_POST['img_head'];
	$target_dir = "../assets/i/country/";
	$target_dir2 = "assets/i/country/";
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

	if ($_FILES["fileToUpload2"]["size"] > 500000) {
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
		if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {

			$sql = "UPDATE country SET name='".$name."',continent=".$continent.",img='".$target_file2."', img_head='".$img_head."' WHERE id=".$id;
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
	$target_dir = "../assets/i/country/";
	$target_dir2 = "assets/i/country/";
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

			$sql = "UPDATE country SET name='".$name."',continent=".$continent.", img='".$img."', img_head='".$target_file2."' WHERE id=".$id;
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

		$sql = "UPDATE country SET name='".$name."',continent=".$continent.", img='".$target_filex2."', img_head='".$target_file2."' WHERE id=".$id;
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