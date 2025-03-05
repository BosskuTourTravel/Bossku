<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$querycontinent = "SELECT * FROM continent";
$rscontinent=mysqli_query($con,$querycontinent);

$querycountry = "SELECT * FROM invoice WHERE id=".$_POST['id'];
$rscountry = mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

  echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE INVOICE PAYMENT</h3>
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
              <div>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <div class='form-group'>
                    <label>Img</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$rowcountry['img']."' placeholder='Enter Img'>
                  </div>

                  <div class='form-group'>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  ";
                  
                  
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
    $("#but_upload").click(function(){
        var fd = new FormData();
        
        var b = $("input[name=img]").val();
        var x = $("input[name=id]").val();
        var files = $('#fileToUpload')[0].files[0];
        fd.append('img',b);
        fd.append('id',x);
        fd.append('fileToUpload',files);
        
        $.ajax({
            url: 'updateInvoicePayment.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	alert(response);
              reloadInvoice(0,0,0);
            },
        });
    });
});

</script>
