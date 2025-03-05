<?php
include "../db=connection.php";
var_dump($_POST['pilihan']);
?>
<form>
    <div class="form-group">
        <label>Code</label>
        <input type="text" class="form-control form-control-sm" id="code">
    </div>
    <div class="form-group">
        <label>Continent</label>
        <input type="text" class="form-control form-control-sm" id="continent">
    </div>
    <div class="form-group">
        <label>Country</label>
        <input type="text" class="form-control form-control-sm" id="country">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" class="form-control form-control-sm" id="city">
    </div>
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control form-control-sm" id="title">
    </div>
    <div class="form-group">
        <label>Depature</label>
        <input type="text" class="form-control form-control-sm" id="depature">
    </div>
    <div class="form-group">
        <label>City IN</label>
        <input type="text" class="form-control form-control-sm" id="cityin">
    </div>
    <div class="form-group">
        <label>City OUT</label>
        <input type="text" class="form-control form-control-sm" id="cityout">
    </div>
    <input type="hidden" name="pilihan" id="pilihan" value="<?php echo $_POST['pilihan'] ?>">
    <input type="hidden" name="pax" id="pax" value="<?php echo $_POST['pax'] ?>">
    <button type="button" class="btn btn-success" onclick="add_code(<?php echo $_POST['id'] ?>,<?php echo $_POST['package'] ?>)">Submit</button>
</form>
<script>
    function add_code(x,y) {
        var code = document.getElementById("code").value;
        var continent = document.getElementById("continent").value;
        var country = document.getElementById("country").value;
        var city = document.getElementById("city").value;
        var title = document.getElementById("title").value;
        var depature = document.getElementById("depature").value;
        var cityin = document.getElementById("cityin").value;
        var cityout = document.getElementById("cityout").value;
        var pax = document.getElementById("pax").value;
        var pilihan = document.getElementById("pilihan").value;
        // alert(y);
        $.ajax({
            url: "insert_new_codeb.php",
            method: "POST",
            async: false,
            data: {
                id:x,
                package:y,
                code:code,
                continent:continent,
                country:country,
                city:city,
                title:title,
                depature:depature,
                cityin:cityin,
                cityout:cityout,
                pax:pax,
                pilihan:pilihan
            },
            success: function(data) {
                 alert(data);
            }
        });
    }
</script>