<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "site.php";
include "navbar.php";
include "db=connection.php"; // Perbaikan nama file
include "slug.php"; // Perbaikan nama file

function get_kurs_manual($d)
{
    include "db=connection.php"; // Perbaikan nama file
    $kurs = $d['kurs'];
    $nominal = $d['nominal'];
    $query = "SELECT * FROM kurs_bca_field WHERE nama = '" . mysqli_real_escape_string($con, $kurs) . "' ORDER BY id ASC"; // Perbaikan query
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);
    if (empty($row['id'])) {
        return json_encode(array("status" => "data Kurs tidak Tersedia", "data" => '0'), true);
    } else {
        if ($kurs == "IDR") {
            return json_encode(array("status" => "kurs sama", "data" => $nominal), true);
        } else {
            if ($nominal == '0') {
                return json_encode(array("status" => "nominal 0", "data" => $nominal), true);
            } else {
                $price = $nominal * $row['jual'];
                return json_encode(array("status" => "success", "data" => $price), true);
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
    <div class="container mx-auto px-4 py-16 mt-10">
        <!-- Title -->
        <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb-2">Paket Land Tour</h1>
        <h2 class="text-3xl font-bold tracking-wide text-center">Jelajahi Destinasi Menarik Bersama Kami</h2>
        <p class="font-medium text-sm tracking-wide text-center text-gray-500">Temukan paket wisata menarik di berbagai belahan dunia.</p>

        <!-- card -->
        <nav aria-label="breadcrumb" class="p-4 rounded-lg mx-auto mt-10">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 px-2 md:px-0">
                <div>
                    <ol class="breadcrumb flex space-x-2 text-sm text-gray-600">
                        <li class="breadcrumb-item">Land Tour</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <?php echo htmlspecialchars($_GET['id']); ?>
                        </li>
                    </ol>
                </div>
                <div class="w-full md:w-auto">
                    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2 w-full">
                        <input type="text" class="form-input border-gray-300 bg-gray-100 rounded-md shadow-sm w-full py-2 px-4 text-sm" placeholder="Search...." id="cari" value="<?php echo !empty($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button id="myBtn" class="btn bg-[#FFCA10] text-black px-4 py-2 rounded-md hover:bg-blue-600 text-sm font-semibold" type="button" onclick="fungsi_cari('<?php echo htmlspecialchars($_GET['id']); ?>')">Cari</button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="p-4 flex flex-wrap gap-2 justify-center">
        <?php
        $query_ct = "SELECT * FROM LT_Category ORDER BY id ASC";
        $rs_ct = mysqli_query($con, $query_ct);
        while ($row_ct = mysqli_fetch_array($rs_ct)) {
        ?>
            <button type="button" class="btn bg-[#02335B] font-semibold text-white px-4 py-1 rounded-full hover:bg-[#FFCA10] hover:text-[#02335B] transition text-sm md:text-base" onclick="cat_lt(<?php echo $row_ct['id']; ?>,'<?php echo htmlspecialchars($_GET['id']); ?>')"><?php echo htmlspecialchars($row_ct['nama']); ?></button>
        <?php
        }
        ?>
    </div>
    <div class="search"></div>
    <div class="category"></div>
    <div class="auto-load">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-center p-4">
            <?php
            $x = 0;
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $query = "SELECT * FROM LT_itinerary2 WHERE landtour !='undefined' AND judul LIKE '%" . mysqli_real_escape_string($con, $search) . "%' ORDER BY id ASC";
            $rs = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($rs)) {
                $query_bn = "SELECT * FROM LT_itinnew WHERE kode='" . mysqli_real_escape_string($con, $row['landtour']) . "' AND agent_twn !='0' AND benua='" . mysqli_real_escape_string($con, $_GET['id']) . "' ORDER BY agent_twn ASC LIMIT 1";
                $rs_bn = mysqli_query($con, $query_bn);
                $row_bn = mysqli_fetch_array($rs_bn);

                if ($row_bn && isset($row_bn['agent_twn']) && $row_bn['agent_twn'] != "") {
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

                    $agent_twn = $rs_kurs_twn['data'];
                    $agent_sgl = $rs_kurs_sgl['data'];
                    $agent_cnb = $rs_kurs_cnb['data'];
                    $agent_inf = $rs_kurs_inf['data'];

                    $sql_profit = "SELECT * FROM LT_itin_profit_range_bossku WHERE price1 <= '" . $agent_twn . "' AND price2 >= '" . $agent_twn . "'";
                    $rs_profit = mysqli_query($con, $sql_profit);
                    $row_profit = mysqli_fetch_array($rs_profit);

                    $pr = 0;
                    if (!empty($row_profit['id'])) {
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
                    <a href="<?php echo $domain_web; ?>detail-landtour.php?id=<?php echo $row_bn['id']; ?>&master=<?php echo $row['id']; ?>" class="block text-black no-underline">
                        <div class="thumbnail bg-white shadow-md rounded-lg overflow-hidden h-full flex flex-col">
                            <img src="<?php echo $domain_web; ?>Admin/images/<?php echo htmlspecialchars($row['gambar1']); ?>" class="w-full h-48 object-cover aspect-square">
                            <?php
                            if ($row_bn['statuss'] == 'E') {
                            ?>
                                <div class="absolute top-2 left-2 text-red-500 font-bold">EXPIRED</div>
                            <?php
                            }
                            ?>
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="font-bold text-lg"><?php echo htmlspecialchars($row['judul']); ?></div>
                                    <div class="text-gray-500 text-xs"><?php echo htmlspecialchars($row_bn['kota']); ?></div>
                                    <div class="text-gray-500 text-sm"><?php echo htmlspecialchars($row['landtour']) . " - " . htmlspecialchars($row_bn['expired']); ?></div>
                                </div>
                                <div class="mt-2">
                                    <div class="flex justify-between items-center">
                                        <div class="text-gray-500 text-sm"><?php echo $pax_val . " Pax"; ?></div>
                                        <div class="line-through text-purple-600 text-sm"><?php echo "IDR " . number_format($coret, 0, ",", "."); ?></div>
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <div class="text-green-600">
                                            <i class="fa fa-building"></i>
                                            <i class="fa fa-bus"></i>
                                            <i class="fa fa-coffee"></i>
                                            <div class="text-gray-500 text-xs">SIC Everyday</div>
                                        </div>
                                        <div class="ml-auto text-right">
                                            <div class="text-green-600 font-bold"><?php echo "IDR " . number_format($twn_rp['value'], 0, ",", "."); ?></div>
                                            <div class="text-gray-500 text-xs">Guarantee Departure (Start From 2pax) klik for price</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
    </div>
    <script>
        function fungsi_more(x) {
            var li = document.getElementById('val_li').value;
            $.ajax({
                url: "more-landtour.php",
                method: "POST",
                async: false,
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
            window.location.href = "<?php echo $domain_web; ?>landtour-content.php?id=" + encodeURIComponent(x) + "&search=" + encodeURIComponent(cari);
        }

        function cat_lt(x, y) {
            $.ajax({
                url: "search-cat-landtour.php",
                method: "POST",
                async: false,
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