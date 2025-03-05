<?php
                session_start();
                include "../site.php";
                include "../db=connection.php";

                if(isset($_POST['agent'])  && ($_POST['city']) && ($_POST['per']) && ($_POST['rent'])){
                  $agent=$_POST['agent'];
                  $city=$_POST['city'];
                  $per=$_POST['per'];
                  $rent=$_POST['rent'];
                  $query = "SELECT * FROM transport where agent=".$agent." AND city=".$city." AND rentype=".$rent." AND  periode=".$per." order by id ASC";
                }
                else if(isset($_POST['agent'])  && ($_POST['city']) && ($_POST['rent'])){
                  $agent=$_POST['agent'];
                  $city=$_POST['city'];
                  $rent=$_POST['rent'];
                  $query = "SELECT * FROM transport where agent=".$agent." AND city=".$city." AND rentype=".$rent." order by id ASC";
                }
                else if(isset($_POST['agent'])  && ($_POST['city'])){
                  $agent=$_POST['agent'];
                  $city=$_POST['city'];
                  $query = "SELECT * FROM transport where agent=".$agent." AND city=".$city."  order by id ASC";
                }
                else{
                  $query = "SELECT * FROM transport order by id ASC";
              }
              $rs=mysqli_query($con,$query);
  
  
                if($_SESSION['type']==1 or $_SESSION['type']==2 or $_SESSION['staff']=="Joana"){
                 // if($_SESSION['type']==1 or $_SESSION['staff']=="Neno Kusminto"){
                  echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px; max-height:100px important;'>
                  <thead>
                  <tr>
                  <th>NO</th>
                  <th>TRANSPORT TYPE</th>
                  <th>SEAT</th>
                  <th>RENTYPE</th>
                  <th>DURATION</th>
                  <th>PRICE</th>
                  <th>REMARKS</th>
                  </tr>
                  </thead>
                  <tbody id='myTable'>";
                    $no=1;
                  while($row = mysqli_fetch_array($rs)){
                    $query2 = "SELECT * FROM agent WHERE id=".$row['agent'];
                    $rs2=mysqli_query($con,$query2);
                    $row2 = mysqli_fetch_array($rs2);
  
                    $queryc = "SELECT * FROM continent WHERE id=".$row['continent'];
                    $rsc=mysqli_query($con,$queryc);
                    $rowc = mysqli_fetch_array($rsc);
  
                    $querycon = "SELECT * FROM country WHERE id=".$row['contry'];
                    $rscon=mysqli_query($con,$querycon);
                    $rowcon = mysqli_fetch_array($rscon);
  
                    $querycity = "SELECT * FROM city WHERE id=".$row['city'];
                    $rscity=mysqli_query($con,$querycity);
                    $rowcity = mysqli_fetch_array($rscity);
  
                    $querykurs = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
                    $rskurs=mysqli_query($con,$querykurs);
                    $rowkurs = mysqli_fetch_array($rskurs);
  
                    $querytr = "SELECT * FROM transport_type WHERE id=".$row['transport_type'];
                    $rstr=mysqli_query($con,$querytr);
                    $rowtr = mysqli_fetch_array($rstr);
  
                    $queryper = "SELECT * FROM periode WHERE id=".$row['periode'];
                    $rsper=mysqli_query($con,$queryper);
                    $rowper = mysqli_fetch_array($rsper);
  
                    $queryren = "SELECT * FROM rent_type WHERE id=".$row['rentype'];
                    $rsren=mysqli_query($con,$queryren);
                    $rowren = mysqli_fetch_array($rsren);
  
                    $querykursc = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
                    $rskursc=mysqli_query($con,$querykursc);
                    $rowkursc = mysqli_fetch_array($rskursc);
  
  
                        $a=$row['periode'];
                      echo"
                      <tr style='font-weight:bold;'>
                      <td>".$no."</td>
                      <td>".$rowtr['name']."</td>
                      <td>".$row['seat']."</td>
                      <td>".$rowren['nama']."</td>
                      <td>".$rowren['duration']." hours</td>
                      <td>".$row['harga']." &nbsp; ".$rowkursc['name']."</td>
                      <td><font color='red'>Periode : &nbsp;".$rowper['nama']."</font></br>".$row['remark']."</td>
                      </tr>";
                      $no=$no+1;
                    }
                  }
                  echo "
                  </tbody>
                  </table>";

?>