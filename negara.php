<?php
include "db=connection.php";
include "slug.php";
include "API/Price/Api_LT_total_baru.php";

?>
<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "navbar.php";

$query = "SELECT consortium_list.id, consortium_list.continent,consortium_list.detail,consortium_list.country,country.img FROM consortium_list LEFT JOIN country ON consortium_list.country LIKE country.name where consortium_list.continent='" . $_GET['id'] . "' && consortium_list.detail='" . $_GET['region'] . "' GROUP BY consortium_list.detail";
$rs = mysqli_query($con, $query);
if(
    $_GET['id'] == "Asia"
){
    $sub_judul = "Wilayah tropis yang kaya akan budaya, kuliner lezat, dan destinasi eksotis.";
    $img_header = "img/Asia/AsiaTenggaraThumb.jpg";
}else if ($_GET['id']  == "Europe" )
{
    $sub_judul = "Nikmati keindahan kota bersejarah, lanskap menawan, dan budaya unik Eropa.";
    $img_header = "img/Europe/EastEuropeThumb.jpg";
} 
// echo $query;
?>

<body>
    <div class="position-relative">
        <img src="<?php echo $img_header ?>" alt="Europe Map" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.9); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold"><?php echo $_GET['region']. " " .$_GET['id'] ?></h1>
            <p class="fs-5"><?php echo $sub_judul ?></p>
        </div>
    </div>
    <div class="container py-5">
        <div class="row g-2">
            <?php
            while ($row = mysqli_fetch_array($rs)) {
                if($row['img'] ==""){
$img = "img/Asia/Asia.jpg";
                }else{
                    $img = $row['img'];
                }
            ?>
                <div class="col-md-4">
                    <a href="detail.php?id=<?php echo $_GET['id'] . "&&region=" . $_GET['region'] . "&&country=" . $row['country'] ?>" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                        <img src="<?php echo $img ?>" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                            <h3 class="fw-bold mb-0 text-white"><?php echo $row['country'] ?></h3>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>

            <!-- <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/MalaysiaFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Malaysia</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/ThailandFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Thailand</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/VietnamFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Vietnam</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/BruneiFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Brunei</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/SingaporeFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Singapore</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/LaosFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Laos</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/FilipinaFLag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Filipina</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/MyanmarFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Myanmar</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/KambojaFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Kamboja</h3>
                    </div>
                </a>
            </div> -->
        </div>
    </div>
</body>
<?php
include "footer.php";
?>

<style>
    .custom-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .custom-card:hover {
        transform: scale(1.05);
    }

    .custom-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 15px;
    }

    .card-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: end;
        color: white;
        padding: 15px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
        transition: all 0.3s ease-in-out;
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
    }

    .card-subtitle {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 10px;
    }
</style>