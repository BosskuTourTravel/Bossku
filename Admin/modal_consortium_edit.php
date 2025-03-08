<?php
include "../db=connection.php";
$i = 1;
$query_cek = "SELECT * FROM consortium_list where id='" . $_POST['id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
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
        <input type="text" class="form-control form-control-sm" list="continent_list" id="continent" autocomplete="off" name="continent" value="<?php echo $row_cek['continent'] ?>" onchange="set_in(this.value)">
        <datalist id="continent_list">
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

        <select id="region" name="region" class="form-control form-control-sm" onchange="set_region(this.value,)">
            <option selected value="<?php echo $row_cek['detail'] ?>"><?php echo $row_cek['detail'] ?></option>
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
        <input type="text" class="form-control form-control-sm" id="country" name="country" value="<?php echo $row_cek['country'] ?>" placeholder="country 1 - country 2 - Country 3" autocomplete="off">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>City</label>
        <?php
        }
        ?>
        <input type="text" class="form-control form-control-sm" id="city" name="city" value="<?php echo $row_cek['city'] ?>" placeholder="City 1 - City 2 - City 3" autocomplete="off">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>Tour Name</label>
        <?php
        }
        ?>
        <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?php echo $row_cek['nama'] ?>">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>Kurs</label>
        <?php
        }
        ?>

        <select id="kurs" name="kurs" class="form-control form-control-sm" onchange="set_in_kurs(this.value,)">
            <option selected value="<?php echo $row_cek['kurs'] ?>"><?php echo $row_cek['kurs'] ?></option>
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
        <input type="number" class="form-control form-control-sm" id="adt" name="adt" value="<?php echo $row_cek['adt'] ?>">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>Child</label>
        <?php
        }
        ?>
        <input type="number" class="form-control form-control-sm" id="chd" name="chd" value="<?php echo $row_cek['chd'] ?>">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>Infant</label>
        <?php
        }
        ?>
        <input type="number" class="form-control form-control-sm" id="inf" name="inf" value="<?php echo $row_cek['inf'] ?>">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>Link PDF</label>
        <?php
        }
        ?>
        <input type="text" class="form-control form-control-sm" id="pdf" name="pdf" value="<?php echo $row_cek['link_pdf'] ?>">
    </div>
    <div class="col mb-2" style="max-width: 190px;">
        <?php
        if ($i == 1) {
        ?>
            <label>Link Image</label>
        <?php
        }
        ?>
        <input type="text" class="form-control form-control-sm" id="img" name="img" value="<?php echo $row_cek['link_gambar'] ?>">
    </div>
</div>
<div class="m-2">
    <button type="button" class="btn btn-success btn-sm" onclick="edit_cons(<?php echo $_POST['id'] ?>)">Submit</button>
</div>

<script>
    function edit_cons(x) {
        let formData = new FormData();
            var con = document.getElementById("continent").value;
            var region = document.getElementById("region").value;
            var coun = document.getElementById("country").value;
            var city = document.getElementById("city").value;
            var nama = document.getElementById("nama").value;
            var kurs = document.getElementById("kurs").value;
            var adt = document.getElementById("adt").value;
            var chd = document.getElementById("chd").value;
            var inf = document.getElementById("inf").value;
            var pdf = document.getElementById("pdf").value;
            var img = document.getElementById("img").value;

            formData.append('con', con);
            formData.append('region', region);
            formData.append('coun', coun);
            formData.append('city', city);
            formData.append('nama', nama);
            formData.append('kurs', kurs);
            formData.append('adt', adt);
            formData.append('chd', chd);
            formData.append('inf', inf);
            formData.append('pdf', pdf);
            formData.append('img', img);
            formData.append('id', x);
            //     // alert(trip);
        // formData.append('id', x);
        $.ajax({
            type: 'POST',
            url: "edit_consortium.php",
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