<?php
include "db=connection.php";
include "slug.php";
include "API/Price/Api_LT_total_baru.php";
include "testimoni-data.php";
include "data-mobil.php"
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
        <div class="absolute inset-0 flex items-center justify-center">
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


    <!-- Destinasi -->
    <div class="container mx-auto py-10 px-6 mb-4">
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


    <!-- Admission Ticket -->
    <div class="container mx-auto py-10 px-6 mb-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-2">
            <h2 class="text-2xl font-bold">Admission Ticket</h2>
            <a href="tiket.php" class="text-blue-600 text-center font-semibold hover:underline">Lihat Semua Tiket</a>
        </div>

        <div class="swiper3 swiper w-full">
            <div class="swiper-wrapper">
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
                    WHERE lt.price > 100000 AND lt.tempat NOT LIKE '%cruise%'
                    ORDER BY lt.id DESC
                    LIMIT 6";

                $result = $con->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($ticket = $result->fetch_assoc()) {
                        $img = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
                        $ticketId = $ticket['id'];
                ?>
                        <div class="swiper-slide">
                            <div class="bg-white shadow-md rounded-2xl overflow-hidden w-full max-w-xs mx-auto flex flex-col h-[450px]">
                                <img src="<?= htmlspecialchars($img); ?>" alt="Ticket Image" class="w-full h-64 object-cover">

                                <div class="flex flex-col justify-between flex-1 p-4">
                                    <div>
                                        <h5 class="text-base sm:text-lg font-bold text-gray-800 mb-1 truncate">
                                            <?= htmlspecialchars($ticket['name']); ?>
                                        </h5>
                                        <p class="text-sm text-gray-600 mb-1">
                                            Lokasi: <span class="inline-block px-2 py-0.5 rounded bg-blue-600 text-white"><?= htmlspecialchars($ticket['location']); ?></span>
                                        </p>
                                        <div class="text-yellow-500 font-semibold text-base mb-1">
                                            IDR <?= number_format($ticket['price'], 0, ',', '.'); ?>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 mt-4">
                                        <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?= urlencode($ticket['name']); ?>"
                                            class="flex-1 py-2 bg-[#FFCA10] text-[#02335B] text-center text-sm font-semibold rounded-lg hover:bg-black hover:text-[#FFCA10] transition-all duration-200 ease-in-out transform hover:scale-105">
                                            Pesan Sekarang
                                        </a>
                                        <a href="tiket-detail.php?id=<?= htmlspecialchars($ticketId); ?>"
                                            class="flex-1 py-2 bg-[#02335B] text-white text-center text-sm font-semibold rounded-lg hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-200 ease-in-out transform hover:scale-105">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>

                <!-- Slide untuk Lihat Semua -->
                <div class="swiper-slide flex items-center justify-center">
                    <a href="tiket.php"
                        class="flex flex-col items-center justify-center w-full h-[450px] max-w-xs mx-auto border-2 border-dashed border-blue-400 text-blue-600 hover:bg-blue-50 rounded-lg text-lg font-semibold transition text-center py-10">
                        <span>Lihat Semua Tiket</span>
                        <span class="text-3xl mt-2">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Navigasi -->
            <div class="swiper-button-next text-blue-600"></div>
            <div class="swiper-button-prev text-blue-600"></div>
        </div>
    </div>



    <!-- Cruise -->
    <div class="container mx-auto py-10 px-6 mb-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-2">
            <h2 class="text-2xl font-bold">Cruise</h2>
            <a href="cruise.php" class="text-blue-600 text-center font-semibold hover:underline">Lihat Semua Cruise</a>
        </div>

        <?php
        $sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
            lti.summer_img, lti.winter_img, lti.autumn_img
            FROM List_tempat AS lt
            LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
            WHERE lt.price > 100000 AND lt.tempat LIKE '%cruise%'
            ORDER BY lt.id DESC
            LIMIT 5";
        ?>

        <div class="swiper3 swiper w-full">
            <div class="swiper-wrapper">
                <?php
                $result = $con->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($cruise = $result->fetch_assoc()) {
                        $img = getGoogleDriveDirectLink($cruise['summer_img'] ?? $cruise['winter_img'] ?? $cruise['autumn_img'] ?? 'https://via.placeholder.com/300x200');
                        $cruiseId = $cruise['id']; // Pastikan ini didefinisikan
                        $cruiseImage = $img; // Menggunakan gambar yang sudah didefinisikan
                ?>
                        <div class="swiper-slide">
                            <div class="bg-white shadow-md rounded-2xl overflow-hidden w-full max-w-xs mx-auto flex flex-col h-[430px]">
                                <img src="<?= htmlspecialchars($img); ?>" alt="Cruise Image" class="w-full h-64 object-cover">

                                <div class="flex flex-col justify-between flex-1 p-4">
                                    <div>
                                        <h5 class="text-base sm:text-lg font-bold text-gray-800 mb-1 truncate">
                                            <?= htmlspecialchars($cruise['name']); ?>
                                        </h5>
                                        <p class="text-sm mb-2">
                                        <p class="inline-block px-2 py-0.5 font-medium rounded bg-[#02335B] text-[#FFCA10]"><?= htmlspecialchars($cruise['location']); ?></p>
                                        </p>
                                        <div class="text-[#02335B] mt-2 font-bold text-base mb-3">
                                            IDR <?= number_format($cruise['price'], 0, ',', '.'); ?>
                                        </div>
                                    </div>

                                    <div class='flex-grow'></div>
                                    <div class='mt-4 flex gap-2 flex-wrap justify-end'>
                                        <a href='<?= htmlspecialchars($cruiseImage); ?>' target='_blank' class='text-sm font-semibold text-[#02335B] bg-[#FFCA10] px-4 py-2 rounded hover:bg-yellow-500 transition-all duration-200'>Lihat Gambar</a>
                                        <a href='cruise-details.php?id=<?= htmlspecialchars($cruiseId); ?>' class='text-sm font-semibold text-white bg-[#02335B] px-4 py-2 rounded hover:bg-white hover:text-[#02335B] transition-all duration-200'>View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>

                <!-- Slide untuk Lihat Semua -->
                <div class="swiper-slide flex items-center justify-center">
                    <a href="cruise.php"
                        class="flex flex-col items-center justify-center w-full h-[430px] max-w-xs mx-auto border-2 border-dashed border-blue-400 text-blue-600 hover:bg-blue-50 rounded-lg text-lg font-semibold transition text-center py-10">
                        <span>Lihat Semua Cruise</span>
                        <span class="text-3xl mt-2">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Navigasi -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>


    <!-- Rental Mobil -->
    <div class="container mx-auto py-10 px-6">
        <h2 class="text-3xl font-bold mb-8 tracking-wide text-gray-800">Rental Mobil</h2>
        <div class="swiper myRentalSlider">
            <div class="swiper-wrapper">

                <?php
                // Batasi hanya 4 mobil pertama yang ditampilkan
                $rental_limited = array_slice($rental, 0, 4);
                foreach ($rental_limited as $car): ?>
                    <div class="swiper-slide">
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <img src="<?php echo $car['image']; ?>" alt="<?php echo $car['name']; ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-primary-900 mb-1"><?php echo $car['name']; ?></h3>
                                <p class="text-gray-600 text-sm mb-3"><?php echo $car['transmisi']; ?> / <?php echo $car['seat']; ?></p>
                                <p class="text-primary-700 font-semibold mb-2"><?php echo $car['Harga']; ?></p>
                                <a href="detail-rental.php?id=<?= $car['id'] ?>" class="mt-4 inline-block bg-[#FFCA10] text-[#112A46] px-4 py-2 rounded-lg font-semibold hover:bg-white hover:text-[#FFCA10] transition">Lihat Detail</a>
                                <a href="https://wa.me/628112557728?text=Halo, Saya ingin menyewa mobil <?= urlencode($car['name']) ?> dengan harga <?= urlencode($car['Harga']) ?>" target="_blank" class="flex-1 text-center bg-[#02335B] text-white px-4 py-2 rounded-lg font-semibold hover:bg-white hover:text-[#02335B] border-2 border-[#02335B] transition-all">
                                    Sewa Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Card Lihat Semua -->
                <div class="swiper-slide">
                    <a href="rental.php"
                        class="flex flex-col items-center justify-center w-full h-[370px] max-w-xs mx-auto border-2 border-dashed border-blue-400 text-blue-600 hover:bg-blue-50 rounded-lg text-lg font-semibold transition text-center py-10">
                        <span>Lihat Semua Rental</span>
                        <span class="text-3xl mt-2">&rarr;</span>
                    </a>
                </div>

            </div>

            <!-- Default Swiper Buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
    </div>


    <!-- Testimoni -->
    <div class="container mx-auto py-10 px-6">
        <h2 class="text-3xl font-bold text-center mb-8 tracking-wide text-gray-800">Apa Kata Mereka</h2>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="swiper-slide">
                        <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col justify-between transition-transform hover:shadow-2xl hover:scale-105 h-full border border-gray-200">
                            <p class="text-gray-700 text-base md:text-lg italic mb-6 flex-grow">
                                <i class="fa fa-quote-left text-xl text-indigo-400 mr-2"></i>
                                <?= htmlspecialchars($testimonial['message']) ?>
                                <i class="fa fa-quote-right text-xl text-indigo-400 ml-2"></i>
                            </p>

                            <div class="flex items-center gap-3 mt-auto">
                                <div>
                                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($testimonial['name']) ?></p>
                                    <p class="text-sm text-indigo-600 font-medium"><?= htmlspecialchars($testimonial['tour_name']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto py-10 px-6">
        <div class="text-center mb-4">
            <h2 class="text-4xl font-bold text-gray-800 mb-2">OUR PRODUCTS</h2>
            <p class="text-lg text-gray-600">Discover our wide range of offerings that cater to every need and desire.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Kategori 1: Attraction -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <a href="<?php echo $domain_web ?>tiket.php">
                    <img src="img/Frame 1.png" alt="Attraction" class="w-full h-64 object-cover transition-transform transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center items-center">
                        <span class="text-white text-xl font-semibold">Explore Attractions</span>
                    </div>
                </a>
            </div>

            <!-- Kategori 2: Cruise -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <a href="<?php echo $domain_web ?>cruise.php">
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
                <a href="<?php echo $domain_web ?>hotel.php">
                    <img src="img/Frame 4.png" alt="Hotel" class="w-full h-64 object-cover transition-transform transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-75 opacity-0 group-hover:opacity-50 transition-opacity duration-300 flex justify-center items-center">
                        <span class="text-white text-xl font-semibold">Luxury Hotels</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div id="BosskuPartner" class="container mx-auto py-10 px-6 scroll-mt-20">
        <!-- Section Gabung Jadi Mitra Kami -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col md:flex-row items-center gap-8 mb-10">
            <div class="flex-1">
                <!-- Judul Utama -->
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Dapatkan Rp400.000 per Customer! Tanpa Modal, Tanpa Target!
                </h2>

                <!-- Ajakan Singkat -->
                <p class="text-gray-600 mb-6">
                    Ingin penghasilan tambahan dari rumah tanpa harus jualan atau stok produk?
                    Gabung jadi bagian dari <strong> Bossku Travel Partner.</strong>
                    Cukup bagikan itinerary liburan yang sudah kami siapkan ke teman, keluarga, atau followers kamu.
                </p>

                <!-- Poin Keuntungan -->
                <h2 class="text-2xl font-bold mb-4 text-gray-700 mt-4">Kenapa Cocok Buat Kamu?</h2>
                <ul class="mb-6 list-disc pl-5 text-gray-700">
                    <li>Bisa dikerjakan dari rumah</li>
                    <li>Gak perlu pengalaman</li>
                    <li>Komisi besar & sistem simpel</li>
                    <li>Materi promosi tinggal pakai</li>
                </ul>

                <!-- CTA -->
                <a href="agent.php"
                    class="inline-block bg-[#FFCA10] text-[#02335B] px-6 py-3 rounded-lg font-bold shadow hover:bg-[#02335B] hover:text-[#FFCA10] transition">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Gambar -->
            <div class="flex-1 flex justify-center">
                <img src="img/agent.jpg" alt="Gabung Mitra Bossku" class="w-64 h-64 object-contain rounded-lg shadow-lg">
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".myRentalSlider", {
            slidesPerView: 1.1,
            spaceBetween: 16,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });

        var swiper = new Swiper('.swiper3', {
            slidesPerView: 1,
            spaceBetween: 20,
            autoheight: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            }
        });

        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
            },
            speed: 2000,
            effect: 'slide',
            easing: 'ease',
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });


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
    html {
        scroll-behavior: smooth;
    }

    .swiper-button-next,
    .swiper-button-prev {
        width: 50px;
        /* Lebar tombol */
        height: 50px;
        /* Tinggi tombol */
        background-color: #FFCA10;
        /* Warna latar belakang tombol */
        color: #02335B;
        /* Warna ikon */
        border-radius: 50%;
        /* Membuat tombol bulat */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        /* Efek transisi */
        z-index: 10;
        /* Pastikan tombol di atas konten */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        /* Bayangan untuk efek kedalaman */
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: #02335B;
        /* Warna latar belakang saat hover */
        color: #FFCA10;
        /* Warna ikon saat hover */
        transform: scale(1.1);
        /* Efek zoom saat hover */
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 24px;
        /* Ukuran ikon */
        font-weight: bold;
        /* Ketebalan ikon */
    }

    /* Menambahkan ikon panah */
    .swiper-button-next::after {
        content: '➔';
        /* Ikon panah kanan */
    }

    .swiper-button-prev::after {
        content: '➔';
        /* Ikon panah kiri, bisa diganti dengan simbol lain */
        transform: rotate(180deg);
        /* Memutar panah kiri */
    }

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

<script>
</script>

</html>