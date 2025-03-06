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
                <h3 class='card-title' style='font-weight:bold;'>Pembayaran</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadManual(3,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>

                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";

                $query = "SELECT * FROM payment_detail_hotel WHERE invoice_id = ".$_POST['id']." ORDER BY payment_number ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Invoice Number</th>
                <th>Pembayaran Ke</th>
                <th>Payment Price</th>
                <th>Tipe Pembayaran</th>
                <th>Bank Pembayaran</th>
                <th>Tanggal Customer Transfer</th>
                <th>Bukti Pembayaran</th>
                <th>Status Cek</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                while($row=mysqli_fetch_array($rs)){
                  
                   $querybank = "SELECT * FROM bank WHERE id=".$row['payment_bank'];
                  $rsbank = mysqli_query($con,$querybank);
                  $rowbank = mysqli_fetch_array($rsbank);
                  $tempCount = $row['invoice_id'] + 15000;
                  echo "<input name='tid' id='tid' type='text' value='".$row['id']."' hidden>";
                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$tempCount."</td>
                  <td>".$row['payment_number']."</td>
                  <td>Rp ".number_format($row['payment_price'], 0, ".", ".")."</td>
                  <td>".$row['payment_type']."</td>
                  <td>".$rowbank['short']." ( ".$rowbank['nama']." )</td>
                  <td>".$row['tanggal_transfer']."</<td>
                  <td><img id='myImg".$row['id']."' onclick='showImage(".$row['id'].")' src='https://2canholiday.com/".$row['payment_photo']."' style='height:150px;width:100px;'>
                  <div id='myModal".$row['id']."'  class='modal' data-backdrop='dynamic'>
                  <span id='closeModal".$row['id']."' onclick='closeImage(".$row['id'].")' class='close'>&times;</span>
                  <img  class='modal-content' id='img".$row['id']."'>
                  <div id='caption".$row['id']."'></div>
                  </div></td>";
                  if($row['status_cek']==0){
                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                  }else{
                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                  }
                  echo "<td><button type='submit' onclick='updatePayment(3,".$row['id'].",".$row['invoice_id'].")' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                  </tr>";

                  echo "<tr>
                  <td><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";
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



