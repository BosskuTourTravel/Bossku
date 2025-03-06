<?php
include "../db=connection.php";
session_start();
$query_agn3 = "SELECT * FROM  agent_transport where id='" . $_POST['id'] . "'";
$rs_agn3 = mysqli_query($con, $query_agn3);
$row_agn3 = mysqli_fetch_array($rs_agn3);
?>
<div class="content-wrapper" style="padding: 20px; width: auto">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtransport List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <button type="button" onclick="TRN_Package(0,0,0)" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                                <button type="button" onclick="TRN_Package(4,<?php echo $_POST['id'] ?>,0)" class="btn btn-success"><i class="fa fa-sync"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div style="padding: 20px;">
                        <div style="text-align: center; padding: 10px;">
                            <h3>Agent name</h3>
                        </div>
                        <input type="hidden" id="agent" value="<?php echo $_POST['id'] ?>">
                        <div class="form-group">
                            <label for="item">ITEM</label>
                            <select class="form-control" id="item" onchange="add_field(this.value)">
                                <option value="0">Pilih Jumlah Item</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div id="field"></div>
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
    $(document).ready(function() {
        $('#tb-pt-sub').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>
<script>
    function delete_itin(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_copy.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(40, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function add_field(x) {
        // alert(x);
        $.ajax({
            url: "field_landtrans.php",
            method: "POST",
            asynch: false,
            data: {
                id: x
            },
            success: function(data) {
                $('#field').html(data);
            }
        });
    }
</script>