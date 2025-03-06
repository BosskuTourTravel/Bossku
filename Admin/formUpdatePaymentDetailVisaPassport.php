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

$querybank = "SELECT * FROM bank";
$rsbank=mysqli_query($con,$querybank);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE PAYMENT INVOICE VISA PASSPORT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadInvoice(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                  echo "
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                  <div class='form-group'>
                    <label>Tanggal Customer Transfer</label>
                    <input class='form-control' type='text' name='datefilter' id='datefilter' value='".$dateNow."' style='width: 100%;' />
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
      var a = $("input[name=id]").val();
      var x = $("input[name=tid]").val();
      var date = new Date($('input[name="datefilter"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var tanggal = year + "-" + month + "-" + day;
      fd.append('tanggal',tanggal);
      fd.append('id',a);

      $.ajax({
        url: 'updatePaymentDetailVisaPassport.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response=="success"){
            alert(response);
            reloadPayment(1,x,0);
          }else{
            alert(response);
          }

        },
      });
        

       
    });
});

</script>
