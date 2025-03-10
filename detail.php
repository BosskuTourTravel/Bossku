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

$query = "SELECT consortium_list.id, consortium_list.continent,consortium_list.detail,consortium_list.country,country.img FROM consortium_list LEFT JOIN country ON consortium_list.country LIKE country.name where consortium_list.continent='" . $_GET['id'] . "' && consortium_list.detail='" . $_GET['region'] . "' && consortium_list.country='".$_GET['country']."' GROUP BY consortium_list.country";
$rs = mysqli_query($con, $query);


?>

<body>
    <div class="position-relative">
        <img src="img/Asia/IndonesiaThumb.jpg" alt="Europe Map" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
            <h1 class="fw-bold"><?php echo $_GET['country'] ?></h1>
        </div>
    </div>
    <div class="container my-4">
        <h2 class="text-center mb-4 fw-bold">Trip <?php echo $_GET['country'] ?></h2>

        <!-- Filter dan Search -->
        <div class="row mb-4">
            <!-- <div class="col-md-4">
                <select id="filterKategori" class="form-select">
                    <option value="all">Semua Kategori</option>
                    <option value="paket-tour">Paket Tour</option>
                    <option value="land-tour">Land Tour</option>
                    <option value="consortium">Consortium</option>
                </select>
            </div> -->
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari trip...">
            </div>
        </div>

        <!-- Card Container -->
        <div class="row" id="tripContainer">
            <!-- Card 1 -->
            <?php 
            while($row=mysqli_fetch_array($rs)){
                ?> <div class="col-md-4 mb-4 trip-card paket-tour">
                <div class="card">
                    <img src="img/Asia/PaketBali.jpg" class="card-img-top" alt="Bali">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Trip Bali</h5>
                        <p class="card-text">3 Hari 2 Malam</p>
                        <p class="fw-bold text-danger">Rp3.500.000</p>
                        <a href="https://wa.me/628112557728?text=Halo Bossku" target="_BLANK" class="btn btn-success mt-auto">Pesan via WhatsApp</a>
                    </div>
                </div>
            </div> <?php 

            }
            ?>
        </div>
    </div>

    <script>
        // document.getElementById("filterKategori").addEventListener("change", function() {
        //     let kategori = this.value;
        //     let cards = document.querySelectorAll(".trip-card");

        //     cards.forEach(card => {
        //         if (kategori === "all" || card.classList.contains(kategori)) {
        //             card.style.display = "block";
        //         } else {
        //             card.style.display = "none";
        //         }
        //     });
        // });

        document.getElementById("searchInput").addEventListener("keyup", function() {
            let searchText = this.value.toLowerCase();
            let cards = document.querySelectorAll(".trip-card");

            cards.forEach(card => {
                let title = card.querySelector(".card-title").innerText.toLowerCase();
                if (title.includes(searchText)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
</body>
<?php
include "footer.php";
?>

<style>
    .card {
        height: 100%;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>