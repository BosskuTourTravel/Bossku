<?php
include "../site.php";
include "../db=connection.php";

session_start();
$query = "SELECT * FROM invoice WHERE id = ".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

echo "<div class='content-wrapper'>

 <div class='row'>
          
              <div class='card-body table-responsive p-0'>";

                echo "<table class='table table-hover'>
                <thead>
                <tr>";
                echo "
                <th>Name</th>
                <th></th>
                <th>Price</th>
                </tr>
                </thead>
                <tbody>";
                $tempName = preg_split ("/[;]+/", $row['additional_name']);
              $tempPax = preg_split ("/[;]+/", $row['additional_pax']);
              $tempPrice = preg_split ("/[;]+/", $row['additional_price']);
                 for($i=0; $i<count($tempName)-1; $i++){
                if($i!=5 && $i!=6 && $i!=7 && $i!=8 && $i!=9){
                  $tempTotal = $tempPax[$i] * $tempPrice[$i];
                  echo"
                  <tr style='font-weight:bold;'>";
                  echo "<td>".$tempName[$i]."</td>";
                  echo "<td>".$tempPax[$i]." Person x ";
                  echo "Rp ".number_format($tempPrice[$i], 0, ".", ".")."</td>";
                  echo "<td>Rp ".number_format($tempTotal, 0, ".", ".")." </td>";
                  echo "</tr>
                  <tr>";
                }
                
              }

                echo "
                </tbody>
                </table>

                
              </div>

        <!-- /.row -->
</div>";
?>

<script>
  function delPriceDetail(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
       $.ajax({
        url:"delPriceDetail.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(3,x,y);
          }else{
            alert("Fail to Delete");
          }
        }
      });
     
    } 
   
  }
</script>