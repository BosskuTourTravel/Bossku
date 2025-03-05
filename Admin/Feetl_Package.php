<?php
include "../db=connection.php";
$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$query_sfee_tgl = "SELECT * FROM LTP_tgl_sfee where sfee_id='" . $_POST['sfee_id'] . "' order by tgl ASC";
$rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">FEE TL PACKAGE</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_sub['master_id'] ?>)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="CT_Package(5,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <div class="judul" style="padding: 10px; font-weight: bold; font-size: 20px; text-align: center;"><?php echo $row_sub['judul'] ?></div>
                    <div class="content" style="padding: 20px;">
                        <form action="cetak_custom_one.php?id=<?php echo $_POST['id'] ?>&grub_id=<?php echo $_POST['grub_id'] ?>&sfee_id=<?php echo $_POST['sfee_id'] ?>" method="post" target="_blank">
                            <div style="padding-bottom: 10px;">
                                <label for="">Custom Price</label>
                                <div class="row">
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="pax" id="pax" placeholder="Pax"></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="twn" id="twn" placeholder="Twn"></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="sgl" id="sgl" placeholder="Single"></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="cnb" id="cnb" placeholder="CNB"></div>
                                    <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="inf" id="inf" placeholder="Infant"></div>
                                </div>
                            </div>
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>TL FEE PER DAY</label>
                                        <input class="form-control form-control-sm" type="number" name="tl_fee" id="tl_fee">
                                    </div>
                                    <div class="col-md-3">
                                        <label>TL MEAL</label>
                                        <input class="form-control form-control-sm" type="number" name="tl_meal" id="tl_meal">
                                    </div>
                                    <div class="col-md-3">
                                        <label>TL VOUCHER TLPN</label>
                                        <input class="form-control form-control-sm" type="number" name="tl_tlpn" id="tl_tlpn">
                                    </div>
                                    <div class="col-md-3">
                                        <label>TL SFEE PER DAY</label>
                                        <input class="form-control form-control-sm" type="number" name="tl_sfee" id="tl_sfee">
                                    </div>
                                </div>
                            </div>
                            <div style="padding-bottom: 10px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">TGL KEBERANGKATAN</label>
                                            <select class="form-control" id="tgl_ber" name="tgl_ber">
                                                <option value="">Pilih Tgl Keberangkatan</option>
                                                <?php
                                                while ($row_sfee_tgl = mysqli_fetch_array($rs_sfee_tgl)) {
                                                ?>
                                                    <option value="<?php echo $row_sfee_tgl['tgl'] ?>"><?php echo $row_sfee_tgl['tgl'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
<script>
    function check_feetl(x, y, z) {
        let formData = new FormData();
        var tl_pax = document.getElementById("tl_pax").value;
        var tl_fee = document.getElementById("tl_fee").value;
        var tl_meal = document.getElementById("tl_meal").value;
        var tl_tlpn = document.getElementById("tl_tlpn").value;
        var tl_sfee = document.getElementById("tl_sfee").value;

        formData.append('tl_pax', tl_pax);
        formData.append("id", x);
        formData.append("grub_id", y);
        formData.append("sfee_id", z);
        formData.append("tl_fee",tl_fee);
        formData.append("tl_meal",tl_meal);
        formData.append("tl_tlpn",tl_tlpn);
        formData.append("tl_sfee",tl_sfee);

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

    function check_price(x, y, z) {
        let formData = new FormData();
        var ltwn = document.getElementById("ltwn").value;
        var tl_pax = document.getElementById("tl_pax").value;
        var tl_fee = document.getElementById("tl_fee").value;
        var tl_meal = document.getElementById("tl_meal").value;
        var tl_tlpn = document.getElementById("tl_tlpn").value;
        var tl_sfee = document.getElementById("tl_sfee").value;

        formData.append('ltwn', ltwn);
        formData.append('tl_pax', tl_pax);
        formData.append("id", x);
        formData.append("grub_id", y);
        formData.append("sfee_id", z);
        formData.append("tl_fee",tl_fee);
        formData.append("tl_meal",tl_meal);
        formData.append("tl_tlpn",tl_tlpn);
        formData.append("tl_sfee",tl_sfee);

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
</script>