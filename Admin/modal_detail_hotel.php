<div>
    <?php
    session_start();
    include "../db=connection.php";
    include "Api_get_hotel_lt_range.php";

    $query_hotel_data = "SELECT * FROM LAN_Hotel_List WHERE master_id='" . $_POST['id'] . "' && status='".$_POST['hotel']."'";
    $rs_hotel_data = mysqli_query($con, $query_hotel_data);
    ?>
    <table id="example_hotel" class="table table-striped table-bordered table-sm" style="font-size: 10pt; text-align: left;">
        <thead style="background-color: darkgreen; color: white;">
            <tr>
                <th>No</th>
                <th>Nama Hotel</th>
                <th>Harga</th>
                <th>Hari ke- </th>
                <th>Urutan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $gt = 0;
            $price = 0;
            $gt_price = 0;
            while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
                $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
                $rs_hlt = mysqli_query($con, $query_hlt);
                $row_hlt = mysqli_fetch_array($rs_hlt);

                if ($row_hotel_data['rate'] == '1') {
                    $data = array(
                        "kurs" =>  $row_hlt['kurs'],
                        "price" => $row_hlt['rate_low'],
                    );
                    $show_rate2 = get_rate($data);
                    $result_rate2 = json_decode($show_rate2, true);

                    $gt = $gt + $result_rate2['price'];
                    $price = $result_rate2['price'];
                } else {
                    $data = array(
                        "kurs" =>  $row_hlt['kurs'],
                        "price" => $row_hlt['rate_high'],
                    );
                    $show_rate2 = get_rate($data);
                    $result_rate2 = json_decode($show_rate2, true);

                    $gt = $gt + $result_rate2['price'];
                    $price = $result_rate2['price'];
                }
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td>
                        <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_hlt['name'] ?></div>
                        <div><?php echo $row_hlt['country'] . " ," . $row_hlt['city'] ?></div>
                        <div style="font-size: 8pt;"><?php echo "Inclusive : " . $row_hlt['inclusive'] ?></div>

                    </td>
                    <td>
                        <div style="font-weight: bold; text-decoration: underline;">
                            <?php
                            if ($row_hotel_data['rate'] == '1') {
                                echo "Low Rate";
                            } else {
                                echo "High Rate";
                            }
                            ?>
                        </div>
                        <div>
                            <?php echo "IDR " . number_format($price, 0, ",", ".") ?>
                        </div>
                    </td>
                    <td><?php echo $row_hotel_data['hari'] ?></td>
                    <td><?php echo $row_hotel_data['urutan'] ?></td>
                </tr>
            <?php
                $no++;
                $gt_price += $price;
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>TOTAL</th>
                <th>IDR <?php echo number_format($gt_price)?></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</div>