<?php
include "../site.php";
include "../db=connection.php";

session_start();
$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Detail Price Package : ".$rowtour['tour_name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(1,".$_POST['id'].",".$_POST['tourpricepackage'].")' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadPage(2,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
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
                <th>Until Person</th>
                <th>Free Person</th>
                <th>Adult</th>
                <th>Single</th>
                <th>Single Supp</th>
                <th>ChildWithBed</th>
                <th>ChildNoBed</th>
                <th>Infant</th>
                <th>Surcharge Weekend</th>
                <th>Kurs</th>
               
                <th>Option</th>
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
                  <td>".$row['person']."</td>
                  <td>".$row['tag']." ".$row['personplus']."</td>
                  <td>".$row['tag2']." ".$row['personplus2']."</td>
                  <td>".$row['price']."</td>
                  <td>".$row['adt']."</td>
                  <td>".$row['adt_sub']."</td>
                  <td>".$row['cwb']."</td>
                  <td>".$row['cnb']."</td>
                  <td>".$row['inf']."</td>
                  <td>".$row['surcharge_weekend']."</td>
                  <td>".$rowkurs['name']."</td>


                  <td>
                  <button type='submit' onclick='editPage(1,".$row['id'].",".$_POST['id'].",".$_POST['tourpricepackage'].")' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delPriceDetail(".$row['id'].",".$_POST['tourpricepackage'].")' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>

                  </td>
                  </tr>
                  <tr>";
                }

                echo "
                </tbody>
                </table>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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