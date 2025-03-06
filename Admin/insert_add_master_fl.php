<?php
include "../site.php";
include "../db=connection.php";
session_start();

$status = $_SESSION['staff_id'];
$date = date("Y-m-d");

$in = explode(',', $_POST['in']);
$out = explode(',', $_POST['out']);
$musim = explode(',', $_POST['musim']);
$type1 = explode(',', $_POST['type1']);
$type2 = explode(',', $_POST['type2']);
$id_grub = explode(',', $_POST['id_grub']);
$maskapai = explode(',', $_POST['maskapai']);
$dept_arr = explode(',', $_POST['dept_arr']);
$no_mas = explode(',', $_POST['no_mas']);
$etd = explode(',', $_POST['etd']);
$eta = explode(',', $_POST['eta']);
$tgl = explode(',', $_POST['tgl']);
$transit = explode(',', $_POST['transit']);
$adt = explode(',', $_POST['adt']);
$chd = explode(',', $_POST['chd']);
$inf = explode(',', $_POST['inf']);
$bagasi = explode(',', $_POST['bagasi']);
$bagasi_price = explode(',', $_POST['bagasi_price']);
$seat_price = explode(',', $_POST['seat_price']);
$bf = explode(',', $_POST['bf']);
$ln = explode(',', $_POST['ln']);
$dn = explode(',', $_POST['dn']);
$tax = explode(',', $_POST['tax']);
$i = 0;
$b_route = 0;
$g_route = 0;
$b_detail = 0;
$g_detail = 0;
$val_idgrub = 0;
$sama = 0;
foreach ($in as $value) {
	$query_code = "SELECT kode FROM LT_flight_logo where nama ='" . $maskapai[$i] . "'";
	$rs_code = mysqli_query($con, $query_code);
	$row_code = mysqli_fetch_array($rs_code);

	$query_type = "SELECT id FROM LTP_type_flight where nama ='" . $type1[$i] . "'";
	$rs_type = mysqli_query($con, $query_type);
	$row_type = mysqli_fetch_array($rs_type);

	$query_cek = "SELECT id FROM LTP_add_route where city_in ='" . $value . "' && city_out ='" . $out[$i] . "' &&  maskapai='" . $row_code['kode'] . "' ";
	$rs_cek = mysqli_query($con, $query_cek);
	$row_cek = mysqli_fetch_array($rs_cek);

	$val_etd = explode('+', $etd[$i]);
	$val_eta = explode('+', $eta[$i]);

	$transit = 0;
	$dp_ar = explode('-', $dept_arr[$i]);
	if ($id_grub[$i] != $val_idgrub) {
		$val_idgrub = $id_grub[$i];

		$cek_id = "SELECT id_grub FROM LTP_route_detail ORDER BY id_grub DESC LIMIT 1";
		$rs_cek_id = mysqli_query($con, $cek_id);
		$row_cek_id = mysqli_fetch_array($rs_cek_id);
		$val_cek_id = $row_cek_id['id_grub'] + 1;

		// transit

		$f_awal = strtotime($val_eta[0]);
		$plus_awal = $val_eta[1];
		// echo $plus_awal ." - ";

	} else {
		if ($val_etd[1] == 1 && $plus_awal == '') {
			$transit = 1440 + ((strtotime($val_etd[0]) - $f_awal) / 60);
		} else if ($val_etd[1] == 1 && $plus_awal == 1) {
			$transit = (strtotime($val_etd[0]) - $f_awal) / 60;
		} else {
			$transit = (strtotime($val_etd[0]) - $f_awal) / 60;
		}
	}
	$jam = $transit;
	// echo $val_cek_id." - ";
	// echo $jam . " - ";

	if ($row_cek['id'] == "") {
		// insert new route
		$sql = "INSERT INTO LTP_add_route VALUES ('','" . $date . "','" . $in[$i] . "','" . $out[$i] . "','" . $row_code['kode'] . "','$status')";
		// echo "Baru ". $sql."</br>";
		if (mysqli_query($con, $sql)) {
			$b_route++;
		} else {
			$g_route++;
		}

		// cek route
		$query_route = "SELECT id FROM LTP_add_route where city_in ='" . $value . "' && city_out ='" . $out[$i] . "' &&  maskapai='" . $row_code['kode'] . "'";
		$rs_route = mysqli_query($con, $query_route);
		$row_route = mysqli_fetch_array($rs_route);
		if ($row_route['id'] != "") {
			// echo "lanjut input";
			$sql2 = "INSERT INTO LTP_route_detail VALUES ('','" . $row_route['id'] . "','" . $musim[$i] . "','" . $row_type['id'] . "','" . $type2[$i] . "','" . $val_cek_id . "','" . $no_mas[$i] . "','" . $dp_ar[0] . "','" . $dp_ar[1] . "','" . $tgl[$i] . "','" . $val_etd[0] . "','" . $val_eta[0] . "','" . $jam . "','" . $adt[$i] . "','" . $chd[$i] . "','" . $inf[$i] . "','" . $bagasi[$i] . "','" . $bagasi_price[$i] . "','" . $seat_price[$i] . "','" . $bf[$i] . "','" . $ln[$i] . "','" . $dn[$i] . "','" . $tax[$i] . "','')";
			if (mysqli_query($con, $sql2)) {
				$b_detail++;
			} else {
				$g_detail++;
				// echo $sql2;
			}
		} else {
			echo "route cek gagal " . $query_route . " </br>";
		}
	} else {
		$query_route2 = "SELECT * FROM LTP_add_route where city_in ='" . $value . "' && city_out ='" . $out[$i] . "' &&  maskapai='" . $row_code['kode'] . "'";
		$rs_route2 = mysqli_query($con, $query_route2);
		$row_route2 = mysqli_fetch_array($rs_route2);
		if ($row_route2['id'] != "") {
			// echo "sudah ada lanjut input</br>";
			// cek data route detail apakah ada yang sama

			$cek_data = "SELECT id FROM LTP_route_detail where route_id='" . $row_route2['id'] . "' &&  musim='" . $musim[$i] . "' &&  type='" . $row_type['id'] . "' && rute='" . $type2[$i] . "' &&  maskapai='" . $no_mas[$i] . "' && dept='" . $dp_ar[0] . "' && arr='" . $dp_ar[1] . "' && take='" . $val_etd[0] . "' && landing='" . $val_eta[0] . "' && tgl='" . $tgl[$i] . "' order by id ASC limit 1";
			$rs_data = mysqli_query($con, $cek_data);
			$row_data = mysqli_fetch_array($rs_data);
			if ($row_data['id'] == "") {

				// insert route detail
				$sql3 = "INSERT INTO LTP_route_detail VALUES ('','" . $row_route2['id'] . "','" . $musim[$i] . "','" . $row_type['id'] . "','" . $type2[$i] . "','" . $val_cek_id . "','" . $no_mas[$i] . "','" . $dp_ar[0] . "','" . $dp_ar[1] . "','" . $tgl[$i] . "','" . $val_etd[0] . "','" . $val_eta[0] . "','" . $jam . "','" . $adt[$i] . "','" . $chd[$i] . "','" . $inf[$i] . "','" . $bagasi[$i] . "','" . $bagasi_price[$i] . "','" . $seat_price[$i] . "','" . $bf[$i] . "','" . $ln[$i] . "','" . $dn[$i] . "','" . $tax[$i] . "','')";
				if (mysqli_query($con, $sql3)) {
					$b_detail++;
				} else {
					$g_detail++;
					echo $sql3;
				}
			} else {
				$sama++;
			}
		} else {
			echo "sudah ada tp gagal " . $query_route2;
		}
	}
	$i++;
}
echo "route berhasil = " . $b_route;
echo ", detail berhasil = " . $b_detail;
echo ", detail sama = " . $sama;
$con->close();
