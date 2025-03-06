<?php
include "../site.php";
include "../db=connection.php";

$query= "SELECT * FROM transquo WHERE id=".$_POST['id'];
$rs = mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);
$agent1=explode(",", $row['agent1']);
$agent2=explode(",", $row['agent2']);
$agent3=explode(",", $row['agent3']);
$agent4=explode(",", $row['agent4']);
$agent5=explode(",", $row['agent5']);
$agent6=explode(",", $row['agent6']);

$queryAgent_edit = "SELECT * FROM agent where id=".$agent1[2];
$rsAgent_edit=mysqli_query($con,$queryAgent_edit);
$row_edit = mysqli_fetch_array($rsAgent_edit);

$queryAgent_edit2 = "SELECT * FROM agent where id=".$agent2[2];
$rsAgent_edit2=mysqli_query($con,$queryAgent_edit2);
$row_edit2 = mysqli_fetch_array($rsAgent_edit2);

$queryAgent_edit3 = "SELECT * FROM agent where id=".$agent3[2];
$rsAgent_edit3=mysqli_query($con,$queryAgent_edit3);
$row_edit3 = mysqli_fetch_array($rsAgent_edit3);

$queryAgent_edit4 = "SELECT * FROM agent where id=".$agent4[2];
$rsAgent_edit4=mysqli_query($con,$queryAgent_edit4);
$row_edit4 = mysqli_fetch_array($rsAgent_edit4);

$queryAgent_edit5 = "SELECT * FROM agent where id=".$agent5[2];
$rsAgent_edit5=mysqli_query($con,$queryAgent_edit5);
$row_edit5 = mysqli_fetch_array($rsAgent_edit5);

$queryAgent_edit6 = "SELECT * FROM agent where id=".$agent6[2];
$rsAgent_edit6=mysqli_query($con,$queryAgent_edit6);
$row_edit6 = mysqli_fetch_array($rsAgent_edit6);
///////////////////////// cityyy //////////////////////////////////
$query_city_edit= "SELECT * FROM city where id=".$agent1[3]; 
$rs_city_edit=mysqli_query($con,$query_city_edit);
$row_city_edit = mysqli_fetch_array($rs_city_edit);

$query_city_edit2= "SELECT * FROM city where id=".$agent2[3]; 
$rs_city_edit2=mysqli_query($con,$query_city_edit2);
$row_city_edit2 = mysqli_fetch_array($rs_city_edit2);

$query_city_edit3= "SELECT * FROM city where id=".$agent3[3]; 
$rs_city_edit3=mysqli_query($con,$query_city_edit3);
$row_city_edit3 = mysqli_fetch_array($rs_city_edit3);

$query_city_edit4= "SELECT * FROM city where id=".$agent4[3]; 
$rs_city_edit4=mysqli_query($con,$query_city_edit4);
$row_city_edit4 = mysqli_fetch_array($rs_city_edit4);

$query_city_edit5= "SELECT * FROM city where id=".$agent5[3]; 
$rs_city_edit5=mysqli_query($con,$query_city_edit5);
$row_city_edit5 = mysqli_fetch_array($rs_city_edit5);

$query_city_edit6= "SELECT * FROM city where id=".$agent6[3]; 
$rs_city_edit6=mysqli_query($con,$query_city_edit6);
$row_city_edit6 = mysqli_fetch_array($rs_city_edit6);
/////////////////////////// periode ///////////////////////////
$queryper_edit = "SELECT * FROM periode where id=".$agent1[4]; 
$rsper_edit=mysqli_query($con,$queryper_edit);
$rowper_edit = mysqli_fetch_array($rsper_edit);

$queryper_edit2 = "SELECT * FROM periode where id=".$agent2[4]; 
$rsper_edit2=mysqli_query($con,$queryper_edit2);
$rowper_edit2 = mysqli_fetch_array($rsper_edit2);

$queryper_edit3 = "SELECT * FROM periode where id=".$agent3[4]; 
$rsper_edit3=mysqli_query($con,$queryper_edit3);
$rowper_edit3 = mysqli_fetch_array($rsper_edit3);

$queryper_edit4 = "SELECT * FROM periode where id=".$agent4[4]; 
$rsper_edit4=mysqli_query($con,$queryper_edit4);
$rowper_edit4 = mysqli_fetch_array($rsper_edit4);

$queryper_edit5 = "SELECT * FROM periode where id=".$agent5[4]; 
$rsper_edit5=mysqli_query($con,$queryper_edit5);
$rowper_edit5 = mysqli_fetch_array($rsper_edit5);

$queryper_edit6 = "SELECT * FROM periode where id=".$agent6[4]; 
$rsper_edit6=mysqli_query($con,$queryper_edit6);
$rowper_edit6 = mysqli_fetch_array($rsper_edit6);

////////////////////////////////////////////////////////
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
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE TRANSQUOTATION : ".$agent1[2]."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(2,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Pax</label>
                    <input type='text' class='form-control' name='pax' id='pax' value='".$row['pax']."' placeholder='EnterJob Name'>
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>
                  <div class=form-group'>
                      <div class='form-row'>
                              <table id='dtBasicExample' class='table table-striped  table-borderless table-sm' style='font-size:8px; max-height:80px important;'>
                              <th>
                                    <div class='col'>
                                    <select class='form-control'  required name='agent' id='agent' style='width:130px;'>
                                            <option value='".$row_edit['id']."'>".$row_edit['company']."(".$row_edit['name'].")</option>";
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
                                    <option value='".$row_edit2['id']."'>".$row_edit2['company']."(".$row_edit2['name'].")</option>";
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
                                    <option value='".$row_edit3['id']."'>".$row_edit3['company']."(".$row_edit3['name'].")</option>";
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
                                     <option value='".$row_edit4['id']."'>".$row_edit4['company']."(".$row_edit4['name'].")</option>";
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
                                    <option value='".$row_edit5['id']."'>".$row_edit5['company']."(".$row_edit5['name'].")</option>";
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
                                    <option value='".$row_edit6['id']."'>".$row_edit6['company']."(".$row_edit6['name'].")</option>";
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
                                        <option value='".$row_city_edit['id']."'>".$row_city_edit['name']."</option>";
                                        echo"</select>
                                    </div>
                              </th>
                              <th>
                                    <div class='col'>
                                        <select class='form-control' name='city2' id='city2'  style='width:130px;'>
                                        <option value='".$row_city_edit2['id']."'>".$row_city_edit2['name']."</option>";
                                        echo"</select>
                                    </div>
                              </th>
                              <th>
                                    <div class='col'>
                                        <select class='form-control' name='city3' id='city3'  style='width:130px;'>
                                        <option value='".$row_city_edit3['id']."'>".$row_city_edit3['name']."</option>";
                                        echo"</select>
                                    </div>
                              </th>
                              <th>
                                    <div class='col'>
                                        <select class='form-control'  name='city4' id='city4'  style='width:130px;'>
                                        <option value='".$row_city_edit4['id']."'>".$row_city_edit4['name']."</option>";
                                        echo"</select>
                                    </div>
                              </th>
                              <th>
                                    <div class='col'>
                                        <select class='form-control'  name='city5' id='city5'  style='width:130px;'>
                                        <option value='".$row_city_edit5['id']."'>".$row_city_edit5['name']."</option>";
                                        echo"</select>
                                    </div>
                              </th>
                              <th>
                                    <div class='col'>
                                        <select class='form-control'  name='city6' id='city6'  style='width:130px;'>
                                        <option value='".$row_city_edit6['id']."'>".$row_city_edit6['name']."</option>";
                                        echo"</select>
                                    </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                    <div class='col'>
                                    <select class='form-control' name='per' id='per' style='width:130px;'>
                                    <option value='".$rowper_edit['id']."'>".$rowper_edit['nama']."</option>";
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
                                        <option value='".$rowper_edit2['id']."'>".$rowper_edit2['nama']."</option>";
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
                                        <option value='".$rowper_edit3['id']."'>".$rowper_edit3['nama']."</option>";
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
                                      <option value='".$rowper_edit4['id']."'>".$rowper_edit4['nama']."</option>";
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
                                    <option value='".$rowper_edit5['id']."'>".$rowper_edit5['nama']."</option>";
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
                                        <option value='".$rowper_edit6['id']."'>".$rowper_edit6['nama']."</option>";
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
                                    <button type='button' class='btn btn-warning' onclick='search()'>Next</button>
                            </th>
                      </tr>";

                      echo"</table>
                  </div>
                  <div class=form-group' name='divjobi' id='divjobi'></div>
                  <div class=form-group' name='divtr' id='divtr'></div>
                  
                  
                  </div>
                  <div class='form-row'>
                  <div class='card-body'>
                      <div id='daymb'></div>
                  </div>
               </div>
                  </div>";
                echo "</div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload' >Next</button>
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
    var g =  $("input[name=id]").val();
   // var ttotal =  $("input[name=ttotal]").val();
    $.ajax({
        url:"searchTransport5_edit.php",
        method: "POST",
        asynch: false,
        data:{agent:a,agent2:a2,agent3:a3,agent4:a4,agent5:a5,agent6:a6,city:d,city2:d2,city3:d3,city4:d4,city5:d5,city6:d6,per:e,per2:e2,per3:e3,per4:e4,per5:e5,per6:e6,id:g},
        success:function(data){
        $('#divjobi').html(data);
        }
      });
    
  }
</script>
