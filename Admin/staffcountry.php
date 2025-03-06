<?php

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>STAFF COUNTRY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      </div>

                      <div class='input-group-append'>
                        <button type='submit' onclick='insertPage(11,0,0)' style='width:50px;' class='btn btn-default'><i class='fa fa-plus'></i></button>
                     </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";
                session_start();

                $query = "SELECT * FROM staff_country";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                
                <th>Staff</th>
                <th>Country</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){

                  $query_staff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                  $rs_staff=mysqli_query($con,$query_staff);
                  $row_staff = mysqli_fetch_array($rs_staff);

                  $tempCountry = preg_split ("/[;]+/", $row['country']);
                  $tempString2 = "";  
                  
                  echo"
                  <tr style='font-weight:bold;'>";
                 
                  echo "<td>".$row_staff['name']."</td>";
                  echo "<td>";
                  for($i=0; $i<count($tempCountry); $i++){
                    $querycountry2 = "SELECT * FROM country WHERE id=".$tempCountry[$i];
                      $rscountry2=mysqli_query($con,$querycountry2);
                      $rowcountry2 = mysqli_fetch_array($rscountry2);
                      if($i==0){
                        $tempString2 = $tempString2 . $rowcountry2['name'];
                      }else{
                        $tempString2 = $tempString2 . "</br>" . $rowcountry2['name'];
                      }
                  }
                  echo $tempString2;
                  echo "</td>
                  <td>";
                
                  echo "<button type='submit' onclick='editPage(-12,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delStaffCountry(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                  
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
  function delStaffCountry(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delStaffCountry.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-16,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

