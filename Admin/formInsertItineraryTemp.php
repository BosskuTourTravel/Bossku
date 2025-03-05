<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>
<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>


<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM price_package";
$rstour=mysqli_query($con,$querytour);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT ITINERARY PACKAGE ( CARA MENGISINYA PER HARI )</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(1,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div >

              <div >
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                <div class='form-row align-items-center'>";

                $query_itinerary = "SELECT COUNT(*) as total FROM itinerary WHERE tour_package=".$_POST['id'];
                $rs_itinerary=mysqli_query($con,$query_itinerary);
                $row_itinerary = mysqli_fetch_assoc($rs_itinerary);

                if($row_itinerary['total']==0){
                	echo "<div class='col-2'>
                	<label>Arrival Time Category</label></br>";

                	$query_category = "SELECT * FROM itinerary_category_arrival";
                	$rs_category=mysqli_query($con,$query_category);
                	echo "<select class='chosen' name='itinerary_category_arrival' id='itinerary_category_arrival'>";
                	echo "<option selected='selected' value='0'>Pilihan</option>";
                	while($row_category = mysqli_fetch_array($rs_category)){
                		echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                	}

                	echo "</select></div> ";

                }else{
                

                	$query_category = "SELECT * FROM itinerary_category_arrival";
                	$rs_category=mysqli_query($con,$query_category);
                	echo "<select name='itinerary_category_arrival' id='itinerary_category_arrival' hidden>";
                	echo "<option selected='selected' value='0'>Pilihan</option>";
                	while($row_category = mysqli_fetch_array($rs_category)){
                		echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                	}

                	echo "</select>";
                }

                $query_tour = "SELECT * FROM tour_package WHERE id=".$_POST['id'];
                $rs_tour=mysqli_query($con,$query_tour);
                $row_tour = mysqli_fetch_array($rs_tour);


                if($row_itinerary['total']==$row_tour['duration_tour']-1){
                	echo "<div class='col-2'>
                	<label>Departure Time Category</label></br>";
                	$query_category = "SELECT * FROM itinerary_category_departure";
                	$rs_category=mysqli_query($con,$query_category);
                	echo "<select class='chosen' name='itinerary_category_departure' id='itinerary_category_departure'>";
                	echo "<option selected='selected' value='0'>Pilihan</option>";
                	while($row_category = mysqli_fetch_array($rs_category)){
                		echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                	}

                	echo "</select></div>";
                }else{
                	echo "";
                	$query_category = "SELECT * FROM itinerary_category_departure";
                	$rs_category=mysqli_query($con,$query_category);
                	echo "<select name='itinerary_category_departure' id='itinerary_category_departure' hidden>";
                	echo "<option selected='selected' value='0'>Pilihan</option>";
                	while($row_category = mysqli_fetch_array($rs_category)){
                		echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                	}

                	echo "</select>";
                }

                echo "<div class='col-3'>
                    <label>Day</label></br>
                    <input type='text' name='day' id='day' placeholder='Enter Day'>
                  </div>
                  </div></br>
                  <div class='form-group'>
                  <input type='checkbox' name='b' id='b'>Breakfast<br>
                    <input type='checkbox' name='l' id='l'>Lunch<br>
                    <input type='checkbox' name='d' id='d'>Dinner<br>
                  </div>
                  <div class='form-group'>
                    <label>Route City</label>
                    <select name='route_count' id='route_count'>
                    <option selected='selected' value=0>Jumlah Route City</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divroute' id='divroute'></div>";


                    echo "
                    
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  
                  
                  
                  <div class='form-group'>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                      
                    </div>
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
    $('#summernote').summernote();
    $(".chosen").chosen();

    $('#route_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getCityItinerary.php',
          data:{'count':count},
          success:function(data){
           $('#divroute').html(data);
         }
       });
      });

    $("#but_upload").click(function(){

        var fd = new FormData();
        var a = $("input[name=id]").val();
        var b = $("input[name=name]").val();
        var c = $("input[name=day]").val();
        var d = $("textarea[name=editordata]").val();

        var bf = 0;
        var lf = 0;
        var df = 0;

        if ($('input[name=b]').is(':checked')) {
          bf = 1;
        }

        if ($('input[name=l]').is(':checked')) {
          lf = 1;
        }

        if ($('input[name=d]').is(':checked')) {
          df = 1;
        }

        // var ct1 = 0;
        // var ct2 = 0;
        // var ct3 = 0;
        // var ct4 = 0;
        // var ct5 = 0;
        // var ct6 = 0;

        // if ($('input[name=category1]').is(':checked')) {
        //   ct1 = 1;
        // }
        // if ($('input[name=category2]').is(':checked')) {
        //   ct2 = 1;
        // }
        // if ($('input[name=category3]').is(':checked')) {
        //   ct3 = 1;
        // }
        // if ($('input[name=category4]').is(':checked')) {
        //   ct4 = 1;
        // }
        // if ($('input[name=category5]').is(':checked')) {
        //   ct5 = 1;
        // }
        // if ($('input[name=category6]').is(':checked')) {
        //   ct6 = 1;
        // }
        // fd.append('ct1',ct1);
        // fd.append('ct2',ct2);
        // fd.append('ct3',ct3);
        // fd.append('ct4',ct4);
        // fd.append('ct5',ct5);
        // fd.append('ct6',ct6);
      
        var itinerary_category_arrival = document.getElementById("itinerary_category_arrival").options[document.getElementById("itinerary_category_arrival").selectedIndex].value;
        var itinerary_category_departure = document.getElementById("itinerary_category_departure").options[document.getElementById("itinerary_category_departure").selectedIndex].value;
        fd.append('itinerary_category_arrival',itinerary_category_arrival);
        fd.append('itinerary_category_departure',itinerary_category_departure);


        var files = $('#fileToUpload')[0].files[0];
       
        fd.append('fileToUpload',files);
        fd.append('id',a);
        fd.append('name',b);
        fd.append('day',c);
        fd.append('desc',d);
        fd.append('b',bf);
        fd.append('l',lf);
        fd.append('d',df);

        if($('#fileToUpload')[0].files.length<1){
          alert('Harus Mengisi Gambar Terlebih Dahulu!');
        }else{
          $.ajax({
            url: 'insertItinerary.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadPage(1,a,0);
              }else{
                alert(response);
              }
            },
          });
        }
        
    });
});

</script>
