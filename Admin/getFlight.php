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
      var tour_name = $("input[name=tour_name]").val();
      var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
      var pnr = $("input[name=pnr]").val();
      var adt_pax = $("input[name=adt_pax]").val();
      var chd_pax = $("input[name=chd_pax]").val();
      var inf_pax = $("input[name=inf_pax]").val();
      var kurs_price = document.getElementById("kurs_price").options[document.getElementById("kurs_price").selectedIndex].value;
      var kurs_tax = document.getElementById("kurs_tax").options[document.getElementById("kurs_tax").selectedIndex].value;
      var adt_price = $("input[name=adt_price]").val();
      var chd_price = $("input[name=chd_price]").val();
      var inf_price = $("input[name=inf_price]").val();
      var selling_adt_price = $("input[name=selling_adt_price]").val();
      var selling_chd_price = $("input[name=selling_chd_price]").val();
      var selling_inf_price = $("input[name=selling_inf_price]").val();
      var tax_adt_price = $("input[name=tax_adt_price]").val();
      var tax_chd_price = $("input[name=tax_chd_price]").val();
      var tax_inf_price = $("input[name=tax_inf_price]").val();
      var status_penalty = document.getElementById("status_penalty").options[document.getElementById("status_penalty").selectedIndex].value;
      var penalty_pax = $("input[name=penalty_pax]").val();
      var adm_penalty = $("input[name=adm_penalty]").val();
      var deposit_pax_amount = $("input[name=deposit_pax_amount]").val();
      var deposit_total_pax = $("input[name=deposit_total_pax]").val();
      var total_seat = $("input[name=total_seat]").val();

      var date=new Date($('input[name="datefilterx"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var date2=new Date($('input[name="datefilterx2"]').val());
      var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
      var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
      var year2 = date2.getFullYear();

      var date3=new Date($('input[name="datefilterx3"]').val());
      var month3 = ((date3.getMonth()+1)<10) ? "0" + (date3.getMonth()+1) : (date3.getMonth()+1);
      var day3 = (date3.getDate() < 10) ? "0" + date3.getDate() : date3.getDate();
      var year3 = date3.getFullYear();

      var tdate = year + "-" + month + "-" + day;
      var tdate2 = year2 + "-" + month2 + "-" + day2;
      var tdate3 = year3 + "-" + month3 + "-" + day3;

      var tags7 = $("input[name=tags7]").val();
      var tags8 = $("input[name=tags8]").val();
      var find = tags7.indexOf("(");
      var find2 = tags8.indexOf("(");
      var destination_fromx = tags7.substring(0,find-1);
      var destination_tox = tags8.substring(0,find2-1);


      fd.append('airlines',airlines);
      fd.append('tour_name',tour_name);
      fd.append('flight_type',flight_type);
      fd.append('pnr',pnr);
      fd.append('adm_penalty',adm_penalty);
      fd.append('adt_pax',adt_pax);
      fd.append('chd_pax',chd_pax);
      fd.append('inf_pax',inf_pax);
      fd.append('kurs_price',kurs_price);
      fd.append('kurs_tax',kurs_tax);
      fd.append('adt_price',adt_price);
      fd.append('chd_price',chd_price);
      fd.append('inf_price',inf_price);
      fd.append('selling_adt_price',selling_adt_price);
      fd.append('selling_chd_price',selling_chd_price);
      fd.append('selling_inf_price',selling_inf_price);
      fd.append('tax_adt_price',tax_adt_price);
      fd.append('tax_chd_price',tax_chd_price);
      fd.append('tax_inf_price',tax_inf_price);
      fd.append('status_penalty',status_penalty);
      fd.append('penalty_pax',penalty_pax);
      fd.append('deposit_pax_amount',deposit_pax_amount);
      fd.append('deposit_total_pax',deposit_total_pax);
      fd.append('total_seat',total_seat);
      fd.append('tdate',tdate);
      fd.append('tdate2',tdate2);
      fd.append('tdate3',tdate3);
      fd.append('destination_fromx',destination_fromx);
      fd.append('destination_tox',destination_tox);


      var type = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
      fd.append('type',type);
      if(type==0){
        var airlines = document.getElementById("flight_invoice").options[document.getElementById("flight_invoice").selectedIndex].value;
        var countDetail = $("input[name=countDetail]").val();
        
      }else if(type==2){

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
          url: 'insertFlight.php',
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
          url: 'insertFlight.php',
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