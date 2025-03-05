<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querytourtype = "SELECT * FROM tour_type";
$rstourtype=mysqli_query($con,$querytourtype);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);

$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT MULTIPLE PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Tour Name</label>
                    <input type='text' class='form-control' name='name' id='name' placeholder='Enter Name'>
                  </div>
                  <div class='form-group'>
                    <label>Description</label>
                    <textarea class='form-control' name='desc' id='desc' placeholder='Enter Description'> </textarea>
                  </div>
                  <div class='form-group'>
                    <label>Category</label>
                    <input type='text' class='form-control' name='category' id='category' placeholder='Enter Category'>
                  </div>
                  <div class='form-group'>
                    <label>Tour Type</label>
                    <select name='type' id='type' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Duration Tour</label>
                    <input type='text' class='form-control' name='duration' id='duration' placeholder='Enter Duration'>
                  </div>
                  <div class='form-group'>
                    <label>Departure</label>
                    <input class='form-control' type='text' name='departure' value='' style='width: 100%;' />
                  </div>
                  <div class='form-group'>
                    <label>Min Person</label>
                    <input type='text' class='form-control' name='minperson' id='minperson' placeholder='Enter Min Person'>
                  </div>
                  <div class='form-group'>
                    <label>Tipping</label>
                    <select name='kurs' id='kurs'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                    <input type='text' class='form-control' name='tipping' id='tipping' placeholder='Enter Tipping Tour Per Person'>
                  </div>
                  <div class=form-group'>
                    <label>Tour Package</label>
                    <select name='tour_package' id='tour_package'>
                    <option selected='selected' value=0>Jumlah Tour Package</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                   echo "</select></div>
                   <div class=form-group' name='divtourpackage' id='divtourpackage'></div>

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
    $('#tour_package').on('change', function() {
        var count = this.value;
        alert(count);
        $.ajax({
          type:'POST',
          url:'getTourPackage.php',
          data:{'count':count},
          success:function(data){
           $('#divtourpackage').html(data);
         }
       });
      });


    $('input[name="departure"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="departure"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="departure"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=name]").val();
        var b = $("input[name=category]").val();
        var c = $("textarea[name=desc]").val();
        var d = $("input[name=duration]").val();
        var f = $("input[name=minperson]").val();
        var g = $("input[name=tipping]").val();
        var j = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
        var k = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
        var l = document.getElementById("tour_package").options[document.getElementById("tour_package").selectedIndex].value;

        var stringDate = String($('input[name="departure"]').val());
        var start = new Date(stringDate.substr(0, 10));
        var end = new Date(stringDate.substr(13, 24));
        var DateString = "";
        for (var i = 0; i < 2; i++) {
          if(i==0){
            date = new Date(start);
          }else{
            date = new Date(end);
          }
          var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
          var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
          var year = date.getFullYear();
          if(month==1){
            month = "Jan";
          }else if(month==2){
            month = "Feb";
          }else if(month==3){
            month = "Mar";
          }else if(month==4){
            month = "Apr";
          }else if(month==5){
            month = "May";
          }else if(month==6){
            month = "Jun";
          }else if(month==7){
            month = "Jul";
          }else if(month==8){
            month = "Aug";
          }else if(month==9){
            month = "Sep";
          }else if(month==10){
            month = "Oct";
          }else if(month==11){
            month = "Nov";
          }else if(month==12){
            month = "Dec";
          }
          if(i==0){
            dateString = day+" "+month+" "+year;
          }else{
            dateString = dateString +" - "+day+" "+month+" "+year;
          }
        }
        var e = dateString;
        var tempTourPackage = "";
        for (var i = 1; i <= $("#tour_package").val(); i++) {
            if(i==1){
              tempTourPackage = tempTourPackage + $("#tourPackage"+i).val();
            }
            else{
              tempTourPackage = tempTourPackage + ";" + $("#tourPackage"+i).val();
            }
          }
        fd.append('tour_package',tempTourPackage);
        fd.append('name',a);
        fd.append('category',b);
        fd.append('desc',c);
        fd.append('duration',d);
        fd.append('departure',e);
        fd.append('minperson',f);
        fd.append('tipping',g);
        fd.append('tour_package_count',l);
        fd.append('type',j);
        fd.append('kurs',k)

        $.ajax({
            url: 'insertMultiplePackage.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
            		reloadPage(0,0,0);
            	}else{
                alert(response);
              }
              
            },
        });
    });
});

</script>
