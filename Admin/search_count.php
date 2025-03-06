<?php
include "../site.php";
include "../db=connection.php";
////////////////////////////////
$search= $_POST['total'];
$search2= $_POST['total2'];
$search3= $_POST['total3'];
$search4= $_POST['total4'];
$search5= $_POST['total5'];
$search6= $_POST['total6'];
$search7= $_POST['total7'];
$search8= $_POST['total8'];
$search9= $_POST['total9'];
$search10= $_POST['total10'];
$search11= $_POST['total11'];
$search12= $_POST['total12'];
$search13= $_POST['total13'];
$search14= $_POST['total14'];
$search15= $_POST['total15'];
$search16= $_POST['total16'];
$search17= $_POST['total17'];
$search18= $_POST['total18'];
$search19= $_POST['total19'];
$search20= $_POST['total20'];
/////////////////////////////
$searchb= $_POST['totalb'];
$searchb2= $_POST['totalb2'];
$searchb3= $_POST['totalb3'];
$searchb4= $_POST['totalb4'];
$searchb5= $_POST['totalb5'];
$searchb6= $_POST['totalb6'];
$searchb7= $_POST['totalb7'];
$searchb8= $_POST['totalb8'];
$searchb9= $_POST['totalb9'];
$searchb10= $_POST['totalb10'];
$searchb11= $_POST['totalb11'];
$searchb12= $_POST['totalb12'];
$searchb13= $_POST['totalb13'];
$searchb14= $_POST['totalb14'];
$searchb15= $_POST['totalb15'];
$searchb16= $_POST['totalb16'];
$searchb17= $_POST['totalb17'];
$searchb18= $_POST['totalb18'];
$searchb19= $_POST['totalb19'];
$searchb20= $_POST['totalb20'];
////////////////////////////////
$searchc= $_POST['totalc'];
$searchc2= $_POST['totalc2'];
$searchc3= $_POST['totalc3'];
$searchc4= $_POST['totalc4'];
$searchc5= $_POST['totalc5'];
$searchc6= $_POST['totalc6'];
$searchc7= $_POST['totalc7'];
$searchc8= $_POST['totalc8'];
$searchc9= $_POST['totalc9'];
$searchc10= $_POST['totalc10'];
$searchc11= $_POST['totalc11'];
$searchc12= $_POST['totalc12'];
$searchc13= $_POST['totalc13'];
$searchc14= $_POST['totalc14'];
$searchc15= $_POST['totalc15'];
$searchc16= $_POST['totalc16'];
$searchc17= $_POST['totalc17'];
$searchc18= $_POST['totalc18'];
$searchc19= $_POST['totalc19'];
$searchc20= $_POST['totalc20'];
////////////////////////////////
$searchd= $_POST['totald'];
$searchd2= $_POST['totald2'];
$searchd3= $_POST['totald3'];
$searchd4= $_POST['totald4'];
$searchd5= $_POST['totald5'];
$searchd6= $_POST['totald6'];
$searchd7= $_POST['totald7'];
$searchd8= $_POST['totald8'];
$searchd9= $_POST['totald9'];
$searchd10= $_POST['totald10'];
$searchd11= $_POST['totald11'];
$searchd12= $_POST['totald12'];
$searchd13= $_POST['totald13'];
$searchd14= $_POST['totald14'];
$searchd15= $_POST['totald15'];
$searchd16= $_POST['totald16'];
$searchd17= $_POST['totald17'];
$searchd18= $_POST['totald18'];
$searchd19= $_POST['totald19'];
$searchd20= $_POST['totald20'];
////////////////////////////////
$searche= $_POST['totale'];
$searche2= $_POST['totale2'];
$searche3= $_POST['totale3'];
$searche4= $_POST['totale4'];
$searche5= $_POST['totale5'];
$searche6= $_POST['totale6'];
$searche7= $_POST['totale7'];
$searche8= $_POST['totale8'];
$searche9= $_POST['totale9'];
$searche10= $_POST['totale10'];
$searche11= $_POST['totale11'];
$searche12= $_POST['totale12'];
$searche13= $_POST['totale13'];
$searche14= $_POST['totale14'];
$searche15= $_POST['totale15'];
$searche16= $_POST['totale16'];
$searche17= $_POST['totale17'];
$searche18= $_POST['totale18'];
$searche19= $_POST['totale19'];
$searche20= $_POST['totale20'];
////////////////////////////////
$searchf= $_POST['totalf'];
$searchf2= $_POST['totalf2'];
$searchf3= $_POST['totalf3'];
$searchf4= $_POST['totalf4'];
$searchf5= $_POST['totalf5'];
$searchf6= $_POST['totalf6'];
$searchf7= $_POST['totalf7'];
$searchf8= $_POST['totalf8'];
$searchf9= $_POST['totalf9'];
$searchf10= $_POST['totalf10'];
$searchf11= $_POST['totalf11'];
$searchf12= $_POST['totalf12'];
$searchf13= $_POST['totalf13'];
$searchf14= $_POST['totalf14'];
$searchf15= $_POST['totalf15'];
$searchf16= $_POST['totalf16'];
$searchf17= $_POST['totalf17'];
$searchf18= $_POST['totalf18'];
$searchf19= $_POST['totalf19'];
$searchf20= $_POST['totalf20'];
////////////////////////////////
$thari= $_POST['t'];
$tr ="1";
//var_dump($searchb);

    echo"<table class='table table-sm table-bordered'>
    </tbody>
    <thead>
    <tr bgcolor='#A9CCE3 '>
      <th scope='col-2' >Car</th>
      <th scope='col-2'>Alpard</th>
      <th scope='col-2'>Mini Van</th>
      <th scope='col-2'>Mini Bus / Hi Ace</th>
      <th scope='col-2'>Coaster</th>
      <th scope='col-2'>Bus</th>
    </tr>
  </thead>
  <tbody>";
//for ($x = 1; $x <= $thari; $x++ ){
 //   echo"<tr> DAy 1</tr>";
 echo"<tr><td colspan='6'  align='center'><b>DAY 1</b></td></tr>";  
 echo"<tr>";
 $arr=$search.$searchb.$searchc.$searchd.$searche.$searchf;
 $data = explode(";" ,$arr);
 $arrb=$search2.$searchb2.$searchc2.$searchd2.$searche2.$searchf2;
 $datab = explode(";" ,$arrb);
 $arrc=$search3.$searchb3.$searchc3.$searchd3.$searche3.$searchf3;
 $datac = explode(";" ,$arrc);
 $arrd=$search4.$searchb4.$searchc4.$searchd4.$searche4.$searchf4;
 $datad = explode(";" ,$arrd);
 $arre=$search5.$searchb5.$searchc5.$searchd5.$searche5.$searchf5;
 $datae = explode(";" ,$arre);
 $arrf=$search6.$searchb6.$searchc6.$searchd6.$searche6.$searchf6;
 $dataf = explode(";" ,$arrf);
 $arrg=$search7.$searchb7.$searchc7.$searchd7.$searche7.$searchf7;
 $datag = explode(";" ,$arrg);
 $arrh=$search8.$searchb8.$searchc8.$searchd8.$searche8.$searchf8;
 $datah = explode(";" ,$arrh);
 $arri=$search9.$searchb9.$searchc9.$searchd9.$searche9.$searchf9;
 $datai = explode(";" ,$arri);
 $arrj=$search10.$searchb10.$searchc10.$searchd10.$searche10.$searchf10;
 $dataj = explode(";" ,$arrj);
 $arrk=$search11.$searchb11.$searchc11.$searchd11.$searche11.$searchf11;
 $datak = explode(";" ,$arrk);
 $arrl=$search12.$searchb12.$searchc12.$searchd12.$searche12.$searchf12;
 $datal = explode(";" ,$arrl);
 $arrm=$search13.$searchb13.$searchc13.$searchd13.$searche13.$searchf13;
 $datam = explode(";" ,$arrm);
 $arrn=$search14.$searchb14.$searchc14.$searchd13.$searche13.$searchf13;
 $datan = explode(";" ,$arrn);
 $arro=$search15.$searchb15.$searchc15.$searchd15.$searche15.$searchf15;
 $datao = explode(";" ,$arro);
 $arrp=$search16.$searchb16.$searchc16.$searchd16.$searche16.$searchf16;
 $datap = explode(";" ,$arrp);
 $arrq=$search17.$searchb17.$searchc17.$searchd17.$searche17.$searchf17;
 $dataq = explode(";" ,$arrq);
 $arrr=$search18.$searchb18.$searchc18.$searchd18.$searche18.$searchf18;
 $datar = explode(";" ,$arrr);
 $arrs=$search19.$searchb19.$searchc19.$searchd19.$searche19.$searchf19;
 $datas = explode(";" ,$arrs);
 $arrt=$search20.$searchb20.$searchc20.$search20.$searche20.$searchf20;
 $datat = explode(";" ,$arrt);

   //// day 1
   $jml=0;
   $jmlal=0;
   $jmlmv=0;
   $jmlmb=0;
   $jmlcs=0;
   $jmlbs=0;

// $datax= implode(";",$arr);
var_dump($arr);
for($i=0; $i < count($data); $i++) {
   //echo "<br/>";
   $data2 = explode("," ,$data[$i]);

   $a=$data2[0];
   $b=$data2[1];
   $c=$data2[2];
   $d=$data2[3];
   $e=$data2[4];
   $tr ="1";
   //var_dump($data2);
   $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$e." AND transport_type=".$d;
   $rs=mysqli_query($con,$query);
   var_dump($query);
   while($row = mysqli_fetch_array($rs)){
   $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
   $rsrenc=mysqli_query($con,$queryrenc);
   $rowrenc = mysqli_fetch_array($rsrenc);

   $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
   $rskursc=mysqli_query($con,$querykursc);
   $rowkursc = mysqli_fetch_array($rskursc);
   $kurs= $rowkursc['name'];
   $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
   $rskonv=mysqli_query($con,$querykonv);
   $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  // echo $harga ;
   //echo $query ;
   //echo "<br/>";

   echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
  
   if ($row['transport_type']== 1) {
      $jmb= $harga ;
      $jml=$jml+$jmb;
   }
   else if ($row['transport_type']== 2) {
    $jmbal= $harga;
    $jmlal=$jmlal+$jmbal;
  }
  else if ($row['transport_type']== 3) {
    $jmbmv= $harga;
    $jmlmv=$jmlmv+$jmbmv;
  }
  else if ($row['transport_type']== 4) {
    $jmbmb= $harga;
    $jmlmb=$jmlmb+$jmbmb;
  }
  else if ($row['transport_type']== 6) {
    $jmbcs= $harga;
    $jmlcs=$jmlcs+$jmbcs;
  }
  else if ($row['transport_type']== 7) {
    $jmbbs= $harga;
    $jmlbs=$jmlbs+$jmbbs;
  }
  
  
   }
   echo"</tr>"; 
   }

  // echo $jmlal;
   echo"<tr>
  <td>jumlah : Rp.".number_format($jml, 0, ".", ".")."</td>
  <td>jumlah:  Rp.".number_format($jmlal, 0, ".", ".")."</td>
  <td>jumlah : Rp.".number_format($jmlmv, 0, ".", ".")."</td>
  <td>jumlah : Rp.".number_format($jmlmb, 0, ".", ".")."</td>
  <td>jumlah : Rp.".number_format($jmlcs, 0, ".", ".")."</td>
  <td>jumlah : Rp.".number_format($jmlbs, 0, ".", ".")."</td>
</tr>";
if($thari >= 2)
{
   echo"<tr><td colspan='6'  align='center'><b>DAY 2</b></td></tr>";  
   
  ////// day 2
  $jml2=0;
  $jmlal2=0;
  $jmlmv2=0;
  $jmlmb2=0;
  $jmlcs2=0;
  $jmlbs2=0;
   for($i=0; $i < count($datab); $i++){

    //echo "<br/>";
    $data2 = explode("," ,$datab[$i]);
    $a=$data2[0];
    $b=$data2[1];
    $c=$data2[2];
    $d=$data2[3];
    $day=$data2[4];
    $tr ="1";
    
    $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
    $rs=mysqli_query($con,$query);
    while($row = mysqli_fetch_array($rs)){
    $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
    $rsrenc=mysqli_query($con,$queryrenc);
    $rowrenc = mysqli_fetch_array($rsrenc);
 
    $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
    $rskursc=mysqli_query($con,$querykursc);
    $rowkursc = mysqli_fetch_array($rskursc);

    $kurs= $rowkursc['name'];
    $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
    $rskonv=mysqli_query($con,$querykonv);
    $rowkonv = mysqli_fetch_array($rskonv);
     $harga= $row['harga'] * $rowkonv['jual'];
     $harga=round($harga ,0);
    //echo $query ;
    //echo "<br/>";
    echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
    if ($row['transport_type']== 1) {
      $jmb2= $harga;
      $jml2=$jml2+$jmb2;
   }
   else if ($row['transport_type']== 2) {
    $jmbal2= $harga;
    $jmlal2=$jmlal2+$jmbal2;
  }
  else if ($row['transport_type']== 3) {
    $jmbmv2= $harga;
    $jmlmv2=$jmlmv2+$jmbmv2;
  }
  else if ($row['transport_type']== 4) {
    $jmbmb2= $harga;
    $jmlmb2=$jmlmb2+$jmbmb2;
  }
  else if ($row['transport_type']== 6) {
    $jmbcs2= $harga;
    $jmlcs2=$jmlcs2+$jmbcs2;
  }
  else if ($row['transport_type']== 7) {
    $jmbbs2= $harga;
    $jmlbs2=$jmlbs2+$jmbbs2;
  }

    }
    echo"</tr>"; 
   // echo"<tr><td>day : ".$day."</td></tr>";  
    }
    echo"<tr>
    <td>jumlah : Rp.".number_format($jml2, 0, ".", ".")."</td>
    <td>jumlah:  Rp.".number_format($jmlal2, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlmv2, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlmb2, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlcs2, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlbs2, 0, ".", ".")."</td>
  </tr>";
  }
if($thari >= 3)
  {
  echo"<tr><td colspan='6'  align='center'><b>DAY 3</b></td></tr>"; 
    ////// day 3
    $jml3=0;
    $jmlal3=0;
    $jmlmv3=0;
    $jmlmb3=0;
    $jmlcs3=0;
    $jmlbs3=0; 
  for($i=0; $i < count($datac); $i++){

    //echo "<br/>";
    $data2 = explode("," ,$datac[$i]);
    $a=$data2[0];
    $b=$data2[1];
    $c=$data2[2];
    $d=$data2[3];
    $day=$data2[4];
    $tr ="1";
    
    $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
    $rs=mysqli_query($con,$query);
    while($row = mysqli_fetch_array($rs)){
    $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
    $rsrenc=mysqli_query($con,$queryrenc);
    $rowrenc = mysqli_fetch_array($rsrenc);
 
    $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
    $rskursc=mysqli_query($con,$querykursc);
    $rowkursc = mysqli_fetch_array($rskursc);

    $kurs= $rowkursc['name'];
    $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
    $rskonv=mysqli_query($con,$querykonv);
    $rowkonv = mysqli_fetch_array($rskonv);
     $harga= $row['harga'] * $rowkonv['jual'];
     $harga=round($harga ,0);
    //echo $query ;
    //echo "<br/>";
    echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
    if ($row['transport_type']== 1) {
      $jmb3= $harga;
      $jml3=$jml3+$jmb3;
   }
   else if ($row['transport_type']== 2) {
    $jmbal3= $harga;
    $jmlal3=$jmlal3+$jmbal3;
  }
  else if ($row['transport_type']== 3) {
    $jmbmv3= $harga;
    $jmlmv3=$jmlmv3+$jmbmv3;
  }
  else if ($row['transport_type']== 4) {
    $jmbmb3= $harga;
    $jmlmb3=$jmlmb3+$jmbmb3;
  }
  else if ($row['transport_type']== 6) {
    $jmbcs3= $harga;
    $jmlcs3=$jmlcs3+$jmbcs3;
  }
  else if ($row['transport_type']== 7) {
    $jmbbs3= $harga;
    $jmlbs3=$jmlbs3+$jmbbs3;
  }
    }
    echo"</tr>"; 
   // echo"<tr><td>day : ".$day."</td></tr>";  
    }
    echo"<tr>
    <td>jumlah : Rp.".number_format($jml3, 0, ".", ".")."</td>
    <td>jumlah:  Rp.".number_format($jmlal3, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlmv3, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlmb3, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlcs3, 0, ".", ".")."</td>
    <td>jumlah : Rp.".number_format($jmlbs3, 0, ".", ".")."</td>
  </tr>";
  }
if($thari >= 4)
  { 
    echo"<tr><td colspan='6'  align='center'><b>DAY 4</b></td></tr>";
    ////// day 4
    $jml4=0;
    $jmlal4=0;
    $jmlmv4=0;
    $jmlmb4=0;
    $jmlcs4=0;
    $jmlbs4=0;  
    for($i=0; $i < count($datad); $i++){
  
      //echo "<br/>";
      $data2 = explode("," ,$datad[$i]);
      $a=$data2[0];
      $b=$data2[1];
      $c=$data2[2];
      $d=$data2[3];
      $day=$data2[4];
      $tr ="1";
      
      $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
      $rs=mysqli_query($con,$query);
      while($row = mysqli_fetch_array($rs)){
      $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
      $rsrenc=mysqli_query($con,$queryrenc);
      $rowrenc = mysqli_fetch_array($rsrenc);
   
      $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
      $rskursc=mysqli_query($con,$querykursc);
      $rowkursc = mysqli_fetch_array($rskursc);

      $kurs= $rowkursc['name'];
      $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
      $rskonv=mysqli_query($con,$querykonv);
      $rowkonv = mysqli_fetch_array($rskonv);
       $harga= $row['harga'] * $rowkonv['jual'];
       $harga=round($harga ,0);
      //echo $query ;
      //echo "<br/>";
      echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
        $jmb4=$harga;
        $jml4=$jml4+$jmb4;
     }
     else if ($row['transport_type']== 2) {
      $jmbal4= $harga;
      $jmlal4=$jmlal4+$jmbal4;
    }
    else if ($row['transport_type']== 3) {
      $jmbmv4= $harga;
      $jmlmv4=$jmlmv4+$jmbmv4;
    }
    else if ($row['transport_type']== 4) {
      $jmbmb4= $harga;
      $jmlmb4=$jmlmb4+$jmbmb4;
    }
    else if ($row['transport_type']== 6) {
      $jmbcs4= $harga;
      $jmlcs4=$jmlcs4+$jmbcs4;
    }
    else if ($row['transport_type']== 7) {
      $jmbbs4= $harga;
      $jmlbs4=$jmlbs4+$jmbbs4;
    }
      }
      echo"</tr>"; 
     // echo"<tr><td>day : ".$day."</td></tr>";  
      }
      echo"<tr>
      <td>jumlah : Rp.".number_format($jml4, 0, ".", ".")."</td>
      <td>jumlah:  Rp.".number_format($jmlal4, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlmv4, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlmb4, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlcs4, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlbs4, 0, ".", ".")."</td>
    </tr>";
    }
if($thari >= 5)
{ 
      echo"<tr><td colspan='6'  align='center'><b>DAY 5</b></td></tr>";
    ////// day 5
    $jml5=0;
    $jmlal5=0;
    $jmlmv5=0;
    $jmlmb5=0;
    $jmlcs5=0;
    $jmlbs5=0; 
      for($i=0; $i < count($datae); $i++){
    
        //echo "<br/>";
        $data2 = explode("," ,$datae[$i]);
        $a=$data2[0];
        $b=$data2[1];
        $c=$data2[2];
        $d=$data2[3];
        $day=$data2[4];
        $tr ="1";
        
        $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
        $rs=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($rs)){
        $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
        $rsrenc=mysqli_query($con,$queryrenc);
        $rowrenc = mysqli_fetch_array($rsrenc);
     
        $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
        $rskursc=mysqli_query($con,$querykursc);
        $rowkursc = mysqli_fetch_array($rskursc);

        $kurs= $rowkursc['name'];
        $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
        $rskonv=mysqli_query($con,$querykonv);
        $rowkonv = mysqli_fetch_array($rskonv);
         $harga= $row['harga'] * $rowkonv['jual'];
         $harga=round($harga ,0);
        //echo $query ;
        //echo "<br/>";
        echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb5= $harga;
          $jml5=$jml5+$jmb5;
       }
       else if ($row['transport_type']== 2) {
        $jmbal5= $harga;
        $jmlal5=$jmlal5+$jmbal5;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv5= $harga;
        $jmlmv5=$jmlmv5+$jmbmv5;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb5= $harga;
        $jmlmb5=$jmlmb5+$jmbmb5;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs5= $harga;
        $jmlcs5=$jmlcs5+$jmbcs5;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs5= $harga;
        $jmlbs5=$jmlbs5+$jmbbs5;
      }
        }
        echo"</tr>"; 
       // echo"<tr><td>day : ".$day."</td></tr>";  
        }
      echo"<tr>
      <td>jumlah : Rp.".number_format($jml5, 0, ".", ".")."</td>
      <td>jumlah:  Rp.".number_format($jmlal5, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlmv5, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlmb5, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlcs5, 0, ".", ".")."</td>
      <td>jumlah : Rp.".number_format($jmlbs5, 0, ".", ".")."</td>
    </tr>";
      }
if($thari >= 6)
{ 
        echo"<tr><td colspan='6'  align='center'><b>DAY 6</b></td></tr>";
    ////// day 3
    $jml6=0;
    $jmlal6=0;
    $jmlmv6=0;
    $jmlmb6=0;
    $jmlcs6=0;
    $jmlbs6=0;  
        for($i=0; $i < count($dataf); $i++){
      
          //echo "<br/>";
          $data2 = explode("," ,$dataf[$i]);
          $a=$data2[0];
          $b=$data2[1];
          $c=$data2[2];
          $d=$data2[3];
          $day=$data2[4];
          $tr ="1";
          
          $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
          $rs=mysqli_query($con,$query);
          while($row = mysqli_fetch_array($rs)){
          $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
          $rsrenc=mysqli_query($con,$queryrenc);
          $rowrenc = mysqli_fetch_array($rsrenc);
       
          $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
          $rskursc=mysqli_query($con,$querykursc);
          $rowkursc = mysqli_fetch_array($rskursc);

          $kurs= $rowkursc['name'];
          $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
          $rskonv=mysqli_query($con,$querykonv);
          $rowkonv = mysqli_fetch_array($rskonv);
           $harga= $row['harga'] * $rowkonv['jual'];
           $harga=round($harga ,0);
          //echo $query ;
          //echo "<br/>";
          echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
          if ($row['transport_type']== 1) {
            $jmb6= $row['harga'];
            $jml6=$jml6+$jmb6;
         }
         else if ($row['transport_type']== 2) {
          $jmbal6= $row['harga'];
          $jmlal6=$jmlal6+$jmbal6;
        }
        else if ($row['transport_type']== 3) {
          $jmbmv6= $row['harga'];
          $jmlmv6=$jmlmv6+$jmbmv6;
        }
        else if ($row['transport_type']== 4) {
          $jmbmb6= $row['harga'];
          $jmlmb6=$jmlmb6+$jmbmb6;
        }
        else if ($row['transport_type']== 6) {
          $jmbcs6= $row['harga'];
          $jmlcs6=$jmlcs6+$jmbcs6;
        }
        else if ($row['transport_type']== 7) {
          $jmbbs6= $row['harga'];
          $jmlbs6=$jmlbs6+$jmbbs6;
        }
          }
          echo"</tr>"; 
         // echo"<tr><td>day : ".$day."</td></tr>";  
          }
          echo"<tr>
          <td>jumlah : Rp.".number_format($jml6, 0, ".", ".")."</td>
          <td>jumlah:  Rp.".number_format($jmlal6, 0, ".", ".")."</td>
          <td>jumlah : Rp.".number_format($jmlmv6, 0, ".", ".")."</td>
          <td>jumlah : Rp.".number_format($jmlmb6, 0, ".", ".")."</td>
          <td>jumlah : Rp.".number_format($jmlcs6, 0, ".", ".")."</td>
          <td>jumlah : Rp.".number_format($jmlbs6, 0, ".", ".")."</td>
        </tr>";
        }
if($thari >= 7)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 7</b></td></tr>";
////// day 3
$jml7=0;
$jmlal7=0;
$jmlmv7=0;
$jmlmb7=0;
$jmlcs7=0;
$jmlbs7=0;  
for($i=0; $i < count($datag); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datag[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb7= $harga;
          $jml7=$jml7+$jmb7;
        }
        else if ($row['transport_type']== 2) {
        $jmbal7= $harga;
        $jmlal7=$jmlal7+$jmbal7;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv7= $harga;
        $jmlmv7=$jmlmv7+$jmbmv7;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb7= $harga;
        $jmlmb7=$jmlmb7+$jmbmb7;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs7= $harga;
        $jmlcs7=$jmlcs7+$jmbcs7;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs7= $harga;
        $jmlbs7=$jmlbs7+$jmbbs7;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml7, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal7, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv7, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb7, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs7, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs7, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 8)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 8</b></td></tr>";
////// day 3
$jml8=0;
$jmlal8=0;
$jmlmv8=0;
$jmlmb8=0;
$jmlcs8=0;
$jmlbs8=0;  
for($i=0; $i < count($datah); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datah[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb8= $row['harga'];
          $jml8=$jml8+$jmb8;
        }
        else if ($row['transport_type']== 2) {
        $jmbal8= $harga;
        $jmlal8=$jmlal8+$jmbal8;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv8= $harga;
        $jmlmv8=$jmlmv8+$jmbmv8;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb8= $harga;
        $jmlmb8=$jmlmb8+$jmbmb8;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs8= $harga;
        $jmlcs8=$jmlcs8+$jmbcs8;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs8= $harga;
        $jmlbs8=$jmlbs8+$jmbbs8;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml8, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal8, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv8, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb8, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs8, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs8, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 9)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 9</b></td></tr>";
////// day 3
$jml9=0;
$jmlal9=0;
$jmlmv9=0;
$jmlmb9=0;
$jmlcs9=0;
$jmlbs9=0;  
for($i=0; $i < count($datai); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datai[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb9= $harga;
          $jml9=$jml9+$jmb9;
        }
        else if ($row['transport_type']== 2) {
        $jmbal9= $harga;
        $jmlal9=$jmlal9+$jmbal9;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv9= $harga;
        $jmlmv9=$jmlmv9+$jmbmv9;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb9= $harga;
        $jmlmb9=$jmlmb9+$jmbmb9;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs9= $harga;
        $jmlcs9=$jmlcs9+$jmbcs9;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs9= $harga;
        $jmlbs9=$jmlbs9+$jmbbs9;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml9, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal9, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv9, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb9, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs9, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs9, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 10)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 10</b></td></tr>";
////// day 3
$jml10=0;
$jmlal10=0;
$jmlmv10=0;
$jmlmb10=0;
$jmlcs10=0;
$jmlbs10=0;  
for($i=0; $i < count($dataj); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$dataj[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb10= $harga;
          $jml10=$jml10+$jmb10;
        }
        else if ($row['transport_type']== 2) {
        $jmbal10= $harga;
        $jmlal10=$jmlal10+$jmbal10;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv10= $harga;
        $jmlmv10=$jmlmv10+$jmbmv10;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb10= $harga;
        $jmlmb10=$jmlmb10+$jmbmb10;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs10= $harga;
        $jmlcs10=$jmlcs10+$jmbcs10;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs10= $harga;
        $jmlbs10=$jmlbs10+$jmbbs10;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml10, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal0, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv10, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb10, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs10, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs10, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 11)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 11</b></td></tr>";
////// day 3
$jml11=0;
$jmlal11=0;
$jmlmv11=0;
$jmlmb11=0;
$jmlcs11=0;
$jmlbs11=0;  
for($i=0; $i < count($datak); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datak[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb11= $harga;
          $jml11=$jml11+$jmb11;
        }
        else if ($row['transport_type']== 2) {
        $jmbal11= $harga;
        $jmlal11=$jmlal11+$jmbal11;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv11= $harga;
        $jmlmv11=$jmlmv11+$jmbmv11;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb11= $harga;
        $jmlmb11=$jmlmb11+$jmbmb11;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs11= $harga;
        $jmlcs11=$jmlcs11+$jmbcs11;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs11= $harga;
        $jmlbs11=$jmlbs11+$jmbbs11;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml11, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal11, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv11, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb11, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs11, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs11, 0, ".", ".")."</td>
      </tr>";
}         
if($thari >= 12)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 12</b></td></tr>";
////// day 3
$jml12=0;
$jmlal12=0;
$jmlmv12=0;
$jmlmb12=0;
$jmlcs12=0;
$jmlbs12=0;  
for($i=0; $i < count($datal); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datal[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb12= $harga;
          $jml12=$jml12+$jmb12;
        }
        else if ($row['transport_type']== 2) {
        $jmbal12= $harga;
        $jmlal12=$jmlal12+$jmbal12;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv12= $harga;
        $jmlmv12=$jmlmv12+$jmbmv12;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb12= $harga;
        $jmlmb12=$jmlmb12+$jmbmb12;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs12= $harga;
        $jmlcs12=$jmlcs12+$jmbcs12;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs12= $harga;
        $jmlbs12=$jmlbs12+$jmbbs12;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml12, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal12, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv12, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb12, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs12, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs12, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 13)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 13</b></td></tr>";
////// day 3
$jml13=0;
$jmlal13=0;
$jmlmv13=0;
$jmlmb13=0;
$jmlcs13=0;
$jmlbs13=0;  
for($i=0; $i < count($datam); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datam[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb13= $harga;
          $jml13=$jml13+$jmb13;
        }
        else if ($row['transport_type']== 2) {
        $jmbal13= $harga;
        $jmlal13=$jmlal13+$jmbal13;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv13= $harga;
        $jmlmv13=$jmlmv13+$jmbmv13;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb13= $harga;
        $jmlmb13=$jmlmb13+$jmbmb13;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs13= $harga;
        $jmlcs13=$jmlcs13+$jmbcs13;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs13= $harga;
        $jmlbs13=$jmlbs13+$jmbbs13;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml13, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal13, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv13, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb13, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs13, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs13, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 14)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 14</b></td></tr>";
////// day 3
$jml14=0;
$jmlal14=0;
$jmlmv14=0;
$jmlmb14=0;
$jmlcs14=0;
$jmlbs14=0;  
for($i=0; $i < count($datan); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datan[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb14= $harga;
          $jml14=$jml14+$jmb14;
        }
        else if ($row['transport_type']== 2) {
        $jmbal14= $harga;
        $jmlal14=$jmlal14+$jmbal14;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv14= $harga;
        $jmlmv14=$jmlmv14+$jmbmv14;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb14= $harga;
        $jmlmb14=$jmlmb14+$jmbmb14;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs14= $harga;
        $jmlcs14=$jmlcs14+$jmbcs14;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs14= $harga;
        $jmlbs14=$jmlbs14+$jmbbs14;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml14, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal14, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv14, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb14, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs14, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs14, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 15)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 15</b></td></tr>";
////// day 3
$jml15=0;
$jmlal15=0;
$jmlmv15=0;
$jmlmb15=0;
$jmlcs15=0;
$jmlbs15=0;  
for($i=0; $i < count($datao); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datao[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb15= $harga;
          $jml15=$jml15+$jmb15;
        }
        else if ($row['transport_type']== 2) {
        $jmbal15= $harga;
        $jmlal15=$jmlal15+$jmbal15;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv15= $harga;
        $jmlmv15=$jmlmv15+$jmbmv15;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb15= $harga;
        $jmlmb15=$jmlmb15+$jmbmb15;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs15= $harga;
        $jmlcs15=$jmlcs15+$jmbcs15;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs15= $harga;
        $jmlbs15=$jmlbs15+$jmbbs15;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml15, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal15, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv15, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb15, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs15, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs15, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 16)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 16</b></td></tr>";
////// day 3
$jml16=0;
$jmlal16=0;
$jmlmv16=0;
$jmlmb16=0;
$jmlcs16=0;
$jmlbs16=0;  
for($i=0; $i < count($datap); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datap[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb16= $harga;
          $jml16=$jml16+$jmb16;
        }
        else if ($row['transport_type']== 2) {
        $jmbal16= $harga;
        $jmlal16=$jmlal16+$jmbal16;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv16= $harga;
        $jmlmv16=$jmlmv16+$jmbmv16;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb16= $harga;
        $jmlmb16=$jmlmb16+$jmbmb16;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs16= $harga;
        $jmlcs16=$jmlcs16+$jmbcs16;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs16= $harga;
        $jmlbs16=$jmlbs16+$jmbbs16;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml16, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal16, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv16, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb16, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs16, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs16, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 17)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 17</b></td></tr>";
////// day 3
$jml17=0;
$jmlal17=0;
$jmlmv17=0;
$jmlmb17=0;
$jmlcs17=0;
$jmlbs17=0;  
for($i=0; $i < count($dataq); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$dataq[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb17= $harga;
          $jml17=$jml17+$jmb17;
        }
        else if ($row['transport_type']== 2) {
        $jmbal17= $harga;
        $jmlal17=$jmlal17+$jmbal17;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv17= $harga;
        $jmlmv17=$jmlmv17+$jmbmv17;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb17= $harga;
        $jmlmb17=$jmlmb17+$jmbmb17;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs17= $harga;
        $jmlcs17=$jmlcs17+$jmbcs17;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs17= $harga;
        $jmlbs17=$jmlbs17+$jmbbs17;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml17, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal17, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv17, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb17, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs17, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs17, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 18)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 18</b></td></tr>";
////// day 3
$jml18=0;
$jmlal18=0;
$jmlmv18=0;
$jmlmb18=0;
$jmlcs18=0;
$jmlbs18=0;  
for($i=0; $i < count($datar); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datar[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb18= $harga;
          $jml18=$jml18+$jmb18;
        }
        else if ($row['transport_type']== 2) {
        $jmbal18= $harga;
        $jmlal18=$jmlal18+$jmbal18;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv18= $harga;
        $jmlmv18=$jmlmv18+$jmbmv18;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb18= $harga;
        $jmlmb18=$jmlmb18+$jmbmb18;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs18= $harga;
        $jmlcs18=$jmlcs18+$jmbcs18;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs18= $harga;
        $jmlbs18=$jmlbs18+$jmbbs18;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml18, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal18, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv18, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb18, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs18, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs18, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 19)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 19</b></td></tr>";
////// day 3
$jml19=0;
$jmlal19=0;
$jmlmv19=0;
$jmlmb19=0;
$jmlcs19=0;
$jmlbs19=0;  
for($i=0; $i < count($datas); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datas[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);

  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);
  //echo $query ;
  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb19= $harga;
          $jml19=$jml19+$jmb19;
        }
        else if ($row['transport_type']== 2) {
        $jmbal19= $harga;
        $jmlal19=$jmlal19+$jmbal19;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv19= $harga;
        $jmlmv19=$jmlmv19+$jmbmv19;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb19= $harga;
        $jmlmb19=$jmlmb19+$jmbmb19;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs19= $harga;
        $jmlcs19=$jmlcs19+$jmbcs19;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs19= $harga;
        $jmlbs19=$jmlbs19+$jmbbs19;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml19, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal19, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv19, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb19, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs19, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs19, 0, ".", ".")."</td>
      </tr>";
}
if($thari >= 20)
{
echo"<tr><td colspan='6'  align='center'><b>DAY 20</b></td></tr>";
////// day 3
$jml20=0;
$jmlal20=0;
$jmlmv20=0;
$jmlmb20=0;
$jmlcs20=0;
$jmlbs20=0;  
for($i=0; $i < count($datat); $i++){

  //echo "<br/>";
  $data2 = explode("," ,$datat[$i]);
  $a=$data2[0];
  $b=$data2[1];
  $c=$data2[2];
  $d=$data2[3];
  $day=$data2[4];
  $tr ="1";
  
  $query = "SELECT * FROM transport WHERE agent=".$a." AND city=".$b." AND  periode=".$c." AND rentype=".$d." order by transport_type";
  $rs=mysqli_query($con,$query);
  while($row = mysqli_fetch_array($rs)){
  $queryrenc = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
  $rsrenc=mysqli_query($con,$queryrenc);
  $rowrenc = mysqli_fetch_array($rsrenc);

  $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
  $rskursc=mysqli_query($con,$querykursc);
  $rowkursc = mysqli_fetch_array($rskursc);
  $kurs= $rowkursc['name'];
  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs%'";
  $rskonv=mysqli_query($con,$querykonv);
  $rowkonv = mysqli_fetch_array($rskonv);
   $harga= $row['harga'] * $rowkonv['jual'];
   $harga=round($harga ,0);

  //echo "<br/>";
  echo "<td><b>Kode Agent : &nbsp;".$a."</b></br>".$rowrenc['nama'].":</br> &nbsp;Rp.".number_format($harga, 0, ".", ".")."</td>";
      if ($row['transport_type']== 1) {
          $jmb20= $harga;
          $jml20=$jml20+$jmb20;
        }
        else if ($row['transport_type']== 2) {
        $jmbal20= $harga;
        $jmlal20=$jmlal20+$jmbal20;
      }
      else if ($row['transport_type']== 3) {
        $jmbmv20= $harga;
        $jmlmv20=$jmlmv20+$jmbmv20;
      }
      else if ($row['transport_type']== 4) {
        $jmbmb20= $harga;
        $jmlmb20=$jmlmb20+$jmbmb20;
      }
      else if ($row['transport_type']== 6) {
        $jmbcs20= $harga;
        $jmlcs20=$jmlcs20+$jmbcs20;
      }
      else if ($row['transport_type']== 7) {
        $jmbbs20= $harga;
        $jmlbs20=$jmlbs20+$jmbbs20;
      }
        }
        echo"</tr>"; 
        // echo"<tr><td>day : ".$day."</td></tr>";  
        }
        echo"<tr>
        <td>jumlah : Rp.".number_format($jml20, 0, ".", ".")."</td>
        <td>jumlah:  Rp.".number_format($jmlal20, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmv20, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlmb20, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlcs20, 0, ".", ".")."</td>
        <td>jumlah : Rp.".number_format($jmlbs20, 0, ".", ".")."</td>
      </tr>";
}
             
 ////////////////////////////////////////////////end//////////////////////////////
 $grandcr=$jml+$jml2+$jml3+$jml4+$jml5+$jml6+$jml7+$jml8+$jml9+$jml10+$jml11+$jml12+$jml13+$jml14+$jml15+$jml16+$jml17+$jml18+$jml19+$jml20;
 $grandal=$jmlal+$jmlal2+$jmlal3+$jmlal4+$jmlal5+$jmlal6+$jmlal7+$jmlal8+$jmlal9+$jmlal10+$jmlal11+$jmlal12+$jmlal13+$jmlal14+$jmlal15+$jmlal16+$jmlal17+$jmlal18+$jmlal19+$jmlal20;
 $grandmv=$jmlmv+$jmlmv2+$jmlmv3+$jmlmv4+$jmlmv5+$jmlmv6+$jmlmv7+$jmlmv8+$jmlmv9+$jmlmv10+$jmlmv11+$jmlmv12+$jmlmv13+$jmlmv14+$jmlmv15+$jmlmv16+$jmlmv17+$jmlmv18+$jmlmv19+$jmlmv20;
 $grandmb=$jmlmb+$jmlmb2+$jmlmb3+$jmlmb4+$jmlmb5+$jmlmb6+$jmlmb7+$jmlmb8+$jmlmb9+$jmlmb10+$jmlmb11+$jmlmb12+$jmlmb13+$jmlmb14+$jmlmb15+$jmlmb16+$jmlmb17+$jmlmb18+$jmlmb19+$jmlmb20;
 $grandcs=$jmlcs+$jmlcs2+$jmlcs3+$jmlcs4+$jmlcs5+$jmlcs6+$jmlcs7+$jmlcs8+$jmlcs9+$jmlcs10+$jmlcs11+$jmlcs12+$jmlcs13+$jmlcs14+$jmlcs15+$jmlcs16+$jmlcs17+$jmlcs18+$jmlcs19+$jmlcs20;
 $grandbs=$jmlbs+$jmlbs2+$jmlbs3+$jmlbs4+$jmlbs5+$jmlbs6+$jmlbs7+$jmlbs8+$jmlbs9+$jmlbs10+$jmlbs11+$jmlbs12+$jmlbs13+$jmlbs14+$jmlbs15+$jmlbs16+$jmlbs17+$jmlbs18+$jmlbs19+$jmlbs20;
echo"<tr  bgcolor='#A9CCE3 '>
  <td align='center'><b>total : Rp.".number_format($grandcr, 0, ".", ".")."</b></td>
  <td align='center'><b>total : Rp.".number_format($grandal, 0, ".", ".")."</b></td>
  <td align='center'><b>total : Rp.".number_format($grandmv, 0, ".", ".")."</b></td>
  <td align='center'><b>total : Rp.".number_format($grandmb, 0, ".", ".")."</b></td>
  <td align='center'><b>total : Rp.".number_format($grandcs, 0, ".", ".")."</b></td>
  <td align='center'><b>total : Rp.".number_format($grandbs, 0, ".", ".")."</b></td>
</tr>
 </tbody>
  </table>";
  echo"<table class='table table-sm table-bordered'>
  </tbody>
  <thead>
  <tr bgcolor='#A9CCE3 '>
    <th scope='col-2' >Agent 1</th>
    <th scope='col-2'>Agent 2</th>
    <th scope='col-2'>Agent 3</th>
    <th scope='col-2'>Agent 4</th>
    <th scope='col-2'>Agent 5</th>
    <th scope='col-2'>Agent 6</th>
  </tr>
</thead>
<tbody>
</tbody>
</table>";
  echo"
  <div class='form-row'>
  <div class='col-3'>
      <div class='card-body'>
      </div>
  </div>
  <div class='col-9'>
      <div class='card border-primary mb-3'>
          <div class='card-body'>
              <form>
                  <div class='form-row'>
                          <div class='col-sm-2 my-1'>
                                  <input type='text' class='form-control' id='tpax' name='tpax' style='width:100px;' placeholder='Jumlah Pax'>
                          </div>
                          <div class='col-sm-2 my-1'>
                                <select class='custom-select mr-sm-2' id='seltp'>
                                <option selected>Transport Type...</option>
                                <option value='".$grandcr."'>Car</option>
                                <option value='".$grandal."'>Alpahard</option>
                                <option value='".$grandmv."'>Mini Van / HI Ace</option>
                                <option value='".$grandmb."'>Mini Bus</option>
                                <option value='".$grandcs."'>Coaster</option>
                                <option value='".$grandbs."'>Bus</option>
                              </select>
                        </div>
                        <div class='col-sm-2 my-1'>
                            <select class='custom-select mr-sm-2' id='conv'>
                            <option selected value='1'>IDR</option>";
                            $conv = "SELECT * FROM kurs_live";
                            $rsconv=mysqli_query($con,$conv);
                            while($rowconv= mysqli_fetch_array($rsconv)){
                            echo"<option value='".$rowconv['jual']."'>".$rowconv['name']."</option>";
                            }
                            echo $conv;
                            echo"
                            </select>
                        </div>
                        <div class='col-auto my-1'>
                        <button type='button' class='btn btn-primary' onclick='totprice()'>Submit</button>
                        </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
 </div>";
 echo"
 <div class='form-row'>
 <div class='col-3'>
     <div class='card-body'>
         <label>Total Price</label>
     </div>
 </div>
 <div class='col-9'>
     <div class='card border-primary mb-3'>
         <div class='card-body'>
                 <div class='form-row'>
                         <div class='col-sm-2 my-1'>
                                 <input type='text' class='form-control' id='tprice' name='tprice' style='width:700px;'>
                         </div>
                 </div>
         </div>
     </div>
 </div>
</div>";
//var_dump($search);

?>
<script>
  function totprice(){
    var aa = $("input[name=tpax]").val();
    var bb = document.getElementById("seltp").options[document.getElementById("seltp").selectedIndex].value;
    var cc = document.getElementById("conv").options[document.getElementById("conv").selectedIndex].value;
    total= (bb/aa) / cc;
    totalz =Math.ceil(total);

  var	number_string = totalz.toString(),
	sisa 	= number_string.length % 3,
	rupiah 	= number_string.substr(0, sisa),
	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
if (ribuan) {
	separator = sisa ? '.' : '';
	rupiah += separator + ribuan.join('.');
}

    alert(total);
    //var total = document.getElementById("tprice").value;
    document.getElementById("tprice").value =rupiah;    
  }
</script>