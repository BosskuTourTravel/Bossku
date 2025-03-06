<?php
include "../site.php";
include "../db=connection.php";
	if($_POST['tipe']==1){
		$tempString = "availableTagsB".$_POST['count'];
	}else{
		$tempString = "availableTagsP".$_POST['count'];
	}
	
	echo "<tr name='r".$_POST['tipe'].$_POST['count']."' id='r".$_POST['tipe'].$_POST['count']."'>
	<td>
	<input type='text' name='available".$_POST['tipe']."".$_POST['count']."' id='available".$_POST['tipe']."".$_POST['count']."' value='".$tempString."' hidden>
	<div>
	<label>Date</label>
	<input class='form-control' class='form-control' type='text' name='datefilter".$_POST['tipe']."".$_POST['count']."1' id='datefilter".$_POST['tipe']."".$_POST['count']."1' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>

	<td>
	<div>
	<label>Airlines</label>";
	$queryairlines = "SELECT * FROM airlines";
	$rsairlines=mysqli_query($con,$queryairlines);
	echo "<select class='chosen' name='airlines_pil".$_POST['tipe']."".$_POST['count']."' id='airlines_pil".$_POST['tipe']."".$_POST['count']."' style='width: 100%;'>
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
	<input class='form-control' type='text' name='code_airlines".$_POST['tipe']."".$_POST['count']."' id='code_airlines".$_POST['tipe']."".$_POST['count']."' value='' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>From</label>
	<input class='form-control' type='text' onkeyup='getFromTransit(this.value,".$_POST['tipe'].",".$_POST['count'].")' name='tags".$_POST['tipe']."".$_POST['count']."1' id='tags".$_POST['tipe']."".$_POST['count']."1' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div >
	<label>To</label>
	<input class='form-control' type='text' onkeyup='getToTransit(this.value,".$_POST['tipe'].",".$_POST['count'].")' name='tags".$_POST['tipe']."".$_POST['count']."2' id='tags".$_POST['tipe']."".$_POST['count']."2' value='".$dateNow."' style='height:2%;'/>
	</div>
	</td>
	<td>
	<div>
	<label>Time</label>
	<input class='form-control' type='text' name='time".$_POST['tipe']."".$_POST['count']."' id='time".$_POST['tipe']."".$_POST['count']."' value='00:00-00:00' style='height:2%;'/>
	</div>
	</td>
	<td>
	<i class='fa fa-minus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='deleteTransit(".$_POST['tipe'].",".$_POST['count'].")' aria-hidden='true'></i>
	
	<input type='text' name='transitType".$_POST['tipe']."".$_POST['count']."' id='transitType".$_POST['tipe']."".$_POST['count']."' value='".$_POST['tipe']."' hidden>
	</td>
	</tr>";

?>

<script>
 	$(document).ready(function(){

	var nametype = <?php echo $_POST['tipe']; ?>;
	var namecount = <?php echo $_POST['count']; ?>;

	var availableTags = [];
 		$(".chosen").chosen();
 		$('input[name="datefilter'+nametype+namecount+'1"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

 });

 	function deleteTransit(x,y){
 		var tempCount = parseInt($("input[name=tb]").val()) - 1;
 		$('#r'+x+y).remove(); 
 		 $("input[name=tb]").val(tempCount);

 		 //alert($("input[name=tb]").val());
 		
 	}


 	function getFromTransit(x,y,z){

 		$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
 			var i=0;
 			for(i=0;i<data.length;i++){
 				availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
 			}

 		});

 		$( "#tags"+y+z+"1" ).autocomplete({
 			source: availableTags
 		});

 	}

 	function getToTransit(x,y,z){

 		$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
 			var i=0;
 			for(i=0;i<data.length;i++){
 				availableTags2[i]=data[i].PlaceName  + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
 			}

 		});

 		$( "#tags"+y+z+"2" ).autocomplete({
 			source: availableTags2
 		});

 	}  

 	function getFrom2(x){

 		$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
 			var i=0;
 			availableTags = [];
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
 			availableTags2 = [];
 			for(i=0;i<data.length;i++){
 				availableTags4[i]=data[i].PlaceName  + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
 			}
 			
 		});



 		$( "#tags4" ).autocomplete({
 			source: availableTags4
 		});

 	}  

 </script>