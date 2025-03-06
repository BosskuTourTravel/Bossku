
<?php
include "../db=connection.php";
if($_POST['id'] !=""){
	$berhasil = 0;
	$gagal = 0;
	if ($_POST['con'] != "" && $_POST['cou'] != "" && $_POST['cit'] != "" && $_POST['pn'] != "" && $_POST['pnd'] != "" && $_POST['ket'] != "") {
	
		$sql = "UPDATE List_tempat SET continent='" . $_POST['con'] . "', negara='" . $_POST['cou'] . "', city='" . $_POST['cit'] . "', tempat='" . $_POST['pn'] . "', tempat2='" . $_POST['pnd'] . "',kurs='" . $_POST['kurs'] . "', price='" . $_POST['adt'] . "',chd='" . $_POST['chd'] . "', infant='" . $_POST['inf'] . "', keterangan='" . $_POST['ket'] . "' where id=".$_POST['id'];
		// var_dump($sql);
		if (mysqli_query($con, $sql)) {
			$berhasil++;
		} else {
			$gagal++;
		}
	} else {
		$gagal++;
	}
	
	echo "Data berhasil : " . $berhasil . ", Data Gagal : " . $gagal;
}
?>
