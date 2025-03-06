<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
	
	$count = $_POST['count'];

	for($x=0; $x < $count; $x++){
		echo "
		<div class='form-row align-items-center'>
		<div class='col-3'>
		<label>From</label>
		<input class='form-control' type='text' onkeyup='getFromTransit(this.value,".$x.")' name='tags1".$x."' id='tags1".$x."' style='height:2%;'/>
		</div>
		<div class='col-3'>
		<label>To</label>
		<input class='form-control' type='text' onkeyup='getToTransit(this.value,".$x.")' name='tags2".$x."' id='tags2".$x."'  style='height:2%;'/>
		</div>
		<div class='col-3'>
		<label>Price</label>
		<input class='form-control' type='text' name='price".$x."' id='price".$x."' value='".$dateNow."' style='height:2%;'/>
		</div>

		</div>";
	}

?>

<script>
 	$(document).ready(function(){

	var namecount = <?php echo $_POST['count']; ?>;

	var availableTags = [];
 		$(".chosen").chosen();;

 });


 	function getFromTransit(x,y){

 		$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
 			var i=0;
 			for(i=0;i<data.length;i++){
 				availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
 			}

 		});

 		$( "#tags1"+y ).autocomplete({
 			source: availableTags
 		});

 	}

 	function getToTransit(x,y){

 		$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
 			var i=0;
 			for(i=0;i<data.length;i++){
 				availableTags[i]=data[i].PlaceName  + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
 			}

 		});

 		$( "#tags2"+y ).autocomplete({
 			source: availableTags
 		});

 	}  

 	

 </script>