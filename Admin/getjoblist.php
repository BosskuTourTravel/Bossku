<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT count(*) as total FROM performa_price_standart WHERE agent=".$_POST['id']." and country=".$_POST['country'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_assoc($rs);


if($row['total']>0){
	echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(-15,".$_POST['id'].",".$_POST['country'].")' class='btn btn-success'><i class='fa fa-tag' aria-hidden='true''></i></button>";
}else{
	echo "";
}
?>

<script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

 </script>