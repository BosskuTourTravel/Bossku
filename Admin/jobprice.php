<?php
session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>JOB PRICE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(14,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadsallary(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM jenisgaji";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Name Job</th>
                <th>Price</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){

                    
                    echo"
                    <tr style='font-weight:bold;'>";
                    if($row['id']==1 or$row['id']==28 or $row['id']==29 or $row['id']==26  or  $row['id']==33 ){
                      echo"
                      <td><font color='red'>".$row['nama_job']."</font></td>";
                    }else{
                    echo"
                    <td>".$row['nama_job']."</td>";
                    }
                    echo"
                    <td>Rp.".number_format($row['harga'], 0, ".", ".")."</td>
                    <td>
                    <button type='submit' onclick='editsallary(2,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                    <button type='submit' onclick='deljobprice(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  function deljobprice(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"deljobprice.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadsallary(2,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

