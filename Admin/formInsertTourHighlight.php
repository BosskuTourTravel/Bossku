  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

session_start();

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT TOUR HIGHLIGHT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadTourHighlight(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body'>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>";
                  
                  echo "
                  <div class='form-group'>
                    <label>Title</label>
                    <input type='text' class='form-control' name='title' id='title' placeholder='Enter Title'>
                  </div>
                  <div class=form-group'>
                    <label>Country</label></br>
                    <select class='chosen' name='country' id='country' onchange='changeCountry()'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcountry=mysqli_fetch_array($rscountry)){
                        echo "<option value=".$rowcountry['id'].">".$rowcountry['name']."</option>";
                      }
                    
                   echo "</select>
                  </div></br>

                   <div class=form-group'>
                    <label>Jumlah Tour Package</label>
                    <select name='tourpackage_count' id='tourpackage_count'>
                    <option selected='selected' value=0>Pilihan</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    
                   echo "</select>
                  </div></br><div class=form-group' name='divtourpackage' id='divtourpackage'></div>";
                      
                       
                  
                echo "

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
   function changeCountry(){
      $("#tourpackage_count").val(0);
      $('#divtourpackage').html('');
    };

  $(document).ready(function(){
    $(".chosen").chosen();



    $('#tourpackage_count').on('change', function() {
        if(document.getElementById("country").options[document.getElementById("country").selectedIndex].value==0){
          alert('Pilih Negara terlebih dahulu');
          $("#tourpackage_count").val(0);
        }else{
           var count = this.value;
           var a = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
           $.ajax({
            type:'POST',
            url:'tourpackage_count.php',
            data:{'count':count,'country':a},
            success:function(data){
             $('#divtourpackage').html(data);
           }
         });
        }
       
      });

    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=title]").val();
        var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;

        var h = "";
        for (var i = 1; i <= $("#tourpackage_count").val(); i++) {
          if(i==1){
            h = h + $("#tourpackage"+i).val();
          }
          else{
            h = h + ";" + $("#tourpackage"+i).val();
          }
        }
      
        fd.append('title',a);
        fd.append('tourpackage',h);
        fd.append('country',b);
        $.ajax({
            url: 'insertTourHighlight.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTourHighlight(0,0,0);
              }else{
                alert(response);
              }
              
            },
        });
    });
});

</script>
