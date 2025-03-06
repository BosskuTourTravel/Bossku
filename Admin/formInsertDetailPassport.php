<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querymonth = "SELECT * FROM month";
$rsmonth=mysqli_query($con,$querymonth);


$query = "SELECT * FROM invoice WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row=mysqli_fetch_array($rs);

$query2 = "SELECT * FROM customer_list WHERE id=".$row['customer_id'];
$rs2=mysqli_query($con,$query2);
$row2=mysqli_fetch_array($rs2);

$description = $row['description'];
$customername = $row2['customer_name'];
$customerphone = $row2['phone_number'];

$tempName = preg_split ("/[;]+/", $row['additional_name']);
$tempPax = preg_split ("/[;]+/", $row['additional_pax']);
$tempRoom = '';
for($i=0; $i<count($tempName); $i++){
  if($i==5){
    if($tempPax[$i]>0){
      $tempRoom = $tempRoom . $tempPax[$i] . " Single ";
    }
  }else if($i==6){
    if($tempPax[$i]>0){
      $tempRoom = $tempRoom . $tempPax[$i] . " Twin ";
    }
  }else if($i==7){
    if($tempPax[$i]>0){
      $tempRoom = $tempRoom . $tempPax[$i] . " Twin Extra ";
    }
  }else if($i==8){
    if($tempPax[$i]>0){
      $tempRoom = $tempRoom . $tempPax[$i] . " Double ";
    }
  }else if($i==9){
    if($tempPax[$i]>0){
      $tempRoom = $tempRoom . $tempPax[$i] . " Double Extra ";
    }
  }

}

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT DETAIL PASSPORT</br></br>
                Room : ".$tempRoom."</br>
                Remarks : ".$description."
                </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadInvoice(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='#'>
             <table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
             <thead>
                <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>SEX</th>
                <th>NATIONAL</th>
                <th>DOB</th>
                <th>POB</th>
                <th>NO PASSPORT</th>
                <th>DOE</th>
                <th>ISSUED</th>
                <th>TELEPHONE</th>
               
                </tr>
                </thead>
                <tbody id='myTable'>";
                

                $totalPax = 0;
                $totalAdult = 0;
                $totalCWB = 0;
                $totalCNB = 0;
                $totalInfant = 0;
                $totalSingle = 0;

                $tempPax = preg_split ("/[;]+/", $row['additional_pax']);
                for($i=0; $i<count($tempPax); $i++){
                  if($i==0){
                    $totalAdult = $totalAdult + $tempPax[$i];
                  }
                  if($i==1){
                    $totalCWB = $totalCWB + $tempPax[$i];
                  }
                  if($i==2){
                    $totalCNB = $totalCNB + $tempPax[$i];
                  }
                  if($i==3){
                    $totalInfant = $totalInfant + $tempPax[$i];
                  }
                  if($i==4){
                    $totalSingle = $totalSingle + $tempPax[$i];
                  }

                }
                $totalPax = $totalAdult + $totalCWB + $totalCNB + $totalInfant + $totalSingle;
                echo "<input type='text' name='totalpax' id='totalpax' value='".$totalPax."' hidden>";
                echo "<input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>";
                echo "<input type='text' name='rooming' id='rooming' value='".$tempRoom."' hidden>";
                echo "<input type='text' name='remark' id='remark' value='".$description."' hidden>";
                for ($i = 0; $i < $totalPax; $i++) {
                  echo "<tr>";

                  $no = $i + 1;
                  echo "<td>".$no."</td>";
                  echo "<td><input type='text' class='form-control' name='name".$i."' id='name".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='sex".$i."' id='sex".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='national".$i."' id='national".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='dob".$i."' id='dob".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='pob".$i."' id='pob".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='nopassport".$i."' id='nopassport".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='doe".$i."' id='doe".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='issued".$i."' id='issued".$i."' placeholder=''></td>";
                  echo "<td><input type='text' class='form-control' name='telephone".$i."' id='telephone".$i."' value='".$customername." ".$customerphone."' placeholder=''></td>";

                  echo "</tr>";
                }
                echo "</tbody>
             </table>
               

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                </div>
              </form>
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
  });

  $("#but_upload").click(function(){
    var totalpax = $("input[name=totalpax]").val();
    var tid = $("input[name=tid]").val();
    var rooming = $("input[name=rooming]").val();
    var remark = $("input[name=remark]").val();
    var fd = new FormData();
    fd.append('totalpax',totalpax);
    fd.append('id',tid);
    fd.append('rooming',rooming);
    fd.append('remark',remark);
    for (var i = 0; i < totalpax; i++) {
       var txtName = "name"+i;
       var name = $("input[name=name"+i+"]").val();
       var txtSex = "sex"+i;
       var sex = $("input[name=sex"+i+"]").val();
       var txtNational = "national"+i;
       var national = $("input[name=national"+i+"]").val();
       var txtDob = "dob"+i;
       var dob = $("input[name=dob"+i+"]").val();
       var txtPob = "pob"+i;
       var pob = $("input[name=pob"+i+"]").val();
       var txtNoPassport = "nopassport"+i;
       var nopassport = $("input[name=nopassport"+i+"]").val();
       var txtDoe = "doe"+i;
       var doe = $("input[name=doe"+i+"]").val();
       var txtIssued = "issued"+i;
       var issued = $("input[name=issued"+i+"]").val();
       var txtTelephone = "telephone"+i;
       var telephone = $("input[name=telephone"+i+"]").val();
       fd.append(txtName,name);
       fd.append(txtSex,sex);
       fd.append(txtNational,national);
       fd.append(txtDob,dob);
       fd.append(txtPob,pob);
       fd.append(txtNoPassport,nopassport);
       fd.append(txtDoe,doe);
       fd.append(txtIssued,issued);
       fd.append(txtTelephone,telephone);

    }
    $.ajax({
    	url: 'insertDetailPassport.php',
    	type: 'post',
    	data: fd,
    	contentType: false,
    	processData: false,
    	success: function(response){
    		if(response=="success"){
    			alert(response);
    			reloadInvoice(0,0,0);
    		}
    	},
    });
    
  });
</script>
