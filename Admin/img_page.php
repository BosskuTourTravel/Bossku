<?php
include "../db=connection.php";
session_start();
$query_img = "SELECT * FROM List_tempat_img where tmp_id=" . $_POST['id'];
$rs_img = mysqli_query($con, $query_img);
$row_img = mysqli_fetch_array($rs_img);
?>
<div class="row">
    <div class="col-md-3">
        <div class="card" style="width: 160px;" onclick="change_card(<?php echo $_POST['col'] ?>,'d','<?php echo $row_img['link']  ?>')">
            <?php
            if ($row_img['link'] == "") {
            ?>
                <img class="card-img-top" src="https://www.2canholiday.com/Admin/images/image.png" alt="Card image cap">
            <?php
            } else {
                $link = $row_img['link'];
                $headers = explode('/', $link);
                $thumbnail = $headers[5];
            ?>
                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
            <?php
            }
            ?>
            <div class="card-body d-<?php echo $_POST['col'] ?>" style="text-align: center; padding: 5px;">
                <p class="card-text">Spring</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="width: 160px;" onclick="change_card(<?php echo $_POST['col'] ?>,'w','<?php echo $row_img['winter_img']  ?>')">
            <?php
            if ($row_img['winter_img'] == "") {
            ?>
                <img class="card-img-top" src="https://www.2canholiday.com/Admin/images/image.png" alt="Card image cap">
            <?php
            } else {
                $link = $row_img['winter_img'];
                $headers = explode('/', $link);
                $thumbnail = $headers[5];
            ?>
                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
            <?php
            }
            ?>

            <div class="card-body w-<?php echo $_POST['col'] ?>" style="text-align: center; padding: 5px;">
                <p class="card-text w-<?php echo $_POST['col'] ?>">Winter</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="width: 160px;" onclick="change_card(<?php echo $_POST['col'] ?>,'s','<?php echo $row_img['summer_img']  ?>')">
            <?php
            if ($row_img['summer_img'] == "") {
            ?>
                <img class="card-img-top" src="https://www.2canholiday.com/Admin/images/image.png" alt="Card image cap">
            <?php
            } else {
                $link = $row_img['summer_img'];
                $headers = explode('/', $link);
                $thumbnail = $headers[5];
            ?>
                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
            <?php
            }
            ?>

            <div class="card-body s-<?php echo $_POST['col'] ?>" style="text-align: center; padding: 5px;">
                <p class="card-text s-<?php echo $_POST['col'] ?>">Summer</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="width: 160px;" onclick="change_card(<?php echo $_POST['col'] ?>,'a','<?php echo $row_img['autumn_img']  ?>')">
            <?php
            if ($row_img['autumn_img'] == "") {
            ?>
                <img class="card-img-top" src="https://www.2canholiday.com/Admin/images/image.png" alt="Card image cap">
            <?php
            } else {
                $link = $row_img['autumn_img'];
                $headers = explode('/', $link);
                $thumbnail = $headers[5];
            ?>
                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
            <?php
            }
            ?>

            <div class="card-body a-<?php echo $_POST['col'] ?>" style="text-align: center; padding: 5px;">
                <p class="card-text a-<?php echo $_POST['col'] ?>">Autumn</p>
            </div>
        </div>
    </div>
</div>