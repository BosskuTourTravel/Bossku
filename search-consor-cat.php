<?php
include "db=connection.php";
if ($_POST['negara'] !== "") {

    $query = "SELECT *  FROM Upload_Drive2 WHERE country LIKE '%" . $_POST['negara'] . "%' && p_cons='1' && start_from='".$_POST['cat']."' && status='on' order by price ASC";
    $rs = mysqli_query($con, $query);
    $p = 0;
    while ($row = mysqli_fetch_array($rs)) {
        $link = $row['thumbnail'];
        $doc = $row['documents'];
        $headers = explode('/', $link);
        $doc_header = explode('/', $doc);
        $thumbnail = $headers[5];
        $doc_link = $doc_header[5];
        $link = "https://drive.google.com/thumbnail?id=" . $thumbnail;
        $documents = "https://drive.google.com/file/d/" . $doc_link . "/view";
?>

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="padding: 10px;">
            <a href="<?php echo $documents ?>" target="_blank" style="text-decoration: none; color:black">
                <div class="card card-promo">
                    <img src="<?php echo $link ?>" class="card-img-top img-promo">
                    <div class="card-body">
                        <p class="card-text" style="text-align: left; font-weight: bold;">
                            <?php echo $row['judul'] ?>
                        </p>
                    </div>
                    <div class="card-footer" style="font-weight: bold;">
                        <?php echo "IDR " . number_format($row['price'], 0, ".", ".") ?>
                    </div>
                </div>
            </a>
        </div>
    <?php
        $p = 1;
    }
    if ($p == '0') {
    ?>
        <div style="font-weight: bold; font-size: 18pt; text-align: center; color: grey;">Promo Lebaran Paket Tour <?php echo $_POST['negara'] ?> Start From <?php echo $_POST['cat'] ?> tidak tersedia </div>
<?php
    }
}
?>