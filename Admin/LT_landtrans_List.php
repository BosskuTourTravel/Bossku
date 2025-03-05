<?php
session_start();
include "../site.php";
include "../db=connection.php";
$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$hari = $row_data['hari'];
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Transport List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">

                                <!-- <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="LT_itinerary(4,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-plus"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="container" style="padding: 20px;">
                        <form>
                            <?php
                            for ($x = 1; $x <= $hari; $x++) {
                            ?>
                                <div style="border: 2px solid; border-color:darkgreen; padding: 10px; margin-bottom: 5px;">
                                    <div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" name="item<?php echo $x ?>" id="item<?php echo $x ?>" onchange="fungsi_item(<?php echo $x ?>)">
                                                <option selected value="">Pilih Jumlah Item</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="<?php echo $x ?>transport_field">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div style="padding: 10px;">

                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="hidden" id="hari" name="hari" value="<?php echo $hari ?>">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="add_toprice(<?php echo  $_POST['id'] ?>)">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="price_tr">
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

</script>
<script>
    function fungsi_item(x) {
        var item = document.getElementById("item" + x).options[document.getElementById("item" + x).selectedIndex].value;
        $.ajax({
            url: "LT_transport_field.php",
            method: "POST",
            asynch: false,
            data: {
                loop: item,
                x: x
            },
            success: function(data) {
                $('#' + x + 'transport_field').html(data);
            }
        })

    }

    function fungsi_negara(x, y) {
        // var item = document.getElementById("item" + x).options[document.getElementById("item" + x).selectedIndex].value;
        $("#" + y + "per_list" + x).empty();
        $('input[name=' + y + 'per' + x + ']').val('');
        var negara = document.getElementById(y + "negara" + x).options[document.getElementById(y + "negara" + x).selectedIndex].value;
        $.post("get_select_tr.php", {
            "negara": negara,
        }, function(data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
            if (jsonData != '') {
                // alert("on");
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    var option = "<option data-customvalue='"+counter.id+"' value='"+counter.detail+"(" + counter.agent + ")"+"'></option>";
                    $("#" + y + "per_list" + x).append(option);
                }
            } else {
                $("#" + y + "per_list" + x).empty();
            }
        });
    }

    function add_toprice(x) {
        $("#price_tr").html('');
        var hari = $("input[name=hari]").val();
        // alert(hari);
        let formData = new FormData();
        var arr =[];
        for (i = 1; i <= hari; i++) {
            // alert(i);
            var loop = document.getElementById("item" + i).options[document.getElementById("item" + i).selectedIndex].value;
           
            for (x = 1; x <= loop; x++) {
                var negara = document.getElementById(x + "negara" + i).options[document.getElementById(x + "negara" + i).selectedIndex].value;
                var trans = $('#' + x + 'per' + i).val();
                
                var trans_id = $('#' + x + 'per_list' + i + ' [value="' + trans + '"]').data('customvalue');

                var rent_type = document.getElementById(x + "per_detail" + i).options[document.getElementById(x + "per_detail" + i).selectedIndex].value;
                if(negara != "" && trans_id != "" && rent_type !=""){
                    const obj = {
                        hari : i,
                        kolom: x,
                        negara: negara,
                        trans_id:trans_id,
                        rent_type:rent_type
                    }
                    arr.push(obj);
                    // const myJSON = JSON.stringify(obj);
                    // console.log(myJSON);
                }else{
                    // alert("semua field harus di isi !");
                }
                // alert(x);
            }
        }
        console.log(arr);
        var value = JSON.stringify(arr);
        formData.append('data',value);
        formData.append('id',x);
        // console.log();
        $.ajax({
			type: 'POST',
			url: "get_price_tr.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data) {
                $('#price_tr').html(data);
			}
		});
    }
</script>