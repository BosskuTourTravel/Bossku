<style>
    .table-container {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .table thead {
        background-color: #007bff;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }

    .btn {
        border-radius: 5px;
        font-size: 10pt;
        padding: 5px 10px;
    }
</style>

<div class="table-container">
    <div class="table-title">LANDTOUR PRICE LIST</div>
    <div class="table-responsive">
        <table id="tb-lt-web" class="table table-hover table-bordered table-sm" style="width:100%; font-size: 10pt;">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th style="max-width: 420px;">Nama Paket</th>
                    <th class="text-center">Pax</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = "SELECT LT_itinerary2.id as tour_id,LT_itinerary2.judul,LT_itinerary2.landtour,LT_itinerary2.hari,LT_itinerary2.status, itin.*,LT_add_Category.category,login_staff.name as staff_name,login_staff.phone FROM ( SELECT * FROM LT_itinnew where LT_itinnew.agent_twn !='0' && LT_itinnew.statuss !='E' GROUP by LT_itinnew.kode ) AS itin INNER JOIN LT_itinerary2 ON itin.kode = LT_itinerary2.landtour LEFT JOIN LT_add_Category ON LT_itinerary2.id = LT_add_Category.tour_id INNER JOIN login_staff ON LT_itinerary2.status=login_staff.id where LT_itinerary2.landtour !='undefined' order by itin.benua , itin.negara ASC";
                $rs = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($rs)) {

                    $url_encode = urldecode("Haii " . $row['staff_name'] . ", Saya ingin Memesan LandTour : ".$domain_web."cetak_all_LTnew.php?id=" . $row['id']);
                    $data_twn = array(
                        "kurs" => $row['kurs'],
                        "nominal" => $row['agent_twn'],
                    );

                    $show_kurs_twn = get_kurs($data_twn);
                    $rs_kurs_twn = json_decode($show_kurs_twn, true);
                    $agent_twn = $rs_kurs_twn['data'];


                    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
                    $rs_profit = mysqli_query($con, $sql_profit);
                    $row_profit = mysqli_fetch_array($rs_profit);

                    $pr = 0;
                    if (isset($row_profit['id'])) {
                        $pr = $row_profit['profit'];
                    } else {
                        $pr = 5;
                    }
                    $twin = ($agent_twn * $pr / 100) + $agent_twn;
                    $twn_sp = get_pembulatan($twin);
                    $twn_rp = json_decode($twn_sp, true);


                ?>
                    <tr>
                        <td class="text-center"><?php echo $no ?></td>
                        <td>
                            <div><?php echo $row['judul'] ?></div>
                            <div class="text-muted" style="font-size: 9pt;"><?php echo $row['landtour'] ?></div>
                        </td>
                        <td class="text-center"><?php echo $row['pax'] . ($row['pax_u'] != 0 ? "-" . $row['pax_u'] : "") . ($row['pax_b'] != 0 ? "+" . $row['pax_b'] : "") ?></td>
                        <td class="text-center">Rp. <?php echo number_format($twn_rp['value'], 0, ",", ".") ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning btn-sm my-1" href="<?php echo $domain_web ?>Admin/cetak_all_LTnew.php?id=<?php echo $row['tour_id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                            <a class="btn btn-success btn-sm my-1" href="https://wa.me/<?php echo $row['phone'] . '?text=' . $url_encode ?>" target="_BLANK"><i class="fa fa-whatsapp"></i> WhatsApp</a>
                            <a class="btn btn-primary btn-sm my-1" href="<?php echo $domain_web ?>detail-landtour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>"><i class="fa fa-info-circle"></i> Detail</a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tb-lt-web').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 10,
            "bDestroy": true
        });
    });
</script>