<?php

include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM agent WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

if($row['tour_country']!=''){
  echo 0;
}else{
  echo 1;
}

?>