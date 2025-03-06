<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <div style="text-align: center; width: 80%; margin: auto;">
        <div class="row" style="text-align: center; padding: 40px;">
            <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                <div class="thumbnail">
                    <a href="<?php echo $domain_web ?>landtour-content.php?id=Eropa" class="front-text">
                        <img src="<?php echo $domain_web ?>img/home_page/EROPA.jpg" class="img-fluid img-thumbnail">
                        <div class="centered">EROPA</div>
                    </a>

                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                <div class="thumbnail">
                    <a href="<?php echo $domain_web ?>landtour-content.php?id=Australia" class="front-text">
                        <img src="<?php echo $domain_web ?>img/home_page/AUSTRALIA.jpg" class="img-fluid img-thumbnail">
                        <div class="centered">AUSTRALIA</div>
                    </a>

                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                <div class="thumbnail">
                    <a href="<?php echo $domain_web ?>landtour-content.php?id=Asia" class="front-text">
                        <img src="<?php echo $domain_web ?>img/home_page/JAPAN.jpg" class="img-fluid img-thumbnail">
                        <div class="centered">ASIA</div>
                    </a>

                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                <div class="thumbnail">
                    <a href="<?php echo $domain_web ?>landtour-content.php?id=Afrika" class="front-text">
                        <img src="<?php echo $domain_web?>img/home_page/AFRIKA.jpg" class="img-fluid img-thumbnail">
                        <div class="centered">AFRIKA</div>
                    </a>

                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                <div class="thumbnail">
                    <a href="<?php echo $domain_web ?>landtour-content.php?id=Amerika" class="front-text">
                        <img src="<?php echo $domain_web ?>img/home_page/AMERIKA.jpg" class="img-fluid img-thumbnail">
                        <div class="centered">AMERIKA UTARA</div>
                    </a>

                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                <div class="thumbnail">
                    <a href="<?php echo $domain_web ?>landtour-content.php?id=Amerika" class="front-text">
                        <img src="<?php echo $domain_web ?>img/home_page/AMERIKA-SEL2.jpg" class="img-fluid img-thumbnail">
                        <div class="centered">AMERIKA SELATAN</div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</body>
<?php

include "footer.php";
?>

</html>