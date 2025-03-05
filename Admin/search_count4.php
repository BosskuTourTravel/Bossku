<?php
include "../site.php";
include "../db=connection.php";
////////////////////////////////
$arr_harga=$_POST['arr_harga'];
$arr_harga2=$_POST['arr_harga2'];
$arr_harga3=$_POST['arr_harga3'];
$arr_harga4=$_POST['arr_harga4'];
$arr_harga5=$_POST['arr_harga5'];
$arr_harga6=$_POST['arr_harga6'];
$data1=implode(";",$arr_harga);
$data2=implode(";",$arr_harga2);
$data3=implode(";",$arr_harga3);
$data4=implode(";",$arr_harga4);
$data5=implode(";",$arr_harga5);
$data6=implode(";",$arr_harga6);
$thari= $_POST['harit'];
$dl= $_POST['dl'];
//$search= $_POST['total'];
//var_dump($data1);
    echo"<table class='table table-sm table-bordered'>
    </tbody>
    <thead>
    <tr bgcolor='#A9CCE3 '>
    <th scope='col-2' >Days</th>
      <th scope='col-2' >Kode Agent</th>
      <th scope='col-2'>Nama Agent</th>
      <th scope='col-2'>Transport type</th>
      <th scope='col-2'>Rent Type</th>
      <th scope='col-2'>Harga</th>
    </tr>
  </thead>
  <tbody>";
  $xtour="";
  $gt=[];
  $arr_dl = explode(";",$dl);
  $total_gt=[];
  for($z=0; $z < count($arr_dl); $z++) {
    $total=[];
    $arr_dl2[$z] = explode(",",$arr_dl[$z]);
    $tour=$arr_dl2[$z][0];
    echo"
    <tr>
    <td colspan='6' align='center'><b>Kode Itinerary  : 888".$tour."</b></td>
   </tr>";
  for($y=0; $y < count($arr_harga); $y++) {
    $data[$y] = explode(",",$arr_harga[$y]);
    $tour2=$data[$y][0];

    if($tour == $tour2){
      $queryAgent[$y] = "SELECT * FROM agent where id=".$data[$y][2]; 
      $rsAgent[$y]=mysqli_query($con,$queryAgent[$y]);
      $rowAgent[$y] = mysqli_fetch_array($rsAgent[$y]);

      $queryrenc[$y] = "SELECT * FROM rent_type WHERE id=".$data[$y][6];
      $rsrenc[$y]=mysqli_query($con,$queryrenc[$y]);
      $rowrenc[$y] = mysqli_fetch_array($rsrenc[$y]);

      $querytrans[$y] = "SELECT * FROM transport_type where id=".$data[$y][5]; 
      $rstrans[$y]=mysqli_query($con,$querytrans[$y]);
      $rowtrans[$y] = mysqli_fetch_array($rstrans[$y]);
      $query[$y] = "SELECT * FROM transport WHERE agent=".$data[$y][2]." AND city=".$data[$y][3]." AND  periode=".$data[$y][4]." AND rentype=".$data[$y][6]." AND transport_type=".$data[$y][5];
      $rs[$y]=mysqli_query($con,$query[$y]);
      while($row[$y] = mysqli_fetch_array($rs[$y])){
      $querykursc[$y] = "SELECT * FROM kurs_bank WHERE id=".$row[$y]['kurs'];
      $rskursc[$y]=mysqli_query($con,$querykursc[$y]);
      $rowkursc[$y] = mysqli_fetch_array($rskursc[$y]);
      $kurs[$y]= $rowkursc[$y]['name'];


      $querykonv[$y] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$y]%'";
      $rskonv[$y]=mysqli_query($con,$querykonv[$y]);
      $rowkonv [$y]= mysqli_fetch_array($rskonv[$y]);
      $kurs[$y]=$rowkonv[$y]['jual'];
      if($kurs[$y]==NULL){
        $harga[$y]= $row[$y]['harga'];
      }else{
      $harga[$y]= $row[$y]['harga'] * $rowkonv[$y]['jual'];
      }
      $harga[$y]=round($harga[$y] ,0);
    }
      echo "
           <tr>
           <td>".$data[$y][7]."</td>
           <td>".$data[$y][2]."</td>
           <td><b>".$rowAgent[$y]['name']."</b> &nbsp; From : ".$rowAgent[$y]['company']."</td>
           <td>".$rowtrans[$y]['name']."</td>
           <td>".$rowrenc[$y]['nama']."</td>
           <td>Rp.".number_format($harga[$y], 0, ".", ".")."</td>
           </tr>";
       array_push($total,$harga[$y]);    
     }
     $total1[$z]=$total1[$z]+$harga[$y];
    }
    for($y=0; $y < count($arr_harga2); $y++) {
      $data[$y] = explode(",",$arr_harga2[$y]);
      $tour2=$data[$y][0];
      if($tour == $tour2)
       {
        $queryAgent[$y] = "SELECT * FROM agent where id=".$data[$y][2]; 
        $rsAgent[$y]=mysqli_query($con,$queryAgent[$y]);
        $rowAgent[$y] = mysqli_fetch_array($rsAgent[$y]);
  
        $queryrenc[$y] = "SELECT * FROM rent_type WHERE id=".$data[$y][6];
        $rsrenc[$y]=mysqli_query($con,$queryrenc[$y]);
        $rowrenc[$y] = mysqli_fetch_array($rsrenc[$y]);
  
        $querytrans[$y] = "SELECT * FROM transport_type where id=".$data[$y][5]; 
        $rstrans[$y]=mysqli_query($con,$querytrans[$y]);
        $rowtrans[$y] = mysqli_fetch_array($rstrans[$y]);
        $query[$y] = "SELECT * FROM transport WHERE agent=".$data[$y][2]." AND city=".$data[$y][3]." AND  periode=".$data[$y][4]." AND rentype=".$data[$y][6]." AND transport_type=".$data[$y][5];
        $rs[$y]=mysqli_query($con,$query[$y]);
        while($row[$y] = mysqli_fetch_array($rs[$y])){
        $querykursc[$y] = "SELECT * FROM kurs_bank WHERE id=".$row[$y]['kurs'];
        $rskursc[$y]=mysqli_query($con,$querykursc[$y]);
        $rowkursc[$y] = mysqli_fetch_array($rskursc[$y]);
        $kurs[$y]= $rowkursc[$y]['name'];
  
  
        $querykonv[$y] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$y]%'";
        $rskonv[$y]=mysqli_query($con,$querykonv[$y]);
        $rowkonv [$y]= mysqli_fetch_array($rskonv[$y]);
        $kurs[$y]=$rowkonv[$y]['jual'];
        if($kurs[$y]==NULL){
          $harga[$y]= $row[$y]['harga'];
        }else{
        $harga[$y]= $row[$y]['harga'] * $rowkonv[$y]['jual'];
        }
        $harga[$y]=round($harga[$y] ,0);
      }
        echo "
             <tr>
             <td>".$data[$y][7]."</td>
             <td>".$data[$y][2]."</td>
             <td><b>".$rowAgent[$y]['name']."</b> &nbsp; From : ".$rowAgent[$y]['company']."</td>
             <td>".$rowtrans[$y]['name']."</td>
             <td>".$rowrenc[$y]['nama']."</td>
             <td>Rp.".number_format($harga[$y], 0, ".", ".")."</td>
             </tr>";
             array_push($total,$harga[$y]);    
       }
      }
      for($y=0; $y < count($arr_harga3); $y++) {
        $data[$y] = explode(",",$arr_harga3[$y]);
        $tour2=$data[$y][0];
        if($tour == $tour2)
         {
          $queryAgent[$y] = "SELECT * FROM agent where id=".$data[$y][2]; 
          $rsAgent[$y]=mysqli_query($con,$queryAgent[$y]);
          $rowAgent[$y] = mysqli_fetch_array($rsAgent[$y]);
    
          $queryrenc[$y] = "SELECT * FROM rent_type WHERE id=".$data[$y][6];
          $rsrenc[$y]=mysqli_query($con,$queryrenc[$y]);
          $rowrenc[$y] = mysqli_fetch_array($rsrenc[$y]);
    
          $querytrans[$y] = "SELECT * FROM transport_type where id=".$data[$y][5]; 
          $rstrans[$y]=mysqli_query($con,$querytrans[$y]);
          $rowtrans[$y] = mysqli_fetch_array($rstrans[$y]);
          $query[$y] = "SELECT * FROM transport WHERE agent=".$data[$y][2]." AND city=".$data[$y][3]." AND  periode=".$data[$y][4]." AND rentype=".$data[$y][6]." AND transport_type=".$data[$y][5];
          $rs[$y]=mysqli_query($con,$query[$y]);
          while($row[$y] = mysqli_fetch_array($rs[$y])){
          $querykursc[$y] = "SELECT * FROM kurs_bank WHERE id=".$row[$y]['kurs'];
          $rskursc[$y]=mysqli_query($con,$querykursc[$y]);
          $rowkursc[$y] = mysqli_fetch_array($rskursc[$y]);
          $kurs[$y]= $rowkursc[$y]['name'];
    
    
          $querykonv[$y] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$y]%'";
          $rskonv[$y]=mysqli_query($con,$querykonv[$y]);
          $rowkonv [$y]= mysqli_fetch_array($rskonv[$y]);
          $kurs[$y]=$rowkonv[$y]['jual'];
          if($kurs[$y]==NULL){
            $harga[$y]= $row[$y]['harga'];
          }else{
          $harga[$y]= $row[$y]['harga'] * $rowkonv[$y]['jual'];
          }
          $harga[$y]=round($harga[$y] ,0);
        }
          echo "
               <tr>
               <td>".$data[$y][7]."</td>
               <td>".$data[$y][2]."</td>
               <td><b>".$rowAgent[$y]['name']."</b> &nbsp; From : ".$rowAgent[$y]['company']."</td>
               <td>".$rowtrans[$y]['name']."</td>
               <td>".$rowrenc[$y]['nama']."</td>
               <td>Rp.".number_format($harga[$y], 0, ".", ".")."</td>
               </tr>";
               array_push($total,$harga[$y]);    
         }
        }
      for($y=0; $y < count($arr_harga4); $y++) {
        $data[$y] = explode(",",$arr_harga4[$y]);
        $tour2=$data[$y][0];
        if($tour == $tour2)
          {
            $queryAgent[$y] = "SELECT * FROM agent where id=".$data[$y][2]; 
            $rsAgent[$y]=mysqli_query($con,$queryAgent[$y]);
            $rowAgent[$y] = mysqli_fetch_array($rsAgent[$y]);
      
            $queryrenc[$y] = "SELECT * FROM rent_type WHERE id=".$data[$y][6];
            $rsrenc[$y]=mysqli_query($con,$queryrenc[$y]);
            $rowrenc[$y] = mysqli_fetch_array($rsrenc[$y]);
      
            $querytrans[$y] = "SELECT * FROM transport_type where id=".$data[$y][5]; 
            $rstrans[$y]=mysqli_query($con,$querytrans[$y]);
            $rowtrans[$y] = mysqli_fetch_array($rstrans[$y]);
            $query[$y] = "SELECT * FROM transport WHERE agent=".$data[$y][2]." AND city=".$data[$y][3]." AND  periode=".$data[$y][4]." AND rentype=".$data[$y][6]." AND transport_type=".$data[$y][5];
            $rs[$y]=mysqli_query($con,$query[$y]);
            while($row[$y] = mysqli_fetch_array($rs[$y])){
            $querykursc[$y] = "SELECT * FROM kurs_bank WHERE id=".$row[$y]['kurs'];
            $rskursc[$y]=mysqli_query($con,$querykursc[$y]);
            $rowkursc[$y] = mysqli_fetch_array($rskursc[$y]);
            $kurs[$y]= $rowkursc[$y]['name'];
      
      
            $querykonv[$y] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$y]%'";
            $rskonv[$y]=mysqli_query($con,$querykonv[$y]);
            $rowkonv [$y]= mysqli_fetch_array($rskonv[$y]);
            $kurs[$y]=$rowkonv[$y]['jual'];
            if($kurs[$y]==NULL){
              $harga[$y]= $row[$y]['harga'];
            }else{
            $harga[$y]= $row[$y]['harga'] * $rowkonv[$y]['jual'];
            }
            $harga[$y]=round($harga[$y] ,0);
          }
            echo "
                 <tr>
                 <td>".$data[$y][7]."</td>
                 <td>".$data[$y][2]."</td>
                 <td><b>".$rowAgent[$y]['name']."</b> &nbsp; From : ".$rowAgent[$y]['company']."</td>
                 <td>".$rowtrans[$y]['name']."</td>
                 <td>".$rowrenc[$y]['nama']."</td>
                 <td>Rp.".number_format($harga[$y], 0, ".", ".")."</td>
                 </tr>";
                 array_push($total,$harga[$y]);    
          }
        }
      for($y=0; $y < count($arr_harga5); $y++) {
        $data[$y] = explode(",",$arr_harga5[$y]);
        $tour2=$data[$y][0];
        if($tour == $tour2)
          {
            $queryAgent[$y] = "SELECT * FROM agent where id=".$data[$y][2]; 
            $rsAgent[$y]=mysqli_query($con,$queryAgent[$y]);
            $rowAgent[$y] = mysqli_fetch_array($rsAgent[$y]);
      
            $queryrenc[$y] = "SELECT * FROM rent_type WHERE id=".$data[$y][6];
            $rsrenc[$y]=mysqli_query($con,$queryrenc[$y]);
            $rowrenc[$y] = mysqli_fetch_array($rsrenc[$y]);
      
            $querytrans[$y] = "SELECT * FROM transport_type where id=".$data[$y][5]; 
            $rstrans[$y]=mysqli_query($con,$querytrans[$y]);
            $rowtrans[$y] = mysqli_fetch_array($rstrans[$y]);
            $query[$y] = "SELECT * FROM transport WHERE agent=".$data[$y][2]." AND city=".$data[$y][3]." AND  periode=".$data[$y][4]." AND rentype=".$data[$y][6]." AND transport_type=".$data[$y][5];
            $rs[$y]=mysqli_query($con,$query[$y]);
            while($row[$y] = mysqli_fetch_array($rs[$y])){
            $querykursc[$y] = "SELECT * FROM kurs_bank WHERE id=".$row[$y]['kurs'];
            $rskursc[$y]=mysqli_query($con,$querykursc[$y]);
            $rowkursc[$y] = mysqli_fetch_array($rskursc[$y]);
            $kurs[$y]= $rowkursc[$y]['name'];
      
      
            $querykonv[$y] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$y]%'";
            $rskonv[$y]=mysqli_query($con,$querykonv[$y]);
            $rowkonv [$y]= mysqli_fetch_array($rskonv[$y]);
            $kurs[$y]=$rowkonv[$y]['jual'];
            if($kurs[$y]==NULL){
              $harga[$y]= $row[$y]['harga'];
            }else{
            $harga[$y]= $row[$y]['harga'] * $rowkonv[$y]['jual'];
            }
            $harga[$y]=round($harga[$y] ,0);
          }
            echo "
                 <tr>
                 <td>".$data[$y][7]."</td>
                 <td>".$data[$y][2]."</td>
                 <td><b>".$rowAgent[$y]['name']."</b> &nbsp; From : ".$rowAgent[$y]['company']."</td>
                 <td>".$rowtrans[$y]['name']."</td>
                 <td>".$rowrenc[$y]['nama']."</td>
                 <td>Rp.".number_format($harga[$y], 0, ".", ".")."</td>
                 </tr>";
                 array_push($total,$harga[$y]);    
          }
        }

      for($y=0; $y < count($arr_harga6); $y++) {
        $data[$y] = explode(",",$arr_harga6[$y]);
        $tour2=$data[$y][0];
        $total6=0;
        if($tour == $tour2)
          {
            $queryAgent[$y] = "SELECT * FROM agent where id=".$data[$y][2]; 
            $rsAgent[$y]=mysqli_query($con,$queryAgent[$y]);
            $rowAgent[$y] = mysqli_fetch_array($rsAgent[$y]);
      
            $queryrenc[$y] = "SELECT * FROM rent_type WHERE id=".$data[$y][6];
            $rsrenc[$y]=mysqli_query($con,$queryrenc[$y]);
            $rowrenc[$y] = mysqli_fetch_array($rsrenc[$y]);
      
            $querytrans[$y] = "SELECT * FROM transport_type where id=".$data[$y][5]; 
            $rstrans[$y]=mysqli_query($con,$querytrans[$y]);
            $rowtrans[$y] = mysqli_fetch_array($rstrans[$y]);
            $query[$y] = "SELECT * FROM transport WHERE agent=".$data[$y][2]." AND city=".$data[$y][3]." AND  periode=".$data[$y][4]." AND rentype=".$data[$y][6]." AND transport_type=".$data[$y][5];
            $rs[$y]=mysqli_query($con,$query[$y]);
            while($row[$y] = mysqli_fetch_array($rs[$y])){
            $querykursc[$y] = "SELECT * FROM kurs_bank WHERE id=".$row[$y]['kurs'];
            $rskursc[$y]=mysqli_query($con,$querykursc[$y]);
            $rowkursc[$y] = mysqli_fetch_array($rskursc[$y]);
            $kurs[$y]= $rowkursc[$y]['name'];
      
      
            $querykonv[$y] = "SELECT * FROM kurs_live WHERE name LIKE '$kurs[$y]%'";
            $rskonv[$y]=mysqli_query($con,$querykonv[$y]);
            $rowkonv [$y]= mysqli_fetch_array($rskonv[$y]);
            $kurs[$y]=$rowkonv[$y]['jual'];
            if($kurs[$y]==NULL){
              $harga[$y]= $row[$y]['harga'];
            }else{
            $harga[$y]= $row[$y]['harga'] * $rowkonv[$y]['jual'];
            }
            $harga[$y]=round($harga[$y] ,0);
          }
            echo "
                 <tr>
                 <td>".$data[$y][7]."</td>
                 <td>".$data[$y][2]."</td>
                 <td><b>".$rowAgent[$y]['name']."</b> &nbsp; From : ".$rowAgent[$y]['company']."</td>
                 <td>".$rowtrans[$y]['name']."</td>
                 <td>".$rowrenc[$y]['nama']."</td>
                 <td>Rp.".number_format($harga[$y], 0, ".", ".")."</td>
                 </tr>";
                 array_push($total,$harga[$y]);    
          }
        }
      $grandtotal[$z]=array_sum($total);
      echo"
        <td colspan='4'></>
        <td><b>Total :</b></td>
        <td><b>Rp.".number_format($grandtotal[$z], 0, ".", ".")."</b></td>";
        array_push($total_gt,$grandtotal[$z]);

  }
  $hasil_grandtotal=array_sum($grandtotal);
        $data_total_gt=implode(";",$total_gt);
      echo"
      <tr>
      <td colspan='6' align='center'><b>Grandtotal : Rp.".number_format(array_sum($grandtotal), 0, ".", ".")."</b></td>
      </tr>
 </tbody>
  </table>";
  echo"
  <div class='form-row'>
  <div class='col-12'>
      <div class='card border-primary mb-3'>
          <div class='card-body'>
              <form>
                  <div class='form-row'>
                          <div class='col'>
                                  <input type='text' class='form-control' id='tpax' name='tpax' style='width:200px;' placeholder='Jumlah Pax'>
                                  <input type='hidden' class='form-control' id='seltp' name='seltp' style='width:100px;' value='".$hasil_grandtotal."'>
                                  <input type='hidden' class='form-control' id='total_gt' name='total_gt' style='width:100px;' value='".$data_total_gt."'>
                                  <input type='hidden' class='form-control' id='arr_harga' name='arr_harga' style='width:100px;' value='".$data1."'>
                                  <input type='hidden' class='form-control' id='arr_harga2' name='arr_harga2' style='width:100px;' value='".$data2."'>
                                  <input type='hidden' class='form-control' id='arr_harga3' name='arr_harga3' style='width:100px;' value='".$data3."'>
                                  <input type='hidden' class='form-control' id='arr_harga4' name='arr_harga4' style='width:100px;' value='".$data4."'>
                                  <input type='hidden' class='form-control' id='arr_harga5' name='arr_harga5' style='width:100px;' value='".$data5."'>
                                  <input type='hidden' class='form-control' id='arr_harga6' name='arr_harga6' style='width:100px;' value='".$data6."'>

                                  <input type='hidden' class='form-control' id='dl' name='dl' style='width:100px;' value='".$dl."'>
                                  <input type='hidden' class='form-control' id='thari' name='thari' style='width:100px;' value='".$lp."'>
                          </div>
                        <div class='col'>
                            <select class='custom-select mr-sm-2' id='conv'>
                            <option selected value='0'>IDR</option>";
                            $conv = "SELECT * FROM kurs_live";
                            $rsconv=mysqli_query($con,$conv);
                            while($rowconv= mysqli_fetch_array($rsconv)){
                            echo"<option value='".$rowconv['jual']."'>".$rowconv['name']."</option>";
                            }
                            echo $conv;
                            echo"
                            </select>
                        </div>
                        <div class='col'>
                        <input type='text' class='form-control' id='ket' name='ket' style='width:200px;' placeholder='keterangan'>
                        </div>
                        </div>
                        </br>
                        <div class='form-row'>
                        <div class='col'>
                        <input type='text' class='form-control' id='gn' name='gn' style='width:200px;' placeholder='Groub Name'>
                        </div>
                        <div class='col'>
                        <input type='text' class='form-control' id='tlp' name='tlp' style='width:200px;' placeholder='Telephon'>
                        </div>
                        <div class='col'>
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
                                 <input type='text' class='form-control' id='tprice' name='tprice' style='width:400px;'>
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
    var fd = new FormData();
    var aa = $("input[name=tpax]").val();
    var bb = $("input[name=seltp]").val();
   //var bb = document.getElementById("seltp").options[document.getElementById("seltp").selectedIndex].value;
    var cc = document.getElementById("conv").options[document.getElementById("conv").selectedIndex].value;
    if(cc==0){
      total= (bb/aa);
    }else{
      total= (bb/aa)/cc;
    }
    totalz =Math.ceil(total);

  var	number_string = totalz.toString(),
	sisa 	= number_string.length % 3,
	rupiah 	= number_string.substr(0, sisa),
	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
if (ribuan) {
	separator = sisa ? '.' : '';
	rupiah += separator + ribuan.join('.');
}

var a1= $("input[name=arr_harga]").val();
var a2= $("input[name=arr_harga2]").val();
var a3= $("input[name=arr_harga3]").val();
var a4= $("input[name=arr_harga4]").val();
var a5= $("input[name=arr_harga5]").val();
var a6= $("input[name=arr_harga6]").val();
var dl= $("input[name=dl]").val();
var thari= $("input[name=thari]").val();
var total_gt=$("input[name=total_gt]").val();
var ket=$("input[name=ket]").val();
var gn=$("input[name=gn]").val();
var tlp=$("input[name=tlp]").val();
fd.append('a1',a1);
fd.append('a2',a2);
fd.append('a3',a3);
fd.append('a4',a4);
fd.append('a5',a5);
fd.append('a6',a6);
fd.append('dl',dl);
fd.append('thari',thari);
fd.append('total_gt',total_gt);
fd.append('cc',cc);
fd.append('tpax',aa);
fd.append('bb',bb);
fd.append('ket',ket);
fd.append('gn',gn);
fd.append('tlp',tlp);
//alert(cc);
    //var total = document.getElementById("tprice").value;
    document.getElementById("tprice").value =rupiah; 
        $.ajax({
            url: 'insert_transquo.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
            alert("data berhasil di simpan");
            }
                 });    
  }
</script>