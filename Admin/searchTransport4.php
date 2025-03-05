<?php
include "../site.php";
include "../db=connection.php";
// $totaltr=$_POST['totaltr'];
// $totaltr2=$_POST['totaltr2'];
// $totaltr3=$_POST['totaltr3'];
// $totaltr4=$_POST['totaltr4'];
// $totaltr5=$_POST['totaltr5'];
// $totaltr6=$_POST['totaltr6'];
//$arrtr=$totaltr.$totaltr2.$totaltr3.$totaltr4.$totaltr5.$totaltr6;
//$data = explode(";" ,$arrtr);
//var_dump($arrtr);
$cagent = $_POST['agent'];
$cagent2 = $_POST['agent2'];
$cagent3 = $_POST['agent3'];
$cagent4 = $_POST['agent4'];
$cagent5 = $_POST['agent5'];
$cagent6 = $_POST['agent6'];
$ccity= $_POST['city'];
$ccity2= $_POST['city2'];
$ccity3= $_POST['city3'];
$ccity4= $_POST['city4'];
$ccity5= $_POST['city5'];
$ccity6= $_POST['city6'];
$cperiode= $_POST['per'];
$cperiode2= $_POST['per2'];
$cperiode3= $_POST['per3'];
$cperiode4= $_POST['per4'];
$cperiode5= $_POST['per5'];
$cperiode6= $_POST['per6'];
$thari= $_POST['thari'];

//var_dump($ccity2);
//var_dump($cperiode2);
$trans ="SELECT DISTINCT  transport_type  FROM transport WHERE agent=".$cagent." AND city=".$ccity." AND periode=".$cperiode." AND harga!=0  order by transport_type ASC";
$rstrans=mysqli_query($con,$trans);
$trans2 ="SELECT DISTINCT  transport_type  FROM transport WHERE agent=".$cagent2." AND city=".$ccity2." AND periode=".$cperiode2." AND harga!=0  order by transport_type ASC";
$rstrans2=mysqli_query($con,$trans2);
$trans3 ="SELECT DISTINCT  transport_type  FROM transport WHERE agent=".$cagent3." AND city=".$ccity3." AND periode=".$cperiode3." AND harga!=0  order by transport_type ASC";
$rstrans3=mysqli_query($con,$trans3);
$trans4 ="SELECT DISTINCT  transport_type  FROM transport WHERE agent=".$cagent4." AND city=".$ccity4." AND periode=".$cperiode4." AND harga!=0  order by transport_type ASC";
$rstrans4=mysqli_query($con,$trans4);
$trans5 ="SELECT DISTINCT  transport_type  FROM transport WHERE agent=".$cagent5." AND city=".$ccity5." AND periode=".$cperiode5." AND harga!=0  order by transport_type ASC";
$rstrans5=mysqli_query($con,$trans5);
$trans6 ="SELECT DISTINCT  transport_type  FROM transport WHERE agent=".$cagent6." AND city=".$ccity6." AND periode=".$cperiode6." AND harga!=0  order by transport_type ASC";
$rstrans6=mysqli_query($con,$trans6);
echo"
<div class='card'>
    <div class='card-body'>
        <div class='container'>
            <div class='row'>
                <div class='col-sm'>";
                while($rowtrans= mysqli_fetch_array($rstrans)){
                    $t=$rowtrans['transport_type'];
                    $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans['transport_type'];
                    $rstt=mysqli_query($con,$querytt);
                    $rowtt = mysqli_fetch_array($rstt);
                    echo"<div class='form-check'>
                        <input class='form-check-input position-static' type='checkbox' name='tt".$t."' id='tt".$t."' value='".$t."'>
                            <label class='form-check-label' for='tt".$t."'>".$rowtt['name']."</label>
                    </div>";
                }
                echo"    
                </div>
                <div class='col-sm'>";
                while($rowtrans2= mysqli_fetch_array($rstrans2)){
                    $t=$rowtrans2['transport_type'];
                    $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans2['transport_type'];
                    $rstt=mysqli_query($con,$querytt);
                    $rowtt = mysqli_fetch_array($rstt);
                    echo"<div class='form-check'>
                        <input class='form-check-input position-static' type='checkbox' name='tt2".$t."' id='tt2".$t."' value='".$t."'>
                            <label class='form-check-label' for='tt2".$t."'>".$rowtt['name']."</label>
                    </div>";
                }
                echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans3= mysqli_fetch_array($rstrans3)){
                    $t=$rowtrans3['transport_type'];
                    $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans3['transport_type'];
                    $rstt=mysqli_query($con,$querytt);
                    $rowtt = mysqli_fetch_array($rstt);
                    echo"<div class='form-check'>
                        <input class='form-check-input position-static' type='checkbox' name='tt3".$t."' id='tt3".$t."' value='".$t."'>
                            <label class='form-check-label' for='tt3".$t."'>".$rowtt['name']."</label>
                    </div>";
                }
                echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans4= mysqli_fetch_array($rstrans4)){
                  $t=$rowtrans4['transport_type'];
                  $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans4['transport_type'];
                  $rstt=mysqli_query($con,$querytt);
                  $rowtt = mysqli_fetch_array($rstt);
                  echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt4".$t."' id='tt4".$t."' value='".$t."'>
                          <label class='form-check-label' for='tt4".$t."'>".$rowtt['name']."</label>
                  </div>";
              }
              echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans5= mysqli_fetch_array($rstrans5)){
                  $t=$rowtrans5['transport_type'];
                  $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans5['transport_type'];
                  $rstt=mysqli_query($con,$querytt);
                  $rowtt = mysqli_fetch_array($rstt);
                  echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt5".$t."' id='tt5".$t."' value='".$t."'>
                          <label class='form-check-label' for='tt5".$t."'>".$rowtt['name']."</label>
                  </div>";
              }
              echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans6= mysqli_fetch_array($rstrans6)){
                  $t=$rowtrans6['transport_type'];
                  $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans6['transport_type'];
                  $rstt=mysqli_query($con,$querytt);
                  $rowtt = mysqli_fetch_array($rstt);
                  echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt6".$t."' id='tt6".$t."' value='".$t."'>
                          <label class='form-check-label' for='tt6".$t."'>".$rowtt['name']."</label>
                  </div>";
              }
               echo"
                </div>
            </div>
        </div>
    </div>
</div>";



for ($y = 1; $y <= $thari; $y++ ){
// $queryct = "SELECT * FROM transport_type WHERE id=".$ctrans;
// $rsct=mysqli_query($con,$queryct);
// $rowct = mysqli_fetch_array($rsct);

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
$query21 ="SELECT DISTINCT  rentype  FROM transport WHERE agent=".$cagent." AND city=".$ccity." AND periode=".$cperiode."  order by rentype ASC";
$rs=mysqli_query($con,$query21);
//echo $query21;
while($rowc= mysqli_fetch_array($rs)){
    $query2 = "SELECT * FROM agent WHERE id=".$rowc['agent'];
    $rs2=mysqli_query($con,$query2);
    $row2 = mysqli_fetch_array($rs2);

    $querycx = "SELECT * FROM continent WHERE id=".$rowc['continent'];
    $rscx=mysqli_query($con,$querycx);
    $rowcx = mysqli_fetch_array($rscx);

    $querycon = "SELECT * FROM country WHERE id=".$rowc['contry'];
    $rscon=mysqli_query($con,$querycon);
    $rowcon = mysqli_fetch_array($rscon);

    $querycity = "SELECT * FROM city WHERE id=".$rowc['city'];
    $rscity=mysqli_query($con,$querycity);
    $rowcity = mysqli_fetch_array($rscity);

    $querykurs = "SELECT * FROM kurs_bank WHERE id=".$rowc['kurs'];
    $rskurs=mysqli_query($con,$querykurs);
    $rowkurs = mysqli_fetch_array($rskurs);

    $querytr = "SELECT * FROM transport_type WHERE id=".$rowc['transport_type'];
    $rstr=mysqli_query($con,$querytr);
    $rowtr = mysqli_fetch_array($rstr);

    $queryper = "SELECT * FROM periode WHERE id=".$rowc['periode'];
    $rsper=mysqli_query($con,$queryper);
    $rowper = mysqli_fetch_array($rsper);

    $queryren = "SELECT * FROM rent_type WHERE id=".$rowc['rentype'];
    $rsren=mysqli_query($con,$queryren);
    $rowren = mysqli_fetch_array($rsren);


      echo"<tr>
        <td scope='row'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox' name='tharga".$y."' id='tharga".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent'].",".$_POST['city'].",".$_POST['per'].",".$rowc['rentype'].",".$y."'>
        <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden' >
        </div>
        </td>
        <td>".$rowren['nama']." &nbsp; : &nbsp; ".$rowren['duration']." &nbsp;Hours</td>";

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
$query22 ="SELECT DISTINCT  rentype  FROM transport WHERE agent=".$cagent2." AND city=".$ccity2." AND periode=".$cperiode2." order by rentype ASC";
$rs2=mysqli_query($con,$query22);
//echo $query22;
while($rowc2= mysqli_fetch_array($rs2)){
    $query2b = "SELECT * FROM agent WHERE id=".$rowc2['agent'];
    $rs2b=mysqli_query($con,$query2b);
    $row2b = mysqli_fetch_array($rs2b);

    $querycxb = "SELECT * FROM continent WHERE id=".$rowc2['continent'];
    $rscxb=mysqli_query($con,$querycxb);
    $rowcxb = mysqli_fetch_array($rscxb);

    $queryconb = "SELECT * FROM country WHERE id=".$rowc2['contry'];
    $rsconb=mysqli_query($con,$queryconb);
    $rowconb = mysqli_fetch_array($rsconb);

    $querycityb = "SELECT * FROM city WHERE id=".$rowc2['city'];
    $rscityb=mysqli_query($con,$querycityb);
    $rowcityb = mysqli_fetch_array($rscityb);

    $querykursb = "SELECT * FROM kurs_bank WHERE id=".$rowc2['kurs'];
    $rskursb=mysqli_query($con,$querykursb);
    $rowkursb = mysqli_fetch_array($rskursb);

    $querytrb = "SELECT * FROM transport_type WHERE id=".$rowc2['transport_type'];
    $rstrb=mysqli_query($con,$querytrb);
    $rowtrb = mysqli_fetch_array($rstrb);

    $queryperb = "SELECT * FROM periode WHERE id=".$rowc2['periode'];
    $rsperb=mysqli_query($con,$queryperb);
    $rowperb = mysqli_fetch_array($rsperb);

    $queryrenb = "SELECT * FROM rent_type WHERE id=".$rowc2['rentype'];
    $rsrenb=mysqli_query($con,$queryrenb);
    $rowrenb = mysqli_fetch_array($rsrenb);


      echo"<tr>
        <td scope='row' style='width:2px;'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox'  name='thargab".$y."' id='thargab".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent2'].",".$_POST['city2'].",".$_POST['per2'].",".$rowc2['rentype'].",".$y."'>
        <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden' >
        </div>
        </td>
        <td>".$rowrenb['nama']." &nbsp; : &nbsp; ".$rowrenb['duration']." &nbsp;Hours</td>";

}

  echo"</tbody>
  </table>";
////////////////////////////////////////////33333/////////////////////////////////////////////////////////////////////////////
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
$query23 ="SELECT DISTINCT  rentype  FROM transport WHERE agent=".$cagent3."  AND city=".$ccity3." AND periode=".$cperiode3." order by rentype ASC";
$rs3=mysqli_query($con,$query23);
//echo $query23;
while($rowc3= mysqli_fetch_array($rs3)){
    $query2c = "SELECT * FROM agent WHERE id=".$rowc3['agent'];
    $rs2c=mysqli_query($con,$query2c);
    $row2c = mysqli_fetch_array($rs2c);

    $querycxc = "SELECT * FROM continent WHERE id=".$rowc3['continent'];
    $rscxc=mysqli_query($con,$querycxc);
    $rowcxc = mysqli_fetch_array($rscxc);

    $queryconc = "SELECT * FROM country WHERE id=".$rowc3['contry'];
    $rsconc=mysqli_query($con,$queryconc);
    $rowconc = mysqli_fetch_array($rsconc);

    $querycityc = "SELECT * FROM city WHERE id=".$rowc3['city'];
    $rscityc=mysqli_query($con,$querycityc);
    $rowcityc = mysqli_fetch_array($rscityc);

    $querykursc = "SELECT * FROM kurs_bank WHERE id=".$rowc3['kurs'];
    $rskursc=mysqli_query($con,$querykursc);
    $rowkursc = mysqli_fetch_array($rskursc);

    $querytrc = "SELECT * FROM transport_type WHERE id=".$rowc3['transport_type'];
    $rstrc=mysqli_query($con,$querytrc);
    $rowtrc = mysqli_fetch_array($rstrc);

    $queryperc = "SELECT * FROM periode WHERE id=".$rowc3['periode'];
    $rsperc=mysqli_query($con,$queryperc);
    $rowperc = mysqli_fetch_array($rsperc);

    $queryrenc = "SELECT * FROM rent_type WHERE id=".$rowc3['rentype'];
    $rsrenc=mysqli_query($con,$queryrenc);
    $rowrenc = mysqli_fetch_array($rsrenc);


      echo"<tr> 
        <td scope='row' style='width:2px;'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox'  name='thargac".$y."' id='thargac".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent3'].",".$_POST['city3'].",".$_POST['per3'].",".$rowc3['rentype'].",".$y."'>
        <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
        </div>
        </td>
        <td>".$rowrenc['nama']." &nbsp; : &nbsp; ".$rowrenc['duration']." &nbsp;Hours</td>";

}

  echo"</tbody>
  </table>";
/////////////////////////////////////////////////////////////////////44444////////////////////////////////////////////////////////////
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
$query24 ="SELECT DISTINCT  rentype  FROM transport WHERE agent=".$cagent4."  AND city=".$ccity4." AND periode=".$cperiode4." order by rentype ASC";
$rs4=mysqli_query($con,$query24);
//echo $query23;
while($rowd4= mysqli_fetch_array($rs4)){
$query2d = "SELECT * FROM agent WHERE id=".$rowd4['agent'];
$rs2d=mysqli_query($con,$query2d);
$row2d = mysqli_fetch_array($rs2d);

$querycxd = "SELECT * FROM continent WHERE id=".$rowd4['continent'];
$rscxd=mysqli_query($con,$querycxd);
$rowcxd = mysqli_fetch_array($rscxd);

$querycond = "SELECT * FROM country WHERE id=".$rowd4['contry'];
$rscond=mysqli_query($con,$querycond);
$rowcond = mysqli_fetch_array($rscond);

$querycityd = "SELECT * FROM city WHERE id=".$rowd4['city'];
$rscityd=mysqli_query($con,$querycityd);
$rowcityd = mysqli_fetch_array($rscityd);

$querykursd = "SELECT * FROM kurs_bank WHERE id=".$rowd4['kurs'];
$rskursd=mysqli_query($con,$querykursd);
$rowkursd = mysqli_fetch_array($rskursd);

$querytrd = "SELECT * FROM transport_type WHERE id=".$rowd4['transport_type'];
$rstrd=mysqli_query($con,$querytrd);
$rowtrd = mysqli_fetch_array($rstrd);

$queryperd = "SELECT * FROM periode WHERE id=".$rowd4['periode'];
$rsperd=mysqli_query($con,$queryperd);
$rowperd = mysqli_fetch_array($rsperd);

$queryrend = "SELECT * FROM rent_type WHERE id=".$rowd4['rentype'];
$rsrend=mysqli_query($con,$queryrend);
$rowrend = mysqli_fetch_array($rsrend);


  echo"<tr> 
    <td scope='row' style='width:2px;'>
    <div class='form-check'>
    <input class='form-check-input position-static' type='checkbox'  name='thargad".$y."' id='thargad".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent4'].",".$_POST['city4'].",".$_POST['per4'].",".$rowd4['rentype'].",".$y."'>
    <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
    </div>
    </td>
    <td>".$rowrend['nama']." &nbsp; : &nbsp; ".$rowrend['duration']." &nbsp;Hours</td>";

}

echo"</tbody>
</table>";
////////////////////////////////////////////////////////////////5555555///////////////////////////////////////////////////////////////
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
$query25 ="SELECT DISTINCT  rentype  FROM transport WHERE agent=".$cagent5."  AND city=".$ccity5." AND periode=".$cperiode5." order by rentype ASC";
$rs5=mysqli_query($con,$query25);
//echo $query23;
while($rowe5= mysqli_fetch_array($rs5)){
$query2e = "SELECT * FROM agent WHERE id=".$rowe5['agent'];
$rs2e=mysqli_query($con,$query2e);
$row2e = mysqli_fetch_array($rs2e);

$querycxe = "SELECT * FROM continent WHERE id=".$rowe5['continent'];
$rscxe=mysqli_query($con,$querycxe);
$rowcxe = mysqli_fetch_array($rscxe);

$querycone = "SELECT * FROM country WHERE id=".$rowe5['contry'];
$rscone=mysqli_query($con,$querycone);
$rowcone = mysqli_fetch_array($rscone);

$querycitye = "SELECT * FROM city WHERE id=".$rowe5['city'];
$rscitye=mysqli_query($con,$querycitye);
$rowcitye = mysqli_fetch_array($rscitye);

$querykurse = "SELECT * FROM kurs_bank WHERE id=".$rowe5['kurs'];
$rskurse=mysqli_query($con,$querykurse);
$rowkurse = mysqli_fetch_array($rskurse);

$querytre = "SELECT * FROM transport_type WHERE id=".$rowe5['transport_type'];
$rstre=mysqli_query($con,$querytre);
$rowtre = mysqli_fetch_array($rstre);

$querypere = "SELECT * FROM periode WHERE id=".$rowe5['periode'];
$rspere=mysqli_query($con,$querypere);
$rowpere = mysqli_fetch_array($rspere);

$queryrene = "SELECT * FROM rent_type WHERE id=".$rowe5['rentype'];
$rsrene=mysqli_query($con,$queryrene);
$rowrene = mysqli_fetch_array($rsrene);


  echo"<tr> 
    <td scope='row' style='width:2px;'>
    <div class='form-check'>
    <input class='form-check-input position-static' type='checkbox'  name='thargae".$y."' id='thargae".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent5'].",".$_POST['city5'].",".$_POST['per5'].",".$rowe5['rentype'].",".$y."'>
    <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
    </div>
    </td>
    <td>".$rowrene['nama']." &nbsp; : &nbsp; ".$rowrene['duration']." &nbsp;Hours</td>";

}

echo"</tbody>
</table>";
////////////////////////////////////////////////////////////////666666///////////////////////////////////////////////////////////////
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
$query26 ="SELECT DISTINCT  rentype  FROM transport WHERE agent=".$cagent6."  AND city=".$ccity6." AND periode=".$cperiode6." order by rentype ASC";
$rs6=mysqli_query($con,$query26);
//echo $query23;
while($rowf6= mysqli_fetch_array($rs6)){
$query2f = "SELECT * FROM agent WHERE id=".$rowf6['agent'];
$rs2f=mysqli_query($con,$query2f);
$row2f = mysqli_fetch_array($rs2f);

$querycxf = "SELECT * FROM continent WHERE id=".$rowf6['continent'];
$rscxf=mysqli_query($con,$querycxf);
$rowcxf = mysqli_fetch_array($rscxf);

$queryconf = "SELECT * FROM country WHERE id=".$rowf6['contry'];
$rsconf=mysqli_query($con,$queryconf);
$rowconf = mysqli_fetch_array($rsconf);

$querycityf = "SELECT * FROM city WHERE id=".$rowf6['city'];
$rscityf=mysqli_query($con,$querycityf);
$rowcityf = mysqli_fetch_array($rscityf);

$querykursf = "SELECT * FROM kurs_bank WHERE id=".$rowf6['kurs'];
$rskursf=mysqli_query($con,$querykursf);
$rowkursf = mysqli_fetch_array($rskursf);

$querytrf = "SELECT * FROM transport_type WHERE id=".$rowf6['transport_type'];
$rstrf=mysqli_query($con,$querytrf);
$rowtrf = mysqli_fetch_array($rstrf);

$queryperf = "SELECT * FROM periode WHERE id=".$rowf6['periode'];
$rsperf=mysqli_query($con,$queryperf);
$rowperf = mysqli_fetch_array($rsperf);

$queryrenf = "SELECT * FROM rent_type WHERE id=".$rowf6['rentype'];
$rsrenf=mysqli_query($con,$queryrenf);
$rowrenf = mysqli_fetch_array($rsrenf);


  echo"<tr> 
    <td scope='row' style='width:2px;'>
    <div class='form-check'>
    <input class='form-check-input position-static' type='checkbox'  name='thargaf".$y."' id='thargaf".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent6'].",".$_POST['city6'].",".$_POST['per6'].",".$rowf6['rentype'].",".$y."'>
    <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
    </div>
    </td>
    <td>".$rowrenf['nama']." &nbsp; : &nbsp; ".$rowrenf['duration']." &nbsp;Hours</td>";

}

echo"</tbody>
</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    echo"</div>
  </div>";
}

?>
<script>
//  $(document).ready(function(){
//   });
// function totalharga(y) {
//   var t= $("input[name=harit]").val();
//   var input = document.getElementsByName("tharga1");
//   var input2 = document.getElementsByName("tharga2");
//   var input3 = document.getElementsByName("tharga3");
//   var input4 = document.getElementsByName("tharga4");
//   var input5 = document.getElementsByName("tharga5");
//   var input6 = document.getElementsByName("tharga6");
//   var input7 = document.getElementsByName("tharga7");
//   var input8 = document.getElementsByName("tharga8");
//   var input9 = document.getElementsByName("tharga9");
//   var input10 = document.getElementsByName("tharga10");
//   var input11 = document.getElementsByName("tharga11");
//   var input12 = document.getElementsByName("tharga12");
//   var input13 = document.getElementsByName("tharga13");
//   var input14 = document.getElementsByName("tharga14");
//   var input15 = document.getElementsByName("tharga15");
//   var input16 = document.getElementsByName("tharga16");
//   var input17 = document.getElementsByName("tharga17");
//   var input18 = document.getElementsByName("tharga18");
//   var input19 = document.getElementsByName("tharga19");
//   var input20 = document.getElementsByName("tharga20");
// ////////////////////////////////////////////////////////
//   var inputb = document.getElementsByName("thargab1");
//   var inputb2 = document.getElementsByName("thargab2");
//   var inputb3 = document.getElementsByName("thargab3");
//   var inputb4 = document.getElementsByName("thargab4");
//   var inputb5 = document.getElementsByName("thargab5");
//   var inputb6 = document.getElementsByName("thargab6");
//   var inputb7 = document.getElementsByName("thargab7");
//   var inputb8 = document.getElementsByName("thargab8");
//   var inputb9 = document.getElementsByName("thargab9");
//   var inputb10 = document.getElementsByName("thargab10");
//   var inputb11 = document.getElementsByName("thargab11");
//   var inputb12 = document.getElementsByName("thargab12");
//   var inputb13 = document.getElementsByName("thargab13");
//   var inputb14 = document.getElementsByName("thargab14");
//   var inputb15 = document.getElementsByName("thargab15");
//   var inputb16 = document.getElementsByName("thargab16");
//   var inputb17 = document.getElementsByName("thargab17");
//   var inputb18 = document.getElementsByName("thargab18");
//   var inputb19 = document.getElementsByName("thargab19");
//   var inputb20 = document.getElementsByName("thargab20");
// /////////////////////////////////////////////////////////
//   var inputc = document.getElementsByName("thargac1");
//   var inputc2 = document.getElementsByName("thargac2");
//   var inputc3 = document.getElementsByName("thargac3");
//   var inputc4 = document.getElementsByName("thargac4");
//   var inputc5 = document.getElementsByName("thargac5");
//   var inputc6 = document.getElementsByName("thargac6");
//   var inputc7 = document.getElementsByName("thargac7");
//   var inputc8 = document.getElementsByName("thargac8");
//   var inputc9 = document.getElementsByName("thargac9");
//   var inputc10 = document.getElementsByName("thargac10");
//   var inputc11 = document.getElementsByName("thargac11");
//   var inputc12 = document.getElementsByName("thargac12");
//   var inputc13 = document.getElementsByName("thargac13");
//   var inputc14 = document.getElementsByName("thargac14");
//   var inputc15 = document.getElementsByName("thargac15");
//   var inputc16 = document.getElementsByName("thargac16");
//   var inputc17 = document.getElementsByName("thargac17");
//   var inputc18 = document.getElementsByName("thargac18");
//   var inputc19 = document.getElementsByName("thargac19");
//   var inputc20 = document.getElementsByName("thargac20");
// /////////////////////////////////////////////////////////
// var inputd = document.getElementsByName("thargad1");
//   var inputd2 = document.getElementsByName("thargad2");
//   var inputd3 = document.getElementsByName("thargad3");
//   var inputd4 = document.getElementsByName("thargad4");
//   var inputd5 = document.getElementsByName("thargad5");
//   var inputd6 = document.getElementsByName("thargad6");
//   var inputd7 = document.getElementsByName("thargad7");
//   var inputd8 = document.getElementsByName("thargad8");
//   var inputd9 = document.getElementsByName("thargad9");
//   var inputd10 = document.getElementsByName("thargad10");
//   var inputd11 = document.getElementsByName("thargad11");
//   var inputd12 = document.getElementsByName("thargad12");
//   var inputd13 = document.getElementsByName("thargad13");
//   var inputd14 = document.getElementsByName("thargad14");
//   var inputd15 = document.getElementsByName("thargad15");
//   var inputd16 = document.getElementsByName("thargad16");
//   var inputd17 = document.getElementsByName("thargad17");
//   var inputd18 = document.getElementsByName("thargad18");
//   var inputd19 = document.getElementsByName("thargad19");
//   var inputd20 = document.getElementsByName("thargad20");
// /////////////////////////////////////////////////////////
// var inpute = document.getElementsByName("thargae1");
//   var inpute2 = document.getElementsByName("thargae2");
//   var inpute3 = document.getElementsByName("thargae3");
//   var inpute4 = document.getElementsByName("thargae4");
//   var inpute5 = document.getElementsByName("thargae5");
//   var inpute6 = document.getElementsByName("thargae6");
//   var inpute7 = document.getElementsByName("thargae7");
//   var inpute8 = document.getElementsByName("thargae8");
//   var inpute9 = document.getElementsByName("thargae9");
//   var inpute10 = document.getElementsByName("thargae10");
//   var inpute11 = document.getElementsByName("thargae11");
//   var inpute12 = document.getElementsByName("thargae12");
//   var inpute13 = document.getElementsByName("thargae13");
//   var inpute14 = document.getElementsByName("thargae14");
//   var inpute15 = document.getElementsByName("thargae15");
//   var inpute16 = document.getElementsByName("thargae16");
//   var inpute17 = document.getElementsByName("thargae17");
//   var inpute18 = document.getElementsByName("thargae18");
//   var inpute19 = document.getElementsByName("thargae19");
//   var inpute20 = document.getElementsByName("thargae20");
// /////////////////////////////////////////////////////////
// var inputf = document.getElementsByName("thargaf1");
//   var inputf2 = document.getElementsByName("thargaf2");
//   var inputf3 = document.getElementsByName("thargaf3");
//   var inputf4 = document.getElementsByName("thargaf4");
//   var inputf5 = document.getElementsByName("thargaf5");
//   var inputf6 = document.getElementsByName("thargaf6");
//   var inputf7 = document.getElementsByName("thargaf7");
//   var inputf8 = document.getElementsByName("thargaf8");
//   var inputf9 = document.getElementsByName("thargaf9");
//   var inputf10 = document.getElementsByName("thargaf10");
//   var inputf11 = document.getElementsByName("thargaf11");
//   var inputf12 = document.getElementsByName("thargaf12");
//   var inputf13 = document.getElementsByName("thargaf13");
//   var inputf14 = document.getElementsByName("thargaf14");
//   var inputf15 = document.getElementsByName("thargaf15");
//   var inputf16 = document.getElementsByName("thargaf16");
//   var inputf17 = document.getElementsByName("thargaf17");
//   var inputf18 = document.getElementsByName("thargaf18");
//   var inputf19 = document.getElementsByName("thargaf19");
//   var inputf20 = document.getElementsByName("thargaf20");
// /////////////////////////////////////////////////////////
//   var total = "";
//   var total2 = "";
//   var total3 = "";
//   var total4 = "";
//   var total5 = "";
//   var total6 = "";
//   var total7 = "";
//   var total8 = "";
//   var total9 = "";
//   var total10 = "";
//   var total11 = "";
//   var total12 = "";
//   var total13 = "";
//   var total14 = "";
//   var total15 = "";
//   var total16 = "";
//   var total17 = "";
//   var total18 = "";
//   var total19 = "";
//   var total20 = "";
// ///////////////////////////////////////////////////////////
//   var totalb = "";
//   var totalb2 = "";
//   var totalb3 = "";
//   var totalb4 = "";
//   var totalb5 = "";
//   var totalb6 = "";
//   var totalb7 = "";
//   var totalb8 = "";
//   var totalb9 = "";
//   var totalb10 = "";
//   var totalb11 = "";
//   var totalb12 = "";
//   var totalb13 = "";
//   var totalb14 = "";
//   var totalb15 = "";
//   var totalb16 = "";
//   var totalb17 = "";
//   var totalb18 = "";
//   var totalb19 = "";
//   var totalb20 = "";
// /////////////////////////////////////////////////////////
//   var totalc = "";
//   var totalc2 = "";
//   var totalc3 = "";
//   var totalc4 = "";
//   var totalc5 = "";
//   var totalc6 = "";
//   var totalc7 = "";
//   var totalc8 = "";
//   var totalc9 = "";
//   var totalc10 = "";
//   var totalc11 = "";
//   var totalc12 = "";
//   var totalc13 = "";
//   var totalc14 = "";
//   var totalc15 = "";
//   var totalc16 = "";
//   var totalc17 = "";
//   var totalc18 = "";
//   var totalc19 = "";
//   var totalc20 = "";
// /////////////////////////////////////////////////////////
// var totald = "";
//   var totald2 = "";
//   var totald3 = "";
//   var totald4 = "";
//   var totald5 = "";
//   var totald6 = "";
//   var totald7 = "";
//   var totald8 = "";
//   var totald9 = "";
//   var totald10 = "";
//   var totald11 = "";
//   var totald12 = "";
//   var totald13 = "";
//   var totald14 = "";
//   var totald15 = "";
//   var totald16 = "";
//   var totald17 = "";
//   var totald18 = "";
//   var totald19 = "";
//   var totald20 = "";
// /////////////////////////////////////////////////////////
// var totale = "";
//   var totale2 = "";
//   var totale3 = "";
//   var totale4 = "";
//   var totale5 = "";
//   var totale6 = "";
//   var totale7 = "";
//   var totale8 = "";
//   var totale9 = "";
//   var totale10 = "";
//   var totale11 = "";
//   var totale12 = "";
//   var totale13 = "";
//   var totale14 = "";
//   var totale15 = "";
//   var totale16 = "";
//   var totale17 = "";
//   var totale18 = "";
//   var totale19 = "";
//   var totale20 = "";
// /////////////////////////////////////////////////////////
// var totalf = "";
//   var totalf2 = "";
//   var totalf3 = "";
//   var totalf4 = "";
//   var totalf5 = "";
//   var totalf6 = "";
//   var totalf7 = "";
//   var totalf8 = "";
//   var totalf9 = "";
//   var totalf10 = "";
//   var totalf11 = "";
//   var totalf12 = "";
//   var totalf13 = "";
//   var totalf14 = "";
//   var totalf15 = "";
//   var totalf16 = "";
//   var totalf17 = "";
//   var totalf18 = "";
//   var totalf19 = "";
//   var totalf20 = "";
// ////////////////////////////aaaaaa/////////////////////////////
//   for (var i = 0; i < input.length; i++) {
//     if (input[i].checked) {
//       total = total + input[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input2.length; i++) {
//     if (input2[i].checked) {
//       total2 = total2 + input2[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input3.length; i++) {
//     if (input3[i].checked) {
//       total3 = total3 + input3[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input4.length; i++) {
//     if (input4[i].checked) {
//       total4 = total4 + input4[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input5.length; i++) {
//     if (input5[i].checked) {
//       total5 = total5 + input5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input6.length; i++) {
//     if (input6[i].checked) {
//       total6 = total6 + input6[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input7.length; i++) {
//     if (input7[i].checked) {
//       total7 = total7 + input7[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input8.length; i++) {
//     if (input8[i].checked) {
//       total8 = total8 + input8[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input9.length; i++) {
//     if (input9[i].checked) {
//       total9 = total9 + input9[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input10.length; i++) {
//     if (input10[i].checked) {
//       total10 = total10 + input10[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input11.length; i++) {
//     if (input11[i].checked) {
//       total11 = total11 + input11[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input12.length; i++) {
//     if (input12[i].checked) {
//       total12 = total12 + input12[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input13.length; i++) {
//     if (input13[i].checked) {
//       total13 = total13 + input13[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input14.length; i++) {
//     if (input14[i].checked) {
//       total14 = total14 + input14[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input15.length; i++) {
//     if (input15[i].checked) {
//       total15 = total15 + input5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input16.length; i++) {
//     if (input16[i].checked) {
//       total16 = total16 + input16[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input17.length; i++) {
//     if (input17[i].checked) {
//       total17 = total17 + input17[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input18.length; i++) {
//     if (input18[i].checked) {
//       total18 = total18 + input18[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input19.length; i++) {
//     if (input19[i].checked) {
//       total19 = total9 + input19[i].value + ";";
//     }
//   }
//   for (var i = 0; i < input20.length; i++) {
//     if (input20[i].checked) {
//       total20 = total20 + input20[i].value + ";";
//     }
//   }
//   ////////////////////////bbbbbb////////////////////////
//   for (var i = 0; i < inputb.length; i++) {
//     if (inputb[i].checked) {
//       totalb = totalb + inputb[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb2.length; i++) {
//     if (inputb2[i].checked) {
//       totalb2 = totalb2 + inputb2[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb3.length; i++) {
//     if (inputb3[i].checked) {
//       totalb3 = totalb3 + inputb3[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb4.length; i++) {
//     if (inputb4[i].checked) {
//       totalb4 = totalb4 + inputb4[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb5.length; i++) {
//     if (inputb5[i].checked) {
//       totalb5 = totalb5 + inputb5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb6.length; i++) {
//     if (inputb6[i].checked) {
//       totalb6 = totalb6 + inputb6[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb7.length; i++) {
//     if (inputb7[i].checked) {
//       totalb7 = totalb7 + inputb7[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb8.length; i++) {
//     if (inputb8[i].checked) {
//       totalb8 = totalb8 + inputb8[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb9.length; i++) {
//     if (inputb9[i].checked) {
//       totalb9 = totalb9 + inputb9[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb10.length; i++) {
//     if (inputb10[i].checked) {
//       totalb10 = totalb10 + inputb10[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb11.length; i++) {
//     if (inputb11[i].checked) {
//       totalb11 = totalb11 + inputb11[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb12.length; i++) {
//     if (inputb12[i].checked) {
//       totalb12 = totalb12 + inputb12[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb13.length; i++) {
//     if (inputb13[i].checked) {
//       totalb13 = totalb13 + inputb13[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb14.length; i++) {
//     if (inputb14[i].checked) {
//       totalb14 = totalb14 + inputb14[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb15.length; i++) {
//     if (inputb15[i].checked) {
//       totalb15 = totalb15 + inputb5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb16.length; i++) {
//     if (inputb16[i].checked) {
//       totalb16 = totalb16 + inputb16[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb17.length; i++) {
//     if (inputb17[i].checked) {
//       totalb17 = totalb17 + inputb17[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb18.length; i++) {
//     if (inputb18[i].checked) {
//       totalb18 = totalb18 + inputb18[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb19.length; i++) {
//     if (inputb19[i].checked) {
//       totalb19 = totalb9 + inputb19[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputb20.length; i++) {
//     if (inputb20[i].checked) {
//       totalb20 = totalb20 + inputb20[i].value + ";";
//     }
//   }
//   ////////////////////////ccccc//////////////////////////////
//   for (var i = 0; i < inputc.length; i++) {
//     if (inputc[i].checked) {
//       totalc = totalc + inputc[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc2.length; i++) {
//     if (inputc2[i].checked) {
//       totalc2 = totalc2 + inputc2[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc3.length; i++) {
//     if (inputc3[i].checked) {
//       totalc3 = totalc3 + inputc3[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc4.length; i++) {
//     if (inputc4[i].checked) {
//       totalc4 = totalc4 + inputc4[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc5.length; i++) {
//     if (inputc5[i].checked) {
//       totalc5 = totalc5 + inputc5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc6.length; i++) {
//     if (inputc6[i].checked) {
//       totalc6 = totalc6 + inputc6[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc7.length; i++) {
//     if (inputc7[i].checked) {
//       totalc7 = totalc7 + inputc7[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc8.length; i++) {
//     if (inputc8[i].checked) {
//       totalc8 = totalc8 + inputc8[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc9.length; i++) {
//     if (inputc9[i].checked) {
//       totalc9 = totalc9 + inputc9[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc10.length; i++) {
//     if (inputc10[i].checked) {
//       totalc10 = totalc10 + inputc10[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc11.length; i++) {
//     if (inputc11[i].checked) {
//       totalc11 = totalc11 + inputc11[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc12.length; i++) {
//     if (inputc12[i].checked) {
//       totalc12 = totalc12 + inputc12[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc13.length; i++) {
//     if (inputc13[i].checked) {
//       totalc13 = totalc13 + inputc13[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc14.length; i++) {
//     if (inputc14[i].checked) {
//       totalc14 = totalc14 + inputc14[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc15.length; i++) {
//     if (inputc15[i].checked) {
//       totalc15 = totalc15 + inputc5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc16.length; i++) {
//     if (inputc16[i].checked) {
//       totalc16 = totalc16 + inputc16[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc17.length; i++) {
//     if (inputc17[i].checked) {
//       totalc17 = totalc17 + inputc17[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc18.length; i++) {
//     if (inputc18[i].checked) {
//       totalc18 = totalc18 + inputc18[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc19.length; i++) {
//     if (inputc19[i].checked) {
//       totalc19 = totalc9 + inputc19[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputc20.length; i++) {
//     if (inputc20[i].checked) {
//       totalc20 = totalc20 + inputc20[i].value + ";";
//     }
//   }
//   //////////////////////ddddd////////////////////////////////
//   for (var i = 0; i < inputd.length; i++) {
//     if (inputd[i].checked) {
//       totald = totald + inputd[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd2.length; i++) {
//     if (inputd2[i].checked) {
//       totald2 = totald2 + inputd2[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd3.length; i++) {
//     if (inputd3[i].checked) {
//       totald3 = totald3 + inputd3[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd4.length; i++) {
//     if (inputd4[i].checked) {
//       totald4 = totald4 + inputd4[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd5.length; i++) {
//     if (inputd5[i].checked) {
//       totald5 = totald5 + inputd5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd6.length; i++) {
//     if (inputd6[i].checked) {
//       totald6 = totald6 + inputd6[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd7.length; i++) {
//     if (inputd7[i].checked) {
//       totald7 = totald7 + inputd7[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd8.length; i++) {
//     if (inputd8[i].checked) {
//       totald8 = totald8 + inputd8[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd9.length; i++) {
//     if (inputd9[i].checked) {
//       totald9 = totald9 + inputd9[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd10.length; i++) {
//     if (inputd10[i].checked) {
//       totald10 = totald10 + inputd10[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd11.length; i++) {
//     if (inputd11[i].checked) {
//       totald11 = totald11 + inputd11[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd12.length; i++) {
//     if (inputd12[i].checked) {
//       totald12 = totald12 + inputd12[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd13.length; i++) {
//     if (inputd13[i].checked) {
//       totald13 = totald13 + inputd13[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd14.length; i++) {
//     if (inputd14[i].checked) {
//       totald14 = totald14 + inputd14[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd15.length; i++) {
//     if (inputd15[i].checked) {
//       totald15 = totald15 + inputd5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd16.length; i++) {
//     if (inputd16[i].checked) {
//       totald16 = totald16 + inputd16[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd17.length; i++) {
//     if (inputd17[i].checked) {
//       totald17 = totald17 + inputd17[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd18.length; i++) {
//     if (inputd18[i].checked) {
//       totald18 = totald18 + inputd18[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd19.length; i++) {
//     if (inputd19[i].checked) {
//       totald19 = totald9 + inputd19[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputd20.length; i++) {
//     if (inputd20[i].checked) {
//       totald20 = totald20 + inputd20[i].value + ";";
//     }
//   }
//   //////////////////////eeee////////////////////////////////
//     for (var i = 0; i < inpute.length; i++) {
//     if (inpute[i].checked) {
//       totale = totale + inpute[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute2.length; i++) {
//     if (inpute2[i].checked) {
//       totale2 = totale2 + inpute2[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute3.length; i++) {
//     if (inpute3[i].checked) {
//       totale3 = totale3 + inpute3[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute4.length; i++) {
//     if (inpute4[i].checked) {
//       totale4 = totale4 + inpute4[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute5.length; i++) {
//     if (inpute5[i].checked) {
//       totale5 = totale5 + inpute5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute6.length; i++) {
//     if (inpute6[i].checked) {
//       totale6 = totale6 + inpute6[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute7.length; i++) {
//     if (inpute7[i].checked) {
//       totale7 = totale7 + inpute7[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute8.length; i++) {
//     if (inpute8[i].checked) {
//       totale8 = totale8 + inpute8[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute9.length; i++) {
//     if (inpute9[i].checked) {
//       totale9 = totale9 + inpute9[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute10.length; i++) {
//     if (inpute10[i].checked) {
//       totale10 = totale10 + inpute10[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute11.length; i++) {
//     if (inpute11[i].checked) {
//       totale11 = totale11 + inpute11[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute12.length; i++) {
//     if (inpute12[i].checked) {
//       totale12 = totale12 + inpute12[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute13.length; i++) {
//     if (inpute13[i].checked) {
//       totale13 = totale13 + inpute13[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute14.length; i++) {
//     if (inpute14[i].checked) {
//       totale14 = totale14 + inpute14[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute15.length; i++) {
//     if (inpute15[i].checked) {
//       totale15 = totale15 + inpute5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute16.length; i++) {
//     if (inpute16[i].checked) {
//       totale16 = totale16 + inpute16[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute17.length; i++) {
//     if (inpute17[i].checked) {
//       totale17 = totale17 + inpute17[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute18.length; i++) {
//     if (inpute18[i].checked) {
//       totale18 = totale18 + inpute18[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute19.length; i++) {
//     if (inpute19[i].checked) {
//       totale19 = totale9 + inpute19[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inpute20.length; i++) {
//     if (inpute20[i].checked) {
//       totale20 = totale20 + inpute20[i].value + ";";
//     }
//   }
//   /////////////////////ffffff/////////////////////////////////
//   for (var i = 0; i < inputf.length; i++) {
//     if (inputf[i].checked) {
//       totalf = totalf + inputf[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf2.length; i++) {
//     if (inputf2[i].checked) {
//       totalf2 =totalf2 + inputf2[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf3.length; i++) {
//     if (inputf3[i].checked) {
//       totalf3 = totalf3 + inputf3[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf4.length; i++) {
//     if (inputf4[i].checked) {
//       totalf4 = totalf4 + inputf4[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf5.length; i++) {
//     if (inputf5[i].checked) {
//       totalf5 = totalf5 + inputf5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf6.length; i++) {
//     if (inputf6[i].checked) {
//       totalf6 = totalf6 + inputf6[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf7.length; i++) {
//     if (inputf7[i].checked) {
//       totalf7 = totalf7 + inputf7[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf8.length; i++) {
//     if (inputf8[i].checked) {
//       totalf8 = totalf8 + inputf8[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf9.length; i++) {
//     if (inputf9[i].checked) {
//       totalf9 = totalf9 + inputf9[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf10.length; i++) {
//     if (inputf10[i].checked) {
//       totalf10 = totalf10 + inputf10[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf11.length; i++) {
//     if (inputf11[i].checked) {
//       totalf11 = totalf11 + inputf11[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf12.length; i++) {
//     if (inputf12[i].checked) {
//       totalf12 = totalf12 + inputf12[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf13.length; i++) {
//     if (inputf13[i].checked) {
//       totalf13 = totalf13 + inputf13[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf14.length; i++) {
//     if (inputf14[i].checked) {
//       totalf14 = totalf14 + inputf14[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf15.length; i++) {
//     if (inputf15[i].checked) {
//       totalf15 = totalf15 + inputf5[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf16.length; i++) {
//     if (inputf16[i].checked) {
//       totalf16 = totalf16 + inputf16[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf17.length; i++) {
//     if (inputf17[i].checked) {
//       totalf17 = totalf17 + inputf17[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf18.length; i++) {
//     if (inputf18[i].checked) {
//       totalf18 = totalf18 + inputf18[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf19.length; i++) {
//     if (inputf19[i].checked) {
//       totalf19 = totalf9 + inputf19[i].value + ";";
//     }
//   }
//   for (var i = 0; i < inputf20.length; i++) {
//     if (inputf20[i].checked) {
//       totalf20 = totalf20 + inputf20[i].value + ";";
//     }
//   }

//    ////////////////////////////////////////////////////////
//  // alert(totalb);
//   $.ajax({
//         url:"search_count.php",
//         method: "POST",
//         asynch: false,
//         data:{total:total,total2:total2,total3:total3,total4:total4,total5:total5,total6:total6,total7:total7,total8:total8,total9:total9,total10:total10,total11:total11,total12:total12,total13:total13,total14:total14,total15:total15,total16:total16,total17:total17,total18:total18,total19:total19,total20:total20,totalb:totalb,totalb2:totalb2,totalb3:totalb3,totalb4:totalb4,totalb5:totalb5,totalb6:totalb6,totalb7:totalb7,totalb8:totalb8,totalb9:totalb9,totalb10:totalb10,totalb11:totalb11,totalb12:totalb12,totalb13:totalb13,totalb14:totalb14,totalb15:totalb15,totalb16:totalb16,totalb17:totalb17,totalb18:totalb18,totalb19:totalb19,totalb20:totalb20,totalc:totalc,totalc2:totalc2,totalc3:totalc3,totalc4:totalc4,totalc5:totalc5,totalc6:totalc6,totalc7:totalc7,totalc8:totalc8,totalc9:totalc9,totalc10:totalc10,totalc11:totalc11,totalc12:totalc12,totalc13:totalc13,totalc14:totalc14,totalc15:totalc15,totalc16:totalc16,totalc17:totalc17,totalc18:totalc18,totalc19:totalc19,totalc20:totalc20,totald:totald,totald2:totald2,totald3:totald3,totald4:totald4,totald5:totald5,totald6:totald6,totald7:totald7,totald8:totald8,totald9:totald9,totald10:totald10,totald11:totald11,totald12:totald12,totald13:totald13,totald14:totald14,totald15:totald15,totald16:totald16,totald17:totald17,totald18:totald18,totald19:totald19,totald20:totald20,totale:totale,totale2:totale2,totale3:totale3,totale4:totale4,totale5:totale5,totale6:totale6,totale7:totale7,totale8:totale8,totale9:totale9,totale10:totale10,totale11:totale11,totale12:totale12,totale13:totale13,totale14:totale14,totale15:totale15,totale16:totale16,totale17:totale17,totale18:totale18,totale19:totale19,totale20:totale20,totalf:totalf,totalf2:totalf2,totalf3:totalf3,totalf4:totalf4,totalf5:totalf5,totalf6:totalf6,totalf7:totalf7,totalf8:totalf8,totalf9:totalf9,totalf10:totalf10,totalf11:totalf11,totalf12:totalf12,totalf13:totalf13,totalf14:totalf14,totalf15:totalf15,totalf16:totalf16,totalf17:totalf17,totalf18:totalf18,totalf19:totalf19,totalf20:totalf20,t:t},
//         success:function(data){
//         $('#daymb').html(data);
//         }
//       });

// }

</script>