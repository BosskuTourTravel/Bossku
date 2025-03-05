<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
function get_kurs_manual($d)
{
    include "db=connection.php";
    $kurs = $d['kurs'];
    $nominal = $d['nominal'];
    $query = "SELECT * FROM  kurs_bca_field where nama = '" . $kurs . "' order by id ASC ";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    if ($row['id'] == "") {
        return json_encode(array("status" => "data Kurs tidak Tersedia", "data" => '0'), true);
    } else {
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "data" => $nominal), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                $price = $nominal * $row['jual'];
                return json_encode(array("status" => $result_data['status'], "data" => $price), true);
            }
        }
    }
}
function get_pembulatan($x)
{
    $totalharga = ceil($x);
    if (substr($totalharga, -5) == 0) {
        $total_harga = round($totalharga, -5);
    } else if (substr($totalharga, -5) <= 50000) {
        $total_harga = round($totalharga, -5) + 50000;
    } else {
        $total_harga = round($totalharga, -5);
    }
    return json_encode(array("status" => 1, "value" => $total_harga), true);
}

?>

<body>
    <div class="content-tour">
        <nav aria-label="breadcrumb" style="padding: 10px; background-color: whitesmoke; border-radius: 15px; margin: auto;">
            <div class="row">
                <div class="col" style="text-align: left;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Land Tour</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <?php echo $_GET['id'] ?>
                        </li>
                    </ol>
                </div>
                <div class="col" style="text-align: right;">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search...." aria-describedby="basic-addon2" id="cari" value="<?php echo $_GET['search'] ?>">
                        <div class="input-group-append" style="padding-left: 5px;">
                            <button id="myBtn" class="btn btn-primary" type="button" onclick="fungsi_cari('<?php echo $_GET['id'] ?>')">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div style="padding: 10px;">
            <?php
            $query_ct = "SELECT * FROM LT_Category order by id ASC";
            $rs_ct = mysqli_query($con, $query_ct);
            while ($row_ct = mysqli_fetch_array($rs_ct)) {
            ?>
                <button type="button" class="btn btn-primary rounded-pill" onclick="cat_lt(<?php echo $row_ct['id'] ?>,'<?php echo $_GET['id'] ?>')"><?php echo $row_ct['nama'] ?></button>
            <?php
            }
            ?>
        </div>
        <div class="search"></div>
        <div class="category"></div>
        <div class="auto-load">
            <div class="row" style="text-align: center; padding: 10px;">
                <?php
                $x = 0;
                $query = "SELECT * FROM  LT_itinerary2 where landtour !='undefined' && judul like '%" . $_GET['search'] . "%'  order by id ASC";
                $rs = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($rs)) {

                    $query_bn = "SELECT * FROM LT_itinnew where kode='" . $row['landtour'] . "'   && agent_twn !='0' && benua='" . $_GET['id'] . "'    order by agent_twn ASC LIMIT 1";
                    $rs_bn = mysqli_query($con, $query_bn);
                    $row_bn = mysqli_fetch_array($rs_bn);

                    if ($row_bn['agent_twn'] != "") {
                        $x++;

                        $data_twn = array(
                            "kurs" => $row_bn['kurs'],
                            "nominal" => $row_bn['agent_twn'],
                        );
                        $data_sgl = array(
                            "kurs" => $row_bn['kurs'],
                            "nominal" => $row_bn['agent_sgl'],
                        );
                        $data_cnb = array(
                            "kurs" => $row_bn['kurs'],
                            "nominal" => $row_bn['agent_cnb'],
                        );
                        $data_inf = array(
                            "kurs" => $row_bn['kurs'],
                            "nominal" => $row_bn['agent_infant'],
                        );
                        $show_kurs_twn = get_kurs_manual($data_twn);
                        $rs_kurs_twn = json_decode($show_kurs_twn, true);

                        $show_kurs_sgl = get_kurs_manual($data_sgl);
                        $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

                        $show_kurs_cnb = get_kurs_manual($data_cnb);
                        $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

                        $show_kurs_inf = get_kurs_manual($data_inf);
                        $rs_kurs_inf = json_decode($show_kurs_inf, true);
                        // var_dump($data_twn);
                        // var_dump($rs_kurs_twn);

                        $agent_twn = $rs_kurs_twn['data'];
                        $agent_sgl = $rs_kurs_sgl['data'];
                        $agent_cnb = $rs_kurs_cnb['data'];
                        $agent_inf = $rs_kurs_inf['data'];


                        $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
                        $rs_profit = mysqli_query($con, $sql_profit);
                        $row_profit = mysqli_fetch_array($rs_profit);

                        $pr = 0;
                        if ($row_profit['id'] != "") {
                            $pr = $row_profit['profit'];
                        } else {
                            $pr = 5;
                        }
                        $ste = $row_profit['staff_eks'];
                        $nom = $row_profit['nominal'];
                        $atwn = ($agent_twn * $pr / 100) + $agent_twn + $nom;
                        $twn_sp = get_pembulatan($atwn);
                        $twn_rp = json_decode($twn_sp, true);
                        $coret = $twn_rp['value'] + 500000;

                        $pax_u = "";
                        $pax_b = "";
                        if ($row_bn['pax_u'] != 0) {
                            $pax_u = "-" . $row_bn['pax_u'];
                        }
                        if ($row_bn['pax_b'] != 0) {
                            $pax_b = "+" . $row_bn['pax_b'];
                        }
                        $pax_val = $row_bn['pax'] . $pax_u . $pax_b;
                ?>
                        <div class="col-xs-12 col-md-6 col-lg-4" style="padding: 5px 5px;">
                            <a href="<?php  echo $domain_web ?>detail-landtour.php?id=<?php echo $row_bn['id'] ?>&master=<?php echo $row['id'] ?>" class="front-text" style="text-decoration: none; color:black">
                                <div class="thumbnail">
                                    <img src="<?php  echo $domain_web ?>Admin/images/<?php echo $row['gambar1'] ?>" class="img-fluid img-thumbnail2">
                                    <?php
                                    if ($row_bn['statuss'] == 'E') {

                                    ?>
                                        <div class="top-left" style="color: red;">
                                            EXPIRED
                                        </div>
                                    <?php
                                    }

                                    ?>
                                    <div class="card-body-tour">
                                        <div class="judul">
                                            <?php echo $row['judul'] ?>
                                        </div>
                                        <div style="color: gray; font-size: 8pt;">
                                            <?php echo $row_bn['kota'] ?>
                                        </div>
                                        <div style="color: gray; font-size: 8pt;">
                                            <?php echo $row['landtour'] ?> - <?php echo  $row_bn['expired'] ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="color: gray; font-size: 8pt;">
                                                    <?php echo $pax_val . " Pax" ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="text-decoration: line-through; font-size: 9pt; color: darkmagenta; text-align: right;"> <?php echo "IDR " . number_format($coret, 0, ",", ".") ?></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3" style="color: darkgreen;">
                                                <i class="fa fa-building"></i>
                                                <i class="fa fa-bus"></i>
                                                <i class="fa fa-coffee"></i>
                                                <div style="color: gray; font-size: 6pt;">SIC Everyday</div>
                                            </div>
                                            <div class="col-9">
                                                <div class="card-body-price">
                                                    <div style="color: darkgreen;"><?php echo "IDR " . number_format($twn_rp['value'], 0, ",", ".") ?></div>
                                                    <div style="color: gray; font-size: 6pt;">
                                                        Guarantee Departure (Start From 2pax) klik for price
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                    if ($x == '6') {
                        break;
                    }
                }
                ?>
            </div>
        </div>
        <div class="more-landtour"></div>
        <div style="text-align: center; padding: 20px;">
            <input type="hidden" name="val_li" id="val_li" value='6'>
            <button type="button" class="btn btn-outline-success" onclick="fungsi_more('<?php echo $_GET['id'] ?>')">More
                Landtour</button>
        </div>
    </div>
    <script>
        function fungsi_more(x) {
            var li = document.getElementById('val_li').value;
            $.ajax({
                url: "more-landtour.php",
                method: "POST",
                asynch: false,
                data: {
                    id: li,
                    x: x
                },
                success: function(data) {
                    var more = parseInt(li) + 6;
                    document.getElementById("val_li").value = more;
                    $('.more-landtour').html(data);
                }
            });
        }

        function fungsi_cari(x) {
            var cari = document.getElementById('cari').value;
            window.location.href = "<?php  echo $domain_web ?>landtour-content.php?id=Asia&search=" + cari;
            // $.ajax({
            //     url: "search-landtour.php",
            //     method: "POST",
            //     asynch: false,
            //     data: {
            //         cari: cari,
            //         benua: x
            //     },
            //     success: function(data) {
            //         $('.search').html(data);
            //         $('.more-landtour').html('');
            //         $('.auto-load').html('');

            //     }
            // });
        }

        function cat_lt(x, y) {
            $.ajax({
                url: "search-cat-landtour.php",
                method: "POST",
                asynch: false,
                data: {
                    cari: x,
                    benua: y
                },
                success: function(data) {
                    $('.search').html(data);
                    $('.more-landtour').html('');
                    $('.auto-load').html('');

                }
            });
        }

        var input = document.getElementById("cari");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("myBtn").click();
            }
        });
    </script>
</body>
<?php
include "footer.php";
?>

</html>