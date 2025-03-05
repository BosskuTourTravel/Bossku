<?php
include "../site.php";
include "../db=connection.php";
session_start();


$_code = "PricePackage"; 

echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:12px; max-height:100px important;'><thead>
<tr>

<th>Min Person</th>
<th>Hotel Rating</th>";

if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
  echo "<th>Purchase Price</th>";
}
echo "<th>Selling Price</th>

</tr>
</thead>
<tbody id='myTable'>";
$query = "SELECT * FROM tour_price_package WHERE tour_package = ".$_POST['id'];
$rs=mysqli_query($con,$query);

while($row = mysqli_fetch_array($rs)){
  if($row['id']!=''){


    $querypricepackage = "SELECT * FROM price_package WHERE id = ".$row['price_package'];
    $rspricepackage=mysqli_query($con,$querypricepackage);
    $rowpricepackage = mysqli_fetch_array($rspricepackage);

    $queryrating = "SELECT * FROM hotel_rating WHERE id=".$row['rating'];
    $rsrating=mysqli_query($con,$queryrating);
    $rowrating = mysqli_fetch_array($rsrating);

    $queryx = "SELECT * FROM tour_price_detail WHERE tour_price_package = ".$row['id']." ORDER BY id ASC";
    $rsx=mysqli_query($con,$queryx);

    $priceX = 999999999999;

    while($rowx = mysqli_fetch_array($rsx)){

                      #dikalikan kurs
      $query_kX = "SELECT * FROM kurs_bank WHERE id = ".$rowx['kurs'];
      $rs_kX=mysqli_query($con,$query_kX);
      $row_kX = mysqli_fetch_array($rs_kX);

      $query_kursX = "SELECT * FROM kurs_live WHERE name LIKE '".$row_kX['name']."'";
      $rs_kursX=mysqli_query($con,$query_kursX);
      $row_kursX = mysqli_fetch_array($rs_kursX);

      if(isset($rowx['price'])==null){

      }else{
        $query_performa_kursX = "SELECT * FROM performa_kurs_standart WHERE kurs=".$rowx['kurs'];
        $rs_performa_kursX=mysqli_query($con,$query_performa_kursX);
        $row_performa_kursX = mysqli_fetch_array($rs_performa_kursX);

        if(!isset($row_kursX['name'])){
          $value_kursX = 1;
        }else{

          if($row_kursX['jual']>$row_performa_kursX['price']){
            $value_kursX = $row_kursX['jual'];
          }else{
            $value_kursX = $row_performa_kursX['price'];
          }

        }

        if(!isset($row_kursX['name'])){
          $value_kursX = 1 * $rowx['price'];
        }else{
          if($row_kursX['jual']>$row_performa_kursX['price']){
            $row_kursX['jual'] = $row_kursX['jual'];
          }else{
            $row_kursX['jual'] = $row_performa_kursX['price'];
          }
          $value_kursX = $row_kursX['jual'] * $rowx['price'];
        }

        if($priceX>$value_kursX){
          $priceX = $value_kursX;
        }


      }



      $purchasepriceX = $priceX;
      if($purchasepriceX>1000 && substr((int)$priceX,-3)!='000'){
        $purchasepriceX = ((int)$purchasepriceX - substr((int)$purchasepriceX,-3)) + 1000;
      }
      if($purchasepriceX >= 999999999999){
        $purchasepriceX = 0;
      }



      $query_range = "SELECT * FROM performa_price_range";
      $rs_range=mysqli_query($con,$query_range);
      $pId = 0;

      $price2 = $priceX;
      while($row_range = mysqli_fetch_array($rs_range)){
        if($row_range['price2']==1){
          if($price2<=$row_range['price1']){
            $pId = $row_range['id'];
          }
        }else if($row_range['price2']==0){
          if($price2>=$row_range['price1']){
            $pId = $row_range['id'];
          }
        }else{
          if($price2>$row_range['price1'] && $price2<=$row_range['price2']){
            $pId = $row_range['id'];
          }

        }

      }
      $query_performa = "SELECT * FROM performa_price WHERE performa_price_range=".$pId." AND tour_package = ".$_POST['id'];
      $rs_performa=mysqli_query($con,$query_performa);
      $row_performa = mysqli_fetch_array($rs_performa);
      $tempPerforma = 0;

      
      if($row_performa['option_price'] == 1){
        $tempPerforma = $row_performa['persentase']*$price2/100;
      }elseif ($row_performa['option_price'] == 2) {
        $tempPerforma = $row_performa['nominal'];
      }elseif ($row_performa['option_price'] == 3) {
        $tempPerforma = $row_performa['agentcom'];
      }

    
      $price2 = $price2 + $tempPerforma;
      if($price2>1000 && substr((int)$price2,-3)!='000'){
        $price2 = ((int)$price2 - substr((int)$price2,-3)) + 1000;
      }
      if($price2 >= 999999999999){
        $price2 = 0;
      }

      if($price2>=1000000000000){
        $price2 = 0;
      }


                  #dikalikan kurs
      echo "<tr>";
      echo "
      <td width='10%'>".$rowx['person']." </td>
      <td width='40%'>".$row['name']." ( ".$rowrating['name']." )</td>";
      if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
        echo "<td width='25%'>Rp ".number_format($purchasepriceX, 0, ".", ".")."</td>";

      }
      echo "<td width='25%'>Rp ".number_format($price2, 0, ".", ".")."</td>";
      


    }


    // while($rowx = mysqli_fetch_array($rsx)){
    //   $querykurs = "SELECT * FROM kurs_bank WHERE id = ".$rowx['kurs'];
    //   $rskurs=mysqli_query($con,$querykurs);
    //   $rowkurs = mysqli_fetch_array($rskurs);

    //   echo "<tr>";
    //   echo "
    //   <td>".$rowx['person']." </td>
    //   <td>".$rowx['price'] . "</td>";



    //   echo "</tr>";




    // }

  }
}

echo "
</tbody>
</table>";
?>