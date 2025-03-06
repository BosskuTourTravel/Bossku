<?php
include "../db=connection.php";
?>
<div class="row">
    <div class="col-md-8">
        <select class="form-control" id="row_number" onchange="row_loop(this.value,<?php echo $_POST['id'] ?>)">
            <option value="0">Pilih Jumlah Row</option>
            <option>5</option>
            <option>10</option>
            <option>15</option>
            <option>20</option>
            <option>25</option>
            <option>30</option>
        </select>
    </div>
    <div class="col-md-4 d-flex justify-content-end">
        <button type="button" class="btn btn-warning btn-sm m-2"><i class="fa fa-plus"></i>Add Row</button>
    </div>
</div>
<div id="row_loop"></div>

<script>
    function row_loop(x,y) {
        $.ajax({
            url: "modal-fl-agent-loop.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                id_promo:y
            },
            success: function(data) {
                $('#row_loop').html(data);
            }
        });
    }
</script>