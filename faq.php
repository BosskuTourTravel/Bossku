<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <!-- Hero Section with image and improved overlay visibility -->
    <div class="relative w-full h-[500px]">
        <!-- Image -->
        <img src="img/Map.jpg" alt="Europe Map" class="w-full h-full object-cover">

        <!-- Header text (FAQ) -->
        <div class="absolute inset-0 flex items-center justify-center text-center text-white z-10">
            <h1 class="text-4xl font-extrabold text-shadow-lg">FAQ</h1>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="space-y-6">
            <?php
            $faqs = [
                "Apa Itu Bossku Tour & Travel?" => "Bossku Tour & Travel adalah agen perjalanan yang menyediakan berbagai paket wisata domestik dan internasional dengan harga terbaik serta pelayanan yang profesional.",
                "Bagaimana cara memesan paket tour?" => "Anda bisa memesan paket tour melalui website resmi kami, menghubungi customer service via WhatsApp, atau datang langsung ke kantor kami untuk konsultasi dan pemesanan.",
                "Apa saja metode pembayaran yang tersedia?" => "Kami menerima pembayaran melalui transfer bank, serta pembayaran langsung di kantor kami.",
                "Apakah bisa melakukan pembayaran secara cicilan?" => "Ya, kami menyediakan opsi pembayaran cicilan untuk beberapa paket tour tertentu. Silakan hubungi customer service kami untuk informasi lebih lanjut.",
                "Apakah harga paket sudah termasuk tiket pesawat?" => "Tergantung pada paket yang dipilih. Beberapa paket sudah termasuk tiket pesawat, sementara yang lain hanya mencakup akomodasi dan fasilitas lainnya.",
                "Apakah tersedia layanan private tour?" => "Ya, kami menyediakan layanan private tour yang dapat disesuaikan dengan kebutuhan Anda, baik untuk keluarga, perusahaan, atau kelompok tertentu.",
                "Bagaimana kebijakan pembatalan perjalanan?" => "Pembatalan dapat dilakukan sesuai dengan syarat & ketentuan yang berlaku. Biaya pembatalan akan dikenakan sesuai dengan waktu pembatalan sebelum keberangkatan.",
                "Apakah paket tour sudah termasuk asuransi perjalanan?" => "Beberapa paket tour sudah termasuk asuransi perjalanan. Untuk informasi lebih detail, silakan cek deskripsi paket atau hubungi tim kami.",
                "Bagaimana jika terjadi perubahan jadwal perjalanan?" => "Kami akan menginformasikan kepada pelanggan jika ada perubahan jadwal dan memberikan solusi terbaik sesuai kebijakan yang berlaku."
            ];
            $i = 1;
            foreach ($faqs as $question => $answer) {
            ?>
                <div class="border-b border-gray-300 py-4">
                    <h3 class="text-xl font-semibold text-[#02335B] cursor-pointer" onclick="toggleAnswer(<?php echo $i; ?>)">
                        <?php echo $question; ?>
                    </h3>
                    <div id="answer<?php echo $i; ?>" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="mt-2 text-gray-600"><?php echo $answer; ?></p>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
    </div>

    <script>
        // JavaScript untuk toggle visibility dari answer di FAQ
        function toggleAnswer(index) {
            const answerElement = document.getElementById(`answer${index}`);

            // Toggle antara max-h-0 dan max-h-[1000px] untuk memberikan animasi yang smooth
            if (answerElement.classList.contains('max-h-0')) {
                answerElement.classList.remove('max-h-0');
                answerElement.classList.add('max-h-[1000px]'); // Bisa diubah sesuai ukuran yang pas
            } else {
                answerElement.classList.remove('max-h-[1000px]');
                answerElement.classList.add('max-h-0');
            }
        }
    </script>
</body>

<?php
include "footer.php";
?>

<style>
    .text-shadow-lg {
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    }
</style>