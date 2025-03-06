 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];
 $count2 = $count + 1;
 echo "
 <table name='t".$_POST['count']."' id='t".$_POST['count']."' class='table-sm' style='font-size:12px;'>
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

  // echo "<tr name='r".$_POST['count']."' id='r".$_POST['count'].">";
  // echo "<td><input type='text' class='form-control' name='name".$count."' id='name".$count."' placeholder=''></td>";
  // echo "<td><input type='text' class='form-control' name='phone".$count."' id='phone".$count."' placeholder=''></td>";
  // echo "<td><input type='text' class='form-control' name='address".$count."' id='address".$count."' placeholder=''></td>";
  // echo "<td><input type='text' class='form-control' name='email".$count."' id='email".$count."' placeholder=''></td>";
  // echo "<td>
  // <i class='fa fa-minus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='deleteDetailSiswa(".$_POST['count'].")' aria-hidden='true'></i>
  // </td>";
  // echo "</tr>";
 echo "<tr name='r".$_POST['count']."' id='r".$_POST['count']."'>
 <td>".$count2."</td>
<td><input type='text' class='form-control' name='name".$count."' id='name".$count."' placeholder=''></td>
<td><input type='text' class='form-control' name='phone".$count."' id='phone".$count."' placeholder=''></td>
<td><input type='text' class='form-control' name='address".$count."' id='address".$count."' placeholder=''></td>
<td><input type='text' class='form-control' name='email".$count."' id='email".$count."' placeholder=''></td>
<td><i class='fa fa-minus' style='color:green;position:absolute;text-align: center;' onclick='deleteDetailSiswa(".$_POST['count'].")' aria-hidden='true'></i></td>


 </tr>";

  echo "</tbody>
</table>";

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

  function deleteDetailSiswa(y){
    var tempCount = parseInt($("input[name=tcount]").val()) - 1;
    $('#r'+y).remove();
    $('#t'+y).remove(); 
     //alert($("input[name=tb]").val());
    
  }

  // $("#but_upload").click(function(){
  //   var totalsiswa = $("input[name=tcount]").val();
  //   var tid = $("input[name=tid]").val();
  //   var fd = new FormData();
  //   fd.append('totalsiswa',totalsiswa);
  //   fd.append('id',tid);
   
  //   for (var i = 0; i < totalsiswa; i++) {
  //      var txtName = "name"+i;
  //      var name = $("input[name=name"+i+"]").val();
  //      var txtPhone = "phone"+i;
  //      var phone = $("input[name=phone"+i+"]").val();
  //      var txtAddress = "address"+i;
  //      var address = $("input[name=address"+i+"]").val();
  //      var txtEmail = "email"+i;
  //      var email = $("input[name=email"+i+"]").val();
       
  //      fd.append(txtName,name);
  //      fd.append(txtPhone,phone);
  //      fd.append(txtAddress,address);
  //      fd.append(txtEmail,email);
  //   }
  //   $.ajax({
  //     url: 'insertDetailSiswa.php',
  //     type: 'post',
  //     data: fd,
  //     contentType: false,
  //     processData: false,
  //     success: function(response){
  //       if(response=="success"){
  //         alert(response);
  //         //reloadCustomer(0,0,0);
  //       }
  //     },
  //   });
    
  // });
 	

 </script>
