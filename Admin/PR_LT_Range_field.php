<?php
include "../db=connection.php";
$i = $_POST['i'];
?>
<div id="row<?php echo $i ?>">
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="mulai" name="mulai[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="until" name="until[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="profit" name="profit[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="admin" name="admin[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="marketing" name="marketing[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="sub_agent" name="sub_agent[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="staff" name="staff[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <input type="Text" class="form-control form-control-sm" id="nominal" name="nominal[]">
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn-sm btn_remove" onclick="remove(<?php echo $i ?>)"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>