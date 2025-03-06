<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>
 <?php
 include "../site.php";
 include "../db=connection.php";

 $city_from = $_POST['city_from'];
 $city_to = $_POST['city_to'];
 $type_price = $_POST['type_price'];
 $flight_type = $_POST['flight_type'];

if($city_to!=0){
	$queryTo = " city_to = ".$city_to;
}else{
	$country_to = $_POST['country_to'];
	$queryTo = " country_to = ".$country_to;
}
// echo $queryTo."</br>";
// echo $_POST['city_out']."</br>";
// echo $_POST['city_from']."</br>";

 $city_out = $_POST['city_out'];
 if($city_out=='-1'){
 	echo "<div class='col-3'>
 	<label>Airlines</label></br>
 	<select class='chosen' name='airlines' id='airlines'>";
 	if($city_out==''){
 		$query_airlines = "SELECT DISTINCT airlines_id,flight_type,kurs_price FROM flight_quotation WHERE flight_type LIKE '".$flight_type."' AND type LIKE '".$type_price."' AND city_from = ".$city_from." AND ".$queryTo;
 	}else{
 		$query_airlines = "SELECT DISTINCT airlines_id,flight_type,kurs_price FROM flight_quotation WHERE flight_type LIKE '".$flight_type."' AND type LIKE '".$type_price."' AND city_from = ".$city_from." AND ".$queryTo;
 	}
 	$rs_airlines=mysqli_query($con,$query_airlines);
 	echo "<option value='0'>Pilihan</option>";
 	while($row_airlines = mysqli_fetch_array($rs_airlines)){
 	// $cekadtpricekurs = $row_airlines['kurs_price'];

 	// if($cekadtpricekurs=='IDR'){
 	// 	$adtprice = (int)$row_airlines['adt_price'];

 	// }else{
 	// 	$query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekadtpricekurs;
 	// 	$rs_kurs=mysqli_query($con,$query_kurs);
 	// 	$row_kurs = mysqli_fetch_array($rs_kurs);

 	// 	$adtprice = (int)$row_airlines['adt_price'] * $row_kurs['jual'];
 	// }
 		$query_flight = "SELECT * FROM airlines WHERE id=".$row_airlines['airlines_id'];
 		$rs_flight=mysqli_query($con,$query_flight);
 		$row_flight = mysqli_fetch_array($rs_flight);
 		echo "<option value='".$row_airlines['airlines_id'] ."-".$row_airlines['flight_type']."-".$row_airlines['adt_price']."'>".$row_flight['nama'] ." - ".$row_airlines['flight_type']."</option>";
 	}
 	echo"</select>
 	</div>";
 }else{
 	echo "<div class='col-3'>
 	<label>Airlines</label></br>
 	<select class='chosen' name='airlines' id='airlines'>";
 	if($city_out==''){
 		$query_airlines = "SELECT DISTINCT airlines_id,flight_type,kurs_price FROM flight_quotation WHERE flight_type LIKE '".$flight_type."' AND type LIKE '".$type_price."' AND city_from = ".$city_from." AND ".$queryTo;
 	}else{
 		$query_airlines = "SELECT DISTINCT airlines_id,flight_type,kurs_price FROM flight_quotation WHERE flight_type LIKE '".$flight_type."' AND type LIKE '".$type_price."' AND city_from = ".$city_from." AND ".$queryTo." AND city_out=".$city_out;
 	}
 	$rs_airlines=mysqli_query($con,$query_airlines);
 	echo "<option value='0'>Pilihan</option>";
 	while($row_airlines = mysqli_fetch_array($rs_airlines)){
 	// $cekadtpricekurs = $row_airlines['kurs_price'];

 	// if($cekadtpricekurs=='IDR'){
 	// 	$adtprice = (int)$row_airlines['adt_price'];

 	// }else{
 	// 	$query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekadtpricekurs;
 	// 	$rs_kurs=mysqli_query($con,$query_kurs);
 	// 	$row_kurs = mysqli_fetch_array($rs_kurs);

 	// 	$adtprice = (int)$row_airlines['adt_price'] * $row_kurs['jual'];
 	// }
 		$query_flight = "SELECT * FROM airlines WHERE id=".$row_airlines['airlines_id'];
 		$rs_flight=mysqli_query($con,$query_flight);
 		$row_flight = mysqli_fetch_array($rs_flight);
 		echo "<option value='".$row_airlines['airlines_id'] ."-".$row_airlines['flight_type']."-".$row_airlines['adt_price']."'>".$row_flight['nama'] ." - ".$row_airlines['flight_type']."</option>";
 	}
 	echo"</select>
 	</div>";
 }
 

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();


 	});

 </script>
