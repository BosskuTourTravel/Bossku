<?php
include "../db=connection.php";
// echo $_POST['id_promo'];
?>
<form action="">
    <?php
    for ($i = 1; $i <= $_POST['id']; $i++) {
    ?>
        <div class="form-row">
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Continent</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" list="continent_list<?php echo $i ?>" id="continent<?php echo $i ?>" autocomplete="off" name="continent" onchange="set_in(this.value,<?php echo $i ?>)">
                <datalist id="continent_list<?php echo $i ?>">
                    <?php
                    $query_con = "SELECT * FROM continent Order by name ASC";
                    $rs_con = mysqli_query($con, $query_con);
                    while ($row_con = mysqli_fetch_array($rs_con)) {
                    ?>
                        <option value="<?php echo $row_con['name'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Region</label>
                <?php
                }
                ?>

                <select id="region<?php echo $i ?>" name="region" class="form-control form-control-sm" onchange="set_region(this.value,<?php echo $i ?>)">
                    <option selected value="">Choose...</option>
                    <option value="West">West</option>
                    <option value="East">East</option>
                    <option value="North">North</option>
                    <option value="South">South</option>
                    <option value="Northeast">Northeast</option>
                    <option value="Northwest">Northwest</option>
                    <option value="Southeast">Southeast</option>
                    <option value="Southwest">Southwest</option>
                </select>
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Country</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" id="country<?php echo $i ?>" name="country" placeholder="country 1 - country 2 - Country 3" autocomplete="off">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>City</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" id="city<?php echo $i ?>" name="city" placeholder="City 1 - City 2 - City 3" autocomplete="off">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Tour Name</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" id="nama<?php echo $i ?>" name="nama">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Kurs</label>
                <?php
                }
                ?>

                <select id="kurs<?php echo $i ?>" name="kurs" class="form-control form-control-sm" onchange="set_in_kurs(this.value,<?php echo $i ?>)">
                    <option selected>Choose...</option>
                    <?php
                    $query_kurs = "SELECT nama FROM kurs_bca_field order by nama ASC";
                    $rs_kurs = mysqli_query($con, $query_kurs);
                    while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
                    ?>
                        <option value="<?php echo $row_kurs['nama'] ?>"><?php echo $row_kurs['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Adult</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="adt<?php echo $i ?>" name="adt">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Child</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="chd<?php echo $i ?>" name="chd">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Infant</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="inf<?php echo $i ?>" name="inf">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Link PDF</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" id="pdf<?php echo $i ?>" name="pdf">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Link Image</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" id="img<?php echo $i ?>" name="img">
            </div>

        </div>
    <?php
    }
    ?>

    <div class="m-2">
        <button type="button" class="btn btn-success btn-sm" onclick="add_cons()">Submit</button>
    </div>
</form>

<script>
    function set_in(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("continent" + $i).value = x;
            };
        }

    }
    function set_region(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("region" + $i).value = x;
            };
        }

    }

    function set_in_kurs(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("kurs" + $i).value = x;
            };
        }

    }


    function add_cons() {
        let formData = new FormData();
        var loop = document.getElementById("row_number").value;
        for (i = 1; i <= loop; i++) {
            var con = document.getElementById("continent" + i).value;
            var region = document.getElementById("region" + i).value;
            var coun = document.getElementById("country" + i).value;
            var city = document.getElementById("city" + i).value;
            var nama = document.getElementById("nama" + i).value;
            var kurs = document.getElementById("kurs" + i).value;
            var adt = document.getElementById("adt" + i).value;
            var chd = document.getElementById("chd" + i).value;
            var inf = document.getElementById("inf" + i).value;
            var pdf = document.getElementById("pdf" + i).value;
            var img = document.getElementById("img" + i).value;

            formData.append('con' + i, con);
            formData.append('region' + i, region);
            formData.append('coun' + i, coun);
            formData.append('city' + i, city);
            formData.append('nama' + i, nama);
            formData.append('kurs' + i, kurs);
            formData.append('adt' + i, adt);
            formData.append('chd' + i, chd);
            formData.append('inf' + i, inf);
            formData.append('pdf' + i, pdf);
            formData.append('img' + i, img);


            //     // alert(trip);
        }
        formData.append('loop', loop);
        // formData.append('id', x);
        $.ajax({
            type: 'POST',
            url: "insert_consortium.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }
</script>