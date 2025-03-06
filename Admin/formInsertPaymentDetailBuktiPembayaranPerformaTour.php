  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>

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
                <h3 class='card-title'>FORM UPLOAD BUKTI PEMBAYARAN</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadInvoice(-1,".$_POST['invoice'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
              <input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>
              <input type='text' name='tinvoice' id='tinvoice' value='".$_POST['invoice']."' hidden>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Bukti Pembayaran ke Agent dengan Foto</label>
                    
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                    </div>
                  </div>

                  <div class='form-group'>
                    <label>Bukti Pembayaran ke Agent dengan Text</label>
                    <textarea id='summernote' name='editordata'></textarea>
                  </div>

                  <div class='form-group'>
                    <label>Debit / Credit / Cash / Transfer</label>

                    <select name='paymenttype' id='paymenttype'>
                      <option selected='selected' value=0>Pilihan</option>";
                        echo "<option value='Debit'>Debit</option>";
                        echo "<option value='Credit Card'>Credit Card</option>";
                        echo "<option value='Transfer'>Transfer</option>";
                        echo "<option value='Cash'>Cash</option>";
                    echo "</select>
                    </div>
                    <div class=form-group'>
                      <label>Payment Bank :</label>
                      <select class='chosen' name='paymentbank' id='paymentbank'>
                      <option selected='selected' value=0>Pilihan</option>";
                      while($rowbank=mysqli_fetch_array($rsbank)){
                        echo "<option value=".$rowbank['id'].">".$rowbank['nama']." ( ".$rowbank['short']." )</option>";
                    }
                    echo "</select></div>";
                  
                  
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
    $('#summernote').summernote();
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=tinvoice]").val();
        var c = document.getElementById("paymentbank").options[document.getElementById("paymentbank").selectedIndex].value;
        var d = $("textarea[name=editordata]").val();
        var e = document.getElementById("paymenttype").options[document.getElementById("paymenttype").selectedIndex].value;
        var x = $("input[name=tid]").val();

        fd.append('paymentbank',c);
        fd.append('paymenttype',e);
        fd.append('id',x);
       
        if(document.getElementById("fileToUpload").files.length != 0){
           var files2 = $('#fileToUpload')[0].files[0];
           fd.append('fileToUpload',files2);
           fd.append('code',0);
           $.ajax({
           	url: 'uploadPaymentDetailPerformaTour.php',
           	type: 'post',
           	data: fd,
           	contentType: false,
           	processData: false,
           	success: function(response){
           		if(response=="success"){
           			alert(response);
           			reloadInvoice(-1,a,0);
           		}else{
           			alert(response);
           		}

           	},
           });
        }else{
          if(d!=''){
            fd.append('code',1);
            fd.append('bukti',d);
            $.ajax({
              url: 'uploadPaymentDetailPerformaTour.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                if(response=="success"){
                  alert(response);
                  reloadInvoice(-1,a,0);
                }else{
                  alert(response);
                }

              },
            });
          }else{
            alert('Mohon Masukkan Bukti Pembayaran Terlebih Dahulu');
          }
        	
        }


        
        

       
    });
});

</script>
