<?php
include "../site.php";
include "../db=connection.php";

$gb= $_POST['gb'];
$gk= $_POST['gk'];
$gt= $_POST['gt'];

$lb= $_POST['lb'];
$lk= $_POST['lk'];
$lt= $_POST['lt'];


$db= $_POST['db'];
$dk= $_POST['dk'];
$dt= $_POST['dt'];


$hb= $_POST['hb'];
$hk= $_POST['hk'];
$ht= $_POST['ht'];
$hp= $_POST['hp'];
$htipe= $_POST['htipe'];
//$kurs=$_POST['cc'];

$bb= $_POST['bb'];
$bk= $_POST['bk'];
$bt= $_POST['bt'];



//$datab= $bb."/".$bk."/".$bt."/".$bp;
$tpax= $_POST['tpax'];
$seltp= $_POST['seltp'];
$tour = explode(";", $_POST['agent']);
$total_ht=explode(";", $_POST['total_ht']);
//var_dump($tour);
$d=0;
$argb  = explode(";",$gb);
$argk  = explode(";",$gk);
$argt  = explode(";",$gt);


$arlb  = explode(";",$lb);
$arlk  = explode(";",$lk);
$arlt  = explode(";",$lt);


$ardb  = explode(";",$db);
$ardk  = explode(";",$dk);
$ardt  = explode(";",$dt);


$arhb  = explode(";",$hb);
$arhk  = explode(";",$hk);
$arht  = explode(";",$ht);
$arhp  = explode(";",$hp);
$arhtipe  = explode(";",$htipe);

$arbb  = explode(";",$bb);
$arbk  = explode(";",$bk);
$arbt  = explode(";",$bt);

$foc = explode(";",$_POST['foc']);
$bonus = explode(";",$_POST['bonus']);
$tl= explode(";",$_POST['tl']);

$focx = explode(",",$_POST['focx']);
$bonusx = explode(",",$_POST['bonusx']);
$tlx= explode(",",$_POST['tlx']);


$ftipe_room = explode(";",$_POST['ftipe_room']);
$btipe_room = explode(";",$_POST['btipe_room']);
$ttipe_room = explode(";",$_POST['ttipe_room']);

$durasi=0;
for($i=0; $i < count($tour); $i++) {
	$tour2[$i]= explode(",", $tour[$i]);
	$tourpack= $tour2[$i][0];
	$durasi_pack=$tour2[$i][1];
	$kurs_pack=$tour2[$i][2];
	if($kurs_pack=='0'){
		$kurs_pack='17';
	}
	$durasi = $durasi + $tour2[$i][1];
	$aht=$total_ht[$i];
	
	$data_foc=$foc[$i];
	$data_bonus=$bonus[$i];
	$data_tl = $tl[$i];

	$data_focx=$focx[$i];
	$data_bonusx=$bonusx[$i];
	$data_tlx = $tlx[$i];

	$data_ftipe=$ftipe_room[$i];
	$data_btipe=$btipe_room[$i];
	$data_ttipe=$ttipe_room[$i];

	$gbtour=array();
	$gktour=array();
	$gttour=array();


	$lbtour=array();
	$lktour=array();
	$lttour=array();


	$dbtour=array();
	$dktour=array();
	$dttour=array();


	$hbtour=array();
	$hktour=array();
	$httour=array();
	$hptour=array();
	$htipe_tour=array();

	$bbtour=array();
	$bktour=array();
	$bttour=array();

	for($x=$d; $x < $durasi; $x++) {
		$selisih= $durasi - $x;
		if($selisih==1){
			$gbtour[]=$argb[$x];
			$gktour[]=$argk[$x];
			$gttour[]=$argt[$x];


			$lbtour[]=$arlb[$x];
			$lktour[]=$arlk[$x];
			$lttour[]=$arlt[$x];


			$dbtour[]=$ardb[$x];
			$dktour[]=$ardk[$x];
			$dttour[]=$ardt[$x];
			$dptour[]=$ardp[$x];

			$hbtour[]=$arhb[$x];
			$hktour[]=$arhk[$x];
			$httour[]=$arht[$x];
			$hptour[]=$arhp[$x];
			$htipe_tour[]=$arhtipe[$x];

			$bbtour[]=$arbb[$x];
			$bktour[]=$arbk[$x];
			$bttour[]=$arbt[$x];

		}else{
			array_push($gbtour,$argb[$x]);
			array_push($gktour,$argk[$x]);
			array_push($gttour,$argt[$x]);


			array_push($lbtour,$arlb[$x]);
			array_push($lktour,$arlk[$x]);
			array_push($lttour,$arlt[$x]);

			array_push($dbtour,$ardb[$x]);
			array_push($dktour,$ardk[$x]);
			array_push($dttour,$ardt[$x]);


			array_push($hbtour,$arhb[$x]);
			array_push($hktour,$arhk[$x]);
			array_push($httour,$arht[$x]);
			array_push($hptour,$arhp[$x]);
			array_push($htipe_tour,$arhtipe[$x]);

			array_push($bbtour,$arbb[$x]);
			array_push($bktour,$arbk[$x]);
			array_push($bttour,$arbt[$x]);

		}
 //var_dump("array x :".$arbb[$x]);
	}
//var_dump($bb);
$d= $d + $durasi;
$hgb=implode(",",$gbtour);
$hgk=implode(",",$gktour);
$hgt=implode(",",$gttour);


$hlb=implode(",",$lbtour);
$hlk=implode(",",$lktour);
$hlt=implode(",",$lttour);


$hdb=implode(",",$dbtour);
$hdk=implode(",",$dktour);
$hdt=implode(",",$dttour);


$hhb=implode(",",$hbtour);
$hhk=implode(",",$hktour);
$hht=implode(",",$httour);
$hhp=implode(",",$hptour);
$hhtipe=implode(",",$htipe_tour);

$hbb=implode(",",$bbtour);
$hbk=implode(",",$bktour);
$hbt=implode(",",$bttour);


$guide= $hgb."%".$hgk."%".$hgt;
$breakfast= $hbb."%".$hbk."%".$hbt;
$lunch= $hlb."%".$hlk."%".$hlt;
$dinner= $hdb."%".$hdk."%".$hdt;
$hotel= $hhb."%".$hhk."%".$hht."%".$hhp."%".$hhtipe;
$all_foc=$data_focx."%".$data_ftipe."%".$data_foc;
$all_bonus=$data_bonusx."%".$data_btipe."%".$data_bonus;
$all_tl=$data_tlx."%".$data_ttipe."%".$data_tl;
//var_dump($all_foc);
$sql = "INSERT INTO hotelquo VALUES ('','".$tourpack."','".$durasi_pack."','".$tpax."','".$kurs_pack."','".$guide."','".$breakfast."','".$lunch."','".$dinner."','".$hotel."','".$all_foc."','".$all_bonus."','".$all_tl."','".$aht."')";
//var_dump($sql);
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}

//var_dump("agent :".$tour2[$i][0]."/"."durasi :".$tour2[$i][1]."/"."bf biaya:".$hbb."/"."bf kurs :".$hbk."/"."bf ket :".$hbt."/"."bf pax :".$hbp);
}
//var_dump($d);
// 	$con->close();


?>