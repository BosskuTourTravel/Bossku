<?php

include "db=connection.php";

include "slug.php";

include "API/Price/Api_LT_total_baru.php";



?>

<!DOCTYPE html>

<html lang="en">

<?php

include "header.php";

include "navbar.php";



$query = "SELECT consortium_list.*,country.img FROM consortium_list LEFT JOIN country ON consortium_list.country LIKE country.name where consortium_list.continent='" . $_GET['id'] . "' && consortium_list.detail='" . $_GET['region'] . "' && consortium_list.country LIKE '%" . $_GET['country'] . "%'";
$rs = mysqli_query($con, $query);





?>



<body>

    <div class="position-relative">

        <img src="img/asia/IndonesiaThumb.jpg" alt="Europe Map" class="img-fluid w-100" style="height: 500px; object-fit: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">

            <h1 class="fw-bold"><?php echo $_GET['country'] ?></h1>

        </div>

    </div>

    <div class="container my-4">

        <h2 class="text-center mb-4 fw-bold">Trip <?php echo $_GET['country'] ?></h2>



        <!-- Filter dan Search -->

        <div class="row mb-4">

            <!-- <div class="col-md-4">

                <select id="filterKategori" class="form-select">

                    <option value="all">Semua Kategori</option>

                    <option value="paket-tour">Paket Tour</option>

                    <option value="land-tour">Land Tour</option>

                    <option value="consortium">Consortium</option>

                </select>

            </div> -->

            <div class="col-md-4">

                <input type="text" id="searchInput" class="form-control" placeholder="Cari trip...">

            </div>

        </div>

        <div class="row" id="tripContainer">
            <?php while ($row = mysqli_fetch_array($rs)) {

                // konversi kurs
                $adt = 0;
                if($row['kurs'] != "IDR"){
                    $datareq = array(
                        "kurs" =>  $row['kurs'],
                        "nominal" => $$row['adt'],
                    );
                    $adt_kurs = get_kurs($datareq);
                    $rs_adt_kurs = json_decode($adt_kurs, true);
                    $adt = $rs_adt_kurs['data'];

                }else{
                    $adt = $row['adt'];
                }

                // Jika link gambar berasal dari Google Drive, ubah ke direct link
                $link_gambar = $row['link_gambar'];
                if (strpos($link_gambar, 'drive.google.com') !== false) {
                    preg_match('/\/d\/(.*?)\//', $link_gambar, $matches);
                    if (!empty($matches[1])) {
                        $link_gambar = "https://drive.google.com/uc?export=view&id=" . $matches[1];
                    }
                }
            ?>
                <div class="col-lg-4 col-md-6 mb-4 trip-card">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative">

                        <!-- Thumbnail Flyer -->
                        <?php if (!empty($link_gambar)) { ?>
                            <img src="<?php echo $link_gambar; ?>" alt="Flyer <?php echo $row['nama']; ?>" class="card-img-top" style="height: 300px; object-fit: cover;">
                        <?php } ?>

                        <div class="card-body text-center p-4 d-flex flex-column">
                            <!-- Nama Paket -->
                            <h5 class="fw-bold text-dark"><?php echo $row['nama'] ?></h5>

                            <!-- Start Location -->
                            <p class="text-muted small">Start from: <span class="fw-semibold"><?php echo $row['start'] ?></span></p>

                            <!-- Harga -->
                            <div class="price-tag bg-warning text-white py-2 px-3 rounded-pill mx-auto">
                                <span class="fs-5 fw-bold"><?php echo "IDR " . number_format($adt); ?></span>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-4 d-grid gap-2">
                                <a href="https://wa.me/628112557728?text=Halo Bossku" target="_blank" class="btn btn-success btn-lg fw-bold shadow-sm">
                                    <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                                </a>

                                <?php if (!empty($row['link_pdf'])) { ?>
                                    <a href="<?php echo $row['link_pdf']; ?>" target="_blank" class="btn btn-outline-primary btn-lg fw-bold shadow-sm">
                                        <i class="bi bi-file-earmark-text"></i> Lihat Itinerary
                                    </a>
                                <?php } ?>

                                <?php if (!empty($row['link_gambar'])) { ?>
                                    <a href="<?php echo $row['link_gambar']; ?>" target="_blank" class="btn btn-outline-warning btn-lg fw-bold shadow-sm">
                                        <i class="bi bi-image"></i> Lihat Flyer
                                    </a>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let searchText = this.value.toLowerCase();
            let cards = document.querySelectorAll(".trip-card");

            cards.forEach(card => {
                let title = card.querySelector(".card-title").innerText.toLowerCase();
                if (title.includes(searchText)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
</body>

<?php
include "footer.php";
?>

<style>
    .trip-card .card {
        transition: all 0.3s ease-in-out;
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
    }

    .trip-card .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
    }

    /* Harga */
    .price-tag {
        font-size: 1.2rem;
        font-weight: bold;
        display: inline-block;
        margin-top: 10px;
    }

    /* Tombol */
    .btn-lg {
        font-size: 1rem;
        padding: 12px;
        border-radius: 12px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }
</style>