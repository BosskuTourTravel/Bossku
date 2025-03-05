<?php
include "../site.php";
include "../db=connection.php";
$totaltr=$_POST['totaltr'];
$totaltr2=$_POST['totaltr2'];
$totaltr3=$_POST['totaltr3'];
$totaltr4=$_POST['totaltr4'];
$totaltr5=$_POST['totaltr5'];
$totaltr6=$_POST['totaltr6'];
$thari=$_POST['t'];
$dl=$_POST['ttotal'];
//var_dump($totaltr2);
$ttotal = explode(";", $_POST['ttotal']);
for($i=0; $i < count($ttotal); $i++) {
//  var_dump(count($ttotal));
  $ttotal2[$i]= explode(",", $ttotal[$i]);
  $durasi=$ttotal2[$i][1];
  $tour=$ttotal2[$i][0];
  echo"
    <div class='container'>
      <div class='row'>
        <div class='col-sm'>
        </div>
        <div class='col-sm'><label><h4>Tour Code : ".$ttotal2[$i][0]." / day : ".$ttotal2[$i][1]."</h4></label>
        </div>
        <div class='col-sm'>
        </div>
      </div>
    </div>";
    for ($y = 1; $y <= $durasi; $y++ ){
      echo"
          <label> Hari ke &nbsp; : &nbsp; ".$y."</label>
          <div class='row'>
          <div class='col-sm'>
          <table class='table table-sm table-hover'>
          <thead>
            <tr bgcolor='#A9CCE3 '>
              <th scope='col-2'>#</th>
              <th scope='col-3'>Rent Type 1</th>
            </tr>
          </thead>
          <tbody>";
          $ardt = explode(";" ,$totaltr);
          for($x=0; $x < count($ardt); $x++) {
            $ardt2 = explode("," ,$ardt[$x]);
            $agent=$ardt2[0];
            $city=$ardt2[1];
            $per=$ardt2[2];
            $t_type=$ardt2[3];
          
      $query21 ="SELECT DISTINCT  rentype,kurs,harga  FROM transport WHERE agent=".$agent." AND city=".$city." AND periode=".$per." AND transport_type=".$t_type."  order by id ASC";
      $rs=mysqli_query($con,$query21);
      while($rowc= mysqli_fetch_array($rs)){
      
          $querytr = "SELECT * FROM transport_type WHERE id=".$t_type;
          $rstr=mysqli_query($con,$querytr);
          $rowtr = mysqli_fetch_array($rstr);
      
          $queryren = "SELECT * FROM rent_type WHERE id=".$rowc['rentype'];
          $rsren=mysqli_query($con,$queryren);
          $rowren = mysqli_fetch_array($rsren);

          $querykursc = "SELECT * FROM kurs_bank WHERE id=".$rowc['kurs'];
          $rskursc=mysqli_query($con,$querykursc);
          $rowkursc = mysqli_fetch_array($rskursc);
          $kurs= $rowkursc['name'];

            echo"<tr>
              <td scope='row'>
              <div class='form-check'>
              <input class='form-check-input position-static' type='checkbox' name='tharga1[]'  onclick='totalharga(".$y.")' value='".$tour.",".$durasi.",".$agent.",".$city.",".$per.",".$t_type.",".$rowc['rentype'].",".$y."'>
              <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden' >
              <input name='dl' id='dl' value='".$dl."' type='hidden' >
              </div>
              </td>
              <td><b>".$rowtr['name']." </b></br> ".$rowren['nama']." &nbsp; : &nbsp; ".$rowren['duration']." &nbsp;Hours</br><b>".number_format($rowc['harga'], 0, ".", ".")." ".$kurs."</b></td>";
      
      }
      echo"</tr><tr bgcolor='#A9CCCC'><td></td></tr>";
      }
      
            echo"</tbody>
            </table>";
      // //////////////////////////////////////////////////111111//////////////////////////////////////////////////////////////////////
          echo"</div>
          <div class='col-sm'>
          <table class='table table-sm table-hover'>
          <thead>
            <tr bgcolor='#A9CCE3 '>
              <th scope='col-2'>#</th>
              <th scope='col-3'>Rent Type 2</th>
            </tr>
          </thead>
          <tbody>";
          $ardtb = explode(";" ,$totaltr2);
          for($x=0; $x < count($ardtb); $x++) {
            $ardtb2 = explode("," ,$ardtb[$x]);
            $agentb=$ardtb2[0];
            $cityb=$ardtb2[1];
            $perb=$ardtb2[2];
            $t_typeb=$ardtb2[3];
      $query22 ="SELECT DISTINCT  rentype,kurs,harga  FROM transport WHERE agent=".$agentb." AND city=".$cityb." AND periode=".$perb." AND transport_type=".$t_typeb."  order by id ASC";
      $rs2=mysqli_query($con,$query22);
      //echo $query22;
      while($rowc2= mysqli_fetch_array($rs2)){
      
          $querytrb = "SELECT * FROM transport_type WHERE id=".$t_typeb;
          $rstrb=mysqli_query($con,$querytrb);
          $rowtrb = mysqli_fetch_array($rstrb);
      
          $queryrenb = "SELECT * FROM rent_type WHERE id=".$rowc2['rentype'];
          $rsrenb=mysqli_query($con,$queryrenb);
          $rowrenb = mysqli_fetch_array($rsrenb);

          $querykursc2 = "SELECT * FROM kurs_bank WHERE id=".$rowc2['kurs'];
          $rskursc2=mysqli_query($con,$querykursc2);
          $rowkursc2 = mysqli_fetch_array($rskursc2);
          $kurs2= $rowkursc2['name'];
      
      
            echo"<tr>
              <td scope='row' style='width:2px;'>
              <div class='form-check'>
              <input class='form-check-input position-static' type='checkbox'  name='tharga2[]' onclick='totalharga(".$y.")' value='".$tour.",".$durasi.",".$agentb.",".$cityb.",".$perb.",".$t_typeb.",".$rowc2['rentype'].",".$y."'>
              <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden' >
              <input name='dl' id='dl' value='".$dl."' type='hidden' >
              </div>
              </td>
              <td><b>".$rowtrb['name']." </b></br> ".$rowrenb['nama']." &nbsp; : &nbsp; ".$rowrenb['duration']." &nbsp;Hours</br><b>".number_format($rowc2['harga'], 0, ".", ".")." ".$kurs2."</b></td>";
      
      }
      echo"</tr><tr bgcolor='#A9CCCC'><td></td></tr>";
          }
      
        echo"</tbody>
        </table>";
      //////////////////////////////////////////33333/////////////////////////////////////////////////////////////////////////////
          echo"</div>
          <div class='col-sm'>
          <table class='table table-sm table-hover'>
          <thead>
            <tr bgcolor='#A9CCE3 '>
              <th scope='col-2'>#</th>
              <th scope='col-3'>Rent Type 3</th>
            </tr>
          </thead>
          <tbody>";
          $ardtc = explode(";" ,$totaltr3);
          for($x=0; $x < count($ardtc); $x++) {
            $ardtc2 = explode("," ,$ardtc[$x]);
            $agentc=$ardtc2[0];
            $cityc=$ardtc2[1];
            $perc=$ardtc2[2];
            $t_typec=$ardtc2[3];
      $query23 ="SELECT DISTINCT  rentype,kurs,harga  FROM transport WHERE agent=".$agentc." AND city=".$cityc." AND periode=".$perc." AND transport_type=".$t_typec."  order by id ASC";
      $rs3=mysqli_query($con,$query23);
      //echo $query23;
      while($rowc3= mysqli_fetch_array($rs3)){
          $querytrc = "SELECT * FROM transport_type WHERE id=". $t_typec;
          $rstrc=mysqli_query($con,$querytrc);
          $rowtrc = mysqli_fetch_array($rstrc);
      
          $queryrenc = "SELECT * FROM rent_type WHERE id=".$rowc3['rentype'];
          $rsrenc=mysqli_query($con,$queryrenc);
          $rowrenc = mysqli_fetch_array($rsrenc);

          $querykursc3 = "SELECT * FROM kurs_bank WHERE id=".$rowc3['kurs'];
          $rskursc3=mysqli_query($con,$querykursc3);
          $rowkursc3 = mysqli_fetch_array($rskursc3);
          $kurs3= $rowkursc3['name'];
            echo"<tr> 
              <td scope='row' style='width:2px;'>
              <div class='form-check'>
              <input class='form-check-input position-static' type='checkbox'  name='tharga3[]' onclick='totalharga(".$y.")' value='".$tour.",".$durasi.",".$agentc.",".$cityc.",".$perc.",".$t_typec.",".$rowc3['rentype'].",".$y."'>
              <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
              <input name='dl' id='dl' value='".$dl."' type='hidden' >
              </div>
              </td>
              <td><b>".$rowtrc['name']." </b></br> ".$rowrenc['nama']." &nbsp; : &nbsp; ".$rowrenc['duration']." &nbsp;Hours</br><b>".number_format($rowc3['harga'], 0, ".", ".")." ".$kurs3."</b></td>";
      
      }
      echo"</tr><tr bgcolor='#A9CCCC'><td></td></tr>";
      }
      
        echo"</tbody>
        </table>";
      ///////////////////////////////////////////////////////////////////44444////////////////////////////////////////////////////////////
      echo"</div>
      <div class='col-sm'>
      <table class='table table-sm table-hover'>
      <thead>
        <tr bgcolor='#A9CCE3 '>
          <th scope='col-2'>#</th>
          <th scope='col-3'>Rent Type 4</th>
        </tr>
      </thead>
      <tbody>";
      $ardtd = explode(";" ,$totaltr4);
      for($x=0; $x < count($ardtd); $x++) {
        $ardtd2 = explode("," ,$ardtd[$x]);
        $agentd=$ardtd2[0];
        $cityd=$ardtd2[1];
        $perd=$ardtd2[2];
        $t_typed=$ardtd2[3];
      $query24 ="SELECT DISTINCT  rentype,kurs,harga  FROM transport WHERE agent=".$agentd." AND city=".$cityd." AND periode=".$perd." AND transport_type=".$t_typed."  order by id ASC";
      $rs4=mysqli_query($con,$query24);
      //echo $query23;
      while($rowd4= mysqli_fetch_array($rs4)){
      
      $querytrd = "SELECT * FROM transport_type WHERE id=".$t_typed;
      $rstrd=mysqli_query($con,$querytrd);
      $rowtrd = mysqli_fetch_array($rstrd);
      
      $queryrend = "SELECT * FROM rent_type WHERE id=".$rowd4['rentype'];
      $rsrend=mysqli_query($con,$queryrend);
      $rowrend = mysqli_fetch_array($rsrend);
      
      $querykursc4 = "SELECT * FROM kurs_bank WHERE id=".$rowd4['kurs'];
      $rskursc4=mysqli_query($con,$querykursc4);
      $rowkursc4 = mysqli_fetch_array($rskursc4);
      $kurs4= $rowkursc4['name'];
      
        echo"<tr> 
          <td scope='row' style='width:2px;'>
          <div class='form-check'>
          <input class='form-check-input position-static' type='checkbox'  name='tharga4[]' onclick='totalharga(".$y.")' value='".$tour.",".$durasi.",".$agentd.",".$cityd.",".$perd.",".$t_typed.",".$rowd4['rentype'].",".$y."'>
          <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
          <input name='dl' id='dl' value='".$dl."' type='hidden' >
          </div>
          </td>
          <td><b>".$rowtrd['name']." </b></br> ".$rowrend['nama']." &nbsp; : &nbsp; ".$rowrend['duration']." &nbsp;Hours</br><b>".number_format($rowd4['harga'], 0, ".", ".")." ".$kurs4."</b></td>";
      
      }
      echo"</tr><tr bgcolor='#A9CCCC'><td></td></tr>";
      }
      
      echo"</tbody>
      </table>";
      //////////////////////////////////////////////////////////////5555555///////////////////////////////////////////////////////////////
      echo"</div>
      <div class='col-sm'>
      <table class='table table-sm table-hover'>
      <thead>
        <tr bgcolor='#A9CCE3 '>
          <th scope='col-2'>#</th>
          <th scope='col-3'>Rent Type 5</th>
        </tr>
      </thead>
      <tbody>";
      $ardte = explode(";" ,$totaltr5);
      for($x=0; $x < count($ardte); $x++) {
        $ardte2 = explode("," ,$ardte[$x]);
        $agente=$ardte2[0];
        $citye=$ardte2[1];
        $pere=$ardte2[2];
        $t_typee=$ardte2[3];
      $query25 ="SELECT DISTINCT  rentype,kurs,harga  FROM transport WHERE agent=".$agente." AND city=".$citye." AND periode=".$pere." AND transport_type=".$t_typee."  order by id ASC";
      $rs5=mysqli_query($con,$query25);
      //echo $query23;
      while($rowe5= mysqli_fetch_array($rs5)){
      
      $querytre = "SELECT * FROM transport_type WHERE id=".$t_typee;
      $rstre=mysqli_query($con,$querytre);
      $rowtre = mysqli_fetch_array($rstre);
      
      $queryrene = "SELECT * FROM rent_type WHERE id=".$rowe5['rentype'];
      $rsrene=mysqli_query($con,$queryrene);
      $rowrene = mysqli_fetch_array($rsrene);
      
      $querykursc5 = "SELECT * FROM kurs_bank WHERE id=".$rowe5['kurs'];
      $rskursc5=mysqli_query($con,$querykursc5);
      $rowkursc5 = mysqli_fetch_array($rskursc5);
      $kurs5= $rowkursc5['name'];
      
        echo"<tr> 
          <td scope='row' style='width:2px;'>
          <div class='form-check'>
          <input class='form-check-input position-static' type='checkbox'  name='tharga5[]' onclick='totalharga(".$y.")' value='".$tour.",".$durasi.",".$agente.",".$citye.",".$pere.",".$t_typee.",".$rowe5['rentype'].",".$y."'>
          <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
          <input name='dl' id='dl' value='".$dl."' type='hidden' >
          </div>
          </td>
          <td><b>".$rowtre['name']." </b></br> ".$rowrene['nama']." &nbsp; : &nbsp; ".$rowrene['duration']." &nbsp;Hours</br><b>".number_format($rowe5['harga'], 0, ".", ".")." ".$kurs5."</b></td>";
      }
      echo"</tr><tr bgcolor='#A9CCCC'><td></td></tr>";
      }
      
      echo"</tbody>
      </table>";
      //////////////////////////////////////////////////////////////666666///////////////////////////////////////////////////////////////
      echo"</div>
      <div class='col-sm'>
      <table class='table table-sm table-hover'>
      <thead>
        <tr bgcolor='#A9CCE3 '>
          <th scope='col-2'>#</th>
          <th scope='col-3'>Rent Type 6</th>
        </tr>
      </thead>
      <tbody>";
      $ardtf = explode(";" ,$totaltr6);
      for($x=0; $x < count($ardtf); $x++) {
        $ardtf2 = explode("," ,$ardtf[$x]);
        $agentf=$ardtf2[0];
        $cityf=$ardtf2[1];
        $perf=$ardtf2[2];
        $t_typef=$ardtf2[3];
      $query26 ="SELECT DISTINCT  rentype,kurs,harga  FROM transport WHERE agent=".$agentf." AND city=".$cityf." AND periode=".$perf." AND transport_type=".$t_typef."  order by id ASC";
      $rs6=mysqli_query($con,$query26);
      //echo $query23;
      while($rowf6= mysqli_fetch_array($rs6)){
      
      $querytrf = "SELECT * FROM transport_type WHERE id=".$t_typef;
      $rstrf=mysqli_query($con,$querytrf);
      $rowtrf = mysqli_fetch_array($rstrf);
      
      $queryrenf = "SELECT * FROM rent_type WHERE id=".$rowf6['rentype'];
      $rsrenf=mysqli_query($con,$queryrenf);
      $rowrenf = mysqli_fetch_array($rsrenf);

      $querykursc6 = "SELECT * FROM kurs_bank WHERE id=".$rowf6['kurs'];
      $rskursc6=mysqli_query($con,$querykursc6);
      $rowkursc6 = mysqli_fetch_array($rskursc6);
      $kurs6= $rowkursc6['name'];
      
      
        echo"<tr> 
          <td scope='row' style='width:2px;'>
          <div class='form-check'>
          <input class='form-check-input position-static' type='checkbox'  name='tharga6[]' onclick='totalharga(".$y.")' value='".$tour.",".$durasi.",".$agentf.",".$cityf.",".$perf.",".$t_typef.",".$rowf6['rentype'].",".$y."'>
          <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
          <input name='dl' id='dl' value='".$dl."' type='hidden' >
          </div>
          </td>
          <td><b>".$rowtrf['name']." </b></br> ".$rowrenf['nama']." &nbsp; : &nbsp; ".$rowrenf['duration']." &nbsp;Hours</br><b>".number_format($rowf6['harga'], 0, ".", ".")." ".$kurs6."</b></td>";
      
      }
      echo"</tr><tr bgcolor='#A9CCCC'><td></td></tr>";
      }
      echo"</tbody>
      </table>";
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          echo"</div>
        </div>";
      }

}


?>
<script>
$(document).ready(function(){
   });
function totalharga(y) {
  var t= $("input[name=harit]").val();
  var dl= $("input[name=dl]").val();
   arr_harga=[];
   arr_harga2=[];
   arr_harga3=[];
   arr_harga4=[];
   arr_harga5=[];
   arr_harga6=[];
   $("input:checkbox[name*=tharga1]:checked").each(function(){
         arr_harga.push($(this).val());
    });
    $("input:checkbox[name*=tharga2]:checked").each(function(){
         arr_harga2.push($(this).val());
    });
    $("input:checkbox[name*=tharga3]:checked").each(function(){
         arr_harga3.push($(this).val());
    });
    $("input:checkbox[name*=tharga4]:checked").each(function(){
         arr_harga4.push($(this).val());
    });
    $("input:checkbox[name*=tharga5]:checked").each(function(){
         arr_harga5.push($(this).val());
    });
    $("input:checkbox[name*=tharga6]:checked").each(function(){
         arr_harga6.push($(this).val());
    });
    //var p = $('input.tharga1').serializeArray();

   ////////////////////////////////////////////////////////
// alert(arr_harga2);
  $.ajax({
        url:"search_count4.php",
        method: "POST",
        asynch: false,
        data:{arr_harga:arr_harga,arr_harga2:arr_harga2,arr_harga3:arr_harga3,arr_harga4:arr_harga4,arr_harga5:arr_harga5,arr_harga6:arr_harga6,harit:t,dl:dl},
        success:function(data){
        $('#daymb').html(data);
        }
      });
}

</script>