<?php
include "../site.php";
include "../db=connection.php";



                                    
                            echo"      
                            
                            <div class='container'>
                            <div class='form-row align-items-center'>
                                <div class='col-12'>";
                                $querya = "SELECT * FROM performa_price_standart_flight WHERE flight_type LIKE 'Group' ORDER BY performa_price_range_flight ASC";
                                $rsa=mysqli_query($con,$querya);
                                echo"
                                <table class='table table-hover' style='font-size:12px;'>
                                <thead>
                                <tr>
                                <th>Range Price</th>
                                <th>Persentase</th>
                                <th>Nominal</th>
                                <th>Pilihan</th>
                                
                                <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>";
                                while($rowa = mysqli_fetch_array($rsa)){
                                $queryz = "SELECT * FROM performa_price_range_flight WHERE id=".$rowa['performa_price_range_flight'];
                                $rsz=mysqli_query($con,$queryz);
                                $rowz = mysqli_fetch_array($rsz);
                                  
                
                                echo"
                                <tr style='font-weight:bold;'>";
                                if($rowz['price2']==1){
                                  echo "<td> < ".number_format($rowz['price1'], 0, ".", ".")."</td>";
                                }else if($rowz['price2']==0){
                                  echo "<td>".number_format($rowz['price1'], 0, ".", ".")." > .. </td>";
                                }else{
                                  echo "<td>".number_format($rowz['price1'], 0, ".", ".")." - ".number_format($rowz['price2'], 0, ".", ".")."</td>";
                                }
                                echo "<td><input type='text' class='form-control' name='tpersentase".$rowa['id']."' id='tpersentase".$rowa['id']."' value='".$rowa['persentase']."' size='1'></td>
                                <td><input type='text' class='form-control' name='tnominal".$rowa['id']."' id='tnominal".$rowa['id']."' value='".$rowa['nominal']."' size='2'></td>
                                <td>
                                <select class='form-control select2' onchange='updateFlag(".$rowa['id'].",this.value)' name='tflag".$rowa['id']."' id='tflag".$rowa['id']."' style='width: 100%;'>
                                  <option selected='selected' value=0>Pilihan</option>";
                                  for ($x = 1; $x <3; $x++) {
                                    if($x==$rowa['option_price']){
                                      if($x==1){
                                        echo "<option selected='selected' value=".$x.">Persentase</option>";
                                      }else{
                                        echo "<option selected='selected' value=".$x.">Nominal</option>";
                                      }
                                    }else{
                                      if($x==1){
                                        echo "<option value=".$x.">Persentase</option>";
                                      }else{
                                        echo "<option value=".$x.">Nominal</option>";
                                      }
                                    }
                                  }
                                  echo"</select>
                                </td>
                                
                                <td>
                                <button type='button' class='btn btn-warning' onclick='editButton(".$rowa['id'].")'><i class='fa fa-edit' aria-hidden='true''></i></br>
                                <button type='button' class='btn btn-primary' onclick='editButton2(".$rowa['id'].")'><i class='fa fa-edit' aria-hidden='true''></i></button>
                                
                                </td>
                                  </tr>
                                  <tr>";

                                }
                                echo"
                                </tbody>
                                </table>

                                </div>
                            </div>
                    </div>
            
                </form>";


//var_dump($totalpax);
echo "<input type='text' id='flight_type' name='flight_type' value='Group' hidden>";


?>
<script>

  function editButton(x){
      var fd = new FormData();

       var a = $("input[name=tagent"+x+"]").val();
       var b = $("input[name=tpersentase"+x+"]").val();
       var c = $("input[name=tnominal"+x+"]").val();
       var d = document.getElementById("tflag"+x).options[document.getElementById("tflag"+x).selectedIndex].value;
       fd.append('code',1);
       fd.append('id',x);
       fd.append('persentase',b);
       fd.append('nominal',c);
       fd.append('flag',d);

       var flight_type = $("input[name=flight_type]").val();
       fd.append('flight_type',flight_type);

      
       $.ajax({
        url: 'updatePerformaPriceFlight.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
        }

      },
    });
   }

   function editButton2(x){
      var fd = new FormData();

       var b = $("input[name=tpersentase"+x+"]").val();
       var c = $("input[name=tnominal"+x+"]").val();
       var d = document.getElementById("tflag"+x).options[document.getElementById("tflag"+x).selectedIndex].value;

       fd.append('code',2);
       fd.append('id',x);
       fd.append('persentase',b);
       fd.append('nominal',c);
       fd.append('flag',d);

       var flight_type = $("input[name=flight_type]").val();
       fd.append('flight_type',flight_type);

      
       $.ajax({
        url: 'updatePerformaPriceFlight.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
          reloadPage(-18,0,0);
        }

      },
    });
   }

  function updateFlag(x,v){
    var fd = new FormData();
    fd.append('id',x);
    fd.append('flag',v);

    $.ajax({
            url: 'updateOptionPricePerformaFlight.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadPage(-18,0,0);
              }else{
                alert(response);
              }
              
            },
        });
  }

$(document).ready(function(){
    $(".chosen").chosen();
    
});
</script> 