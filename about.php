<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <div style="padding-top: 40px; height: 300px; background-image:url('<?php echo $domain_web ?>img/header/pantai.jpg'); background-position: bottom; background-repeat: no-repeat; background-size: cover;">
    </div>
    <div class="container" style="max-width: 950px;">
        <div class="card">
            <div class="card-body">
                <div class="judul" style="font-size: 40px; font-weight: bold; text-align: center;">ABOUT</div>
                <div class="content" style="padding: 20px;">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <img src="<?php echo $domain_web ?>img/header/tri.png" alt=""> -->
                        </div>
                        <div class="col-md-8" style="text-align: justify;">2Canholiday adalah agen perjalanan ritel dan online yang menangani jenis perjalanan individu dan kelompok dengan penjualan distribusi sebagian besar berasal dari situs web dan media sosial.</br></br>
                            2Canholiday juga menawarkan paket liburan menarik terlengkap yang dibuat berdasarkan minat pelanggan, Dengan beragam akomodasi mulai dari standar hingga mewah, kami menawarkan berbagai pilihan paket menarik yang tersedia di website kami dan juga paket yang disesuaikan berdasarkan permintaan klien.
                        </div>
                    </div>
                    <div style="padding: 60px;"></div>
                    <div class="row" style="text-align: center;">
                        <div class="col-md-3">
                            <img src="<?php echo $domain_web ?>img/header/about-services-1.png" alt="">
                            <div style="font-size: 20px; font-weight: bold; color: darkviolet;">Customized Holiday</div>
                            <p style="padding: 20px 10px; width: auto; text-wrap: wrap; text-align: justify;">Menawarkan liburan yang disesuaikan baik untuk wisatawan individu atau kelompok di mana klien dapat membuat perjalanan sesuai kebutuhan mereka</p>
                        </div>
                        <div class="col-md-3">
                            <img src="<?php echo $domain_web ?>img/header/about-services-2.png" alt="">
                            <div style="font-size: 20px; font-weight: bold; color: darkviolet;">Group Incentives</div>
                            <p style="padding: 20px 10px; width: auto; text-wrap: wrap; text-align: justify;">Menangani setiap insentif perusahaan atau tur kelompok atas permintaan apa pun dari organisasi perusahaan atau industri.</p>
                        </div>
                        <div class="col-md-3">
                            <img src="<?php echo $domain_web?>img/header/about-services-3.png" alt="">
                            <div style="font-size: 20px; font-weight: bold; color: darkviolet;">Travel Document</div>
                            <p style="padding: 20px 10px; width: auto; text-wrap: wrap; text-align: justify;">Membantu untuk mendapatkan dan memperbarui paspor serta membantu proses pengajuan visa.</p>
                        </div>
                        <div class="col-md-3">
                            <img src="<?php echo $domain_web?>img/header/about-services-4.png" alt="">
                            <div style="font-size: 20px; font-weight: bold; color: darkviolet;">Travel Insurance</div>
                            <p style="padding: 20px 10px; width: auto; text-wrap: wrap; text-align: justify;">Menyediakan asuransi perjalanan untuk pelancong individu atau perjalanan perusahaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<?php
include "footer.php"
?>