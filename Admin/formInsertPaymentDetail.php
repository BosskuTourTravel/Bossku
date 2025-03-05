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


$query_livebank = "SELECT * FROM kurs_live";
$rs_livebank=mysqli_query($con,$query_livebank);

$querybank = "SELECT * FROM bank";
$rsbank=mysqli_query($con,$querybank);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT PAYMENT INVOICE</h3></br>";
               

                echo "<select class='chosen' class='form-control'>
                    <option selected='selected' value=0>CEK KURS</option>";

                    while($row_livebank = mysqli_fetch_array($rs_livebank)){
                      echo "<option value='".$row_livebank['jual']."'>".$row_livebank['name']." ( Rp ".number_format($row_livebank['jual'], 0, ".", ".")." )</option>";
                    }
                    echo"</select>";

                echo "<div class='card-tools'>
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
                <div class='card-body'>";
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
                    <label>Description</label>
                    <input type='text' class='form-control' name='description' id='description' placeholder='Masukkan Harga Bila Bukan Kurs IDR ( USD 1 / @14300 )'>
                  </div>

                  <div class='form-group'>
                    <label>Debit / Credit / Cash / Transfer</label>

                    <select name='paymenttype' id='paymenttype'>
                      <option selected='selected' value=0>Pilihan</option>";
                        echo "<option value='Debit'>Debit</option>";
                        echo "<option value='Credit'>Credit</option>";
                        echo "<option value='Transfer'>Transfer</option>";
                        echo "<option value='Cash'>Cash</option>";
                    echo "</select>
                    </div>
                    <div class=form-group'>
                      <label>Paymen Bank :</label>
                      <select class='chosen' name='paymentbank' id='paymentbank'>
                      <option selected='selected' value=0>Pilihan</option>";
                      while($rowbank=mysqli_fetch_array($rsbank)){
                        echo "<option value=".$rowbank['id'].">".$rowbank['nama']." ( ".$rowbank['short']." )</option>";
                    }
                    echo "</select></div>


                  <div class='form-group'>
                    <label>Tanggal Customer Transfer</label>
                    <input class='form-control' type='text' name='datefilter' id='datefilter' value='".$dateNow."' style='width: 100%;' />
                  </div>

                  <div class='form-group'>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
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

    $('input[name="datefilter"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=paymentnumber]").val();
        var b = $("input[name=paymentprice]").val();
        var c = document.getElementById("paymenttype").options[document.getElementById("paymenttype").selectedIndex].value;
        var d = document.getElementById("paymentbank").options[document.getElementById("paymentbank").selectedIndex].value;
        var e = $("input[name=description]").val();
        var x = $("input[name=invoiceid]").val();

        var date = new Date($('input[name="datefilter"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var tanggal = year + "-" + month + "-" + day;
        fd.append('tanggal',tanggal);

        var files = $('#fileToUpload')[0].files[0];
        fd.append('fileToUpload',files);
        fd.append('paymentnumber',a);
        fd.append('paymentprice',b);
        fd.append('paymenttype',c);
        fd.append('paymentbank',d);
        fd.append('description',e);
        fd.append('invoiceid',x);

        if($('#fileToUpload')[0].files.length<1 ){
          alert("Bukti Pembayaran harus dimasukkan");
        }else{
           $.ajax({
            url: 'insertPaymentDetail.php',
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
        }

       
    });
});

</script>
