<?php
include "../db=connection.php";
$x = $_POST['x'];
$loop =$_POST['loop'];
for ($i = 1; $i <= $loop; $i++) {
?>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label style="font-size: 11px;">NEGARA</label>
                <select class="form-control form-control-sm" name="<?php echo $i ?>negara<?php echo $x ?>" id="<?php echo $i ?>negara<?php echo $x ?>" onchange="fungsi_negara(<?php echo $x ?>,<?php echo $i ?>)">
                    <option selected value="">Pilih Negara</option>
                    <?php
                    $query_negara = "SELECT DISTINCT country FROM Transport_new ORDER BY country ASC";
                    $rs_negara = mysqli_query($con, $query_negara);
                    while ($row_negara = mysqli_fetch_array($rs_negara)) {
                    ?>
                        <option value="<?php echo $row_negara['country'] ?>"><?php echo $row_negara['country'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label style="font-size: 11px;">Detail</label>
                <!-- <select class="form-control form-control-sm" name="<?php echo $i ?>per<?php echo $x ?>" id="<?php echo $i ?>per<?php echo $x ?>">
                    <option selected value="">Pilih Kota</option>
                </select> -->
                <input class="form-control form-control-sm" list="<?php echo $i ?>per_list<?php echo $x ?>" name="<?php echo $i ?>per<?php echo $x ?>" id="<?php echo $i ?>per<?php echo $x ?>">
                <datalist id="<?php echo $i ?>per_list<?php echo $x ?>">
                <!-- <option data-customvalue="sdwew" value="asasasa"></option>
                <option data-customvalue="pppp" value="hahahahahah"></option> -->
                </datalist>
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label style="font-size: 11px;">Rent Type</label>
                <select class="form-control form-control-sm" name="<?php echo $i ?>per_detail<?php echo $x ?>" id="<?php echo $i ?>per_detail<?php echo $x ?>">
                    <option value="">Pilih Rent Type</option>
                    <option value="oneway">One Way</option>
                    <option value="twoway">Two Way</option>
                    <option value="hd1">Half Day 1</option>
                    <option value="hd2">HAlf Day 2</option>
                    <option value="fd1">Full Day 1</option>
                    <option value="fd2">Full Day 2</option>
                    <option value="kaisoda">Kaisoda</option>
                    <option value="luarkota">Luar Kota</option>
                </select>
            </div>
        </div>

    </div>
<?php
}
?>