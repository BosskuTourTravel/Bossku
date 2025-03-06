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
                <th>FROM</th>
                <th>PERIODE</th>
                <th>KURS</th>
                <th>TRANSPORT TYPE</th>
                <th>RENTYPE</th>
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
                    <td>".$row2['name']."<br>".$row2['company']."</td>
                    <td>".$rowc['name']."<br>".$rowcon['name']."<br>".$rowcity['name']."</td>";
                    // <td>
                    // <select class='chosen' onchange='updateconti(".$row['id'].",".$row['agent'].",this.value)' name='conti".$row['id']."' id='conti".$row['id']."'>
                    // <option selected='selected' value=0>".$rowc['name']."</option>";
                    //     $querycitp = "SELECT * FROM continent";
                    //     $rscitp=mysqli_query($con,$querycitp); 
                    //     while($rowcitp = mysqli_fetch_array($rscitp)){
                    //           echo "<option value='".$rowcitp['id']."'>".$rowcitp['name']."</option>";
                    //       }
                    //    echo"</select>
                    // </td>
                    // <td>
                    // <select class='chosen' onchange='updatecon(".$row['id'].",".$row['agent'].",".$row['continent'].",this.value)' name='con".$row['id']."' id='con".$row['id']."'style='width:100px;'>
                    // <option selected='selected' value=0>".$rowcon['name']."</option>";
                    //     $querycotp = "SELECT * FROM country";
                    //     $rscotp=mysqli_query($con,$querycotp); 
                    //     while($rowcotp = mysqli_fetch_array($rscotp)){
                    //           echo "<option value='".$rowcotp['id']."'>".$rowcotp['name']."</option>";
                    //       }
                    //    echo"</select>
                    // </td>
                    // <td>
                    // <select class='chosen'  onchange='updatecity(".$row['id'].",".$row['agent'].",".$row['continent'].",".$row['contry'].",this.value)' name='city".$row['id']."' id='city".$row['id']."' style='width:100px;'>
                    // <option selected='selected' value='' >".$rowcity['name']."</option>";
                    //     $queryctp = "SELECT * FROM city";
                    //     $rsctp=mysqli_query($con,$queryctp); 
                    //     while($rowctp = mysqli_fetch_array($rsctp)){
                    //           echo "<option value='".$rowctp['id']."'>".$rowctp['name']."</option>";
                    //       }
                    //    echo"</select>
                    // </td>
                    echo"
                    <td>
                    <select class='form-control' onchange='updateper(".$row['id'].",".$row['agent'].",".$row['continent'].",".$row['contry'].",".$row['city'].",this.value)' name='periode".$row['id']."' id='periode".$row['id']."'   style='width:170px;'>
                    <option selected='selected' value=''>".$rowper['nama']."</option>";
                        $queryptp = "SELECT * FROM periode";
                        $rsptp=mysqli_query($con,$queryptp); 
                        while($rowptp = mysqli_fetch_array($rsptp)){
                              echo "<option value='".$rowptp['id']."'>".$rowptp['nama']."</option>";
                          }
                       echo"</select>
                    </td>
                    <td>
                    <select class='form-control' onchange='updatekurs(".$row['id'].",".$row['agent'].",".$row['continent'].",".$row['contry'].",".$row['city'].",".$row['periode'].",this.value)' name='kurs".$row['id']."' id='kurs".$row['id']."'>
                        <option selected='selected' value=''>".$rowkurs['name']."</option>";
                            $queryktp= "SELECT * FROM kurs_bank";
                            $rsktp=mysqli_query($con,$queryktp); 
                            while($rowktp = mysqli_fetch_array($rsktp)){
                                  echo "<option value='".$rowktp['id']."'>".$rowktp['name']."</option>";
                              }
                    echo"</select>
                    </td>
                    
                    <td>".$rowtr['name']." /seat <input type='text' class='form-control'  onchange='updateFlag(".$row['id'].",".$row['agent'].",".$row['continent'].",".$row['contry'].",".$row['city'].",".$row['periode'].",".$row['kurs'].",".$row['transport_type'].",this.value)' name='seat".$row['id']."' id='seat".$row['id']."' value='".$row['seat']."' size='1'></td>
                    <td>".$rowren['nama']."<br>".$rowren['duration']." hours</td>
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

function updateFlag(p,q,w,e,r,t,y,u,i){
    var fd = new FormData();
    fd.append('agent',q);
    fd.append('continent',w);
    fd.append('country',e);
    fd.append('city',r);
    fd.append('periode',t);
    fd.append('kurs',y);
    fd.append('tp',u);
    fd.append('seat',i);
    fd.append('id',p);
    $.ajax({
            url: 'updateOptionTransport.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTransport(2,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }
  function updatekurs(p,q,w,e,r,t,y){
    var fd = new FormData();
    fd.append('agent',q);
    fd.append('continent',w);
    fd.append('country',e);
    fd.append('city',r);
    fd.append('periode',t);
    fd.append('kurs',y);
    fd.append('id',p);


    $.ajax({
            url: 'updateOptionKurs.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTransport(2,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }
  function updateper(p,q,w,e,r,t,){
    var fd = new FormData();
    fd.append('agent',q);
    fd.append('continent',w);
    fd.append('country',e);
    fd.append('city',r);
    fd.append('periode',t);
    fd.append('id',p);
    $.ajax({
            url: 'updateOptionPer.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTransport(2,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }
  function updatecity(p,q,w,e,r){
    var fd = new FormData();
    fd.append('agent',q);
    fd.append('continent',w);
    fd.append('country',e);
    fd.append('city',r);
    fd.append('id',p);
    $.ajax({
            url: 'updateOptionCity.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTransport(2,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }
  function updatecon(p,q,w,e){
    var fd = new FormData();
    fd.append('agent',q);
    fd.append('continent',w);
    fd.append('country',e);
    fd.append('id',p);
    $.ajax({
            url: 'updateOptionCon.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTransport(2,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }

  function updateconti(p,q,w){
    var fd = new FormData();
    fd.append('agent',q);
    fd.append('continent',w);
    fd.append('id',p);
    $.ajax({
            url: 'updateOptionConti.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadTransport(2,0,0);
              }else{
                alert(response);
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

