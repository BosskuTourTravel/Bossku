<div class="d-flex justify-content-between">
    <div class="form-group mx-sm-3 mb-2 w-50">
        <label>Name</label>
        <input type="text" class="form-control" id="nama">
    </div>
    <div>
        <div class="p-3"></div>
        <button type="button" class="btn btn-primary mb-2" onclick="add_package(<?php echo $_POST['id'] ?>)">Submit</button>
    </div>
</div>

<script>
    function add_package(x) {
        var nama = document.getElementById("nama").value;
        $.ajax({
            url: "insert_hotel_package.php",
            method: "POST",
            asynch: false,
            data: {
                nama: nama,
                id: x
            },
            success: function(data) {
                alert(data);
                $('#new_hotel_package').modal('toggle');
                // LAN_Package(1,x,0);
            }
        });
    }
</script>