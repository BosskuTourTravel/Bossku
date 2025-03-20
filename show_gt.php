<?php
if (isset($_POST['id'])) {
?>
    <h4>GRAND TOTAL : IDR <?php echo number_format(intval($_POST['id'])) ?></h4>
<?php
}
?>