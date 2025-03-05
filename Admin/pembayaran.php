<?php
include "../site.php";
include "../db=connection.php";
$bulan = array(
    '01' => 'JANUARI',
    '02' => 'FEBRUARI',
    '03' => 'MARET',
    '04' => 'APRIL',
    '05' => 'MEI',
    '06' => 'JUNI',
    '07' => 'JULI',
    '08' => 'AGUSTUS',
    '09' => 'SEPTEMBER',
    '10' => 'OKTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DESEMBER',
  );

$queryg = "SELECT * FROM login_staff";
$rsg=mysqli_query($con,$queryg);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>PEMBAYARAN</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                      <button type='submit' onclick='insertPage(23,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>
              <div class='card card-primary'>";
                               
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT id,tgl,nama,gaji,bpjs,gj,year(tgl) AS thn,month(tgl) AS bln FROM sallary order by tgl DESC";
                $rs=mysqli_query($con,$query);

                $querybln = "SELECT Month(tgl)  AS bln FROM sallary  order by id desc"; 
                $rsbln=mysqli_query($con,$querybln);
                $rowbln=mysqli_fetch_array($rsbln);

                $querygaji = "SELECT SUM(gaji) as totalgaji FROM sallary";
                $rsgaji=mysqli_query($con,$querygaji);

                $querybpjs = "SELECT SUM(bpjs) AS totalbpjs FROM sallary";
                $rsbpjs=mysqli_query($con,$querybpjs);
                $rowbpjs=mysqli_fetch_array($rsbpjs); 
                echo "<table class='table' style='font-size:12px;'>
                <thead>
                <tr>
                <th scope='col'>GAJI</th>
                <th scope='col'>NAMA STAFF</th>
                <th scope='col'>TOTAL HOURS</th>
                <th scope='col'>TOTAL GAJI AKHIR</th>
                <th scope='col'>TOTAL GAJI DIBAYAR</th>
                <th scope='col'>BALANCE</th>
                <th>     
                </th>
                </tr>
                </thead>
                <tbody>";
                $grandtotal=0;
                $totaljobdesk=0;
                $totaltj=0;
                $totallb=0;
                while($row = mysqli_fetch_array($rs)){
                    $tanggal=$row['tgl'];
                    $day = date('m', strtotime($tanggal));
              //query mendapatkan tanggal awal dan akhir
              $querytgl = "SELECT year(tgl) AS thn,month(tgl) AS bln FROM sallary WHERE nama =".$row['nama']." AND YEAR(tgl)=".$row['thn']."  AND gj !=1 AND MONTH(tgl) =".$row['bln'];
              $rstgl=mysqli_query($con,$querytgl);
              $rowtgl=mysqli_fetch_array($rstgl);
              //query mengambil nilai gj
              // $querygj = "SELECT  gj FROM sallary WHERE nama =".$row['nama']." AND YEAR(tgl)=".$row['thn']." AND MONTH(tgl) =".$row['bln'];
              // $rsgj=mysqli_query($con,$querygj);
              // $rowgj=mysqli_fetch_array($rsgj);
              $gj=$row['gj'];
              $x=$rowtgl['thn'];
              $y=$rowtgl['bln'];
              $tgaw=date("$x-$y-10 0:0:0");
              $tgak=date("Y-m-10 0:0:0", strtotime("+1 months",strtotime($tgaw)));
              //var_dump($tgak);
              //echo $querygj;
              //==========================================
                  $querystaff = "SELECT * FROM login_staff WHERE id=".$row['nama'];
                  $rsstaff=mysqli_query($con,$querystaff);
                  $rowstaff = mysqli_fetch_array($rsstaff);
                  if ($gj==1) {
                  $querylembur = "SELECT SUM(total) as subtotal FROM lembur WHERE staff =".$row['nama']." AND YEAR(tgl)=".$row['thn']." AND MONTH(tgl) =".$row['bln'];
                  }else{
                    $querylembur = "SELECT SUM(total) as subtotal FROM lembur WHERE tgl >='".$tgaw."' AND tgl < '".$tgak."' AND staff =".$row['nama'];
                  }
                  $rslembur=mysqli_query($con,$querylembur);
                  $rowlembur=mysqli_fetch_array($rslembur);
                  if ($gj==1) {
                  $queryjobdesk = "SELECT SUM(total) as subjobdesk FROM total_job WHERE id_staff =".$row['nama']." AND YEAR(date)=".$row['thn']." AND MONTH(date) =".$row['bln'];
                  }else{
                    $queryjobdesk = "SELECT SUM(total) as subjobdesk FROM total_job WHERE date >= '".$tgaw."' AND date < '".$tgak."' AND id_staff =".$row['nama'];
                  }
                  $rsjobdesk=mysqli_query($con,$queryjobdesk);
                  $rowjobdesk=mysqli_fetch_array($rsjobdesk);
                  if ($gj==1) {
                  $querytj = "SELECT SUM(nominal) as subnominal FROM tunjangan_price WHERE nama=".$row['nama']." AND YEAR(tgl)=".$row['thn']." AND MONTH(tgl) =".$row['bln'];
                  }else{
                    $querytj = "SELECT SUM(nominal) as subnominal FROM tunjangan_price WHERE tgl >= '".$tgaw."' AND tgl < '".$tgak."' AND nama=".$row['nama'];
                  }
                  $rstj=mysqli_query($con,$querytj);
                  $rowtj=mysqli_fetch_array($rstj);
                  ////commission
                  if ($gj==1) {
                    $querycomlt = "SELECT SUM(staff_com) as substaffcom FROM invoice WHERE staff_id=".$row['nama']." AND YEAR(stamp)=".$row['thn']." AND MONTH(stamp) =".$row['bln'];
                    }else{
                      $querycomlt = "SELECT SUM(staff_com) as substaffcom FROM invoice WHERE stamp >= '".$tgaw."' AND stamp < '".$tgak."' AND staff_id=".$row['nama'];
                    }
                    $rscomlt=mysqli_query($con,$querycomlt);
                    $rowcomlt=mysqli_fetch_array($rscomlt);
                  if ($gj==1) {
                    $querycomvp = "SELECT SUM(staff_com) as subvpcom FROM invoiceVisaPassport WHERE staff_id=".$row['nama']." AND YEAR(stamp)=".$row['thn']." AND MONTH(stamp) =".$row['bln'];
                    }else{
                      $querycomvp = "SELECT SUM(staff_com) as subvpcom FROM invoiceVisaPassport WHERE stamp >= '".$tgaw."' AND stamp < '".$tgak."' AND staff_id=".$row['nama'];
                    }
                    $rscomvp=mysqli_query($con,$querycomvp);
                    $rowcomvp=mysqli_fetch_array($rscomvp);
                    if ($gj==1) {
                      $queryfl = "SELECT SUM(staff_com) as subflcom FROM flight WHERE staff_id=".$row['nama']." AND YEAR(stamp)=".$row['thn']." AND MONTH(stamp) =".$row['bln'];
                        
                    }else{
                        $queryfl = "SELECT SUM(staff_com) as subflcom FROM flight WHERE stamp >= '".$tgaw."' AND stamp < '".$tgak."' AND staff_id=".$row['nama'];
                      
                      }
                      $rsfl=mysqli_query($con,$queryfl);
                      $rowfl=mysqli_fetch_array($rsfl);
                  $fl=$rowfl['subflcom'] * 40/100;
                  $com=$rowcomlt['substaffcom']+$rowcomvp['subvpcom'] + $fl ;

                  $querylemburin= "SELECT SUM(durasi) as totaldur FROM lembur where staff=".$row['nama']." AND YEAR(tgl)=".$row['thn']." AND MONTH(tgl) =".$row['bln'];
                  $rslemburin=mysqli_query($con,$querylemburin);
                  $rowlemburin=mysqli_fetch_array($rslemburin);

                  $totalgaji=$row['gaji']+$row['bpjs']+$rowjobdesk['subjobdesk']+$rowtj['subnominal']+$rowlembur['subtotal']+$com;
                  $grandtotal=$grandtotal+$totalgaji;
                  $jobdesk = $rowjobdesk['subjobdesk'];
                  $totaljobdesk =$totaljobdesk+$jobdesk;
                  $tj = $rowtj['subnominal'];
                  $totaltj =$totaltj+$tj;
                  $lb = $rowlembur['subtotal'];
                  $totallb =$totallb+$lb;

                    echo"
                          <tr style='font-weight:bold;'>
                          <td>".$bulan[$day]."</td>
                          <td>".$rowstaff['name']."</td>
                          <td>".$rowlemburin['totaldur']."&nbsp;Hours</td>";
                          echo"<td align='center'>Rp".number_format($totalgaji, 0, ".", ".")."</td>";
                          $querybayar = "SELECT SUM(nominal) as subnominal FROM pembayaran WHERE staff=".$row['nama']." AND thn=".$row['thn']." AND bln=".$row['bln'];
                          $rsbayar=mysqli_query($con,$querybayar);
                          $rowbayar=mysqli_fetch_array($rsbayar);
                          echo"<td>Rp".number_format($rowbayar['subnominal'], 0, ".", ".")."</td>";
                          $balance=$totalgaji -$rowbayar['subnominal'];
                          echo"<td>Rp".number_format($balance, 0, ".", ".")."</td>
                    </tr>";
                }
  
                //while($rowt = mysqli_fetch_array($rsgaji)){  
 
                  
                echo"
                    <tr style='font-weight:bold;'>
                          <td></td>    
                          <td  align='center'> TOTAL :</td>
                          <td></td>
                          <td align='center'>Rp".number_format($grandtotal, 0, ".", ".")."</td>
                          <td></td>
                          <td></td>
                    </tr>
                    <tr>";

                
                echo "
                </tbody>
                </table>

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              </tbody>
            </table>
            </div>
            </div>

              </div>
            </div>
          </div>
        </div>
        </div>";
?>

<script>

</script>
