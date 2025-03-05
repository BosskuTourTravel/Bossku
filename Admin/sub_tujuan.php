<?php $tujuan = $_POST['tujuan'];
// var_dump($sub);
?>
<div class="row">
<?php
for ($xt = 1; $xt <= $tujuan; $xt++) {
?>
<div class="col-md-2">
<label style="font-size: 11px;">Tujuan <?php echo $xt ?></label>
    <select class="form-control form-control-sm" id="" name="">
        <option value="">Tempat 1</option>
        <option value="">Tempat 2</option>
        <option value="">Tempat 3</option>
        <option value="">Tempat 4</option>
    </select>
</div>

<?php
}
?>
</div>