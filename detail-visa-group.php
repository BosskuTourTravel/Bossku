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
        <h2 class="text-3xl font-bold tracking-wide text-center">Visa Individu</h2>
        <p class="font-medium text-sm tracking-wide text-center text-gray-500">Layanan visa untuk satu orang, cocok untuk perjalanan pribadi, bisnis, atau kunjungan keluarga.<br> Proses mudah dan cepat untuk kebutuhan perjalanan Anda.</p>
    </div>

    <!-- Button -->
    <div class="flex justify-between items-center mb-4">
        <a href="visa.php" class="text-center text-md font-semibold tracking-wide hover:underline ">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="detail-visa-individu.php" class="text-center text-md font-semibold tracking-wide hover:underline ">
            Visa Individu <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-6 items-start">
        <!-- Konten A -->
        <div class="w-full md:w-3/4 text-justify">
            <img src="img/GroupTour.jpg" alt="Visa Group" class="w-full h-96 object-cover rounded-xl mb-4">

            <h1 class="text-2xl font-bold tracking-wide text-[#02335B]">Visa Group</h1>

            <p class="text-gray-600 text-md mb-4">
                Visa Group adalah layanan pengurusan visa secara kolektif untuk rombongan, baik untuk keperluan wisata, studi, maupun perjalanan bisnis. Solusi ideal untuk perusahaan, institusi pendidikan, atau komunitas yang ingin bepergian bersama dengan pengurusan visa yang terorganisir.
            </p>

            <p class="text-gray-600 text-md mb-4">
                Dengan layanan ini, Anda akan mendapatkan dukungan penuh dari tim profesional kami dalam mengoordinasi seluruh kebutuhan administrasi dan teknis rombongan. Kami memahami pentingnya keseragaman dan efisiensi dalam perjalanan grup, sehingga proses dilakukan secara sistematis dan sesuai tenggat waktu.
            </p>

            <!-- Sub Judul 1 -->
            <h2 class="text-xl font-semibold text-[#02335B] mt-6 mb-2">Benefit dari Visa Group</h2>
            <p class="text-gray-600 text-md mb-2">
                Layanan ini memberikan efisiensi biaya dan waktu untuk perjalanan rombongan, serta pengurusan dokumen yang lebih mudah karena dilakukan secara kolektif dengan pendampingan penuh.
            </p>

            <ul class="list-disc list-inside text-gray-600 text-md">
                <li>Biaya lebih hemat untuk pengajuan grup</li>
                <li>Koordinasi dokumen yang lebih praktis</li>
                <li>Jadwal proses yang disesuaikan kebutuhan grup</li>
                <li>Bantuan lengkap untuk seluruh anggota rombongan</li>
            </ul>

            <!-- Sub Judul 2 -->
            <h2 class="text-xl font-semibold text-[#02335B] mt-6 mb-2">Mengapa Harus Pilih Visa Group Kami?</h2>
            <p class="text-gray-600 text-md">
                Kami memiliki pengalaman dalam menangani berbagai skala perjalanan kelompok dan memberikan layanan yang profesional, cepat, dan terpercaya. Tim kami siap memberikan panduan dari awal hingga akhir proses agar perjalanan rombongan Anda berjalan lancar tanpa hambatan.
            </p>
        </div>

        <!-- Konten B -->
        <div class="w-full md:w-1/4 flex justify-center items-center">
            <div class="w-full max-w-md flex flex-col shadow-lg rounded-2xl p-6 items-center gap-4 border-t-4 border-blue-600 bg-white transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-800">
                <p class="font-medium text-sm tracking-wide text-center text-gray-500">GET VISA SERVICE</p>
                <h1 class="text-2xl font-bold tracking-wide text-[#02335B] mb-4 text-center">Feel Free To Contact Us</h1>
                <a href="contact.php" class="inline-block bg-blue-600 text-white text-sm py-2 px-6 rounded-md hover:bg-blue-800 transition duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>

</div>

<?php
include "footer.php";
?>