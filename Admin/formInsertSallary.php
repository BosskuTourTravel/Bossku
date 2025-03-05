  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

session_start();

$query2 = "SELECT * FROM jobdesk";
$rs2=mysqli_query($con,$query2);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INPUT JOB DESCRIPTION STAFF</h3>
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
              <div class='card-body'>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>";
                  
                  echo "
                  <div class=form-group'>
                    <label style='margin-right:140px;'>Name</label>
                    <select class='chosen' name='nama' id='jobdesk' onchange='changejobdesk()'>
                    <option selected='selected' value=0>Pilih Nama Staff</option>";

                    while($row2=mysqli_fetch_array($rs2)){
                        echo "<option value=".$row2['nama'].">".$row2['nama']."</option>";
                      }
                    
                   echo "</select>
                  </div></br>
                  <!-- form start -->
                   <div class=form-group'>
                    <label style='margin-right:85px;'>UPLOAD DATA</label>
                    <select name='sallary_item' id='sallary_item'>
                      <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                    
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divsallary' id='divsallary'></div>";

                  echo "
                  </br>
                   <div class=form-group'>
                    <label style='margin-right:100px;'>INPUT DATA</label>
                    <select name='input_data' id='input_data'>
                     <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                        
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divdata' id='divdata'></div>";


                  echo "
                  </br>
                   <div class=form-group'>
                    <label style='margin-right:50px;'>UPLOAD PROMO IG</label>
                    <select name='upg' id='upg'>
                     <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                        
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divupg' id='divupg'></div>";

                  echo "
                  </br>
                   <div class=form-group'>
                    <label style='margin-right:70px;'>BROADCAST WA</label>
                    <select name='bwa' id='bwa'>
                     <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                        
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divbwa' id='divbwa'></div>";

                  echo "
                  </br>
                   <div class=form-group'>
                    <label style='margin-right:40px;'>POSTING FB GROUP</label>
                    <select name='pfg' id='pfg'>
                     <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                        
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divpfg' id='divpfg'></div>";

                  echo "
                  </br>
                   <div class=form-group'>
                    <label style='margin-right:100px;'>STATUS WA</label>
                    <select name='sw' id='sw'>
                     <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                        
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divsw' id='divsw'></div>";

                  echo "
                  </br>
                   <div class=form-group'>
                    <label style='margin-right:40px;'>PAKET INTINERARY</label>
                    <select name='pi' id='pi'>
                     <option selected='selected' value=0>Pilih jumlah Item</option>";

                        for ($x = 1; $x <= 20; $x++){
                          echo "<option value=".$x.">".$x."</option>";
                        }
                        
                   echo "</select>
                  </div></br>
                  <div class=form-group' name='divpi' id='divpi'></div>";
                  
                      
                       
                  
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
   function changejobdesk(){
      $("#sallary_item").val(0);
      $("#input_data").val(0);
      $("#upg").val(0);
      $("#bwa").val(0);
      $("#pfg").val(0);
      $("#sw").val(0);
      $("#pi").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $("#upg").val(0);
      $('#divsallary').html('');
      $('#divdata').html('');
      $('#divbwa').html('');
      $('#divpfg').html('');
      $('#divsw').html('');
      $('#divpi').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
      $('#divupg').html('');
    };

  $(document).ready(function(){
    $(".chosen").chosen();



    $('#sallary_item').on('change', function() {
        if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
          alert('Pilih nama staff terlebih dahulu');
          $("#sallary_item").val(0);
        }else{
           var jd = this.value;
           var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
           $.ajax({
            type:'POST',
            url:'sallary_item.php',
            data:{'jd':jd,'jobdesk':a},
            success:function(data){
             $('#divsallary').html(data);
           }
         });
        }
       
      });

    $('#input_data').on('change', function() {
        if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
          alert('Pilih nama staff terlebih dahulu');
          $("#input_data").val(0);
        }else{
           var jd = this.value;
           var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
           $.ajax({
            type:'POST',
            url:'sallary_item.php',
            data:{'jd':jd,'jobdesk':a},
            success:function(data){
             $('#divdata').html(data);
           }
         });
        }
       
      });

    $('#upg').on('change', function() {
      if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
        alert('Pilih nama staff terlebih dahulu');
        $("#upg").val(0);
      }else{
          var jd = this.value;
          var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
          $.ajax({
          type:'POST',
          url:'sallary_item.php',
          data:{'jd':jd,'jobdesk':a},
          success:function(data){
            $('#divupg').html(data);
          }
        });
      }
       
      });

      $('#bwa').on('change', function() {
      if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
        alert('Pilih nama staff terlebih dahulu');
        $("#bwa").val(0);
      }else{
          var jd = this.value;
          var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
          $.ajax({
          type:'POST',
          url:'sallary_item.php',
          data:{'jd':jd,'jobdesk':a},
          success:function(data){
            $('#divbwa').html(data);
          }
        });
      }
       
      });

      $('#pfg').on('change', function() {
      if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
        alert('Pilih nama staff terlebih dahulu');
        $("#pfg").val(0);
      }else{
          var jd = this.value;
          var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
          $.ajax({
          type:'POST',
          url:'sallary_item.php',
          data:{'jd':jd,'jobdesk':a},
          success:function(data){
            $('#divpfg').html(data);
          }
        });
      }
       
      });

      $('#sw').on('change', function() {
      if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
        alert('Pilih nama staff terlebih dahulu');
        $("#sw").val(0);
      }else{
          var jd = this.value;
          var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
          $.ajax({
          type:'POST',
          url:'sallary_item.php',
          data:{'jd':jd,'jobdesk':a},
          success:function(data){
            $('#divsw').html(data);
          }
        });
      }
       
      });

      $('#pi').on('change', function() {
      if(document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value==0){
        alert('Pilih nama staff terlebih dahulu');
        $("#pi").val(0);
      }else{
          var jd = this.value;
          var a = document.getElementById("jobdesk").options[document.getElementById("jobdesk").selectedIndex].value;
          $.ajax({
          type:'POST',
          url:'sallary_item.php',
          data:{'jd':jd,'jobdesk':a},
          success:function(data){
            $('#divpi').html(data);
          }
        });
      }
       
      });


    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=name]").val();
        var b = document.getElementById("login_staff").options[document.getElementById("login_staff").selectedIndex].value;

        var h = "";
        for (var i = 1; i <= $("#sallary_item").val(); i++) {
          if(i==1){
            h = h + $("#sallary"+i).val();
          }
          else{
            h = h + ";" + $("#sallary"+i).val();
          }
        }
      
        fd.append('name',a);
        fd.append('sallary',h);
        fd.append('login_staff',b);
        $.ajax({
            url: 'insertSallary.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadsallary(0,0,0);
              }else{
                alert(response);
              }
              
            },
        });
    });
});

</script>
