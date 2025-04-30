
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

// Ambil data cruise berdasarkan ID
$id = $_GET['id'] ?? '';
$sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
               lti.summer_img, lti.winter_img, lti.autumn_img, 
               lt.keterangan, lt.kurs
        FROM List_tempat AS lt
        LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
        WHERE lt.id = '$id'"; // Pastikan ID ada di database

$result = $con->query($sql);
$cruise = $result->fetch_assoc();

if (!$cruise) {
    // Jika tidak ada data, tampilkan pesan error
    echo "<div class='container mx-auto px-4 py-16 mt-10'><p class='text-center text-red-500'>Cruise tidak ditemukan.</p></div>";
    exit;
}

// Mengambil gambar dan membuat link WhatsApp
$cruiseImage = getGoogleDriveDirectLink($cruise['summer_img'] ?? $cruise['winter_img'] ?? $cruise['autumn_img'] ?? 'https://via.placeholder.com/300x200');
$waLink = "https://wa.me/628112557728?text=Halo, saya tertarik dengan cruise " . urlencode($cruise['name']);
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Explore Cruises</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Discover Your Perfect Cruise</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500 mb-4">Let us help you find the ideal cruise experience tailored to your needs.</p>

    <div class="max-w-5xl mx-auto p-8">
        <a href="javascript:history.back()" class="text-center text-md font-semibold tracking-wide hover:underline ">
            &larr;Kembali
        </a>

        <div class="mt-4 rounded-xl overflow-hidden flex flex-col md:flex-row">
            <!-- Gambar di sebelah kiri (lebih besar) -->
            <div class="md:w-7/12 w-full">
                <img src="<?= $cruiseImage ?>" alt="<?= htmlspecialchars($cruise['name']) ?>" class="w-full h-100 object-cover rounded-lg shadow-lg">

                <!-- CTA di bawah gambar -->
                <a href="<?= $waLink ?>" target="_blank" class="flex items-center justify-center gap-2 mt-4 text-sm font-semibold text-white bg-[#02335B] hover:bg-[#1ebc5c] transition-all duration-300 px-6 py-3 rounded-lg shadow-md hover:shadow-lg">
                    Chat via WhatsApp
                </a>
            </div>

            <!-- Deskripsi di sebelah kanan -->
            <div class="md:w-5/12 w-full p-6">
                <h2 class="text-3xl font-bold text-[#02335B]"><?= htmlspecialchars($cruise['name']) ?></h2>
                <p class="text-xl font-bold text-[#02335B]">
                 Harga: <?= htmlspecialchars($cruise['kurs']) ?> <?= number_format($cruise['price'], 0, ',', '.') ?>
                </p>

                <p class="text-sm text-gray-500 mt-2">Location: <?= htmlspecialchars($cruise['location']) ?></p>
                <p class="text-sm text-gray-600 mt-2 tracking-wide text-justify leading-relaxed"><?= htmlspecialchars($cruise['keterangan']) ?></p>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>