<?php
 include "../site.php";
 include "../db=connection.php";

 $transport = $_POST['jenistransport'];
 $tr = $_POST['tr'];

$querytr = "SELECT * FROM jenisgaji WHERE id_job=".$transport;
$rstr=mysqli_query($con,$querytr);
//$row3 = mysqli_fetch_array($rs3);

 for ($x = 1; $x <= $tr; $x++){
 	$querytr4 = "SELECT * FROM ketSal WHERE jenisgaji LIKE '%".$transport."%' and flag = 1";
 	$rstr4=mysqli_query($con,$querytr4);
 	 echo "<div class='form-row'>
                  <div class='form-group'>
                    <label>Agent".$x."</label>
					<select class='chosen' name='agent' id='agent'>
					<option selected='selected' value=0>Pilihan</option>";
					while($rowagent = mysqli_fetch_array($rsagent)){
                      echo "<option value=".$rowagent['id'].">".$rowagent['name']."</option>";
                    }
                   echo "</select>
                  </div>
				  <div class='form-group'>
					<label>Continent".$x."</label>
					<select class='chosen' name='continent' id='continent'>
					<option selected='selected' value=0>Pilihan</option>";
					while($rowcontinent = mysql_fetch_array($rscontinent)){
						echo "<option value=".$rowcontinent['id'].">".$rowcontinent['name']."</option>";
                    }
                   echo "</select>
                  </div>
				  <div class='form-group'>
					<label>Country".$x."</label>
					<select class='chosen' name='country' id='country'>
					<option selected='selected' value=0>Pilihan</option>";
					while($rowcountry = mysqli_fetch_array($rscountry)){
                     
                        echo "<option value=".$rowcountry['id'].">".$rowcountry['name']."</option>";
                      
                    }
                    echo"</select>
                  </div>
				  <div class='form-group'>
					<label>City".$x."</label>
					<select class='chosen' name='city' id='city'>
					<option selected='selected' value=0>Pilihan</option>";
					while($rowcity = mysqli_fetch_array($rscity)){
                      
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      
                    }
                    echo"</select>
                  </div>
				  <div class='form-group'>
					<label>Transport Type".$x."</label>
					<select class='chosen' name='transport' id='transport'>
					<option selected='selected' value=0>Pilihan</option>";
					while($rowtransport = mysqli_fetch_array($rstransport)){
                      
                      echo "<option value=".$rowtransport['id'].">".$rowtransport['name']."</option>";
                    
                  }
                    echo"</select>
                  </div>
				  <div class='form-group'>
					<label>Rent Type".$x."</label>
					<select class='chosen' name='rent' id='rent'>
					<option selected='selected value=0>Pilihan</option>";
					while($row7 = mysqli_fetch_array($rs7)){
                      
                      echo "<option value=".$row7['id'].">".$row7['nama']."</option>";
                    
                  }
                    echo"</select>
                   </div>
				   <div class='form-group'>
                    <label>Duration</label>
                    <input type='text' class='form-control' name='duration' id='duration' placeholder='Enter Duration'>
                  </div>
				  <div class='form-group'>
                    <label>Price</label>
					<select name='kurs' id='kurs'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
					while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                    <input class='form-control' type='price' name='price' value='' style='width: 100%;'/>
                  </div>
				  <div class='form-group'>
					<label>Tipping</label>
					<input type='text' class='form-control' name='tipping' id='tipping' placeholder='Enter Tipping'>
                  </div>
                  </br>
                  
                    </div>
                  </div>";
			echo "</div>
				  
				  
     </input>
 	<!---- <select class='chosen' name='keterangan".$x."' id='keterangan".$x."' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option> --->";

 
 	echo"</select></div>";

 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>
