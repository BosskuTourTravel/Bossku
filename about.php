<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <div class="text-center mb-10">
        <h1 class="text-[#02335B] text-sm font-semibold tracking-wide uppercase">Tentang Kami</h1>
        <h2 class="text-3xl font-bold tracking-wide text-[#02335B] mt-3">Yuk, Jelajahi Dunia Bersama Kami</h2>
        <p class="font-medium text-base tracking-wide text-gray-500 mt-5">Kami siap menemani setiap langkah liburan seru Anda — dari awal hingga akhir perjalanan.</p>
    </div>

    <!-- Image -->
    <div class="flex justify-center mb-10">
        <img src="img/aboutthumb.jpg" alt="Tentang Kami" class="rounded-2xl shadow-lg object-cover w-full max-w-4xl h-80 md:h-96">
    </div>

    <!-- How We Help -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-10">
        <div class="text-left">
            <h2 class="text-4xl font-bold text-primary-900 tracking-wide mb-6">Begini Cara Kami Bantu Liburan Anda</h2>
        </div>
        <div class="text-gray-700 text-base font-medium tracking-wide text-justify leading-relaxed">
            <p>
                Dari ngobrolin destinasi impian hingga ngatur semua detailnya, kami siap bantu biar liburan Anda jadi super nyaman dan bebas repot. Anda cukup santai, kami yang urus semuanya. Liburan seru, hati pun tenang!
                Kami percaya setiap perjalanan punya ceritanya sendiri — dan kami ada di sini untuk bantu wujudkan cerita liburan yang menyenangkan, berkesan, dan pastinya bebas drama.
            </p>
        </div>
    </div>

    <!-- Dream Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-10">
        <img src="img/about2.jpg" alt="Wujudkan Liburan Impian" class="rounded-xl shadow-xl object-cover w-full max-w-4xl h-64 md:h-96">
        <div class="text-gray-700 text-base font-medium tracking-wide text-justify leading-relaxed">
            <h2 class="text-4xl font-bold text-black mb-4">Wujudkan Liburan Impian Anda</h2>
            <p>Kami di sini untuk bantu Anda menikmati liburan yang seru, nyaman, dan penuh cerita indah. Dari merancang rencana perjalanan sampai mengatur semua detailnya — cukup ceritakan apa yang Anda inginkan, dan biarkan kami yang mengurus sisanya. Liburan jadi lebih mudah, Anda tinggal fokus menikmati setiap momennya.</p>
        </div>

    </div>

    <!-- Core Values -->
    <div class="text-center mb-10 mt-4">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-900 mb-2">Nilai-Nilai yang Kami Pegang</h2>
        <p class="text-gray-600 text-base font-medium max-w-2xl mx-auto">
            Buat kami, liburan bukan hanya soal tempat yang dikunjungi — tapi tentang pengalaman yang menyenangkan, nyaman, dan berkesan.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        <!-- Card 1 -->
        <div class="p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="mb-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-xl font-semibold text-primary-900">Kepercayaan</h3>
            </div>
            <p class="text-gray-700 text-sm">Kami selalu terbuka dan jujur — karena perjalanan yang menyenangkan dimulai dari rasa saling percaya.</p>
        </div>

        <!-- Card 2 -->
        <div class="p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="mb-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 100-10 7 7 0 00-13 6z" />
                </svg>
                <h3 class="text-xl font-semibold text-primary-900">Kenyamanan</h3>
            </div>
            <p class="text-gray-700 text-sm">Mulai dari awal sampai selesai, kami pastikan liburan Anda berjalan lancar dan bebas ribet.</p>
        </div>

        <!-- Card 3 -->
        <div class="p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="mb-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-xl font-semibold text-primary-900">Kebahagiaan</h3>
            </div>
            <p class="text-gray-700 text-sm">Kepuasan Anda adalah semangat kami. Setiap momen dirancang untuk bikin hati bahagia.</p>
        </div>

        <!-- Card 4 -->
        <div class="p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="mb-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 0 0-.584.859 6.753 6.753 0 0 0 6.138 5.6 6.73 6.73 0 0 0 2.743 1.346A6.707 6.707 0 0 1 9.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 0 0-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 0 1-1.112-3.173 6.73 6.73 0 0 0 2.743-1.347 6.753 6.753 0 0 0 6.139-5.6.75.75 0 0 0-.585-.858 47.077 47.077 0 0 0-3.07-.543V2.62a.75.75 0 0 0-.658-.744 49.22 49.22 0 0 0-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 0 0-.657.744Zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 0 1 3.16 5.337a45.6 45.6 0 0 1 2.006-.343v.256Zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 0 1-2.863 3.207 6.72 6.72 0 0 0 .857-3.294Z" clip-rule="evenodd" />
                </svg>

                <h3 class="text-xl font-semibold text-primary-900">Kualitas</h3>
            </div>
            <p class="text-gray-700 text-sm">Kami selalu mengutamakan pelayanan terbaik, karena Anda layak mendapat pengalaman liburan yang luar biasa.</p>
        </div>
    </div>

    <div class="text-center mb-10 mt-4">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-900 mb-2">Kunjungi Kantor Kami</h2>
        <p class="text-gray-600 text-base font-medium max-w-2xl mx-auto">
            Kami dengan senang hati menyambut Anda di kantor kami untuk konsultasi perjalanan yang personal dan nyaman.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-primary-900">Kantor Pusat</h3>
                <p class="text-gray-700 text-base">Jl. Mulyosari Baru No. 42 - 44, Kav. 89, Kota Surabaya</p>
                <p class="text-gray-700 text-base">Tel: <a href="tel:+628112557728" class="text-primary-700 hover:underline">+62 811 2557 728</a></p>
                <p class="text-gray-700 text-base">Email: <a href="mailto:bosskutourandtravel@gmail.com" class="text-primary-700 hover:underline">bosskutourandtravel@gmail.com</a></p>
            </div>

            <div class="pt-6 border-t border-gray-300 space-y-4">
                <h3 class="text-2xl font-bold text-primary-900">Jam Kerja</h3>
                <ul class="text-gray-700 text-base space-y-1">
                    <li>Senin - Jumat: 08.00 WIB – 17.00 WIB</li>
                    <li>Sabtu: 08.00 WIB – 16.00 WIB</li>
                    <li>Minggu & Tanggal Merah: Libur</li>
                </ul>
            </div>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-xl">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8067697649635!2d112.79829319999999!3d-7.2628191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f90043dffc1f%3A0x909c5b4c3d9400a5!2sBossku%20Tour%20%26%20travel!5e0!3m2!1sid!2sid!4v1745803931482!5m2!1sid!2sid"
                width="100%"
                height="100%"
                style="min-height: 400px; border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>



    <!-- Contact Prompt -->
    <div class="flex justify-center mt-8">
        <p class="text-sm font-medium text-gray-600">
            Punya pertanyaan? <a href="contact.php" class="text-[#02335B] font-semibold hover:underline">Hubungi tim kami</a> — kami siap membantu!
        </p>
    </div>
</div>

<?php
include "footer.php";
?>