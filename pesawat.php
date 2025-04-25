<?php
include "header.php";
include "navbar.php";
include "slug.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Tiket Pesawat</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Pesan Tiket Pesawat Jadi Lebih Mudah</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Kami siap bantu Anda dapatkan tiket terbaik dengan cepat, nyaman, dan tanpa ribet.</p>

    <div class="flex flex-col md:flex-row gap-6 items-start mt-10">
        <!-- Konten A -->
        <div class="w-full md:w-3/4 text-justify">
            <img src="img/plane.jpg" alt="Tiket Pesawat" class="w-full h-auto object-cover rounded-xl mb-4">

            <h1 class="text-2xl font-bold text-[#02335B] mt-6 mb-2">Layanan Tiket Pesawat</h1>

            <p class="text-gray-600 text-md mb-4">
                Kami menyediakan layanan pemesanan tiket pesawat domestik dan internasional, sesuai kebutuhan Anda—baik untuk liburan, perjalanan bisnis, atau keperluan mendesak. Kami akan bantu carikan penerbangan terbaik dari berbagai maskapai pilihan dengan harga yang kompetitif.
            </p>

            <p class="text-gray-600 text-md mb-4">
                Gak perlu repot buka banyak website atau aplikasi—cukup satu kali chat ke tim kami, dan semua kebutuhan penerbangan Anda akan segera ditangani dengan cepat dan profesional. Mulai dari memilih jadwal hingga request maskapai favorit, semua bisa kami bantu!
            </p>

            <p class="text-gray-600 text-md mb-4">
                Kami juga terbiasa menangani kebutuhan tiket untuk rombongan, perjalanan mendadak, bahkan tiket pulang kampung menjelang hari raya. Jadi, apapun keperluan terbang Anda, tenang aja—kami siap bantu dari awal sampai boarding!
            </p>

            <p class="text-gray-600 text-md mb-4">
                Yuk, hubungi kami sekarang dan rasakan kemudahan pesan tiket yang praktis tanpa ribet!
            </p>

            <!-- Fitur-fitur -->
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center mb-6">
                <i class="fas fa-plane-departure mr-2"></i> Harga Terbaik, Jadwal Fleksibel
            </div>
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center mb-6">
                <i class="fas fa-plane-departure mr-2"></i> Bisa Request Maskapai Favoritmu
            </div>
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center mb-6">
                <i class="fas fa-plane-departure mr-2"></i> Terbang ke Mana Saja, Kapan Saja!
            </div>
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center mb-6">
                <i class="fas fa-plane-departure mr-2"></i> Tersedia Rute Domestik & Internasional
            </div>
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center mb-6">
                <i class="fas fa-plane-departure mr-2"></i> Pilih Jadwal & Harga Sesuai Budgetmu
            </div>
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center mb-6">
                <i class="fas fa-plane-departure mr-2"></i> Booking Cepat, Tanpa Ribet
            </div>
            <div class="w-full border border-[#02335B] text-[#02335B] text-base font-semibold px-4 py-4 rounded-md shadow-md flex items-center">
                <i class="fas fa-plane-departure mr-2"></i> Langsung Chat Kami untuk Info Tiket!
            </div>
        </div>

        <!-- Konten B -->
        <div class="w-full md:w-1/4 flex flex-col justify-between items-center gap-4">

            <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 text-center mx-auto">
                <h3 class="text-xl font-bold text-[#02335B] mb-2">Siap Terbang?</h3>
                <p class="text-gray-600 text-sm mb-4">Hubungi kami sekarang untuk pesan tiket pesawat dengan proses mudah, cepat, dan harga terbaik!</p>

                <a href="https://wa.me/6281234567890?text=Halo%20admin%2C%20saya%20ingin%20pesan%20tiket%20pesawat."
                    target="_blank"
                    aria-label="Pesan tiket pesawat lewat WhatsApp"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full shadow-md transition duration-300">
                    <i class="fab fa-whatsapp mr-2"></i>Pesan Sekarang via WhatsApp
                </a>
            </div>

            <!-- Section Bantuan Paspor -->
            <div class="bg-[#F9FAFB] border border-gray-200 rounded-xl p-6 mt-3 text-center mx-auto shadow-md">
                <h2 class="text-xl font-semibold text-[#02335B] mb-2">Butuh Bantuan Paspor?</h2>
                <p class="text-gray-600 text-md mb-2">
                    Kami juga menyediakan layanan pengurusan paspor untuk memudahkan perjalanan Anda ke luar negeri. Mulai dari konsultasi dokumen hingga pendampingan pengajuan, semua bisa kami bantu.
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20admin%2C%20saya%20butuh%20bantuan%20untuk%20pengurusan%20paspor."
                    target="_blank"
                    class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-full shadow-md transition duration-300">
                    <i class="fab fa-whatsapp mr-2"></i> Konsultasi via WhatsApp
                </a>
            </div>

        </div>
    </div>
</div>


<?php
include "footer.php";
?>