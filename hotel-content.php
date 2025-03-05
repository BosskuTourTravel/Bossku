<?php
include "db=connection.php";
// include_once "Admin/Api_LT_total_baru.php";

function get_kurs($d)
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

if ($_POST['id'] != "") {
    $query_itin2 = "SELECT * FROM LT_itinnew where id=" . $_POST['id'];
    $rs_itin2 = mysqli_query($con, $query_itin2);
    $row_itin2 = mysqli_fetch_array($rs_itin2);

    $query_itin3 = "SELECT * FROM LT_itinnew where kode='" . $row_itin2['kode'] . "' order by id ASC";
    $rs_itin3 = mysqli_query($con, $query_itin3);
    while ($row_itin3 = mysqli_fetch_array($rs_itin3)) {

        $pax_u = "";
        $pax_b = "";
        if ($row_itin3['pax_u'] != 0) {
            $pax_u = "-" . $row_itin3['pax_u'];
        }
        if ($row_itin3['pax_b'] != 0) {
            $pax_b = "+" . $row_itin3['pax_b'];
        }
        $pax_val = $row_itin3['pax'] . $pax_u . $pax_b;

        $data_twn = array(
            "kurs" => $row_itin3['kurs'],
            "nominal" => $row_itin3['agent_twn'],
        );
        $data_sgl = array(
            "kurs" => $row_itin3['kurs'],
            "nominal" => $row_itin3['agent_sgl'],
        );
        $data_cnb = array(
            "kurs" => $row_itin3['kurs'],
            "nominal" => $row_itin3['agent_cnb'],
        );
        // var_dump($data_twn);
        
        $show_kurs_twn = get_kurs($data_twn);
        $rs_kurs_twn = json_decode($show_kurs_twn, true);

        $show_kurs_sgl = get_kurs($data_sgl);
        $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

        $show_kurs_cnb = get_kurs($data_cnb);
        $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

        $agent_twn = $rs_kurs_twn['data'];
        $agent_sgl = $rs_kurs_sgl['data'];
        $agent_cnb = $rs_kurs_cnb['data'];
        // var_dump($rs_kurs_twn);

        $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" .$agent_twn . "' && price2 >='" . $agent_twn . "'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);
        $pr = 0;
        if ($row_profit['id'] != "") {
            $pr = $row_profit['profit'];
        } else {
            $pr = 5;
        }
        $twin = ($agent_twn * $pr / 100) + $agent_twn;
        $asgl =  ($agent_sgl * $pr / 100) + $agent_sgl;
        $acnb =  ($agent_cnb * $pr / 100) + $agent_cnb ;
        ///pembulatan
        $twn_sp = get_pembulatan($twin);
        $twn_rp = json_decode($twn_sp, true);

        $sgl_sp = get_pembulatan($asgl);
        $sgl_rp = json_decode($sgl_sp, true);

        $cnb_sp = get_pembulatan($acnb);
        $cnb_rp = json_decode($cnb_sp, true);


        $coret = $twn_rp['value'] + 500000;

        if ($row_itin3['agent_twn'] != 0) {
?>
            <div class="card" style="margin: 2px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <input class="form-check-input" type="radio" name="hotel" id="hotel" value="<?php echo $row_itin3['id'] ?>" onclick="room_set(this.value,<?php echo $_POST['master'] ?>,<?php echo $twn_rp['value'] ?>)">
                        </div>
                        <div class="col-md-8">
                            <div style="font-weight: bold; text-decoration: underline;">Hotel Name : </div>
                            <ul>
                                <?php
                                if ($row_itin3['hotel1'] != "") {
                                    echo "<li>" . $row_itin3['hotel1'] . "</li>";
                                }
                                if ($row_itin3['hotel2'] != "") {
                                    echo "<li>" . $row_itin3['hotel2'] . "</li>";
                                }
                                if ($row_itin3['hotel3'] != "") {
                                    echo "<li>" . $row_itin3['hotel3'] . "</li>";
                                }
                                if ($row_itin3['hotel4'] != "") {
                                    echo "<li>" . $row_itin3['hotel4'] . "</li>";
                                }
                                if ($row_itin3['hotel5'] != "") {
                                    echo "<li>" . $row_itin3['hotel5'] . "</li>";
                                }
                                if ($row_itin3['hotel6'] != "") {
                                    echo "<li>" . $row_itin3['hotel6'] . "</li>";
                                }
                                if ($row_itin3['hotel7'] != "") {
                                    echo "<li>" . $row_itin3['hotel7'] . "</li>";
                                }
                                if ($row_itin3['hotel8'] != "") {
                                    echo "<li>" . $row_itin3['hotel8'] . "</li>";
                                }
                                if ($row_itin3['hotel9'] != "") {
                                    echo "<li>" . $row_itin3['hotel9'] . "</li>";
                                }
                                if ($row_itin3['hotel10'] != "") {
                                    echo "<li>" . $row_itin3['hotel10'] . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div><?php echo $pax_val . " Pax" ?></div>
                            <!-- <div style="font-weight: bold;">IDR <?php echo number_format($twn_rp['value'], 0, ",", ".") ?></div> -->
                            <div>
                                <div style="text-decoration: line-through; font-size: 9pt; color: grey; font-weight: bold;"> <?php echo "IDR " . number_format($coret, 0, ",", ".") ?></div>
                                <div style="font-weight: bold;"><?php echo "IDR " . number_format($twn_rp['value'], 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
?>
<script>

    function room_set(x, y, z) {
        var tgl = document.getElementById("tgl").value;
        // var adt = document.getElementById("adt").value;
        // var chd = document.getElementById("inf").value;
        var room = document.getElementById("room").value;
        $.ajax({
            url: "room_content.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                master: y,
                price: z,
                tgl: tgl,
                // adt: adt,
                // chd: chd,
                room:room
            },
            success: function(data) {
                $('.room-set').html(data);
            }
        });
    }
</script>