<?php
include "../site.php";
include "../db=connection.php";
include "Api_get_hotel_lt_range.php";
//export.php  
if (isset($_POST['id'])) {
      $query_dh = "SELECT * FROM hotel_lt where id='" . $_POST['id'] . "'";
      $rs_dh = mysqli_query($con, $query_dh);
      $row_dh = mysqli_fetch_array($rs_dh);

      $query_hotel_detail2 = "SELECT * FROM hotel_lt where country='" . $row_dh['country'] . "' && city='" . $row_dh['city'] . "' && name='" . $row_dh['name'] . "' Order by id ASC";
      $rs_hotel_detail2 = mysqli_query($con, $query_hotel_detail2);
      while ($row_hotel_detail2 = mysqli_fetch_array($rs_hotel_detail2)) {
            $datareq = array(
                  "kurs" =>  $row_hotel_detail2['kurs'],
                  "price" => $row_hotel_detail2['rate_low'],
              );
              $datareq_high = array(
                  "kurs" =>  $row_hotel_detail2['kurs'],
                  "price" => $row_hotel_detail2['rate_high'],
              );

            $show_rate = get_rate($datareq);
            $result_rate = json_decode($show_rate, true);

            $show_rate_h = get_rate($datareq_high);
            $result_rate_h = json_decode($show_rate_h, true);

?>
            <a data-toggle="modal" data-target="#modal_card" data-id="<?php echo $row_hotel_detail2['id']  ?>" style="text-decoration: none; color: black;">
                  <div class="card" id="hotel_card<?php echo $row_hotel_detail2['id'] ?>">
                        <div class="card-body">
                              <div class="row">
                                    <div class="col-md-8">
                                          <div class="row">
                                                <div class="col"><b><?php echo $row_hotel_detail2['type'] . " (" . $row_hotel_detail2['occ'] . ")"  ?></b></div>
                                                <div class="col" style="text-align: center;">
                                                      <div><b>Quote</b></div>
                                                      <div><?php echo $row_hotel_detail2['quote']  ?></div>
                                                </div>
                                                <div class="col" style="text-align: center;">
                                                      <div><b>Inclusive</b></div>
                                                      <div><?php echo $row_hotel_detail2['inclusive']  ?></div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="row" style="text-align: center;">
                                                <div class="col">
                                                      <div style="font-weight: bold;">Low Rate</div>
                                                      <div><span class="badge badge-warning"><?php echo number_format($result_rate['price'], 0, ",", ".")  ?></span></div>
                                                </div>
                                                <div class="col">
                                                      <div style="font-weight: bold;">High Rate</div>
                                                      <div><span class="badge badge-danger"><?php echo number_format($result_rate_h['price'], 0, ",", ".")   ?></span></div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </a>
      <?php
      }

      ?>
      <div class="modal fade" id="modal_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Hotel Rate</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
                              <div class="modal-data"></div>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" onclick="add_rate(1,<?php echo $_POST['id'] ?>)" >Low Rate</button>
                              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="add_rate(2,<?php echo $_POST['id']  ?>)">High Rate</button>
                        </div>
                  </div>
            </div>
      </div>
      <script>
            $(document).ready(function() {
                  $('#modal_card').on('show.bs.modal', function(e) {
                        var id = $(e.relatedTarget).data('id');
                        $.ajax({
                              url: "modal_hotel_rate.php",
                              method: "POST",
                              asynch: false,
                              data: {
                                    id: id,
                              },
                              success: function(data) {
                                    $('.modal-data').html(data);
                              }
                        });
                  });
            });
      </script>
<?php
}
?>