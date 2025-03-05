<?php
include "../site.php";
include "../db=connection.php";
session_start();


$_code = "PricePackage"; 

echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:12px; max-height:100px important;'><thead>
<tr>

<th>Adm Penalty</th>
<th>Status Penalty</th>
<th>Penalty Pax</th>
<th>Deposit Pax Ammount</th>
<th>Deposit Total Pax</th>
<th>Total Seat</th>";

echo "</tr>
</thead>
<tbody id='myTable'>";
$query = "SELECT * FROM flight WHERE id = ".$_POST['id'];
$rs=mysqli_query($con,$query);

while($row = mysqli_fetch_array($rs)){

  echo "<td>Rp ".number_format($row['adm_penalty'], 0, ".", ".")."</td>";
  echo "<td>".$row['status_penalty']."</td>";
  if($row['penalty_pax']==0){
     echo "<td>Tidak Hangus</td>";
  }else{
     echo "<td>Hangus</td>";
  }
 
  echo "<td>Rp ".number_format($row['deposit_pax_amount'], 0, ".", ".")."</td>";
  echo "<td>".$row['deposit_total_pax']."</td>";
  echo "<td>".$row['total_seat']."</td>";
}

echo "
</tbody>
</table>";
?>