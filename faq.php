<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide mb-2 border border-[#02335B] rounded-full px-2 py-0 inline-block bg-[#F0F8FF]">FAQs</h1>
    <h2 class="text-3xl font-bold tracking-wide">Frequently Asked Questions</h2>
    <p class="font-medium text-sm tracking-wide text-gray-500 mb-4">Find answers to common questions about our services.</p>

    <!-- FAQ Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <div class="space-y-4">
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apa saja yang termasuk dalam paket tour?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Paket mencakup transportasi, akomodasi, tiket masuk objek wisata, makan sesuai itinerary, dan pemandu wisata.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apakah saya bisa request destinasi tertentu?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Bisa! Kami menyediakan paket private tour yang fleksibel sesuai kebutuhan Anda.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apakah ada minimal jumlah peserta?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Beberapa paket memiliki jumlah minimal peserta. Silakan cek detail masing-masing paket.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Bagaimana jika saya membatalkan tour? Apakah bisa refund?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Pembatalan bisa dilakukan dengan ketentuan tertentu. Umumnya, ada potongan sesuai waktu pembatalan.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apakah tour ini cocok untuk anak-anak atau lansia?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Kami punya banyak pilihan paket yang ramah untuk semua usia. Konsultasikan dengan tim kami.</p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Metode pembayaran apa saja yang tersedia?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Kami menerima transfer bank, dan pembayaran langsung di kantor.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apakah harus bayar penuh di awal?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Cukup bayar DP 50% saat reservasi. Pelunasan maksimal H-14 sebelum keberangkatan.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apakah ada biaya tambahan?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Biaya tambahan hanya jika ada kebutuhan pribadi atau pengeluaran di luar itinerary.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Bagaimana saya tahu pembayaran sudah diterima?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Kami akan mengirim konfirmasi melalui WhatsApp atau email setelah pembayaran diterima.</p>
            </div>
            <div>
                <h3 class="font-semibold tracking-wide text-md mb-1">Apakah pembayaran online aman?</h3>
                <p class="font-medium text-sm tracking-wide text-gray-600 mb-2">Ya, sistem kami aman dan menggunakan metode pembayaran terpercaya.</p>
            </div>
        </div>
    </div>

    <div class="mt-10 text-center">
        <p class="text-gray-600">If you have more questions, feel free to <a href="contact.php" class="text-[#02335B] font-semibold">contact us</a>.</p>
    </div>
</div>

<?php
include "footer.php";
?>