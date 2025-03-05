<?php
include "../site.php";
include "../db=connection.php";
////////////////////////////////

$gb= $_POST['gb'];
$gk= $_POST['gk'];
$gt= $_POST['gt'];


$lb= $_POST['lb'];
$lk= $_POST['lk'];
$lt= $_POST['lt'];


$db= $_POST['db'];
$dk= $_POST['dk'];
$dt= $_POST['dt'];


$hb= $_POST['hb'];
$hk= $_POST['hk'];
$ht= $_POST['ht'];
$hp= $_POST['hp'];
$htipe= $_POST['htipe'];
//$tipe_room= $_POST['tr'];

$bb= $_POST['bb'];
$bk= $_POST['bk'];
$bt= $_POST['bt'];
$focx= $_POST['foc'];
$bonusx= $_POST['bonus'];
$tlx= $_POST['tl'];

$thari = $_POST['harit'];
$data = explode(";", $_POST['total']);
$topax = explode(",", $_POST['topax']);
$foc = explode(",", $_POST['foc']);
$bonus = explode(",", $_POST['bonus']);
$tl = explode(",", $_POST['tl']);
$ftipe_room = explode(";", $_POST['ftr']);
$btipe_room = explode(";", $_POST['btr']);
$ttipe_room = explode(";", $_POST['ttr']);
$dgb =explode(";",$gb);
$dgk =explode(";",$gk);
$dgt =explode(";",$gt);
$dlb =explode(";",$lb);
$dlk =explode(";",$lk);
$dlt =explode(";",$lt);


$ddb =explode(";",$db);
$ddk =explode(";",$dk);
$ddt =explode(";",$dt);


$dhb =explode(";",$hb);
$dhk =explode(";",$hk);
$dht =explode(";",$ht);
$dhp =explode(";",$hp);
$dhtipe =explode(";",$htipe);
//$dtipe_room =explode(";",$tipe_room);
//var_dump($dhtipe);

$dbb =explode(";",$bb);
$dbk =explode(";",$bk);
$dbt =explode(";",$bt);

//var_dump($guide);
// var_dump($lunch[0]);
// var_dump($dinner[0]);
// var_dump($hotel[0]);
//var_dump($hotel[0]);
//var_dump($dgp);

echo"<table class='table table-sm'>
  <thead>
    <tr>
      <th scope='col'>DAY</th>
      <th scope='col'>Guide</th>
      <th scope='col'>Breakfast</th>
      <th scope='col'>Lunch</th>
      <th scope='col'>Dinner</th>
      <th scope='col'>Hotel</th>
      <th scope='col'>Total</th>
      <th scope='col'>Per Pax</th>
    </tr>
  </thead>
  <tbody>";
  //var_dump($data);
  $d=0;
  $z=0;
  $grandtotal2=0;
  $grandtotal3=0;
  $total_ht=[];
  $data_foc=[];
  $data_bonus=[];
  $data_tl=[];
  for($i=0; $i < count($data); $i++) {
    $data2[$i]= explode(",", $data[$i]);
            $d = $d + $data2[$i][1];
            $pax_tour=$topax[$i];
            $foc_tour=$foc[$i];
            $bonus_tour=$bonus[$i];
            $tl_tour=$tl[$i];
            $ftr_tour=$ftipe_room[$i];
            $btr_tour=$btipe_room[$i];
            $ttr_tour=$ttipe_room[$i];

            $query = "SELECT * FROM tour_package where id=".$data2[$i][0];
            $rs=mysqli_query($con,$query);
            $row = mysqli_fetch_array($rs);

            $trans_pack = "SELECT * FROM transquo where tour_pack=".$data2[$i][0];
            $rs_trans_pack=mysqli_query($con,$trans_pack);
            $row_trans_pack = mysqli_fetch_array($rs_trans_pack);
            $total_trans_pack=$row_trans_pack['total'];
            $pax_trans=$row_trans_pack['pax'];
            if($pax_trans==NULL or $total_trans_pack==NULL){
              $transquo_pack='0';
            }else{
            $transquo_pack=$total_trans_pack/$pax_trans;
            }

            echo"<tr>
            <th scope='row'>#</th>
            <td colspan='6'align='center'><p><h7><b>".$row['tour_name']."</b></h7></p></td>
          </tr>";

  $no=1;
  $grandtotal="";
  $grandpax="";
  $grand_foc=0;
  $grand_bonus=0;
  $grand_tl=0;
  for ($y = $z; $y < $d; $y++ ){
    //////////////////////guide//////////////////////
    $querybgk = "SELECT * FROM kurs_bank WHERE id=".$dgk[$y];
    $rsbgk=mysqli_query($con,$querybgk);
    $rowbgk = mysqli_fetch_array($rsbgk);
    $bgk=$rowbgk['name'];
    $querygk= "SELECT * FROM kurs_live WHERE name LIKE '$bgk%'";
    $rsgk=mysqli_query($con,$querygk);
    $rowgk = mysqli_fetch_array($rsgk);
    $kursgk=$rowgk['jual'];
    if($kursgk==NULL){
      $hargag= $dgb[$y];
     }else{
     $hargag= $dgb[$y] * $rowgk['jual'];
     }
    $hargag=round($hargag ,0);
    //////////////////////breakfast//////////////////////
    $querybbk = "SELECT * FROM kurs_bank WHERE id=".$dbk[$y];
    $rsbbk=mysqli_query($con,$querybbk);
    $rowbbk = mysqli_fetch_array($rsbbk);
    $bbk=$rowbbk['name'];
    $querybk= "SELECT * FROM kurs_live WHERE name LIKE '$bbk%'";
    $rsbk=mysqli_query($con,$querybk);
    $rowbk = mysqli_fetch_array($rsbk);
    $kursbk=$rowbk['jual'];
    if($kursbk==NULL){
      $hargab= $dbb[$y];
     }else{
     $hargab= $dbb[$y] * $rowbk['jual'];
     }
     $foc_bf=$hargab;
     $hargab = $hargab * $pax_tour; 
      $hargab=round($hargab ,0);
    //////////////////////lunch//////////////////////
    $queryblk = "SELECT * FROM kurs_bank WHERE id=".$dlk[$y];
    $rsblk=mysqli_query($con,$queryblk);
    $rowblk = mysqli_fetch_array($rsblk);
    $blk=$rowblk['name'];
    $querylk= "SELECT * FROM kurs_live WHERE name LIKE '$blk%'";
    $rslk=mysqli_query($con,$querylk);
    $rowlk = mysqli_fetch_array($rslk);
    $kurslk=$rowlk['jual'];
    if($kurslk==NULL){
      $hargal= $dlb[$y];
     }else{
     $hargal= $dlb[$y] * $rowlk['jual'];
     }
     $foc_l=$hargal;
    $hargal=  $hargal *$pax_tour;
    $hargal=round($hargal ,0);
    ////////////////////////dinner/////////////////////
    $querybdk = "SELECT * FROM kurs_bank WHERE id=".$ddk[$y];
    $rsbdk=mysqli_query($con,$querybdk);
    $rowbdk = mysqli_fetch_array($rsbdk);
    $bdk=$rowbdk['name'];
    $querydk= "SELECT * FROM kurs_live WHERE name LIKE '$bdk%'";
    $rsdk=mysqli_query($con,$querydk);
    $rowdk = mysqli_fetch_array($rsdk);
    $kursdk=$rowdk['jual'];
    if($kursdk==NULL){
      $hargad= $ddb[$y];
     }else{
     $hargad= $ddb[$y] * $rowdk['jual'];
     }
     $foc_d=$hargad;
     $hargad =  $hargad * $pax_tour;
     $hargad=round($hargad ,0);
    ////////////////////////hotel/////////////////////
    $querybhk = "SELECT * FROM kurs_bank WHERE id=".$dhk[$y];
    $rsbhk=mysqli_query($con,$querybhk);
    $rowbhk = mysqli_fetch_array($rsbhk);
    $bhk=$rowbhk['name'];
    $queryhk= "SELECT * FROM kurs_live WHERE name LIKE '$bhk%'";
    $rshk=mysqli_query($con,$queryhk);
    $rowhk = mysqli_fetch_array($rshk);
    $kurshk=$rowhk['jual'];
    if($kurshk==NULL){
      $hargah= $dhb[$y];
     }else{
     $hargah= $dhb[$y] * $rowhk['jual'];
     }
     $pax= $dhp[$y];
     if($pax==NULL){
       $pax=1;
     }
      if($dhtipe[$y]=='1')
      {
        $hotelx=$hargah;
       $hargah =  $hargah * $pax;


      }else{
      $hotelx=$hargah*2;
      $hargah =  $hargah * $pax_tour;
       $hargah=round($hargah ,0);


      }
      // $grand_foc=$grand_foc + $cost_foc;
      // $grand_bonus=$grand_bonus + $cost_bonus;
      // $grand_tl=$grand_tl + $cost_tl;
     //var_dump($dhtipe[$y]);
    /////////////////////////////////////////////////
    $querydollar= "SELECT * FROM kurs_live WHERE name LIKE 'USD%'";
    $rsdollar=mysqli_query($con,$querydollar);
    $rowdollar = mysqli_fetch_array($rsdollar);
    $dollar=$rowdollar['jual'];

    $total=$hargag + $hargal + $hargad +  $hargah + $hargab;
    $per_pax=$total/$pax_tour;
    $total_usd = ceil($total / $dollar);
    $per_pax_usd =ceil($per_pax / $dollar);
    if($ftr_tour == 0){
      $total_foc= ($foc_bf + $foc_l + $foc_d + $hotelx) * $foc_tour;
    }else{
      $total_foc= ($foc_bf + $foc_l + $foc_d + ($hotelx/2)) * $foc_tour;
    }
    if($btr_tour==0){
      $total_bonus= ($foc_bf + $foc_l + $foc_d  + $hotelx) * $bonus_tour;
    }else{
      $total_bonus= ($foc_bf + $foc_l + $foc_d  + ($hotelx/2)) * $bonus_tour;
    }
    if($ttr_tour==0){
      $total_tl= ($foc_bf + $foc_l + $foc_d  + $hotelx) * $tl_tour;
    }else{
      $total_tl= ($foc_bf + $foc_l + $foc_d + ($hotelx/2)) * $tl_tour;
    }
    //$total_foc= ($hargal + $hargad +  $hargah + $hotelx) * $bonus_tour;
    //$total_foc= ($hargal + $hargad +  $hargah + $hotelx) * $tl_tour;
  //var_dump($total_foc);

    echo"<tr>
      <th scope='row'>".$no."</th>
      <td>Rp.".number_format($hargag, 0, ".", ".")."</br><p style='color: red;'>ket : ".$dgt[$y]."</p></td>
      <td>Rp.".number_format($hargab, 0, ".", ".")."</br><p style='color: red;'>ket : ".$dbt[$y]."</p></td>
      <td>Rp.".number_format($hargal, 0, ".", ".")."</br><p style='color: red;'>ket : ".$dlt[$y]."</p></td>
      <td>Rp.".number_format($hargad, 0, ".", ".")."</br><p style='color: red;'>ket : ".$ddt[$y]."</p></td>
      <td>Rp.".number_format($hargah, 0, ".", ".")."</br><p style='color: red;'>ket : ".$dht[$y]."</p></td>
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
  <td colspan='6' align='center'>Hotel Quotation/Itinerary : </td>
  <td>Rp.".number_format($grandtotal, 0, ".", ".")."</td>
  <td>Rp.".number_format($grandpax, 0, ".", ".")."</td>";
  echo"
  <tr>
  <td colspan='6' align='center'>Cost FOC : </td>
  <td>Rp.".number_format($grand_foc, 0, ".", ".")."</td>
  <td>Rp.".number_format($grand_foc/$pax_tour, 0, ".", ".")."</td>
  </tr>";
  echo"
  <tr>
  <td colspan='6' align='center'>Cost Bonus Pax : </td>
  <td>Rp.".number_format($grand_bonus, 0, ".", ".")."</td>
  <td>Rp.".number_format($grand_bonus/$pax_tour, 0, ".", ".")."</td>
  </tr>";
  echo"
  <tr>
  <td colspan='6' align='center'>Cost TL: </td>
  <td>Rp.".number_format($grand_tl, 0, ".", ".")."</td>
  <td>Rp.".number_format($grand_tl/$pax_tour, 0, ".", ".")."</td>
  </tr>";

  echo"
  <tr>
  <td colspan='6' align='center'>Transport Quotation/Itinerary: </td>
  <td>Rp.".number_format($total_trans_pack, 0, ".", ".")."</td>
  <td>Rp.".number_format($transquo_pack, 0, ".", ".")."</td>
  </tr>";
  $grandtotal_per_itenerary= $grandtotal+$total_trans_pack+$grand_foc+$grand_bonus+$grand_tl;
  $grandtotal_per_itenerary_pack= $grandpax+$transquo_pack+($grand_foc/$pax_tour)+($grand_bonus/$pax_tour)+($grand_tl/$pax_tour);
  echo"
  <tr>
  <td colspan='6' align='center'><b>Grandtotal/Itinerary:</b> </td>
  <td><b>Rp.".number_format($grandtotal_per_itenerary, 0, ".", ".")."</b><p style='color: red;'>$.".number_format($grandtotal_per_itenerary/$dollar, 0, ".", ".")." USD</p></td>
  <td><b>Rp.".number_format($grandtotal_per_itenerary_pack, 0, ".", ".")."</b><p style='color: red;'>$.".number_format($grandtotal_per_itenerary_pack/$dollar, 0, ".", ".")." USD</p></td>
  </tr>";
  $z= $z + $data2[$i][1];
  $grandtotal2=$grandtotal2+$grandtotal_per_itenerary;
  $grandtotal3=$grandtotal3+$grandtotal_per_itenerary_pack;
  array_push($total_ht,$grandtotal);
  array_push($data_foc,$grand_foc);
  array_push($data_bonus,$grand_bonus);
  array_push($data_tl,$grand_tl);
}
$data_total_ht=implode(";",$total_ht);
$total_data_foc=implode(";",$data_foc);
$total_data_bonus=implode(";",$data_bonus);
$total_data_tl=implode(";",$data_tl);
//var_dump($data_total_ht);
  // session_start();
  // $transport = $_SESSION['transport']; 
  // $supergrand =$grandtotal2 + $transport;
  echo"
  <tr>
  <td colspan='6'>
  <form>
  <div class='form-row'>
  <div class='col'>
  <p><h3>GRANDTOTAL: Rp.".number_format($grandtotal2, 0, ".", ".")."</h3></p>
  </div>
  <div class='col'>
  <p><h3>GRANDTOTAL_PAX: Rp.".number_format($grandtotal3, 0, ".", ".")."</h3></p>
  </div>
      <div class='col'>
          <input type='hidden' class='form-control' id='tpax' name='tpax' style='width:100px;' value='".$_POST['topax']."'>
          <input type='hidden' class='form-control' id='seltp' name='seltp' style='width:100px;' value='".$grandtotal2."'>
          <input type='hidden' class='form-control' id='total_ht' name='total_ht' style='width:100px;' value='".$data_total_ht."'>
          <input type='hidden' class='form-control' id='agent' name='agent' style='width:100px;' value='".$_POST['total']."'>
          <input type='hidden' class='form-control' id='gb' name='gb' style='width:100px;' value='".$gb."'>
          <input type='hidden' class='form-control' id='gk' name='gk' style='width:100px;' value='".$gk."'>
          <input type='hidden' class='form-control' id='gt' name='gt' style='width:100px;' value='".$gt."'>

          <input type='hidden' class='form-control' id='lb' name='lb' style='width:100px;' value='".$lb."'>
          <input type='hidden' class='form-control' id='lk' name='lk' style='width:100px;' value='".$lk."'>
          <input type='hidden' class='form-control' id='lt' name='lt' style='width:100px;' value='".$lt."'>

          <input type='hidden' class='form-control' id='db' name='db' style='width:100px;' value='".$db."'>
          <input type='hidden' class='form-control' id='dk' name='dk' style='width:100px;' value='".$dk."'>
          <input type='hidden' class='form-control' id='dt' name='dt' style='width:100px;' value='".$dt."'>

          <input type='hidden' class='form-control' id='hb' name='hb' style='width:100px;' value='".$hb."'>
          <input type='hidden' class='form-control' id='hk' name='hk' style='width:100px;' value='".$hk."'>
          <input type='hidden' class='form-control' id='ht' name='ht' style='width:100px;' value='".$ht."'>
          <input type='hidden' class='form-control' id='hp' name='hp' style='width:100px;' value='".$hp."'>
          <input type='hidden' class='form-control' id='htipe' name='htipe' style='width:100px;' value='".$htipe."'>

          <input type='hidden' class='form-control' id='bb' name='bb' style='width:100px;' value='".$bb."'>
          <input type='hidden' class='form-control' id='bk' name='bk' style='width:100px;' value='".$bk."'>
          <input type='hidden' class='form-control' id='bt' name='bt' style='width:100px;' value='".$bt."'>

          <input type='hidden' class='form-control' id='focx' name='focx' style='width:100px;' value='".$focx."'>
          <input type='hidden' class='form-control' id='bonusx' name='bonusx' style='width:100px;' value='".$bonusx."'>
          <input type='hidden' class='form-control' id='tlx' name='tlx' style='width:100px;' value='".$tlx."'>

          <input type='hidden' class='form-control' id='foc' name='foc' style='width:100px;' value='".$total_data_foc."'>
          <input type='hidden' class='form-control' id='bonus' name='bonus' style='width:100px;' value='".$total_data_bonus."'>
          <input type='hidden' class='form-control' id='tl' name='tl' style='width:100px;' value='".$total_data_tl."'>
          <input type='hidden' class='form-control' id='ftipe_room' name='ftipe_room' style='width:100px;' value='".$_POST['ftr']."'>
          <input type='hidden' class='form-control' id='ftipe_room' name='btipe_room' style='width:100px;' value='".$_POST['btr']."'>
          <input type='hidden' class='form-control' id='ftipe_room' name='ttipe_room' style='width:100px;' value='".$_POST['ttr']."'>
      </div>
      <div class='col-auto my-1'>
            <button type='button' class='btn btn-primary' onclick='totprice()'>Save to Database</button>
      </div>
  </div>
</form>
<td>
</tr>";
echo"
  </tbody>
</table>";

?>
<script>
// function delses(){
//   unset($_SESSION['transport']);
//   }
  function totprice(){
    var fd = new FormData();
    var aa = $("input[name=tpax]").val();
    var seltp = $("input[name=seltp]").val();
    var agent = $("input[name=agent]").val();
   //var bb = document.getElementById("seltp").options[document.getElementById("seltp").selectedIndex].value;
   // var cc = document.getElementById("conv").options[document.getElementById("conv").selectedIndex].value;
//     total= seltp/cc;
//     totalz =Math.ceil(total);

//   var	number_string = totalz.toString(),
// 	sisa 	= number_string.length % 3,
// 	rupiah 	= number_string.substr(0, sisa),
// 	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
// if (ribuan) {
// 	separator = sisa ? '.' : '';
// 	rupiah += separator + ribuan.join('.');
// }
var gb= $("input[name=gb]").val();
   var gk= $("input[name=gk]").val();
   var gt= $("input[name=gt]").val();

   var lb= $("input[name=lb]").val();
   var lk= $("input[name=lk]").val();
   var lt= $("input[name=lt]").val();

   var db= $("input[name=db]").val();
   var dk= $("input[name=dk]").val();
   var dt= $("input[name=dt]").val();

   var hb= $("input[name=hb]").val();
   var hk= $("input[name=hk]").val();
   var hp= $("input[name=hp]").val();
   var ht= $("input[name=ht]").val();
   var htipe= $("input[name=htipe]").val();

   var bb= $("input[name=bb]").val();
   var bk= $("input[name=bk]").val();
   var bt= $("input[name=bt]").val();
   var total_ht=$("input[name=total_ht]").val();
   
   var foc= $("input[name=foc]").val();
   var bonus= $("input[name=bonus]").val();
   var tl= $("input[name=tl]").val();

   var focx= $("input[name=focx]").val();
   var bonusx= $("input[name=bonusx]").val();
   var tlx= $("input[name=tlx]").val();

   var ftipe_room= $("input[name=ftipe_room]").val();
   var btipe_room= $("input[name=btipe_room]").val();
   var ttipe_room= $("input[name=ttipe_room]").val();

fd.append('gb',gb);
fd.append('gk',gk);
fd.append('gt',gt);


fd.append('lb',lb);
fd.append('lk',lk);
fd.append('lt',lt);


fd.append('db',db);
fd.append('dk',dk);
fd.append('dt',dt);


fd.append('hb',hb);
fd.append('hk',hk);
fd.append('ht',ht);
fd.append('hp',hp);
fd.append('htipe',htipe);

fd.append('bb',bb);
fd.append('bk',bk);
fd.append('bt',bt);


fd.append('tpax',aa);
fd.append('seltp',seltp);
fd.append('agent',agent);
fd.append('total_ht',total_ht);

fd.append('foc',foc);
fd.append('bonus',bonus);
fd.append('tl',tl);

fd.append('focx',focx);
fd.append('bonusx',bonusx);
fd.append('tlx',tlx);

fd.append('ftipe_room',ftipe_room);
fd.append('btipe_room',btipe_room);
fd.append('ttipe_room',ttipe_room);
//fd.append('cc',cc);
alert(agent);
    //var total = document.getElementById("tprice").value;
   // document.getElementById("tprice").value =rupiah;   
    $.ajax({
            url: 'insert_hotelquo.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
            alert("data berhasil di simpan");
            reloadTransport(4,0,0);
            }
                 }); 
  }
</script>