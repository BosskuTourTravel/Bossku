 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];

echo "<input type='text' class='form-control' name='cityCount' id='cityCount' value='".$_POST['count']."' hidden>";
 for ($x = 1; $x <= $count; $x++){
 	$querycity = "SELECT * FROM city";
 	$rscity=mysqli_query($con,$querycity);
 	echo"<div class=form-group' style='margin-bottom:10px;'>
 	<label>City ".$x."</label>
 	<select class='chosen' name='cityA".$x."' id='cityA".$x."'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowcity = mysqli_fetch_array($rscity)){
 		echo "<option value='".$rowcity['name']."'>".$rowcity['name']."</option>";
 	}
 	echo"</select>";

 	$querykegiatan = "SELECT * FROM kegiatan_itinerary";
 	$rskegiatan=mysqli_query($con,$querykegiatan);
 	echo"
 	<label>Tipe Kegiatan ".$x."</label>
 	<select class='chosen' name='kegiatanDay".$x."' id='kegiatanDay".$x."'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowkegiatan = mysqli_fetch_array($rskegiatan)){
 		if($rowkegiatan['id']==1 OR $rowkegiatan['id']==3 OR $rowkegiatan['id']==4){
 			echo "<option value='".$rowkegiatan['name']."'>".$rowkegiatan['name']."</option>";
 		}
 		
 	}
 	echo"</select><i class='fa fa-plus' style='color:green;position:absolute;text-align: center;' onclick='getKegiatan(".$x.")' aria-hidden='true'></i>";
 	echo "<input type='text' name='countKegiatan".$x."' id='countKegiatan".$x."' value=0 hidden>

 	</div>
 	<div id='divKegiatan".$x."'></div>";

 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();


 	});
 	function getKegiatan(y){
 		var cityCount = y;
 		var kegiatanCount = $("input[name=countKegiatan"+y+"]").val();
 		var city = document.getElementById("cityA"+y).options[document.getElementById("cityA"+y).selectedIndex].value;
 		var tempCount = parseInt($("input[name=countKegiatan"+y+"]").val()) + 1;
 		var kegiatanDay = document.getElementById("kegiatanDay"+y).options[document.getElementById("kegiatanDay"+y).selectedIndex].value;
 		if(city==0 || kegiatanDay==0){
 			alert('Wajib Pilih Kota dan Tipe Kegiatan Terlebih Dahulu');
 		}else{
 			$.ajax({
 				type:'POST',
 				url:'getKegiatanItinerary.php',
 				data:{'city':city,'cityCount':cityCount,'countKegiatan':kegiatanCount},
 				success:function(data){
 					$('#divKegiatan'+y).append(data);
 					$("input[name=countKegiatan"+y+"]").val(tempCount);
 				}
 			});
 		}
 		
 	}
 	

 </script>
