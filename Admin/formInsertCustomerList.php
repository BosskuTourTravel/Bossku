<?php
include "../site.php";
include "../db=connection.php";

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT CUSTOMER LIST</h3>
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
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='#'>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Phone Number</label>
                    <input type='text' class='form-control' name='phone' id='phone' placeholder='Enter Phone Number'>
                  </div>

                  <div id='divCustomer' name='divCustomer'></div>
                  
                  </div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='insertCustomerList()'>Submit</button>
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

  $("#phone").keyup(function(){
    var x = this.value;
    $.ajax({
      type:'POST',
      url:'getInsertCustomerList.php',
      data:{'phone':x},
      success:function(data){
        $('#divCustomer').html(data);
      }
    });
  });

  function insertCustomerList(){
    var b = $("input[name=phone]").val();

    if(b=='' || b=='0'){
      alert("Nomer Telephone Customer Wajib Diisi Terlebih Dahulu!");
    }else{
      var a = $("input[name=name]").val();
      var c = $("input[name=type]").val();
      var e = $("input[name=pax]").val();
      var f = document.getElementById("month").options[document.getElementById("month").selectedIndex].value;
      var g = $("input[name=email]").val();
      var d = $("input[name=from]").val();
      var x = document.getElementById("cityc").options[document.getElementById("cityc").selectedIndex].value;
      var y = document.getElementById("customer_category").options[document.getElementById("customer_category").selectedIndex].value;
      var j = $("input[name=departure]").val();
      var l = $("input[name=address]").val();
      var h = "";
        for (var i = 1; i <= $("#country_count").val(); i++) {
          if(i==1){
            h = h + $("#country"+i).val();
          }
          else{
            h = h + ";" + $("#country"+i).val();
          }
        }
      $.ajax({
        url:"insertCustomerList.php",
        method: "POST",
        asynch: false,
        data:{name:a,phone:b,type:c,destination:h,pax:e,month:f,email:g,from:d,city:x,customer_category:y,departure:j,address:l},
        success:function(data){
        	if(data=='success'){
        		reloadCustomer(0,0,0);
        	}else{
        		alert(data);
        	}
        }
      });
    }
    
    
  }
</script>
