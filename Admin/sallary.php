<?php
session_start();
echo "<div class='content-wrapper'>

 <div>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>SALARY STAFF</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='newTab()' class='btn btn-default'><i class='fa fa-print'></i></button>
                      <button type='submit' onclick='reloadsallary(12,0,0)' style='font-size:13px;' class='btn btn-warning'>Cuti</button>
                      <button type='submit' onclick='reloadsallary(4,0,0)' style='font-size:13px;' class='btn btn-success'>absen</button>
                      <button type='submit' onclick='reloadsallary(5,0,0)' style='font-size:13px;' class='btn btn-primary'>jobdesk</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
                include "../site.php";
                include "../db=connection.php";
               // $st=$_SESSION['staff_id'];
               //var_dump($tgak);
               //var_dump($tgaw);
               $querygj = "SELECT id,tgl,nama,gaji,bpjs,gj,year(tgl) AS thn,month(tgl) AS bln FROM sallary WHERE nama=".$_SESSION['staff_id']." order by tgl DESC";
               $rsgj=mysqli_query($con,$querygj);
               $rowgj = mysqli_fetch_array($rsgj);
               $gji=$rowgj['gj'];
              //query mendapatkan tanggal awal dan akhir
              $querytgl = "SELECT year(tgl) AS thn,month(tgl) AS bln FROM sallary WHERE nama =".$rowgj['nama']." AND YEAR(tgl)=".$rowgj['thn']."  AND gj !=1 AND MONTH(tgl) =".$rowgj['bln'];
              $rstgl=mysqli_query($con,$querytgl);
              $rowtgl=mysqli_fetch_array($rstgl);
              //$gj=$row['gj'];
              $x=$rowtgl['thn'];
              $y=$rowtgl['bln'];
              $tgaw=date("$x-$y-11 0:0:0");
              $tgak=date("Y-m-11 0:0:0", strtotime("+1 months",strtotime($tgaw)));

              //var_dump($querygj);
              //echo $querygj;
              //==========================================
               if ($gji==1) {
                $query = "SELECT * FROM sallary WHERE nama=".$_SESSION['staff_id']." AND YEAR(tgl)=".date('Y')." AND MONTH(tgl) =".date('m');
                }else{
                  $query = "SELECT * FROM sallary WHERE  tgl >='".$tgaw."' AND tgl < '".$tgak."' AND nama=".$_SESSION['staff_id'];
                }
                $rs=mysqli_query($con,$query);
                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Nama</th>
                <th>Pokok</th>
                <th>BPJS</th>
                <th>Tunjangan</th>
                <th>Job Harian</th>
                <th>Lembur</th>
                <th>Lembur 2</th>
                <th>Gaji</th>
                </tr>
                </thead>
                <tbody>";

                //echo"$tgaw";
               // echo"$tgak";
                while($row = mysqli_fetch_array($rs)){
                  $querystaff = "SELECT * FROM login_staff WHERE id=".$row['nama'];
                  $rsstaff=mysqli_query($con,$querystaff);
                  $rowstaff = mysqli_fetch_array($rsstaff);
                  $gj=$row['gj'];
                 // var_dump($gj); 
                  if ($gj==1) {
                      $querylembur = "SELECT SUM(total) as subtotal FROM lembur WHERE staff =".$row['nama']." AND YEAR(tgl)=".date('Y')." AND MONTH(tgl) =".date('m');
                }else{
                      $querylembur = "SELECT SUM(total) as subtotal FROM lembur WHERE  tgl >= '".$tgaw."' AND tgl < '".$tgak."' AND staff =".$row['nama'];
                      }
                  $rslembur=mysqli_query($con,$querylembur);
                  $rowlembur=mysqli_fetch_array($rslembur);
                  if ($gj==1) {
                    $querylembur2 = "SELECT SUM(total2) as subtotal2 FROM lembur2 WHERE staff2 =".$row['nama']." AND YEAR(tgl2)=".date('Y')." AND MONTH(tgl2) =".date('m');
              }else{
                    $querylembur2 = "SELECT SUM(total2) as subtotal2 FROM lembur2 WHERE  tgl2 >= '".$tgaw."' AND tgl2 < '".$tgak."' AND staff2 =".$row['nama'];
                    }
                $rslembur2=mysqli_query($con,$querylembur2);
                $rowlembur2=mysqli_fetch_array($rslembur2);
                  if ($gj==1) {
                    $queryjobdesk = "SELECT SUM(total) as subjobdesk FROM total_job WHERE  id_staff=".$row['nama']." AND YEAR(date)=".date('Y')." AND MONTH(date) =".date('m');                    
                }else{
                  $queryjobdesk = "SELECT SUM(total) as subjobdesk FROM total_job WHERE  date >= '".$tgaw."' AND date < '".$tgak."' AND  id_staff =".$row['nama'];
                }
                  $rsjobdesk=mysqli_query($con,$queryjobdesk);
                  $rowjobdesk=mysqli_fetch_array($rsjobdesk);
                  if ($gj==1) {
                    $querytj = "SELECT SUM(nominal) as subnominal FROM tunjangan_price WHERE nama=".$row['nama']." AND YEAR(tgl)=".date('Y')." AND MONTH(tgl) =".date('m');
                 
                }else{
                  $querytj = "SELECT SUM(nominal) as subnominal FROM tunjangan_price WHERE  tgl >= '".$tgaw."' AND tgl < '".$tgak."' AND  nama=".$row['nama'];
                }
                  $rstj=mysqli_query($con,$querytj);
                  $rowtj=mysqli_fetch_array($rstj);

                  $gaji=$row['gaji']+$row['bpjs']+$rowtj['subnominal']+$rowjobdesk['subjobdesk']+$rowlembur['subtotal']+$rowlembur2['subtotal2'];
                    echo"
                    <tr style='font-weight:bold;'>
                    <td>".$rowstaff['name']."</td>
                    <td>Rp".number_format($row['gaji'], 0, ".", ".")."</td>
                    <td>Rp".number_format($row['bpjs'], 0, ".", ".")."</td>
                    <td>Rp".number_format($rowtj['subnominal'], 0, ".", ".")."</td>
                    <td>Rp".number_format($rowjobdesk['subjobdesk'], 0, ".", ".")."</td>
                    <td>Rp".number_format($rowlembur['subtotal'], 0, ".", ".")."</td>
                    <td>Rp".number_format($rowlembur2['subtotal2'], 0, ".", ".")."</td>
                    <td>Rp".number_format($gaji, 0, ".", ".")."</td>
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
function newTab(url){
    var x = window.open('http://www.2canholiday.com/Admin/printGaji.php','_blank');
    x.focus();
}
  function delStaga(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delGaj.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadsallary(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

