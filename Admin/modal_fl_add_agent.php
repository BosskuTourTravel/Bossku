<form>
    <div class="mb-3">
        <label>Nama Promo Flight</label>
        <input type="text" class="form-control " id="nama">
    </div>
    <div class="mb-3">
        <label>TGL</label>
        <input type="date" class="form-control" id="tgl">
    </div>
    <div class="mb-3">
        <label>Keterangan</label>
        <textarea class="form-control" id="ket" rows="3"></textarea>
    </div>
    <button type="button" class="btn btn-primary" onclick="add_promo()">Submit</button>
</form>
<script>
    function add_promo() {
        var nama = document.getElementById("nama").value;
        var tgl = document.getElementById("tgl").value;
        var ket = document.getElementById('ket').value;
        $.ajax({
            url: "insert_promo_flight.php",
            method: "POST",
            asynch: false,
            data: {
                nama: nama,
                tgl:tgl,
                ket:ket
            },
            success: function(data) {
               alert(data);
            }
        });
    }
</script>