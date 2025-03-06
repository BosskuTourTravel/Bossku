<?php
 include "../site.php";
 include "../db=connection.php";

 //$item = $_POST['salaryItem'];
 //$id = $_POST['id'];
 //$id_count = $_POST['id_count'];
 $count = $_POST['count'];

 $queryjob = "SELECT * FROM jobdesk WHERE id=".$_POST['count'];
 $rsjob=mysqli_query($con,$queryjob);
//$row3 = mysqli_fetch_array($rs3);
echo "<input type='text' class='form-control' name='jobCount' id='jobCount' value='".$_POST['count']."' hidden>";
for ($y = 1; $y <= $count; $y++ ){
	$query4 = "SELECT * FROM ketSal WHERE jenisgaji LIKE '%".$count."%' ";
	$rs4=mysqli_query($con,$query4);
	echo"<div class=form-group' style='margin-bottom:10px;'>
	<label>".$i."JobItem ".$y."</label>
	<textarea  class='form-control' name='keterangan".$y."' id='keterangan".$y."' placeholder='Ketikkan Keterangan Job disini'>
	</textarea> ";
	echo"</select></div>";

}

 ?>

