<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
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
$queryper = "SELECT * FROM periode";
$rsper=mysqli_query($con,$queryper);

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
                  <select class='chosen' name='agent' id='agent'>
                     <option value=''> Pilih Agent</option>";
                     while($rowAgent = mysqli_fetch_array($rsAgent)){
                       echo "<option value='".$rowAgent['id']."'>".$rowAgent['company']."  ===>  (".$rowAgent['name'].")</option>";
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
                  <label>Pilih Periode</label>
                  <select class='form-control'  name='season' id='season'>
                  <option value=''> Pilih Season</option>";
                  while($rowper = mysqli_fetch_array($rsper)){
                    echo "<option value='".$rowper['id']."'>".$rowper['nama']."</option>";
                  }
                  echo"</select>
                  </div>
                  <div class='form-group'>
                  <label>Kurs</label>
                  <select class='form-control' name='kurs' id='kurs'>
                     <option value=''> Pilih Kurs</option>";
                     while($rowkurs = mysqli_fetch_array($rskurs)){
                       echo "<option value='".$rowkurs['id']."'>".$rowkurs['name']."</option>";
                     }
                 echo"</select>
                  </div>";
                  $notrans=0;
                  while($rowtran = mysqli_fetch_array($rstran)){
                  echo"
                       <div class='form-group'>
                            <div class='row'>
                                <div class='col-4'>
                                    <label>".$rowtran['name']."</label>
                                    <input name='tp".$notrans."' id='tp".$notrans."' value='".$rowtran['id']."' type='hidden' >
                                </div>
                                 <div class='col'>
                                    <input type='text' class='form-control' name='seat".$notrans."' id='seat".$notrans."'placeholder='Seat'>
                                </div>
                                <div class='col'>
                                </div>
                            </div>
                        </div>
                        <table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px; max-height:100px important;'>
                      <thead>
                        <tr>
                          <th scope='col'>Rentype</th>
                          <th scope='col'>Duration</th>
                          <th scope='col'>Harga</th>
                          <th scope='col'>Remarks</th>
                        </tr>
                      </thead>
                      <tbody id='myTable'>";
                            $querytype = "SELECT * FROM rent_type";
                            $rstype=mysqli_query($con,$querytype);
                           $noren=0;
                           while($rowtype = mysqli_fetch_array($rstype)){
                        echo"<tr>
                          <th scope='row'>".$rowtype['nama']."
                          </th>
                          <input name='ren".$notrans."".$noren."' id='ren".$notrans."".$noren."' value='".$rowtype['id']."' type='hidden' >
                          <td>".$rowtype['duration']." hours</td>
                          <input name='durasi".$notrans."".$noren."' id='durasi".$notrans."".$noren."' value='".$rowtype['duration']."' type='hidden' >
                          <td>
                          <div class='form-group'>
                          <input type='text' class='form-control' name='harga".$notrans."".$noren."' id='harga".$notrans."".$noren."'>
                          </div>
                          </td>
                          <td>
                          <div class='form-group'>
                          <textarea  class='form-control' name='remarks".$notrans."".$noren."' id='remarks".$notrans."".$noren."'></textarea>
                          </div>
                          </td>
                        </tr>";
                        $noren=$noren+1;
                       }

                  echo"
                      </tbody>
                    </table> </br>";
                    $notrans=$notrans+1;
                      }
                      $totalren=$noren;
                      $totaltrans=$notrans;
                      $totalpax = $z;

                    echo "<input type='text' name='totalren' id='totalren' value='".$totalren."' hidden>";
                    echo "<input type='text' name='totaltrans' id='totaltrans' value='".$totaltrans."' hidden>";
                echo"
                    </div>     
                </div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$(".chosen").chosen();
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
        // disable button
        $(this).prop("disabled", true);
      // add spinner to button
      $(this).html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
      );
  var fd = new FormData();
  var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
  var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
  var c = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
  var d = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
  var e = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
  var f = document.getElementById("season").options[document.getElementById("season").selectedIndex].value;
  var totalren = $("input[name=totalren]").val();
  var totaltrans = $("input[name=totaltrans]").val();

  fd.append('agent',a);
  fd.append('country',b);
  fd.append('city',c);
  fd.append('continent',d);
  fd.append('kurs',e);
  fd.append('season',f);
  fd.append('totalren',totalren);
  fd.append('totaltrans',totaltrans);

  for (var i = 0; i < totaltrans; i++) {
    var g = $("input[name=tp"+i+"]").val();
    var h = $("input[name=seat"+i+"]").val();


    fd.append('tp'+i,g);
    fd.append('seat'+i,h);

         for (var j = 0; j < totalren; j++) {
              var k = $("input[name=ren"+i+""+j+"]").val();
              var n = $("input[name=durasi"+i+""+j+"]").val();
              var l = $("input[name=harga"+i+""+j+"]").val();
              var m = $("textarea[name=remarks"+i+""+j+"]").val();
              
              fd.append('ren'+i+j,k);
              fd.append('harga'+i+j,l);
              fd.append('durasi'+i+j,n);
              fd.append('remarks'+i+j,m);
   //      alert(k);   
            }
  }
      $.ajax({
        url: 'insertTransport.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            alert(response);
            reloadTransport(0,0,0);
        },
    });
  });
});

</script>
