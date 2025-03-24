<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<style>
/* Overlay */
.header-banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
}

/* Container */
.terms {
    max-width: 850px;
    margin: 50px auto;
    padding: 20px;
}

/* Card */
.terms-card {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    border-left: 5px solid #007bff;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.terms-card:hover {
    transform: translateY(-3px);
    box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.15);
}

/* Typography */
.terms-card h2 {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 18px;
    color: #333;
}

.terms-card p {
    font-size: 16px;
    text-align: justify;
    line-height: 1.7;
    color: #444;
}

/* Responsive */
@media (max-width: 768px) {
    .header-banner {
        font-size: 2rem;
        height: 250px;
    }

    .terms-card {
        padding: 20px;
    }
}
</style>

<body>

    <div class="container terms">
        <div class="terms-card">
            <h2>Syarat & Ketentuan</h2>
            <p>
                <strong>Bossku Tour & Travel</strong> adalah agen perjalanan yang menyediakan berbagai paket wisata domestik dan internasional. Informasi yang tersedia di website ini ditujukan untuk memberikan kemudahan bagi pelanggan dalam merencanakan perjalanan.
            </p>
            <p>
                Dengan melakukan pemesanan, pelanggan menyetujui penggunaan data pribadi sesuai dengan kebijakan privasi kami.
            </p>
            <p>
                Harga yang tertera dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya. Jika terjadi kesalahan sistem yang menyebabkan harga tidak sesuai, kami berhak membatalkan pesanan dan mengembalikan dana pelanggan.
            </p>
            <p>
                Pemesanan harus dilakukan jauh hari sebelum keberangkatan untuk memastikan ketersediaan tiket dan akomodasi. Semua peserta tour wajib mematuhi peraturan yang berlaku selama perjalanan.
            </p>
            <p>
                Bossku Tour & Travel tidak bertanggung jawab atas kehilangan barang pribadi, keterlambatan penerbangan, atau perubahan jadwal akibat kondisi di luar kendali kami.
            </p>
        </div>
    </div>

</body>

<?php
include "footer.php"
?>
