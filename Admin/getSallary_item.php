<?php
 include "../site.php";
 include "../db=connection.php";

 $item = $_POST['salaryItem'];
 $id = $_POST['id'];
 $id_count = $_POST['id_count'];

 $queryjob = "SELECT * FROM jobdesk WHERE id=".$_POST['salaryItem'];
 $rsjob=mysqli_query($con,$queryjob);
//$row3 = mysqli_fetch_array($rs3);
echo "<input type='text' class='form-control' name='jobCount' id='jobCount' value='".$_POST['salaryItem']."' hidden>";
for ($y = 1; $y <= $item; $y++ ){
	$query4 = "SELECT * FROM ketSal WHERE jenisgaji LIKE '%".$item."%' ";
	$rs4=mysqli_query($con,$query4);
	echo"<div class=form-group' style='margin-bottom:10px;'>
	<label>".$i."JobItem ".$y."</label>
	<input type='textbox' required class='form-control' name='keterangan".$y."' id='keterangan".$y."' placeholder='Ketikkan Keterangan Job disini'>
	</input>";

	echo"</select></div>";

}

 ?>

