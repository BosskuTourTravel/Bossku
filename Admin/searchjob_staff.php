<?php
$bulan = array(
  '01' => 'JAN',
  '02' => 'FEB',
  '03' => 'MAR',
  '04' => 'APR',
  '05' => 'MEI',
  '06' => 'JUN',
  '07' => 'JUL',
  '08' => 'AGU',
  '09' => 'SEP',
  '10' => 'OKT',
  '11' => 'NOV',
  '12' => 'DES',
);
                include "../site.php";
                include "../db=connection.php";


                if(isset($_POST['table_bulan'])  && ($_POST['table_tgl'])){
                  $qcari=$_POST['table_bulan'];
                 // $qcarib=$_POST['table_tahun'];
                  $qcaric=$_POST['table_tgl'];
                  $query = "SELECT id,tgl,nama,gaji,bpjs,gj,year(tgl) AS thn,month(tgl) AS bln FROM sallary where gj=".$qcaric." AND month(tgl)=".$qcari;
                }
                else{
                $query = "SELECT id,tgl,nama,gaji,bpjs,gj,year(tgl) AS thn,month(tgl) AS bln FROM sallary where year(tgl) = ".date('Y')." AND month(tgl) =".date('m')."   order by gj ASC";
                
              }
                $rs=mysqli_query($con,$query);

                $querybln = "SELECT Month(tgl)  AS bln FROM sallary  order by id desc"; 
                $rsbln=mysqli_query($con,$querybln);
                $rowbln=mysqli_fetch_array($rsbln);

                // $querygaji = "SELECT SUM(gaji) as totalgaji FROM sallary";
                // $rsgaji=mysqli_query($con,$querygaji);

                $querybpjs = "SELECT SUM(bpjs) AS totalbpjs FROM sallary";
                $rsbpjs=mysqli_query($con,$querybpjs);
                $rowbpjs=mysqli_fetch_array($rsbpjs); 
                echo "<table class='table' style='font-size:12px;'>
                <thead>
                <tr>
                <th scope='col'>BULAN</th>
                <th scope='col'>NAMA STAFF</th>
                <th scope='col'>GAJI POKOK</br>JOB HARIAN</th>
                <th scope='col'>BPJS</th>
                <th scope='col'>TUNJANGAN</th>
                <th scope='col'>COMMISSION</th>
                <th scope='col'>LEMBUR</th>
                <th scope='col'>LEMBUR 2</th>
                <th scope='col'>TOTAL GAJI AKHIR</th>
                <th>     
                </th>
                </tr>
                </thead>
                <tbody>";
                $grandtotal=0;
                $totaljobdesk=0;
                $totaltj=0;
                $totallb=0;
                $totallb2=0;
                $totalpokok=0;
                $totalbpjs=0;
                $totalcom=0;
                while($row = mysqli_fetch_array($rs)){
                  $tanggal=$row['tgl'];
                  $day = date('m', strtotime($tanggal));
                 // $dayx = date($day,strtotime("+1 months"));
                  $dayx=date("m", strtotime("+1 months",strtotime($tanggal)));
              //query mendapatkan tanggal awal dan akhir
              $querytgla = "SELECT year(tgl) AS thn,month(tgl) AS bln FROM sallary WHERE nama =".$row['nama']." AND YEAR(tgl)=".$row['thn']."  AND gj=1 AND MONTH(tgl) =".$row['bln'];
              $rstgla=mysqli_query($con,$querytgla);
              $rowtgla=mysqli_fetch_array($rstgla);
              $querytgl = "SELECT year(tgl) AS thn,month(tgl) AS bln FROM sallary WHERE nama =".$row['nama']." AND YEAR(tgl)=".$row['thn']."  AND gj !=1 AND MONTH(tgl) =".$row['bln'];
              $rstgl=mysqli_query($con,$querytgl);
              $rowtgl=mysqli_fetch_array($rstgl);
              //query mengambil nilai gj
              // $querygj = "SELECT  gj FROM sallary WHERE nama =".$row['nama']." AND YEAR(tgl)=".$row['thn']." AND MONTH(tgl) =".$row['bln'];
              // $rsgj=mysqli_query($con,$querygj);
              // $rowgj=mysqli_fetch_array($rsgj);
              $gj=$row['gj'];
              $xa=$rowtgla['thn'];
              $ya=$rowtgla['bln'];
              $tgawx=date("$xa-$ya-01");
              $x=$rowtgl['thn'];
              $y=$rowtgl['bln'];
              $tgaw=date("$x-$y-11");
              $tgak=date("Y-m-11", strtotime("+1 months",strtotime($tgaw)));
             
              //var_dump($x);
              //var_dump($tgawx);
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
                    $querylembur2 = "SELECT SUM(total2) as subtotal2 FROM lembur2 WHERE staff2 =".$row['nama']." AND YEAR(tgl2)=".$row['thn']." AND MONTH(tgl2) =".$row['bln'];
                 
                  }else{
                      $querylembur2 = "SELECT SUM(total2) as subtotal2 FROM lembur2 WHERE tgl2 >='".$tgaw."' AND tgl2 < '".$tgak."' AND staff2 =".$row['nama'];
                    }
                    $rslembur2=mysqli_query($con,$querylembur2);
                    $rowlembur2=mysqli_fetch_array($rslembur2);
                    //////////
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
                  $totalgaji=$row['gaji']+$row['bpjs']+$rowjobdesk['subjobdesk']+$rowtj['subnominal']+$rowlembur['subtotal']+$rowlembur2['subtotal2']+$rowcomlt['substaffcom'] + $com;
                  $grandtotal=$grandtotal+$totalgaji;
                  $jobdesk = $rowjobdesk['subjobdesk'];
                  $totaljobdesk =$totaljobdesk+$jobdesk;
                  $tj = $rowtj['subnominal'];
                  $totaltj =$totaltj+$tj;
                  $lb = $rowlembur['subtotal'];
                  $lb2 = $rowlembur2['subtotal2'];
                  $totallb =$totallb+$lb;
                  $totallb2 =$totallb2+$lb2;
                  $pk=$row['gaji'];
                  $bp=$row['bpjs'];
                  $totalpokok=$totalpokok+$pk;
                  $totalbpjs=$totalbpjs+$bp;
                  $totalcom=$totalcom+$com;
                  
                 // $tgjx=date($tgj, strtotime("-1 days"));
                  //$tgbu=date($day, strtotime("+1 months"));
                    echo"
                    <tr style='font-weight:bold;'>";
                      if($gj==1){
                        $akhir=date("Y-m-d", strtotime("+1 months",strtotime($tgawx)));
                        $akhir2=date("d", strtotime("-1 days",strtotime($akhir)));
                        echo"<td>".$gj."/".$bulan[$day]." - ".$akhir2."/".$bulan[$day]."/".$x."</td>";
                      }else{
                        $akhir=date("Y-m-d", strtotime("+1 months",strtotime($tgaw)));
                        $akhir2=date("d", strtotime("-1 days",strtotime($akhir)));
                        echo"<td>".$gj."/".$bulan[$day]." - ".$akhir2."/".$bulan[$dayx]."/".$x."</td>";
                      }
                    echo"
                    <td>".$rowstaff['name']." </br>Job Harian</td>
                    <td align='center'>Rp".number_format($row['gaji'], 0, ".", ".")."</br>Rp".number_format($rowjobdesk['subjobdesk'], 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($row['bpjs'], 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($rowtj['subnominal'], 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($com,0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($rowlembur['subtotal'], 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($rowlembur2['subtotal2'], 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($totalgaji, 0, ".", ".")."</td>

                    <td>
                    <span class='badge badge-success' onclick='editsallary(4,".$row['id'].",0,0)'>views lembur</span></br>
                    <span class='badge badge-warning' onclick='editsallary(5,".$row['id'].",0,0)'>views tunjangan</span></br>
                    <span class='badge badge-primary' onclick='editsallary(6,".$row['id'].",0,0)'>views job harian</span></br>
                    <span class='badge badge-danger' onclick='newTab(".$row['id'].")'>Print Sallary</span></br>
                    <td><button type='submit' onclick='deljobstaff(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
              </tr>";
          }

            
          echo"
              <tr style='font-weight:bold;'>
                    <td></td>    
                    <td align='center'> TOTAL :</td>
                    <td align='center'>Rp".number_format($totalpokok, 0, ".", ".")."</br>Rp".number_format($totaljobdesk, 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($totalbpjs, 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($totaltj, 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($totalcom,0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($totallb, 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($totallb2, 0, ".", ".")."</td>
                    <td align='center'>Rp".number_format($grandtotal, 0, ".", ".")."</td>
                    <td></td>
              </tr>
              <tr>";

                
                echo "
                </tbody>
                </table>";

?>