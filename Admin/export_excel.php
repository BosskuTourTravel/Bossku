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

$datareq = array(
    "type" => $type,
    "token" => $token,
    "url" => "https://uat-api.globaltix.com/api/product/list?countryId=2&cityIds=all&categoryIds=all&searchText=&page=1&lang=en"
);
$country = get_country($datareq);
$result_country = json_decode($country, true);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Export Excel</h3></br>

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
                    <div class="container-fluid" style="padding: 20px;">

                        <form action="proses_export.php" method="POST">
                            <div class="form-group">
                                <label for="">Country</label>
                                <select id="country" name="country" class="form-control">
                                    <option selected value="2">Indonesia</option>
                                    <?php
                                    // var_dump($result_country);
                                    if ($result_country['success'] == true) {
                                        foreach ($result_country['data'] as $val_country) {
                                    ?>
                                            <option value="<?php echo $val_country['id'] ?>"><?php echo $val_country['name'] ?></option>
                                        <?php

                                        }
                                    } else {
                                        ?>
                                        <option>data not available</option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option selected value="all">All</option>
                                    <option value="1">F&B</option>
                                    <option value="2">Attraction</option>
                                    <option value="3">WiFi & SIM Card</option>
                                    <option value="4">Others</option>
                                    <option value="5">Lifestyle</option>
                                    <option value="6">Entertainment</option>
                                    <option value="7">Events</option>
                                    <option value="8">Tours</option>
                                    <option value="9">Transportation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Page</label>
                                <input type="text" class="form-control" id="page" name="page" aria-describedby="pagelHelp" placeholder="Masukkan jumlah Page">
                            </div>
                            <div class="form-group">
                                <label for="">Text Keys</label>
                                <input type="text" class="form-control" id="kata" name="kata" aria-describedby="katalHelp" placeholder="Masukkan Kata Kunci">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mb-2" value="submit">Export Excel</button>
                                <!-- <button type="button" class="btn btn-primary mb-2" onclick="get_export()">Export Excel</button> -->
                            </div>
                        </form>

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
    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         "aLengthMenu": [
    //             [5, 10, 25, -1],
    //             [5, 10, 25, "All"]
    //         ],
    //         "iDisplayLength": 5
    //     });
    // });


    function get_export() {
        var a = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
        alert("ommi");
        $.ajax({
            url: "proses_export.php",
            method: "POST",
            asynch: false,
            data: {
                id: a
            },
            success: function(data) {
                if (data == 'success') {
                    swal("Proses Export Berhasil !", "silakan cek email", "success");
                }
            }
        });
    }
</script>