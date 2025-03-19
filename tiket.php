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
    return $url;
}

$sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
               lti.summer_img, lti.winter_img, lti.autumn_img
        FROM List_tempat AS lt
        LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
        WHERE lt.price > 100000";

$result = $con->query($sql);
$tickets = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    
<?php
include "header.php";
include "navbar.php";
?>

<body>
    <div class="container my-5 p-4 shadow-lg rounded-4 container-tiket">
    <a href="index.php" class="btn btn-kembali">Kembali</a>
        <h2 class="text-center fw-bold mb-4 text-primary border-bottom pb-2">Admission Ticket</h2>
        <div class="row">
            <?php foreach ($tickets as $ticket) {
                $image = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/300x200');
            ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card card-tiket border-0 shadow-lg rounded-4 overflow-hidden position-relative">
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Ticket Image" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold text-dark"><?php echo htmlspecialchars($ticket['name']); ?></h5>
                            <p class="text-muted small"><?php echo htmlspecialchars($ticket['location']); ?></p>
                            <div class="price-tag">IDR <?php echo number_format($ticket['price'], 0, ',', '.'); ?></div>
                            <div class="mt-4 d-grid gap-2">
                                <a href="https://wa.me/628112557728?text=Halo, saya ingin membeli tiket <?php echo urlencode($ticket['name']); ?>" target="_blank" class="btn btn-success fw-bold shadow-sm">
                                    <i class="fa fa-whatsapp"></i> Beli Tiket
                                </a>
                                <a href="<?php echo htmlspecialchars($image); ?>" target="_blank" class="btn btn-outline-warning fw-bold shadow-sm">
                                    <i class="fa fa-image"></i> Lihat Gambar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

<style>
    .tiket {
        background: linear-gradient(135deg, #6e8efb, #a777e3);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .container-tiket {
        background: #fff;
        color: #333;
    }

    .card-tiket {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-tiket:hover {
        transform: translateY(-8px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .price-tag {
        font-size: 1.2rem;
        background: #FFCA10;
        color: #02335B;
        padding: 8px 15px;
        border-radius: 50px;
        display: inline-block;
        font-weight: bold;
    }

    .btn-kembali {
        display: flex;
        justify-content: center;
        position: absolute;
        background: #02335B;
        color: #FFCA10;
        padding: 5px 15px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-kembali:hover {
        background: #FFCA10;
        color: #02335B;
    }

</style>

</html>