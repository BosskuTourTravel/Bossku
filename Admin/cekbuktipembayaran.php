<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<style>
.tableFixHead          { overflow-y: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
th     { background:#ffff; }

</style>
<?php
include "../site.php";
include "../db=connection.php";
session_start();


$grandtotalFinal = 0;

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>CEK PEMBAYARAN</h3>
                <table class='table-striped table-bordered table-sm' style='margin-top:-1%;margin-left:1%;'>

                  	  <tr>
                  	  <td>
                    <input class='form-control' type='text' name='datefilter' id='datefilter' value='".$dateNow."' style='width:100%;height:2%;'/>
              
                    </td>
                    <td>
                    <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$dateNow."' style='width:100%;height:2%;'/>
              
                    </td>
               		<td>
                    <button type='button' class='btn btn-primary' id='but_transfer' style='font-size:12px;width:100px;height:2%;'>Tanggal Transfer</button>
             		</td>
                 	<td>
                    <button type='button' class='btn btn-primary' id='but_upload' style='font-size:12px;width:100px;height:2%;'>Tanggal Upload</button>
                    </td>
                    </tr>
                    </table>";
                    
                  
                    echo "
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    

                      
                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              






            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>

 function printPaymentDetail(x,y){
    window.open("https://www.2canholiday.com/Admin/printpaymentdetail.php?id="+x+"&tipe="+y, '_blank');
  }
$(document).ready(function(){
    $(".chosen").chosen();

    $('input[name="datefilter"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

    $("#but_transfer").click(function(){
        var fd = new FormData();
     
        var date=new Date($('input[name="datefilter"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var tanggal = year + "-" + month + "-" + day;
        var tanggal2 = month + "/" + day + "/" + year;

        fd.append('tanggal',tanggal);
        fd.append('tanggal2',tanggal2);



        var datex=new Date($('input[name="datefilter2"]').val());
        var monthx = ((datex.getMonth()+1)<10) ? "0" + (datex.getMonth()+1) : (datex.getMonth()+1);
        var dayx = (datex.getDate() < 10) ? "0" + datex.getDate() : datex.getDate();
        var yearx = datex.getFullYear();

        var tanggalx = yearx + "-" + monthx + "-" + dayx;
        var tanggalx2 = monthx + "/" + dayx + "/" + yearx;

        fd.append('tanggalx',tanggalx);
        fd.append('tanggalx2',tanggalx2);



        fd.append('tipe',1);
      
        $.ajax({

            url:"searchcekbuktipembayaran.php",

            method: "POST",

            asynch: false,

            data: fd,

            contentType: false,

            processData: false,

            success:function(data){

                $("#divReloadPage").html(data);

            }

        });

    });

    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var date=new Date($('input[name="datefilter"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var tanggal = year + "-" + month + "-" + day;
        var tanggal2 = month + "/" + day + "/" + year;

        fd.append('tanggal',tanggal);
        fd.append('tanggal2',tanggal2);


        var datex=new Date($('input[name="datefilter2"]').val());
        var monthx = ((datex.getMonth()+1)<10) ? "0" + (datex.getMonth()+1) : (datex.getMonth()+1);
        var dayx = (datex.getDate() < 10) ? "0" + datex.getDate() : datex.getDate();
        var yearx = datex.getFullYear();

        var tanggalx = yearx + "-" + monthx + "-" + dayx;
        var tanggalx2 = monthx + "/" + dayx + "/" + yearx;

        fd.append('tanggalx',tanggalx);
        fd.append('tanggalx2',tanggalx2);

        
        fd.append('tipe',2);
      
        $.ajax({

            url:"searchcekbuktipembayaran.php",

            method: "POST",

            asynch: false,

            data: fd,

            contentType: false,

            processData: false,

            success:function(data){

                $("#divReloadPage").html(data);

            }

        });

    });

});

  function updateCek(x,y){
    var txt;
    var r = confirm("Are you sure to Cek this?");
    if (r == true) {
     $.ajax({
        url:"updateCekPaymentDetail.php",
        method: "POST",
        asynch: false,
        data:{id:x,tipe:y},
        success:function(data){
          if(data=="success"){
            alert(data);
            reloadCek(0,0,0);
          }else{
            alert("Fail to Cek");
          }
        }
      });
     } 
  }
</script>

