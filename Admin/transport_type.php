<?php

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Transport Type</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(7,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM transport_type";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Name</th>
                <th>Transport Type</th>
                </tr>
                </thead>
                <tbody>";

                while($rowtransport_type = mysqli_fetch_array($rstransport_type_type)){
                  if($row['transport_type']!='' or $row['transport_type']==0){
                    $querytransport_type = "SELECT * FROM transport_type WHERE id=".$row['transport_type'];
                    $rstransport_type_type=mysqli_query($con,$querytransport_type);
                    $rowtransport_type = mysqli_fetch_array($rstransport_type_type);
                  }else{
                    $rowtransport_type['name'] = '-';
                  }
                  
                 
                    echo"
                    <tr style='font-weight:bold;'>
                    <td>".$row['name']."</td>
                    <td>".$rowtransport_type['name']."</td>
                    
                    <td>
                    <button type='submit' onclick='updateTrtype(-6,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                    <button type='submit' onclick='delTransport_type(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  function delTransport_type(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delTransport_type.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-4,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

