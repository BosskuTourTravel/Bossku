<?php
 include "../site.php";
 include "../db=connection.php";

 //$item = $_POST['salaryItem'];
 //$id = $_POST['id'];
 //$id_count = $_POST['id_count'];
 $count = $_POST['count'];


echo "<input type='text' class='form-control' name='jobCount' id='jobCount' value='".$_POST['count']."' hidden>";
for ($y = 1; $y <= $count; $y++ ){
	echo"
		<label>Cuti Hari ke-".$y."</label>
		<input type='date' class='form-control' name='tawal".$y."' id='tawal".$y."' placeholder='Enter tanggal'>";
}

 ?>

