<?php

?>
<form>
    <div class="form-row mb-3">
        <div class="col">
            <label for="">Hari</label>
            <input type="text" class="form-control" id="hari" placeholder="cth : 1-5 or 1,2,4,5">
        </div>
        <div class="col">
            <label for="">Fee Guide</label>
            <input type="number" class="form-control" id="fee" placeholder="">
        </div>
        <div class="col">
            <label for="">Surcharge Fee Guide</label>
            <input type="number" class="form-control" id="sfee" placeholder="">
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="add_fee(<?php echo $_POST['id'] ?>,<?php echo $_POST['tourid'] ?>)">Submit</button>
</form>

<script>
    function add_fee(x,y) {
        var hari = document.getElementById("hari").value;
        var fee = document.getElementById("fee").value;
        var sfee = document.getElementById("sfee").value;
        $.ajax({
            url: "insert_fee_rent.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                tourid:y,
                hari:hari,
                fee:fee,
                sfee:sfee
            },
            success: function(data) {
                alert(data);
                // $('.modal-data').html(data);
                $('#modal').modal('toggle');
            }
        });
    }
</script>