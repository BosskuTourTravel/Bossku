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
$limit = 6;
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
        WHERE lt.price > 100000";

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

<!DOCTYPE html>
<html lang="en">

<?php
include "header.php";
include "navbar.php";
?>

<body class="bg-gray-50">

    <div class="container mx-auto my-10 p-6 shadow-lg rounded-2xl bg-white">

        <h2 class="text-center font-bold text-3xl text-gray-800 mb-6">Admission Ticket</h2>

        <form method="GET" class="flex items-center mb-6 p-4 rounded-lg shadow-md bg-gray-100 transition duration-300 hover:shadow-lg">
            <div class="w-full flex gap-4">
                <div class="w-3/4">
                    <input type="text" name="search" class="w-full p-3 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Cari tempat..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <div class="w-1/4">
                    <button type="submit" class="w-full p-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition duration-300">Cari</button>
                </div>
            </div>
        </form>

        <p class="text-center text-gray-500 mb-6">Menampilkan <?php echo count($tickets); ?> dari <?php echo $total_tickets; ?> tiket tersedia</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($tickets as $ticket) {
                $image = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
            ?>
                <div class="rounded-xl shadow-md bg-white overflow-hidden transition transform hover:scale-105 duration-300">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="Admission Ticket" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h5 class="text-gray-800 font-bold text-lg"><?php echo htmlspecialchars($ticket['name']); ?></h5>
                        <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($ticket['location']); ?></p>
                        <div class="text-blue-600 text-xl font-semibold my-2">
                            <?php echo number_format($ticket['price'], 0, ',', '.'); ?> IDR
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?php echo urlencode($ticket['name']); ?>"
                                target="_blank" class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 transition">
                                <i class="bi bi-whatsapp"></i> Buy Ticket
                            </a>
                            <a href="<?php echo htmlspecialchars($image); ?>" target="_blank"
                                class="px-4 py-2 border border-blue-600 text-blue-600 text-sm rounded-md hover:bg-blue-600 hover:text-white transition">
                                <i class="bi bi-image"></i> Lihat Gambar
                            </a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

        <div class="flex justify-center gap-4 mt-8">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold transition duration-300 hover:bg-blue-700">Prev</a>
            <?php endif; ?>

            <div class="flex gap-2">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="px-4 py-2 border-2 border-blue-600 rounded-lg text-blue-600 font-semibold transition duration-300 hover:bg-blue-600 hover:text-white <?php echo ($i == $page) ? 'bg-yellow-500 text-blue-800' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold transition duration-300 hover:bg-blue-700">Next</a>
            <?php endif; ?>
        </div>

    </div>

</body>

<?php
include 'footer.php';
?>

</html>