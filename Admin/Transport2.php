<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
session_start();
include "../site.php";
include "../db=connection.php";
// $st=$_SESSION['staff_id'];
$query = "SELECT * FROM transport order by id";
$rs=mysqli_query($con,$query);


echo "<div class='content-wrapper'>

 <div class='row'>
 <div>
          <div style='width:120%;'>
          <div class='col-12'>
            <div class='card' style='width:120%;'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>EDIT TRANSPORT PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                    <button type='submit' onclick='insertTransport(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";

                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px; max-height:100px important;'>
                <thead>
                <tr>
                <th>No</th>
                <th>AGENT</th>
                <th>CONTINENT</th>
                <th>COUNTRY</th>
                <th>CITY</th>
                <th>PERIODE</th>
                <th>KURS</th>
                <th>TRANSPORT TYPE</th>
                <th>RENTYPE</th>
                <th style='width:2%;'>DURATION</th>
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

                  $querycon = "SELECT * FROM country WHERE continent=".$row['continent']." AND id=".$row['contry'];
                  $rscon=mysqli_query($con,$querycon);
                  $rowcon = mysqli_fetch_array($rscon);

                  $querycity = "SELECT * FROM city WHERE country=".$row['contry']." AND id=".$row['city'];
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


                      $a=$row['periode'];
                    echo"
                    <tr style='font-weight:bold;'>
                    <td>".$no."</td>
                    <td>".$row2['name']."</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>".$rowtr['name']."</td>
                    <td>".$rowren['nama']."</td>
                    <td>".$rowren['duration']." hours</td>
                    <td><input type='text' class='form-control' name='tharga".$row['id']."' id='tharga".$row['id']."' value='".$row['harga']."' size='20'></td>
                    <td><input type='text' class='form-control' name='tremark".$row['id']."' id='tremark".$row['id']."' value='".$row['remark']."' size='20'></td>
                    <td><button type='button' class='btn btn-warning' onclick='editButton(".$row['id'].")'><i class='fa fa-edit' aria-hidden='true''></i></button>
                    <button type='submit'onclick='del(".$row['agent'].",".$row['continent'].",".$row['contry'].",".$row['city'].",".$row['periode'].",".$row['kurs'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>              
                    </td>
                    </tr>";
                    $no=$no+1;
                  }
                echo "
                </tbody>
                </table>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          </div>
        </div>
        <!-- /.row -->
</div>";
?>
<script>
$(document).ready(function(){
    $(".chosen").chosen();
});
  function editButton(x){
      var fd = new FormData();
       var a = $("input[name=tharga"+x+"]").val();
       var b = $("input[name=tremark"+x+"]").val();
      // fd.append('id',this.value);
       fd.append('harga',a);
       fd.append('remark',b);
       fd.append('id',x);

       $.ajax({
        url: 'updatetransport2.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
          reloadTransport(2,0,0);
        }

      },
    });
  }

  function del(y,s,t,u,v,w){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delTransport2.php",
        method: "POST",
        asynch: false,
        data:{agent:y,continent:s,country:t,city:u,periode:v,kurs:w},
        success:function(data){
          if(data=="success"){
            reloadTransport(2,0,0);
          }else{
            reloadTransport(2,0,0);
          }
        }
      });
    } 
  }
</script>

