<?php
 include "../site.php";
 include "../db=connection.php";

 $jobdesk = $_POST['jenisgaji'];
 $jd = $_POST['jd'];

$query3 = "SELECT * FROM jenisgaji WHERE id_job=".$jobdesk;
$rs3=mysqli_query($con,$query3);
//$row3 = mysqli_fetch_array($rs3);

 for ($x = 1; $x <= $jd; $x++){
 	//$query4 = "SELECT * FROM ketSal WHERE jenisgaji LIKE '%".$jobdesk."%' and flag = 1";
 	//$rs4=mysqli_query($con,$query4);
 	echo"<div class=form-group' style='margin-bottom:10px;'>
     <label>Job Item ".$x."</label>
     <input type='textbox' required class='form-control' name='".$jd."keterangan".$x."' id='".$jd."keterangan".$x."' placeholder='Ketikkan Keterangan Job disini'>
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
