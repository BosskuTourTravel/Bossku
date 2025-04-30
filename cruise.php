<?php
include "header.php";
include "navbar.php";
include "slug.php";
include "db=connection.php"; // Perbaiki nama file jika perlu

function getGoogleDriveDirectLink($url)
{
    if (strpos($url, 'drive.google.com') !== false) {
        preg_match('/d\/([^\/]+)/', $url, $matches);
        if (!empty($matches[1])) {
            return "https://lh3.googleusercontent.com/d/{$matches[1]}=s0"; // Link langsung ke gambar
        }
    }
    return $url ?: 'https://via.placeholder.com/300x200'; // Default jika tidak ada gambar
}

$limit = 6; // Jumlah item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk menghitung total data
$total_sql = "SELECT COUNT(*) as total FROM List_tempat AS lt WHERE lt.price > 100000 AND lt.tempat LIKE '%cruise%'";
$total_result = $con->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_cruise = $total_row['total'];
$total_pages = ceil($total_cruise / $limit);

// Query SQL dengan pagination dan pencarian
$sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
               lti.summer_img, lti.winter_img, lti.autumn_img
        FROM List_tempat AS lt
        LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
        WHERE lt.price > 100000 AND lt.tempat LIKE '%cruise%'
        ORDER BY lt.id DESC
        LIMIT $limit OFFSET $offset";

$result = $con->query($sql);
?>

<div class='container mx-auto px-4 py-16 mt-10'>
    <h1 class='text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2'>Explore Cruises</h1>
    <h2 class='text-3xl font-bold tracking-wide text-center'>Discover Your Perfect Cruise</h2>
    <p class='font-medium text-sm tracking-wide text-center text-gray-500'>Let us help you find the ideal cruise experience tailored to your needs.</p>

    <form method='GET' class='w-full max-w-md mx-auto flex flex-wrap sm:flex-nowrap items-center gap-2 mt-8 px-4'>
        <input type='text' name='search' placeholder='Cari cruise berdasarkan kota tujuan...' value='<?= htmlspecialchars($search) ?>' class='w-full sm:w-auto flex-grow border border-gray-300 px-5 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#02335B] focus:border-transparent transition duration-200 text-sm' />
        <button type='submit' class='w-full md:w-auto bg-[#02335B] text-white px-6 py-2 rounded-lg shadow hover:bg-[#035a8b] transition-all duration-200 text-sm'>Cari</button>
    </form>

    <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-10'>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                $cruiseName = htmlspecialchars($row['name']);
                $cruiseImage = getGoogleDriveDirectLink($row['summer_img'] ?? $row['winter_img'] ?? $row['autumn_img'] ?? 'https://via.placeholder.com/300x200');
                $cruisePrice = number_format($row['price'], 0, ',', '.');
                $cruiseCountry = htmlspecialchars($row['location']);
                $cruiseId = $row['id']; // Menggunakan ID untuk detail
                ?>
                <div class='bg-white shadow-md rounded-lg overflow-hidden flex flex-col h-full'>
                    <img src='<?= $cruiseImage ?>' alt='<?= $cruiseName ?>' class='w-full h-48 object-cover'>
                    <div class='p-4 flex flex-col flex-grow'>
                        <h3 class='text-xl font-bold text-[#02335B] leading-snug'><?= $cruiseName ?></h3>
                        <div class='mt -3'>
                            <span class='inline-block bg-[#02335B] text-[#FFCA10] text-xs font-semibold px-3 py-1 rounded-full'><?= $cruiseCountry ?></span>
                        </div>
                        <div class='mt-3'>
                            <span class='block text-lg font-semibold text-[#02335B] tracking-wide'>IDR <?= $cruisePrice ?></span>
                        </div>
                        <div class='flex-grow'></div>
                        <div class='mt-4 flex gap-2 flex-wrap justify-end'>
                            <a href='<?= $cruiseImage ?>' target='_blank' class='text-sm font-semibold text-[#02335B] bg-[#FFCA10] px-4 py-2 rounded hover:bg-yellow-500 transition-all duration-200'>Lihat Gambar</a>
                            <a href='cruise-details.php?id=<?= $cruiseId ?>' class='text-sm font-semibold text-white bg-[#02335B] px-4 py-2 rounded hover:bg-[#035a8b] transition-all duration-200'>View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class='text-center text-red-500'>Tidak ada data cruise yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class='mt-6 flex flex-col items-center justify-between gap-2 text-sm text-gray-600'>
        <p>Menampilkan <?= ($offset + 1) ?> &ndash; <?= min($offset + $limit, $total_cruise) ?> dari <?= $total_cruise ?> produk</p>
        <div class='flex justify-center items-center space-x-2 text-[#02335B] font-medium'>
            <?php if ($page > 1): ?>
                <a href='?search=<?= urlencode($search) ?>&page=<?= ($page - 1) ?>' class='px-3 py-1 bg-gray-200 rounded hover:bg-gray-300'>&laquo;</a>
            <?php endif; ?>

            <?php
            $visiblePages = [];
            if ($total_pages <= 7) {
                $visiblePages = range(1, $total_pages);
            } else {
                $visiblePages = array_unique(array_merge(
                    [1, 2],
                    range(max(1, $page - 1), min($total_pages, $page + 1)),
                    [$total_pages - 1, $total_pages]
                ));
                sort($visiblePages);
            }

            $lastPageShown = 0;
            foreach ($visiblePages as $i) {
                if ($lastPageShown + 1 < $i) echo "<span class='px-2'>...</span>";
                $lastPageShown = $i;
                echo "<a href='?search=" . urlencode($search) . "&page=$i' class='px-3 py-1 rounded " . ($i === $page ? 'bg-[#02335B] text-white font-bold' : 'bg-gray-200 text-gray-700 hover:bg-gray-300') . "'>$i</a>";
            }

            if ($page < $total_pages) {
                echo "<a href='?search=" . urlencode($search) . "&page=" . ($page + 1) . "' class='px-3 py-1 bg-gray-200 rounded hover:bg-gray-300'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

