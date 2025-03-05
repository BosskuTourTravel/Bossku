<?php

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>PERFORMA KURS</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='insertPerforma(0,0,0)' style='width:50px;' class='btn btn-default'><i class='fa fa-plus'></i></button>

                      </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";
                session_start();

                $query = "SELECT * FROM performa_kurs_standart";
                $rs=mysqli_query($con,$query);

                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Country</th>
                <th>Kurs</th>
                <th>Price</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  $query_country = "SELECT * FROM country WHERE id=".$row['country'];
                  $rs_country=mysqli_query($con,$query_country);
                  $row_country = mysqli_fetch_array($rs_country);

                  $query_kurs = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
                  $rs_kurs=mysqli_query($con,$query_kurs);
                  $row_kurs = mysqli_fetch_array($rs_kurs);

                  echo"
                  <tr style='font-weight:bold;'>";
                 
                  echo "<td>".$row_country['name']."</td>";
                  echo "<td>".$row_kurs['name']."</td>";
                  echo "<td>".$row ['price']."</td>";
                  echo "<td><button type='submit' onclick='editPerforma(0,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delPerformaKurs(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                  
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
  function delPerformaKurs(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delPerformaKurs.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPerforma(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

