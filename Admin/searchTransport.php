<?php
include "../site.php";
include "../db=connection.php";

$cagent = $_POST['agent'];
$ccontinent= $_POST['conti'];
$ccountry= $_POST['con'];
$ccity= $_POST['city'];
$cperiode= $_POST['per'];
$ctrans= $_POST['trans'];

// var_dump($cagent);
// var_dump($ccontinent);
// var_dump($ccountry);
// var_dump($ccity);
// var_dump($cperiode);
// var_dump($ckurs);
//$sql = "select * from transport where nt like '%".$cari."%' or domain like '%".$cari."%' or marketing like '%".$cari."%'";
    echo"<table class='table table-sm table-hover'>
    <thead>
      <tr>
        <th scope='col-2'>#</th>
        <th scope='col-2'style='width:180px;'>Transport Type</th>
        <th scope='col-2'style='width:180px;'>Rent Type </th>
        <th scope='col-2' style='width:80px;'>Harga</th>
        <th scope='col-4'>Remarks</th>
      </tr>
    </thead>
    <tbody>";
$query21 ="SELECT * FROM transport WHERE agent LIKE '%".$cagent."%' AND continent LIKE '%".$ccontinent."%' AND contry LIKE '%".$ccountry."%' AND city LIKE '%".$ccity."%' AND periode LIKE '%".$cperiode."%' AND transport_type LIKE '%".$ctrans."%'  order by rentype ASC";
$rs=mysqli_query($con,$query21);
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
        <th scope='row'>
        <div class='form-check'>
        <input class='form-check-input position-static' type='checkbox' id='blankCheckbox' value='option1'>
        </div>
        </th>
        <td>".$rowren['nama']." &nbsp; : &nbsp; ".$rowren['duration']." &nbsp;Hours</td>
        <td>".$rowtr['name']." &nbsp; :  &nbsp; ".$rowc['seat']."</td>
        <td>".$rowc['harga']." &nbsp; ".$rowkurs['name']."</td>
        <td>".$rowc['remark']."</td>
      </tr>";
}
    echo"</tbody>
  </table>";

 
//echo $query21;
// $sql = "UPDATE transport SET contry =".$country."  WHERE agent=".$agent." AND continent=".$continent;
// if (mysqli_query($con, $sql)) {
// 	echo "success";
// } else {
//   echo "Error: " . $sql . "" . mysqli_error($con);
//   header("location:https://www.2canholiday.com/Admin/#");
// }
// $con->close();
   
?>