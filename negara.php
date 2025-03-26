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

$query = "SELECT DISTINCT consortium_list.country, country.img 
          FROM consortium_list 
          LEFT JOIN country ON consortium_list.country = country.name
          WHERE consortium_list.detail = '" . $_GET['region'] . "' 
          AND consortium_list.continent = '" . $_GET['id'] . "'";

$rs = mysqli_query($con, $query);

if ($_GET['id'] == "Asia") {
    $sub_judul = "Wilayah tropis yang kaya akan budaya, kuliner lezat, dan destinasi eksotis.";
    $img_header = "img/asia/AsiaTenggaraThumb.jpg";
} else if ($_GET['id'] == "Europe") {
    $sub_judul = "Nikmati keindahan kota bersejarah, lanskap menawan, dan budaya unik Eropa.";
    $img_header = "img/europe/EastEuropeThumb.jpg";
} else if ($_GET['id'] == "Australia") {
    $judul = "Benua Australia";
    $sub_judul = "Keajaiban alam, satwa unik, dan kota metropolitan yang menakjubkan.";
    $img_header = "img/BenuaAus.jpg";
}
?>

<body>
    <!-- Header Section with background image -->
    <div class="relative">
        <img src="<?php echo $img_header ?>" alt="Region Map" class="w-full h-[400px] object-cover">
        <div class="absolute inset-0 bg-black opacity-75"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white z-10 px-6">
            <h1 class="text-4xl font-bold"><?php echo $_GET['region'] . " " . $_GET['id'] ?></h1>
            <p class="text-lg mt-4"><?php echo $sub_judul ?></p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="flex justify-center items-center py-10">
        <div class="container max-w-7xl px-6">
            <!-- Search input -->
            <div class="mb-6 flex justify-start relative">
                <!-- Icon Search -->
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                </span>

                <!-- Input Field -->
                <input type="text" id="searchInput" class="w-full max-w-md pl-10 pr-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" placeholder="Cari negara...">
            </div>

            <!-- Countries List (Centered) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 justify-center" id="countryList">
                <?php
                if ($rs && mysqli_num_rows($rs) > 0) {
                    while ($row = mysqli_fetch_array($rs)) {
                        $country = $row['country'];
                        $filename_base = strtolower(str_replace([" ", "’"], ["-", ""], $country));
                        $img_jpg = "img/flag/" . $filename_base . ".jpg";
                        $img_jpeg = "img/flag/" . $filename_base . ".jpeg";
                        $img_png = "img/flag/" . $filename_base . ".png";

                        // Check image format
                        if (file_exists(__DIR__ . "/" . $img_jpg)) {
                            $img = $img_jpg;
                        } elseif (file_exists(__DIR__ . "/" . $img_jpeg)) {
                            $img = $img_jpeg;
                        } elseif (file_exists(__DIR__ . "/" . $img_png)) {
                            $img = $img_png;
                        } else {
                            $img = "img/asia/Asia.jpg";
                        }
                ?>
                        <div class="group relative country-item" data-name="<?php echo strtolower($country); ?>">
                            <a href="detail.php?id=<?php echo $_GET['id'] . "&&region=" . $_GET['region'] . "&&country=" . urlencode($country) ?>" class="block overflow-hidden rounded-lg shadow-lg">
                                <img src="<?php echo $img ?>" alt="<?php echo $country ?>" class="w-full h-56 object-cover rounded-lg transition-transform transform group-hover:scale-105">
                                <div class="absolute inset-0 bg-black opacity-50 rounded-lg group-hover:opacity-75"></div>
                                <div class="absolute bottom-0 left-0 w-full p-3 text-white">
                                    <h3 class="text-2xl font-semibold"><?php echo $country ?></h3>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center text-gray-600'>Tidak ada data tersedia.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('.country-item');

            items.forEach(function(item) {
                let name = item.getAttribute('data-name');
                if (name.includes(filter)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    </script>
</body>
<?php
include "footer.php";
?>

</html>