<?php
session_start();
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper" style="width: max-content;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Package List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <!-- <div style="padding-right: 5px;"><a class="btn btn-success btn-sm" href="export_list_tempat.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div>
                                <div style="padding-right: 5px;"> <button type="submit" onclick="LT_Package(2,0,0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  LT_itinnew order by benua ASC, negara ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 11px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>PLACE</th>
                                <th>Agent</th>
                                <th>Detail</th>
                                <th>Pax</th>
                                <th>Twin</th>
                                <th>SGL</th>
                                <th>CNB</th>
                                <th>SGL SUB</th>
                                <th>INF</th>
                                <th>Profit</th>
                                <th>SELL TWN</th>
                                <th>SELL SGL</th>
                                <th>SELL CNB</th>
                                <th>SELL SGL SUB</th>
                                <th>SEL INF</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {

                                $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row['agent_twn'] . "' && price2 >='".$row['agent_twn']."'";
                                $rs_profit = mysqli_query($con, $sql_profit);
                                $row_profit = mysqli_fetch_array($rs_profit);
                                // var_dump($sql_profit);

                                $pr = 0;
                                $dp ="";
                                if ($row_profit['id'] != "") {
                                    $pr = $row_profit['profit'];
                                    $dp = $row_profit['profit'] . "%";

                                }else{
                                    $pr = 5;
                                    $dp = "5 %";
                                }
                                $atwn =  ($row['agent_twn'] * $pr / 100) + $row['agent_twn'];
                                $asgl =  ($row['agent_sgl'] * $pr / 100) + $row['agent_sgl'];
                                $acnb =  ($row['agent_cnb'] * $pr / 100) + $row['agent_cnb'];
                                $asglsub =  ($row['agent_sglsub'] * $pr / 100) + $row['agent_sglsub'];
                                $ainfant =  ($row['agent_infant'] * $pr / 100) + $row['agent_infant'];
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['id'] ?></td>
                                    <td><?php echo  $row['kode'] ?></td>
                                    <td style="max-width: 200px;"><?php echo $row['benua'] . " - " . $row['negara'] ?></td>
                                    <td><?php echo $row['agent'] ?></td>
                                    <td style="max-width: 400px;"><?php echo $row['judul'] ?></td>
                                    <td><?php echo  "(".$row['pax']." - ". $row['pax_u']." [".$row['pax_b']."])" ?></td>
                                    <td><?php echo number_format($row['agent_twn'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['agent_sgl'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['agent_cnb'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['agent_sglsub'] , 0, ",", ".") ?></td>
                                    <td><?php echo number_format($row['agent_infant'], 0, ",", ".")  ?></td>
                                    <td style="background-color: greenyellow;"><?php echo  $dp ?></td>
                                    <td><?php echo number_format($atwn, 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($asgl, 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($acnb, 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($asglsub, 0, ",", ".") ?></td>
                                    <td><?php echo number_format($ainfant, 0, ",", ".")  ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id='loadingmsg' style='display: none;'>
                    <div class="spinner-grow text-primary" role="status">>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                    </div>
                </div>
                <div id='loadingover' style='display: none;'></div>
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
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_list_tmp.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>