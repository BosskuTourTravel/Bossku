<?php
include "header.php";
include "navbar.php";
include "slug.php";
include "db=connection.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

function slugify($text)
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    if (function_exists('iconv')) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);

    return !empty($text) ? $text : 'n-a';
}

// Validasi
if (empty($slug)) {
    echo "<p>Cruise tidak ditemukan.</p>";
    exit;
}

// Query database
$sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, 
        lti.summer_img, lti.winter_img, lti.autumn_img, lt.keterangan, lt.kurs
        FROM List_tempat AS lt
        LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id";

$result = $con->query($sql);

$cruise = null;
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (slugify($row['name']) == $slug) {
            $cruise = [
                'id' => $row['id'],
                'name' => $row['name'],
                'country' => $row['location'],
                'price' => $row['price'],
                'currency' => $row['kurs'],
                'image' => $row['summer_img'] ?: ($row['winter_img'] ?: $row['autumn_img']),
                'description' => $row['keterangan'],
            ];
            break;
        }
    }
}

if (!$cruise) {
    echo "<p>Cruise tidak ditemukan.</p>";
    exit;
}


// Function format harga (bisa dipindah ke include-an juga)
function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
function formatUSD($angka)
{
    return '$' . number_format($angka, 2, '.', ',');
}

$waNumber = "628112557728";
$waMessage = "Halo! Saya tertarik untuk memesan cruise: " . $cruise['name'] . ". Mohon info lebih lanjut.";
$encodedMessage = urlencode($waMessage);
$waLink = "https://wa.me/{$waNumber}?text={$encodedMessage}";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Explore Cruises</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Discover Your Perfect Cruise</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500 mb-4">Let us help you find the ideal cruise experience tailored to your needs.</p>

    <div class="max-w-5xl mx-auto p-8">
        <a href="javascript:history.back()" class="text-center text-md font-semibold tracking-wide hover:underline ">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="mt-4 rounded-xl overflow-hidden flex flex-col md:flex-row">


            <!-- Gambar di sebelah kiri (lebih besar) -->
            <div class="md:w-7/12 w-full">
                <img src="<?php echo $cruise['image']; ?>" alt="<?php echo htmlspecialchars($cruise['name']); ?>" class="w-full md:w-1/2 rounded-lg shadow-md">

                <!-- CTA di bawah gambar -->
                <a href="<?php echo $waLink; ?>" target="_blank" class="flex items-center justify-center gap-2 mt-4 text-sm font-semibold text-white bg-[#02335B] hover:bg-[#1ebc5c] transition-all duration-300 px-6 py-3 rounded-lg shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.721 6.721 0 0 0 3.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 0 1-.814 1.686.75.75 0 0 0 .44 1.223ZM8.25 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                    </svg>
                    Chat via WhatsApp
                </a>

            </div>

            <!-- Deskripsi di sebelah kanan -->
            <div class="md:w-5/12 w-full p-6">
                <h2 class="text-3xl font-bold text-[#02335B]"><?php echo $cruise['name']; ?></h2>
                <p class="text-xl font-bold text-[#02335B]">
                    <?php
                    if (!empty($cruise['price'])) {
                        $currency = strtoupper(trim($cruise['currency']));
                        $cruisePrice = $cruise['price'];

                        if ($currency === 'IDR') {
                            echo formatRupiah($cruisePrice);
                        } elseif ($currency === 'USD') {
                            echo formatUSD($cruisePrice);
                        } else {
                            echo number_format($cruisePrice); // fallback
                        }
                    } else {
                        echo 'Harga belum tersedia';
                    }
                    ?>
                </p>

                <p class="text-sm text-gray-500 mt-2">Country: <?php echo $cruise['country']; ?></p>
                <p class="text-sm text-gray-600 mt-2 tracking-wide text-justify leading-relaxed"><?php echo $cruise['description']; ?></p>
            </div>
        </div>
    </div>


</div>
<?php
include "footer.php";
?>