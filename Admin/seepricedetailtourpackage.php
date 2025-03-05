<?php
include "../site.php";
include "../db=connection.php";

session_start();
$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

echo "<div class='content-wrapper'>

 <div class='row'>
          
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM tour_price_detail WHERE tour_price_package = ".$_POST['tourpricepackage']." ORDER BY id ASC";
                $rs=mysqli_query($con,$query);

                echo "<table class='table table-hover'>
                <thead>
                <tr>";
                if($_SESSION['type']==2){
                  echo "<th>ID</th>";
                }
                echo "<th>Person</th>
                <th>Adult</th>
                <th>Single</th>
                <th>Single Supp</th>
                <th>ChildWithBed</th>
                <th>ChildNoBed</th>
                <th>Infant</th>
                <th>Surcharge Weekend</th>
                <th>Kurs</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  $querykurs = "SELECT * FROM kurs_bank WHERE id = ".$row['kurs'];
                  $rskurs=mysqli_query($con,$querykurs);
                  $rowkurs = mysqli_fetch_array($rskurs);

                  echo"
                  <tr style='font-weight:bold;'>";
                  if($_SESSION['type']==2){
                    echo "<td>".$row['id']."</td>";
                  }
                  echo "
                  <td>".$row['person'].$row['tag']." ".$row['personplus'].$row['tag2']." ".$row['personplus2']."</td>
                  <td>".$row['price']."</td>
                  <td>".$row['adt']."</td>
                  <td>".$row['adt_sub']."</td>
                  <td>".$row['cwb']."</td>
                  <td>".$row['cnb']."</td>
                  <td>".$row['inf']."</td>
                  <td>".$row['surcharge_weekend']."</td>
                  <td>".$rowkurs['name']."</td>


               
                  </tr>
                  <tr>";
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