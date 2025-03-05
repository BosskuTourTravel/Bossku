<?php 
error_reporting(0);
function ayoCurl($bank, $url, $td, $field1, $field2,$code,$user_agent = "Googlebot/2.1 (http://www.googlebot.com/bot.html)")
{
    $url = $url;
    $ch = curl_init();
	
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	
	// jika website yd di curl sedang offline
	if(!$content = curl_exec($ch)){
		$arrai = array(
			"bank" => $bank,
			"status" => "offline",
			"kurs" => array()
		);
		// return $arrai;
        return array("price" => 0,"status" => $arrai);
	}
	
	// ternyata website yd di curl sedang online
	else{
		curl_close($ch);
		$dom = new DOMDocument;
		$dom->loadHTML($content);
		$rows = array();
		foreach ($dom->getElementsByTagName('tr') as $tr) {
			$cells = array();
			foreach ($tr->getElementsByTagName('td') as $r) {
				$cells[] = $r->nodeValue;
			}
			$rows[] = $cells;
		}		
		
		$data_beli =  preg_replace('/\s+/', '', $rows[$td][$field1]);
		$data_jual =  preg_replace('/\s+/', '', $rows[$td][$field2]);

        $val_jual = explode(",", $data_jual);
        $val_beli = explode(",", $data_beli);
		
        $jual = preg_replace("/[^0-9]/", "", $val_jual[0]);
        $beli = preg_replace("/[^0-9]/", "", $val_beli[0]);
		// if(substr($jual, -3) == ",00"){
		// 	$jual = str_replace(",00", "", $jual);
		// }else if(substr($jual, -3) == ",00"){
		// 	$jual = str_replace(",00", "", $jual);
		// }
		
		// if(substr($beli, -3) == ",00"){
		// 	$beli = str_replace(".00", "", $beli);
		// }else if(substr($beli, -3) == ",00"){
		// 	$beli = str_replace(",00", "", $beli);
		// }
		
		// $search  = array(",", ".");
		// $replace = array("", "");
		// $jual = str_replace($search, $replace, $jual);
		// $beli = str_replace($search, $replace, $beli);
		
		$arrai = array(
			"bank" => $bank,
			"status" => "online",
			"kurs" => array(
				"mata_uang" => $code,
				"jual" => $jual,
				"beli" => $beli
			)
		);
		return array("price" => $beli,"status" => $arrai);
	}
}
function curl($code){
	include "../db=connection.php";
    $query = "SELECT id FROM kurs_bca_field where nama='".$code."'";
    $rs = mysqli_query($con,$query);
    $row = mysqli_fetch_array($rs);
	$data = array();
	$data[] = ["bank" => "BCA", "url" => "https://www.bca.co.id/id/informasi/kurs",	"td" => $row['id'], "field1" => "1", "field2" => "2"];
	/* Sobat bisa menambahkan lagi daftar bank yang akan di cURL ^^
	$data[] = ["bank" => "nama bank", "url" => "url bank yang akan di cURL", "td" => "array td ke", "field1" => "array field ke di dalam td (jual)", "field2" => "array field ke di dalam td (beli)"];
	*/
	
	return $data;
	
}
// function kurs($bank){

// 	$curl = curl();
	
// 	$data = array(
// 		"date" => date("d/m/Y")
// 	);

// 	foreach($curl as $cr){
// 		if($cr['bank'] == $bank){
// 			$data['data'][] = ayoCurl($cr['bank'], $cr['url'], $cr['td'], $cr['field1'], $cr['field2']);
// 		}else if($bank == "all"){
// 			$data['data'][] = ayoCurl($cr['bank'], $cr['url'], $cr['td'], $cr['field1'], $cr['field2']);
// 		}
// 	}	
	
// 	return $data;

// }
function get_kurs_bca($x){
$nominal = $x['nominal'];
$code = $x['code'];
$bank = "BCA";
$curl = curl($code);
	$data = array(
		"date" => date("d/m/Y")
	);
foreach($curl as $cr){
    if($cr['bank'] == $bank){
        $data['data'][] = ayoCurl($cr['bank'], $cr['url'], $cr['td'], $cr['field1'], $cr['field2'],$code);
        $kurs = $nominal * $data['data'][0]['price'];
        return  json_encode(array("status" => $data['data'][0]['status'], "tgl" => $data['date'],"price" =>$kurs ), true);
    }
}

}
