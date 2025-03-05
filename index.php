<?php
include "db=connection.php";
include "slug.php";
include "../API/Price/Api_LT_total_baru.php";

?>
<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "navbar.php";
?>

<body style="overflow-x: hidden;">
    <!-- Bootstrap 5 Carousel -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/Carousel1.jpg" class="img-fluid d-block w-100" style="height: 500px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="img/Carousel2.jpg" class="img-fluid d-block w-100" style="height: 500px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="img/Carousel3.jpg" class="img-fluid d-block w-100" style="height: 500px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="img/Carousel4.jpg" class="img-fluid d-block w-100" style="height: 500px; object-fit: cover;">
            </div>
        </div>
        <!-- Tombol Navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>


    <div class="container-fluid">
        <div><?php include "table_paket_tour.php"; ?></div>

        <!-- Video Section -->
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item w-100" src="https://www.youtube.com/embed/UzAayl0Lefo" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item w-100" src="https://www.youtube.com/embed/frXzt2Fm1M0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item w-100" src="https://www.youtube.com/embed/ffnHCAVJVP4" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item w-100" src="https://www.youtube.com/embed/DzsXnfvP8Bk" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>


        <div><?php include "table_paket_tour2.php"; ?></div>
    </div>

    <div class="content">
        <div class="content-promo-lebaran">
            <div class="judul-promo">PROMO PAKET TOUR CONSORTIUM 2024</div>
            <div class="content-promo">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6" style="text-align: right;">
                        <div class="row">
                            <div class="col" style="padding: 10px 5px;">
                                <button type="button" class="btn btn-success" onclick="search_promo_consor()"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="col" style="padding: 10px 5px;">
                                <div class="form-group">
                                    <input class="form-control" list="negaraList_consor" id="negara_consor" placeholder="Cari berdasarkan Negara" autocomplete="off">
                                    <datalist id="negaraList_consor">
                                        <?php
                                        // country
                                        $query_country = "SELECT name FROM country order by name ASC";
                                        $rs_country = mysqli_query($con, $query_country);
                                        while ($row_country = mysqli_fetch_array($rs_country)) {
                                        ?>
                                            <option value="<?php echo $row_country['name'] ?>">
                                            <?php
                                        }
                                            ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <?php
                    $query_upload = "SELECT * FROM Upload_Drive2 where p_cons='1' && status='on' order by price ASC limit 4";
                    $rs_upload = mysqli_query($con, $query_upload);
                    while ($row_upload = mysqli_fetch_array($rs_upload)) {
                        $thumbnail = "https://drive.google.com/thumbnail?id=" . explode('/', $row_upload['thumbnail'])[5];
                        $documents = "https://drive.google.com/file/d/" . explode('/', $row_upload['documents'])[5] . "/view";
                    ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <a href="<?php echo $documents ?>" target="_blank" class="text-decoration-none text-dark">
                                <div class="card shadow-sm border-0">
                                    <img src="<?php echo $thumbnail ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $row_upload['judul'] ?></h6>
                                    </div>
                                    <div class="card-footer bg-white font-weight-bold">
                                        <?php echo "IDR " . number_format($row_upload['price'], 0, ".", ".") ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="search-consor"></div>
                <div class="more-consor"></div>
            </div>
            <div class="footer-promo" style="text-align: center; margin-top: -30px;">
                <input type="hidden" name="val_li_consor" id="val_li_consor" value='10'>
                <button type="button" class="btn btn-success" onclick="fungsi_more_consor()">View More</button>
            </div>
        </div>

        <div class="text-center" style="margin-top: 40px;">
            <h2 class="fw-bold">OUR PRODUCTS</h2>
        </div>
        <div class="row text-center">
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="<?php echo $domain_web ?>Activity">
                    <img src="img/attraction2.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="">
                    <img src="img/cruise.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="<?php echo $domain_web ?>paket-landtour.php">
                    <img src="img/land_tour.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="<?php echo $domain_web ?>Hotel">
                    <img src="img/hotel.png" class="img-thumbnail shadow-sm img-hover">
                </a>
            </div>
        </div>
    </div>
    <script>
        function search_promo() {
            var negara = document.getElementById("negara").value;
            $.ajax({
                url: "search-lebaran.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                },
                success: function(data) {
                    $('.search-lebaran').html(data);
                    $('.front-lebaran').html('');

                }
            });
        }

        function search_promo_consor() {
            var negara = document.getElementById("negara_consor").value;
            $.ajax({
                url: "search-consor.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                },
                success: function(data) {
                    $('.search-consor').html(data);
                    $('.front-consor').html('');

                }
            });
        }

        function fungsi_more() {
            var li = document.getElementById('val_li').value;
            // alert(li);
            $.ajax({
                url: "promo1.php",
                method: "POST",
                asynch: false,
                data: {
                    id: li,
                },
                success: function(data) {
                    var more = parseInt(li) + 10;
                    document.getElementById("val_li").value = more;
                    $('.more-promo').html(data);
                }
            });
        }

        function fungsi_more_consor() {
            var li = document.getElementById('val_li_consor').value;
            // alert(li);
            $.ajax({
                url: "promo_consor.php",
                method: "POST",
                asynch: false,
                data: {
                    id: li,
                },
                success: function(data) {
                    var more = parseInt(li) + 10;
                    document.getElementById("val_li_consor").value = more;
                    $('.more-consor').html(data);
                }
            });
        }
    </script>
</body>
<style>
    .video-wrapper {
        width: 100%;
        max-width: 270px;
        /* Batasi lebar maksimal */
    }

    .video-wrapper iframe {
        width: 100%;
        height: 150px;
        border: none;
    }

    @media (max-width: 576px) {

        /* Untuk layar kecil seperti HP */
        .d-flex {
            flex-direction: column;
            /* Stack ke bawah */
            align-items: center;
        }
    }

    /* Style untuk tombol navigasi */
    .custom-btn {
        background: rgba(0, 0, 0, 0.5);
        /* Transparan hitam */
        border: none;
        width: 50px;
        height: 50px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        transition: 0.3s ease-in-out;
    }

    .custom-btn:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    /* Style untuk ikon prev & next */
    .custom-icon {
        color: white;
        font-size: 24px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Posisi tombol prev & next */
    .carousel-control-prev {
        left: 15px;
    }

    .carousel-control-next {
        right: 15px;
    }

    .img-hover {
        transition: transform 0.3s ease-in-out;
    }

    .img-hover:hover {
        transform: scale(1.1);
    }

    #tb-lt-web th,
    #tb-lt-web td {
        padding: 8px;
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        #tb-lt-web {
            font-size: 9pt;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
</style>
<?php
include "footer.php";
?>

</html>