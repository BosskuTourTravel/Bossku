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
} else if ($_GET['id']  == "Europe") {
    $sub_judul = "Nikmati keindahan kota bersejarah, lanskap menawan, dan budaya unik Eropa.";
    $img_header = "img/europe/EastEuropeThumb.jpg";
}
?>

<body>
    <div class="position-relative">
        <img src="<?php echo $img_header ?>" alt="Region Map" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.9); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold"><?php echo $_GET['region'] . " " . $_GET['id'] ?></h1>
            <p class="fs-5"><?php echo $sub_judul ?></p>
        </div>
    </div>
    <div class="container py-5">
        <div class="mb-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari negara...">
        </div>
        <div class="row g-2" id="countryList">
            <?php
            if ($rs && mysqli_num_rows($rs) > 0) {
                while ($row = mysqli_fetch_array($rs)) {
                    $country = $row['country'];
                    $filename_base = strtolower(str_replace([" ", "’"], ["-", ""], $country));
                    $img_jpg = "img/flag/" . $filename_base . ".jpg";
                    $img_jpeg = "img/flag/" . $filename_base . ".jpeg";
                    $img_png = "img/flag/" . $filename_base . ".png";

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
                    <div class="col-md-4 country-item" data-name="<?php echo strtolower($country); ?>">
                        <a href="detail.php?id=<?php echo $_GET['id'] . "&&region=" . $_GET['region'] . "&&country=" . urlencode($country) ?>"
                            class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                            <img src="<?php echo $img ?>" alt="<?php echo $country ?>" class="img-fluid w-100" style="height: 225px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                                <h3 class="fw-bold mb-0 text-white"><?php echo $country ?></h3>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center text-muted'>Tidak ada data tersedia.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('.country-item');
            
            items.forEach(function (item) {
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
