<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM cruise_package_new WHERE id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

?>
<div class="content-wrapper">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM EDIT ITENERARY</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" onclick="reloadcruise(2,<?php echo $row['pack_id'] ?>,0)" class="btn btn-default"><i class="fa fa-arrow-left"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="insertPricePackage.php">
                            <div class="card-body">
                                <!-- content disini -->
                                <div class="form-group">
                                    <label>START DATE</label>
                                    <input type="text" class="form-control" name="str_date" id="str_date" value="<?php echo $row['start_date']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>END DATE</label>
                                    <input type="text" class="form-control" name="end_date" id="end_date" value="<?php echo $row['end_date']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>CATEGORY</label>
                                    <input type="text" class="form-control" name="category" id="category" value="<?php echo $row['category']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>KURS</label>
                                    <input type="text" class="form-control" name="currency" id="currency" value="<?php echo $row['currency']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PRICE</label>
                                    <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $row['harga']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PORT OF CHARGERS</label>
                                    <input type="text" class="form-control" name="poc" id="poc" value="<?php echo $row['port_chargers']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>DEPATURE TAX</label>
                                    <input type="text" class="form-control" name="dep_tax" id="dep_tax" value="<?php echo $row['dep_tax']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>TIPPING</label>
                                    <input type="text" class="form-control" name="tipping" id="tipping" value="<?php echo $row['tipping']; ?>">
                                </div>
                                <input name="id" id="id" value="<?php echo $row['id']; ?>" type='hidden' >

                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="but_upload">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){



$("#but_upload").click(function(){
    var fd = new FormData();
    var a = $("input[name=id]").val();
    var b = $("input[name=str_date]").val();
    var c = $("input[name=end_date]").val();
    var d = $("input[name=category]").val();
    var e = $("input[name=currency]").val();
    var f = $("input[name=harga]").val();
    var g = $("input[name=port_chargers]").val();
    var h = $("input[name=dep_tax]").val();
    var i = $("input[name=tipping]").val();

    fd.append('id',a);
    fd.append('str_date',b);
    fd.append('end_date',c);
    fd.append('category',d);
    fd.append('currency',e);
    fd.append('harga',f);
    fd.append('port_chargers',g);
    fd.append('dep_tax',h);
    fd.append('tipping',i);


    $.ajax({
        url: 'Update_itin.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            alert(response);
            reloadcruise(2,<?php echo $row['pack_id'] ?>,0);
        },
    });
});
});
</script>