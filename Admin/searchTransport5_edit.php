<?php
include "../site.php";
include "../db=connection.php";

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
$id= $_POST['id'];
//$ttotal= $_POST['ttotal'];
//var_dump($ttotal);

$query= "SELECT * FROM transquo WHERE id=".$_POST['id'];
$rs = mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);
$agent1=explode(",", $row['agent1']);
$agent2=explode(",", $row['agent2']);
$agent3=explode(",", $row['agent3']);
$agent4=explode(",", $row['agent4']);
$agent5=explode(",", $row['agent5']);
$agent6=explode(",", $row['agent6']);

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
                    $t_edit=$agent1[5];
                    $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans['transport_type'];
                    $rstt=mysqli_query($con,$querytt);
                    $rowtt = mysqli_fetch_array($rstt);
                    if($t==$t_edit){
                          echo"<div class='form-check'>
                          <input class='form-check-input position-static' type='checkbox' name='tt' id='tt' onclick='trcheck(".$t.")' value='".$_POST['agent'].",".$_POST['city'].",".$_POST['per'].",".$t."' checked>
                              <label class='form-check-label' for='tt".$t."'>".$rowtt['name']."</label>
                      </div>";
                    }else{
                          echo"<div class='form-check'>
                          <input class='form-check-input position-static' type='checkbox' name='tt' id='tt' onclick='trcheck(".$t.")' value='".$_POST['agent'].",".$_POST['city'].",".$_POST['per'].",".$t."'>
                              <label class='form-check-label' for='tt".$t."'>".$rowtt['name']."</label>
                      </div>";
                    }

                }
                echo"    
                </div>
                <div class='col-sm'>";
                while($rowtrans2= mysqli_fetch_array($rstrans2)){
                    $t=$rowtrans2['transport_type'];
                    $t_edit=$agent2[5];
                    $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans2['transport_type'];
                    $rstt=mysqli_query($con,$querytt);
                    $rowtt = mysqli_fetch_array($rstt);
                    if($t==$t_edit){
                      echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt2' id='tt2' onclick='trcheck(".$t.")' value='".$_POST['agent2'].",".$_POST['city2'].",".$_POST['per2'].",".$t."' checked>
                          <label class='form-check-label' for='tt2".$t."'>".$rowtt['name']."</label>
                  </div>";
                    }else{
                      echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt2' id='tt2' onclick='trcheck(".$t.")' value='".$_POST['agent2'].",".$_POST['city2'].",".$_POST['per2'].",".$t."'>
                          <label class='form-check-label' for='tt2".$t."'>".$rowtt['name']."</label>
                  </div>";
                    }

                }
                echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans3= mysqli_fetch_array($rstrans3)){
                    $t=$rowtrans3['transport_type'];
                    $t_edit=$agent3[5];
                    $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans3['transport_type'];
                    $rstt=mysqli_query($con,$querytt);
                    $rowtt = mysqli_fetch_array($rstt);
                    if($t==$t_edit){
                      echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt3' id='tt3' onclick='trcheck(".$t.")' value='".$_POST['agent3'].",".$_POST['city3'].",".$_POST['per3'].",".$t."' checked>
                          <label class='form-check-label' for='tt3".$t."'>".$rowtt['name']."</label>
                  </div>"; 
                    }else{
                      echo"<div class='form-check'>
                      <input class='form-check-input position-static' type='checkbox' name='tt3' id='tt3' onclick='trcheck(".$t.")' value='".$_POST['agent3'].",".$_POST['city3'].",".$_POST['per3'].",".$t."'>
                          <label class='form-check-label' for='tt3".$t."'>".$rowtt['name']."</label>
                  </div>";                      
                    }

                }
                echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans4= mysqli_fetch_array($rstrans4)){
                  $t=$rowtrans4['transport_type'];
                  $t_edit=$agent4[5];
                  $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans4['transport_type'];
                  $rstt=mysqli_query($con,$querytt);
                  $rowtt = mysqli_fetch_array($rstt);
                  if($t==$t_edit){
                    echo"<div class='form-check'>
                    <input class='form-check-input position-static' type='checkbox' name='tt4' id='tt4' onclick='trcheck(".$t.")' value='".$_POST['agent4'].",".$_POST['city4'].",".$_POST['per4'].",".$t."' checked>
                        <label class='form-check-label' for='tt4".$t."'>".$rowtt['name']."</label>
                </div>";
                  }else{
                    echo"<div class='form-check'>
                    <input class='form-check-input position-static' type='checkbox' name='tt4' id='tt4' onclick='trcheck(".$t.")' value='".$_POST['agent4'].",".$_POST['city4'].",".$_POST['per4'].",".$t."'>
                        <label class='form-check-label' for='tt4".$t."'>".$rowtt['name']."</label>
                </div>";
                  }

              }
              echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans5= mysqli_fetch_array($rstrans5)){
                  $t=$rowtrans5['transport_type'];
                  $t_edit=$agent5[5];
                  $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans5['transport_type'];
                  $rstt=mysqli_query($con,$querytt);
                  $rowtt = mysqli_fetch_array($rstt);
                  if($t==$t_edit){
                    echo"<div class='form-check'>
                    <input class='form-check-input position-static' type='checkbox' name='tt5' id='tt5' onclick='trcheck(".$t.")' value='".$_POST['agent5'].",".$_POST['city5'].",".$_POST['per5'].",".$t."' checked>
                        <label class='form-check-label' for='tt5".$t."'>".$rowtt['name']."</label>
                </div>";  
                  }else{
                    echo"<div class='form-check'>
                    <input class='form-check-input position-static' type='checkbox' name='tt5' id='tt5' onclick='trcheck(".$t.")' value='".$_POST['agent5'].",".$_POST['city5'].",".$_POST['per5'].",".$t."'>
                        <label class='form-check-label' for='tt5".$t."'>".$rowtt['name']."</label>
                </div>";                    
                  }

              }
              echo"
                </div>
                <div class='col-sm'>";
                while($rowtrans6= mysqli_fetch_array($rstrans6)){
                  $t=$rowtrans6['transport_type'];
                  $t_edit=$agent6[5];
                  $querytt = "SELECT * FROM transport_type WHERE id=".$rowtrans6['transport_type'];
                  $rstt=mysqli_query($con,$querytt);
                  $rowtt = mysqli_fetch_array($rstt);
                  if($t==$t_edit){
                    echo"<div class='form-check'>
                    <input class='form-check-input position-static' type='checkbox' name='tt6' id='tt6' onclick='trcheck(".$t.")' value='".$_POST['agent6'].",".$_POST['city6'].",".$_POST['per6'].",".$t."' checked>
                        <label class='form-check-label' for='tt6".$t."'>".$rowtt['name']."</label>
                </div>";  
                  }else{
                    echo"<div class='form-check'>
                    <input class='form-check-input position-static' type='checkbox' name='tt6' id='tt6' onclick='trcheck(".$t.")' value='".$_POST['agent6'].",".$_POST['city6'].",".$_POST['per6'].",".$t."'>
                        <label class='form-check-label' for='tt6".$t."'>".$rowtt['name']."</label>
                </div>";                    
                  }

              }
               echo"
                </div>
                
                <input name='harit' id='harit' value='".$_POST['thari']."' type='hidden'>
                <input name='id' id='id' value='".$_POST['id']."' type='hidden'>
                <input name='ttotal' id='ttotal' value='".$_POST['ttotal']."' type='hidden'>
            </div>
        </div>
    </div>
</div>
<button type='button' class='btn btn-warning' onclick='search()'>Next</button>";


?>
<script>
 $(document).ready(function(){
  });
  function search(t) {
    var t= $("input[name=harit]").val();
    var id= $("input[name=id]").val();
   // var ttotal= $("input[name=ttotal]").val();
    var tr1 = document.getElementsByName("tt");
    var tr2 = document.getElementsByName("tt2");
    var tr3 = document.getElementsByName("tt3");
    var tr4 = document.getElementsByName("tt4");
    var tr5 = document.getElementsByName("tt5");
    var tr6 = document.getElementsByName("tt6");
    var totaltr = "";
    var totaltr2 = "";
    var totaltr3 = "";
    var totaltr4 = "";
    var totaltr5 = "";
    var totaltr6 = "";
   
    for (var i = 0; i < tr1.length; i++) {
    if (tr1[i].checked) {
      totaltr = totaltr + tr1[i].value + ";";
    }
  }
  for (var i = 0; i < tr2.length; i++) {
    if (tr2[i].checked) {
      totaltr2 = totaltr2 + tr2[i].value + ";";
    }
  }
  for (var i = 0; i < tr3.length; i++) {
    if (tr3[i].checked) {
      totaltr3 = totaltr3 + tr3[i].value + ";";
    }
  }
  for (var i = 0; i < tr4.length; i++) {
    if (tr4[i].checked) {
      totaltr4 = totaltr4 + tr4[i].value + ";";
    }
  }
  for (var i = 0; i < tr5.length; i++) {
    if (tr5[i].checked) {
      totaltr5 = totaltr5 + tr5[i].value + ";";
    }
  }
  for (var i = 0; i < tr6.length; i++) {
    if (tr6[i].checked) {
      totaltr6 = totaltr6 + tr6[i].value + ";";
    }
  }

// alert(ttotal);
  $.ajax({
        url:"searchTransport4b_edit.php",
        method: "POST",
        asynch: false,
        data:{totaltr:totaltr,totaltr2:totaltr2,totaltr3:totaltr3,totaltr4:totaltr4,totaltr5:totaltr5,totaltr6:totaltr6,t:t,id:id},
        success:function(data){
        $('#divtr').html(data);
        }
      });
  }

</script>