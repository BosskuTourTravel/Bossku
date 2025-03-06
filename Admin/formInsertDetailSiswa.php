<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querymonth = "SELECT * FROM month";
$rsmonth=mysqli_query($con,$querymonth);

$query2 = "SELECT * FROM customer_list WHERE id=".$_POST['id'];
$rs2=mysqli_query($con,$query2);
$row2=mysqli_fetch_array($rs2);

$description = $row['description'];
$customername = $row2['customer_name'];
$customerphone = $row2['phone_number'];



echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT DETAIL SISWA
                </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadCustomer(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->

              <div class=form-group'>
              <label>Tambah Siswa</label>";
              echo "<i class='fa fa-plus' style='color:green;margin-left:2%;text-align: center;' onclick='getSiswa()' aria-hidden='true'></i>";
              // echo "<select class='chosen' name='siswa_count' id='siswa_count'>
              // <option selected='selected' value=0>Jumlah Siswa</option>";
              $query_detailsiswa = "SELECT COUNT(*) as total FROM siswa WHERE customer_id=".$_POST['id'];
              $rs_detailsiswa=mysqli_query($con,$query_detailsiswa);
              $row_detailsiswa = mysqli_fetch_assoc($rs_detailsiswa);

              $query_detailsiswa2 = "SELECT * FROM siswa WHERE customer_id=".$_POST['id'];
              $rs_detailsiswa2=mysqli_query($con,$query_detailsiswa2);


              // for ($x = 1; $x <= 20; $x++){
              //   if($x==$row_detailsiswa['total']){
              //     echo "<option selected='selected' value=".$x.">".$x."</option>";
              //   }else{
              //     echo "<option value=".$x.">".$x."</option>";
              //   }
                
              // }
              // echo "</select>";

              echo "</div>";
              if($row_detailsiswa['total']>0){
                echo "<input type='text' name='tcount' id='tcount' value='".$row_detailsiswa['total']."' hidden>";
              }else{
                echo "<input type='text' name='tcount' id='tcount' value=0 hidden>";
              }
              echo "<input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>
              <div class=form-group' name='divsiswa' id='divsiswa'>";

              if($row_detailsiswa['total']>0){
                $countSiswa = 0;
                while($row_detailsiswa2 = mysqli_fetch_array($rs_detailsiswa2)){
                  $count3 = $countSiswa + 1;
                 echo "
                 <table name='t".$countSiswa."' id='t".$countSiswa."' class='table-sm' style='font-size:12px;'>
                 <thead>
                 <tr>
                 <th>NO</th>
                 <th>NAMA</th>
                 <th>PHONE</th>
                 <th>ADDRESS</th>
                 <th>EMAIL</th>
                 <th>OPTION</th>

                 </tr>
                 </thead>
                 <tbody id='myTable'>";

                 echo "<tr name='r".$_POST['count']."' id='r".$_POST['count']."'>
                 <td>".$count3."</td>
                 <td><input type='text' class='form-control' name='name".$countSiswa."' id='name".$countSiswa."' value='".$row_detailsiswa2['name']."' placeholder=''></td>
                 <td><input type='text' class='form-control' name='phone".$countSiswa."' id='phone".$countSiswa."' value='".$row_detailsiswa2['phone']."' placeholder=''></td>
                 <td><input type='text' class='form-control' name='address".$countSiswa."' id='address".$countSiswa."' value='".$row_detailsiswa2['address']."' placeholder=''></td>
                 <td><input type='text' class='form-control' name='email".$countSiswa."' id='email".$countSiswa."' value='".$row_detailsiswa2['email']."' placeholder=''></td>
                 <td><i class='fa fa-minus' style='color:green;position:absolute;text-align: center;' onclick='deleteDetailSiswa(".$countSiswa.")' aria-hidden='true'></i></td>


                 </tr>";

                 echo "</tbody>
                 </table>";
                 $countSiswa = $countSiswa + 1;
               }
              }

              echo "</div>
              <div class='card-footer'>
              <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
              </div>
              </br>
              
            </div>

            
                

              
            </div>
          </div>
        </div>
</div>";
?>

<script>
  $(document).ready(function(){
    $(".chosen").chosen();
    $('#summernote').summernote();
    $('#siswa_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'siswa_count.php',
          data:{'count':count},
          success:function(data){
           $('#divsiswa').html(data);
         }
       });
      });
  });

  function getSiswa(){
       var count = $("input[name=tcount]").val();
       var tempCount = parseInt($("input[name=tcount]").val()) + 1;
       $.ajax({
        type:'POST',
        url:'siswa_count.php',
        data:{'count':count},
        success:function(data){
         $("#divsiswa").append(data);
         $("input[name=tcount]").val(tempCount);
       }
     });
  }

  $("#but_upload").click(function(){
    var totalsiswa = $("input[name=tcount]").val();
    var tid = $("input[name=tid]").val();
    var fd = new FormData();
    fd.append('totalsiswa',totalsiswa);
    fd.append('id',tid);
   
    for (var i = 0; i < totalsiswa; i++) {
       var txtName = "name"+i;
       var name = $("input[name=name"+i+"]").val();
       var txtPhone = "phone"+i;
       var phone = $("input[name=phone"+i+"]").val();
       var txtAddress = "address"+i;
       var address = $("input[name=address"+i+"]").val();
       var txtEmail = "email"+i;
       var email = $("input[name=email"+i+"]").val();
       
       fd.append(txtName,name);
       fd.append(txtPhone,phone);
       fd.append(txtAddress,address);
       fd.append(txtEmail,email);
    }
    $.ajax({
      url: 'insertDetailSiswa.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response=="success"){
          alert(response);
          reloadCustomer(0,0,0);
        }
      },
    });
    
  });
</script>
