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
$query = "SELECT consortium_list.id, consortium_list.continent, consortium_list.detail, consortium_list.country, country.img FROM consortium_list LEFT JOIN country ON consortium_list.country LIKE country.name where consortium_list.continent='" . $_GET['id'] . "' GROUP BY consortium_list.detail";
$rs = mysqli_query($con, $query);

if ($_GET['id'] == "Asia") {
    $judul = "Benua Asia";
    $sub_judul = "Asia adalah benua terbesar dengan budaya, alam, dan kota-kota modern yang menakjubkan.";
    $img_header = "img/asia/AsiaMap.jpg";
} else if ($_GET['id'] == "Europe") {
    $judul = "Benua Europe";
    $sub_judul = "Temukan keindahan dan keberagaman budaya dari Eropa Barat hingga Timur.";
    $img_header = "img/europe/Europe.jpg";
} else if ($_GET['id'] == "Australia") {
    $judul = "Benua Australia";
    $sub_judul = "Keajaiban alam, satwa unik, dan kota metropolitan yang menakjubkan.";
    $img_header = "img/BenuaAus.jpg";
} else {
}
?>

<body>
    <div class="relative">
        <img src="<?php echo $img_header ?>" alt="Benua Image" class="w-full h-[400px] object-cover">
        <div class="absolute inset-0 bg-black opacity-75"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white z-10 px-4">
            <h1 class="text-4xl font-bold"><?php echo $judul ?></h1>
            <p class="text-lg mt-4 max-w-3xl mx-auto"><?php echo $sub_judul ?></p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            <?php
            while ($row = mysqli_fetch_array($rs)) {
                // Define image paths for regions based on continent
                $images = [
                    "Europe" => [
                        "West" => "img/europe/WestEurope.jpg",
                        "East" => "img/europe/EastEurope.jpg",
                    ],
                    "Asia" => [
                        "North" => "img/asia/AsiaBarat.jpg",
                        "Southeast" => "img/asia/AsiaTenggara.jpg",
                        "South" => "img/asia/AsiaSelatan.jpg",
                        "Northwest" => "img/asia/Northwest.jpg",
                        "East" => "img/asia/AsiaTimur.jpg"
                    ],
                    "Australia" => [
                        "" => "img/AustraliaThumb.jpg"
                    ]
                ];

                $continent = $_GET['id']; // Get continent name from URL
                $region = $row['detail']; // Get region name from the query

                // Default image path
                $image = "img/default.jpg";
                // Check if the image exists for the continent and region
                if (isset($images[$continent][$region])) {
                    $image = $images[$continent][$region];
                }
            ?>
                <div class="relative group">
                    <a href="negara.php?id=<?php echo $_GET['id'] . "&&region=" . $row['detail'] ?>" class="block overflow-hidden rounded-lg shadow-lg">
                        <img src="<?php echo $image; ?>" alt="<?php echo $row['detail']; ?>" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-50 group-hover:opacity-75 transition-opacity duration-300 rounded-lg"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="text-xl font-semibold"><?php echo $row['detail']; ?></h3>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
<?php
include "footer.php";
?>

<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.js"></script>

</html>
