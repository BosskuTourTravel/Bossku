<?php
include "../site.php";
include "../db=connection.php";

//export.php  
?>
<table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
      <thead>
            <tr>
                  <th>#</th>
                  <th>ID GROUP</th>
                  <th>MASKAPAI</th>
                  <th>IN / OUT</th>
                  <th>TRIP</th>
                  <th>TYPE</th>
                  <th>Season</th>
                  <th>TGL</th>
                  <th>CODE</th>
                  <th>DEPT ARR</th>
                  <th>ETD ETA</th>
                  <th>TRANSIT</th>
                  <th>ADT</th>
                  <th>CHD</th>
                  <th>INF</th>
                  <th>BAGASI</th>
                  <th>BF</th>
                  <th>LN</th>
                  <th>DN</th>

            </tr>
      </thead>
      <tbody>
            <?php
            if ($_POST['city_in'] == "" && $_POST['city_out'] != "") {

                  $query_route_id = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_out='" . $_POST['city_out'] . "'  order by city_in ASC, city_out ASC";
            } else if ($_POST['city_in'] != "" && $_POST['city_out'] == "") {
                  $query_route_id = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_in='" . $_POST['city_in'] . "'  order by city_in ASC, city_out ASC";
            } else if ($_POST['city_in'] != "" && $_POST['city_out'] != "") {
                  $query_route_id = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_in='" . $_POST['city_in'] . "' && city_out='" . $_POST['city_out'] . "'  order by city_in ASC, city_out ASC";
            } else {
                  $query_route_id = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' order by city_in ASC, city_out ASC";
            }
            // $query_route_id = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "'  order by city_in ASC, city_out ASC";
            $rs_route_id = mysqli_query($con, $query_route_id);
            // var_dump($query_route_id);
            while ($row_route_id = mysqli_fetch_array($rs_route_id)) {

                  $query = "SELECT * FROM  LTP_route_detail where route_id='" . $row_route_id['id'] . "' order by type ASC, id ASC ";
                  $rs = mysqli_query($con, $query);
                  $no = 1;
                  $grub_id = 0;
                  while ($row = mysqli_fetch_array($rs)) {

                        $query_type = "SELECT nama FROM LTP_type_flight where id=" . $row['type'];
                        $rs_type = mysqli_query($con, $query_type);
                        $row_type = mysqli_fetch_array($rs_type);

                        $query_flight_logo2 = "SELECT * FROM  LT_flight_logo where kode='" .  $row_route_id['maskapai'] . "'";
                        $rs_flight_logo2 = mysqli_query($con, $query_flight_logo2);
                        $row_flight_logo2 = mysqli_fetch_array($rs_flight_logo2);

                        if ($row_route_id['maskapai'] != "") {
                              if ($row['id_grub'] != $grub_id) {
            ?>
                                    <tr>
                                          <td>
                                                <input type="checkbox" id="chck" name="chck" value="<?php echo $row['id_grub'] ?>">
                                          </td>
                                          <td>
                                                <?php echo $row['id_grub'] ?>
                                          </td>
                                          <td><?php echo $row_flight_logo2['nama'] ?></td>
                                          <td style="color: darkgreen;"><?php echo $row_route_id['city_in'] . " - " . $row_route_id['city_out'] ?></td>
                                          <td><?php echo $row_type['nama'] ?></td>
                                          <td><?php echo $row['rute'] ?></td>
                                          <td><?php echo $row['musim'] ?></td>
                                          <td><?php echo $row['tgl'] ?></td>
                                          <td><?php echo $row['maskapai'] ?></td>
                                          <td><?php echo $row['dept'] . "-" . $row['arr'] ?></td>
                                          <td style="max-width: 90px;"><?php echo $row['take'] . "-" . $row['landing'] ?></td>
                                          <td><?php echo $row['transit'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['chd'] ?></td>
                                          <td><?php echo $row['inf'] ?></td>
                                          <td><?php echo $row['bagasi'] ?></td>
                                          <td><?php echo $row['bf'] ?></td>
                                          <td><?php echo $row['ln'] ?></td>
                                          <td><?php echo $row['dn'] ?></td>
                                    </tr>
                              <?php
                              } else {
                              ?>
                                    <tr>
                                          <td></td>
                                          <td><?php echo $row['id_grub'] ?></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><?php echo $row['tgl'] ?></td>
                                          <td><?php echo $row['maskapai'] ?></td>
                                          <td><?php echo $row['dept'] . "-" . $row['arr'] ?></td>
                                          <td style="max-width: 90px;"><?php echo $row['take'] . "-" . $row['landing'] ?></td>
                                          <td><?php echo $row['transit'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>
                                          <td><?php echo $row['adt'] ?></td>

                                    </tr>
                              <?php
                              }
                              ?>

                              <?php
                              if ($row['id_grub'] != $grub_id) {
                                    $grub_id = $row['id_grub'];
                              }
                        }
                  }
            }
            // flight kepulangan
            // if ($_POST['city_in'] != "" && $_POST['city_out'] != "") {

            // jika in out null flight kepulangan tidak tampil
            if ($_POST['city_in'] != "" && $_POST['city_out'] == "") {
                  $query_route_id_back = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_out='" . $_POST['city_in'] . "'  order by city_in ASC, city_out ASC";
            } else if ($_POST['city_in'] == "" && $_POST['city_out'] != "") {
                  $query_route_id_back = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_in='" . $_POST['city_out'] . "'  order by city_in ASC, city_out ASC";
            } else if ($_POST['city_in'] != "" && $_POST['city_out'] != "") {
                  $query_route_id_back = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_in='" . $_POST['city_out'] . "' && city_out='" . $_POST['city_in'] . "'  order by city_in ASC, city_out ASC";
            } else {
                  // $query_route_id_back = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "'   order by city_in ASC, city_out ASC";
                  $query_route_id_back ="";
            }
            // var_dump($query_route_id_back);

            // $query_route_id_back = "SELECT * FROM LTP_add_route where maskapai='" . $_POST['maskapai'] . "' && city_in='" . $_POST['city_out'] . "' && city_out='" . $_POST['city_in'] . "'  order by city_in ASC, city_out ASC";
            $rs_route_id_back = mysqli_query($con, $query_route_id_back);
            while ($row_route_id_back = mysqli_fetch_array($rs_route_id_back)) {
                  $query_back = "SELECT * FROM  LTP_route_detail where route_id='" . $row_route_id_back['id'] . "' order by type ASC, id ASC ";
                  $rs_back = mysqli_query($con, $query_back);
                  $no_back = 1;
                  $grub_id_back = 0;
                  while ($row_back = mysqli_fetch_array($rs_back)) {
                        $query_type_back = "SELECT nama FROM LTP_type_flight where id=" . $row_back['type'];
                        $rs_type_back = mysqli_query($con, $query_type_back);
                        $row_type_back = mysqli_fetch_array($rs_type_back);

                        $query_flight_logo3 = "SELECT * FROM  LT_flight_logo where kode='" .  $row_route_id_back['maskapai'] . "'";
                        $rs_flight_logo3 = mysqli_query($con, $query_flight_logo3);
                        $row_flight_logo3 = mysqli_fetch_array($rs_flight_logo3);

                        if ($row_route_id_back['maskapai'] != "") {
                              if ($row_back['id_grub'] != $grub_id_back) {
                              ?>
                                    <tr>
                                          <td>
                                                <input type="checkbox" id="chck" name="chck" value="<?php echo $row_back['id_grub'] ?>">
                                          </td>
                                          <td>
                                                <?php echo $row_back['id_grub'] ?>
                                          </td>
                                          <td><?php echo $row_flight_logo3['nama'] ?></td>
                                          <td style="color: darkred;"><?php echo $row_route_id_back['city_in'] . " - " . $row_route_id_back['city_out'] ?></td>
                                          <td><?php echo $row_type_back['nama'] ?></td>
                                          <td><?php echo $row_back['rute'] ?></td>
                                          <td><?php echo $row_back['musim'] ?></td>
                                          <td><?php echo $row_back['tgl'] ?></td>
                                          <td><?php echo $row_back['maskapai'] ?></td>
                                          <td><?php echo $row_back['dept'] . "-" . $row_back['arr'] ?></td>
                                          <td style="max-width: 90px;"><?php echo $row_back['take'] . "-" . $row_back['landing'] ?></td>
                                          <td><?php echo $row_back['transit'] ?></td>
                                          <td><?php echo $row_back['adt'] ?></td>
                                          <td><?php echo $row_back['chd'] ?></td>
                                          <td><?php echo $row_back['inf'] ?></td>
                                          <td><?php echo $row_back['bagasi'] ?></td>
                                          <td><?php echo $row_back['bf'] ?></td>
                                          <td><?php echo $row_back['ln'] ?></td>
                                          <td><?php echo $row_back['dn'] ?></td>
                                    </tr>
                              <?php
                              } else {
                              ?>
                                    <tr>
                                          <td></td>
                                          <td><?php echo $row_back['id_grub'] ?></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><?php echo $row_back['tgl'] ?></td>
                                          <td><?php echo $row['maskapai'] ?></td>
                                          <td><?php echo $row_back['dept'] . "-" . $row_back['arr'] ?></td>
                                          <td style="max-width: 90px;"><?php echo $row_back['take'] . "-" . $row_back['landing'] ?></td>
                                          <td><?php echo $row_back['transit'] ?></td>
                                          <td><?php echo $row_back['adt'] ?></td>
                                          <td><?php echo $row_back['chd'] ?></td>
                                          <td><?php echo $row_back['inf'] ?></td>
                                          <td><?php echo $row_back['bagasi'] ?></td>
                                          <td><?php echo $row_back['bf'] ?></td>
                                          <td><?php echo $row_back['ln'] ?></td>
                                          <td><?php echo $row_back['dn'] ?></td>

                                    </tr>
                              <?php
                              }
                              ?>

            <?php
                              if ($row_back['id_grub'] != $grub_id_back) {
                                    $grub_id_back = $row_back['id_grub'];
                              }
                        }
                  }
            }

            /// end cek kepulangan in out
            // }

            ?>
      </tbody>
</table>