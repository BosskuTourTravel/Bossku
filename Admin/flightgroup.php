<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 105px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<script>

function showImage(x){
  // Get the modal
  var modal = document.getElementById("myModal"+x);

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById("myImg"+x);
  var modalImg = document.getElementById("img"+x);
  img.onclick = function(){
    var captionText = document.getElementById("caption"+x);
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}

function closeImage(x){
	var modal = document.getElementById("myModal"+x);
	modal.style.display = "none";
}

</script>

<?php
session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Flight Group</h3>
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
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM flight ORDER BY airlines ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Airlines</th>
                <th>Tour Name</th>
                
                <th>Invoice Type</th>
                <th>PNR</th>
                <th>Detail Flight</th>
                <th>Adult</th>
                <th>Child</th>
                <th>Infant</th>
                <th>Adt Price</th>
                <th>Chd Price</th>
                <th>Inf Price</th>
                <th>Country</th>
                <th>City</th>
                <th>Staff</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                while($row=mysqli_fetch_array($rs)){
                echo "
                  <tr style='font-weight:bold;'>";
                  $queryairlines = "SELECT * FROM airlines WHERE id=".$row['airlines'];
                  $rsairlines = mysqli_query($con,$queryairlines);
                  $rowairlines = mysqli_fetch_array($rsairlines);
                  echo "<td>".$rowairlines['nama']."</td>";
                  echo "<td>".$row['tour_name']."</td>";
                  echo "<td>".$row['invoice_type']."</td>";
                  echo "<td>".$row['pnr']."</td>";
                  echo "<td>".$row['detail_flight']."</td>";
                  echo "<td>".$row['adt']."</td>";
                  echo "<td>".$row['chd']."</td>";
                  echo "<td>".$row['inf']."</td>";
                  echo "<td>".$row['adt_price']."</td>";
                  echo "<td>".$row['chd_price']."</td>";
                  echo "<td>".$row['inf_price']."</td>";

                  if($row['country']==0){
                    echo "<td>-</td>";
                  }else{
                    echo "<td>".$row['country']."</td>";
                  }
                  if($row['city']==0){
                    echo "<td>-</td>";
                  }else{
                    echo "<td>".$row['city']."</td>";
                  }
                  if($row['staff_id']!=''){
                    $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff_id'];
                    $rsstaff = mysqli_query($con,$querystaff);
                    $rowstaff = mysqli_fetch_array($rsstaff);
                    echo "<td>".$rowstaff['name']."</td>";
                  }else{
                    echo "<td>-</td>";
                  }

                  
                  
                  

                  echo "<td><input type='checkbox' name='pilihan".$row['id']."' value='".$row['id']."'></td>
                  </tr>";
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
        <!-- /.row -->
</div>";
?>

<script>
  function delPaymentDetail(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delStaff.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-3,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

