<?php
include "../site.php";
include "../db=connection.php";
$count = $_POST['count'];
$str = "";
for ($i = 0; $i < $count; $i++) {
	echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='visaname".$i."' id='visaname".$i."' value='Visa' disabled>";
	
	
	echo "<select name='visa".$i."' id='visa".$i."'>
	<option selected='selected' value=0>Pilihan Visa</option>";
	$query_visi = "SELECT * FROM visa ORDER BY continent ASC, country ASC, id DESC";
	$rs_visi=mysqli_query($con,$query_visi);
	while($row_visi = mysqli_fetch_array($rs_visi)){
		$querycountry2 = "SELECT * FROM country WHERE id=".$row_visi['country'];
		$rscountry2=mysqli_query($con,$querycountry2);
		$rowcountry2 = mysqli_fetch_array($rscountry2);

		$queryembassy = "SELECT * FROM embassy WHERE id=".$row_visi['embassy'];
		$rsembassy=mysqli_query($con,$queryembassy);
		$rowembassy = mysqli_fetch_array($rsembassy);

		$query_city = "SELECT * FROM city WHERE id=".$rowembassy['city'];
		$rs_city=mysqli_query($con,$query_city);
		$row_city = mysqli_fetch_array($rs_city);
		echo "<option value=".$row_visi['id'].">".$rowcountry2['name']." - ".$row_visi['type']." - ".$row_visi['day']."days - Rp ".number_format($row_visi['price'], 0, ".", ".")."</option>";
	}
	echo"</select>";

}

?>

<script>
$(document).ready(function(){
	$(".chosen").chosen();
});
 </script>