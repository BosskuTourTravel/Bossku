<form>
    <div class="form-row mb-3">
        <div class="col">
            <label for="">Hari</label>
            <input type="text" class="form-control" placeholder="cth : 1-5 or 1,2,4,5">
        </div>
        <div class="col">
            <label for="">Voucher Telepon</label>
            <input type="number" class="form-control" placeholder="" id="vt">
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="add_vt(<?php echo $_POST['id'] ?>,<?php echo $_POST['tourid'] ?>)">Submit</button>
</form>


<script>
    function add_vt(x,y) {
        var hari = document.getElementById("hari").value;
        var vt = document.getElementById("vt").value;
        $.ajax({
            url: "insert_vt_rent.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                tourid:y,
                hari:hari,
                vt:vt,
            },
            success: function(data) {
                alert(data);
                // $('.modal-data').html(data);
                $('#modal').modal('toggle');
            }
        });
    }
</script>