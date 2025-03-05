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
                    <label>Flight</label>
                <?php
                }
                ?>

                <select class="form-control form-control-sm" name="fl" id="fl<?php echo $i ?>" onchange="set_val(this.value,<?php echo $i ?>)">
                    <option selected>Choose...</option>
                    <?php
                    $query_flight_logo = "SELECT * FROM  LT_flight_logo order by nama ASC";
                    $rs_flight_logo = mysqli_query($con, $query_flight_logo);
                    while ($row_flight_logo = mysqli_fetch_array($rs_flight_logo)) {
                    ?>
                        <option value="<?php echo $row_flight_logo['id']  ?>"><?php echo $row_flight_logo['nama'] . " (" . $row_flight_logo['kode'] . ") "  ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>City In</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" list="city_in_list<?php echo $i ?>" id="city_in<?php echo $i ?>" name="city_in" onchange="set_in(this.value,<?php echo $i ?>)">
                <datalist id="city_in_list<?php echo $i ?>">
                    <?php
                    $query_city = "SELECT name FROM city Order by name ASC";
                    $rs_city = mysqli_query($con, $query_city);
                    while ($row_city = mysqli_fetch_array($rs_city)) {
                    ?>
                        <option value="<?php echo $row_city['name'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col mb-2" style="max-width: 190px;">

                <?php
                if ($i == 1) {
                ?>
                    <label>City Out</label>
                <?php
                }
                ?>
                <input type="text" class="form-control form-control-sm" list="city_out_list<?php echo $i ?>" id="city_out<?php echo $i ?>" name="city_out" placeholder="City Out">
                <datalist id="city_out_list<?php echo $i ?>">
                    <?php
                    $query_city2 = "SELECT name FROM city Order by name ASC";
                    $rs_city2 = mysqli_query($con, $query_city2);
                    while ($row_city2 = mysqli_fetch_array($rs_city2)) {
                    ?>
                        <option value="<?php echo $row_city2['name'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Musim</label>
                <?php
                }
                ?>

                <select id="musim<?php echo $i ?>" name="musim" class="form-control form-control-sm" onchange="set_musim(this.value,<?php echo $i ?>)">
                    <option selected>Choose...</option>
                    <option value="all">All</option>
                    <option value="winter">Winter</option>
                    <option value="summer">Summer</option>
                </select>
            </div>
            <div class="col mb-2" style="max-width: 90px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Type</label>
                <?php
                }
                ?>

                <select id="rute<?php echo $i ?>" name="rute" class="form-control form-control-sm" onchange="set_type(this.value,<?php echo $i ?>)">
                    <option selected>Choose...</option>
                    <option value="FIT">FIT</option>
                    <option value="FIG">FIG</option>
                </select>
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>Trip</label>
                <?php
                }
                ?>
                <select id="trip<?php echo $i ?>" name="trip" class="form-control form-control-sm" onchange="fungsi_trip(this.value,<?php echo $i ?>)">
                    <option value="" selected>Choose...</option>
                    <?php
                    $query_type = "SELECT * FROM LTP_type_flight order by id ASC ";
                    $rs_type = mysqli_query($con, $query_type);
                    while ($row_type = mysqli_fetch_array($rs_type)) {
                    ?>
                        <option value="<?php echo $row_type['id'] ?>"><?php echo $row_type['nama'] ?></option>
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
                    <label>Bagasi</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="bagasi<?php echo $i ?>" name="bagasi">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>BF</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="bf<?php echo $i ?>" name="bf">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>LN</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="ln<?php echo $i ?>" name="ln">
            </div>
            <div class="col mb-2" style="max-width: 190px;">
                <?php
                if ($i == 1) {
                ?>
                    <label>DN</label>
                <?php
                }
                ?>
                <input type="number" class="form-control form-control-sm" id="dn<?php echo $i ?>" name="dn">
            </div>
        </div>
    <?php
    }
    ?>

    <div class="m-2">
        <button type="button" class="btn btn-success btn-sm" onclick="add_fl(<?php echo $_POST['id_promo'] ?>)">Submit</button>
    </div>
</form>

<script>
    function set_val(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("fl" + $i).value = x;
            };
        }

    }

    function set_in(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("city_in" + $i).value = x;
            };
        }

    }

    function set_musim(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("musim" + $i).value = x;
            };
        }

    }

    function set_type(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("rute" + $i).value = x;
            };
        }

    }

    function fungsi_trip(x, y) {
        var loop = document.getElementById("row_number").value;
        if (y == 1) {
            for ($i = 1; $i <= loop; $i++) {
                document.getElementById("trip" + $i).value = x;
            };
        }

    }

    function add_fl(x) {
        let formData = new FormData();
        var loop = document.getElementById("row_number").value;
        for (i = 1; i <= loop; i++) {
            var fl = document.getElementById("fl"+i).value;
            var city_in = document.getElementById("city_in"+i).value;
            var city_out = document.getElementById("city_out"+i).value;
            var musim = document.getElementById("musim"+i).value;
            var tipe = document.getElementById("rute"+i).value;
            var trip = document.getElementById("trip"+i).value;
            var adt = document.getElementById("adt"+i).value;
            var chd = document.getElementById("chd"+i).value;
            var inf = document.getElementById("inf"+i).value;
            var bagasi = document.getElementById("bagasi"+i).value;
            var bf = document.getElementById("bf"+i).value;
            var ln = document.getElementById("ln"+i).value;
            var dn = document.getElementById("dn"+i).value;

            formData.append('fl' + i, fl);
            formData.append('city_in' + i, city_in);
            formData.append('city_out' + i, city_out);
            formData.append('musim' + i, musim);
            formData.append('tipe' + i, tipe);
            formData.append('trip' + i, trip);
            formData.append('adt' + i, adt);
            formData.append('chd' + i, chd);
            formData.append('inf' + i, inf);
            formData.append('bagasi' + i, bagasi);
            formData.append('bf' + i, bf);
            formData.append('ln' + i, ln);
            formData.append('dn' + i, dn);

            // alert(trip);
        }
        formData.append('loop', loop);
        formData.append('id', x);
        $.ajax({
            type: 'POST',
            url: "insert-fl-agent.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_Package(15, 0, 0);
                // LT_Package(20, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }
</script>