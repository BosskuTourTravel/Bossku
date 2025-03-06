<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$querytour = "SELECT * FROM country";
$rstour = mysqli_query($con, $querytour);
var_dump($query);
?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight:bold;">Print Package </h3>
          <div class="card-tools">
            <div class="input-group input-group-sm">
              <div class="input-group-append" style="text-align: right;">
                <a class="btn btn-primary btn-sm" onclick="reloadPage(-5, 0, 0)"><i class="fa fa-arrow-left"></i></a>
                <a class="btn btn-warning btn-sm" onclick="insertPage(8, 0, 0)"><i class="fas fa-sync-alt"></i></a>

              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <div style="padding: 10px;">
              <div class="card-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter City Name">
                </div>
                <div class="form-group">
                  <label>Country</label>
                  <select class="form-control" name="country" id="country">
                    <option selected="selected" value=0>Pilihan</option>
                    <?php

                    while ($rowtour = mysqli_fetch_array($rstour)) {
                    ?>
                      <option value="<?php echo $rowtour['id'] ?>"><?php echo $rowtour['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-primary" id="but_upload" onclick="add_city()">Submit</button>
              </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>

  <!-- /.row -->
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "aLengthMenu": [
        [5, 10, 25, -1],
        [5, 10, 25, "All"]
      ],
      "iDisplayLength": 10
    });

    $(".tip").tooltip({
      placement: 'top',
      trigger: 'hover'
    });
  });

  function add_city() {
      alert("on");
      var fd = new FormData();
      var a = $("input[name=name]").val();
      var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
      fd.append('name', a);
      fd.append('country', b);
      $.ajax({
        url: 'insertCity.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
          alert(response);
          reloadPage(-5, 0, 0);
        },
      });

    }
</script>