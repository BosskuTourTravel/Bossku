<?php
include "../site.php";
include "../db=connection.php";  

session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>LIST JOB HARIAN </h3></br><p>AUTO INPUT : (INSERT,UPDATE COSTUMER LIST), (UPLOAD FILES,INPUT LANDTOUR)<p>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(12,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadsallary(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            


                $query = "SELECT * FROM total_job where id_staff=".$_SESSION['staff_id']."  order by date DESC";
                $rs=mysqli_query($con,$query);


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>TANGGAL</th>
                <th>NAMA</th>
                <th>JOB TIPE</th>
                <th>DESCRIPTION</th>
                <th>JUMLAH</th>
                <th>TOTAL</th>
                <th>option</th>
                </tr>
                </thead>
                <tbody>";
                while($row = mysqli_fetch_array($rs)){
                  $data= explode(";",$row['keterangan']); 
                  $querystaff = "SELECT * FROM login_staff WHERE id=".$row['id_staff'];
                  $rsstaff=mysqli_query($con,$querystaff);
                  $rowstaff = mysqli_fetch_array($rsstaff);
                  $querytipe = "SELECT * FROM jenisgaji WHERE id=".$row['job'];
                  $rstipe=mysqli_query($con,$querytipe);
                  $rowtipe = mysqli_fetch_array($rstipe);
                  
                echo"
                <tr style='font-weight:bold;'>
                <td>".$row['date']."</td>
                <td>".$rowstaff['name']."</td>
                <td>".$rowtipe['nama_job']."</td>
                <td>"; 
                for($i=0; $i < count($data); $i++){
                  echo"<option value=".$data[$i].">".$data[$i]."</option>";}
                echo"</td>

                <td>".$row['jumlah']."</td>";
               // $total=$row['jumlah']*$rowtipe['harga'];
                echo"
                <td>".number_format($row['total'], 0, ".", ".")."</td>
                <td>
                <button type='submit' onclick='deltot(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  function deltot(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"deltot_job.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadsallary(5,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

