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

    <div class="relative">
        <!-- Gambar Background -->
        <img src="img/asia/AsiaBaratThumb.jpg" alt="Asia Barat" class="w-full h-[550px] object-cover">

        <!-- Overlay dengan efek Glassmorphism -->
        <div class="absolute inset-0 flex items-center justify-center" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
            <div class="bg-white/10 backdrop-blur-md p-6 md:p-8 rounded-2xl w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 shadow-2xl text-white border border-white/20">
                <h2 class="text-center text-2xl md:text-3xl font-extrabold mb-5 text-yellow-400 drop-shadow-lg">
                    Temukan Destinasi Impianmu
                </h2>

                <!-- Form Pencarian -->
                <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Input Search by Country -->
                    <div>
                        <label for="country" class="block font-semibold">Cari Berdasarkan Negara</label>
                        <input type="text" id="country" name="country"
                            class="w-full px-4 py-2 rounded-full text-gray-900 border-2 border-gray-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300 transition duration-300"
                            placeholder="Masukkan negara..." value="<?= htmlspecialchars($_GET['country'] ?? '') ?>">
                    </div>

                    <!-- Filter by Start (Dropdown) -->
                    <div>
                        <label for="start" class="block font-semibold">Filter Berdasarkan Start</label>
                        <select id="start" name="start"
                            class="w-full px-4 py-2 rounded-full text-gray-900 border-2 border-gray-300 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300 transition duration-300">
                            <option value="">Pilih Start</option>
                            <option value="Surabaya" <?= (isset($_GET['start']) && $_GET['start'] == 'SBY') ? 'selected' : '' ?>>Surabaya (SBY)</option>
                            <option value="Jakarta" <?= (isset($_GET['start']) && $_GET['start'] == 'JKT') ? 'selected' : '' ?>>Jakarta (JKT)</option>
                            <option value="Bali" <?= (isset($_GET['start']) && $_GET['start'] == 'DPS') ? 'selected' : '' ?>>Denpasar (DPS)</option>
                            <option value="Singapore" <?= (isset($_GET['start']) && $_GET['start'] == 'SG') ? 'selected' : '' ?>>Singapura (SG)</option>
                            <option value="Batam" <?= (isset($_GET['start']) && $_GET['start'] == 'BTM') ? 'selected' : '' ?>>Batam (BTM)</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-6 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Ambil data pencarian
    $country = isset($_GET['country']) ? $_GET['country'] : '';
    $start = isset($_GET['start']) ? $_GET['start'] : '';

    // Jika user mengisi form, tampilkan hasil
    if (!empty($country) || !empty($start)) {
        echo '<div class="container mx-auto my-8 p-6 bg-white shadow-lg rounded-xl">';
        echo '<h3 class="text-center text-2xl font-bold mb-6">Hasil Pencarian</h3>';
        echo '<div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg overflow-hidden">';
        echo '<thead class="bg-gray-800 text-white text-center">
                        <tr>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Negara</th>
                            <th class="py-3 px-4">Kota</th>
                            <th class="py-3 px-4">Nama</th>
                            <th class="py-3 px-4">Start</th>
                            <th class="py-3 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-white divide-y divide-gray-200">';

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

                echo "<tr class='hover:bg-gray-100'>
                        <td class='py-3 px-4'>{$id}</td>
                        <td class='py-3 px-4'>{$country}</td>
                        <td class='py-3 px-4'>{$city}</td>
                        <td class='py-3 px-4 font-semibold'>{$nama}</td>
                        <td class='py-3 px-4'>{$start}</td>
                        <td class='py-3 px-4'>
                            <div class='flex flex-wrap gap-2 justify-center'>";

                // Tombol Lihat Itinerary (Jika Ada)
                if ($link_pdf) {
                    echo "<a href='{$link_pdf}' target='_blank' 
                            class='px-3 py-2 text-sm font-semibold text-blue-600 border border-blue-500 rounded-lg hover:bg-blue-500 hover:text-white transition'>
                            Itinerary
                          </a>";
                }

                // Tombol Lihat Gambar (Jika Ada)
                if ($link_gambar) {
                    echo "<a href='{$link_gambar}' target='_blank' 
                            class='px-3 py-2 text-sm font-semibold text-yellow-600 border border-yellow-500 rounded-lg hover:bg-yellow-500 hover:text-white transition'>
                            Flyer
                          </a>";
                }

                // Tombol Pesan Sekarang (Selalu Ada)
                echo "<a href='https://wa.me/{$wa_number}?text=" . urlencode("Halo, saya tertarik dengan paket {$nama} di {$country}. Bagaimana cara memesannya?") . "' 
                        class='px-3 py-2 text-sm font-semibold text-green-600 border border-green-500 rounded-lg hover:bg-green-500 hover:text-white transition' target='_blank'>
                        Pesan
                      </a>";

                echo "</div>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='py-4 text-center text-gray-500'>Tidak ada hasil ditemukan.</td></tr>";
        }

        echo '</tbody></table></div></div>';
    }
    ?>


    <div class="container mx-auto py-10 px-6" data-aos="fade-up" data-aos-duration="3000">
        <!-- Judul -->
        <div class="flex items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Destinasi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $query_con = "SELECT consortium_list.id, consortium_list.continent, continent.img FROM consortium_list LEFT JOIN continent ON consortium_list.continent LIKE continent.name GROUP BY consortium_list.continent";
            $rs_con = mysqli_query($con, $query_con);
            while ($row_con = mysqli_fetch_array($rs_con)) {
                $img = isset($row_con['img']) ? $row_con['img'] : 'img/home.png';
            ?>
                <a href="region.php?id=<?php echo $row_con['continent'] ?>" class="group relative block rounded-xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <img src="<?php echo $img ?>" alt="<?php echo $row_con['continent'] ?>" class="w-full h-[350px] object-cover">
                    <div class="absolute inset-0 bg-black/50 group-hover:bg-black/30 transition duration-300"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold"><?php echo $row_con['continent'] ?></h3>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="container mx-auto my-10 p-6 shadow-xl" data-aos="zoom-in-up" data-aos-easing="linear" data-aos-duration="1000">
        <h2 class="text-2xl font-bold border-b-4 border-blue-500 pb-4 mb-6">Admission Ticket</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
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
               LIMIT 4";

            $result = $con->query($sql);
            $tickets = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tickets[] = $row;
                }
            }

            foreach ($tickets as $ticket) {
                $image = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
            ?>
                <div class="ticket-card bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl relative">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="Ticket Image" class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h5 class="text-lg font-bold text-gray-900"> <?php echo htmlspecialchars($ticket['name']); ?> </h5>
                        <p class="text-sm text-gray-600 mt-2">Location: <span class="text-white px-3 py-1 rounded bg-blue-600"> <?php echo htmlspecialchars($ticket['location']); ?> </span></p>
                        <div class="mt-3 text-lg font-bold text-yellow-500">IDR <?php echo number_format($ticket['price'], 0, ',', '.'); ?></div>
                        <div class="mt-4 flex flex-col gap-2">
                            <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?php echo urlencode($ticket['name']); ?>"
                                class="w-full py-2 bg-[#FFCA10] text-[#02335B] font-bold rounded-lg hover:bg-black hover:text-[#FFCA10] transition transform hover:scale-105">Pesan Sekarang</a>
                            <a href="<?php echo htmlspecialchars($image); ?>" target="_blank"
                                class="w-full py-2 bg-[#02335B] text-[#FFCA10] font-semibold rounded-lg border border-yellow-500 hover:bg-yellow-500 hover:text-white transition transform hover:scale-105">Lihat Gambar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="text-center mt-6">
            <a href="tiket.php" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-lg font-semibold rounded-full shadow-lg hover:shadow-2xl transform hover:scale-110 transition duration-300">
                Lihat Semua Tiket
            </a>
        </div>
    </div>


    <div class="container mx-auto py-10 px-6" data-aos-offset="300" data-aos-easing="ease-in-sine">
        <div data-aos="fade-down"><?php include "table_paket_tour.php"; ?></div>
    </div>
    <div class="container mx-auto py-10 px-6" data-aos-offset="500" data-aos-duration="500">
        <div data-aos="fade-up"><?php include "table_paket_tour2.php"; ?></div>
    </div>

    <div class="container mx-auto py-12 px-6" data-aos="fade-up" data-aos-duration="2000">
        <div class="flex justify-between items-center mb-10 pb-4">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-wide relative">
                Visa
            </h1>
            <a href="#" class="relative text-blue-600 hover:text-blue-800 font-semibold transition duration-300 flex items-center group after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 group-hover:after:w-full">
                Lihat Lainnya
                <span class="ml-2 transform transition-transform duration-300 group-hover:translate-x-2 group-hover:scale-110">&rarr;</span>
            </a>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Card Template -->
            <div class="group relative bg-white shadow-md rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="h-64 w-full flex items-center justify-center bg-gray-100">
                    <img src="img/VisaJapan.jpg" alt="Visa Jepang" class="h-full object-cover w-full">
                </div>
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white text-xl font-bold text-center">Visa Japan - Rp1.500.000</span>
                </div>
            </div>

            <div class="group relative bg-white shadow-md rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="h-64 w-full flex items-center justify-center bg-gray-100">
                    <img src="img/VisaChina.jpg" alt="Visa China" class="h-full object-cover w-full">
                </div>
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white text-xl font-bold text-center">Visa China - Rp2.800.000</span>
                </div>
            </div>

            <div class="group relative bg-white shadow-md rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="h-64 w-full flex items-center justify-center bg-gray-100">
                    <img src="img/VisaTurkey.jpg" alt="Visa Turkey" class="h-full object-cover w-full">
                </div>
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white text-xl font-bold text-center">Visa Turkey - Rp2.500.000</span>
                </div>
            </div>

            <div class="group relative bg-white shadow-md rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="h-64 w-full flex items-center justify-center bg-gray-100">
                    <img src="img/VisaAusie.jpg" alt="Visa Australia" class="h-full object-cover w-full">
                </div>
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white text-xl font-bold text-center">Visa Australia - Rp2.200.000</span>
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

    <div class="container mx-auto py-16 px-6" data-aos="zoom-in-right">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">OUR PRODUCTS</h2>
            <p class="text-lg text-gray-600">Discover our wide range of offerings that cater to every need and desire.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Kategori 1: Attraction -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <a href="<?php echo $domain_web ?>Activity">
                    <img src="img/Frame 1.png" alt="Attraction" class="w-full h-64 object-cover transition-transform transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center items-center">
                        <span class="text-white text-xl font-semibold">Explore Attractions</span>
                    </div>
                </a>
            </div>

            <!-- Kategori 2: Cruise -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <a href="#">
                    <img src="img/Frame 2.png" alt="Cruise" class="w-full h-64 object-cover transition-transform transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center items-center">
                        <span class="text-white text-xl font-semibold">Amazing Cruises</span>
                    </div>
                </a>
            </div>

            <!-- Kategori 3: Land Tour -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <a href="<?php echo $domain_web ?>paket-landtour.php">
                    <img src="img/Frame 3.png" alt="Land Tour" class="w-full h-64 object-cover transition-transform transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center items-center">
                        <span class="text-white text-xl font-semibold">Land Tours</span>
                    </div>
                </a>
            </div>

            <!-- Kategori 4: Hotel -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <a href="<?php echo $domain_web ?>Hotel">
                    <img src="img/Frame 4.png" alt="Hotel" class="w-full h-64 object-cover transition-transform transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center items-center">
                        <span class="text-white text-xl font-semibold">Luxury Hotels</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

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