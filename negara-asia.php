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
$query = "SELECT consortium_list.id, consortium_list.continent,consortium_list.detail,consortium_list.country,country.img FROM consortium_list LEFT JOIN country ON consortium_list.country LIKE country.name where consortium_list.continent='Asia' GROUP BY consortium_list.detail";
$rs = mysqli_query($con, $query);
?>

<body>
    <div class="position-relative">
        <img src="img/Asia/AsiaMap.jpg" alt="Asia Map" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.75); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold">Benua Asia</h1>
            <p class="fs-5 mt-3 px-3" style="max-width: 800px;">
                Asia adalah benua terbesar dengan budaya, alam, dan kota-kota modern yang menakjubkan.
            </p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-2">
            <?php
            while ($row = mysqli_fetch_array($rs)) {
            ?>
                <div class="col-md-4">
                    <a href="asiatenggara.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                        <img src="img/Asia/AsiaTenggara.jpg" alt="Europe" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                            <h3 class="fw-bold mb-0 text-white"><?php echo $row['detail']." Asia" ?></h3>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
            <!-- <div class="col-md-4">
                <a href="asiatimur.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/AsiaTimur.jpg" alt="Europe" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Asia Timur</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="asiaselatan.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/AsiaSelatan.jpg" alt="Europe" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Asia Selatan</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="asiatengah.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/AsiaTengah.jpg" alt="Europe" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Asia Tengah</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="asiabarat.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Asia/AsiaBarat.jpg" alt="Europe" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Asia Barat</h3>
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