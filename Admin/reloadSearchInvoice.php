<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

<style>
.tableFixHead          { overflow-y: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
th     { background:#ffff; }



.multiselect {
  width: 100%;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

</script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$querypackageT = "SELECT DISTINCT tour_package,checkin FROM invoice WHERE checkin between '".$_POST['tdate']."' and '".$_POST['tdate2']."' ORDER BY checkin ASC";
$rspackageT=mysqli_query($con,$querypackageT);
                    // echo "<select class='chosen1' onchange='reloadSeeInvoice(0,this.value,0,0,0,0,0)' name='searchseeinvoice' id='searchseeinvoice' class='form-control'>
                    // <option selected='selected' value=0>Pilihan</option>";

echo "
<div class='selectBox' onclick='showCheckboxes()'>
<select>
<option>Tour Group Checkin</option>
</select>
<div class='overSelect'></div>
</div>
<div id='checkboxes'>";
echo "<input type='checkbox' id='selectAll' name='selectAll' />Select All</label>";
while($rowpackageT = mysqli_fetch_array($rspackageT)){

  $queryT = "SELECT * FROM tour_package WHERE id=".$rowpackageT['tour_package'];
  $rsT=mysqli_query($con,$queryT);
  $rowT = mysqli_fetch_array($rsT);

  $cekDetailPassportT = 0;
  $query2T = "SELECT *FROM invoice WHERE tour_package=".$rowpackageT['tour_package']." AND checkin LIKE '".$rowpackageT['checkin']."'";
  $rs2T=mysqli_query($con,$query2T);
  while($row2T = mysqli_fetch_array($rs2T)){
    $cekDetailPassportT = 1;
  }



  if($cekDetailPassportT==1){
                       // echo "<option value='".$rowT['id']."*".$rowpackageT['checkin']."'>".$rowpackageT['checkin']."  ||  888".$rowT['id']." ( ".$rowT['tour_name'].")</option>";

   echo "
   <label>
   <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$rowT['id']."*".$rowpackageT['checkin']."' />".$rowpackageT['checkin']."  ||  888".$rowT['id']." ( ".$rowT['tour_name'].")</label>";

 }
}

echo " </div>";
               
?>

<script>
  $(document).ready(function(){
    $(".chosen1").chosen();
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

    $('input[name="datefilter3"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
  });

  $("#selectAll").click(function() {
    $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
  });


  $("#but_invoicecategory").click(function(){
        var fd = new FormData();
     
        var date=new Date($('input[name="datefilter2"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var date2=new Date($('input[name="datefilter3"]').val());
        var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
        var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
        var year2 = date2.getFullYear();
       
        fd.append('month',month);
        fd.append('year',year);
        fd.append('day',day);

        var tdate = year + "-" + month + "-" + day;
        var tdate2 = year2 + "-" + month2 + "-" + day2;

       $("input[name=tdate]").val(tdate);
       $("input[name=tpilihan]").val(0);
       $("input[name=tday]").val(day);
       $("input[name=tmonth]").val(month);
       $("input[name=tyear]").val(year);
       $("input[name=tdate2]").val(tdate2);
        $("input[name=tday2]").val(day2);
       $("input[name=tmonth2]").val(month2);
       $("input[name=tyear2]").val(year2);
       $("input[name=tbeforenext]").val(0);

       var queryString = $('form[name="bookForm"]').serialize();        
        //window.open('https://www.2canholiday.com/Admin/printReportInvoiceCategory.php?'+ queryString +'', '_blank');
        $.ajax({

        url:"printReportInvoiceCategory.php",

        method: "POST",

        asynch: false,

       data:{'tdate':tdate,'tdate2':tdate2},

        success:function(data){

          $("#divReloadPage").html(data);

        }

      });
    });

  function printItinerary(x,y){
    window.open("https://www.2canholiday.com/print.php?id="+x+"&id_package="+y,"Print");
  }

  function seeBuktiBayar(){

    var tourpackage = <?php echo json_encode($tourpackage); ?>;
    var date = <?php echo json_encode($tempdate); ?>;
    tourpackage = JSON.stringify(tourpackage);
    date = JSON.stringify(date);

    $.ajax({
          type:'POST',
          url:'searchcekbuktipembayaran2.php',
          data:{'ttourpackage':tourpackage,'tdate':date,'tipe':1},
          success:function(data){
           $('#divBuktiPembayaran').html(data);
         }
       });
  }

  function reloadDate(){
      var date=new Date($('input[name="datefilter2"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var date2=new Date($('input[name="datefilter3"]').val());
      var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
      var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
      var year2 = date2.getFullYear();

      var tdate = year + "-" + month + "-" + day;
      var tdate2 = year2 + "-" + month2 + "-" + day2;
       $.ajax({
          type:'POST',
          url:'reloadSearchInvoice.php',
          data:{'tdate':tdate,'tdate2':tdate2},
          success:function(data){
           $('#divselect').html(data);
         }
       });
  }

  function seeDetail(x,y){
    $.ajax({
          type:'POST',
          url:'seeInvoiceDetail.php',
          data:{'id':x,'invoiceId':y},
          success:function(data){
           $('#divDetail'+x).html(data);
         }
       });
  }

  function closeDetail(x,y){
     $('#divDetail'+x).html('');
  }

  function updateHandle(x,z){
    var txt;
    if(z==0){
      var r = confirm("Are you sure to make this invoice Lunas?");
    }else{
      var r = confirm("Are you sure to make this invoice Belum Lunas?");
    }

    
    if (r == true) {

     $.ajax({
        url:"updateStatusInvoice.php",
        method: "POST",
        asynch: false,
        data:{id:x,flag:z},
        success:function(data){
          if(data=="success"){
            reloadInvoice(0,0,0);
          }else{
            alert("Fail to Update");
          }
        }
      });
    } 
  }
  
 
  function delInvoice(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete Invoice "+x+"?");
    if (r == true) {
      if(y==z){
        $.ajax({
          url:"delInvoice.php",
          method: "POST",
          asynch: false,
          data:{id:x},
          success:function(data){
            if(data=="success"){
              reloadInvoice(0,0,0);
              alert(data);
            }else{
              alert("Fail to Delete");
            }
          }
        });
      }else{
        alert("Kamu Tidak Punya Hak Menghapus Invoice Ini");
      }
    
    } 
  }
</script>
