<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['negara'] != "") {
      $arr_data = explode("-", $_POST['negara']);
      $city = $arr_data[0];
      $trans_type = $arr_data[1];

?>
      <table class="table table-striped table-sm" style="font-size: 14px;">
            <thead>
                  <tr>
                        <th scope="col">No</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Transport Type</th>
                        <th scope="col">Season</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  $query_trans = "SELECT * FROM Transport_new where city LIKE '%" . $city . "%' && trans_type LIKE '%" . $trans_type . "%'  Order by id ASC";
                  $rs_trans = mysqli_query($con, $query_trans);
                  // var_dump($query_trans);


                  $no = 1;
                  // var_dump($query_trans);
                  while ($row_trans = mysqli_fetch_array($rs_trans)) {
                        $query_agent = "SELECT * FROM agent where id='" . $row_trans['agent'] . "'";
                        $rs_agent = mysqli_query($con, $query_agent);
                        $row_agent = mysqli_fetch_array($rs_agent);
                        $dr = $_POST['durasi'];
                        $price = $row_trans[$dr];
                        if ($price != '0') {
                  ?>
                              <tr>
                                    <th style="width: 40px;"><?php echo $no ?></th>
                                    <td><?php echo  $row_agent['company'] ?></td>
                                    <td><?php echo $row_trans['trans_type'] ?></td>
                                    <td><?php echo $row_trans['periode'] ?></td>
                                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                                    <td><?php echo $price ?></td>
                                    <td style="text-align: center;">
                                          <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo $row_trans['id'] ?>,<?php echo $_POST['id'] ?>)">add to list</button>
                                    </td>
                              </tr>

                  <?php
                              $no++;
                        }
                  }
                  ?>
            </tbody>
      </table>
<?php
}
