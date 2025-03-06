<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
  <style>
    .tableFixHead          { overflow-y: auto; height: 100px; }
    .tableFixHead thead th { position: sticky; top: 0; }

    /* Just common table stuff. Really. */
    th     { background:#ffff; }

  </style>
<?php
include "../db=connection.php";
include "../site.php";
session_start();


?>
 
<!-- End Facebook Pixel Code -->




<script>

  function printURL(url,x,y) {
    url = url+"?"+"id="+x+"&"+"id_package="+y;
    var printWindow = window.open( url);
    printWindow.print();
};
</script>

</head>
<body>


</table>
<div id="wrapper">
<div id="content-page">
<div class="container" >
  <div class="content_tour" itemscope itemtype="http://schema.org/Product">

        </div>
      <div style='margin-top: 20px;'>
       
              <?php
              include "site.php";
              include "db=connection.php";

              session_start();

              $querycategory = "SELECT * FROM tour_category";
              $rscategory=mysqli_query($con,$querycategory);
              while($rowcategory = mysqli_fetch_array($rscategory)){

                if($rowcategory['name']=='Land Tour Consortium' or $rowcategory['name']=='Land Tour Series'){
                 
                 
                        // $query = "SELECT DISTINCT tour_package,checkin FROM invoice WHERE month LIKE '".$_POST['tmonth']."' AND year LIKE '".$_POST['tyear']."' ORDER BY year ASC, month ASC, checkin ASC";
                        // $rs=mysqli_query($con,$query);
                     
                        $query = "SELECT DISTINCT tour_package,checkin FROM invoice  ORDER BY year ASC, month ASC, checkin ASC";
                        $rs=mysqli_query($con,$query);
                   


                  echo "<h3>Tagihan ".$rowcategory['name']."</h3>";

                  $arrayNamaAgent = array();
                  $arrayTotalDibayarkanAgent = array();
                  $arrayTotalInvoice = array();

                  $grandtotalKekuranganSupplier = array();
                  $invoiceKekuranganSupplier = array();

                  $grandtotalBank = 0;
                  $arrayNamaBank = array();
                  $arrayTotalPemasukanBank = array();
                  $querybank = "SELECT * FROM bank";
                  $rsbank=mysqli_query($con,$querybank);
                  while($rowbank = mysqli_fetch_array($rsbank)){
                    array_push($arrayNamaBank,$rowbank['id']);
                    array_push($arrayTotalPemasukanBank,0);
                  }
                  array_push($arrayNamaBank,0);

                  $arrayCategory = array();
                  $arrayTotalPemasukan = array();
                  if($rowcategory['name']=='Land Tour Consortium'){
                    $codecategory = 2;
                  }elseif($rowcategory['name']=='Land Tour Series'){
                    $codecategory = 1;
                  }
                  array_push($arrayCategory,'Land Tour Series');
                  array_push($arrayCategory,'Land Tour Consortium');
                  
                  for ($i = 0; $i < 2; $i++)
                  {
                    array_push($arrayTotalPemasukan,0);
                  }

                  while($row=mysqli_fetch_array($rs)){
                    $queryinvoice2 = "SELECT * FROM invoice WHERE tour_package=".$row['tour_package']." AND checkin LIKE '".$row['checkin']."'";
                    $rsinvoice2 = mysqli_query($con,$queryinvoice2);
                    $rowinvoice2 = mysqli_fetch_array($rsinvoice2);

                    $date1=date_create($rowinvoice2['checkin']);
                    $date2=date_create($_POST['tdate2']);
                    $diff = date_diff($date1,$date2);
                    $checkDiff = 0;
                    if($rowinvoice2['checkin']>=$_POST['tdate'] && $rowinvoice2['checkin']<=$_POST['tdate2']){
                      $checkDiff = 1;
                    }
                   
                   
                    

                    $cekCategory = 1;

                    $queryinvoice = "SELECT * FROM invoice WHERE tour_package=".$row['tour_package']." AND checkin LIKE '".$row['checkin']."'";
                    $rsinvoice = mysqli_query($con,$queryinvoice);
                    $rowinvoice = mysqli_fetch_array($rsinvoice);

                    $querypackage = "SELECT * FROM tour_package WHERE id=".$row['tour_package'];
                    $rspackage = mysqli_query($con,$querypackage);
                    $rowpackage = mysqli_fetch_array($rspackage);

                    if($rowpackage['category']==$rowcategory['name']){
                      $cekCategory = 1;
                    }else{
                      $cekCategory = 0;
                    }

                    if($cekCategory==1 && $checkDiff>0){
                     // echo $checkDiff;
                     // echo "</br>";
                      // echo "Date Awal : ".$_POST['tdate']."</br>";
                      // echo "Date Akhir : ".$_POST['tdate2']."</br>";
                      // echo "Date : ".$rowinvoice2['checkin']."</br>";
                      // echo "Invoice : ".$rowinvoice2['id']."</br>";
                        //echo "Invoice Category ".$rowcategory['name']." : ".$rowinvoice['id']."</br>";


                        //kekuranganpembayaransupplier
                      $totaldibayarkansupplier = 0;
                      $totalkekurangansupplier = 0;
                      $total_pembayaran = 0;
                      $querydetailpayment = "SELECT * FROM payment_detail_performatour WHERE invoice_id=".$rowinvoice['id'];
                      $rsdetailpayment = mysqli_query($con,$querydetailpayment);
                      while($rowdetailpayment = mysqli_fetch_array($rsdetailpayment)){
                        if($rowdetailpayment['img_bukti_bayar']!='' OR $rowdetailpayment['bukti_pembayaran']!=''){
                          $totaldibayarkansupplier = $totaldibayarkansupplier + $rowdetailpayment['total_dibayarkan'];
                        }
                        $total_pembayaran = $rowdetailpayment['total_pembayaran'];
                      }


                      $totalkekurangansupplier = $total_pembayaran - $totaldibayarkansupplier;

                      if($totalkekurangansupplier>0){
                          //echo "Invoice Id ".$rowinvoice['id']." : Rp ".number_format($totalkekurangansupplier, 0, ".", ".")."</br>";
                        array_push($invoiceKekuranganSupplier,$rowinvoice['id']);
                        array_push($grandtotalKekuranganSupplier,$totalkekurangansupplier);
                      } 
                        //kekuranganpembayaransupplier

                        //pemasukkan
                      for ($i = 0; $i < 2; $i++)
                      {
                        if($arrayCategory[$i]==$rowcategory['name']){

                          $querypemasukkan = "SELECT * FROM payment_detail WHERE invoice_id=".$rowinvoice['id'];
                          $rspemasukkan=mysqli_query($con,$querypemasukkan);
                          while($rowpemasukkan = mysqli_fetch_array($rspemasukkan)){
                            $arrayTotalPemasukan[$i] = $arrayTotalPemasukan[$i] + $rowpemasukkan['payment_price'];
                          }
                        }
                      }
                        //endpemasukkan


                        //pemasukkanberdasarkanbank
                      for ($i = 0; $i < count($arrayNamaBank)+1; $i++){
                        $querypemasukkan = "SELECT * FROM payment_detail WHERE payment_bank=".$arrayNamaBank[$i]." AND invoice_id=".$rowinvoice['id'];
                        $rspemasukkan=mysqli_query($con,$querypemasukkan);
                        while($rowpemasukkan = mysqli_fetch_array($rspemasukkan)){
                          if($rowpemasukkan['payment_type']!='Cash'){
                            $arrayTotalPemasukanBank[$i] = $arrayTotalPemasukanBank[$i] + $rowpemasukkan['payment_price'];
                          }else{
                            $grandtotalBank = $grandtotalBank + $rowpemasukkan['payment_price'];
                          }

                        }
                      }

                        //endpemasukkanberdasarkanbank

                      $queryagent2 = "SELECT * FROM payment_detail_performatour WHERE invoice_id=".$rowinvoice['id'];
                      $rsagent2=mysqli_query($con,$queryagent2);
                      $rowagent2 = mysqli_fetch_array($rsagent2);

                      $queryagent = "SELECT * FROM agent WHERE id =".$rowagent2['agent'];
                      $rsagent=mysqli_query($con,$queryagent);
                      $rowagent = mysqli_fetch_array($rsagent);

                      $queryagent3 = "SELECT COUNT(DISTINCT(agent)) as total FROM payment_detail_performatour";
                      $rsagent3=mysqli_query($con,$queryagent3);
                      $rowagent3 = mysqli_fetch_assoc($rsagent3);

                      $totalagent = $rowagent3['total'];

                          //echo $rowagent['company']." : Total = ".$rowagent2['total_dibayarkan']." </br>";



                      for ($i = 0; $i < $totalagent; $i++)
                      {
                        array_push($arrayTotalDibayarkanAgent,0);
                        array_push($arrayTotalInvoice, 0);

                      }

                      $queryagent4 = "SELECT DISTINCT(agent) FROM payment_detail_performatour";
                      $rsagent4=mysqli_query($con,$queryagent4);
                      while($rowagent4 = mysqli_fetch_array($rsagent4)){
                        array_push($arrayNamaAgent, $rowagent4['agent']);
                      }

                      for ($i = 0; $i < $totalagent; $i++)
                      {
                        $queryagentcount = "SELECT COUNT(*) as total FROM payment_detail_performatour WHERE agent=".$arrayNamaAgent[$i]." AND invoice_id=".$rowinvoice['id'];
                        $rsagentcount=mysqli_query($con,$queryagentcount);
                        $rowagentcount = mysqli_fetch_assoc($rsagentcount);

                        if($rowagentcount['total']>0){
                          $arrayTotalInvoice[$i] = $arrayTotalInvoice[$i] + 1;
                        }
                        if($arrayNamaAgent[$i]==$rowagent2['agent']){
                            //echo "Invoice Id  : ".$rowinvoice['id']." = ".$rowagent2['total_dibayarkan']."</br>";
                          $arrayTotalDibayarkanAgent[$i] = $arrayTotalDibayarkanAgent[$i] + $rowagent2['total_dibayarkan'];
                        }
                      }


                    }

                    
                   
                  }//end $row

                  echo "<table class='table table-hover table-bordered' style='font-size:14px;'>
                  <thead >
                  <th>Nama Agent</th>
                  <th>Total Invoice</th>
                  <th>Total Tagihan</th>
                  </thead>
                  <tbody id='myTable'>";
                  $queryagent3 = "SELECT COUNT(DISTINCT(agent)) as total FROM payment_detail_performatour";
                  $rsagent3=mysqli_query($con,$queryagent3);
                  $rowagent3 = mysqli_fetch_assoc($rsagent3);
                  $totalInvoice = 0;
                  $totalDibayarkan = 0;
                  for ($i = 0; $i < $rowagent3['total']; $i++)
                  {
                    $queryagent = "SELECT * FROM agent WHERE id =".$arrayNamaAgent[$i];
                    $rsagent=mysqli_query($con,$queryagent);
                    $rowagent = mysqli_fetch_array($rsagent);
                    if($arrayTotalDibayarkanAgent[$i]!=0){
                     $totalInvoice = $totalInvoice + $arrayTotalInvoice[$i];
                     $totalDibayarkan = $totalDibayarkan + $arrayTotalDibayarkanAgent[$i];
                     echo "<tr>";
                     echo "<td>".$rowagent['company']."</td>";
                     echo "<td>".$arrayTotalInvoice[$i]." Invoice</td>";
                     echo "<td>Rp ".number_format($arrayTotalDibayarkanAgent[$i], 0, ".", ".")."</td>";
                      //echo "Agent ".$rowagent['company']."</br> Total Pengeluaran : Rp ".number_format($arrayTotalDibayarkanAgent[$i], 0, ".", ".")."</br>";
                     echo "</tr>";
                    }
                   
                  }


                  echo "<tr style='color:blue;'>";
                  echo "<td></br></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";

                  echo "<tr style='color:blue;'>";
                  echo "<td>Total</td>";
                  echo "<td>".$totalInvoice." Invoice</td>";
                  echo "<td>Rp ".number_format($totalDibayarkan, 0, ".", ".")."</td>";
                  echo "</tr>";

                  $tempTotalKekuranganSupplier = 0;
                  for ($i = 0; $i < count($grandtotalKekuranganSupplier); $i++){
                    $tempTotalKekuranganSupplier = $tempTotalKekuranganSupplier + $grandtotalKekuranganSupplier[$i];
                  }
                  echo "<tr style='color:red;'>";
                  echo "<td>Total Kekurangan Pembayaran Supplier</td>";
                  echo "<td>";
                  $countEnter = 0; 
                  for ($i = 0; $i < count($invoiceKekuranganSupplier); $i++){
                    $countEnter = $countEnter + 1;
                    if($countEnter==5){
                      echo "<button onclick='searchInvoice(0,".$invoiceKekuranganSupplier[$i].",1)'>".$invoiceKekuranganSupplier[$i]."</button></br>";
                      $countEnter = 0;
                    }else{
                      echo "<button onclick='searchInvoice(0,".$invoiceKekuranganSupplier[$i].",1)'>".$invoiceKekuranganSupplier[$i]."</button> ";
                    }
                    
                    
                  }
                  echo "</td>";
                  echo "<td>Rp ".number_format($tempTotalKekuranganSupplier, 0, ".", ".")."</td>";
                  echo "</tr>";
                  echo "
                  </tbody>
                  </table>";

                  for ($i = 0; $i < 2; $i++)
                  {
                    if($arrayCategory[$i]==$rowcategory['name']){
                      echo "Total Pemasukkan : Rp ".number_format($arrayTotalPemasukan[$i], 0, ".", ".");
                      echo "</br>";
                      echo "Cash  = Rp ".number_format($grandtotalBank, 0, ".", ".");
                          echo "</br>";
                      for ($i = 0; $i < count($arrayNamaBank); $i++){
                        if($arrayTotalPemasukanBank[$i]!=0){
                          $querybank = "SELECT * FROM bank WHERE id=".$arrayNamaBank[$i];
                          $rsbank=mysqli_query($con,$querybank);
                          $rowbank = mysqli_fetch_array($rsbank);
                          echo $rowbank['nama']." ( ".$rowbank['short']." ) = Rp ".number_format($arrayTotalPemasukanBank[$i], 0, ".", ".");
                          echo "</br>";
                        }
                      }

                    }
                  }
                    
                  echo "</br>";

             }//end if
             elseif($rowcategory['name']=='Land Tour Series'){

             }

            }//end while category
              
              echo "</div>

              <!-- /.row -->";
              ?>

    

    </div>
</div>

</body>
</html>
