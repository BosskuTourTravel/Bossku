<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "get_price_selected_hotel.php";

$query = "SELECT LT_itinerary2.id,LT_itinerary2.judul,LT_itinerary2.landtour,LT_itinnew.id AS code_id,LT_itinnew.no_urut,LT_itinnew.kurs,LT_itinnew.pax,LT_itinnew.pax_u,LT_itinnew.pax_b,LT_itinnew.agent_twn,LT_itinnew.agent_sgl,LT_itinnew.agent_cnb,LT_itinnew.agent_infant,LT_itinnew.hotel1,LT_itinnew.hotel2,LT_itinnew.hotel3,LT_itinnew.hotel4,LT_itinnew.hotel5,LT_itinnew.hotel6,LT_itinnew.hotel7,LT_itinnew.hotel8,LT_itinnew.hotel9,LT_itinnew.hotel10 FROM LT_itinerary2 INNER JOIN LT_itinnew ON LT_itinerary2.landtour=LT_itinnew.kode WHERE LT_itinnew.statuss='U' && LT_itinerary2.id='" . $_POST['id'] . "' ORDER BY LT_itinnew.no_urut ASC";
$rs = mysqli_query($con, $query);

$query_rent = "SELECT Package_rent.*,login_staff.name as staff FROM Package_rent LEFT JOIN login_staff ON Package_rent.staff=login_staff.id where master_id='" . $_POST['id'] . "' order by id ASC";
$rs_rent = mysqli_query($con, $query_rent);

$query_judul = "SELECT * FROM LT_itinerary2 where id=" . $_POST['id'];
$rs_judul = mysqli_query($con, $query_judul);
$row_judul = mysqli_fetch_array($rs_judul);
?>
<div class="container">
    <div class="d-flex justify-content-center text-bold align-items-center p-2 h4"><?php echo $row_judul['landtour'] . " " . $row_judul['judul'] ?></div>
    <div class="d-flex justify-content-end gap-1">
        <div class="form-check m-2">
            <input class="form-check-input" type="checkbox" value="" id="hotel" checked disabled>
            <label class="form-check-label" for="hotel">
                Hotel For Landtour
            </label>
        </div>
        <div class="form-check m-2">
            <input class="form-check-input" type="checkbox" value="" id="landtrans" disabled>
            <label class="form-check-label" for="landtrans">
                Landtrans
            </label>
        </div>
        <div class="form-check m-2">
            <input class="form-check-input" type="checkbox" value="" id="guide" disabled>
            <label class="form-check-label" for="guide">
                Fee Guide
            </label>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-1 m-2">
        <div class="row">
            <div class="col">
                <select class="form-control form-control-sm" id="guest_hotel">
                    <option selected value="0">Select Hotel Package</option>
                    <?php
                    $query_hh = "SELECT Hotel_Package.*,LAN_Hotel_List.hotel_id,LAN_Hotel_List.rate FROM Hotel_Package LEFT JOIN LAN_Hotel_List ON Hotel_Package.id=LAN_Hotel_List.status  WHERE Hotel_Package.master_id='" . $_POST['id'] . "' GROUP BY Hotel_Package.id order by Hotel_Package.nama ASC";
                    $rs_hh = mysqli_query($con, $query_hh);
                    while ($row_hh = mysqli_fetch_array($rs_hh)) {
                        $show_hotel_price = get_price_selected_hotel($row_hh['id']);
                        $rs_hotel_price = json_decode($show_hotel_price, true);

                    ?>
                        <option value="<?php echo $row_hh['id'] ?>"><?php echo $row_hh['nama'] . " || IDR " . number_format($rs_hotel_price['price']) ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-control form-control-sm" id="guest_rent">
                    <option selected value="0">Select Rent Package</option>
                    <?php
                    while ($row_rent = mysqli_fetch_array($rs_rent)) {
                    ?>
                        <option value="<?php echo $row_rent['id'] ?>"><?php echo $row_rent['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-control form-control-sm" id="pilihan" name="pilihan">
                    <option value="0">Without Guide</option>
                    <option value="1">1 Guide</option>
                    <option value="2">2 Guide</option>
                    <option value="3">3 Guide</option>
                    <option value="4">4 Guide</option>
                    <option value="5">5 Guide</option>
                </select>
            </div>
            <div class="col">
                <select class="form-control form-control-sm" id="foc" name="foc">
                    <option value="0">Without FOC</option>
                    <option value="1">1 FOC</option>
                    <option value="2">2 FOC</option>
                    <option value="3">3 FOC</option>
                    <option value="4">4 FOC</option>
                    <option value="5">5 FOC</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary btn-sm" onclick="add_compare(<?php echo $_POST['id'] ?>)">
                Compare
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-sm small" id="price-lt" style="width: 100%;">
                <thead class="bg-primary">
                    <tr>
                        <td scope="col">#</td>
                        <th scope="col">HOTEL</th>
                        <th scope="col">Pax</th>
                        <th scope="col">TWN</th>
                        <th scope="col">SGL</th>
                        <th scope="col">CNB</th>
                        <th scope="col">INF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($rs)) {
                        $hotel = "";
                        for ($i = 1; $i <= 10; $i++) {
                            $dump = "hotel" . $i;
                            if ($row[$dump] !== "") {
                                $hotel .= $row[$dump] . " || ";
                            }
                        }

                        $data_twn = array(
                            "kurs" => $row['kurs'],
                            "nominal" => $row['agent_twn'],
                        );
                        $data_sgl = array(
                            "kurs" => $row['kurs'],
                            "nominal" => $row['agent_sgl'],
                        );
                        $data_cnb = array(
                            "kurs" => $row['kurs'],
                            "nominal" => $row['agent_cnb'],
                        );
                        $data_inf = array(
                            "kurs" => $row['kurs'],
                            "nominal" => $row['agent_infant'],
                        );


                        $show_kurs_twn = get_kurs($data_twn);
                        $rs_kurs_twn = json_decode($show_kurs_twn, true);

                        $show_kurs_sgl = get_kurs($data_sgl);
                        $rs_kurs_sgl = json_decode($show_kurs_sgl, true);

                        $show_kurs_cnb = get_kurs($data_cnb);
                        $rs_kurs_cnb = json_decode($show_kurs_cnb, true);

                        $show_kurs_inf = get_kurs($data_inf);
                        $rs_kurs_inf = json_decode($show_kurs_inf, true);

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
                        $twin = ($agent_twn * $pr / 100) + $agent_twn;
                        $chd = ($agent_cnb * $pr / 100) + $agent_cnb;
                        $inf = ($agent_inf * $pr / 100) + $agent_inf;
                        $sgl = ($agent_sgl * $pr / 100) + $agent_sgl;

                        $twn_sp = get_pembulatan($twin);
                        $twn_rp = json_decode($twn_sp, true);

                        $sgl_sp = get_pembulatan($sgl);
                        $sgl_rp = json_decode($sgl_sp, true);

                        $cnb_sp = get_pembulatan($chd);
                        $cnb_rp = json_decode($cnb_sp, true);

                        $inf_sp = get_pembulatan($inf);
                        $inf_rp = json_decode($inf_sp, true);


                        $bonus = number_format($row['pax_b']);
                        $pax = "";
                        $pax .= $row['pax'];
                        if ($row['pax_u'] != '0') {
                            $pax = " - " . $row['pax_u'];
                        }
                        if ($bonus != 0) {
                            $pax .= " + " . $bonus;
                        }
                    ?>
                        <tr>
                            <td><?php echo $row['no_urut'] ?></td>
                            <td style="width: 290px;"><?php echo $hotel ?></td>
                            <td><?php echo $pax ?></td>
                            <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                            <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                        </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>
        <div class="col-12 compare-table">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#price-lt').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });

    });

    function add_compare(x) {
        var hotel = document.getElementById("guest_hotel").value;
        var rent = document.getElementById("guest_rent").value;
        var guide = document.getElementById("pilihan").value;
        var foc = document.getElementById("foc").value;
        $.ajax({
            url: "compare_table.php",
            method: "POST",
            asynch: false,
            data: {
                tourid: x,
                hotel: hotel,
                rent: rent,
                guide: guide,
                foc: foc
            },
            success: function(data) {
                $('.compare-table').html(data);
            }
        });
    }
</script>