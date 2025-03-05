<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

$dateNow = date("m/d/Y");

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>FORM INSERT DATE : ".$rowtour['tour_name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(4,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                      <label>Pilihan</label>
                      <select class='form-control select2' name='pilihan' id='pilihan' style='width: 100%;'>
                      <option selected='selected' value=0>Pilihan</option>
                      <option value=1>Manual</option>
                      <option value=2>From To</option>
                      <option value=3>By Days</option>
                      </select>
                      <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>
                </div>
                <div class='card-body' id='date1'>
                  <div class='form-group'>
                    <label>Date</label>
                    <input class='form-control' type='text' name='datefilter' value='' style='width: 100%;' />
                  </div>
                </div>
                <div class='card-body' id='date2'>
                  <div class='form-group'>
                    <label>Date</label>
                    <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$dateNow."' style='width: 100%;' />
                  </div>
                </div>
                <div class='card-body' id='date3'>
                  <div class='form-group'>
                    <label>Date</label>
                  </div>
                  <div class='form-group'>
                    <input type='checkbox' name='h' value='0'>Sunday<br>
                    <input type='checkbox' name='h' value='1'>Monday<br>
                    <input type='checkbox' name='h' value='2'>Tuesday<br>
                    <input type='checkbox' name='h' value='3'>Wednesday<br>
                    <input type='checkbox' name='h' value='4'>Thursday<br>
                    <input type='checkbox' name='h' value='5'>Friday<br>
                    <input type='checkbox' name='h' value='6'>Saturday<br>
                  </div>
                  <div class='form-group'>

                    <input class='form-control' type='text' name='datefilter3' value='' style='width: 100%;' />
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
    $("#date1").hide();
    $("#date2").hide();
    $("#date3").hide();

     $('#pilihan').on('change', function() {
        if($('#pilihan').val()==1){
           $("#date2").show();
           $("#date1").hide();
           $("#date3").hide();
        }else if($('#pilihan').val()==2){
           $("#date1").show();
           $("#date2").hide();
           $("#date3").hide();
        }else if($('#pilihan').val()==3){
           $("#date3").show();
           $("#date2").hide();
           $("#date1").hide();
        }else{
           $("#date1").hide();
           $("#date2").hide();
           $("#date3").hide();
        }
    });

    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });


    $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

     $('input[name="datefilter3"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="datefilter3"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="datefilter3"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });



    $("#but_upload").click(function(){
       
          var fd = new FormData();
          var a = $("input[name=id]").val();
          var b =  $('#pilihan').val();
          var status = 0;
          if(b==1){
            var date=new Date($('input[name="datefilter2"]').val());
            var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
            var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
            var year = date.getFullYear();
            fd.append('id',a);
            fd.append('day',day);
            fd.append('month',month);
            fd.append('year',year);
            fd.append('pilihan','');
             $.ajax({
              url: 'insertDate.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                reloadPage(4,a,0)
              },
            });
          
          }else if(b==2){
            var delay = 1000;
            var stringDate = String($('input[name="datefilter"]').val());
            var start = new Date(stringDate.substr(0, 10));
            var end = new Date(stringDate.substr(13, 24));
            var newend = end.setDate(end.getDate());
            var end = new Date(newend);
            date = new Date(start);
            var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
            var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
            var year = date.getFullYear();
            fd.append('id',a);
            fd.append('day',day);
            fd.append('month',month);
            fd.append('year',year);
            fd.append('pilihan','Everyday Can Go');
            $.ajax({
              url: 'insertDate.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){

              },
            });
            while(start < end){    
               var newDate = start.setDate(start.getDate() + 1);
               date = new Date(newDate);
               var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
               var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
               var year = date.getFullYear();
               fd.append('id',a);
               fd.append('day',day);
               fd.append('month',month);
               fd.append('year',year);
                $.ajax({
                  url: 'insertDate.php',
                  type: 'post',
                  data: fd,
                  contentType: false,
                  processData: false,
                  success: function(response){
                    setTimeout(function() {
                    }, delay);
                   
                  },
                });
             }

           reloadPage(4,a,0);
          }else if(b==3){
          	var stringDate = String($('input[name="datefilter3"]').val());
            var start = new Date(stringDate.substr(0, 10));
            var end = new Date(stringDate.substr(13, 24));
            var newend = end.setDate(end.getDate());
            var end = new Date(newend);
            date = new Date(start);
            var array = [];
            var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
            var tempString = "";

            alert(checkboxes.length);
            for (var i = 0; i < checkboxes.length; i++) {
              alert(i);
                var tempString2 = "";
                if(checkboxes[i].value==0){
                  tempString2 = "Sunday";
                }else if(checkboxes[i].value==1){
                  tempString2 = "Monday";
                }else if(checkboxes[i].value==2){
                  tempString2 = "Tuesday";
                }else if(checkboxes[i].value==3){
                  tempString2 = "Wednesday";
                }else if(checkboxes[i].value==4){
                  tempString2 = "Thursday";
                }else if(checkboxes[i].value==5){
                  tempString2 = "Friday";
                }else if(checkboxes[i].value==6){
                  tempString2 = "Saturday";
                }
                if(i==0){
                  tempString = tempString + tempString2;
                }else{
                  tempString = tempString + " " + tempString2;
                }
            }
            
            for (var i = 0; i < checkboxes.length; i++) {
            		var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
            		var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
            		var year = date.getFullYear();
            		fd.append('id',a);
            		fd.append('day',day);
            		fd.append('month',month);
            		fd.append('year',year);
            		$.ajax({
            			url: 'insertDate.php',
            			type: 'post',
            			data: fd,
            			contentType: false,
            			processData: false,
            			success: function(response){

            			},
            		});
            	}
            tempString = Array.from(new Set(tempString.split(' '))).toString();
            while(start < end){
               var fd = new FormData();
               fd.append('pilihan',tempString);   
               var newDate = start.setDate(start.getDate() + 1);
               date = new Date(newDate);
               var array = [];
               var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
               
               for (var i = 0; i < checkboxes.length; i++) {
               
               	if(date.getDay()==checkboxes[i].value && checkboxes[i].value!=""){
               		var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
               		var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
               		var year = date.getFullYear();
               		fd.append('id',a);
               		fd.append('day',day);
               		fd.append('month',month);
               		fd.append('year',year);
               		$.ajax({
               			url: 'insertDate.php',
               			type: 'post',
               			data: fd,
               			contentType: false,
               			processData: false,
               			success: function(response){
               				setTimeout(function() {
               				}, delay);

               			},
               		});

               	}
               
             }

           reloadPage(4,a,0);
          }
         

       }
    });
});

</script>
