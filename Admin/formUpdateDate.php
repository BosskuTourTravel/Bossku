<?php
include "../site.php";
include "../db=connection.php";
echo "<script type='text/javascript' src='https://cdn.jsdelivr.net/jquery/latest/jquery.min.js'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/momentjs/latest/moment.min.js'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js'></script>
<link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' />";

$querytour = "SELECT * FROM date_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

$date = $rowtour['month']."/".$rowtour['date_number']."/".$rowtour['year'];

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>UPDATE DATE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(4,".$_POST['tid'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                 <div class='form-group'>
                    <label>Date</label>
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                    <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$date."' style='width: 100%;' />
                  </div>
                </div>
                

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

     $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

    $("#but_upload").click(function(){
         var fd = new FormData();
         var a = $("input[name=id]").val();
         var b = $("input[name=tid]").val();
         var date=new Date($('input[name="datefilter2"]').val());
         var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
         var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
         var year = date.getFullYear();
         fd.append('id',a);
         fd.append('day',day);
         fd.append('month',month);
         fd.append('year',year);
         $.ajax({
          url: 'updateDate.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            reloadPage(4,b,0)
          },
        });
     });
         

       
});

</script>
