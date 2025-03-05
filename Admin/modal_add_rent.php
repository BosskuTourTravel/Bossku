<?php
include "../db=connection.php";
// $query = "SELECT * FROM  LT_itinerary2 where id =" . $_POST['id'];
// $rs = mysqli_query($con, $query);
// $row = mysqli_fetch_array($rs);
// $hari = $row['hari'];

?>
<div class="row" style="padding: 10px 15px; justify-content: space-around;">
    <div class="col-md-10">
        <div class="form-group">
            <input class="form-control form-control-sm" list="negara_list" name="negara" id="negara" autocomplete="off" placeholder="Country - City - Transport Type">
            <datalist id="negara_list">
                <?php
                $query_negara = "SELECT Transport_new.id, Transport_new.city,Transport_new.country, Transport_new.trans_type,agent_transport.company FROM Transport_new LEFT JOIN agent_transport ON agent_transport.id=Transport_new.agent ORDER BY Transport_new.city , Transport_new.trans_type ASC";
                $rs_negara = mysqli_query($con, $query_negara);
                while ($val = mysqli_fetch_array($rs_negara)) {
                ?>
                    <option data-id="<?php echo $val['id']  ?>" value="<?php echo  $val['trans_type'] . " " . $val['city'] . " ," . $val['country'] ?>" label="<?php echo $val['id'] ?>"></option>
                <?php
                }
                ?>
            </datalist>
        </div>
    </div>
    <div class="col-md-2" style="text-align: right; margin: auto;">
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-sm" onclick="fungsi_search(<?php echo $_POST['id'] ?>)">SEARCH</button>
        </div>
    </div>
    <div class="content-val" style="padding: 10px 15px"></div>
    <!-- <div class="rent-val alert alert-success" style="padding: 10px 15px"></div> -->
</div>
<script>
    function fungsi_search(x) {
        var value = $("#negara_list option[value='" + $('#negara').val() + "']").attr('data-id');
        //  alert(x);
        $.ajax({
            url: "get_rent_trans.php",
            method: "POST",
            asynch: false,
            data: {
                value: value,
                id:x
            },
            success: function(data) {
                $('.content-val').html(data);
            }
        });
    }

function add_list(x,y,z){
    // alert(y);
    $.ajax({
            url: "get_selected_rent.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                tipe:z,
                pack_id:y
            },
            success: function(data) {
                // $('.rent-val').html(data);
                alert(data);
            }
        });
}
</script>