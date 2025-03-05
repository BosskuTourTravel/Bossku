<?php
include "../site.php";
include "../db=connection.php";
include "Api_LT_total_baru.php";
session_start();


$date = date("Y-m-d");
$dp_maker = $_SESSION['staff_id'];

$query_sub = "SELECT landtour,judul,id,tgl,status,cabang,master_id FROM  LTSUB_itin where  id =" . $_POST['sub_id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$master_id = $row_sub['master_id'];
$copy_id = $row_sub['id'];
$chck = $_POST['chck'];
$c_pax = $_POST['pax'];
$c_twn = $_POST['twn'];
$c_sgl = $_POST['sgl'];
$c_cnb = $_POST['cnb'];
$c_inf = $_POST['inf'];
$l_twn = $_POST['ltwn'];
$l_sgl = $_POST['ltwn'];
$l_cnb = $_POST['ltwn'];
$l_inf = $_POST['ltwn'];
$judul = $row_sub['judul'];

$sub_maker = $row_sub['status'];
$tgl_sub = $row_sub['tgl'];

$code = "";
$itin_id = '';

$continent = "";
$country = "";
$city = "";
$pax = "";
$twn = 0;
$sgl = 0;
$cnb = 0;
$inf = 0;
$exp = "";
$ket = $row_sub['cabang'];
$highlight = "";

$arr = [];
$arr_chck = explode(",",$_POST['chck']);
foreach ($arr_chck as $check) {
	if ($check != '15' && $check !='1') {
		$data_tps = array(
			"master_id" => $row_sub['master_id'],
			"copy_id" => $row_sub['id'],
			"check_id" => $check,
		);

		$show_tps = get_total($data_tps);
		$result_tps = json_decode($show_tps, true);

		$twn = $twn + $result_tps['adt'];
		$sgl = $sgl + $result_tps['sgl'];
		$cnb = $cnb + $result_tps['chd'];
		$inf = $inf + $result_tps['inf'];
	}else if($check == '1'){
		$data_tps = array(
			"flight" => $_POST['flight'],
			"date" => $_POST['date']
		);
		$show_tps = get_flight_price($data_tps);
		$result_tps = json_decode($show_tps, true);
		$twn = $twn + $result_tps['adt'];
		$sgl = $sgl + $result_tps['sgl'];
		$cnb = $cnb + $result_tps['chd'];
		$inf = $inf + $result_tps['inf'];
	}else{

	}
}

$data_visa = array(
	"master_id" => $row_sub['master_id'],
	"copy_id" => $row_sub['id'],
	"check_id" => '8',
);

$show_visa = get_total($data_visa);
$result_visa = json_decode($show_visa, true);

$data_guide = array(
	"master_id" => $row_sub['master_id'],
	"copy_id" => $row_sub['id'],
	"check_id" => '26'
);

$show_guide = get_total($data_guide);
$result_guide = json_decode($show_guide, true);

$data_tl = array(
	"master_id" => $row_sub['master_id'],
	"copy_id" => $row_sub['id'],
	"check_id" => '32'
);

$show_tl = get_total($data_tl);
$result_tl = json_decode($show_tl, true);

$visa = $result_visa['adt'];
$guide = $result_guide['adt'];
$feetl = $result_tl['adt'];

if ($row_sub['landtour'] != "undefined") {
	$arr_htl = [];
	$query_hotel2 = "SELECT * FROM LT_select_PilihHTL WHERE master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' order by id ASC ";
	$rs_hotel2 = mysqli_query($con, $query_hotel2);
	while ($row_hotel2 = mysqli_fetch_array($rs_hotel2)) {
		$arr_h = array(
			"master_id" => $row_hotel2['master_id'],
			"copy_id" => $row_hotel2['copy_id'],
			"hotel_id" => $row_hotel2['hotel_id'],
			"hari" => $row_hotel2['hari'],
			"no_htl" => $row_hotel2['no_htl'],
			"ket" => $row_hotel2['ket']
		);
		array_push($arr_htl, $arr_h);
	}

	$query_hotel = "SELECT hotel_id FROM LT_select_PilihHTL WHERE master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' order by id ASC limit 1";
	$rs_hotel = mysqli_query($con, $query_hotel);
	$row_hotel = mysqli_fetch_array($rs_hotel);
	if ($row_hotel['hotel_id'] != "") {
		$query_itin = "SELECT * FROM LT_itinnew WHERE id=" . $row_hotel['hotel_id'];
		$rs_itin = mysqli_query($con, $query_itin);
		$row_itin = mysqli_fetch_array($rs_itin);

		$itin_id = $row_itin['id'];
		$code = $row_itin['kode'];
		$continent = $row_itin['benua'];
		$country = $row_itin['negara'];
		$city = $row_itin['kota'];
		$pax = $row_itin['pax'];
		$pax_u = $row_itin['pax_u'];
		$pax_b = $row_itin['pax_b'];
		$exp = $row_itin['expired'];

		if ($row_itin['id'] != "") {
			$sql_profit = "SELECT id,profit FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
			$rs_profit = mysqli_query($con, $sql_profit);
			$row_profit = mysqli_fetch_array($rs_profit);

			$pr = 0;
			if ($row_profit['id'] != "") {
				$pr = $row_profit['profit'];
			} else {
				$pr = 5;
			}

			$nom = $row_profit['nominal'];
			// $lain2 = $dm + $mar + $agn_s + $ste + $nom;

			$p_twin =  ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'] + $nom;
			$p_sgl =  ($row_itin['agent_sgl'] * $pr / 100) + $row_itin['agent_sgl'] + $nom;
			$p_chd =  ($row_itin['agent_cnb'] * $pr / 100) + $row_itin['agent_cnb'] + $nom;
			$p_inf =  ($row_itin['agent_infant'] * $pr / 100) + $row_itin['agent_infant'] + $nom;


			$twn = $twn +  $p_twin + $l_twn;
			$sgl = $sgl +  $p_sgl + $l_sgl;
			$cnb = $cnb +  $p_chd + $l_cnb;
			$inf = $inf +  $p_inf + $l_inf;
		}
	}
} else {
	
}
$arr_dp_trans = [];
$query_plane = "SELECT * FROM LT_add_transport where master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' && tgl_sfee='".$_POST['date']."'  order by hari ASC,urutan ASC";
$rs_plane = mysqli_query($con, $query_plane);
$plane = "";
$fr = "";
while ($row_plane = mysqli_fetch_array($rs_plane)) {
	$arr_tr = array(
		"tgl_sfee" => $row_plane['tgl_sfee'],
		"grub_id" => $row_plane['grub_id'],
		"type" => $row_plane['type'],
		"hari" => $row_plane['hari'],
		"urutan" => $row_plane['urutan'],
		"transport" => $row_plane['transport'],
		"status" => $row_plane['status']
	);

	array_push($arr_dp_trans, $arr_tr);
	if ($row_plane['type'] == '1') {

		$query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_plane['transport'] . "'";
		$rs_detail2 = mysqli_query($con, $query_detail2);
		$row_detail2 = mysqli_fetch_array($rs_detail2);

		$detail = $row_detail2['maskapai']." : ".$row_detail2['dept']."-".$row_detail2['arr']." (".$row_detail2['take']."-".$row_detail2['landing'].")";
		$plane .= $detail . "</br>";

	} else if ($row_plane['type'] == '2') {
		$query_ferry = "SELECT * FROM ferry_LT  where id=" . $row_plane['transport'];
		$rs_ferry = mysqli_query($con, $query_ferry);
		$row_ferry = mysqli_fetch_array($rs_ferry);
		$detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ")";
		$fr .= $detail . "</br>";
	}
}
$flight = $plane;
$ferry = $fr;

$twn_sp = get_pembulatan($twn);
$twn_rp = json_decode($twn_sp, true);

$sgl_sp = get_pembulatan($sgl);
$sgl_rp = json_decode($sgl_sp, true);

$cnb_sp = get_pembulatan($cnb);
$cnb_rp = json_decode($cnb_sp, true);

$inf_sp = get_pembulatan($inf);
$inf_rp = json_decode($inf_sp, true);

$sql = "INSERT INTO DP_ptsub2 VALUES ('','" . $date . "','" . $master_id . "','" . $copy_id . "','" . $chck . "','" . $c_pax . "','" . $c_twn . "','" . $c_sgl . "','" . $c_cnb . "','" . $c_inf . "','" . $l_twn . "','" . $l_sgl . "','" . $l_cnb . "','" . $l_inf . "','" . $judul . "','" . $code . "','" . $itin_id . "','" . $continent . "','" . $country . "','" . $city . "','" . $pax . "','" . $pax_u . "','" . $pax_b . "','" . $twn_rp['value'] . "','" . $sgl_rp['value'] . "','" . $cnb_rp['value'] . "','" . $inf_rp['value'] . "','" . $exp . "','" . $chck . "','" . $flight . "','" . $ferry . "','" . $visa . "','" . $guide . "','" . $feetl . "','" . $highlight . "','" . $sub_maker . "','" . $tgl_sub . "','" . $dp_maker . "','$ket')";
if (mysqli_query($con, $sql)) {

	$sql_id = "SELECT id FROM DP_ptsub2 order by id DESC limit 1";
	$rs_id = mysqli_query($con, $sql_id);
	$row_id = mysqli_fetch_array($rs_id);
	// echo "success";
	$berhasil = 0;
	$gagal = 0;
	$berhasil_hc = 0;
	$gagal_hc = 0;
	foreach ($arr_dp_trans as $val_tr) {
		$sql_tr = "INSERT INTO DP_add_transport VALUES ('','$date','".$val_tr['tgl_sfee']."','$master_id','$copy_id','".$val_tr['grub_id']."','" . $row_id['id'] . "','" . $val_tr['type'] . "','" . $val_tr['hari'] . "','" . $val_tr['urutan'] . "','" . $val_tr['transport'] . "','" . $val_tr['status'] . "')";
		if (mysqli_query($con, $sql_tr)) {
			$berhasil++;
		} else {
			$gagal++;
		}
	}
	if ($row_sub['landtour'] != "undefined") {
		foreach ($arr_htl as $val_htl) {
			$sql_hc = "INSERT INTO DP_select_PilihHTL VALUES ('','".$date."','".$val_htl['master_id']."','".$val_htl['copy_id']."','" . $row_id['id'] . "','".$val_htl['hotel_id']."','".$val_htl['hari']."','".$val_htl['no_htl']."','".$val_htl['ket']."')";
			if (mysqli_query($con, $sql_hc)) {
				$berhasil_hc++;
			} else {
				$gagal_hc++;
			}
		}
	} else {
		foreach ($arr_htl as $val_htl) {
			$sql_hnc = "INSERT INTO DP_select_PilihHTLNC VALUES ('','".$date."','".$val_htl['master_id']."','".$val_htl['copy_id']."','" . $row_id['id'] . "','".$val_htl['hotel_name']."','".$val_htl['hari']."','".$val_htl['hotel_twin']."','".$val_htl['hotel_triple']."','".$val_htl['hotel_family']."','".$val_htl['status']."')";
			if (mysqli_query($con, $sql_hnc)) {
				$berhasil_hc++;
			} else {
				$gagal_hc++;
			}
		}
	}
	echo "DP PT SUB Berhasil, Transport berhasil : " . $berhasil.", Hotel berhasil :".$berhasil_hc;
} else {
	echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();
