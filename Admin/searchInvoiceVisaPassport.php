<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$querycountry = "SELECT * FROM invoiceVisaPassport ORDER BY id ASC";
$rscountry=mysqli_query($con,$querycountry);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Invoice Visa Passport</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 300px;'>

                    <select class='chosen1' name='scountry' id='scountry' onchange='searchInvoice(-1,this.value)' class='form-control' >
                    <option selected='selected' value=0>Search By Invoice Number</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['id']."</option>";
                    }
                    echo"</select>
                    
                    <div class='input-group-append'>";
                    
                    echo "<button type='submit' onclick='insertCustomer(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>";
                    
                    echo "</div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div  id='myMidBody'>";
            

                $query = "SELECT * FROM invoiceVisaPassport WHERE id=".$_POST['id']." ORDER BY id ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Print Invoice</th>
                <th>Customer Phone</th>
                <th>Type</th>
                <th>Nama Paket</th>
                <th>Jenis</th>
                <th>Total Pax</th>
                <th>Grand Total Penjualan</th>
                <th>Total Dibayarkan Customer</th>
                <th>Kekurangan Pembayaran Customer</th>
                <th>Bank</th>
                <th>Total Dibayarkan Supplier</th>
                <th>Kekurangan Pembayaran ke Supplier</th>
                <th>Staff Com 2</th>
                <th>Status</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                $grandtotalAll = 0;
                $grandtotalDibayarkan = 0;
                $grandtotalKekurangan = 0;
                $grandtotalDibayarkanSupplier = 0;
                $grandtotalKekuranganSupplier = 0;
                $grandtotalStaffCom = 0;

                $grandtotalPax = 0;
                $grandtotalPayment = 0;
                while($row=mysqli_fetch_array($rs)){
                  
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
                  $querybank = "SELECT * FROM bank WHERE id=".$row['payment_bank'];
                  $rsbank = mysqli_query($con,$querybank);
                  $rowbank = mysqli_fetch_array($rsbank);

                  if($row['type']==0){
                    $querypackage = "SELECT * FROM passport WHERE id=".$row['passportVisaId'];
                    $rspackage = mysqli_query($con,$querypackage);
                    $rowpackage = mysqli_fetch_array($rspackage);
                  }else{
                    $querypackage = "SELECT * FROM visa WHERE id=".$row['passportVisaId'];
                    $rspackage = mysqli_query($con,$querypackage);
                    $rowpackage = mysqli_fetch_array($rspackage);
                  }
                  
                  if($row['type']==0){
                    $querypayment = "SELECT * FROM payment_detail_visapassport WHERE type=0 AND invoice_id=".$row['id'];
                    $rspayment = mysqli_query($con,$querypayment);
                    $totaldibayarkan = 0;
                    while($rowpayment = mysqli_fetch_array($rspayment)){
                      $totaldibayarkan = $totaldibayarkan + $rowpayment['payment_price'];
                    }

                    $totalkekurangan = $row['grandtotal'] - $totaldibayarkan;
                  }else{
                    $querypayment = "SELECT * FROM payment_detail_visapassport WHERE type=1 AND invoice_id=".$row['id'];
                    $rspayment = mysqli_query($con,$querypayment);
                    $totaldibayarkan = 0;
                    while($rowpayment = mysqli_fetch_array($rspayment)){
                      $totaldibayarkan = $totaldibayarkan + $rowpayment['payment_price'];
                    }

                    $totalkekurangan = $row['grandtotal'] - $totaldibayarkan;
                  }

                  $querydetailpayment = "SELECT * FROM payment_detail_performavisapassport WHERE invoice_id=".$row['id'];
                  $rsdetailpayment = mysqli_query($con,$querydetailpayment);
                  $totaldibayarkansupplier = 0;
                  $totalkekurangansupplier = 0;
                  $total_pembayaran = 0;
                  while($rowdetailpayment = mysqli_fetch_array($rsdetailpayment)){
                    if($rowdetailpayment['img_bukti_bayar']!='' OR $rowdetailpayment['bukti_pembayaran']!=''){
                      $totaldibayarkansupplier = $totaldibayarkansupplier + $rowdetailpayment['total_dibayarkan'];
                    }
                    $total_pembayaran = $rowdetailpayment['total_pembayaran'];
                  }

                  $totalkekurangansupplier = $total_pembayaran - $totaldibayarkansupplier;
                  
                  $totalPax = 0;
                  $totalkekurangan = $totalkekurangan * -1;

                  $totalkekurangansupplier = $totalkekurangansupplier * -1;

                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['id']."</td>
                  <td>".$rowcustomer['customer_name']."</br></br>
                  ".$row['stamp']."
                  </td>
                  <td>".$rowcustomer['city']."</td>
                  <td><a href='https://www.2canholiday.com/printInvoiceVisaPassport.php?type=".$row['type']."&id=".$row['id']."&id_package=".$row['id']."' target='_blank'><button class='btn btn-primary' style='font-size:11px;'>Print Invoice Awal</button></a></br</br>
                  <a href='https://www.2canholiday.com/printInvoiceVisaPassportProgress.php?type=".$row['type']."&id=".$row['id']."&id_package=".$row['id']."' target='_blank'><button class='btn btn-success' style='font-size:11px;'>Print Invoice Progress</button></a></td>
                  <td>".$rowcustomer['phone_number']."</td>";

                  if($row['type']==0){
                    echo "<td>Passport ".$rowpackage['zone']."</td>";
                  }else{
                    $querycountry2 = "SELECT * FROM country WHERE id=".$rowpackage['country'];
                    $rscountry2 = mysqli_query($con,$querycountry2);
                    $rowcountry2 = mysqli_fetch_array($rscountry2);
                    echo "<td>Visa ".$rowcountry2['name']."</td>";
                  }
                  
                  echo "<td>".$row['namapaket']."</td>
                  <td>".$row['jenis']."</td>";
                  
                  echo "<td>".$row['person']."</td>";

                  echo "<td>Rp ".number_format($row['grandtotal'], 0, ".", ".")."</td>
                  <td>Rp ".number_format($totaldibayarkan, 0, ".", ".")."</br>
                  ".$row['payment']."</br>
                  <button type='submit' onclick='insertPayment(1,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(1,".$row['id'].",0)' class='btn btn-primary' style='font-size:11px;'>Cek</button>
                  </td>
                  <td>Rp ".number_format($totalkekurangan, 0, ".", ".")."</td>
                  <td>".$rowbank['short']." ( ".$rowbank['nama']." )</td>

                  ";
                    
                  if($totaldibayarkansupplier==0 && $totalkekurangansupplier==0){
                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></br>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")." </br>";
                  }else{
                    echo "<td>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")."</br>";
                  }
                    echo "<button type='submit' onclick='insertPayment(-3,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(-2,".$row['id'].",0)'  class='btn btn-primary' style='font-size:11px;'>Cek</button></td>

                  ";

                  echo "<td>Rp ".number_format($totalkekurangansupplier, 0, ".", ".")."</td>";
                  
                  echo "
                  <td>".$rowstaff['name']."</br>
                  Rp ".number_format($row['staff_com'], 0, ".", ".")."</td>";

                  if($row['status']=='0'){
                    echo "<td><button class='btn btn-danger' style='font-size:11px;'>Belum Lunas</button></td>";
                  }else{
                    echo "<td><button class='btn btn-success' style='font-size:11px;'>Sudah Lunas</button></td>";
                  }

                  echo "<td><button type='submit' onclick='editInvoice(0,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                  </tr>";

                  echo "<tr>
                  <td><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";

                  $grandtotalAll = $grandtotalAll + $row['grandtotal'];
                  $grandtotalDibayarkan = $grandtotalDibayarkan + $totaldibayarkan;
                  $grandtotalKekurangan = $grandtotalKekurangan + $totalkekurangan;
                  $grandtotalDibayarkanSupplier = $grandtotalDibayarkanSupplier + $totaldibayarkansupplier;
                  $grandtotalKekuranganSupplier = $grandtotalKekuranganSupplier + $totalkekurangansupplier;
                  $grandtotalPax = $grandtotalPax + $row['person'];
                  $grandtotalStaffCom = $grandtotalStaffCom + $row['staff_com'];
                
                }
                echo"
                  <tr style='font-weight:bold;'>
                  <td>Total : </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>";
                  
                  
                  echo "<td>".$grandtotalPax."</td>";
                  echo "
                  <td>Rp ".number_format($grandtotalAll, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalDibayarkan, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalKekurangan, 0, ".", ".")."</td>

                  <td></td>

                   <td>Rp ".number_format($grandtotalDibayarkanSupplier, 0, ".", ".")."</td>

                  <td>Rp ".number_format($grandtotalKekuranganSupplier, 0, ".", ".")."</td>
                  <td>Rp ".number_format($grandtotalStaffCom, 0, ".", ".")."</td>

                  <td></td>

                  <td></td>

                  </tr>";
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
        url:"updateStatusInvoiceVisaPassport.php",
        method: "POST",
        asynch: false,
        data:{id:x,flag:z},
        success:function(data){
          if(data=="success"){
            reloadInvoice(1,0,0);
          }else{
            alert("Fail to Update");
          }
        }
      });
    } 
  }
  
 
  function delInvoiceVisaPassport(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delInvoiceVisaPassport.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadCustomer(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

