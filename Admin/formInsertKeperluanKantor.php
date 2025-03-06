<?php
include "../site.php";
include "../db=connection.php";
$query = "SELECT * FROM imigration";
$rs=mysqli_query($con,$query);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT KEPERLUAN KANTOR</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadManual(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action=''>
                <div class='card-body'>
                  <div class=form-group'>
                  <label>Date</label>
                    <input class='form-control' type='text' name='datefilter' id='datefilter' value='".$dateNow."' style='height:2%;'/>
                  </div>
                 <div class=form-group'>
                   <label>Keperluan</label>
                    <input type='text' required class='form-control' name='description' id='description' placeholder='Enter Keperluan'>
                  </div>
                  <div class=form-group'>
                   <label>Total Price</label>
                    <input type='text' required class='form-control' name='price' id='price' placeholder='Enter Total Price'>
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
    $(".chosen").chosen();
    $('input[name="datefilter"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
  });
   $("#but_upload").click(function(){

    var a = $("input[name=description]").val();
    var b = $("input[name=price]").val();

    var fd = new FormData();

    var date=new Date($('input[name="datefilter"]').val());
    var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
    var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
    var year = date.getFullYear();

    var tdate = year + "-" + month + "-" + day;

    fd.append('tdate',tdate);
    fd.append('description',a);
    fd.append('price',b);


    $.ajax({
      url: 'insertKeperluanKantor.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
       if(response=="success"){
        alert(response);
        reloadManual(0,0,0);
      }

    },
  });
  });
</script>
