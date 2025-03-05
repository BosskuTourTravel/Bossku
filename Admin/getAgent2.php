<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country WHERE id=".$_POST['country'];
$rscountry=mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

echo "
<label>Agent</label>";
$query = "SELECT DISTINCT(agent) FROM tour_package WHERE country LIKE '%".$_POST['country']."%'";
$rs=mysqli_query($con,$query);
$z=0;
while($row = mysqli_fetch_array($rs)){
	$querytourtype = "SELECT * FROM agent WHERE id=".$row['agent'];
  $rstourtype=mysqli_query($con,$querytourtype);
  
	while($rowtourtype = mysqli_fetch_array($rstourtype)){
			$tempCountry = preg_split ("/[;]+/", $rowtourtype['tour_country']);
			$checkTempCountry = 0;
			for($i=0; $i<count($tempCountry); $i++){
				$query_country = "SELECT * FROM country WHERE id=".$tempCountry[$i];
				$rs_country=mysqli_query($con,$query_country);
				$row_country = mysqli_fetch_array($rs_country);

				if($row_country['name']==$rowcountry['name']){
					$checkTempCountry = 1;
				}

			}

			if($checkTempCountry==1){

                echo "<option value='".$rowtourtype['id']."'>".$rowtourtype['company']." - ".$rowtourtype['id']."</option>
                <input name='agent".$z."' id='agent".$z."' value='".$rowtourtype['id']."' type='hidden' >
                <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>";

                $queryperformaprice = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=".$row['agent']." AND country = ".$_POST['country'];
                $rsperformaprice=mysqli_query($con,$queryperformaprice);
                $rowperformaprice = mysqli_fetch_assoc($rsperformaprice);
                if($rowperformaprice['total']>0){
                   echo "<div class='container' name='asd' id='asd' hidden>";
                }else{
                   echo "<div class='container' name='asd' id='asd'>";
                }

                            echo "<div class='form-row align-items-center'> 
                                    <div class='col-4'>
                                            <label>Persentase</label>
                                                <input type='text' class='form-control' name='persentase".$z."' id='persentase".$z."' placeholder='Enter Persentase ( Diisi Tanpa % )'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Nominal</label>
                                            <input type='text' class='form-control' name='nominal".$z."' id='nominal".$z."' placeholder='Enter Nominal ( Diisi Tanpa % )'>
                                    </div>
                                    <div class='col-4'>
                                            <label>Option Price</label>
                                                <select class='form-control select2' name='flag".$z."' id='flag".$z."' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    
                                                    echo "<option value=1>Persentase</option>";
                                                    echo "<option value=2>Nominal</option>";
                                                        
                                    echo"</select>
                                        </div>
                            </div>
                            <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Agent Com</label>
                                            <input type='text' class='form-control' name='agentcom".$z."' id='agentcom".$z."' placeholder='Enter AgentCom ( Diisi Dengan % )'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Staff Com</label>
                                            <input type='text' class='form-control' name='staffcom".$z."' id='staffcom".$z."' placeholder='Enter StaffCom ( Diisi Dengan % )'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Staff Com2</label>
                                            <input type='text' class='form-control' name='staffcom2".$z."' id='staffcom2".$z."' placeholder='Enter StaffCom ( Diisi Dengan % )'>
                                    </div>
                            </div>
                            <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Supplier ( Commision For PTT )</label>
                                            <input type='text' class='form-control' name='subagent".$z."' id='subagent".$z."' placeholder='Enter Supplier ( Diisi Dengan % )'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Marketing Com</label>
                                            <input type='text' class='form-control' name='marketingcom".$z."' id='marketingcom".$z."' placeholder='Enter Marketing Com ( Diisi Dengan % )'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Discount</label>
                                            <input type='text' class='form-control' name='discount".$z."' id='discount".$z."' placeholder='Enter Marketing Com ( Diisi Dengan % )'>
                                    </div>

                            </div>";
                                   $z=$z+1;
                                    
                            echo"      
                            
                            </div></br>
                            <div class='form-row align-items-center'>
                                <div class='col-12'>";
                                $querya = "SELECT * FROM performa_price_standart WHERE country=".$_POST['country']." AND agent =".$row['agent'] ." ORDER BY performa_price_range ASC";
                                $rsa=mysqli_query($con,$querya);
                                echo"
                                <table class='table table-hover' style='font-size:12px;'>
                                <thead>
                                <tr>
                                <th>Range Price</th>
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
                                $queryz = "SELECT * FROM performa_price_range WHERE id=".$rowa['performa_price_range'];
                                $rsz=mysqli_query($con,$queryz);
                                $rowz = mysqli_fetch_array($rsz);
                                  
                
                                echo"
                                <tr style='font-weight:bold;'>";
                                if($rowz['price2']==1){
                                  echo "<td> < ".number_format($rowz['price1'], 0, ".", ".")."</td>";
                                }else if($rowz['price2']==0){
                                  echo "<td>".number_format($rowz['price1'], 0, ".", ".")." > .. </td>";
                                }else{
                                  echo "<td>".number_format($rowz['price1'], 0, ".", ".")." - ".number_format($rowz['price2'], 0, ".", ".")."</td>";
                                }
                                echo "<td><input type='text' class='form-control' name='tpersentase".$rowa['id']."' id='tpersentase".$rowa['id']."' value='".$rowa['persentase']."' size='1'></td>
                                <td><input type='text' class='form-control' name='tnominal".$rowa['id']."' id='tnominal".$rowa['id']."' value='".$rowa['nominal']."' size='2'></td>
                                <td>
                                <select class='form-control select2' onchange='updateFlag(".$rowa['id'].",".$rowa['agent'].",".$_POST['country'].",this.value)' name='tflag".$rowa['id']."' id='tflag".$rowa['id']."' style='width: 100%;'>
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
                                <td><input type='text' class='form-control' name='tagentcom".$rowa['id']."' id='tagentcom".$rowa['id']."' value='".$rowa['agentcom']."' size='1'</td>
                                <td><input type='text' class='form-control' name='tstaffcom".$rowa['id']."' id='tstaffcom".$rowa['id']."' value='".$rowa['staffcom']."' size='1'</td>
                                <td><input type='text' class='form-control' name='tstaffcom2".$rowa['id']."' id='tstaffcom2".$rowa['id']."' value='".$rowa['staff_com2']."' size='1'</td>
                                <td><input type='text' class='form-control' name='tmarketingcom".$rowa['id']."' id='tmarketingcom".$rowa['id']."' value='".$rowa['marketingcom']."' size='1'</td>
                                <td><input type='text' class='form-control' name='tsubagent".$rowa['id']."' id='tsubagent".$rowa['id']."' value='".$rowa['subagent']."' size='1'</td>
                                <td><input type='text' class='form-control' name='tdiscount".$rowa['id']."' id='tdiscount".$rowa['id']."' value='".$rowa['discount']."' size='1'</td>
                                <td>
                                <button type='button' class='btn btn-warning' onclick='editButton(".$rowa['id'].")'><i class='fa fa-edit' aria-hidden='true''></i></br>
                                <button type='button' class='btn btn-primary' onclick='editButton2(".$rowa['id'].")'><i class='fa fa-edit' aria-hidden='true''></i></button>
                                
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
            
                </form>";
			}
			
	}
}

$totalpax = $z;

//var_dump($totalpax);
echo "<input type='text' name='totalpax' id='totalpax' value='".$totalpax."' hidden>";
echo "<input type='text' name='tcount' id='tcount' value='".$_POST['country']."' hidden>";

echo"<div class='card-footer'>
<button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
   </div> ";
?>
<script>

  function editButton(x){
      var fd = new FormData();
      var totalpax = $("input[name=totalpax]").val();
      var tcoun = $("input[name=tcount]").val();
      var fd = new FormData();
        fd.append('totalpax',totalpax);
        fd.append('tcoun',tcoun);

       var a = $("input[name=tagent"+x+"]").val();
       var b = $("input[name=tpersentase"+x+"]").val();
       var c = $("input[name=tnominal"+x+"]").val();
       var d = document.getElementById("tflag"+x).options[document.getElementById("tflag"+x).selectedIndex].value;
       var e = $("input[name=tagentcom"+x+"]").val();
       var f = $("input[name=tstaffcom"+x+"]").val();
       var k = $("input[name=tstaffcom2"+x+"]").val();
       var g = $("input[name=tsubagent"+x+"]").val();
       var h = $("input[name=tmarketingcom"+x+"]").val();
       var j = $("input[name=tdiscount"+x+"]").val();

       fd.append('code',1);
       fd.append('id',x);
       fd.append('agent',a);
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
        url: 'insertPerformaPriceAgent2.php',
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
   }

   function editButton2(x){
      var fd = new FormData();
      var totalpax = $("input[name=totalpax]").val();
      var tcoun = $("input[name=tcount]").val();
      var fd = new FormData();
        fd.append('totalpax',totalpax);
        fd.append('tcoun',tcoun);

       var a = $("input[name=tagent"+x+"]").val();
       var b = $("input[name=tpersentase"+x+"]").val();
       var c = $("input[name=tnominal"+x+"]").val();
       var d = document.getElementById("tflag"+x).options[document.getElementById("tflag"+x).selectedIndex].value;
       var e = $("input[name=tagentcom"+x+"]").val();
       var f = $("input[name=tstaffcom"+x+"]").val();
       var k = $("input[name=tstaffcom2"+x+"]").val();
       var g = $("input[name=tsubagent"+x+"]").val();
       var h = $("input[name=tmarketingcom"+x+"]").val();
       var j = $("input[name=tdiscount"+x+"]").val();

       fd.append('code',1);
       fd.append('id',x);
       fd.append('agent',a);
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
        url: 'updatePerformaPriceAgentDua.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
          reloadPage(-13,0,0);
        }

      },
    });
   }

  function updateFlag(x,y,z,v){
    var fd = new FormData();
    fd.append('country',z);
    fd.append('agent',y);
    fd.append('flag',v);

    $.ajax({
            url: 'updateOptionPricePerformaPrice.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadPage(-13,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }

$(document).ready(function(){
    $(".chosen").chosen();

    $("#but_upload").click(function(){

      var totalpax = $("input[name=totalpax]").val();
      var tcoun = $("input[name=tcount]").val();
      var fd = new FormData();
        fd.append('totalpax',totalpax);
        fd.append('tcoun',tcoun);
      

      for (var i = 0; i < totalpax; i++) {
       var a = $("input[name=agent"+i+"]").val();
       var b = $("input[name=persentase"+i+"]").val();
       var c = $("input[name=nominal"+i+"]").val();
       var d = document.getElementById("flag"+i).options[document.getElementById("flag"+i).selectedIndex].value;
       var e = $("input[name=agentcom"+i+"]").val();
       var f = $("input[name=staffcom"+i+"]").val();
       var k = $("input[name=staffcom2"+i+"]").val();
       var g = $("input[name=subagent"+i+"]").val();
       var h = $("input[name=marketingcom"+i+"]").val();
       var j = $("input[name=discount"+i+"]").val();

       fd.append('code',0);
       fd.append('agent'+i,a);
       fd.append('persentase'+i,b);
       fd.append('nominal'+i,c);
       fd.append('flag'+i,d);
       fd.append('agentcom'+i,e);
       fd.append('staffcom'+i,f);
       fd.append('staffcom2'+i,k);
       fd.append('subagent'+i,g);
       fd.append('marketingcom'+i,h);
       fd.append('discount'+i,j);
    }
        $.ajax({
            url: 'insertPerformaPriceAgent2.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
                alert(response);
                reloadPage(-13,0,0);
            	}else{
                alert(response);
              }
              
            },
        });
    });



    
});
</script> 