<?php
include "../site.php";
include "../db=connection.php";
$query = "SELECT * FROM imigration";
$rs=mysqli_query($con,$query);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT PASSPORT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPassport(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action=''>
                <div class='card-body'>
                  <div class=form-group'>
                   <label>Zone</label>
                    <select class='chosen' name='zone' id='zone' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($row = mysqli_fetch_array($rs)){
                      echo "<option value='".$row['zone']."'>".$row['zone']."</option>";
                    }
                    echo"</select>
                  </div>
                 <div class=form-group'>
                   <label>Normal Day</label>
                    <input type='text' required class='form-control' name='day' id='day' placeholder='Enter Normal Day'>
                  </div>
                  <div class=form-group'>
                   <label>Normal Price</label>
                    <input type='text' required class='form-control' name='price' id='price' placeholder='Enter Normal Price'>
                  </div>
                  <div class=form-group'>
                   <label>Express Day</label>
                    <input type='text' required class='form-control' name='day2' id='day2' placeholder='Enter Express Day'>
                  </div>
                  <div class=form-group'>
                   <label>Express Price</label>
                    <input type='text' required class='form-control' name='price2' id='price2' placeholder='Enter Express Price'>
                  </div>


                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='insertPassportPrice()'>Submit</button>
                </div>
              </form>
            </div>

            
                

              </div>
            </div>
          </div>
        </div>
</div>";
?>

<script>
  $(document).ready(function(){
    $(".chosen").chosen();
  });
  function insertPassportPrice(){
    var b = document.getElementById("zone").options[document.getElementById("zone").selectedIndex].value;
    var c = $("input[name=day]").val();
    var d = $("input[name=price]").val();
    var e = $("input[name=day2]").val();
    var f = $("input[name=price2]").val();

    $.ajax({
        url:"insertPassport.php",
        method: "POST",
        asynch: false,
        data:{zone:b,day:c,price:d,day2:e,price2:f},
        success:function(data){
          if(data=="success"){
            alert(data);
            reloadPassport(1,0,0);
          }else{
            alert(data);
          }
          
        }
      });
    
  }
</script>
