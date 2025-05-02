<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>
<div class="container mx-auto px-4 py-16 mt-10">

    <!-- Title -->
    <div class="flex flex-col items-center justify-center mb-4">
        <h1 class="text-center text-[#02335B] text-sm font-semibold tracking-wide mb-2 border border-[#02335B] rounded-full px-2 py-0 inline-block bg-[#F0F8FF]">Visa</h1>
        <h2 class="text-3xl font-bold tracking-wide text-center">Visa</h2>
        <p class="font-medium text-sm tracking-wide text-center text-gray-500">Let's Explore Our Immigration And Visa Type</p>
    </div>

    <!-- Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
        <!-- Card Visa Individu -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border-t-4 border-yellow-500 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-800">
            <!-- Gambar -->
            <img src="img/SoloTrip.jpg" alt="Visa Individu" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-[#02335B] mb-2">Visa Individu</h2>
                <p class="text-gray-600 text-sm mb-4">
                    Layanan visa untuk satu orang, cocok untuk perjalanan pribadi, bisnis, atau kunjungan keluarga. Proses mudah dan cepat untuk kebutuhan perjalanan Anda.
                </p>
                <a href="detail-visa-individu.php" class="inline-block bg-[#FFCA10] text-[#02335B] px-6 py-2 rounded-full font-semibold transition duration-300 hover:bg-[#02335B] hover:text-[#FFCA10]">
                    Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Card Visa Group -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border-t-4 border-yellow-500 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-800">
            <img src="img/GroupTrip.jpg" alt="Visa Group" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-[#02335B] mb-2">Visa Group</h2>
                <p class="text-gray-600 text-sm mb-4">
                    Layanan visa untuk rombongan, ideal untuk tur, perjalanan dinas, atau kegiatan kelompok lainnya. Proses cepat dan efisien untuk memenuhi kebutuhan kelompok Anda.
                </p>
                <a href="detail-visa-group.php" class="inline-block bg-[#FFCA10] text-[#02335B] px-6 py-2 rounded-full font-semibold transition duration-300 hover:bg-[#02335B] hover:text-[#FFCA10]">
                    Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Card Passport -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border-t-4 border-yellow-500 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-800">
            <img src="img/Passport.jpg" alt="Passport" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-[#02335B] mb-2">Passport</h2>
                <p class="text-gray-600 text-sm mb-4">
                    Layanan pembuatan dan perpanjangan passport, cocok untuk kebutuhan perjalanan internasional Anda. Proses mudah dan cepat untuk kenyamanan Anda.
                </p>
                <a href="passport.php" class="inline-block bg-[#FFCA10] text-[#02335B] px-6 py-2 rounded-full font-semibold transition duration-300 hover:bg-[#02335B] hover:text-[#FFCA10]">
                    Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

</div>

<?php
include "footer.php";
?>