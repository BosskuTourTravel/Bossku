<?php
include "../site.php";
include "../db=connection.php";

echo "<table class='table class='table-striped table-bordered table-sm' style='margin-top:1%;margin-left:1%;'>";
if($_POST['count']==1){
	echo "<tr>
	
	<td>
	<div>
	<label>Depart</label>
	<input class='form-control' class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>

	<td>
	<div>
	<label>Airlines</label>";
	$queryairlines = "SELECT * FROM airlines";
	$rsairlines=mysqli_query($con,$queryairlines);
	echo "<select class='chosen' name='airlines_pil' id='airlines_pil' style='width: 100%;'>
	<option selected='selected' value=0>Pilihan</option>";
	while($rowairlines = mysqli_fetch_array($rsairlines)){
		echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
	}

	echo"</select>

	</div>
	</td>
	<td>
	<div>
	<label>Code Airlines</label>
	<input class='form-control' type='text' name='code_airlines' id='code_airlines' value='' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>From</label>
	<input class='form-control' type='text' onkeyup='getFrom(this.value)' name='tags' id='tags' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div >
	<label>To</label>
	<input class='form-control' type='text' onkeyup='getTo(this.value)' name='tags2' id='tags2' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Time</label>
	<input class='form-control' type='text' name='time' id='time' value='00:00-00:00' style='height:2%;'/>
	</div>
	</td>
	<td>
	<i class='fa fa-plus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='getTransit(1)' aria-hidden='true'></i>
	</td>
	</tr>
	<td colspan='7'>
	<div id='divberangkat'>

	</div>
	</td>
	<tr>

	<td>
	<div>
	<label>Return</label>
	<input class='form-control' class='form-control' type='text' name='datefilter6' id='datefilter6' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Airlines</label>";
	$queryairlines = "SELECT * FROM airlines";
	$rsairlines=mysqli_query($con,$queryairlines);
	echo "<select class='chosen' name='airlines_pil2' id='airlines_pil2' style='width: 100%;'>
	<option selected='selected' value=0>Pilihan</option>";
	while($rowairlines = mysqli_fetch_array($rsairlines)){
		echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
	}

	echo"</select>

	</div>
	</td>
	<td>
	<div>
	<label>Code Airlines</label>
	<input class='form-control' type='text' name='code_airlines2' id='code_airlines2' value='' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>From</label>
	<input class='form-control' type='text' onkeyup='getFrom2(this.value)' name='tags3' id='tags3' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div >
	<label>To</label>
	<input class='form-control' type='text' onkeyup='getTo2(this.value)' name='tags4' id='tags4' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Time</label>
	<input class='form-control' type='text' name='time2' id='time2' value='00:00-00:00' style='height:2%;'/>
	</div>
	</td>
	<td>
	<i class='fa fa-plus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='getTransit(2)' aria-hidden='true'></i>
	</td>
	</tr>
	<td colspan='7'>
	<div id='divpulang'>

	</div>
	</td>
	</tr>
	
	";
}elseif($_POST['count']==2){
	echo "<tr>
	
	<td>
	<div>
	<label>Depart</label>
	<input class='form-control' class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Return</label>
	<input class='form-control' type='text' value='One Way' style='height:2%;' disabled/>
	</div>
	</td>
	<td>
	<div>
	<label>Airlines</label>";
	$queryairlines = "SELECT * FROM airlines";
	$rsairlines=mysqli_query($con,$queryairlines);
	echo "<select class='chosen' name='airlines_pil' id='airlines_pil' style='width: 100%;'>
	<option selected='selected' value=0>Pilihan</option>";
	while($rowairlines = mysqli_fetch_array($rsairlines)){
		echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
	}

	echo"</select>

	</div>
	</td>
	<td>
	<div>
	<label>Code Airlines</label>
	<input class='form-control' type='text' name='code_airlines' id='code_airlines' value='' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>From</label>
	<input class='form-control' type='text' onkeyup='getFrom(this.value)' name='tags' id='tags' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div >
	<label>To</label>
	<input class='form-control' type='text' onkeyup='getTo(this.value)' name='tags2' id='tags2' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Time</label>
	<input class='form-control' type='text' name='time2' id='time2' value='00:00-00:00' style='height:2%;'/>
	</div>
	</td>
	</tr>";

}else{
	echo "<tr>
	
	<td>
	<div>
	<label>Depart</label>
	<input class='form-control' class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>

	<td>
	<div>
	<label>Airlines</label>";
	$queryairlines = "SELECT * FROM airlines";
	$rsairlines=mysqli_query($con,$queryairlines);
	echo "<select class='chosen' name='airlines_pil' id='airlines_pil' style='width: 100%;'>
	<option selected='selected' value=0>Pilihan</option>";
	while($rowairlines = mysqli_fetch_array($rsairlines)){
		echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
	}

	echo"</select>

	</div>
	</td>
	<td>
	<div>
	<label>Code Airlines</label>
	<input class='form-control' type='text' name='code_airlines' id='code_airlines' value='' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>From</label>
	<input class='form-control' type='text' onkeyup='getFrom(this.value)' name='tags' id='tags' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>To</label>
	<input class='form-control' type='text' onkeyup='getTo(this.value)' name='tags2' id='tags2' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Time</label>
	<input class='form-control' type='text' name='time' id='time' value='00:00-00:00' style='height:2%;'/>
	</div>
	<td>
	<i class='fa fa-plus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='getTransit(1)' aria-hidden='true'></i>
	</td>
	</tr>
	<td colspan='7'>
	<div id='divberangkat'>
	
	</div>
	</td>
	<tr>
	

	<td>
	<div>
	<label>Return</label>
	<input class='form-control' class='form-control' type='text' name='datefilter6' id='datefilter6' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Airlines</label>";
	$queryairlines = "SELECT * FROM airlines";
	$rsairlines=mysqli_query($con,$queryairlines);
	echo "<select class='chosen' name='airlines_pil2' id='airlines_pil2' style='width: 100%;'>
	<option selected='selected' value=0>Pilihan</option>";
	while($rowairlines = mysqli_fetch_array($rsairlines)){
		echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
	}

	echo"</select>

	</div>
	</td>
	<td>
	<div>
	<label>Code Airlines</label>
	<input class='form-control' type='text' name='code_airlines2' id='code_airlines2' value='' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>From</label>
	<input class='form-control' type='text' onkeyup='getFrom2(this.value)' name='tags3' id='tags3' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div >
	<label>To</label>
	<input class='form-control' type='text' onkeyup='getTo2(this.value)' name='tags4' id='tags4' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Time</label>
	<input class='form-control' type='text' name='time2' id='time2' value='00:00-00:00' style='height:2%;'/>
	</div>
	</td>
	<td>
	<i class='fa fa-plus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='getTransit(2)' aria-hidden='true'></i>
	</td>
	</tr>
	<td colspan='7'>
	<div id='divpulang'>
	
	</div>
	</td>
	</tr>";
}
echo "</table><center></br><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center>";

?>

<script>
	var availableTags = [];
	var availableTags2 = [];
	var availableTags3 = [];
	var availableTags4 = [];
	$(document).ready(function(){
		$(".chosen").chosen();
		$('input[name="datefilter3"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		});
		$('input[name="datefilter4"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		});
		$('input[name="datefilter5"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		});
		$('input[name="datefilter6"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		});

		$("#but_upload").click(function(){
			var fd = new FormData();
			const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
			"JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
			];

			var airlines = document.getElementById("airlines").options[document.getElementById("airlines").selectedIndex].value;
			var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;
			var adt_price = $("input[name=adt_price]").val();
			var chd_price = $("input[name=chd_price]").val();
			var inf_price = $("input[name=inf_price]").val();
			var tax_adt_price = $("input[name=tax_adt_price]").val();
			var tax_chd_price = $("input[name=tax_chd_price]").val();
			var tax_inf_price = $("input[name=tax_inf_price]").val();
			var kurs_price = document.getElementById("kurs_price").options[document.getElementById("kurs_price").selectedIndex].value;
			var kurs_tax = document.getElementById("kurs_tax").options[document.getElementById("kurs_tax").selectedIndex].value;
			var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
			var flight_category = document.getElementById("flight_category").options[document.getElementById("flight_category").selectedIndex].value;
			var country_to = document.getElementById("country_tos").options[document.getElementById("country_tos").selectedIndex].value;
			var city_from = document.getElementById("city_froms").options[document.getElementById("city_froms").selectedIndex].value;
			var city_to = document.getElementById("city_tos").options[document.getElementById("city_tos").selectedIndex].value;
			var city_out = document.getElementById("city_outs").options[document.getElementById("city_outs").selectedIndex].value;
			var total_seat = $("input[name=total_seat]").val();
			var total_foc = $("input[name=total_foc]").val();
			var tax_foc = $("input[name=tax_foc]").val();

      //var date = $("textarea[name=editordata]").val();

      var remarks = $("textarea[name=editordata]").val();
      fd.append('remarks',remarks);
      var from = $("input[name=tags7]").val();
      var to = $("input[name=tags8]").val();
      var out = $("input[name=tags9]").val();
      if(from!=''){
      	var n_from = from.indexOf("-")+1;
      	var len_from = from.length;
      	var from_fix = from.substring(n_from, len_from);
      }else{
      	var from_fix = '';
      }
      if(to!=''){
      	var n_to = to.indexOf("-")+1;
      	var len_to = to.length;
      	var to_fix = to.substring(n_to, len_to);
      }else{
      	var to_fix = '';
      }
      
      if(out!=''){
      	var n_out = out.indexOf("-")+1;
      	var len_out = out.length;
      	var out_fix = out.substring(n_out, len_out);
      }else{
      	var out_fix = '';
      }

      // var ct1 = 0;
      // var ct2 = 0;
      // var ct3 = 0;
      // var ct4 = 0;
      // var ct5 = 0;
      // var ct6 = 0;

      // if ($('input[name=category1]').is(':checked')) {
      //   ct1 = 1;
      // }
      // if ($('input[name=category2]').is(':checked')) {
      //   ct2 = 1;
      // }
      // if ($('input[name=category3]').is(':checked')) {
      //   ct3 = 1;
      // }
      // if ($('input[name=category4]').is(':checked')) {
      //   ct4 = 1;
      // }
      // if ($('input[name=category5]').is(':checked')) {
      //   ct5 = 1;
      // }
      // if ($('input[name=category6]').is(':checked')) {
      //   ct6 = 1;
      // }
      // fd.append('ct1',ct1);
      // fd.append('ct2',ct2);
      // fd.append('ct3',ct3);
      // fd.append('ct4',ct4);
      // fd.append('ct5',ct5);
      // fd.append('ct6',ct6);

      var itinerary_category_arrival = document.getElementById("itinerary_category_arrival").options[document.getElementById("itinerary_category_arrival").selectedIndex].value;
      var itinerary_category_departure = document.getElementById("itinerary_category_departure").options[document.getElementById("itinerary_category_departure").selectedIndex].value;
      fd.append('itinerary_category_arrival',itinerary_category_arrival);
      fd.append('itinerary_category_departure',itinerary_category_departure);
      

      if(airlines==8){
      	if(chd_price==0){
      		chd_price = adt_price * 80 / 100;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 10 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }else if(airlines==25){
      	if(chd_price==0){
      		chd_price = adt_price * 85 / 100;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 10 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }else if(airlines==24){
      	if(chd_price==0){
      		chd_price = adt_price;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 20 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }else if(airlines==4 || airlines == 5){
      	if(chd_price==0){
      		chd_price = adt_price;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 10 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }else if(airlines==17){
      	if(chd_price==0){
      		chd_price = adt_price;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 10 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }else if(airlines==12){
      	if(chd_price==0){
      		chd_price = adt_price;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 20 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }else if(airlines==32){
      	if(chd_price==0){
      		chd_price = adt_price;
      		tax_chd_price = tax_adt_price;
      	}
      	if(inf_price==0){
      		inf_price = adt_price * 20 / 100;
      		tax_inf_price = tax_adt_price;
      	}
      }

      fd.append('airlines',airlines);
      fd.append('type_price',type_price);
      fd.append('adt_price',adt_price);
      fd.append('chd_price',chd_price);
      fd.append('inf_price',inf_price);
      fd.append('tax_adt_price',tax_adt_price);
      fd.append('tax_chd_price',tax_chd_price);
      fd.append('tax_inf_price',tax_inf_price);
      fd.append('kurs_price',kurs_price);
      fd.append('kurs_tax',kurs_tax);
      fd.append('flight_type',flight_type);
      fd.append('flight_category',flight_category);
      fd.append('country_to',country_to);
      fd.append('city_from',city_from);
      fd.append('city_to',city_to);
      fd.append('city_out',city_out);
      fd.append('total_seat',total_seat);
      fd.append('total_foc',total_foc);
      fd.append('tax_foc',tax_foc);
      //fd.append('date',date);
      fd.append('from_fix',from_fix);
      fd.append('to_fix',to_fix);
      fd.append('out_fix',out_fix);

      for (i = 0; i < 2; i++) {
      	for (j = 1; j <= 12; j++) {
      		
      		if(i==0){
      			var iDate = $("input[name='datea"+i+j+"']").val();
      			var iDate2 = $("input[name='datea2"+i+j+"']").val();
      			var tempDate = iDate + " " + iDate2;
      		}else{
      			var iDate = $("input[name='dateb"+i+j+"']").val();
      			var iDate2 = $("input[name='dateb2"+i+j+"']").val();
      			var tempDate = iDate + " " + iDate2;
      		}
      		if(iDate!=''){
            // alert(tempDate+" - "+i+j);
            fd.append('date'+i+j,tempDate);
        }else{
        	fd.append('date'+i+j,'');
        }
        
    }

}


var type = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
fd.append('type',type);

if(type==2){

	var date=new Date($('input[name="datefilter3"]').val());
	var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
	var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
	var year = date.getFullYear();

	var airlines_pil = document.getElementById("airlines_pil").options[document.getElementById("airlines_pil").selectedIndex].value;
	var airlines_code = $("input[name=code_airlines]").val();
	var tags = $("input[name=tags]").val();
	var tags2 = $("input[name=tags2]").val();
	var time2 = $("input[name=time2]").val();

	var res = time2.split("-");


	var departure_time = res[0].replace(':','');
	var arrival_time = res[1].replace(':','');
	var n = tags.indexOf("-")+1;
	var len = tags.length;
	var from = tags.substring(n, len);
	var n2 = tags2.indexOf("-")+1;
	var len2 = tags2.length;
	var to = tags2.substring(n2, len2);

	var find = tags.indexOf("(");
	var find2 = tags2.indexOf("(");
	var destination_from = tags.substring(0,find-1);
	var destination_to = tags2.substring(0,find2-1);

	var flight_date = day+monthNames[date.getMonth()];


	fd.append('flight_date',flight_date);
	fd.append('airlines_pil',airlines_pil);
	fd.append('airlines_code',airlines_code);
	fd.append('from',from);
	fd.append('to',to);
	fd.append('destination_from',destination_from);
	fd.append('destination_to',destination_to);
	fd.append('departure_time',departure_time);
	fd.append('arrival_time',arrival_time);

	$.ajax({
		url: 'insertFlightQuotation.php',
		type: 'post',
		data: fd,
		contentType: false,
		processData: false,
		success: function(response){
			if(response=="success"){
				alert(response);
				reloadManual(1,0,0);
			}else{
				alert(response);
			}

		},
	});

}else{

	var counttb = $("input[name=tb]").val();
	var counttp = $("input[name=tp]").val();

	fd.append('counttb',counttb);
	fd.append('counttp',counttp);

	var date=new Date($('input[name="datefilter3"]').val());
	var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
	var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
	var year = date.getFullYear();

	var airlines_pil = document.getElementById("airlines_pil").options[document.getElementById("airlines_pil").selectedIndex].value;
	var airlines_code = $("input[name=code_airlines]").val();
	var tags = $("input[name=tags]").val();
	var tags2 = $("input[name=tags2]").val();
	var time = $("input[name=time]").val();

	var res = time.split("-");


	var departure_time = res[0].replace(':','');
	var arrival_time = res[1].replace(':','');
	var n = tags.indexOf("-")+1;
	var len = tags.length;
	var from = tags.substring(n, len);
	var n2 = tags2.indexOf("-")+1;
	var len2 = tags2.length;
	var to = tags2.substring(n2, len2);

	var find = tags.indexOf("(");
	var find2 = tags2.indexOf("(");
	var destination_from = tags.substring(0,find-1);
	var destination_to = tags2.substring(0,find2-1);

	var flight_date = day+monthNames[date.getMonth()];

	fd.append('flight_date',flight_date);
	fd.append('airlines_pil',airlines_pil);
	fd.append('airlines_code',airlines_code);
	fd.append('from',from);
	fd.append('to',to);
	fd.append('destination_from',destination_from);
	fd.append('destination_to',destination_to);
	fd.append('departure_time',departure_time);
	fd.append('arrival_time',arrival_time);

	var date2=new Date($('input[name="datefilter6"]').val());
	var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
	var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
	var year2 = date2.getFullYear();

	var airlines_pil2 = document.getElementById("airlines_pil2").options[document.getElementById("airlines_pil2").selectedIndex].value;
	var airlines_code2 = $("input[name=code_airlines2]").val();
	var tags3 = $("input[name=tags3]").val();
	var tags4 = $("input[name=tags4]").val();
	var time2 = $("input[name=time2]").val();

	var res2 = time2.split("-");
	var departure_time2 = res2[0].replace(':','');
	var arrival_time2 = res2[1].replace(':','');
	var n3 = tags3.indexOf("-")+1;
	var len3 = tags3.length;
	var from2 = tags3.substring(n3, len3);
	var n4 = tags4.indexOf("-")+1;
	var len4 = tags4.length;
	var to2 = tags4.substring(n4, len4);

	var find = tags3.indexOf("(");
	var find2 = tags4.indexOf("(");
	var destination_from2 = tags3.substring(0,find-1);
	var destination_to2 = tags4.substring(0,find2-1);

	var flight_date2 = day2+monthNames[date2.getMonth()];

	fd.append('flight_date2',flight_date2);
	fd.append('airlines_pil2',airlines_pil2);
	fd.append('airlines_code2',airlines_code2);
	fd.append('from2',from2);
	fd.append('to2',to2);
	fd.append('destination_from2',destination_from2);
	fd.append('destination_to2',destination_to2);
	fd.append('departure_time2',departure_time2);
	fd.append('arrival_time2',arrival_time2);

	for (i = 0; i < counttb; i++) {
		var dateb=new Date($('input[name="datefilter1'+i+'1"]').val());
		var monthb = ((dateb.getMonth()+1)<10) ? "0" + (dateb.getMonth()+1) : (dateb.getMonth()+1);
		var dayb = (dateb.getDate() < 10) ? "0" + dateb.getDate() : dateb.getDate();
		var yearb = dateb.getFullYear();
		var transit_typeb = $("input[name=transitType1"+i+"]").val();
		var airlines_pilb = document.getElementById("airlines_pil1"+i).options[document.getElementById("airlines_pil1"+i).selectedIndex].value;
		var airlines_codeb = $("input[name=code_airlines1"+i+"]").val();
		var tagsb = $("input[name=tags1"+i+"1]").val();
		var tags2b = $("input[name=tags1"+i+"2]").val();
		var timeb = $("input[name=time1"+i+"]").val();
		
		var resb = timeb.split("-");


		var departure_timeb = resb[0].replace(':','');
		var arrival_timeb = resb[1].replace(':','');
		var nb = tagsb.indexOf("-")+1;
		var lenb = tagsb.length;
		var fromb = tagsb.substring(nb, lenb);
		var n2b = tags2b.indexOf("-")+1;
		var len2b = tags2b.length;
		var tob = tags2b.substring(n2b, len2b);

		var find = tagsb.indexOf("(");
		var find2 = tags2b.indexOf("(");
		var destination_fromb = tagsb.substring(0,find-1);
		var destination_tob = tags2b.substring(0,find2-1);

		var flight_dateb = dayb+monthNames[dateb.getMonth()];

		fd.append('flight_date1'+i,flight_dateb);
		fd.append('airlines_pil1'+i,airlines_pilb);
		fd.append('airlines_code1'+i,airlines_codeb);
		fd.append('from1'+i,fromb);
		fd.append('to1'+i,tob);
		fd.append('destination_from1'+i,destination_fromb);
		fd.append('destination_to1'+i,destination_tob);
		fd.append('departure_time1'+i,departure_timeb);
		fd.append('arrival_time1'+i,arrival_timeb);
		fd.append('transit_type1'+i,transit_typeb);

	}

	for (i = 0; i < counttp; i++) {
		var dateb=new Date($('input[name="datefilter2'+i+'1"]').val());
		var monthb = ((dateb.getMonth()+1)<10) ? "0" + (dateb.getMonth()+1) : (dateb.getMonth()+1);
		var dayb = (dateb.getDate() < 10) ? "0" + dateb.getDate() : dateb.getDate();
		var yearb = dateb.getFullYear();
		var transit_typeb = $("input[name=transitType2"+i+"]").val();
		var airlines_pilb = document.getElementById("airlines_pil2"+i).options[document.getElementById("airlines_pil2"+i).selectedIndex].value;
		var airlines_codeb = $("input[name=code_airlines2"+i+"]").val();
		var tagsb = $("input[name=tags2"+i+"1]").val();
		var tags2b = $("input[name=tags2"+i+"2]").val();
		var timeb = $("input[name=time2"+i+"]").val();

		var resb = timeb.split("-");


		var departure_timeb = resb[0].replace(':','');
		var arrival_timeb = resb[1].replace(':','');
		var nb = tagsb.indexOf("-")+1;
		var lenb = tagsb.length;
		var fromb = tagsb.substring(nb, lenb);
		var n2b = tags2b.indexOf("-")+1;
		var len2b = tags2b.length;
		var tob = tags2b.substring(n2b, len2b);

		var find = tagsb.indexOf("(");
		var find2 = tags2b.indexOf("(");
		var destination_fromb = tagsb.substring(0,find-1);
		var destination_tob = tags2b.substring(0,find2-1);

		var flight_dateb = dayb+monthNames[dateb.getMonth()];

		fd.append('flight_date2'+i,flight_dateb);
		fd.append('airlines_pil2'+i,airlines_pilb);
		fd.append('airlines_code2'+i,airlines_codeb);
		fd.append('from2'+i,fromb);
		fd.append('to2'+i,tob);
		fd.append('destination_from2'+i,destination_fromb);
		fd.append('destination_to2'+i,destination_tob);
		fd.append('departure_time2'+i,departure_timeb);
		fd.append('arrival_time2'+i,arrival_timeb);
		fd.append('transit_type2'+i,transit_typeb);
	}

	$.ajax({
		url: 'insertFlightQuotation.php',
		type: 'post',
		data: fd,
		contentType: false,
		processData: false,
		success: function(response){
			if(response=="success"){
				alert(response);
				reloadManual(4,0,0);
			}else{
				alert(response);
			}

		},
	});

}
});

});

function getFrom(x){

	$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
		var i=0;
		availableTags = [];
		for(i=0;i<data.length;i++){
			availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
		}

	});



	$( "#tags" ).autocomplete({
		source: availableTags
	});

}

function getTo(x){

	$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
		var i=0;
		availableTags2 = [];
		for(i=0;i<data.length;i++){
			availableTags2[i]=data[i].PlaceName + " - " + data[i].PlaceId;
		}

	});



	$( "#tags2" ).autocomplete({
		source: availableTags2
	});

}  

function getFrom2(x){

	$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
		var i=0;
		availableTags3 = [];
		for(i=0;i<data.length;i++){
			availableTags3[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
		}
		
	});



	$( "#tags3" ).autocomplete({
		source: availableTags3
	});

}

function getTo2(x){

	$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
		var i=0;
		availableTags4 = [];
		for(i=0;i<data.length;i++){
			availableTags4[i]=data[i].PlaceName + " - " + data[i].PlaceId;
		}
		
	});



	$( "#tags4" ).autocomplete({
		source: availableTags4
	});

}  

</script>