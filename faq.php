<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <div class="position-relative">
        <img src="img/Map.jpg" alt="Europe Map" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <div class="faq-header">FAQ</div>
        </div>
    </div>

    <div class="faq-container">
        <div class="accordion" id="faqAccordion">
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $i; ?>">
                        <button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="<?php echo $i == 1 ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $i; ?>">
                            <?php echo $question; ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i == 1 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?php echo $answer; ?>
                        </div>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
    </div>
</body>


<?php
include "footer.php"
?>

<style>
    .faq-header {
        height: 300px;
        background-image: url('<?php echo $domain_web ?>img/header/faq.jpg');
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 40px;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .faq-container {
        max-width: 950px;
        margin: auto;
        padding: 40px 20px;
    }
</style>