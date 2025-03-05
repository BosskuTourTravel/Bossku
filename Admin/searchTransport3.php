<?php
include "../site.php";
include "../db=connection.php";

$cagent = $_POST['agent'];
$cagent2 = $_POST['agent2'];
$cagent3 = $_POST['agent3'];
$ccity= $_POST['city'];
$ccity2= $_POST['city2'];
$ccity3= $_POST['city3'];
$cperiode= $_POST['per'];
$cperiode2= $_POST['per2'];
$cperiode3= $_POST['per3'];
$thari= $_POST['thari'];
//var_dump($cagent2);
//var_dump($ccity2);
//var_dump($cperiode2);
echo"
<div class='card'>
  <div class='card-body'>
    This is some text within a card body.
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
        <th scope='row' style='width:2px;'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox' name='tharga".$y."' id='tharga".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent'].",".$_POST['city'].",".$_POST['per'].",".$rowc['rentype'].",".$y."'>
        <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden' >
        </div>
        </th>
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
        <th scope='row' style='width:2px;'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox'  name='thargab".$y."' id='thargab".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent2'].",".$_POST['city2'].",".$_POST['per2'].",".$rowc2['rentype'].",".$y."'>
        <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden' >
        </div>
        </th>
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
        <th scope='row' style='width:2px;'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox'  name='thargac".$y."' id='thargac".$y."' onclick='totalharga(".$y.")' value='".$_POST['agent3'].",".$_POST['city3'].",".$_POST['per3'].",".$rowc3['rentype'].",".$y."'>
        <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
        </div>
        </th>
        <td>".$rowrenc['nama']." &nbsp; : &nbsp; ".$rowrenc['duration']." &nbsp;Hours</td>";

}

  echo"</tbody>
  </table>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    echo"</div>
  </div>";
}

?>
<script>
 $(document).ready(function(){
  });
function totalharga(y) {
  var t= $("input[name=harit]").val();
  var input = document.getElementsByName("tharga1");
  var input2 = document.getElementsByName("tharga2");
  var input3 = document.getElementsByName("tharga3");
  var input4 = document.getElementsByName("tharga4");
  var input5 = document.getElementsByName("tharga5");
  var input6 = document.getElementsByName("tharga6");
  var input7 = document.getElementsByName("tharga7");
  var input8 = document.getElementsByName("tharga8");
  var input9 = document.getElementsByName("tharga9");
  var input10 = document.getElementsByName("tharga10");
  var input11 = document.getElementsByName("tharga11");
  var input12 = document.getElementsByName("tharga12");
  var input13 = document.getElementsByName("tharga13");
  var input14 = document.getElementsByName("tharga14");
  var input15 = document.getElementsByName("tharga15");
  var input16 = document.getElementsByName("tharga16");
  var input17 = document.getElementsByName("tharga17");
  var input18 = document.getElementsByName("tharga18");
  var input19 = document.getElementsByName("tharga19");
  var input20 = document.getElementsByName("tharga20");
////////////////////////////////////////////////////////
  var inputb = document.getElementsByName("thargab1");
  var inputb2 = document.getElementsByName("thargab2");
  var inputb3 = document.getElementsByName("thargab3");
  var inputb4 = document.getElementsByName("thargab4");
  var inputb5 = document.getElementsByName("thargab5");
  var inputb6 = document.getElementsByName("thargab6");
  var inputb7 = document.getElementsByName("thargab7");
  var inputb8 = document.getElementsByName("thargab8");
  var inputb9 = document.getElementsByName("thargab9");
  var inputb10 = document.getElementsByName("thargab10");
  var inputb11 = document.getElementsByName("thargab11");
  var inputb12 = document.getElementsByName("thargab12");
  var inputb13 = document.getElementsByName("thargab13");
  var inputb14 = document.getElementsByName("thargab14");
  var inputb15 = document.getElementsByName("thargab15");
  var inputb16 = document.getElementsByName("thargab16");
  var inputb17 = document.getElementsByName("thargab17");
  var inputb18 = document.getElementsByName("thargab18");
  var inputb19 = document.getElementsByName("thargab19");
  var inputb20 = document.getElementsByName("thargab20");
/////////////////////////////////////////////////////////
  var inputc = document.getElementsByName("thargac1");
  var inputc2 = document.getElementsByName("thargac2");
  var inputc3 = document.getElementsByName("thargac3");
  var inputc4 = document.getElementsByName("thargac4");
  var inputc5 = document.getElementsByName("thargac5");
  var inputc6 = document.getElementsByName("thargac6");
  var inputc7 = document.getElementsByName("thargac7");
  var inputc8 = document.getElementsByName("thargac8");
  var inputc9 = document.getElementsByName("thargac9");
  var inputc10 = document.getElementsByName("thargac10");
  var inputc11 = document.getElementsByName("thargac11");
  var inputc12 = document.getElementsByName("thargac12");
  var inputc13 = document.getElementsByName("thargac13");
  var inputc14 = document.getElementsByName("thargac14");
  var inputc15 = document.getElementsByName("thargac15");
  var inputc16 = document.getElementsByName("thargac16");
  var inputc17 = document.getElementsByName("thargac17");
  var inputc18 = document.getElementsByName("thargac18");
  var inputc19 = document.getElementsByName("thargac19");
  var inputc20 = document.getElementsByName("thargac20");
/////////////////////////////////////////////////////////
  var total = "";
  var total2 = "";
  var total3 = "";
  var total4 = "";
  var total5 = "";
  var total6 = "";
  var total7 = "";
  var total8 = "";
  var total9 = "";
  var total10 = "";
  var total11 = "";
  var total12 = "";
  var total13 = "";
  var total14 = "";
  var total15 = "";
  var total16 = "";
  var total17 = "";
  var total18 = "";
  var total19 = "";
  var total20 = "";
///////////////////////////////////////////////////////////
  var totalb = "";
  var totalb2 = "";
  var totalb3 = "";
  var totalb4 = "";
  var totalb5 = "";
  var totalb6 = "";
  var totalb7 = "";
  var totalb8 = "";
  var totalb9 = "";
  var totalb10 = "";
  var totalb11 = "";
  var totalb12 = "";
  var totalb13 = "";
  var totalb14 = "";
  var totalb15 = "";
  var totalb16 = "";
  var totalb17 = "";
  var totalb18 = "";
  var totalb19 = "";
  var totalb20 = "";
/////////////////////////////////////////////////////////
  var totalc = "";
  var totalc2 = "";
  var totalc3 = "";
  var totalc4 = "";
  var totalc5 = "";
  var totalc6 = "";
  var totalc7 = "";
  var totalc8 = "";
  var totalc9 = "";
  var totalc10 = "";
  var totalc11 = "";
  var totalc12 = "";
  var totalc13 = "";
  var totalc14 = "";
  var totalc15 = "";
  var totalc16 = "";
  var totalc17 = "";
  var totalc18 = "";
  var totalc19 = "";
  var totalc20 = "";
/////////////////////////////////////////////////////////
  for (var i = 0; i < input.length; i++) {
    if (input[i].checked) {
      total = total + input[i].value + ";";
    }
  }
  for (var i = 0; i < input2.length; i++) {
    if (input2[i].checked) {
      total2 = total2 + input2[i].value + ";";
    }
  }
  for (var i = 0; i < input3.length; i++) {
    if (input3[i].checked) {
      total3 = total3 + input3[i].value + ";";
    }
  }
  for (var i = 0; i < input4.length; i++) {
    if (input4[i].checked) {
      total4 = total4 + input4[i].value + ";";
    }
  }
  for (var i = 0; i < input5.length; i++) {
    if (input5[i].checked) {
      total5 = total5 + input5[i].value + ";";
    }
  }
  for (var i = 0; i < input6.length; i++) {
    if (input6[i].checked) {
      total6 = total6 + input6[i].value + ";";
    }
  }
  for (var i = 0; i < input7.length; i++) {
    if (input7[i].checked) {
      total7 = total7 + input7[i].value + ";";
    }
  }
  for (var i = 0; i < input8.length; i++) {
    if (input8[i].checked) {
      total8 = total8 + input8[i].value + ";";
    }
  }
  for (var i = 0; i < input9.length; i++) {
    if (input9[i].checked) {
      total9 = total9 + input9[i].value + ";";
    }
  }
  for (var i = 0; i < input10.length; i++) {
    if (input10[i].checked) {
      total10 = total10 + input10[i].value + ";";
    }
  }
  for (var i = 0; i < input11.length; i++) {
    if (input11[i].checked) {
      total11 = total11 + input11[i].value + ";";
    }
  }
  for (var i = 0; i < input12.length; i++) {
    if (input12[i].checked) {
      total12 = total12 + input12[i].value + ";";
    }
  }
  for (var i = 0; i < input13.length; i++) {
    if (input13[i].checked) {
      total13 = total13 + input13[i].value + ";";
    }
  }
  for (var i = 0; i < input14.length; i++) {
    if (input14[i].checked) {
      total14 = total14 + input14[i].value + ";";
    }
  }
  for (var i = 0; i < input15.length; i++) {
    if (input15[i].checked) {
      total15 = total15 + input5[i].value + ";";
    }
  }
  for (var i = 0; i < input16.length; i++) {
    if (input16[i].checked) {
      total16 = total16 + input16[i].value + ";";
    }
  }
  for (var i = 0; i < input17.length; i++) {
    if (input17[i].checked) {
      total17 = total17 + input17[i].value + ";";
    }
  }
  for (var i = 0; i < input18.length; i++) {
    if (input18[i].checked) {
      total18 = total18 + input18[i].value + ";";
    }
  }
  for (var i = 0; i < input19.length; i++) {
    if (input19[i].checked) {
      total19 = total9 + input19[i].value + ";";
    }
  }
  for (var i = 0; i < input20.length; i++) {
    if (input20[i].checked) {
      total20 = total20 + input20[i].value + ";";
    }
  }
  ////////////////////////////////////////////////
  for (var i = 0; i < inputb.length; i++) {
    if (inputb[i].checked) {
      totalb = totalb + inputb[i].value + ";";
    }
  }
  for (var i = 0; i < inputb2.length; i++) {
    if (inputb2[i].checked) {
      totalb2 = totalb2 + inputb2[i].value + ";";
    }
  }
  for (var i = 0; i < inputb3.length; i++) {
    if (inputb3[i].checked) {
      totalb3 = totalb3 + inputb3[i].value + ";";
    }
  }
  for (var i = 0; i < inputb4.length; i++) {
    if (inputb4[i].checked) {
      totalb4 = totalb4 + inputb4[i].value + ";";
    }
  }
  for (var i = 0; i < inputb5.length; i++) {
    if (inputb5[i].checked) {
      totalb5 = totalb5 + inputb5[i].value + ";";
    }
  }
  for (var i = 0; i < inputb6.length; i++) {
    if (inputb6[i].checked) {
      totalb6 = totalb6 + inputb6[i].value + ";";
    }
  }
  for (var i = 0; i < inputb7.length; i++) {
    if (inputb7[i].checked) {
      totalb7 = totalb7 + inputb7[i].value + ";";
    }
  }
  for (var i = 0; i < inputb8.length; i++) {
    if (inputb8[i].checked) {
      totalb8 = totalb8 + inputb8[i].value + ";";
    }
  }
  for (var i = 0; i < inputb9.length; i++) {
    if (inputb9[i].checked) {
      totalb9 = totalb9 + inputb9[i].value + ";";
    }
  }
  for (var i = 0; i < inputb10.length; i++) {
    if (inputb10[i].checked) {
      totalb10 = totalb10 + inputb10[i].value + ";";
    }
  }
  for (var i = 0; i < inputb11.length; i++) {
    if (inputb11[i].checked) {
      totalb11 = totalb11 + inputb11[i].value + ";";
    }
  }
  for (var i = 0; i < inputb12.length; i++) {
    if (inputb12[i].checked) {
      totalb12 = totalb12 + inputb12[i].value + ";";
    }
  }
  for (var i = 0; i < inputb13.length; i++) {
    if (inputb13[i].checked) {
      totalb13 = totalb13 + inputb13[i].value + ";";
    }
  }
  for (var i = 0; i < inputb14.length; i++) {
    if (inputb14[i].checked) {
      totalb14 = totalb14 + inputb14[i].value + ";";
    }
  }
  for (var i = 0; i < inputb15.length; i++) {
    if (inputb15[i].checked) {
      totalb15 = totalb15 + inputb5[i].value + ";";
    }
  }
  for (var i = 0; i < inputb16.length; i++) {
    if (inputb16[i].checked) {
      totalb16 = totalb16 + inputb16[i].value + ";";
    }
  }
  for (var i = 0; i < inputb17.length; i++) {
    if (inputb17[i].checked) {
      totalb17 = totalb17 + inputb17[i].value + ";";
    }
  }
  for (var i = 0; i < inputb18.length; i++) {
    if (inputb18[i].checked) {
      totalb18 = totalb18 + inputb18[i].value + ";";
    }
  }
  for (var i = 0; i < inputb19.length; i++) {
    if (inputb19[i].checked) {
      totalb19 = totalb9 + inputb19[i].value + ";";
    }
  }
  for (var i = 0; i < inputb20.length; i++) {
    if (inputb20[i].checked) {
      totalb20 = totalb20 + inputb20[i].value + ";";
    }
  }
  //////////////////////////////////////////////////////
  for (var i = 0; i < inputc.length; i++) {
    if (inputc[i].checked) {
      totalc = totalc + inputc[i].value + ";";
    }
  }
  for (var i = 0; i < inputc2.length; i++) {
    if (inputc2[i].checked) {
      totalc2 = totalc2 + inputc2[i].value + ";";
    }
  }
  for (var i = 0; i < inputc3.length; i++) {
    if (inputc3[i].checked) {
      totalc3 = totalc3 + inputc3[i].value + ";";
    }
  }
  for (var i = 0; i < inputc4.length; i++) {
    if (inputc4[i].checked) {
      totalc4 = totalc4 + inputc4[i].value + ";";
    }
  }
  for (var i = 0; i < inputc5.length; i++) {
    if (inputc5[i].checked) {
      totalc5 = totalc5 + inputc5[i].value + ";";
    }
  }
  for (var i = 0; i < inputc6.length; i++) {
    if (inputc6[i].checked) {
      totalc6 = totalc6 + inputc6[i].value + ";";
    }
  }
  for (var i = 0; i < inputc7.length; i++) {
    if (inputc7[i].checked) {
      totalc7 = totalc7 + inputc7[i].value + ";";
    }
  }
  for (var i = 0; i < inputc8.length; i++) {
    if (inputc8[i].checked) {
      totalc8 = totalc8 + inputc8[i].value + ";";
    }
  }
  for (var i = 0; i < inputc9.length; i++) {
    if (inputc9[i].checked) {
      totalc9 = totalc9 + inputc9[i].value + ";";
    }
  }
  for (var i = 0; i < inputc10.length; i++) {
    if (inputc10[i].checked) {
      totalc10 = totalc10 + inputc10[i].value + ";";
    }
  }
  for (var i = 0; i < inputc11.length; i++) {
    if (inputc11[i].checked) {
      totalc11 = totalc11 + inputc11[i].value + ";";
    }
  }
  for (var i = 0; i < inputc12.length; i++) {
    if (inputc12[i].checked) {
      totalc12 = totalc12 + inputc12[i].value + ";";
    }
  }
  for (var i = 0; i < inputc13.length; i++) {
    if (inputc13[i].checked) {
      totalc13 = totalc13 + inputc13[i].value + ";";
    }
  }
  for (var i = 0; i < inputc14.length; i++) {
    if (inputc14[i].checked) {
      totalc14 = totalc14 + inputc14[i].value + ";";
    }
  }
  for (var i = 0; i < inputc15.length; i++) {
    if (inputc15[i].checked) {
      totalc15 = totalc15 + inputc5[i].value + ";";
    }
  }
  for (var i = 0; i < inputc16.length; i++) {
    if (inputc16[i].checked) {
      totalc16 = totalc16 + inputc16[i].value + ";";
    }
  }
  for (var i = 0; i < inputc17.length; i++) {
    if (inputc17[i].checked) {
      totalc17 = totalc17 + inputc17[i].value + ";";
    }
  }
  for (var i = 0; i < inputc18.length; i++) {
    if (inputc18[i].checked) {
      totalc18 = totalc18 + inputc18[i].value + ";";
    }
  }
  for (var i = 0; i < inputc19.length; i++) {
    if (inputc19[i].checked) {
      totalc19 = totalc9 + inputc19[i].value + ";";
    }
  }
  for (var i = 0; i < inputc20.length; i++) {
    if (inputc20[i].checked) {
      totalc20 = totalc20 + inputc20[i].value + ";";
    }
  }
  //////////////////////////////////////////////////////
 // alert(totalb);
  $.ajax({
        url:"search_count.php",
        method: "POST",
        asynch: false,
        data:{total:total,total2:total2,total3:total3,total4:total4,total5:total5,total6:total6,total7:total7,total8:total8,total9:total9,total10:total10,total11:total11,total12:total12,total13:total13,total14:total14,total15:total15,total16:total16,total17:total17,total18:total18,total19:total19,total20:total20,totalb:totalb,totalb2:totalb2,totalb3:totalb3,totalb4:totalb4,totalb5:totalb5,totalb6:totalb6,totalb7:totalb7,totalb8:totalb8,totalb9:totalb9,totalb10:totalb10,totalb11:totalb11,totalb12:totalb12,totalb13:totalb13,totalb14:totalb14,totalb15:totalb15,totalb16:totalb16,totalb17:totalb17,totalb18:totalb18,totalb19:totalb19,totalb20:totalb20,totalc:totalc,totalc2:totalc2,totalc3:totalc3,totalc4:totalc4,totalc5:totalc5,totalc6:totalc6,totalc7:totalc7,totalc8:totalc8,totalc9:totalc9,totalc10:totalc10,totalc11:totalc11,totalc12:totalc12,totalc13:totalc13,totalc14:totalc14,totalc15:totalc15,totalc16:totalc16,totalc17:totalc17,totalc18:totalc18,totalc19:totalc19,totalc20:totalc20,t:t},
        success:function(data){
        $('#daymb').html(data);
        }
      });

}

</script>