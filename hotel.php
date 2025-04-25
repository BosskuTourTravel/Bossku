<?php
include "header.php";
include "navbar.php";
include "slug.php";
?>

<div class="w-full">
    <img src="img/Hotel.jpg" alt="Gambar Hotel" class="mt-10 w-full h-[550px] object-cover">
</div>

<div class="container mx-auto px-4 py-10 mb-5">
    <!-- Judul -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Hotel</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center mb-2">Butuh Penginapan? Kami Siap Bantu</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500 mb-6">
        Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan terkait hotel.
    </p>

    <!-- Deskripsi umum -->
    <div class="text-justify text-gray-700 text-base tracking-wide leading-relaxed mb-10">
        <p class="mb-4">
            Kami bekerja sama dengan berbagai hotel terpercaya yang tersebar di berbagai destinasi populer, baik di dalam maupun luar negeri. Mulai dari hotel berbintang tiga yang nyaman hingga hotel mewah berbintang lima dengan fasilitas kelas atas, semuanya tersedia untuk memenuhi kebutuhan perjalanan Anda. Pilihan kamar yang tersedia pun beragam, mulai dari tipe standar yang efisien dan hemat biaya, hingga kamar suite yang mewah dan luas. Apakah Anda bepergian untuk urusan bisnis, liburan keluarga, bulan madu romantis, atau bahkan perjalanan solo, kami siap membantu mencarikan akomodasi terbaik untuk Anda.
        </p>
        <p class="mb-4">
            Kami memahami bahwa setiap orang memiliki kebutuhan dan preferensi yang berbeda dalam memilih penginapan. Oleh karena itu, kami menyediakan layanan konsultasi pemesanan hotel secara personal. Anda hanya perlu menghubungi kami melalui WhatsApp, dan tim kami akan membantu mencarikan opsi terbaik sesuai dengan tanggal perjalanan, lokasi yang diinginkan, jumlah tamu, serta anggaran yang tersedia.
        </p>
        <p>
            Dengan pengalaman dan jaringan yang luas di industri pariwisata, kami berkomitmen untuk memberikan pelayanan yang cepat, ramah, dan profesional. Jangan ragu untuk mengandalkan kami sebagai mitra perjalanan Anda. Kepuasan dan kenyamanan Anda selama menginap adalah prioritas utama kami.
        </p>
    </div>


    <!-- 2 Kolom: Fasilitas & Peraturan -->
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Fasilitas umum -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-[#02335B] mb-4 flex items-center text-center justify-center">
                <i class="fa fa-concierge-bell mr-2 text-[#02335B]"></i>Fasilitas Umum yang Tersedia
            </h3>
            <ul class="list-disc list-inside text-base text-gray-600 space-y-1">
                <li>Wi-Fi Gratis</li>
                <li>AC dan TV di setiap kamar</li>
                <li>Kamar mandi dalam dengan air panas</li>
                <li>Sarapan gratis (untuk beberapa hotel)</li>
                <li>Layanan kamar 24 jam</li>
                <li>Kolam renang & pusat kebugaran (tergantung hotel)</li>
                <li>Parkir gratis</li>
            </ul>
        </div>

        <!-- Peraturan umum -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-[#02335B] mb-4 flex items-center text-center justify-center">
                <i class="fa fa-info-circle mr-2 text-[#02335B]"></i>Peraturan Umum Hotel
            </h3>
            <ul class="list-disc list-inside text-base text-gray-600 space-y-1">
                <li>Check-in mulai pukul 14:00, check-out maksimal pukul 12:00</li>
                <li>Tamu wajib menunjukkan identitas resmi saat check-in</li>
                <li>Tidak diperbolehkan membawa hewan peliharaan (kecuali hotel tertentu)</li>
                <li>Dilarang merokok di area kamar non-smoking</li>
                <li>Pembatalan atau perubahan pemesanan mengikuti kebijakan masing-masing hotel</li>
            </ul>
        </div>
    </div>

    <!-- Tombol kontak -->
    <div class="text-center">
        <?php
        $no_wa = "6281234567890";
        $pesan = "Halo, saya ingin bertanya tentang pemesanan hotel.";
        $pesan_encode = urlencode($pesan);
        ?>
        <p class="text-sm text-gray-800 mb-3">Tertarik atau punya permintaan khusus? Hubungi kami langsung:</p>
        <a href="https://wa.me/<?php echo $no_wa; ?>?text=<?php echo $pesan_encode; ?>" target="_blank" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full shadow-lg transition duration-200">
            <i class="fab fa-whatsapp mr-2"></i>Chat via WhatsApp
        </a>
    </div>
</div>


<?php
include "footer.php";
?>