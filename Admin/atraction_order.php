<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../Activity/Api/Api_request.php";
////// request token ////////////////
$token = get_token();
$results_token = json_decode($token, true);
//  echo $results_token['token'];
////////////////////////////////////
$type = $results_token['type'];
$token = $results_token['token'];
$_SESSION['token'] = $token;
$_SESSION['type'] = $type;
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Attraction Order</h3>
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
                    $query = "SELECT * FROM  atraction_order order by id DESC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl</th>
                                <th>Data Pemesan</th>
                                <th>Detail Pesanan</th>
                                <th>Total Price</th>
                                <th>Kode Booking</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {

                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row['tgl'] ?></td>
                                    <td>
                                        <div class="div"><b>Nama Pembeli</b> : <?php echo $row['customer'] ?></div>
                                        <div class="div"><b>Email</b> : <?php echo $row['email'] ?></div>
                                        <div class="div"><b>No Telpon</b> : <?php echo $row['tlpn'] ?></div>
                                    </td>
                                    <td>
                                        <?php
                                        $data = stripslashes($row['produk']);
                                        $cart_data = json_decode($data, true);
                                        foreach ($cart_data as $keys => $values) {
                                            $datareq = array(
                                                "type" => $_SESSION['type'],
                                                "token" => $_SESSION['token'],
                                                "url" => $values["item_id"]
                                            );
                                            $tiket = get_tiket($datareq);
                                            $result_tiket = json_decode($tiket, true);
                                            $tiket_value = $result_tiket['data'];

                                        ?>
                                            <div class="div" style="color: green;"><b><?php echo $tiket_value['attraction']['title'] ?></b></div>
                                            <div class="div"><b>Merchant</b> : <?php echo $tiket_value['attraction']['merchantName'] ?></div>
                                            <div class="div"><b>Package</b> : <?php echo $tiket_value['name'] ?></div>
                                            <?php
                                            foreach ($tiket_value['variants'] as $var => $variants) {
                                                if ($variants['ticketTypeId'] == $tiket_value['id']) {
                                            ?>
                                                    <div class="div"><b>Tiket Type</b> : <?php echo $variants['variantName']; ?></div>
                                                    <div class="div"><b>Price</b> : <?php echo $tiket_value['currency'] . " " . $variants['originalPrice']; ?></div>
                                            <?php
                                                }
                                            }
                                            ?>

                                            <div class="div"><b>Date</b> : <?php echo $values["item_tgl"] ?></div>
                                            <div class="div"><b>Quantity</b> : <?php echo $values["item_quantity"] ?></div>
                                            </br>
                                        <?php
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <div class="div"><?php echo $row['currency'] . " " . $row['total'] ?></div>
                                    </td>
                                    <td><?php echo $row['bookid'] ?></td>
                                    <td><?php
                                        if ($row['status'] == "0") {
                                        ?>
                                            <span class="badge badge-danger">Unpaid</span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge badge-success">Paid</span>
                                        <?php
                                        }
                                        ?>
                                    <td>
                                        <?php
                                        if ($row['status'] == "0") {
                                        ?>
                                            <button type="button" style="font-size:13px;" class="btn btn-warning" onclick="get_order(<?php echo $row['id'] ?>)">Issued</i></button>
                                        <?php

                                        } else {
                                        ?>
                                            <input name="book" id="book" value="<?php echo $row['bookid'] ?>" type='hidden'>
                                            <button type="button" style="font-size:13px;" class="btn btn-success" onclick="get_etiket()">Print Tiket</i></button>
                                        <?php

                                        }
                                        ?>
                                        <!-- <button type="submit" onclick="" style="font-size:13px;" class="btn btn-success">Issued</button> -->

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


    function get_order(x) {
        // alert(x);
        var txt;
        var r = confirm("Apakah Anda yakin untuk melakukan Issud ?");
        if (r == true) {
            $.ajax({
                url: "checkout_order.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == 'success') {
                        swal("Itinerary akan di kirimkan ke email anda !", "silakan cek email", "success");
                        // window.location.href = "https://www.2canholiday.com/Admin/";
                    }
                    location.reload(true);
                }
            });
        }
    }

    function get_etiket() {
        var book = $("input[name=book]").val();
        // alert(book);
        $.ajax({
            url: "print_etiket.php",
            method: "POST",
            asynch: false,
            data: {
                id: book
            },
            success: function(data) {
                // if (data == 'success') {
                //     swal("Itinerary akan di kirimkan ke email anda !", "silakan cek email", "success");
                //     window.location.href = "https://www.2canholiday.com/Activity/chart.php";
                // }
                window.location.href = data;
            }
        });
    }
</script>