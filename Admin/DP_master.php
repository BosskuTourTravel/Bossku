<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$query_data = "SELECT * FROM  DP_master order by id ASC";
$rs_data = mysqli_query($con, $query_data);
$data_arr = [];
while ($row_data = mysqli_fetch_array($rs_data)) {
    $arr = [];
    $query_itin = "SELECT * FROM LT_itinnew WHERE id=" . $row_data['lt_id'];
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_array($rs_itin);
    $exp = $row_itin['expired'];

    $query = "SELECT * FROM  LT_itinerary2 where id=" . $row_data['master_id'];
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    $tgl = $row['tgl'];


    $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['status'];
    $rsStaff = mysqli_query($con, $queryStaff);
    $rowStaff = mysqli_fetch_array($rsStaff);
    $staff = $rowStaff['name'];

    $queryStaff2 = "SELECT * FROM  login_staff WHERE id=" . $row_data['staff'];
    $rsStaff2 = mysqli_query($con, $queryStaff2);
    $rowStaff2 = mysqli_fetch_array($rsStaff2);
    $staff2 = $rowStaff2['name'];

    if ($row_itin['id'] != "") {
        $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);

        $pr = 0;
        $dp = "";
        if ($row_profit['id'] != "") {
            $pr = $row_profit['profit'];
        } else {
            $pr = 5;
        }
        $atwn =  ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'];
        $arr['id'] = $row_data['id'];
        $arr['master_id'] = $row_data['master_id'];
        $arr['code'] = $row_itin['kode'];
        $arr['negara'] = $row_itin['negara'];
        $arr['judul'] = $row_itin['judul'];
        $arr['start_pax'] = $row_itin['pax'];
        $arr['until_pax'] = $row_itin['pax_u'];
        $arr['bonus_pax'] = $row_itin['pax_b'];
        $arr['price'] = $atwn;
        $arr['link'] = '';
        $arr['link_itin'] = $link;
        $arr['flayer_maker'] = $staff;
        $arr['tgl'] = $tgl;
        $arr['exp'] = $expired;
        $arr['sc'] = $staff2;

        array_push($data_arr, $arr);
    }
}
$keys = array_column($data_arr, 'negara');
array_multisort($keys, SORT_ASC, $data_arr);

?>
<div class="content-wrapper" style="width: 120%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                            <div style="padding-right: 5px;">
                            <a class="btn btn-warning btn-sm" href="../Data_promo/landtour.php" target="_BLANK">List to PNG</a>
                            </div>
                            <h3 class="card-title" style="font-weight:bold;">Data Promo Master List</h3>
                        </div>
                    </div>
                    <!-- <h3 class="card-title" style="font-weight:bold;">Data Promo Master List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                            <a class="btn btn-warning btn-sm" href="../Data_promo/landtour.php" target="_BLANK"><i class="fas fa-images"></i></a>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Master ID</th>
                                <th>Code</th>
                                <th>Country</th>
                                <th>Subject</th>
                                <th>Start Pax</th>
                                <th>Until Pax</th>
                                <th>Bonus Pax</th>
                                <th>Price Twn</th>
                                <th>Itin Maker</th>
                                <th>Created On</th>
                                <th>Copied</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_arr as $value) {
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $value['master_id']?></td>
                                    <td><?php echo $value['code']?></td>
                                    <td><?php echo $value['negara']?></td>
                                    <td><?php echo $value['judul']?></td>
                                    <td><?php echo $value['start_pax']?></td>
                                    <td><?php echo $value['until_pax']?></td>
                                    <td><?php echo $value['bonus_pax']?></td>
                                    <td><?php echo  number_format($value['price'], 0, ",", ".")?></td>
                                    <td><?php echo $value['flayer_maker']?></td>
                                    <td><?php echo $value['tgl']?></td>
                                    <td><?php echo "Copied by ".$value['sc']?></td>
                                    <td style="min-width: 100px;">
                                    <a class="btn btn-warning btn-sm"  href="preview_DP_master.php?id=<?php echo $value['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                    <a class="btn btn-warning btn-sm" href="../Data_promo/landtour.php?id=<?php echo $value['id'] ?>" target="_BLANK"><i class="fas fa-images"></i></a>
                                    <a class="btn btn-primary btn-sm" href="../Data_promo/landtour_nh.php?id=<?php echo $value['id'] ?>" target="_BLANK"><i class="fas fa-images"></i></a>
                                    <a class="btn btn-danger btn-sm" onclick="del_makelt(<?php echo $value['id'] ?>)"><i class="fa fa-trash"></i></a>
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
<script>
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "DP_delete_master.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        DP_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function copy_itin(x, y) {
        var r = confirm("Are you sure to copy this file ?");

        if (r == true) {
            let formData = new FormData();
            formData.append('id', x);
            formData.append('cabang', y);
            $.ajax({
                type: 'POST',
                url: "copy_add_LT.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    // LT_itinerary(0, 0, 0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
    }
    $(document).ready(function() {

        $('.submit_promo').on('click', e => {
            var r = confirm("Are you sure to copy this file ?");

            if (r == true) {
                const $button = $(e.target);
                const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
                const id = $button.data('id');
                const pax = $modalBody.find($("select[name=pax" + id + "]")).val();
                // alert(pax);

                let formData = new FormData();
                formData.append('id', id);
                formData.append('pax', pax);
                // work with the values here:
                $.ajax({
                    type: 'POST',
                    url: "copy_master_promo.php",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(msg) {
                        alert(msg);
                    },
                    error: function() {
                        alert("Data Gagal Diupload");
                    }
                });
            }
            // alert("on");

            //  console.log(id, hari, rute);

        });
    });
</script>