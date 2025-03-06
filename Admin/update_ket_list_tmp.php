
<?php
include "../db=connection.php";
if($_POST['id'] !=""){
	$berhasil = 0;
	$gagal = 0;
	if ( $_POST['ket'] != "") {
	
		$sql = "UPDATE List_tempat SET keterangan='" . $_POST['ket'] . "' where id=".$_POST['id'];
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
