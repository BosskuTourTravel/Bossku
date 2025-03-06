<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
session_start();
include "../site.php";
include "../db=connection.php";
// $st=$_SESSION['staff_id'];
$querycity = "SELECT DISTINCT  city FROM transport";
$rscity=mysqli_query($con,$querycity);
// $queryAgent = "SELECT DISTINCT agent FROM transport";
// $rsAgent=mysqli_query($con,$queryAgent);
$queryper = "SELECT DISTINCT  periode FROM transport";
$rsper=mysqli_query($con,$queryper);
$queryrent = "SELECT DISTINCT  rentype FROM transport";
$rsrent=mysqli_query($con,$queryrent);
echo "<div class='content-wrapper'>
 <div>
          <div>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>TRANSPORT PACKAGE</h3>
                <div class='card-tools'>
                <form>
                  <div class='input-group input-group-sm'>
                            <select class='form-control' name='city' id='city' style='width:5%;'>
                                  <option value=''>Pilih City</option>";
                                  while($rowcity= mysqli_fetch_array($rscity)){
                                    $querycity2 = "SELECT * FROM city where id=".$rowcity['city']; 
                                    $rscity2=mysqli_query($con,$querycity2);
                                    $rowcity2 = mysqli_fetch_array($rscity2);
                                echo "<option value='".$rowcity2['id']."'>".$rowcity2['name']."</option>";
                                }


                  echo"</select>
                        <select class='form-control' name='rent' id='rent' style='width:5%;'>
                            <option value=''>Pilih Rentype</option>";
                            while($rowrent= mysqli_fetch_array($rsrent)){
                              $queryrent2 = "SELECT * FROM  rent_type WHERE id=".$rowrent['rentype']; 
                              $rsrent2=mysqli_query($con,$queryrent2);
                              $rowrent2 = mysqli_fetch_array($rsrent2);
                          echo "<option value='".$rowrent2['id']."'>".$rowrent2['nama']."</option>";
                          }

                  echo"</select>
                      <select class='form-control' name='per' id='per' style='width:5%;'>
                            <option value=''>Pilih Periode</option>";
                            while($rowper= mysqli_fetch_array($rsper)){
                              $queryper2 = "SELECT * FROM periode where id=".$rowper['periode']; 
                              $rsper2=mysqli_query($con,$queryper2);
                              $rowper2 = mysqli_fetch_array($rsper2);
                          echo "<option value='".$rowper2['id']."'>".$rowper2['nama']."</option>";
                          }

                  echo"</select>
                  <select class='form-control' name='agent' id='agent' style='width:5%;'>
                          <option value=''>Pilih Agent</option>";
                echo"</select>
                    <div class='input-group-append'>
                    <button type='button' class='btn btn-default' onclick='search()'><i class='fas fa-search'></i></button>
                    </form>
                    <button type='button' id='btnFetch' onclick='reloadTransport(2,0,0)' class='btn btn-default'>Edit</button>
                    <button type='button'  onclick='insertTransport(0,0,0)' class='btn btn-default'>Insert</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
              echo"<div name='tb' id='tb'>";
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
                </table>
               </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          </div>
        <!-- /.row -->
</div>";
?>
<script>
$(document).ready(function(){
 //   $(".chosen").chosen();
    $("#btnFetch").click(function() {
      // disable button
      $(this).prop("disabled", true);
      // add spinner to button
      $(this).html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
      );
    });
});
$("#city").change(function(){
            // variabel dari nilai combo box kendaraan
            var cont = $("#city").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                url: 'getAgenttv.php',
                data: {'city':cont},
                success: function(data){
                   $("#agent").html(data);
                }
            });
        });
// $("#city").change(function(){
//     // variabel dari nilai combo box kendaraan
//     var conti = $("#city").val();
//     alert(conti);
//     // Menggunakan ajax untuk mengirim dan dan menerima data dari server
//     $.ajax({
//         type: 'POST',
//         url: 'getCitytv.php',
//         data: {'city':conti},
//         success: function(data){
//             $("#per").html(data);
//         }
//     });
// });
// $("#city").change(function(){
// // variabel dari nilai combo box kendaraan
// var cit = $("#city").val();
// // Menggunakan ajax untuk mengirim dan dan menerima data dari server
// $.ajax({
//     type: 'POST',
//     url: 'getCitytv.php',
//     data: {'city':cit},
//     success: function(data){
//         $("#per").html(data);
//     }
// });
// });
function search(){
  var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
  var b = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
  var c = document.getElementById("per").options[document.getElementById("per").selectedIndex].value;
  var d = document.getElementById("rent").options[document.getElementById("rent").selectedIndex].value;
//alert(b);
  $.ajax({
        url:"searchtrans_view.php",
        method: "POST",
        asynch: false,
        data:{agent:a,city:b,per:c,rent:d},
        success:function(data){
        $('#tb').html(data);
        }
      });

  }
</script>

