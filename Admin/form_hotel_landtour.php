<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
     <div class="row" style="width: 100%;">
          <div class="col-12">
               <div class="card">
                    <div class="card-header">
                         <h3 class="card-title" style="font-weight:bold;">Form Insert Hotel Landtour</h3>
                         <div class="card-tools">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                   <div class="input-group-append" style="text-align: left;">
                                        <button type="button" onclick="LT_Package(13,0,0)" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                         <div>
                              <label>File input Rute</label>
                              <form mehtod="post" id="import_hotel_lt">
                                   <div class="form-group">
                                        <input type="file" name="excel_hotel_lt" id="excel_hotel_lt">
                                   </div>
                              </form>
                              <div id="result_hotel_lt" style="padding-bottom: 20px;">
                              </div>
                         </div>
                    </div>
                    <!-- /.card-body -->
               </div>
               <!-- /.card -->
          </div>
     </div>
     <!-- /.row -->
</div>
<script type="text/javascript">
     $(document).ready(function() {
          $('#excel_hotel_lt').change(function() {
               $('#import_hotel_lt').submit();
          });
          $('#import_hotel_lt').on('submit', function(event) {
               event.preventDefault();
               $.ajax({
                    url: "insert_hotel_landtour.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                         $('#result_hotel_lt').html(data);
                         $('#excel_hotel_lt').val('');
                    }
               });
          });
     });
</script>