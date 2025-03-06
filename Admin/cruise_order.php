<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Cruise Order</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <!-- <button type="submit" onclick="insertPage(29,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  checkout_cruise order by id DESC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl</th>
                                <th>Data Pemesan</th>
                                <th>Detail Cruise</th>
                                <th>Jumlah Pesanan</th>
                                <th>Detail Price</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                $query_bg = "SELECT * FROM Cruise_ship where id=" . $row['ship'];
                                $rs_bg = mysqli_query($con, $query_bg);
                                $row_bg = mysqli_fetch_array($rs_bg);

                                $query_package = "SELECT * FROM Itinerary_Cuise where id=" . $row['pack_id'];
                                $rs_package = mysqli_query($con, $query_package);
                                $row_package = mysqli_fetch_array($rs_package);

                                $query_cabin = "SELECT * FROM cruise_package_new where id=" . $row['cabin'];
                                $rs_cabin = mysqli_query($con, $query_cabin);
                                $row_cabin = mysqli_fetch_array($rs_cabin);
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row['tanggal'] ?></td>
                                    <td>
                                        <div class="div"><b>Nama Pembeli</b> : <?php echo $row['customer'] ?></div>
                                        <div class="div"><b>Email</b> : <?php echo $row['email'] ?></div>
                                        <div class="div"><b>No Telpon</b> : <?php echo $row['tlpn'] ?></div>
                                    </td>
                                    <td>
                                        <div class="div"><b>Nama Kapal</b> : <?php echo $row_bg['name'] ?></div>
                                        <div class="div"><b>Package Name</b> : <?php echo $row_package['sub'] ?></div>
                                        <div class="div"><b>Cabin Name</b> : <?php echo $row_cabin['category'] ?></div>
                                        <div class="div"><b>Start Date</b> : <?php echo $row_cabin['start_date'] ?></div>
                                    </td>
                                    <td>
                                        <div class="div"><b>Adult </b> : <?php echo  $row['adult'] ?></div>
                                        <div class="div"><b>Child </b> : <?php echo  $row['child'] ?></div>
                                    </td>
                                    <td>
                                        <div class="div"><b>Cabin Price </b> : <?php echo $row['currency']." ". $row['cabin_price'] ?></div>
                                        <div class="div"><b>Depature Tax</b> : <?php echo  $row['currency']." ". $row['dept_price'] ?></div>
                                        <div class="div"><b>Port Chargers </b> : <?php echo $row['currency']." ". $row['port_price'] ?></div>
                                        <div class="div"><b>Service </b> : <?php echo $row['currency']." ". $row['service_price'] ?></div>
                                        <div class="div"><b>Total Price </b> : <?php echo $row['currency']." ". $row['total_price'] ?></div>
                                    </td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td>
                                    <!-- <button type="submit" onclick="" style="font-size:13px;" class="btn btn-success">Issued</button> -->
                                    <button type="submit" onclick="" style="font-size:13px;" class="btn btn-warning">Checkout</i></button>
                                    </td>
                                </tr>
                            <?php
                                $no++;
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