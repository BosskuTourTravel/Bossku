<?php
include "../db=connection.php";
// if($_POST['getDetail']) {
$id = $_POST['tq'];
// $query1 = "SELECT * FROM transquo where tour_pack=".$id;
// $rs1=mysqli_query($con,$query1);
// while($row1=mysqli_fetch_array($rs1)){
$query = "SELECT * FROM hotelquo where tour_pack=".$id;
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
  $pax_tour=$row['pax'];
  $db_durasi=$row['durasi'];
  $db_guide=explode("%", $row['guide']);
      $value_guide=explode(",",$db_guide[0]);
      $kurs_guide=explode(",",$db_guide[1]);
      $ket_guide=explode(",",$db_guide[2]);
  $db_breakfest=explode("%", $row['breakfast']);
      $value_breakfest=explode(",",$db_breakfest[0]);
      $kurs_breakfest=explode(",",$db_breakfest[1]);
      $ket_breakfest=explode(",",$db_breakfest[2]);
  $db_lunch=explode("%", $row['lunch']);
      $value_lunch=explode(",",$db_lunch[0]);
      $kurs_lunch=explode(",",$db_lunch[1]);
      $ket_lunch=explode(",",$db_lunch[2]);
  $db_dinner=explode("%", $row['dinner']);
      $value_dinner=explode(",",$db_dinner[0]);
      $kurs_dinner=explode(",",$db_dinner[1]);
      $ket_dinner=explode(",",$db_dinner[2]);
  $db_hotel=explode("%", $row['hotel']);
      $value_hotel=explode(",",$db_hotel[0]);
      $kurs_hotel=explode(",",$db_hotel[1]);
      $tipe_hotel=explode(",",$db_hotel[4]);
      $vr_hotel=explode(",",$db_hotel[3]);
      $ket_hotel=explode(",",$db_hotel[2]);
  $db_foc=explode("%", $row['foc']);
      $foc=$db_foc[2];
  $db_bonus=explode("%", $row['bonus']);
      $bonus=$db_bonus[2];
  $db_tl=explode("%", $row['tl']);
      $tl=$db_tl[2];
  $query_tour = "SELECT * FROM tour_package where id=".$row['tour_pack'];
  $rs_tour=mysqli_query($con,$query_tour);
  $row_tour = mysqli_fetch_array($rs_tour);

  echo"<tr>
  <th scope='row'>#</th>
  <td colspan='7'align='center'><p><h7><b>".$row_tour['tour_name']."</b></h7></p></td>
  </tr>";
  /////looooopinggg 1///////////////////////////////////////////////////////////
  $no=1;
  $grandtotal="";
  $grandpax="";
  // $grand_foc=0;
  // $grand_bonus=0;
  // $grand_tl=0;
  for($i=0; $i < $db_durasi; $i++) {
    ////////////// guide/////////////////////////
    $querybgk = "SELECT * FROM kurs_bank WHERE id=".$kurs_guide[$i];
    $rsbgk=mysqli_query($con,$querybgk);
    $rowbgk = mysqli_fetch_array($rsbgk);
    $bgk=$rowbgk['name'];
    $querygk= "SELECT * FROM kurs_live WHERE name LIKE '$bgk%'";
    $rsgk=mysqli_query($con,$querygk);
    $rowgk = mysqli_fetch_array($rsgk);
    $kursgk=$rowgk['jual'];
    if($kursgk==NULL){
      $hargag= $value_guide[$i];
     }else{
     $hargag= $value_guide[$i] * $rowgk['jual'];
     }
    $hargag=round($hargag ,0);
    //////////////////////breakfast//////////////////////
    $querybbk = "SELECT * FROM kurs_bank WHERE id=".$kurs_breakfest[$i];
    $rsbbk=mysqli_query($con,$querybbk);
    $rowbbk = mysqli_fetch_array($rsbbk);
    $bbk=$rowbbk['name'];
    $querybk= "SELECT * FROM kurs_live WHERE name LIKE '$bbk%'";
    $rsbk=mysqli_query($con,$querybk);
    $rowbk = mysqli_fetch_array($rsbk);
    $kursbk=$rowbk['jual'];
    if($kursbk==NULL){
      $hargab= $value_breakfest[$i];
     }else{
     $hargab= $value_breakfest[$i] * $rowbk['jual'];
     }
     $foc_bf=$hargab;
     $hargab = $hargab * $pax_tour; 
      $hargab=round($hargab ,0);
    //////////////////////lunch//////////////////////
    $queryblk = "SELECT * FROM kurs_bank WHERE id=".$kurs_lunch[$i];
    $rsblk=mysqli_query($con,$queryblk);
    $rowblk = mysqli_fetch_array($rsblk);
    $blk=$rowblk['name'];
    $querylk= "SELECT * FROM kurs_live WHERE name LIKE '$blk%'";
    $rslk=mysqli_query($con,$querylk);
    $rowlk = mysqli_fetch_array($rslk);
    $kurslk=$rowlk['jual'];
    if($kurslk==NULL){
      $hargal= $value_lunch[$i];
     }else{
     $hargal= $value_lunch[$i] * $rowlk['jual'];
     }
     $foc_l=$hargal;
    $hargal=  $hargal *$pax_tour;
    $hargal=round($hargal ,0);
    ////////////////////////dinner/////////////////////
    $querybdk = "SELECT * FROM kurs_bank WHERE id=".$kurs_dinner[$i];
    $rsbdk=mysqli_query($con,$querybdk);
    $rowbdk = mysqli_fetch_array($rsbdk);
    $bdk=$rowbdk['name'];
    $querydk= "SELECT * FROM kurs_live WHERE name LIKE '$bdk%'";
    $rsdk=mysqli_query($con,$querydk);
    $rowdk = mysqli_fetch_array($rsdk);
    $kursdk=$rowdk['jual'];
    if($kursdk==NULL){
      $hargad= $value_dinner[$i];
     }else{
     $hargad= $value_dinner[$i] * $rowdk['jual'];
     }
     $foc_d=$hargad;
     $hargad =  $hargad * $pax_tour;
     $hargad=round($hargad ,0);

    // $total_breakfest=$value_breakfest[$i]*$row['pax'];
    // $total_lunch=$value_lunch[$i]*$row['pax'];
    // $total_dinner=$value_dinner[$i]*$row['pax'];
    ///////hotel//////////////////////////////////////
    $querybhk = "SELECT * FROM kurs_bank WHERE id=".$kurs_hotel[$i];
    $rsbhk=mysqli_query($con,$querybhk);
    $rowbhk = mysqli_fetch_array($rsbhk);
    $bhk=$rowbhk['name'];
    $queryhk= "SELECT * FROM kurs_live WHERE name LIKE '$bhk%'";
    $rshk=mysqli_query($con,$queryhk);
    $rowhk = mysqli_fetch_array($rshk);
    $kurshk=$rowhk['jual'];
    if($kurshk==NULL){
      $hargah= $value_hotel[$i];
     }else{
     $hargah= $value_hotel[$i] * $rowhk['jual'];
     }

    $pax= $vr_hotel[$i];
    if($pax==NULL){
      $pax=1;
    }
    if($tipe_hotel[$i]=='1')
    {
      $hotelx=$hargah;
     $hargah =  $hargah * $pax;
    }else{
    $hotelx=$hargah*2;
    $hargah =  $hargah * $row['pax'];
     $hargah=round($hargah ,0);
    }
    $querydollar= "SELECT * FROM kurs_live WHERE name LIKE 'USD%'";
    $rsdollar=mysqli_query($con,$querydollar);
    $rowdollar = mysqli_fetch_array($rsdollar);
    $dollar=$rowdollar['jual'];
    $total=$hargag + $hargal + $hargad +  $hargah + $hargab;
    $per_pax=$total/$pax_tour;
    $total_usd = ceil($total / $dollar);
    $per_pax_usd =ceil($per_pax / $dollar);
    echo"
    <th scope='row'>".$no."</th>
    <td>Rp.".number_format($hargag, 0, ".", ".")."</br><p style='color: red;'>ket : ".$ket_guide[$i]."</p></td>
    <td>Rp.".number_format($hargab, 0, ".", ".")."</br><p style='color: red;'>ket : ".$ket_breakfest[$i]."</p></td>
    <td>Rp.".number_format($hargal, 0, ".", ".")."</br><p style='color: red;'>ket : ".$ket_lunch[$i]."</p></td>
    <td>Rp.".number_format($hargad, 0, ".", ".")."</br><p style='color: red;'>ket : ".$ket_dinner[$i]."</p></td>
    <td>Rp.".number_format($hargah, 0, ".", ".")."</br><p style='color: red;'>ket : ".$ket_hotel[$i]."</p></td>
    <td>Rp.".number_format($total, 0, ".", ".")."</br><p style='color: red;'>$.".number_format($total_usd, 0, ".", ".")." USD</p></td>
    <td>Rp.".number_format($per_pax, 0, ".", ".")."</br><p style='color: red;'>$.".number_format($per_pax_usd, 0, ".", ".")." USD</p></td>
  </tr>";
$no++;
$grandtotal=$grandtotal+$total;
$grandpax=$grandpax+$per_pax;
$grand_foc=$grand_foc+$total_foc;
$grand_bonus=$grand_bonus+$total_bonus;
$grand_tl=$grand_tl+$total_tl;

  }
  echo"
  <tr>
  <td colspan='6'>Total</td>
  <td>Rp.".number_format($grandtotal, 0, ".", ".")."</td>
  <td>Rp.".number_format($grandpax, 0, ".", ".")."</td>
  </tr>";
  echo"
  <tr>
  <td colspan='6' align='center'>Cost FOC : </td>
  <td>Rp.".number_format($foc, 0, ".", ".")."</td>
  <td>Rp.".number_format($foc/$pax_tour, 0, ".", ".")."</td>
  </tr>";
  echo"
  <tr>
  <td colspan='6' align='center'>Cost Bonus Pax : </td>
  <td>Rp.".number_format($bonus, 0, ".", ".")."</td>
  <td>Rp.".number_format($bonus/$pax_tour, 0, ".", ".")."</td>
  </tr>";
  echo"
  <tr>
  <td colspan='6' align='center'>Cost TL: </td>
  <td>Rp.".number_format($tl, 0, ".", ".")."</td>
  <td>Rp.".number_format($tl/$pax_tour, 0, ".", ".")."</td>
  </tr>";
  $grandtotal_per_itenerary= $grandtotal+$foc+$bonus+$tl;
  $grandtotal_per_itenerary_pack= $grandpax+($foc/$pax_tour)+($bonus/$pax_tour)+($tl/$pax_tour);
  echo"
  <tr>
  <td colspan='6' align='center'><b>Grandtotal:</b> </td>
  <td><b>Rp.".number_format($grandtotal_per_itenerary, 0, ".", ".")."</b><p style='color: red;'>$.".number_format($grandtotal_per_itenerary/$dollar, 0, ".", ".")." USD</p></td>
  <td><b>Rp.".number_format($grandtotal_per_itenerary_pack, 0, ".", ".")."</b><p style='color: red;'>$.".number_format($grandtotal_per_itenerary_pack/$dollar, 0, ".", ".")." USD</p></td>
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