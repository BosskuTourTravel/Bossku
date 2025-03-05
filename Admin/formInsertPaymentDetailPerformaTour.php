  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

session_start();

if($_SESSION['staff_id']=='null' || $_SESSION['staff_id']=='undefined' || $_SESSION['staff_id']==''){
  echo "<script>alert('Session Login Berakhir, Harap Login Kembali!');</script>";
  echo "<script>window.location='https://www.2canholiday.com/member/';</script>";
}

$queryagent = "SELECT * FROM agent";
$rsagent=mysqli_query($con,$queryagent);

$querybank = "SELECT * FROM bank";
$rsbank=mysqli_query($con,$querybank);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT PAYMENT PERFORMA</h3>
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
              <div class='card-body table-responsive p-0'>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                  <div class=form-group'>
                      <label>Agent :</label>
                      <select class='chosen' name='paymentagent' id='paymentagent'>
                      <option selected='selected' value=0>Pilihan</option>";
                      while($rowagent=mysqli_fetch_array($rsagent)){
                        echo "<option value=".$rowagent['id'].">".$rowagent['company']." ( ".$rowagent['name']." )</option>";
                    }
                    echo "</select></div>";

                    echo " <div class='form-group'>
                      <label>Date</label>
                      <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$dateNow."' style='width: 100%;' />
                    </div>
                    <div class='form-group'>
                    <label>Total Pembayaran</label>
                    <input type='text' class='form-control' name='totalpayment' id='totalpayment' placeholder='Enter Harga Yang Harus Dibayarkan ( Angka Saja )'>
                  </div>";
                  echo "<div class='form-group'>
                  <input type='text' class='form-control' name='invoiceid' id='invoiceid' value='".$_POST['id']."' hidden>
                    <label>Pembayaran Ke</label>
                    <input type='text' class='form-control' name='paymentnumber' id='paymentnumber' placeholder='Enter Pemabayaran Ke ( 1 / 2 / seterusnya'>
                  </div>
                  <div class='form-group'>
                    <label>Harga</label>
                    <input type='text' class='form-control' name='paymentprice' id='paymentprice' placeholder='Enter Harga Yang Dibayarkan ( Angka Saja )'>
                  </div>

                  <div class='form-group'>
                    <label for='exampleInputFile'>Lampiran Tagihan Invoice</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload2' id='fileToUpload2' accept='.png, .jpg, .jpeg,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document' type='file' />
                      </div>
                  </div>

                  
                    <div class='form-group'>
                    <label>No Rekening</label>
                      <input type='text' class='form-control' name='norek' id='norek' placeholder='Enter No Rek Supplier'>
                    </div>

                    <div class='form-group'>
                    <label>Atas Nama Rekening</label>
                      <input type='text' class='form-control' name='atasnama' id='atasnama' placeholder='Enter Atas Nama Rekening ( a/n NamaOrangnya )'>
                    </div>

                    <div class='form-group'>
                    <label>Bank Rekening</label>
                      <input type='text' class='form-control' name='bank' id='bank' placeholder='Enter Rekening Banknya ( BCA / BNI / BRI / dan seterusnya'>
                    </div>";


                  
                  
                echo "</div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                </div>
              </form>
            </div>

            
                

              </div>
            </div>
          </div>
        </div>
</div>";
?>

<script>

  $(document).ready(function(){
  	$(".chosen").chosen();
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=paymentnumber]").val();
        var b = $("input[name=paymentprice]").val();
        var c = $("input[name=totalpayment]").val();
        var e = document.getElementById("paymentagent").options[document.getElementById("paymentagent").selectedIndex].value;
        var date = new Date($('input[name="datefilter2"]').val());
        var f = $("input[name=norek]").val();
        var f2 = $("input[name=atasnama]").val();
        var f3 = $("input[name=bank]").val();
        var x = $("input[name=invoiceid]").val();
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        date = day + "-" + month + "-" + year;

        fd.append('totalpayment',c);
        fd.append('paymentnumber',a);
        fd.append('paymentprice',b);
        fd.append('invoiceid',x);
        fd.append('date',date);
        fd.append('paymentagent',e);
        fd.append('norek',f);
        fd.append('atasnama',f2);
        fd.append('bank',f3);
       
        if(document.getElementById("fileToUpload2").files.length != 0){
           var files2 = $('#fileToUpload2')[0].files[0];
           fd.append('fileToUpload2',files2);
           fd.append('code',1);
        }else{
          fd.append('code',0);
        }


        $.ajax({
          url: 'insertPaymentDetailPerformaTour.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
              reloadInvoice(0,0,0);
            }else{
              alert(response);
            }

          },
        });
        

       
    });
});

</script>
