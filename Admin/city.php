<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query = "SELECT * FROM city ORDER BY id DESC";
$rs = mysqli_query($con, $query);

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
                <a class="btn btn-primary btn-sm" onclick="reloadPage(-5, 0, 0)"><i class="fas fa-sync-alt"></i></a>
                <a class="btn btn-warning btn-sm" onclick="insertPage(8, 0, 0)"><i class="fas fa-plus"></i></a>
                
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <div style="padding: 10px;">
            <table id="example" class="table table-striped table-bordered table-sm" style="width:100% ; font-size: 10pt;">
              <thead style="background-color: darkgreen; color: white;">
                <tr>
                  <th>City</th>
                  <th>Country</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($rs)) {
                  $query2 = "SELECT * FROM country WHERE id=" . $row['country'];
                  $rs2 = mysqli_query($con, $query2);
                  $row2 = mysqli_fetch_array($rs2);
                ?>
                  <tr style='font-weight:bold;'>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row2['name']  ?></td>
                    <td>
                      <button type="button" onclick="editPage(-7,<?php echo $row['id'] ?>,0,0)" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button>
                      <button type="button" onclick="delCity(<?php echo $row['id'] ?>,0,0)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>

              </tfoot>
            </table>
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

    function delCity(x, y, z) {
      var txt;
      var r = confirm("Are you sure to delete?");
      if (r == true) {
        $.ajax({
          url: "delCity.php",
          method: "POST",
          asynch: false,
          data: {
            id: x
          },
          success: function(data) {
            if (data == "success") {
              reloadPage(-5, 0, 0);
            } else {
              alert("Fail to Delete");
            }
          }
        });
      }
    }
  });
</script>