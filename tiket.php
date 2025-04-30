<?php
include "db=connection.php";
include "slug.php";
?>

<?php
function getGoogleDriveDirectLink($url)
{
    if (strpos($url, 'drive.google.com') !== false) {
        preg_match('/d\/([^\/]+)/', $url, $matches);
        if (!empty($matches[1])) {
            return "https://lh3.googleusercontent.com/d/{$matches[1]}=s0";
        }
    }
    return $url ?: 'https://via.placeholder.com/300x200'; // Default jika tidak ada gambar
}

// Inisialisasi pagination dan filter
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$price_filter = isset($_GET['price_filter']) ? $_GET['price_filter'] : '';
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

// Query dasar
$sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
               lti.summer_img, lti.winter_img, lti.autumn_img
        FROM List_tempat AS lt
        LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
        WHERE lt.price > 100000 AND lt.tempat NOT LIKE '%cruise%'";

// Tambahkan filter pencarian
$params = [];
if (!empty($search)) {
    $sql .= " AND (lt.tempat LIKE ? OR lt.city LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Tambahkan filter harga
if ($price_filter == 'low') {
    $sql .= " AND lt.price < 200000";
} elseif ($price_filter == 'medium') {
    $sql .= " AND lt.price BETWEEN 200000 AND 500000";
} elseif ($price_filter == 'high') {
    $sql .= " AND lt.price > 500000";
}

// Tambahkan pengurutan
if ($sort_by == 'price_asc') {
    $sql .= " ORDER BY lt.price ASC";
} elseif ($sort_by == 'price_desc') {
    $sql .= " ORDER BY lt.price DESC";
} else {
    $sql .= " ORDER BY lt.id DESC";
}

// Tambahkan pagination
$sql .= " LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

// Eksekusi query dengan prepared statement
$stmt = $con->prepare($sql);
$stmt->bind_param(str_repeat("s", count($params)), ...$params);
$stmt->execute();
$result = $stmt->get_result();

$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

// Query total tiket
$total_sql = "SELECT COUNT(*) AS total FROM List_tempat WHERE price > 100000";
if (!empty($search)) {
    $total_sql .= " AND (tempat LIKE ? OR city LIKE ?)";
    $params_total = ["%$search%", "%$search%"];
} else {
    $params_total = [];
}

$stmt_total = $con->prepare($total_sql);
if (!empty($params_total)) {
    $stmt_total->bind_param(str_repeat("s", count($params_total)), ...$params_total);
}
$stmt_total->execute();
$total_result = $stmt_total->get_result();
$total_row = $total_result->fetch_assoc();
$total_tickets = $total_row['total'];
$total_pages = ceil($total_tickets / $limit);
?>

<?php
include "header.php";
include "navbar.php";
?>
<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center">Admission Tickets</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Explore the World with Us</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Discover amazing places and experiences.</p>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500 mb-4">Book your tickets now!</p>

    <form method="GET" class="flex flex-col gap-4 justify-center align-center md:flex-row items-center mb-8 p-6 rounded-lg shadow-lg bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 transition duration-300 hover:shadow-xl space-y-4 md:space-y-0 md:space-x-4">
        <div class="flex-grow w-full md:w-1/2">
            <div class="relative">
                <input type="text" name="search" class="w-full p-3 pl-10 rounded-lg bg-white border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400 text-gray-700" placeholder="Search for a place..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <select name="price_filter" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white text-gray-700">
                <option value="">Price Filter</option>
                <option value="low" <?php echo $price_filter == 'low' ? 'selected' : ''; ?>>Low (&lt; 200k)</option>
                <option value="medium" <?php echo $price_filter == 'medium' ? 'selected' : ''; ?>>Medium (200k - 500k)</option>
                <option value="high" <?php echo $price_filter == 'high' ? 'selected' : ''; ?>>High (&gt; 500k)</option>
            </select>
        </div>
        <div class="w-full md:w-1/4">
            <select name="sort_by" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white text-gray-700">
                <option value="">Sort By</option>
                <option value="price_asc" <?php echo $sort_by == 'price_asc' ? 'selected' : ''; ?>>Price: Low to High</option>
                <option value="price_desc" <?php echo $sort_by == 'price_desc' ? 'selected' : ''; ?>>Price: High to Low</option>
            </select>
        </div>
        <div class="w-full md:w-auto flex justify-center md:justify-start">
            <button type="submit" class="px-4 py-2 rounded-lg bg-black text-white font-semibold hover:bg-gray-800 transition duration-300 flex items-center gap-2">
                <i class="bi bi-search"></i>
                Search
            </button>
        </div>
    </form>

    <p class="text-center text-gray-500 mb-8">Showing <?php echo count($tickets); ?> of <?php echo $total_tickets; ?> available tickets</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php foreach ($tickets as $ticket) {
            $image = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
        ?>
            <div class="rounded-xl shadow-lg bg-white overflow-hidden transition transform hover:scale-105 duration-300">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Admission Ticket" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h5 class="text-gray-800 font-bold text-lg mb-2"><?php echo htmlspecialchars($ticket['name']); ?></h5>
                    <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($ticket['location']); ?></p>
                    <div class="text-blue-600 text-xl font-semibold mb-4">
                        <?php echo number_format($ticket['price'], 0, ',', '.'); ?> IDR
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?php echo urlencode($ticket['name']); ?>"
                            target="_blank" class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 transition">
                            <i class="bi bi-whatsapp"></i> Buy Ticket
                        </a>
                        <a href="<?php echo htmlspecialchars($image); ?>" target="_blank"
                            class="px-4 py-2 border border-blue-600 text-blue-600 text-sm rounded-md hover:bg-blue-600 hover:text-white transition">
                            <i class="bi bi-image"></i> View Image
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-between mt-10 px-4 sm:px-8 gap-4">

        <!-- Spacer kosong untuk alignment di desktop, bisa dihapus jika tidak digunakan -->
        <div class="hidden sm:block w-24"></div>

        <!-- Pagination number -->
        <div class="flex flex-wrap items-center justify-center gap-2 text-sm text-black">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                    class="px-3 py-2 rounded-md whitespace-nowrap 
               <?php echo ($i == $page)
                    ? 'font-bold underline text-blue-600'
                    : 'font-normal bg-white hover:bg-gray-100'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>

        <!-- Prev / Next Buttons -->
        <div class="flex items-center justify-center gap-4">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>"
                    class="flex items-center gap-1 px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100 transition">
                    <span>&larr;</span> Previous
                </a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>"
                    class="flex items-center gap-1 px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100 transition">
                    Next <span>&rarr;</span>
                </a>
            <?php endif; ?>
        </div>

    </div>


</div>

<?php
include 'footer.php';
?>