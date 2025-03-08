<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<style>
.header-banner {
    height: 300px;
    background-image: url('<?php echo $domain_web ?>img/header/faq.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    font-size: 2.5rem;
    font-weight: bold;
}

/* Container */
.terms {
    max-width: 900px;
    margin: 50px auto;
    padding: 20px;
}

/* Card untuk terms */
.terms-card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.terms-card:hover {
    transform: translateY(-5px);
}

/* Typography */
.terms-card h2 {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #2c3e50;
}

.terms-card p {
    font-size: 16px;
    text-align: justify;
    line-height: 1.6;
    color: #555;
}

/* Responsif */
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
                <strong>Bossku Tour & Travel</strong> adalah agen perjalanan yang dimiliki dan dioperasikan oleh PT Performa Tour & Travel. Website ini menyediakan informasi umum maupun khusus bagi pelanggan yang menggunakan layanan kami.
            </p>
            <p>
                Dengan menggunakan website ini, pelanggan setuju untuk memberikan informasi pribadi yang akan digunakan sesuai dengan ketentuan layanan kami.
            </p>
            <p>
                Harga pemesanan yang tertera dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu. Jika terjadi kesalahan sistem yang menyebabkan harga tidak wajar, kami berhak membatalkan pesanan dan mengembalikan dana pelanggan.
            </p>
        </div>
    </div>
</body>


<?php
include "footer.php"
?>