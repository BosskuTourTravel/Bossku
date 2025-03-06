 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];
 $id = $_POST['id'];


 	$queryp = "SELECT * FROM passport WHERE id=".$id;
 	$rsp=mysqli_query($con,$queryp);

 	echo"<label>Price</label>
 	<select class='chosen' name='price' id='price' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowp = mysqli_fetch_array($rsp)){
 		echo "<option value=".$rowp['price'].">".$rowp['day']." days / ".$rowp['price']."</option>";
 	}
 	echo"</select>";
 

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>
