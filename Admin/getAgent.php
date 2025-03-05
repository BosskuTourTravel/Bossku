<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country WHERE id=".$_POST['country'];
$rscountry=mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

echo "<div class='form-group'>
<label>Agent</label>
<select class='chosen' name='agent' id='agent' onchange='getPerformaPrice(this.value,".$_POST['country'].")' class='form-control'>
<option selected='selected' value=0>Pilihan</option>";
$query = "SELECT DISTINCT(agent) FROM tour_package WHERE country LIKE '%".$_POST['country']."%'";
$rs=mysqli_query($con,$query);
while($row = mysqli_fetch_array($rs)){
	$querytourtype = "SELECT * FROM agent WHERE id=".$row['agent'];
	$rstourtype=mysqli_query($con,$querytourtype);
	while($rowtourtype = mysqli_fetch_array($rstourtype)){
			$tempCountry = preg_split ("/[\s;]+/", $rowtourtype['tour_country']);
			$checkTempCountry = 0;
			for($i=0; $i<count($tempCountry); $i++){
				$query_country = "SELECT * FROM country WHERE id=".$tempCountry[$i];
				$rs_country=mysqli_query($con,$query_country);
				$row_country = mysqli_fetch_array($rs_country);

				if($row_country['name']==$rowcountry['name']){
					$checkTempCountry = 1;
				}

			}

			if($checkTempCountry==1){
				$query_standart = "SELECT count(*) as total FROM performa_price_standart WHERE agent=".$rowtourtype['id'];
				$rs_standart=mysqli_query($con,$query_standart);
				$row_standart = mysqli_fetch_assoc($rs_standart);
				if($row_standart['total']>0){
					echo "<option style='color:red' value='".$rowtourtype['id']."'>".$rowtourtype['company']."</option>";
				}else{
					echo "<option value='".$rowtourtype['id']."'>".$rowtourtype['company']."</option>";
				}
				

				
			}
			
	}
}
echo"</select>
</div>";
?>

<script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>