<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <div class="text-center mb-8">
        <h1 class="text-[#02335B] text-lg font-semibold tracking-wide">Passport</h1>
        <h2 class="text-4xl font-bold tracking-wide text-[#02335B]">Solusi Praktis untuk Pengurusan Paspor Anda</h2>
        <p class="font-medium text-sm tracking-wide text-gray-500 mt-2">Layanan mudah, cepat, dan terpercaya untuk setiap kebutuhan paspor Anda.</p>
    </div>

    <div class="flex justify-between items-center mb-4">
        <a href="javascript:history.back()" class="text-center text-md font-semibold tracking-wide hover:underline ">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="detail-visa-individu.php" class="text-center text-md font-semibold tracking-wide hover:underline ">
            Visa Individu <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-6 items-start">
        <!-- Konten A -->
        <div class="w-full md:w-3/4 text-justify">
            <img src="img/Passport.jpg" alt="Layanan Paspor" class="w-full h-96 object-cover rounded-xl mb-4">

            <h1 class="text-2xl font-bold tracking-wide text-[#02335B]">Layanan Paspor</h1>

            <p class="text-gray-600 text-md mb-4">
                Kami menyediakan layanan paspor yang lengkap untuk memastikan proses pengurusan dokumen perjalanan Anda berjalan lancar dan tanpa hambatan.
            </p>

            <p class="text-gray-600 text-md mb-4">
                Dengan tim profesional yang siap membantu, kami akan memandu Anda melalui setiap langkah, mulai dari persiapan dokumen hingga pengajuan. Layanan kami dirancang untuk memenuhi kebutuhan perjalanan pribadi, bisnis, atau kunjungan keluarga Anda.
            </p>

            <p class="text-gray-600 text-md mb-4">
                Kami juga menawarkan konsultasi gratis untuk membantu Anda memahami persyaratan dan prosedur yang diperlukan, sehingga Anda dapat mempersiapkan segala sesuatunya dengan lebih baik.
            </p>

            <!-- Sub Judul 1 -->
            <h2 class="text-xl font-semibold text-[#02335B] mt-6 mb-2">Pusat Layanan Paspor</h2>
            <p class="text-gray-600 text-md mb-2">
                Pusat Layanan Paspor kami hadir untuk memberikan solusi terbaik bagi kebutuhan paspor Anda, dengan layanan yang cepat, nyaman, dan terpercaya.
            </p>
            <p class="text-gray-600 text-md mb-2">
                Kami berkomitmen untuk memberikan pengalaman terbaik dengan dukungan tim profesional yang siap membantu Anda setiap saat.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                <!-- Badge 1 -->
                <div class="flex items-center gap-3 bg-[#FFCA10] text-blue-900 px-5 py-4 rounded-xl shadow-md hover:shadow-md transition-shadow duration-300">
                    <div class="mt-1">
                        <svg class="w-6 h-6 text-[#02335B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-snug">Pelayanan profesional dan ramah</p>
                </div>

                <!-- Badge 2 -->
                <div class="flex items-center gap-3 bg-[#FFCA10] text-blue-900 px-5 py-4 rounded-2xl shadow-md hover:shadow-md transition-shadow duration-300">
                    <div class="mt-1">
                        <svg class="w-6 h-6 text-[#02335B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-snug">Proses pengajuan yang mudah dan efisien</p>
                </div>

                <!-- Badge 3 -->
                <div class="flex items-center gap-3 bg-[#FFCA10] text-blue-900 px-5 py-4 rounded-2xl shadow-md hover:shadow-md transition-shadow duration-300">
                    <div class="mt-1">
                        <svg class="w-6 h-6 text-[#02335B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-snug">Tidak perlu menunggu lama</p>
                </div>

                <!-- Badge 4 -->
                <div class="flex items-center gap-3 bg-[#FFCA10] text-blue-900 px-5 py-4 rounded-2xl shadow-md hover:shadow-md transition-shadow duration-300">
                    <div class="mt-1">
                        <svg class="w-6 h-6 text-[#02335B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-snug">Dijamin lolos wawancara</p>
                </div>

                <!-- Badge 5 (baru) -->
                <div class="flex items-center gap-3 bg-[#FFCA10] text-blue-900 px-5 py-4 rounded-2xl shadow-md hover:shadow-md transition-shadow duration-300">
                    <div class="mt-1">
                        <svg class="w-6 h-6 text-[#02335B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-snug">Layanan foto kapan saja</p>
                </div>

                <!-- Badge 6 (baru) -->
                <div class="flex items-center gap-3 bg-[#FFCA10] text-blue-900 px-5 py-4 rounded-2xl shadow-md hover:shadow-md transition-shadow duration-300">
                    <div class="mt-1">
                        <svg class="w-6 h-6 text-[#02335B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium leading-snug">Layanan antar jemput dokumen</p>
                </div>
            </div>


            <!-- Sub Judul 2 -->
            <h2 class="text-xl font-semibold text-[#02335B] mt-6 mb-2">Daftar Harga Layanan Paspor</h2>
            <div class="space-y-4">
                <!-- Accordion Item 1 -->
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <button class="w-full text-left bg-[#02335B] text-[#FFCA10] font-semibold px-4 py-3 focus:outline-none flex justify-between items-center" onclick="toggleAccordion('collapseOne')">
                        <span>Proses Normal (8 Hari Kerja)</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300" id="icon-collapseOne" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="collapseOne" class="hidden px-4 py-2 transition-all duration-300 ease-in-out">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full mx-auto text-left border-collapse border border-gray-300 mt-4">
                                <thead>
                                    <tr class="bg-[#FFCA10] text-[#02335B] text-center">
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Jenis Layanan</th>
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Tipe</th>
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Baru</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Biasa</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 1.250.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Baru</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">E Paspor</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 2.500.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Hilang</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Biasa</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 2.500.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Hilang</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">E Paspor</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 3.500.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Rusak</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Biasa</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 2.000.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Rusak</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">E Paspor</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 3.000.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Accordion Item 2 -->
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <button class="w-full text-left bg-[#02335B] text-[#FFCA10] font-bold px-4 py-3 focus:outline-none flex justify-between items-center" onclick="toggleAccordion('collapseTwo')">
                        <span>Proses Kilat (2 Hari Kerja)</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300" id="icon-collapseTwo" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="collapseTwo" class="hidden px-4 py-2 transition-all duration-300 ease-in-out">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full mx-auto text-left border-collapse border border-gray-300 mt-4">
                                <thead>
                                    <tr class="bg-[#FFCA10] text-[#02335B] text-center">
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Jenis Layanan</th>
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Tipe</th>
                                        <th class="border border-gray-300 px-4 py-2 font-semibold">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Baru</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Biasa</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 2.000.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Baru</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">E Paspor</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 3.000.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Hilang</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Biasa</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 3.000.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Hilang</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">E Paspor</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 4.000.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Rusak</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Biasa</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 2.500.000</td>
                                    </tr>
                                    <tr class="hover:bg-blue-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Paspor Rusak</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700">E Paspor</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-700 text-right">Rp 3.500.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function toggleAccordion(id) {
                    const content = document.getElementById(id);
                    const icon = document.getElementById(`icon-${id}`);
                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    } else {
                        content.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                    }
                }
            </script>
        </div>

        <!-- Konten B -->
        <div class="w-full md:w-1/4 flex flex-col justify-between items-center gap-6">
            <!-- Konten Atas -->
            <div class="w-full max-w-md flex flex-col shadow-lg rounded-2xl p-6 items-center gap-4 border-t-4 border-blue-600 bg-white transform transition-all duration-300 hover:-translate-y-2 hover:border-blue-800">
                <p class="font-medium text-sm tracking-wide text-center text-gray-500">DAPATKAN LAYANAN PASPOR</p>
                <h1 class="text-2xl font-bold tracking-wide text-[#02335B] mb-4 text-center">Jangan Ragu Untuk Menghubungi Kami</h1>
                <a href="contact.php" class="inline-block bg-blue-600 text-white text-sm py-2 px-6 rounded-md hover:bg-blue-800 transition duration-300">
                    Hubungi Kami
                </a>
            </div>

            <!-- Konten Bawah -->
            <a href="pdf/Passport.pdf" download class="bg-[#FFCA10] text-center w-full max-w-md flex flex-row items-center shadow-lg rounded-xl px-6 py-3 gap-2 border-t-4 border-blue-600 transform transition-all duration-300 hover:-translate-y-2 hover:border-blue-800 text-[#02335B] font-semibold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#02335B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v3a2 2 0 002 2m0 0v6a2 2 0 002 2h4a2 2 0 002-2v-6m-6 0h6" />
                </svg>
                <span>Unduh File PDF</span>
            </a>
        </div>
    </div>
</div>

<script>
    function toggleAccordion(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>
<?php
include "footer.php";
?>