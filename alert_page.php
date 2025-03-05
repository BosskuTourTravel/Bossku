<?php
if ($_POST['x'] != "") {
    if ($_POST['x'] == '1') {
?>
        <div class="alert alert-success" role="alert">
            Data berhasil di kirim, Invoice akan di kirmkan via email atau Whatshapp
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger" role="alert">
            Data Gagal di kirim, Mohon lengkapi data atau hubungi Admin untuk info lebih lanjut
        </div>
<?php
    }
}
?>