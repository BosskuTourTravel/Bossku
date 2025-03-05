<?php
include "../site.php";
include "../db=connection.php";  


session_start();
$querysal = "SELECT id,tgl,nama,gaji,bpjs,gj,year(tgl) AS thn,month(tgl) AS bln FROM sallary  WHERE id=".$_POST['id'];
$rssal=mysqli_query($con,$querysal);
$bulan = array(
  '1' => 'JANUARI',
  '2' => 'FEBRUARI',
  '3' => 'MARET',
  '4' => 'APRIL',
  '5' => 'MEI',
  '6' => 'JUNI',
  '7' => 'JULI',
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
                $gj=$rowsal['gj'];
                $querystaff = "SELECT * FROM login_staff WHERE id=".$rowsal['nama'];
                $rsstaff=mysqli_query($con,$querystaff);
                $rowstaff = mysqli_fetch_array($rsstaff);
              echo"
                <h3 class='card-title' style='font-weight:bold;'> VIEW LIST TUNJANGAN :".$rowstaff['name']." / BULAN :".$bulan[$abulan]." ".$rowsal['thn']."</h3>
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
              //query mendapatkan tanggal awal dan akhir
              $querytgl = "SELECT year(tgl) AS thn,month(tgl) AS bln FROM sallary WHERE nama =".$rowsal['nama']." AND YEAR(tgl)=".$rowsal['thn']."  AND gj !=1 AND MONTH(tgl) =".$rowsal['bln'];
              $rstgl=mysqli_query($con,$querytgl);
              $rowtgl=mysqli_fetch_array($rstgl);
              $x=$rowtgl['thn'];
              $y=$rowtgl['bln'];
              $tgaw=date("$x-$y-10 0:0:0");
              $tgak=date("Y-m-10 0:0:0", strtotime("+1 months",strtotime($tgaw)));
              //var_dump($tgak);
              //==========================================
              if ($gj==1) {
              $querytj = "SELECT * FROM tunjangan_price WHERE nama=".$rowsal['nama']." AND YEAR(tgl)=".$rowsal['thn']." AND MONTH(tgl) =".$rowsal['bln'];
               }else{
                $querytj = "SELECT * FROM tunjangan_price  WHERE  tgl >= '".$tgaw."' AND tgl < '".$tgak."' AND nama=".$rowsal['nama'];
               }
               $rstj=mysqli_query($con,$querytj);
              echo "<table class='table table-hover' style='font-size:14px;'>
              <thead>
              <tr>
              <th>TANGGAL</th>
              <th>NAMA</th>
              <th>KETERANGAN</th>
              <th>NOMINAL</th>
              </tr>
              </thead>
              <tbody>";
              $grandtotal=0;
              while($row = mysqli_fetch_array($rstj)){
                $querystaff = "SELECT * FROM login_staff WHERE id=".$row['nama'];
                $rsstaff=mysqli_query($con,$querystaff);
                $rowstaff = mysqli_fetch_array($rsstaff);
                $grandtotal=$grandtotal+$row['nominal'];

              echo"
              <tr style='font-weight:bold;'>
              <td>".$row['tgl']."</td>
              <td>".$rowstaff['name']."</td>
              <td>".$row['place']."</td>
              <td>".$row['nominal']."</td>
              </tr>
              <tr>";      
                }
                echo"
                <tr style='font-weight:bold;'>
                <td>GRAND TOTAL</td>
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
