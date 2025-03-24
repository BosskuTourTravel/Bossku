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
?>


<body style="overflow-x: hidden; font-family: 'poppins', sans-serif; background-color: #f4f4f4;">

    <div class="position-relative">
        <!-- Gambar Background -->
        <img src="img/asia/AsiaBaratThumb.jpg" alt="Asia Barat" class="img-fluid w-100" style="height: 550px; object-fit: cover;">

        <!-- Overlay dengan efek Glassmorphism -->
        <div class="position-absolute top-50 start-50 translate-middle w-75 p-4 rounded text-white shadow-lg custom-bg">
            <h2 class="text-center fw-bold mb-3 text-warning">Temukan Destinasi Impianmu</h2>

            <!-- Form Pencarian -->
            <form method="GET" action="" class="row g-3">
                <!-- Input Search by Country -->
                <div class="col-md-6">
                    <label for="country" class="form-label fw-semibold">Cari Berdasarkan Negara</label>
                    <input type="text" id="country" name="country" class="form-control rounded-pill px-3 py-2 text-dark" placeholder="Masukkan negara..." value="<?= htmlspecialchars($_GET['country'] ?? '') ?>">
                </div>

                <!-- Filter by Start (Dropdown) -->
                <div class="col-md-4">
                    <label for="start" class="form-label fw-semibold">Filter Berdasarkan Start</label>
                    <select id="start" name="start" class="form-select rounded-pill px-3 py-2 text-dark">
                        <option value="">Pilih Start</option>
                        <option value="Surabaya" <?= (isset($_GET['start']) && $_GET['start'] == 'SBY') ? 'selected' : '' ?>>Surabaya (SBY)</option>
                        <option value="Jakarta" <?= (isset($_GET['start']) && $_GET['start'] == 'JKT') ? 'selected' : '' ?>>Jakarta (JKT)</option>
                        <option value="Bali" <?= (isset($_GET['start']) && $_GET['start'] == 'DPS') ? 'selected' : '' ?>>Denpasar (DPS)</option>
                        <option value="Singapore" <?= (isset($_GET['start']) && $_GET['start'] == 'SG') ? 'selected' : '' ?>>Singapura (SG)</option>
                        <option value="Batam" <?= (isset($_GET['start']) && $_GET['start'] == 'BTM') ? 'selected' : '' ?>>Batam (BTM)</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn w-100 btn-cari rounded-pill">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Ambil data pencarian
    $country = isset($_GET['country']) ? $_GET['country'] : '';
    $start = isset($_GET['start']) ? $_GET['start'] : '';

    // Jika user mengisi form, tampilkan hasil
    if (!empty($country) || !empty($start)) {
        echo '<div class="container mt-4">';
        echo '<h3 class="text-center mb-4 fw-bold">Hasil Pencarian</h3>';
        echo '<div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Negara</th>
                            <th>Kota</th>
                            <th>Nama</th>
                            <th>Start</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">';

        // Query Default
        $sql = "SELECT id, country, city, nama, start, status, link_pdf, link_gambar FROM consortium_list WHERE 1=1";

        if (!empty($country)) {
            $sql .= " AND country LIKE '%" . $con->real_escape_string($country) . "%'";
        }
        if (!empty($start)) {
            $sql .= " AND start = '" . $con->real_escape_string($start) . "'";
        }

        $result = mysqli_query($con, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id'] ?? '');
                $country = htmlspecialchars($row['country'] ?? '');
                $city = htmlspecialchars($row['city'] ?? '');
                $nama = htmlspecialchars($row['nama'] ?? '');
                $start = htmlspecialchars($row['start'] ?? '');
                $status = htmlspecialchars($row['status'] ?? '');
                $link_pdf = !empty(trim($row['link_pdf'])) ? htmlspecialchars($row['link_pdf']) : null;
                $link_gambar = !empty(trim($row['link_gambar'])) ? htmlspecialchars($row['link_gambar']) : null;
                $wa_number = "6281234567890"; // Nomor WA

                echo "<tr class='fw-semibold'>
                    <td>{$id}</td>
                    <td>{$country}</td>
                    <td>{$city}</td>
                    <td>{$nama}</td>
                    <td>{$start}</td>
                    <td>
                        <div class='d-flex flex-wrap gap-2 justify-content-center'>";

                // Tombol Lihat Itinerary (Jika Ada)
                if ($link_pdf) {
                    echo "<a href='{$link_pdf}' target='_blank' class='btn btn-outline-primary btn-sm fw-bold'>
                            <i class='bi bi-file-earmark-text'></i> Itinerary
                          </a>";
                }

                // Tombol Lihat Gambar (Jika Ada)
                if ($link_gambar) {
                    echo "<a href='{$link_gambar}' target='_blank' class='btn btn-outline-warning btn-sm fw-bold'>
                            <i class='bi bi-image'></i> Flyer
                          </a>";
                }

                // Tombol Pesan Sekarang (Selalu Ada)
                echo "<a href='https://wa.me/{$wa_number}?text=" . urlencode("Halo, saya tertarik dengan paket {$nama} di {$country}. Bagaimana cara memesannya?") . "' 
                        class='btn btn-outline-success btn-sm fw-bold' target='_blank'>
                        <i class='bi bi-whatsapp'></i> Pesan
                      </a>";

                echo "</div>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center text-muted fw-light'>Tidak ada hasil ditemukan.</td></tr>";
        }

        echo '</tbody></table></div></div>';
    }
    ?>

    <div class="container py-5">
        <!-- Judul -->
        <div class="d-flex align-items-center mb-4">
            <i class="fa fa-globe fa-2x text-primary me-3"></i>
            <h2 class="fw-bold mb-0 text-uppercase">Destinasi</h2>
        </div>

        <div class="row g-4">
            <?php
            $query_con = "SELECT consortium_list.id, consortium_list.continent,continent.img FROM consortium_list LEFT JOIN continent ON consortium_list.continent LIKE continent.name GROUP BY consortium_list.continent";
            $rs_con = mysqli_query($con, $query_con);
            while ($row_con = mysqli_fetch_array($rs_con)) {
                if (isset($row_con['img'])) {
                    $img = $row_con['img'];
                } else {
                    $img = "img/home.png";
                }
            ?>
                <div class="col-md-6">
                    <a href="region.php?id=<?php echo $row_con['continent'] ?>" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                        <img src="<?php echo $img ?>" alt="Asia" class="img-fluid w-100" style="height: 350px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                            <h3 class="fw-bold mb-0 text-white"><?php echo $row_con['continent'] ?></h3>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="container my-5 p-4 bg-white shadow-lg rounded-4" style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.8);">
        <h2 class="table-title text-center fw-bold mb-4 border-bottom pb-2">Admission Ticket</h2>
        <div class="row">
            <?php

            function getGoogleDriveDirectLink($url)
            {
                if (strpos($url, 'drive.google.com') !== false) {
                    preg_match('/d\/([^\/]+)/', $url, $matches);
                    if (!empty($matches[1])) {
                        return "https://lh3.googleusercontent.com/d/{$matches[1]}=s0";
                    }
                }
                return $url;
            }

            $sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
               lti.summer_img, lti.winter_img, lti.autumn_img
        FROM List_tempat AS lt
        LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
        WHERE lt.price > 100000
        LIMIT 1000";

            $result = $con->query($sql);
            $tickets = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tickets[] = $row;
                }
            }

            $maxVisible = 3; // Jumlah card yang ditampilkan pertama kali
            foreach ($tickets as $index => $ticket) {
                $image = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
                $hiddenClass = ($index >= $maxVisible) ? 'hidden-card' : ''; // Sembunyikan jika lebih dari 3
            ?>
                <div class="col-lg-4 col-md-6 mb-4 ticket-card <?php echo $hiddenClass; ?>">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative">
                        <img src="<?php echo htmlspecialchars($image); ?>"
                            alt="Admission Ticket"
                            class="card-img-top" style="height: 250px; object-fit: cover;">

                        <div class="card-body text-center p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark"><?php echo htmlspecialchars($ticket['name']); ?></h5>
                            <p class="text-muted small">
                                Location: <span class="fw-bold text-white px-2 py-1 rounded bg-primary">
                                    <?php echo htmlspecialchars($ticket['location']); ?>
                                </span>
                            </p>
                            <div class="price-tag bg-warning text-white py-2 px-3 rounded-pill mx-auto">
                                <span class="fs-5 fw-bold">IDR <?php echo number_format($ticket['price'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="mt-4 d-grid gap-2">
                                <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?php echo urlencode($ticket['name']); ?>"
                                    target="_blank" class="btn btn-success btn-lg fw-bold shadow-sm">
                                    <i class="bi bi-whatsapp"></i> Buy Ticket
                                </a>
                                <a href="<?php echo htmlspecialchars($image); ?>"
                                    target="_blank" class="btn btn-outline-warning btn-lg fw-bold shadow-sm">
                                    <i class="bi bi-image"></i> Lihat Gambar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo $domain_web ?>tiket.php" class="btn btn-primary btn-lg">Lihat Semua Tiket</a>
        </div>
    </div>

    <div class="container my-5">
        <div><?php include "table_paket_tour.php"; ?></div>
        <div><?php include "table_paket_tour2.php"; ?></div>
    </div>

    <div class="container my-5" style="margin-top: 20px;">
        <div class="header-section">
            <h1>Visa</h1>
            <a href="#">Lihat Lainnya ></a>
        </div>

        <div class="row g-4">
            <!-- Card Visa Jepang -->
            <div class="col-md-3 col-sm-6">
                <div class="visa-card">
                    <img src="img/VisaJapan.jpg" alt="Japan">
                    <div class="visa-content">
                        <h5>Visa Jepang</h5>
                        <p class="price">Rp1.500.000</p>
                    </div>
                </div>
            </div>

            <!-- Card Visa China -->
            <div class="col-md-3 col-sm-6">
                <div class="visa-card">
                    <img src="img/VisaChina.jpg" alt="USA">
                    <div class="visa-content">
                        <h5>Visa China</h5>
                        <p class="price">Rp2.800.000</p>
                    </div>
                </div>
            </div>

            <!-- Card Visa Prancis -->
            <div class="col-md-3 col-sm-6">
                <div class="visa-card">
                    <img src="img/VisaTurkey.jpg" alt="France">
                    <div class="visa-content">
                        <h5>Visa Turkey</h5>
                        <p class="price">Rp2.500.000</p>
                    </div>
                </div>
            </div>

            <!-- Card Visa Australia -->
            <div class="col-md-3 col-sm-6">
                <div class="visa-card">
                    <img src="img/VisaAusie.jpg" alt="Australia">
                    <div class="visa-content">
                        <h5>Visa Australia</h5>
                        <p class="price">Rp2.200.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- <div class="content">
        <div class="content-promo-lebaran">
            <div class="judul-promo">PROMO PAKET TOUR CONSORTIUM 2024</div>
            <div class="content-promo">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6" style="text-align: right;">
                        <div class="row">
                            <div class="col" style="padding: 10px 5px;">
                                <button type="button" class="btn btn-success" onclick="search_promo_consor()"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="col" style="padding: 10px 5px;">
                                <div class="form-group">
                                    <input class="form-control" list="negaraList_consor" id="negara_consor" placeholder="Cari berdasarkan Negara" autocomplete="off">
                                    <datalist id="negaraList_consor">
                                        <?php
                                        // country
                                        $query_country = "SELECT name FROM country order by name ASC";
                                        $rs_country = mysqli_query($con, $query_country);
                                        while ($row_country = mysqli_fetch_array($rs_country)) {
                                        ?>
                                            <option value="<?php echo $row_country['name'] ?>">
                                            <?php
                                        }
                                            ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <?php
                    $query_upload = "SELECT * FROM Upload_Drive2 where p_cons='1' && status='on' order by price ASC limit 4";
                    $rs_upload = mysqli_query($con, $query_upload);
                    while ($row_upload = mysqli_fetch_array($rs_upload)) {
                        $thumbnail = "https://drive.google.com/thumbnail?id=" . explode('/', $row_upload['thumbnail'])[5];
                        $documents = "https://drive.google.com/file/d/" . explode('/', $row_upload['documents'])[5] . "/view";
                    ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <a href="<?php echo $documents ?>" target="_blank" class="text-decoration-none text-dark">
                                <div class="card shadow-sm border-0">
                                    <img src="<?php echo $thumbnail ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $row_upload['judul'] ?></h6>
                                    </div>
                                    <div class="card-footer bg-white font-weight-bold">
                                        <?php echo "IDR " . number_format($row_upload['price'], 0, ".", ".") ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="search-consor"></div>
                <div class="more-consor"></div>
            </div>
            <div class="footer-promo" style="text-align: center; margin-top: -30px;">
                <input type="hidden" name="val_li_consor" id="val_li_consor" value='10'>
                <button type="button" class="btn btn-success" onclick="fungsi_more_consor()">View More</button>
            </div>
        </div>
    </div> -->

    <div class="container my-5">
        <div class="text-center" style="margin-top: 40px;">
            <h2 class="fw-bold">OUR PRODUCTS</h2>
        </div>
        <div class="row text-center">
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="<?php echo $domain_web ?>Activity">
                    <img src="img/attraction2.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <a href="">
                    <img src="img/cruise.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <a href="<?php echo $domain_web ?>paket-landtour.php">
                    <img src="img/land_tour.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <a href="<?php echo $domain_web ?>Hotel">
                    <img src="img/hotel.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>
        </div>
    </div>

    <script>
        function search_promo() {
            var negara = document.getElementById("negara").value;
            $.ajax({
                url: "search-lebaran.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                },
                success: function(data) {
                    $('.search-lebaran').html(data);
                    $('.front-lebaran').html('');

                }
            });
        }

        function search_promo_consor() {
            var negara = document.getElementById("negara_consor").value;
            $.ajax({
                url: "search-consor.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                },
                success: function(data) {
                    $('.search-consor').html(data);
                    $('.front-consor').html('');

                }
            });
        }

        function fungsi_more() {
            var li = document.getElementById('val_li').value;
            // alert(li);
            $.ajax({
                url: "promo1.php",
                method: "POST",
                asynch: false,
                data: {
                    id: li,
                },
                success: function(data) {
                    var more = parseInt(li) + 10;
                    document.getElementById("val_li").value = more;
                    $('.more-promo').html(data);
                }
            });
        }

        function fungsi_more_consor() {
            var li = document.getElementById('val_li_consor').value;
            // alert(li);
            $.ajax({
                url: "promo_consor.php",
                method: "POST",
                asynch: false,
                data: {
                    id: li,
                },
                success: function(data) {
                    var more = parseInt(li) + 10;
                    document.getElementById("val_li_consor").value = more;
                    $('.more-consor').html(data);
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const hiddenCards = document.querySelectorAll(".hidden-card");
            const toggleButton = document.getElementById("toggleButton");
            let isExpanded = false;

            if (toggleButton) {
                toggleButton.addEventListener("click", function() {
                    isExpanded = !isExpanded;
                    hiddenCards.forEach(card => {
                        card.style.display = isExpanded ? "block" : "none";
                    });
                    toggleButton.textContent = isExpanded ? "Tampilkan Lebih Sedikit" : "Lihat Lainnya";
                });
            }
        });
    </script>
</body>
<style>
    .hidden-card {
        display: none;
    }

    .custom-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .custom-card:hover {
        transform: scale(1.05);
    }

    .custom-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 15px;
    }

    .card-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: end;
        color: white;
        padding: 15px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
        transition: all 0.3s ease-in-out;
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
    }

    .card-subtitle {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 10px;
    }

    .visa-card {
        position: relative;
        overflow: hidden;
        background: white;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .visa-card:hover {
        transform: translateY(-8px);
        box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.3);
    }

    .visa-card img {
        width: 100%;
        height: 180px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        transition: transform 0.3s ease;
    }

    .visa-card:hover img {
        transform: scale(1.05);
    }

    .visa-content {
        padding: 20px;
        text-align: center;
    }

    .visa-content h5 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #343a40;
    }

    .visa-content p {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .visa-content .price {
        color: black;
        display: inline-block;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
        margin-top: 10px;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-section h1 {

        font-size: 24px;
        font-weight: bold;
    }

    .header-section a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .header-section a:hover {
        text-decoration: underline;

    }

    .video-wrapper {
        width: 100%;
        max-width: 270px;
        /* Batasi lebar maksimal */
    }

    .video-wrapper iframe {
        width: 100%;
        height: 150px;
        border: none;
    }

    @media (max-width: 576px) {

        /* Untuk layar kecil seperti HP */
        .d-flex {
            flex-direction: column;
            /* Stack ke bawah */
            align-items: center;
        }
    }

    /* Style untuk tombol navigasi */
    .custom-btn {
        background: rgba(0, 0, 0, 0.5);
        /* Transparan hitam */
        border: none;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        transition: 0.3s ease-in-out;
    }

    .custom-btn:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    /* Style untuk ikon prev & next */
    .custom-icon {
        color: white;
        font-size: 24px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Posisi tombol prev & next */
    .carousel-control-prev {
        left: 15px;
    }

    .carousel-control-next {
        right: 15px;
    }

    .img-hover {
        transition: transform 0.3s ease-in-out;
    }

    .img-hover:hover {
        transform: scale(1.1);
    }

    #tb-lt-web th,
    #tb-lt-web td {
        padding: 8px;
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        #tb-lt-web {
            font-size: 9pt;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }

    .custom-bg {
        background: rgba(0, 0, 0, 0.1);
        /* Transparan lebih halus */
        backdrop-filter: blur(5px);
        border-radius: 16px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .btn-cari {
        background: linear-gradient(135deg, #FFD700, #FFCA10);
        border: none;
        color: black;
        font-weight: bold;
        padding: 10px;
        transition: all 0.3s ease-in-out;
    }

    .btn-cari:hover {
        background: linear-gradient(135deg, #E0B000, #D4A000);
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(255, 202, 16, 0.5);
    }

    /* Styling untuk input dan dropdown */
    .form-control,
    .form-select {
        border: 2px solid rgba(255, 202, 16, 0.8);
        background-color: rgba(255, 255, 255, 0.9);
        /* Warna putih lebih terlihat */
        color: black;
        /* Teks jadi hitam agar terlihat */
    }

    .form-control::placeholder {
        color: rgba(0, 0, 0, 0.6);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #FFD700;
        box-shadow: 0 0 8px rgba(255, 202, 16, 0.8);
    }

    /* Styling tambahan untuk dropdown */
    .form-select option {
        background-color: white;
        /* Warna latar dropdown */
        color: black;
        /* Warna teks dropdown */
    }

    .form-select:hover {
        background-color: rgba(255, 255, 255, 0.95);
    }
</style>

<?php
include "footer.php";
?>

</html>