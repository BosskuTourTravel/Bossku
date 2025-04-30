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

$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // minimal page 1
$start_from = ($page - 1) * $limit;

// Hitung total data
$total_records_query = "SELECT COUNT(*) as total FROM consortium_list 
    WHERE continent='" . $_GET['id'] . "' 
    AND detail='" . $_GET['region'] . "' 
    AND country='" . $_GET['country'] . "'";
$total_records_result = mysqli_query($con, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
$total_pages = ceil($total_records / $limit);

// Logic untuk membuat range angka dan ellipsis
$visible_pages = 5;
$pagination = [];

if ($total_pages <= $visible_pages + 2) {
    for ($i = 1; $i <= $total_pages; $i++) $pagination[] = $i;
} else {
    $pagination[] = 1;
    $start = max(2, $page - 1);
    $end = min($total_pages - 1, $page + 1);
    if ($start > 2) $pagination[] = "...";
    for ($i = $start; $i <= $end; $i++) $pagination[] = $i;
    if ($end < $total_pages - 1) $pagination[] = "...";
    $pagination[] = $total_pages;
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$search_condition = "";

if (!empty($search)) {
    $search_condition = "AND nama LIKE '%$search%'";
}

$total_records_query = "SELECT COUNT(*) as total FROM consortium_list 
    WHERE continent='{$_GET['id']}' 
    AND detail='{$_GET['region']}' 
    AND country='{$_GET['country']}' 
    $search_condition";


$query = "SELECT consortium_list.*, country.img 
          FROM consortium_list 
          LEFT JOIN country ON consortium_list.country = country.name 
          WHERE consortium_list.continent='{$_GET['id']}' 
          AND consortium_list.detail='{$_GET['region']}' 
          AND consortium_list.country = '{$_GET['country']}' 
          $search_condition
          ORDER BY consortium_list.id DESC 
          LIMIT $start_from, $limit";


$rs = mysqli_query($con, $query);
?>

<body class="bg-gray-50">
    <div class="relative">
        <img src="img/asia/IndonesiaThumb.jpg" alt="Region Map" class="w-full h-96 object-cover">
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white z-10">
            <h1 class="text-4xl font-bold"><?php echo $_GET['country'] ?></h1>
        </div>
    </div>

    <div class="container mx-auto my-8 px-4">
        <h2 class="text-center text-3xl font-extrabold mb-6 text-gray-800">Trip <?php echo $_GET['country'] ?></h2>

        <!-- Search Input -->
        <form method="GET" class="flex justify-center mb-6">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
            <input type="hidden" name="region" value="<?= htmlspecialchars($_GET['region']) ?>">
            <input type="hidden" name="country" value="<?= htmlspecialchars($_GET['country']) ?>">

            <div class="relative w-full max-w-md">
                <input
                    type="text"
                    name="search"
                    id="searchInput"
                    class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 placeholder-gray-400"
                    placeholder="Cari trip..."
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2.5-5.5a8.5 8.5 0 111-1 8.5 8.5 0 011 1z" />
                    </svg>
                </span>
            </div>
        </form>


        <!-- Trip Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8" id="tripContainer">
            <?php
            function getStartColor($start)
            {
                $colors = [
                    "Surabaya" => "#007bff",  // Biru
                    "Jakarta" => "#dc3545",  // Merah
                    "Bali" => "#28a745",  // Hijau
                    "Bandung" => "#17a2b8",  // Biru Muda
                    "Yogyakarta" => "#ffc107",  // Kuning
                ];
                return isset($colors[$start]) ? $colors[$start] : "#6c757d";
            }

            while ($row = mysqli_fetch_array($rs)) {

                // Konversi kurs
                $adt = 0;
                if ($row['kurs'] != "IDR") {
                    $datareq = array(
                        "kurs" => $row['kurs'],
                        "nominal" => $row['adt'],
                    );
                    $adt_kurs = get_kurs($datareq);
                    $rs_adt_kurs = json_decode($adt_kurs, true);
                    $adt = $rs_adt_kurs['data'];
                } else {
                    $adt = $row['adt'];
                }

                $link_gambar = $row['link_gambar'];

                if (strpos($link_gambar, 'drive.google.com') !== false) {
                    if (preg_match('/\/d\/(.*?)\//', $link_gambar, $matches) || preg_match('/id=([a-zA-Z0-9_-]+)/', $link_gambar, $matches)) {
                        if (!empty($matches[1])) {
                            $link_gambar = "https://lh3.googleusercontent.com/d/{$matches[1]}=s0";
                        }
                    }
                }
            ?>
                <div class="card bg-white rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                    <!-- Thumbnail Flyer -->
                    <?php if (!empty($link_gambar)) { ?>
                        <div class="relative w-full h-64">
                            <img src="<?php echo htmlspecialchars($link_gambar, ENT_QUOTES, 'UTF-8'); ?>"
                                alt="Flyer <?php echo htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?>"
                                class="w-full h-full object-cover rounded-t-lg <?php echo (strpos($row['nama'], '[EXPIRED]') !== false) ? 'opacity-100' : ''; ?>">
                            <?php if (strpos($row['nama'], '[EXPIRED]') !== false) { ?>
                                <div class="absolute inset-0 bg-black opacity-75 rounded-t-lg"></div>
                                <div class="absolute inset-0 flex items-center justify-center text-red-600 text-xl font-bold">
                                    <span>EXPIRED</span>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <!-- Konten Card -->
                    <div class="p-6 flex flex-col justify-between flex-1">
                        <!-- Info Paket -->
                        <div class="text-center">
                            <h5 class="text-lg font-semibold text-gray-800"><?php echo $row['nama'] ?></h5>
                            <p class="text-sm text-gray-500 mt-2">
                                Start from:
                                <span class="px-3 py-1 rounded-full text-black font-bold" style="background-color: <?php echo getStartColor($row['start']); ?>;">
                                    <?php echo $row['start']; ?>
                                </span>
                            </p>
                        </div>

                        <!-- Harga & Tombol -->
                        <div class="mt-6 flex flex-col gap-3">
                            <!-- Harga -->
                            <div class="bg-yellow-500 text-white py-2 px-4 rounded-full text-center">
                                <span class="text-lg font-semibold"><?php echo "IDR " . number_format($adt); ?></span>
                            </div>

                            <!-- Tombol -->
                            <a href="https://wa.me/628112557728?text=Halo Bossku" target="_blank" class="block bg-[#02335B] text-white py-2 px-6 rounded-lg text-base font-semibold hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-300 transform hover:scale-105 shadow-md text-center">
                                <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                            </a>

                            <?php if (!empty($row['link_pdf'])) { ?>
                                <a href="<?php echo $row['link_pdf']; ?>" target="_blank" class="block border border-[#02335B] text-[#02335B] py-2 px-6 rounded-lg text-base font-semibold hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-300 transform hover:scale-105 shadow-md text-center">
                                    <i class="bi bi-file-earmark-text"></i> Lihat Itinerary
                                </a>
                            <?php } ?>

                            <?php if (!empty($row['link_gambar'])) { ?>
                                <a href="<?php echo $row['link_gambar']; ?>" target="_blank" class="block border border-[#02335B] text-[#02335B] py-2 px-6 rounded-lg text-base font-semibold hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-300 transform hover:scale-105 shadow-md text-center">
                                    <i class="bi bi-image"></i> Lihat Flyer
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between mt-10 px-4 sm:px-8 gap-4">

            <div class="sm:block w-24"></div>

            <div class="flex flex-wrap items-center justify-center gap-2 text-sm text-black">
                <?php
                $queryString = "id=" . urlencode($_GET['id']) .
                    "&region=" . urlencode($_GET['region']) .
                    "&country=" . urlencode($_GET['country']);

                if (!empty($_GET['search'])) {
                    $queryString .= "&search=" . urlencode($_GET['search']);
                }

                foreach ($pagination as $p) { ?>
                    <?php if ($p === "...") { ?>
                        <span class="px-3 py-2">...</span>
                    <?php } else { ?>
                        <a href="?id=<?php echo $_GET['id']; ?>&region=<?php echo $_GET['region']; ?>&country=<?php echo $_GET['country']; ?>&page=<?php echo $p; ?>"
                            class="px-3 py-2 rounded-md whitespace-nowrap <?php echo ($p == $page) ? 'font-bold underline' : 'font-normal bg-white hover:bg-gray-100'; ?>">
                            <?php echo $p; ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="flex items-center justify-center gap-4">
                <?php if ($page > 1) { ?>
                    <a href="?<?php echo $queryString; ?>&page=<?php echo $page - 1; ?>"
                        class="flex items-center gap-1 px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100 transition">
                        <span>&larr;</span> Previous
                    </a>
                <?php } ?>
                <?php if ($page < $total_pages) { ?>
                    <a href="?<?php echo $queryString; ?>&page=<?php echo $page + 1; ?>"
                        class="flex items-center gap-1 px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100 transition">
                        Next <span>&rarr;</span>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

<script>
    let debounceTimer;
    const form = document.querySelector('form');
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            // Hapus input page kalau ada, supaya balik ke page 1
            const pageInput = form.querySelector('input[name="page"]');
            if (pageInput) pageInput.remove();

            form.submit();
        }, 1000); // delay 500ms
    });
</script>


<?php
include "footer.php";
?>