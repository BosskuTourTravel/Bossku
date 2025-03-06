<?php
include "../site.php";
include "../db=connection.php";
session_start();

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$date = date("Y-m-d");
$judul = $_POST['judul'];
$landtour = $_POST['landtour_name'];
$status = $_SESSION['staff_id'];
$g1 = $row_data['gambar1'];
$g2 = $row_data['gambar2'];
$g3 = $row_data['gambar3'];
$g4 = $row_data['gambar4'];
$berhasil = 0;
$gagal = 0;

if (!empty($_FILES['gambar1'])) {
	// $nama_file = $_FILES['gambar1']['name'];
	$nama_file = uniqid().$_FILES['gambar1']['name'];
	$ukuran_file = $_FILES['gambar1']['size'];
	$tipe_file = $_FILES['gambar1']['type'];
	$tmp_file = $_FILES['gambar1']['tmp_name'];
	$path = "images/" . $nama_file;

	if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
		if ($ukuran_file <= 5000000) {
			// echo $nama_file;
			if (move_uploaded_file($tmp_file, $path)) {
				 $g1 = $nama_file;
				$berhasil++;
			} else {
				// echo $_FILES["gambar1"]["error"];
				$gagal++;
			}
		} else {
			$gagal++;
		}
	} else {
		$gagal++;
	}
}

if (!empty($_FILES['gambar2'])) {
	$nama_file = uniqid().$_FILES['gambar2']['name'];
	$ukuran_file = $_FILES['gambar2']['size'];
	$tipe_file = $_FILES['gambar2']['type'];
	$tmp_file = $_FILES['gambar2']['tmp_name'];
	$path = "images/" . $nama_file;
	if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
		if ($ukuran_file <= 5000000) {
			if (move_uploaded_file($tmp_file, $path)) {
				$g2 = $nama_file;
				$berhasil++;
			} else {
				// 
				$gagal++;
			}
		} else {
			$gagal++;
		}
	} else {
		$gagal++;
	}
}

if (!empty($_FILES['gambar3'])) {
	$nama_file = uniqid().$_FILES['gambar3']['name'];
	$ukuran_file = $_FILES['gambar3']['size'];
	$tipe_file = $_FILES['gambar3']['type'];
	$tmp_file = $_FILES['gambar3']['tmp_name'];
	$path = "images/" . $nama_file;
	if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
		if ($ukuran_file <= 5000000) {
			if (move_uploaded_file($tmp_file, $path)) {
				$g3 = $nama_file;
				$berhasil++;
			} else {
				// 
				$gagal++;
			}
		} else {
			$gagal++;
		}
	} else {
		$gagal++;
	}
}

if (!empty($_FILES['gambar4'])) {
	$nama_file = uniqid().$_FILES['gambar4']['name'];
	$ukuran_file = $_FILES['gambar4']['size'];
	$tipe_file = $_FILES['gambar4']['type'];
	$tmp_file = $_FILES['gambar4']['tmp_name'];
	$path = "images/" . $nama_file;
	// var_dump($nama_file);
	if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
		if ($ukuran_file <= 5000000) {
			if (move_uploaded_file($tmp_file, $path)) {
				$g4 = $nama_file;
				$berhasil++;
			} else {
				// 
				$gagal++;
			}
		} else {
			$gagal++;
		}
	} else {
		$gagal++;
	}
}

//  echo $g1;
$sql = "UPDATE LT_itinerary2 SET judul='" . $judul . "',landtour='" . $landtour . "', gambar1='" . $g1 . "', gambar2='" . $g2 . "', gambar3='" . $g3 . "', gambar4='" . $g4 . "' WHERE id='" . $_POST['id'] . "'";
if (mysqli_query($con, $sql)) {
	echo "berhasil update gambar :".$berhasil;
} else {
	echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();
