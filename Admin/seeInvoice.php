<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<style>
.tableFixHead          { overflow-y: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
th     { background:#ffff; }



.multiselect {
  width: 100%;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

</script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$querycountry = "SELECT * FROM invoice";
$rscountry=mysqli_query($con,$querycountry);

$querystaff = "SELECT * FROM login_staff";
$rsstaff=mysqli_query($con,$querystaff);

$querycategory = "SELECT * FROM tour_category";
$rscategory=mysqli_query($con,$querycategory);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Invoice</h3>
                <div class='input-group input-group-sm'>
                    <div>
                    <select class='chosen1' name='scountry' id='scountry' onchange='searchInvoice(0,this.value,1)' class='form-control'>
                    <option selected='selected' value=0>Search By Invoice Number</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['id']."</option>";
                    }
                    echo"</select>


                    <select class='chosen1' name='sstaff' id='sstaff' onchange='searchInvoice(0,this.value,2)' class='form-control'>
                    <option selected='selected' value=0>Search By Staff</option>";

                    while($rowstaff = mysqli_fetch_array($rsstaff)){
                      echo "<option value='".$rowstaff['id']."'>".$rowstaff['name']."</option>";
                    }
                    echo"</select>

                    <select class='chosen1' name='scategory' id='scategory' onchange='searchInvoice(1,this.value,2)' class='form-control'>
                    <option selected='selected' value=0>Search By Category</option>";

                    while($rowcategory = mysqli_fetch_array($rscategory)){
                      echo "<option value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                    }
                    echo"</select>
                    </br></br>";


                    echo "<button type='button' style='text-align:right;font-size:10px;' class='btn btn-primary' id='but_searchinvoice' onclick='reloadSeeInvoice(0,0,0,0,0,0,0)'>Search</button>";
                     echo "<button type='button' style='text-align:right;font-size:10px;margin-left:5px;' class='btn btn-success' id='but_clear' onclick='reloadDate()'>Reload</button>";

                    $querypackageT = "SELECT DISTINCT tour_package,checkin FROM invoice ORDER BY checkin ASC";
                    $rspackageT=mysqli_query($con,$querypackageT);
                    // echo "<select class='chosen1' onchange='reloadSeeInvoice(0,this.value,0,0,0,0,0)' name='searchseeinvoice' id='searchseeinvoice' class='form-control'>
                    // <option selected='selected' value=0>Pilihan</option>";

                     echo "<form>
                   <div class='multiselect' id='divselect'>
                   <div class='selectBox' onclick='showCheckboxes()'>
                   <select>
                   <option>Tour Group Checkin</option>
                   </select>
                   <div class='overSelect'></div>
                   </div>
                   <div id='checkboxes'>";
                   echo "<label>
                       <input type='checkbox' id='selectAll' name='selectAll' />Select All</label>";
                    while($rowpackageT = mysqli_fetch_array($rspackageT)){

                      $queryT = "SELECT * FROM tour_package WHERE id=".$rowpackageT['tour_package'];
                      $rsT=mysqli_query($con,$queryT);
                      $rowT = mysqli_fetch_array($rsT);

                      $cekDetailPassportT = 0;
                      $query2T = "SELECT *FROM invoice WHERE tour_package=".$rowpackageT['tour_package']." AND checkin LIKE '".$rowpackageT['checkin']."'";
                      $rs2T=mysqli_query($con,$query2T);
                      while($row2T = mysqli_fetch_array($rs2T)){
                        $cekDetailPassportT = 1;
                      }


                     
                      if($cekDetailPassportT==1){
                       // echo "<option value='".$rowT['id']."*".$rowpackageT['checkin']."'>".$rowpackageT['checkin']."  ||  888".$rowT['id']." ( ".$rowT['tour_name'].")</option>";

                       echo "
                       <label>
                       <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$rowT['id']."*".$rowpackageT['checkin']."' />".$rowpackageT['checkin']."  ||  888".$rowT['id']." ( ".$rowT['tour_name'].")</label>";

                     }
                   }

                   echo " </div>
                       </div>
                       </form>";
                   // echo"</select>";

                  
                   

                    echo "</div>";
                      echo "<table class='table-striped table-bordered table-sm' style='margin-top:-1%;margin-left:1%;'>

                      <tr>
                      <td>
                    <label>Date</label>
                    <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$dateNow."' style='height:2%;'/>
                    </td>
                    <td>
                    <label>Date 2</label>
                    <input class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;'/>
                    </td>
                    <td>
                    <button type='button' style='text-align:right;font-size:10px;' class='btn btn-primary' id='but_invoicecategory'>Total Category</button>
                    </td>
                    </tr>
                    </table>";
                    
                  
                    echo "
                  </div>
              
              </div>
              <!-- /.card-header -->
              <form method='post' name='bookForm' action='https://www.2canholiday.com/printreporttourlist.php'>
                  <input type='text' name='ttourpackage' id='ttourpackage' hidden>

                  <input type='text' name='tdate' id='tdate' hidden>
                  <input type='text' name='tday' id='tday' hidden>
                  <input type='text' name='tmonth' id='tmonth' hidden>
                  <input type='text' name='tyear' id='tyear' hidden>

                  <input type='text' name='tdate2' id='tdate2' hidden>
                  <input type='text' name='tday2' id='tday' hidden>
                  <input type='text' name='tmonth2' id='tmonth' hidden>
                  <input type='text' name='tyear2' id='tyear' hidden>
                  <input type='text' name='tpilihan' id='tpilihan' hidden>
                  <input type='text' name='tbeforenext' id='tbeforenext' hidden>
              </form>
              <div  id='myMidBody'>";
            

              
            
                // $tempdate = $_POST['tyear']."-".$_POST['tmonth']."-".$_POST['tday'];

                $tempdate2 = array();

                // if($_POST['tbeforenext']==1){
                //     if($_POST['ttourpackage']==0){
                //       if($_POST['tpilihan']==0){
                //         $query = "SELECT * FROM invoice WHERE DATE(checkin) >= DATE('".$tempdate."') ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==1){
                //         $query = "SELECT * FROM invoice WHERE month LIKE '".$_POST['tmonth']."' AND year LIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==2){
                //         $query = "SELECT * FROM invoice WHERE year LIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else{
                //         $query = "SELECT * FROM invoice  ORDER BY checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }

                //     }else{

                //       if($_POST['tpilihan']==0){
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." AND DATE(checkin) >= DATE('".$tempdate."') ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==1){
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." AND month LIKE '".$_POST['tmonth']."' AND year LIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==2){
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." AND yearLIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else{
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." ORDER BY month ASC, year ASC, checkin ASC";
                //       }
                //     }
                // }else{
                //   if($_POST['ttourpackage']==0){
                //       if($_POST['tpilihan']==0){
                //         $query = "SELECT * FROM invoice WHERE DATE(checkin) < DATE('".$tempdate."') ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==1){
                //         $query = "SELECT * FROM invoice WHERE month LIKE '".$_POST['tmonth']."' AND year LIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==2){
                //         $query = "SELECT * FROM invoice WHERE year LIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else{
                //         $query = "SELECT * FROM invoice  ORDER BY checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }
                      
                //     }else{
                      
                //       if($_POST['tpilihan']==0){
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." AND DATE(checkin) < DATE('".$tempdate."') ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==1){
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." AND month LIKE '".$_POST['tmonth']."' AND year LIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else if($_POST['tpilihan']==2){
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." AND yearLIKE '".$_POST['tyear']."' ORDER BY month ASC, year ASC, checkin ASC";
                //         $rs=mysqli_query($con,$query);
                //       }else{
                //         $query = "SELECT * FROM invoice WHERE tour_package = ".$_POST['ttourpackage']." ORDER BY month ASC, year ASC, checkin ASC";
                //       }
                //     }
                // }
               


               //echo  $query;
              //  echo  "asdasd".$_POST['tpilihan'];

              $tempdate = json_decode(stripslashes($_POST['tdate']));
              $tourpackage = json_decode(stripslashes($_POST['ttourpackage']));
              $tempString = '';
              // echo "----------- Jumlah : ".count($tempdate)."</br>";
              for ($x = 0; $x < count($tempdate); $x++) {
                // echo " -------- ".$tourpackage[$x]." ------- ".$tempdate[$x]."</br>";
                if($x==0){
                  $tempString = $tempString . " tour_package = ".$tourpackage[$x]." AND checkin LIKE '".$tempdate[$x]."'";
                }else{
                  $tempString = $tempString . " OR tour_package = ".$tourpackage[$x]." AND checkin LIKE '".$tempdate[$x]."'";
                }
              }

              $query = "SELECT * FROM invoice WHERE ".$tempString." ORDER BY checkin ASC";
              $rs=mysqli_query($con,$query);

                 echo "<table id='dtBasicExample' class='tableFixHead table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead >
                <tr>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Customer City & Phone</th>
                <th>Tour Package</th>
                <th>Agent</th>
                <th>Tour Type</th>
                <th>Tour Category</th>
                <th>Description</th>
                <th>Tgl Berangkat - Pulang</th>
                <th>adt</th>
                <th>cwb</th>
                <th>cnb</th>
                <th>inf</th>
                <th>sgl</th>
                <th>ttl</th>
                <th>Room </br>Single</th>
                <th>Room </br>Twin</th>
                <th>Room </br>Twin Extra</th>
                <th>Room </br>Double</th>
                <th>Room </br>Double Extra</th>
                <th>Grand Total Penjualan</th>
                <th>Total Dibayarkan Customer</th>
                <th>Kekurangan Pembayaran Customer</th>
                <th>Bank</th>
                <th>Estimasi Pembelian</th>
                <th>Grand Total Pembelian</th>
                <th>Total Dibayarkan ke Supplier</th>
                <th>Kekurangan Pembayaran ke Supplier</th>";

              
              
                echo "

                <th>Tambahan</th>
                <th>Laba Kotor</th>
                <th>Agent Com</th>
                <th>Staff Com 2</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                $grandtotalAll = 0;
                $grandtotalDibayarkan = 0;
                $grandtotalKekurangan = 0;
                $grandtotalpembelian = 0;
                $grandtotallabakotor = 0;
                $grandtotalnonprofit = 0;
                $grandtotalDibayarkanSupplier = 0;
                $grandtotalKekuranganSupplier = 0;
                $grandtotalAgentCom = 0;
                $grandtotalStaffCom = 0;

                $grandtotalPax = 0;
                $grandtotalAdult = 0;
                $grandtotalCWB = 0;
                $grandtotalCNB = 0;
                $grandtotalInfant = 0;
                $grandtotalSingle = 0;
               
                $grandtotalPaxRoom = 0;
                $grandtotalSingleR = 0;
                $grandtotalTwin = 0;
                $grandtotalTwinExtra = 0;
                $grandtotalDouble = 0;
                $grandtotalDoubleExtra = 0;
                $grandtotalPayment = 0;
                while($row=mysqli_fetch_array($rs)){
                  
                  array_push($tempdate2,$row['checkin']);
                  
                
                  if($row['staff_id']!=''){
                    $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff_id'];
                    $rsstaff = mysqli_query($con,$querystaff);
                    $rowstaff = mysqli_fetch_array($rsstaff);
                  }

                  if($row['customer_id']!=''){
                    $querycustomer = "SELECT * FROM customer_list WHERE id=".$row['customer_id'];
                    $rscustomer = mysqli_query($con,$querycustomer);
                    $rowcustomer = mysqli_fetch_array($rscustomer);
                  }
                  $querydetailpayment = "SELECT * FROM payment_detail_performatour WHERE invoice_id=".$row['id'];
                  $rsdetailpayment = mysqli_query($con,$querydetailpayment);
                  $totaldibayarkansupplier = 0;
                  $totalkekurangansupplier = 0;
                  $total_pembayaran = 0;
                  while($rowdetailpayment = mysqli_fetch_array($rsdetailpayment)){
                    $totaldibayarkansupplier = $totaldibayarkansupplier + $rowdetailpayment['total_dibayarkan'];
                    $total_pembayaran = $rowdetailpayment['total_pembayaran'];
                  }

                  $querybank = "SELECT * FROM bank WHERE id=".$row['payment_bank'];
                  $rsbank = mysqli_query($con,$querybank);
                  $rowbank = mysqli_fetch_array($rsbank);

                  $querypackage = "SELECT * FROM tour_package WHERE id=".$row['tour_package'];
                  $rspackage = mysqli_query($con,$querypackage);
                  $rowpackage = mysqli_fetch_array($rspackage);

                  $querypayment = "SELECT * FROM payment_detail WHERE invoice_id=".$row['id'];
                  $rspayment = mysqli_query($con,$querypayment);
                  $totaldibayarkan = 0;
                  $totalkekurangan = 0;
                  while($rowpayment = mysqli_fetch_array($rspayment)){
                    $totaldibayarkan = $totaldibayarkan + $rowpayment['payment_price'];
                  }
                  $totalpembelian = $total_pembayaran;
                  $totallabakotor = $row['grandtotal'] - $total_pembayaran;
                  $totalkekurangan = $row['grandtotal'] - $totaldibayarkan;
                  $totalkekurangansupplier = $total_pembayaran - $totaldibayarkansupplier;

                  $tempPax = preg_split ("/[;]+/", $row['additional_pax']);
                  $tempPrice = preg_split ("/[;]+/", $row['additional_price']);
                  $tempName = preg_split ("/[;]+/", $row['additional_name']);
                  $totalnonprofit = 0;
                  $pId = 0;
                  $totalPax = 0;
                  $totalAdult = 0;
                  $totalCWB = 0;
                  $totalCNB = 0;
                  $totalInfant = 0;
                  $totalSingle = 0;

                  $totalPaxRoom = 0;
                  $totalSingleR = 0;
                  $totalTwin = 0;
                  $totalTwinExtra = 0;
                  $totalDouble = 0;
                  $totalDoubleExtra = 0;
                  $totalAgentCom = 0;

                  for($i2=0; $i2<count($tempPrice); $i2++){


                    if($i2==0 or $i2==1 or $i2==2 or $i2==3 or $i2==4 or $tempName[$i2]=='Tipping' and $tempPax[$i2]!=0){
                      $query_range = "SELECT * FROM performa_price_range";
                      $rs_range=mysqli_query($con,$query_range);
                      while($row_range = mysqli_fetch_array($rs_range)){
                        if($row_range['price2']==1){
                          if($tempPrice[$i2]<=$row_range['price1']){
                            $pId = $row_range['id'];
                          }
                        }else if($row_range['price2']==0){
                          if($tempPrice[$i2]>=$row_range['price1']){
                            $pId = $row_range['id'];
                          }

                        }else{
                          if($tempPrice[$i2]>$row_range['price1'] && $tempPrice[$i2]<=$row_range['price2']){
                            $pId = $row_range['id'];
                          }

                        }
                      }
                    }

                    $query_performa = "SELECT * FROM performa_price WHERE performa_price_range=".$pId." AND tour_package = ".$row['tour_package'];
                    $rs_performa=mysqli_query($con,$query_performa);
                    $row_performa = mysqli_fetch_array($rs_performa);


                    if($row_performa['option_price']==1){
                      $pricesesungguhnya = $tempPrice[$i2] - ($tempPrice[$i2]*$row_performa['persentase']/100);
                      $totalnonprofit = $totalnonprofit + ($pricesesungguhnya*$tempPax[$i2]);
                    }else{
                      $pricesesungguhnya = $tempPrice[$i2] - ($tempPrice[$i2]+$row_performa['nominal']);
                      $totalnonprofit = $totalnonprofit + ($pricesesungguhnya*$tempPax[$i2]);
                    }

                    // if($pricesesungguhnya!=0 && $_SESSION['staff_id']==1){
                    //  echo "<div class='container'>";
                    //  echo $row['id']." - ".$row['tour_package']."</br>";
                    //  echo $pricesesungguhnya."</br>";
                    //  echo $pricesesungguhnya*$tempPax[$i2]."</br>";
                    //  echo "</div>";
                    // }
                    
                    
                    
                  }

                   for($i=0; $i<count($tempName); $i++){
                    if($tempName[$i]=='AgentCom'){
                      $totalAgentCom = $totalAgentCom + ($tempPrice[$i] * $tempPax[$i]);
                    }
                   }

                  for($i=0; $i<count($tempPax); $i++){
                    if($i==0){
                      $totalAdult = $totalAdult + $tempPax[$i];
                    }
                    if($i==1){
                      $totalCWB = $totalCWB + $tempPax[$i];
                    }
                    if($i==2){
                      $totalCNB = $totalCNB + $tempPax[$i];
                    }
                    if($i==3){
                      $totalInfant = $totalInfant + $tempPax[$i];
                    }
                    if($i==4){
                      $totalSingle = $totalSingle + $tempPax[$i];
                    }

                  }

                  for($i=0; $i<count($tempPax); $i++){
                    if($i==5){
                      $totalSingleR = $totalSingleR + $tempPax[$i];
                    }
                    if($i==6){
                      $totalTwin = $$totalTwin + $tempPax[$i];
                    }
                    if($i==7){
                      $totalTwinExtra = $totalTwinExtra + $tempPax[$i];
                    }
                    if($i==8){
                      $totalDouble = $totalExtra + $tempPax[$i];
                    }
                    if($i==9){
                      $totalDoubleExtra = $totalDoubleExtra + $tempPax[$i];
                    }

                  }

                  $totalPax = $totalAdult + $totalCWB + $totalCNB + $totalInfant + $totalSingle;
                  $totalPaxRoom = $totalSingleR + $totalTwin + $totalTwinExtra + $totalDouble + $totalDoubleExtra;
 if($row['status']==0){
                    echo"
                  <tr style='font-weight:bold;color:red'>";
                  }else{
                    echo"
                  <tr style='font-weight:bold;color:black'>";
                  }
                  


                  echo "<td>".$row['id']."</br><button type='submit' style='font-size:10px;' onclick='seeDetail(".$row['id'].",".$row['id'].")' class='btn btn-success'>See Detail</button> <button type='submit' style='font-size:10px;' onclick='closeDetail(".$row['id'].",".$row['id'].")' class='btn btn-danger'>Close Detail</button><button type='submit' style='font-size:10px;' onclick='printItinerary(2,".$rowpackage['id'].")' class='btn btn-primary'>Print Itinerary</button></td>
                  <td>".$rowcustomer['customer_name']."</br></br>";

                  $querydetailpassport = "SELECT COUNT(*) as total FROM invoice_detail_passport WHERE invoice_id=".$row['id'];
                  $rsdetailpassport = mysqli_query($con,$querydetailpassport);
                  $rowdetailpassport = mysqli_fetch_assoc($rsdetailpassport);
                  if($rowdetailpassport['total']!=$totalPax){
                    echo "<button type='submit' onclick='insertDetailPassport(0,".$row['id'].",0)' class='btn btn-primary' style='font-size:10px'>Input Detail Passport</button></br>";
                  }
                  

                  echo "
                  ".$row['stamp']."
                  </td>
                  <td>".$rowcustomer['city']."</br>
                  ".$rowcustomer['phone_number']."</br>
                  <a href='https://www.2canholiday.com/printInvoice.php?id=".$row['id']."&id_package=".$row['id']."' target='_blank'><button class='btn btn-primary' style='font-size:11px;'>Print Invoice Awal</button></a></br</br>
                  <a href='https://www.2canholiday.com/printInvoiceProgress.php?id=".$row['id']."&id_package=".$row['id']."' target='_blank'><button class='btn btn-success' style='font-size:11px;'>Print Invoice Progress</button></a></td>
             
                 
                  <td>".$rowpackage['tour_name']." - ".$row['tour_package']."</td>";
                  $queryagent = "SELECT * FROM agent WHERE id =".$rowpackage['agent'];
                  $rsagent=mysqli_query($con,$queryagent);
                  $rowagent = mysqli_fetch_array($rsagent);

                  echo "
                  <td>".$rowagent['company']."</td>
                  <td>".$rowpackage['tour_type']."</td>
                  <td>".$rowpackage['category']."</td>
                  <td>".$row['description']."</td>
                  <td>".$row['checkin']." / ".$row['checkout']."</td>";
                 
                  if($totalAdult!=0){
                    echo "<td>".$totalAdult."</td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalCWB!=0){
                    echo "<td>".$totalCWB." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalCNB!=0){
                    echo "<td>".$totalCNB." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalInfant!=0){
                    echo "<td>".$totalInfant." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalSingle!=0){
                    echo "<td>".$totalSingle." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  echo "<td>".$totalPax."</td>";



                if($totalSingleR!=0){
                    echo "<td>".$totalSingleR."</td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalTwin!=0){
                    echo "<td>".$totalTwin." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalTwinExtra!=0){
                    echo "<td>".$totalTwinExtra." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalDouble!=0){
                    echo "<td>".$totalDouble." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($totalDoubleExtra!=0){
                    echo "<td>".$totalDoubleExtra." </td>";
                  }else{
                    echo "<td>0</td>";
                  }


                  $totalkekurangan = $totalkekurangan * -1;
                  $totalkekurangansupplier = $totalkekurangansupplier * -1;

                  echo "
                  
                  <td>Rp ".number_format($row['grandtotal'], 0, ".", ".")."</td>
                  
                  <td>Rp ".number_format($totaldibayarkan, 0, ".", ".")."</br>
                  ".$row['payment']."</br>
                  <button type='submit' onclick='insertPayment(0,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(0,".$row['id'].",0)' class='btn btn-primary' style='font-size:11px;'>Cek</button></td>
                  
                  <td>Rp ".number_format($totalkekurangan, 0, ".", ".")."</td>
                  <td>".$rowbank['short']." ( ".$rowbank['nama']." )</td>
               
                 
                  <td>Rp ".number_format($totalnonprofit, 0, ".", ".")."</td>
                  <td>Rp ".number_format($total_pembayaran, 0, ".", ".")."</td>";
                  if($totaldibayarkansupplier==0 && $totalkekurangansupplier==0){
                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></br>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")." </br>";
                  }else{
                    echo "<td>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")."</br>";
                  }
                  

                  echo "<button type='submit' onclick='insertPayment(-1,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(-1,".$row['id'].",0)'  class='btn btn-primary' style='font-size:11px;'>Cek</button></td>
                  <td>Rp ".number_format($totalkekurangansupplier, 0, ".", ".")."</td>";
                    echo "

                  ";
                  
                  echo "

                  <td><button type='submit' onclick='insertVisaPassport(0,".$row['id'].",0)' class='btn btn-success' style='font-size:11px;'>+ Visa Passport</button></br></br>
                  <button type='submit' onclick='reloadFlight(0,".$row['id'].",0)' class='btn btn-success' style='font-size:11px;'>+ Flight</button></br>
                  </td>
                  <td>Rp ".number_format($totallabakotor, 0, ".", ".")."</td>
                   <td>Rp ".number_format($totalAgentCom, 0, ".", ".")."</td>
                  <td>".$rowstaff['name']."</br>
                  Rp ".number_format($row['staff_com'], 0, ".", ".")."</td>";

                
                  echo "<td><button type='submit' onclick='editInvoice(0,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delInvoice(".$row['id'].",".$row['staff_id'].",".$_SESSION['staff_id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                  </tr>";

                  echo "<tr>
                  <td><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";

                  $grandtotalAll = $grandtotalAll + $row['grandtotal'];
                  $grandtotalDibayarkan = $grandtotalDibayarkan + $totaldibayarkan;
                  $grandtotalKekurangan = $grandtotalKekurangan + $totalkekurangan;
                  $grandtotalpembelian = $grandtotalpembelian + $totalpembelian; 
                  $grandtotallabakotor = $grandtotallabakotor + $totallabakotor;
                  $grandtotalnonprofit = $grandtotalnonprofit + $totalnonprofit;
                  $grandtotalDibayarkanSupplier = $grandtotalDibayarkanSupplier + $totaldibayarkansupplier;
                  $grandtotalKekuranganSupplier = $grandtotalKekuranganSupplier + $totalkekurangansupplier;
                  $grandtotalPax = $grandtotalPax + $totalPax;
                  $grandtotalAdult = $grandtotalAdult + $totalAdult;
                  $grandtotalCWB = $grandtotalCWB + $totalCWB;
                  $grandtotalCNB = $grandtotalCNB + $totalCNB;
                  $grandtotalInfant = $grandtotalInfant + $totalInfant;
                  $grandtotalSingle = $grandtotalSingle + $totalSingle;

                  $grandtotalSingleR = $grandtotalSingleR + $totalSingleR;
                  $grandtotalTwin = $grandtotalTwin + $totalTwin;
                  $grandtotalTwinExtra = $grandtotalTwinExtra + $totalTwinExtra;
                  $grandtotalDouble = $grandtotalDouble + $totalDouble;
                  $grandtotalDoubleExtra = $grandtotalDoubleExtra + $totalDoubleExtra;

                  $grandtotalAgentCom = $grandtotalAgentCom + $totalAgentCom;
                  $grandtotalStaffCom = $grandtotalStaffCom + $row['staff_com'];
                }
                $tempdate2 = array_unique($tempdate2);

                echo"
                  <tr style='font-weight:bold;'>
                  
                  <td colspan='8'><center>Total : <i class='fa fa-book' onclick='seeBuktiBayar()' aria-hidden='true'>".count($tempdate2)."</i></center></td>
                  ";
                  
                  if($grandtotalAdult!=0){
                    echo "<td>".$grandtotalAdult."</td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalCWB!=0){
                    echo "<td>".$grandtotalCWB." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalCNB!=0){
                    echo "<td>".$grandtotalCNB." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalInfant!=0){
                    echo "<td>".$grandtotalInfant." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalSingle!=0){
                    echo "<td>".$grandtotalSingle." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  echo "<td>".$grandtotalPax."</td>";


                  
                  if($grandtotalSingleR!=0){
                    echo "<td>".$grandtotalSingleR."</td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalTwin!=0){
                    echo "<td>".$grandtotalTwin." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalTwinExtra!=0){
                    echo "<td>".$grandtotalTwinExtra." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalDouble!=0){
                    echo "<td>".$grandtotalDouble." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  if($grandtotalDoubleExtra!=0){
                    echo "<td>".$grandtotalDoubleExtra." </td>";
                  }else{
                    echo "<td>0</td>";
                  }
                  
                  echo "
                  
                  
                  <td>Rp ".number_format($grandtotalAll, 0, ".", ".")."</td>
                  
                  <td>Rp ".number_format($grandtotalDibayarkan, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalKekurangan, 0, ".", ".")."</td>
                  <td></td>
               
                  <td>Rp ".number_format($grandtotalnonprofit, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalpembelian, 0, ".", ".")."</td>
                  
                  <td>Rp ".number_format($grandtotalDibayarkanSupplier, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalKekuranganSupplier, 0, ".", ".")."</td>
                  <td></td>

             
                  <td>Rp ".number_format($grandtotallabakotor, 0, ".", ".")."</td>

                  <td>Rp ".number_format($grandtotalAgentCom, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalStaffCom, 0, ".", ".")."</td>
                  <td></td>

                  </tr>";
                echo "
                </tbody>
                </table>
                <div id='divBuktiPembayaran'>

                </div>
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
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

    $('input[name="datefilter3"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
  });

  $("#selectAll").click(function() {
    $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
  });

  $("#but_invoicecategory").click(function(){
        var fd = new FormData();
     
        var date=new Date($('input[name="datefilter2"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var date2=new Date($('input[name="datefilter3"]').val());
        var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
        var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
        var year2 = date2.getFullYear();
       
        fd.append('month',month);
        fd.append('year',year);
        fd.append('day',day);

        var tdate = year + "-" + month + "-" + day;
        var tdate2 = year2 + "-" + month2 + "-" + day2;

       $("input[name=tdate]").val(tdate);
       $("input[name=tpilihan]").val(0);
       $("input[name=tday]").val(day);
       $("input[name=tmonth]").val(month);
       $("input[name=tyear]").val(year);
       $("input[name=tdate2]").val(tdate2);
        $("input[name=tday2]").val(day2);
       $("input[name=tmonth2]").val(month2);
       $("input[name=tyear2]").val(year2);
       $("input[name=tbeforenext]").val(0);

       var queryString = $('form[name="bookForm"]').serialize();        
        //window.open('https://www.2canholiday.com/Admin/printReportInvoiceCategory.php?'+ queryString +'', '_blank');
        $.ajax({

        url:"printReportInvoiceCategory.php",

        method: "POST",

        asynch: false,

       data:{'tdate':tdate,'tdate2':tdate2},

        success:function(data){

          $("#divReloadPage").html(data);

        }

      });
    });

  function printItinerary(x,y){
    window.open("https://www.2canholiday.com/print.php?id="+x+"&id_package="+y,"Print");
  }

  function seeBuktiBayar(){

    var tourpackage = <?php echo json_encode($tourpackage); ?>;
    var date = <?php echo json_encode($tempdate); ?>;
    tourpackage = JSON.stringify(tourpackage);
    date = JSON.stringify(date);

    $.ajax({
          type:'POST',
          url:'searchcekbuktipembayaran2.php',
          data:{'ttourpackage':tourpackage,'tdate':date,'tipe':1},
          success:function(data){
           $('#divBuktiPembayaran').html(data);
         }
       });
  }

  function reloadDate(){
      var date=new Date($('input[name="datefilter2"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var date2=new Date($('input[name="datefilter3"]').val());
      var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
      var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
      var year2 = date2.getFullYear();

      var tdate = year + "-" + month + "-" + day;
      var tdate2 = year2 + "-" + month2 + "-" + day2;
       $.ajax({
          type:'POST',
          url:'reloadSearchInvoice.php',
          data:{'tdate':tdate,'tdate2':tdate2},
          success:function(data){
           $('#divselect').html(data);
         }
       });
  }

  function seeDetail(x,y){
    $.ajax({
          type:'POST',
          url:'seeInvoiceDetail.php',
          data:{'id':x,'invoiceId':y},
          success:function(data){
           $('#divDetail'+x).html(data);
         }
       });
  }

  function closeDetail(x,y){
     $('#divDetail'+x).html('');
  }

  function updateHandle(x,z){
    var txt;
    if(z==0){
      var r = confirm("Are you sure to make this invoice Lunas?");
    }else{
      var r = confirm("Are you sure to make this invoice Belum Lunas?");
    }

    
    if (r == true) {

     $.ajax({
        url:"updateStatusInvoice.php",
        method: "POST",
        asynch: false,
        data:{id:x,flag:z},
        success:function(data){
          if(data=="success"){
            reloadInvoice(0,0,0);
          }else{
            alert("Fail to Update");
          }
        }
      });
    } 
  }
  
 
  function delInvoice(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete Invoice "+x+"?");
    if (r == true) {
      if(y==z){
        $.ajax({
          url:"delInvoice.php",
          method: "POST",
          asynch: false,
          data:{id:x},
          success:function(data){
            if(data=="success"){
              reloadInvoice(0,0,0);
              alert(data);
            }else{
              alert("Fail to Delete");
            }
          }
        });
      }else{
        alert("Kamu Tidak Punya Hak Menghapus Invoice Ini");
      }
    
    } 
  }
</script>
