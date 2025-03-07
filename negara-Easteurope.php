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
        <img src="img/Europe/EastEuropeThumb.jpg" alt="Europe Map" class="img-fluid w-100" style="height: 450px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold">East Europe</h1>
            <p class="fs-5">Nikmati keindahan kota bersejarah, lanskap menawan, dan budaya unik Eropa Timur.</p>
        </div>
    </div>
    <div class="container py-5">
        <div class="row g-2">
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/KroasiaFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Croatia</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/RussianFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Russia</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/SerbiaFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Serbia</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/PolandFLag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Poland</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="negara-europe.php" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                    <img src="img/Europe/GeorgiaFlag.jpg" alt="Europe" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); "></div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                        <h3 class="fw-bold mb-0 text-white">Georgia</h3>
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