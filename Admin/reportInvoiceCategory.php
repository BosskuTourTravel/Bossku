<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querypackage = "SELECT DISTINCT(tour_package) FROM invoice";
$rspackage=mysqli_query($con,$querypackage);

$dateNow = date("m/d/Y");



echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>REPORT INVOICE CATEGORY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadReport(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div'>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                 <div class='form-group' hidden>
                    <label>Tour Code</label>
                    <select class='chosen' name='tourpackage' id='tourpackage' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowpackage = mysqli_fetch_array($rspackage)){
                    	$query = "SELECT * FROM tour_package WHERE id=".$rowpackage['tour_package'];
                    	$rs=mysqli_query($con,$query);
                    	$row = mysqli_fetch_array($rs);

                      $queryinvoice = "SELECT DISTINCT(tour_package) FROM invoice WHERE tour_package=".$rowpackage['tour_package'];
                      $rsinvoice=mysqli_query($con,$queryinvoice);
                      $rowinvoice = mysqli_fetch_array($rsinvoice);

                      $queryinvoice2 = "SELECT * FROM invoice WHERE id=".$rowinvoice['id'];
                      $rsinvoice2=mysqli_query($con,$queryinvoice2);
                      $rowinvoice2 = mysqli_fetch_array($rsinvoice2);
                      echo "<option value='".$row['id']."'>888".$row['id']." ( ".$row['tour_name']." -  [ ".$row['category']." ] )</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group' hidden>
                    <input type='radio' name='beforenext' value='0' checked> Sebelum Tanggal Coloumn Yang Tertera Di bawah ini ( Tour Yang Sudah Berjalan )<br>
                    <input type='radio' name='beforenext' value='1'> Setelah Tanggal Coloumn Yang Tertera Di bawah ini ( Tour Yang Belum Berjalan )<br>
                  </div>
                  
                  <div class='form-group' hidden>
                    <label>Pilihan</label>
                    <select class='chosen' name='pilihan' id='pilihan' class='form-control'>
                    <option selected='selected' value=0>Tanggal</option>
                    <option value=1>Bulan</option>
                    <option value=2>Tahun</option>
                    </select>
                  </div>
               
                  <div class='form-group'>
                  <label>Date</label>
                  <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$dateNow."' style='width: 100%;' />
                  </div>

                  <div class='form-group'>
                  <label>Date 2</label>
                  <input class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='width: 100%;' />
                  </div>
                  
                <table>
             
                <tr>
                <td><div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_invoicecategory'>Total Category</button>
                </div></td>
                </tr>
                </table>
              </form>
              <form method='post' name='bookForm' action='https://www.2canholiday.com/printreporttourlist.php'>
                  <input type='text' name='ttourpackage' id='ttourpackage' hidden>

                  <input type='text' name='tdate' id='tdate' hidden>
                  <input type='text' name='tday' id='tday' hidden>
                  <input type='text' name='tmonth' id='tmonth' hidden>
                  <input type='text' name='tyear' id='tyear' hidden>

                  <input type='text' name='tdate2' id='tdate2' hidden>
                  <input type='text' name='tday2' id='tday' hidden>
                  <input type='text' name='tmonth2' id='tmonth' hidden>
                  <input type='text' name='tyear2' id='tyear' hidden>
                  <input type='text' name='tpilihan' id='tpilihan' hidden>
                  <input type='text' name='tbeforenext' id='tbeforenext' hidden>
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

    $('input[name="datefilter3"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $("#but_invoice").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("tourpackage").options[document.getElementById("tourpackage").selectedIndex].value;
        var date=new Date($('input[name="datefilter2"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var b = document.getElementById("pilihan").options[document.getElementById("pilihan").selectedIndex].value;
        var c = $("input[type='radio'][name='beforenext']:checked").val();
       
        fd.append('tourpackage',a);
        fd.append('pilihan',b);
        fd.append('month',month);
        fd.append('year',year);
        fd.append('day',day);

       $("input[name=ttourpackage]").val(a);
       $("input[name=tpilihan]").val(b);
       $("input[name=tday]").val(day);
       $("input[name=tmonth]").val(month);
       $("input[name=tyear]").val(year);
       $("input[name=tbeforenext]").val(c);

       reloadSeeInvoice(0,a,b,day,month,year,c);
    });

    $("#but_customerlist").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("tourpackage").options[document.getElementById("tourpackage").selectedIndex].value;
        var date=new Date($('input[name="datefilter2"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();
        var b = document.getElementById("pilihan").options[document.getElementById("pilihan").selectedIndex].value;
        var c = $("input[type='radio'][name='beforenext']:checked").val();
       
        fd.append('tourpackage',a);
        fd.append('pilihan',b);
        fd.append('month',month);
        fd.append('year',year);
        fd.append('day',day);
        fd.append('beforenext',c);

       $("input[name=ttourpackage]").val(a);
       $("input[name=tpilihan]").val(b);
       $("input[name=tday]").val(day);
       $("input[name=tmonth]").val(month);
       $("input[name=tyear]").val(year);
       $("input[name=tbeforenext]").val(c);

        var queryString = $('form[name="bookForm"]').serialize();        
        window.open('https://www.2canholiday.com/printcustomerlist.php?'+ queryString +'', '_blank');
    });

    $("#but_invoicecategory").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("tourpackage").options[document.getElementById("tourpackage").selectedIndex].value;
        var date=new Date($('input[name="datefilter2"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var date2=new Date($('input[name="datefilter3"]').val());
        var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
        var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
        var year2 = date2.getFullYear();

        var b = document.getElementById("pilihan").options[document.getElementById("pilihan").selectedIndex].value;
        var c = $("input[type='radio'][name='beforenext']:checked").val();
       
        fd.append('tourpackage',a);
        fd.append('pilihan',b);
        fd.append('month',month);
        fd.append('year',year);
        fd.append('day',day);

        var tdate = year + "-" + month + "-" + day;
        var tdate2 = year2 + "-" + month2 + "-" + day2;

       $("input[name=ttourpackage]").val(a);
       $("input[name=tdate]").val(tdate);
       $("input[name=tpilihan]").val(b);
       $("input[name=tday]").val(day);
       $("input[name=tmonth]").val(month);
       $("input[name=tyear]").val(year);
       $("input[name=tdate2]").val(tdate2);
        $("input[name=tday2]").val(day2);
       $("input[name=tmonth2]").val(month2);
       $("input[name=tyear2]").val(year2);
       $("input[name=tbeforenext]").val(c);

       var queryString = $('form[name="bookForm"]').serialize();        
        window.open('https://www.2canholiday.com/printReportInvoiceCategory.php?'+ queryString +'', '_blank');
    });
    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("tourpackage").options[document.getElementById("tourpackage").selectedIndex].value;
        var date=new Date($('input[name="datefilter2"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();
        var b = document.getElementById("pilihan").options[document.getElementById("pilihan").selectedIndex].value;
        var c = $("input[type='radio'][name='beforenext']:checked").val();
       
        fd.append('tourpackage',a);
        fd.append('pilihan',b);
        fd.append('month',month);
        fd.append('year',year);
        fd.append('day',day);
        fd.append('beforenext',c);

       $("input[name=ttourpackage]").val(a);
       $("input[name=tpilihan]").val(b);
       $("input[name=tday]").val(day);
       $("input[name=tmonth]").val(month);
       $("input[name=tyear]").val(year);
       $("input[name=tbeforenext]").val(c);

        var queryString = $('form[name="bookForm"]').serialize();        
        window.open('https://www.2canholiday.com/printreporttourlist.php?'+ queryString +'', '_blank');
    });
});

</script>
