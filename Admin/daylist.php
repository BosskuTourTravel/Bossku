<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title style='font-weight:bold;'>Day : ".$rowtour['tour_name']."</h3>
                <button type='button' class='btn btn-danger' onclick='delAllDay(".$_POST['id'].")'>Delete All</button>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(4,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM date_package WHERE tourpackage=".$_POST['id']." ORDER BY year ASC, month ASC, date_number ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover'>
                <thead>
                <tr>
                <th>Day</th>
                <th>Month</th>
                <th>Year</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){

                echo"
                <tr style='font-weight:bold;'>
                <td>".$row['date_number']."</td>
                <td>".$row['month']."</td>
                <td>".$row['year']."</td>
                <td>
                  <button type='submit' class='btn btn-warning' onclick='editPage(4,".$row['id'].",".$_POST['id'].",0)'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' class='btn btn-danger' onclick='delDay(".$row['id'].",".$_POST['id'].")'><i class='fa fa-trash' aria-hidden='true'></i></button>

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
  function delAllDay(x){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
      url:"delAllDay.php",
      method: "POST",
      asynch: false,
      data:{id:x},
      success:function(data){
        if(data=="success"){
          reloadPage(4,x,0);
        }else{
          alert("Fail to Delete");
        }
      }
    });
    } 
    
  }

  function delDay(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
      url:"delDay.php",
      method: "POST",
      asynch: false,
      data:{id:x},
      success:function(data){
        if(data=="success"){
          reloadPage(4,y,0);
        }else{
          alert("Fail to Delete");
        }
      }
    });
    } 
    
  }
</script>