<form>
    <div class="form-row mb-3">
        <div class="col">
            <label for="">Hari</label>
            <input type="text" class="form-control" placeholder="cth : 1-5 or 1,2,4,5" id="hari">
        </div>
        <div class="col">
            <label for="">Breakfast</label>
            <input type="number" class="form-control" placeholder="" id="bf">
        </div>
        <div class="col">
            <label for="">Luch</label>
            <input type="number" class="form-control" placeholder="" id="ln">
        </div>
        <div class="col">
            <label for="">Dinner</label>
            <input type="number" class="form-control" placeholder="" id="dn">
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="add_meal(<?php echo $_POST['id'] ?>,<?php echo $_POST['tourid'] ?>)">Submit</button>
</form>
<script>
    function add_meal(x,y) {
        var hari = document.getElementById("hari").value;
        var bf = document.getElementById("bf").value;
        var ln = document.getElementById("ln").value;
        var dn = document.getElementById("dn").value;
        $.ajax({
            url: "insert_meal_rent.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                tourid:y,
                hari:hari,
                bf:bf,
                ln:ln,
                dn:dn
            },
            success: function(data) {
                alert(data);
                // $('.modal-data').html(data);
                $('#modal').modal('toggle');
            }
        });
    }
</script>