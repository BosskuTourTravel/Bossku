<?php
session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Pembayaran</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadInvoice(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>

                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM payment_detail_visatransport WHERE invoice_id = ".$_POST['id']." ORDER BY payment_number ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Invoice Number</th>
                <th>Pembayaran Ke</th>
                <th>Payment Price</th>
                <th>Tipe Pembayaran</th>
                <th>Bank Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                while($row=mysqli_fetch_array($rs)){
                  
                   $querybank = "SELECT * FROM bank WHERE id=".$row['payment_bank'];
                  $rsbank = mysqli_query($con,$querybank);
                  $rowbank = mysqli_fetch_array($rsbank);

                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['invoice_id']."</td>
                  <td>".$row['payment_number']."</td>
                  <td>Rp ".number_format($row['payment_price'], 0, ".", ".")."</td>
                  <td>".$row['payment_type']."</td>
                  <td>".$rowbank['short']."</td>
                  
                  <td><img src='https://2canholiday.com/".$row['payment_photo']."' style='height:100px;width:50px;'></td>";

                  echo "<td><button type='submit' onclick='' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                  </tr>";

                  echo "<tr>
                  <td><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";
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
  function delPaymentDetail(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delStaff.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-3,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

