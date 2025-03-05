<?php
include "../site.php";
include "../db=connection.php"; 

session_start();

  $querystaff = "SELECT * FROM login_staff WHERE id=".$_SESSION['staff_id'];
  $rsstaff=mysqli_query($con,$querystaff);
  while($rowstaff = mysqli_fetch_array($rsstaff)){
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>".$rowstaff['name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(19,0,0)' class='btn btn-default'><i class='fa fa-print'></i></button>
                      <button type='submit' onclick='insertPage(16,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadsallary(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
 


                

                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                </thead>
                <tbody>";


                echo"
                <tr style='font-weight:bold;'>
                <td>GAJI POKOK</td>
                <td></td>
                <td></td>
                <td></td>
               </tr>
               <tr style='font-weight:bold;'>
               <td>UANG MAKAN SIANG</td>
               <td></td>
               <td></td>
               <td></td>
              </tr>";
                    $queryj= "SELECT * FROM jobdesk where nama=".$rowstaff['id'];
                    $rsj=mysqli_query($con,$queryj);
                    while($rowj = mysqli_fetch_array($rsj)){
                      $data= explode(",",$rowj['job']);
                      for($i=0; $i < count($data); $i++){
                        $queryn= "SELECT * FROM jenisgaji where id=".$data[$i];
                        $rsn=mysqli_query($con,$queryn);
                        $rown = mysqli_fetch_array($rsn);
              echo"
              <tr style='font-weight:bold;'>
              <td>".$rown['nama_job']."</td>
              <td></td>
              <td></td>
              <td></td>
              </tr>";

                      }
                    }
              echo"<tr>";      
              echo"
              <tr style='font-weight:bold;'>
              <td>STAFF COMMISION</td>
              <td></td>
              <td></td>
              <td></td>
             </tr>";

            echo"
            <tr style='font-weight:bold;'>
            <td>GRAND TOTAL</td>
            <td></td>
            <td></td>
            <td></td>
           </tr>";


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
  function dellembur(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"dellembur.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadsallary(4,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>
