<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country WHERE id=".$_POST['country'];
$rscountry=mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

echo "
<form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
<div class='card-body'>
<div class='form-row align-items-center'> 
<div class='col-4'>
<label>Persentase</label>
<input type='text' class='form-control' name='persentase' id='persentase' placeholder='Enter Persentase ( Diisi Tanpa % )'>
</div>
<div class='col-4'>
<label>Nominal</label>
<input type='text' class='form-control' name='nominal' id='nominal' placeholder='Enter Nominal ( Diisi Tanpa % )'>
</div>
<div class='col-4'>
<label>Option Price</label>
<select class='form-control select2' name='flag' id='flag' style='width: 100%;'>
<option selected='selected' value=0>Pilihan</option>";
echo "<option value=1>Persentase</option>";
echo "<option value=2>Nominal</option>";
echo"</select>
</div>
</div>
<div class='form-row align-items-center'>
<div class='col-4'>
<label>Agent Com</label>
<input type='text' class='form-control' name='agentcom' id='agentcom' placeholder='Enter AgentCom ( Diisi Dengan % )'>
</div>
<div class='col-4'>
<label>Staff Com</label>
<input type='text' class='form-control' name='staffcom' id='staffcom' placeholder='Enter StaffCom ( Diisi Dengan % )'>
</div>
<div class='col-4'>
<label>Staff Com2</label>
<input type='text' class='form-control' name='staffcom2' id='staffcom2' placeholder='Enter StaffCom 2( Diisi Dengan % )'>
</div>
</div>
<div class='form-row align-items-center'>
<div class='col-4'>
<label>Supplier ( Commision For PTT )</label>
<input type='text' class='form-control' name='subagent' id='subagent' placeholder='Enter Supplier ( Diisi Dengan % )'>
</div>
<div class='col-4'>
<label>Marketing Com</label>
<input type='text' class='form-control' name='marketingcom' id='marketingcom' placeholder='Enter Marketing Com ( Diisi Dengan % )'>
</div>
<div class='col-4'>
<label>Discount</label>
<input type='text' class='form-control' name='discount' id='discount' placeholder='Enter Discount Com ( Diisi Dengan % )'>
</div>";
$z=$z+1;

echo"      
</div></br>
</form>
<div class='form-row align-items-center'>
<div class='col-12'>";
$querya = "SELECT * FROM performa_price_visapassport WHERE country =".$_POST['country'];
$rsa=mysqli_query($con,$querya);
echo"
<table class='table table-hover' style='font-size:12px;'>
<thead>
<tr>
<th>Persentase</th>
<th>Nominal</th>
<th>Pilihan</th>
<th>Agent Com</th>
<th>Staff Com</th>
<th>Staff Com2</th>
<th>Marketing</th>
<th>Supplier ( Commision For PTT )</th>
<th>Discount</th>

<th>Option</th>
</tr>
</thead>
<tbody>";
while($rowa = mysqli_fetch_array($rsa)){


  echo"
  <tr style='font-weight:bold;'>";
  
  echo "<td><input type='text' class='form-control' name='tpersentase' id='tpersentase' value='".$rowa['persentase']."' size='1'></td>
  <td><input type='text' class='form-control' name='tnominal' id='tnominal' value='".$rowa['nominal']."' size='1'></td>
  <td>
  <select class='form-control select2' onchange='updateFlag(".$rowa['id'].",".$_POST['id'].",".$_POST['country'].")' name='tflag' id='tflag' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";
  for ($x = 1; $x <3; $x++) {
    if($x==$rowa['option_price']){
      if($x==1){
        echo "<option selected='selected' value=".$x.">Persentase</option>";
      }else{
        echo "<option selected='selected' value=".$x.">Nominal</option>";
      }
    }else{
      if($x==1){
        echo "<option value=".$x.">Persentase</option>";
      }else{
        echo "<option value=".$x.">Nominal</option>";
      }
    }
  }
  echo"</select>
  </td>
  <td><input type='text' class='form-control' name='tagentcom' id='tagentcom' value='".$rowa['agentcom']."' size='1'></td>
  <td><input type='text' class='form-control' name='tstaffcom' id='tstaffcom' value='".$rowa['staffcom']."' size='1'></td>
  <td><input type='text' class='form-control' name='tstaffcom2' id='tstaffcom2' value='".$rowa['staffcom2']."' size='1'></td>
  <td><input type='text' class='form-control' name='tmarketingcom' id='tmarketingcom' value='".$rowa['marketingcom']."' size='1'></td>
  <td><input type='text' class='form-control' name='tsubagent' id='tsubagent' value='".$rowa['subagent']."' size='1'></td>
  <td><input type='text' class='form-control' name='tdiscount' id='tdiscount' value='".$rowa['discount']."' size='1'></td>
  <td>
  <button type='button' id='but_edit' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>

  </td>
  </tr>
  <tr>";
}
echo"
</tbody>
</table>

</div>
</div>
</div>

";

//var_dump($totalpax);
echo "<input type='text' name='tcoun' id='tcoun' value='".$_POST['country']."' hidden>";
echo"<div class='card-footer'>
<button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
</div> ";
?>
<script>
  $(document).ready(function(){
    $(".chosen").chosen();

    $("#but_upload").click(function(){

      var fd = new FormData();
       var a = $("input[name=tcoun]").val();
       var b = $("input[name=persentase]").val();
       var c = $("input[name=nominal]").val();
       var d = document.getElementById("flag").options[document.getElementById("flag").selectedIndex].value;
       var e = $("input[name=agentcom]").val();
       var f = $("input[name=staffcom]").val();
       var k = $("input[name=staffcom2]").val();
       var g = $("input[name=subagent]").val();
       var h = $("input[name=marketingcom]").val();
       var j = $("input[name=discount]").val();

       fd.append('country',a);
       fd.append('persentase',b);
       fd.append('nominal',c);
       fd.append('flag',d);
       fd.append('agentcom',e);
       fd.append('staffcom',f);
       fd.append('staffcom2',k);
       fd.append('subagent',g);
       fd.append('marketingcom',h);
       fd.append('discount',j);
       $.ajax({
        url: 'insertPerformaPriceVisaPassport.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
          reloadPage(-14,0,0);
        }

      },
    });
   });

    $("#but_edit").click(function(){
      var fd = new FormData();
       var a = $("input[name=tcoun]").val();
       var b = $("input[name=tpersentase]").val();
       var c = $("input[name=tnominal]").val();
       var d = document.getElementById("tflag").options[document.getElementById("tflag").selectedIndex].value;
       var e = $("input[name=tagentcom]").val();
       var f = $("input[name=tstaffcom]").val();
       var k = $("input[name=tstaffcom2]").val();
       var g = $("input[name=tsubagent]").val();
       var h = $("input[name=tmarketingcom]").val();
       var j = $("input[name=tdiscount]").val();

       fd.append('country',a);
       fd.append('persentase',b);
       fd.append('nominal',c);
       fd.append('flag',d);
       fd.append('agentcom',e);
       fd.append('staffcom',f);
       fd.append('staffcom2',k);
       fd.append('subagent',g);
       fd.append('marketingcom',h);
       fd.append('discount',j);
       $.ajax({
        url: 'insertPerformaPriceVisaPassport.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
        }

      },
    });
   });




  });
</script> 