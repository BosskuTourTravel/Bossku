 <?php
 include "../site.php";
 include "../db=connection.php";
 $id = $_POST['id'];

 // $query_flight = "SELECT * FROM flight_quotation WHERE id=".$id;
 // $rs_flight=mysqli_query($con,$query_flight);
 // $row_flight = mysqli_fetch_array($rs_flight);

 // $temp_kurs_price = $row_flight['kurs_price'];
 // $temp_adt_price = $row_flight['adt_price'];
 // $temp_chd_price = $row_flight['chd_price'];
 // $temp_inf_price = $row_flight['inf_price'];
 // $temp_kurs_tax = $row_flight['kurs_tax'];
 // $temp_adt_tax = $row_flight['adt_tax'];
 // $temp_chd_tax = $row_flight['chd_tax'];
 // $temp_inf_tax = $row_flight['inf_tax'];
 // echo "<input type='text' name='tkurs_price' id='tkurs_price' value='".$temp_kurs_price."' hidden>";
 // echo "<input type='text' name='tadt_price' id='tadt_price' value='".$temp_adt_price."' hidden>";
 // echo "<input type='text' name='tchd_price' id='tchd_price' value='".$temp_chd_price."' hidden>";
 // echo "<input type='text' name='tinf_price' id='tinf_price' value='".$temp_inf_price."' hidden>";
 // echo "<input type='text' name='tkurs_tax' id='tkurs_tax' value='".$temp_kurs_tax."' hidden>";
 // echo "<input type='text' name='tadt_tax' id='tadt_tax' value='".$temp_adt_tax."' hidden>";
 // echo "<input type='text' name='tchd_tax' id='tchd_tax' value='".$temp_chd_tax."' hidden>";
 // echo "<input type='text' name='tinf_tax' id='tinf_tax' value='".$temp_inf_tax."' hidden>";

 $query_count = "SELECT COUNT(*) as total FROM flight_quotation_detail WHERE flight_quotation_id=".$id;
 $rs_count=mysqli_query($con,$query_count);
 $row_count = mysqli_fetch_array($rs_count);

 echo "<input type='text' name='countDetail' id='countDetail' value='".$row_count['total']."' hidden>";
 echo "<input type='text' name='quotationID' id='quotationID' value='".$id."' hidden>";

 $query_flightquotation = "SELECT * FROM flight_quotation_detail WHERE flight_quotation_id=".$id;
 $rs_flightquotation=mysqli_query($con,$query_flightquotation);
 $counQuotation = 0;

 echo "<table id='dtBasicExample' class='tableFixHead table-striped table-bordered table-sm' style='font-size:14px;'>";
 while($row_flightquotation = mysqli_fetch_array($rs_flightquotation)){
 	echo "<tr>";
 	echo "<td>`
 	<label>Day</label>
 	<input type='text' size='1' name='dayQuotation".$counQuotation."' id='dayQuotation".$counQuotation."' placeholder='01 / 12'></td>";
 	$query_month = "SELECT * FROM month";
 	$rs_month=mysqli_query($con,$query_month);

 	echo "<td>
 	<label>Month</label></br>
 	<select class='chosen' name='QuotationMonth".$counQuotation."' id='QuotationMonth".$counQuotation."'>
 	<option selected='selected' value=0>Pilihan</option>";
 	while($row_month = mysqli_fetch_array($rs_month)){
 		$tempMonth = substr($row_month['name'],0,3);
 		echo "<option value='".$tempMonth."'>".$tempMonth."</option>";
 	}

 	echo"</select></td>";

 	echo "<td>
 	<label>Detail Flight</label></br>
 	".$row_flightquotation['airlines'].$row_flightquotation['airlines_code']." ".$row_flightquotation['from'].$row_flightquotation['to']." ".$row_flightquotation['departure_time']." ".$row_flightquotation['arrival_time']."</td>";
 	echo "</tr>";
 	$counQuotation = $counQuotation + 1;
 }
 echo "</table>";
 echo "<center></br><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center>";

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>
