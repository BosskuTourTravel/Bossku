  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$query_performa = "SELECT * FROM performa_kurs_standart WHERE id=".$_POST['id'];
$rs_performa=mysqli_query($con,$query_performa);
$row_performa = mysqli_fetch_array($rs_performa);

$querytour = "SELECT * FROM country";
$rstour=mysqli_query($con,$querytour);

$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT PERFORMA KURS</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPerforma(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->

              <div class='card card-primary'>
        
                <div class='card-body'>
                 
                   <div class=form-group'>
                   <input type='text' class='form-control' name='tid' id='tid' value='".$_POST['id']."' hidden>
                    <label>Country</label>
                    <select class='chosen' name='country' id='country' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtour = mysqli_fetch_array($rstour)){
                      if($rowtour['id']==$row_performa['country']){
                        echo "<option selected='selected' value=".$rowtour['id'].">".$rowtour['name']."</option>";
                      }else{
                        echo "<option value=".$rowtour['id'].">".$rowtour['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>
                  </br>
                  <div class=form-group'>
                    <label>Kurs</label>
                    <select class='chosen' name='kurs' id='kurs' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      if($rowkurs['id']==$row_performa['kurs']){
                        echo "<option selected='selected' value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                  </div></br>
                  <div class='form-group'>
                    <label>Price</label>
                    <input type='text' class='form-control' name='price' id='price' value='".$row_performa['price']."' placeholder='Enter Price'>
                  </div>

                <div style='margin-top:3%;'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
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
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=price]").val();
        var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
        var c = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;

        var x = $("input[name=tid]").val();
        fd.append('price',a);
        fd.append('country',b);
        fd.append('kurs',c);
        fd.append('id',x);


        $.ajax({
            url: 'updatePerformaKurs.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              alert(response);
              reloadPerforma(0,0,0);
            },
        });
    });
});
</script>
