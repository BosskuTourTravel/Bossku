<?php
include "../site.php";
include "../db=connection.php";

echo "<option value=''>Pilih nama staff</option>";
 
$query = "SELECT * FROM jobdesk Order by nama  ASC";
$dewan1 = $db1->prepare($query);
$dewan1-> execute();
$res1 = $dewan1-> get_result();
while ($row = $res1-> fetch_assoc()) {
    echo "<option value='".$row['id']."'>".$row['nama']."</option>";
}
?>