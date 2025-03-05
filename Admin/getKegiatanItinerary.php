 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['cityCount'];
 $countKegiatan = $_POST['countKegiatan'];
 $city = $_POST['city'];

 $tempCountKegiatan = $countKegiatan + 1;

echo "<input type='text'  name='cityCount' id='cityCount' value='".$_POST['count']."' hidden>";
 	$querykegiatan = "SELECT * FROM kegiatan_itinerary2";
 	$rskegiatan=mysqli_query($con,$querykegiatan);
 	echo"<div name='kegiatan".$count.$countKegiatan."' id='kegiatan".$count.$countKegiatan."' style='margin-bottom:10px;'>
 	<label>Input Nama Tempat &  Pilih Kegiatan ".$city." ".$tempCountKegiatan."</label></br>
 	<input type='text' name='kegiatanKota".$count.$countKegiatan."' id='kegiatanKota".$count.$countKegiatan."' placeholder='Input Nama Tempat'>
 	<select class='chosen' name='kegiatanA".$count.$countKegiatan."' id='kegiatanA".$count.$countKegiatan."' onchange='cekKegiatan(".$count.",".$countKegiatan.",this.value)'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowkegiatan = mysqli_fetch_array($rskegiatan)){
 		if($rowkegiatan['id']==1 OR $rowkegiatan['id']==3 OR $rowkegiatan['id']==4){
 			echo "<option value='".strtoupper($city)." ".$rowkegiatan['name']."'>".strtoupper($city)." ".$rowkegiatan['name']."</option>";
 		}elseif($rowkegiatan['id']==21){
 			echo "<option value='".$rowkegiatan['name']." ".$city."'>".$rowkegiatan['name']." ".$city."</option>";
 		}else{
 			echo "<option value='".$rowkegiatan['name']."'>".$rowkegiatan['name']."</option>";
 		}
 		
 	}
 	echo"</select><i class='fa fa-minus' style='color:green;position:absolute;text-align: center;' onclick='deleteKegiatan(".$count.",".$countKegiatan.")' aria-hidden='true'></i>
 	<div class='form-group' name'divothers".$count.$countKegiatan."' id='divothers".$count.$countKegiatan."' style='margin-top:5px;'>
 		<label>Others</label>
 		<textarea maxlength='300' name='others".$count.$countKegiatan."' id='others".$count.$countKegiatan."' style='width:100%'></textarea>
 	</div>
 	</div>";

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 		count = <?php echo $_POST['cityCount']; ?>;
 		countKegiatan = <?php echo $_POST['countKegiatan']; ?>;
 		$("#divothers"+count+countKegiatan).hide();
 		$("#others"+count+countKegiatan).hide();


 	});

 	function cekKegiatan(x,y,z){
 		if(z=='OTHERS'){
 			$("#divothers"+x+y).show();
 			$("#others"+x+y).show();
 		}else{
 			$("#divothers"+x+y).hide();
 			$("#others"+x+y).hide();
 		}
 		
 	}
 	
 	function deleteKegiatan(x,y){
 		var tempCount = parseInt($("input[name=countKegiatan"+x+"]").val()) - 1;
 		$('#kegiatan'+x+y).remove(); 
 		$("input[name=countKegiatan"+x+"]").val(tempCount);

 		 //alert($("input[name=tb]").val());
 		
 	}

 </script>
