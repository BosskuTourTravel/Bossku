<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

$_code = "PricePackage"; 

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Tour Price Package : ".$rowtour['tour_name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(0,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM tour_price_package WHERE tour_package = ".$_POST['id'];
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover'>
                <thead>
                <tr>
                <th>Name</th>
                <th>Price Package</th>
                <th>Year</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  $querypricepackage = "SELECT * FROM price_package WHERE id = ".$row['price_package'];
                  $rspricepackage=mysqli_query($con,$querypricepackage);
                  $rowpricepackage = mysqli_fetch_array($rspricepackage);
                  $queryrating = "SELECT * FROM hotel_rating WHERE id=".$row['rating'];
                  $rsrating=mysqli_query($con,$queryrating);
                  $rowrating = mysqli_fetch_array($rsrating);

                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['name']." ( ".$rowrating['name']." ) </br></td>
                  <td>".$rowpricepackage['title']."</td>
                  <td>".$row['year']."</td>

                  <td>

                  <button type='submit' onclick='reloadPage(3,".$_POST['id'].",".$row['id'].")' class='btn btn-success'><i class='fa fa-tag' aria-hidden='true''></i></button>
                  <button type='submit' onclick='editPage(0,".$row['id'].",".$_POST['id'].",0)' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delPricePackage(".$row['id'].",".$_POST['id'].")' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>

                  </td>
                  </tr>
                  <tr>
                  <td>";

                  $querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
                  $rstour=mysqli_query($con,$querytour);
                  $rowtour = mysqli_fetch_array($rstour);



                  $queryx = "SELECT * FROM tour_price_detail WHERE tour_price_package = ".$row['id']." ORDER BY id ASC";
                  $rsx=mysqli_query($con,$queryx);

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

                  while($rowx = mysqli_fetch_array($rsx)){
                    $querykurs = "SELECT * FROM kurs_bank WHERE id = ".$rowx['kurs'];
                    $rskurs=mysqli_query($con,$querykurs);
                    $rowkurs = mysqli_fetch_array($rskurs);

                    echo"
                    <tr style='font-weight:bold;'>";
                    if($_SESSION['type']==2){
                      echo "<td>".$row['id']."</td>";
                    }
                    echo "
                    <td>".$rowx['person'].$rowx['tag']." ".$rowx['personplus'].$rowx['tag2']." ".$rowx['personplus2']."</td>
                    <td>".$rowx['price']."</td>
                    <td>".$rowx['adt']."</td>
                    <td>".$rowx['adt_sub']."</td>
                    <td>".$rowx['cwb']."</td>
                    <td>".$rowx['cnb']."</td>
                    <td>".$rowx['inf']."</td>
                    <td>".$rowx['surcharge_weekend']."</td>
                    <td>".$rowkurs['name']."</td>



                    </tr>
                    <tr>";
                  }

                  echo "
                  </tbody>
                  </table>";


               


                  echo "</tr>";
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

  function closeDetail(x,y){
    $('#divDetail'+y).html('');
  }
  function seeDetail(x,y){
    $.ajax({
          type:'POST',
          url:'seepricedetailtourpackage.php',
          data:{'id':x,'tourpricepackage':y},
          success:function(data){
           $('#divDetail'+y).html(data);
         }
       });
  }
  function delPricePackage(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
      $.ajax({
        url:"delPricePackage.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(2,y,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
    
  }
</script>