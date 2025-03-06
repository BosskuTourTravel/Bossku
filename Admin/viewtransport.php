<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM transport_pric";
$rscountry=mysqli_query($con,$querycountry);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>TRANSPORT PRICE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='insertAgent(0,0,0)' style='width:50px;' class='btn btn-default'><i class='fa fa-plus'></i></button>

                      </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";
                session_start();

                $query = "SELECT * FROM transport_pric ORDER BY id DESC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Transport type</th>
                <th>Rent Type</th>
                <th>Country</th>
                <th>City</th>
                <th>Agent</th>
                <th>Kurs</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  
                  echo"
                  <tr style='font-weight:bold;'>";
                 
                  echo "<td>".$row ['transport_type']."</td>";
                  echo "<td>".$row ['rent_type']."</td>";
                  echo "<td>".$row ['country']."</td>";
                  echo "<td>".$row ['city']."</td>";
                  echo "<td>".$row ['agent']."</td>";
                  echo "<td>".$row ['kurs']."</td>
                  <td>";
                
                  echo "<button type='submit' onclick='editPage(-11,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delAgent(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                  
                  echo"</tr>";
                  
                  
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
  function delAgent(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delAgent.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-12,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

