<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
     <div class="row" style="width: 400%;">
          <div class="col-12">
               <div class="card">
                    <div class="card-header">
                         <h3 class="card-title" style="font-weight:bold;">Form Insert Flight</h3>
                         <div class="card-tools">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                   <div class="input-group-append" style="text-align: left;">
                                        <button type="button" onclick="LT_Package(15,0,0)" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                                        <a class="btn btn-warning" href="/excel/Format_Flight_input.xlsx" download="Flight_input.xlsx" role="button">Format Upload</a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                         <div>
                              <label>File input Rute</label>
                              <form mehtod="post" id="import_flight">
                                   <div class="form-group">
                                        <input type="file" name="excel_flight" id="excel_flight">
                                   </div>
                              </form>
                              <div id="result_flight" style="padding-bottom: 20px;">
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
          $('#excel_flight').change(function() {
               $('#import_flight').submit();
          });
          $('#import_flight').on('submit', function(event) {
               event.preventDefault();
               $.ajax({
                    url: "insert_master_flight.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                         $('#result_flight').html(data);
                         $('#excel_flight').val('');
                    }
               });
          });
     });
</script>