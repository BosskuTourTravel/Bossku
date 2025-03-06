<?php
include "site.php";
include "db=connection.php";
if (isset($_POST['cabin'])) {
    $cabin = $_POST['cabin'];
    $id = $_POST['id'];
    for ($i = 0; $i < $cabin; $i++) {
        $query_cabin = "SELECT * FROM cruise_package_new  where id=" . $_POST['id'];
        $rs_cabin = mysqli_query($con, $query_cabin);
        $row_cabin = mysqli_fetch_array($rs_cabin);
?>
        <div style="padding : 10px 10px; background-color: yellowgreen; text-align: left;">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group" style="max-width: 150px;">
                        <label for="exampleInputEmail1">Adult</label>
                        <select class="form-control" id="adult" name="adult" onchange="Cd()">
                            <option selected="selected" value="2">2</option>
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group" style="max-width: 150px;">
                        <label for="exampleInputEmail1">Child</label>
                        <select class="form-control" id="child" name="child">
                            <option selected="selected" value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                </br>
            </div>
        </div>
        <div>
            <table style="text-align: left; min-width: 320px;">
                <div id="cd" name="cd">
                    <?php
                    $ad = 2;
                    $ch = 0;
                    for ($x = 0; $x < $ad; $x++) {
                    ?>
                        <tr>
                            <th>Adults :</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td style="padding-left: 5px;">Cabin</td>
                            <td>9000</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5px;">Depature Tax</td>
                            <td>800000</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5px;">Port Charger</td>
                            <td>800000</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5px;">Service</td>
                            <td>800000</td>
                        </tr>
                    <?php
                    }
                    ?>
                </div>
                <?php
                for ($y = 0; $y < $ch; $y++) {
                ?>
                    <tr>
                        <th>Childs :</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">Cabin</td>
                        <td>9000</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">Depature Tax</td>
                        <td>800000</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">Port Charger</td>
                        <td>800000</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 5px;">Service</td>
                        <td>800000</td>
                    </tr>
                <?php

                }
                ?>
                <tr>
                    <th style="color: salmon;">Total :</th>
                    <th style="color: salmon;"> 161000</th>
                </tr>
            </table>
        </div>
<?php
    }
}
?>
<script>
    function Cd() {
        var a = document.getElementById("adult").options[document.getElementById("adult").selectedIndex].value;
        alert(a);
        $.ajax({
            url: "change_cd.php",
            method: "POST",
            asynch: false,
            data: {
                cd: a
            },
            success: function(data) {
                $(' #cd').html(data);
            }
        });
    }
</script>