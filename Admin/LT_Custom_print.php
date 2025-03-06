<?php
session_start();
include "../db=connection.php";
include "Api_LT_total.php";
$query = "SELECT * FROM  checkbox_include2 order by id ASC ";
$rs = mysqli_query($con, $query);
$no = 1;
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">COSTUM PRINT</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <div class="container" style="max-width:85%; padding: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <div style="text-align: center;">BIAYA TAMBAHAN</div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="include">
                                            <form action="preview_PT.php?id=<?php echo $_POST['id'] ?>" method="post" target="_blank">

                                                <?php
                                                $auto = array(0,18,19,26,27,36,37,38,39,1);
                                                while ($row = mysqli_fetch_array($rs)) {
                                                    // var_dump($row['id']);
                                                    $cocok = array_search($row['id'], $auto);
                                                    if ($cocok != "") {
                                                ?>
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" aria-label="Checkbox for following text input" id="chck<?php echo $row['id'] ?>" name="include[]" value="<?php echo $row['id'] ?> ">
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" name="val<?php echo $row['id'] ?>" value="<?php echo $row['nama'] ?>" disabled>
                                                        </div>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <div class="input-group input-group-sm mb-3">
                                                    <button type="submit" class="btn btn-success btn-sm">Print</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script>
    function add_print(x) {
        var count = $("input[name=rata]").val();
        var hasil = [];
        for (var i = 1; i <= count; i++) {
            if ($('#chck' + i).is(":checked")) {
                var value = $("#chk" + i).val();
                hasil.push(value);
            }
        }
        var vh = JSON.stringify(hasil);
        // alert(count);
        window.open("https://www.2canholiday.com/Admin/preview_PT.php?id=" + x + "&value=" + vh);
    }
</script>