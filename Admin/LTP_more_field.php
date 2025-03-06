<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $query_in = "SELECT DISTINCT city_in FROM LTP_add_route order by city_in ASC";
    $rs_in = mysqli_query($con, $query_in);

    $query_out = "SELECT DISTINCT city_out FROM LTP_add_route order by city_out ASC";
    $rs_out = mysqli_query($con, $query_out);

?>
    <div>
        <div class="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control form-control-sm" list="city_in_list" name="city_in_p" id="city_in_p" autocomplete="off" placeholder="Depature" onchange="add_out(this.value)">
                        <datalist id="city_in_list">
                            <?php
                            while ($row_in = mysqli_fetch_array($rs_in)) {
                            ?>
                                <option value="<?php echo $row_in['city_in'] ?> "></option>
                            <?php
                            }
                            ?>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control form-control-sm" list="city_out_list" name="city_out_p" id="city_out_p" autocomplete="off" placeholder="Arrival">
                        <datalist id="city_out_list">
                        </datalist>
                    </div>
                </div>
                <div class="col-md-4" style="text-align: left;">
                    <button type="button" class="btn btn-primary btn-sm" onclick="show_table()">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div id="table_search">

    </div>
    <script>
        function add_out(x) {
            $('#city_out_p').empty();
            $.post('LTP_city_out_field.php', {
                'x': x
            }, function(data) {
                var jsonData = JSON.parse(data);
                var options = '';
                if (jsonData != '') {
                    for (var i = 0; i < jsonData.length; i++) {
                        var counter = jsonData[i];
                        options += '<option value="' + counter.city_out + '">' + counter.city_out + '</option>';
                    }
                    document.getElementById('city_out_list').innerHTML = options;

                } else {
                    options += '<option value="" selected>Tidak ada data Penerbangan</option>';
                    document.getElementById('city_out_list').innerHTML = options;
                }
            });
        }

        function show_table() {
            var city_in = $('#city_in_p').val();
            var city_out = $('#city_out_p').val();
            $.ajax({
                url: "LTP_table_field.php",
                method: "POST",
                asynch: false,
                data: {
                    city_in: city_in,
                    city_out: city_out
                },
                success: function(data) {
                    $('#table_search').html(data);
                }
            });
        }
    </script>
<?php
}
?>