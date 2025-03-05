<?php $trans = $_POST['trans'];
$day = $_POST['day'];
// var_dump($day);
?>
<!-- <div class="row"> -->
<?php
for ($xt = 1; $xt <= $trans; $xt++) {
?>
    <div class="row">
        <div class="col-md-2">
            <label style="font-size: 11px;">Pilihan <?php echo $xt ?></label>
            <select class="form-control form-control-sm" name="<?php echo $day ?>pilih<?php echo $xt ?>" id="<?php echo $day ?>pilih<?php echo $xt ?>" onchange="pilihan2(<?php echo $day ?>,<?php echo $xt?>)">
                <option value="0">Select Type</option>
                <option value="1">Transport</option>
                <option value="2">Tempat</option>
            </select>
        </div>
        <div class="col">
            <div class="<?php echo $day ?>pil<?php echo $xt ?>" name="<?php echo $day ?>pil<?php echo $xt ?>" id="<?php echo $day ?>pil<?php echo $xt ?>"></div>
        </div>
    </div>
<?php
}
?>
<script>
    function pilihan2(x,y) {
        // alert(x+"pilihan uuu"+y);
        // var a = document.getElementById("1"+"pilih"+"1").options[document.getElementById("1"+"pilih"+"1").selectedIndex].value;
       var a =  document.getElementById(x+'pilih'+y).value;
        // alert(a);
        $.ajax({
            url: "LT_subtempat.php",
            method: "POST",
            asynch: false,
            data: {
                sub: a,
                day:x,
                loop:y
            },
            success: function(data) {
                // alert(x);
                // alert(y);
                 $('#'+x+'pil'+y).html(data);
                // document.getElementById(x + 'pil').style.display = 'none';
                // document.getElementById(x + 'pil2').style.display = 'block';
            }
        });
 
    }
</script>
<!-- </div> -->