<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$paymentbank = $_POST['paymentbank'];
$paymenttype = $_POST['paymenttype'];

if($_POST['code']==0){
  $target_dir = "../assets/i/Performa/InvoiceTour/BuktiPembayaran/";
  $target_dir2 = "assets/i/Performa/InvoiceTour/BuktiPembayaran/";
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

      $sql = "UPDATE payment_detail_performatour SET payment_type = '".$paymenttype."',bukti_pembayaran = '', img_bukti_bayar = '".$target_file2."', bank_dibayarkan = ".$paymentbank." WHERE id = ".$id;
      if (mysqli_query($con, $sql)) {
        echo "success";

      } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
        header("location:https://www.2canholiday.com/Admin/#");
      }
      $con->close();
    } else {
      echo "Sorry, there was an error uploading your BuktiPembayaran.";
      header("location:https://www.2canholiday.com/Admin/#");
    }
  }
}else{

	$query = "SELECT * FROM payment_detail_performatour WHERE id=".$id;
	$rs=mysqli_query($con,$query);
	$row=mysqli_fetch_array($rs);

	$tempimg = $row['img_bukti_bayar'];

      $bukti = $_POST['bukti'];

      $sql = "UPDATE payment_detail_performatour SET payment_type = '".$paymenttype."',img_bukti_bayar='', bukti_pembayaran = '".$bukti."', bank_dibayarkan = ".$paymentbank." WHERE id = ".$id;
      if (mysqli_query($con, $sql)) {
      	unlink($tempimg);
        echo "success";

      } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
        header("location:https://www.2canholiday.com/Admin/#");
      }
      $con->close();
    
  
}

    



?>