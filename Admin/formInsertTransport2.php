<?php
include "../site.php";
include "../db=connection.php";

$queryAgent = "SELECT * FROM agent";
$rsAgent=mysqli_query($con,$queryAgent);
$querycon = "SELECT * FROM continent";
$rscon=mysqli_query($con,$querycon);
$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);
$querytran = "SELECT * FROM transport_type";
$rstran=mysqli_query($con,$querytran);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT TRANSPORT </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadTransport(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                  <div class='form-group'>
                  <label>Agent</label>
                  <select class='form-control' name='agent' id='agent'>
                     <option value=''> Pilih Agent</option>";
                     while($rowAgent = mysqli_fetch_array($rsAgent)){
                       echo "<option value='".$rowAgent['id']."'>".$rowAgent['name'].".:".$rowAgent['company']."</option>";
                     }
                 echo"</select>
                  </div>
                  <div class='form-group'>
                  <label>Continent</label>
                  <select class='form-control' name='continent' id='continent'>
                     <option value=''> Pilih Continent</option>";
                     while($rowcon = mysqli_fetch_array($rscon)){
                       echo "<option value='".$rowcon['id']."'>".$rowcon['name']."</option>";
                     }
                 echo"</select>
                  </div>

                  <div class='form-group'>
                  <label>Country</label>
                  <select class='form-control' name='country' id='country'>
                     <option value=''> Pilih Country</option>
                 </select>
                  </div>
                  <div class='form-group'>
                  <label>City</label>
                  <select class='form-control' name='city' id='city'>
                     <option value=''> Pilih City</option>
                 </select>
                  </div>
                  <div class='form-group'>
                  <input type='checkbox' name='high'id='high' value='high'>High Season</input>
                  <input type='checkbox' name='low' id='low' value='high'>Low Season</input>
                  </div>
                  <div class='form-group'>
                  <label>Kurs</label>
                  <select class='form-control' name='continent' id='continent'>
                     <option value=''> Pilih Kurs</option>";
                     while($rowkurs = mysqli_fetch_array($rskurs)){
                       echo "<option value='".$rowkurs['id']."'>".$rowkurs['name']."</option>";
                     }
                 echo"</select>
                  </div>";
                  while($rowtran = mysqli_fetch_array($rstran)){
                  echo"
                       <div class='form-group'>
                            <div class='row'>
                                <div class='col-4'>
                                    <label>".$rowtran['name']."</label>
                                    <input name='tp".$rowtran['id']."' id='tp".$rowtran['id']."' value='".$rowtran['id']."' type='hidden' >
                                </div>
                                 <div class='col'>
                                    <input type='text' class='form-control' name='seat".$rowtran['id']."' id='seat".$rowtran['id']."'placeholder='Seat'>
                                </div>
                                <div class='col'>
                                </div>
                            </div>
                        </div>
                  <table class='table table-bordered'>
                      <thead>
                        <tr>
                          <th scope='col'>Rentype</th>
                          <th scope='col'>Duration</th>
                          <th scope='col'>Harga</th>
                          <th scope='col'>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>";
                            $querytype = "SELECT * FROM rent_type";
                            $rstype=mysqli_query($con,$querytype);
                           while($rowtype = mysqli_fetch_array($rstype)){
                               $count=$rowtype['id'];
                        echo"<tr>
                          <th scope='row'>".$rowtype['nama']."
                          <input name='ren".$rowtype['id']."' id='ren".$rowtype['id']."' value='".$rowtype['id']."' type='hidden' >
                          </th>
                          <td>".$rowtype['duration']." hour</td>
                          <td>
                          <div class='form-group'>
                          <input type='text' class='form-control' name='".$rowtran['id']."harga".$rowtype['id']."' id='".$rowtran['id']."harga".$rowtype['id']."'>
                          </div>
                          </td>
                          <td>
                          <div class='form-group'>
                          <input type='text' class='form-control' name='".$rowtran['id']."remarks".$rowtype['id']."' id='".$rowtran['id']."remarks".$rowtype['id']."'>
                          </div>
                          </td>
                        </tr>";
                       }
                  echo"
                      </tbody>
                    </table> </br>";
                    
                      }
                
                echo"
                    </div>     
                </div>

                <div class='card-footer'>
                <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>";
                echo"</div>
              </form>
            </div>

            
                

              </div>
            </div>
          </div>
        </div>
</div>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#continent").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#continent").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                url: 'getCont.php',
                data: {'continent':cont},
                success: function(data){
                   $("#country").html(data);
                }
            });
        });
$("#country").change(function(){
    // variabel dari nilai combo box kendaraan
    var cit = $("#country").val();

    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
        type: 'POST',
        url: 'getCity2.php',
        data: {'country':cit},
        success: function(data){
            $("#city").html(data);
        }
    });
});

$("#but_upload").click(function(){
  var fd = new FormData();
  var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
  var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
  var c = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
  var d = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
 // var e = ;
  //var f = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
 var ren ="";

 for (var i = 1; i <=count($("#ren").val(); i++) {
     if(i==1){
           h = h + $("#ren"+i).val();
       }
     else{
     h = h + ";" + $("#ren"+i).val();
     }
     }

     alert($count);
     fd.append('agent',a);
        fd.append('country',h);
        fd.append('city',b);
        fd.append('"continent',c);
        fd.append('"ren',ren);

        $.ajax({
            url: 'insertSallary3.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadsallary(5,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  });
});

</script>
