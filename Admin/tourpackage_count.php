 <?php
 include "../site.php";
 include "../db=connection.php";

 $country = $_POST['country'];
 $count = $_POST['count'];

$querycountry = "SELECT * FROM country WHERE id=".$country;
$rscountry=mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

 for ($x = 1; $x <= $count; $x++){
 	$querytourpackage = "SELECT * FROM tour_package WHERE country LIKE '%".$country."%' and flag = 1";
 	$rstourpackage=mysqli_query($con,$querytourpackage);
 	echo"<div class=form-group' style='margin-bottom:10px;'>
 	<label>Tour Package ".$x."</label>
 	<select class='chosen' name='tourpackage".$x."' id='tourpackage".$x."' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowtourpackage = mysqli_fetch_array($rstourpackage)){

 		
        if($rowtourpackage['country']!='' and $rowtourpackage['country']!='undefined'){
        	$tempCountry = preg_split ("/[;]+/", $rowtourpackage['country']);
         	for($i=0; $i<count($tempCountry); $i++){
	 		$querycountry2 = "SELECT * FROM country WHERE id=".$tempCountry[$i];
	 		$rscountry2=mysqli_query($con,$querycountry2);
	 		$rowcountry2 = mysqli_fetch_array($rscountry2);

	 		if($rowcountry2['name'] == $rowcountry['name']){
	 			echo "<option value=".$rowtourpackage['id'].">".$rowtourpackage['tour_name']."</option>";
	 		}
	 		
	 	}
	 }
 	}
 	echo"</select></div>";

 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>
