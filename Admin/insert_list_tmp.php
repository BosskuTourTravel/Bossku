
<?php
include "../db=connection.php";

if ($_POST['sel'] != "") {
	$berhasil = 0;
	$gagal = 0;
	$sama = 0;
	for ($i = 1; $i <= $_POST['sel']; $i++) {
		if ($_POST['con'.$i] != "" && $_POST['cou'.$i] != "" && $_POST['cit'.$i] != "" && $_POST['pn'.$i] != "" && $_POST['pnd'.$i] != "" && $_POST['ket'.$i] != "") {

			// 
			$query_cek = "SELECT * FROM List_tempat where continent ='" . $_POST['con'.$i] . "' && negara ='" . $_POST['cou'.$i] . "' && city='" . $_POST['cit'.$i] . "' && tempat='" . $_POST['pn'.$i] . "' && tempat2='" . $_POST['pnd'.$i] . "'";
			$rs_cek = mysqli_query($con, $query_cek);
			$row_cek = mysqli_fetch_array($rs_cek);

			if ($row_cek['id'] == "") {
				$sql = "INSERT INTO List_tempat VALUES ('','" . $_POST['con'.$i] . "','" . $_POST['cou'.$i] . "','" . $_POST['cit'.$i] . "','" . $_POST['pn'.$i] . "','" . $_POST['pnd'.$i] . "','" . $_POST['ket'.$i] . "','" . $_POST['kurs'.$i] . "','" . $_POST['adt'.$i] . "','" . $_POST['chd'.$i] . "','" . $_POST['inf'.$i] . "','','')";
				// var_dump($sql);
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			} else {
				$sama++;
			}
		} else {
			$gagal++;
		}
	}

	echo "Data berhasil : " . $berhasil . ", Data Gagal : " . $gagal . ", Data sama : " . $sama;
}
?>
