<?php
session_start();
require("Api_Kurs_online.php");
include "../site.php";
include "../db=connection.php";
$query_tgl = "SELECT tgl FROM  kurs_bca_field where nama != 'IDR' order by id ASC limit 1";
$rs_tgl = mysqli_query($con, $query_tgl);
$row_tgl = mysqli_fetch_array($rs_tgl);
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                        <div class="input-group-append" style="text-align: left;">
                            <div style="padding-right: 5px;">
                                <button type="button" onclick="update_kurs()" class="btn btn-success  btn-sm">Update Kurs <i id="loader" class=""></button>
                            </div>
                            <h3 class="card-title" style="font-weight:bold;">KURS BCA <?php echo date('d F Y', strtotime($row_tgl['tgl'])); ?></h3>
                        </div>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query = "SELECT * FROM  kurs_bca_field where nama != 'IDR' order by id ASC ";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>KURS</th>
                                <th>BELI</th>
                                <th>JUAL</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                // $data = array(
                                //     "nominal" => 1,
                                //     "code" => $row['nama'],
                                // );
                                // $show_kurs = get_kurs_bca($data);
                                // $result_kurs = json_decode($show_kurs, true);
                            ?>
                                <tr>
                                    <td><?php echo number_format($row['id'], 0, ",", ".")  ?></td>
                                    <td><?php echo $row['nama']  ?></td>
                                    <td><?php echo number_format($row['beli'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['jual'], 0, ",", ".")  ?></td>
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
            "iDisplayLength": 25
        });
    });
</script>
<script>
    function update_kurs(){
        var txt;
        var r = confirm("Are you sure to Update this Kurs ?");
        if (r == true) {
            $('#loader').attr('class', 'fa fa-spinner fa-spin mr-2');
            $.ajax({
			url: "KL_update.php",
			method: "POST",
			asynch: false,
			data: {},
			success: function(data) {
                alert(data);
				KL_Package(0,0,0);
			}
		});
        }
    }
</script>
