<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <div class="container mx-auto px-4 py-16 mt-10">
        <!-- Title -->
        <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb-2">Paket Land Tour</h1>
        <h2 class="text-3xl font-bold tracking-wide text-center">Jelajahi Destinasi Menarik Bersama Kami</h2>
        <p class="font-medium text-sm tracking-wide text-center text-gray-500">Temukan paket wisata menarik di berbagai belahan dunia.</p>

        <!-- Card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <a href="<?php echo $domain_web ?>landtour-content.php?id=Eropa" class="block">
                <img src="<?php echo $domain_web ?>img/home_page/EROPA.jpg" alt="Eropa" class="w-full h-48 object-cover">
                <div class="text-center py-4 font-semibold text-lg text-[#02335B]">EROPA</div>
            </a>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <a href="<?php echo $domain_web ?>landtour-content.php?id=Australia" class="block">
                <img src="<?php echo $domain_web ?>img/home_page/AUSTRALIA.jpg" alt="Australia" class="w-full h-48 object-cover">
                <div class="text-center py-4 font-semibold text-lg text-[#02335B]">AUSTRALIA</div>
            </a>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <a href="<?php echo $domain_web ?>landtour-content.php?id=Asia" class="block">
                <img src="<?php echo $domain_web ?>img/home_page/JAPAN.jpg" alt="Asia" class="w-full h-48 object-cover">
                <div class="text-center py-4 font-semibold text-lg text-[#02335B]">ASIA</div>
            </a>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <a href="<?php echo $domain_web ?>landtour-content.php?id=Afrika" class="block">
                <img src="<?php echo $domain_web ?>img/home_page/AFRIKA.jpg" alt="Afrika" class="w-full h-48 object-cover">
                <div class="text-center py-4 font-semibold text-lg text-[#02335B]">AFRIKA</div>
            </a>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <a href="<?php echo $domain_web ?>landtour-content.php?id=Amerika" class="block">
                <img src="<?php echo $domain_web ?>img/home_page/AMERIKA.jpg" alt="Amerika Utara" class="w-full h-48 object-cover">
                <div class="text-center py-4 font-semibold text-lg text-[#02335B]">AMERIKA UTARA</div>
            </a>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <a href="<?php echo $domain_web ?>landtour-content.php?id=Amerika" class="block">
                <img src="<?php echo $domain_web ?>img/home_page/AMERIKA-SEL2.jpg" alt="Amerika Selatan" class="w-full h-48 object-cover">
                <div class="text-center py-4 font-semibold text-lg text-[#02335B]">AMERIKA SELATAN</div>
            </a>
            </div>
        </div>
    </div>
</body>
<?php

include "footer.php";
?>

</html>