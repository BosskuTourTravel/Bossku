<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<style>
    .hero {
        height: 350px;
        background: url('<?php echo $domain_web ?>img/header/pantai.jpg') no-repeat center center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 40px;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }

    .about-content {
        padding: 50px 20px;
        text-align: center;
    }

    .about-content p {
        max-width: 800px;
        margin: auto;
        line-height: 1.8;
    }

    .service-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Pastikan tinggi setiap card seragam */
    }

    .service-card .card-body {
        flex-grow: 1;
        /* Memastikan teks menyesuaikan */
    }

    .service-card img {
        height: 200px;
        /* Sesuaikan ukuran gambar */
        object-fit: cover;
        /* Agar gambar tidak terdistorsi */
    }

    .service-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease-in-out;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<body>
    <div class="position-relative">
        <img src="img/About.jpg" alt="Europe Map" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <div class="hero">ABOUT US</div>
        </div>
    </div>

    <div class="about-content">
        <h2>Tentang Bossku Tour & Travel</h2>
        <p>Bossku Tour & Travel adalah agen perjalanan yang menyediakan berbagai paket wisata domestik dan internasional dengan harga terbaik. Kami berkomitmen untuk memberikan pengalaman perjalanan yang nyaman, aman, dan berkesan bagi setiap pelanggan dengan layanan profesional dan fasilitas terbaik.</p>
    </div>


    <div class="container text-center py-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card service-card">
                    <img src="img/Map.jpg" class="card-img-top" alt="Customized Holiday">
                    <div class="card-body">
                        <h5 class="card-title">Customized Holiday</h5>
                        <p class="card-text">Liburan yang bisa disesuaikan sesuai keinginan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card service-card">
                    <img src="img/Group.jpg" class="card-img-top" alt="Group Incentives">
                    <div class="card-body">
                        <h5 class="card-title">Group Incentives</h5>
                        <p class="card-text">Paket perjalanan untuk perusahaan atau grup.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card service-card">
                    <img src="img/Paspor.jpg" class="card-img-top" alt="Travel Document">
                    <div class="card-body">
                        <h5 class="card-title">Travel Document</h5>
                        <p class="card-text">Membantu dalam pengurusan paspor dan visa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card service-card">
                    <img src="img/Insurance.jpg" class="card-img-top" alt="Travel Insurance">
                    <div class="card-body">
                        <h5 class="card-title">Travel Insurance</h5>
                        <p class="card-text">Perlindungan asuransi perjalanan bagi pelancong.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<?php
include "footer.php"
?>