<?php
include "../db=connection.php";

?>
<form>
    <div class="form-group">
        <label>Hari</label>
        <input type="number" class="form-control form-control-sm" id="hari" placeholder="Msukkan Hari">
    </div>
    <button type="button" class="btn btn-success" onclick="edit_hari(<?php echo $_POST['id'] ?>,<?php echo $_POST['package'] ?>)">Submit</button>
</form>
<script>
    function edit_hari(x,y) {
        var hari = document.getElementById("hari").value;
        $.ajax({
            url: "edit_hari_rent.php",
            method: "POST",
            async: false,
            data: {
                hari: hari,
                id:x,
                package:y
            },
            success: function(data) {
                alert(data);
            }
        });
    }
</script>