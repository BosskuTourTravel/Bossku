 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];
 $id = $_POST['id'];
 $id_count = $_POST['id_count'];

 for ($x = 1; $x <= $count; $x++){
 	$querycity = "SELECT * FROM city WHERE country=".$id;
 	$rscity=mysqli_query($con,$querycity);
 	echo"</select>
 	<select class='chosen' name='city".$id_count.$x."' id='city".$id_count.$x."' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowcity = mysqli_fetch_array($rscity)){
 		echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
 	}
 	echo"</select>";
 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>
