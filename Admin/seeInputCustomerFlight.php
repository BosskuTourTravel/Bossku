<?php
include "../site.php";
include "../db=connection.php";
session_start();

$id = $_POST['id'];
$queryflight = "SELECT * FROM flight WHERE id=".$id;
$rsflight=mysqli_query($con,$queryflight);
$rowflight = mysqli_fetch_array($rsflight);
echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:12px; '><thead>
<tr>
<th>Customer Name</th>
<th>Option</th>
";

echo "</tr>
</thead>
<tbody id='myTable'>";
$query = "SELECT * FROM customer_list";
$rs=mysqli_query($con,$query);
echo "
<tr><td>
<select class='chosen' name='customer' id='customer'>
<option selected='selected' value=0>Pilihan</option>";
while($row = mysqli_fetch_array($rs)){
  if($row['id']==$rowflight['customer_id']){
    echo "<option selected value='".$row['id']."'>".$row['customer_name']." ( ".$row['phone_number']." - ".$row['city']." )</option>";
  }else{
    echo "<option value='".$row['id']."'>".$row['customer_name']." ( ".$row['phone_number']." - ".$row['city']." )</option>";
  }
}

echo"</select>";


echo "
</td>
<td><button type='button' class='btn btn-warning' onclick='editButtonCustomer(".$id.")'><i class='fa fa-edit' aria-hidden='true''></i></button></td>
</tr>
</tbody>
</table>";
?>

<script>
$(document).ready(function(){
    $(".chosen").chosen();

  });

function editButtonCustomer(x){
      var fd = new FormData();
      var customer = document.getElementById("customer").options[document.getElementById("customer").selectedIndex].value;
      fd.append('customer_id',customer);
      fd.append('id',x);

      
       $.ajax({
        url: 'updateCustomerFlight.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
          reloadManual(1,0,0);
        }

      },
    });
   }
</script>