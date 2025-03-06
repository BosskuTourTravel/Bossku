<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$querydate = "SELECT DISTINCT(tanggal_keperluan) FROM pengeluaran_kantor";
$rsdate=mysqli_query($con,$querydate);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>KEPERLUAN KANTOR</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 300px;'>

                    <select class='chosen1' name='scountry' id='scountry' class='form-control'>
                    <option selected='selected' value=0>Search By Tanggal</option>";

                    while($rowdate = mysqli_fetch_array($rsdate)){
                      echo "<option value='".$rowdate['id']."'>".$rowdate['tanggal_keperluan']."</option>";
                    }
                    echo"</select>
                    
                    <div class='input-group-append'>";
                    
                    echo "<button type='submit' onclick='insertManual(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>";
                    
                    echo "</div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0' id='myMidBody'>";
              

                  $query = "SELECT * FROM pengeluaran_kantor ORDER BY id ASC";
                  $rs=mysqli_query($con,$query);
                  
                  $grandtotalkeperluan = 0;

                  echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                  <thead>
                  <tr>
                  <th>Tanggal Keperluan</th>
                  <th>Keperluan</th>
                  <th>Total</th>
                  <th>Diterima / Tidak</th>
                  <th>Staff</th>
                  <th>Tanggal Upload</th>
                  <th>Option</th>
                  </tr>
                  </thead>
                  <tbody id='myTable'>";
                  
                  while($row=mysqli_fetch_array($rs)){
                    
                    if($row['staff_id']!=''){
                      $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff_id'];
                      $rsstaff = mysqli_query($con,$querystaff);
                      $rowstaff = mysqli_fetch_array($rsstaff);
                    }

                    echo "<tr>";

                    echo "<td>".$row['tanggal_transfer']."</td>";
                    echo "<td>".$row['description']."</td>";
                    echo "<td>Rp ".number_format($row['total'], 0, ".", ".")."</td>";
                    if($row['status_cek']==0){
                      echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                    }else{
                      echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                    }
                    echo "<td>".$rowstaff['name']."</td>";
                    echo "<td>".$row['stamp']."</td>";
                    echo "<td>-</td>";



                    echo "</tr>";

                    $grandtotalkeperluan = $grandtotalkeperluan + $row['total'];

                  }

                  echo "<tr>";
                  echo "<td colspan='2'>Total : </td>";
                  echo "<td>Rp ".number_format($grandtotalkeperluan, 0, ".", ".")."</td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";
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
    $(document).ready(function(){
      $(".chosen1").chosen();
    });

   
  </script>

