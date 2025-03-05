<?php
include "../site.php";
include "../db=connection.php";
$count = $_POST['count'];
$str = "";
for ($i = 0; $i < $count; $i++) {
	echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='bordername".$i."' id='bordername".$i."' placeholder='City Name'>";
	echo "<select name='borderkurs".$i."' id='borderkurs".$i."' style='margin-right:10px;'>
	<option selected='selected' value=0>Pilihan Kurs</option>";
	$querykurs = "SELECT * FROM kurs_bank";
	$rskurs=mysqli_query($con,$querykurs);
	while($rowkurs2 = mysqli_fetch_array($rskurs)){
		echo "<option value=".$rowkurs2['id'].">".$rowkurs2['name']."</option>";
	}
	echo"</select>";
	echo "<input type='text'  name='borderprice'".$i." id='borderprice".$i."' placeholder='Tax Price'></div>";

}

?>

<script>
	$(document).ready(function(){
		$(".chosen").chosen();
	});
</script>