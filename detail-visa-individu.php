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
        <a href="javascript:history.back()" class="text-center text-md font-semibold tracking-wide hover:underline ">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="detail-visa-group.php" class="text-center text-md font-semibold tracking-wide hover:underline ">
            Visa Group <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-6 items-start">
        <!-- Konten A -->
        <div class="w-full md:w-3/4 text-justify">
            <img src="img/SoloTour.jpg" alt="Visa Individu" class="w-full h-96 object-cover rounded-xl mb-4">

            <h1 class="text-2xl font-bold tracking-wide text-[#02335B]">Visa Individu</h1>

            <p class="text-gray-600 text-md mb-4">
                Layanan visa untuk satu orang, cocok untuk perjalanan pribadi, bisnis, atau kunjungan keluarga. Proses mudah dan cepat untuk kebutuhan perjalanan Anda.
            </p>

            <p class="text-gray-600 text-md mb-4">
                Dengan layanan ini, Anda akan mendapatkan panduan lengkap dari tim profesional kami, mulai dari persiapan dokumen hingga proses pengajuan ke kedutaan. Kami memahami bahwa setiap perjalanan memiliki tujuan unik, oleh karena itu layanan visa individu kami dirancang fleksibel sesuai kebutuhan dan rencana perjalanan Anda.
            </p>

            <!-- Sub Judul 1 -->
            <h2 class="text-xl font-semibold text-[#02335B] mt-6 mb-2">Benefit dari Visa Individu</h2>
            <p class="text-gray-600 text-md mb-2">
                Layanan ini memberikan kenyamanan dan efisiensi dalam proses pengajuan visa secara personal, tanpa ribet dan tanpa harus mengikuti jadwal rombongan.
            </p>

            <ul class="list-disc text-gray-600 text-md p-4 leading-relaxed">
                <li>Proses lebih cepat dan fleksibel</li>
                <li>Dapat disesuaikan dengan kebutuhan pribadi</li>
                <li>Bimbingan langsung dari tim berpengalaman</li>
                <li>Dukungan dokumen lengkap dan valid</li>
            </ul>


            <!-- Sub Judul 2 -->
            <h2 class="text-xl font-semibold text-[#02335B] mt-6 mb-2">Mengapa Harus Pilih Visa Individu Kami?</h2>
            <p class="text-gray-600 text-md">
                Kami tidak hanya membantu proses teknis, tapi juga memberikan pengalaman terbaik dengan pendekatan personal, layanan pelanggan ramah, dan hasil yang terpercaya. Komitmen kami adalah memastikan perjalanan Anda dimulai dengan lancar sejak pengurusan visa.
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