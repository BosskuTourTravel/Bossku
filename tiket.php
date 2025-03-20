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

<body>
    <div class="container my-5 p-4 shadow-lg rounded-4 bg-light">
        <h2 class="text-center fw-bold mb-4 text-dark border-bottom pb-2">Admission Ticket</h2>
        <form method="GET" class="mt-4 mb-4 p-3 rounded-4 shadow-sm">
            <div class="row g-3 align-items-center">
                <div class="col-md-8"></div>

                <!-- Input Pencarian -->
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-warning text-dark border-0 rounded-start-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control shadow-none border-0 rounded-end-3"
                            placeholder="Cari tempat..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    </div>
                </div>

                <!-- Tombol Cari -->
                <div class="col-md-1 text-end">
                    <button type="submit" class="btn btn-warning fw-bold rounded-3 px-4 shadow-sm text-dark">
                        Cari
                    </button>
                </div>
            </div>
        </form>



        <p class="text-center text-muted">Menampilkan <?php echo count($tickets); ?> dari <?php echo $total_tickets; ?> tiket tersedia</p>
        <div class="row g-4">
            <?php foreach ($tickets as $ticket) {
                $image = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
            ?>
                <div class="col-lg-4 col-md-6 mb-4 ticket-card <?php echo $hiddenClass; ?>">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative">
                        <img src="<?php echo htmlspecialchars($image); ?>"
                            alt="Admission Ticket"
                            class="card-img-top" style="height: 250px; object-fit: cover;">

                        <div class="card-body text-center p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark"> <?php echo htmlspecialchars($ticket['name']); ?> </h5>
                            <p class="text-muted small"> <?php echo htmlspecialchars($ticket['location']); ?> </p>
                            <div class="badge text-light p-2 fw-bold" style="background-color: #02335B;">
                                IDR <?php echo number_format($ticket['price'], 0, ',', '.'); ?>
                            </div>

                            <div class="mt-4 d-grid gap-2">
                                <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?php echo urlencode($ticket['name']); ?>"
                                    target="_blank" class="btn btn-success btn-md fw-semibold shadow-sm">
                                    <i class="bi bi-whatsapp"></i> Buy Ticket
                                </a>
                                <a href="<?php echo htmlspecialchars($image); ?>"
                                    target="_blank" class="btn btn-outline-warning btn-md fw-bold shadow-sm">
                                    <i class="bi bi-image"></i> Lihat Gambar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="pagination-wrapper">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>" class="pagination-btn prev-btn">&laquo; Prev</a>
            <?php endif; ?>

            <div class="pagination-pages">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>"
                        class="pagination-number <?php echo ($i == $page) ? 'active-page' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>" class="pagination-btn next-btn">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</body>

<style>
    .form-control,
    .form-select {
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 1px solid #ccc;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #000;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .btn-dark {
        transition: all 0.3s ease-in-out;
        background: #212529;
        border: none;
    }

    .btn-dark:hover {
        background: #000;
        transform: scale(1.02);
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.2);
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        gap: 12px;
    }

    .pagination-btn {
        padding: 10px 18px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
        font-size: 1rem;
        border: 2px solid transparent;
    }

    .prev-btn,
    .next-btn {
        background: #02335B;
        color: #FFF;
        border: 2px solid #02335B;
    }

    .prev-btn:hover,
    .next-btn:hover {
        background: transparent;
        color: #02335B;
    }

    .pagination-pages {
        display: flex;
        gap: 6px;
    }

    .pagination-number {
        padding: 10px 15px;
        border: 2px solid #02335B;
        color: #02335B;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        font-size: 1rem;
    }

    .pagination-number:hover {
        background: #02335B;
        color: #FFF;
    }

    .active-page {
        background: #FFCA10;
        color: #02335B;
        font-weight: bold;
        border: 2px solid #FFCA10;
    }
</style>

</html>