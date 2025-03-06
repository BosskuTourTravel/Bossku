<?php
include "../site.php";
include "../db=connection.php";
session_start();

// $data = $_POST['data'];
// $gmb = json_encode($data['gambar']);
// var_dump("onnn");
// foreach($data['gambar'] as $val_gmb){
// 	echo $val_gmb['filename'];
// 	echo "on";
// }
$date = date("Y-m-d");
$judul = $_POST['judul'];
$landtour = $_POST['landtour_name'];
$hari = $_POST['hari'];
$status = $_SESSION['staff_id'];

$count = count($_FILES['fileToUpload']['name']);
$g1 = "";
$g2 = "";
$g3 = "";
$g4 = "";
$berhasil = 0;
$gagal = 0;
if ($count < 4) {
	$sql = "INSERT INTO LT_itinerary2 VALUES ('','$judul','$landtour','$hari','','','','','$date','','$status')";
	if (mysqli_query($con, $sql)) {
		echo "success" . " , Gambar berhasil : " . $berhasil . " , Gambar Gagal : " . $gagal;
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
} else {
	for ($i = 0; $i < $count; $i++) {
		// echo 'Name: '.$_FILES['fileToUpload']['name'][$i].'<br/>';
		$nama_file = $_FILES['fileToUpload']['name'][$i];
		$ukuran_file = $_FILES['fileToUpload']['size'][$i];
		$tipe_file = $_FILES['fileToUpload']['type'][$i];
		$tmp_file = $_FILES['fileToUpload']['tmp_name'][$i];

		$path = "images/" . $nama_file;
		if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
			if ($ukuran_file <= 5000000) {

				//memindahkan lokasi gambar dari tempat asal ke dalam folder website
				//memiliki 2 parameter yang harus diisi, yaitu parameter tempat asal gambar dan paramter tempat tujuan gambar
				if (move_uploaded_file($tmp_file, $path)) {
					// echo "succes upload gambar";
					if ($i == 0) {
						$g1 = $nama_file;
					} else if ($i == 1) {
						$g2 = $nama_file;
					} else if ($i == 2) {
						$g3 = $nama_file;
					} else if ($i == 3) {
						$g4 = $nama_file;
					} else {
					}
					$berhasil++;
				} else {
					// 
					$gagal++;
				}
			} else {
				//jika ukuran gambar lebih besar dari 5MB maka akan memunculkan pesan seperti di bawah ini
				// 
				$gagal++;
			}
		} else {
			//jika tipe gambar yang diupload bukan jpg atau png maka akan memunculkan pesan seperti di bawah ini
			// 
			$gagal++;
		}
	}
	$sql = "INSERT INTO LT_itinerary2 VALUES ('','$judul','$landtour','$hari','$g1','$g2','$g3','$g4','$date','','$status')";
	if (mysqli_query($con, $sql)) {
		echo "success" . " , Gambar berhasil : " . $berhasil . " , Gambar Gagal : " . $gagal;
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
}
$con->close();
