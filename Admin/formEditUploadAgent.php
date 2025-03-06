<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querytourtype = "SELECT * FROM agent ORDER BY company ASC";
$rstourtype=mysqli_query($con,$querytourtype);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM EDIT AGENT SCOPE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                 
                  <div class='form-group'>
                    <label>Agent</label>
                    <select class='chosen' name='agent' id='agent' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";
                    
                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      // $query_agent = "SELECT DISTINCT(agent) FROM agent_files";
                      // $rs_agent=mysqli_query($con,$query_agent);
                      // while($row_agent = mysqli_fetch_array($rs_agent)){
                      //   if($rowtourtype['id']==$row_agent['agent']){
                      //     echo "<option value='".$rowtourtype['id']."'>".$rowtourtype['company']." ( ".$rowtourtype['email']." )</option>";
                      //   }
                      // }
                      if($rowtourtype['tour_country']==''){
                         echo "<option value='".$rowtourtype['id']."'>".$rowtourtype['company']." ( ".$rowtourtype['email']." )</option>";
                       }else{
                         echo "<option style='color:red'  value='".$rowtourtype['id']."'>".$rowtourtype['company']." ( ".$rowtourtype['email']." )</option>";
                       }
                     
                    }
                    echo"</select>
                  </div>

                  </br>
                  <div class=form-group'>
                    <label>Agent Scope</label>
                    <select name='country_count' id='country_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountry' id='divcountry'></div>
                   </br>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                </div>
              </form>
            </div>

            
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

    $('#agent').on('change', function() {
      var count = this.value;
      $.ajax({
          type:'POST',
          url:'cekTourCountry.php',
          data:{'id':count},
          success:function(data){
           // if(data==0){
           //  $("#country_count").attr('disabled', true);
           // }else{
           //  $("#country_count").removeAttr('disabled');
           // }
         }
       });
    });

    $('#country_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getCountryCount.php',
          data:{'count':count},
          success:function(data){
           $('#divcountry').html(data);
         }
       });
    });
    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
        var h = "";
        for (var i = 1; i <= $("#country_count").val(); i++) {
          if(i==1){
            h = h + $("#country"+i).val();
          }
          else{
            h = h + ";" + $("#country"+i).val();
          }
        }
        fd.append('agent',a);
        fd.append('country',h);
        $.ajax({
            url: 'editUploadAgent.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
                alert(response);
            		editAgent(0,0,0);
            	}
              
            },
        });
    });
});

</script>
