<?php
include "site.php";
include "db=connection.php";
if (isset($_POST['tgl'])  && ($_POST['pack_id'])) {
    $tgl = $_POST['tgl'];
    $pack_id = $_POST['pack_id'];
    $query_detail = "SELECT * FROM cruise_package_new  where pack_id='" . $pack_id . "' and start_date='" . $tgl . "' order by start_date ASC";
    $rs_detail = mysqli_query($con, $query_detail);
?>
    <!-- <div class="container"> -->
    <!-- <div class="row"> -->
    <?php
    while ($row_detail = mysqli_fetch_array($rs_detail)) {
        $up_price = $row_detail['harga'] + ($row_detail['harga'] * 0.2);
    ?>
        <div class="col-md-4">
            <div class="card " style="padding: 10px 5px;">
                <img class="card-img-top" src="https://images.yuktravel.com/images/upload/cruises/thumbs/spectrum-of-the-seas-banner-rev.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;"><?php echo $row_detail['category'] . " " . $row_detail['id'] ?></h5>
                    <p class="card-text">
                    <div class="starting">Starting: (/pax)</div>
                    <div class="starting disc-price"><?php echo $row_detail['currency'] . " " . $up_price ?></div>
                    <div class="price big-price"><?php echo $row_detail['currency'] . " " . $row_detail['harga'] ?></div>
                    </p>
                    <!-- <a href="#" onclick="Detail()" class="btn btn-primary">Price Detail</a> -->
                        <!-- <input name="id_detail" id="id_detail" value="<?php echo $row_detail['id']; ?>" type="hidden"> -->
                        <button type="submit" class="btn btn-default" onclick="Detail(<?php echo $row_detail['id'];?>)">Price Detail</button>
                </div>
            </div>
        </div>

        <!-- </div> -->
        <!-- </div> -->
<?php
    }
}
