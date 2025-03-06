<?php $tq = $_POST['tq'];
// var_dump($sub);
for ($xy = 1; $xy <= $tq; $xy++) {
?>
    <div class="form-group">
        <label for="exampleFormControlInput1">Transquo <?php echo $xy ?></label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
<?php
}
?>