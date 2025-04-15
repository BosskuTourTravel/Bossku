<?php
for ($i = 1; $i <= $_POST['id']; $i++) {
?>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>HOTEL <?php echo $i ?></label>
                <input type="text" class="form-control" id="hotel<?php echo $i ?>" name="hotel" onchange="add_total_hotel(<?php echo $i ?>)">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Detail</label>
                <input type="text" class="form-control" id="hotel_detail<?php echo $i ?>" name="hotel_detail" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Total</label>
                <input type="text" class="form-control" id="hotel_total<?php echo $i ?>" name="hotel_total" disabled>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {
        $('input[name="hotel"]').keyup(function() {
            // alert("onn");
            $(this).val(formatAngka($(this).val()));
        });

    });
</script>