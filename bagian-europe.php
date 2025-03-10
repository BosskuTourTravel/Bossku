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
?>

<body>
    <div class="position-relative">
        <img src="img/Europe/EuropeMap.jpg" alt="Europe Map" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.9); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold">Europe</h1>
            <p class="fs-5"></p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6">
                <a href="negara-Westeurope.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/WestEurope.jpg" alt="Europe" class="img-fluid w-100" style="height: 275px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.2); z-index: 1;"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">West Europe</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="negara-Easteurope.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/EastEurope.jpg" alt="Europe" class="img-fluid w-100" style="height: 275px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.2); z-index: 1;"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">East Europe</h3>
                    </div>
                </a>
            </div>
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