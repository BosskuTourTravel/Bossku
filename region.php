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
$query = "SELECT consortium_list.id, consortium_list.continent,consortium_list.detail,consortium_list.country,country.img FROM consortium_list LEFT JOIN country ON consortium_list.country LIKE country.name where consortium_list.continent='" . $_GET['id'] . "' GROUP BY consortium_list.detail";
$rs = mysqli_query($con, $query);

if ($_GET['id'] == "Asia") {
    $judul = "Benua Asia";
    $sub_judul = "Asia adalah benua terbesar dengan budaya, alam, dan kota-kota modern yang menakjubkan.";
    $img_header = "img/asia/AsiaMap.jpg";
} else if ($_GET['id'] == "Europe") {
    $judul = "Benua Europe";
    $sub_judul = "Temukan keindahan dan keberagaman budaya dari Eropa Barat hingga Timur.";
    $img_header = "img/europe/Europe.jpg";
} else {
}
?>

<body>
    <div class="position-relative">
        <img src="<?php echo $img_header ?>" alt="Asia Map" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.75); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold"><?php echo $judul ?></h1>
            <p class="fs-5 mt-3 px-3" style="max-width: 800px;">
                <?php echo $sub_judul ?>
            </p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-2">
            <?php
            while ($row = mysqli_fetch_array($rs)) {

            ?>
                <div class="col-md-4">
                    <a href="negara.php?id=<?php echo $_GET['id'] . "&&region=" . $row['detail'] ?>" class="custom-card position-relative overflow-hidden rounded-4 shadow-lg d-block">
                        <?php
                        // Array manual untuk menyimpan gambar berdasarkan benua & region
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
                            ]
                        ];

                        // Ambil nama benua dari URL
                        $continent = $_GET['id'];  // Misal: "Asia" atau "Europe"
                        $region = $row['detail'];  // Misal: "West", "Southeast", dll

                        // Cek apakah ada gambar untuk benua dan region ini
                        $image = "img/default.jpg"; // Default image
                        if (isset($images[$continent][$region])) {
                            $image = $images[$continent][$region];
                        }
                        ?>
                        <img src="<?php echo $image; ?>" alt="<?php echo $row['detail']; ?>" class="img-fluid w-100" style="height: 220px; object-fit: cover;">

                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-left">
                            <h3 class="fw-bold mb-0 text-white"><?php echo $row['detail'] . " " ?></h3>
                        </div>                    </a>
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

<style>
    .custom-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .custom-card:hover {
        transform: scale(1.05);
    }

    .custom-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 15px;
    }

    .card-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: end;
        color: white;
        padding: 15px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
        transition: all 0.3s ease-in-out;
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
    }

    .card-subtitle {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 10px;
    }
</style>