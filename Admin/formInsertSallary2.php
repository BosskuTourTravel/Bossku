<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$queryjob = "SELECT * FROM jobdesk";
$rsjob=mysqli_query($con,$queryjob);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>INPUT JOB DESCRIPTION STAFF</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>


              <div class='card card-primary' style='height:700px;'>
              
              <!-- /.card-header -->
                <div class='card-body'>
                 <div class='form-group' >
                    <label>STAFF</label>
                    <select class='chosen' name='staff' id='staff' onchange='getstaff(this.value)' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowjob = mysqli_fetch_array($rsjob)){
                      echo "<option value='".$rowjob['id']."'>".$rowjob['nama']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class=form-group' name='divstaff' id='divstaff'>";
                  echo "</div>
                    <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>";
              echo" 
            </div>        
              </div>
            </div>
          </div>
        </div>
</div>";
?>

<script>
   function getstaff(x) {
    $.ajax({
      type:'POST',
      url:'getSallary.php',
      data:{'staff':x},
      success:function(data){
        $('#divstaff').html(data);
      }
    });
  }



  $(document).ready(function(){
    $(".chosen").chosen();
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
        var h ="";       

      for (var i = 1; i <= $("#salaryCount").val(); i++) {
        if(i==1){
          h = h + $("#salaryItem"+i).val();
        }
        else{
          h = h + ";" + $("#salaryItem"+i).val();
        }
      }        var x = "";
        var l = "";
        for (var j = 1; j <= $("#country_count").val(); j++) {
          if(j==1){
            l = l + $("#city_count"+j).val();
          }else{
            l = l + ";" + $("#city_count"+j).val();
          }

          for (var i = 1; i <= $("#city_count"+j).val(); i++) {
              if(j==1 && i==1){
                x = x + $("#city"+j+i).val();
              }
              else{
                x = x + ";" + $("#city"+j+i).val();
              }
            }
        }
      alert(x);
        fd.append('staff',a);
        fd.append('keterangan',h);
        $.ajax({
            url: 'insertSallary.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
                alert(response);
            		reloadPage(-13,0,0);
            	}
              
            },
        });
    });
});

</script>
