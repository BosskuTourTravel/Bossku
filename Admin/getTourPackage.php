 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];

 for ($x = 1; $x <= $count; $x++){
 	$querycity = "SELECT * FROM tour_package";
 	$rscity=mysqli_query($con,$querycity);
 	echo"</select>
 	<select class='chosen' name='tourPackage".$x."' id='tourPackage".$x."' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowcity = mysqli_fetch_array($rscity)){
 		echo "<option id=tourPackage".$x." value=".$rowcity['id'].">".$rowcity['tour_name']."</option>";
 	}
 	echo"</select>";
 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>
