<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
// var_dump("idd:".$_POST['id']);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Cruise Itinerary <?php echo $_POST['id'] ; ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <button type="submit" onclick="reloadManual(10,0,0)" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                                <button type="submit" onclick="reloadcruise(3,<?php echo $_POST['id']; ?>,0)" class="btn btn-warning"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  cruise_package_new where pack_id = '" . $_POST['id'] . "' order by id ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1;
                    $total=0;
                  

                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Pack ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Category</th>
                                <th>Currency</th>
                                <th>Price</th>
                                <th>Port of Chargers</th>
                                <th>Depature Tax</th>
                                <th>Tipping</th>
                                <th>Total Price</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                $total = $total+$row['harga']+$row['port_chargers']+$row['dep_tax']+$row['tipping'];
                            ?>
                                <tr>
                                    <td><?php echo $row['pack_id'] ?></td>
                                    <td><?php echo $row['start_date'] ?></td>
                                    <td><?php echo $row['end_date'] ?></td>
                                    <td><?php echo $row['category'] ?></td>
                                    <td><?php echo $row['currency'] ?></td>
                                    <td><?php echo $row['harga'] ?></td>
                                    <td><?php echo $row['port_chargers'] ?></td>
                                    <td><?php echo $row['dep_tax'] ?></td>
                                    <td><?php echo $row['tipping'] ?></td>
                                    <td><?php echo $total ?></td>
                                    <td>
                                        <button type="submit" onclick="reloadcruise(5,<?php echo $row['id'] ?>,0)" class="btn btn-warning">Edit</button>
                                        <button type='submit' onclick="del_itin(<?php echo $row['id'].','.$row['pack_id'] ?>)" class='btn btn-danger'>Delete</button>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                $total=0;
                            }
                            ?>
                        </tbody>
                    </table>
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
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>
<script>
  function del_itin(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"del_itin.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadcruise(2,y,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>