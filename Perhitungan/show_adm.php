<?php
for ($i = 1; $i <= $_POST['id']; $i++) {
?>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>ADMISSION <?php echo $i ?></label>
                <input type="text" class="form-control" id="adm<?php echo $i ?>" name="adm" onchange="add_total_adm(<?php echo $i ?>)">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Detail</label>
                <input type="text" class="form-control" id="adm_detail<?php echo $i ?>" name="adm_detail" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Total</label>
                <input type="text" class="form-control" id="adm_total<?php echo $i ?>" name="adm_total" disabled>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {
        $('input[name="adm"]').keyup(function() {
            // alert("onn");
            $(this).val(formatAngka($(this).val()));
        });

    });
</script>