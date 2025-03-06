<?php
include "../site.php";
include "../db=connection.php";
session_start();

// $data=$_POST['data'];
if (!empty($_FILES['fileupload'])){
    $nama_file = $_FILES['fileupload']['name'];
    $ukuran_file = $_FILES['fileupload']['size'];
    $tipe_file = $_FILES['fileupload']['type'];
    $tmp_file = $_FILES['fileupload']['tmp_name'];

    $path = "images/".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
        if($ukuran_file <= 5000000){ 

          //memindahkan lokasi gambar dari tempat asal ke dalam folder website
          //memiliki 2 parameter yang harus diisi, yaitu parameter tempat asal gambar dan paramter tempat tujuan gambar
          if(move_uploaded_file($tmp_file, $path)){ 
           echo "succes upload gambar";
          }else{
            echo "Maaf, Gambar gagal untuk diupload.";
          }
        }else{
          //jika ukuran gambar lebih besar dari 5MB maka akan memunculkan pesan seperti di bawah ini
          echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
        }
      }else{
        //jika tipe gambar yang diupload bukan jpg atau png maka akan memunculkan pesan seperti di bawah ini
        echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
      }
}else{
	echo "file tidak terbaca";
}


?>
