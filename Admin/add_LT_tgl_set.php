<?php
include "../site.php";
include "../db=connection.php";
session_start();


$copy_id = $_POST['copy_id'];
$master_id = $_POST['master_id'];
$chck_id = $_POST['chck_id'];


$berhasil = 0;
$gagal = 0;
if ($chck_id != "") {

	$query = "SELECT * FROM  LT_Date_list where master_id='" .$master_id. "' && copy_id='" . $copy_id . "' order by tgl ASC";
	$rs = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($rs)) {
		if($row['id']==$chck_id){
			$sql = "UPDATE  LT_Date_list SET ket='1' where  id=".$row['id'];
			if (mysqli_query($con, $sql)) {
				echo "Tanggal Keberangkatan Berhasil Di Update";
		   } else {
			echo "Tanggal Keberangkatan Gagal Di Update";
		   }
		}else{
			$sql = "UPDATE  LT_Date_list SET ket='0' where  id=".$row['id'];
			if (mysqli_query($con, $sql)) {
				$berhasil++;
		   } else {
				$gagal++;
		   }
		}
	}

	$con->close();
}
