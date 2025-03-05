<?php
include "../site.php";
include "../db=connection.php";  


session_start();
$querysal = "SELECT id,agent,tour_name,description,category,tour_type,month,year,duration_tour,departure,minperson,tipping,kurs,continent,country,city,year(tgl) AS thn,month(tgl) AS bln FROM sallary  WHERE id=".$_POST['id'];
$rssal=mysqli_query($con,$querysal);
$bulan = array(
  '1' => 'JANUARI',
  '2' => 'FEBRUARI',
  '3' => 'MARET',
  '4' => 'APRIL',
  '5' => 'MEI',
  '6' => 'JUNI',
  '07' => 'JULI',
  '8' => 'AGUSTUS',
  '9' => 'SEPTEMBER',
  '10' => 'OKTOBER',
  '11' => 'NOVEMBER',
  '12' => 'DESEMBER',
);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>";
              while($rowsal = mysqli_fetch_array($rssal)){
                $abulan=$rowsal['bln'];
               // var_dump($abulan);
                $querystaff = "SELECT * FROM login_staff WHERE id=".$rowsal['nama'];
                $rsstaff=mysqli_query($con,$querystaff);
                $rowstaff = mysqli_fetch_array($rsstaff);
              echo"
                <h3 class='card-title' style='font-weight:bold;'> VIEW LIST JOB HARIAN :".$rowstaff['name']." / BULAN :".$bulan[$abulan]." ".$rowsal['thn']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='reloadsallary(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            

              $queryjobhar = "SELECT * FROM total_job WHERE id_staff =".$rowsal['nama']." AND YEAR(date)=".$rowsal['thn']." AND MONTH(date) =".$rowsal['bln'];
              $rsjobhar=mysqli_query($con,$queryjobhar);


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>TANGGAL</th>
                <th>NAMA</th>
                <th>JOB TIPE</th>
                <th>DESCRIPTION</th>
                <th>JUMLAH</th>
                <th>TOTAL</th>
                </tr>
                </thead>
                <tbody>";
                $grandtotal=0;
                while($row = mysqli_fetch_array($rsjobhar)){
                
                  $data= explode(";",$row['keterangan']); 
                  $querystaff = "SELECT * FROM login_staff WHERE id=".$row['id_staff'];
                  $rsstaff=mysqli_query($con,$querystaff);
                  $rowstaff = mysqli_fetch_array($rsstaff);
                  
                  $querytipe = "SELECT * FROM jenisgaji WHERE id=".$row['job'];
                  $rstipe=mysqli_query($con,$querytipe);
                  $rowtipe = mysqli_fetch_array($rstipe);
                  $grandtotal=$grandtotal+$row['total'];
                  
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
                </tr>";
              }
 
              echo"
                <tr style='font-weight:bold;'>
                <td>GRAND TOTAL</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Rp".number_format($grandtotal, 0, ".", ".")."</td>
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
