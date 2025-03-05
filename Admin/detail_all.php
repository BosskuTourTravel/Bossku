<?php
include "../db=connection.php";
// if($_POST['getDetail']) {
$id = $_POST['tq'];
// $query1 = "SELECT * FROM transquo where tour_pack=".$id;
// $rs1=mysqli_query($con,$query1);
// while($row1=mysqli_fetch_array($rs1)){
$query = "SELECT * FROM transquo where tour_pack=".$id;
$rs=mysqli_query($con,$query);
echo"
<div class='container'>
  <div class='col-12'>
<div class='card'>
<div class='card-header'>View All</div>
<div class='card-body'>
<table class='table table-bordered'>
<thead>                  
<tr>
    <th>Days</th>
    <th>Agent Code</th>
    <th>Agent Name</th>
    <th>Transport Type</th>
    <th>Rent Type</th>
    <th>Cost</th>
    <th>Cost /pax</th>
</tr>
</thead>
<tbody>";
$no=1;
while($row=mysqli_fetch_array($rs)){
  $tour=$row['tour_pack'];
  $pax=$row['pax'];
  $arr_harga=$row['agent1'];
  $arr_harga2=$row['agent2'];
  $arr_harga3=$row['agent3'];
  $arr_harga4=$row['agent4'];
  $arr_harga5=$row['agent5'];
  $arr_harga6=$row['agent6'];
  $data1=explode(";",$arr_harga);
  $data2=explode(";",$arr_harga2);
  $data3=explode(";",$arr_harga3);
  $data4=explode(";",$arr_harga4);
  $data5=explode(";",$arr_harga5);
  $data6=explode(";",$arr_harga6);
//var_dump("data1:".count($data1)."/"."data2:".count($data2)."/"."data3:".count($data3)."/"."data4:". count($data4)."/"."data5:". count($data5)."/"."data6:". count($data6));
//var_dump();
  echo"
  <tr>
  <td colspan='6' align='center'><b>Kode Itinerary  : 888".$row['tour_pack']." / Versi : ".$row['ket']."</b></td>
 </tr>";
 $total=[];
 $total_pax=[];
for($z=0; $z < count($data1); $z++) {
  $hasil[$z]=explode(",",$data1[$z]);
  $tour2=$hasil[$z][0];
  if($tour == $tour2){
  $queryAgent[$z] = "SELECT * FROM agent where id=".$hasil[$z][2]; 
  $rsAgent[$z]=mysqli_query($con,$queryAgent[$z]);
  $rowAgent[$z] = mysqli_fetch_array($rsAgent[$z]);

  $querytrans[$z] = "SELECT * FROM transport_type where id=".$hasil[$z][5]; 
  $rstrans[$z]=mysqli_query($con,$querytrans[$z]);
  $rowtrans[$z] = mysqli_fetch_array($rstrans[$z]);

  $queryrenc[$z] = "SELECT * FROM rent_type WHERE id=".$hasil[$z][6];
  $rsrenc[$z]=mysqli_query($con,$queryrenc[$z]);
  $rowrenc[$z] = mysqli_fetch_array($rsrenc[$z]);

  $query_tr[$z] = "SELECT * FROM transport WHERE agent=".$hasil[$z][2]." AND city=".$hasil[$z][3]." AND  periode=".$hasil[$z][4]." AND rentype=".$hasil[$z][6]." AND transport_type=".$hasil[$z][5];
  $rs_tr[$z]=mysqli_query($con,$query_tr[$z]);
  while($row_tr[$z] = mysqli_fetch_array($rs_tr[$z])){
  $querykursc[$z] = "SELECT * FROM kurs_bank WHERE id=".$row_tr[$z]['kurs'];
  $rskursc[$z]=mysqli_query($con,$querykursc[$z]);
  $rowkursc[$z] = mysqli_fetch_array($rskursc[$z]);
  $kurs[$z]= $rowkursc[$z]['name'];

  $querykonv[$z] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$z]%'";
  $rskonv[$z]=mysqli_query($con,$querykonv[$z]);
  $rowkonv [$z]= mysqli_fetch_array($rskonv[$z]);
  $kurs[$z]=$rowkonv[$z]['jual'];
  if($kurs[$z]==NULL){
    $harga[$z]= $row_tr[$z]['harga'];
  }else{
  $harga[$z]= $row_tr[$z]['harga'] * $rowkonv[$z]['jual'];
  }
  $harga[$z]=round($harga[$z] ,0);
}
echo"
<tr>
<td>".$hasil[$z][7]."</td>
<td>".$hasil[$z][2]."</td>
<td><b>".$rowAgent[$z]['name']."</b> &nbsp; From : ".$rowAgent[$z]['company']."</td>
<td>".$rowtrans[$z]['name']."</td>
<td>".$rowrenc[$z]['nama']."</td>
<td>Rp.".number_format($harga[$z], 0, ".", ".")."</td>
<td>Rp.".number_format($harga[$z]/$row['pax'], 0, ".", ".")."</td>
</tr>";
array_push($total,$harga[$z]); 
$harga_pax[$z]=$harga[$z]/$pax;
array_push($total_pax,$harga_pax[$z]);
 }
}
 for($z=0; $z < count($data2); $z++) {
  $hasil[$z]=explode(",",$data2[$z]);
  $tour2=$hasil[$z][0];
  if($tour == $tour2){
  $queryAgent[$z] = "SELECT * FROM agent where id=".$hasil[$z][2]; 
  $rsAgent[$z]=mysqli_query($con,$queryAgent[$z]);
  $rowAgent[$z] = mysqli_fetch_array($rsAgent[$z]);

  $querytrans[$z] = "SELECT * FROM transport_type where id=".$hasil[$z][5]; 
  $rstrans[$z]=mysqli_query($con,$querytrans[$z]);
  $rowtrans[$z] = mysqli_fetch_array($rstrans[$z]);

  $queryrenc[$z] = "SELECT * FROM rent_type WHERE id=".$hasil[$z][6];
  $rsrenc[$z]=mysqli_query($con,$queryrenc[$z]);
  $rowrenc[$z] = mysqli_fetch_array($rsrenc[$z]);

  $query_tr[$z] = "SELECT * FROM transport WHERE agent=".$hasil[$z][2]." AND city=".$hasil[$z][3]." AND  periode=".$hasil[$z][4]." AND rentype=".$hasil[$z][6]." AND transport_type=".$hasil[$z][5];
  $rs_tr[$z]=mysqli_query($con,$query_tr[$z]);
  while($row_tr[$z] = mysqli_fetch_array($rs_tr[$z])){
  $querykursc[$z] = "SELECT * FROM kurs_bank WHERE id=".$row_tr[$z]['kurs'];
  $rskursc[$z]=mysqli_query($con,$querykursc[$z]);
  $rowkursc[$z] = mysqli_fetch_array($rskursc[$z]);
  $kurs[$z]= $rowkursc[$z]['name'];

  $querykonv[$z] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$z]%'";
  $rskonv[$z]=mysqli_query($con,$querykonv[$z]);
  $rowkonv[$z]= mysqli_fetch_array($rskonv[$z]);
  $kurs[$z]=$rowkonv[$z]['jual'];
  if($kurs[$z]==NULL){
    $harga[$z]= $row_tr[$z]['harga'];
  }else{
  $harga[$z]= $row_tr[$z]['harga'] * $rowkonv[$z]['jual'];
  }
  $harga[$z]=round($harga[$z] ,0);
}

echo"
<tr>
<td>".$hasil[$z][7]."</td>
<td>".$hasil[$z][2]."</td>
<td><b>".$rowAgent[$z]['name']."</b> &nbsp; From : ".$rowAgent[$z]['company']."</td>
<td>".$rowtrans[$z]['name']."</td>
<td>".$rowrenc[$z]['nama']."</td>
<td>Rp.".number_format($harga[$z], 0, ".", ".")."</td>
<td>Rp.".number_format($harga[$z]/$row['pax'], 0, ".", ".")."</td>
</tr>";
array_push($total,$harga[$z]);
$harga_pax[$z]=$harga[$z]/$pax;
array_push($total_pax,$harga_pax[$z]); 
 }
}
 for($z=0; $z < count($data3); $z++) {
  $hasil[$z]=explode(",",$data3[$z]);
  $tour2=$hasil[$z][0];
  if($tour == $tour2){
  $queryAgent[$z] = "SELECT * FROM agent where id=".$hasil[$z][2]; 
  $rsAgent[$z]=mysqli_query($con,$queryAgent[$z]);
  $rowAgent[$z] = mysqli_fetch_array($rsAgent[$z]);

  $querytrans[$z] = "SELECT * FROM transport_type where id=".$hasil[$z][5]; 
  $rstrans[$z]=mysqli_query($con,$querytrans[$z]);
  $rowtrans[$z] = mysqli_fetch_array($rstrans[$z]);

  $queryrenc[$z] = "SELECT * FROM rent_type WHERE id=".$hasil[$z][6];
  $rsrenc[$z]=mysqli_query($con,$queryrenc[$z]);
  $rowrenc[$z] = mysqli_fetch_array($rsrenc[$z]);

  $query_tr[$z] = "SELECT * FROM transport WHERE agent=".$hasil[$z][2]." AND city=".$hasil[$z][3]." AND  periode=".$hasil[$z][4]." AND rentype=".$hasil[$z][6]." AND transport_type=".$hasil[$z][5];
  $rs_tr[$z]=mysqli_query($con,$query_tr[$z]);
  while($row_tr[$z] = mysqli_fetch_array($rs_tr[$z])){
  $querykursc[$z] = "SELECT * FROM kurs_bank WHERE id=".$row_tr[$z]['kurs'];
  $rskursc[$z]=mysqli_query($con,$querykursc[$z]);
  $rowkursc[$z] = mysqli_fetch_array($rskursc[$z]);
  $kurs[$z]= $rowkursc[$z]['name'];

  $querykonv[$z] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$z]%'";
  $rskonv[$z]=mysqli_query($con,$querykonv[$z]);
  $rowkonv [$z]= mysqli_fetch_array($rskonv[$z]);
  $kurs[$z]=$rowkonv[$z]['jual'];
  if($kurs[$z]==NULL){
    $harga[$z]= $row_tr[$z]['harga'];
  }else{
  $harga[$z]= $row_tr[$z]['harga'] * $rowkonv[$z]['jual'];
  }
  $harga[$z]=round($harga[$z] ,0);
}
echo"
<tr>
<td>".$hasil[$z][7]."</td>
<td>".$hasil[$z][2]."</td>
<td><b>".$rowAgent[$z]['name']."</b> &nbsp; From : ".$rowAgent[$z]['company']."</td>
<td>".$rowtrans[$z]['name']."</td>
<td>".$rowrenc[$z]['nama']."</td>
<td>Rp.".number_format($harga[$z], 0, ".", ".")."</td>
<td>Rp.".number_format($harga[$z]/$row['pax'], 0, ".", ".")."</td>
</tr>";
array_push($total,$harga[$z]);
$harga_pax[$z]=$harga[$z]/$pax;
array_push($total_pax,$harga_pax[$z]); 
 }
}
 for($z=0; $z < count($data4); $z++) {
  $hasil[$z]=explode(",",$data4[$z]);
  $tour2=$hasil[$z][0];
  if($tour == $tour2){
  $queryAgent[$z] = "SELECT * FROM agent where id=".$hasil[$z][2]; 
  $rsAgent[$z]=mysqli_query($con,$queryAgent[$z]);
  $rowAgent[$z] = mysqli_fetch_array($rsAgent[$z]);

  $querytrans[$z] = "SELECT * FROM transport_type where id=".$hasil[$z][5]; 
  $rstrans[$z]=mysqli_query($con,$querytrans[$z]);
  $rowtrans[$z] = mysqli_fetch_array($rstrans[$z]);

  $queryrenc[$z] = "SELECT * FROM rent_type WHERE id=".$hasil[$z][6];
  $rsrenc[$z]=mysqli_query($con,$queryrenc[$z]);
  $rowrenc[$z] = mysqli_fetch_array($rsrenc[$z]);

  $query_tr[$z] = "SELECT * FROM transport WHERE agent=".$hasil[$z][2]." AND city=".$hasil[$z][3]." AND  periode=".$hasil[$z][4]." AND rentype=".$hasil[$z][6]." AND transport_type=".$hasil[$z][5];
  $rs_tr[$z]=mysqli_query($con,$query_tr[$z]);
  while($row_tr[$z] = mysqli_fetch_array($rs_tr[$z])){
  $querykursc[$z] = "SELECT * FROM kurs_bank WHERE id=".$row_tr[$z]['kurs'];
  $rskursc[$z]=mysqli_query($con,$querykursc[$z]);
  $rowkursc[$z] = mysqli_fetch_array($rskursc[$z]);
  $kurs[$z]= $rowkursc[$z]['name'];

  $querykonv[$z] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$z]%'";
  $rskonv[$z]=mysqli_query($con,$querykonv[$z]);
  $rowkonv [$z]= mysqli_fetch_array($rskonv[$z]);
  $kurs[$z]=$rowkonv[$z]['jual'];
  if($kurs[$z]==NULL){
    $harga[$z]= $row_tr[$z]['harga'];
  }else{
  $harga[$z]= $row_tr[$z]['harga'] * $rowkonv[$z]['jual'];
  }
  $harga[$z]=round($harga[$z] ,0);
}
echo"
<tr>
<td>".$hasil[$z][7]."</td>
<td>".$hasil[$z][2]."</td>
<td><b>".$rowAgent[$z]['name']."</b> &nbsp; From : ".$rowAgent[$z]['company']."</td>
<td>".$rowtrans[$z]['name']."</td>
<td>".$rowrenc[$z]['nama']."</td>
<td>Rp.".number_format($harga[$z], 0, ".", ".")."</td>
<td>Rp.".number_format($harga[$z]/$row['pax'], 0, ".", ".")."</td>
</tr>";
array_push($total,$harga[$z]); 
$harga_pax[$z]=$harga[$z]/$pax;
array_push($total_pax,$harga_pax[$z]);
 }
}
 for($z=0; $z < count($data5); $z++) {
  $hasil[$z]=explode(",",$data5[$z]);
  $tour2=$hasil[$z][0];
  if($tour == $tour2){
  $queryAgent[$z] = "SELECT * FROM agent where id=".$hasil[$z][2]; 
  $rsAgent[$z]=mysqli_query($con,$queryAgent[$z]);
  $rowAgent[$z] = mysqli_fetch_array($rsAgent[$z]);

  $querytrans[$z] = "SELECT * FROM transport_type where id=".$hasil[$z][5]; 
  $rstrans[$z]=mysqli_query($con,$querytrans[$z]);
  $rowtrans[$z] = mysqli_fetch_array($rstrans[$z]);

  $queryrenc[$z] = "SELECT * FROM rent_type WHERE id=".$hasil[$z][6];
  $rsrenc[$z]=mysqli_query($con,$queryrenc[$z]);
  $rowrenc[$z] = mysqli_fetch_array($rsrenc[$z]);

  $query_tr[$z] = "SELECT * FROM transport WHERE agent=".$hasil[$z][2]." AND city=".$hasil[$z][3]." AND  periode=".$hasil[$z][4]." AND rentype=".$hasil[$z][6]." AND transport_type=".$hasil[$z][5];
  $rs_tr[$z]=mysqli_query($con,$query_tr[$z]);
  while($row_tr[$z] = mysqli_fetch_array($rs_tr[$z])){
  $querykursc[$z] = "SELECT * FROM kurs_bank WHERE id=".$row_tr[$z]['kurs'];
  $rskursc[$z]=mysqli_query($con,$querykursc[$z]);
  $rowkursc[$z] = mysqli_fetch_array($rskursc[$z]);
  $kurs[$z]= $rowkursc[$z]['name'];

  $querykonv[$z] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$z]%'";
  $rskonv[$z]=mysqli_query($con,$querykonv[$z]);
  $rowkonv [$z]= mysqli_fetch_array($rskonv[$z]);
  $kurs[$z]=$rowkonv[$z]['jual'];
  if($kurs[$z]==NULL){
    $harga[$z]= $row_tr[$z]['harga'];
  }else{
  $harga[$z]= $row_tr[$z]['harga'] * $rowkonv[$z]['jual'];
  }
  $harga[$z]=round($harga[$z] ,0);
}
echo"
<tr>
<td>".$hasil[$z][7]."</td>
<td>".$hasil[$z][2]."</td>
<td><b>".$rowAgent[$z]['name']."</b> &nbsp; From : ".$rowAgent[$z]['company']."</td>
<td>".$rowtrans[$z]['name']."</td>
<td>".$rowrenc[$z]['nama']."</td>
<td>Rp.".number_format($harga[$z], 0, ".", ".")."</td>
<td>Rp.".number_format($harga[$z]/$row['pax'], 0, ".", ".")."</td>
</tr>";
array_push($total,$harga[$z]);
$harga_pax[$z]=$harga[$z]/$pax;
array_push($total_pax,$harga_pax[$z]); 
 }
}
 for($z=0; $z < count($data6); $z++) {
  $hasil[$z]=explode(",",$data6[$z]);
  $tour2=$hasil[$z][0];
  if($tour == $tour2){
  $queryAgent[$z] = "SELECT * FROM agent where id=".$hasil[$z][2]; 
  $rsAgent[$z]=mysqli_query($con,$queryAgent[$z]);
  $rowAgent[$z] = mysqli_fetch_array($rsAgent[$z]);

  $querytrans[$z] = "SELECT * FROM transport_type where id=".$hasil[$z][5]; 
  $rstrans[$z]=mysqli_query($con,$querytrans[$z]);
  $rowtrans[$z] = mysqli_fetch_array($rstrans[$z]);

  $queryrenc[$z] = "SELECT * FROM rent_type WHERE id=".$hasil[$z][6];
  $rsrenc[$z]=mysqli_query($con,$queryrenc[$z]);
  $rowrenc[$z] = mysqli_fetch_array($rsrenc[$z]);

  $query_tr[$z] = "SELECT * FROM transport WHERE agent=".$hasil[$z][2]." AND city=".$hasil[$z][3]." AND  periode=".$hasil[$z][4]." AND rentype=".$hasil[$z][6]." AND transport_type=".$hasil[$z][5];
  $rs_tr[$z]=mysqli_query($con,$query_tr[$z]);
  while($row_tr[$z] = mysqli_fetch_array($rs_tr[$z])){
  $querykursc[$z] = "SELECT * FROM kurs_bank WHERE id=".$row_tr[$z]['kurs'];
  $rskursc[$z]=mysqli_query($con,$querykursc[$z]);
  $rowkursc[$z] = mysqli_fetch_array($rskursc[$z]);
  $kurs[$z]= $rowkursc[$z]['name'];

  $querykonv[$z] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$z]%'";
  $rskonv[$z]=mysqli_query($con,$querykonv[$z]);
  $rowkonv [$z]= mysqli_fetch_array($rskonv[$z]);
  $kurs[$z]=$rowkonv[$z]['jual'];
  if($kurs[$z]==NULL){
    $harga[$z]= $row_tr[$z]['harga'];
  }else{
  $harga[$z]= $row_tr[$z]['harga'] * $rowkonv[$z]['jual'];
  }
  $harga[$z]=round($harga[$z] ,0);
}
echo"
<tr>
<td>".$hasil[$z][7]."</td>
<td>".$hasil[$z][2]."</td>
<td><b>".$rowAgent[$z]['name']."</b> &nbsp; From : ".$rowAgent[$z]['company']."</td>
<td>".$rowtrans[$z]['name']."</td>
<td>".$rowrenc[$z]['nama']."</td>
<td>Rp.".number_format($harga[$z], 0, ".", ".")."</td>
<td>Rp.".number_format($harga[$z]/$row['pax'], 0, ".", ".")."</td>
</tr>";
array_push($total,$harga[$z]);
$harga_pax[$z]=$harga[$z]/$pax;
array_push($total_pax,$harga_pax[$z]); 
 }
}
echo"
<tr>
<td colspan='5'>Total</td>
<td>Rp.".number_format(array_sum($total), 0, ".", ".")."</td>
<td>Rp.".number_format(array_sum($total_pax), 0, ".", ".")."</td>
</tr>";
}

echo"
</tbody>
</table>
</div>
</div>
</div>
</div>";
 //}
?>