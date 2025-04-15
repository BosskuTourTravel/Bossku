<?php
for ($i = 1; $i <= $_POST['id']; $i++) {
?>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>TRANSPORT <?php echo $i ?></label>
                <input type="text" class="form-control" id="transport<?php echo $i ?>" name="transport" onchange="add_total_transport(<?php echo $i ?>)">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Detail</label>
                <input type="text" class="form-control" id="transport_detail<?php echo $i ?>" name="transport_detail" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Total</label>
                <input type="text" class="form-control" id="transport_total<?php echo $i ?>" name="transport_total" disabled>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {
        $('input[name="transport"]').keyup(function() {
            // alert("onn");
            $(this).val(formatAngka($(this).val()));
        });

    });
</script>