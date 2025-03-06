<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";
session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>TRANSPORT QUOTATION</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 130px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='insertPage(24,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0' style='font-size:14px; align:center;'>";
              echo"
                <div class='container'>
                    <div class='form-row'>
                             <div class='col-3'>
                             <div class='card-body'>
                             <label>Pilih Landtour</label>
                         </div>
                             </div>
                             <div class='col-9'>
                                <div class='card border-primary mb-3'>
                                     <div class='card-body'>
                                     <table class='table table-sm'>
                                     <thead>
                                       <tr>
                                         <th scope='col'>#</th>
                                         <th scope='col'>Tour Code</th>
                                         <th scope='col'>Tour Type</th>
                                         <th scope='col'>Tour Category</th>
                                         <th scope='col'>Tour Name</th>
                                         <th scope='col'>staff</th>
                                       </tr>
                                     </thead>
                                     <tbody>";
                                     $query = "SELECT * FROM tour_package ORDER BY category ASC";
                                     $rs=mysqli_query($con,$query);
                                     $n=1;
                                     while($row = mysqli_fetch_array($rs)){
                                      $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                                      $rsstaff=mysqli_query($con,$querystaff);
                                      $rowstaff = mysqli_fetch_array($rsstaff);
                                      $queryyy="SELECT category, COUNT(category) AS count FROM tour_package GROUP BY category HAVING COUNT(category) > 0";
                                      $rsyy=mysqli_query($con,$queryyy);
                                      $x=1;
                                      while($rowyy = mysqli_fetch_array($rsyy)){
                                      if($rowyy['category']==$row['category'] && $x==$n){
                                        echo"<tr bgcolor='#A9CCE3 '>
                                        <th scope='row'>
                                        </th>
                                        <td colspan='5' align='center'><b>Tour Category : &nbsp; ".$row['category']."</b></td>
                                      </tr>";
                                      }
                                      $x=$x+$rowyy['count'];
                                    }

                                    $queryhotel = "SELECT * FROM hotelquo where tour_pack=".$row['id'];
                                    $rshotel=mysqli_query($con,$queryhotel);
                                    $rowhotel = mysqli_fetch_array($rshotel);
                                    $hotelquo=$rowhotel['tour_pack'];
                                    //var_dump($hotelquo);
                                    if($hotelquo==NULL){
                                       echo"<tr>
                                         <th scope='row'>
                                         <div class='form-check'>
                                         <input class='form-check-input position-static' type='checkbox'  name='tour' id='".$row['id']."' onclick='total()' value='".$row['id'].",".$row['duration_tour']."'>
                                         </div>
                                         </th>
                                         <td>888".$row['id']."</td>
                                         <td>".$row['tour_type']."</td>
                                         <td>".$row['category']."</td>
                                         <td>".$row['tour_name']."</td>
                                         <td>".$rowstaff['name']."</td>
                                       </tr>";
                                    }else{
                                        echo"<tr bgcolor='#FFFF00'>
                                        <th scope='row'>
                                        <div class='form-check'>
                                        <input class='form-check-input position-static' type='checkbox'  name='tour' id='".$row['id']."' onclick='total()' value='".$row['id'].",".$row['duration_tour']."'>
                                        </div>
                                        </th>
                                        <td>888".$row['id']."</td>
                                        <td>".$row['tour_type']."</td>
                                        <td>".$row['category']."</td>
                                        <td>".$row['tour_name']."</td>
                                        <td>".$rowstaff['name']."</td>
                                      </tr>";

                                    }
                                       $queryxx="SELECT category, COUNT(category) AS count FROM tour_package GROUP BY category HAVING COUNT(category) > 0";
                                       $rsxx=mysqli_query($con,$queryxx);
                                       $y=0;
                                       while($rowxx = mysqli_fetch_array($rsxx)){
                                         
                                      if($rowxx['category']==$row['category'] && $y+$rowxx['count']==$n){
                                        echo"<tr>
                                        <th scope='row'>
                                        </th>
                                        <td colspan='5' align='center'><b>jumlah &nbsp; ".$rowxx['count']."</b></td>
                                      </tr>";

                                      }
                                      $y=$y+$rowxx['count'];
                                     // echo $y;
                                      }
                                      $n=$n+1;
                                      }

                                     echo"</tbody>
                                   </table>";
                                    echo"</div>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class='form-row'>
                    <div class='col-3'>
                        <div class='card-body'>
                            <label>Total Hari</label>
                        </div>
                    </div>
                    <div class='col-9'>
                        <div class='card border-primary mb-3'>
                            <div class='card-body'>
                                    <div class='form-row'>
                                            <div class='col-sm-2 my-1'>
                                                    <input type='text' class='form-control' id='thari' name='thari' style='width:100px;'>
                                                    <input id='tharid' name='tharid'  type='hidden'>
                                                    <input id='ttotal' name='ttotal'  type='hidden'>
                                            </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class='form-row'>
                    <div class='col-12'>
                        <div class='card border-primary mb-3'>
                            <div class='card-body' style='width:100%;'>
                                    <div class='form-row'>";
                                            $queryAgent = "SELECT DISTINCT agent FROM transport";
                                            $rsAgent=mysqli_query($con,$queryAgent);
                                            $queryAgentb = "SELECT DISTINCT agent FROM transport";
                                            $rsAgentb=mysqli_query($con,$queryAgentb);
                                            $queryAgentc = "SELECT DISTINCT agent FROM transport";
                                            $rsAgentc=mysqli_query($con,$queryAgentc);
                                            $queryAgentd = "SELECT DISTINCT agent FROM transport";
                                            $rsAgentd=mysqli_query($con,$queryAgentd);
                                            $queryAgente = "SELECT DISTINCT agent FROM transport";
                                            $rsAgente=mysqli_query($con,$queryAgente);
                                            $queryAgentf = "SELECT DISTINCT agent FROM transport";
                                            $rsAgentf=mysqli_query($con,$queryAgentf);

                                            $querycity = "SELECT DISTINCT  city FROM transport";
                                            $rscity=mysqli_query($con,$querycity);
                                            $querycityb = "SELECT DISTINCT  city FROM transport";
                                            $rscityb=mysqli_query($con,$querycityb);
                                            $querycityc = "SELECT DISTINCT  city FROM transport";
                                            $rscityc=mysqli_query($con,$querycityc);
                                            $querycityd = "SELECT DISTINCT  city FROM transport";
                                            $rscityd=mysqli_query($con,$querycityd);
                                            $querycitye = "SELECT DISTINCT  city FROM transport";
                                            $rscitye=mysqli_query($con,$querycitye);
                                            $querycityf = "SELECT DISTINCT  city FROM transport";
                                            $rscityf=mysqli_query($con,$querycityf);

                                            $queryper = "SELECT DISTINCT  periode FROM transport";
                                            $rsper=mysqli_query($con,$queryper);
                                            $queryperb = "SELECT DISTINCT  periode FROM transport";
                                            $rsperb=mysqli_query($con,$queryperb);
                                            $queryperc = "SELECT DISTINCT  periode FROM transport";
                                            $rsperc=mysqli_query($con,$queryperc);
                                            $queryperd = "SELECT DISTINCT  periode FROM transport";
                                            $rsperd=mysqli_query($con,$queryperd);
                                            $querypere = "SELECT DISTINCT  periode FROM transport";
                                            $rspere=mysqli_query($con,$querypere);
                                            $queryperf = "SELECT DISTINCT  periode FROM transport";
                                            $rsperf=mysqli_query($con,$queryperf);

                                            $querykurs = "SELECT DISTINCT  kurs FROM transport";
                                            $rskurs=mysqli_query($con,$querykurs);
                                            // $querytr = "SELECT DISTINCT  transport_type FROM transport";
                                            // $rstr=mysqli_query($con,$querytr);

                                            echo"<div class=form-group' style='margin-bottom:10px;'>
                                                    <div class='card border-primary mb-3'>
                                                        <div class='card-body'>
                                                              <form>
                                                                  <div class='form-row'>
                                                                      <table id='dtBasicExample' class='table table-striped  table-borderless table-sm' style='font-size:8px; max-height:80px important;'>
                                                                        <th>
                                                                              <div class='col'>
                                                                              <select class='form-control' name='agent' id='agent' style='width:130px;'>
                                                                                      <option value=''>Pilih Agent 1</option>";
                                                                                          while($rowAgent = mysqli_fetch_array($rsAgent)){
                                                                                              $queryAgent2 = "SELECT * FROM agent where id=".$rowAgent['agent']; 
                                                                                              $rsAgent2=mysqli_query($con,$queryAgent2);
                                                                                              $rowAgent2 = mysqli_fetch_array($rsAgent2);
                                                                                              echo "<option value='".$rowAgent2['id']."'>".$rowAgent2['company']."(".$rowAgent2['name'].")</option>";
                                                                                          }
                                                                            echo"</select>
                                                                            </div>
                                                                        </th>
                                                                        <th>
                                                                        <div class='col'>
                                                                        <select class='form-control' name='agent2' id='agent2'style='width:130px;'>
                                                                            <option value=''>Pilih Agent 2</option>";
                                                                                while($rowAgentb = mysqli_fetch_array($rsAgentb)){
                                                                                    $queryAgent2b = "SELECT * FROM agent where id=".$rowAgentb['agent']; 
                                                                                    $rsAgent2b=mysqli_query($con,$queryAgent2b);
                                                                                    $rowAgent2b = mysqli_fetch_array($rsAgent2b);
                                                                                    echo "<option value='".$rowAgent2b['id']."'>".$rowAgent2b['company']."(".$rowAgent2b['name'].")</option>";
                                                                                }
                                                                  echo"</select>
                                                                  </div>
                                                                        </th>
                                                                        <th>
                                                                        <div class='col'>
                                                                        <select class='form-control' name='agent3' id='agent3'style='width:130px;'>
                                                                            <option value=''>Pilih Agent 3</option>";
                                                                                while($rowAgentc = mysqli_fetch_array($rsAgentc)){
                                                                                    $queryAgent2c = "SELECT * FROM agent where id=".$rowAgentc['agent']; 
                                                                                    $rsAgent2c=mysqli_query($con,$queryAgent2c);
                                                                                    $rowAgent2c = mysqli_fetch_array($rsAgent2c);
                                                                                    echo "<option value='".$rowAgent2c['id']."'>".$rowAgent2c['company']."(".$rowAgent2c['name'].")</option>";
                                                                                }
                                                                  echo"</select>
                                                                  </div>
                                                                </th>
                                                                <th>
                                                                  <div class='col'>
                                                                        <select class='form-control' name='agent4' id='agent4'style='width:130px;'>
                                                                              <option value=''>Pilih Agent 4</option>";
                                                                                  while($rowAgentd = mysqli_fetch_array($rsAgentd)){
                                                                                      $queryAgent2d = "SELECT * FROM agent where id=".$rowAgentd['agent']; 
                                                                                      $rsAgent2d=mysqli_query($con,$queryAgent2d);
                                                                                      $rowAgent2d = mysqli_fetch_array($rsAgent2d);
                                                                                      echo "<option value='".$rowAgent2d['id']."'>".$rowAgent2d['company']."(".$rowAgent2d['name'].")</option>";
                                                                                  }
                                                                    echo"</select>
                                                                    </div>
                                                                  </th>
                                                                  <th>
                                                                  <div class='col'>
                                                                  <select class='form-control' name='agent5' id='agent5'style='width:130px;'>
                                                                      <option value=''>Pilih Agent 5</option>";
                                                                          while($rowAgente = mysqli_fetch_array($rsAgente)){
                                                                              $queryAgent2e = "SELECT * FROM agent where id=".$rowAgente['agent']; 
                                                                              $rsAgent2e=mysqli_query($con,$queryAgent2e);
                                                                              $rowAgent2e = mysqli_fetch_array($rsAgent2e);
                                                                              echo "<option value='".$rowAgent2e['id']."'>".$rowAgent2e['company']."(".$rowAgent2e['name'].")</option>";
                                                                          }
                                                            echo"</select>
                                                            </div>
                                                          </th>
                                                          <th>
                                                          <div class='col'>
                                                          <select class='form-control' name='agent6' id='agent6'style='width:130px;'>
                                                              <option value=''>Pilih Agent 6</option>";
                                                                  while($rowAgentf = mysqli_fetch_array($rsAgentf)){
                                                                      $queryAgent2f = "SELECT * FROM agent where id=".$rowAgentf['agent']; 
                                                                      $rsAgent2f=mysqli_query($con,$queryAgent2f);
                                                                      $rowAgent2f = mysqli_fetch_array($rsAgent2f);
                                                                      echo "<option value='".$rowAgent2f['id']."'>".$rowAgent2f['company']."(".$rowAgent2f['name'].")</option>";
                                                                  }
                                                              echo"</select>
                                                              </div>
                                                            </th>
                                                                <tr>
                                                                  <th>
                                                                  <div class='col'>
                                                                      <select class='form-control' name='city' id='city' style='width:130px;'>
                                                                      <option value=''>Pilih City 1</option>";
                                                                echo"</select>
                                                                </div></th>
                                                                  <th>
                                                                  <div class='col'>
                                                                      <select class='form-control' name='city2' id='city2'  style='width:130px;'>
                                                                          <option value=''>Pilih City 2</option>";
                                                                echo"</select>
                                                                </div></th>
                                                                  <th>
                                                                  <div class='col'>
                                                                      <select class='form-control' name='city3' id='city3'  style='width:130px;'>
                                                                          <option value=''>Pilih City 3</option>";
                                                                echo"</select>
                                                                </div>
                                                                  </th>
                                                                  <th>
                                                                  <div class='col'>
                                                                  <select class='form-control'  name='city4' id='city4'  style='width:130px;'>
                                                                      <option value=''>Pilih City 4</option>";
                                                            echo"</select>
                                                            </div></th>
                                                              <th>
                                                              <div class='col'>
                                                                  <select class='form-control'  name='city5' id='city5'  style='width:130px;'>
                                                                      <option value=''>Pilih City 5</option>";
                                                            echo"</select>
                                                            </div></th>
                                                              <th>
                                                              <div class='col'>
                                                                  <select class='form-control'  name='city6' id='city6'  style='width:130px;'>
                                                                      <option value=''>Pilih City 6</option>";
                                                            echo"</select>
                                                            </div>
                                                            </th>
                                                                  </tr>
                                                                  <tr>
                                                                  <th>
                                                                  <div class='col'>
                                                                  <select class='form-control' name='per' id='per' style='width:130px;'>
                                                                          <option value=''>Pilih Periode 1</option>";
                                                                          while($rowper= mysqli_fetch_array($rsper)){
                                                                            $queryper2 = "SELECT * FROM periode where id=".$rowper['periode']; 
                                                                            $rsper2=mysqli_query($con,$queryper2);
                                                                            $rowper2 = mysqli_fetch_array($rsper2);
                                                                        echo "<option value='".$rowper2['id']."'>".$rowper2['nama']."</option>";
                                                                        }
                                                                echo"</select>
                                                                  </div>
                                                            </th>
                                                            <th>
                                                            <div class='col'>
                                                                <select class='form-control'  name='per2' id='per2' style='width:130px;'>
                                                                    <option value=''>Pilih Periode 2</option>";
                                                                        while($rowperb= mysqli_fetch_array($rsperb)){
                                                                            $queryper2b = "SELECT * FROM periode where id=".$rowperb['periode']; 
                                                                            $rsper2b=mysqli_query($con,$queryper2b);
                                                                            $rowper2b = mysqli_fetch_array($rsper2b);
                                                                        echo "<option value='".$rowper2b['id']."'>".$rowper2b['nama']."</option>";
                                                                        }
                                                          echo"</select>
                                                            </div>
                                                      </th>
                                                      <th>
                                                      <div class='col'>
                                                          <select class='form-control'  name='per3' id='per3' style='width:130px;'>
                                                              <option value=''>Pilih Periode 3</option>";
                                                                  while($rowperc= mysqli_fetch_array($rsperc)){
                                                                      $queryper2c = "SELECT * FROM periode where id=".$rowperc['periode']; 
                                                                      $rsper2c=mysqli_query($con,$queryper2c);
                                                                      $rowper2c = mysqli_fetch_array($rsper2c);
                                                                  echo "<option value='".$rowper2c['id']."'>".$rowper2c['nama']."</option>";
                                                                  }
                                                    echo"</select>
                                                      </div>
                                                </th>
                                                <th>
                                                <div class='col'>
                                                    <select class='form-control'  name='per4' id='per4' style='width:130px;'>
                                                        <option value=''>Pilih Periode 4</option>";
                                                            while($rowperd= mysqli_fetch_array($rsperd)){
                                                                $queryper2d = "SELECT * FROM periode where id=".$rowperd['periode']; 
                                                                $rsper2d=mysqli_query($con,$queryper2d);
                                                                $rowper2d = mysqli_fetch_array($rsper2d);
                                                            echo "<option value='".$rowper2d['id']."'>".$rowper2d['nama']."</option>";
                                                            }
                                              echo"</select>
                                                </div>
                                          </th>
                                          <th>
                                          <div class='col'>
                                              <select class='form-control'  name='per5' id='per5' style='width:130px;'>
                                                  <option value=''>Pilih Periode 5</option>";
                                                      while($rowpere= mysqli_fetch_array($rspere)){
                                                          $queryper2e = "SELECT * FROM periode where id=".$rowpere['periode']; 
                                                          $rsper2e=mysqli_query($con,$queryper2e);
                                                          $rowper2e = mysqli_fetch_array($rsper2e);
                                                      echo "<option value='".$rowper2e['id']."'>".$rowper2e['nama']."</option>";
                                                      }
                                        echo"</select>
                                          </div>
                                    </th>
                                    <th>
                                    <div class='col'>
                                        <select class='form-control'  name='per6' id='per6' style='width:130px;'>
                                            <option value=''>Pilih Periode 3</option>";
                                                while($rowperf= mysqli_fetch_array($rsperf)){
                                                    $queryper2f = "SELECT * FROM periode where id=".$rowperf['periode']; 
                                                    $rsper2f=mysqli_query($con,$queryper2f);
                                                    $rowper2f = mysqli_fetch_array($rsper2f);
                                                echo "<option value='".$rowper2f['id']."'>".$rowper2f['nama']."</option>";
                                                }
                                  echo"</select>
                                    </div>
                                  </th>
                                    </tr>
                                                <tr>
                                                            <th>
                                                            <button type='button' class='btn btn-warning' onclick='search()'>Submit
                                                            </th>
                                                            </tr>";

                                                                  echo"</table>
                                                              </div>
                                                          </form>
                                                    </div>";
                                        echo"</select>
                                        <div class=form-group' name='divjobi' id='divjobi'></div>
                                        <div class=form-group' name='divtr' id='divtr'></div>
                                        </div>";
                                    echo"</div>
                            </div>
                        </div>
                    </div>
                   </div>
                   </div>
                   <div class='form-row'>
                      <div class='card-body'>
                          <div id='daymb'></div>
                      </div>
                   </div>
                </div>";
                echo"
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
    $("#agent").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#agent").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'get_transcity.php',
                data: {'agent':cont},
                success: function(data){
                   $("#city").html(data);
                }
            });
        });
        $("#agent2").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#agent2").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'get_transcity.php',
                data: {'agent2':cont},
                success: function(data){
                   $("#city2").html(data);
                }
            });
        });
        $("#agent3").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#agent3").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'get_transcity.php',
                data: {'agent3':cont},
                success: function(data){
                   $("#city3").html(data);
                }
            });
        });
        $("#agent4").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#agent4").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'get_transcity.php',
                data: {'agent4':cont},
                success: function(data){
                   $("#city4").html(data);
                }
            });
        });
        $("#agent5").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#agent5").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'get_transcity.php',
                data: {'agent5':cont},
                success: function(data){
                   $("#city5").html(data);
                }
            });
        });
        $("#agent6").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#agent6").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                dataType: "html",
                url: 'get_transcity.php',
                data: {'agent6':cont},
                success: function(data){
                   $("#city6").html(data);
                }
            });
        });
function total() {
  var input = document.getElementsByName("tour");
  var total ="";
  //var subtotal ="";
  for (var i = 0; i < input.length; i++) {
          if (input[i].checked) {
            if(total==""){
                      total = total + input[i].value;
            }
            else{
                 total = total + ";"+ input[i].value;
            }
          }
  }
  //alert(total);
  var strtotal = total.split(";");
  var strtotal2=[];
  var subtotal=0;
  for(var i = 0; i < strtotal.length; i++){
          strtotal2[i] = strtotal[i].split(",");
          d = Number(strtotal2[i][1]);
          subtotal= subtotal + d ;
        }
   var n = subtotal-1;
   document.getElementById("thari").value =  subtotal + "D" + n + "N";
   document.getElementById("tharid").value =  subtotal.toFixed();
   document.getElementById("ttotal").value =  total;
}

function search(x){
    var a =  document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
    var a2 =  document.getElementById("agent2").options[document.getElementById("agent2").selectedIndex].value;
    var a3 =  document.getElementById("agent3").options[document.getElementById("agent3").selectedIndex].value;
    var a4 =  document.getElementById("agent4").options[document.getElementById("agent4").selectedIndex].value;
    var a5 =  document.getElementById("agent5").options[document.getElementById("agent5").selectedIndex].value;
    var a6 =  document.getElementById("agent6").options[document.getElementById("agent6").selectedIndex].value;
    var d =  document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
    var d2 =  document.getElementById("city2").options[document.getElementById("city2").selectedIndex].value;
    var d3 =  document.getElementById("city3").options[document.getElementById("city3").selectedIndex].value;
    var d4 =  document.getElementById("city4").options[document.getElementById("city4").selectedIndex].value;
    var d5 =  document.getElementById("city5").options[document.getElementById("city5").selectedIndex].value;
    var d6 =  document.getElementById("city6").options[document.getElementById("city6").selectedIndex].value;
    var e =  document.getElementById("per").options[document.getElementById("per").selectedIndex].value;
    var e2 =  document.getElementById("per2").options[document.getElementById("per2").selectedIndex].value;
    var e3 =  document.getElementById("per3").options[document.getElementById("per3").selectedIndex].value;
    var e4 =  document.getElementById("per4").options[document.getElementById("per4").selectedIndex].value;
    var e5 =  document.getElementById("per5").options[document.getElementById("per5").selectedIndex].value;
    var e6 =  document.getElementById("per6").options[document.getElementById("per6").selectedIndex].value;
    // var f =  document.getElementById("trans").options[document.getElementById("trans").selectedIndex].value;
    var g =  $("input[name=tharid]").val();
    var ttotal =  $("input[name=ttotal]").val();
//    alert(a5);
//    alert(d5);
alert(ttotal);
    $.ajax({
        url:"searchTransport5.php",
        method: "POST",
        asynch: false,
        data:{agent:a,agent2:a2,agent3:a3,agent4:a4,agent5:a5,agent6:a6,city:d,city2:d2,city3:d3,city4:d4,city5:d5,city6:d6,per:e,per2:e2,per3:e3,per4:e4,per5:e5,per6:e6,thari:g,ttotal:ttotal},
        success:function(data){
        $('#divjobi').html(data);
        }
      });
    
  }

</script>