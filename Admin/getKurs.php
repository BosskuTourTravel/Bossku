<?php
	// include kurs.php
	require("kurs.php");
	
	$bank = (!empty($_GET["bank"]) ? $_GET["bank"] : "");
	
	// call function and return array print_r($data);
	if(!empty($bank)){
		$data = kurs($bank);
	}else{
		$data = bank();
	}
	
	// JSON
	header('Content-Type: application/json');
	
	// mengijinkan semua host/domain/ip untuk menggunakan data JSON ini bila menggunakan AJAX
	// atau rubah tanda * menjadi domain yg di tentukan
	header('Access-Control-Allow-Origin: *');
	
	// convert array to JSON
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	$kursvalue = "";
	for ($x = 0; $x < count($data["data"]); $x++) {
		if($data["data"][$x]["kurs"]["mata_uang"]==$_GET['mata_uang']){
			$kursvalue = $data["data"][$x]["kurs"]["jual"];
		}
	}
	
	echo "asd : ".$kursvalue;
?>