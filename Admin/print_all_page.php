<?php
session_start();
include "../db=connection.php";
$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$query_sfee_tgl = "SELECT * FROM LTP_tgl_sfee where sfee_id='" . $_POST['sfee_id'] . "' order by tgl ASC";
$rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
//  var_dump($query_sfee_tgl);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background-color: darkgreen; color: whitesmoke;">
                    <h3 class="card-title" style="font-weight:bold;">Print All Itinerary</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_sub['master_id'] ?>)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="CT_Package(2,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <div class="judul" style="padding: 10px; font-weight: bold; font-size: 20px; text-align: center;"><?php echo $row_sub['judul'] ?></div>
                    <div class="content" style="padding: 20px;">
                        <form action="preview_print_one.php?id=<?php echo $_POST['id'] ?>&grub_id=<?php echo $_POST['grub_id'] ?>&sfee_id=<?php echo $_POST['sfee_id'] ?>" method="post" target="_blank">
                            <div style="padding-bottom: 10px;">
                                <label for="">Lain-lain</label>
                                <div class="row">
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="ltwn" id="ltwn" placeholder="Twn" onchange="updateInput(this.value)"></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="lsgl" id="lsgl" placeholder="Sgl" disabled></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="lcnb" id="lcnb" placeholder="Cnb" disabled></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="linf" id="linf" placeholder="Inf" disabled></div>
                                </div>
                            </div>
                            <div style="padding-bottom: 10px;">
                                <label for="">COST TL (Pax)</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="form-control form-control-sm" type="number" name="tl_pax" id="tl_pax">
                                    </div>
                                </div>
                            </div>
                            <div style="padding-bottom: 10px;">
                            </div>
                            <div style="text-align: center; padding: 10px;">
                                <button type="submit" class="btn btn-success">Print Itinerary</button>
                            </div>
                        </form>
                        <div style="padding: 5px;">
                            <button type="button" class="btn btn-success" onclick="check_price(<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)">BREAKDOWN PRICE</button>
                            <button type="button" class="btn btn-warning" onclick="check_feetl(<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)">BREAKDOWN FEE TL</button>
                        </div>
                    </div>

                    <div id="show_pricelist"></div>
                    <div id="show_feetl_list"></div>
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
            "iDisplayLength": 10
        });
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>
<script>
    function updateInput(ish) {
        document.getElementById("lsgl").value = ish;
        document.getElementById("lcnb").value = ish;
        document.getElementById("linf").value = ish;
    }

    function check_price(x, y, z) {
        let formData = new FormData();
        var ltwn = document.getElementById("ltwn").value;
        var tl_pax = document.getElementById("tl_pax").value;

        formData.append('ltwn', ltwn);
        formData.append('tl_pax', tl_pax);
        formData.append("id", x);
        formData.append("grub_id", y);
        formData.append("sfee_id", z);

        $.ajax({
            type: 'POST',
            url: "breakdown_price_list.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#show_pricelist').html(data);
                $('#show_feetl_list').html('');
            }
        });
    }

    function check_feetl(x, y, z) {
        let formData = new FormData();
        var tl_pax = document.getElementById("tl_pax").value;

        formData.append('tl_pax', tl_pax);
        formData.append("id", x);
        formData.append("grub_id", y);
        formData.append("sfee_id", z);

        $.ajax({
            type: 'POST',
            url: "breakdown_cost_tl.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#show_feetl_list').html(data);
                $('#show_pricelist').html('');
            }
        });
    }
</script>