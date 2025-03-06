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
                <h3 class='card-title' style='font-weight:bold;'>Exclusion : ".$rowtour['tour_name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 300px;'>
                 
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='reloadPage(1,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              </br>
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM exclusion WHERE tour_package=".$_POST['id']." ORDER BY id ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Name</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){

                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['name']."</td>
                  <td>
                  <button type='submit' onclick='editPage(-3,".$row['id'].",".$_POST['id'].",0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delExclusion(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>
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
  function delExclusion(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
      $.ajax({
        url:"delExclusion.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-7,y,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
   
  }
</script>