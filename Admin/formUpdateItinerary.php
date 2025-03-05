<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>
<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM itinerary WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATE INSERT ITINERARY PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(1,".$_POST['tid'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                //   <div class='form-group'>
                // <label>Arrival & Departure Time Category</label></br>";
                //     $query_category = "SELECT * FROM itinerary_category";
                //     $rs_category=mysqli_query($con,$query_category);
                //     // $tempCT = array();
                //     // array_push($tempCT,$row['daily']);
                //     // array_push($tempCT,$row['morning']);
                //     // array_push($tempCT,$row['noon']);
                //     // array_push($tempCT,$row['evening']);
                //     // array_push($tempCT,$row['night']);
                //     // array_push($tempCT,$row['earlymorning']);
                //     while($row_category = mysqli_fetch_array($rs_category)){
                //       $countCT = $row_category['id'] - 1;

                //       if($tempCT[$countCT]==1){
                //         echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."' checked>".$row_category['name']."<br>";
                //       }else{
                //         echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";
                //       }
                      
                //     }
                   
                // echo "</div>";

                echo "<div class='form-row align-items-center'>";

                $query_itinerary = "SELECT COUNT(*) as total FROM itinerary WHERE tour_package=".$_POST['id'];
                $rs_itinerary=mysqli_query($con,$query_itinerary);
                $row_itinerary = mysqli_fetch_assoc($rs_itinerary);

                if($row['day']==1){
                  echo "<div class='col-2'>
                  <label>Arrival Time Category</label></br>";
                  $query_category = "SELECT * FROM itinerary_category_arrival";
                  $rs_category=mysqli_query($con,$query_category);
                  echo "<select class='chosen' name='itinerary_category_arrival' id='itinerary_category_arrival'>";
                  echo "<option selected='selected' value='0'>Pilihan</option>";
                  while($row_category = mysqli_fetch_array($rs_category)){
                   if($row_category['id']==$row['itinerary_category_arrival']){
                    echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }else{
                    echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }

                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                }

                echo "</select></div>";
              }else{
               
                  $query_category = "SELECT * FROM itinerary_category_arrival";
                  $rs_category=mysqli_query($con,$query_category);
                  echo "<select name='itinerary_category_arrival' id='itinerary_category_arrival' hidden>";
                  echo "<option selected='selected' value='0'>Pilihan</option>";
                  while($row_category = mysqli_fetch_array($rs_category)){
                   if($row_category['id']==$row['itinerary_category_arrival']){
                    echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }else{
                    echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }

                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                }

                echo "</select>";
              }

              $query_tour = "SELECT * FROM tour_package WHERE id=".$row['tour_package'];
              $rs_tour=mysqli_query($con,$query_tour);
              $row_tour = mysqli_fetch_array($rs_tour);


              if($row['day']==$row_tour['duration_tour']){

                echo "<div class='col-2'>
                <label>Departure Time Category</label></br>";
                $query_category = "SELECT * FROM itinerary_category_departure";
                $rs_category=mysqli_query($con,$query_category);
                echo "<select class='chosen' name='itinerary_category_departure' id='itinerary_category_departure'>";
                echo "<option selected='selected' value='0'>Pilihan</option>";
                while($row_category = mysqli_fetch_array($rs_category)){
                  if($row_category['id']==$row['itinerary_category_departure']){
                    echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }else{
                    echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }

                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                }

                echo "</select></div>";
              }else{

                $query_category = "SELECT * FROM itinerary_category_departure";
                $rs_category=mysqli_query($con,$query_category);
                echo "<select name='itinerary_category_departure' id='itinerary_category_departure' hidden>";
                echo "<option selected='selected' value='0'>Pilihan</option>";
                while($row_category = mysqli_fetch_array($rs_category)){
                  if($row_category['id']==$row['itinerary_category_departure']){
                    echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }else{
                    echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                  }

                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                }

                echo "</select>";
              }

                echo "<div class='col-3'>
                    <label>Day</label></br>
                    <input type='text' name='day' id='day' value='".$row['day']."' placeholder='Enter Day'>
                  </div></div>
                  <div class='form-group'>
                    <label>Judul Route</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$row['name']."' placeholder='Enter Name'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                  </div>";

                  if($row['breakfast']!=1){
                    echo "<input type='checkbox' name='b' id='b'>Breakfast<br>";
                  }else{
                    echo "<input type='checkbox' name='b' id='b' checked>Breakfast<br>";
                  }
                  
                  if($row['lunch']!=1){
                    echo "<input type='checkbox' name='l' id='l'>Lunch<br>";
                  }else{
                    echo "<input type='checkbox' name='l' id='l' checked>Lunch<br>";
                  }

                   if($row['dinner']!=1){
                    echo "<input type='checkbox' name='d' id='d'>Dinner<br>";
                  }else{
                    echo "<input type='checkbox' name='d' id='d' checked>Dinner<br>";
                  }

                  echo "<div class='form-group'>
                    <label>Description Route</label>
                    <!-- <textarea class='form-control' name='desc' id='desc' value='".$row['description']."' placeholder='Enter Description'>".$row['description']."</textarea> -->
                    <textarea id='summernote' name='editordata' placeholder='Enter Description'>".$row['description']."</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Img</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$row['img']."' placeholder='Enter Img'>
                  </div>
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

    $("#but_upload").click(function(){

        var fd = new FormData();
        var a = $("input[name=id]").val();
        var b = $("input[name=name]").val();
        var c = $("input[name=day]").val();
        var d = $("textarea[name=editordata]").val();
        var e = $("input[name=img]").val();
        var x = $("input[name=tid]").val();

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
        fd.append('img',e);
        fd.append('b',bf);
        fd.append('l',lf);
        fd.append('d',df);
        if($('#fileToUpload')[0].files.length<1){
          fd.append('code',0);
        }else{
          fd.append('code',1);
        }
          
          $.ajax({
            url: 'updateItinerary.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadPage(1,x,0);
              }else{
                alert(response);
              }
            },
          });
        


       
        
       
    });
});

</script>
