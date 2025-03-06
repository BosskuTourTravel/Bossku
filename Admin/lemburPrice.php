<?php
  include "../site.php";
  include "../db=connection.php";  
session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>LIST LEMBUR PRICE STAFF </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='insertPage(18,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadsallary(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            

                $query = "SELECT * FROM lemburPrice order by id DESC";
                $rs=mysqli_query($con,$query);
                

                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>NAME STAFF</th>
                <th>NOMINAL/JAM</th>
                <th>TYPE</th>
                <th>OFFICE</th>
                <th>option</th>
                </tr>
                </thead>
                <tbody>";
                while($row = mysqli_fetch_array($rs)){
                  $querystaff = "SELECT * FROM login_staff WHERE id=".$row['nama'];
                  $rsstaff=mysqli_query($con,$querystaff);
                  $rowstaff = mysqli_fetch_array($rsstaff);
                  $queryz = "SELECT * FROM Setin WHERE id=".$row['office'];
                  $rsz=mysqli_query($con,$queryz);
                  $rowz = mysqli_fetch_array($rsz);

                echo"
                <tr style='font-weight:bold;'>
                <td>".$rowstaff['name']."</td>
                <td>Rp".number_format($row['nominal'], 0, ".", ".")."</td>
                <td>".$row['type']."</td>
                <td>".$rowz['nama']."</td>
                <td>
                <button type='submit' onclick='editsallary(7,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                <button type='submit' onclick='delLP(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  function delLP(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delLP.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadsallary(8,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

