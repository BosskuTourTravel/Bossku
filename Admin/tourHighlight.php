<?php

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Tour Highlight</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertTourHighlight(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM tour_highlight ORDER by id DESC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Country</th>
                <th>Title</th>
                <th>Tour Package</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                 

                   $tempPackage = preg_split ("/[;]+/", $row['tour_package']);
                   $tempString = "";
                   $querycountry = "SELECT * FROM country WHERE id=".$row['country'];
                   $rscountry=mysqli_query($con,$querycountry);
                   $rowcountry = mysqli_fetch_array($rscountry);
                    echo"
                    <tr style='font-weight:bold;'>
                    <td>".$row['id']."</td>
                    <td>".$rowcountry['name']."</td>
                    <td>".$row['title']."</td>
                    <td>";

                    for($i=0; $i<count($tempPackage); $i++){
                      $query_package = "SELECT * FROM tour_package WHERE id=".$tempPackage[$i];
                      $rs_package=mysqli_query($con,$query_package);
                      $row_package = mysqli_fetch_array($rs_package);
                      if($i==0){
                        $tempString = $tempString . $i+1 . ") ".$row_package['tour_name'] . "( Tour Code : 888".$tempPackage[$i]." )</br>";
                      }else{
                        $tempString = $tempString . "</br>" . $i + 1 . ") ".$row_package['tour_name'] . "( Tour Code : 888".$tempPackage[$i]." )</br>";
                      }

                      echo $tempString;
                    }

                    echo "</td>
                    <td>
                    <button type='submit' onclick='editTourHighlight(0,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                    <button type='submit' onclick='delTourHightlight(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  function delTourHightlight(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delTourHightlight.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadTourHighlight(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

