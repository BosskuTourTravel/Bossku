<?php

include "db=connection.php";
include "slug.php";
include "header.php";
include "navbar.php";

// Konfigurasi paginasi
$limit = 10; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Ambil kata kunci pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Hitung total data
$total_query = "SELECT COUNT(DISTINCT LTSUB_itin.landtour) as total 
                FROM paket_tour_online 
                INNER JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id 
                WHERE LTSUB_itin.judul LIKE '%$search%' OR LTSUB_itin.landtour LIKE '%$search%'";
$total_result = mysqli_query($con, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb-2">Paket Tour</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Temukan Paket Tour Terbaik Untuk Anda</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500 mb-4">Jelajahi berbagai pilihan paket tour yang sesuai dengan kebutuhan Anda.</p>

    <!-- Formulir Pencarian -->
    <form method="GET" class="mb-8 flex justify-center items-center space-x-2">
        <input type="text" name="search" placeholder="Cari paket tour..." value="<?php echo htmlspecialchars($search); ?>"
            class="w-1/2 border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" />
        <button type="submit"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition duration-300">
            <i class="fa fa-search mr-2"></i>Cari
        </button>
    </form>

    <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
        <table id="tb-pt-web" class="table-auto w-full text-sm border-collapse">
            <thead class="bg-[#02335B] text-white uppercase tracking-wide">
                <tr>
                    <th class="border border-gray-300 px-6 py-3 text-center font-semibold">No</th>
                    <th class="border border-gray-300 px-6 py-3 text-center font-semibold">Nama Paket</th>
                    <th class="border border-gray-300 px-6 py-3 text-center font-semibold">Pax</th>
                    <th class="border border-gray-300 px-6 py-3 text-center font-semibold">Code</th>
                    <th class="border border-gray-300 px-6 py-3 text-center font-semibold">Price</th>
                    <th class="border border-gray-300 px-6 py-3 text-center font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $no = $start + 1;
                $query = "SELECT * FROM (
                            SELECT paket_tour_online.*, LTSUB_itin.judul, LTSUB_itin.landtour, LT_change_judul.nama AS change_judul, 
                            LTP_insert_sfee.ket AS staff_id, login_staff.name AS staff_name, login_staff.phone 
                            FROM paket_tour_online 
                            INNER JOIN LTSUB_itin ON paket_tour_online.tour_id = LTSUB_itin.id 
                            LEFT JOIN LT_change_judul ON paket_tour_online.tour_id = LT_change_judul.copy_id AND paket_tour_online.grub_id = LT_change_judul.grub_id 
                            INNER JOIN LTP_insert_sfee ON paket_tour_online.sfee_id = LTP_insert_sfee.id 
                            INNER JOIN login_staff ON LTP_insert_sfee.ket = login_staff.id 
                            WHERE LTSUB_itin.judul LIKE '%$search%' OR LTSUB_itin.landtour LIKE '%$search%' 
                            ORDER BY paket_tour_online.gt ASC 
                          ) AS itin 
                          GROUP BY itin.landtour 
                          ORDER BY itin.negara ASC 
                          LIMIT $start, $limit";
                $rs = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($rs)) {
                    $judul = isset($row['change_judul']) ? $row['change_judul'] : $row['judul'];
                    $url_encode = urldecode("Haii Bossku, Saya ingin Memesan Paket Tour : https://www.holidaymyboss.com/Admin/cetak_pt_website.php?id=" . $row['id']);
                ?>
                    <tr class="text-center border-t border-gray-200 hover:bg-gray-100 transition duration-200">
                        <td class="border border-gray-300 px-6 py-4"><?php echo $no ?></td>
                        <td class="border border-gray-300 px-6 py-4">
                            <div>
                                <a href="<?php echo $domain_web ?>detail-paket-tour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>" class="text-[#02335B] font-bold hover:underline"><?php echo $judul ?></a>
                            </div>
                            <div class="text-gray-500 text-sm"><?php echo $row['negara'] ?></div>
                        </td>
                        <td class="border border-gray-300 px-6 py-4"><?php echo $row['pax_tour'] ?></td>
                        <td class="border border-gray-300 px-6 py-4"><?php echo $row['landtour'] ?></td>
                        <td class="border border-gray-300 px-6 py-4"><?php echo "IDR " . number_format($row['gt'], 0, ".", ".") ?></td>
                        <td class="border border-gray-300 px-6 py-4">
                            <div class="flex flex-col items-center space-y-2">
                                <a
                                    href="Admin/cetak_pt_website.php?id=<?php echo $row['id'] ?>"
                                    target="_BLANK"
                                    class="w-40 flex items-center justify-center px-4 py-2 rounded-lg bg-yellow-500 text-white shadow-md hover:bg-yellow-600 hover:shadow-lg transition duration-200">
                                    <i class="fa fa-print mr-2"></i> Print
                                </a>
                                <a
                                    href="https://wa.me/<?php echo $row['phone'] . '?text=' . $url_encode ?>"
                                    target="_BLANK"
                                    class="w-40 flex items-center justify-center px-4 py-2 rounded-lg bg-green-600 text-white shadow-md hover:bg-green-700 hover:shadow-lg transition duration-200">
                                    <i class="fa fa-whatsapp mr-2"></i> Whatsapp
                                </a>
                                <a
                                    href="<?php echo $domain_web ?>detail-paket-tour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>"
                                    class="w-40 flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white shadow-md hover:bg-blue-700 hover:shadow-lg transition duration-200">
                                    <i class="fa fa-info-circle mr-2"></i> Detail
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4 text-center text-sm text-gray-600">
        Menampilkan <?php echo mysqli_num_rows($rs); ?> dari <?php echo $total_data; ?> data.
    </div>
    <div class="mt-4 flex justify-center space-x-2 text-sm">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Previous</a>
        <?php endif; ?>

        <?php
        $range = 1;
        for ($i = 1; $i <= $total_pages; $i++) {
            if (
                $i == 1 || $i == $total_pages ||
                ($i >= $page - $range && $i <= $page + $range)
            ) {
                if ($i == $page) {
                    echo '<span class="px-3 py-1 bg-blue-600 text-white rounded">' . $i . '</span>';
                } else {
                    echo '<a href="?page=' . $i . '" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">' . $i . '</a>';
                }
                $dots = true;
            } elseif ($dots) {
                echo '<span class="px-3 py-1">...</span>';
                $dots = false;
            }
        }
        ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next</a>
        <?php endif; ?>
    </div>
</div>