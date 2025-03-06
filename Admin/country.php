<?php

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>COUNTRY</h3>
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
            
                // include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM country ORDER BY continent ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Continent</th>
                <th>Country</th>
                <th rowspan=2>City</th>
                <th>Img</th>
                <th>Img_Head</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  if($row['continent']!='' or $row['continent']==0){
                    
                    $querycontinent = "SELECT * FROM continent WHERE id=".$row['continent'];
                    $rscontinent=mysqli_query($con,$querycontinent);
                    $rowcontinent = mysqli_fetch_array($rscontinent);

                    // var_dump($querycontinent);
                  }else{
                    $rowcontinent['name'] = '-';
                  }
                  
                 
                    echo"
                    <tr style='font-weight:bold;'>
                    <td>".$rowcontinent['name']."</td>
                    <td>".$row['name']."</td>";
                    echo "<td rowspan=2 nowrap>";
                    $awal = 1;
                    $countCity = 1;
                    $totltaCOuntCity = 1;
                    $query_city = "SELECT COUNT(*) as total FROM city WHERE country =".$row['id']." ORDER BY name ASC";
                    $rs_city=mysqli_query($con,$query_city);
                    $row_city = mysqli_fetch_assoc($rs_city);
                    $end = $row_city['total'] / 5;

                    $query_city = "SELECT * FROM city WHERE country =".$row['id']." ORDER BY name ASC";
                    $rs_city=mysqli_query($con,$query_city);
                    while($row_city = mysqli_fetch_array($rs_city)){
                      if($awal==1){
                        $awal = 2;
                        echo $totltaCOuntCity." ";
                        $totltaCOuntCity = $totltaCOuntCity + 1;
                      }
                      if($countCity==5){
                        
                        echo $row_city['name']."</br>";
                        if($totltaCOuntCity!=$end){
                          echo $totltaCOuntCity." ";
                        }
                        $totltaCOuntCity = $totltaCOuntCity + 1;
                        $countCity = 0;
                      }else{
                        echo $row_city['name'].", ";
                      }
                      $countCity = $countCity + 1;
                    }
                    echo "</td>";
                    echo "<td>".$row['img']."</td>
                    <td>".$row['img_head']."</td>
                    <td>
                    <button type='submit' onclick='editPage(-6,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                    <button type='submit' onclick='delCountry(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  function delCountry(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delCountry.php",
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

