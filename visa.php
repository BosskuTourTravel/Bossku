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
    <div class="flex gap-6 justify-center items-start px-4 flex-wrap">
        <!-- Card Visa Individu -->
        <div class="shadow-lg rounded-2xl p-6 flex flex-col md:flex-row items-center gap-4 border-t-4 border-blue-600 bg-white transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-800 w-full md:w-5/12 lg:w-1/3">
            <!-- Gambar -->
            <img src="img/SoloTrip.jpg" alt="Visa Individu" class="w-48 h-48 object-cover rounded-xl hover:scale-105 transition duration-300">

            <!-- Teks -->
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-xl font-bold text-[#02335B] mb-1">Visa Individu</h2>
                <p class="text-gray-600 text-sm mb-4">
                    Layanan visa untuk satu orang, cocok untuk perjalanan pribadi, bisnis, atau kunjungan keluarga. Proses mudah dan cepat untuk kebutuhan perjalanan Anda.
                </p>

                <a href="detail-visa-individu.php" class="mt-4 bg-[#FFCA10] text-[#02335B] border-1 border-[#02335B] rounded-full px-4 py-1 font-semibold transition duration-300 hover:bg-[#02335B] hover:text-[#FFCA10] shadow-md inline-block">
                    Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Card Visa Group -->
        <div class="shadow-lg rounded-2xl p-6 flex flex-col md:flex-row items-center gap-4 border-t-4 border-blue-600 bg-white transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-800 w-full md:w-5/12 lg:w-1/3">
            <!-- Gambar -->
            <img src="img/GroupTrip.jpg" alt="Visa Group" class="w-48 h-48 object-cover rounded-xl hover:scale-105 transition duration-300">

            <!-- Teks -->
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-xl font-bold text-[#02335B] mb-1">Visa Group</h2>
                <p class="text-[#02335B] text-sm mb-4">
                    Layanan visa untuk rombongan, ideal untuk tur, perjalanan dinas, atau kegiatan kelompok lainnya. Proses cepat dan efisien untuk memenuhi kebutuhan kelompok Anda.
                </p>

                <a href="detail-visa-group.php" class="mt-4 bg-[#FFCA10] text-[#02335B] border-1 border-[#02335B] rounded-full px-4 py-1 font-semibold transition duration-300 hover:bg-[#02335B] hover:text-[#FFCA10] shadow-md inline-block">
                    Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

</div>

<?php
include "footer.php";
?>